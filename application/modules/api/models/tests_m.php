<?php

class tests_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function read($id=NULL){

		$tests = array();

		$is_datatable = $this->input->get("datatable");

		$search = $this->input->get("search");
		$limit_start = $this->input->get("limit_start");
		$limit_items = $this->input->get("limit_items");
		$draw;


		$total_records = 0;
		$records_filtered = 0;

		if($is_datatable){
			$search = $search['value'];			
			$limit_start = $this->input->get("start");
			$limit_items = $this->input->get("length");
			$draw = $this->input->get("draw");

			$total_records 		= 	(int)	R::getAll("CALL `proc_api_get_tests`('$id','','','','true')")[0]['count'];
			$records_filtered 	=	(int) 	R::getAll("CALL `proc_api_get_tests`('$id','$search','$limit_start','$limit_items','true')")[0]['count'];
		}

		$tests_res = R::getAll("CALL `proc_api_get_tests`('$id','$search','$limit_start','$limit_items','false')");

		if($is_datatable){

			$tests = $this->arr_to_dt_response($tests_res,$draw,$total_records,$records_filtered);


		}else{
			$tests = $tests_res ;
		}

		return $tests;
	}

	

}