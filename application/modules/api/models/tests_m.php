<?php

class tests_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function read($id=NULL){

		$tests = array();
		
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
			$order_col = $order[0]['column'];
			$order_dir = $order[0]['dir'];
			$limit_start = $this->input->get("start");
			$limit_items = $this->input->get("length");
			$draw = $this->input->get("draw");

			$total_records 		= 	(int)	R::getAll("CALL `proc_api_get_tests`('$id','','$order_col','$order_dir','','','true')")[0]['count'];
			$records_filtered 	=	(int) 	R::getAll("CALL `proc_api_get_tests`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','true')")[0]['count'];
		}

		$tests_res = R::getAll("CALL `proc_api_get_tests`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','false')");

		if($is_datatable){

			$tests = $this->arr_to_dt_response($tests_res,$draw,$total_records,$records_filtered);


		}else{
			$tests = $tests_res ;
		}

		return $tests;
	}

	

}