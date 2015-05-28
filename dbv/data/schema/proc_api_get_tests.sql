CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_api_get_tests`( T_id int(11),search varchar(255), _from int(3), _to int(3),get_count varchar(10))
BEGIN

        SET @QUERY =    "SELECT
                            `cd4t`.`id`,
                            `cd4t`.`sample`,
                            `fc`.`name`         AS `facility_name`,
                            `sub`.`name`        AS `sub_county_name`,
                            `cnt`.`name`        AS `county_name`,
                            `cd4t`.`cd4_count`
                        FROM `cd4_test` `cd4t`
                        LEFT JOIN `facility` `fc` ON `cd4t`.`facility_id` = `fc`.`id`
                        LEFT JOIN `sub_county` `sub` ON `fc`.`sub_county_id` = `sub`.`id`
                        LEFT JOIN `county` `cnt` ON `sub`.`county_id` = `cnt`.`id`
                        WHERE 1   
                        ";

        IF (get_count = 'true')
        THEN
            SET @QUERY =    "SELECT
                              COUNT(*) AS `count`
                            FROM `cd4_test` `cd4t`
                            LEFT JOIN `facility` `fc` ON `cd4t`.`facility_id` = `fc`.`id`
                            LEFT JOIN `sub_county` `sub` ON `fc`.`sub_county_id` = `sub`.`id`
                            LEFT JOIN `county` `cnt` ON `sub`.`county_id` = `cnt`.`id`
                            WHERE 1   
                            ";
        ELSE

            SET @QUERY = @QUERY;
        END IF;


        IF (T_id = 0 || T_id = '')
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `cd4t`.`id`=', T_id, ' ');
        END IF;

        IF (search = ''|| search IS NULL)
        THEN
            SET @QUERY = @QUERY;
        ELSE
            SET @QUERY = CONCAT(@QUERY, ' AND `cnt`.`name` LIKE "%', search, '%" OR `fc`.`name` LIKE "%', search, '%" OR `fc`.`mfl_code` LIKE "%', search, '%" OR `cd4t`.`sample` LIKE "%', search, '%"');
        END IF;

        SET @QUERY = CONCAT(@QUERY, ' ORDER BY `cd4t`.`id` ASC ');

        CASE 
            WHEN (_from = 0 || _from = '') AND (_to <> 0 || _to <> '') AND  (get_count <> 'true')
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT  0 ,  ', _to, ' ');
            WHEN (_from <> 0 || _from <> '') AND (_to <> 0 || _to <> '') AND    (get_count <> 'true')
                THEN SET @QUERY = CONCAT(@QUERY, ' LIMIT ',_from,' , ', _to, ' ');
            ELSE
                SET @QUERY = @QUERY;
        END CASE;

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        SELECT @QUERY;
        SHOW ERRORS;
    END