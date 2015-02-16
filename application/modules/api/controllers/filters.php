<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class filters extends MY_Controller {	

	function __construct() {

		parent::__construct();

		
		header('Content-Type: application/json; charset=utf-8');
		$this->load->model('api/api_m');
	}

	public function index(){
		echo '<pre/>
		{
			"entities" 	: 	';
			$this->entities(); echo ',
			"programs" 	: 	';
			$this->programs(); echo ',
			"dates" 	: 	';
			$this->dates(); echo '
		}
		';
	}

	public function entities(){
		// $entity_values = [];
		// $entities = $this->api_m->get_entities();
		// // print_r($entities);die;
		// $i = 0;
		// foreach ($entities as $key => $value) {
		// 	if($value['grp_type'] == 'region'){
		// 		$entity_values[$i]['name'] = $value['name'];
		// 		$entity_values[$i]['email'] = 'null';
		// 		$entity_values[$i]['phone'] = 'null';
		// 		$entity_values[$i]['type'] = $value['grp_type']; 
		// 	}else if($value['grp_type'] == 'district'){
		// 		$entity_values[$i]['name'] = $value['dis_name'];
		// 		$entity_values[$i]['email'] = 'null';
		// 		$entity_values[$i]['phone'] = 'null';
		// 		$entity_values[$i]['type'] = $value['grp_type'];	
		// 	}else if($value['grp_type'] == 'partner'){
		// 		$entity_values[$i]['name'] = $value['partner_name'];
		// 		$entity_values[$i]['email'] = 'null';
		// 		$entity_values[$i]['phone'] = 'null';
		// 		$entity_values[$i]['type'] = $value['grp_type'];
		// 	}else if($value['grp_type'] == 'lab'){
		// 		$entity_values[$i]['name'] = $value['name'];
		// 		$entity_values[$i]['email'] = 'null';
		// 		$entity_values[$i]['phone'] = 'null';
		// 		$entity_values[$i]['type'] = $value['grp_type'];
		// 	}else if($value['grp_type'] == 'facility'){
		// 		$entity_values[$i]['name'] = $value['facility_name'];
		// 		$entity_values[$i]['email'] = $value['facility_email'];
		// 		$entity_values[$i]['phone'] = $value['facility_phone'];
		// 		$entity_values[$i]['type'] = $value['grp_type'];
		// 	}
		// 	$i++;
		// }
		// print_r($entity_values);
	
		// return $entity_values;

			$entities = array(
			array('name'=>'Ruvuma','phone'=>'1234567','type'=>'Regions'),
			array('name'=>'CSSC','phone'=>'1234567','type'=>'Implementing Partner'),
			array('name'=>'Iringa','phone'=>'1234567','type'=>'Regions'),
			);


		echo json_encode($entities,JSON_PRETTY_PRINT);
		// echo "[{ 'name': 'Iringa',      						      					'phone':'1234567'		, 'type': 'Region' },
		// { 'name': 'Ruvuma',    					'email': 'ruvuma@email.com',    'phone':'1234567'		, 'type': 'Region' },
		// { 'name': 'CSSC', 						'email': 'cssc@email.com', 		'phone':'1234567'		, 'type': 'Implementing Partner' },
		// { 'name': 'Walter Reed',				'email': 'adrian@email.com',    'phone':'1234567'		, 'type': 'Implementing Partner' },
		// { 'name': 'Arumeru',  					'email': 'arumeru@email.com',  	'phone':'1234567'		, 'type': 'District' },
		// { 'name': 'Kilolo',  					'email': 'Kilolo@email.com',  	'phone':'1234567'		, 'type': 'District' },
		// { 'name': 'Idodo',  					'email': 'Idodo@email.com',  	'phone':'1234567'		, 'type': 'Facility' },
		// { 'name': 'Mafinga',    				'email': 'Mafinga@email.com',   'phone':'1234567'		, 'type': 'District' },
		// { 'name': 'Mbeya District Hospital',	'email': 'natasha@email.com',   'phone':'1234567'		, 'type': 'HPV Lab' },
		// { 'name': 'Ruvuma Hospital',   			'email': 'natasha@email.com',   'phone':'1234567'		, 'type': 'HPV Lab' },
		// { 'name': 'Mgololo',  					'email': 'Mgololo@email.com',  	'phone':'1234567'		, 'type': 'Facility' }
		// ]
		// ";
		return $entities;
	}	

	public function programs(){
		$programs = array(
			array('name'=>'Viral Load','initials'=>'VL'),
			array('name'=>'Early Infant Diagnosis','initials'=>'EID')
			);

		echo json_encode($programs,JSON_PRETTY_PRINT);

		return $programs;
	}

	public function dates(){
		$dates = array('start'=> date("Y-m-d", strtotime('first day of this year')),'end'=>date("Y-m-d"));

		echo json_encode($dates,JSON_PRETTY_PRINT);

		return $dates;
	}
}