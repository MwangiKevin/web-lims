<?php

class fcdrrs_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id=null){		

		$fcdrr = array();

		$facility = (int) $this->input->get("facility");
		$year = (int) $this->input->get("year");
		$month = (int) $this->input->get("month");


		$fcdrr_res = R::getAll("CALL `proc_get_fcdrrs`('$id','$facility','$year','$month')");
		
		if($id==NULL){

			$fcdrr = $fcdrr_res;

			foreach ($fcdrr as $key => $value) {
				$fcdrr_commodities = R::getAll("CALL `proc_get_fcdrr_commodities`('','".$value['fcdrr_id']."')");
				$fcdrr[$key]['commodities'] = $fcdrr_commodities;
			}	

		}else{

			$fcdrr = $fcdrr_res[0];	

			$fcdrr_commodities = R::getAll("CALL `proc_get_fcdrr_commodities`('','".$fcdrr['fcdrr_id']."')");
			$fcdrr['commodities'] = $fcdrr_commodities;
		}

		return $fcdrr;

	}

	public function update($id){

	}

	public function remove($id){

	}

}