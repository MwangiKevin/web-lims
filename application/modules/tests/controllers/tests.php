<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class tests extends MY_Controller {

	public $login_status = false;

	function __construct() {

	}

	public function index() {

		$this->load->view("tests_v");
	}

	function ss_procedure()
	{
		$sql_categories = R::getAll("CALL `proc_dt_tests`()");

		echo json_encode($sql_categories,JSON_PRETTY_PRINT);
	}
}
