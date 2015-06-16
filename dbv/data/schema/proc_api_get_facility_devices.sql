CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_facility_devices`(id int(11),fac_id int(11),search varchar(25), order_col varchar(35), order_dir varchar(10), limit_start int(3), limit_items int(3),get_count varchar(10))
BEGIN
        SET @QUERY =    " SELECT 
                                `dev`.`name`                        AS  `device_name`,
                                `f_d`.`id`                          AS  `facility_device_id`,
                                `f_d`.`facility_id`                 AS  `facility_id`,
                                `f_d`.`device_id`                   AS  `device_id`,
                                `f_d`.`status`                      AS  `status`,
                                `f_d`.`deactivation_reason`         AS  `deactivation_reason`,
                                `f_d`.`date_added`                  AS  `date_added`,
                                `f_d`.`date_removed`                AS  `date_removed`,
                                `f_d`.`serial_number`               AS  `serial_number`,
                                `f`.`name`                          AS  `facility_name`,
                                `f`.`mfl_code`                      AS  `facility_mfl_code`,
                                `f`.`site_prefix`                   AS  `facility_site_prefix`,
                                `f`.`sub_county_id`                 AS  `facility_sub_county_id`,
                                `f`.`partner_id`                    AS  `facility_partner_id`,
                                `f`.`facility_type_id`              AS  `facility_type_id`,
                                `f`.`level`                         AS  `facility_level`,
                                `f`.`central_site_id`               AS  `facility_central_site_id`,
                                `f`.`email`                         AS  `facility_email`,
                                `f`.`phone`                         AS  `facility_phone`,
                                `f`.`rollout_status`                AS  `facility_rollout_status`,
                                `f`.`rollout_date`                  AS  `facility_rollout_date`,
                                `f`.`google_maps`                   AS  `facility_google_maps`,
                                `p`.`name`                          AS  `partner_name`,
                                `sc`.`name`                         AS  `sub_county_name`,
                                `c`.`name`                          AS  `county_name`,
                                `central_site`.`name`               AS  `central_site_name`,
                                `ft`.`initials`                     AS  `affiliation`               
                            FROM `facility_device` `f_d`
                                LEFT JOIN `device` `dev`
                                ON `dev`.`id`=`f_d`.`device_id`
                                    LEFT JOIN `facility` `f` 
                                    ON `f_d`.`facility_id` = `f`.`id`
                                        LEFT JOIN `partner` `p`
                                        ON `p`.`id`=`f`.`partner_id`
                                        LEFT JOIN `sub_county` `sc` 
                                        ON `sc`.`id`=`f`.`sub_county_id`
                                            LEFT JOIN `county` `c`
                                            ON `c`.`id`=`sc`.`county_id`
                                        LEFT JOIN `facility` `central_site`
                                        ON `central_site`.`id` = `f`.`central_site_id`
                                        LEFT JOIN `facility_type` `ft`
                                        ON `ft`.`id`=`f`.`facility_type_id`
                            WHERE 1 
                        ";


        IF (get_count = 'true')
        THEN
            SET @QUERY =    "SELECT                                
                                COUNT(*) AS `count`                          
                            FROM `facility_device` `f_d`
                                LEFT JOIN `device` `dev`
                                ON `dev`.`id`=`f_d`.`device_id`
                                LEFT JOIN `facility` `f` 
                                ON `f_d`.`facility_id` = `f`.`id`
                                    LEFT JOIN `partner` `p`
                                    ON `p`.`id`=`f`.`partner_id`
                                    LEFT JOIN `sub_county` `sc` 
                                    ON `sc`.`id`=`f`.`sub_county_id`
                                        LEFT JOIN `county` `c`
                                        ON `c`.`id`=`sc`.`county_id`
                                    LEFT JOIN `facility` `central_site`
                                    ON `central_site`.`id` = `f`.`central_site_id`
                                    LEFT JOIN `facility_type` `ft`
                                    ON `ft`.`id`=`f`.`facility_type_id`
                            WHERE 1 
                            ";
        ELSE

            SET @QUERY = @QUERY;
        END IF;


        IF (id != 0 && id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `f_d`.`id`='",id,"' ");
        END IF;

        IF (fac_id != 0 && fac_id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `f_d`.`facility_id`='",fac_id,"' ");
        END IF;


        IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND (`f`.`name` LIKE "%', search, '%" ');
            SET @QUERY = CONCAT(@QUERY, ' OR  `f_d`.`serial_number` LIKE "%', search, '%"  ');
            SET @QUERY = CONCAT(@QUERY, ' OR  `f`.`mfl_code` LIKE "%', search, '%") ');
        END IF;




        CASE 
            WHEN ((order_col = '' || order_col IS NULL) AND (get_count <> 'true'))
                THEN SET @QUERY = CONCAT(@QUERY, ' ORDER BY `f_d`.`serial_number`  asc ');

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
        SHOW ERRORS;
    END;