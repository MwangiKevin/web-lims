<?php

class counties_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id=NULL){
		$couties_res = R::getAll("CALL proc_get_county_details('$id')");

		if($id==NULL){

			return $couties_res;	

		}else{

			return $couties_res;	
		}
	}

	public function update($id){
		$name = $this->input->put('name');
		$county = R::getAll("UPDATE `county` 
								SET `name`='$name'
								WHERE `id` = '$id'
								");
		return $county;
	}

	public function remove($id){

	}

}