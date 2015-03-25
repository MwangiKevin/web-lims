<?php

class fcdrrs_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

		$request_body = file_get_contents('php://input');

		$fcdrr = json_decode($request_body,true);

		$this->db->trans_begin();

		$fcdrr_st			=	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'fcdrr'"	);

		$fcdrr_auto_id 		=	 $fcdrr['fcdrr_id'] =(int)	$fcdrr_st[0]["Auto_increment"];

		$facility_id			= 	(int) $fcdrr['facility']['facility_id'];

		$from_date		 = 			$fcdrr['from_date']		= 	Date('Y-m-d', strtotime($fcdrr['year'].'-'.$fcdrr['month'].'-1'));
		$to_date		 = 			$fcdrr['to_date']		= 	Date('Y-m-t', strtotime($fcdrr['year'].'-'.$fcdrr['month'].'-1'));

		$year					= 	Date('Y', strtotime($fcdrr['year'].'-'.$fcdrr['month'].'-1'));
		$month					= 	Date('m', strtotime($fcdrr['year'].'-'.$fcdrr['month'].'-1'));

		$calibur_tests_adults	= 	(int) $fcdrr['calibur_tests_adults'];
		$calibur_tests_pead		= 	(int) $fcdrr['calibur_tests_pead'];
		$count_tests_adults		= 	(int) $fcdrr['count_tests_adults'];
		$count_tests_pead		= 	(int) $fcdrr['count_tests_pead'];
		$cyflow_tests_adults 	= 	(int) $fcdrr['cyflow_tests_adults'];
		$cyflow_tests_pead		= 	(int) $fcdrr['cyflow_tests_pead'];
		$adults_bel_cl			= 	(int) $fcdrr['adults_bel_cl'];
		$pead_bel_cl			= 	(int) $fcdrr['pead_bel_cl'];

		$comments				= 	$fcdrr['comments'];

		$commodities 			= 	$fcdrr['displayed_commodities'];

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
				`count_tests_adults`, 
				`count_tests_pead`, 
				`cyflow_tests_adults`, 
				`cyflow_tests_pead`, 
				`pima_tests`, 
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
				'$count_tests_adults', 
				'$count_tests_pead', 
				'$cyflow_tests_adults', 
				'$cyflow_tests_pead', 
				'$pima_tests', 
				'$adults_bel_cl', 
				'$pead_bel_cl', 
				'$comments'

			);";

			$this->db->query($sql);
		foreach ($commodities as $key => $value) {

			$comm_sql = "INSERT INTO `fcdrr_commodity`
			(
				`fcdrr_id`, 
				`beginning_bal`, 
				`received_qty`, 
				`lot_code`, 
				`qty_used`, 
				`losses`, 
				`adjustment_plus`, 
				`adjustment_minus`, 
				`end_bal`, 
				`requested`, 
				`commodity_id`
			)
			VALUES(

				'".$fcdrr_auto_id."',
				'".$value['beginning_bal']."',
				'".$value['received_qty']."',
				'".$value['lot_code']."',
				'".$value['qty_used']."',
				'".$value['losses']."',
				'".$value['adjustment_plus']."',
				'".$value['adjustment_minus']."',
				'".$value['end_bal']."',
				'".$value['requested']."',
				'".$key."'
			)
			";

			$this->db->query($comm_sql);
		}

		if ($this->db->trans_status() === FALSE ){
			$this->db->trans_rollback();
			$fcdrr = array('error' => 'fcdrr save failed');
		}
		else{
			$this->db->trans_commit();
		}	

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