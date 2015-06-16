CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_facility_devices`(user_group_id int(11),user_filter_used int(11) )
BEGIN
		CASE `user_filter_used`
		WHEN 0 THEN
        SELECT 
			`eq`.`equipment_id`,
			`eq`.`equipment`,
			COUNT(*) AS `all`,
			SUM(CASE WHEN (`eq`.`facility_equipment_status_id`<> '4' )    THEN 1 ELSE 0 END) AS `total`,
			SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '1'    THEN 1 ELSE 0 END) AS `functional`,
			SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '2'    THEN 1 ELSE 0 END) AS `broken_down`,
			SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '3'    THEN 1 ELSE 0 END) AS `obsolete`
		FROM 
			(SELECT
									
									`fac_eq`.`id` 			AS `facility_equipment_id`,														
									`eq_cat`.`id`			AS `equipment_category_id`,
									`eq_cat`.`description` 	AS `equipment_category`,	
									`eq`.`id` 				AS `equipment_id`,
									`eq`.`description` 		AS `equipment`,
									`fac_eq`.`status` 		AS `facility_equipment_status_id`,
									`eq_st`.`description`	AS `facility_equipment_status`,
									`fac_eq`.`deactivation_reason` ,															
									`fac_eq`.`date_added` ,													
									`fac_eq`.`date_removed`,																											
									`fac_eq`.`serial_number`,
									`fac`.`id` 				AS `facility_id`,
									`fac`.`name` 			AS `facility_name`,
									`fac`.`email` 			AS `facility_email`,
									`fac`.`phone` 			AS `facility_phone`,
									`fac`.`rollout_status` 	AS `facility_rollout_id`,
									`fac`.`sub_county_id`, 
									`sub`.`name` 			AS `sub_county_name`,
									`sub`.`status` 			AS `sub_county_status`,
									`sub`.`county_id`,
									`cou`.`name`			AS `county_name`,
									`par_cou`.`partner_id`,
									`par`.`name`			AS `partner_name`,
									`par`.`email`			AS `partner_email`,
									`par`.`phone`			AS `partner_phone`

								FROM `facility_equipment` `fac_eq`
									LEFT JOIN `equipment` `eq`
									ON `fac_eq`.`equipment_id`= `eq`.`id`
										LEFT JOIN `equipment_category` `eq_cat`
										ON `eq`.`category`= `eq_cat`.`id`
									LEFT JOIN `facility` `fac`
									ON	`fac_eq`.`facility_id` = `fac`.`id`
										LEFT JOIN `sub_county` `sub`
										ON `fac`.`sub_county_id` = `sub`.`id`
											LEFT JOIN `county` `cou`
											ON `cou`.`id` = `sub`.`county_id`
												LEFT JOIN `partner_counties` `par_cou`
												ON `cou`.`id` = `par_cou`.`county_id`
													LEFT JOIN `partner` `par`
													ON `par_cou`.`partner_id`=`par`.`id`
									LEFT JOIN `equipment_status` `eq_st`
									ON `fac_eq`.`status`=`eq_st`.`id`	
			) `eq`

			WHERE `equipment_category_id`= '1'
		GROUP BY `eq`.`equipment_id`
		ORDER BY `equipment` ASC;
        ELSE				
			CASE `user_group_id`
			WHEN 3 THEN
            SELECT
				
				`fac_eq`.`id` 			AS `facility_equipment_id`,														
				`eq_cat`.`id`			AS `equipment_category_id`,
				`eq_cat`.`description` 	AS `equipment_category`,	
				`eq`.`id` 				AS `equipment_id`,
				`eq`.`description` 		AS `equipment`,
				`fac_eq`.`status` 		AS `facility_equipment_status_id`,
				`eq_st`.`description`	AS `facility_equipment_status`,
				`fac_eq`.`deactivation_reason` ,															
				`fac_eq`.`date_added` ,													
				`fac_eq`.`date_removed`,																											
				`fac_eq`.`serial_number`,
				`fac`.`id` 				AS `facility_id`,
				`fac`.`name` 			AS `facility_name`,
				`fac`.`email` 			AS `facility_email`,
				`fac`.`phone` 			AS `facility_phone`,
				`fac`.`rollout_status` 	AS `facility_rollout_id`,
				`fac`.`sub_county_id`, 
				`sub`.`name` 			AS `sub_county_name`,
				`sub`.`status` 			AS `sub_county_status`,
				`sub`.`county_id`,
				`cou`.`name`			AS `county_name`,
				`par_cou`.`partner_id`,
				`par`.`name`			AS `partner_name`,
				`par`.`email`			AS `partner_email`,
				`par`.`phone`			AS `partner_phone`

			FROM `facility_equipment` `fac_eq`
				LEFT JOIN `equipment` `eq`
				ON `fac_eq`.`equipment_id`= `eq`.`id`
					LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
				ON	`fac_eq`.`facility_id` = `fac`.`id`
					LEFT JOIN `sub_county` `sub`
					ON `fac`.`sub_county_id` = `sub`.`id`
						LEFT JOIN `county` `cou`
						ON `cou`.`id` = `sub`.`county_id`
							LEFT JOIN `partner_counties` `par_cou`
							ON `cou`.`id` = `par_cou`.`county_id`
								LEFT JOIN `partner` `par`
								ON `par_cou`.`partner_id`=`par`.`id`
				LEFT JOIN `equipment_status` `eq_st`
				ON `fac_eq`.`status`=`eq_st`.`id`
				WHERE 1
				AND `par_cou`.`partner_id` = user_group_id;
            	
			WHEN 6 THEN
            SELECT
				
				`fac_eq`.`id` 			AS `facility_equipment_id`,														
				`eq_cat`.`id`			AS `equipment_category_id`,
				`eq_cat`.`description` 	AS `equipment_category`,	
				`eq`.`id` 				AS `equipment_id`,
				`eq`.`description` 		AS `equipment`,
				`fac_eq`.`status` 		AS `facility_equipment_status_id`,
				`eq_st`.`description`	AS `facility_equipment_status`,
				`fac_eq`.`deactivation_reason` ,															
				`fac_eq`.`date_added` ,													
				`fac_eq`.`date_removed`,																											
				`fac_eq`.`serial_number`,
				`fac`.`id` 				AS `facility_id`,
				`fac`.`name` 			AS `facility_name`,
				`fac`.`email` 			AS `facility_email`,
				`fac`.`phone` 			AS `facility_phone`,
				`fac`.`rollout_status` 	AS `facility_rollout_id`,
				`fac`.`sub_county_id`, 
				`sub`.`name` 			AS `sub_county_name`,
				`sub`.`status` 			AS `sub_county_status`,
				`sub`.`county_id`,
				`cou`.`name`			AS `county_name`,
				`par_cou`.`partner_id`,
				`par`.`name`			AS `partner_name`,
				`par`.`email`			AS `partner_email`,
				`par`.`phone`			AS `partner_phone`

			FROM `facility_equipment` `fac_eq`
				LEFT JOIN `equipment` `eq`
				ON `fac_eq`.`equipment_id`= `eq`.`id`
					LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
				ON	`fac_eq`.`facility_id` = `fac`.`id`
					LEFT JOIN `sub_county` `sub`
					ON `fac`.`sub_county_id` = `sub`.`id`
						LEFT JOIN `county` `cou`
						ON `cou`.`id` = `sub`.`county_id`
							LEFT JOIN `partner_counties` `par_cou`
							ON `cou`.`id` = `par_cou`.`county_id`
								LEFT JOIN `partner` `par`
								ON `par_cou`.`partner_id`=`par`.`id`
				LEFT JOIN `equipment_status` `eq_st`
				ON `fac_eq`.`status`=`eq_st`.`id`
				WHERE 1
				AND `fac`.`id` = user_group_id;
				
			WHEN 9 THEN  
            SELECT
				
				`fac_eq`.`id` 			AS `facility_equipment_id`,														
				`eq_cat`.`id`			AS `equipment_category_id`,
				`eq_cat`.`description` 	AS `equipment_category`,	
				`eq`.`id` 				AS `equipment_id`,
				`eq`.`description` 		AS `equipment`,
				`fac_eq`.`status` 		AS `facility_equipment_status_id`,
				`eq_st`.`description`	AS `facility_equipment_status`,
				`fac_eq`.`deactivation_reason` ,															
				`fac_eq`.`date_added` ,													
				`fac_eq`.`date_removed`,																											
				`fac_eq`.`serial_number`,
				`fac`.`id` 				AS `facility_id`,
				`fac`.`name` 			AS `facility_name`,
				`fac`.`email` 			AS `facility_email`,
				`fac`.`phone` 			AS `facility_phone`,
				`fac`.`rollout_status` 	AS `facility_rollout_id`,
				`fac`.`sub_county_id`, 
				`sub`.`name` 			AS `sub_county_name`,
				`sub`.`status` 			AS `sub_county_status`,
				`sub`.`county_id`,
				`cou`.`name`			AS `county_name`,
				`par_cou`.`partner_id`,
				`par`.`name`			AS `partner_name`,
				`par`.`email`			AS `partner_email`,
				`par`.`phone`			AS `partner_phone`

			FROM `facility_equipment` `fac_eq`
				LEFT JOIN `equipment` `eq`
				ON `fac_eq`.`equipment_id`= `eq`.`id`
					LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
				ON	`fac_eq`.`facility_id` = `fac`.`id`
					LEFT JOIN `sub_county` `sub`
					ON `fac`.`sub_county_id` = `sub`.`id`
						LEFT JOIN `county` `cou`
						ON `cou`.`id` = `sub`.`county_id`
							LEFT JOIN `partner_counties` `par_cou`
							ON `cou`.`id` = `par_cou`.`county_id`
								LEFT JOIN `partner` `par`
								ON `par_cou`.`partner_id`=`par`.`id`
				LEFT JOIN `equipment_status` `eq_st`
				ON `fac_eq`.`status`=`eq_st`.`id`
				WHERE 1
				AND `sub`.`county_id` = user_group_id;
				
			WHEN 8 THEN
            SELECT
				
				`fac_eq`.`id` 			AS `facility_equipment_id`,														
				`eq_cat`.`id`			AS `equipment_category_id`,
				`eq_cat`.`description` 	AS `equipment_category`,	
				`eq`.`id` 				AS `equipment_id`,
				`eq`.`description` 		AS `equipment`,
				`fac_eq`.`status` 		AS `facility_equipment_status_id`,
				`eq_st`.`description`	AS `facility_equipment_status`,
				`fac_eq`.`deactivation_reason` ,															
				`fac_eq`.`date_added` ,													
				`fac_eq`.`date_removed`,																											
				`fac_eq`.`serial_number`,
				`fac`.`id` 				AS `facility_id`,
				`fac`.`name` 			AS `facility_name`,
				`fac`.`email` 			AS `facility_email`,
				`fac`.`phone` 			AS `facility_phone`,
				`fac`.`rollout_status` 	AS `facility_rollout_id`,
				`fac`.`sub_county_id`, 
				`sub`.`name` 			AS `sub_county_name`,
				`sub`.`status` 			AS `sub_county_status`,
				`sub`.`county_id`,
				`cou`.`name`			AS `county_name`,
				`par_cou`.`partner_id`,
				`par`.`name`			AS `partner_name`,
				`par`.`email`			AS `partner_email`,
				`par`.`phone`			AS `partner_phone`

			FROM `facility_equipment` `fac_eq`
				LEFT JOIN `equipment` `eq`
				ON `fac_eq`.`equipment_id`= `eq`.`id`
					LEFT JOIN `equipment_category` `eq_cat`
					ON `eq`.`category`= `eq_cat`.`id`
				LEFT JOIN `facility` `fac`
				ON	`fac_eq`.`facility_id` = `fac`.`id`
					LEFT JOIN `sub_county` `sub`
					ON `fac`.`sub_county_id` = `sub`.`id`
						LEFT JOIN `county` `cou`
						ON `cou`.`id` = `sub`.`county_id`
							LEFT JOIN `partner_counties` `par_cou`
							ON `cou`.`id` = `par_cou`.`county_id`
								LEFT JOIN `partner` `par`
								ON `par_cou`.`partner_id`=`par`.`id`
				LEFT JOIN `equipment_status` `eq_st`
				ON `fac_eq`.`status`=`eq_st`.`id`
				WHERE 1
				AND `fac`.`sub_county_id` = user_group_id;
            END CASE;
		END CASE;		
END