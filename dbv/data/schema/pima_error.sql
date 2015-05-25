CREATE TABLE `pima_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `error_code` varchar(75) DEFAULT NULL,
  `error_detail` varchar(50) NOT NULL,
  `pima_error_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `error_code` (`error_code`),
  KEY `error_detail` (`error_detail`),
  KEY `pima_error_type` (`pima_error_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1