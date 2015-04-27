DROP TRIGGER IF EXISTS trig_pima_uploads;
delimiter $$

CREATE TRIGGER trig_pima_uploads AFTER INSERT ON pima_raw_upload
FOR EACH ROW
  BEGIN
	DECLARE cd4_test_id int(6);
	DECLARE equipment_id int(6);
	DECLARE facility_equipement_id int(6);
	DECLARE facility_id int(6);

	SELECT `AUTO_INCREMENT` INTO @cd4_test_id
						FROM  INFORMATION_SCHEMA.TABLES
						WHERE TABLE_SCHEMA = 'web-lims'
						AND   TABLE_NAME   = 'cd4_test';
	SELECT 
	fe.id, 
	f.id,
	d.id
	INTO @facility_equipment_id,@facility_id,@equipment_id
	FROM facility_pima fp,facility_equipment fe, facility f,device d WHERE fp.facility_equipment_id=fe.id AND fe.facility_id=f.id AND fe.equipment_id=d.id 
		AND fp.serial_num=NEW.device_serial  LIMIT 1;

	INSERT INTO cd4_test(id,cd4_count,patient_age_group_id,equipment_id,facility_equipment_id,facility_id,result_date,valid,timestamp)
						values(@cd4_test_id,NEW.cd4_count,3,@equipment_id,@facility_equipment_id,@facility_id,NEW.result_date,NEW.valid_test,NEW.start_time);

END;
$$

delimiter ;
SHOW errors;