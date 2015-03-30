DROP PROCEDURE IF EXISTS `proc_get_facility_details`;

CREATE PROCEDURE  proc_get_facility_details (user_group_id int(11), user_filter_used int(11)) 
						BEGIN 
							CASE `user_filter_used`
							WHEN 0 THEN
								SELECT 
										`fac`.`id` 				AS `facility_id`,
										`fac`.`name` 			AS `facility_name`,
										`fac`.`email` 			AS `facility_email`,
										`fac`.`mfl_code` 		AS `facility_mfl_code`,
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