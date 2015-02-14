CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `perm_id_user_id_index` (`perm_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8