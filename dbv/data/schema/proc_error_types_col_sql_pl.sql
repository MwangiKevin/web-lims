DROP PROCEDURE IF EXISTS `proc_error_types_col_sql_pl`

CREATE PROCEDURE proc_error_types_col_sql_pl(user_group_id int(11),user_filter_used int(11), from_date date,to_date date)
BEGIN 
	SELECT * FROM `pima_error_type`;
END