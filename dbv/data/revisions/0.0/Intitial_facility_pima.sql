-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2015 at 02:32 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

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
-- Table structure for table `facility_pima`
--

CREATE TABLE IF NOT EXISTS `facility_pima` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_equipment_id` int(11) NOT NULL COMMENT 'FK to facility_equipment',
  `serial_num` varchar(30) NOT NULL,
  `ctc_id_no` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `facility_pima`
--

INSERT INTO `facility_pima` (`id`, `facility_equipment_id`, `serial_num`, `ctc_id_no`) VALUES
(1, 1, 'PIMA-D-002766', ''),
(2, 2, 'PIMA-D-002774', ''),
(3, 3, 'PIMA-D-002538', ''),
(4, 5, 'PIMA-D-002534', ''),
(5, 6, 'PIMA-D-002778', ''),
(6, 7, 'PIMA-D-002409', ''),
(7, 8, 'PIMA-D-002628', ''),
(8, 9, 'PIMA-D-002393', ''),
(9, 10, 'PIMA-D-002597', ''),
(10, 11, 'PIMA-D-002508', ''),
(11, 12, 'PIMA-D-002772', ''),
(12, 13, 'PIMA-D-002949', ''),
(13, 14, 'PIMA-D-003304', ''),
(14, 15, 'PIMA-D-002950', ''),
(15, 16, 'PIMA-D-002769', ''),
(16, 17, 'PIMA-D-002598', ''),
(17, 18, 'PIMA-D-003130', ''),
(18, 19, 'PIMA-D-002494', ''),
(19, 20, 'PIMA-D-002359', ''),
(20, 21, 'PIMA-D-002655', ''),
(21, 22, 'PIMA-D-002562', ''),
(22, 23, 'PIMA-D-002965', ''),
(23, 24, 'PIMA-D-002764', ''),
(24, 25, 'PIMA-D-002946', ''),
(25, 26, 'PIMA-D-003141', ''),
(26, 27, 'PIMA-D-002593', ''),
(27, 28, 'PIMA-D-002960', ''),
(28, 29, 'PIMA-D-002608', ''),
(29, 30, 'PIMA-D-003142', ''),
(30, 31, 'PIMA-D-002629', ''),
(31, 32, 'PIMA-D-002975', ''),
(32, 33, 'PIMA-D-003125', ''),
(33, 34, 'PIMA-D-002935', ''),
(34, 35, 'PIMA-D-002901', ''),
(35, 36, 'PIMA-D-002973', ''),
(36, 37, 'PIMA-D-002773', ''),
(37, 38, 'PIMA-D-002775', ''),
(38, 39, 'PIMA-D-002617', ''),
(39, 40, 'PIMA-D-002977', ''),
(40, 41, 'PIMA-D-002620', ''),
(41, 42, 'PIMA-D-002618', ''),
(42, 43, 'PIMA-D-002933', ''),
(43, 44, 'PIMA-D-002565', ''),
(44, 45, 'PIMA-D-002910', ''),
(45, 46, 'PIMA-D-000328', ''),
(46, 47, 'PIMA-D-002899', ''),
(47, 48, 'PIMA-D-002818', ''),
(48, 49, 'PIMA-D-002785', ''),
(49, 50, 'PIMA-D-002151', ''),
(50, 51, 'PIMA-D-002979', ''),
(51, 52, 'PIMA-D-006649', ''),
(52, 53, 'PIMA-D-002900', ''),
(53, 54, 'PIMA-D-002895', ''),
(54, 55, 'PIMA-D-002875', ''),
(55, 56, 'PIMA-D-002821', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
