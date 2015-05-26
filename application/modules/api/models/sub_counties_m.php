<?php

class sub_counties_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){
		$error = array();
		
		$request_body = file_get_contents('php://input');
		
		$sub_county = json_decode($request_body,true);
		
		$sub_county_table =	R::getAll("SHOW TABLE STATUS WHERE `Name` = 'sub_county'");
		
		$sub_county_ID = $sub_county_table[0][Auto_increment];
		
		$sql = "INSERT INTO `sub_county`
							(
								`id`,
								`name`,
								`county_id`,
								`status`
							)
						VALUES
							(
								'$sub_county_ID',
								'$sub_county[name]',
								'$sub_county[county_id]',
								'$sub_county[status]'
							)";

		
		if(!$this->db->query($sql)){
			$error = array('error' => array('message'=>$this->db->_error_message(),'no'=>$this->db->_error_number() ));
			return $error;
		}

		return $sub_county;
	}

	public function read($id=NULL){
		
		$search = $this->input->get("search");
		$limit_start = $this->input->get("limit_start");
		$limit_items = $this->input->get("limit_items");

		$sub_couties_res = R::getAll("CALL proc_api_get_sub_counties('$id','$search','$limit_start','$limit_items')");
		
		return $sub_couties_res;	
	}

	public function update($id){
		
		$request_fields = file_get_contents('php://input');

		$sub_county = json_decode($request_fields, true);

		$sub_county_updated = R::getAll("UPDATE `sub_county` 
								SET 
									`name`='$sub_county[name]',
									`status`='$sub_county[status]'
								WHERE 
									`id` = '$id'
								");

		return $sub_county_updated;
	}

	public function remove($id){
		// $request_sub_county = file_get_contents('php://input');
		// $sub_county = json_decode($request_sub_county, true);
		
		$sub_county_deleted = R::getAll("DELETE FROM 
												 `sub_county`
											WHERE 
												`id` = '$id'
											");
		
		return $sub_county_deleted;
	}

}