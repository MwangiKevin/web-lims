CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_equipment_yearly_testing_trends_column`(user_group_id int(11),user_filter_used int(11))
BEGIN
	CASE `user_filter_used`
		WHEN 0 THEN
		
			SELECT 
				`d`.`name` AS `equipment_name`,
				YEAR(`c_t`.`result_date`) AS `year`,
				COUNT(*) as `count`,
				SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
			FROM `device` `d`
				LEFT JOIN `cd4_test` `c_t`
				ON `c_t`.`device_id` = `d`.`id`
			WHERE 1
				AND `c_t`.`result_date`<= CURDATE()
			GROUP BY `d`.`name`,`year` 
			ORDER BY `d`.`name` ASC;
		ELSE	
			CASE `user_group_id`
			WHEN 4 THEN
			
				SELECT 
					`d`.`name` AS `equipment_name`,
					YEAR(`c_t`.`result_date`) AS `year`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
				FROM `device` `d`
					LEFT JOIN `cd4_test` `c_t`
					ON `c_t`.`device_id` = `d`.`id`
				LEFT JOIN `facility` `f`
					ON `c_t`.`facility_id` = `f`.`id`
				WHERE 1
					AND `c_t`.`result_date`<= CURDATE()
					AND `partner_id` = `user_filter_used`
				GROUP BY `d`.`name`,`year` 
			ORDER BY `d`.`name` ASC;
				
			WHEN 3 THEN
			
				SELECT 
					`dev`.`name` AS `equipment_name`,
					YEAR(`c_t`.`result_date`) AS `year`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
				FROM `device` `dev`
					LEFT JOIN `cd4_test` `c_t`
					ON `c_t`.`device_id` = `dev`.`id`
					LEFT JOIN `facility` `f`
					ON `c_t`.`facility_id` = `f`.`id`
					LEFT JOIN `sub_county` `s_c`
					ON `s_c`.`id` = `f`.`sub_county_id`
				WHERE 1
					AND `c_t`.`result_date`<= CURDATE()
					AND `county_id` = `user_filter_used`
				GROUP BY `dev`.`name`,`year` 
				ORDER BY `dev`.`name` ASC;
				
			WHEN 2 THEN
				SELECT 
					`dev`.`name` AS `equipment_name`,
					YEAR(`c_t`.`result_date`) AS `year`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
				FROM `device` `dev`
					LEFT JOIN `cd4_test` `c_t`
					ON `c_t`.`device_id` = `dev`.`id`
					LEFT JOIN `facility` `f`
					ON `c_t`.`facility_id` = `f`.`id`
					LEFT JOIN `sub_county` `s_c`
					ON `s_c`.`id` = `f`.`sub_county_id`
				WHERE 1
					AND `c_t`.`result_date`<= CURDATE()
					AND `sub_county_id` = `user_filter_used`
				GROUP BY `dev`.`name`,`year` 
				ORDER BY `dev`.`name` ASC;
			WHEN 1 THEN
				SELECT 
					`d`.`name` AS `equipment_name`,
					YEAR(`c_t`.`result_date`) AS `year`,
					COUNT(*) as `count`,
					SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`			
				FROM `device` `d`
					LEFT JOIN `cd4_test` `c_t`
					ON `c_t`.`device_id` = `d`.`id`
				LEFT JOIN `facility` `f`
					ON `c_t`.`facility_id ` = `f`.`id`
				WHERE 1
					AND `c_t`.`result_date`<= CURDATE()
					AND `facility_id` = `user_filter_used`
				GROUP BY `d`.`name`,`year` 
				ORDER BY `d`.`name` ASC;
			
			END CASE;
				END CASE;
END