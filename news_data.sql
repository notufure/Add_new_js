-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 04:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `news_data`
--

CREATE TABLE `news_data` (
  `news_id` int(10) NOT NULL,
  `news_type` varchar(25) NOT NULL,
  `news_title` char(250) NOT NULL,
  `news_detail` text NOT NULL,
  `news_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_data`
--

INSERT INTO `news_data` (`news_id`, `news_type`, `news_title`, `news_detail`, `news_date`) VALUES
(70, 'Fisco', 'test', 'test', '2020-05-29 13:35:00'),
(71, 'Fisco', 'test2', 'test2', '2020-05-29 13:36:00'),
(73, 'Breaking news', 'test3', 'test3', '2020-05-29 13:49:00'),
(74, 'Breaking news', 'test4', 'test444', '2020-05-29 14:15:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news_data`
--
ALTER TABLE `news_data`
  ADD PRIMARY KEY (`news_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news_data`
--
ALTER TABLE `news_data`
  MODIFY `news_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
