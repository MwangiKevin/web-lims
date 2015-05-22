<?php

class dashboard_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}
	
	public function get_yearmonth_categories($from,$to){
		$datemonth = array();
		
		$from_year        = (int) Date("Y",strtotime($from));
		$from_month       = (int) Date("m",strtotime($from));
		$to_year          = (int) Date("Y",strtotime($to));
		$to_month         = (int) Date("m",strtotime($to));

		for($y=$from_year; $y <= $to_year;$y++){
			for($m=1;($m <= 12);$m++){
				if( $y==$from_year ){
					if($m>=$from_month ){
						$datemonth[] = $y."-".$m;
					}
				}elseif( $y==$to_year ){
					if($m<=$to_month ){
						$datemonth[] = $y."-".$m;
					}
				}else{
					$datemonth[] = $y."-".$m;
				}
			}
		}
		return $datemonth;
	}
	
	public function get_cd4_devices_pie($param1,$param2){
		$sql = "CALL proc_get_equipment()";
		$sql1 = "CALL proc_equipment_pie('".$param1."','".$param2."')";
		
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
	
	public function get_devices_table($user_group_id,$user_filter_id){
		$sql = "CALL proc_get_equipment()";
		$sql1 = "CALL proc_get_facility_devices('".$user_group_id."','".$user_filter_id."')";
				
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
		//print_r($eq_data);
		return $eq_data;		
	}
	
	public function get_devices_tests_pie($from,$to,$user_group_id,$user_filter_used){
		$sql_eq = "CALL proc_get_equipment()";
		$sql = "CALL proc_equipment_tests_pie('".$from."','".$to."','".$user_group_id."','".$user_filter_used."')";
		$equipment 			= R::getAll($sql_eq);
		$equip_tst =	R::getAll($sql);
		
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
	
	public function get_devices_tests_table($from,$to,$user_group_id,$user_filter_used){
		$sql_eq = "CALL proc_get_equipment()";
		$sql = "CALL proc_equipment_test_table('".$from."','".$to."','".$user_group_id."','".$user_filter_used."')";	
		
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
	
	public function get_expected_reporting_devices($user_group_id,$user_filter_used,$year){
		$data["chart"][0]["name"] 	= 	"Expected Reporting Devices";
		$data["chart"][0]["data"] 	= 	$this->expected_reporting_dev_array($user_group_id,$user_filter_used,$year);
		$data["chart"][1]["name"] 	= 	"Reported Devices";
		$data["chart"][1]["color"] 	= 	"#a4d53a";		

	    $data["chart"][1]["data"] 	= 	$this->reported_devices($user_group_id, $user_filter_used,$year);
		foreach ($data as $key => $value) {
			return $value;
		}
	}
	
	private function expected_reporting_dev_array($user_group_id,$user_filter_used,$year){
		//error_reporting(0);
		$sql_added = "CALL proc_expected_reporting_dev_array_added(".$user_group_id.", ".$user_filter_used.")";

		$sql_removed = "CALL proc_expected_reporting_dev_array_removed(".$user_group_id.", ".$user_filter_used.")";


		$devices_added_assoc 	=	R::getAll($sql_added);
		$devices_removed_assoc 	=	R::getAll($sql_removed);		

		$devices_added_array	=	array();	
		$devices_removed_array	=	array();

		$consolidated_array		=	array();

		//initialize
		$current_cummulative_added 		= 0;
		$current_cummulative_removed 	= 0;

		//assisgn $current_cummulative_added and $current_cummulative_removed to last years ending
		//print_r($devices_added_assoc);die();
		//print_r($devices_removed_assoc);die();
		foreach ($devices_added_assoc as $value) {
			$curr_year = (int) Date("Y",strtotime($value["rank_date"]));

			if($curr_year< (int) $year){
				//echo $curr_year."  ".$year."  ".$value["cumulative"]."<br/>" ;				
				$current_cummulative_added 		= (int) $value["cumulative"];
			}
		}
		//echo 	$current_cummulative_added ;


		foreach ($devices_removed_assoc as $value) {
			$curr_year = (int) Date("Y",strtotime($value["rank_date"]));
			if($curr_year< (int) $year){
				//echo $curr_year."  ".$year."  ".$value["cumulative"]."<br/>" ;				
				$current_cummulative_removed 		= (int) $value["cumulative"];
			}
		}
		//echo 	$current_cummulative_removed ;

		//initialize
		$devices_added_array[0]		=	$current_cummulative_added;	
		$devices_removed_array[0]	=	$current_cummulative_removed;

		for($i=0;$i<12;$i++){

			foreach ($devices_added_assoc as $key => $added) {
				if($added['yearmonth']==($year)."-".($i+1)){
					$current_cummulative_added = (int) $added['cumulative'];
				}				
			}
			foreach ($devices_removed_assoc as $key => $removed) {
				if($removed['yearmonth']==($year)."-".($i+1)){
					$current_cummulative_removed = (int) $removed['cumulative'];
				}				
			}

			$devices_added_array[$i] = $current_cummulative_added;
			$devices_removed_array[$i] = $current_cummulative_removed;
			
		}

		for($i=0;$i<12;$i++){
			$consolidated_array[$i] = (int)$devices_added_array[$i] - (int) $devices_removed_array[$i];
		}

		// echo "<pre>";
		// print_r($consolidated_array);
		// echo "</pre>";
		
		// print_r($consolidated_array); die();
		return $consolidated_array;
	}

	private function reported_devices($user_group_id,$user_filter_used, $year){
		
		$sql = "CALL proc_reported_devices(".$user_group_id.",".$user_filter_used.",".$year.")";
		$res = R::getAll($sql);
		// print_r($res);die();
		$reported_array = array(); 
		for($i=0;$i<12;$i++){

			$reported_array[$i] = 0; 
		}

		for($i=0;$i<12;$i++){

			foreach ($res as $key => $value) {

				if($value["month"]==($i+1)){					
					
					$reported_array[$i] = (int) $value["reported_devices"]; 

				}
			}
		}


		for($i=11;$i>=0;$i--){
			if($reported_array[$i] == 0 ){
				$reported_array[$i] = null; 
			}
			else{
				break;
			}
		}

		// echo "<pre>";
		// print_r($reported_array);

		return $reported_array;
	}
	
	public function get_cd4_devices_perCounty(){
		$sql = "CALL proc_get_devices_per_county";
		$response = R::getAll($sql);
		
		foreach ($response as $key => $value) {
			
			$response[$key]['no_per_county'] = (int) $response[$key]['no_per_county'];
			
		}
		return $response;	
	}
	
	
	
	
	
}