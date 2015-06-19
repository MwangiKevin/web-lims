CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_equipment_test_table`(from_date date,to_date date,filter_type int(11), filter_id int(11))
BEGIN

	DECLARE Q1 varchar(500);
	DECLARE Q2 varchar(100);
	DECLARE Q3 varchar(100);
	DECLARE Q4 varchar(100);
	DECLARE QUERY varchar(1000);

	SET @Q1 =	"SELECT 
						`dev`.`name` AS `equipment_name`,
						COUNT(*) as `count`,
						SUM(CASE WHEN `valid`= '1'    THEN 1 ELSE 0 END) AS `valid`,							
						SUM(CASE WHEN `valid`= '0'    THEN 1 ELSE 0 END) AS `errors`
					FROM `cd4_test`  `tst`
						LEFT JOIN `facility` `f`
						ON `tst`.`facility_id`=`f`.`id`			
							LEFT JOIN `partner` `p`
							ON `f`.`partner_id` =`p`.`id`
							LEFT JOIN `sub_county` `s_c`
							ON `f`.`sub_county_id` = `s_c`.`id`
								LEFT JOIN `county` `c`
								ON `s_c`.`county_id` = `c`.`id`
							LEFT JOIN `facility_device` `fac_dev`
							ON `tst`.`facility_device_id`=`fac_dev`.`id`
								LEFT JOIN `device` `dev`
								ON `fac_dev`.`device_id` = `dev`.`id` ";

	SET @Q2 		= CONCAT(" WHERE `tst`.`result_date` BETWEEN '",`from_date`,"' AND '",`to_date`,"' ");
 	

 	CASE 
        WHEN (filter_type = 1 ) 
            THEN 	SET @Q3   = CONCAT(" AND `f`.`id` = '",`filter_id`,"' ");
        WHEN (filter_type = 2 ) 
            THEN 	SET @Q3   = CONCAT(" AND `s_c`.`id` = '",`filter_id`,"' ");
        WHEN (filter_type = 3 ) 
            THEN 	SET @Q3   = CONCAT(" AND `c`.`id` = '",`filter_id`,"' ");
        WHEN (filter_type = 4 ) 
            THEN 	SET @Q3   = CONCAT(" AND `f`.`partner_id` = '",`filter_id`,"' ");
        ELSE
            SET @Q3 = " ";
    END CASE;
						

	SET @Q4 =			" AND `tst`.`result_date` <= CURDATE()

					GROUP BY `equipment_name`
					ORDER BY `equipment_name` DESC 
					";


	-- SET @QUERY = CONCAT(@Q1,@Q2,@Q3,@Q4);
	SET @QUERY = CONCAT(@Q1,@Q2,@Q3,@Q4);

    PREPARE stmt FROM @QUERY;
    EXECUTE stmt;
    -- SELECT @QUERY;
END