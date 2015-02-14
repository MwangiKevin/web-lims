CREATE TABLE `aauth_pms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text,
  `date` datetime DEFAULT NULL,
  `read` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8