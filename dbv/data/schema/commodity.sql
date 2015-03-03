CREATE TABLE `commodity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL COMMENT 'FK to reagentcategory',
  `reporting_status` int(11) NOT NULL COMMENT 'Reporting Status either 0 or 1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1