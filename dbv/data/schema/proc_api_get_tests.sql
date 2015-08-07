CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_tests`( T_id int(11),search varchar(255), order_col varchar(35), order_dir varchar(10), limit_start int(3), limit_items int(3),get_count varchar(10),filter_type int(11),filter_id int(11))
BEGIN

        SET @QUERY =    "SELECT
                            `cd4t`.`id`,
                            `cd4t`.`sample`,
                            `cd4t`.`result_date`,
                            `cd4t`.`facility_device_id`,
                            `cd4t`.`valid`,
                            `cd4t`.`timestamp`  AS 'test_timestamp',
                            `cd4t`.`file_date_time` AS 'upload_date',
                            `cd4t`.`cd4_count`,                            
                            `fd`.`serial_number`AS `device_serial_number`,
                            `fc`.`id`           AS `facility_id`,
                            `fc`.`name`         AS `facility_name`,
                            `sub`.`name`        AS `sub_county_name`,
                            `sub`.`id`          AS `sub_county_id`,
                            `cnt`.`name`        AS `county_name`,
                            `cnt`.`id`          AS `county_id`,
                            `d`.`name`          AS `device_name`
                        FROM `cd4_test` `cd4t`
                        LEFT JOIN `facility` `fc` ON `cd4t`.`facility_id` = `fc`.`id`
                        LEFT JOIN `sub_county` `sub` ON `fc`.`sub_county_id` = `sub`.`id`
                        LEFT JOIN `county` `cnt` ON `sub`.`county_id` = `cnt`.`id`
                        LEFT JOIN `facility_device` `fd` ON `fd`.`id` = `cd4t`.`facility_device_id`
                            LEFT JOIN `device` `d` ON `d`.`id` = `fd`.`device_id`
                        WHERE 1   
                        ";

        IF (get_count = 'true')
        THEN
            SET @QUERY =    "SELECT
                              COUNT(*) AS `count`
                            FROM `cd4_test` `cd4t`
                            LEFT JOIN `facility` `fc` ON `cd4t`.`facility_id` = `fc`.`id`
                            LEFT JOIN `sub_county` `sub` ON `fc`.`sub_county_id` = `sub`.`id`
                            LEFT JOIN `county` `cnt` ON `sub`.`county_id` = `cnt`.`id`
                            LEFT JOIN `facility_device` `fd` ON `fd`.`id` = `cd4t`.`facility_device_id`
                                LEFT JOIN `device` `d` ON `d`.`id` = `fd`.`device_id`
                            WHERE 1   
                            ";
        ELSE

            SET @QUERY = @QUERY;
        END IF;


        IF (T_id = 0 || T_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `cd4t`.`id`=', T_id, ' ');
        END IF;

        IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND (`cnt`.`name` LIKE "%', search, '%" OR `fc`.`name` LIKE "%', search, '%" OR `fc`.`mfl_code` LIKE "%', search, '%" OR `fd`.`serial_number` LIKE "%', search, '%" OR `cd4t`.`sample` LIKE "%', search, '%")');
        END IF;

        CASE 
            WHEN (filter_type = 1 ) 
                THEN    SET @QUERY   = CONCAT(@QUERY," AND `cd4t`.`facility_id` = '",`filter_id`,"' ");
            WHEN (filter_type = 2 ) 
                THEN    SET @QUERY   = CONCAT(@QUERY," AND `sub`.`id` = '",`filter_id`,"' ");
            WHEN (filter_type = 3 ) 
                THEN    SET @QUERY   = CONCAT(@QUERY," AND `cnt`.`id` = '",`filter_id`,"' ");
            WHEN (filter_type = 4 ) 
                THEN    SET @QUERY   = CONCAT(@QUERY," AND `fc`.`partner_id` = '",`filter_id`,"' ");
            WHEN (filter_type = 5 ) 
                THEN    SET @QUERY   = CONCAT(@QUERY," AND `cd4t`.`facility_device_id` = '",`filter_id`,"' ");
            ELSE
                SET @QUERY = @QUERY;
        END CASE;
        
       CASE 
            WHEN ((order_col = '' || order_col IS NULL) AND (get_count <> 'true'))
                THEN SET @QUERY = CONCAT(@QUERY, ' ORDER BY `id`  asc ');

            WHEN ((get_count <> 'true') AND order_col <> '' AND order_col IS NOT NULL)
                THEN SET @QUERY = CONCAT(@QUERY, ' ORDER BY ', order_col ,' ', order_dir, ' ');
            ELSE
                SET @QUERY = @QUERY;
        END CASE; 


        CASE 
            WHEN (limit_start = 0 || limit_start = '') AND (limit_items > 0 || limit_items <> '') AND  (get_count <> 'true') AND  (filter_type <> -1)
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT  0 ,  ', limit_items, ' ');
            WHEN (limit_start > 0 || limit_start <> '') AND (limit_items > 0 || limit_items <> '') AND    (get_count <> 'true') AND  (filter_type <> -1)
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT ',limit_start,' , ', limit_items, ' ');
            WHEN  (filter_type = -1)
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT  0  ');
            ELSE
                SET @QUERY = @QUERY;
        END CASE;

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        -- SELECT @QUERY;
        -- SHOW ERRORS;
    END