DROP PROCEDURE IF EXISTS `proc_get_expected_reporting_devices`;

CREATE PROCEDURE  proc_get_expected_reporting_devices (user_group_id int(11), user_filter_used int(11), date_from varchar(50), date_to varchar(50)) 
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
