<?php

class counties_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id){
		$couties_res = R::getAll("CALL proc_get_county_details()");

		return $couties_res;
	}

	public function update($id){

	}

	public function remove($id){

	}

}