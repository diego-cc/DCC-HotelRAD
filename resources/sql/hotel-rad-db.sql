DROP USER IF EXISTS `hotel_rad`@`localhost`;
DROP DATABASE IF EXISTS `hotel_rad`;

CREATE DATABASE IF NOT EXISTS `hotel_rad` /*!40100 COLLATE 'utf8mb4_general_ci' */;

CREATE USER IF NOT EXISTS `hotel_rad_user`@`localhost` IDENTIFIED BY 'Secret1';
GRANT USAGE ON *.* TO 'hotel_rad_user'@localhost IDENTIFIED BY 'Secret1';
GRANT ALL privileges ON `hotel_rad`.* TO 'hotel_rad_user'@localhost;

USE hotel_rad;
