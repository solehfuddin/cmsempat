<?php 
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class TestimoniModel extends Model {
    protected $table = 'tbl_testimoni';
    protected $primaryKey = 'id_testimoni';
    protected $allowedFields = ['id_testimoni','name', 'perusahaan', 'jabatan', 'image', 'testimoni', 
                                'kode_user'];
    protected $column_order = array('image', 'name', 'perusahaan', 'jabatan', 'nama_user',
                                    'tbl_testimoni.insert_date', '');
    protected $column_search = array('image', 'name', 'perusahaan', 'jabatan', 'tbl_testimoni.insert_date');
    protected $order = array('id_testimoni' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table)
                             ->select('*, tbl_user.nama_user, tbl_user.email')
                             ->join('tbl_user', 'tbl_testimoni.kode_user = tbl_user.kode_user');
    }

    private function _get_datatables_query(){
        $i = 0;
        foreach ($this->column_search as $item){
            if($this->request->getPost('search')['value']){ 
                if($i===0){
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                }
                else{
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }
         
        if($this->request->getPost('order')){
                $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
            } 
        else if(isset($this->order)){
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables(){
        $this->_get_datatables_query();
        if($this->request->getPost('length') != -1)
        $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    function count_filtered(){
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }

    public function count_all(){
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}