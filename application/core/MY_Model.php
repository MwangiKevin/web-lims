<?php
class MY_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
		ini_set('memory_limit', '-1');
	}
	
	public function get_yearmonth_categories($from,$to){
		$datemonth = array();
		
		$from_year        = (int) Date("Y",strtotime($from));
		$from_month       = (int) Date("m",strtotime($from));
		$to_year          = (int) Date("Y",strtotime($to));
		$to_month         = (int) Date("m",strtotime($to));

		for($y=$from_year; $y <= $to_year;$y++){
			for($m=1;($m <= 12);$m++){

				if(($y==$from_year)&&($y==$to_year)){
					if(($m>=$from_month)&&($m<=$to_month)){
						$datemonth[] = $y."-".$m;
					}
				}
				elseif($y==$from_year ){
					if($m>=$from_month ){
						$datemonth[] = $y."-".$m;
					}
				}elseif($y==$to_year){
					if($m<=$to_month ){
						$datemonth[] = $y."-".$m;
					}
				}else{
					 $datemonth[] = $y."-".$m;
				}
			}
		}
		return $datemonth;
	}

	public function get_yearmonth_categories_wordly($start_date=null,$end_date=null){

		if(empty($start_date)){
			$start_date = Date('Y-01-01');
		}
		if(empty($end_date)){
			$end_date = Date('Y-m-d');
		}
		
		$categories = $this->get_yearmonth_categories($start_date,$end_date);//2012-01-2
		foreach ($categories as $key => $value) {
			$categories[$key] = Date("M,Y", strtotime("".$value.'-1'));
		}
		return $categories;
	}

	public function tester(){
		return "Works";
	}

	protected function arr_to_dt_response($data,$draw,$total_records,$records_filtered){

		foreach ($data as $key => $value) {
			$data[$key]['DT_RowId'] = 'row_'.$value['id'];
			$data[$key]['DT_RowData'] = array('pkey'=>$value['id']);
		}

		return array(
					'draw' 				=> 	$draw,
					'sEcho' 			=> 	$draw,
					'recordsTotal' 		=> 	$total_records,
					'recordsFiltered' 	=> 	$records_filtered,
					'data' 				=> 	$data
			);

	}

	protected function api_get_users( 	
										$id = NULL , 
										$search = NULL, 
										$order_col = NULL , 
										$order_dir = NULL, 
										$limit_start = NULL , 
										$limit_items = NULL, 
										$if_get_count = NULL
									){

		return R::getAll("CALL `proc_api_get_users`('$id','$search','$order_col','$order_dir','$limit_start','$limit_items','$if_get_count')");

	}
}