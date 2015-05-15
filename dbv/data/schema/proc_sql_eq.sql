DROP PROCEDURE IF EXISTS `proc_get_devices`;

CREATE PROCEDURE `proc_get_devices`(d_id int(2),cat_id int(2))
	BEGIN
		SET @QUERY = 	"
							SELECT 
								`name` as `device_name`,
								`id` 
							FROM `device` "

		SET @QUERY = CONCAT(@QUERY,  " ORDER BY `name` ASC "); 

		PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
	END;