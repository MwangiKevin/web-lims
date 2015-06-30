<?php
if(!defined("BASEPATH")) exit("No direct access to script allowed");

/**
* This script has functions used to upload data from .exp files from facs_calibur devices into the database
*/
class facs_calibur extends MY_Controller
{
	private $filename_entry;
	private $filename_date;
	
	function __construct()
	{
		parent:: __construct();
	}

	function index()
	{
		$this->load->view('facs_calibur_view');

	}

// .exp upload script
	function upload_facs_calibur_exp()
	{

	}
}