-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2015 at 11:01 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

-- Author Brian Hawi
-- first version of commodity 0.1

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `commodity`
--

INSERT INTO `commodity` (`id`, `code`, `name`, `unit`, `category_id`) VALUES
(1, 'CAL 002', 'Tri-TEST CD3/CD4/CD45 with TruCOUNT Tubes', '50T Pack', 1),
(2, 'CAL 003', 'Calibrite 3 Beads', '3 Vials Pack', 1),
(3, 'CAL 005', 'FACS Lysing solution', '100mL Pack', 1),
(4, '', 'FACS Clean solution', '5L Pack', 1),
(5, '', 'FACS Rinse solution', '5L Pack', 1),
(6, '', 'FACS Flow solution', '20L Pack', 1),
(7, 'CAL 006', 'Falcon Tubes', '125 pcs Pack', 1),
(8, '', 'BD Multi-Check Control', 'Pack', 1),
(9, '', 'BD Multi-Check CD4 Low Control', 'Pack', 1),
(10, 'CAL 009', 'Printing Paper (A4)', 'Raem', 1),
(11, 'CAL 010', 'HP Laser Jet Printer Catridge 53A', 'pcs', 1),
(12, '', 'PARTEC EASY Count CD4 Reagents (Paediatrcics)', '100T Pack', 2),
(13, '', 'PARTEC Control check beads', '25mL Pack', 2),
(14, '', 'PARTEC Sheath Fluid', '5L Pack', 2),
(15, '', 'PARTEC Cleaning Solution', '250mL Pack', 2),
(16, '', 'PARTEC Decontamination solution', '250mL Pack', 2),
(17, '', 'PARTEC Bleaching solution', '250mL Pack', 2),
(18, '', 'PARTEC Rohren Tubes', '500 pcs Pack', 2),
(19, '', 'printing Paper (A4)', 'Ream', 2),
(20, '', 'HP Laser Jet Printer Cartilage 35A', 'pcs', 2),
(21, '340167', 'FACSCount Kit 50T', '50T', 3),
(22, '340166', 'FACSCount Controls', ' 25T', 3),
(23, '342003', 'FACSFlow', '20L', 3),
(24, '340345', 'FACSClean', ' 5L', 3),
(25, '340346', 'FACS Rinse', '5L', 3),
(26, '332839', 'Thermal Paper FacsCount', '5 Rolls', 3),
(27, 'CON 007', 'Vacutainer EDTA 4ml  tubes', '100/pack', 4),
(28, 'CON 011', 'Vacutainer Needle 21G [Adult]\r\n', '100/pack', 4),
(29, 'FAC 002', 'FACSCount CD4 % reagent [Peadiatric]\r\n', '50 tests', 3),
(30, 'CON 009', 'Microtainer tubes [Paediatric]', '50/Pack', 4),
(31, 'CON 010', 'Microtainer Pink lancets 21G [Paediatric]', '200/Pack', 4),
(32, 'CON 012', 'Vacutainer Butterfly Needle 23G [Paediatrics]', '50/Pack', 4),
(33, 'CON 005', 'Yellow Pipette Tips (50 MicroL)', '1,000 tips', 4),
(34, 'CON 008', 'CD4 Stabilizer tubes 5ml', '100/Pack', 4),
(35, '', 'BD TruCount Control', 'pack', 1),
(36, '', 'PIMA Catridge', '1', 5),
(37, 'FAC 001', 'FACSCount CD4 % reagent [Adult]\r\n', '50 tests', 3),
(38, 'CON 001', 'Sheath Fluid', '20L', 4),
(39, 'CON 002', 'Cleaning Fluid', '5L', 4),
(40, 'CON 003', 'Rinse Fluid', '5L', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
