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

	protected function check_login_status(){
		$this->load->library("Aauth");	

	}
	

}


