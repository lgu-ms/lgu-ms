SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE `citizen` (
  `c_id` int(11) NOT NULL,
  `account_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `citizen_feedback` (
  `feedback_id` int(11) NOT NULL,
  `citizen_id` int(11) NOT NULL,
  `feedback_date` date NOT NULL,
  `rating` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `citizen_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `request_date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `session_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `citizen_id` int(11) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `citizen`
  ADD PRIMARY KEY (`c_id`);

ALTER TABLE `citizen_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `citizen_id` (`citizen_id`),
  ADD KEY `citizen_id_2` (`citizen_id`);

ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `citizen_id` (`citizen_id`);

ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `citizen_id` (`citizen_id`),
  ADD KEY `fk_sesion_id` (`session_id`);


ALTER TABLE `citizen`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `citizen_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `citizen_feedback`
  ADD CONSTRAINT `fk_citizen_id` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`c_id`) ON UPDATE CASCADE;

ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`c_id`) ON UPDATE CASCADE;

ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_sesion_id` FOREIGN KEY (`session_id`) REFERENCES `lgu-ms`.`account_session` (`_sid`),
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`c_id`) ON UPDATE CASCADE;
