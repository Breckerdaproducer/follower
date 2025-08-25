-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2025 at 03:24 PM
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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `followers` int(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `s_1` varchar(225) NOT NULL,
  `s_2` varchar(225) NOT NULL,
  `s_3` varchar(225) NOT NULL,
  `date_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `user_id` varchar(20) NOT NULL,
  `platform` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `followers`, `location`, `img`, `price`, `status`, `s_1`, `s_2`, `s_3`, `date_time`, `user_id`, `platform`) VALUES
(1, 'TechSupport_Pro', 12500, 'USA', 'whatsapp.jpg', 2499, 'verified', '', '', '', '0000-00-00 00:00:00.000000', '1132055577', 'whatsapp'),
(2, 'DanceMoves_Pro', 320000, 'USA', 'tiktok2.jpg', 3899, 'unverified', '', '', '', '0000-00-00 00:00:00.000000', '1132055577', 'tiktok'),
(3, 'GameMaster Elite', 85000, 'USA', 'youtube.jpg', 8750, 'verified', 'Gaming', 'Reviews', '', '0000-00-00 00:00:00.000000', '1132055577', 'youtube'),
(4, 'Gourmet Bistro NYC', 28000, 'USA', 'facebook.jpg', 1850, 'verified', 'Food', 'Restaurant', '', '0000-00-00 00:00:00.000000', '1132055577', 'facebook'),
(5, 'StyleVogue_Official', 145000, 'USA', 'instagram.jpg', 5200, 'unverified', 'Fashion', 'Lifestyle', 'Beauty', '0000-00-00 00:00:00.000000', '1132055577', 'instagram'),
(6, 'FunnyVibes_Daily', 445000, 'USA', 'tiktok.jpg', 7200, 'verified', 'Comedy', 'Entertainment', '', '0000-00-00 00:00:00.000000', '1132055577', 'tiktok');

-- --------------------------------------------------------

--
-- Table structure for table `available_counties`
--

CREATE TABLE `available_counties` (
  `id` int(11) NOT NULL,
  `county_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `available_counties`
--

INSERT INTO `available_counties` (`id`, `county_name`) VALUES
(4, 'Australia'),
(5, 'Canada'),
(1, 'China'),
(6, 'India'),
(3, 'UK'),
(2, 'USA');

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
(1, 'USA', 'United States', 1),
(2, 'UK', 'United Kingdom', 1),
(3, 'Canada', 'Canada', 1),
(4, 'India', 'India', 1),
(5, 'USA', 'United States', 2),
(6, 'UK', 'United Kingdom', 2),
(7, 'USA', 'United States', 3),
(8, 'China', 'China', 3),
(9, 'UK', 'United Kingdom', 3),
(10, 'Australia', 'Australia', 3),
(11, 'Canada', 'Canada', 3),
(12, 'India', 'India', 3),
(13, 'USA', 'United States', 4),
(14, 'UK', 'United Kingdom', 4),
(15, 'Canada', 'Canada', 4),
(16, 'USA', 'United States', 5),
(17, 'UK', 'United Kingdom', 5),
(18, 'Canada', 'Canada', 5);

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
(5, 'Instagram\r\n');

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
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `available_counties`
--
ALTER TABLE `available_counties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `county_name` (`county_name`);

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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `available_counties`
--
ALTER TABLE `available_counties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
