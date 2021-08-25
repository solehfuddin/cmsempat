<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ArticleModel;
use Config\Services;

class Article extends BaseController
{
	public function index()
	{
        if(!$this->session->get('islogin'))
		{
			return redirect()->to(base_url() . '/');
		}

		return view('v_article');
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

                                $action1 = "<button type=\"button\" class=\"btn btn-warning btn-sm btneditinfocategory\"
                                                onclick=\"editsiswa('" .$list->id_projek. "')\">
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
	
}