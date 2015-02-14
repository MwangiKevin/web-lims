<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();		
	}

	public function index() {
		$this->load->view("login_v");
		echo $this->config->item("copyrights");
	}
}
