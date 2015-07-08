DROP PROCEDURE IF EXISTS proc_api_get_facility_types;
DELIMITER $$
CREATE procedure proc_api_get_facility_types()
BEGIN
SELECT * FROM facility_type;
END;
$$

delimiter ;
SHOW errors; 