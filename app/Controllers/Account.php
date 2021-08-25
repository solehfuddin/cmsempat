<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AccountModel;
use Config\Services;

class Account extends BaseController
{
	public function index()
	{
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
		}

		return view('v_account');
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
                $m_account  = new AccountModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_account->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $row = [];

                                $action1 = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editsiswa('" .$list->kode_user. "')\">
                                                <i class=\"fa fa-edit\"></i></button>";
								
								$action = "<td>
											<div class=\"dropdown\">
											<a class=\"btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle\" 
												href=\"#\" role=\"button\" data-toggle=\"dropdown\">
												<i class=\"dw dw-more\"></i>
											</a>
											<div class=\"dropdown-menu dropdown-menu-right dropdown-menu-icon-list\">
												<button type=\"button\" class=\"dropdown-item\" 
												onclick=\"editaccount('" .$list->kode_user. "')\"><i class=\"dw dw-edit2\"></i> Edit</button>
												<button type=\"button\" class=\"dropdown-item\" 
												onclick=\"deleteaccount('" .$list->kode_user. "')\"><i class=\"dw dw-delete-3\"></i> Delete</button>
											</div>
										   </div>
										   </td>";

                                $tgl = date("d-m-Y", strtotime($list->insert_date));

								if ($list->user_level == 1)
                                {
                                    $status = "Administrator";
                                }
                                else
                                {
                                    $status = "User";
                                }

                                $row[] = $list->kode_user;
                                $row[] = $list->nama_user;
                                $row[] = $list->email;
								$row[] = $status;
                                $row[] = $tgl;
                                $row[] = $action;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_account->count_all(),
                            "recordsFiltered" => $m_account->count_filtered(),
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
                $m_article = new AccountModel($request);

                $getdata = $m_article->findAll();
                $max  = count($getdata) + 1;
                $gen  = "USR" . str_pad($max, 3, 0, STR_PAD_LEFT); 
				
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
                    'account_kode' => [
                        'label' => 'Kode user',
                        'rules' => [
                            'required',
                            'is_unique[tbl_user.kode_user]',
                        ],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
                            'is_unique'	    => '{field} tidak boleh sama, coba dengan kode yang lain'
                        ],
                    ],
    
                    'account_nama' => [
                        'label' => 'Nama user',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'account_email' => [
                        'label' => 'Email user',
                        'rules' => [
							'required',
							'valid_email',
						],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
							'valid_email'	=> '{field} tidak valid',
                        ],
                    ],
					
					'account_password' => [
                        'label' => 'Password',
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
						"account_kode" => $this->validation->getError('account_kode'),
                        "account_nama" => $this->validation->getError('account_nama'),
						"account_email" => $this->validation->getError('account_email'),
						"account_password" => $this->validation->getError('account_password'),
					]
				];
			}
			else
			{
                $data = [
                    'kode_user' => $this->request->getVar('account_kode'),
                    'nama_user' => $this->request->getVar('account_nama'),
					'email' => $this->request->getVar('account_email'),
					'password' => md5($this->request->getVar('account_password')),
					'user_level' => $this->request->getVar('account_level'),
                ];

                $request = Services::request();
                $m_account = new AccountModel($request);

                $m_account->insert($data);

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
                $m_account = new AccountModel($request);

                $item = $m_account->find($kode);
    
                $data = [
                    'success' => [
                        'kode' => $item['kode_user'],
                        'nama' => $item['nama_user'],
						'email' => $item['email'],
                        'level' => $item['user_level'],
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
                    'account_namaubah' => [
                        'label' => 'Nama user',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'account_emailubah' => [
                        'label' => 'Email user',
                        'rules' => [
							'required',
							'valid_email',
						],
                        'errors' => [
                            'required' 		=> '{field} wajib terisi',
							'valid_email'	=> '{field} tidak valid',
                        ],
                    ],
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "account_namaubah" => $this->validation->getError('account_namaubah'),
							"account_emailubah" => $this->validation->getError('account_emailubah'),
                        ]
                    ];
                }
                else
                {
                    $data = [
                       'nama_user' => $this->request->getVar('account_namaubah'),
					   'email' => $this->request->getVar('account_emailubah'),
					   'user_level' => $this->request->getVar('account_levelubah'),
                    ];
    
                    $kode = $this->request->getVar('account_kodeubah');
    
                    $request = Services::request();
                    $m_account = new AccountModel($request);

                    $m_account->update($kode, $data);
    
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
                $m_account = new AccountModel($request);
                $m_account->delete($kode);
    
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