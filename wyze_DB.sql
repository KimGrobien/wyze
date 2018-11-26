-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2018 at 01:11 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wyze`
--

-- --------------------------------------------------------

--
-- Table structure for table `AccountSettings`
--

CREATE TABLE IF NOT EXISTS `AccountSettings` (
  `userID` int(11) NOT NULL,
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `userID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`categoryID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`userID`, `categoryID`, `categoryName`) VALUES
(1, 1, 'Food and Dining'),
(1, 2, 'Gas and Fuel'),
(1, 3, 'Shopping'),
(1, 4, 'Electric');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `userID` int(11) NOT NULL,
  `planID` int(11) NOT NULL AUTO_INCREMENT,
  `budget` int(11) NOT NULL,
  `plan_limit` int(11) DEFAULT NULL,
  `default_plan` int(11) DEFAULT NULL,
  PRIMARY KEY (`planID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `userID` int(11) NOT NULL,
  `transactionID` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(10) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `source` varchar(30) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`userID`, `transactionID`, `date`, `description`, `category`, `source`, `amount`) VALUES
(1, 9, '09/22/18', 'Chick-fil-A', 'Food and Dining', 'cash', 7.5),
(1, 10, '09/12/18', 'Marathon', NULL, 'credit', 27.15),
(1, 12, '10/03/18', 'Kroger', NULL, 'cash', 12.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `numPhone` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lName`, `email`, `numPhone`) VALUES
(1, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', '', '', '', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `AccountSettings`
--
ALTER TABLE `AccountSettings`
  ADD CONSTRAINT `AccountSettings_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
