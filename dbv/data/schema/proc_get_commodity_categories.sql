DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_get_commodity_categories`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_commodity_categories`(C_id int(2))
BEGIN


        SET @QUERY =    " SELECT 
                                `c`.`id`                as `commodity_category_id`,
                                `c`.`name`              as `commodity_category_name`,
                                `c`.`equipment_id`      as `commodity_category_equipment_id`
                            FROM `commodity_category` `c` 
                            WHERE 1 
                        ";

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