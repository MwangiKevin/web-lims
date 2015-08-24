<?php

class utils_m extends MY_Model{

	function __construct() {

		parent::__construct();

		// $this->load->model("facilities_m");	
		// $this->load->model("sub_counties_m");	
		// $this->load->model("counties_m");	
		// $this->load->model("partners_m");	
		// $this->load->model("users_m");	
	}

	/**
	 * Facilities utils
	 */
	public function create_facility_default_user($facility_id = null){

		$facilities = $this->api_get_facilities($facility_id);

		$count = 0;
		$users_added = array();

		foreach ($facilities as $key => $value) {

			$mfl_code = $value['facility_mfl_code'];
			$name  = $value['name'];

				// echo $name."------$mfl_code p-------<br/>";

			try{

				if( !is_null($mfl_code) && $this->aauth->create_user($value['facility_mfl_code'],'123456',$value['name']) ){


					$u_id = (int) R::getAll("SELECT id FROM aauth_users  WHERE email ='$mfl_code'")[0]['id'];

					$this->aauth->add_member($u_id,'facility_default');
					

					$f_id = (int) R::getAll("SELECT f.id FROM aauth_users  u LEFT JOIN facility f ON f.mfl_code = u.email WHERE f.mfl_code ='$mfl_code'")[0]['id'];

					$this->aauth->set_user_var('linked_entity_id',$f_id,$u_id);

					$count++;
					$users_added[] = $name;


				}
			}catch (Exception $e){
			}
		}

		return array(
					'count'	=> $count,
					'users_added'=>$users_added
			);

	}

}