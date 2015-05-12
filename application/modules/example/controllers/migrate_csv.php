<?php
if (!defined('BASEPATH')) exit('No direct script access allowed.');

/**
* 
*/
class Migrate_csv extends MY_Controller
{
	
	function __construct()
	{
		parent:: __construct();
	}

	public function index()
	{
		$this->load->view('migrate_csv');
	}

	function uploadcsv()
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

            //getting file name and the extension.
            $file_type_array = explode("(", $file_name);
	        $file_type_array = explode(").", end($file_type_array));
	        $file_type = current($file_type_array);

	       	$allowed = array('csv', 'CSV');//allowed file types

	       	if(in_array($file_ext, $allowed)){
				//Import uploaded file to Database
				$handle = fopen($file_tmp, "r");
					
					while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
						$new_array[] = $data;
						
					}

					$counter = 0;
					$emptyEmailcnt = 0;
					$emailcnt = 0;
					
					foreach ($new_array as $key => $value) {
						 if($value[1] == NULL){
						 	$emptyEmailcnt++;
						 } else {
						 	$insert_data[] = $value;
						 	$emailcnt++;
						 }
					}
				    echo "<pre>";print_r($insert_data);
				    echo $emailcnt." users have provided email addresses ".$emptyEmailcnt." users have not provided email addresses.";
				    die();
				
				fclose($handle);
				print "Import successful";
				
			}else{
				echo "Invalid File type";
                die;
			}
		} else {
			echo "No csv file selected";
		}
		
	}
}
?>