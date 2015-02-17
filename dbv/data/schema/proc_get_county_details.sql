DROP PROCEDURE IF EXISTS `proc_get_county_details`;

CREATE PROCEDURE  proc_get_county_details () 
					BEGIN
						SELECT 		
							`cnt`.`id`					AS `region_id`,
							`cnt`.`name`				AS `region_name`,
                        
							`par_cnt`.`partner_id`,
							`par`.`name`				AS `partner_name`,
							`par`.`email`				AS `partner_email`,
							`par`.`phone`				AS `partner_phone`
                            `type`

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
				
