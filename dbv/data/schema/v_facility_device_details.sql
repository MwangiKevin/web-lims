-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2015 at 03:32 PM
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
-- Structure for view `v_facility_device_details`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_facility_device_details` AS select `f`.`id` AS `facility_id`,`f`.`name` AS `facility_name`,`f`.`mfl_code` AS `mfl_code`,`f`.`sub_county_id` AS `sub_county_id`,`sc`.`name` AS `sub_county_name`,`f`.`partner_id` AS `partner_id`,`p`.`name` AS `partner_name`,`c`.`id` AS `county_id`,`c`.`name` AS `county_name`,`fd`.`id` AS `facility_device_id`,`fd`.`device_id` AS `device_id`,`f`.`rollout_status` AS `rollout_status`,`fd`.`status` AS `status`,`fd`.`deactivation_reason` AS `deactivation_reason`,`fd`.`serial_number` AS `serial_number` from ((((`facility_device` `fd` left join `facility` `f` on((`fd`.`facility_id` = `f`.`id`))) left join `sub_county` `sc` on((`f`.`sub_county_id` = `sc`.`id`))) left join `county` `c` on((`sc`.`county_id` = `c`.`id`))) left join `partner` `p` on((`f`.`partner_id` = `p`.`id`)));

--
-- VIEW  `v_facility_device_details`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
