<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class dashboard extends MY_Controller {	

	// for testing trends for last 4 years [line graph]
	function get_testing_trends($param1,$param2){
		$sql = "CALL proc_test_line_trend()";
		$response = R::getAll($sql);

		echo json_encode($response);
	}

// for tests and errors [pie chart]
	function get_test_n_errors($param1, $param2){
		$sql = "CALL proc_get_test_pie()";
		$response = R::getAll($sql);

		echo json_encode($response);
	}

	// for test for this year [table]
	function get_tests($param1, $param2){
		$sql = "CALL proc_tests_table()";
		$response = R::getAll($sql);

		echo json_encode($response);
	}

	// for yearly testing trends [Column]
	function get_yearly_testing_trends($param1,$param2){
		$sql = "CALL proc_error_yealy_trends()";
		$response = R::getAll($sql);

		echo json_encode($response);
	}


// WEB-LIMS DEVICES


	// Number of Devices per County [stacked]
	function get_cd4_devices_perCounty(){
		$sql = "CALL get_devices_per_county";
		$response = R::getAll($sql);
		
		echo json_encode($response);

	}

	// get cd4 devices [Pie Chart]
	function get_cd4_devices_pie($param1,$param2){
		$sql = "CALL proc_equipment_pie(0,0)";
		$response = R::getAll($sql);

		// echo "<pre>" ; print($response);
		// die();
		
		echo json_encode($response);
	}

	// get cd4 Devices [Table]
	function get_devices_table(){

		$sql = "CALL proc_get_facility_devices()";
		$response = R::getAll($sql);

		echo json_encode($response);
	}

	// Devices and tests [Pie Chart]
	function get_devices_tests_pie($param1,$param2){
		$sql = "CALL proc_equipment_tests_pie()";
		$response = R::getAll($sql);

		echo json_encode($response);
	}

	// Devices tests for this year [table]
	function get_devices_tests_thisyear(){
		$sql = "CALL proc_equipment_test_data";
		$response = R::getAll($sql);

		echo json_encode($response);
	}

	// expected reporting devices [area chart]
	
	function get_expected_reporting_devices($param1,$param2,$year=2015){
		//error_reporting(0);
		$sql_devices_added = "CALL proc_expected_reporting_dev_array_added(".$param1.", ".$param2.")";

		$sql_devices_removed = "CALL proc_expected_reporting_dev_array_removed(".$param1.", ".$param2.")";


		$devices_added_assoc 	=	R::getAll($sql_devices_added);
		$devices_removed_assoc 	=	R::getAll($sql_devices_removed);

		$devices_added_array	=	array();	
		$devices_removed_array	=	array();

		$consolidated_array		=	array();

		//initialize
		$current_cummulative_added 		= 0;
		$current_cummulative_removed 	= 0;

		foreach ($devices_added_assoc as $value) {
			$curr_year = (int) Date("Y",strtotime($value["rank_date"]));

			if($curr_year< (int) $year){
				$current_cummulative_added 		= (int) $value["cumulative"];
			}
		}
		//echo 	$current_cummulative_added ;
		foreach ($devices_removed_assoc as $value) {
			$curr_year = (int) Date("Y",strtotime($value["rank_date"]));
			if($curr_year< (int) $year){
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

		echo json_encode($consolidated_array);
	}


}