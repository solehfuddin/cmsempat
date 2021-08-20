<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{
		if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
		}

		return view('v_dashboard');
	}
}
