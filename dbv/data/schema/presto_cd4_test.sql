DROP TABLE IF EXISTS `presto_cd4_test`; CREATE TABLE `presto_cd4_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `run_id` varchar(100) NOT NULL,
  `run_date_time` datetime NOT NULL,
  `operator` varchar(100) NOT NULL,
  `reagent_lot_id` int(11) NOT NULL,
  `reagent_lot_exp` date NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `inst_qc_passed` varchar(100) NOT NULL,
  `reagent_qc_passed` varchar(100) NOT NULL,
  `cd4` int(11) NOT NULL,
  `%cd4` int(11) NOT NULL,
  `passed` int(11) NOT NULL,
  `error_codes` varchar(100) NOT NULL,
  `serial_number` varchar(100) NOT NULL,
  `file_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1