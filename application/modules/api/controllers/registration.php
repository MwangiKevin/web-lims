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
		$request_body = file_get_contents('php://input');
		
		$new_user = json_decode($request_body,true)['params'];

		if($this->aauth->create_user($new_user['email'],$new_user['password'],$new_user['email'].' '.$new_user['email'])){
			echo "user Created";
		}else{
			http_response_code(500);
			echo "failed to create user";
		}
	}
}