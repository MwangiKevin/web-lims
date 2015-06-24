<?php

class commodities_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){
		$error = array();
		
		$request_body = file_get_contents('php://input');
		
		$commodity = json_decode($request_body,true);
		
		$commodity_table =	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'commodity'"	);
		
		$commodity_ID = $commodity_table[0][Auto_increment];
		
		$sql = "INSERT INTO `commodity`
							(
							`id`,
							`code`,
							`name`,
							`unit`,
							`category_id`,
							`reporting_status`
							)
						VALUES
							(
							'$commodity_ID',
							'$commodity[code]',
							'$commodity[name]',
							'$commodity[unit]',
							'$commodity[category_id]',
							'$commodity[reporting_status]'
							)";

		if(!$this->db->query($sql)){
			$error = array('error' => array('message'=>$this->db->_error_message(),'no'=>$this->db->_error_number() ));
			return $error;
		}
		return $commodity;
	}

	public function read($id=NULL){

		$commodities;

		$reporting_status = 0;

		if($this->input->get('reportingOnly') && $this->input->get('reportingOnly')!='false'){

			$reporting_status = 1;
		}




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

			$total_records 		= 	(int)	R::getAll("CALL `proc_api_get_commodities`('$id','','$order_col','$order_dir','','','true','$reporting_status')")[0]['count'];
			$records_filtered 	=	(int) 	R::getAll("CALL `proc_api_get_commodities`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','true','$reporting_status')")[0]['count'];
		}

		$search = addslashes($search);

		$comodities_res = R::getAll("CALL `proc_api_get_commodities`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','false','$reporting_status')");

		if($this->input->get('fcdrr_format') && $this->input->get('fcdrr_format')!='false'){

			$comodity_categories = R::getAll("CALL `proc_get_commodity_categories`('')");

			$i=0;
			foreach ($comodity_categories  as $cat) {
				
				$j=0;
				foreach($comodities_res as $commodity){

					if($cat['commodity_category_id']==$commodity["commodity_category_id"]){
						$commodities_results[$i]['category_id']=$cat['commodity_category_id'];
						$commodities_results[$i]['category_name']=$cat['commodity_category_name'];

						$commodities_results[$i]["commodities"][$j]['id']=$commodity['commodity_id'];
						$commodities_results[$i]["commodities"][$j]['name']=$commodity['commodity_name'];
						$commodities_results[$i]["commodities"][$j]['unit']=$commodity['commodity_unit'];
						if($commodity['commodity_reporting_status']==1){
							$commodities_results[$i]["commodities"][$j]['is_reporting']=true;
						}else{							
							$commodities_results[$i]["commodities"][$j]['is_reporting']=false;
						}
						

						$j++;
					}	
				}
				$i++;
			}

			
			// $commodities = $commodities_results;
			$commodities_clean = array();

			foreach ($commodities_results as $key => $value) {
				array_push($commodities_clean, $value);
			}


			$commodities = $commodities_clean;



		}else{

			$commodities =  $comodities_res;	 
		}


		if($id==NULL){
		//do nothing	

		}else{

			$commodities = $commodities[0];	
		}


		if($is_datatable && $id==NULL){

			$commodities = $this->arr_to_dt_response($commodities,$draw,$total_records,$records_filtered);

		}

		return $commodities;

	}

	public function update($id){
		
		$request_fields = file_get_contents('php://input');

		$commodity = json_decode($request_fields, true);

		$commodity_updated = R::getAll("UPDATE `commodity` 
								SET 
									`code`='$commodity[code]',
									`name`='$commodity[name]',
									`unit`='$commodity[unit]',
									`category_id`='$commodity[category_id]',
									`reporting_status`='$commodity[reporting_status]'
								WHERE 
									`id` = '$id'
								");
		
		return $commodity_updated;
	}

	public function remove($id){

		$request_comm = file_get_contents('php://input');

		$commodity = json_decode($request_comm, true);
		
		$commodity_deleted = R::getAll("UPDATE `commodity` 
								SET 
									`status`='$commodity[status]'
								WHERE 
									`id` = '$id'
											");
		
		return $commodity_deleted;
	}

}