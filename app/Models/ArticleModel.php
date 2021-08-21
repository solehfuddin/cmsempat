<?php 
namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ArticleModel extends Model {
    protected $table = 'tbl_article';
    protected $primaryKey = 'id_projek';
    protected $allowedFields = ['id_projek','kode_type', 'title', 'slug', 'description', 'full_description', 
                                'image', 'kode_user', 'insert_date'];
    protected $column_order = array('type', 'title', 'slug', 'nama_user', 'tbl_article.insert_date', '');
    protected $column_search = array('type', 'title', 'slug', 'nama_user', 'tbl_article.insert_date');
    protected $order = array('tbl_article.insert_date' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request){
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table)
                             ->select('*, type_article.type, tbl_user.nama_user, tbl_user.email')
                             ->join('type_article', 'tbl_article.kode_type = type_article.kode_type')
                             ->join('tbl_user', 'tbl_article.kode_user = tbl_user.kode_user');
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