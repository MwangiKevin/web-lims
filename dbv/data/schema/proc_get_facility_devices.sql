DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_get_facility_devices`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_facility_devices`(id int(11),fac_id int(11))
BEGIN
        SET @QUERY =    " SELECT 
                                `dev`.`name`                        AS  `device_name`,
                                `f_d`.`id`                          AS  `facility_device_id`,
                                `f_d`.`facility_id`                 ,
                                `f_d`.`device_id`                   ,
                                `f_d`.`status`                      ,
                                `f_d`.`deactivation_reason`         ,
                                `f_d`.`date_added`                  ,
                                `f_d`.`date_removed`                ,
                                `f_d`.`serial_number`                               
                            FROM `facility_device` `f_d`
                                LEFT JOIN `device` `dev`
                                ON `dev`.`id`=`f_d`.`device_id`
                            WHERE 1 
                        ";



        IF (id != 0 && id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `f_d`.`id`='",id,"' ");
        END IF;

        IF (fac_id != 0 && fac_id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `f_d`.`facility_id`='",fac_id,"' ");
        END IF;


        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END$$

DELIMITER ;