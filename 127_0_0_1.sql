-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2021 at 05:24 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penny_collector`
--
CREATE DATABASE IF NOT EXISTS `penny_collector` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `penny_collector`;

-- --------------------------------------------------------

--
-- Table structure for table `penny`
--

CREATE TABLE `penny` (
  `pennyID` int(30) NOT NULL,
  `userName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pennyMint` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pennyCondition` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pennyAmount` varchar(30) CHARACTER SET utf8 NOT NULL,
  `pennyYear` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penny`
--

INSERT INTO `penny` (`pennyID`, `userName`, `pennyMint`, `pennyCondition`, `pennyAmount`, `pennyYear`) VALUES
(9, 'Sam', 'San Francisco', 'Good', '5', 1934),
(10, 'Sam', 'Denver', 'Great', '8', 1945),
(11, 'Sam', 'Philadelphia', 'Bad', '6', 2009),
(12, 'Sam', 'Denver', 'Great', '10', 1944),
(13, 'Sam', 'San Francisco', 'Good', '7', 1980),
(14, 'Gram', 'San Francisco', 'Good', '7', 1980),
(15, 'Gram', 'Denver', 'Great', '5', 1944),
(16, 'Gram', 'Philadelphia', 'Good', '4', 1945),
(17, 'Gram', 'Denver', 'Bad', '9', 1930),
(18, 'Gram', 'Denver', 'Great', '10', 1937),
(19, 'Darren', 'Philadelphia', 'Great', '7', 1991),
(20, 'Darren', 'Denver', 'Bad', '8', 1999),
(21, 'Darren', 'Denver', 'Great', '7', 1944),
(22, 'Darren', 'Philadelphia', 'Good', '8', 1937),
(25, 'Darren', 'Denver', 'Great', '5', 1980),
(26, 'Billy', 'San Francisco', 'Great', '5', 1945),
(27, 'Billy', 'Denver', 'Good', '8', 1976),
(28, 'Billy', 'Philadelphia', 'Bad', '7', 1930),
(29, 'Billy', 'Denver', 'Great', '7', 1991),
(30, 'Billy', 'San Francisco', 'Bad', '9', 1966);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userName`, `password`) VALUES
('Billy', '$2y$10$U5cxfoPviLO2X7DtfhOyLOqQd0TIv12rXNJo5TS.YOnreUYpXbMw2'),
('Darren', '$2y$10$ouUAISIlHmRJMRSXW13tEOdTfmZXGrbOHkuEGMhDrRLFHXbq2ACRu'),
('Gram', '$2y$10$xYuvzV/R4Tm1KPqkQjvy2eGNRLS6gr1BXTPRLOfgL2.rZpqNk7Z3S'),
('Sam', '$2y$10$U5nH7EmJWVYbRTO91udO1eOtvi0XC1cXUdwmvkD0vCIJqX0NPFmoe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penny`
--
ALTER TABLE `penny`
  ADD PRIMARY KEY (`pennyID`),
  ADD KEY `fk_penny_user` (`userName`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penny`
--
ALTER TABLE `penny`
  MODIFY `pennyID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penny`
--
ALTER TABLE `penny`
  ADD CONSTRAINT `fk_penny_user` FOREIGN KEY (`userName`) REFERENCES `user` (`userName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
