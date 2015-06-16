CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_partner_details`(P_id int(11))
BEGIN 
	SET @QUERY =    "SELECT 
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
				`cnty`.`id` = `par_cnty`.`county_id`";

		IF (P_id = 0 || P_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' WHERE `par`.`id`=', P_id, '');
        END IF;

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
END