CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_report_types`(P_id int(11),U_id int(11),search varchar(25), order_col varchar(35), order_dir varchar(10), limit_start int(3), limit_items int(3),get_count varchar(10))
BEGIN 
	SET @QUERY =    "SELECT 
							`typ`.`id`,
							`typ`.`report_name`,
                            `typ`.`description`,
                            `typ`.`relative_url`,
                            `typ`.`periodic_interval`,
                            `typ`.`last_batch_sending`
						FROM `report_type` `typ` 
                        WHERE 1                          
						";


        IF (U_id = 0 || U_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY =    "SELECT 
                            `typ`.`id`,
                            `typ`.`report_name`,
                            `typ`.`description`,
                            `typ`.`relative_url`,
                            `typ`.`periodic_interval`,
                            `typ`.`last_batch_sending`,
                             CASE WHEN `rus`.`id`  IS NULL THEN 0 ELSE 1 END AS `subscribed`
                        FROM `report_type` `typ`
                            LEFT JOIN `report_user_subscription` `rus`
                            ON `rus`.`report_type_id` = `typ`.`id`   
                        ";
            SET @QUERY = CONCAT(@QUERY, ' AND `rus`.`aauth_user_id`=', U_id, ' WHERE 1 ');
        END IF;



        IF (get_count = 'true')
        THEN
            SET @QUERY =    "SELECT
                                  COUNT(*) AS `count`
                                FROM `report_type` `typ`  
                                LEFT JOIN `report_user_subscription` `rus`
                                    ON `rus`.`report_type_id` = `typ`.`id` 
                                WHERE 1                            
                            ";

        ELSE
            SET @QUERY = @QUERY;

        END IF;

        IF (P_id = 0 || P_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `typ`.`id`=', P_id, ' ');
        END IF;

        IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `typ`.`report_name` LIKE "%', search, '%" ');
        END IF;



        CASE 
            WHEN ((order_col = '' || order_col IS NULL) AND (get_count <> 'true'))
                THEN SET @QUERY = CONCAT(@QUERY, ' ORDER BY `typ`.`report_name`  asc ');

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