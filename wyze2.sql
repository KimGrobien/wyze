-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2018 at 03:18 AM
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
  `planID` int(11) NOT NULL DEFAULT '0',
  `accountName` varchar(30) NOT NULL DEFAULT 'New Account',
  `userID` int(11) NOT NULL,
  UNIQUE KEY `accountName` (`accountName`),
  UNIQUE KEY `planID` (`planID`),
  UNIQUE KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE IF NOT EXISTS `budget` (
  `budgetID` int(11) NOT NULL AUTO_INCREMENT,
  `budgetLimit` int(11) NOT NULL,
  `planID` int(11) NOT NULL,
  PRIMARY KEY (`budgetID`),
  KEY `planID` (`planID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(30) DEFAULT NULL,
  `budgetID` int(11) DEFAULT NULL,
  PRIMARY KEY (`categoryID`),
  KEY `budgetID` (`budgetID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `budgetID`) VALUES
(1, 'Food and Dining', NULL),
(2, 'Gas and Fuel', NULL),
(3, 'Shopping', NULL),
(4, 'Electric', NULL),
(5, 'Bills', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `planID` int(11) NOT NULL AUTO_INCREMENT,
  `planName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`planID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`planID`, `planName`) VALUES
(2, NULL),
(3, NULL);

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
  `source` varchar(30) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL,
  PRIMARY KEY (`transactionID`),
  KEY `categoryID` (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`userID`, `transactionID`, `date`, `description`, `source`, `amount`, `categoryID`) VALUES
(1, 9, '09/22/18', 'Chick-fil-A', 'cash', 7.5, 2),
(1, 10, '09/12/18', 'Marathon', 'credit', 27.15, 4),
(1, 12, '10/03/18', 'Kroger', 'cash', 12.99, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `numPhone` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `numPhone`) VALUES
(1, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', '', '', '', NULL),
(2, 'tester', 'great', 'John', 'Doe', 'email@email.com', '2602602602'),
(3, 'as', '*82F7A212F409F2D39676231F9599E077C10214C9', 'as', 'as', 'as@as.edu', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountsettings`
--
ALTER TABLE `accountsettings`
  ADD CONSTRAINT `accountsettings_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `accountsettings_ibfk_1` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`);

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`planID`) REFERENCES `plan` (`planID`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`budgetID`) REFERENCES `budget` (`budgetID`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
