DROP PROCEDURE IF EXISTS `proc_reported_devices`

DELIMITER $$
CREATE PROCEDURE `proc_reported_devices`(user_group_id int(11),user_filter_used int(11),year int(11))
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT 
			`t1`.`month`,
			COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
		FROM (
				SELECT 
					DISTINCT `tst`.`facility_equipment_id`,
					MONTH(`pim_upl`.`upload_date`) AS `month`
				FROM `cd4_test` `tst`
					LEFT JOIN `pima_test` `pim_tst`
					ON `pim_tst`.`cd4_test_id`=`tst`.`id`
						LEFT JOIN `pima_upload` `pim_upl`
						ON `pim_upl`.`id` = `pim_tst`.`pima_upload_id`
				WHERE 1 
				AND YEAR(`pim_upl`.`upload_date`) = `year`
			)AS `t1`				
		GROUP BY `t1`.`month` ;
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
			SELECT 
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM (
					SELECT 
						DISTINCT `tst`.`facility_equipment_id`,
						MONTH(`pim_upl`.`upload_date`) AS `month`
					FROM `cd4_test` `tst`
						LEFT JOIN `pima_test` `pim_tst`
						ON `pim_tst`.`cd4_test_id`=`tst`.`id`
							LEFT JOIN `pima_upload` `pim_upl`
							ON `pim_upl`.`id` = `pim_tst`.`pima_upload_id`
                    	LEFT JOIN `facility` `f`
	                	ON `f`.`id` = `tst`.`facility_id`
					WHERE 1 
					AND YEAR(`pim_upl`.`upload_date`) = `year`
	                AND `f`.`partner_id` = `user_filter_used`
				 )AS `t1`					
			GROUP BY `t1`.`month`;
			
		WHEN 9 THEN 
		
			SELECT
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM 
				(
					SELECT 
						DISTINCT `tst`.`facility_equipment_id`,
						MONTH(`pim_upl`.`upload_date`) AS `month`
					FROM `cd4_test` `tst`
						LEFT JOIN `pima_test` `pim_tst`
							ON `pim_tst`.`cd4_test_id`=`tst`.`id`
						LEFT JOIN `pima_upload` `pim_upl`
							ON `pim_upl`.`id` = `pim_tst`.`pima_upload_id`
                		LEFT JOIN `facility` `f`
							ON `f`.`id` = `tst`.`facility_id`
						LEFT JOIN `sub_county` `sub`
							ON `f`.`district_id` = `sub`.`id`
						LEFT JOIN `county` `cou`
							ON `cou`.`id` = `sub`.`county_id`
				WHERE 1 
				AND YEAR(`pim_upl`.`upload_date`) = `year`
                AND `cou`.`id` = `user_filter_used`
				)AS `t1`					
			GROUP BY `t1`.`month`;
			
		WHEN 8 THEN
		
			SELECT
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM 
				(
					SELECT 
						DISTINCT `tst`.`facility_equipment_id`,
						MONTH(`pim_upl`.`upload_date`) AS `month`
					FROM `cd4_test` `tst`
					LEFT JOIN `pima_test` `pim_tst`
						ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `pima_upload` `pim_upl`
						ON `pim_upl`.`id` = `pim_tst`.`pima_upload_id`
					LEFT JOIN `facility` `f`
                    	ON `f`.`id` = `tst`.`facility_id`
					LEFT JOIN `sub_county` `sub`
						ON `sub`.`id` = `f`.`sub_county_id`
				WHERE 1 
				AND YEAR(`pim_upl`.`upload_date`) = `year`
                AND `sub`.`id` = `user_filter_used`
				)AS `t1`					
			GROUP BY `t1`.`month`;
			
		WHEN 6 THEN
			SELECT
				`t1`.`month`,
				COUNT(`t1`.`facility_equipment_id`) AS `reported_devices`
			FROM 
				(
					SELECT 
						DISTINCT `tst`.`facility_equipment_id`,
						MONTH(`pim_upl`.`upload_date`) AS `month`
					FROM `cd4_test` `tst`
					LEFT JOIN `pima_test` `pim_tst`
						ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `pima_upload` `pim_upl`
							ON `pim_upl`.`id` = `pim_tst`.`pima_upload_id`
					LEFT JOIN `facility` `f`
						ON `f`.`id` = `tst`.`facility_id`
					WHERE 1 
					AND YEAR(`pim_upl`.`upload_date`) = `year`
					AND `f`.`id` = `user_filter_used`
					)AS `t1`					
			GROUP BY `t1`.`month`;
			
		END CASE;
	END CASE;
END;
$$
DELIMITER ;