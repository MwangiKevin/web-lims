<?php
/**
* 
*/
class uploads_model extends MY_Model
{
	
	function import_pima_dev($data = NULL)
	{
		echo "<pre>";print_r($data);die();
		$sql = "INSERT INTO
						`pima_export_data`
				(`test_id`,`device_id`,`assay_id`,`export_error_message`)
				VALUES
					('$data[0]','$data[1]','$data[2]','$data[3]')";

		$result = $this->db->query($sql);
		return $result;
	}

	function import_pima_beads($data = NULL)
	{
		echo "<pre>";print_r($data);die();
		$sql = "INSERT INTO
						`pima_export_data`
				(`test_id`,`device_id`,`assay_id`,`assay_name`,`sample`,`cd3+cd4+value(cell/mm3)`,`error_message`,`operator`,`result_date`,`bar_code`,`expiry_date`,`device`,`software_version`)
				VALUES
					('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8] $data[9]','$data[10]','$data[11]','$data[12]','$data[13]')";

		$result = $this->db->query($sql);
		return $result;
	}

	function import_pima_cd4($data = NULL)
	{
		echo "<pre>";print_r($data);die();
		$sql = "INSERT INTO
						`pima_export_data`
				('test_id','device_id','assay_id',)
				VALUES
					('$data[0]','$data[1]','$data[2]','$data[3]','','','','')";

		$result = $this->db->query($sql);
		return $result;
	}

	function import_unknown($data = NULL)
	{
		echo "<pre>";print_r($data);die();
		$sql = "INSERT INTO
						`pima_export_data`
				('test_id','device_id','assay_id',)
				VALUES
					('$data[0]','$data[1]','$data[2]','$data[3]','','','','')";

		$result = $this->db->query($sql);
		return $result;
	}
}
?>