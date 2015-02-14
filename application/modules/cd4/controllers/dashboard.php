<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class dashboard extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();		

        $this->view_data['content_view'] = "cd4/dashboard_v";
        $this->view_data['title'] = "CD4|Dashboard";
		
		$this->view_data['menu1'] = "cd4";
		$this->view_data['cd4_menu'] = "dashboard";
		
		$this->view_data['breadcrumbs'] 	=	array(
														0 	=>	array(
																	"title" 	=>	"Home",
																	"link"		=>	base_url()."",
																	"class"		=>	""
																	),
														1 	=>	array(
																	"title" 	=>	"Dashboard",
																	"link"		=>	base_url()."cd4/dashboard",
																	"class"		=>	"active"
																	)
												);
	}

	public function index() {
		$this->load->template($this->view_data);
	}
}
