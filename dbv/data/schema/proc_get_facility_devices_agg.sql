CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_facility_devices_agg`(filter_type int(11),filter_id int(11) )
BEGIN

	DECLARE Q1 varchar(1000);
	DECLARE Q2 varchar(100);
	DECLARE Q3 varchar(100);
	DECLARE Q4 varchar(100);
	DECLARE QUERY varchar(1000);

	SET @Q1 =	"SELECT 
						`eq`.`equipment_id`,
						`eq`.`equipment`,
						COUNT(*) AS `all`,
						SUM(CASE WHEN (`eq`.`facility_equipment_status_id`<> '4' )    THEN 1 ELSE 0 END) AS `total`,
						SUM(CASE WHEN (`eq`.`facility_equipment_status_id`<> '4' )    THEN 1 ELSE 0 END) AS `count`,
						SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '1'    THEN 1 ELSE 0 END) AS `functional`,
						SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '2'    THEN 1 ELSE 0 END) AS `broken_down`,
						SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '3'    THEN 1 ELSE 0 END) AS `obsolete`
					FROM 
						(SELECT
												
												`fac_dev`.`id` 			AS `facility_equipment_id`,	
												`dev`.`id` 				AS `equipment_id`,
												`dev`.`name` 		AS `equipment`,
												`fac_dev`.`status` 		AS `facility_equipment_status_id`,									
												`fac_dev`.`deactivation_reason` ,															
												`fac_dev`.`date_added` ,													
												`fac_dev`.`date_removed`,																											
												`fac_dev`.`serial_number`,
												`fac`.`id` 				AS `facility_id`,
												`fac`.`name` 			AS `facility_name`,
												`fac`.`email` 			AS `facility_email`,
												`fac`.`phone` 			AS `facility_phone`,
												`fac`.`rollout_status` 	AS `facility_rollout_id`,
												`fac`.`sub_county_id`, 
												`sub`.`name` 			AS `sub_county_name`,
												`sub`.`status` 			AS `sub_county_status`,
												`sub`.`county_id`,
												`cou`.`name`			AS `county_name`,
												`par_cou`.`partner_id`,
												`par`.`name`			AS `partner_name`,
												`par`.`email`			AS `partner_email`,
												`par`.`phone`			AS `partner_phone`

											FROM `facility_device` `fac_dev`
												LEFT JOIN `device` `dev`
												ON `fac_dev`.`device_id`= `dev`.`id`
												
												LEFT JOIN `facility` `fac`
												ON	`fac_dev`.`facility_id` = `fac`.`id`
													LEFT JOIN `sub_county` `sub`
													ON `fac`.`sub_county_id` = `sub`.`id`
														LEFT JOIN `county` `cou`
														ON `cou`.`id` = `sub`.`county_id`
															LEFT JOIN `partner_counties` `par_cou`
															ON `cou`.`id` = `par_cou`.`county_id`
																LEFT JOIN `partner` `par`
																ON `par_cou`.`partner_id`=`par`.`id`
						 	
						) `eq`
					WHERE 1 

				";
 	

 	CASE 
        WHEN (filter_type = 1 ) 
            THEN 	SET @Q3   = CONCAT(" AND `eq`.`facility_id` = '",`filter_id`,"' ");
        WHEN (filter_type = 2 ) 
            THEN 	SET @Q3   = CONCAT(" AND `eq`.`sub_county_id` = '",`filter_id`,"' ");
        WHEN (filter_type = 3 ) 
            THEN 	SET @Q3   = CONCAT(" AND `eq`.`county_id` = '",`filter_id`,"' ");
        WHEN (filter_type = 4 ) 
            THEN 	SET @Q3   = CONCAT(" AND `eq`.`partner_id` = '",`filter_id`,"' ");
        ELSE
            SET @Q3 = " ";
    END CASE;
						

	SET @Q4 =			" 

					GROUP BY `eq`.`equipment_id`
					ORDER BY `equipment` DESC 
					";


	-- SET @QUERY = CONCAT(@Q1,@Q2,@Q3,@Q4);
	SET @QUERY = CONCAT(@Q1,@Q3,@Q4);

    PREPARE stmt FROM @QUERY;
    EXECUTE stmt;
    -- SELECT @QUERY;
END