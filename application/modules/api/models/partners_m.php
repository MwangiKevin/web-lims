<?php

class partners_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id=NULL){
		$sub_couties_res = R::getAll("CALL proc_get_partner_details('$id')");
				
			return $sub_couties_res;	
		
	}

	public function update($id){

	}

	public function remove($id){

	}

}