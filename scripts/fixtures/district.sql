-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2012 at 11:56 AM
-- Server version: 5.0.87
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dwr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `did` int(11) NOT NULL auto_increment,
  `dname` varchar(100) NOT NULL,
  PRIMARY KEY  (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`did`, `dname`) VALUES
(1, 'Colombo'),
(2, 'Gampaha'),
(3, 'Kalutara'),
(4, 'Kandy'),
(5, 'Matale'),
(6, 'Nuwaraeliya'),
(7, 'Batticaloa'),
(8, 'Trincomalee'),
(9, 'Ampara'),
(10, 'Jaffna'),
(11, 'Mannar'),
(12, 'Mullaitivu'),
(13, 'Vavuniya'),
(14, 'Anuradhapura'),
(15, 'Polonnaruwa'),
(16, 'Kurunegala'),
(17, 'Puttalam'),
(18, 'Ratnapura'),
(19, 'Kegalle'),
(20, 'Galle'),
(21, 'Matara'),
(22, 'Hambantota'),
(23, 'Badulla'),
(24, 'Monaragala');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
