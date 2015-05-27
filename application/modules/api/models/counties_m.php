<?php

class counties_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){
		$error = array();
		
		$request_body = file_get_contents('php://input');
		
		$county = json_decode($request_body,true);
		$county_name = $county['name'];
		
		$county_table =	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'county'"	);
		
		$county_ID = $county_table[0][Auto_increment];
		
		$sql = "INSERT INTO `county`
						(
							`id`,
							`name`
						) 
					VALUES 
					(
						'$county_ID',
						'$county_name'
					)";

		
		if(!$this->db->query($sql)){
			$error = array('error' => array('message'=>$this->db->_error_message(),'no'=>$this->db->_error_number() ));
			return $error;
		}

		return $county;
	}

	public function read($id=NULL){

		$search = $this->input->get("search");
		$limit_start = $this->input->get("limit_start");
		$limit_items = $this->input->get("limit_items");

		$couties_res = R::getAll("CALL proc_api_get_counties('$id','$search','$limit_start','$limit_items')");

		if($id==NULL){

			return $couties_res;	

		}else{

			return $couties_res;	
		}
	}

	public function update($id){
		
		$request_fields = file_get_contents('php://input');

		$county = json_decode($request_fields, true);

		$county_updated = R::getAll("UPDATE `county` SET `name`='$county[name]'	WHERE `id` = '$id'");
		
		return $county_updated;
	}

	public function remove($id){
		// $request_county = file_get_contents('php://input');
		// $county = json_decode($request_county, true);
		
		$county_deleted = R::getAll("DELETE FROM 
												 `county`
											WHERE 
												`id` = '$id'
											");
		
		return $county_deleted;
	}

}