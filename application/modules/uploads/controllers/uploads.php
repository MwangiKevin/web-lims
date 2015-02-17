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
			
			// echo "<pre>";print_r($file_type);die();
	                    
			$allowed = array('csv', 'CSV');//allowed file types

			if(in_array($file_ext, $allowed)){
				//Import uploaded file to Database
				$handle = fopen($file_tmp, "r");

					while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
						$new_array[] = $data;

						// if ($file_type == "PIMA_DEV") {
						// 	// $insert = $this->uploads_model->import_pima_dev($data);
						// 	$sql = "INSERT INTO
						// 				`pima_export_data`
						// 		(`test_id`,`device_id`,`assay_id`,`export_error_message`)
						// 		VALUES
						// 			('$data[0]','$data[1]','$data[2]','$data[3]')";

						// 	// $result = $this->db->query($sql);
						// } else if ($file_type == "PIMA_BEADS") {
						// 	// $insert = $this->uploads_model->import_pima_beads($data);
						// 	$sql = "INSERT INTO
						// 					`pima_export_data`
						// 			(`test_id`,`device_id`,`assay_id`,`assay_name`,`sample`,`cd3+cd4+value(cell/mm3)`,`error_message`,`operator`,`result_date`,`barcode`,`expiry_date`,`device`,`software_version`)
						// 			VALUES
						// 				('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8] $data[9]','$data[10]','$data[11]','$data[12]','$data[13]')";

						// 	// $result = $this->db->query($sql);
						// } else if ($file_type == "PIMA_CD4") {
						// 	// $insert = $this->uploads_model->import_pima_cd4($data);
						// 	$sql = "INSERT INTO
						// 					`pima_export_data`
						// 			(`test_id`,`device_id`,`assay_id`,`assay_name`,`sample`,`cd3+cd4+value(cell/mm3)`,`error_message`,`operator`,`result_date`,`barcode`,`expiry_date`,`volume`,`device`,`reagent`,`software_version`)
						// 			VALUES
						// 				('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8] $data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]')";

						// 	// $result = $this->db->query($sql);
						// } else if ($file_type == "Unknown") {
						// 	// $insert = $this->uploads_model->import_unknown($data);
						// 	$sql = "INSERT INTO
						// 					`pima_export_data`
						// 			(`test_id`,`device_id`,`assay_id`,`assay_name`,`sample`,`cd3+cd4+value(cell/mm3)`,`error_message`,`operator`,`result_date`,`barcode`,`expiry_date`,`device`,`software_version`)
						// 			VALUES
						// 				('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8] $data[9]','$data[10]','$data[11]','$data[12]','$data[13]')";

						// 	// $result = $this->db->query($sql);
						// } else {
						// 	print "File type cannot be processed";
						// }
						// reset($file_type_array);

						// if (!$result) {
						// 	print "Import failed";
						// 	echo "<br />";
							
						//  }
						//  else {
						// 	print "Import successful";
						// 	echo "<br />";
						// }
				    }
				    echo"<pre>";print_r($new_array);die();

				fclose($handle);

				
			}else{
				echo "Invalid File type";
                die;
			}
			
			echo "<pre>";print_r($file);die();
		} else {
			echo "No file selected";
            die;
		}
		
	}
}

?>