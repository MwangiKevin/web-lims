<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class filters extends MY_Controller {	

	function __construct() {

		parent::__construct();

		
		header('Content-Type: application/json; charset=utf-8');
		// $this->load->model('api/api_m');
	}

	public function index(){
	}

	public function entities(){
		
		$entities = array();

		$this->load->model("facilities_m");	
		$this->load->model("sub_counties_m");	
		$this->load->model("counties_m");	
		$this->load->model("partners_m");	

		$facilities 	= $this->facilities_m	->	read();
		$sub_counties 	= $this->sub_counties_m	->	read();
		$counties 		= $this->counties_m		->	read();
		$partners 		= $this->partners_m		->	read();

		foreach ($facilities as $key => $value) {

			$item = array(
					'name' 			=>	$value['facility_name'],
					'email'			=>	$value['facility_email'],
					'phone' 		=>	$value['facility_phone'],
					'type' 			=>	"Facilities",
					'filter_type'	=>	1,
					'filter_id'		=>	(int) $value['facility_id']
				);	
			array_push($entities, $item);
		}


		foreach ($sub_counties as $key => $value) {

			$item = array(
					'name' 			=>	$value['name'],
					'email'			=>	"",
					'phone' 		=>	"",
					'type' 			=>	"Sub Counties",
					'filter_type'	=>	2,
					'filter_id'		=>	(int) $value['id']
				);	
			array_push($entities, $item);
		}



		foreach ($counties as $key => $value) {

			$item = array(
					'name' 			=>	$value['name'],
					'email'			=>	"",
					'phone' 		=>	"",
					'type' 			=>	"Counties",
					'filter_type'	=>	3,
					'filter_id'		=>	(int) $value['id']
				);	
			array_push($entities, $item);
		}

		foreach ($partners as $key => $value) {

			$item = array(
					'name' 			=>	$value['name'],
					'email'			=>	"",
					'phone' 		=>	"",
					'type' 			=>	"Partners",
					'filter_type'	=>	4,
					'filter_id'		=>	(int) $value['id']
				);	
			array_push($entities, $item);
		}


		echo json_encode($entities,JSON_PRETTY_PRINT);

	}	

	public function programs(){
		$programs = array(
			array('name'=>'Viral Load','initials'=>'VL'),
			array('name'=>'Early Infant Diagnosis','initials'=>'EID'),
			array('name'=>'CD4','initials'=>'CD4')
			);

		echo json_encode($programs,JSON_PRETTY_PRINT);
	}

	public function dates(){
		$dates = array('start'=> date("Y-m-d", strtotime('first day of this year')),'end'=>date("Y-m-d"));

		echo json_encode($dates,JSON_PRETTY_PRINT);

		return $dates;
	}
}