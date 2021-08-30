<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\CustomModel;
use Config\Services;

class Custom extends BaseController
{
	public function index()
	{
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
		}
		
		$request = Services::request();
        $m_custom = new CustomModel($request);
		
		$data = [
			"custom" => $m_custom->findAll(),
		];

		//dd($data);
		return view('v_custom', $data);
	}

	public function ajax_list() {
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $request = Services::request();
                $m_custom  = new CustomModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_custom->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $row = [];

                                $action = "<td>
											<div class=\"dropdown\">
											<a class=\"btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle\" 
												href=\"#\" role=\"button\" data-toggle=\"dropdown\">
												<i class=\"dw dw-more\"></i>
											</a>
											<div class=\"dropdown-menu dropdown-menu-right dropdown-menu-icon-list\">
												<button type=\"button\" class=\"dropdown-item\" 
												onclick=\"editcustom('" .$list->id_custom. "')\"><i class=\"dw dw-edit2\"></i> Edit</button>
											</div>
										   </div>
										   </td>";

                                $tgl = date("d-m-Y", strtotime($list->insert_date));

                                $row[] = $list->key;
                                $row[] = $list->title;
                                $row[] = $list->nama_user;
                                $row[] = $tgl;
                                $row[] = $action;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_custom->count_all(),
                            "recordsFiltered" => $m_custom->count_filtered(),
                            "data" => $data
                        ];

						// dd($output);

                    echo json_encode($output);
                }
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }
	
	public function pilihdata() {
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_custom = new CustomModel($request);

                $item = $m_custom->find($kode);
				$img = $item['image'] != null ? $item['image'] : 'notfound.png';
    
                $data = [
                    'success' => [
						'judul' => 'Ubah ' . $item['key'],
						'kode' => $item['id_custom'],
                        'key' => $item['key'],
                        'title' => $item['title'],
						'link' => $item['link'],
						'counter' => $item['counter'],
						'desc1' => $item['description'],
						'desc2' => $item['description2'],
						'img' => $item['image'],
						'image' => base_url() . '/public/images/' . $img, 
						'status' => $item['is_active'],
                    ]
                ];
    
                echo json_encode($data);
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }
	
	public function perbaruidata() {
        if(!$this->session->get('islogin'))
		{
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX())
            {
				if ($this->request->getFile('custom_imgubah')->isValid())
				{
					//update dengan gambar
					$request = Services::request();
					$m_custom = new CustomModel($request);

					$kode = $this->request->getVar('custom_kodeubah');
					$gambar = $this->request->getFile('custom_imgubah');
					$item = $m_custom->find($kode);
					$tbname = $item['image'];

					//unlink('public/images/' . $tbname);
					//unlink('public/images/thumbs/' . $tbname);

					$filename = $kode . '.' . $gambar->getExtension();
			
					$gambar->move('public/images/', $filename);
					$location = base_url() . '/public/images/thumbs/' . $filename;
					//$this->compressImgVer($filename);
					
					$data = [
						'title' => $this->request->getVar('custom_judulubah'),
						'description' => $this->request->getVar('custom_desc1ubah'),
						'description2' => $this->request->getVar('custom_desc2ubah'),
						'image' => $gambar->getName(),
						'link' => $this->request->getVar('custom_linkubah'),
						'counter' => $this->request->getVar('custom_counterubah'),
						'kode_user' => $this->session->get('kodeuser'),
						'is_active' => $this->request->getVar('custom_isactiveubah'),
					];

						$m_custom->update($kode, $data);
			
						$msg = [
							'success' => [
								'data' => 'Berhasil memperbarui data dengan gambar',
								'link' => base_url() . '/customentry'
							]
						];
				}
				else
				{
					//update tanpa gambar
					$data = [
						'title' => $this->request->getVar('custom_judulubah'),
						'description' => $this->request->getVar('custom_desc1ubah'),
						'description2' => $this->request->getVar('custom_desc2ubah'),
						'link' => $this->request->getVar('custom_linkubah'),
						'counter' => $this->request->getVar('custom_counterubah'),
						'kode_user' => $this->session->get('kodeuser'),
						'is_active' => $this->request->getVar('custom_isactiveubah'),
					];
		
					$kode = $this->request->getVar('custom_kodeubah');
		
					$request = Services::request();
					$m_custom = new CustomModel($request);

					$m_custom->update($kode, $data);
		
					$msg = [
						'success' => [
							'data' => 'Berhasil memperbarui data',
							'link' => base_url() . '/customentry'
						]
					];
				}
    
                echo json_encode($msg);
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }
}