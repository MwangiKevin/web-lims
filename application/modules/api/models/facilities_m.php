<?php

class facilities_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id){

		$facilities_res = R::getAll("CALL `proc_get_facilities`('$id')");
		
		if($id==NULL){

			return $facilities_res;	

		}else{

			return $facilities_res[0];	
		}
	}

	public function update($id){

	}

	public function remove($id){

	}

}