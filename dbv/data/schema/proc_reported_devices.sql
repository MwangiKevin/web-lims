CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_reported_devices`(filter_type int(11),filter_id int(11),from_date date, to_date date)
BEGIN

	DECLARE Q1 varchar(1000);
	DECLARE Q2 varchar(100);
	DECLARE Q3 varchar(100);
	DECLARE Q4 varchar(100);
	DECLARE QUERY varchar(1000);

    SET @Q1 =   " SELECT 
							COUNT(DISTINCT `tst`.`facility_device_id`) AS `count`,
							CONCAT(YEAR(`tst`.`file_date_time`),'-',MONTH(`tst`.`file_date_time`)) AS `yearmonth`,
							YEAR(`tst`.`file_date_time`) AS `year`,
							MONTH(`tst`.`file_date_time`) AS `month`
						FROM `cd4_test` `tst`
						LEFT JOIN `facility` `fc` ON `tst`.`facility_id` = `fc`.`id`
						LEFT JOIN `sub_county` `sub` ON `fc`.`sub_county_id` = `sub`.`id`
						LEFT JOIN `county` `cnt` ON `sub`.`county_id` = `cnt`.`id`
						LEFT JOIN `facility_device` `fd` ON `fd`.`id` = `tst`.`facility_device_id`
							LEFT JOIN `device` `d` ON `d`.`id` = `fd`.`device_id`
						WHERE 1 
						"; 

    SET @Q2 =   CONCAT(" AND `tst`.`file_date_time`  BETWEEN '",`from_date`,"' AND '",`to_date`,"' "); 


	CASE 
        WHEN (filter_type = 1 ) 
            THEN 	SET @Q3   = CONCAT(" AND `tst`.`facility_id` = '",`filter_id`,"' ");
        WHEN (filter_type = 2 ) 
            THEN 	SET @Q3   = CONCAT(" AND `sub`.`id` = '",`filter_id`,"' ");
        WHEN (filter_type = 3 ) 
            THEN 	SET @Q3   = CONCAT(" AND `cnt`.`id` = '",`filter_id`,"' ");
        WHEN (filter_type = 4 ) 
            THEN 	SET @Q3   = CONCAT(" AND `fc`.`partner_id` = '",`filter_id`,"' ");
        ELSE
            SET @Q3 = " ";
    END CASE;


	SET @Q4 =		" 
					GROUP BY `yearmonth`
					ORDER BY `tst`.`file_date_time` asc
					";


	SET @QUERY = CONCAT(@Q1,@Q2,@Q3,@Q4);

	
    PREPARE stmt FROM @QUERY;
    EXECUTE stmt;
    -- SELECT @QUERY;
END