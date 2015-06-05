<?php
if (!defined('BASEPATH')) exit('No direct script access alllowed.');

/**
* 
*/
class presto_uploads extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('presto_uploads_view');
	}

	function upload_presto_csv()
	{
		if (isset($_FILES)) {
			$file = $_FILES['upload'];//has all info about uploaded files  
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

					while (($data = fgetcsv($handle, 0, ",")) !== FALSE) { //gets the data, separated with comma
						$new_array[] = $data;
					}

					$number_of_elements = count($new_array);
					$top_array = array_slice($new_array, 0, 10);
					$bottom_array = array_slice($new_array, 11);

					// echo "<pre>";print_r($top_array);
					// echo "<br/><br><pre>";print_r($bottom_array);die;

					foreach ($bottom_array as $key => $value) {
						if ($value[0] == 'Run ID') {
							$column_keys[] = $key;
							foreach ($value as $k => $v) {
								if ($v !== '') {
									$column_title[$key][] = $v;
								}
							}
						}
					}

					// echo "<pre>";print_r($column_keys);
					// echo end($column_keys);die;
					$tables = array();
					$counter = 0;
					foreach ($column_keys as $key => $column_key) {
						foreach ($bottom_array as $k => $val) {
							if(($column_keys[$counter] < $k) && ($column_keys[$counter + 1] > $k) && ($k < end($column_keys)))
							{
								if(!in_array($k, $column_keys)){
									$inner_counter = 0;
									foreach ($val as $vk => $v) {
										if($inner_counter < count($column_title[$column_key])){
											$data[$counter][$k][$column_title[$column_key][$inner_counter]] = $v; 
											$inner_counter++;
										}
									}
								}
							}
							else if($k > end($column_keys)){
								if(!in_array($k, $column_keys)){
									$inner_counter = 0;
									foreach ($val as $vk => $v) {
										if($inner_counter < count($column_title[$column_key])){
											$data[$counter][$k][$column_title[$column_key][$inner_counter]] = $v; 
											$inner_counter++;
										}
									}
								}
							}
						}

					$counter++;
					}
					echo "<pre>";print_r($data);die;
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