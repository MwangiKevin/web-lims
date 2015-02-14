-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2015 at 10:57 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

-- Author Brian Hawi
-- first version of commodity_category
-- the equipment_id column is set to zero as there is are no equipment yet

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web-lims`
--

-- --------------------------------------------------------

--
-- Table structure for table `commodity_category`
--

CREATE TABLE IF NOT EXISTS `commodity_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `commodity_category`
--

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
