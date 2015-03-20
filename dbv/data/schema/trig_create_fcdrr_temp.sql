CREATE TRIGGER `trig_create_fcdrr_temp` 
	AFTER INSERT ON `facility`
 		FOR EACH ROW 
 			INSERT INTO fcdrr_temp (`facility_id`)
  			VALUES (NEW.id)