<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class login extends MY_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->library("Aauth");	

	
	}
	public function nav_bar(){
		$this->load->view("login_navbar");
	}	
	public function logout(){
		$this->load->view('logout_v');
	}
	public function change_password(){
		$this->load->view('change_password_v');
	}
}