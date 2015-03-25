<?php

class sub_counties_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id=NULL){

		$sub_couties_res = R::getAll("CALL proc_get_sub_county_details('$id')");
		
		if($id==NULL){

			return $sub_couties_res;	

		}else{

			return $sub_couties_res;	
		}

	}

	public function update($id){

	}

	public function remove($id){

	}

}