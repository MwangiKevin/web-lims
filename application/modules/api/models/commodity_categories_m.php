<?php

class commodity_categories_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){
		$error = array();
		
		$request_body = file_get_contents('php://input');
		
		$commodity_category = json_decode($request_body,true);
		
		$commodity_cat_table =	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'commodity_category'"	);
		
		$commodity_cat_ID = $commodity_cat_table[0][Auto_increment];
		
		$sql = "INSERT INTO `commodity_category`
							(
							`id`,
							`name`,
							`equipment_id`
							)
						VALUES
							(
							'$commodity_cat_ID',
							'$commodity_category[name]',
							'$commodity_category[equipment_id]'
							)";

		if(!$this->db->query($sql)){
			$error = array('error' => array('message'=>$this->db->_error_message(),'no'=>$this->db->_error_number() ));
			return $error;
		}
		return $commodity_category;
	}

	public function read($id=NULL){

		$categories_res = R::getAll("CALL `proc_get_commodity_categories`('$id')");

		if($id==NULL){

			return $categories_res;	

		}else{

			return $categories_res[0];	
		}

	}

	public function update($id){
		
		$request_fields = file_get_contents('php://input');

		$commodity_cat = json_decode($request_fields, true);
		
		$commodity_cat_updated = R::getAll("UPDATE `commodity_category` 
											SET 
												`name`='$commodity_cat[name]',
												`equipment_id`='$commodity_cat[equipment_id]'
											WHERE 
												`id` = '$id'
								");
		return $commodity_cat_updated;
	}

	public function remove($id){
		
		$request_comm_cat = file_get_contents('php://input');

		$commodity_cat = json_decode($request_comm_cat, true);
		
		$commodity_cat_deleted = R::getAll("UPDATE `commodity_category` 
											SET 
												`status`='$commodity_cat[status]'
											WHERE 
												`id` = '$id'
											");
		
		return $commodity_cat_deleted;
	}

}