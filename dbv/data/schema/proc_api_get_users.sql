CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_users`(C_id int(11),search varchar(25), order_col varchar(35), order_dir varchar(10), limit_start int(3), limit_items int(3),get_count varchar(10))
BEGIN
		SET @QUERY =    "SELECT 	
                                `u`.`id`,
                                `u`.`id` AS `user_id`,
                                `u`.`name` AS `user_name`,
                                `u`.`email`,
                                `u`.`banned`,
                                `u`.`last_login`,
                                `u`.`last_activity`
                            FROM `aauth_users` `u`
                            WHERE 1							
						";
        IF (get_count = 'true')
        THEN
            SET @QUERY =    "SELECT  
                                   COUNT(*) AS `count`
                                FROM `aauth_users`
                                WHERE 1 
                            ";
        ELSE
            SET @QUERY = @QUERY;
        END IF;

  
        IF (C_id = 0 || C_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `u`.`id`=', C_id, ' ');
        END IF;

        IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `u`.`name` LIKE "%', search, '%" ');
        END IF;

        -- SET @QUERY = CONCAT(@QUERY, ' GROUP BY `u`.`id` ORDER BY `u`.`name` ASC ');

        
        CASE 
            WHEN ((order_col = '' || order_col IS NULL) AND (get_count <> 'true'))
                THEN SET @QUERY = CONCAT(@QUERY, ' ORDER BY `u`.`id`  asc ');

            WHEN ((get_count <> 'true') AND order_col <> '' AND order_col IS NOT NULL)
                THEN SET @QUERY = CONCAT(@QUERY, ' ORDER BY ', order_col ,' ', order_dir, ' ');
            ELSE
                SET @QUERY = @QUERY;
        END CASE; 


   
        CASE 
            WHEN (limit_start = 0 || limit_start = '') AND (limit_items > 0 || limit_items <> '') AND  (get_count <> 'true')
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT  0 ,  ', limit_items, ' ');
            WHEN (limit_start > 0 || limit_start <> '') AND (limit_items > 0 || limit_items <> '') AND    (get_count <> 'true')
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT ',limit_start,' , ', limit_items, ' ');
            ELSE
                SET @QUERY = @QUERY;
        END CASE;


        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        -- SELECT @QUERY;
        -- SHOW ERRORS;
    END