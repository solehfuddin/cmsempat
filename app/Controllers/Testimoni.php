<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\TestimoniModel;
use Config\Services;

class Testimoni extends BaseController
{
	public function index()
	{
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
		}

		return view('v_testimoni');
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
                $m_testi  = new TestimoniModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_testi->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $row = [];

                                $action1 = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editsiswa('" .$list->id_testimoni. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";
								
								$action = "<td>
											<div class=\"dropdown\">
											<a class=\"btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle\" 
												href=\"#\" role=\"button\" data-toggle=\"dropdown\">
												<i class=\"dw dw-more\"></i>
											</a>
											<div class=\"dropdown-menu dropdown-menu-right dropdown-menu-icon-list\">
												<button type=\"button\" class=\"dropdown-item\" 
												onclick=\"edittestimoni('" .$list->id_testimoni. "')\"><i class=\"dw dw-edit2\"></i> Edit</button>
												<button type=\"button\" class=\"dropdown-item\" 
												onclick=\"deletetestimoni('" .$list->id_testimoni. "')\"><i class=\"dw dw-delete-3\"></i> Delete</button>
											</div>
										   </div>
										   </td>";

                                $img = "<img src='public/images/" .$list->image. "' width=100>";

                                $tgl = date("d-m-Y", strtotime($list->insert_date));

                                // $row[] = $list->image;
                                $row[] = $img;
                                $row[] = $list->name;
                                $row[] = $list->perusahaan;
                                $row[] = $list->jabatan;
                                $row[] = $list->nama_user;
                                $row[] = $tgl;
                                $row[] = $action;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_testi->count_all(),
                            "recordsFiltered" => $m_testi->count_filtered(),
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
                $m_testi = new TestimoniModel($request);

                $getdata = $m_testi->findAll();
                $max  = count($getdata) + 1;
                $gen  = "TSTI" . str_pad($max, 3, 0, STR_PAD_LEFT); 
				
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
                    'testimoni_kode' => [
                        'label' => 'Kode testimoni',
                        'rules' => [
                            'required',
                            'is_unique[tbl_testimoni.id_testimoni]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'testimoni_nama' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'testimoni_company' => [
                        'label' => 'Perusahaan',
                        'rules' => [
							'required',
						],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                        ],
                    ],
					
					'testimoni_position' => [
                        'label' => 'Jabatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'testimoni_content' => [
                        'label' => 'Isi testimoni',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'testimoni_image' => [
                        'label' => 'Gambar',
                        'rules' => [
                            'uploaded[testimoni_image]',
                            'mime_in[testimoni_image,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[testimoni_image]',
                            'max_size[testimoni_image,4096]',
                        ],
                        'errors' => [
                            'uploaded'      => '{field} wajib dipilih',
                            'mime_in' 		=> '{field} tidak sesuai format standar',
                            'is_image'      => '{field} tidak sesuai',
                            'max-size'      => '{field} melebihi ukuran yang ditentukan',
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
						"testimoni_kode" => $this->validation->getError('testimoni_kode'),
                        "testimoni_nama" => $this->validation->getError('testimoni_nama'),
						"testimoni_company" => $this->validation->getError('testimoni_company'),
						"testimoni_position" => $this->validation->getError('testimoni_position'),
						"testimoni_content" => $this->validation->getError('testimoni_content'),
						"testimoni_image" => $this->validation->getError('testimoni_image'),
					]
				];
			}
			else
			{
				$kode = $this->request->getVar('testimoni_kode');
                $gambar = $this->request->getFile('testimoni_image');
                $filename = $kode . '.' . $gambar->getExtension();

                $gambar->move('public/images/', $filename);
                $location = base_url() . '/public/images/thumbs/' . $filename;
				//$gambar->move(WRITEPATH.'uploads/', $filename);
                $this->compressImg($filename);
				
                $data = [
                    'id_testimoni' => $kode,
                    'name' => $this->request->getVar('testimoni_nama'),
					'perusahaan' => $this->request->getVar('testimoni_company'),
					'jabatan' => $this->request->getVar('testimoni_position'),
					'image' => $this->request->getVar('account_level'),
					'testimoni' => $this->request->getVar('testimoni_content'),
					'kode_user' => $this->session->get('kodeuser'),
					'image' => $gambar->getName(),
                ];

                $request = Services::request();
                $m_testi = new TestimoniModel($request);

                $m_testi->insert($data);

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
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_testi = new TestimoniModel($request);

                $item = $m_testi->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['id_testimoni'],
                        'nama' => $item['name'],
                        'perusahaan' => $item['perusahaan'],
						'jabatan' => $item['jabatan'],
						'image' => base_url() . '/public/images/' . $item['image'],
						'testimoni' => $item['testimoni'],
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
                $check = $this->validate([
					'testimoni_namaubah' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'testimoni_companyubah' => [
                        'label' => 'Perusahaan',
                        'rules' => [
							'required',
						],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                        ],
                    ],
					
					'testimoni_positionubah' => [
                        'label' => 'Jabatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'testimoni_contentubah' => [
                        'label' => 'Isi testimoni',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "testimoni_namaubah" => $this->validation->getError('testimoni_namaubah'),
							"testimoni_companyubah" => $this->validation->getError('testimoni_companyubah'),
							"testimoni_positionubah" => $this->validation->getError('testimoni_positionubah'),
							"testimoni_contentubah" => $this->validation->getError('testimoni_contentubah'),
                        ]
                    ];
                }
                else
                {
					if ($this->request->getFile('testimoni_imageubah')->isValid())
					{
						//update dengan gambar
						$request = Services::request();
						$m_testi = new TestimoniModel($request);

						$kode = $this->request->getVar('testimoni_kodeubah');
						$gambar = $this->request->getFile('testimoni_imageubah');
						$item = $m_testi->find($kode);
						$tbname = $item['image'];

						unlink('public/images/' . $tbname);
						unlink('public/images/thumbs/' . $tbname);

						$filename = $kode . '.' . $gambar->getExtension();
			
						$gambar->move('public/images/', $filename);
						$location = base_url() . '/public/images/thumbs/' . $filename;
						$this->compressImg($filename);
					
						$data = [
							'name' => $this->request->getVar('testimoni_namaubah'),
							'perusahaan' => $this->request->getVar('testimoni_companyubah'),
							'jabatan' => $this->request->getVar('testimoni_positionubah'),
							'testimoni' => $this->request->getVar('testimoni_contentubah'),
							'kode_user' => $this->session->get('kodeuser'),
							'image' => $gambar->getName(),
						];

						$m_testi->update($kode, $data);
			
						$msg = [
							'success' => [
								'data' => 'Berhasil memperbarui data dengan gambar',
								'link' => base_url() . '/feedbackcustomer'
							]
						];
					}
					else
					{
						//update tanpa gambar
						$data = [
						   'name' => $this->request->getVar('testimoni_namaubah'),
						   'perusahaan' => $this->request->getVar('testimoni_companyubah'),
						   'jabatan' => $this->request->getVar('testimoni_positionubah'),
						   'testimoni' => $this->request->getVar('testimoni_contentubah'),
						   'kode_user' => $this->session->get('kodeuser'),
						];
		
						$kode = $this->request->getVar('testimoni_kodeubah');
		
						$request = Services::request();
						$m_testi = new TestimoniModel($request);

						$m_testi->update($kode, $data);
		
						$msg = [
							'success' => [
							   'data' => 'Berhasil memperbarui data',
							   'link' => base_url() . '/feedbackcustomer'
							]
						];
					}
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
			return view('view_login');
        }
        else
        {
            if ($this->request->isAJAX()) {
                $kode = $this->request->getVar('kode');
                $request = Services::request();
                $m_testi = new TestimoniModel($request);

                $item = $m_testi->find($kode);
                $filename = $item['image'];

                unlink('public/images/' . $filename);
                unlink('public/images/thumbs/' . $filename);
    
                $m_testi->delete($kode);
    
                $msg = [
                    'success' => [
                        'data' => 'Berhasil menghapus data dengan kode ' . $kode,
                        'link' => '/admsettingbenefit'
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