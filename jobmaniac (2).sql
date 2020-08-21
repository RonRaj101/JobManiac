-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2020 at 06:39 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `jobapplications`
--

CREATE TABLE `jobapplications` (
  `A_ID` int(11) NOT NULL,
  `J_ID` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `cvfileurl` int(11) NOT NULL,
  `Accepted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobapplications`
--

INSERT INTO `jobapplications` (`A_ID`, `J_ID`, `U_ID`, `cvfileurl`, `Accepted`) VALUES
(1, 1, 1, 0, 0),
(2, 3, 1, 0, 0);

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
  `Seen` int(11) NOT NULL,
  `Active` int(11) NOT NULL DEFAULT 1,
  `Featured` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`J_ID`, `J_TITLE`, `J_DESC`, `J_SALARY`, `J_TYPE`, `J_FIELD`, `J_COMPANY`, `J_CREATOR`, `Seen`, `Active`, `Featured`) VALUES
(1, 'IT Professional', 'IT Professional Needed with 5 years of experience in Windows and Linux', 95000, 1, 1, 'ABC.Inc', 2, 1, 1, 0),
(2, 'Medical Transcriptionist', 'Experienced Transcriptionist Needed at Agha Khan with excellent communication skills and greater than 100wpm typing speed.', 55000, 1, 5, 'Agha Khan', 2, 1, 1, 0),
(3, 'Java Teacher', 'Java Teacher Needed with 5 years of experience in Java and related frameworks', 65000, 1, 1, 'Aptech', 3, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobtype`
--

CREATE TABLE `jobtype` (
  `T_ID` int(11) NOT NULL,
  `T_NAME` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobtype`
--

INSERT INTO `jobtype` (`T_ID`, `T_NAME`) VALUES
(1, 'Full-Time'),
(2, 'Part-Time'),
(3, 'Freelance'),
(4, 'Other'),
(5, 'Contract');

-- --------------------------------------------------------

--
-- Table structure for table `savedjobs`
--

CREATE TABLE `savedjobs` (
  `S_ID` int(11) NOT NULL,
  `J_ID` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `Seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `savedjobs`
--

INSERT INTO `savedjobs` (`S_ID`, `J_ID`, `U_ID`, `Seen`) VALUES
(2, 3, 1, 0);

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
  `profileimgurl` text NOT NULL,
  `cvfileurl` text NOT NULL,
  `Verified` int(11) NOT NULL DEFAULT 0,
  `social_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprofiles`
--

INSERT INTO `userprofiles` (`ID`, `Name`, `Email`, `Phone`, `Purpose`, `Password`, `profileimgurl`, `cvfileurl`, `Verified`, `social_link`) VALUES
(1, 'Ronit', 'r@r.com', '111244622', '1', '123', 'Image Uploads/5f3aec7910e4a3.84562156.png', 'File Uploads/5f3aec63bc13d1.67769294.pdf', 1, ''),
(2, 'Warren', 'w@b.com', '03114545227', '0', '123', 'Image Uploads/5f3aecca6fdbc9.29177031.png', 'File Uploads/5f3aecd83c2e89.90213062.pdf', 1, ''),
(3, 'Aptech', 'a@c.com', '123', '0', '123', 'Image Uploads/5f3b717b88c0f5.67023679.png', 'File Uploads/5f3b718fe83b96.16034775.pdf', 1, 'www.facebook.com/Aptech');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`F_ID`);

--
-- Indexes for table `jobapplications`
--
ALTER TABLE `jobapplications`
  ADD PRIMARY KEY (`A_ID`),
  ADD KEY `J_ID` (`J_ID`),
  ADD KEY `U_ID` (`U_ID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`J_ID`),
  ADD KEY `J_FIELD` (`J_FIELD`),
  ADD KEY `J_CREATOR` (`J_CREATOR`),
  ADD KEY `J_TYPE` (`J_TYPE`);

--
-- Indexes for table `jobtype`
--
ALTER TABLE `jobtype`
  ADD PRIMARY KEY (`T_ID`);

--
-- Indexes for table `savedjobs`
--
ALTER TABLE `savedjobs`
  ADD PRIMARY KEY (`S_ID`);

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
-- AUTO_INCREMENT for table `jobapplications`
--
ALTER TABLE `jobapplications`
  MODIFY `A_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `J_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobtype`
--
ALTER TABLE `jobtype`
  MODIFY `T_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `savedjobs`
--
ALTER TABLE `savedjobs`
  MODIFY `S_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userprofiles`
--
ALTER TABLE `userprofiles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobapplications`
--
ALTER TABLE `jobapplications`
  ADD CONSTRAINT `jobapplications_ibfk_1` FOREIGN KEY (`J_ID`) REFERENCES `jobs` (`J_ID`),
  ADD CONSTRAINT `jobapplications_ibfk_2` FOREIGN KEY (`U_ID`) REFERENCES `userprofiles` (`ID`);

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
