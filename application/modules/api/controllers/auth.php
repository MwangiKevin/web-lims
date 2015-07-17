<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class auth extends MY_Controller {	
	function __construct() {

		parent::__construct();		
		header('Content-Type: application/json; charset=utf-8');
	}

	public function login(){


		$this->load->library("Aauth");	

		$username = $this->input->post('username');
		$password = $this->input->post('password');


		if ($this->aauth->login($username, $password)){
			$details =	array(
				'username' 		=>	$username,
				'login_status' 	=>	true,
				'user'			=>	$this->aauth->get_user(),
			);
			$user  = (array) $this->aauth->get_user();
			$user_id = (int) $user['id'];
			$this->load->model('users_m');
			$this->session->set_userdata("user", $this->users_m->read($user_id));

			echo json_encode($details);

		}else{			
			http_response_code(401);
			$details =	array(
				'username' 	=>	$username,
				'login_status' 	=>	false,
				'user'			=>	$this->aauth->get_user(),
				);

			$user = array(
					"filter_type" => -1,
					"filter_id"=>-1
				);
			$this->session->set_userdata("user", $user);

			echo json_encode($details);
		}
	}

	public function logout(){

		$this->load->library("Aauth");	
		$this->aauth->logout();
	}

	public function get_session_details (){

		echo json_encode($this->session->all_userdata());		

	}

	public function is_logged_in(){		
	
		if(!$this->session->userdata('loggedin')){
			http_response_code(401);
			$this->output->set_content_type('application/json')->set_output('false');
		}else{

			$this->output->set_content_type('application/json')->set_output('true');
		}

	}

	public function get_user_var($id=null){
			echo json_encode($this->aauth->get_user_var("linked_entity_id",$id));
	}
	public function get_currentuser(){
			echo json_encode($this->aauth->get_user($id));
			
	}
	public function get_filter_type(){
		
		echo (int) $filter_type;
			
	}
	public function get_filter_id(){
		echo (int) $filter_id;
			
	}

}