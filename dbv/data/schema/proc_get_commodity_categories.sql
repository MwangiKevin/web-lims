DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_get_commodity_categories`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_commodity_categories`()
BEGIN


        SET @QUERY =    " SELECT 
                                `c`.`id`                as `commodity_category_id`,
                                `c`.`name`              as `commodity_category_name`,
                                `c`.`equipment_id`      as `commodity_category_equipment_id`
                            FROM `commodity_category` `c` 
                            WHERE 1 
                        ";

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END$$

DELIMITER ;