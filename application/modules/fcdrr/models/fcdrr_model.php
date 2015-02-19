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