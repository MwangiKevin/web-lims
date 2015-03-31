DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_get_fcdrrs`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_temp_fcdrrs`(fcdrr_id int(11),facility_id int(11))
BEGIN
        SET @QUERY =    " SELECT 
                                `temp_fcdrr`.`id`                       as  `temp_fcdrr_id` ,
                                `temp_fcdrr`.`facility_id`              ,
                                `f`.`mfl_code`                          as `facility_mfl_code`,
                                `temp_fcdrr`.`from_date`                ,
                                `temp_fcdrr`.`to_date`                  ,
                                `temp_fcdrr`.`year`                     ,
                                `temp_fcdrr`.`month`                    ,
                                `temp_fcdrr`.`calibur_tests_adults`     ,
                                `temp_fcdrr`.`calibur_tests_pead`       ,
                                `temp_fcdrr`.`count_tests_adults`       ,
                                `temp_fcdrr`.`count_tests_pead`         ,
                                `temp_fcdrr`.`cyflow_tests_adults`      ,
                                `temp_fcdrr`.`cyflow_tests_pead`        ,
                                `temp_fcdrr`.`pima_tests`               ,
                                `temp_fcdrr`.`adults_bel_cl`            ,
                                `temp_fcdrr`.`pead_bel_cl`              ,
                                `temp_fcdrr`.`comments`                 ,
                                `temp_fcdrr`.`timestamp`         
                            FROM `temp_fcdrr`
                                LEFT JOIN `facility` `f`
                                ON `f`.`id` =  `temp_fcdrr`.`facility_id`

                            WHERE 1 
                        ";



        IF (fcdrr_id != 0 && fcdrr_id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `temp_fcdrr`.`id`='",fcdrr_id,"' ");
        END IF;

        IF (facility_id != 0 && facility_id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `temp_fcdrr`.`facility_id`='",facility_id,"' ");
        END IF;

        -- IF (year != 0 && year != '' && month != 0 && month != '') THEN
        --     SET @QUERY = CONCAT(@QUERY," AND `fcdrr`.`from_date` = '",year,"-",month,"-1' " ); 
        -- END IF;

            SET @QUERY = CONCAT(@QUERY," ORDER BY 'from_date' DESC" ); 

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END$$

DELIMITER ;