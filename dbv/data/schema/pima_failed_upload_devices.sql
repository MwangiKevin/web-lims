CREATE TABLE `pima_failed_upload_devices` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `serial_num` varchar(30) DEFAULT NULL,
  `user_id` int(30) DEFAULT NULL,
  `equipment_id` int(30) DEFAULT NULL,
  `status` int(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1