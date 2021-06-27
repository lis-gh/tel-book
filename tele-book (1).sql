-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 02:34 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tele-book`
--

-- --------------------------------------------------------

--
-- Table structure for table `nums`
--

CREATE TABLE `nums` (
  `numid` int(11) NOT NULL,
  `fnname` varchar(255) DEFAULT NULL,
  `lnname` varchar(255) NOT NULL,
  `telnum` varchar(10) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nums`
--

INSERT INTO `nums` (`numid`, `fnname`, `lnname`, `telnum`, `userid`) VALUES
(35, 'mhddd', 'gh', '0912345678', 7),
(36, 'mhd', 'jjjjjj', '0912245678', 7),
(37, 'mhd', 'fddd', '0912243678', 7),
(38, 'fd1125', 'gh', '0912345677', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `telnum` varchar(10) DEFAULT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fname`, `lname`, `city`, `telnum`, `pass`) VALUES
(1, 'root', '', '', '912345678', '123'),
(2, 'root', '', '', '912345678', '123'),
(3, 'lis', '', '', '912345678', '123'),
(5, 'lolo', '', '', '0912345678', '1234'),
(6, 'lolo', '', '', '0912345678', '1234'),
(7, 'lala', 'gh', 'damas', '0912345678', '123'),
(8, 'gogo', 'gh', 'damas', '0933312345', '1234'),
(9, 'lana', 'gh', 'damas', '0911223344', '12345'),
(10, 'lama', 'gh', 'damas', '0911122333', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nums`
--
ALTER TABLE `nums`
  ADD PRIMARY KEY (`numid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nums`
--
ALTER TABLE `nums`
  MODIFY `numid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nums`
--
ALTER TABLE `nums`
  ADD CONSTRAINT `nums_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
