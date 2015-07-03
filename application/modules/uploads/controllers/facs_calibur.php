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
		$this->load->library('excel');
	}

	function index()
	{
		$this->load->view('facs_calibur_view');

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

        //allowed exp file types
        $allowed = array('exp', 'EXP');

        $file_type_array = explode("(", $file_name);
        $file_type_array = explode(").", end($file_type_array));
        $file_type = current($file_type_array);

        if(in_array($file_ext, $allowed)){
		// Import uploaded file to Database

				// get the files creation date and save it in an array
				$file_date_time = date ("Y-m-d H:i:s", filemtime($file_tmp));


				//read file from path
				$objPHPExcel = PHPExcel_IOFactory::load($file_name);die;
				//get only the Cell Collection
				/*$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
				//extract to a PHP readable array format
				foreach ($cell_collection as $cell) {
				    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
				    //header will/should be in row 1 only. of course this can be modified to suit your need.
				    if ($row == 1) {
				        $header[$row][$column] = $data_value;
				    } else {
				        $arr_data[$row][$column] = $data_value;
				    }
				}
				//send the data in an array format
				$data['header'] = $header;
				$data['values'] = $arr_data;

				echo "<pre>";
				print_r($arr_data); die();*/

		}

	}
}