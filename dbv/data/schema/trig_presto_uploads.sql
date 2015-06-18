CREATE DEFINER=`root`@`localhost` TRIGGER trig_presto_uploads AFTER INSERT ON presto_cd4_tests
FOR EACH ROW
  BEGIN
	DECLARE cd4_test_id int(6);
	DECLARE the_device_id int(6);
	DECLARE facility_device_id int(6);
	DECLARE facility_id int(6);

	SELECT `AUTO_INCREMENT` INTO @cd4_test_id
						FROM  INFORMATION_SCHEMA.TABLES
						WHERE TABLE_SCHEMA = 'web-lims'
						AND   TABLE_NAME   = 'cd4_test';
	SELECT fd.id,
		fd.facility_id,
		fd.device_id
	INTO @facility_device_id,@facility_id,@the_device_id
	FROM facility_device fd WHERE 
		serial_number=NEW.serial_number LIMIT 1;

	INSERT INTO cd4_test(id,cd4_count,patient_age_group_id,sample,device_id,facility_device_id,facility_id,run_date_time,valid,timestamp,file_date_time)
						values(@cd4_test_id,NEW.cd4_count,3,NEW.sample_code,@the_device_id,@facility_device_id,@facility_id,NEW.run_date_time,NEW.valid_test,NOW(),NEW.file_date);

END