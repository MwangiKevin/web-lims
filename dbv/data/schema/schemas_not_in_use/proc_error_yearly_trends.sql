DROP PROCEDURE IF EXISTS `proc_error_yearly_trends`;

CREATE PROCEDURE proc_error_yearly_trends (user_group_id int(11), user_filter_used int(11), year int(4))
	BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
		
			SELECT 
				MONTH(`tst`.`result_date`) AS `month`, 
				SUM(CASE WHEN `tst`.`valid`= '1' THEN 1 ELSE 0 END) AS `valid`,
				 SUM(CASE WHEN `tst`.`valid`= '0' THEN 1 ELSE 0 END) AS `errors`, 
				CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth` 
			
			FROM `cd4_test` `tst`
			LEFT JOIN `facility` `fac`
			    ON `tst`.`facility_id` = `fac`.`id`
			
			WHERE 1 
			AND YEAR(`tst`.`result_date`) = `year` 
			AND `tst`.`result_date` <= CURDATE()
			GROUP BY `yearmonth`;
		ELSE			
			CASE `user_group_id`
			WHEN 3 THEN
			
				SELECT 
					MONTH(`tst`.`result_date`) AS `month`, 
					SUM(CASE WHEN `tst`.`valid`= '1' THEN 1 ELSE 0 END) AS `valid`,
					 SUM(CASE WHEN `tst`.`valid`= '0' THEN 1 ELSE 0 END) AS `errors`, 
					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth` 
				
				FROM `cd4_test` `tst`
				LEFT JOIN `facility` `fac`
				    ON `tst`.`facility_id` = `fac`.`id`
				
				 WHERE 1 
				 AND YEAR(`tst`.`result_date`) = `year` 
				 AND `fac`.`partner_id` = `user_filter_used`
				 AND `tst`.`result_date` <= CURDATE()
				 GROUP BY `yearmonth`;
			
			WHEN 9 THEN
			
				SELECT 
					MONTH(`tst`.`result_date`) AS `month`, 
					SUM(CASE WHEN `tst`.`valid`= '1' THEN 1 ELSE 0 END) AS `valid`,
					 SUM(CASE WHEN `tst`.`valid`= '0' THEN 1 ELSE 0 END) AS `errors`, 
					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth` 
				
				FROM `cd4_test` `tst`
				LEFT JOIN `facility` `fac`
				    ON `tst`.`facility_id` = `fac`.`id`
				LEFT JOIN `sub_county` `sub`
				ON `sub`.`id` = `fac`.`sub_county_id`
				
				WHERE 1 
				AND YEAR(`tst`.`result_date`) = `year`
				AND `sub`.`county_id` = `user_filter_used`
				AND `tst`.`result_date` <= CURDATE()
				GROUP BY `yearmonth`;
			WHEN 8 THEN
			
				SELECT 
					MONTH(`tst`.`result_date`) AS `month`, 
					SUM(CASE WHEN `tst`.`valid`= '1' THEN 1 ELSE 0 END) AS `valid`,
					 SUM(CASE WHEN `tst`.`valid`= '0' THEN 1 ELSE 0 END) AS `errors`, 
					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth` 
				
				FROM `cd4_test` `tst`
				LEFT JOIN `facility` `fac`
				    ON `tst`.`facility_id` = `fac`.`id`
				
				WHERE 1 
				AND YEAR(`tst`.`result_date`) = `year`
				AND `fac`.`sub_county_id` = `user_filter_used`
				AND `tst`.`result_date` <= CURDATE()
				GROUP BY `yearmonth`;
				
			WHEN 6 THEN
			
				SELECT 
					MONTH(`tst`.`result_date`) AS `month`, 
					SUM(CASE WHEN `tst`.`valid`= '1' THEN 1 ELSE 0 END) AS `valid`,
					 SUM(CASE WHEN `tst`.`valid`= '0' THEN 1 ELSE 0 END) AS `errors`, 
					CONCAT(YEAR(`tst`.`result_date`),'-',MONTH(`tst`.`result_date`)) AS `yearmonth` 
				
				FROM `cd4_test` `tst`
				LEFT JOIN `facility` `fac`
				    ON `tst`.`facility_id` = `fac`.`id`
				
				WHERE 1 
				AND YEAR(`tst`.`result_date`) = `year`
				AND `fac`.`id` = `user_filter_used`
				AND `tst`.`result_date` <= CURDATE()
				GROUP BY `yearmonth`;

			END CASE;
		END CASE;		
	END;