<?php

class facility_devices_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){
		$error = array();
		
		$request_body = file_get_contents('php://input');
		
		$facility_device = json_decode($request_body,true);
		
		$facility_device_table =	R::getAll("SHOW TABLE STATUS WHERE `Name` = 'facility_device'");

		$date = date('H:i:s');

		$facility_device[date_added] = $facility_device[date_added].' '.$date;
		
		$facility_device_ID = $facility_device_table[0][Auto_increment];
		
		$sql = "INSERT INTO `facility_device`
						(
						`id`,
						`facility_id`,
						`device_id`,
						`status`,
						`deactivation_reason`,
						`date_added`,
						`date_removed`
						)
					VALUES
						(
						'$facility_device_ID',
						'$facility_device[facility_id]',
						'$facility_device[device_id]',
						'$facility_device[status]',
						'$facility_device[deactivation_reason]',
						'$facility_device[date_added]',
						'$facility_device[date_removed]'
						)";

		echo $sql;die;

		if(!$this->db->query($sql)){
			$error = array('error' => array('message'=>$this->db->_error_message(),'no'=>$this->db->_error_number() ));
			return $error;
		}
		//return $facility_device;
	}

	public function read($id=NULL){

		$fac_dev = array();

		$verbose = $this->input->get('verbose');

		$is_datatable = $this->input->get("datatable");

		$search = $this->input->get("search");
		$order = $this->input->get("order");
		$limit_start = $this->input->get("limit_start");
		$limit_items = $this->input->get("limit_items");
		
		$draw;$order_col;$order_dir;


		$total_records = 0;
		$records_filtered = 0;

		if($is_datatable){
			$search = $search['value'];			
			$search = addslashes($search);

			$columns = $this->input->get("columns");

			$order_col_index = $order[0]['column'];
			$order_col = $columns[$order_col_index]['data'];
			$order_dir = $order[0]['dir'];


			$limit_start = $this->input->get("start");
			$limit_items = $this->input->get("length");
			$draw = $this->input->get("draw");

			$total_records 		= 	(int)	R::getAll("CALL `proc_api_get_facility_devices`('$id','','','$order_col','$order_dir','','','true')")[0]['count'];
			$records_filtered 	=	(int) 	R::getAll("CALL `proc_api_get_facility_devices`('$id','','$search','$order_col','$order_dir','$limit_start','$limit_items','true')")[0]['count'];
		}

		$search = addslashes($search);

		$fac_dev_res = R::getAll("CALL `proc_api_get_facility_devices`('$id','','$search','$order_col','$order_dir','$limit_start','$limit_items','false')");

		if($id==NULL){

			$fac_dev =  $fac_dev_res;	

			if($verbose=='true'){
				foreach ($fac_dev as $key => $value) {
					$facility=R::getAll("CALL `proc_api_get_facilities`('".$value['facility_id']."','','','','','','')");

					if(sizeof($facility)>0){
						$fac_dev[$key]['assigned_to_facility'] = true;
						foreach ($facility[0] as $fac_key => $value1) {
							$fac_dev[$key][$fac_key]= $value1;
						}
					}else{

						$fac_dev[$key]['assigned_to_facility'] = false;
					}
				}
			}

		}else{

			$fac_dev =  $fac_dev_res[0];

			if(sizeof($fac_dev)>0){
				$facility=R::getAll("CALL `proc_api_get_facilities`('".$fac_dev['facility_id']."','','','','','','')");

				if(sizeof($facility)>0){
					$fac_dev['assigned_to_facility'] = true;
					foreach ($facility[0] as $fac_key => $value1) {
						$fac_dev[$fac_key]= $value1;
					}
				}else{

					$fac_dev['assigned_to_facility'] = false;
				}

			}	
		}

		
		if($is_datatable && $id==NULL){

			$fac_dev = $this->arr_to_dt_response($fac_dev,$draw,$total_records,$records_filtered);


		}else{
		}

		$fac_dev['id'] = $fac_dev['facility_device_id'];
		$fac_dev['original_date_added'] = $fac_dev['date_added'];
		$fac_dev['date_added'] = date('Y-m-d',strtotime($fac_dev['date_added']));
		

		// echo "<pre>";
		// print_r($fac_dev);
		// echo "</pre>";die;
		return $fac_dev;
	}

	public function update($id){
		
		$request_fields = file_get_contents('php://input');

		$facility_device = json_decode($request_fields, true);

		$date_compare = date('Y-m-d',strtotime($facility_device['date_added']));

		if($facility_device[date_added]==$date_compare){
			$original_time = date('H:i:s',strtotime($facility_device[original_date_added]));
			$facility_device[date_added] = $facility_device[date_added].' '.$original_time;
		}else{
			$current_time = date('H:i:s');
			$facility_device[date_added] = $facility_device[date_added].' '.$current_time;
		}
		$facility_dev_updated = R::getAll("UPDATE `facility_device` 
											SET 
												`facility_id`='$facility_device[facility_id]',
												`device_id`='$facility_device[device_id]',
												`status`='$facility_device[status]',
												`deactivation_reason`='$facility_device[deactivation_reason]',
												`date_added`='$facility_device[date_added]',
												`date_removed`='$facility_device[date_removed]',
												`serial_number`='$facility_device[serial_number]'
											WHERE 
												`id` = '$id'
								");
		// $facility_dev_updated = "UPDATE `facility_device` 
		// 									SET 
		// 										`facility_id`='$facility_device[facility_id]',
		// 										`device_id`='$facility_device[device_id]',
		// 										`status`='$facility_device[status]',
		// 										`deactivation_reason`='$facility_device[deactivation_reason]',
		// 										`date_added`='$facility_device[date_added]',
		// 										`date_removed`='$facility_device[date_removed]',
		// 										`serial_number`='$facility_device[serial_number]'
		// 									WHERE 
		// 										`id` = '$id'
		// 						";
		//echo $facility_dev_updated;die;
		return $facility_dev_updated;
	}

	public function remove($id){

		$request_fac_dev = file_get_contents('php://input');

		$facility_dev = json_decode($request_fac_dev, true);
		
		$facility_dev_deleted = R::getAll("UPDATE `facility_device` 
											SET 
												`status`='0'
											WHERE 
												`id` = '$id'
											");
		
		return $facility_dev_deleted;
	}

}