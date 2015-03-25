<?php

class facility_devices_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id){

		$fac_dev = array();

		$verbose = $this->input->get('verbose');

		$fac_dev_res = R::getAll("CALL `proc_get_facility_devices`('$id','')");
		
		if($id==NULL){

			$fac_dev =  $fac_dev_res;	

			if($verbose=='true'){
				foreach ($fac_dev as $key => $value) {
					$facility=R::getAll("CALL `proc_get_facilities`('".$value['facility_id']."')");

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

	}

	public function remove($id){

	}

}