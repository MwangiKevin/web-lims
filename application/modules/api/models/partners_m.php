<?php

class partners_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){
		$error = array();
		
		$request_body = file_get_contents('php://input');
		
		$partner = json_decode($request_body,true);
		
		$partner_table =	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'partner'"	);
		
		$partner_ID = $partner_table[0][Auto_increment];
		
		$sql = "INSERT INTO `partner`
						(
						`id`,
						`name`,
						`phone`,
						`email`
						)
					VALUES
						(
						'$partner_ID',
						'$partner[name]',
						'$partner[phone]',
						'$partner[email]'
						)";
		
		if(!$this->db->query($sql)){
			$error = array('error' => array('message'=>$this->db->_error_message(),'no'=>$this->db->_error_number() ));
			return $error;
		}

		return $partner;
	}

	public function read($id=NULL){
		$sub_couties_res = R::getAll("CALL proc_api_get_partners('$id')");
				
			return $sub_couties_res;	
		
	}

	public function update($id){
		
		$request_fields = file_get_contents('php://input');

		$partner = json_decode($request_fields, true);

		$partner_updated = R::getAll("UPDATE `partner` 
								SET 
									`name`='$partner[name]',
									`phone`='$partner[phone]',
									`email`='$partner[email]'
								WHERE 
									`id` = '$id'
								");

		return $partner_updated;
	}

	public function remove($id){
		// $request_partner = file_get_contents('php://input');

		// $partner = json_decode($request_partner, true);
		
		$partner_deleted = R::getAll("DELETE FROM 
												 `partner`
											WHERE 
												`id` = '$id'
											");
		
		return $partner_deleted;
	}

}