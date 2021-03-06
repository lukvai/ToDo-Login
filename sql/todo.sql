-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2019 at 09:09 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(20) NOT NULL,
  `taskSubject` varchar(100) COLLATE utf8_lithuanian_ci NOT NULL,
  `uid` int(20) NOT NULL,
  `finished` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `taskSubject`, `uid`, `finished`) VALUES
(1, 'Do Some Python', 2, 1),
(2, 'Do Some CSS', 3, 1),
(3, 'Do Some SASS', 3, 0),
(4, 'Do Some Work', 2, 0),
(5, 'Do Some JavaScript ES6', 3, 0),
(6, 'Do Web App', 3, 0),
(23, 'Do Some HTML', 2, 1),
(26, 'Do some PHP', 3, 1),
(27, 'Learn some OOP', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `uname` varchar(30) DEFAULT NULL,
  `upass` varchar(50) DEFAULT NULL,
  `role` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uname`, `upass`, `role`) VALUES
(1, 'admin', 'admin', 1),
(2, 'user1', 'user1', 0),
(3, 'user2', 'user2', 0),
(4, 'user3', 'user3', 0),
(5, 'user4', 'user4', 0),
(6, 'user5', 'user5', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
