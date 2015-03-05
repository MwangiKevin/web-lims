DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_get_facilities`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_facilities`(f_id int(2))
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
                                `f`.`google_maps`           as `facility_google_maps`
                            FROM `facility` `f` 
                            WHERE 1 
                        ";

        IF (f_id = 0 || f_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `f`.`id`=', f_id, '');
        END IF;

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END$$

DELIMITER ;