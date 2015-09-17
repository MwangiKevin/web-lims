<?php

class dashboard_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}		
	
	public function get_cd4_devices_pie($entity_type,$entity_id){
		$sql = "CALL proc_sql_eq()";
		$sql1 = "CALL proc_get_facility_devices_agg('".$entity_type."','".$entity_id."')";
		
		$equipment = R::getAll($sql);
		$equipment_r = R::getAll($sql1);
		
		$dat = array();

		foreach ($equipment as $key => $value) {
			$dat[$key]["name"]		=$value["equipment"];
			$dat[$key]["y"]			=0;
			$dat[$key]["sliced"]	=false;
			$dat[$key]["selected"]	=false;
			foreach ($equipment_r as $value1) {
				if($value["equipment"]==$value1["equipment"]){	
					$dat[$key]["y"]			= 	(int) $value1["count"];
				}
			}

			if($key==0){				
				$dat[$key]["sliced"]	=true;
				$dat[$key]["selected"]	=true;
			}
		}

		return $dat;	
	}
	
	public function get_devices_table($entity_type,$entity_id){
		$sql = "CALL proc_sql_eq()";
		$sql1 = "CALL proc_get_facility_devices_agg('".$entity_type."','".$entity_id."')";
				
		$equipment = R::getAll($sql);
		$fac_eq = R::getAll($sql1);
		
		$eq_data 	=	array();

		foreach ($equipment as $key => $value) {
			$value['total'] 		=	0;
			$value['functional'] 	=	0;
			$value['broken_down'] 	=	0;
			$value['obsolete'] 		=	0;

			foreach ($fac_eq as $value1) {
				if($value["id"]==$value1["equipment_id"]){					
					$value['total'] 		=	$value1['total'] 	;
					$value['functional'] 	=	$value1['functional'] ;
					$value['broken_down'] 	=	$value1['broken_down'] ;
					$value['obsolete'] 		=	$value1['obsolete'] 	;
				}
			}

			$eq_data[$key] =	$value;
		}
		// print_r($eq_data);die;
		return $eq_data;		
	}
	
	public function get_devices_tests_pie($from,$to,$user_group_id,$user_filter_used){
		$sql_eq = "CALL proc_sql_eq()";
		$sql = "CALL proc_device_test_data('".$from."','".$to."','".$user_group_id."','".$user_filter_used."')";
		$equipment 			= R::getAll($sql_eq);
		$equip_tst =	R::getAll($sql);
		// echo "<pre> $equip_tst<br/>";
		// print_r($equip_tst);
		// echo "<pre> $equipment<br/>";
		// print_r($equipment);
		// die;
		
		
		$data=array();

		foreach ($equipment as $key => $value) {
			$row['name'] 			=	$value["equipment"];
			$row['y'] 			=	0;
			$row['sliced'] 		=	false;
			$row['selected'] 		=	false;

			foreach ($equip_tst as $value1) {
				if($value["equipment"]==$value1["equipment_name"]){					
					$row['y'] 		=	(int) $value1['count'] 	;
				}
			}

			if($key==0){				
				$data[$key]["sliced"]	=true;
				$data[$key]["selected"]	=true;
			}
			
			$data[$key] =	$row;
		}		
		return $data;
	}
	
	public function get_devices_tests_table($start_date,$end_date,$entity_type,$entity_id){
		$sql_eq = "CALL proc_sql_eq()";
		$sql = "CALL proc_device_test_data('".$start_date."','".$end_date."','".$entity_type."','".$entity_id."')";	
		
		$equipment = R::getAll($sql_eq);
		$equip_tst = R::getAll($sql);				
		$data = array();

		foreach ($equipment as $key => $value) {
			$value['equipment'] 			=	$value["equipment"];
			$value['count'] 				=	0;
			$value['valid'] 				=	0;
			$value['errors'] 				=	0;
	

			foreach ($equip_tst as $value1) {
				if($value["equipment"]==$value1["equipment_name"]){			
					$value['equipment'] 			=	$value1['equipment_name'] ;
					$value['count'] 				=	$value1['count'] 	;
					$value['valid'] 				=	$value1['valid'] 	;
					$value['errors'] 				=	$value1['errors'] 	;
				}
			}

			$data[$key] =	$value;
		}		
				
		return $data;			
	}
	
	public function get_expected_reporting_devices($entity_type,$entity_id,$start_date,$end_date){

		// echo $start_date.' --'.$end_date;
		$data["categories"] 	= 	$this->get_yearmonth_categories_wordly($start_date,$end_date);	
		$data["series"][0]["name"] 	= 	"Expected Reporting Devices";
		$data["series"][0]["color"] 	= 	"#2E64FE";
		$data["series"][0]["data"] 	= 	$this->expected_reporting_dev_array($entity_type,$entity_id,$start_date,$end_date);
		$data["series"][1]["name"] 	= 	"Reported Devices";
		$data["series"][1]["color"] 	= 	"#a4d53a";
		$data["series"][1]["data"] 	= 	$this->reported_devices($entity_type, $entity_id,$start_date,$end_date);
		
		return $data;
	}
	
	private function expected_reporting_dev_array($user_group_id,$user_filter_used,$start_date,$end_date){

		$sql_added = "CALL proc_expected_reporting_dev_array_added(".$user_group_id.", ".$user_filter_used.")";

		$sql_removed = "CALL proc_expected_reporting_dev_array_removed(".$user_group_id.", ".$user_filter_used.")";
		
		$devices_added_assoc 	=	R::getAll($sql_added);
		$devices_removed_assoc 	=	R::getAll($sql_removed);

		$start_year 		= (int) Date( 'Y',strtotime($start_date));
		$end_year 			= (int) Date( 'Y',strtotime($end_date));
		$start_month 		= (int) Date( 'm',strtotime($start_date));
		$end_month 			= (int) Date( 'm',strtotime($end_date));

		$added_arr = array();
		$removed_arr = array();
		$consolidated_arr = array();

		//initializing

		for ($y=$start_year; $y <= $end_year ; $y++) { 
			
			for ($m=1; $m <= 12 ; $m++) { 

				if(($end_year == $start_year) && ($m>=$start_month)&&($m<=$end_month)){
					$added_arr[$y.'-'.$m] = 0;
					$removed_arr[$y.'-'.$m] = 0;				
					
				}else if(($end_year != $start_year)&&($start_year == $y) && ($m>=$start_month)){
					$added_arr[$y.'-'.$m] = 0;
					$removed_arr[$y.'-'.$m] = 0; 	
					
				}else if(($end_year != $start_year)&&($end_year == $y) && ($m<=$end_month)){
					$added_arr[$y.'-'.$m] = 0;
					$removed_arr[$y.'-'.$m] = 0; 	
					
				}else if(($end_year != $y)&&($start_year != $y)){
					$added_arr[$y.'-'.$m] = 0;
					$removed_arr[$y.'-'.$m] = 0;						
				}
				
			}
		}

		$added_placeholder = 0;
		foreach ($added_arr as $key => $value) {
			foreach ($devices_added_assoc as $key1 => $value1) {
				if($key == $value1['yearmonth']){
					$added_placeholder = (int) $value1['cumulative'] ;
				}				
			}			
			$added_arr[$key] = $added_placeholder;
		}

		$removed_placeholder = 0;
		foreach ($removed_arr as $key => $value) {
			foreach ($devices_removed_assoc as $key1 => $value1) {
				if($key == $value1['yearmonth']){
					$removed_placeholder = (int) $value1['cumulative'] ;
				}				
			}			
			$removed_arr[$key] = $removed_placeholder;
		}


		foreach ($added_arr as $key => $value) {

			$consolidated_arr[]= $value - $removed_arr[$key];
			
		}
		// print_r($consolidated_arr);

		return $consolidated_arr;
	}

	private function reported_devices($user_group_id,$user_filter_used, $start_date,$end_date){
		
		$sql = "CALL proc_reported_devices(".$user_group_id.",".$user_filter_used.",'".$start_date."','".$end_date."')";
		$reported_assoc = R::getAll($sql);
		$reported_array = array(); 

		$result = array(); 

		$start_year 		= (int) Date( 'Y',strtotime($start_date));
		$end_year 			= (int) Date( 'Y',strtotime($end_date));
		$start_month 		= (int) Date( 'm',strtotime($start_date));
		$end_month 			= (int) Date( 'm',strtotime($end_date));

		//initializing

		for ($y=$start_year; $y <= $end_year ; $y++) { 
			
			for ($m=1; $m <= 12 ; $m++) { 

				if(($end_year == $start_year) && ($m>=$start_month)&&($m<=$end_month)){
					$reported_array[$y.'-'.$m] = 0;				
					
				}else if(($end_year != $start_year)&&($start_year == $y) && ($m>=$start_month)){
					$reported_array[$y.'-'.$m] = 0; 	
					
				}else if(($end_year != $start_year)&&($end_year == $y) && ($m<=$end_month)){
					$reported_array[$y.'-'.$m] = 0; 	
					
				}else if(($end_year != $y)&&($start_year != $y)){
					$reported_array[$y.'-'.$m] = 0;						
				}
				
			}
		}

		$reported_placeholder = 0;
		foreach ($reported_array as $key => $value) {
			foreach ($reported_assoc as $key1 => $value1) {
				if($key == $value1['yearmonth']){
					$reported_placeholder = (int) $value1['count'] ;
				}				
			}			
			$reported_array[$key] = $reported_placeholder;	
			$reported_placeholder = 0;
		}

		foreach ($reported_array as $key => $value) {
			$result[]=$value;
		}
		return $result;
	}
	
	public function get_cd4_devices_perCounty(){
		$sql = "CALL proc_get_devices_per_county()";
		$response = R::getAll($sql);
		
		foreach ($response as $key => $value) {
			
			$response[$key]['no_per_county'] = (int) $response[$key]['no_per_county'];
			
		}
		return $response;	
	}
	
	
	
	
	
}