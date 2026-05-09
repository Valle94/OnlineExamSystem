-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2026 at 04:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `StudentID` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`StudentID`, `FirstName`, `LastName`, `Email`, `Password`) VALUES
(1, 'Max', 'Valle', 'valle@email.com', '$2y$10$pcoIsuvDVrW9mDfcFgsro.y0/iIOOn8AMfLA.BrO1ebJoQynDGVEm'),
(3, 'Max', 'Valle', 'valle040@morrisville.edu', '$2y$10$W0z6GMjofJZ5Q9tk76xaRuA3bLdP4NAE0wFq752qTiIOpca6e2gLi'),
(4, 'Max', 'Valle', 'Valle1@email.com', '$2y$10$zfXHUW1f8CB9yXCmRrzZOuksZnwLcKhkK.1ti7CVgT/nvPXFz6diO'),
(5, 'Max', 'Valle', 'maxthvalle@yahoo.com', '$2y$10$uZh74w1AtpS/mt5Bz7HfKeq3ZLB6uJhpVc6hECE.2jxyz/RI.dsZ.');

-- --------------------------------------------------------

--
-- Table structure for table `examresults`
--

CREATE TABLE `examresults` (
  `StudentID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Score` float NOT NULL,
  `CorrectAnswers` int(11) NOT NULL,
  `WrongAnswers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examresults`
--

INSERT INTO `examresults` (`StudentID`, `Date`, `Time`, `Score`, `CorrectAnswers`, `WrongAnswers`) VALUES
(1, '2026-03-21', '17:54:33', 40, 2, 3),
(1, '2026-03-22', '07:29:14', 100, 5, 0),
(1, '2026-03-23', '22:13:26', 60, 3, 2),
(1, '2026-03-24', '12:41:59', 80, 4, 1),
(1, '2026-03-25', '19:08:37', 0, 0, 5),
(1, '2026-03-26', '08:55:41', 20, 1, 4),
(1, '2026-03-27', '16:32:18', 40, 2, 3),
(1, '2026-03-28', '11:47:03', 60, 3, 2),
(1, '2026-03-29', '14:15:22', 80, 4, 1),
(1, '2026-03-30', '09:23:45', 100, 5, 0),
(1, '2026-03-31', '18:12:32', 100, 5, 0),
(1, '2026-04-02', '18:42:12', 0, 0, 5),
(3, '2026-03-31', '18:04:07', 80, 4, 1),
(4, '2026-03-31', '18:14:33', 80, 4, 1),
(5, '2026-05-09', '15:49:53', 80, 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `examresults`
--
ALTER TABLE `examresults`
  ADD PRIMARY KEY (`StudentID`,`Date`),
  ADD KEY `StudentID` (`StudentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `examresults`
--
ALTER TABLE `examresults`
  ADD CONSTRAINT `examresults_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `account` (`StudentID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
