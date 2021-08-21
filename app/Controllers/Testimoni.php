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
												<a class=\"dropdown-item\" href=\"#\"><i class=\"dw dw-eye\"></i> View</a>
												<a class=\"dropdown-item\" href=\"#\"><i class=\"dw dw-edit2\"></i> Edit</a>
												<a class=\"dropdown-item\" href=\"#\"><i class=\"dw dw-delete-3\"></i> Delete</a>
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
}