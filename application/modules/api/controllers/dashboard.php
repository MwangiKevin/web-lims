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
}