<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class users extends MY_Controller {

	public $login_status = false;

	function __construct() {
		parent::__construct();		
	}

	public function index() {
		$this->load->view("users_v");
	}

	public function details() {
		$this->load->view("view_user_v");
	}

	/* Load the edit user view */
	public function edit(){
		$this->load->view("edit_user_v");
	}

	/* Load the new user view */
	public function new(){
		$this->load->view("new_user_v");
	}

}
