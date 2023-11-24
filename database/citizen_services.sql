-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 02:43 PM
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
-- Database: `citizen_services`
--

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `c_id` int(11) NOT NULL,
  `account_id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`c_id`, `account_id`, `first_name`, `last_name`, `email`, `contact_no`) VALUES
(106, 2023000020, 'Micheal Andrei', 'Santos', 'santos@gmail.com', '09271123463'),
(107, 2023000021, 'Nelson', 'Reyes', 'reyes@gmail.com', '09087527541');

-- --------------------------------------------------------

--
-- Table structure for table `citizen_feedback`
--

CREATE TABLE `citizen_feedback` (
  `feedback_id` int(11) NOT NULL,
  `account_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `feedback_date` date NOT NULL,
  `rating` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen_feedback`
--

INSERT INTO `citizen_feedback` (`feedback_id`, `account_id`, `feedback_date`, `rating`, `feedback`) VALUES
(36, 2023000021, '2023-11-12', 5, 'The government was lit !!!!'),
(37, 2023000021, '2023-11-23', 4, 'Generous Citizen'),
(38, 2023000021, '2023-11-17', 3, 'The citizen were generous.'),
(39, 2023000021, '2023-11-19', 4, 'Market was good.');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `account_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `request_date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `account_id`, `service_name`, `description`, `request_date`, `status`) VALUES
(14, 2023000021, 'Clean and Green', 'Cleaning some areas.', '2023-11-16', 'Denied'),
(15, 2023000021, 'Traffic Enforcement', 'Managing traffic in the city.', '2023-11-16', 'Denied'),
(18, 2023000021, 'Liquor Ban', 'Ban liquors for elections', '2023-11-23', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `account_id`, `transaction_type`, `transaction_date`) VALUES
(1, 2023000021, 'Service Submmission', '2023-11-23'),
(2, 2023000021, 'Account Registration', '2023-11-23'),
(3, 2023000021, 'Service Approval', '2023-11-23'),
(4, 2023000021, 'Service Denial', '2023-11-23'),
(5, 2023000021, 'Account Modification', '2023-11-23'),
(6, 2023000021, 'Account Deletion', '2023-11-23'),
(7, 2023000021, 'Feedback Modification', '2023-11-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `citizen_feedback`
--
ALTER TABLE `citizen_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citizen`
--
ALTER TABLE `citizen`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `citizen_feedback`
--
ALTER TABLE `citizen_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
