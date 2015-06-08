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

				$header_one = Array('Run ID','Run Date/Time','Operator','Normal count','Low count',
					'Passed?','Error Codes','','','','','','','','','','');

				$header_two = Array('Run ID','Run Date/Time','Operator','Reagent Lot ID','Reagent Lot Exp','Process Lot ID',
					'Process Lot Exp','Level','Exp CD4 (Lwr)','Exp CD4 (Upr)','Exp %CD4 (Lwr)','Exp %CD4 (Upr)','Reagent QC P/F','CD4','%CD4','Passed?','Error Codes');

				$header_three = Array('Run ID','Run Date/Time','Operator','Reagent Lot ID','Reagent Lot Exp','Process Lot ID',
					'Process Lot Exp','Level','Exp Hb (Lwr)','Exp Hb (Upr)','Reagent QC P/F','Hb (g/dL)','Passed?','Error Codes','','',''	);

				$header_four = Array('Run ID','Run Date/Time','Operator','Reagent Lot ID','Reagent Lot Exp','Patient ID',
					'Inst QC Passed?','Reagent QC Passed?','CD4','%CD4','Hb','Error Codes','','','','','');

				$cleaned_header_one = Array('run_id','run_date_time','operator','normal_count','low_count',
					'passed','error_codes', 'serial_number');


				for ($i=0; $i <4 ; $i++) {

					if ($i==0) {
						$array_to_search = $header_one;
					}
					elseif ($i==1) {
						$array_to_search = $header_two;
					}
					elseif ($i==2) {
						$array_to_search = $header_three;
					}
					elseif ($i==3) {
						$array_to_search = $header_four;
					}

					echo $controls_start = array_search($header_one,$new_array) +1;
					echo $controls_end = $controls_start -(array_search($header_two,$new_array) -2);
					$header =  array_slice($new_array, 0, $controls_start);
					foreach ($header as $key => $value) {
						//loop through the inner array of header as $value
						foreach ($value as $k => $v) {
							if ($v == 'Instrument serial no:') {
								$serial_key = $key;
								$serial_number_key = $k + 1;
							}
						}
						
					}

					$controls_arr = array_slice($new_array,$controls_start, $controls_end);
					$counter = 0;
					foreach ($controls_arr as $control_arr) {
						foreach ($control_arr as $key => $value) {
							$number = $key+1;
							if($number <= count($cleaned_header_one)){
								if($cleaned_header_one[$key] !== 'serial_number'){
									$insert_one[$counter][$cleaned_header_one[$key]] = $value;
								}
								else{
									$insert_one[$counter][$cleaned_header_one[$key]] = $header[$serial_key][$serial_number_key];
								}
							}
						}
						$counter++;
					}
				}
				
				$query = $this->db->insert_batch('presto_cd4_controls', $insert_one);

		}



	}

}


?>