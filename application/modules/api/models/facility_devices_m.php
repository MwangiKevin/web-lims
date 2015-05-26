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
		
		$facility_device_ID = $county_table[0][Auto_increment];
		
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

		if(!$this->db->query($sql)){
			$error = array('error' => array('message'=>$this->db->_error_message(),'no'=>$this->db->_error_number() ));
			return $error;
		}
		return $facility_device;
	}

	public function read($id=NULL){

		$fac_dev = array();

		$verbose = $this->input->get('verbose');

		$fac_dev_res = R::getAll("CALL `proc_get_facility_devices`('$id','')");
		
		if($id==NULL){

			$fac_dev =  $fac_dev_res;	

			if($verbose=='true'){
				foreach ($fac_dev as $key => $value) {
					$facility=R::getAll("CALL `proc_get_facilities`('".$value['facility_id']."','','','')");

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
				$facility=R::getAll("CALL `proc_get_facilities`('".$fac_dev['facility_id']."')");

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

		return $fac_dev;
	}

	public function update($id){
		
		$request_fields = file_get_contents('php://input');

		$facility_device = json_decode($request_fields, true);

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
		return $facility_dev_updated;

	}

	public function remove($id){

		$request_fac_dev = file_get_contents('php://input');

		$facility_dev = json_decode($request_fac_dev, true);
		
		$facility_dev_deleted = R::getAll("UPDATE `facility_device` 
											SET 
												`status`='$facility_device[status]'
											WHERE 
												`id` = '$id'
											");
		
		return $facility_dev_deleted;
	}

}