<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\FaqModel;
use Config\Services;

class Faq extends BaseController
{
	public function index()
	{
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
		}

		return view('v_faq');
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
                $m_faq  = new FaqModel($request);

                if($request->getMethod(true)=='POST'){
                    $lists = $m_faq->get_datatables();
                        $data = [];
                        $no = $request->getPost("start");

                        foreach ($lists as $list) {
                                $row = [];

                                $action1 = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editsiswa('" .$list->id_contactus. "')\">
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

                                $tgl = date("d-m-Y", strtotime($list->insert_date));

								if ($list->is_reply == 0)
                                {
                                    $status = "<span class=\"badge badge-pill badge-danger\">Belum dibalas</span";
                                }
                                else
                                {
                                    $status = "<span class=\"badge badge-pill badge-success\">Sudah dibalas</span";
                                }

                                $row[] = $tgl;
                                $row[] = $list->name;
                                $row[] = $list->email;
                                $row[] = $list->message;
								$row[] = $status;
                                $row[] = $action;
                                $data[] = $row;
                        }
                    
                        $output = [
                            "draw" => $request->getPost('draw'),
                            "recordsTotal" => $m_faq->count_all(),
                            "recordsFiltered" => $m_faq->count_filtered(),
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