-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 11, 2023 at 02:08 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `_oid` int(10) UNSIGNED ZEROFILL NOT NULL,
  `code` int(11) NOT NULL,
  `session_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_time` int(11) NOT NULL COMMENT 'The time this opt was generated expired every 15 minutes',
  `action_type` varchar(20) NOT NULL COMMENT 'LOGIN\r\nACCOUNT_CREATION\r\nFORGOT_PASSWORD'
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
  MODIFY `_id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2023000000;

--
-- AUTO_INCREMENT for table `account_session`
--
ALTER TABLE `account_session`
  MODIFY `_sid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000000;

--
-- AUTO_INCREMENT for table `error`
--
ALTER TABLE `error`
  MODIFY `_eid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000000;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `_oid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000000;

--
-- AUTO_INCREMENT for table `passwordchanged`
--
ALTER TABLE `passwordchanged`
  MODIFY `_pid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000000;

--
-- AUTO_INCREMENT for table `profilepic`
--
ALTER TABLE `profilepic`
  MODIFY `_pid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000000;

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
