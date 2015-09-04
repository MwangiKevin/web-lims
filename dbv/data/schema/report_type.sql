CREATE TABLE `report_type` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `report_name` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `periodic_interval` varchar(20) NOT NULL,
  `relative_url` varchar(50) NOT NULL,
  `last_batch_sending` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1