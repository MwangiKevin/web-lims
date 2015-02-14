<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class dashboard extends MY_Controller {	

	function __construct() {

		parent::__construct();		
	}

	public function index() {
		
		$this->load->view('dashboard_template');
	}

	public function dashboard_view(){
		$this->load->view("dashboard_v");
	}

	public function tests(){
		echo "Test";	
	}
	public function tat(){
		echo "tat";	
	}
	public function facilitiesTests(){
		echo "facilitiesTests";	
	}
	public function labPerformance(){
		echo "labPerformance";	
	}
	public function TBCoinf(){
		echo "TBCoinf";	
	}
	public function VLSuppression(){
		echo "VLSuppression";	
	}
	public function SampleType(){
		echo "SampleType";	
	}
	public function BF(){
		echo "BF";	
	}

	public function dashboard_item(){

		$this->load->view("dashboard_item_v");
	}

	public function dashboard_item_singular(){

		$this->load->view("dashboard_item_singular_v");
	}
}
