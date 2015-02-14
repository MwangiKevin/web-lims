CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  KEY `perm_id_group_id_index` (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8