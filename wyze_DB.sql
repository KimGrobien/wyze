-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 10:43 PM
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
-- Table structure for table `accountsettings`
--

CREATE TABLE IF NOT EXISTS `accountsettings` (
  `userID` int(11) NOT NULL,
  `planID` int(11) NOT NULL DEFAULT '0',
  `accountName` varchar(30) NOT NULL DEFAULT 'New Account',
  UNIQUE KEY `accountName` (`accountName`),
  UNIQUE KEY `planID` (`planID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accountsettings`
--

INSERT INTO `accountsettings` (`userID`, `planID`, `accountName`) VALUES
(2, 3, 'Second Test Account'),
(2, 2, 'Test Account');

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
  `categoryID` int(11) NOT NULL DEFAULT '1',
  `budget` int(11) NOT NULL,
  `plan_limit` int(11) DEFAULT NULL,
  `default_plan` int(11) DEFAULT NULL,
  PRIMARY KEY (`planID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`userID`, `planID`, `categoryID`, `budget`, `plan_limit`, `default_plan`) VALUES
(2, 2, 1, 20, 500, NULL),
(2, 3, 3, 500, 1500, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
  `userID` int(11) NOT NULL,
  `sourceID` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(30) NOT NULL,
  PRIMARY KEY (`sourceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`userID`, `sourceID`, `source`) VALUES
(1, 1, 'credit'),
(1, 2, 'debit'),
(1, 3, 'cash');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`userID`, `transactionID`, `date`, `description`, `category`, `source`, `amount`) VALUES
(1, 9, '09/22/18', 'Chick-fil-A', 'Food and Dining', 'cash', 7.5),
(1, 10, '09/12/18', 'Marathon', NULL, 'credit', 27.15),
(1, 12, '10/03/18', 'Kroger', NULL, 'cash', 12.99),
(0, 79, '9/30/18', 'ACH Transaction - AMERICAN FUNDS INVESTMENT 0009100001', NULL, 'cash', 50),
(0, 80, '9/30/18', 'Transfer to Checking', NULL, 'cash', 100),
(0, 81, '9/30/18', 'POS Debit - Visa Check Card 5214 - WAYNE PARTNERSHIP FORT WAYNE', NULL, 'cash', 5.5),
(0, 82, '9/27/18', 'POS Debit - Visa Check Card 5214 - WAYNE PARTNERSHIP FORT WAYNE', NULL, 'cash', 5),
(0, 83, '9/25/18', 'POS Debit - Visa Check Card 5214 - MARATHON PETRO1170 FORT WAYNE', NULL, 'cash', 31.33),
(0, 84, '9/25/18', 'POS Debit - Visa Check Card 5214 - WAYNE PARTNERSHIP FORT WAYNE', NULL, 'cash', 4.5),
(0, 85, '9/23/18', 'POS Debit - Visa Check Card 5214 - CULVERS OF FT WAY FORT WAYNE', NULL, 'cash', 14.02),
(0, 86, '9/23/18', 'POS Debit - Visa Check Card 5214 - TRACFONE AIRTI TRACFONECOM', NULL, 'cash', 10),
(0, 87, '9/23/18', 'POS Debit - Visa Check Card 5214 - WAYNE PARTNERSHIP FORT WAYNE', NULL, 'cash', 5),
(0, 88, '9/20/18', 'POS Debit - Visa Check Card 5214 - WAYNE PARTNERSHIP FORT WAYNE', NULL, 'cash', 5),
(0, 89, '9/18/18', 'POS Debit - Visa Check Card 5214 - WAYNE PARTNERSHIP FORT WAYNE', NULL, 'cash', 5),
(0, 90, '9/17/18', 'ACH Transaction - AMERICAN FUNDS INVESTMENT 0009100001', NULL, 'cash', 50),
(0, 91, '9/16/18', 'POS Debit - Visa Check Card 5214 - KROGER FU 5765 FALLS D FORT W', NULL, 'cash', 29.11),
(0, 92, '9/16/18', 'POS Debit - Visa Check Card 5214 - WAYNE PARTNERSHIP FORT WAYNE', NULL, 'cash', 6),
(0, 93, '9/13/18', 'POS Debit - Visa Check Card 5214 - KROGER FU 5765 FALLS D FORT W', NULL, 'cash', 16.02),
(0, 94, '9/13/18', 'POS Debit - Visa Check Card 5214 - WAYNE PARTNERSHIP FORT WAYNE', NULL, 'cash', 5),
(0, 95, '', '', NULL, 'cash', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lName`, `email`, `numPhone`) VALUES
(1, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', '', '', '', NULL),
(2, 'tester', '*2FCE88C7C2BED8984457A2832AE9777C009E15CE', 'John', 'Doe', 'email@email.com', '2602602602');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountsettings`
--
ALTER TABLE `accountsettings`
  ADD CONSTRAINT `AccountSettings_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
