CREATE TABLE `report_user_subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_type_id` int(6) NOT NULL,
  `aauth_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `report_type_id` (`report_type_id`,`aauth_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1