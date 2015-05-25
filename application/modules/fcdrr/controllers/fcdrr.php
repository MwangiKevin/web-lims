<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class fcdrr extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();		

        $this->load->model('fcdrr_model');
	}

	public function index() {
	
	}

	public function is_allowed(){		

		$this->load->library("Aauth");	
		if(!$this->aauth->is_allowed(1) || !is_admin()){
			http_response_code(401);
			$this->output->set_content_type('application/json')->set_output('false');
		}else{

			$this->output->set_content_type('application/json')->set_output('true');
		}

	}

	public function fillFCDRR_view(){
		$this->load->view("fcdrr_v",$data);

	}
	public function fcdrrs(){

		

		$this->load->view("fcdrrs_v",$data);

	}
	public function get_commodities_and_categories(){
		/* call the commodities and print the data in JSON format */
		
		$data=$this->fcdrr_model->get_commodities();
		$this->output->set_content_type('application/json')->set_output(json_encode($data,JSON_PRETTY_PRINT));


	}
}
