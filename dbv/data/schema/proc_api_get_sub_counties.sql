CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_sub_counties`(sc_id int(11))
BEGIN
				SET @QUERY =    "SELECT 	

									`s_cnt`	.`id`,
									`s_cnt`	.`name`,	
									`s_cnt`	.`id`				AS `sub_county_id`,
									`s_cnt`	.`name`				AS `sub_county_name`,	
									`cnt`	.`id`				AS `county_id`,
									`cnt`	.`name`				AS `county_name`,
				                
									`par_cnt`.`partner_id`,

									`par`.`name`				AS `partner_name`,
									`par`.`email`				AS `partner_email`,
									`par`.`phone`				AS `partner_phone`

								FROM `sub_county` `s_cnt`

									LEFT JOIN `county` `cnt`
									ON	`s_cnt`.`county_id` = `cnt`.`id`
										LEFT OUTER JOIN `partner_counties` `par_cnt`
										ON `cnt`.`id` = `par_cnt`.`county_id`
											LEFT JOIN `partner` `par`
											ON `par_cnt`.`partner_id`=`par`.`id`
								";
  
        IF (sc_id = 0 || sc_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' WHERE `s_cnt`.`id`=', sc_id, ' ');
        END IF;


        SET @QUERY = CONCAT(@QUERY, ' GROUP BY `s_cnt`.`id` ORDER BY `s_cnt`.`name` ASC ');

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END;