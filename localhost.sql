-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2015 at 05:35 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jdull`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `language` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `year`, `language`) VALUES
(1, 'The lives of the conjurors', 'Frost, Thomas', 1876, 'English'),
(2, 'The Anglo-Saxon charms ...', 'Grendon, Felix', 1909, 'English'),
(3, 'Curses, lucks and talismans.', 'Lockhart, John Gilbert', 1938, 'English'),
(4, 'A treatyse of magic incantations', 'Pazig, Christianus', 1886, 'English'),
(5, 'Famous curses', 'O''Donnell, Elliott', 1929, 'English'),
(6, 'L''art de se rendre heureux', 'unknown', 1747, 'French');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE IF NOT EXISTS `levels` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `save_files`
--

CREATE TABLE IF NOT EXISTS `save_files` (
  `save_id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `save_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `level_id` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `save_files`
--

INSERT INTO `save_files` (`save_id`, `user_id`, `save_date`, `level_id`, `score`) VALUES
(1, 3, '2015-12-02 23:11:30', 1, 30000),
(2, 3, '2015-12-02 23:17:12', 2, 4000),
(3, 3, '2015-12-03 05:58:02', 1, 100300),
(4, 3, '2015-12-03 06:11:43', 1, 100300),
(5, 3, '2015-12-04 01:13:47', 1, 94640),
(6, 3, '2015-12-04 01:49:21', 1, 82118),
(7, 3, '2015-12-04 02:09:29', 1, 92793),
(8, 3, '2015-12-08 04:22:30', 2, 200),
(9, 3, '2015-12-08 04:27:23', 1, 100300),
(10, 3, '2015-12-08 04:27:57', 2, 200),
(11, 3, '2015-12-08 05:35:08', 2, 200),
(12, 3, '2015-12-08 05:36:27', 2, 200),
(13, 3, '2015-12-09 03:39:05', 1, 100300),
(14, 4, '2015-12-09 04:12:11', 1, 94540),
(15, 4, '2015-12-09 04:14:55', 1, 96454),
(16, 4, '2015-12-09 04:19:31', 2, 200),
(17, 3, '2015-12-13 05:27:13', 1, 92893),
(18, 3, '2015-12-13 05:28:04', 1, 92893),
(19, 3, '2015-12-13 05:28:31', 1, 92893),
(20, 3, '2015-12-13 05:29:31', 1, 92893),
(21, 3, '2015-12-13 05:40:44', 1, 83533),
(22, 3, '2015-12-13 05:46:37', 1, 100300);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `rank` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `first_name`, `last_name`, `date_created`, `rank`) VALUES
(3, 'eldergods', 'c62b7a01e8a1e2eb3fca9794b014e2fe', 'joshualdull@gmail.com', 'Joshua', 'Dull', '2015-12-02 22:48:34', 1),
(4, 'tester', 'fdbcb1540a321b8a6ca667f7408e7e68', 'testaccount@yahoo.com', 'Test', 'Account', '2015-12-09 03:06:52', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `save_files`
--
ALTER TABLE `save_files`
  ADD PRIMARY KEY (`save_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `save_files`
--
ALTER TABLE `save_files`
  MODIFY `save_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
