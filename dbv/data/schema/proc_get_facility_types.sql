CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_get_facility_types`()
BEGIN
SELECT * FROM facility_type;
END