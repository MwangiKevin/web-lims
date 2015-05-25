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
		$this->load->model('presto_uploads_model');
	}

	function index()
	{
		$this->load->view('presto_uploads_view');

	}

// .CSV upload script

	function upload_presto_csv()
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

        //allowed presto file types
        $allowed = array('csv', 'CSV');

        //csv type (CD4/BEADS/UNKNOWN etc.)
        $file_type_array = explode("(", $file_name);
        $file_type_array = explode(").", end($file_type_array));
        $file_type = current($file_type_array);

	}


}


?>