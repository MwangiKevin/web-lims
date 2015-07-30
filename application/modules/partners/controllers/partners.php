<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class partners extends MY_Controller{

	/* view all partners */
	public function index(){

		$this->load->view("partners_v");

	}

	/* edit partner view*/
	public function editPartner(){

		$this->load->view('editPartner_v');
	}
	/* new partner view */
	public function newPartner(){

		$this->load->view('new_partner_v');
	}

	/* partner statistics */
	public function viewPartner(){

		$this->load->view('view_partner_v');
	}
}


?>