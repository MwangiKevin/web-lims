<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class devices extends MY_Controller {

	public $login_status = false;

	function __construct() {
		parent::__construct();		
	}

	public function index() {
		$this->load->view("devices_v");
	}

	public function device_uploads() {
		$this->load->view("uploads_v");
	}

}
