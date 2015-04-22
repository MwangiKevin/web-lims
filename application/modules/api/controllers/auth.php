<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class auth extends MY_Controller {	
	function __construct() {

		parent::__construct();
		
		header('Content-Type: application/json; charset=utf-8');
		$this->load->library("Aauth");		
	}

	function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// show_error("432",401);

		// $this->aauth->create_user('kevin@gmail.com','kevin','kevin1');

		if ($this->aauth->login($username, $password)){
			$details =	array(
				'username' 		=>	$username,
				'login_status' 	=>	'true',
				'user'			=>	$this->aauth->get_user(),

				);

			echo json_encode($details);

		}else{
			
			http_response_code(401);
			$details =	array(
				'username' 	=>	$username,
				'login_status' 	=>	'false',
				);

			echo json_encode($details);
		}
	}

	function logout(){
		$this->aauth->login();
	}

}