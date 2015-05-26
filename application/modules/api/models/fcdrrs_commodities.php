<?php

class fcdrrs_commodities extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id=NULL){		

		$fcdrr = R::getAll("CALL `proc_get_fcdrr_commodities`('$id')");
		
		if($id==NULL){

			return $fcdrr;	

		}else{

			return $fcdrr[0];	
		}

	}

	public function update($id){


		$fcdrr = R::getAll("UPDATE `fcdrr_commodities` 
								SET `name`='$name', 
								SET `name`='$name', 
								SET `name`='$name', 
								SET `name`='$name', 
								SET `name`='$name', 
								SET `name`='$name', 
								SET `name`='$name', 
								SET `name`='$name', 
								SET `name`='$name', 
								SET `name`='$name', 

								");
		
		if($id==NULL){

			return $fcdrr;	

		}else{

			return $fcdrr[0];	
		}

	}

	public function remove($id){

	}

}