<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class devices extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();		

		$this->view_data['menu1'] = "cd4";
		$this->view_data['cd4_menu'] = "devices";
		
        $this->view_data['content_view'] = "cd4/devices_v";
        $this->view_data['title'] = "CD4|Devices";
		$this->view_data['breadcrumbs'] 	=	array(
														0 	=>	array(
																	"title" 	=>	"Home",
																	"link"		=>	base_url()."",
																	"class"		=>	""
																	),
														1 	=>	array(
																	"title" 	=>	"Devices",
																	"link"		=>	base_url()."cd4/devices",
																	"class"		=>	"active"
																	)
												);
	}

	public function index() {
		$this->load->template($this->view_data);
	}
	
	public function view_device(){
		$this->view_data['content_view'] = "cd4/view_device";
        $this->view_data['title'] = "CD4|View Device";
		$this->view_data['breadcrumbs'] 	=	array(
														0 	=>	array(
																	"title" 	=>	"Home",
																	"link"		=>	base_url()."",
																	"class"		=>	""
																	),
														1 	=>	array(
																	"title" 	=>	"Devices",
																	"link"		=>	base_url()."cd4/devices",
																	"class"		=>	"active"
																	),
														2 =>	array(
																	"title" 	=>	"View Device",
																	"link"		=>	base_url()."cd4/devices/view_device",
																	"class"		=>	"active"
																	)
												);
		$this->load->template($this->view_data);
	}
	
	public function register(){
		$this->view_data['content_view'] = "cd4/register_device";
        $this->view_data['title'] = "CD4|Register Device";
		$this->view_data['breadcrumbs'] 	=	array(
												0 	=>	array(
															"title" 	=>	"Home",
															"link"		=>	base_url()."",
															"class"		=>	""
															),
												1 	=>	array(
															"title" 	=>	"Devices",
															"link"		=>	base_url()."cd4/devices",
															"class"		=>	"active"
															),
												2 =>	array(
															"title" 	=>	"Register Device",
															"link"		=>	base_url()."cd4/devices/register",
															"class"		=>	"active"
															)
										);
		
		
		
		
		
		
		
		
		$this->load->template($this->view_data);	
	}
}
