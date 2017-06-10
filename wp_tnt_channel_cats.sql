-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2017 at 11:44 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `setvnow`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_tnt_channel_cats`
--

CREATE TABLE `wp_tnt_channel_cats` (
  `chcat_id` int(11) NOT NULL,
  `chcat_name` varchar(255) NOT NULL,
  `chcat_parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_tnt_channel_cats`
--

INSERT INTO `wp_tnt_channel_cats` (`chcat_id`, `chcat_name`, `chcat_parent`) VALUES
(2, 'Channel Test 123 tthththt', 0),
(3, 'Channel Test Fuck Life', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_tnt_channel_cats`
--
ALTER TABLE `wp_tnt_channel_cats`
  ADD PRIMARY KEY (`chcat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_tnt_channel_cats`
--
ALTER TABLE `wp_tnt_channel_cats`
  MODIFY `chcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
