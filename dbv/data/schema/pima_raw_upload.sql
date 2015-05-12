-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2015 at 01:37 PM
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
-- Table structure for table `pima_raw_upload`
--

CREATE TABLE IF NOT EXISTS `pima_raw_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_test_id` int(11) NOT NULL,
  `device_serial` varchar(30) NOT NULL,
  `assay_id` int(11) NOT NULL,
  `assay_name` varchar(15) NOT NULL,
  `sample_code` varchar(50) NOT NULL,
  `error_message` varchar(25) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `cd4_count` int(11) NOT NULL,
  `result_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `barcode` varchar(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `volume` varchar(11) NOT NULL,
  `device` varchar(11) NOT NULL,
  `reagent` varchar(11) NOT NULL,
  `software_version` varchar(11) NOT NULL,
  `export_error_message` varchar(15) NOT NULL,
  `valid_test` int(2) DEFAULT '0',
  `upload_file_name` varchar(100) DEFAULT NULL,
  `file_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pima Test Raw uploads' AUTO_INCREMENT=1 ;

--
-- Triggers `pima_raw_upload`
--
DROP TRIGGER IF EXISTS `trig_pima_uploads`;
DELIMITER //
CREATE TRIGGER `trig_pima_uploads` AFTER INSERT ON `pima_raw_upload`
 FOR EACH ROW BEGIN
	DECLARE cd4_test_id int(6);
	DECLARE device_id int(6);
	DECLARE facility_device_id int(6);
	DECLARE facility_id int(6);

	SELECT `AUTO_INCREMENT` INTO @cd4_test_id
						FROM  INFORMATION_SCHEMA.TABLES
						WHERE TABLE_SCHEMA = 'web-lims'
						AND   TABLE_NAME   = 'cd4_test';
	SELECT id as facility_device_id,
		facility_id,
		device_id
	INTO @facility_device_id,@facility_id,@device_id
	FROM facility_device WHERE 
		serial_number=NEW.device_serial  LIMIT 1;

	INSERT INTO cd4_test(id,cd4_count,patient_age_group_id,device_id,facility_device_id,facility_id,result_date,valid,timestamp)
						values(@cd4_test_id,NEW.cd4_count,3,@device_id,@facility_device_id,@facility_id,NEW.result_date,NEW.valid_test,NEW.start_time);

END
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
