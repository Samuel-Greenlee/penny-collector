-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2021 at 12:38 AM
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
(7, 'Sam', 'Seattle', 'Good', '55', 1945),
(8, 'Sam', 'Denver', 'Great', '80', 1980);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userName`, `password`) VALUES
('Bob', 'Bobbbbbb1'),
('Bobby', 'BobBob88*'),
('Fred', 'Bill888!'),
('Jill', 'Jelly&88!'),
('Sally', 'Sally888!!!'),
('Sam', 'Sammy888!!!'),
('Sim', 'Sim88888*'),
('Ted', 'Teddy999!!!'),
('Test', 'T8t88888');

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
  MODIFY `pennyID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
