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
		$counties = array();

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

			$total_records 		= 	(int)	R::getAll("CALL `proc_api_get_counties`('$id','','$order_col','$order_dir','','','true')")[0]['count'];
			$records_filtered 	=	(int) 	R::getAll("CALL `proc_api_get_counties`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','true')")[0]['count'];
		}

		$search = addslashes($search);


		$counties_res = R::getAll("CALL proc_api_get_counties('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','false')");

		if($id==NULL){

			$counties =  $counties_res;	

		}else{

			$counties =  $counties_res[0];	
		}

		if($is_datatable && $id==NULL){

			$counties = $this->arr_to_dt_response($counties,$draw,$total_records,$records_filtered);

		}

		return $counties;
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