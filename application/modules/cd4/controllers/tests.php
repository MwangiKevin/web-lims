<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class tests extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();		
		
		$this->view_data['menu1'] = "cd4";
		$this->view_data['cd4_menu'] = "tests";
		
        $this->view_data['content_view'] = "cd4/tests_v";
        $this->view_data['title'] = "CD4|Tests";
		$this->view_data['breadcrumbs'] 	=	array(
														0 	=>	array(
																	"title" 	=>	"Home",
																	"link"		=>	base_url()."",
																	"class"		=>	""
																	),
														1 	=>	array(
																	"title" 	=>	"Tests",
																	"link"		=>	base_url()."cd4/tests",
																	"class"		=>	"active"
																	)
												);
	}

	public function index() {
		$this->load->template($this->view_data);
	}
	
	public function pima_tests(){//gets data for pima then redirects to tests_v
		$this->view_data['content_view'] = "cd4/pima_tests_v";
		$this->view_data['menu1'] = "cd4";
		$this->view_data['cd4_menu'] = "pima";	
		$this->view_data['title'] = "CD4|PIMA Tests";
		$this->view_data['breadcrumbs'] 	=	array(
														0 	=>	array(
																	"title" 	=>	"Home",
																	"link"		=>	"",
																	"class"		=>	""
																	),
														1 	=>	array(
																	"title" 	=>	"Tests",
																	"link"		=>	base_url()."cd4/tests",
																	"class"		=>	""
																	),
														2 	=>	array(
																	"title" 	=>	"Pima Tests",
																	"link"		=>	"#",
																	"class"		=>	"active"
																	)
												);
		$this->load->template($this->view_data);
	}
}
