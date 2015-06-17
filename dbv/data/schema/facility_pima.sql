CREATE TABLE `facility_pima` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_device_id` int(11) NOT NULL COMMENT 'FK to facility_equipment',
  `serial_num` varchar(30) NOT NULL,
  `ctc_id_no` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1