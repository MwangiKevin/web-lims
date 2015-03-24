<?php

class fcdrrs_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

		$request_body = file_get_contents('php://input');

		$fcdrr = json_decode($request_body,true);
		// print_r($fcdrr);


		// $this->db->trans_begin();

		$fcdrr_st			=	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'fcdrr'"	);

		$fcdrr_auto_id 		=	(int)	$fcdrr_st[0]["Auto_increment"];

		$facility_id			= 	(int) $fcdrr['head_info']['selected']['facility']['facility_id'];
		$from_date				= 	Date('Y-m-d', strtotime($fcdrr['head_info']['selected']['dates']['year'].'-'.$fcdrr['head_info']['selected']['dates']['month'].'-1'));
		$to_date				= 	Date('Y-m-d', strtotime($fcdrr['head_info']['selected']['dates']['year'].'-'.$fcdrr['head_info']['selected']['dates']['month'].'-t'));
		$calibur_tests_adults	= 	$fcdrr['head_info']['devicetests'];
		$calibur_tests_pead		= 	$fcdrr['head_info']['devicetests'];
		$caliburs 				= 	$fcdrr['head_info']['devicetests'];
		$count_tests_adults		= 	$fcdrr['head_info']['devicetests'];
		$count_tests_pead		= 	$fcdrr['head_info']['devicetests'];
		$counts 				= 	$fcdrr['head_info']['devicetests'];
		$cyflow_tests_adults 	= 	$fcdrr['head_info']['devicetests'];
		$cyflow_tests_pead		= 	$fcdrr['head_info']['devicetests'];
		$cyflows 				= 	$fcdrr['head_info']['devicetests'];
		$adults_bel_cl			= 	$fcdrr['head_info']['devicetests'];
		$pead_bel_cl			= 	$fcdrr['head_info']['devicetests'];
		$comments				= 	$fcdrr['footer_info']['comments'];

		$commodities 			= 	$fcdrr['head_info']['devicetests'];

		$sql = "INSERT INTO `fcdrr` 
			(
				`id`, 
				`facility_id`, 
				`from_date`, 
				`to_date`, 
				`year`, 
				`month`, 
				`calibur_tests_adults`, 
				`calibur_tests_pead`, 
				`caliburs`, 
				`count_tests_adults`, 
				`count_tests_pead`, 
				`counts`, 
				`cyflow_tests_adults`, 
				`cyflow_tests_pead`, 
				`cyflows`, 
				`adults_bel_cl`, 
				`pead_bel_cl`, 
				`comments`
			) 
			VALUES
			(
				'$fcdrr_auto_id', 
				'$facility_id', 
				'$from_date', 
				'$to_date', 
				'$year', 
				'$month', 
				'$calibur_tests_adults', 
				'$calibur_tests_pead', 
				'$caliburs', 
				'$count_tests_adults', 
				'$count_tests_pead', 
				'$counts', 
				'$cyflow_tests_adults', 
				'$cyflow_tests_pead', 
				'$cyflows', 
				'$adults_bel_cl', 
				'$pead_bel_cl', 
				'$comments'
				);";


		return $fcdrr;

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