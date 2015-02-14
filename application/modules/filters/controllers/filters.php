<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class filters extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();		
	}

	public function index() {
		$this->load->view("filter_view");
	}

}
