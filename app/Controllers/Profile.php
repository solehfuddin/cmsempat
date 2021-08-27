<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AccountModel;
use Config\Services;

class Profile extends BaseController
{
	public function index()
	{
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
		}

		$request = Services::request();
        $m_acc = new AccountModel($request);
		
		$data = [
			"account" => $m_acc->where('kode_user', $this->session->get('kodeuser'))->find(),
		];
		
		//dd($data);
		return view('v_profile', $data);
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
                    'profile_nama' => [
                        'label' => 'Nama user',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
					
					'profile_email' => [
                        'label' => 'Email',
                        'rules' => 'required',
                        'errors' => [
                            'required' 		=> '{field} wajib terisi'
                        ],
                    ],
                ]);

                if (!$check) {
                    $msg = [
                        'error' => [
                            "profile_nama" => $this->validation->getError('profile_nama'),
							"profile_email" => $this->validation->getError('profile_email'),
                        ]
                    ];
                }
                else
                {
					$newPass = $this->request->getVar('profile_newpass');
					$confirmPass = $this->request->getVar('profile_confirmpass');
					
					if ($newPass != null && $confirmPass != null)
					{
						if ($newPass == $confirmPass)
						{
							$data = [
							   'nama_user' => $this->request->getVar('profile_nama'),
							   'email' => $this->request->getVar('profile_email'),
							   'password' => md5($confirmPass),
							];
			
							$kode = $this->session->get('kodeuser');
			
							$request = Services::request();
							$m_acc = new AccountModel($request);

							$m_acc->update($kode, $data);
			
							$msg = [
								'success' => [
								   'data' => 'Berhasil memperbarui data',
								   'link' => base_url() . '/logout'
								]
							];
						}
						else
						{
							$errorPass = "Harap samakan kedua password";
							$msg = [
								'error' => [
									"profile_newpass" => $errorPass,
									"profile_confirmpass" => $errorPass,
								]
							];
						}
					}
					else
					{
						$data = [
						   'nama_user' => $this->request->getVar('profile_nama'),
						   'email' => $this->request->getVar('profile_email'),
						];
		
						$kode = $this->session->get('kodeuser');
		
						$request = Services::request();
						$m_acc = new AccountModel($request);

						$m_acc->update($kode, $data);
		
						$msg = [
							'success' => [
							   'data' => 'Berhasil memperbarui data',
							   'link' => base_url() . '/viewprofile'
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
}