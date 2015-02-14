<?php

class api_m extends MY_Model{
	
	public function get_region_details(){
		 $sql 	=	"CALL get_region_details()";
		 $result = R::getAll($sql);
		 return $result;
	}
	
	public function get_district_details(){
		$sql 	=	"CALL get_district_details()";
		$result = R::getAll($sql);
		return $result;
	}
	
	public function get_lab_details(){
		$sql = "CALL get_lab_details()";
		$result = R::getAll($sql);
		return $result;		
	}
	
	public function get_partner_details(){
		$sql = "CALL get_partner_details()";
		$result = R::getAll($sql);
		return $result;		
	}
	
	public function get_facility_details(){
		$sql = "CALL get_facility_details()";
		$result = R::getAll($sql);
		return $result;
	}
	
	public function get_entities(){
		$result = [];
				
		$dis_result = $this->get_district_details();
		foreach ($dis_result as $key => $value) {
			$value['grp_type'] = 'district';
			array_push($result,$value);
		}
		
		$reg_result = $this->get_region_details();
		foreach($reg_result as $key => $value1){
			$value1['grp_type'] = 'region';
			array_push($result,$value1);	
		}
		
		$lab_result = $this->get_lab_details();
		foreach($lab_result as $key => $value2){
			$value2['grp_type'] = 'lab';
			array_push($result,$value2);	
		}
		
		$par_result = $this->get_partner_details();
		foreach($par_result as $key => $value3){
			$value3['grp_type'] = 'partner';
			array_push($result,$value3);	
		}
		
		$fac_result = $this->get_facility_details();
		foreach($fac_result as $key => $value4){
			$value4['grp_type'] = 'facility';
			array_push($result,$value4);	
		}
		return $result;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
/* End of file api_m.php */
/* Location: ./application/modules/api/models/api_m.php */