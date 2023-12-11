SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `swm` (
  `_sid` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `collection_area` text NOT NULL,
  `no_trucks` int(11) NOT NULL,
  `solid_waste_weight` int(11) NOT NULL,
  `collection_date` date NOT NULL,
  `transport_to` text NOT NULL,
  `waste_processing_type` varchar(30) NOT NULL COMMENT 'Anaerobic Digester\r\nCompost\r\nVermicompost\r\nIncineration\r\nLandfill\r\nRecycling',
  `waste_type` text NOT NULL COMMENT 'Municipal waste, Hazardous waste, Construction waste, Biodegerable waste, Industrial waste, Household hazardous waste, Electronic waste, Chemical waste, Agricultural waste, Green waste, Biomedical waste, Radioactive waste',
  `created_on` int(11) NOT NULL,
  `updated_on` int(11) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`_sid`),
  KEY `swm_created_by` (`created_by`),
  KEY `swm_updated_by` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000000 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Solid Waste Management';


ALTER TABLE `swm`
  ADD CONSTRAINT `created_by_id` FOREIGN KEY (`created_by`) REFERENCES `lgu-ms`.`account_session` (`_sid`),
  ADD CONSTRAINT `updated_by_id` FOREIGN KEY (`updated_by`) REFERENCES `lgu-ms`.`account_session` (`_sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
