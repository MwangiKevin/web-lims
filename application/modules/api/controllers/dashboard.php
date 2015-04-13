<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class dashboard extends MY_Controller {	

	function __construct() {

		parent::__construct();
		$this->load->model("dashboard_m");
	}
	
	public function index(){
		$this->load->view('create');
	}
	
	// for testing trends for last 4 years [line graph]	
	public function get_testing_trends($user_group_id,$user_filter){
		$today		=	Date("Y-m-d");
		$this_year 	= 	(int)	Date("Y");
		$beg_year	=	$this_year - 4;

		$from		=	Date("$beg_year-1-1");
		$to			=	$today;
		
		$sql = "CALL proc_tests_line_trend(0,0,'".$from."', '".$to."')";
		$tests = R::getAll($sql);
		
		
		// echo "<pre>";
		// print_r($tests);
		// echo "</pre>";
		// die;
	
		$categories 	=	$this->get_testing_trends_categories();
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
	public function get_testing_trends_categories(){
		$today		=	Date("Y-m-d");
		$this_year 	= 	(int)	Date("Y");
		$beg_year	=	$this_year - 4;

		$from		=	Date("$beg_year-1-1");
		$to			=	$today;
		
		$categories 	=	$this->dashboard_m->get_yearmonth_categories($from,$to);
		
		// echo "<pre>";
		// print_r($cat2);
		// echo "</pre>"; 		
		// die;
	
		return $categories;
	}
	public function return_testing_trends_categories(){
		$categories = $this->get_testing_trends_categories();
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
	//gets data for xAxis (categories)
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
	//returns data for xAxis (categories)
	public function return_yearly_testing_trends_categories(){
		$categories = $this->get_yearly_testing_trends_categories();
		echo json_encode($categories[0]);
	}
	public function yearly_testing_trends($user_group_id,$user_filter_used) {
		$sql = "CALL proc_equipment_yearly_testing_trends_column(0,0)";
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
		echo json_encode($data);
	}
	
	//
	//
	//Tests and Errors pie chart
	//
	//
	public function test_errors_pie(){
		$from = '2014-02-27';
		$to = '2015-02-24';
		$user_group_id = 0;
		$user_filter_used = 0;
		
		$sql = "CALL proc_tests_errors_pie('".$from."','".$to."',".$user_group_id.",".$user_filter_used.")";
		$tst 	=	R::getAll($sql);
		
		$tst[0]["title"]= 'Tests';

		$failed =	(int) $tst[0]["failed"];
		$passed =	(int) $tst[0]["passed"];
		$total =	(int) $tst[0]["total"];
		$errors =	(int) $tst[0]["errors"];
		$valid =	(int) $tst[0]["valid"];


		// $tests 	=				array(
									// 0	=>	array(
													// 'y'				=>	$valid,
													// 'color'			=>	'#a4d53a',
													// 'drilldown'		=>	array(
																			// 'name'			=>	'Successful Tests',
																			// 'color'			=>	'#a4d53a',
																			// 'categories'	=>	array(
																										// 0	=>	'abv critical lvl',
																										// 1	=>	'blw critical lvl',
																								// ),
																			// 'data'			=>	array(
																										// 0	=>	$passed,
																										// 1	=>	$failed
																								// )
																		// )
												// ),
									// 1	=>	array(
													// 'y'				=>	$errors,
													// 'color'			=>	'#aa1919',
													// 'drilldown'		=>	array(
																			// 'name'			=>	'Unsuccessful Tests (Errors)',
																			// 'color'			=>	'#aa1919',
																			// 'categories'	=>	array(
																										// 0	=>	'Errors'
																								// ),
																			// 'data'			=>	array(
																										// 0	=>	$errors
																								// )
																		// )
												// )
								// );

		$tests = 
				array(
							array('Errors', $errors),
							array('Above Critical', $passed),
							array('Below Critical', $failed)	
						
				);
				
		$data["tests"]		=	$tests;
		$data["categories"]	=	$categories;
		
		echo json_encode($tests);
		
		// $thiss =  json_encode($tests);
		// echo "<pre>";
		// print_r($tests);
		// echo "</pre>";die;
	}

	// for tests and errors [pie chart]
	public function get_test_n_errors($param1, $param2){
		$sql = "CALL proc_get_test_pie()";
		$response = R::getAll($sql);

		echo json_encode($response);
	}

	// for test for this year [table]
	public function get_tests($user_group_id, $user_filter_used,$from,$to){
		$from = '2014-02-27';
		$to = '2015-02-24';
		$user_group_id = 0;
		$user_filter_used = 0;
		
		$sql = "CALL proc_tests_table(".$user_group_id.",".$user_filter_used.",'".$from."','".$to."')";
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
}