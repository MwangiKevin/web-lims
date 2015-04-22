DELIMITER $$

DROP PROCEDURE IF EXISTS `web-lims`.`proc_get_commodities`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `web-lims`.`proc_get_commodities`(C_id int(11),reporting_status int(2))
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

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END$$

DELIMITER ;