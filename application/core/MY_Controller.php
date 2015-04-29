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

	protected function _detect_method() {
		$method = strtolower($this->input->server('REQUEST_METHOD'));

		if ($this->config->item('enable_emulate_request')) {
			if ($this->input->post('_method')) {
				$method = strtolower($this->input->post('_method'));
			} else if ($this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE')) {
				$method = strtolower($this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE'));
			}      
		}

		if (in_array($method, array('get', 'delete', 'post', 'put'))) {
			return $method;
		}

		return 'get';
	}

	function GetMonthName($month)
{
	$monthname="";

	 if ($month==1)
	 {
	     $monthname="January";
	 }
	  else if ($month==2)
	 {
	 	$monthname="February";
	 }else if ($month==3)
	 {
	     $monthname="March";
	 }else if ($month==4)
	 {
	     $monthname="April";
	 }else if ($month==5)
	 {
	     $monthname="May";
	 }else if ($month==6)
	 {
	     $monthname="June";
	 }else if ($month==7)
	 {
	     $monthname="July";
	 }else if ($month==8)
	 {
	     $monthname="August";
	 }else if ($month==9)
	 {
	     $monthname="September";
	 }else if ($month==10)
	 {
	     $monthname="October";
	 }else if ($month==11)
	 {
	     $monthname="November";
	 }
	  else if ($month==12)
	 {
	     $monthname="December";
	 }
	  else if ($month==13)
	 {
	     $monthname=" Jan - Sep  ";
	 }
	return $monthname;
}

	

}


