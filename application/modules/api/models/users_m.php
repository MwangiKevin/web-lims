<?php

class users_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){
		
	}

	public function read($id=NULL){

		$users = array();

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

			// $total_records 		= 	(int)	R::getAll("CALL `proc_api_get_users`('$id','','$order_col','$order_dir','','','true')")[0]['count'];
			// $records_filtered 	=	(int) 	R::getAll("CALL `proc_api_get_users`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','true')")[0]['count'];
			
			$total_records		=	(int) $this->api_get_users($id,NULL,$order_col,$order_dir,NULL,NULL,'true')[0]['count'];
			$records_filtered	=	(int) $this->api_get_users($id,NULL,$order_col,$order_dir,$limit_start,$limit_items,'true')[0]['count'];
		}

		$search = addslashes($search);


		// $counties_res = R::getAll("CALL proc_api_get_users('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','false')");

		$counties_res = $this->api_get_users($id,$search,$order_col,$order_dir,$limit_start,$limit_items,'false');

		if($id==NULL){

			$users =  $counties_res;	

		}else{

			$users =  $counties_res[0];	
		}

		if($is_datatable && $id==NULL){

			$users = $this->arr_to_dt_response($users,$draw,$total_records,$records_filtered);

		}

		return $users;
	}

	public function update($id=NULL){
		
		$request_fields = file_get_contents('php://input');

		$facility = json_decode($request_fields, true);

		$facility_updated = "UPDATE `facility` 
										SET 
											`name`='$facility[facility_name]',
											`mfl_code`='$facility[facility_mfl_code]',
											`site_prefix`='$facility[facility_site_prefix]',
											`sub_county_id`='$facility[facility_sub_county_id]',
											`facility_type_id`='$facility[facility_type_id]',
											`level`='$facility[facility_level]',
											`central_site_id`='$facility[central_site_id]',
											`email`='$facility[facility_email]',
											`phone`='$facility[facility_phone]',
											`partner_id`='$facility[partner_id]',
											`rollout_status`='$facility[facility_rollout_status]'
										WHERE 
											`id` = '$id'";
		echo $facility_updated;

		//return $facility_updated;
	}

	public function remove($id){
	}

}