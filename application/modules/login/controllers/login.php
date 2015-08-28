<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class login extends MY_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->library("Aauth");		
	}	
	public function logout(){
		$this->load->view('logout_v');
	}
}