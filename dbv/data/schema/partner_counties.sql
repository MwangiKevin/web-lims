CREATE TABLE `partner_counties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL COMMENT 'FK to partner',
  `county_id` int(11) NOT NULL COMMENT 'FK to county',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Mapping to partners and counties'