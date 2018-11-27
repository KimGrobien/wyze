-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2018 at 09:56 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wyze`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountsettings`
--

CREATE TABLE `accountsettings` (
  `userID` int(11) NOT NULL,
  `planID` int(11) NOT NULL DEFAULT '0',
  `accountName` varchar(30) NOT NULL DEFAULT 'New Account'
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

CREATE TABLE `categories` (
  `userID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `plan` (
  `userID` int(11) NOT NULL,
  `planID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL DEFAULT '1',
  `budget` int(11) NOT NULL,
  `plan_limit` int(11) DEFAULT NULL,
  `default_plan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `sources` (
  `userID` int(11) NOT NULL,
  `sourceID` int(11) NOT NULL,
  `source` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `transactions` (
  `userID` int(11) NOT NULL,
  `transactionID` int(11) NOT NULL,
  `date` varchar(10) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `source` varchar(30) DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `numPhone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lName`, `email`, `numPhone`) VALUES
(1, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', '', '', '', NULL),
(2, 'tester', 'great', 'John', 'Doe', 'email@email.com', '2602602602');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountsettings`
--
ALTER TABLE `accountsettings`
  ADD UNIQUE KEY `accountName` (`accountName`),
  ADD UNIQUE KEY `planID` (`planID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`planID`);

--
-- Indexes for table `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`sourceID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `planID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sources`
--
ALTER TABLE `sources`
  MODIFY `sourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
