<?php

class fcdrr_model extends MY_Model{

/* these function the commodities in the databse */

function get_facs_calibur_commodities()
{
	$facs_calibur_commodities=array();

	$sql_commodity="SELECT c.name,c.unit,c.category_id FROM commodity c, commodity_category cc where cc.id='1' AND cc.id=c.category_id ORDER BY cc.id";

	$commodity_results=$this->db->query($sql_commodity);

	foreach($commodity_results->result_array() as $commodity)
	{
		$facs_calibur_commodities[]=$commodity;
	}

	return $facs_calibur_commodities;
}

function get_facs_count_commodities()
{
	$facs_count_commodities=array();

	$sql_commodity="SELECT c.name,c.unit,c.category_id FROM commodity c, commodity_category cc where cc.id='3' AND cc.id=c.category_id ORDER BY cc.id";

	$commodity_results=$this->db->query($sql_commodity);

	foreach($commodity_results->result_array() as $commodity)
	{
		$facs_count_commodities[]=$commodity;
	}

	return $facs_count_commodities;
}

function get_cyflow_commodities()
{
	$cyflow_commodities=array();

	$sql_commodity="SELECT c.name,c.unit,c.category_id FROM commodity c, commodity_category cc where cc.id='2' AND cc.id=c.category_id ORDER BY cc.id";

	$commodity_results=$this->db->query($sql_commodity);

	foreach($commodity_results->result_array() as $commodity)
	{
		$cyflow_commodities[]=$commodity;
	}

	return $cyflow_commodities;
}

function get_poc_commodities()
{
	$poc_commodities=array();

	$sql_commodity="SELECT c.name,c.unit,c.category_id FROM commodity c, commodity_category cc where cc.id='4' AND cc.id=c.category_id ORDER BY cc.id";

	$commodity_results=$this->db->query($sql_commodity);

	foreach($commodity_results->result_array() as $commodity)
	{
		$poc_commodities[]=$commodity;
	}

	return $poc_commodities;
}

function get_categories(){

	$commodities_results=array();

	$sql_commodities=$this->db->query("SELECT c.id as commodity_id,
											c.code as commodity_code,
											c.name as commodity,
											c.unit as commodity_unit,
											c.category_id as commodity_category
										FROM commodity c");
	$sql_categories =$this->db->query("SELECT * FROM commodity_category");

	$i=0;
	foreach ($sql_categories->result_array()  as $cat) {
		$j=0;
			foreach($sql_commodities->result_array() as $commodity){
				if($cat['id']==$commodity["commodity_category"]){
						$commodities_results[$i]['category_name']=$cat['name'];
						$commodities_results[$i]["commodities"][$j]['name']=$commodity['commodity'];
						$commodities_results[$i]["commodities"][$j]['unit']=$commodity['commodity_unit'];

						$j++;
				}	
			}
			$i++;
	}

	return $commodities_results;
}

}
?>