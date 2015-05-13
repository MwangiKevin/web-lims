CREATE VIEW `v_device_details` AS 
select `f`.`name` AS `facility_name`,
`f`.`id` AS `facility_id`,
`f`.`mfl_code` AS `mfl_code`,
`f`.`facility_type_id` AS `facility_type_id`,
`ft`.`initials` AS `type`,
`f`.`sub_county_id` AS `sub_county_id`,
`sc`.`name` AS `sub_county_name`,
`sc`.`county_id` AS `county_id`,
`c`.`name` AS `county_name`,
`f`.`central_site_id` AS `central_site_id`,
`fd`.`device_id` AS `device_id`,
`fd`.`status` AS `status`,
`d`.`name` AS `device_name` 
from (((((`facility_device` `fd` join `facility` `f`) join `device` `d`) join `sub_county` `sc`) join `county` `c`) join `facility_type` `ft`) where ((`fd`.`facility_id` = `f`.`id`) and (`f`.`sub_county_id` = `sc`.`id`) and (`fd`.`device_id` = `d`.`id`) and (`sc`.`county_id` = `c`.`id`) and (`f`.`facility_type_id` = `ft`.`id`));

