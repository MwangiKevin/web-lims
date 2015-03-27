<?php

class facilities_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){
		$error = array();
		
		$request_body = file_get_contents('php://input');
		
		$facility = json_decode($request_body,true);
		
		$facility_table =	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'facility'"	);
		
		$facility_ID = $facility_table[0][Auto_increment];
		
		$sql = "INSERT INTO `facility`
							(
							`id`,
							`name`,
							`mfl_code`,
							`site_prefix`,
							`sub_county_id`,
							`partner_id`,
							`facility_type_id`,
							`level`,
							`central_site_id`,
							`email`,
							`phone`,
							`rollout_status`
							)
						VALUES
							(
							'$facility_ID',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							''
							)";
		
		echo $sql;
		die();
		if(!$this->db->query($sql)){
			$error = array('error' => array('message'=>$this->db->_error_message(),'no'=>$this->db->_error_number() ));
		}
	}

	public function read($id){

		$facilities = array();

		$verbose = $this->input->get('verbose');
		// $verbose = true;

		$facilities_res = R::getAll("CALL `proc_get_facilities`('$id')");
		
		if($id==NULL){

			$facilities =  $facilities_res;	

			if($verbose=='true'){

				foreach ($facilities as $key => $value) {
					$facility_devices = R::getAll("CALL `proc_get_facility_devices`('','".$value['facility_id']."')");
					$facilities[$key]['devices'] = $facility_devices;
				}	

			}

		}else{

			$facilities =  $facilities_res[0];	
			if(sizeof($facilities)>0){
				$facility_devices = R::getAll("CALL `proc_get_facility_devices`('','".$facilities['facility_id']."')");
				$facilities['devices'] = $facility_devices;
			}
		}

		return $facilities;
	}

	public function update($id){
		// parse_str(file_get_contents('php://input'), $_PUT);
		$request_fields = file_get_contents('php://input');

		$facility = json_decode($request_fields, true);

		$facility_updated = R::getAll("UPDATE `facility` 
								SET 
									`name`='',
									`name`='',
									`name`='',
									`name`='',
									`name`='',
									`name`='',
									`name`='',
									`name`='',
									`name`='',
									`name`='',
									`name`=''
								WHERE 
									`id` = '$id'
								");
		return $facility_updated;
	}

	public function remove($id){

	}

}