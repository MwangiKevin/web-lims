<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class api extends MY_Controller {	

	function __construct() {

		parent::__construct();
		$this->load->model("api_m");	
	}

	public function index() {
		if($this->login_status){
				$this->load->view('dashboard_template');
		}
	}
	
	public function regions(){
		$result = $this->api_m->get_region_details();
		$result = json_encode($result);
		print_r($result);
	}
	
	public function labs(){
		$result = $this->api_m->get_lab_details();
		$result = json_encode($result);
		print_r($result);
	}
	
	public function districts(){
		$result = $this->api_m->get_district_details();
		$result = json_encode($result);
		print_r($result);
	}
	
	public function partners(){
		$result = $this->api_m->get_partner_details();
		$result = json_encode($result);
		print_r($result);
	}
	
	public function facility(){
		$result = $this->api_m->get_facility_details();
		$result = json_encode($result);
		print_r($result);
	}
}
