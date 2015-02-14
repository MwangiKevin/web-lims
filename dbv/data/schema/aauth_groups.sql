CREATE TABLE `aauth_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`),
  KEY `id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8