SELECT 
	`AutoID` 		as 	`id`,
	`name`			as 	`name`,
	`MFLCode` 		as 	`mfl_code`,
	`siteprefix`	as 	`site_prefix`,
	`district`		as 	`sub_county_id`,
	`partnerID`		as 	`partner_id`,
	`type`			as	`facility_type_id`,
	`level`			as	`level`,
	`centralsiteAutoID` as `central_site_id`,
	`email`			as 	`email`,
	''				as	`phone`,
	`rolloutstatus`	as 	`rollout_status`,
	`rolloutDate`	as	`rollout_date`,
	''				as	`google_maps`
	
	

FROM `facility` WHERE 1
GROUP BY `MFLCode`