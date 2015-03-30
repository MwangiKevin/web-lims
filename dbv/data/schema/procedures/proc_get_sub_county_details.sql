DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_get_sub_county_details`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE  `proc_get_sub_county_details` (SC_id int(11)) 
					BEGIN
						SET @QUERY =    " SELECT 

											`sub`.`id`,
											`sub`.`name`,
											`sub`.`id` 				AS `sub_county_id`,
											`sub`.`name` 			AS `sub_county_name`,
											`sub`.`status` 			AS `sub_county_status`,
											`sub`.`county_id`,
											`cnt`.`name`			AS `county_name`,
											
											`par_cnt`.`partner_id`,
											`par`.`name`			AS `partner_name`,
											`par`.`email`			AS `partner_email`,
											`par`.`phone`			AS `partner_phone`

										FROM `sub_county` `sub`
											LEFT JOIN `county` `cnt`
											ON `sub`.`county_id` = `cnt`.`id`
												LEFT JOIN `partner_counties` `par_cnt`
												ON `cnt`.`id` = `par_cnt`.`county_id`
													LEFT JOIN `partner` `par`
													ON `par_cnt`.`partner_id`=`par`.`id`

										";
										

        
        IF (SC_id = 0 || SC_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' WHERE `sub`.`id`=', SC_id, '');
        END IF;

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END$$

DELIMITER ;