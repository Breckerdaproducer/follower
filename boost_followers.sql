-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2025 at 02:24 PM
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
-- Database: `boost followers`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `short` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `platform_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `short`, `name`, `platform_id`) VALUES
(1, 'US', 'United States', 1),
(2, 'UK', 'United Kingdom', 1),
(3, 'CA', 'Canada', 1),
(4, 'IN', 'India', 1),
(5, 'US', 'United States', 2),
(6, 'UK', 'United Kingdom', 2),
(7, 'US', 'United States', 3),
(8, 'CN', 'China', 3),
(9, 'UK', 'United Kingdom', 3),
(10, 'AU', 'Australia', 3),
(11, 'CA', 'Canada', 3),
(12, 'IN', 'India', 3),
(13, 'US', 'United States', 4),
(14, 'UK', 'United Kingdom', 4),
(15, 'CA', 'Canada', 4),
(16, 'US', 'United States', 5),
(17, 'UK', 'United Kingdom', 5),
(18, 'CA', 'Canada', 5),
(19, 'US', 'United States', 6),
(20, 'UK', 'United Kingdom', 6);

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `name`) VALUES
(1, 'WhatsApp\r\n'),
(2, 'Facebook\r\n'),
(3, 'TikTok\r\n'),
(4, 'YouTube\r\n'),
(5, 'Instagram\r\n'),
(6, 'X (Twitter)\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` text NOT NULL,
  `balance` int(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `email`, `user_name`, `password`, `ip`, `balance`, `status`, `date_time`) VALUES
(4, 1132055577, 'tiktok683078922@gmail.com', 'brecker', '$2y$10$YHbVfpt5r7u2u5Y1SI4kY.y31K48Tcig0h878b.ECOu7JxkxnVt76', '::1', 100000, 'active', '2025-08-23 10:07:37.000000'),
(5, 1534466234, 'whumobrianrinywe@gmail.com', 'brecker237', '$2y$10$3a1eCXA0C8uk6McAhImYYeNTvAy20P.FouQ6mxg0Ms8onNCyiArIm', '::1', 0, 'active', '2025-08-24 12:23:12.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
