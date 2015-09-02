<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class reports extends MY_Controller {	

	function __construct() {

		parent::__construct();
		
		// header('Content-Type: application/json; charset=utf-8');
	}

	public function subscribe($user_id=0,$report_id=0) {

		$perm = false;

		$res = R::getAll("SELECT `report_name` FROM  `report_user_subscription` `rus` LEFT JOIN `report_type` `rt` ON `rt`.id = `rus`.`report_type_id`  WHERE `rt`.`id`  = '$report_id' AND `rus`.`aauth_user_id` = '$user_id'");

		// print_r($res);
		// echo sizeof($res);
		// die;
		
		if($this->aauth->is_admin() || $this->is_current_user()){
			$perm = true;
		}

		if(sizeof($res)> 0 && $perm){
			http_response_code(208);
		}else if($user_id!=0 && $report_id!=0){

			$data = array(
				'aauth_user_id' => $user_id,
				'report_type_id' => $report_id
			);

			if ( $this->db->insert('report_user_subscription', $data )){

				http_response_code(201);
			}
		}
	}

	public function unsubscribe($user_id=0,$report_id=0) {

		$perm = false;

		if($this->aauth->is_admin() || $this->is_current_user()){
			$perm = true;
		}

		if($perm){
			// $this->db->flush_cache();
			$this->db->where('report_type_id', $report_id);
			$this->db->where('aauth_user_id', $user_id);
			$this->db->delete('report_user_subscription');
			http_response_code(201);
		}else{

			http_response_code(500);
		}

	}
}