DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_get_devices_per_county`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_devices_per_county`()

	BEGIN
		

		SELECT COUNT(fd.id) AS "no_per_county" , c.name AS county

			FROM 	device d,
					facility f,
					sub_county sc ,
					county c,
					facility_device fd

			WHERE

				d.id = fd.device_id 	AND
				f.id = fd.facility_id 	AND
				f.sub_county_id = sc.id AND
				sc.county_id = c.id
			GROUP BY
				c.id, fd.device_id;

END $$

DELIMITER ;

SHOW ERRORS;
