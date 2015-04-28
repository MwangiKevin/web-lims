<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class registration extends MY_Controller {	
	function __construct() {

		parent::__construct();
		
		header('Content-Type: application/json; charset=utf-8');
		$this->load->library("Aauth");		
	}

	function submit(){
		
	}
}