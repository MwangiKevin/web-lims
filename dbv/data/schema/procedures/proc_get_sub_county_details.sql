DROP PROCEDURE IF EXISTS `proc_get_sub_county_details`;

CREATE PROCEDURE  proc_get_sub_county_details () 
					BEGIN
						SELECT 

							`sub`.`id`,
							`sub`.`name`,
							`sub`.`id` 				AS `sub_county_id`,
							`sub`.`name` 			AS `sub_county_name`,
							`sub`.`status` 			AS `sub_county_status`,
							`sub`.`county_id`,
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