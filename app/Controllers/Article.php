<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\ArticletypeModel;
use Config\Services;

class Article extends BaseController
{
	public function index()
	{
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
		}

		$request = Services::request();
        $m_type = new ArticletypeModel($request);

        $data = [
			'arttype' => $m_type->getkodetype(),
        ];
		return view('v_article', $data);
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
                $m_article  = new ArticleModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_article->get_datatables();
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
												onclick=\"editarticle('" .$list->id_projek. "')\"><i class=\"dw dw-edit2\"></i> Edit</button>
												<button type=\"button\" class=\"dropdown-item\" 
												onclick=\"deletearticle('" .$list->id_projek. "')\"><i class=\"dw dw-delete-3\"></i> Delete</button>
											</div>
										   </div>
										   </td>";

                                $tgl = date("d-m-Y", strtotime($list->insert_date));

                                if ($list->type == "Information")
                                {
                                    $status = "<span class=\"badge badge-pill badge-info\">Informasi</span";
                                }
                                else if ($list->type == "News")
                                {
                                    $status = "<span class=\"badge badge-pill badge-warning\">Berita</span";
                                }
                                else if ($list->type == "Portofolio")
                                {
                                    $status = "<span class=\"badge badge-pill badge-success\">Portofolio</span";
                                }

                                $row[] = $status;
                                $row[] = $list->title;
                                $row[] = $list->slug;
                                $row[] = $list->nama_user;
                                $row[] = $tgl;
                                $row[] = $action;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_article->count_all(),
                            "recordsFiltered" => $m_article->count_filtered(),
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
                $m_article = new ArticleModel($request);

                $getdata = $m_article->findAll();
                $max  = count($getdata) + 1;
                $gen  = "ARTC" . str_pad($max, 3, 0, STR_PAD_LEFT); 
				
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
                    'article_kode' => [
                        'label' => 'Kode artikel',
                        'rules' => [
                            'required',
                            'is_unique[tbl_article.id_projek]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'article_title' => [
                        'label' => 'Judul artikel',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'article_slug' => [
                        'label' => 'Slug artikel',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'article_descfull' => [
                        'label' => 'Isi artikel',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'article_img' => [
                        'label' => 'Gambar',
                        'rules' => [
                            'uploaded[article_img]',
                            'mime_in[article_img,image/jpg,image/jpeg,image/gif,image/png]',
                            'is_image[article_img]',
                            'max_size[article_img,4096]',
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
						"article_kode" => $this->validation->getError('article_kode'),
                        "article_title" => $this->validation->getError('article_title'),
						"article_slug" => $this->validation->getError('article_slug'),
						"article_descfull" => $this->validation->getError('article_descfull'),
						"article_img" => $this->validation->getError('article_img'),
					]
				];
			}
			else
			{
				$kode = $this->request->getVar('article_kode');
                $gambar = $this->request->getFile('article_img');
                $filename = $kode . '.' . $gambar->getExtension();

                $gambar->move('public/images/', $filename);
                $location = base_url() . '/public/images/thumbs/' . $filename;
                $this->compressImg($filename);
				
				$data = [
					'id_projek' => $this->request->getVar('article_kode'),
					'kode_type' => $this->request->getVar('article_type'),
					'title' => $this->request->getVar('article_title'),
					'slug' => $this->request->getVar('article_slug'),
					'description' => $this->request->getVar('article_desc'),
					'full_description' => $this->request->getVar('article_descfull'),
					'kode_user' => $this->session->get('kodeuser'),
					'image' => $gambar->getName(),
				];

				$request = Services::request();
				$m_article = new ArticleModel($request);

				$m_article->insert($data);

				$msg = [
					'success' => [
					'data' => 'Berhasil menambahkan data',
					'link' => base_url() . '/v_article'
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
                $m_article = new ArticleModel($request);

                $item = $m_article->find($kode);
				$img = $item['image'] != null ? $item['image'] : 'notfound.png';
    
                $data = [
                    'success' => [
                        'kode' => $item['id_projek'],
                        'type' => $item['kode_type'],
                        'judul' => $item['title'],
						'slug' => $item['slug'],
						'img' => $item['image'],
						'image' => base_url() . '/public/images/' . $img,
						'deskripsishort' => $item['description'],
						'deskripsifull' => $item['full_description'],
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
					'article_titleubah' => [
                        'label' => 'Judul artikel',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'article_slugubah' => [
                        'label' => 'Slug artikel',
                        'rules' => [
							'required',
						],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                        ],
                    ],
					
					'article_descfullubah' => [
                        'label' => 'Isi artikel',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "article_titleubah" => $this->validation->getError('article_titleubah'),
							"article_slugubah" => $this->validation->getError('article_slugubah'),
							"article_descfullubah" => $this->validation->getError('article_descfullubah'),
                        ]
                    ];
                }
                else
                {
					if ($this->request->getFile('article_imgubah')->isValid())
					{
						//update dengan gambar
						$request = Services::request();
						$m_article = new ArticleModel($request);

						$kode = $this->request->getVar('article_kodeubah');
						$gambar = $this->request->getFile('article_imgubah');
						$item = $m_article->find($kode);
						$tbname = $item['image'];

						//unlink('public/images/' . $tbname);
						//unlink('public/images/thumbs/' . $tbname);

						$filename = $kode . '.' . $gambar->getExtension();
			
						$gambar->move('public/images/', $filename);
						$location = base_url() . '/public/images/thumbs/' . $filename;
						$this->compressImg($filename);
					
						$data = [
							'kode_type' => $this->request->getVar('article_typeubah'),
							'title' => $this->request->getVar('article_titleubah'),
							'slug' => $this->request->getVar('article_slugubah'),
							'description' => $this->request->getVar('article_descubah'),
							'full_description' => $this->request->getVar('article_descfullubah'),
							'kode_user' => $this->session->get('kodeuser'),
							'image' => $gambar->getName(),
						];

						$m_article->update($kode, $data);
			
						$msg = [
							'success' => [
								'data' => 'Berhasil memperbarui data dengan gambar',
								'link' => base_url() . '/listarticle'
							]
						];
					}
					else
					{
						//update tanpa gambar
						$data = [
						   'kode_type' => $this->request->getVar('article_typeubah'),
						   'title' => $this->request->getVar('article_titleubah'),
						   'slug' => $this->request->getVar('article_slugubah'),
						   'description' => $this->request->getVar('article_descubah'),
						   'full_description' => $this->request->getVar('article_descfullubah'),
						   'kode_user' => $this->session->get('kodeuser'),
						];
		
						$kode = $this->request->getVar('article_kodeubah');
		
						$request = Services::request();
						$m_article = new ArticleModel($request);

						$m_article->update($kode, $data);
		
						$msg = [
							'success' => [
							   'data' => 'Berhasil memperbarui data',
							   'link' => base_url() . '/listarticle'
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
                $m_article = new ArticleModel($request);

                //$item = $m_article->find($kode);
                //$filename = $item['image'];

                //unlink('public/images/' . $filename);
                //unlink('public/images/thumbs/' . $filename);
    
                $m_article->delete($kode);
    
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