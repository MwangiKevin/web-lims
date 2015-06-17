DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_dt_tests`( search varchar(255), _from int(3), _to int(3))
BEGIN

        SET @QUERY =    "SELECT
                            `cd4t`.`id`,
                            `cd4t`.`sample`,
                            `fc`.`name`,
                            `cd4t`.`cd4_count`
                        FROM `cd4_test` `cd4t`
                        LEFT JOIN `facility` `fc` ON `cd4t`.`facility_id` = `fc`.`id`
                        LEFT JOIN `sub_county` `sub` ON `fc`.`sub_county_id` = `sub`.`id`
                        LEFT JOIN `county` `cnt` ON `sub`.`county_id` = `cnt`.`id`
                        WHERE 1   
                        ";


        IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `cnt`.`name` LIKE "%', search, '%" OR `fc`.`name` LIKE "%', search, '%" OR `fc`.`mfl_code` LIKE "%', search, '%" OR `cd4t`.`sample` LIKE "%', search, '%"');
        END IF;

        SET @QUERY = CONCAT(@QUERY, ' ORDER BY `cd4t`.`id` ASC ');

        CASE 
            WHEN (_from = 0 || _from = '') AND (_to <> 0 || _to <> '') 
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT  0 ,  ', _to, ' ');
            WHEN (_from <> 0 || _from <> '') AND (_to <> 0 || _to <> '')
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT ',_from,' , ', _to, ' ');
            ELSE
                SET @QUERY = @QUERY;
        END CASE;

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
    END$$

DELIMITER ;