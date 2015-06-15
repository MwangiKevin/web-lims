<?php

class facilities_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){
		$error = array();
		
		$request_body = file_get_contents('php://input');
		
		$facility = json_decode($request_body,true);
		
		$facility_table =	R::getAll("SHOW TABLE STATUS WHERE `Name` = 'facility'");
		
		$facility_ID = $facility_table[0][Auto_increment];
		
		$sql = "INSERT INTO `facility`
							(
							`id`,
							`name`,
							`mfl_code`,
							`site_prefix`,
							`sub_county_id`,
							`partner_id`,
							`facility_type_id`,
							`level`,
							`central_site_id`,
							`email`,
							`phone`,
							`rollout_status`
							)
						VALUES
							(
							'$facility_ID',
							'$facility[name]',
							'$facility[mfl_code]',
							'$facility[site_prefix]',
							'$facility[sub_county_id]',
							'$facility[partner_id]',
							'$facility[facility_type_id]',
							'$facility[level]',
							'$facility[central_site_id]',
							'$facility[email]',
							'$facility[phone]',
							'$facility[rollout_status]'
							)";
		

		if(!$this->db->query($sql)){
			$error = array('error' => array('message'=>$this->db->_error_message(),'no'=>$this->db->_error_number() ));
			return $error;
		}

		return $facility;
	}

	public function read($id=NULL){

		$facilities = array();

		$verbose = $this->input->get('verbose');

		$is_datatable = $this->input->get("datatable");

		$search = $this->input->get("search");
		$order = $this->input->get("order");
		$limit_start = $this->input->get("limit_start");
		$limit_items = $this->input->get("limit_items");
		$draw;


		$total_records = 0;
		$records_filtered = 0;

		if($is_datatable){
			$search = $search['value'];

			$columns = $this->input->get("columns");

			$order_col_index = $order[0]['column'];
			$order_col = $columns[$order_col_index]['data'];
			$order_dir = $order[0]['dir'];


			$limit_start = $this->input->get("start");
			$limit_items = $this->input->get("length");
			$draw = $this->input->get("draw");

			$total_records 		= 	(int)	R::getAll("CALL `proc_api_get_facilities`('$id','','$order_col','$order_dir','','','true')")[0]['count'];
			$records_filtered 	=	(int) 	R::getAll("CALL `proc_api_get_facilities`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','true')")[0]['count'];
		}


		$facilities_res = R::getAll("CALL `proc_api_get_facilities`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','false')");
		
		if($id==NULL){

			$facilities =  $facilities_res;	

			if($verbose=='true'){

				foreach ($facilities as $key => $value) {
					$facility_devices = R::getAll("CALL `proc_get_api_facility_devices`('','".$value['facility_id']."')");
					$facilities[$key]['devices'] = $facility_devices;
				}	

			}

		}else{

			$facilities =  $facilities_res[0];	
			if(sizeof($facilities)>0){
				$facility_devices = R::getAll("CALL `proc_get_api_facility_devices`('','".$facilities['facility_id']."')");
				$facilities['devices'] = $facility_devices;
			}
		}


		if($is_datatable){

			$facilities = $this->arr_to_dt_response($facilities,$draw,$total_records,$records_filtered);


		}else{
		}

		return $facilities;
	}

	public function update($id){
		
		$request_fields = file_get_contents('php://input');

		$facility = json_decode($request_fields, true);

		$facility_updated = R::getAll("UPDATE `facility` 
								SET 
									`name`='$facility[name]',
									`mfl_code`='$facility[mfl_code]',
									`site_prefix`='$facility[site_prefix]',
									`facility_type_id`='$facility[facility_type_id]',
									`level`='$facility[level]',
									`central_site_id`='$facility[central_site_id]',
									`email`='$facility[email]',
									`phone`='$facility[phone]',
									`rollout_status`='$facility[rollout_status]'
								WHERE 
									`id` = '$id'
								");

		return $facility_updated;
	}

	public function remove($id){
		$request_fac = file_get_contents('php://input');

		$facility = json_decode($request_fac, true);
		
		$facility_deleted = R::getAll("UPDATE `facility` 
											SET 
												`status`='$facility[status]'
											WHERE 
												`id` = '$id'
											");
		
		return $facility_deleted;
	}

}