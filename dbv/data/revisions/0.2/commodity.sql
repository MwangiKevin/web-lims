-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2015 at 01:34 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

-- Author Brian Hawi
-- first version of commodity 0.2
-- has a status field

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
-- Table structure for table `commodity`
--

CREATE TABLE IF NOT EXISTS `commodity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL COMMENT 'FK to commdity_category',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `commodity`
--

INSERT INTO `commodity` (`id`, `code`, `name`, `unit`, `category_id`, `status`) VALUES
(1, 'CAL 002', 'Tri-TEST CD3/CD4/CD45 with TruCOUNT Tubes', 'Tests', 1, 1),
(2, 'CAL 006', 'Falcon Tubes', 'Pieces', 1, 1),
(3, 'CAL 009', 'Printing Paper', 'Reams', 1, 1),
(4, '', 'Printer Catridge', 'Pieces', 1, 1),
(5, 'FAC 001', 'FACSCount CD4/CD3 Reagent [Adult]', 'Tests', 3, 1),
(6, 'FAC 002', 'FACSCount CD4 % reagent [Paediatric]', 'Tests', 3, 1),
(7, '', 'EASY Count CD4/CD3 Reagent [Adult]', 'Tests', 2, 1),
(8, '', 'EASY Count CD4 % reagent [Paediatric]', 'Tests', 2, 1),
(9, '', 'Cartridges', 'Pieces', 4, 1),
(10, '', 'Cell / ACT Pack', 'Litres', 5, 1),
(11, '', 'Cell Clean / ACT Rinse', 'Litres', 5, 1),
(12, '', 'ACT Diff 3 kits', 'Tests', 5, 1),
(13, '', 'ACT Diff 5 kits', 'Tests', 5, 1),
(14, '', 'Celtac 6400 kits', 'Tests', 5, 1),
(15, '', 'Celtac 8222', 'Tests', 5, 1),
(16, '', 'Haemo cuvettes', 'Tests', 5, 1),
(17, '', 'Albumin', 'Tests', 6, 1),
(18, '', 'Alkaline phosphatase', 'Tests', 6, 1),
(19, '', 'ALT (SGPT)', 'Tests', 6, 1),
(20, '', 'AST (SGOT)', 'Tests', 6, 1),
(21, '', 'Creatinine', 'Tests', 6, 1),
(22, '', 'Potassium', 'Tests', 6, 1),
(23, '', 'Sodium', 'Tests', 6, 1),
(24, '', 'Chloride', 'Tests', 6, 1),
(25, '', 'Gamma GT', 'Tests', 6, 1),
(26, '', 'Glucose test strips', 'Pieces', 6, 1),
(27, '', 'HDL Cholesterol', 'Tests', 6, 1),
(28, '', 'Pregnancy test strips', 'Pieces', 6, 1),
(29, '', 'Serum Amylase test kits', 'Tests', 6, 1),
(30, '', 'Serum protein kit', 'Tests', 6, 1),
(31, '', 'Total Cholesterol', 'Tests', 6, 1),
(32, '', 'Triglycerides', 'Tests', 6, 1),
(33, '', 'Bilirubin', 'Tests', 6, 1),
(34, '', 'Urea', 'Tests', 6, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
