-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2015 at 01:33 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

-- Author Brian Hawi
-- first version of commodity_category
-- the equipment_id column is set to zero as there is are no equipment yet

INSERT INTO `commodity_category` (`id`, `name`, `equipment_id`) VALUES
(1, 'FACS Calibur Reagents and Consumables', 0),
(2, 'Cyflow Partec Reagents', 0),
(3, 'FACS Count Reagents', 0),
(4, 'Point of Care CD4 reagents (e.g. PIMA, etc)', 0),
(5, 'Haematology', 0),
(6, 'Biochemistry', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
