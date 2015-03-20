<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class api extends MY_Controller {	

	function __construct() {

		parent::__construct();
		
		header('Content-Type: application/json; charset=utf-8');
	}
	public function index(){
		echo "null";
	}

	public function facilities($id=NULL) {

		$this->load->model("facilities_m");	

		$method= $this->_detect_method();

		if ($method=="post"){
			echo json_encode($this->facilities_m->create(),JSON_PRETTY_PRINT);
		}

		else if($method=="get"){
			echo json_encode($this->facilities_m->read($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="put"){
			echo json_encode($this->facilities_m->update($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="delete"){
			echo json_encode($this->facilities_m->remove($id),JSON_PRETTY_PRINT);
		}
	}

	public function sub_counties($id=NULL) {

		$this->load->model("sub_counties_m");	

		$method= $this->_detect_method();

		if ($method=="post"){
			echo json_encode($this->sub_counties_m->create(),JSON_PRETTY_PRINT);
		}

		else if($method=="get"){
			echo json_encode($this->sub_counties_m->read($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="put"){
			echo json_encode($this->sub_counties_m->update($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="delete"){
			echo json_encode($this->sub_counties_m->remove($id),JSON_PRETTY_PRINT);
		}
	}

	public function counties($id=NULL) {

		$this->load->model("counties_m");	

		$method = $this->_detect_method();

		if ($method=="post"){
			echo json_encode($this->counties_m->create(),JSON_PRETTY_PRINT);
		}

		else if($method=="get"){
			echo json_encode($this->counties_m->read($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="put"){
			echo json_encode($this->counties_m->update($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="delete"){
			echo json_encode($this->counties_m->remove($id),JSON_PRETTY_PRINT);
		}
	}

	public function partners($id=NULL) {

		$this->load->model("partners_m");	

		$method = $this->_detect_method();

		if ($method=="post"){
			echo json_encode($this->partners_m->create(),JSON_PRETTY_PRINT);
		}

		else if($method=="get"){
			echo json_encode($this->partners_m->read($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="put"){
			echo json_encode($this->partners_m->update($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="delete"){
			echo json_encode($this->partners_m->remove($id),JSON_PRETTY_PRINT);
		}
	}

	public function commodities($id=NULL) {

		$this->load->model("commodities_m");	

		$method = $this->_detect_method();

		if ($method=="post"){
			echo json_encode($this->commodities_m->create(),JSON_PRETTY_PRINT);
		}

		else if($method=="get"){
			echo json_encode($this->commodities_m->read($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="put"){
			echo json_encode($this->commodities_m->update($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="delete"){
			echo json_encode($this->commodities_m->remove($id),JSON_PRETTY_PRINT);
		}
	}

	public function commodity_categories($id=NULL) {

		$this->load->model("commodity_categories_m");	

		$method = $this->_detect_method();

		if ($method=="post"){
			echo json_encode($this->commodity_categories_m->create(),JSON_PRETTY_PRINT);
		}

		else if($method=="get"){
			echo json_encode($this->commodity_categories_m->read($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="put"){
			echo json_encode($this->commodity_categories_m->update($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="delete"){
			echo json_encode($this->commodity_categories_m->remove($id),JSON_PRETTY_PRINT);
		}
	}

	public function fcdrrs($id=NULL) {

		$this->load->model("fcdrrs_m");	

		$method = $this->_detect_method();

		if ($method=="post"){
			echo json_encode($this->fcdrrs_m->create(),JSON_PRETTY_PRINT);
		}

		else if($method=="get"){
			echo json_encode($this->fcdrrs_m->read($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="put"){
			echo json_encode($this->fcdrrs_m->update($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="delete"){
			echo json_encode($this->fcdrrs_m->remove($id),JSON_PRETTY_PRINT);
		}
	}

	public function facility_devices($id=NULL) {

		$this->load->model("facility_devices_m");	

		$method = $this->_detect_method();

		if ($method=="post"){
			echo json_encode($this->facility_devices_m->create(),JSON_PRETTY_PRINT);
		}

		else if($method=="get"){
			echo json_encode($this->facility_devices_m->read($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="put"){
			echo json_encode($this->facility_devices_m->update($id),JSON_PRETTY_PRINT);
		}

		else if ($method=="delete"){
			echo json_encode($this->facility_devices_m->remove($id),JSON_PRETTY_PRINT);
		}
	}
}
