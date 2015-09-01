<?php

class report_types_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){
		$error = array();
		
		$request_body = file_get_contents('php://input');
		
		$report_type = json_decode($request_body,true);
		
		$rpt_table =	R::getAll("SHOW TABLE STATUS WHERE `Name` = 'report_type'");
		
		$rpt_ID = $rpt_table[0][Auto_increment];
		
		$sql = "INSERT INTO `report_type`
						(
						`id`,
						`report_name`,
						`description`
						)
					VALUES
						(
						'$rpt_ID',
						'$report_type[report_type_name]',
						'$report_type[description]'
						)";
		
		if(!$this->db->query($sql)){
			$error = array('error' => array('message'=>$this->db->_error_message(),'no'=>$this->db->_error_number() ));
			return $error;
		}

		return $report_type;
	}

	public function read($id=NULL){

		$verbose = $this->input->get('verbose');

		$is_datatable = $this->input->get("datatable");

		$search = $this->input->get("search");
		$order = $this->input->get("order");
		$limit_start = $this->input->get("limit_start");
		$limit_items = $this->input->get("limit_items");

		$user_id = (int) $this->input->get("user_id");
		
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

			$total_records 		= 	(int)	R::getAll("CALL `proc_api_get_report_types`('$id','$user_id','','$order_col','$order_dir','','','true')")[0]['count'];
			$records_filtered 	=	(int) 	R::getAll("CALL `proc_api_get_report_types`('$id','$user_id','$search','$order_col','$order_dir','$limit_start','$limit_items','true')")[0]['count'];
		}

		$search = addslashes($search);
		// echo "CALL `proc_api_get_report_types`('$id','$user_id','$search','$order_col','$order_dir','$limit_start','$limit_items','false')";
		$rpt_res = R::getAll("CALL `proc_api_get_report_types`('$id','$user_id','$search','$order_col','$order_dir','$limit_start','$limit_items','false')");
		
		if($id==NULL){

			$rpt =  $rpt_res;	

			if($verbose=='true'){
				
			}

		}else{

			$rpt =  $rpt_res[0];
		}

		if($is_datatable && $id==NULL){

			$rpt = $this->arr_to_dt_response($rpt,$draw,$total_records,$records_filtered);

		}
		
		return $rpt;	
		
	}

	public function update($id){
		
		$request_fields = file_get_contents('php://input');

		$report_type = json_decode($request_fields, true);

		$rpt_updated = R::getAll("UPDATE `report_type` 
								SET 
									`report_name`='$report_type[report_name]',
									`description`='$report_type[description]'
								WHERE 
									`id` = '$id'
								");

		return $rpt_updated;
	}

	public function remove($id){
	}

}