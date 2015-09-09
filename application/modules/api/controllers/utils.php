<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class utils extends MY_Controller {	

	function __construct() {

		parent::__construct();

		
		// header('Content-Type: application/json; charset=utf-8');
		// $this->load->model('api/api_m');
	}


	public function create_facility_default_user($id=NULL) {


			$this->load->model("utils_m");	

			echo json_encode($this->utils_m->create_facility_default_user($id),JSON_PRETTY_PRINT);
	}

	public function remap_facility_default_users() {


			$this->load->model("utils_m");	

			echo json_encode($this->utils_m->remap_facility_default_users(),JSON_PRETTY_PRINT);
	}
	public function reset_facility_default_users() {


			$this->load->model("utils_m");	

			echo json_encode($this->utils_m->reset_facility_default_users(),JSON_PRETTY_PRINT);
	}
}