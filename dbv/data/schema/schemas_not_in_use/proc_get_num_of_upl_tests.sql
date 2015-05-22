DROP PROCEDURE IF EXISTS `proc_get_num_of_upl_tests`;

CREATE PROCEDURE  proc_get_num_of_upl_tests (`dev_test_id` int(11),`sa_code` varchar(120) ,`res_date` varchar(50)) 
					BEGIN
							SELECT 
												COUNT(*) AS `num`
											FROM `pima_test` 
											LEFT JOIN `cd4_test`
												ON `cd4_test`.`id`=`pima_test`.`cd4_test_id` 
											WHERE 	`device_test_id`			= 	`dev_test_id`
											AND		`sample_code` 				=	`sa_code`
											AND		`cd4_test`.`result_date`	=	`res_date`;

					END;