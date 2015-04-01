CREATE TRIGGER `trig_create_temp_fcdrr` 
	AFTER INSERT ON `facility`
 		FOR EACH ROW 
 			INSERT INTO temp_fcdrr (`facility_id`)
  			VALUES (NEW.id)