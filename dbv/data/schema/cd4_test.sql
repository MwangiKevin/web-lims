CREATE TABLE `cd4_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd4_count` int(11) NOT NULL,
  `patient_age_group_id` int(11) NOT NULL DEFAULT '3' COMMENT 'FK to patient age group',
  `equipment_id` int(11) NOT NULL COMMENT 'pk to equipment',
  `patient_id` varchar(25) NOT NULL COMMENT 'Patient unique number (CCC)',
  `facility_device_id` int(11) NOT NULL COMMENT 'FK to facility_device',
  `facility_id` int(11) NOT NULL COMMENT 'FK to facility',
  `result_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid` int(11) NOT NULL DEFAULT '1' COMMENT '1 for true 0 for false',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1