-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2020 at 04:14 PM
-- Server version: 5.6.40-84.0-log
-- PHP Version: 5.6.30
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Database: `craigbtn_wp300`
--
-- --------------------------------------------------------
--
-- Table structure for table `01_tblTest`
--
CREATE TABLE `01_tblTest` (
  `ID` int(11) NOT NULL,
  `UnitName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Dumping data for table `01_tblTest`
--
INSERT INTO `01_tblTest` (`ID`, `UnitName`) VALUES
(1, 'London'),
(2, 'Leeds'),
(3, 'Paris'),
(4, 'Athens'),
(5, 'Manchester');
--
-- Indexes for dumped tables
--
--
-- Indexes for table `01_tblTest`
--
ALTER TABLE `01_tblTest`
  ADD PRIMARY KEY (`ID`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `01_tblTest`
--
ALTER TABLE `01_tblTest`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
