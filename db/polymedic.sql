-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2015 at 05:48 PM
-- Server version: 5.5.28
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `polymedic`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `b_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `b_name` varchar(45) NOT NULL DEFAULT '',
  `b_desc` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `branch`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `d_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `d_fname` varchar(45) NOT NULL DEFAULT '',
  `d_mname` varchar(45) NOT NULL DEFAULT '',
  `d_lname` varchar(45) NOT NULL DEFAULT '',
  `d_sched` varchar(45) NOT NULL DEFAULT '',
  `sp_id` int(10) unsigned NOT NULL DEFAULT '0',
  `b_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`d_id`),
  KEY `sp_id` (`sp_id`),
  KEY `b_id` (`b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `specification`
--

CREATE TABLE IF NOT EXISTS `specification` (
  `sp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sp_name` varchar(45) NOT NULL DEFAULT '',
  `sp_desc` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`sp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `specification`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL DEFAULT '',
  `password` varchar(400) NOT NULL DEFAULT '',
  `u_type` varchar(45) NOT NULL DEFAULT '',
  `Name` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `username`, `password`, `u_type`, `Name`) VALUES
(1, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'ADMINISTRATOR', 'Adminsitrator'),
(2, 'guest@guest.com', '084e0343a0486ff05530df6c705c8bb4', 'GUEST', 'Guest');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `b_id` FOREIGN KEY (`b_id`) REFERENCES `branch` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sp_id` FOREIGN KEY (`sp_id`) REFERENCES `specification` (`sp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
