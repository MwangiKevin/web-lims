CREATE TABLE IF NOT EXISTS `presto_qc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `run_id` varchar(100) NOT NULL,
  `run_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `operator` varchar(100) DEFAULT NULL COMMENT 'can have operator name or remain blank for self tests',
  `normal_count` int(11) NOT NULL,
  `low_count` int(11) NOT NULL,
  `passed` varchar(100) NOT NULL,
  `error_codes` varchar(100) NOT NULL,
  `serial_number` varchar(100) NOT NULL,
  `file_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1