CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tests_line_trend`(user_group_id int(11),user_filter_used int(11), from_date date,to_date date)
BEGIN	
							CASE `user_filter_used`
							WHEN 0 THEN
							
								SELECT
									COUNT(*) AS `total`,
									MONTH(`c_t`.`result_date`) AS `month`,
									YEAR(`c_t`.`result_date`) AS `YEAR`,
									CONCAT(YEAR(`c_t`.`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
									SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 500 THEN 1 ELSE 0 END ) AS `failed`,
									SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` >= 500 THEN 1 ELSE 0 END ) AS `passed`,
									SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
									SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
								FROM `cd4_test` `c_t`
								WHERE `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
								AND `c_t`.`result_date` <= CURDATE() 
								GROUP BY 	`yearmonth`
								ORDER BY 	`c_t`.`result_date` DESC;
								
							ELSE
								CASE `user_group_id`
								WHEN 4 THEN
									SELECT
										COUNT(*) AS `total`,
										MONTH(`c_t`.`result_date`) AS `month`,
										YEAR(`c_t`.`result_date`) AS `YEAR`,
										CONCAT(YEAR(`c_t`.`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 500 THEN 1 ELSE 0 END ) AS `failed`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` >= 500 THEN 1 ELSE 0 END ) AS `passed`,
										SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
										SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
										
									FROM `cd4_test` `c_t`
									LEFT JOIN facility `f`
										ON `c_t`.`facility_id` = `f`.`id`
									WHERE `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
									AND `partner_id` = `user_filter_used`
									AND `c_t`.`result_date` <= CURDATE() 
									GROUP BY 	`yearmonth`
									ORDER BY 	`c_t`.`result_date` DESC;
								WHEN 1 THEN
									SELECT
										COUNT(*) AS `total`,
										MONTH(`c_t`.`result_date`) AS `month`,
										YEAR(`c_t`.`result_date`) AS `YEAR`,
										CONCAT(YEAR(`c_t`.`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 500 THEN 1 ELSE 0 END ) AS `failed`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` >= 500 THEN 1 ELSE 0 END ) AS `passed`,
										SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
										SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`
										
									FROM `cd4_test` `c_t`
									WHERE `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
									AND `c_t`.`facility_id` = `user_filter_used`
									AND `c_t`.`result_date` <= CURDATE() 
									GROUP BY 	`yearmonth`
									ORDER BY 	`c_t`.`result_date` DESC;
								WHEN 2 THEN
									SELECT
										COUNT(*) AS `total`,
										MONTH(`c_t`.`result_date`) AS `month`,
										YEAR(`c_t`.`result_date`) AS `YEAR`,
										CONCAT(YEAR(`c_t`.`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 500 THEN 1 ELSE 0 END ) AS `failed`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` >= 500 THEN 1 ELSE 0 END ) AS `passed`,
										SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
										SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
										
										`f`.`sub_county_id` AS `sub_county_id` 	
										
									FROM `cd4_test` `c_t`
									LEFT JOIN facility `f`
										ON `c_t`.`facility_id` = `f`.`id`
									WHERE `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
									AND `sub_county_id` = `user_filter_used`
									AND `c_t`.`result_date` <= CURDATE()
									GROUP BY 	`yearmonth`
									ORDER BY 	`c_t`.`result_date` DESC;
								WHEN 3 THEN
									SELECT
										COUNT(*) AS `total`,
										MONTH(`c_t`.`result_date`) AS `month`,
										YEAR(`c_t`.`result_date`) AS `YEAR`,
										CONCAT(YEAR(`c_t`.`result_date`),'-',MONTH(`result_date`)) AS `yearmonth`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` < 500 THEN 1 ELSE 0 END ) AS `failed`,
										SUM(CASE WHEN `c_t`.`patient_age_group_id`='3' AND `c_t`.`valid`= '1' AND `c_t`.`cd4_count` >= 500 THEN 1 ELSE 0 END ) AS `passed`,
										SUM(CASE WHEN `c_t`.`valid`= '0'    THEN 1 ELSE 0 END) AS `errors`,	
										SUM(CASE WHEN `c_t`.`valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,
										
										`d`.`county_id` AS `county_id`	
										
									FROM `cd4_test` `c_t`
									LEFT JOIN facility `f`
										ON `c_t`.`facility_id` = `f`.`id`
									LEFT JOIN `sub_county` `d`
										ON `d`.`id` = `f`.`sub_county_id`
									WHERE `c_t`.`result_date` BETWEEN `from_date` AND  `to_date`
									AND `county_id` = `user_filter_used`
									AND `c_t`.`result_date` <= CURDATE()
									GROUP BY 	`yearmonth`
									ORDER BY 	`result_date` DESC;
								END CASE;
							END CASE;
						END