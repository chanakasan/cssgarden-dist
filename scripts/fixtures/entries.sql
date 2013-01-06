-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2013 at 06:45 PM
-- Server version: 5.0.87
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dcr_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `dwpno` varchar(32) NOT NULL,
  `date` varchar(32) NOT NULL,
  `cat` varchar(32) NOT NULL,
  `customer` varchar(32) NOT NULL,
  `customerInfo` varchar(64) NOT NULL,
  `visitTime` varchar(32) NOT NULL,
  `area` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `activity` varchar(64) NOT NULL,
  `result` varchar(64) NOT NULL,
  `remarks` varchar(64) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cat` (`cat`),
  KEY `area` (`area`),
  KEY `city` (`city`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `user_id`, `dwpno`, `date`, `cat`, `customer`, `customerInfo`, `visitTime`, `area`, `city`, `activity`, `result`, `remarks`) VALUES
(1, 2, '06012013102', '2013-01-06 18:38:51', 'Doctor', 'Dr. Fernando 1', 'some details...', '11 am', 'Colombo', 'Akarawita', 'meeting', 'incomplete', '---'),
(2, 2, '06012013102', '2013-01-06 18:39:58', 'Doctor', 'Dr. Fernando 2', 'some details...', '12 pm', 'Colombo', 'Akuregoda', 'meeting', 'incomplete', '---'),
(3, 2, '06012013102', '2013-01-06 18:42:15', 'Doctor', 'Dr. Fernando 3', 'some details...', '1 pm', 'Colombo', 'Angoda', 'meeting', 'incomplete', '---'),
(4, 2, '06012013102', '2013-01-06 18:43:09', 'Doctor', 'Dr. Fernando 4', 'some details...', '2 pm', 'Colombo', 'Athurugiriya', 'meeting', 'incomplete', '---'),
(5, 2, '06012013102', '2013-01-06 18:44:21', 'Doctor', 'Dr. Fernando 5', 'some details...', '3 pm', 'Colombo', 'Avissawella', 'meeting', 'incomplete', '---');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
