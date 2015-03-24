DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_get_fcdrrs`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_fcdrrs`(fcdrr_id int(11),facility_id int(11),year int(4),month int(2))
BEGIN
        SET @QUERY =    " SELECT 
                                `fcdrr`.`id`                       as  `fcdrr_id`,
                                `fcdrr`.`facility_id`              ,
                                `fcdrr`.`from_date`                ,
                                `fcdrr`.`to_date`                  ,
                                `fcdrr`.`year`                     ,
                                `fcdrr`.`month`                    ,
                                `fcdrr`.`calibur_tests_adults`     ,
                                `fcdrr`.`calibur_tests_pead`       ,
                                `fcdrr`.`caliburs`                 ,
                                `fcdrr`.`count_tests_adults`       ,
                                `fcdrr`.`count_tests_pead`         ,
                                `fcdrr`.`counts`                   ,
                                `fcdrr`.`cyflow_tests_adults`      ,
                                `fcdrr`.`cyflow_tests_pead`        ,
                                `fcdrr`.`cyflows`                  ,
                                `fcdrr`.`adults_bel_cl`            ,
                                `fcdrr`.`pead_bel_cl`              ,
                                `fcdrr`.`comments`                 ,
                                `fcdrr`.`upload_timestamp`         
                            FROM `fcdrr`

                            WHERE 1 
                        ";



        IF (fcdrr_id != 0 && fcdrr_id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `fcdrr`.`id`='",fcdrr_id,"' ");
        END IF;

        IF (facility_id != 0 && facility_id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `fcdrr`.`facility_id`='",facility_id,"' ");
        END IF;

        IF (year != 0 && year != '' && month != 0 && month != '') THEN
            SET @QUERY = CONCAT(@QUERY," AND `fcdrr`.`from_date` = '",year,"-",month,"-1' " ); 
        END IF;


        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END$$

DELIMITER ;