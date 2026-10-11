-- Adminer 5.4.2 MariaDB 11.8.6 dump

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `datikothechef`;
CREATE DATABASE `datikothechef`;

DROP USER IF EXISTS `datikothechef`@`%`;
CREATE USER `datikothechef`@`%` IDENTIFIED BY `AuJ7k68cXCTnpPSX`;
GRANT ALL PRIVILEGES ON datikothechef.* TO `datikothechef`@`%` WITH GRANT OPTION;
FLUSH PRIVILEGES;

USE `datikothechef`;


DROP TABLE IF EXISTS `Admin`;
CREATE TABLE `Admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` bigint(20) DEFAULT NULL,
  `Privilege` int(1) DEFAULT NULL,
  `Created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

INSERT INTO `Admin` (`ID`, `Name`, `Username`, `Password`, `Email`, `Phone`, `Privilege`, `Created`, `Updated`) VALUES
(1, 'Administrator', 'admin', NULL, 'anamaria.lublovary@gmail.com', 995599292568, 1, NOW(), NULL);


DROP TABLE IF EXISTS `Reservation`;
CREATE TABLE `Reservation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Number` bigint(20) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` bigint(20) DEFAULT NULL,
  `BookingDate` date DEFAULT NULL,
  `BookingTime` time DEFAULT NULL,
  `TableID` int(11) DEFAULT NULL,
  `Adults` int(11) DEFAULT NULL,
  `Children` int(11) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `Created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;


DROP TABLE IF EXISTS `Table`;
CREATE TABLE `Table` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Number` varchar(255) DEFAULT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `Created` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;


-- 2026-05-17 16:20:03 UTC