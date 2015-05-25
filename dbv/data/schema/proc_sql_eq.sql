DELIMITER $$
DROP PROCEDURE IF exists `proc_sql_eq`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_sql_eq`()
BEGIN
			SELECT `name` as `equipment`,`id` FROM `device` WHERE `status`= '1' ORDER BY `name` ASC; 
		END$$
DELIMITER ;
