<?php
/*
|--------------------------------------------------------------------------
| PRESET CD4 SQL LIBRARY
|--------------------------------------------------------------------------
|
| Path to the script directory.  Relative to the CI front controller.
 * @package		sql
 * @author		Kevin MWangi 
 * @email 		mwangikevinn@gmail.com
 * @usage 		-load config ->item("preset_sql");
 *				-returns a predefines resultset
 */


$db_procedures["drop_proc_get_facility_details"]  					=	"DROP PROCEDURE IF EXISTS `proc_get_facility_details`; ";
$db_procedures["drop_proc_get_expected_reporting_devices"]  			=	"DROP PROCEDURE IF EXISTS `proc_get_expected_reporting_devices`; ";
$db_procedures["drop_proc_get_region_details"]  						=	"DROP PROCEDURE IF EXISTS `proc_get_region_details`; ";
$db_procedures["drop_proc_get_district_details"]  					=	"DROP PROCEDURE IF EXISTS `proc_get_district_details`; ";
$db_procedures["drop_proc_get_tests_details"]  						=	"DROP PROCEDURE IF EXISTS `proc_get_tests_details`; ";
// $db_procedures["drop_tests_line_trend"] 						=   "DROP PROCEDURE IF EXISTS `tests_line_trend` ";
// $db_procedures["drop_equipment_tests_column"]					=	"DROP PROCEDURE IF EXISTS `equipment_tests_column`";
$db_procedures["drop_sql_eq"]									= 	"DROP PROCEDURE IF EXISTS `sql_eq`";


$db_procedures["proc_get_facility_details"]  		=	
					"CREATE PROCEDURE  proc_get_facility_details (user_group_id int(11), user_filter_used int(11)) 
						BEGIN 
							CASE `user_filter_used`
							WHEN 0 THEN
								SELECT 
										`fac`.`id` 				AS `facility_id`,
										`fac`.`name` 			AS `facility_name`,
										`fac`.`email` 			AS `facility_email`,
										`fac`.`phone` 			AS `facility_phone`,
										`fac`.`rollout_status` 	AS `facility_rollout_id`,
										`fac`.`rollout_date`	AS `facility_rollout_date`,
										`fac`.`sub_county_id`, 
										`sub`.`name` 			AS `sub_county_name`,
										`sub`.`status` 			AS `sub_county_status`,
										`sub`.`county_id`,
										`cnt`.`name`			AS `county_name`,
										`par_cnt`.`partner_id`,
										`par`.`name`			AS `partner_name`,
										`par`.`email`			AS `partner_email`,
										`par`.`phone`			AS `partner_phone`,
										COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
										COUNT(`fu`.`facility_id`) AS `users_count`

									FROM `facility` `fac`
										LEFT JOIN `sub_county` `sub`
										ON `fac`.`sub_county_id` = `sub`.`id`
											LEFT JOIN `county` `cnt`
											ON `sub`.`county_id` = `cnt`.`id`
												LEFT JOIN `partner_counties` `par_cnt`
												ON `cnt`.`id` = `par_cnt`.`county_id`
													LEFT JOIN `partner` `par`
													ON `par_cnt`.`partner_id`=`par`.`id`
													LEFT JOIN `facility_user` `fu`
										ON `fac`.`id`=`fu`.`facility_id`
										LEFT JOIN `facility_equipment` `fac_eq`
										ON `fac`.`id` = `fac_eq`.`facility_id`

									GROUP BY `facility_id`
									ORDER BY `facility_name` ASC;
									
								ELSE 
									CASE `user_group_id`
									WHEN 3 THEN
										SELECT 
											`fac`.`id` 				AS `facility_id`,
											`fac`.`name` 			AS `facility_name`,
											`fac`.`email` 			AS `facility_email`,
											`fac`.`phone` 			AS `facility_phone`,
											`fac`.`rollout_status` 	AS `facility_rollout_id`,
											`fac`.`rollout_date`	AS `facility_rollout_date`,
											`fac`.`sub_county_id`, 
											`sub`.`name` 			AS `sub_county_name`,
											`sub`.`county_id`,
											`cnt`.`name`			AS `region_name`,
											`par_cnt`.`partner_id`,
											`par`.`name`			AS `partner_name`,
											`par`.`email`			AS `partner_email`,
											`par`.`phone`			AS `partner_phone`,
											COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
											COUNT(`fu`.`facility_id`) AS `users_count`

										FROM `facility` `fac`
											LEFT JOIN `sub_county` `sub`
											ON `fac`.`sub_county_id` = `sub`.`id`
												LEFT JOIN `county` `cnt`
												ON `sub`.`county_id` = `cnt`.`id`
													LEFT JOIN `partner_counties` `par_cnt`
													ON `cnt`.`id` = `par_cnt`.`county_id`
														LEFT JOIN `partner` `par`
														ON `par_cnt`.`partner_id`=`par`.`id`
											
											LEFT JOIN `facility_user` `fu`
											ON `fac`.`id`=`fu`.`facility_id`
											LEFT JOIN `facility_equipment` `fac_eq`
											ON `fac`.`id` = `fac_eq`.`facility_id`

											WHERE `par`.`id` = user_filter_used

										GROUP BY `facility_id`
										ORDER BY `facility_name` ASC;
									WHEN 8 THEN
										SELECT 
											`fac`.`id` 				AS `facility_id`,
											`fac`.`name` 			AS `facility_name`,
											`fac`.`email` 			AS `facility_email`,
											`fac`.`phone` 			AS `facility_phone`,
											`fac`.`rollout_status` 	AS `facility_rollout_id`,
											`fac`.`rollout_date`	AS `facility_rollout_date`,
											`fac`.`sub_county_id`, 
											`sub`.`name` 			AS `sub_county_name`,
											`sub`.`county_id`,
											`cnt`.`name`			AS `region_name`,
											`par_cnt`.`partner_id`,
											`par`.`name`			AS `partner_name`,
											`par`.`email`			AS `partner_email`,
											`par`.`phone`			AS `partner_phone`,
											COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
											COUNT(`fu`.`facility_id`) AS `users_count`

										FROM `facility` `fac`
											LEFT JOIN `sub_county` `sub`
											ON `fac`.`sub_county_id` = `sub`.`id`
												LEFT JOIN `county` `cnt`
												ON `sub`.`county_id` = `cnt`.`id`
													LEFT JOIN `partner_counties` `par_cnt`
													ON `cnt`.`id` = `par_cnt`.`county_id`
														LEFT JOIN `partner` `par`
														ON `par_cnt`.`partner_id`=`par`.`id`
											
											LEFT JOIN `facility_user` `fu`
											ON `fac`.`id`=`fu`.`facility_id`
											LEFT JOIN `facility_equipment` `fac_eq`
											ON `fac`.`id` = `fac_eq`.`facility_id`

											WHERE `par`.`id` = user_filter_used

										GROUP BY `facility_id`
										ORDER BY `facility_name` ASC;
									WHEN 9 THEN
										SELECT 
											`fac`.`id` 				AS `facility_id`,
											`fac`.`name` 			AS `facility_name`,
											`fac`.`email` 			AS `facility_email`,
											`fac`.`phone` 			AS `facility_phone`,
											`fac`.`rollout_status` 	AS `facility_rollout_id`,
											`fac`.`rollout_date`	AS `facility_rollout_date`,
											`fac`.`sub_county_id`, 
											`sub`.`name` 			AS `sub_county_name`,
											`sub`.`county_id`,
											`cnt`.`name`			AS `region_name`,
											`par_cnt`.`partner_id`,
											`par`.`name`			AS `partner_name`,
											`par`.`email`			AS `partner_email`,
											`par`.`phone`			AS `partner_phone`,
											COUNT(`fac_eq`.`facility_id`) AS `equipment_count`,
											COUNT(`fu`.`facility_id`) AS `users_count`

										FROM `facility` `fac`
											LEFT JOIN `sub_county` `sub`
											ON `fac`.`sub_county_id` = `sub`.`id`
												LEFT JOIN `county` `cnt`
												ON `sub`.`county_id` = `cnt`.`id`
													LEFT JOIN `partner_counties` `par_cnt`
													ON `cnt`.`id` = `par_cnt`.`county_id`
														LEFT JOIN `partner` `par`
														ON `par_cnt`.`partner_id`=`par`.`id`
											
											LEFT JOIN `facility_user` `fu`
											ON `fac`.`id`=`fu`.`facility_id`
											LEFT JOIN `facility_equipment` `fac_eq`
											ON `fac`.`id` = `fac_eq`.`facility_id`

											WHERE `par`.`id` = user_filter_used

										GROUP BY `facility_id`
										ORDER BY `facility_name` ASC;
								END CASE;
							END CASE;
						END;
					";

$db_procedures["proc_get_expected_reporting_devices"]  =	
					"CREATE PROCEDURE  proc_get_expected_reporting_devices (user_group_id int(11), user_filter_used int(11), date_from varchar(50), date_to varchar(50)) 
					BEGIN
						CASE `user_group_id`
						WHEN '3' THEN
							SELECT 
									COUNT(*) AS `count`,								
									`eq`.`description` 		AS `equipment`

								FROM `facility_equipment` `fac_eq`
									LEFT JOIN `equipment` `eq`
									ON `fac_eq`.`equipment_id`= `eq`.`id`
										
									LEFT JOIN `facility` `fac`
									ON	`fac_eq`.`facility_id` = `fac`.`id`
										LEFT JOIN `sub_county` `sub`
										ON `fac`.`sub_county_id` = `sub`.`id`
											LEFT JOIN `county` `cnt`
											ON `sub`.`county_id` = `cnt`.`id`
												LEFT JOIN `partner_counties` `par_cnt`
												ON `cnt`.`id` = `par_cnt`.`county_id`
													LEFT JOIN `partner` `par`
													ON `par_cnt`.`partner_id`=`par`.`id`
									
								WHERE 	`par_cnt`.`partner_id` = 1
								GROUP BY `eq`.`description` ORDER BY `count` desc;
						END CASE;
					END;
				";

$db_procedures["proc_get_region_details"]  			=	
				"CREATE PROCEDURE  proc_get_region_details () 
					BEGIN
						SELECT 		
							`cnt`.`id`					AS `region_id`,
							`cnt`.`name`				AS `region_name`,
							`par_cnt`.`partner_id`,
							`par`.`name`				AS `partner_name`,
							`par`.`email`				AS `partner_email`,
							`par`.`phone`				AS `partner_phone`


						FROM `county` `cnt`
							LEFT OUTER JOIN `partner_counties` `par_cnt`
							ON `cnt`.`id` = `par_cnt`.`county_id`
								LEFT JOIN `partner` `par`
								ON `par_cnt`.`partner_id`=`par`.`id`
							RIGHT OUTER JOIN `sub_county` `sub`
							ON `sub`.`county_id` = `cnt`.`id`		

						GROUP BY `par_cnt`.`county_id`
						ORDER BY `cnt`.`name` ASC;
					END;
				";

$db_procedures["proc_get_district_details"]  			=	
				"CREATE PROCEDURE  proc_get_district_details () 
					BEGIN
						SELECT 

							`sub`.`id` 				AS `sub_county_id`,
							`sub`.`name` 			AS `sub_county_name`,
							`sub`.`status` 			AS `sub_county_status`,
							`cnt`.`name`			AS `county_name`,
							`par_cnt`.`partner_id`,
							`par`.`name`			AS `partner_name`,
							`par`.`email`			AS `partner_email`,
							`par`.`phone`			AS `partner_phone`

						FROM `sub_county` `sub`
							LEFT JOIN `county` `cnt`
							ON `sub`.`county_id` = `cnt`.`id`
								LEFT JOIN `partner_counties` `par_cnt`
								ON `cnt`.`id` = `par_cnt`.`county_id`
									LEFT JOIN `partner` `par`
									ON `par_cnt`.`partner_id`=`par`.`id`

						GROUP BY `sub`.`id`
						ORDER BY `sub`.`name` ASC;
					END;
				";


//equipment_models
$db_procedures["sql_eq"]=
	"
		CREATE PROCEDURE proc_sql_eq()
		BEGIN
			SELECT `description` as `equipment`,`id` FROM `equipment` WHERE `category`= '1' ORDER BY `description` ASC; 
		END;
	";

//Missing procedures
//Missing procedure
	//Missing procedures

$db_procedures["equipment_pie"]=
	"CREATE PROCEDURE proc_equipment_pie(user_group_id int(11),user_filter_used int(11))
	BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		
		SELECT 
			`equipment`,
			COUNT(*) AS `all`,
			SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> '4' ) THEN 1 ELSE 0 END) AS `count`
		FROM 
		(SELECT 
			`f_eq`.`status` AS `facility_equipment_status_id`, 
			`eq`.`description` AS `equipment`, 
			`f_eq`.`id` AS `facility_equipment_id`, 
			`eq`.`category` AS `equipment_category_id`
		FROM `facility_equipment` `f_eq`
		LEFT JOIN `equipment` `eq`
			ON `f_eq`.`equipment_id` =  `eq`.`id`
		GROUP BY `facility_equipment_id`) `eq_s`
		
		WHERE `equipment_category_id`	=	1
 		GROUP BY `equipment`
		ORDER BY `count` desc;
	 ELSE 
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT 
				`equipment`,
				COUNT(*) AS `all`,
				SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
				`f`.`partner_id` AS `partner_id`
			FROM 
			
				(SELECT 
					`f_eq`.`status` AS `facility_equipment_status_id`, 
					`eq`.`description` AS `equipment`, 
					`f_eq`.`id` AS `facility_equipment_id`, 
					`f_eq`.`facility_id`,
					`eq`.`category` AS `equipment_category_id`
				FROM `facility_equipment` `f_eq`
				LEFT JOIN `equipment` `eq`
					ON `f_eq`.`equipment_id` =  `eq`.`id`
				GROUP BY `facility_equipment_id`) `eq_s`
				
			LEFT JOIN `facility` `f`
				ON `f`.`id` = `eq_s`.`facility_id`									
			WHERE `equipment_category_id`	=	1
			AND `f`.`partner_id` = user_filter_used
	 		GROUP BY `equipment`
			ORDER BY `count` desc; 
	 		 
		WHEN 9 THEN
			
			SELECT 
					`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
					`f`.`sub_county_id`
			FROM 
				
					(SELECT 
						`f_eq`.`status` AS `facility_equipment_status_id`, 
						`eq`.`description` AS `equipment`, 
						`f_eq`.`id` AS `facility_equipment_id`,
							`f_eq` .`facility_id` AS facility_id,
						`eq`.`category` AS `equipment_category_id`
					FROM `facility_equipment` `f_eq`
					LEFT JOIN `equipment` `eq`
						ON `f_eq`.`equipment_id` =  `eq`.`id`
					GROUP BY `facility_equipment_id`) `eq_s`

			LEFT JOIN `facility` `f`
				ON `eq_s`.`facility_id` = 	`f`.`id`
			LEFT JOIN `sub_county` `d`				
            	ON `f`.`sub_county_id` = `d`.`id`
				WHERE  `eq_s`.`equipment_category_id` = 1
			AND `county_id` = user_filter_used
		 		GROUP BY `equipment`
				ORDER BY `count` desc;
		WHEN 8 THEN
		
			SELECT 
					`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
					`f`.`sub_county_id`
			FROM 
				
					(SELECT 
						`f_eq`.`status` AS `facility_equipment_status_id`, 
						`eq`.`description` AS `equipment`, 
						`f_eq`.`id` AS `facility_equipment_id`,
                                                `f_eq` .`facility_id` AS facility_id,
						`eq`.`category` AS `equipment_category_id`
					FROM `facility_equipment` `f_eq`
					LEFT JOIN `equipment` `eq`
						ON `f_eq`.`equipment_id` =  `eq`.`id`
					GROUP BY `facility_equipment_id`) `eq_s`

			LEFT JOIN `facility` `f`
				ON `eq_s`.`facility_id` = 	`f`.`id`
			LEFT JOIN `sub_county` `d`				
            	ON `f`.`sub_county_id` = `d`.`id`
				WHERE  `eq_s`.`equipment_category_id` = 1
			AND `sub_county_id` = user_filter_used
		 		GROUP BY `equipment`
				ORDER BY `count` desc;
		
		WHEN 6 THEN
		
			SELECT 
					`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq_s`.`facility_equipment_status_id`<> 4 ) THEN 1 ELSE 0 END) AS `count`,
					`f`.`id`
			FROM 
				
					(SELECT 
						`f_eq`.`status` AS `facility_equipment_status_id`, 
						`eq`.`description` AS `equipment`, 
						`f_eq`.`id` AS `facility_equipment_id`,
                                                `f_eq` .`facility_id` AS facility_id,
						`eq`.`category` AS `equipment_category_id`
					FROM `facility_equipment` `f_eq`
					LEFT JOIN `equipment` `eq`
						ON `f_eq`.`equipment_id` =  `eq`.`id`
					GROUP BY `facility_equipment_id`) `eq_s`

			LEFT JOIN `facility` `f`
				ON `eq_s`.`facility_id` = 	`f`.`id`
			WHERE  `eq_s`.`equipment_category_id` = 1
			AND `facility_id` = user_filter_used
		 		GROUP BY `equipment`
				ORDER BY `count` desc;
			
		END CASE;
	
	END CASE;
	END;
	";	
	
//Missing procedures
//Missing procedure
	//Missing procedures

	$db_procedures['error_types_col_sql_pl'] = 
		"CREATE PROCEDURE proc_error_types_col_sql_pl(user_group_id int(11),user_filter_used int(11), from_date date,to_date date)
		BEGIN 
			SELECT * FROM `pima_error_type`;
		END
	";

//Missing procedures
//Missing procedure
//Missing procedures

$db_procedures['expected_reporting_devices_pie_expected']=
"CREATE PROCEDURE expected_reporting_devices_pie_expected(user_group_id int(11),user_filter_used int(11), beg_date date,to_date date)
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT
			COUNT(DISTINCT `id`) AS `expected`
			FROM `facility_equipment`
			WHERE 1 
			AND `date_added` BETWEEN `beg_date` AND `to_date`
			AND ((`date_removed` IS NULL) OR (`date_removed` IS NOT NULL AND `date_removed` > `to_date`) );
	ELSE
		CASE `user_group_id`
		WHEN 3 THEN
		
			SELECT
				COUNT(DISTINCT `fe`.`id`) AS `expected`
			FROM `facility_equipment` `fe`
			LEFT JOIN `facility` `f`
				ON `f`.`id` = `fe`.`facility_id`
			WHERE 1 
			AND `fe`.`date_added` BETWEEN `beg_date` AND `to_date`
			AND ((`fe`.`date_removed` IS NULL) OR (`fe`.`date_removed` IS NOT NULL AND `fe`.`date_removed` > `to_date`) )
			AND `f`.`partner_id` = `user_filter_used`;
		    
		    WHEN 9 THEN
		    
		    	SELECT 
					COUNT(DISTINCT `fe`.`id`) AS `expected`
				FROM `facility_equipment` `fe`
				LEFT JOIN `facility` `f`
					ON `fe`.`facility_id` = `f`.`id`
				LEFT JOIN `sub_county` `d`
					ON `d`.`id` = `f`.`sub_county_id`
				WHERE 1 
				AND `fe`.`date_added` BETWEEN `beg_date` AND `to_date`
				AND ((`fe`.`date_removed` IS NULL) OR (`fe`.`date_removed` IS NOT NULL AND `fe`.`date_removed` > `to_date`) ) 
			    AND `d`.`county_id` = user_filter_used;

			WHEN 8 THEN
			
				SELECT 
					COUNT(DISTINCT `fe`.`id`) AS `expected`
				FROM `facility_equipment` `fe`
				LEFT JOIN `facility` `f`
					ON `fe`.`facility_id` = `f`.`id`
				WHERE 1 
				AND `fe`.`date_added` BETWEEN `beg_date` AND `to_date`
				AND ((`fe`.`date_removed` IS NULL) OR (`fe`.`date_removed` IS NOT NULL AND `fe`.`date_removed` > `to_date`) ) 
			    AND `f`.`sub_county_id` = user_filter_used;
				
			WHEN 6 THEN
			
				SELECT 
					COUNT(DISTINCT `fe`.`id`) AS `expected`
				FROM `facility_equipment` `fe`
				LEFT JOIN `facility` `f`
					ON `fe`.`facility_id` = `f`.`id`
				WHERE 1 
				AND `fe`.`date_added` BETWEEN `beg_date` AND `to_date` 
				AND ((`fe`.`date_removed` IS NULL) OR (`fe`.`date_removed` IS NOT NULL AND `fe`.`date_removed` > `to_date`) ) 
			    AND `f`.`id` = user_filter_used;
			
		END CASE;
	END CASE;
END
";



$config["procedures_sql"] = $db_procedures;

/* End of file procedures_sql.php */
/* Location: ./application/config/sql.php */
