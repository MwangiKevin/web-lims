CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_commodities`(C_id int(11), search varchar(25), order_col varchar(35), order_dir varchar(10), limit_start int(3), limit_items int(3),get_count varchar(10),reporting_status int(2))
BEGIN


        SET @QUERY =    " SELECT 
                                `c`.`id`                as `commodity_id`,
                                `c`.`code`              as `commodity_code`,
                                `c`.`name`              as `commodity_name`,
                                `c`.`unit`              as `commodity_unit`,
                                `c`.`category_id`       as `commodity_category_id`,
                                `c`.`reporting_status`  as `commodity_reporting_status`
                            FROM `commodity` `c` 
                            WHERE 1 
                        ";

            IF (get_count = 'true')
        THEN
            SET @QUERY =    "SELECT
                                  COUNT(*) AS `count`
                                FROM `commodity` `c` 
                                WHERE 1     
                            ";
        ELSE

            SET @QUERY = @QUERY;
        END IF;


        IF (reporting_status = 1 || reporting_status = '1')
        THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `c`.`reporting_status`='1' ");
        ELSE
            SET @QUERY = @QUERY;
        END IF;

        IF (C_id = 0 || C_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `c`.`id`=', C_id, '');
        END IF;


                IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND (`c`.`name` LIKE "%', search, '%" ');
            SET @QUERY = CONCAT(@QUERY, ' OR  `c`.`code` LIKE "%', search, '%") ');
        END IF;

        CASE 
            WHEN ((order_col = '' || order_col IS NULL) AND (get_count <> 'true'))
                THEN SET @QUERY = CONCAT(@QUERY, ' ORDER BY `c`.`name`  asc ');

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
        SELECT @QUERY;
    END