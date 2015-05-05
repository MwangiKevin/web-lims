<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class tests extends MY_Controller {

	public $login_status = false;

	function __construct() {
		parent:: __construct();
		$this->load->model("test_model");
		
		
	}

	public function index() {

		// $this->load->view("tests_v");
		$this->load->view("testing_view");
	}

	function ss_procedure()
	{
		$length = $this->input->post(length);
		$search = $this->input->post(search);
		$order = $this->input->post(order);
		
		$ss_dt = $this->test_model->ss_dt( $length, $search, $order );
		print_r($ss_dt);
		
	}

	function test_unparametized()
	{
		$length = $this->input->post(length);
		$search = $this->input->post(search);
		$order = $this->input->post(order);
		$start = $this->input->post(start);

		$serverSide_data = $this->test_model->ss_dt($start, $length, $search, $order);
		
		echo json_encode($serverSide_data, JSON_PRETTY_PRINT);
	}

	
}
