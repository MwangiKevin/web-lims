CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_fcdrrs`(fcdrr_id int(11),facility_id int(11),yr int(4),mnth int(2),search varchar(25), order_col varchar(35), order_dir varchar(10), limit_start int(3), limit_items int(3),get_count varchar(10),filter_type int(11),filter_id int(11))
BEGIN
        SET @QUERY =    " SELECT 
                                `fcdrr`.`id`                       as  `id` ,
                                `fcdrr`.`id`                       as  `fcdrr_id` ,
                                `fcdrr`.`facility_id`              ,
                                `f`.`mfl_code`                     as `facility_mfl_code`,
                                `f`.`name`                         as `facility_name`,
                                `fcdrr`.`from_date`                ,
                                `fcdrr`.`to_date`                  ,
                                `fcdrr`.`year`                     ,
                                `fcdrr`.`month`                    ,
                                `fcdrr`.`calibur_tests_adults`     ,
                                `fcdrr`.`calibur_tests_pead`       ,
                                `fcdrr`.`count_tests_adults`       ,
                                `fcdrr`.`count_tests_pead`         ,
                                `fcdrr`.`cyflow_tests_adults`      ,
                                `fcdrr`.`cyflow_tests_pead`        ,
                                `fcdrr`.`pima_tests`               ,
                                `fcdrr`.`adults_bel_cl`            ,
                                `fcdrr`.`pead_bel_cl`              ,
                                `fcdrr`.`comments`                 ,
                                `fcdrr`.`timestamp`         
                            FROM `fcdrr`
                                LEFT JOIN `facility` `f`
                                ON `f`.`id` =  `fcdrr`.`facility_id`
                                    LEFT JOIN `partner` `p`
                                    ON `p`.`id`=`f`.`partner_id`
                                        LEFT JOIN `sub_county` `sc` 
                                        ON `sc`.`id`=`f`.`sub_county_id`
                                            LEFT JOIN `county` `c`
                                            ON `c`.`id`=`sc`.`county_id`

                            WHERE 1 
                        ";
        IF (get_count = 'true')
        THEN        SET @QUERY =    " SELECT 
                                          COUNT(*) AS `count`
                                    FROM `fcdrr`
                                            LEFT JOIN `facility` `f`
                                            ON `f`.`id` =  `fcdrr`.`facility_id`
                                                LEFT JOIN `partner` `p`
                                                ON `p`.`id`=`f`.`partner_id`
                                                    LEFT JOIN `sub_county` `sc` 
                                                    ON `sc`.`id`=`f`.`sub_county_id`
                                                        LEFT JOIN `county` `c`
                                                        ON `c`.`id`=`sc`.`county_id`

                                    WHERE 1 
                                ";
        ELSE

            SET @QUERY = @QUERY;
        END IF;



        IF (fcdrr_id != 0 && fcdrr_id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `fcdrr`.`id`='",fcdrr_id,"' ");
        END IF;

        IF (facility_id != 0 && facility_id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `fcdrr`.`facility_id`='",facility_id,"' ");
        END IF;

        IF (yr != 0 && yr != '' && mnth != 0 && mnth != '') THEN
            SET @QUERY = CONCAT(@QUERY," AND `fcdrr`.`from_date` = '",yr,"-",mnth,"-1' " ); 
        END IF;




        IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND (`f`.`name` LIKE "%', search, '%" ');
            SET @QUERY = CONCAT(@QUERY, ' OR  `f`.`mfl_code` LIKE "%', search, '%") ');
        END IF;


        CASE 
            WHEN (filter_type = 1 ) 
                THEN    SET @QUERY   = CONCAT(@QUERY," AND `f`.`id` = '",`filter_id`,"' ");
            WHEN (filter_type = 2 ) 
                THEN    SET @QUERY   = CONCAT(@QUERY," AND `sc`.`id` = '",`filter_id`,"' ");
            WHEN (filter_type = 3 ) 
                THEN    SET @QUERY   = CONCAT(@QUERY," AND `c`.`id` = '",`filter_id`,"' ");
            WHEN (filter_type = 4 ) 
                THEN    SET @QUERY   = CONCAT(@QUERY," AND `p`.`id` = '",`filter_id`,"' ");
            ELSE
                SET @QUERY = @QUERY;
        END CASE;

        CASE 
            WHEN ((order_col = '' || order_col IS NULL) AND (get_count <> 'true'))
                THEN     SET @QUERY = CONCAT(@QUERY," ORDER BY 'from_date' DESC" ); 

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
        SELECT @QUERY;
    END