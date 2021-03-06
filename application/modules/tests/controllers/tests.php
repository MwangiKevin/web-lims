<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class tests extends MY_Controller {

	public $login_status = false;

	function __construct() {
		parent:: __construct();
	}

	public function index() {

		$this->load->view("tests_v");
		// $this->load->view("testing_view");
	}

	public function get_tests()
	{
		$this->load->module("api");
		$this->load->model("test_model");
		$data = $this->api->tests();
		$result = $this->test_model->raw_ss_dt($data);

		echo json_encode($result, JSON_PRETTY_PRINT);
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
