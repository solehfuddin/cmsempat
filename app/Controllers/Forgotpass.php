<?php

namespace App\Controllers;

class ForgotPass extends BaseController
{
	public function index()
	{
		if($this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/dashboard');
		}

		return view('v_forgot');
	}
}
