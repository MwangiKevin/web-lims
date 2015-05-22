<?php
if(!defined("BASEPATH")) exit("No direct access to script allowed");

/**
* This script has functions used to upload test data from .csv files from Presto devices into the database
*/
class presto_uploads extends MY_Controller
{
	private $filename_entry;
	private $filename_date;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('');

		
	}

	function index()
	{
		$this->load->view('presto_uploads_view');

	}
}
?>