<?php

class commodity_categories_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read(){

		$reporting_status = 0;

		if($this->input->get('reporting') && $this->input->get('reporting')!='false'){

			$reporting_status = 1;
		}

		$result = R::getAll("CALL proc_get_commodities($reporting_status)");
		return $result;	

	}

	public function update($id){

	}

	public function remove($id){

	}

}