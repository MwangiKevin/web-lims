<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class facilities extends MY_Controller {

	public $login_status = false;

	function __construct() {
		parent::__construct();		
	}

	public function index() {
		$this->load->view("facilities_v");
	}

	/* view facilities Statistics & details */
	public function view_facility_details() {
		$this->load->view("view_facilities_v");
	}

	/* Load the edit facilities view */
	public function edit_facilities(){
		$this->load->view("edit_facilities_v");
	}

	/* Load the new facilities view */
	public function newFacility(){
		$this->load->view("new_facility_v");
	}

}
