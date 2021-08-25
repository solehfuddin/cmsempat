<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ArticletypeModel;
use Config\Services;

class Articletype extends BaseController
{
	public function index()
	{
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
		}

		return view('v_articletype');
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
                $m_artype  = new ArticletypeModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_artype->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $row = [];

                                $action1 = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editsiswa('" .$list->kode_type. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";
								
								$action = "<td>
											<div class=\"dropdown\">
											<a class=\"btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle\" 
												href=\"#\" role=\"button\" data-toggle=\"dropdown\">
												<i class=\"dw dw-more\"></i>
											</a>
											<div class=\"dropdown-menu dropdown-menu-right dropdown-menu-icon-list\">
												<button type=\"button\" class=\"dropdown-item\" 
												onclick=\"editarticletype('" .$list->kode_type. "')\"><i class=\"dw dw-edit2\"></i> Edit</button>
												<button type=\"button\" class=\"dropdown-item\" 
												onclick=\"deletearticletype('" .$list->kode_type. "')\"><i class=\"dw dw-delete-3\"></i> Delete</button>
											</div>
										   </div>
										   </td>";

                                $tgl = date("d-m-Y", strtotime($list->insert_date));

                                $row[] = $list->kode_type;
                                $row[] = $list->type;
                                $row[] = $tgl;
                                $row[] = $list->nama_user;
                                $row[] = $action;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_artype->count_all(),
                            "recordsFiltered" => $m_artype->count_filtered(),
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
	
	public function getdata() {
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $request = Services::request();
                $m_article = new ArticletypeModel($request);

                $getdata = $m_article->findAll();
                $max  = count($getdata) + 1;
                $gen  = "TART" . str_pad($max, 3, 0, STR_PAD_LEFT); 
				
				/* $gen  = "PENG" . str_pad(time(), 3, 0, STR_PAD_LEFT); 
                $gen  = "PENG" . str_pad(date("dmyms"), 3, 0, STR_PAD_LEFT); */

                $data = [
                    'kodegen' => $gen
                ];

                echo json_encode($data);
            }
            else
            {
                return view('errors/html/error_404');
            }
        }
    }
	
	public function simpandata() {
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $validationCheck = $this->validate([
                    'articletype_kode' => [
                        'label' => 'Kode tipe artikel',
                        'rules' => [
                            'required',
                            'is_unique[type_article.kode_type]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'articletype_judul' => [
                        'label' => 'Tipe artikel',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);
            }
            else
            {
                return view('errors/html/error_404');
            }

            if (!$validationCheck) {
				$msg = [
					'error' => [
						"articletype_kode" => $this->validation->getError('articletype_kode'),
                        "articletype_judul" => $this->validation->getError('articletype_judul'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_type' => $this->request->getVar('articletype_kode'),
                    'type' => $this->request->getVar('articletype_judul'),
					'kode_user' => $this->session->get('kodeuser'),
                ];

                $request = Services::request();
                $m_arttype = new ArticletypeModel($request);

                $m_arttype->insert($data);

                $msg = [
                    'success' => [
                       'data' => 'Berhasil menambahkan data',
                       'link' => base_url() . '/v_articletype'
                    ]
                ];
            }

            echo json_encode($msg);
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
                $m_arttype = new ArticletypeModel($request);

                $item = $m_arttype->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_type'],
                        'judul' => $item['type'],
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
			return redirect()->to(base_url() . '/');
        }
        else
        {
            if ($this->request->isAJAX())
            {
                $check = $this->validate([
                    'articletype_judulubah' => [
                        'label' => 'Tipe artikel',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "articletype_judulubah" => $this->validation->getError('articletype_judulubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                       'type' => $this->request->getVar('articletype_judulubah'),
					   'kode_user' => $this->session->get('kodeuser'),
                    ];
    
                    $kode = $this->request->getVar('articletype_kodeubah');
    
                    $request = Services::request();
                    $m_arttype = new ArticletypeModel($request);

                    $m_arttype->update($kode, $data);
    
                    $msg = [
                        'success' => [
                           'data' => 'Berhasil memperbarui data',
                           'link' => '/admcattype'
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
	
	public function hapusdata() {
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_arttype = new ArticletypeModel($request);
                $m_arttype->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data pengumuman dengan kode ' . $kode,
                        'link' => '/adminfonews'
                     ]
                ];
            }
            else
            {
                return view('errors/html/error_404');
            }
    
            echo json_encode($msg);
        }
    }  
}