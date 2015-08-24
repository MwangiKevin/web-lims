<?php

class users_m extends MY_Model{

	function __construct() {

		parent::__construct();

		$this->load->model("facilities_m");	
		$this->load->model("sub_counties_m");	
		$this->load->model("counties_m");	
		$this->load->model("partners_m");	
	}

	public function create(){
		
	}

	public function read($id=NULL){

		$users = array();

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

			
			$total_records		=	(int) $this->api_get_users($id,NULL,$order_col,$order_dir,NULL,NULL,'true')[0]['count'];
			$records_filtered	=	(int) $this->api_get_users($id,NULL,$order_col,$order_dir,$limit_start,$limit_items,'true')[0]['count'];
		}

		$search = addslashes($search);


		$users_res = $this->api_get_users($id,$search,$order_col,$order_dir,$limit_start,$limit_items,'false');

		if($id==NULL){

			$users =  $users_res;	

			foreach ($users as $key => $value) {

				$users[$key]['default_user_group']  = (array) $this->aauth->get_user_groups($users[$key]['id'])[0];
				$users[$key]['user_groups']  = (array) $this->aauth->get_user_groups($users[$key]['id']);
				$users[$key]['linked_entity_id']  = (int) $this->aauth->get_user_var("linked_entity_id",$users[$key]['id']);

				$users[$key]['banned']  = (int) $users[$key]['banned'];

				if($users[$key]['default_user_group']['group_id']== 4){

					$mfl = $users[$key]['email'];

					$fac_res =  R::getAll("SELECT f.email,f.phone FROM aauth_users  u LEFT JOIN facility f ON f.mfl_code = u.email WHERE f.mfl_code ='$mfl'")[0];

					$users[$key]['email'] = $fac_res['email'];

					$users[$key]['phone'] = (string) $fac_res['phone'];

				}else{
					$users[$key]['phone']  = (string) $this->aauth->get_user_var('phone',$users[$key]['id']);
				}

			}

		}else{

			$users =  $users_res[0];	

			if(!is_null($users['id'])){	

				$users['default_user_group']  = (array) $this->aauth->get_user_groups($users['id'])[0];
				$users['user_groups']  = (array) $this->aauth->get_user_groups($users['id']);
				$users['linked_entity_id']  = (int) $this->aauth->get_user_var("linked_entity_id",$users['id']);

				$users['banned']  = (int) $users['banned'];

				if($users['default_user_group']['group_id']== 2) {
					$users['linked_entity'] = array(
							        "filter_type"=> 0,
							        "filter_id"=> 0
						);
				}	
				else if($users['default_user_group']['group_id']== 3) {
					$users['linked_entity'] = $this->facilities_m->read($users['linked_entity_id']);
					$users['phone']  = (string) $this->aauth->get_user_var('phone',$users['id']);
				}
				else if($users['default_user_group']['group_id']== 4 ){
					$users['linked_entity'] = $this->facilities_m->read($users['linked_entity_id']);

					$mfl = $users['email'];
					
					$fac_res =  R::getAll("SELECT f.email,f.phone FROM aauth_users  u LEFT JOIN facility f ON f.mfl_code = u.email WHERE f.mfl_code ='$mfl'")[0];

					$users[$key]['email'] = $fac_res['email'];

					$users[$key]['phone'] = (string) $fac_res['phone'];

				}
				else if($users['default_user_group']['group_id']== 6){
					$users['linked_entity'] = $this->sub_counties_m->read($users['linked_entity_id']);
					$users['phone']  = (string) $this->aauth->get_user_var('phone',$users['id']);
				}
				else if($users['default_user_group']['group_id']== 5){
					$users['linked_entity'] = $this->counties_m->read($users['linked_entity_id']);
					$users['phone']  = (string) $this->aauth->get_user_var('phone',$users['id']);
				}
				else if($users['default_user_group']['group_id']== 7){
					$users['linked_entity'] = $this->partners_m->read($users['linked_entity_id']);
					$users['phone']  = (string) $this->aauth->get_user_var('phone',$users['id']);
				}
				else{
					$users['linked_entity'] = array(
							        "filter_type"=> -1,
							        "filter_id"=> -1
						);					
					$users['phone']  = (string) $this->aauth->get_user_var('phone',$users['id']);
				}
			}
		}

		if($is_datatable && $id==NULL){

			$users = $this->arr_to_dt_response($users,$draw,$total_records,$records_filtered);

		}

		return $users;
	}

	public function update($id=NULL){
		
		$request_fields = file_get_contents('php://input');

		$user = json_decode($request_fields, true);

		if(!is_null($id)){

			//aauth fields
			$this->aauth->update_user($id, $user['email'],$user['pass'], $user['user_name']);

			//phone
			$this->aauth->set_user_var('phone',$user['phone'],$id);

	        // $this->aauth->set_member(1,2);
		}
	
	}

	public function remove($id){
	}

}