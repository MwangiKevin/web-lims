<?php
if(!defined("BASEPATH")) exit("No direct access to script allowed");

/**
* This script has functions used to upload data from .exp files from facs_calibur devices into the database
*/
class facs_calibur_uploads extends MY_Controller
{
	private $filename_entry;
	private $filename_date;
	
	function __construct()
	{
		parent:: __construct();
	}

	function index()
	{
		$this->load->view('facs_calibur_uploads_view');

	}

// .exp upload script

	function upload_facs_calibur_exp()
	{
		$file = $_FILES[upload];//has all info about uploaded files  
		//file properties
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        //file extension
        $file_ext = explode(".", $file_name);
        $file_ext = end($file_ext);

        //allowed facs calibur file types
        $allowed = array('exp', 'EXP');

        //exp type (CD4/BEADS/UNKNOWN etc.)
        $file_type_array = explode("(", $file_name);
        $file_type_array = explode(").", end($file_type_array));
        $file_type = current($file_type_array);

        if(in_array($file_ext, $allowed)){
		//Import uploaded file to Database

			$handle = fopen($file_tmp, "r");