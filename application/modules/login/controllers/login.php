<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class login extends MY_Controller {	

	function __construct() {
		parent::__construct();
		$this->load->library("Aauth");		
	}

	public function index() {
		$this->load->view('dashboard_template');
	}
	
	public function dashboard_view(){
		$this->load->view("dashboard_v");
	}
	
	public function nav_bar(){
		$this->load->view("login_navbar");
	}
	
	public function lims_login(){
		$this->load->view('lims_login_v');
	}
	
	public function authenticate(){
		$username = $_POST['username'];
		$password = $_POST['password'];
				
	 	if ($this->aauth->login($username, $password)){
            echo 'Logged in';
        }else{
            echo 'Invalid username password combination';
		}
	}
}
