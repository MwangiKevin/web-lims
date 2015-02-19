<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class reports extends MY_Controller {

	public $login_status = false;

	function __construct() {

	}

	public function index() {

		$this->load->view("reports_v");
	}
}
