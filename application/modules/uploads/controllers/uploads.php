<?php
if(!defined("BASEPATH")) exit("No direct access to script allowed");

/**
* This script has several functions used to upload test data from .csv files from PIMA devices into the database
*/
class uploads extends MY_Controller
{
	private $filename_entry;
	private $filename_date;
	
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

					while (($data = fgetcsv($handle, 0, ",")) !== FALSE) { //gets the data, separated with comma
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
									if ($v == 'CD3+CD4+ Value [cells/mm3]') { // searching for the strings
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
				    $this->db->insert_batch('pima_export_data', $insert_data); //used to insert the data

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

    public function read_csv($file_dir){
		$row = 0;
		$sheet_data = array();
		$formatted_csv	=	array();

		if (($handle = fopen("$file_dir", "r")) !== FALSE) {
			while (($row_data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$sheet_data[$row]=$row_data;
				$row++;
			}			
			fclose($handle);
			if(count($sheet_data)>0){

				$keys = $sheet_data[0];
				$data = array();

				for($i=1;$i<sizeof($sheet_data);$i++){
					for($j=0;$j<sizeof($keys);$j++){
						if(isset( $sheet_data[$i][$j])){
							$data[$i][$keys[$j]] = str_replace("'","",$sheet_data[$i][$j]);
						}else{
							$data[$i][$keys[$j]] =	"";
						}
					}
				}

				$formatted_csv["data"] = $data; 
				$formatted_csv["title"] = $keys; 
			}

			//$arr["sheet_data"] 	= $this 	-> 	makeTable($formatted_csv);
			$arr["upload_data"] = $this		->	format_upload_data($data);


			return $arr;
		}else{

			return null;
		}	

	}

    public function server_upload(){

		//get last upload id

		$upl = R::getAll("SELECT MAX(id) AS max FROM `pima_upload`");

		$last_upl = 0;

		if($upl[0]["max"]){
			$last_upl = (int) $upl[0]["max"];
		}else{
			$last_upl = 0;
		}

		// set folder paths to fetch files and move them once test data has been uploaded

		$root_folder 		= $this->config->item("pima_export");
		$uploaded_folder 	= $this->config->item("pima_uploaded");

		$files_to_move = array();

		$i=0;

		if ($handle = opendir($root_folder)){
		    while (false !== ($entry = readdir($handle))) { // open root folder

		        if(substr($entry, -4)==".csv" && $entry!="."&& $entry!=".."){

		        	if($this-> server_upload_commit(realpath($root_folder."/".$entry),$entry) ){ //upload tests data from files in root folder

		        		// put files in array
		      			$files_to_move[$i]["source"] 		= 	$root_folder."/".$entry;	
					    $files_to_move[$i]["destination"]	= 	$uploaded_folder."/".$entry;

					    $i++;
					}
		        }
		    }
		    closedir($handle);
		}
		
		foreach ($files_to_move as $file) {

			rename($file["source"] 	,$file["destination"]); // moves files in array to different location           			
					             			 
		}
		$uploaded_new = false;

		//$this->load->model('uploads_model');

		//$view_data["upl_res"] = $this->uploads_model->get_Upload_details($last_upl);
		$view_data['view_data']="Okay";

		$this->load->view("server_uploaded_view",$view_data);
		
	}

	private function makeTable($data) {
		$tableTitle = "<thead>";
		$tableTitle .= '<tr>';
		foreach ($data['title'] as $title) {
			$tableTitle .= '<th width="100px">' . $title . '</th>';

		}
		$tableTitle .= '</tr>';
		$tableTitle .= '</thead>';

		$tableData = '<tbody>';

		$j = 0;
		foreach ($data['data'] as $key => $data) {
			$tableData .= '<tr>';
			foreach ($data as $dataKey => $dataVal) {
				$tableData .= '<td>' . $dataVal . '</td>';
			}
			$tableData .= '</tr>';

		}
		$tableData .= '</tbody>';

		$table = $tableTitle . $tableData;
		return $table;

	}

	private function format_upload_data($data){
		
		//print_r($data[1]);die;


		$titles=array_keys($data[1]);
		$titles_f=array();
		$data_f=array();

		foreach ($titles as $title) {
			$title=str_replace("/", "_", $title);
			$title=str_replace("]", "", $title);
			$title=str_replace("[", "", $title);
			$title=str_replace(" ", "_", $title);
			$title=str_replace("+", "_", $title);
			$title=str_replace("__", "_", $title);
			$title=str_replace("_cells_mm3", "", $title);
			$title=strtolower($title);
			$titles_f[]=$title;
		}
		$i=0;
		foreach ($data as $datum ) {
			$j=0;
			foreach ($titles as $title) {
				$new_title=$titles_f[$j];				
				$data_f[$i][$new_title]= $datum[$title];
				$j++;
			}
			if(isset($data_f[$i]['errormessage'])){
				$data_f[$i]['errormessage'] = filter_var($data_f[$i]['errormessage'], FILTER_SANITIZE_NUMBER_INT);
			}
			$i++;
		}		

		return $data_f;

	}

	public function server_upload_commit($file,$entry){

		//set file details
		$this->filename_entry=$entry;
		$this->filename_date=date("Y-m-d H:i:s", filemtime($file));

		$dt 	=	$this->read_csv($file); //validate file and return test data from file
		$data 	= 	$dt["upload_data"];

		$facility_pima_id_res[0]['facility_pima_id'] = 1;

		if(!isset($data[0]["assay_name"]) || $data[0]["assay_name"]==""){
			$this->error_file_upload($data); //upload errors
		}else if($data[0]["assay_name"]=="PIMA BEADS"){
			$this->control_file_upload($data); // upload control file data
		}else if($data[0]["assay_name"]=="PIMA CD4"){	
			$this->tests_file_upload($data);// upload tests
		}
		return $this->upload_status;
	}

	private function tests_file_upload($data){

		$data = $this->trim_uploaded_tests($data);

		if( sizeof($data) > 0){
			//fetch next autoincrement value from 
			$pim_raw_upl_st			=	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'pima_raw_upload'");
			$pim_upl_st				=	R::getAll(	"SHOW TABLE STATUS WHERE `Name` = 'pima_upload'");

			$pim_upl_raw_auto_id 		=	(int)	$pim_raw_upl_st[0]["Auto_increment"];
			$pima_upload_id 			=	(int)	$pim_upl_st[0]["Auto_increment"];

			$assay_type = $data[0]['assay_id'];

			$serial_number 			=	$data[0]['device_id'];
			$facility_pima_id_res 	=	R::getAll("SELECT id as facility_device_id,
														facility_id,
														device_id,
														serial_number
														from facility_device 
														where serial_number='$serial_number'  LIMIT 1");
			
			if(sizeof($facility_pima_id_res)>0) {

				//$facility_pima_id =$facility_pima_id_res[0]['facility_pima_id'];
				$facility_device_id =$facility_pima_id_res[0]['facility_device_id'];
				$facility_id =$facility_pima_id_res[0]['facility_id'];
				$error =	false;// initialize error

				$this->message = "<div class='success'>Upload Successful </div>";				
				$this->upload_status = true;

				// echo "IM here";

				$this->db->query("INSERT INTO `pima_upload`(`id`,`upload_date`,`facility_pima_id`,`uploaded_by`,`file_date`)
												VALUES
												('".$pima_upload_id."',
												 '".date("Y-m-d H:i:s")."',
												 '".$facility_device_id."',
												 '1',
												 '".$this->filename_date."')");

				// echo "IM here 2";

				
				foreach ($data as $row) {

					//initialize 
					$validity 	=	1;
					$pima_error_id 	=	"";
					$barcode		=	3;
					$expiry_date	=	3;
					$volume			=	3;
					$device 		=	3;
					$reagent		=	3;

					if($row["errormessage"]>0){//has an error
						
						if($row["errormessage"]>=300 && $row["errormessage"]<=399){
							$row["errormessage"]= "300-399";
						}

						$error_message =$row["errormessage"];
						$pima_error_res = R::getAll("SELECT `id` FROM `pima_error` WHERE `error_code`='$error_message' LIMIT 1");

						if(sizeof($pima_error_res)>0){
							$pima_error_id =	$pima_error_res[0]['id'];		
							$validity 	=	0;				
						}else{
							$error = true;//error exists
							$this->message = "<div class='error'>No success. The file has an error not recognized by the system: ".$row['errormessage']."</div>";
							$this->upload_status = false;
							$upload_success = false;
						}
					}else{
					}

					$barcode_res		=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['barcode']."' LIMIT 1");
					$expiry_date_res	=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['expiry_date']."' LIMIT 1");					
					$device_res			=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['device']."' LIMIT 1");
					if($assay_type==2){
						$volume_res			=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['volume']."' LIMIT 1");
						$reagent_res		=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['reagent']."' LIMIT 1");
					}

					error_reporting(1);

					$barcode			= 	$barcode_res[0]['id']		;
					$expiry_date		= 	$expiry_date_res[0]['id']	;					
					$device 			= 	$device_res[0]['id']		;
					if($assay_type==2){
						$volume				= 	$volume_res[0]['id']	;
						$reagent			= 	$reagent_res[0]['id']	;	
					}

					if( $assay_type	!=	3 ){
						try{
						$this->db->query("INSERT INTO `pima_raw_upload`
										(`id`,
										`pima_upload_id`,
										`device_test_id`,
										`device_serial`,
										`assay_id`,
										`assay_name`,
										`sample_code`,
										`error_message`,
										`operator`,
										`cd4_count`,
										`result_date`,
										`date`,
										`start_time`,
										`barcode`,
										`expiry_date`,
										`volume`,
										`device`,
										`reagent`,
										`software_version`,
										`export_error_message`,
										`valid_test`,
										`upload_file_name`,
										`file_date`) 
										VALUES
										('$pim_upl_raw_auto_id',
										 '".$pima_upload_id."',
										 '".$row['test_id']."',
										 '".$facility_pima_id_res[0]['serial_number']."',
										 '".$row['assay_id']."',
										 '".$row['assay_name']."',
										 '".$row['sample']."',
										 '".$error_message."',
										 '".$row['operator']."',
										 '".$row['cd3_cd4_value']."',
										 '".$row['result_date']." ".$row['start_time'].":00',
										 '".$row['result_date']."',
										 '".$row['start_time'].":00',
										 '$barcode',
										 '$expiry_date',
										 '$volume',
										 '$device',
										 '$reagent',
										 '".$row['software_version']."',
										 '".$error_message."',
										 '".$validity."',
										 '".$this->filename_entry."',
										 '".$this->filename_date."')");

					}catch (Exception $e){

					}

					}
					$validity=0;
					$error_message="";// unset any error message
					$pim_upl_raw_auto_id++;

					
				}

			}else{
				$facility_pima_id=	0;
				$this->message = "<div class='error'>This device is not recognized by the system</div>";
				$this->upload_status = false;
				$upload_success = false;
				$this->device_not_recognized($serial_number,1);
			}

		}else{
			$this->message = "<div class='notice'>No data Uploaded! <br/>It seems all of this data has already been uploaded or there is no data in the file.</div>";
				$this->upload_status = true;
		}

	}

	private function error_file_upload($data){

		$error_keys  	=	'
		[
			"test_id",
			"device_id",
			"assay_id",
			"assay_name",
			"sample",
			"cd3_cd4_value",
			"errormessage",
			"operator",
			"result_date",
			"start_time",
			"barcode",
			"expiry_date",
			"device",
			"software_version"
		]
		';

		$dev_keys 		=	'

		[
			"test_id",
			"device_id",			
			"assay_id",
			"export_error_message"
		]

		';

		$test_data = array();

		if(			array_keys($data[0] )	== 	json_decode($error_keys)	){
			foreach ($data as $key => $dt) {

				$test_data[$key]["test_id"]				=	$data[$key]["test_id"];
				$test_data[$key]["device_id"]			=	$data[$key]["device_id"];
				$test_data[$key]["assay_id"]			=	$data[$key]["assay_id"];
				$test_data[$key]["assay_name"]			=	$data[$key]["assay_name"];
				$test_data[$key]["sample"]				=	$data[$key]["sample"];
				$test_data[$key]["cd3_cd4_value"]		=	$data[$key]["cd3_cd4_value"];
				$test_data[$key]["errormessage"]		=	$data[$key]["errormessage"];
				$test_data[$key]["operator"]			=	$data[$key]["operator"];
				$test_data[$key]["result_date"]			=	$data[$key]["result_date"];
				$test_data[$key]["start_time"]			=	$data[$key]["start_time"];
				$test_data[$key]["barcode"]				=	$data[$key]["barcode"];
				$test_data[$key]["expiry_date"]			=	$data[$key]["expiry_date"];
				$test_data[$key]["volume"]				=	"";
				$test_data[$key]["device"]				=	$data[$key]["device"];
				$test_data[$key]["reagent"]				=	"";
				$test_data[$key]["software_version"]	=	$data[$key]["software_version"];
			}

		}else if( 	array_keys($data[0] )	== 	json_decode($dev_keys) 		){
			foreach ($data as $key => $dt) {

				$test_data[$key]["test_id"]				=	$data[$key]["test_id"];
				$test_data[$key]["device_id"]			=	$data[$key]["device_id"];
				$test_data[$key]["assay_id"]			=	$data[$key]["assay_id"];
				$test_data[$key]["assay_name"]			=	"DEV";
				$test_data[$key]["sample"]				=	"";
				$test_data[$key]["cd3_cd4_value"]		=	"";
				$test_data[$key]["errormessage"]		=	$data[$key]["export_error_message"]."210";
				$test_data[$key]["operator"]			=	"";
				$test_data[$key]["result_date"]			=	Date("Y/m/d");
				$test_data[$key]["start_time"]			=	"12:00";
				$test_data[$key]["barcode"]				=	"";
				$test_data[$key]["expiry_date"]			=	"";
				$test_data[$key]["volume"]				=	"";
				$test_data[$key]["device"]				=	"";
				$test_data[$key]["reagent"]				=	"";
				$test_data[$key]["software_version"]	=	"";

			}

		}

		$this->tests_file_upload($test_data);

	}

	private function control_file_upload($data){

		$data =	$this->trim_uploaded_controls($data);

		if(sizeof($data) > 0) {

			$pim_upl_st			=	R::getAll( "SHOW TABLE STATUS WHERE `Name` = 'pima_upload'" );

			$pim_upl_auto_id 		=	(int)	$pim_upl_st[0]["Auto_increment"];


			$assay_type = $data[0]['assay_id'];

			$serial_number 			=	$data[0]['device_id'];
			$facility_pima_res 	=	R::getAll("SELECT id as facility_device_id,
														facility_id,
														device_id,
														serial_number
														from facility_device 
														where serial_number='$serial_number'  LIMIT 1");
			if(sizeof($facility_pima_res)>0){

				//$facility_pima_id 		=	$facility_pima_res[0]['facility_pima_id'];
				$facility_device_id 	=	$facility_pima_res[0]['facility_device_id'];
				$facility_id 			=	$facility_pima_res[0]['facility_id'];

				$error =false;// initialize error

				$this->message = "<div class='success'>Upload Successful </div>";
				$this->upload_status = true;
				
				$this->db->trans_begin();
				$this->db->query("INSERT INTO `pima_upload`(`id`,`upload_date`,`facility_pima_id`,`uploaded_by`,`file_date`)
												VALUES
												('".$pima_upload_id."',
												 '".date("Y-m-d H:i:s")."',
												 '".$facility_device_id."',
												 '1',
												 '".$this->filename_date."')");				
				
				foreach ($data as $row) {

					$pima_error_id 	=	"";
					$barcode		=	3;
					$expiry_date	=	3;
					$volume			=	3;
					$device 		=	3;
					$reagent		=	3;

					if($row["errormessage"]>0){//has an error
						
						if($row["errormessage"]>=300 && $row["errormessage"]<=399){
							$row["errormessage"]= "300-399";
						}

						$error_message =$row["errormessage"];
						$pima_error_res = R::getAll("SELECT `id` FROM `pima_error` WHERE `error_code`='$error_message' LIMIT 1");

						if(sizeof($pima_error_res)>0){
							$pima_error_id =	$pima_error_res[0]['id'];		
							$validity 	=	0;				
						}else{
							$error = true;//error exists
							$this->message = "<div class='error'>No success. The file has an error not recognized by the system: ".$row['errormessage']."</div>";
							$this->upload_status = false;
							$upload_success = false;
						}
					}else{
						//do nothing
					}

					$barcode_res		=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['barcode']."' LIMIT 1");
					$expiry_date_res	=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['expiry_date']."' LIMIT 1");					
					$device_res			=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['device']."' LIMIT 1");
					if($assay_type==2){
						$volume_res			=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['volume']."' LIMIT 1");
						$reagent_res		=	R::getAll("SELECT `id` FROM `pima_test_pass_fail` WHERE `status` ='".$row['reagent']."' LIMIT 1");
					}

					$barcode			= 	$barcode_res[0]['id']		;
					$expiry_date		= 	$expiry_date_res[0]['id']	;					
					$device 			= 	$device_res[0]['id']		;
					if($assay_type==2){
						$volume				= 	$volume_res[0]['id']	;
						$reagent			= 	$reagent_res[0]['id']	;	
					}

					if( $assay_type	==	3 ){

						$this->db->query("INSERT INTO `pima_control` 
										(
											`device_test_id`,
											`pima_upload_id`,
											`assay_id`,
											`sample_code`,
											`error_id`,										
											`operator`,
											`barcode`,
											`expiry_date`,
											`device`,
											`software_version`,
											`cd4_count`,
											`facility_device_id`,
											`result_date`
										) 
										VALUES
											(
												'".$row['test_id']."',
												'$pim_upl_auto_id',
												'".$row['assay_id']."',
												'".$row['sample']."',
												'$pima_error_id',
												'".$row['operator']."',
												'$barcode',
												'$expiry_date',
												'$device ',
												'".$row['software_version']."',
												'".$row['cd3_cd4_value']."',
												'$facility_device_id',
												'".$row['result_date']." ".$row['start_time'].":00'
										)");
					}
					$error_message="";// unset any error message
				}
			

			}else{

				$facility_pima_id=	0;
				$this->message = "<div class='error'>This device is not recognized by the system</div>";				
				$this->upload_status = false;
				$upload_success = false;
				$this->device_not_recognized($serial_number,1);

			}
		}else{
			$this->message = "<div class='notice'>No data Uploaded! <br/>It seems all of this data has already been uploaded or there is no data in the file.</div>";
			$this->upload_status = true;
		}

	}


	private function trim_uploaded_tests($data){

		foreach ($data as $row) {
			$device_test_id	=	$row['test_id'];
			$sample_code	=	$row['sample'];
			$result_date	=	$row['result_date']." ".$row['start_time'].":00";

			$count_res = R::getAll("	SELECT 
												COUNT(*) AS `num`
											FROM `pima_test` 
											LEFT JOIN `cd4_test`
												ON `cd4_test`.`id`=`pima_test`.`cd4_test_id` 
											WHERE 	`device_test_id`			= 	'$device_test_id'
											AND		`sample_code` 				=	'$sample_code'
											AND		`cd4_test`.`result_date`	=	'$result_date' "
				);

			if($count_res[0]['num']>0){
				if (($key = array_search($row, $data)) !== false) {	//
	    			unset($data[$key]);								// removing the data
	    		}	
			}
		}

		$trimmed_data = array();

		foreach ($data as $datum) {
			$trimmed_data[] = $datum;
		}

		return $trimmed_data;

	}
	private function trim_uploaded_controls($data){

		foreach ($data as $row) {
			$device_test_id	=	$row['test_id'];
			$sample_code	=	$row['sample'];
			$result_date	=	$row['result_date']." ".$row['start_time'].":00";

			$count_res = R::getAll("	SELECT 
												COUNT(*) AS `num`
											FROM `pima_control` 

											WHERE 	`device_test_id`			= 	'$device_test_id'
											AND		`sample_code` 				=	'$sample_code'
											AND		`result_date`				=	'$result_date' "
				);

			if($count_res[0]['num']>0){
				if (($key = array_search($row, $data)) !== false) {	//
	    			unset($data[$key]);								// removing the data
	    		}	
			}
		}

		$trimmed_data = array();

		foreach ($data as $datum) {
			$trimmed_data[] = $datum;
		}
	
		return $trimmed_data;
	}
	private function device_not_recognized($serial_num,$user_id){
		$this->db->query("INSERT INTO `pima_failed_upload_devices` 
										(`serial_num`,`user_id`,`equipment_id`,`status`) 
										VALUES
											('$serial_num','$user_id','4','1')");
	}
}
?>