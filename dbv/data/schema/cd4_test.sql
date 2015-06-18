CREATE TABLE `cd4_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd4_count` int(11) NOT NULL,
  `patient_age_group_id` int(11) NOT NULL DEFAULT '3' COMMENT 'FK to patient age group',
  `sample` varchar(25) NOT NULL,
  `device_id` int(11) NOT NULL COMMENT 'pk to equipment',
  `facility_device_id` int(11) NOT NULL COMMENT 'FK to facility_equipment',
  `facility_id` int(11) NOT NULL COMMENT 'FK to facility',
  `result_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid` int(11) NOT NULL DEFAULT '1' COMMENT '1 for true 0 for false',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cd4_count` (`cd4_count`,`sample`,`device_id`,`result_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1