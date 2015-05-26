CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_device_pie`(user_group_id int(11),user_filter_used int(11))
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		
		SELECT 
			`equipment`,
			COUNT(*) AS `all`,
			SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> '4' ) THEN 1 ELSE 0 END) AS `count`
		FROM 
		(SELECT 
			`f_dev`.`status` AS `facility_equipment_status_id`, 
			`dev`.`name` AS `equipment`, 
			`f_dev`.`id` AS `facility_equipment_id`, 
			`dev`.`status` AS `equipment_category_id`
		FROM `facility_device` `f_dev`
		LEFT JOIN `device` `dev`
			ON `f_dev`.`device_id` =  `dev`.`id`
		GROUP BY `facility_equipment_id`) `eq_s`
		
		WHERE `equipment_category_id`	=	'1'
 		GROUP BY `equipment`
		ORDER BY `count` desc;
	 ELSE 
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT 
				`equipment`,
				COUNT(*) AS `all`,
				SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
				`f`.`partner_id` AS `partner_id`
			FROM 
			
				(SELECT 
					`f_dev`.`status` AS `facility_equipment_status_id`, 
					`dev`.`name` AS `equipment`, 
					`f_dev`.`id` AS `facility_equipment_id`, 
					`f_dev`.`facility_id`,
					`dev`.`status` AS `equipment_category_id`
				FROM `facility_device` `f_dev`
				LEFT JOIN `device` `dev`
					ON `f_dev`.`device_id` =  `dev`.`id`
				GROUP BY `facility_equipment_id`) `eq_s`
				
			LEFT JOIN `facility` `f`
				ON `f`.`id` = `eq_s`.`facility_id`									
			WHERE `equipment_category_id`	=	'1'
			AND `f`.`partner_id` = `user_filter_used`
	 		GROUP BY `equipment`
			ORDER BY `count` desc; 
	 		 
		WHEN 9 THEN
			
			SELECT 
					`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
					`f`.`sub_county_id`
			FROM 
				
					(SELECT 
						`f_dev`.`status` AS `facility_equipment_status_id`, 
						`dev`.`name` AS `equipment`, 
						`f_dev`.`id` AS `facility_equipment_id`,
							`f_dev` .`facility_id` AS facility_id,
						`dev`.`status` AS `equipment_category_id`
					FROM `facility_device` `f_dev`
					LEFT JOIN `device` `dev`
						ON `f_dev`.`device_id` =  `dev`.`id`
					GROUP BY `facility_equipment_id`) `eq_s`

			LEFT JOIN `facility` `f`
				ON `eq_s`.`facility_id` = 	`f`.`id`
			LEFT JOIN `sub_county` `d`				
            	ON `f`.`sub_county_id` = `d`.`id`
				WHERE  `eq_s`.`equipment_category_id` = '1'
			AND `county_id` = `user_filter_used`
		 		GROUP BY `equipment`
				ORDER BY `count` desc;
		WHEN 8 THEN
		
			SELECT 
					`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
					`f`.`sub_county_id`
			FROM 
				
					(SELECT 
						`f_dev`.`status` AS `facility_equipment_status_id`, 
						`dev`.`name` AS `equipment`, 
						`f_dev`.`id` AS `facility_equipment_id`,
                        `f_dev` .`facility_id` AS `facility_id`,
						`dev`.`status` AS `equipment_category_id`
					FROM `facility_device` `f_dev`
					LEFT JOIN `device` `dev`
						ON `f_dev`.`device_id` =  `dev`.`id`
					GROUP BY `facility_equipment_id`) `eq_s`

			LEFT JOIN `facility` `f`
				ON `eq_s`.`facility_id` = 	`f`.`id`
			LEFT JOIN `sub_county` `d`				
            	ON `f`.`sub_county_id` = `d`.`id`
				WHERE  `eq_s`.`equipment_category_id` = '1'
			AND `sub_county_id` = `user_filter_used`
		 		GROUP BY `equipment`
				ORDER BY `count` desc;
		
		WHEN 6 THEN
		
			SELECT 
					`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
					`f`.`id`
			FROM 
				
					(SELECT 
						`f_dev`.`status` AS `facility_equipment_status_id`, 
						`dev`.`name` AS `equipment`, 
						`f_dev`.`id` AS `facility_equipment_id`,
						`f_dev` .`facility_id` AS `facility_id`,
						`dev`.`status` AS `equipment_category_id`
					FROM `facility_device` `f_dev`
					LEFT JOIN `device` `dev`
						ON `f_dev`.`device_id` =  `dev`.`id`
					GROUP BY `facility_equipment_id`) `eq_s`

			LEFT JOIN `facility` `f`
				ON `eq_s`.`facility_id` = 	`f`.`id`
			WHERE  `eq_s`.`equipment_category_id` = '1'
			AND `facility_id` = '0'
		 		GROUP BY `equipment`
				ORDER BY `count` desc;
			
		END CASE;
	END CASE;
END