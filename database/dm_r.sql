SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `dm_r` (
  `_did` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `file_name` text NOT NULL,
  `file_description` text DEFAULT NULL,
  `file_type` text NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_added_date` int(11) NOT NULL,
  `file_status` varchar(20) NOT NULL COMMENT 'EXIST & DELETED',
  `file_deleted_date` int(11) DEFAULT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`_did`),
  KEY `dm_r_created_by` (`created_by`),
  KEY `dm_r_updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000000 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Document Management and Records';


ALTER TABLE `dm_r`
  ADD CONSTRAINT `created_by_id` FOREIGN KEY (`created_by`) REFERENCES `lgu-ms`.`account_session` (`_sid`),
  ADD CONSTRAINT `updated_by_id` FOREIGN KEY (`updated_by`) REFERENCES `lgu-ms`.`account_session` (`_sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
