CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_report_fcdrr_data_extract`(yr int(11),mnth int(11))
BEGIN
	SELECT 
			`tb1`.`mfl_code`,
			`f`.`name`,
			SUM(`fc`.`calibur_tests_adults`)+ SUM(`fc`.`calibur_tests_pead`)+ SUM(`fc`.`count_tests_adults`)+ SUM(`fc`.`count_tests_pead`)+ SUM(`fc`.`cyflow_tests_adults`)+ SUM(`fc`.`cyflow_tests_pead`)+ SUM(`fc`.`pima_tests`) AS `total_cd4_tests`,
			SUM(`fc`.`calibur_tests_adults`)+ SUM(`fc`.`calibur_tests_pead`) 	AS `total_calibur_cd4_tests`,
			SUM(`fc`.`count_tests_adults`)+ SUM(`fc`.`count_tests_pead`) 		AS `total_count_cd4_tests`,
			SUM(`fc`.`cyflow_tests_adults`)+ SUM(`fc`.`cyflow_tests_pead`) 		AS `total_cyflow_cd4_tests`,
			SUM(`fc`.`pima_tests`) AS total_pima_tests,
			`tb1`.`sum` AS `ending_bal_sum`

		FROM `facility` `f`
			LEFT JOIN `fcdrr` `fc`
			ON `f`.`id`=`fc`.`facility_id` AND MONTH(`fc`.`from_date`) = `mnth` AND YEAR(`fc`.`from_date`) = `yr`
			LEFT JOIN 
			(
				select 
						`f`.`mfl_code`,
						`f`.`id`,
						SUM(`c1`.`end_bal`) AS `sum` 

					FROM `facility` `f`

						LEFT JOIN `fcdrr` `fc1`
						ON `f`.`id`=`fc1`.`facility_id` AND MONTH(`fc1`.`from_date`) = `mnth` AND YEAR(`fc1`.`from_date`) = `yr` 
							LEFT JOIN `fcdrr_commodity` `c1` 
							ON `fc1`.`id`=`c1`.`fcdrr_id` 
					GROUP BY `f`.`id`
			) AS `tb1`
			 ON `tb1`.`id` = `f`.`id`
		WHERE `tb1`.`sum`>0
	GROUP BY `f`.`mfl_code`
	ORDER BY  `name` ASC ;
END