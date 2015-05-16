DROP PROCEDURE IF exists `proc_get_equipment`;
DELIMITER $$
CREATE PROCEDURE `proc_get_equipment`()
BEGIN
		SELECT `description` as `equipment`,`id` FROM `equipment` WHERE `category`= '1' ORDER BY `description` ASC;
END;
$$
DELIMITER ;
