DROP VIEW IF EXISTS `v_pima_upload_details`;
CREATE VIEW `v_pima_upload_details` AS
SELECT pru.id AS test_id,
cd4.id AS cd4_test_id, 
pru.pima_upload_id, 
pru.device_test_id, 
pru.device_serial AS serial_number, 
fd.id AS facility_id, 
f.name AS facility_name, 
sc.id AS sub_county_id, 
sc.name AS sub_county_name, 
c.id AS county_id, 
c.name AS county_name, 
p.id AS partner_id, 
p.name AS partner_name, 
pru.assay_id, 
pru.assay_name, 
pru.sample_code, 
pru.operator,
pru.cd4_count, 
pru.error_message, 
pe.error_detail, 
pet.description, 
pru.result_date, 
pru.valid_test AS valid,
pu.upload_date,
pru.barcode, 
pru.expiry_date, 
pru.volume, 
pru.device, 
pru.reagent, 
pru.software_version 
FROM pima_raw_upload pru 
LEFT JOIN facility_device fd ON pru.device_serial=fd.serial_number 
LEFT JOIN facility f ON fd.facility_id=f.id 
LEFT JOIN sub_county sc ON f.sub_county_id=sc.id 
LEFT JOIN county c ON sc.county_id=c.id 
LEFT JOIN partner p ON f.partner_id=p.id 
LEFT JOIN pima_error pe ON pru.error_message=pe.error_code 
LEFT JOIN pima_error_type pet ON pe.pima_error_type=pet.id 
LEFT JOIN cd4_test cd4 ON cd4.id=pru.id
LEFT JOIN pima_upload pu ON pru.pima_upload_id=pu.id