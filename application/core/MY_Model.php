<?php
class MY_Model extends CI_Model{

	public function __construct(){
		parent::__construct();

	}


	public function sql_user_delimiter($user_group_id,$user_filter_used){
		$user_delimiter = "";

		if($user_filter_used >0){		

			if($user_group_id == 3){
				$user_delimiter = " AND `partner_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 9) {
				$user_delimiter = " AND `region_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 8) {
				$user_delimiter = " AND `district_id` = '".$user_filter_used."' ";
			}elseif ($user_group_id == 6) {
				$user_delimiter = " AND `facility_id` = '".$user_filter_used."' ";
			}
		}
		return $user_delimiter;
	}
}