<?php

class api_m extends MY_Model{
	
	public function get_facility_types(){
		 $sql 	=	"CALL proc_get_facility_types()";
		 $result = R::getAll($sql);
		 return $result;
	}

	public function get_county_details(){
		 $sql 	=	"CALL proc_get_county_details()";
		 $result = R::getAll($sql);
		 return $result;
	}
	
	public function get_sub_county_details(){
		$sql 	=	"CALL proc_get_sub_county_details()";
		$result = R::getAll($sql);
		return $result;
	}
	
	public function get_facility_details(){
		$sql = "CALL proc_get_facility_details(0,0)";
		$result = R::getAll($sql);
		return $result;		
	}

	public function get_partner_details(){
		$sql = "CALL proc_get_partner_details()";
		$result = R::getAll($sql);
		return $result;		
	}

	
	public function get_entities(){
		$result = [];
					
		$county_result = $this->get_county_details();
		foreach($county_result as $key => $value1){
			$value1['grp_type'] = 'Counties';
			array_push($result,$value1);
		}

		$sub_county_result = $this->get_sub_county_details();
		foreach ($sub_county_result as $key => $value) {
			$value['grp_type'] = 'Sub-Counties';
			array_push($result,$value);
		}

		$partner_result = $this->get_partner_details();
		foreach($partner_result as $key => $value3){
			$value3['grp_type'] = 'Implementing Partners';
			array_push($result,$value3);	
		}
		
		$facility_result = $this->get_facility_details();
		foreach($facility_result as $key => $value4){
			$value4['grp_type'] = 'Facilities';
			array_push($result,$value4);	
		}
		return $result;
	}

	public function get_tests_details($search=NULL,$start=NULL,$end=NULL)
	{
		$sql = "CALL `proc_dt_tests`('$search','$start','$end')";
		$result = R::getAll($sql);
		return $result;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
/* End of file api_m.php */
/* Location: ./application/modules/api/models/api_m.php */