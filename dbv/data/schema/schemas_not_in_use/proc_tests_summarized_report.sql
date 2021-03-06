DROP PROCEDURE IF EXISTS `proc_tests_summarized_report`;

CREATE PROCEDURE proc_tests_summarized_report(user_group_id int(11), user_filter_used int(11),date_from date, date_to date)
	BEGIN
		CASE `user_filter_used`
			WHEN 0 THEN
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					`pim_tst`.`sample_code`,
					COUNT(`pim_tst`.`sample_code`) AS tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator` AS `operator`,
					`tst`.`result_date`,
					MONTH(`tst`.`result_date`) AS `month`
					
				FROM `pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `sub_county` `sub`
						ON `fac`.`sub_county_id` = `sub`.`id`
							LEFT JOIN `county` `cnt`
							ON `sub`.`county_id` = `cnt`.`id`
								LEFT JOIN `partner_counties` `par_cnt`
								ON `cnt`.`id` = `par_cnt`.`county_id`
									LEFT JOIN `partner` `par`
									ON `par_cnt`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
					LEFT JOIN `facility_equipment`
					ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
					LEFT JOIN `pima_upload` `pim_upl`
					ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
						LEFT JOIN `user` `usr`
						ON `pim_upl`.`uploaded_by`= `usr`.`id`																
					LEFT JOIN `patient_age_group` `ag`
					ON `tst`.`patient_age_group_id` = `ag`.`id`
					
				WHERE 1
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				GROUP BY `facility_name`,`month`
				;
		ELSE
			CASE `user_group_id`
			WHEN 3 THEN
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					COUNT(`pim_tst`.`sample_code`) AS tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator`  AS `operator`,
					`pim_tst`.`sample_code`,
					`tst`.`result_date`,
					MONTH(`tst`.`result_date`) AS `month`
					
				
				FROM `pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `sub_county` `sub`
						ON `fac`.`sub_county_id` = `sub`.`id`
							LEFT JOIN `county` `cnt`
							ON `sub`.`county_id` = `cnt`.`id`
								LEFT JOIN `partner_counties` `par_cnt`
								ON `cnt`.`id` = `par_cnt`.`county_id`
									LEFT JOIN `partner` `par`
									ON `par_cnt`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
					LEFT JOIN `facility_equipment`
					ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
					LEFT JOIN `pima_upload` `pim_upl`
					ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
						LEFT JOIN `user` `usr`
						ON `pim_upl`.`uploaded_by`= `usr`.`id`																
					LEFT JOIN `patient_age_group` `ag`
					ON `tst`.`patient_age_group_id` = `ag`.`id`
					
				WHERE 1
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				AND `par_cnt`.`partner_id` = `user_filter_used`
				GROUP BY `facility_name`,`month`
				;			
			WHEN 9 THEN
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					COUNT(`pim_tst`.`sample_code`) as tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator`  AS `operator`,
					`pim_tst`.`sample_code`,
					`tst`.`result_date`,
					MONTH(`tst`.`result_date`) AS `month`
					
				FROM `pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `sub_county` `sub`
						ON `fac`.`sub_county_id` = `sub`.`id`
							LEFT JOIN `county` `cnt`
							ON `sub`.`county_id` = `cnt`.`id`
								LEFT JOIN `partner_counties` `par_cnt`
								ON `cnt`.`id` = `par_cnt`.`county_id`
									LEFT JOIN `partner` `par`
									ON `par_cnt`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
					LEFT JOIN `facility_equipment`
					ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
					LEFT JOIN `pima_upload` `pim_upl`
					ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
						LEFT JOIN `user` `usr`
						ON `pim_upl`.`uploaded_by`= `usr`.`id`																
					LEFT JOIN `patient_age_group` `ag`
					ON `tst`.`patient_age_group_id` = `ag`.`id`
					
				WHERE 1
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				AND `sub`.`county_id` = `user_filter_used`
				GROUP BY `facility_name`,`month`
				;
			WHEN 8 THEN
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					COUNT(`pim_tst`.`sample_code`) AS tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator`  AS `operator`,
					`tst`.`result_date`,
					MONTH(`tst`.`result_date`) AS `month`
				
				FROM `pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `sub_county` `sub`
						ON `fac`.`sub_county_id` = `sub`.`id`
							LEFT JOIN `county` `cnt`
							ON `sub`.`county_id` = `cnt`.`id`
								LEFT JOIN `partner_counties` `par_cnt`
								ON `cnt`.`id` = `par_cnt`.`county_id`
									LEFT JOIN `partner` `par`
									ON `par_cnt`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
					LEFT JOIN `facility_equipment`
					ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
					LEFT JOIN `pima_upload` `pim_upl`
					ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
						LEFT JOIN `user` `usr`
						ON `pim_upl`.`uploaded_by`= `usr`.`id`																
					LEFT JOIN `patient_age_group` `ag`
					ON `tst`.`patient_age_group_id` = `ag`.`id`
					
				WHERE 1
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				AND `fac`.`sub_county_id` = `user_filter_used`
				GROUP BY `facility_name`,`month`
				;		
			WHEN 6 THEN
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					COUNT(`pim_tst`.`sample_code`) AS tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator`  AS `operator`,
					`tst`.`result_date`,
					`pim_tst`.`sample_code`,
					MONTH(`tst`.`result_date`) AS `month`
					
				FROM `pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `sub_county` `sub`
						ON `fac`.`sub_county_id` = `sub`.`id`
							LEFT JOIN `county` `cnt`
							ON `sub`.`county_id` = `cnt`.`id`
								LEFT JOIN `partner_counties` `par_cnt`
								ON `cnt`.`id` = `par_cnt`.`county_id`
									LEFT JOIN `partner` `par`
									ON `par_cnt`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
					LEFT JOIN `facility_equipment`
					ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
					LEFT JOIN `pima_upload` `pim_upl`
					ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
						LEFT JOIN `user` `usr`
						ON `pim_upl`.`uploaded_by`= `usr`.`id`																
					LEFT JOIN `patient_age_group` `ag`
					ON `tst`.`patient_age_group_id` = `ag`.`id`
				WHERE 1
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				AND `fac`.`id` = `user_filter_used`
				GROUP BY `facility_name`,`month`
				;	
			WHEN 7 THEN	
				SELECT 
					`fac`.`name` 	AS `facility_name`,
					`facility_equipment`.`serial_number` AS `equipment_serial_number`,
					COUNT(`pim_tst`.`sample_code`) AS tests_done,
					`tst`.`cd4_count`,
					`pim_tst`.`operator`  AS `operator`,
					`tst`.`result_date`,
					`pim_tst`.`sample_code`,
					MONTH(`tst`.`result_date`) AS `month`
					
				FROM `pima_test`  `pim_tst`
				LEFT JOIN `cd4_test` `tst`
				ON `pim_tst`.`cd4_test_id`=`tst`.`id`
					LEFT JOIN `facility` `fac`
					ON `tst`.`facility_id`=`fac`.`id`
						LEFT JOIN `sub_county` `sub`
						ON `fac`.`sub_county_id` = `sub`.`id`
							LEFT JOIN `county` `cnt`
							ON `sub`.`county_id` = `cnt`.`id`
								LEFT JOIN `partner_counties` `par_cnt`
								ON `cnt`.`id` = `par_cnt`.`county_id`
									LEFT JOIN `partner` `par`
									ON `par_cnt`.`partner_id`=`par`.`id`
						LEFT JOIN `status` `st`
						ON `fac`.`rollout_status`= `st`.`id`  
						LEFT JOIN `facility_user` `fu`
						ON `fac`.`id`=`fu`.`facility_id`
						LEFT JOIN `facility_equipment` `fac_eq`
						ON `fac`.`id` = `fac_eq`.`facility_id`
					LEFT JOIN `facility_equipment`
					ON `tst`.`facility_equipment_id`=`facility_equipment`.`id`
					LEFT JOIN `pima_upload` `pim_upl`
					ON `pim_tst`.`pima_upload_id`=`pim_upl`.`id`
						LEFT JOIN `user` `usr`
						ON `pim_upl`.`uploaded_by`= `usr`.`id`																
					LEFT JOIN `patient_age_group` `ag`
					ON `tst`.`patient_age_group_id` = `ag`.`id`
				WHERE 1
				AND `tst`.`result_date` between `date_from` and `date_to`
				AND ( `sample_code` NOT LIKE '%CONTROL%' )
				AND `valid` = '1'
				AND `tst`.`facility_equipment_id` = `user_filter_used`
				GROUP BY `facility_name`,`month`
				;
			END CASE;
		END CASE;
	END;