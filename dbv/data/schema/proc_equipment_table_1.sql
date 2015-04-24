DROP PROCEDURE IF EXISTS `proc_equipment_table_1`;

DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_equipment_table_1` (from_date date, to_date date, user_group_id int(11), user_filter_used int(11))
	BEGIN
			SELECT 
						`description` as `equipment`,
						`id` FROM `equipment`

			 WHERE 		`category`= '1' 
			 ORDER BY 	`description`
			 ASC

END;
DELIMITER $$;

SHOW ERRORS;