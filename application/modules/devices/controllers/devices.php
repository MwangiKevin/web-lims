<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class devices extends MY_Controller {

	public $login_status = false;

	function __construct() {
		parent::__construct();		
	}

	public function index() {
		$this->load->view("devices_v");
	}

	public function device_uploads() {
		$this->load->view("uploads_v");
	}

	/* Load the new device view */
	public function new_CD4_device(){

		$this->load->view('new_facility_device_v');
	}

	/* Load the edit device view */
	public function editFacilityDevices(){

		$this->load->view('editFacilityDevices_v',$data);
	}

}