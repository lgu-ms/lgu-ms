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
-- Database: `property_tax`
--

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `property_address` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `property_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `account_id`, `property_address`, `value`, `property_type`) VALUES
(36, 2023000021, '98, Ambuklao Street, Pasong Tamo, Quezon CIty, NCR', '2,500,000', 'Condominium');

-- --------------------------------------------------------

--
-- Table structure for table `property_owner`
--

CREATE TABLE `property_owner` (
  `owner_id` int(11) NOT NULL,
  `account_id` int(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_owner`
--

INSERT INTO `property_owner` (`owner_id`, `account_id`, `first_name`, `last_name`, `email`, `contact_no`) VALUES
(6, 2023000021, 'Nelson', 'Reyes', 'nreyesmine69@gmail.com', '09087527541');

-- --------------------------------------------------------

--
-- Table structure for table `tax_record`
--

CREATE TABLE `tax_record` (
  `tax_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `tax_amount` int(11) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `tax_rate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax_record`
--

INSERT INTO `tax_record` (`tax_id`, `account_id`, `property_id`, `owner_id`, `tax_amount`, `payment_status`, `tax_rate`) VALUES
(11, 2023000021, 36, 6, 25000, 'Unpaid', '1%');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `transaction_type` varchar(50) NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `account_id`, `transaction_type`, `transaction_date`) VALUES
(12, 2023000021, 'Account Registration', '2023-11-23 20:43:21'),
(13, 2023000021, 'Property Registration', '2023-11-23 20:44:12'),
(27, 2023000021, 'Tax Viewing', '2023-11-23 21:03:33'),
(28, 2023000021, 'Tax Payment', '2023-11-23 21:14:25'),
(29, 2023000021, 'Property Owner Modification', '2023-11-23 21:15:37'),
(30, 2023000021, 'Account Registration', '2023-11-23 21:16:47'),
(31, 2023000021, 'Property Owner Deletion', '2023-11-23 21:21:09'),
(32, 2023000021, 'Property Deletetion', '2023-11-23 21:21:45'),
(33, 2023000021, 'Property Registration', '2023-11-23 21:22:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `property_owner`
--
ALTER TABLE `property_owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `tax_record`
--
ALTER TABLE `tax_record`
  ADD PRIMARY KEY (`tax_id`),
  ADD KEY `fk_owner_id` (`owner_id`),
  ADD KEY `fk_property_id` (`property_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `property_owner`
--
ALTER TABLE `property_owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tax_record`
--
ALTER TABLE `tax_record`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tax_record`
--
ALTER TABLE `tax_record`
  ADD CONSTRAINT `fk_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `property_owner` (`owner_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_property_id` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
