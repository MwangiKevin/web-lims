CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_partners`(P_id int(11))
BEGIN 
	SET @QUERY =    "SELECT 
							`par`.`id`,
							`par`.`name`,
							`par`.`id`  		AS `partner_id`,
							`par`.`name` 		AS `partner_name`,
							`par`.`email` 		AS `partner_email`,
							`par`.`phone` 		AS `partner_phone`
						FROM `partner` `par`

						";

        IF (P_id = 0 || P_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' WHERE `par`.`id`=', P_id, ' ');
        END IF;

        SET @QUERY = CONCAT(@QUERY, ' GROUP BY `par`.`id` ORDER BY `par`.`name` ASC ');

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END;