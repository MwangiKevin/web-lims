<?php

class fcdrr_model extends MY_Model{

/* these function the commodities in the databse */
function get_commodities(){

	$commodities_results=array();

	$sql_commodities=$this->db->query("SELECT c.id as commodity_id,
											c.code as commodity_code,
											c.name as commodity,
											c.unit as commodity_unit,
											c.category_id as commodity_category
										FROM commodity c 
										WHERE c.reporting_status='1'");
	$sql_categories =$this->db->query("SELECT * FROM commodity_category");

	$i=0;
	foreach ($sql_categories->result_array()  as $cat) {
		$j=0;
			foreach($sql_commodities->result_array() as $commodity){
				if($cat['id']==$commodity["commodity_category"]){
						$commodities_results[$i]['category_name']=$cat['name'];

						$commodities_results[$i]["commodities"][$j]['id']=$commodity['commodity_id'];
						$commodities_results[$i]["commodities"][$j]['name']=$commodity['commodity'];
						$commodities_results[$i]["commodities"][$j]['unit']=$commodity['commodity_unit'];

						$j++;
				}	
			}
			$i++;
	}

	return $commodities_results;
}
/* Get all fcdrr that have been reported */
function get_fcdrr_list($fromdate,$todate){

	$final_pdf_data="";

	$fcdrr_list_results=$this->db->query("SELECT *,fcdr.id as fcdrr_id FROM fcdrr fcdr
											LEFT JOIN facility f ON fcdr.facility_id=f.id
											WHERE from_date  BETWEEN '".$fromdate."' AND '".$todate."' 
											AND to_date BETWEEN '".$fromdate."' AND '".$todate."' 
											GROUP BY fcdr.facility_id");

	return $fcdrr_list_results;
}

function get_fcdrr_content($fcdrr_list_result){

		$device_details=$this->db->query("SELECT * FROM v_device_details WHERE mfl_code='".$fcdrr_list_result['mfl_code']."' GROUP BY mfl_code");

		foreach($device_details->result_array() as $device_result)
 		{
			$first_part_table='<table bordercolor="#000000" border="single" class="data-table" id="table">';
			$first_part_table.='<colgroup><col width="100"><col width="50"></colgroup>';
			$first_part_table.='<tbody>';
			$first_part_table.='<tr>';
			$first_part_table.='<td><b>Name of Facility:</b></td>';
			$first_part_table.='<td colspan="4">'.$fcdrr_list_result["name"].'<center></center></td>';
			$first_part_table.='<td><b>Facility Code:</b></td>';
			$first_part_table.='<td><center> '.$fcdrr_list_result["mfl_code"].'</center></td>';
			$first_part_table.='<td colspan="2"><b>District:</b></td>';
			$first_part_table.='<td><center> '.$device_result["sub_county_name"].'</center></td>';
			$first_part_table.='<td><b>Province/County:</b></td>';
			$first_part_table.='<td colspan="2"><center> '.$device_result["county_name"].'</center></td>';
			$first_part_table.='<td><b>Affiliation:</b></td>';
			$first_part_table.='<td><center> '.$device_result['type'].'</center></td>';
			$first_part_table.='</tr>';
			$first_part_table.='<tr>';
			$first_part_table.='<td align="right" colspan="2"><b>REPORT FOR PERIOD:</b></td>';
			$first_part_table.='<td colspan="3"><b>BEGINNING:</b></td>';
			$first_part_table.='<td colspan="2">';
			$first_part_table.='<center id="from"> '.$fcdrr_list_result["from_date"].'</center>';
			$first_part_table.='</td>';
			$first_part_table.='<td colspan="3"><b>ENDING:<b></b></b></td>';
			$first_part_table.='<td colspan="3"><center id="to"> '. $fcdrr_list_result["to_date"].'</center></td>';
			$first_part_table.='<td colspan="2"></td>';
			$first_part_table.='</tr>';
			$first_part_table.='<tr>';
			$first_part_table.='<td colspan="2" rowspan="2" align="left"><b>State the number of CD4 Tests conducted:-</b></td>';
			$first_part_table.='<td colspan="1" rowspan="2"><b> Calibur:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>';
					    
			$first_part_table.='<td><label for="caliburtestsPead" class="">Pead </label></td>';
			$first_part_table.='<td><label for="caliburtestsAdults3" class="">Adults</label></td>';
			$first_part_table.='<td><label for="caliburs3" class="">Equip </label></td>';
			$first_part_table.='<td colspan="1" rowspan="2"><b> Count:</b></td>';
			$first_part_table.='<td><label for="caliburtestsPead" class="">Pead </label></td>';
			$first_part_table.='<td><label for="caliburtestsAdults2" class="">Adults</label></td>';
			$first_part_table.='<td><label for="caliburesult_fcdrr_list" class="">Equip </label></td>';
			$first_part_table.='<td colspan="1" rowspan="2"><b>Cyflow Partec</b></td>';
			$first_part_table.='<td><label for="caliburtestsPead" class="">Pead </label></td>';
			$first_part_table.='<td><label for="caliburtestsAdults4" class="">Adults</label></td>';
			$first_part_table.='<td><label for="caliburs4" class="">Equip </label></td>';
			$first_part_table.='<td rowspan="1" colspan="1"><b>Pima Tests</b></td>';
			$first_part_table.='</tr>';
			$first_part_table.='<tr>';
			$first_part_table.='<td><span id="caliburtestsPead">'.$fcdrr_list_result["calibur_tests_pead"].'</span></td>';
			$first_part_table.='<td><span id="caliburtestsAdults">'.$fcdrr_list_result["calibur_tests_adults"].'</span></td>';
			$first_part_table.='<td><span id="caliburs"> '.$fcdrr_list_result["caliburs"].'</span></td>';
			$first_part_table.='<td>'.$fcdrr_list_result["count_tests_pead"].'</td>';
			$first_part_table.='<td><span id="counttestsAdults"> '. $fcdrr_list_result["count_tests_adults"].'</span></td>';
			$first_part_table.='<td><span id="counts"> '. $fcdrr_list_result["counts"].'</span></td>';
			$first_part_table.='<td><span id="cyflowtestsPead"> '.$fcdrr_list_result["cyflow_tests_pead"].'</span></td>';
			$first_part_table.='<td><span id="cyflowtestsAdults"> '.$fcdrr_list_result["cyflow_tests_adults"].'</span></td>';
			$first_part_table.='<td><span id="cyflows">'. $fcdrr_list_result["cyflows"].'</span></td>';
			$first_part_table.='<td>'.$fcdrr_list_result["pima_tests"].' ';
			$first_part_table.='</tr>';


			/* Second Part of the table */


			$second_part_table='<tr>';
			$second_part_table.='<td colspan="7"><b>TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</b></td>';
			$second_part_table.='<td colspan="10"><center>'.$fcdrr_list_result["cyflow_tests_adults"]+$fcdrr_list_result["cyflow_tests_pead"]+$fcdrr_list_result["count_tests_adults"]+$fcdrr_list_result["count_tests_pead"]+$fcdrr_list_result["calibur_tests_pead"]+$fcdrr_list_result["calibur_tests_adults"].'</center></td>';
			$second_part_table.='</tr>';
			$second_part_table.='<tr>';		 
			$second_part_table.='<td rowspan="2"><b>COMMODITY CODE</b></td>';
			$second_part_table.='<td rowspan="2"><b>COMMODITY NAME</b></td>';
	        $second_part_table.='<td rowspan="2"><b>UNIT OF ISSUE</b></td>';
	        $second_part_table.='<td colspan="2" rowspan="2"><b>BEGINNING BALANCE</b></td>';
	        $second_part_table.='<td colspan="2"><b>QUANTITY RECEIVED FROM CENTRAL<br> WAREHOUSE (e.g. KEMSA)</b></td>';            
	        $second_part_table.='<td colspan="2" rowspan="2"><b>QUANTITY USED</b></td>';
	        $second_part_table.='<td rowspan="2"><b>LOSSES/WASTAGE</b></td>';
	        $second_part_table.='<td colspan="3"><b>ADJUSTMENTS<br><i>Indicate if (+) or (-)</i></b></td>';
	        $second_part_table.='<td rowspan="2"><b>ENDING BALANCE <br>PYSICAL COUNT at end of the Month</b></td>';
	        $second_part_table.='<td rowspan="2"><b>QUANTITY REQUESTED</b></td>';
		    $second_part_table.='</tr>';
			$second_part_table.='<tr>';    
	        $second_part_table.='<td>Quantity</td>';
	        $second_part_table.='<td>Lot No.</td>';
	        $second_part_table.='<td>Positive</td>';
	        $second_part_table.='<td colspan="2">Negative</td>';

	        $commodities_usage=$this->get_commodity_categories($fcdrr_list_result['facility_id'],$fcdrr_list_result['fcdrr_id']);

			$second_part_table.='</tr>'. $commodities_usage.' ';
			$second_part_table.'<tr align="left">';
	        $second_part_table.='<td colspan="1"><b>FCDRR Comments</b></td>';
			$second_part_table.='<td colspan="14"><span name="comments" id="comments" cols="250">'. $fcdrr_list_result["comments"].'</span></td>';
			$second_part_table.='</tr>';
			$second_part_table.='</tbody>';
			$second_part_table.='</table>';

			$final_pdf_data=$first_part_table.$second_part_table;

		}

		return $final_pdf_data;
	
}/* End of function get_fcdrr() */

function get_commodity_categories($facility_id,$fcdrr_id){

	$commodity_category_results=$this->db->query("SELECT cc.id,
							 						cc.name,
							 						cc.device_id
							 						FROM commodity_category cc,  v_device_details vde 
							 						WHERE (cc.device_id = vde.device_id OR cc.device_id =0) AND vde.facility_id ='$facility_id' GROUP BY cc.id");
	$commodities_final_list="";

	foreach($commodity_category_results->result_array() as $commodity_category)
	{
		$cat_table = '<tr><td colspan="15"><b>'.$commodity_category['name'].'</b></td></tr>';

		$commodities_list=$this->get_actual_commodities($commodity_category['id'],$fcdrr_id);

		$commodities_final_list=$commodities_final_list.$cat_table.$commodities_list; //concatenate all the rows to join the table later
	}

	return $commodities_final_list;

} /* End of function get_commodity_categories(2 variables) */

function get_actual_commodities($category_id,$fcdrr_id){

	$commodities_results=$this->db->query("SELECT * FROM commodity where category_id='".$category_id."' ");

	$commodities_table="";

	foreach($commodities_results->result_array() as $commodity)
	{
		$table_list='<tr><td>'.$commodity['code'].'</td><td>' . $commodity['name'] . '</td>';
		$table_list.='<td >'.$commodity['unit'].'<input  name="namer[' . $commodity['id'] . ']"  id="namer[' . $commodity['id'] . ']" type="hidden" test= "' . $commodity['id'] . '" value="' . $commodity['id'] . '"></td>';
		$table_list.='<td colspan="2"><center id="beginningbal' . $commodity['id'] . '">'.$v1=$this->get_commodity_usage_values($fcdrr_id,$commodity['id'],'beginning_bal').'</center></td>';
		$table_list.='<td><center id="receivedqty' . $commodity['id'] . '">'.$v2=$this->get_commodity_usage_values($fcdrr_id,$commodity['id'],'received_qty').'</center></td>';
		$table_list.='<td><center id="receivedlot' . $commodity['id'] . '">'.$v3=$this->get_commodity_usage_values($fcdrr_id,$commodity['id'],'lot_code').'</center></td>';
		$table_list.='<td colspan="2"><center id="qtyused' . $commodity['id'] . '">'.$v4=$this->get_commodity_usage_values($fcdrr_id,$commodity['id'],'qty_used').'</center></td>';
		$table_list.='<td><center id="losses' . $commodity['id'] . '" >'.$v5=$this->get_commodity_usage_values($fcdrr_id,$commodity['id'],'losses').'</center></td>';
		$table_list.='<td><center id="adjustmentplus' . $commodity['id'] . '">'.$v6=$this->get_commodity_usage_values($fcdrr_id,$commodity['id'],'adjustment_plus').'</center></td>';
		$table_list.='<td colspan="2"><center id="adjustmentminus' . $commodity['id'] . '">'.$v7=$this->get_commodity_usage_values($fcdrr_id,$commodity['id'],'adjustment_minus').'</center></td>';
		$table_list.='<td><center id="endbal' . $commodity['id'] . '">'.$v8=$this->get_commodity_usage_values($fcdrr_id,$commodity['id'],'end_bal').'</center></td>';
		$table_list.='<td><center id="requested' . $commodity['id'] . '">'.$v9=$this->get_commodity_usage_values($fcdrr_id,$commodity['id'],'requested').'</center></td>';
		$table_list.='</tr>';

	$commodities_table=$commodities_table.$table_list;

	return $commodities_table;
	}

}/* End of function get_actual_commodities(2 variables)*/

function get_commodity_usage_values($fcdrr_id,$commodity_id,$field){

	//secho $sql="SELECT * FROM fcdrr_commodity WHERE reagent_id='$commodity_id' AND fcdrr_id='$fcdrr_id'";die;

	$commodity_values=$this->db->query("SELECT * FROM fcdrr_commodity WHERE reagent_id='$commodity_id' AND fcdrr_id='$fcdrr_id'");

	$value=0;

	foreach($commodity_values->result_array() as $commodity_usage)
	{
		$value=$commodity_usage[$field];
	}

	return $value;
}/* End of function get_commodity_usage(3 variables)*/


	function get_partner_email($partner_name)//get the partner email address 
	{
		$sql="SELECT u.username,u.name,u.email 
						FROM partner p,partner_user pu, v_facility_device_details vfd, aauth_users u
					 	WHERE vfd.partner_name=p.name 
					 	AND p.id=pu.partner_id 
					 	AND pu.user_id=u.id 
					 	AND vfd.partner_name='".$partner_name."' AND u.banned='0' GROUP BY u.email ";

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

	function get_county_email($sub_county_id)//get the county coordinator email address 
	{
		$sql="SELECT u.name,u.email,vfd.county_id,vfd.county_name
						FROM county_user cu,county c,v_facility_device_details vfd, aauth_users u
						WHERE vfd.county_name=r.name
						AND c.id=cu.county_id
						AND c.user_id=u.id
						AND vfd.sub_county_id='".$sub_county_id."' AND u.banned='0' GROUP BY u.email";

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
?>