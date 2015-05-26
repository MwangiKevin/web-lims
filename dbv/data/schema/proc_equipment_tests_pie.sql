DROP PROCEDURE IF EXISTS `proc_equipment_tests_pie`;
CREATE PROCEDURE `proc_equipment_tests_pie`(from_date date,to_date date,user_group_id int(11),user_filter_used int(11))
	BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
	
		SELECT 
			`e`.`description` AS `equipment_name`,
			COUNT(*) as `count`,
			SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
			SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`				
		FROM `equipment` `e`
			LEFT JOIN `cd4_test` `c_t`
			ON `c_t`.`equipment_id` = `e`.`id`
		WHERE 1
			AND `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
			AND `c_t`.`result_date` <= CURDATE() 
		GROUP BY `equipment_name`
		ORDER BY `equipment_name` ASC;
	
	ELSE	
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT 
				`e`.`description` AS `equipment_name`,
				COUNT(*) as `count`,
				SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
				SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
				 
				`f`.`partner_id` AS `partner_id`
												
			FROM `equipment` `e`
				LEFT JOIN `cd4_test` `c_t`
				ON `c_t`.`equipment_id` = `e`.`id`
				LEFT JOIN facility `f`
				ON `c_t`.`facility_id` = `f`.`id`
			WHERE 1
				AND `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
				AND  `partner_id` = `user_filter_used`
				AND `c_t`.`result_date` <= CURDATE()
			GROUP BY `equipment_name`
			ORDER BY `equipment_name` ASC;
		
		WHEN 9 THEN
		
			SELECT 
				`e`.`description` AS `equipment_name`,
				COUNT(*) as `count`,
				SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
				SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
				 
				`d`.`county_id` AS `county_id` 
												
			FROM `equipment` `e`
				LEFT JOIN `cd4_test` `c_t`
				ON `c_t`.`equipment_id` = `e`.`id`
			   LEFT JOIN facility `f`
					ON `c_t`.`facility_id` = `f`.`id`
				LEFT JOIN `sub_county` `d`
					ON `d`.`id` = `f`.`sub_county_id`
			WHERE 1
				AND `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
				AND  `county_id` = `user_filter_used`
				AND `c_t`.`result_date` <= CURDATE()
			GROUP BY `equipment_name`
			ORDER BY `equipment_name` ASC;
			
		WHEN 8 THEN
		
			SELECT 
				`e`.`description` AS `equipment_name`,
				COUNT(*) as `count`,
				SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
				SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
				 
				`f`.`sub_county_id` AS `sub_county_id`  
												
			FROM `equipment` `e`
			LEFT JOIN `cd4_test` `c_t`
			ON `c_t`.`equipment_id` = `e`.`id`
			LEFT JOIN `facility` `f`
			ON `c_t`.`facility_id` = `f`.`id`
			WHERE 1
				AND `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
				AND  `sub_county_id` = `user_filter_used`
				AND `c_t`.`result_date` <= CURDATE()
			GROUP BY `equipment_name`
			ORDER BY `equipment_name` ASC;
		
		WHEN 6 THEN
		
			SELECT 
				`e`.`description` AS `equipment_name`,
				COUNT(*) as `count`,
				SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
				SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,
				 
				`f`.`sub_county_id` AS `sub_county_id`  
												
			FROM `equipment` `e`
			LEFT JOIN `cd4_test` `c_t`
			ON `c_t`.`equipment_id` = `e`.`id`
			LEFT JOIN `facility` `f`
			ON `c_t`.`facility_id` = `f`.`id`
			WHERE 1
				AND `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
				AND  `facility_id` = `user_filter_used`
				AND `c_t`.`result_date` <= CURDATE()
			GROUP BY `equipment_name`
			ORDER BY `equipment_name` ASC;
		
		END CASE;
	END CASE;
	END;