-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 07:36 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestatedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminaccount`
--

CREATE TABLE `adminaccount` (
  `adminID` int(30) NOT NULL,
  `adminFirstname` varchar(255) NOT NULL,
  `adminLastname` varchar(255) NOT NULL,
  `adminUsername` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL,
  `adminPhone` varchar(255) NOT NULL,
  `accountType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminaccount`
--

INSERT INTO `adminaccount` (`adminID`, `adminFirstname`, `adminLastname`, `adminUsername`, `adminEmail`, `adminPassword`, `adminPhone`, `accountType`) VALUES
(2, 'Kryz-Ian', 'Calaustro', 'admin', 'calaustro.kryzian11@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '09453084255', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `houselistings`
--

CREATE TABLE `houselistings` (
  `houseID` int(30) NOT NULL,
  `houseImage` varchar(255) NOT NULL,
  `houseName` varchar(255) NOT NULL,
  `housePrice` varchar(255) NOT NULL,
  `houseDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `houselistings`
--

INSERT INTO `houselistings` (`houseID`, `houseImage`, `houseName`, `housePrice`, `houseDescription`) VALUES
(1, 'large room package.jpg', 'Modern House', '450000', 'Address: 3002 Foster Ave, Brooklyn, NY 11210, USA\r\nArea: $2,800/sq ft\r\nDetails: 4 Bedrooms, 4 Bathrooms and 2 Dining Rooms\r\nFeatures: Air Conditioning'),
(2, 'small room package.jpg', 'Malto House', '290000', 'Include of multiple small room'),
(3, 'medium room package.jpg', 'Medium House', '360000', 'Include multiple medium room');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminaccount`
--
ALTER TABLE `adminaccount`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `houselistings`
--
ALTER TABLE `houselistings`
  ADD PRIMARY KEY (`houseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminaccount`
--
ALTER TABLE `adminaccount`
  MODIFY `adminID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `houselistings`
--
ALTER TABLE `houselistings`
  MODIFY `houseID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
