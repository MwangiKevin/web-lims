DROP PROCEDURE IF EXISTS proc_get_device_types;
DELIMITER $$
CREATE procedure proc_get_device_types()
BEGIN
select * from device order by name ASC;
END;
$$

delimiter ;
SHOW errors; 