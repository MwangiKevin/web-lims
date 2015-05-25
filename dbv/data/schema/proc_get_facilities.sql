DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_get_facilities`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_facilities`(f_id int(2), search varchar(25), limit_start int(3), limit_items int(3))
BEGIN

        SET @QUERY =    " SELECT 
                                `f`.`id`                    as `facility_id`,
                                `f`.`name`                  as `facility_name`,
                                `f`.`mfl_code`              as `facility_mfl_code`,
                                `f`.`site_prefix`           as `facility_site_prefix`,
                                `f`.`sub_county_id`         as `facility_sub_county_id`,
                                `f`.`partner_id`            as `facility_partner_id`,
                                `f`.`facility_type_id`      as `facility_type_id`,
                                `f`.`level`                 as `facility_level`,
                                `f`.`central_site_id`       as `facility_central_site_id`,
                                `f`.`email`                 as `facility_email`,
                                `f`.`phone`                 as `facility_phone`,
                                `f`.`rollout_status`        as `facility_rollout_status`,
                                `f`.`rollout_date`          as `facility_rollout_date`,
                                `f`.`google_maps`           as `facility_google_maps`,
                                `p`.`name`                  as `partner_name`,
                                `sc`.`name`                 as `sub_county_name`,
                                `c`.`name`                  as `county_name`,
                                `central_site`.`name`       as `central_site_name`,
                                `ft`.`initials`             as `affiliation`
                            FROM `facility` `f` 
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

        IF (f_id = 0 || f_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `f`.`id`=', f_id, '');
        END IF;


        IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND (`f`.`name` LIKE "%', search, '%"');
            SET @QUERY = CONCAT(@QUERY, ' OR  `f`.`mfl_code` LIKE "%', search, '%")');
        END IF;


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
    END$$

DELIMITER ;