<?php
/* This model has functions to fetch cd4 tests uploaded during a particular week */
class alerts_model extends MY_Model{

function weekly_uploads($last_monday,$last_sunday,$county,$partner,$facility,$receipient)//This function get all cd4 tests uploaded during the week
{
	$pdf_data=array();
	$total_number_of_records=0;
	$total_tests=0;
	$errors=0;
	$tests_less_than500=0;
	$tests_greater_than500=0;
	$percentage_errors=0;
	$delimiter="";
	$group_by="";

	//cumulative table headings
	$pdf_data['cumulative_table']='<table border="0" align="center" width="880" class="data-table">';
	$pdf_data['cumulative_table'].='<tr>';
	$pdf_data['cumulative_table'].='<th><center># PIMAs Reported</center></th>';
	$pdf_data['cumulative_table'].='<th bgcolor="#000066" style="color:#FFF;"><center>Total Tests</center></th>';
	$pdf_data['cumulative_table'].='<th bgcolor="#eb9316" style="color:#FFF;"><center>Total Tests < 500</center></th>';
	$pdf_data['cumulative_table'].='<th bgcolor="#CC0000" style="color:#FFF;"><center>Total Errors</center></th>';
	//$pdf_data['cumulative_table'].='<th bgcolor="#CC0000" style="color:#FFF;"><center>Errors by %</center></th>';
	$pdf_data['cumulative_table'].='</tr>';

	$pdf_data['breakdown_table']='<table border="0" align="center" width="880" class="data-table">';
	$pdf_data['breakdown_table'].='<tr>';
	$pdf_data['breakdown_table'].='<th><center>#</center></th>';
	$pdf_data['breakdown_table'].='<th style="width:25%"><center>Device Serial Number</center></th>';
	$pdf_data['breakdown_table'].='<th style="width:25%"><center>Facility</center></th>';
	$pdf_data['breakdown_table'].='<th bgcolor="#000066" style="color:#FFF;width:15%"><center>Total Tests</center></th>';
	$pdf_data['breakdown_table'].='<th bgcolor="#eb9316" style="color:#FFF;width:15%"><center>Tests < 500</center></th>';
	$pdf_data['breakdown_table'].='<th bgcolor="#CC0000" style="color:#FFF;width:15%"><center>Errors</center></th>';
	$pdf_data['breakdown_table'].='</tr>';

	$pdf_data['facility_breakdown']="";

	if(!$county=="")//check if county parameter is set
	{
		$delimiter=" AND `county_name`='".$county."' ";
		$group_by=" `facility_name` ";
		$total_pima_sql="SELECT DISTINCT COUNT(  'serial_number' ) AS total_pimas
							FROM v_facility_device_details
							WHERE  `county_name`='".$county."' AND status='1'"; 
	}
	if(!$partner=="")//check if partner parameter is set
	{
		$delimiter=" AND `partner_name`='".$partner."' ";
		$group_by=" `facility_name` ";
		$total_pima_sql="SELECT DISTINCT COUNT(  'serial_number' ) AS total_pimas
							FROM v_facility_device_details
							WHERE  `partner_name`='".$partner."' AND status='1' ";
	}
	if(!$facility=="")//check if facility parameter is set
	{
		$delimiter=" ";
		$group_by=" `facility_name` ";
		$total_pima_sql="SELECT COUNT(  'device_id' ) AS total_pimas
							FROM facility_device
							WHERE device_id='4' AND status='1' ";
	}
	$sql	=	"SELECT 
						`pima_upload_id`,
						`upload_date`,
						`serial_number`,
						`facility_name`,
						`sub_county_id`,
						`sub_county_name`,
						`county_id`,
						`county_name`,
						`partner_id`,
						`partner_name`,
						COUNT(`test_id`) AS `total_tests`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid_tests`,
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
						SUM(CASE WHEN `valid`= '1'  AND  `cd4_count` < 500 THEN 1 ELSE 0 END) AS `failed`,
						SUM(CASE WHEN `valid`= '1'  AND  `cd4_count` >= 500 THEN 1 ELSE 0 END) AS `passed`
					FROM `v_pima_upload_details`
					WHERE `result_date` BETWEEN '".$last_monday."' AND '".$last_sunday."' ".$delimiter."
					GROUP BY ".$group_by."
					ORDER BY `facility_name` ASC";
	
	$query=$this->db->query($sql);

	if($query->num_rows()>0)
	{
		$total_number_of_records=$query->num_rows();
		$i=1;
		foreach($query->result_array() as $value)
		{
			if($value['facility_name']==NULL || $value['serial_number']==NULL)
			{
				//should i still pick these results despite them having no facility and equipment?
			}
			else
			{
				$total_tests+=$value['total_tests'];
				//$tests_greater_than500+=$value['passed'];
				$tests_less_than500+=$value['failed'];
				$errors+=$value['errors'];

				
			}
		}
		//$percentage_errors=round(($errors/$total_tests)*100,1);

		$total_pima_query=$this->db->query($total_pima_sql);

		foreach($total_pima_query->result() as $value)
		{
			$total_pimas=$value->total_pimas;
		}
		//cumulative table data
		$pdf_data['cumulative_table'].='<tr>';
		$pdf_data['cumulative_table'].='<td><center>'.$total_number_of_records.' / '.$total_pimas.'</center></td>';
		$pdf_data['cumulative_table'].='<td><center>'.$total_tests.'</center></td>';
		$pdf_data['cumulative_table'].='<td><center>'.$tests_less_than500.'</center></td>';
		$pdf_data['cumulative_table'].='<td><center>'.$errors.'</center></td>';
		//$pdf_data['cumulative_table'].='<td><center>'.$percentage_errors.'</center></td>';
		$pdf_data['cumulative_table'].='</tr></table>';

		foreach($query->result_array() as $value)
		{
			if($value['facility_name']==NULL || $value['serial_number']==NULL)
			{
				//should i still pick these results despite them having no facility and equipment?
			}
			else
			{
				//break down table
				$pdf_data['breakdown_table'].='<tr>';
				$pdf_data['breakdown_table'].='<td><center>'.$i.'</center></td>';
				$pdf_data['breakdown_table'].='<td><center>'.$value['serial_number'].'</center></td>';
				$pdf_data['breakdown_table'].='<td><center>'.$value['facility_name'].'</center></td>';
				$pdf_data['breakdown_table'].='<td><center>'.$value['total_tests'].'</center></td>';
				$pdf_data['breakdown_table'].='<td><center>'.$value['failed'].'</center></td>';
				$pdf_data['breakdown_table'].='<td><center>'.$value['errors'].'</center></td>';
				$pdf_data['breakdown_table'].='</tr>';

				$i++;
			}
		}
		$pdf_data['breakdown_table'].='</table>';

		if($receipient=="breakdown")
		{
			foreach($query->result_array() as $value)
			{
				if($value['facility_name']==NULL || $value['serial_number']==NULL)
				{

				}
				else
				{

					$facility_results=$this->tests_less_than500($last_monday,$last_sunday,$value['facility_name']);

					$pdf_data['facility_breakdown'].=$facility_results['table'].'<br />';
				}
			}

		}

	}
	else
	{
		//no records code here
	}

return $pdf_data;
}


function tests_less_than500($from,$to,$facility)//tests less than 500 per month, critical
{
	$datestring = "%h:%i %a";//set the timestamp

	$pdf_results="";
	$pdf_count="";
	$pdf_data=array();
	$i=1;//counter

	$pdf_data['table']="<table border='0' align='center' width='880' class='data-table'>";
	$pdf_data['table'].="<tr>";
	$pdf_data['table'].="<th style='width:3%'>#</th>";
	$pdf_data['table'].="<th style='width:10%'>Patient ID</th>";
	$pdf_data['table'].="<th style='width:20%'>Facility - Device</th>";
	$pdf_data['table'].="<th style='width:20%'>Date Run</th>";
	$pdf_data['table'].="<th style='width:10%'>CD4 Count</th>";
	$pdf_data['table'].="</tr>";

	if($facility!="")//By facility
	{
		$device="";
		$all="";
		$report_type="tests_less_than500";

		$pdf_results=$this->get_test_details($from,$to,$facility,$report_type);
		$pdf_count=$this->get_count_test_details($from,$to,$facility,$report_type);
	}
	if($pdf_results!="")
	{
		foreach ($pdf_results as $value) 
		{
			$string_unix="";
			$string_unix=mysql_to_unix($value['result_date']);

			$pdf_data['table'].='<tr>';
			$pdf_data['table'].='<td style="width:3%">'.$i.'</td>';
			$pdf_data['table'].='<td style="width:10%">'.$value['sample_code'].'</td>';
			$pdf_data['table'].='<td style="width:20%"><center>'.$value['facility_name'].' - '.$value['serial_number'].'</center></td>';
			$pdf_data['table'].='<td style="width:20%"><center>'.date('d-F-Y',strtotime($value['result_date'])).' - '.mdate($datestring,$string_unix).'</center></td>';
			$pdf_data['table'].='<td style="width:10%"><center>'.$value['cd4_count'].'</center></td>';
			$pdf_data['table'].='</tr>';

			$i++;	
		}
	}
	else
	{
		$pdf_data['less_than500']=0;
		$pdf_data['count']=0;
	}

	$pdf_data['table'].="</table>";

	if($pdf_count!="")
	{
		foreach($pdf_count as $test_count)
		{
			$pdf_data['less_than500']=$test_count['failed'];
			$pdf_data['count']=$test_count['total_tests'];
		}
	}

	// print_r($pdf_data);
	// die;
	return $pdf_data;	
}

public function get_test_details($from,$to,$facility,$report_type)  // get all the cd4 tests based the date and the facility
{
	$sql="SELECT * FROM v_pima_tests_details";

	if(!$facility=="")
	{
		if($report_type=="all") //for monthly activity report
		{
			$criteria =" WHERE facility_name='".$facility."' AND result_date like '".date('Y-m',strtotime($from))."-%' ";
		}
		else if($report_type=="tests_less_than500") // for monthly critical report
		{
			$criteria =" WHERE facility_name='".$facility."' AND valid='1' AND cd4_count < 500 AND result_date BETWEEN '".$from."' AND '".$to."' ";
		}
		
	}		

	$test_details=R::getAll($sql.$criteria);

	// echo $tests_sql.$date_delimiter.$criteria;

	// die;

	return $test_details;

}
public function get_count_test_details($from,$to,$facility)// get all cumulative values of the cd4 tests based on the date and facility
{
	$sql_count="SELECT COUNT(test_id) AS total_tests,
					SUM(CASE WHEN valid= '1'    THEN 1 ELSE 0 END) AS valid_tests,
					SUM(CASE WHEN valid= '0'    THEN 1 ELSE 0 END) AS `errors`,
					SUM(CASE WHEN valid= '1'  AND  cd4_count < 500 THEN 1 ELSE 0 END) AS failed,
					SUM(CASE WHEN valid= '1'  AND  cd4_count >= 500 THEN 1 ELSE 0 END) AS passed
					FROM v_pima_tests_only ";	

	if(!$facility=="")
	{
		if($report_type=="all") //for monthly activity report
			{
				$criteria =" WHERE facility_name='".$facility."' AND result_date like '".date('Y-m',strtotime($from))."-%' ";
			}
			else if($report_type=="tests_less_than500") // for monthly critical report
			{
				$criteria =" WHERE facility_name='".$facility."' AND valid='1' AND cd4_count < 500 AND result_date BETWEEN '".$from."' AND '".$to."' ";
			}
	}	

	$test_details=R::getAll($sql_count.$criteria);

	// echo $sql_count.$date_delimiter.$criteria;

	// die;

	return $test_details;
}
function all_tests_done($from,$to,$facility) //monthly activity report
{
	$datestring = "%h:%i %a";//set the timestamp

	$pdf_results="";
	$pdf_count="";
	$pdf_data=array();
	$i=1;//counter

	$pdf_data['table']="<table border='0' align='center' width='880' class='data-table'>";
	$pdf_data['table'].="<tr>";
	$pdf_data['table'].="<th style='width:3%'>#</th>";
	$pdf_data['table'].="<th style='width:10%;'>Patient ID</th>";
	$pdf_data['table'].="<th style='width:20%;'>Facility - Device</th>";
	$pdf_data['table'].="<th style='width:20%;'>Date Run</th>";
	$pdf_data['table'].="<th style='width:10%;'>Test Status</th>";
	$pdf_data['table'].="<th style='width:10%;'>CD4 Count</th>";
	$pdf_data['table'].="</tr>";

	if($facility!="")//By facility
	{
		$device="";
		$all="";
		$report_type="all";

		$pdf_results=$this->get_test_details($from,$to,$facility,$report_type);
		$pdf_count=$this->get_count_test_details($from,$to,$facility,$report_type);
	}
	if($pdf_results!="")
	{
		foreach ($pdf_results as $value) // get all the details about a cd4 test
		{
			$string_unix="";
			$string_unix=mysql_to_unix($value['date_test']);

			if($value['valid']==1)
			{

				$pdf_data['table'].='<tr>';
				$pdf_data['table'].='<td style="width:3%">'.$i.'</td>';
				$pdf_data['table'].='<td style="width:10%;">'.$value['sample_code'].'</td>';
				$pdf_data['table'].='<td style="width:20%;" ><center>'.$value['facility_name'].' - '.$value['serial_number'].'</center></td>';
				$pdf_data['table'].='<td style="width:20%;"><center>'.date('d-F-Y',strtotime($value['date_test'])).' - '.mdate($datestring,$string_unix).'</center></td>';
				$pdf_data['table'].='<td style="width:10%;"><center>Successful</center></td>';
				$pdf_data['table'].='<td style="width:10%;"><center>'.$value['cd4_count'].'</center></td>';
				$pdf_data['table'].='</tr>';
			}
			else
			{
				$pdf_data['table'].='<tr>';
				$pdf_data['table'].='<td style="width:3%">'.$i.'</td>';
				$pdf_data['table'].='<td style="width:10%">'.$value['sample_code'].'</td>';
				$pdf_data['table'].='<td style="width:25%"><center>'.$value['facility_name'].' - '.$value['serial_number'].'</center></td>';
				$pdf_data['table'].='<td style="width:20%"><center>'.date('d-F-Y',strtotime($value['result_date'])).' - '.mdate($datestring,$string_unix).'</center></td>';
				$pdf_data['table'].='<td style="width:10%"><center>Error</center></td>';
				$pdf_data['table'].='<td style="width:10%"><center>'.$value['cd4_count'].'</center></td>';
				$pdf_data['table'].='</tr>';
			}

		$i++;	
		}
	}
	else
	{
		$pdf_data['less_than500']=0;
		$pdf_data['count']=0;
		$pdf_data['valid_tests']=0;
		$pdf_data['greater_equal_to500']=0;
		$pdf_data['errors']=0;
	}

	$pdf_data['table'].="</table>";

	if($pdf_count!="") // fetch the cumulative values
	{
		foreach($pdf_count as $test_count)
		{
			$pdf_data['less_than500']=$test_count['failed'];
			$pdf_data['count']=$test_count['total_tests'];
			$pdf_data['valid_tests']=$test_count['valid_tests'];
			$pdf_data['greater_equal_to500']=$test_count['passed'];
			$pdf_data['errors']=$test_count['errors'];
		}
	}

	// print_r($pdf_data);
	// die;
	return $pdf_data;	
}

function upload_list($from,$to,$group_by_delimiter)// gets uploads grouped by facility,county,partner based on the variable $group_by_delimiter
{
	$sql	=	"SELECT 
						pima_upload_id,
						upload_date,
						serial_number,
						facility_name,
						COUNT(cd4_test_id) AS total_tests,
						SUM(CASE WHEN valid= '1'    THEN 1 ELSE 0 END) AS valid_tests,
						SUM(CASE WHEN valid= '0'    THEN 1 ELSE 0 END) AS errors,
						SUM(CASE WHEN valid= '1'  AND  cd4_count < 500 THEN 1 ELSE 0 END) AS failed,
						SUM(CASE WHEN valid= '1'  AND  cd4_count >= 500 THEN 1 ELSE 0 END) AS passed,
						sub_county_name,
						sub_county_id,
						county_id,
						county_name,
						partner_name
					FROM v_pima_upload_details
					WHERE result_date BETWEEN '".$from."' AND '".$to."'
					GROUP BY $group_by_delimiter
					ORDER BY facility_name ASC ";

	$res 	=	R::getAll($sql);

	return $res;
}
function get_partner_email($partner_id)//get the partner email address 
{
	$sql="SELECT u.name,u.email 
					FROM partner p,partner_user pu, v_facility_device_details vdp, aauth_users u
				 	WHERE vdp.partner_name=p.name 
				 	AND p.id=pu.partner_id 
				 	AND pu.user_id=u.id 
				 	AND vdp.partner_id='".$partner_id."' AND u.banned='0' GROUP BY u.email ";

 	$query=$this->db->query($sql);

 	if($query->num_rows()>0)
 	{
 		foreach($query->result_array() as $email)
 		{
 			$result[]=$email['email'];
 		}
 	}
 	else
 	{
			$result[]='brianhawi92@gmail.com';//admin email
 	}

	return $result;		
}

function get_county_email($county_id)//get the county coordinator email address 
{
	$sql="SELECT u.username,u.name,u.email
					FROM county_user cu,county c,v_facility_device_details vdp, aauth_users u
					WHERE vdp.county_name=c.name
					AND c.id=cu.county_id
					AND cu.user_id=u.id
					AND vdp.county_id='".$county_id."' AND u.banned='0' GROUP BY u.email";

	$query=$this->db->query($sql);

 	if($query->num_rows()>0)
 	{
 		foreach($query->result_array() as $email)
 		{
 			$result[]=$email['email'];
 		}
 	}
 	else
 	{
			$result[]='brianhawi92@gmail.com';
 	}

	return $result;

}





}