CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_expected_reporting_dev_array_removed`(user_group_id int(11),user_filter_used int(11))
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		
		SELECT
			`t1`.`date_removed` as `rank_date`,
			`t1`.`yearmonth`,
			`t1`.`month`, 
			`t1`.`removed`, 
			SUM(`t2`.`removed`) AS `cumulative`
		FROM
			(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
				`date_removed`, 
				MONTH(`date_removed`) AS `month`,
				COUNT(*) AS `removed` 			
			FROM `facility_device` `fac_dev`
			LEFT JOIN `device` `dev`
				ON `fac_dev`.`device_id`= `dev`.`id`	 
			WHERE `date_removed` <> '0000-00-00'
			AND `device_id` = '4' 
			GROUP BY `yearmonth`) AS `t1` 
		INNER JOIN 
			(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
				`date_removed`, 
				MONTH(`date_removed`) AS `month`,
				COUNT(*) AS `removed` 			
			FROM `facility_device` `fac_dev`
            LEFT JOIN `device` `dev`
            	ON `fac_dev`.`device_id`= `dev`.`id`
			WHERE `date_removed` <> '0000-00-00'
			AND `device_id` = '4' 
			GROUP BY `yearmonth`) AS `t2` 
			ON `t1`.`date_removed` >= `t2`.`date_removed` 							
			group by `t1`.`date_removed`;
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT
				`t1`.`date_removed` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`removed`, 
				SUM(`t2`.`removed`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_device` `fac_dev`
				LEFT JOIN `device` `dev`
					ON `fac_dev`.`device_id`= `dev`.`id`	
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id` 
				LEFT JOIN `partner` `par`
					ON `fac`.`partner_id` = `par`.`id`
				WHERE `date_removed` <> '0000-00-00'
				AND `device_id` = '4' 
				AND `par`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
	            	ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id`
				LEFT JOIN `partner` `par`
					ON `fac`.`partner_id` = `par`.`id`
				WHERE `date_removed` <> '0000-00-00'
				AND `device_id` = '4' 
				AND `par`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
				ON `t1`.`date_removed` >= `t2`.`date_removed` 							
				group by `t1`.`date_removed`;
				
		WHEN 9 THEN
		
			SELECT
				`t1`.`date_removed` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`removed`, 
				SUM(`t2`.`removed`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_device` `fac_dev`
				LEFT JOIN `device` `dev`
					ON `fac_dev`.`device_id`= `dev`.`id`	
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id` 
				LEFT JOIN `sub_county` `sub`
					ON `fac`.`sub_county_id` = `sub`.`id`
				LEFT JOIN `county` `cou`
					ON `sub`.`county_id` = `cou`.`id`
				WHERE `date_removed` <> '0000-00-00'
				AND `device_id` = '4' 
				AND `cou`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
	            	ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id`
				LEFT JOIN `sub_county` `sub`
					ON `fac`.`sub_county_id` = `sub`.`id`
				LEFT JOIN `county` `cou`
					ON `sub`.`county_id` = `cou`.`id`
				WHERE `date_removed` <> '0000-00-00'
				AND `device_id` = '4' 
				AND `cou`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
				ON `t1`.`date_removed` >= `t2`.`date_removed` 							
				group by `t1`.`date_removed`;
		
		WHEN 8 THEN
		
			SELECT
				`t1`.`date_removed` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`removed`, 
				SUM(`t2`.`removed`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_device` `fac_dev`
				LEFT JOIN `device` `dev`
					ON `fac_dev`.`device_id`= `dev`.`id`	
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id` 
				LEFT JOIN `sub_county` `sub`
					ON `sub`.`id` = `fac`.`sub_county_id`
				WHERE `date_removed` <> '0000-00-00'
				AND `device_id` = '4' 
				AND `sub`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
	            	ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id` 
				LEFT JOIN `sub_county` `sub`
					ON `sub`.`id` = `fac`.`sub_county_id`
				WHERE `date_removed` <> '0000-00-00'
				AND `device_id` = '4' 
				AND `sub`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
				ON `t1`.`date_removed` >= `t2`.`date_removed` 							
				group by `t1`.`date_removed`;
				
		WHEN 6 THEN
		
			SELECT
				`t1`.`date_removed` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`removed`, 
				SUM(`t2`.`removed`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_device` `fac_dev`
				LEFT JOIN `device` `dev`
					ON `fac_dev`.`device_id`= `dev`.`id`	
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id` 
				WHERE `date_removed` <> '0000-00-00'
				AND `device_id` = '4' 
				AND `fac`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`date_removed`),'-',MONTH(`date_removed`)) AS `yearmonth`,
					`date_removed`, 
					MONTH(`date_removed`) AS `month`,
					COUNT(*) AS `removed` 			
				FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
	            	ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id`
				WHERE `date_removed` <> '0000-00-00'
				AND `device_id` = '4' 
				AND `fac`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
				ON `t1`.`date_removed` >= `t2`.`date_removed` 							
				group by `t1`.`date_removed`;
		END CASE;
	END CASE;
END