-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2015 at 11:58 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

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
-- Table structure for table `presto_qc`
--

CREATE TABLE IF NOT EXISTS `presto_qc` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `run_id` varchar(100) NOT NULL,
  `run_date_time` datetime NOT NULL,
  `operator` varchar(100) NOT NULL,
  `reagent_lot_id` int(11) NOT NULL,
  `reagent_lot_exp` date NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `inst_qc_passed` varchar(100) NOT NULL,
  `reagent_qc_passed` varchar(100) NOT NULL,
  `cd4` int(11) NOT NULL,
  `%cd4` int(11) NOT NULL,
  `passed` int(11) NOT NULL,
  `error_codes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `presto_qc`
--
ALTER TABLE `presto_qc`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `presto_qc`
--
ALTER TABLE `presto_qc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
