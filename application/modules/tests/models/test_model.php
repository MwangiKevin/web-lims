<?php
if (!defined("BASEPATH")) exit('No direct script access allowed');

/**
* 
*/
class test_model extends MY_Model
{	
	function __construct()
	{
		parent:: __construct();
	}
	function ss_dt( $start, $length, $search=NULL, $order )
	{
		$search_value = $search[value];
		$order_column = $order[0][column];
		$order_direction = $order[0][dir];

		if ($order_column = 0) {
			$column = `cd4t`.`id`;
		}else if ($order_column = 1){
			$column = `cd4t`.`patient_id`;
		}else if ($order_column = 2){
			$column = `fc`.`name`;
		}else if ($order_column = 3){
			$column = `cd4t`.`cd4_count`;
		}

		$serverSide_data = R::getAll("CALL `proc_dt_tests`('".$start."','".$length."','".$search."')");

		$data = array();
		$recordsTotal = 0;

		foreach ($serverSide_data as $key => $value) {
			$data[] = array(
					$value['id'],
					$value['patient_id'],
					$value['name'],
					$value['cd4_count'],
				);
			$recordsTotal++;
		}

		$json_reg = array(
				"sEcho" => 1,
				"iTotalRecords" => $recordsTotal,
				"iTotalDisplayRecords" => $recordsTotal,
				"aaData" => $data
			);
		
		return $json_reg;
		
	}

	function raw_ss_dt()
	{
		
		$sql = "SELECT
					`cd4t`.`id`,
					`cd4t`.`patient_id`,
					`fc`.`name`,
					`cd4t`.`cd4_count`
				FROM `cd4_test` `cd4t`
					LEFT JOIN `facility` `fc`
						ON `cd4t`.`facility_id` = `fc`.`id`";
		
		$serverSide_data = R::getAll($sql);

		$data = array();
		$recordsTotal = 0;

		foreach ($serverSide_data as $key => $value) {
			$data[] = array(
					$value['id'],
					$value['patient_id'],
					$value['name'],
					$value['cd4_count'],
				);
			$recordsTotal++;
		}

		$json_reg = array(
				"sEcho" => 1,
				"iTotalRecords" => $recordsTotal,
				"iTotalDisplayRecords" => $recordsTotal,
				"aaData" => $data
			);
		
		return $json_reg;
	}

}
?>
