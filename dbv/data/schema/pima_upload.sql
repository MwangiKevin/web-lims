CREATE TABLE `pima_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `facility_pima_id` varchar(100) NOT NULL COMMENT 'FK to facility pima',
  `uploaded_by` int(11) NOT NULL COMMENT 'FK to user',
  `file_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `facility_pima_id` (`facility_pima_id`,`file_date`,`upload_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pima uploads'