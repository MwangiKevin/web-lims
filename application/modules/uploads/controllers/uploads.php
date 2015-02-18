<?php
if(!defined("BASEPATH")) exit("No direct access to script allowed");

/**
* 
*/
class uploads extends MY_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('uploads_model');
	}

	function index()
	{
		$this->load->view('uploads_view');

	}

	function upload_file()
	{
		if (isset($_FILES)) {
			$file = $_FILES[upload];//has all info about uploaded files            
            //file properties
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            //file extension
            $file_ext = explode(".", $file_name);
            $file_ext = end($file_ext);

            //csv type (CD4/BEADS/UNKNOWN etc.)
            $file_type_array = explode("(", $file_name);
	        $file_type_array = explode(").", end($file_type_array));
	        $file_type = current($file_type_array);
			
			$allowed = array('csv', 'CSV');//allowed file types

			if(in_array($file_ext, $allowed)){
				//Import uploaded file to Database
				$handle = fopen($file_tmp, "r");

					while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
						$new_array[] = $data;
						$new_data = array();
											
				    }
				    $cols = array();
				    $insert_data = array();
				    $counter = 0;
			    	foreach ($new_array as $key => $value) {
						if ($key == 0) {
							foreach ($value as $k => $v) {
								if (($v != 'Result Date')&&($v != 'Start Time')) {
									if ($v == 'CD3+CD4+ Value [cells/mm3]') {
										$v = '`cd3+cd4+value(cell/mm3)`';
									}
									elseif ($v == 'ErrorMessage') {
										$v = '`error_message`';
									}
									else
									{
										$v = strtolower(str_replace(" ", "_", $v));
									}
									
								}
								else {
									$v = 'result_date';
								}
								$cols[] = $v;
								
							}
						}
						else
						{
							foreach ($value as $k => $v) {
								if (($k == 8)||($k==9)) {
									$v = $value[8] . ' ' . $value[9];
									$v = date('Y-m-d h:i:s', strtotime($v));
								}
								$insert_data[$counter][$cols[$k]] = $v;
							}
							$counter++;
						}
						
					}
					// $c=0;
					// foreach ($insert_data as $key => $value) {
					// 	if (($key != 'result_date')||($key != 'start_time')) {
					// 		$insert_data[$c][$key]= $value;
					// 	}

					// 	// $result_date = $insert_data[$c]
					// }
					// echo "<pre>";print_r($insert_data);
					// foreach ($new_array as $key => $value) {
					// 	# code...
					// }
					// die();
				    $this->db->insert_batch('pima_export_data', $insert_data);

				fclose($handle);
				print "Import successful";
				
			}else{
				echo "Invalid File type";
                die;
			}
			
		} else {
			echo "No file selected";
            die;
		}
		
	}
}

?>