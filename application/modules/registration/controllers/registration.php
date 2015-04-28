<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class registration extends MY_Controller {

	public $login_status = false;

	function __construct() {
		parent::__construct();		
	}

	public function index() {
		$this->load->view("registration_v");
	}

}
