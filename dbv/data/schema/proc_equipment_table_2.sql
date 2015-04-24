DROP PROCEDURE IF EXISTS `proc_equipment_table_2`;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_equipment_table_2` (from_date date, to_date date, user_delimiter varchar(255))
	BEGIN

				SELECT 
					`eq`.`equipment_id`,
					`eq`.`equipment`,
					COUNT(*) AS `all`,
					SUM(CASE WHEN (`eq`.`facility_equipment_status_id`<> '4' )    THEN 1 ELSE 0 END) AS `total`,
					SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '1'    THEN 1 ELSE 0 END) AS `functional`,
					SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '2'    THEN 1 ELSE 0 END) AS `broken_down`,
					SUM(CASE WHEN `eq`.`facility_equipment_status_id`= '3'    THEN 1 ELSE 0 END) AS `obsolete`
				
				FROM 

					 (SELECT 
				        `fac_eq`.`id` AS `facility_equipment_id`,
				        `eq_cat`.`id` AS `equipment_category_id`,
				        `eq_cat`.`description` AS `equipment_category`,
				        `eq`.`id` AS `equipment_id`,
				        `eq`.`description` AS `equipment`,
				        `fac_eq`.`status` AS `facility_equipment_status_id`,
				        `eq_st`.`description` AS `facility_equipment_status`,
				        `fac_eq`.`deactivation_reason` AS `deactivation_reason`,
				        `fac_eq`.`date_added` AS `date_added`,
				        `fac_eq`.`date_removed` AS `date_removed`,
				        `fac_eq`.`serial_number` AS `serial_number`,
				        `fac`.`id` AS `facility_id`,
				        `fac`.`name` AS `facility_name`,
				        `fac`.`email` AS `facility_email`,
				        `fac`.`phone` AS `facility_phone`,
				        `fac`.`rollout_status` AS `facility_rollout_id`,
				        `fac`.`sub_county_id` AS `sub_county_id`,
				        `sub`.`name` AS `sub_county_name`,
				        `sub`.`status` AS `sub_county_status`,
				        `sub`.`county_id` AS `county_id`,
				        `count`.`name` AS `county_name`,
				        `count`.`fusion_id` AS `county_fusion_id`,
				        `par_count`.`partner_id` AS `partner_id`,
				        `par`.`name` AS `partner_name`,
				        `par`.`email` AS `partner_email`,
				        `par`.`phone` AS `partner_phone`
				    FROM
				        (
				            (
				                    (
				                        (
				                            (
				                                (
				                                        (
				                                                    (
				                                                        `web-lims`.`facility_equipment` `fac_eq`
				                                                            LEFT JOIN `web-lims`.`equipment` `eq` ON ((`fac_eq`.`equipment_id` = `eq`.`id`))
				                                                        )
				                                                    LEFT JOIN `web-lims`.`equipment_category` `eq_cat` ON ((`eq`.`category` = `eq_cat`.`id`))
				                                            )
				                                    LEFT JOIN `web-lims`.`facility` `fac` ON ((`fac_eq`.`facility_id` = `fac`.`id`))
				                                )
				                                LEFT JOIN `web-lims`.`sub_county` `sub` ON ((`fac`.`sub_county_id` = `sub`.`id`))
				                            )
				                            LEFT JOIN `web-lims`.`county` `reg` ON ((`sub`.`county_id` = `reg`.`id`))
				                        )
				                        LEFT JOIN `web-lims`.`partner_counties` `par_count` ON ((`reg`.`id` = `par_count`.`county_id`))
				                    )
				                    LEFT JOIN `web-lims`.`partner` `par` ON ((`par_count`.`partner_id` = `par`.`id`))
				            )
				            LEFT JOIN `web-lims`.`equipment_status` `eq_st` ON ((`fac_eq`.`status` = `eq_st`.`id`)))

							WHERE user_delimiter

								GROUP BY `facility_equipment_id`
								) `eq`

								WHERE `equipment_category_id`= '1'
							GROUP BY `eq`.`equipment_id`
							ORDER BY `equipment` ASC;
END;

DELIMITER $$;

SHOW ERRORS;