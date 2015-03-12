<?php

class facilities_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

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

			$facility_devices = R::getAll("CALL `proc_get_facility_devices`('','".$facilities['facility_id']."')");
			$facilities['devices'] = $facility_devices;
		}

		return $facilities;
	}

	public function update($id){

	}

	public function remove($id){

	}

}