-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2017 at 04:24 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects`
--
CREATE DATABASE IF NOT EXISTS `projects` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projects`;

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `dateDownloaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `projname` varchar(200) NOT NULL,
  `coursecode` varchar(8) NOT NULL,
  `coursename` varchar(200) NOT NULL,
  `githublink` text NOT NULL,
  `year` int(4) NOT NULL,
  `file` text NOT NULL,
  `members` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `projname`, `coursecode`, `coursename`, `githublink`, `year`, `file`, `members`) VALUES
(1, 'Web Applications', 'INFO3410', 'Web Technologies', 'www.github.com', 2016, '/useruploads/hive.zip', 'John Barron\r\nAaron Samuel\r\nDarren Bravo\r\nMichael Brown\r\nAnn Lyons\r\n'),
(2, 'Websites', 'INFO1500', 'Programming for the Web', 'www.github.com', 2014, '/useruploads/hive.zip', 'Ava Swan\r\nAbi Hobson\r\nYousuf Ali\r\nSharon Barnes\r\n'),
(3, 'Hosting', 'INFO3410', 'Web Technologies', 'www.github.com', 2015, '/useruploads/hive.zip', 'Sarah Cruise\r\nDana Lopez\r\nHannah Howel\r\nTrudy Briggs\r\n'),
(4, 'aa', 'ss', '232', '1231231', 2017, '/useruploads/hive.zip', 'Member1 Member2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `schoolIdnum` int(15) NOT NULL,
  `accounttype` varchar(200) NOT NULL,
  `approval` varchar(5) NOT NULL DEFAULT 'No',
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `Email`, `schoolIdnum`, `accounttype`, `approval`, `datecreated`) VALUES
(1, 'stacy', '4ff18f00176f0f2b3ae5477d5c64490c7a748808', '', '0', '', 0, 'Student', 'No', '2017-03-31 00:31:53'),
(2, 'aaron', 'e1952705cc0e6ec262d611301793720f7bfe5669', '', '0', '', 0, 'Student', 'No', '2017-04-06 16:50:20'),
(3, 'rebecca', '2cec08d12876881ed7328cc7fdde856d6e91d0be', '', '0', '', 0, 'Student', 'No', '2017-04-06 16:50:20'),
(4, 'listra', 'b1ec0f56f225344da9c5d8130e1bd1cfc83f7013', '', '0', '', 0, 'Student', 'No', '2017-04-06 16:50:46'),
(5, 'stu12', 'pw', 'Aaron', 'Granger', 'Ag@gmail.com', 123456, 'student', 'No', '2017-04-17 20:24:02'),
(6, '', '', '', '', '', 0, '1', 'No', '2017-04-18 00:03:21'),
(7, '', '', '', '', '', 0, '1', 'No', '2017-04-18 01:46:47'),
(8, '', '', '', '', '', 0, '1', 'No', '2017-04-18 01:48:24'),
(9, '', '', '', '', '', 0, '1', 'No', '2017-04-18 01:56:22'),
(10, '', '', '', '', '', 0, '2', 'No', '2017-04-18 01:58:51'),
(11, '', '', '', '', '', 0, 'Admin', 'No', '2017-04-18 01:59:34'),
(12, '', '', '', '', '', 0, 'Admin', 'No', '2017-04-18 02:04:22'),
(13, '', '', '', '', '', 0, 'Admin', 'No', '2017-04-18 02:08:32'),
(14, 'gr', 'pw', 'aa', 'gg', 'adg@gmail', 1212, 'Student', 'No', '2017-04-18 02:10:05'),
(15, 'a', 's', 'aa', 'ss', 'adg@gmail', 1212, 'Admin', 'No', '2017-04-19 03:00:16'),
(16, 'a', 'ss', 'asa', 'asdsd', 'adg@gmail', 12121, 'Admin', 'No', '2017-04-19 03:10:56'),
(17, 'a', 'pw', 'asa', 'asdsd', 'adg@gmail', 12121, 'Admin', 'No', '2017-04-19 03:33:19'),
(18, 'a', 'pw', 'asa', 'asdsd', 'adg@gmail', 12121, 'Admin', 'No', '2017-04-19 03:33:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
