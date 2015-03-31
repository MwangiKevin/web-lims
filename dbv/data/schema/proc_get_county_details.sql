DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_get_county_details`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE  `proc_get_county_details` (C_id int(11)) 
			BEGIN
				SET @QUERY =    "SELECT 	

									`cnt`.`id`,
									`cnt`.`name`,	
									`cnt`.`id`					AS `region_id`,
									`cnt`.`name`				AS `region_name`,
				                
									`par_cnt`.`partner_id`,
									`par`.`name`				AS `partner_name`,
									`par`.`email`				AS `partner_email`,
									`par`.`phone`				AS `partner_phone`,

				                    '3' AS `filter_type`,
						            `par`.`id`  AS `filter_id`

								FROM `county` `cnt`
									LEFT OUTER JOIN `partner_counties` `par_cnt`
									ON `cnt`.`id` = `par_cnt`.`county_id`
										LEFT JOIN `partner` `par`
										ON `par_cnt`.`partner_id`=`par`.`id`

								GROUP BY `cnt`.`id`
								ORDER BY `cnt`.`name` ASC";
  
        IF (C_id = 0 || C_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' WHERE `sub`.`id`=', C_id, '');
        END IF;

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END$$

DELIMITER ;		
