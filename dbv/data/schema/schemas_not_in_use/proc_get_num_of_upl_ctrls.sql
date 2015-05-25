DROP PROCEDURE IF EXISTS `proc_get_num_of_upl_ctrls`;

CREATE PROCEDURE  proc_get_num_of_upl_ctrls (`dev_test_id` int(11),`sa_code` varchar(120) ,`res_date` varchar(50)) 
					BEGIN
							SELECT 
									COUNT(*) AS `num`
								FROM `pima_control` 
								WHERE 	`device_test_id`			= 	`dev_test_id`
								AND		`sample_code` 				=	`sa_code`
								AND		`result_date`				=	`res_date`;

					END;