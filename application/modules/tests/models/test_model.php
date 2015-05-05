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

		$serverSide_data = R::getAll("CALL `proc_dt_tests`('".$start."','".$length."','".$search."','".$column."')");
		
		return $serverSide_data;
	}

	function raw_ss_dt($length, $search, $order)
	{
		$search_value = $search[value];
		$order_column = $order[0][column];
		$order_direction = $order[0][dir];


		$sql = "SELECT
					`cd4t`.`id`,
					`cd4t`.`patient_id`,
					`fc`.`name`,
					`cd4t`.`cd4_count`
				FROM `cd4_test` `cd4t`
					LEFT JOIN `facility` `fc`
						ON `cd4t`.`facility_id` = `fc`.`id`
				LIMIT $length";
		
		$serverSide_data = R::getAll($sql);
		
		return $serverSide_data;
	}

}
?>
