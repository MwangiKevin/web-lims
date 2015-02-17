DROP PROCEDURE IF EXISTS `proc_sql_eq`;

CREATE PROCEDURE proc_sql_eq()
		BEGIN
			SELECT `description` as `equipment`,`id` FROM `equipment` WHERE `category`= '1' ORDER BY `description` ASC; 
		END;