<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class fcdrr extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();		

        // $data['content_view'] = "fcdrr/fcdrr_v";
        // $this->view_data['title'] = "FCDRR";

        $this->load->model('fcdrr_model');
	}

	public function index() {
	
	}

	public function fillFCDRR_view(){

		

		$this->load->view("fcdrr_v",$data);

	}
	public function get_commodities(){

		$data['facs_calibur']=$this->fcdrr_model->get_facs_calibur_commodities();
		// $data['facs_count']=$this->fcdrr_model->get_facs_count_commodities();
		// $data['cyflow_partec']=$this->fcdrr_model->get_cyflow_commodities();
		// $data['poc_commodities']=$this->fcdrr_model->get_poc_commodities();

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
