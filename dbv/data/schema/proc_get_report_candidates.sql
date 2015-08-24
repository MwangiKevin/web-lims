CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_report_candidates`(report_type_id int(11))
BEGIN
			SET @QUERY =    "SELECT 
									`u`.`id` AS `user_id`,
									`u`.`name` AS `name`,
									 CASE WHEN `g`.`id`  ='4' THEN `f`.`email` ELSE `u`.`email` END AS `email`,
									`u2g`.`group_id` AS `group_id`,
									`g`.`name` AS `group`,	
									CASE `g`.`name`
									 	WHEN 'facility_users' THEN 1 
									 	WHEN 'facility_default' THEN 1 
									 	WHEN 'sub_county_level_user' THEN 2 
									 	WHEN 'county_level_user' THEN 3 
									 	WHEN 'partners' THEN 4
									 	ELSE 0 
									END AS `filter_type`,	
									`uv`.`value` AS `filter_id`

								FROM `aauth_users` `u`
								RIGHT JOIN `aauth_user_to_group` `u2g`
								ON `u`.`id` = `u2g`.`user_id`
									LEFT JOIN `aauth_groups` `g`
									ON `u2g`.`group_id`=`g`.`id`

								LEFT JOIN `aauth_user_variables` `uv`
								ON `u`.`id` = `uv`.`user_id`
								AND `uv`.`key` = 'linked_entity_id'
									LEFT JOIN `facility` `f`
									ON `uv`.`value` = `f`.`id`
									AND `g`.`id`  ='4'

								RIGHT JOIN `report_user_subscription` `rus`
								ON `u`.`id` = `rus`.`aauth_user_id`
							";

  


        SET @QUERY = CONCAT(@QUERY, " AND `rus`.`report_type_id` ='",report_type_id,"' ");

        SET @QUERY2 = 	"
        				WHERE 
							(
								`u`.`email` REGEXP '[-a-z0-9~!$%^&*_=+}{\\\'?]+(\\.[-a-z0-9~!$%^&*_=+}{\\\'?]+)*@([a-z0-9_][-a-z0-9_]*(\\.[-a-z0-9_]+)*\\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}))(:[0-9]{1,5})?'
								OR `f`.`email` REGEXP '[-a-z0-9~!$%^&*_=+}{\\\'?]+(\\.[-a-z0-9~!$%^&*_=+}{\\\'?]+)*@([a-z0-9_][-a-z0-9_]*(\\.[-a-z0-9_]+)*\\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}))(:[0-9]{1,5})?'
							)
						";

        SET @QUERY = CONCAT(@QUERY, " AND `rus`.`report_type_id` ='",report_type_id,"'");

        SET @QUERY = CONCAT(@QUERY,@QUERY2);

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        -- SELECT @QUERY;
    END