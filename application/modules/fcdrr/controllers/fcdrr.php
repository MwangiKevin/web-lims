<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class fcdrr extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();		

        $this->view_data['content_view'] = "fcdrr/fcdrr_v";
        $this->view_data['title'] = "FCDRR";

        $this->load->model('fcdrr_model');
	}

	public function index() {
		//echo $this->config->item("copyrights");
		$this->view_data['facs_calibur']=$this->fcdrr_model->get_facs_calibur_commodities();
		$this->view_data['facs_count']=$this->fcdrr_model->get_facs_count_commodities();
		$this->view_data['cyflow_partec']=$this->fcdrr_model->get_cyflow_commodities();
		$this->view_data['poc_commodities']=$this->fcdrr_model->get_poc_commodities();
		// $this->view_data['haematology']=$this->fcdrr_model->get_haematology_commodities();
		// $this->view_data['biochemistry']=$this->fcdrr_model->get_biochemistry_commodities();		

		$this->load->template($this->view_data);
	}

	public function fillFCDRR_view(){
		echo "<h1>This is the fcdrr page<h1/>";
	}
}
