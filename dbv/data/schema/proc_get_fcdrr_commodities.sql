CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_fcdrr_commodities`(id int(11),fcdrr_id int(11))
BEGIN
        SET @QUERY =    " SELECT 
                                `comm`.`name`                       AS  `commodity_name`,
                                `comm`.`code`                       AS  `commodity_code`,
                                `comm`.`unit`                       AS  `commodity_unit`,
                                `f_comm`.`id`                       AS  `fcdrr_commodity_id`,
                                `f_comm`.`fcdrr_id`                 ,
                                `f_comm`.`beginning_bal`            ,
                                `f_comm`.`received_qty`             ,
                                `f_comm`.`lot_code`                 ,
                                `f_comm`.`qty_used`                 ,
                                `f_comm`.`losses`                   ,
                                `f_comm`.`adjustment_plus`          ,
                                `f_comm`.`adjustment_minus`         ,
                                `f_comm`.`end_bal`                  ,
                                `f_comm`.`requested`                ,
                                `f_comm`.`commodity_id`               AS `commodity_id`
                            FROM `fcdrr_commodity` `f_comm`
                                LEFT JOIN `commodity` `comm`
                                ON `comm`.`id`=`f_comm`.`commodity_id`
                            WHERE 1 
                        ";



        IF (id != 0 && id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `f_comm`.`id`='",id,"' ");
        END IF;

        IF (fcdrr_id != 0 && fcdrr_id != '') THEN
            SET @QUERY = CONCAT(@QUERY, "  AND `f_comm`.`fcdrr_id`='",fcdrr_id,"' ");
        END IF;


        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END