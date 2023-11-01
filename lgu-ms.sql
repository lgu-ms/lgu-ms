-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2023 at 03:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lgu-ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_password` text NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `dateofbirth` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phonenumber` int(15) DEFAULT NULL,
  `user_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`_id`, `user_fullname`, `user_password`, `user_type`, `created_at`, `updated_at`, `user_name`, `dateofbirth`, `address`, `phonenumber`, `user_email`) VALUES
(2023000016, 'test', 'a279b9c7d0bee32b4807c59bc3490119cb5fd217fca9a1894604e7b912d3ef1705e7cedcf451e3803402cd1f7248064e8466d9415b0a94bc52288f91f36c52c9', 'User', '2023-10-30 20:45:01', '2023-10-30 20:45:01', 'mrepol742', NULL, NULL, NULL, 'mrepol742@gmail.com'),
(2023000017, 'admin', 'e54ee7e285fbb0275279143abc4c554e5314e7b417ecac83a5984a964facbaad68866a2841c3e83ddf125a2985566261c4014f9f960ec60253aebcda9513a9b4', 'User', '2023-10-31 02:20:08', '2023-10-31 02:20:08', 'admin', NULL, NULL, NULL, 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `account_session`
--

CREATE TABLE `account_session` (
  `_sid` int(10) UNSIGNED ZEROFILL NOT NULL,
  `user_agent` text DEFAULT NULL,
  `session_started` text NOT NULL,
  `session_ended` text DEFAULT NULL,
  `session_status` varchar(10) NOT NULL COMMENT 'active = means the account is currently loggedin, end = means the user logout the account',
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_accessed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `account_session`
--

INSERT INTO `account_session` (`_sid`, `user_agent`, `session_started`, `session_ended`, `session_status`, `user_id`, `last_accessed`) VALUES
(1000000036, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-10-30 20:53:05', '2023-10-30 20:54:40', 'end', 2023000016, ''),
(1000000037, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-10-30 20:58:19', '2023-10-30 21:02:28', 'end', 2023000016, ''),
(1000000038, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-10-30 21:26:50', '2023-10-30 21:27:27', 'end', 2023000016, ''),
(1000000039, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-10-30 21:28:01', '2023-10-30 21:29:14', 'end', 2023000016, ''),
(1000000040, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-10-30 21:29:35', '2023-10-31 02:06:09', 'end', 2023000016, ''),
(1000000041, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-10-31 02:06:37', '2023-10-31 02:08:17', 'end', 2023000016, '2023-10-31 02:06:37'),
(1000000042, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-10-31 02:08:25', '2023-10-31 02:08:48', 'end', 2023000016, '2023-10-31 02:08:25'),
(1000000043, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-10-31 02:08:54', '2023-10-31 02:09:52', 'end', 2023000016, '2023-10-31 02:08:54'),
(1000000044, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-10-31 02:10:02', '2023-10-31 02:19:50', 'end', 2023000016, '2023-10-31 02:10:02'),
(1000000045, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-10-31 02:20:13', '2023-11-01 03:22:28', 'end', 2023000017, '2023-11-01 03:18:58'),
(1000000046, '13421c7434b48507a2be73e73078d1c6604e54d3a88a89c4f5037e79edb10406daef78d23dd54a8636d8ffe5d96ee1b182829c16bc1084e90a9d2f3fbd48e6a1', '2023-11-01 03:38:01', NULL, 'active', 2023000016, '2023-11-01 03:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `error`
--

CREATE TABLE `error` (
  `_eid` int(10) UNSIGNED ZEROFILL NOT NULL,
  `error_code` int(11) NOT NULL,
  `error_name` varchar(50) NOT NULL,
  `error_date` text NOT NULL,
  `session_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `error`
--

INSERT INTO `error` (`_eid`, `error_code`, `error_name`, `error_date`, `session_id`, `user_id`) VALUES
(0000000001, 404, 'File Not Found', '2023-11-01 03:18:58', 1000000045, 2023000017),
(0000000002, 404, 'File Not Found', '2023-11-01 03:23:46', NULL, NULL),
(0000000003, 404, 'File Not Found', '2023-11-01 03:34:31', NULL, NULL),
(0000000004, 404, 'File Not Found', '2023-11-01 03:34:34', NULL, NULL),
(0000000005, 404, 'File Not Found', '2023-11-01 03:34:57', NULL, NULL),
(0000000006, 404, 'File Not Found', '2023-11-01 03:35:23', NULL, NULL),
(0000000007, 404, 'File Not Found', '2023-11-01 03:35:27', NULL, NULL),
(0000000008, 404, 'File Not Found', '2023-11-01 03:35:29', NULL, NULL),
(0000000009, 404, 'File Not Found', '2023-11-01 03:41:08', 1000000046, 2023000016),
(0000000010, 404, 'File Not Found', '2023-11-01 03:44:38', 1000000046, 2023000016),
(0000000011, 404, 'File Not Found', '2023-11-01 03:45:30', 1000000046, 2023000016);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `_oid` int(10) UNSIGNED ZEROFILL NOT NULL,
  `code` varchar(20) NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_time` int(11) NOT NULL COMMENT 'The time this opt was generated expired every 15 minutes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passwordchanged`
--

CREATE TABLE `passwordchanged` (
  `_pid` int(10) UNSIGNED ZEROFILL NOT NULL,
  `date_accessed` text NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `event_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `passwordchanged`
--

INSERT INTO `passwordchanged` (`_pid`, `date_accessed`, `session_id`, `user_id`, `event_type`) VALUES
(0000000001, '2023-10-31 02:20:22', 1000000045, 2023000017, 'change-password');

-- --------------------------------------------------------

--
-- Table structure for table `profilepic`
--

CREATE TABLE `profilepic` (
  `_pid` int(10) UNSIGNED ZEROFILL NOT NULL,
  `profilepic` text NOT NULL COMMENT 'base64 format of user profile picture',
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `account_session`
--
ALTER TABLE `account_session`
  ADD PRIMARY KEY (`_sid`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `error`
--
ALTER TABLE `error`
  ADD PRIMARY KEY (`_eid`),
  ADD KEY `error_session_id` (`session_id`),
  ADD KEY `error_user_id` (`user_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`_oid`),
  ADD KEY `session_otp_id` (`session_id`),
  ADD KEY `account_otp_id` (`user_id`);

--
-- Indexes for table `passwordchanged`
--
ALTER TABLE `passwordchanged`
  ADD PRIMARY KEY (`_pid`),
  ADD KEY `password_account_id` (`user_id`),
  ADD KEY `password_session_id` (`session_id`);

--
-- Indexes for table `profilepic`
--
ALTER TABLE `profilepic`
  ADD PRIMARY KEY (`_pid`),
  ADD KEY `account_profile_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `_id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2023000018;

--
-- AUTO_INCREMENT for table `account_session`
--
ALTER TABLE `account_session`
  MODIFY `_sid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000047;

--
-- AUTO_INCREMENT for table `error`
--
ALTER TABLE `error`
  MODIFY `_eid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `_oid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passwordchanged`
--
ALTER TABLE `passwordchanged`
  MODIFY `_pid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profilepic`
--
ALTER TABLE `profilepic`
  MODIFY `_pid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_session`
--
ALTER TABLE `account_session`
  ADD CONSTRAINT `account_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`_id`);

--
-- Constraints for table `error`
--
ALTER TABLE `error`
  ADD CONSTRAINT `error_session_id` FOREIGN KEY (`session_id`) REFERENCES `account_session` (`_sid`),
  ADD CONSTRAINT `error_user_id` FOREIGN KEY (`user_id`) REFERENCES `account` (`_id`);

--
-- Constraints for table `otp`
--
ALTER TABLE `otp`
  ADD CONSTRAINT `account_otp_id` FOREIGN KEY (`user_id`) REFERENCES `account` (`_id`),
  ADD CONSTRAINT `session_otp_id` FOREIGN KEY (`session_id`) REFERENCES `account_session` (`_sid`);

--
-- Constraints for table `passwordchanged`
--
ALTER TABLE `passwordchanged`
  ADD CONSTRAINT `password_account_id` FOREIGN KEY (`user_id`) REFERENCES `account` (`_id`),
  ADD CONSTRAINT `password_session_id` FOREIGN KEY (`session_id`) REFERENCES `account_session` (`_sid`);

--
-- Constraints for table `profilepic`
--
ALTER TABLE `profilepic`
  ADD CONSTRAINT `account_profile_id` FOREIGN KEY (`user_id`) REFERENCES `account` (`_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
