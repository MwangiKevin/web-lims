DELIMITER $$

DROP PROCEDURE IF EXISTS `proc_dt_tests`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_dt_tests`()
BEGIN

        SET @QUERY =    " SELECT
								`cd4t`.`id`,
								`cd4t`.`patient_id`,
								`fc`.`name`,
								`cd4t`.`cd4_count`
							FROM `cd4_test` `cd4t`
								LEFT JOIN `facility` `fc`
									ON `cd4t`.`facility_id` = `fc`.`id`
                        ";

        -- IF (f_id = 0 || f_id = '')
        -- THEN
        --     SET @QUERY = @QUERY;
        -- ELSE
        --     SET @QUERY = CONCAT(@QUERY, ' AND `f`.`id`=', f_id, '');
        -- END IF;

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END$$

DELIMITER ;