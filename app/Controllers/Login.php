<?php

namespace App\Controllers;
use App\Models\LoginModel;

class Login extends BaseController
{
	protected $loginModel;

	public function __construct()
	{
		$this->loginModel = new LoginModel();
	}

	public function index()
	{
		if($this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/dashboard');
		}

		return view('v_login');
	}

	public function auth()
	{
		if ($this->request->isAJAX()) {
			$emailaddr = $this->request->getVar('inputuser');
			$pass      = $this->request->getVar('password');

			$validationCheck = $this->validate([
				'inputuser' => [
					'label' => 'Alamat Email',
					'rules' => [
						'required',
						'valid_email',
					],
					'errors' => [
						'required' 		=> '{field} wajib terisi',
						'valid_email'	=> '{field} tidak valid'
					],
				],

				'password' => [
					'label' => 'Password',
					'rules' => 'required',
					'errors' => [
						'required' 		=> '{field} wajib terisi'
					],
				]
			]);

			if (!$validationCheck) {
				$msg = [
					'error' => [
						"inputuser" => $this->validation->getError('inputuser'),
						"password" => $this->validation->getError('password'),
					]
				];
			}
			else
			{
				$mailCheck = $this->loginModel->login($emailaddr);

				if (count($mailCheck) > 0)
				{
					$passCheck = $mailCheck[0]['password'];
					$levelCheck= $mailCheck[0]['user_level'];

					if ($passCheck == md5($pass)) {
						if ($levelCheck != "")
						{
							$saveSession = [
								'islogin' => true,
								'kodeuser' => $mailCheck[0]['kode_user'],
								'username' => $mailCheck[0]['nama_user'],
								'alamatemail' => $mailCheck[0]['email'],
								'idlevel'	=> $mailCheck[0]['user_level'],
								'otp'	=> $mailCheck[0]['kode_otp'],
							];
	
							$this->session->set($saveSession);
	
							$msg = [
								'success' => [
									'link' => base_url() . '/dashboard'
								]
							];
						}
						else
						{
							$msg = [
								'error' => [
									'errorauth' => 'Maaf akun anda tidak dapat akses ke sistem'
								]
							];
						}
					}
					else
					{
						$msg = [
							'error' => [
								'password' => 'Maaf password anda salah'
							]
						];
					}
				}
				else
				{
					$msg = [
						'error' => [
							'inputuser' => 'Maaf akun tidak ditemukan'
						]
					];
				}
			}

			echo json_encode($msg);
		}
	}

	public function out()
	{
		$this->session->destroy();
		return redirect()->to(base_url() . '/');
	}
}
