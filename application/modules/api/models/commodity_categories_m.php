<?php

class commodity_categories_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id=NULL){

		$categories_res = R::getAll("CALL `proc_get_commodity_categories`('$id')");

		if($id==NULL){

			return $categories_res;	

		}else{

			return $categories_res[0];	
		}

	}

	public function update($id){

	}

	public function remove($id){

	}

}