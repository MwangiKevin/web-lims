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

		$verbose = $this->input->get('verbose');

		$is_datatable = $this->input->get("datatable");

		$search = $this->input->get("search");
		$order = $this->input->get("order");
		$limit_start = $this->input->get("limit_start");
		$limit_items = $this->input->get("limit_items");
		
		$draw;$order_col;$order_dir;


		$total_records = 0;
		$records_filtered = 0;

		if($is_datatable){
			$search = $search['value'];
			$search = addslashes($search);

			$columns = $this->input->get("columns");

			$order_col_index = $order[0]['column'];
			$order_col = $columns[$order_col_index]['data'];
			$order_dir = $order[0]['dir'];


			$limit_start = $this->input->get("start");
			$limit_items = $this->input->get("length");
			$draw = $this->input->get("draw");

			$total_records 		= 	(int)	R::getAll("CALL `proc_api_get_partners`('$id','','$order_col','$order_dir','','','true')")[0]['count'];
			$records_filtered 	=	(int) 	R::getAll("CALL `proc_api_get_partners`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','true')")[0]['count'];
		}

		$search = addslashes($search);
		
		$partners_res = R::getAll("CALL `proc_api_get_partners`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','false')");
		
		if($id==NULL){

			$partners =  $partners_res;	

		}else{

			$partners =  $partners_res[0];
		}

		if($is_datatable){

			$partners = $this->arr_to_dt_response($partners,$draw,$total_records,$records_filtered);

		}else{
		}

		
		return $partners;	
		
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