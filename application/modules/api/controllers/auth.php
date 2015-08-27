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

	public function get_user_groups($id=NULL){
		echo json_encode($this->aauth->get_user_groups($id));			
	}

	public function list_groups($id=NULL){
		$groups = $this->aauth->list_groups($id);

		foreach ($groups as $key => $value) {
			$groups[$key]->group_id = $value->id;
		}

		echo json_encode($groups);			
	}

	public function set_password(){

		$request_body = file_get_contents('php://input');		
		$user = json_decode($request_body,true);

		$id = $user['id'];
		$password = $user['password'];

		if($this->aauth->is_admin()){

			return $this->aauth->set_password($id,$password);

		}		
	}

	public function reset_password(){

		$request_body = file_get_contents('php://input');		
		$user = json_decode($request_body,true);


		$id = (int) $user['id'];
		$ver_code = $user['ver_code'];

		if($id<=0){$id=null;}

		return $this->aauth->reset_password($id,$ver_code);

		
	}

	public function remind_password(){

		$this->aauth->remind_password("mwangikevinn@gmail.com");

	}
}