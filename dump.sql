-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 11, 2016 at 12:04 PM
-- Server version: 5.6.30-0ubuntu0.14.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `workers`
--

-- --------------------------------------------------------

--
-- Table structure for table `salary_report`
--

CREATE TABLE IF NOT EXISTS `salary_report` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `worker_id` int(10) NOT NULL,
  `date_salary` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `worker_idx` (`worker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `salary_report`
--

INSERT INTO `salary_report` (`id`, `worker_id`, `date_salary`) VALUES
(9, 1, '2016-07-01 09:00:00'),
(10, 2, '2016-07-02 00:00:00'),
(11, 3, '2016-07-01 00:00:00'),
(12, 4, '2016-07-02 00:00:00'),
(13, 1, '2016-06-02 00:00:00'),
(14, 2, '2016-06-03 00:00:00'),
(15, 3, '2016-06-01 00:00:00'),
(16, 4, '2016-06-02 00:00:00'),
(17, 1, '2016-05-01 00:00:00'),
(18, 2, '2016-05-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `time_report`
--

CREATE TABLE IF NOT EXISTS `time_report` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `worker_id` int(10) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `time_report`
--

INSERT INTO `time_report` (`id`, `worker_id`, `start_time`, `end_time`) VALUES
(1, 1, '2016-07-08 08:04:24', '2016-07-08 18:08:10'),
(2, 2, '2016-07-08 08:02:45', '2016-07-08 17:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE IF NOT EXISTS `workers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `salary` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `full_name`, `email`, `salary`) VALUES
(1, 'Klark Kent', 'Klark@gmail.com', 100),
(2, 'Nick Bold', 'Nick@gmail.com', 200),
(3, 'Barack Obama', 'Barack@gmail.com', 500),
(4, 'Will Smith', 'Smith@gmail.com', 550);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `salary_report`
--
ALTER TABLE `salary_report`
  ADD CONSTRAINT `worker_idx` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
