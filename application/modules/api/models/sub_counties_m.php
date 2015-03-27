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

		$sub_couties_res = R::getAll("CALL proc_get_sub_county_details('$id')");
		
		return $sub_couties_res;	
	}

	public function update($id){
		// parse_str(file_get_contents('php://input'), $_PUT);
		$request_fields = file_get_contents('php://input');

		$sub_county = json_decode($request_fields, true);

		$sub_county_updated = R::getAll("UPDATE `sub_county` 
								SET 
									`name`='',
									`name`='',
									`name`='$name'
								WHERE 
									`id` = '$id'
								");
		return $sub_county_updated;
	}

	public function remove($id){

	}

}