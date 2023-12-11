SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `property_address` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `property_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `property_owner` (
  `owner_id` int(11) NOT NULL,
  `account_id` int(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tax_record` (
  `tax_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `tax_amount` int(11) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `tax_rate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `session_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `owner_id` int(11) NOT NULL,
  `transaction_type` varchar(50) NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `owner_id` (`owner_id`);

ALTER TABLE `property_owner`
  ADD PRIMARY KEY (`owner_id`);

ALTER TABLE `tax_record`
  ADD PRIMARY KEY (`tax_id`),
  ADD KEY `fk_owner_id` (`owner_id`),
  ADD KEY `property_id` (`property_id`);

ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `owner_id` (`owner_id`),
  ADD KEY `session_id` (`session_id`);


ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `property_owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tax_record`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `property_owner` (`owner_id`) ON UPDATE CASCADE;

ALTER TABLE `tax_record`
  ADD CONSTRAINT `fk_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `property_owner` (`owner_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_record_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_id`) ON UPDATE CASCADE;

ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_session_id` FOREIGN KEY (`session_id`) REFERENCES `lgu-ms`.`account_session` (`_sid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `property_owner` (`owner_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
