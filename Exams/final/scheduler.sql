-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `scheduler_user`;
CREATE TABLE `scheduler_user` (
  `scheduler_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheduler_user_name` varchar(255) NOT NULL,
  `scheduler_user_password` varchar(128) NOT NULL,
  PRIMARY KEY (`scheduler_user_id`),
  UNIQUE KEY `scheduler_user_name` (`scheduler_user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `scheduler_appointments`;
CREATE TABLE `scheduler_appointments` (
  `scheduler_appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheduler_appointment_start_time_date` DATETIME NOT NULL,
  `scheduler_appointment_end_time_date` DATETIME NOT NULL,
  `scheduler_appointment_duration` TIME NOT NULL,
  `scheduler_appointment_reserved` BOOLEAN,
  `scheduler_user_id` int(11),
  PRIMARY KEY (`scheduler_appointment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scheduler_user`
--

INSERT INTO `scheduler_user` 
(`scheduler_user_name`, `scheduler_user_password`)
VALUES
('juhi123', 'hello'),
('eliza0', 'world');
-- Encrypted Version
-- ('juhi123', '$2y$11$Xu2fBnMw7v1XXBpalCIwxe1K62lHR4RTsEJZvOHMqB0jjexD0TiYm'),
-- ('eliza0', '$2y$11$ZmjgNvYPVjwBa8t13GzU8ex8K7SXlHmemwh69qBWb382PdYSqWxa2');

-- INSERTING APPOINTMENT INFO
INSERT INTO `scheduler_appointments` 
(`scheduler_appointment_start_time_date`, `scheduler_appointment_end_time_date`, `scheduler_appointment_duration`, `scheduler_appointment_reserved`, `scheduler_user_id`) 
VALUES
('2019-04-8 9:00', '2019-04-8 12:00', '3:00', FALSE, 1),
('2019-05-10 12:00', '2019-05-10 13:00', '01:00', FALSE, 1),
('2019-05-18 8:00', '2019-05-19 8:30', '00:30', TRUE, 1),
('2019-05-15 10:00', '2019-05-15 12:00', '02:00', FALSE, 1),
('2019-06-07 14:00', '2019-06-07 16:30', '02:30', TRUE, 2),
('2019-05-18 19:00', '2019-05-19 19:30', '00:30', FALSE, 2);


-- ADDING BOOKING TO APPOINTMENTS EXAMPLE 
UPDATE `scheduler_appointments` 
SET `scheduler_appointment_reserved` = TRUE
WHERE scheduler_appointment_id = 2;