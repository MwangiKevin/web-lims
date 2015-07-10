CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_report_yearly_facility_cd4_testing`(year int(11))
BEGIN

        SET @Q1 = "	SELECT 
										`f`.`mfl_code` 	AS `facility_mfl_code`,
										`f`.`name` 	AS `facility_name`,
										COUNT(DISTINCT  fd.id) AS 'no_of_devices',
										SUM( CASE WHEN MONTH(`tst`.`result_date`) = 1 THEN 1 ELSE 0 END) AS `jan`,
										SUM( CASE WHEN MONTH(`tst`.`result_date`) = 2 THEN 1 ELSE 0 END) AS `feb`,
										SUM( CASE WHEN MONTH(`tst`.`result_date`) = 3 THEN 1 ELSE 0 END) AS `mar`,
										SUM( CASE WHEN MONTH(`tst`.`result_date`) = 4 THEN 1 ELSE 0 END) AS `apr`,
										SUM( CASE WHEN MONTH(`tst`.`result_date`) = 5 THEN 1 ELSE 0 END) AS `may`,
										SUM( CASE WHEN MONTH(`tst`.`result_date`) = 6 THEN 1 ELSE 0 END) AS `jun`,
										SUM( CASE WHEN MONTH(`tst`.`result_date`) = 7 THEN 1 ELSE 0 END) AS `jul`,
										SUM( CASE WHEN MONTH(`tst`.`result_date`) = 8 THEN 1 ELSE 0 END) AS `aug`,
										SUM( CASE WHEN MONTH(`tst`.`result_date`) = 9 THEN 1 ELSE 0 END) AS `sept`,
							            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 10 THEN 1 ELSE 0 END) AS `oct`,
							            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 11 THEN 1 ELSE 0 END) AS `nov`,
							            SUM( CASE WHEN MONTH(`tst`.`result_date`) = 12 THEN 1 ELSE 0 END) AS `dec`
							FROM facility f ";
					SET@Q2 = CONCAT("		LEFT JOIN cd4_test tst ON (tst.facility_id = f.id AND YEAR(`tst`.`result_date`) = ",year,")");
					SET @Q3= "				LEFT JOIN facility_device fd ON fd.facility_id = f.id	

							WHERE fd.id IS NOT NULL
						    


						GROUP BY f.id
						ORDER BY f.name ASC

	    ";

	   	SET  @QUERY = CONCAT(@Q1,@Q2,@Q3);

        PREPARE stmt FROM @QUERY;
        EXECUTE stmt;
        -- SELECT @QUERY;
        -- SHOW ERRORS;
END