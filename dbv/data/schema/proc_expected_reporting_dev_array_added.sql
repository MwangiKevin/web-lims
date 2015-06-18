DELIMITER $$
DROP procedure IF exists `proc_expected_reporting_dev_array_added`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_expected_reporting_dev_array_added`(user_group_id int(11),user_filter_used int(11))
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		
		SELECT
			`t1`.`date_added` as `rank_date`,
			`t1`.`yearmonth`,
			`t1`.`month`, 
			`t1`.`rolledout`, 
			SUM(`t2`.`rolledout`) AS `cumulative`
		FROM
			(SELECT 	CONCAT(YEAR(`fac_dev`.`date_added`),'-',MONTH(`fac_dev`.`date_added`)) AS `yearmonth`,
             			`fac_dev`.`date_added`, 
						MONTH(`fac_dev`.`date_added`) AS `month`,
						COUNT(*) AS `rolledout` 

			FROM `facility_device` `fac_dev`
            LEFT JOIN `device` `dev`
            	ON `fac_dev`.`device_id`= `dev`.`id`
			WHERE `fac_dev`.`date_added` <> '0000-00-00'
			AND `dev`.`id` = '4' 
			AND `fac_dev`.`status` <> '4' 
			GROUP BY `yearmonth`) AS `t1` 
		INNER JOIN 
			(SELECT 	CONCAT(YEAR(`fac_dev`.`date_added`),'-',MONTH(`fac_dev`.`date_added`)) AS `yearmonth`,
             			`fac_dev`.`date_added`, 
						MONTH(`fac_dev`.`date_added`) AS `month`,
						COUNT(*) AS `rolledout` 			
            FROM `facility_device` `fac_dev`
            LEFT JOIN `device` `dev`
		        ON `fac_dev`.`device_id`= `dev`.`id`
			WHERE `fac_dev`.`date_added` <> '0000-00-00'
			AND `dev`.`id` = '4' 
			AND `fac_dev`.`status` <> '4' 
			GROUP BY `yearmonth`) AS `t2` 
		ON `t1`.`date_added` >= `t2`.`date_added` 
		group by `t1`.`date_added`;
		
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT
				`t1`.`date_added` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`rolledout`, 
				SUM(`t2`.`rolledout`) AS `cumulative`
			FROM
(SELECT 	CONCAT(YEAR(`fac_dev`.`date_added`),'-',MONTH(`fac_dev`.`date_added`)) AS `yearmonth`,
             		`fac_dev`.`date_added`, 
					MONTH(`fac_dev`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout` 

				FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
            		ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id`
 				LEFT JOIN `partner` `par`
 					ON `par`.`id` = `fac`.`partner_id`
				WHERE `fac_dev`.`date_added` <> '0000-00-00'
				AND `dev`.`id` = '4'
				AND `fac_dev`.`status` <> '4' 
				AND `par`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1`
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`fac_dev`.`date_added`),'-',MONTH(`fac_dev`.`date_added`)) AS `yearmonth`,
             			`fac_dev`.`date_added`, 
						MONTH(`fac_dev`.`date_added`) AS `month`,
						COUNT(*) AS `rolledout`
 			
	            FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
			        ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
			        ON	`fac_dev`.`facility_id` = `fac`.`id`
                 LEFT JOIN `partner` `par`
 					ON `par`.`id` = `fac`.`partner_id`
				WHERE `fac_dev`.`date_added` <> '0000-00-00'
				AND `dev`.`id` = '4' 
				AND `fac_dev`.`status` <> '4' 
				AND `par`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
			ON `t1`.`date_added` >= `t2`.`date_added` 
			GROUP BY `t1`.`date_added`;
		
		WHEN 9 THEN
		
			SELECT
				`t1`.`date_added` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`rolledout`, 
				SUM(`t2`.`rolledout`) AS `cumulative`
			FROM
(SELECT 	CONCAT(YEAR(`fac_dev`.`date_added`),'-',MONTH(`fac_dev`.`date_added`)) AS `yearmonth`,
             			`fac_dev`.`date_added`, 
						MONTH(`fac_dev`.`date_added`) AS `month`,
						COUNT(*) AS `rolledout`
 			
	            FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
			        ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id`
				LEFT JOIN `sub_county` `s_c`
					ON `fac`.`sub_county_id` = `s_c`.`id`
				LEFT JOIN `county` `cou`
					ON `cou`.`id` = `s_c`.`county_id`
				WHERE `fac_dev`.`date_added` <> '0000-00-00'
				AND `dev`.`id` = '4' 
				AND `fac_dev`.`status` <> '4' 
				AND `cou`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1`
			INNER JOIN 
			(SELECT 	CONCAT(YEAR(`fac_dev`.`date_added`),'-',MONTH(`fac_dev`.`date_added`)) AS `yearmonth`,
             			`fac_dev`.`date_added`, 
						MONTH(`fac_dev`.`date_added`) AS `month`,
						COUNT(*) AS `rolledout`
 			
	            FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
			        ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
        			ON	`fac_dev`.`facility_id` = `fac`.`id`
				LEFT JOIN `sub_county` `s_c`
					ON `fac`.`sub_county_id` = `s_c`.`id`
				LEFT JOIN `county` `cou`
					ON `cou`.`id` = `s_c`.`county_id`
				WHERE `fac_dev`.`date_added` <> '0000-00-00'
				AND `dev`.`id` = '4' 
				AND `fac_dev`.`status` <> '4' 
				AND `cou`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
			ON `t1`.`date_added` >= `t2`.`date_added` 
			GROUP BY `t1`.`date_added`;
			
		WHEN 8 THEN
			SELECT
				`t1`.`date_added` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`rolledout`, 
				SUM(`t2`.`rolledout`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`fac_dev`.`date_added`),'-',MONTH(`fac_dev`.`date_added`)) AS `yearmonth`,
             		`fac_dev`.`date_added`, 
					MONTH(`fac_dev`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout` 

				FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
	            	ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
			        ON	`fac_dev`.`facility_id` = `fac`.`id`
				LEFT JOIN `sub_county` `s_c`
					ON `fac`.`sub_county_id` = `s_c`.`id`
				WHERE `fac_dev`.`date_added` <> '0000-00-00'
				AND `dev`.`id` = '4'
				AND `fac_dev`.`status` <> '4' 
				AND `s_c`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`fac_dev`.`date_added`),'-',MONTH(`fac_dev`.`date_added`)) AS `yearmonth`,
             		`fac_dev`.`date_added`, 
					MONTH(`fac_dev`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout`
 			
	            FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
			        ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
			        ON	`fac_dev`.`facility_id` = `fac`.`id`
				LEFT JOIN `sub_county` `s_c`
					ON `fac`.`sub_county_id` = `s_c`.`id`

				WHERE `fac_dev`.`date_added` <> '0000-00-00'
				AND `dev`.`id` = '4' 
				AND `fac_dev`.`status` <> '4' 
				AND `s_c`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
			ON `t1`.`date_added` >= `t2`.`date_added` 
			group by `t1`.`date_added`;
			
		WHEN 6 THEN
		
			SELECT
				`t1`.`date_added` as `rank_date`,
				`t1`.`yearmonth`,
				`t1`.`month`, 
				`t1`.`rolledout`, 
				SUM(`t2`.`rolledout`) AS `cumulative`
			FROM
				(SELECT 	CONCAT(YEAR(`fac_dev`.`date_added`),'-',MONTH(`fac_dev`.`date_added`)) AS `yearmonth`,
             		`fac_dev`.`date_added`, 
					MONTH(`fac_dev`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout` 

				FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
	            	ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
					ON	`fac_dev`.`facility_id` = `fac`.`id`
				LEFT JOIN `sub_county` `dis`
				ON `fac`.`sub_county_id` = `dis`.`id`
				WHERE `fac_dev`.`date_added` <> '0000-00-00'
				AND `dev`.`id` = '4'
				AND `fac_dev`.`status` <> '4' 
				AND `fac`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t1` 
			INNER JOIN 
				(SELECT 	CONCAT(YEAR(`fac_dev`.`date_added`),'-',MONTH(`fac_dev`.`date_added`)) AS `yearmonth`,
             		`fac_dev`.`date_added`, 
					MONTH(`fac_dev`.`date_added`) AS `month`,
					COUNT(*) AS `rolledout`
 			
	            FROM `facility_device` `fac_dev`
	            LEFT JOIN `device` `dev`
			        ON `fac_dev`.`device_id`= `dev`.`id`
				LEFT JOIN `facility` `fac`
				        ON	`fac_dev`.`facility_id` = `fac`.`id`
                        
				WHERE `fac_dev`.`date_added` <> '0000-00-00'
				AND `dev`.`id` = '4' 
				AND `fac_dev`.`status` <> '4' 
				AND `fac`.`id` = `user_filter_used`
				GROUP BY `yearmonth`) AS `t2` 
			ON `t1`.`date_added` >= `t2`.`date_added` 
			group by `t1`.`date_added`;
		END CASE;
	END CASE;
END$$
DELIMITER ;
