CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `user_id_group_id_index` (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8