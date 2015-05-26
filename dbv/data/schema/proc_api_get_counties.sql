CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_counties`(C_id int(11),search varchar(25), limit_start int(3), limit_items int(3))
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

										WHERE 1 
								";
  
        IF (C_id = 0 || C_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `cnt`.`id`=', C_id, ' ');
        END IF;

        IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `cnt`.`name` LIKE "%', search, '%" ');
        END IF;

        SET @QUERY = CONCAT(@QUERY, ' GROUP BY `cnt`.`id` ORDER BY `cnt`.`name` ASC ');

        CASE 
            WHEN (limit_start = 0 || limit_start = '') AND (limit_items <> 0 || limit_items <> '') 
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT  0 ,  ', limit_items, ' ');
            WHEN (limit_start <> 0 || limit_start <> '') AND (limit_items <> 0 || limit_items <> '')
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT ',limit_start,' , ', limit_items, ' ');
            ELSE
                SET @QUERY = @QUERY;
        END CASE;

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END;