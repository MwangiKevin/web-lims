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

        if(in_array($file_ext, $allowed)){
		//Import uploaded file to Database

			$handle = fopen($file_tmp, "r");

			while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
				$new_array[] = $data;
		    }

			    // echo "<pre>";print_r($new_array); die();

				$header_one = Array('Run ID','Run Date/Time','Operator','Normal count','Low count',
					'Passed?','Error Codes','','','','','','','','','','');

				$header_two = Array('Run ID','Run Date/Time','Operator','Reagent Lot ID','Reagent Lot Exp','Process Lot ID',
					'Process Lot Exp','Level','Exp CD4 (Lwr)','Exp CD4 (Upr)','Exp %CD4 (Lwr)','Exp %CD4 (Upr)','Reagent QC P/F','CD4','%CD4','Passed?','Error Codes');

				$header_three = Array('Run ID','Run Date/Time','Operator','Reagent Lot ID','Reagent Lot Exp','Process Lot ID',
					'Process Lot Exp','Level','Exp Hb (Lwr)','Exp Hb (Upr)','Reagent QC P/F','Hb (g/dL)','Passed?','Error Codes','','',''	);

				$header_four = Array('Run ID','Run Date/Time','Operator','Reagent Lot ID','Reagent Lot Exp','Patient ID',
					'Inst QC Passed?','Reagent QC Passed?','CD4','%CD4','Hb','Error Codes','','','','','');

				// echo array_search ($header_one,$new_array);

				for ($i=0; $i <4 ; $i++) { 

					if (i==0) {
						$array_to_search = $header_one;
					}
					echo array_search ($array_to_search,$new_array);

					die();
				}

			    die();
		}
	}

}


?>