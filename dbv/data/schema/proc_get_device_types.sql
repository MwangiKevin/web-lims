CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_device_types`()
BEGIN
select * from device order by name ASC;
END