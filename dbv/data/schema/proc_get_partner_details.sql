DROP PROCEDURE IF EXISTS `proc_get_partner_details`;

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_partner_details`()
BEGIN 
			SELECT 
				`par`.`id`,
				`par`.`name`,
				`par`.`id`  AS `partner_id`,
				`par`.`name` AS `partner_name`,
				`par`.`email` AS `partner_email`,
				`par`.`phone` AS `partner_phone`,
				`par_cnty`.`county_id`,
				`cnty`.`name` AS `county_name`,

            --  delimiters for filters

	            '1' AS `filter_type`,
	            `par`.`id`  AS `filter_id`
			   
			FROM
				`partner` `par`
			LEFT JOIN 
				`partner_counties` `par_cnty`
			ON
				`par`.`id` = `par_cnty`.`partner_id`
			LEFT JOIN
				`county` `cnty`
			ON
				`cnty`.`id` = `par_cnty`.`county_id`; 
		END;