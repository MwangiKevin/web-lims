<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

class  MY_Controller  extends  MX_Controller {

	public $view_data;
	
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Africa/Nairobi');
		
		$this->load->module('filters');
	}

	public function head_template(){
		$this->load->view("tmpl_head_v");
	}

	public function navbar(){
		$this->load->view("navbar_v");
	}
	public function filter(){
		$this->load->view("filters/filter_view");
	}
	public function footer(){
		$this->load->view("tmpl_footer_v");
	}
	public function logout(){
		
	}

}


