CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_equipment_test_table`(from_date date,to_date date,user_group_id int(11), user_filter_used int(11))
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN	
			SELECT 
				`dev`.`name` AS `equipment_name`,
				COUNT(*) as `count`,
				SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
				SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
			FROM `cd4_test`  `tst`
				LEFT JOIN `facility` `f`
				ON `tst`.`facility_id`=`f`.`id`			
					LEFT JOIN `partner` `p`
					ON `f`.`partner_id` =`p`.`id`
					LEFT JOIN `sub_county` `s_c`
					ON `f`.`sub_county_id` = `s_c`.`id`
						LEFT JOIN `county` `c`
						ON `s_c`.`county_id` = `c`.`id`
					LEFT JOIN `facility_device` `fac_dev`
					ON `tst`.`facility_device_id`=`fac_dev`.`id`
						LEFT JOIN `device` `dev`
						ON `fac_dev`.`device_id` = `dev`.`id`

				WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
				AND `tst`.`result_date` <= CURDATE()

			GROUP BY `equipment_name`
			ORDER BY `equipment_name` DESC;
            
			CASE `user_group_id`
			WHEN 3 THEN	
				SELECT 
					`dev`.`name` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
				FROM `cd4_test`  `tst`
					LEFT JOIN `facility` `f`
				ON `tst`.`facility_id`=`f`.`id`			
					LEFT JOIN `partner` `p`
					ON `f`.`partner_id` =`p`.`id`
					LEFT JOIN `sub_county` `s_c`
					ON `f`.`sub_county_id` = `s_c`.`id`
						LEFT JOIN `county` `c`
						ON `s_c`.`county_id` = `c`.`id`
					LEFT JOIN `facility_device` `fac_dev`
					ON `tst`.`facility_device_id`=`fac_dev`.`id`
						LEFT JOIN `device` `dev`
						ON `fac_dev`.`device_id` = `dev`.`id`

					WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
                    AND `p`.`id` = `user_filter_used`
					AND `tst`.`result_date` <= CURDATE()

			GROUP BY `equipment_name`
			ORDER BY `equipment_name` DESC;
			WHEN 6 THEN
				SELECT 
					`dev`.`name` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
				FROM `cd4_test`  `tst`
					LEFT JOIN `facility` `f`
					ON `tst`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
						LEFT JOIN `sub_county` `s_c`
						ON `f`.`sub_county_id` = `s_c`.`id`
							LEFT JOIN `county` `c`
							ON `s_c`.`county_id` = `c`.`id`
						LEFT JOIN `facility_device` `fac_dev`
						ON `tst`.`facility_device_id`=`fac_dev`.`id`
							LEFT JOIN `device` `dev`
							ON `fac_dev`.`device_id` = `dev`.`id`

					WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
                    AND `f`.`id` = `user_filter_used`
					AND `tst`.`result_date` <= CURDATE()

				GROUP BY `equipment_name`
				ORDER BY `equipment_name` DESC;
			WHEN 8 THEN
				SELECT 
					`dev`.`name` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
				FROM `cd4_test`  `tst`
					LEFT JOIN `facility` `f`
					ON `tst`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
						LEFT JOIN `sub_county` `s_c`
						ON `f`.`sub_county_id` = `s_c`.`id`
							LEFT JOIN `county` `c`
							ON `s_c`.`county_id` = `c`.`id`
						LEFT JOIN `facility_device` `fac_dev`
						ON `tst`.`facility_device_id`=`fac_dev`.`id`
							LEFT JOIN `device` `dev`
							ON `fac_dev`.`device_id` = `dev`.`id`

					WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
                    AND `s_c`.`id` = `user_filter_used`
					AND `tst`.`result_date` <= CURDATE()

				GROUP BY `equipment_name`
				ORDER BY `equipment_name` DESC;
			WHEN 9 THEN
				SELECT 
					`dev`.`name` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
				FROM `cd4_test`  `tst`
					LEFT JOIN `facility` `f`
					ON `tst`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
						LEFT JOIN `sub_county` `s_c`
						ON `f`.`sub_county_id` = `s_c`.`id`
							LEFT JOIN `county` `c`
							ON `s_c`.`county_id` = `c`.`id`
						LEFT JOIN `facility_device` `fac_dev`
						ON `tst`.`facility_device_id`=`fac_dev`.`id`
							LEFT JOIN `device` `dev`
							ON `fac_dev`.`device_id` = `dev`.`id`

					WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
                    AND `c`.`id` = `user_filter_used`
					AND `tst`.`result_date` <= CURDATE()

				GROUP BY `equipment_name`
				ORDER BY `equipment_name` DESC;
			WHEN 12 THEN    
				SELECT 
					`dev`.`name` AS `equipment_name`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
					SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
				FROM `cd4_test`  `tst`
					LEFT JOIN `facility` `f`
					ON `tst`.`facility_id`=`f`.`id`			
						LEFT JOIN `partner` `p`
						ON `f`.`partner_id` =`p`.`id`
						LEFT JOIN `sub_county` `s_c`
						ON `f`.`sub_county_id` = `s_c`.`id`
							LEFT JOIN `county` `c`
							ON `s_c`.`county_id` = `c`.`id`
						LEFT JOIN `facility_device` `fac_dev`
						ON `tst`.`facility_device_id`=`fac_dev`.`id`
							LEFT JOIN `device` `dev`
							ON `fac_dev`.`device_id` = `dev`.`id`

					WHERE `tst`.`result_date` BETWEEN `from_date` AND `to_date`
                    AND `fac_dev`.`id` = `user_filter_used`
					AND `tst`.`result_date` <= CURDATE()

				GROUP BY `equipment_name`
				ORDER BY `equipment_name` DESC;
		END CASE;
	END CASE;	
END