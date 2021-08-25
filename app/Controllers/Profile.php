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

		return view('v_profile');
	}
}