CREATE TABLE `aauth_user_variables` (
  `user_id` int(11) NOT NULL,
  `key` text NOT NULL,
  `value` text,
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8