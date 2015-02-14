<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class test extends MY_Controller {

	public $login_status = false;

	function __construct() {

		parent::__construct();		

        $this->view_data['content_view'] = "test/test_v";
        $this->view_data['title'] = "TEST";
	}

	public function index() {
		//echo $this->config->item("copyrights");

		$this->load->template($this->view_data);
	}
}
