CREATE TABLE IF NOT EXISTS `presto_cd4_tests` (
`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `run_id` varchar(100) NOT NULL,
  `run_date_time` datetime NOT NULL,
  `operator` varchar(100) DEFAULT NULL COMMENT 'can have operator name or remain blank for self tests',
  `normal_count` int(11) NOT NULL,
  `low_count` int(11) NOT NULL,
  `passed` varchar(100) NOT NULL,
  `error_codes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
