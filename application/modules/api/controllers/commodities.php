<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class commodities extends MY_Controller {	

	function __construct() {

		parent::__construct();
	}

	public function index($id=NULL) {
		$method = $this->_detect_method();

		if ($method=="post"){
			$this->create();
		}

		else if($method=="get"){
			$this->read();
		}

		else if ($method=="put"){
			$this->update($id);
		}

		else if ($method=="delete"){
			$this->remove($id);
		}
	}

	private function create(){

	}

	private function read(){

	}

	private function update($id){

	}

	private function remove($id){

	}
}
