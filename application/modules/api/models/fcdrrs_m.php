<?php

class fcdrrs_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id=null){		

		$fcdrr = R::getAll("CALL `proc_get_fcdrrs`('$id')");
		
		if($id==NULL){

			return $fcdrr;	

		}else{

			return $fcdrr[0];	
		}

	}

	public function update($id){

	}

	public function remove($id){

	}

}