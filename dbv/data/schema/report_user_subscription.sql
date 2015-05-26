CREATE TABLE `report_user_subscription` (
  `id` int(6) NOT NULL,
  `report_type_id` int(6) NOT NULL,
  `aauth_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1