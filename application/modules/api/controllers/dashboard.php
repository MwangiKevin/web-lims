<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class dashboard extends MY_Controller {	

	function __construct() {

		parent::__construct();
		$this->load->model("dashboard_m");
		
		header('Content-Type: application/json; charset=utf-8');
	}
	
	public function index(){
		$this->load->view('create');
	}
	
	// for testing trends for last 4 years [line graph]	
	public function get_testing_trends(){
		$entity_type = $this -> input -> get('entityType');
		$entity_id = $this -> input -> get('entityId');
		$start_date = $this -> input -> get('startDate');
		$end_date = $this -> input -> get('endDate');
		
		if(empty($entity_type)){
			$entity_type = 0;
		}
		if(empty($entity_id)){
			$entity_id = 0;
		}
		if($start_date == ''){
			$start_date = Date('Y-01-01');
		}
		if(empty($end_date)){
			$end_date = Date('Y-m-d');
		}
		
				 
		$sql = "CALL proc_tests_line_trend('".$entity_type."','".$entity_id."','".$start_date."', '".$end_date."')";
		$tests = R::getAll($sql);
		
		
		// echo "<pre>";
		// print_r($tests);
		// echo "</pre>";
		// die;
	
		$categories 	=	$this->get_testing_trends_categories($start_date,$end_date);
		// echo "get_testing_trends Start Date ".$start_date;
		// echo "<pre>";
		// print_r($categories);
		// echo "</pre>";
		// die;
		
		$bel 	=	array();
		$abv 	=	array();

		foreach ($categories as $key => $value) {
			$bel[$key] 	=	0;
			$abv[$key] 	=	0; 				
		}

		foreach ($categories as $key => $value) {
			 foreach ($tests as $row) {
				if($value==$row["yearmonth"]){
					$bel[$key] 	=	(int) $row["failed"];
					$abv[$key] 	=	(int) $row["passed"];
 				 }
			}
		}

		$series_data	=	array(
								0	=>	array(
											"name"	=>	"Above critical level",
											"data"	=>	$abv
										),
								1 	=>	array(
											"name"	=>	"Below critical level",
											"data"	=>	$bel,
											"color" => "#caa6bb"
										)
							);		

		$data["categories"] 	= $categories;
		$data["series_data"] 	= $series_data;
		
		// echo "<pre>";
		// print_r($series_data);
		// echo "</pre>";
		// die;
		// return $data;
		
		echo json_encode($series_data);
	}	
	public function get_testing_trends_categories($start_date,$end_date){
		$categories 	=	$this->dashboard_m->get_yearmonth_categories($start_date,$end_date);
		
		// echo "<pre>";
		// print_r($categories);
		// echo "</pre>"; 		
		// die;
	
		return $categories;
	}
	public function return_testing_trends_categories(){
		$start_date = $this -> input -> get('startDate');
		$end_date = $this -> input -> get('endDate');
		
		if(empty($start_date)){
			$start_date = Date('Y-01-01');
		}
		if(empty($end_date)){
			$end_date = Date('Y-m-d');
		}
		
		$categories = $this->get_testing_trends_categories($start_date,$end_date);//2012-01-2
		foreach ($categories as $key => $value) {
			$categories[$key] = Date("M,Y", strtotime("".$value.'-1'));
		}
		echo json_encode($categories);
	}

	
	//
	//
	//YEARLY TESTING TRENDS COLUMN
	//
	//
	
	public function get_yearly_testing_trends_categories(){
		$this_year 	= 	(int)	Date("Y");
		$beg_year	=	$this_year - 4;

		//categories
		$categories =	array();
		$categories_initialize =	array();
		for($i=$beg_year;$i<=$this_year;$i++){
			$categories[]	=	"$i";
			$categories_initialize[]	=	0;
		}
		return array($categories,$categories_initialize);
	}
	
	public function return_yearly_testing_trends_categories(){
		$entity_type = $this->input->get('entityType');
		$entity_id = $this->input->get('entityId');
		
		$categories = $this->get_yearly_testing_trends_categories();
		$data = $this->yearly_testing_trends($entity_type,$entity_id);
		
		$consolidated_result = [];
		array_push($consolidated_result,$categories[0],$data);
		// print_r($consolidated_result);die;
		echo json_encode($consolidated_result);
	}

	public function yearly_testing_trends($entity_type,$entity_id) {
		$sql = "CALL proc_equipment_yearly_testing_trends_column('".$entity_type."','".$entity_id."')";
		$sql1 = "CALL proc_sql_eq()";
		$equip_tst = R::getAll($sql);
		$equipment = R::getAll($sql1);
		
		$categories = $this->get_yearly_testing_trends_categories();
		
		//series data
		foreach ($equipment as $key => $value) {
			$row['name']	=	$value["equipment"];
			$row['data']	=	$categories[1];

			foreach ($equip_tst as $value1) {
				if($value["equipment"]==$value1["equipment_name"]){					
					foreach ($categories[0] as $keycat =>$cat) {
						if((int)$value1["year"]==(int)$cat){
							$row['data'][$keycat]= (int)$value1["valid"];
						}
					}
				}
			}


			$data[$key] =	$row;
		}
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";die;
		// echo json_encode($data);die;
		return $data;
	}
	
	//
	//
	//Tests and Errors pie chart
	//
	//
	public function test_errors_pie(){
		$entity_type = $this -> input -> get('entityType');
		$entity_id = $this -> input -> get('entityId');
		$start_date = $this -> input -> get('startDate');
		$end_date = $this -> input -> get('endDate');
				
		if(empty($entity_type)){
			$entity_type = 0;
		}
		if(empty($entity_id)){
			$entity_id = 0;
		}
		if(empty($start_date)){
			$start_date = Date('Y-01-01');
		}
		if(empty($end_date)){
			$end_date = Date('Y-m-d');
		}
		
		$sql = "CALL proc_tests_errors_pie('".$start_date."','".$end_date."',".$entity_type.",".$entity_id.")";
		$tst 	=	R::getAll($sql);

		foreach ($tst[0] as $key => $value) {
					$tst[0][$key] = (int) $tst[0][$key];
				}		
	
		echo json_encode($tst[0]);
	}
	// for test for this year [table]
	public function get_tests(){
		$entity_type = $this -> input -> get('entityType');
		$entity_id = $this -> input -> get('entityId');
		$start_date = $this -> input -> get('startDate');
		$end_date = $this -> input -> get('endDate');
		
		if(empty($entity_type)){
			$entity_type = 0;
		}
		if(empty($entity_id)){
			$entity_id = 0;
		}
		if(empty($start_date)){
			$start_date = Date('Y-01-01');
		}
		if(empty($end_date)){
			$end_date = Date('Y-m-d');
		}
		
		$sql = "CALL proc_tests_table('".$entity_type."','".$entity_id."','".$start_date."','".$end_date."')";
		$tests = R::getAll($sql); 
		$tests[0]["title"]= 'Tests';

		$failed =	$tests[0]["failed"];
		$passed =	$tests[0]["passed"];
		$total =	$tests[0]["total"];
		$errors =	$tests[0]["errors"];
		$valid =	$tests[0]["valid"];

		if($total>0){

			$row["title"]	= 'Percentages';
			$row["total"]	= null;
			$row["passed"]	= round(($passed/$total)*100,2)."%";
			$row["failed"]	= round(($failed/$total)*100,2)."%";	
			$row["errors"]	= round(($errors/$total)*100,2)."%";	
			$row["valid"]	= round(($valid/$total)*100,2)."%";	
		}else{
			$row["title"]	= 'Percentages';
			$row["total"]	= null;
			$row["passed"]	= "0 %";
			$row["failed"]	= "0 %";	
			$row["errors"]	= "0 %";	
			$row["valid"]	= "0 %";
		}

		$tests[1]	=	$row;
		
		// echo "<pre>";
		// print_r($tests);
		// echo "</pre>";die;
		
		echo json_encode($tests);	
	}
	// for yearly testing trends [Column]
	public function get_yearly_testing_trends($param1,$param2){
		$sql = "CALL proc_error_yealy_trends()";
		$response = R::getAll($sql);

		echo json_encode($response);
	}
	
	
	// WEB-LIMS DEVICE DISTRIBUTION
    

	// Number of Devices per County [stacked]
	public function get_cd4_devices_perCounty(){
		$result = $this->dashboard_m->get_cd4_devices_perCounty();
		echo json_encode($result);
	}

	// get cd4 devices [Pie Chart]
	function get_cd4_devices_pie(){	

		$entity_type = $this->input->get('entityType');
		$entity_id = $this->input->get('entityId');

		$result = $this->dashboard_m->get_cd4_devices_pie($entity_type,$entity_id);
		echo json_encode($result);
	}

	// get cd4 equipment [Table]
	function get_devices_table(){
		$entity_type = $this->input->get('entityType');
		$entity_id = $this->input->get('entityId');
		
		if(empty($entity_type)){
			$entity_type = 0;
		}
		if(empty($entity_id)){
			$entity_id = 0;
		}
		
		$result = $this->dashboard_m->get_devices_table($entity_type,$entity_id);
		echo json_encode($result);
	}

	
	// equipment and tests [Pie Chart]
	function get_devices_tests_pie(){
		$entity_type = $this -> input -> get('entityType');
		$entity_id = $this -> input -> get('entityId');
		$start_date = $this -> input -> get('startDate');
		$end_date = $this -> input -> get('endDate');
		
		if(empty($entity_type)){
			$entity_type = 0;
		}
		if(empty($entity_id)){
			$entity_id = 0;
		}
		if(empty($start_date)){
			$start_date = Date('Y-01-01');
		}
		if(empty($end_date)){
			$end_date = Date('Y-m-d');
		}
		
		$result = $this->dashboard_m->get_devices_tests_pie($start_date,$end_date,$entity_type,$entity_id);
		echo json_encode($result);
	}

	// Devices tests for this year [table]
	function get_devices_tests_table(){
		$entity_type = $this -> input -> get('entityType');
		$entity_id = $this -> input -> get('entityId');
		$start_date = $this -> input -> get('startDate');
		$end_date = $this -> input -> get('endDate');
		
		if(empty($entity_type)){
			$entity_type = 0;
		}
		if(empty($entity_id)){
			$entity_id = 0;
		}
		if(empty($start_date)){
			$start_date = Date('Y-01-01');
		}
		if(empty($end_date)){
			$end_date = Date('Y-m-d');
		}

		
		
		$result = $this->dashboard_m->get_devices_tests_table($start_date,$end_date,$entity_type,$entity_id);
		echo json_encode($result);
	}

	// expected reporting devices [area chart]
	function get_expected_reporting_devices(){
		$entity_type = $this -> input -> get('entityType');
		$entity_id = $this -> input -> get('entityId');
		$start_date = $this -> input -> get('startDate');
		$end_date = $this -> input -> get('endDate');
		$year = Date( 'Y',strtotime($start_date));
		
		if(empty($entity_type)){
			$entity_type = 0;
		}
		if(empty($entity_id)){
			$entity_id = 0;
		}
		if(empty($start_date)){
			$start_date = Date('Y');
		}
		

		$results = $this->dashboard_m->get_expected_reporting_devices($entity_type,$entity_id,$year);
		echo json_encode($results);
	}
}