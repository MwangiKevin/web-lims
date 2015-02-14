<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class pima extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();	
		$this->view_data['menu1'] = "cd4";
		$this->view_data['cd4_menu'] = "pima";	
	}

	public function index() {
		$this->errors();
	}
	
	public function errors(){
		$this->view_data['content_view'] = "cd4/pima_errors_v";
        $this->view_data['title'] = "CD4|PIMA Errors";
		
		$this->view_data['breadcrumbs'] 	=	array(
														0 	=>	array(
																	"title" 	=>	"Home",
																	"link"		=>	base_url()."",
																	"class"		=>	""
																	),
														1 	=>	array(
																	"title" 	=>	"PIMA Errors",
																	"link"		=>	base_url()."cd4/pima",
																	"class"		=>	"active"
																	)
												);
		$this->load->template($this->view_data);
	}
	
	public function controls(){
		$this->view_data['content_view'] = "cd4/pima_controls_v";
        $this->view_data['title'] = "CD4|PIMA Controls";
		
		$this->view_data['breadcrumbs'] 	=	array(
														0 	=>	array(
																	"title" 	=>	"Home",
																	"link"		=>	base_url()."",
																	"class"		=>	""
																	),
														1 	=>	array(
																	"title" 	=>	"PIMA Controls",
																	"link"		=>	base_url()."cd4/pima",
																	"class"		=>	"active"
																	)
												);
		$this->load->template($this->view_data);
		
	}
	
	public function tests(){
		$this->view_data['content_view'] = "cd4/pima_tests_v";
        $this->view_data['title'] = "CD4|PIMA Tests";
		
		$this->view_data['breadcrumbs'] 	=	array(
														0 	=>	array(
																	"title" 	=>	"Home",
																	"link"		=>	base_url()."",
																	"class"		=>	""
																	),
														1 	=>	array(
																	"title" 	=>	"PIMA Tests",
																	"link"		=>	base_url()."cd4/pima",
																	"class"		=>	"active"
																	)
												);
		$this->load->template($this->view_data);
		
	}
}
