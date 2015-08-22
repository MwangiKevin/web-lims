CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_sub_counties`(sc_id int(11),search varchar(25), order_col varchar(35), order_dir varchar(10), limit_start int(3), limit_items int(3),get_count varchar(10))
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

									WHERE 1 
						";
        IF (get_count = 'true')
        THEN
            SET @QUERY =    "SELECT
                                  COUNT(*) AS `count`
                                FROM `sub_county` `s_cnt`

                                    LEFT JOIN `county` `cnt`
                                    ON  `s_cnt`.`county_id` = `cnt`.`id`
                                        LEFT OUTER JOIN `partner_counties` `par_cnt`
                                        ON `cnt`.`id` = `par_cnt`.`county_id`
                                            LEFT JOIN `partner` `par`
                                            ON `par_cnt`.`partner_id`=`par`.`id`

                                            WHERE 1 
                            ";
        ELSE

            SET @QUERY = @QUERY;
        END IF;

  
        IF (sc_id = 0 || sc_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `s_cnt`.`id`=', sc_id, ' ');
        END IF;


        IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `s_cnt`.`name` LIKE "%', search, '%" ');
        END IF;


        -- SET @QUERY = CONCAT(@QUERY, ' GROUP BY `s_cnt`.`id` ORDER BY `s_cnt`.`name` ASC ');

        CASE 
            WHEN ((order_col = '' || order_col IS NULL) AND (get_count <> 'true'))
                THEN SET @QUERY = CONCAT(@QUERY, ' ORDER BY `s_cnt`.`id`  asc ');

            WHEN ((get_count <> 'true') AND order_col <> '' AND order_col IS NOT NULL)
                THEN SET @QUERY = CONCAT(@QUERY, ' ORDER BY ', order_col ,' ', order_dir, ' ');
            ELSE
                SET @QUERY = @QUERY;
        END CASE; 


   
        CASE 
            WHEN (limit_start = 0 || limit_start = '') AND (limit_items > 0 || limit_items <> '') AND (limit_items <> -1)  AND  (get_count <> 'true')
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT  0 ,  ', limit_items, ' ');
            WHEN (limit_start > 0 || limit_start <> '') AND (limit_items > 0 || limit_items <> '') AND (limit_items <> -1)  AND    (get_count <> 'true')
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT ',limit_start,' , ', limit_items, ' ');
            ELSE
                SET @QUERY = @QUERY;
        END CASE;

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        -- SELECT @QUERY;
        -- SHOW ERRORS;
    END