-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2015 at 02:31 PM
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
-- Table structure for table `facility_equipment`
--

CREATE TABLE IF NOT EXISTS `facility_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'FK to equipmentstatus',
  `deactivation_reason` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_removed` datetime DEFAULT NULL,
  `serial_number` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Equipment mapped to facilities' AUTO_INCREMENT=57 ;

--
-- Dumping data for table `facility_equipment`
--

INSERT INTO `facility_equipment` (`id`, `facility_id`, `equipment_id`, `status`, `deactivation_reason`, `date_added`, `date_removed`, `serial_number`) VALUES
(1, 822, 4, 1, '', '2014-02-28 05:01:53', NULL, 'PIMA-D-002766'),
(2, 837, 4, 1, '', '2014-02-28 05:07:44', NULL, 'PIMA-D-002774'),
(3, 1019, 4, 1, '', '2014-02-28 07:19:11', NULL, 'PIMA-D-002538'),
(5, 1055, 4, 1, '', '2014-02-28 07:20:49', NULL, 'PIMA-D-002534'),
(6, 1143, 4, 1, '', '2014-02-28 07:21:18', NULL, 'PIMA-D-002778'),
(7, 307, 4, 1, '', '2014-02-28 07:22:31', NULL, 'PIMA-D-002409'),
(8, 1281, 4, 1, '', '2014-02-28 07:23:00', NULL, 'PIMA-D-002628'),
(9, 346, 4, 1, '', '2014-02-28 07:23:33', NULL, 'PIMA-D-002393'),
(10, 876, 4, 1, '', '2014-02-28 07:24:18', NULL, 'PIMA-D-002597'),
(11, 877, 4, 1, '', '2014-02-28 07:24:48', NULL, 'PIMA-D-002508'),
(12, 1086, 4, 1, '', '2014-02-28 07:25:27', NULL, 'PIMA-D-002772'),
(13, 885, 4, 1, '', '2014-02-28 07:25:59', NULL, 'PIMA-D-002949'),
(14, 222, 4, 1, '', '2014-02-28 07:26:46', NULL, 'PIMA-D-003304'),
(15, 373, 4, 1, '', '2014-02-28 07:28:08', NULL, 'PIMA-D-002950'),
(16, 462, 4, 1, '', '2014-02-28 07:29:05', NULL, 'PIMA-D-002769'),
(17, 377, 4, 1, '', '2014-02-28 07:30:34', NULL, 'PIMA-D-002598'),
(18, 286, 4, 1, '', '2014-02-28 07:31:31', NULL, 'PIMA-D-003130'),
(19, 274, 4, 1, '', '2014-02-28 07:33:05', NULL, 'PIMA-D-002494'),
(20, 380, 4, 1, '', '2014-02-28 07:33:49', NULL, 'PIMA-D-002359'),
(21, 379, 4, 1, '', '2014-02-28 07:34:30', NULL, 'PIMA-D-002655'),
(22, 400, 4, 1, '', '2014-02-28 07:35:06', NULL, 'PIMA-D-002562'),
(23, 340, 4, 1, '', '2014-02-28 07:35:46', NULL, 'PIMA-D-002965'),
(24, 739, 4, 1, '', '2014-02-28 07:36:23', NULL, 'PIMA-D-002764'),
(25, 957, 4, 1, '', '2014-02-28 07:37:45', NULL, 'PIMA-D-002946'),
(26, 981, 4, 1, '', '2014-02-28 07:38:19', NULL, 'PIMA-D-003141'),
(27, 986, 4, 1, '', '2014-02-28 07:39:07', NULL, 'PIMA-D-002593'),
(28, 962, 4, 1, '', '2014-02-28 07:39:43', NULL, 'PIMA-D-002960'),
(29, 784, 4, 1, '', '2014-02-28 07:40:09', NULL, 'PIMA-D-002608'),
(30, 16, 4, 1, '', '2014-02-28 07:42:08', NULL, 'PIMA-D-003142'),
(31, 992, 4, 1, '', '2014-02-28 07:43:12', NULL, 'PIMA-D-002629'),
(32, 255, 4, 1, '', '2014-02-28 07:45:08', NULL, 'PIMA-D-002975'),
(33, 299, 4, 1, '', '2014-02-28 07:45:49', NULL, 'PIMA-D-003125'),
(34, 1313, 4, 1, '', '2014-02-28 07:46:21', NULL, 'PIMA-D-002935'),
(35, 265, 4, 1, '', '2014-02-28 07:46:51', NULL, 'PIMA-D-002901'),
(36, 342, 4, 1, '', '2014-02-28 07:47:28', NULL, 'PIMA-D-002973'),
(37, 1170, 4, 1, '', '2014-02-28 07:48:34', NULL, 'PIMA-D-002773'),
(38, 1360, 4, 1, '', '2014-02-28 08:13:18', NULL, 'PIMA-D-002775'),
(39, 1358, 4, 1, '', '2014-02-28 08:15:15', NULL, 'PIMA-D-002617'),
(40, 620, 4, 1, '', '2014-02-28 08:16:02', NULL, 'PIMA-D-002977'),
(41, 1361, 4, 1, '', '2014-02-28 08:16:44', NULL, 'PIMA-D-002620'),
(42, 1359, 4, 1, '', '2014-02-28 08:17:31', NULL, 'PIMA-D-002618'),
(43, 1363, 4, 1, '', '2014-02-28 08:18:00', NULL, 'PIMA-D-002933'),
(44, 1362, 4, 1, '', '2014-02-28 08:50:46', NULL, 'PIMA-D-002565'),
(45, 654, 4, 1, '', '2014-03-28 07:04:47', NULL, 'PIMA-D-002910'),
(46, 667, 4, 1, '', '2014-03-28 07:05:51', NULL, 'PIMA-D-000328'),
(47, 659, 4, 0, 'For Repair', '2014-03-28 07:06:10', NULL, 'PIMA-D-002899'),
(48, 657, 4, 1, '', '2014-03-28 07:06:45', NULL, 'PIMA-D-002818'),
(49, 654, 4, 1, '', '2014-08-08 11:27:04', NULL, 'PIMA-D-002785'),
(50, 605, 4, 1, '', '2015-02-27 05:37:08', NULL, 'PIMA-D-002151'),
(51, 528, 4, 1, '', '2015-03-02 10:15:30', NULL, 'PIMA-D-002979'),
(52, 558, 4, 1, '', '2015-03-03 09:19:40', NULL, 'PIMA-D-006649'),
(53, 654, 4, 1, '', '2015-03-11 13:11:29', NULL, 'PIMA-D-002900'),
(54, 654, 4, 1, '', '2015-03-11 13:12:08', NULL, 'PIMA-D-002895'),
(55, 654, 4, 1, '', '2015-03-11 13:12:41', NULL, 'PIMA-D-002875'),
(56, 659, 4, 1, '', '2015-03-11 13:16:57', NULL, 'PIMA-D-002821');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
