DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_dt_tests`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_dt_tests`(in _from integer, in _to integer, in search varchar(255))
BEGIN

        SET @QUERY =    " SELECT
								`cd4t`.`id`,
								`cd4t`.`patient_id`,
								`fc`.`name`,
								`cd4t`.`cd4_count`
							FROM `cd4_test` `cd4t`
								LEFT JOIN `facility` `fc`
									ON `cd4t`.`facility_id` = `fc`.`id`
                            limit ?,?
                            ;
                        ";


        IF (search = 0 || search = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' WHERE  `cd4t`.`id` LIKE  %search%
                                OR  `cd4t`.`patient_id` LIKE  %search%
                                OR  `fc`.`name` LIKE  %search%
                                OR  `cd4t`.`cd4_count` LIKE %search% ');
        END IF;

        PREPARE stmt FROM @QUERY;
        set @from = _from;
        set @to = _to;
        EXECUTE stmt using @from, @to;
        SELECT @QUERY;
    END$$

DELIMITER ;
