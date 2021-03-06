DROP PROCEDURE IF EXISTS `proc_errors_detailed_report`;

CREATE PROCEDURE proc_errors_detailed_report(user_group_id int(11), user_filter_used int(11), date_from date, date_to date)
BEGIN
	CASE `user_filter_used`
	WHEN 0 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`
			

		FROM 
			`pima_test`  `pim_tst`
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to`  
		;
	ELSE
	CASE `user_group_id`
	WHEN 3 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`

		FROM 
			`pima_test`  `pim_tst`
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to` 
	 	AND `par_cnt`.`partner_id` = `user_filter_used`
	 	; 
	WHEN 9 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`

		FROM 
			`pima_test`  `pim_tst`
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to`
	 	AND `sub`.`county_id` = `user_filter_used`  
	 	;
	WHEN 8 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`,
			`tst`.`result_date`

		FROM 
			`pima_test`  `pim_tst`
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to`
	 	AND `fac`.`sub_county_id` = `user_filter_used`  
	 	;
	WHEN 6 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`,
			`tst`.`result_date`

		FROM 
			`pima_test`  `pim_tst`
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to`  
	 	AND `fac`.`id` = `user_filter_used`
		;
	WHEN 7 THEN
		SELECT
			`fac`.`name` 			AS `facility_name`,
			`facility_equipment`.`serial_number` AS `equipment_serial_number`,
			`pim_tst`.`sample_code`,
			`p_e_ty`.`description` AS `error_type_description`,
			`pima_err`.`error_detail`,
			`pim_tst`.`operator`  AS `operator`,
			`tst`.`result_date`,
			`tst`.`result_date`

		FROM 
			`pima_test`  `pim_tst`
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
			LEFT JOIN `pima_error` `pima_err`
			ON `pim_tst`.`error_id`=`pima_err`.`id`
				LEFT JOIN `pima_error_type` `p_e_ty`
				ON `pima_err`.`pima_error_type`=`p_e_ty`.`id`
				 
		WHERE 1
		AND `valid` = '0'
	 	AND ( `sample_code` NOT LIKE '%CONTROL%' )
	 	AND `tst`.`result_date` between `date_from` and `date_to`  
	 	AND `tst`.`facility_equipment_id` = `user_filter_used`
		;
	END CASE;
	END CASE;
END