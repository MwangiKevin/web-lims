CREATE TABLE `sub_county_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'FK to user',
  `sub_county_id` int(11) NOT NULL COMMENT 'FK to sub_count',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='sub_count and user mapping table'