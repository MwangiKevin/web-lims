<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class admin extends MY_Controller {

	public function index(){

		$this->load->view("partners_v");

	}

	function editPartner(){

		$this->load->view('editPartner_v');
	}

	
}