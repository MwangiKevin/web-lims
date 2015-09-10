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

				if( !is_null($mfl_code) && $this->aauth->create_user($value['facility_mfl_code'],$this->get_default_password(),$value['name']) ){


					$u_id = (int) R::getAll("SELECT id FROM aauth_users  WHERE email ='$mfl_code'")[0]['id'];

					$this->aauth->set_member($u_id,'facility_default');
					

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

	public function remap_facility_default_users(){
		$sql = "SELECT 
						`u`.`id` 	AS	`user_id`,
						`u`.`email`	AS	`user_mfl`,
						`u`.`name` 	AS 	`user_name`,
						`f`.`id` 	AS 	`facility_id`,
						`f`.`name` 	AS 	`facility_name`,
						`f`.`mfl_code`,
						`ug`.`group_id`,
						`uv`.`key`,
						`uv`.`value`


					FROM `aauth_users` `u`
						LEFT JOIN `aauth_user_to_group` `ug`
						ON `ug`.`user_id` = `u`.`id` 
						AND `ug`.`group_id` = '4'
						RIGHT JOIN `facility` `f`
						ON `u`.`email` = `f`.`mfl_code`
						LEFT JOIN `aauth_user_variables` `uv`
						ON `uv`.`user_id` = `u`.`id`
						AND `uv`.`key` = 'linked_entity_id'

					";

		$fac_us 	=	R::getAll($sql);

		foreach ($fac_us as $key => $value) {
			if($value[user_id] == null){

				echo "<br/>".$value[facility_name];
				$facility_id = (int) $value[facility_id];
				$this->create_facility_default_user($facility_id);


			}
		}
	}

	public function reset_facility_default_users(){
		$sql = "SELECT 
					`u`.`id`AS `user_id`,
					`u`.`email` AS `mfl_code`,
					`u`.`name`,
					`f`.`id` `facility_id`    
				FROM `aauth_users` `u` 
				LEFT JOIN `facility` `f` ON `u`.`email` = `f`.`mfl_code`
				WHERE `u`.`email` > 0";

		$res = R::getAll($sql);

		foreach ($res as $key => $value) {

			// echo "j";

	        $this->aauth->set_member($value['user_id'],4);
			$this->aauth->set_user_var('linked_entity_id',$value['facility_id'],$value['user_id']);

		}
	}
}