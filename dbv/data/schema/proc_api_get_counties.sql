CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_counties`(C_id int(11))
BEGIN
				SET @QUERY =    "SELECT 	

									`cnt`.`id`,
									`cnt`.`name`,	
									`cnt`.`id`					AS `region_id`,
									`cnt`.`name`				AS `region_name`,
				                
									`par_cnt`.`partner_id`,
									`par`.`name`				AS `partner_name`,
									`par`.`email`				AS `partner_email`,
									`par`.`phone`				AS `partner_phone`

								FROM `county` `cnt`
									LEFT OUTER JOIN `partner_counties` `par_cnt`
									ON `cnt`.`id` = `par_cnt`.`county_id`
										LEFT JOIN `partner` `par`
										ON `par_cnt`.`partner_id`=`par`.`id`
								";
  
        IF (C_id = 0 || C_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' WHERE `cnt`.`id`=', C_id, ' ');
        END IF;


        SET @QUERY = CONCAT(@QUERY, ' GROUP BY `cnt`.`id` ORDER BY `cnt`.`name` ASC ');

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END;