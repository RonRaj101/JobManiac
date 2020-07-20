-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2020 at 09:15 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobmaniac`
--

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `F_ID` int(11) NOT NULL,
  `F_NAME` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`F_ID`, `F_NAME`) VALUES
(1, 'Information Technology'),
(2, 'Business'),
(3, 'Marketing Services'),
(4, 'Accountant'),
(5, 'Labour'),
(6, 'Designer');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `J_ID` int(11) NOT NULL,
  `J_TITLE` text NOT NULL,
  `J_DESC` text NOT NULL,
  `J_SALARY` int(11) NOT NULL,
  `J_TYPE` int(11) NOT NULL,
  `J_FIELD` int(11) NOT NULL,
  `J_COMPANY` text NOT NULL,
  `J_CREATOR` int(11) NOT NULL,
  `Seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`J_ID`, `J_TITLE`, `J_DESC`, `J_SALARY`, `J_TYPE`, `J_FIELD`, `J_COMPANY`, `J_CREATOR`, `Seen`) VALUES
(22, 'Freelance Developers', 'Work for our world class team and gain experience', 50000, 4, 1, 'TekBook Inc', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userprofiles`
--

CREATE TABLE `userprofiles` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Phone` text NOT NULL,
  `Purpose` text NOT NULL,
  `Password` text NOT NULL,
  `redirectURL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprofiles`
--

INSERT INTO `userprofiles` (`ID`, `Name`, `Email`, `Phone`, `Purpose`, `Password`, `redirectURL`) VALUES
(7, 'Ronit', 'r@r.com', '03164038778', '1', '123', 'JobManiacHomeFIND.php'),
(8, 'Warren Buffet', 'W@B.COM', '111244622', '0', '123', 'JobManiacHomeHIRE.php'),
(9, 'Bill Gates', 'B@G.COM', '2022', '0', '123', 'JobManiacHomeHIRE.php');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`F_ID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`J_ID`),
  ADD KEY `J_FIELD` (`J_FIELD`),
  ADD KEY `J_CREATOR` (`J_CREATOR`),
  ADD KEY `J_TYPE` (`J_TYPE`);

--
-- Indexes for table `userprofiles`
--
ALTER TABLE `userprofiles`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `F_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `J_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `userprofiles`
--
ALTER TABLE `userprofiles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`J_FIELD`) REFERENCES `fields` (`F_ID`),
  ADD CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`J_CREATOR`) REFERENCES `userprofiles` (`ID`),
  ADD CONSTRAINT `jobs_ibfk_3` FOREIGN KEY (`J_TYPE`) REFERENCES `jobtype` (`T_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
