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

	function upload_csv_file()
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

	function upload_exp_file()
	{
		if(isset($_FILES))
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

            //csv type (CD4/BEADS/UNKNOWN etc.)
            $file_type_array = explode("(", $file_name);
	        $file_type_array = explode(").", end($file_type_array));
	        $file_type = current($file_type_array);
			
			$allowed = array('exp', 'EXP');//allowed file types
			if (in_array($file_ext, $allowed)) {
				
			} else {
				print "Please select an exp file format";
			}
			
		}else{
			print "No file has been selected";
		}
	}

	function upload_exp()
	{
		echo "<pre>";print_r($_FILES);

		$file1 = $_FILES[upload]['tmp_name'];
		$filename = $_FILES[upload]['name'];
	 	$file_ext = explode(".", $filename);
        $file_ext = current($file_ext);
        $new_ext = $file_ext.".csv";

		echo $new_ext;
		$file_dir = $file1;
		$excelReader = PHPExcel_IOFactory::createReader('Excel2007');
			$excelReader -> setReadDataOnly(true);
			$objPHPExcel = PHPExcel_IOFactory::load($file_dir);

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
			$objWriter -> save($new_ext);
		echo $file_dir;die();


		
	}

	function upload_exp_failed_one()
	{
		$file = fopen($file1, "r") or exit("Unable to open file!");

		while(!feof($file)){
		    
		    if($test==0){
		        $data=fgets($file);
		        // echo $data;die;
		        $data_array=explode("\t",$data);
		        $exlpoded = explode("\n", $data_array[277]);
		        echo mb_detect_encoding($data_array[277]);
		        //echo "<pre>";print_r($exlpoded);die();


			// Instantiate a new PHPExcel object
			$objPHPExcel = new PHPExcel(); 
			// Set the active Excel worksheet to sheet 0
			$objPHPExcel->setActiveSheetIndex(0); 
			// Initialise the Excel row number
			$rowCount = 1; 
			// Iterate through each result from the SQL query in turn
			// We fetch each database result row into $row in turn
			while($data_array){ 
			    // Set cell An to the "name" column from the database (assuming you have a column called name)
			    //    where n is the Excel row number (ie cell A1 in the first row)
			    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['name']); 
			    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
			    //    where n is the Excel row number (ie cell A1 in the first row)
			    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['age']); 
			    // Increment the Excel row counter
			    $rowCount++; 
			} 

			// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
			// Write the Excel file to filename some_excel_file.xlsx in the current directory
			$objWriter->save('some_excel_file.xlsx'); 

		       echo $data; die();
		        $objPHPExcel = new PHPExcel();
		        //Set properties
		        $objPHPExcel->getProperties()->setCreator("ThinkPHP")
		        			->setLastModifiedBy("web-lims")
		        			->setTitle("Office 2013 XLSX Test Document")
		        			->setSubject("Office 2013 XLSX Test Document")
		        			->setDescription("Test doc for Office 2013 XLSX, generated by PHPExcel.")
		        			->setKeywords("office 2013 openxml php")
		        			->setCategory("Test Result file");
		        $objPHPExcel->getActiveSheet()->setTitle('Minimalistic demo');
		        $objPHPExcel->setActiveSheetIndex(0)
		        			->setCellValue('A1', 'Hello')
		        			->setCellValue('B1', 'world!');

		       	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		       	$objWriter->save('MyExcel.xslx');
		        // setCellValueByColumnAndRow($column, $row, $data);

				echo $data;die;


				// echo"<pre>";print_r($data);die;
				$data_array=explode("\t",$data);

						  $temp_str=trim(str_replace("\"","",$data_array[13]));
		  $temp_str=date('Y-m-d',strtotime($temp_str));
	
          echo"
		<div style='margin-top:0px;'><table class='data-table' style='width:40%'>
		<thead>
        <tr><th colspan='1'>".$data_array[0]."</th>
        <th colspan='1'>".$data_array[1]."</th>
        <th colspan='1'>".$data_array[2]."</th>
        <th colspan='1'>".$data_array[3]."</th>
        <th colspan='1'>".$data_array[4]."</th>
        <th colspan='1'>".$data_array[5]."</th>
        <th colspan='1'>".$data_array[6]."</th>
        <th colspan='1'>".$data_array[7]."</th>
        <th colspan='1'>".$data_array[8]."</th>
        <th colspan='1'>".$data_array[9]."</th>
        <th colspan='1'>".$data_array[10]."</th>
        <th colspan='1'>".$data_array[11]."</th>
        <th colspan='1'>".$data_array[12]."</th>
		<th colspan='1'>".$data_array[13]."</th>
		<th colspan='1'>".$data_array[14]."</th>
		<th colspan='1'>".$data_array[15]."</th>
		<th colspan='1'>".$data_array[16]."</th>
		<th colspan='1'>".$data_array[17]."</th>
		<th colspan='1'>".$data_array[18]."</th>
		<th colspan='1'>".$data_array[19]."</th>
		<th colspan='1'>".$data_array[20]."</th>
		<th colspan='1'>".$data_array[21]."</th>
		<th colspan='1'>".$data_array[22]."</th>
		<th colspan='1'>".$data_array[23]."</th>
		<th colspan='1'>".$data_array[24]."</th>";
		
		if(count($data_array)>24){
		
		 $data1=str_split($data_array[25],31);
		echo "<th colspan='1'>".$data1[0]."</th></tr>
		</thead>
		<tbody>
		";	
		}
		else{
		
		
		echo "<th colspan='1'>".$data_array[25]."</th></tr>
		</thead>
		<tbody>
		";		
		}
				

          		echo "<pre>"; print_r($data_array);die();
			} else{
			}
		  $test++;
		}

		fclose($file);
    }
}
?>