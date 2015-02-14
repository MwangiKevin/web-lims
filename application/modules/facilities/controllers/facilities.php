<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class facilities extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();		

        $this->view_data['content_view'] = "facilities/facilities_v";
        $this->view_data['title'] = "CD4|Facilities";
		$this->view_data['menu1'] = "facility";
		$this->view_data['breadcrumbs'] 	=	array(
														0 	=>	array(
																	"title" 	=>	"Home",
																	"link"		=>	base_url()."",
																	"class"		=>	""
																	),
														1 	=>	array(
																	"title" 	=>	"Facilities",
																	"link"		=>	base_url()."facilities/facilities",
																	"class"		=>	"active"
																	)
												);
	}

	public function index() {
		$this->load->template($this->view_data);
	}
	
	public function view(){
		$this->view_data['content_view'] = "facilities/view_facilities_v";
        $this->view_data['title'] = "CD4|Tests";
		$this->view_data['breadcrumbs'] 	=	array(
														0 	=>	array(
																	"title" 	=>	"Home",
																	"link"		=>	base_url()."",
																	"class"		=>	""
																	),
														1 	=>	array(
																	"title" 	=>	"Facilities",
																	"link"		=>	base_url()."facilities/facilities",
																	"class"		=>	"active"
																	),
														2 	=>	array(
																	"title" 	=>	"Facilities View",
																	"link"		=>	"",
																	"class"		=>	"active"
																	)			
												);
		$this->load->template($this->view_data);
	}
}
