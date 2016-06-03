-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2016 at 05:06 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ColiGo`
--

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `departure_address` int(11) NOT NULL,
  `arrival_address` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ordered_from` int(11) DEFAULT NULL,
  `ordered_by` int(11) NOT NULL,
  `deliver_to` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `delivery_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`id`, `departure_address`, `arrival_address`, `total_price`, `order_date`, `ordered_from`, `ordered_by`, `deliver_to`, `is_deleted`, `delivery_date`) VALUES
(3, 1, 20, 22.7, '2016-04-25 18:01:27', NULL, 9, 10, 0, '0000-00-00 00:00:00'),
(4, 1, 21, 22.7, '2016-04-25 18:01:44', NULL, 9, 10, 0, '0000-00-00 00:00:00'),
(13, 1, 29, 22.7, '2016-04-25 18:09:01', 1, 9, 10, 0, '0000-00-00 00:00:00'),
(14, 1, 37, 19.2, '2016-05-05 09:27:11', 1, 15, 14, 0, '0000-00-00 00:00:00'),
(15, 1, 38, 19.2, '2016-05-05 09:30:26', 1, 15, 14, 0, '0000-00-00 00:00:00'),
(16, 1, 39, 19.2, '2016-05-05 09:30:47', 1, 15, 14, 0, '0000-00-00 00:00:00'),
(17, 1, 40, 19.2, '2016-05-05 09:35:08', 1, 15, 14, 0, '0000-00-00 00:00:00'),
(18, 1, 41, 19.2, '2016-05-05 09:36:39', 1, 15, 14, 0, '0000-00-00 00:00:00'),
(19, 1, 43, 10.2, '2016-05-05 09:57:58', 1, 15, 14, 0, '0000-00-00 00:00:00'),
(20, 1, 45, 38.5, '2016-05-06 10:46:40', 1, 1, 14, 0, '0000-00-00 00:00:00'),
(21, 1, 35, 15.55, '2016-05-08 12:03:07', 1, 1, 14, 0, '0000-00-00 00:00:00'),
(22, 1, 46, 15.55, '2016-05-15 16:39:22', 1, 1, 14, 0, '0000-00-00 00:00:00'),
(23, 1, 46, 15.55, '2016-05-15 16:40:34', 1, 1, 14, 0, '0000-00-00 00:00:00'),
(24, 1, 46, 15.55, '2016-05-15 16:41:39', 1, 1, 2, 0, '0000-00-00 00:00:00'),
(25, 1, 46, 15.55, '2016-05-15 16:41:42', 1, 1, 2, 0, '0000-00-00 00:00:00'),
(26, 1, 46, 38.5, '2016-05-15 16:43:49', 1, 1, 2, 0, '0000-00-00 00:00:00'),
(27, 1, 47, 6.35, '2016-05-15 17:09:11', 1, 1, 1, 0, '0000-00-00 00:00:00'),
(28, 1, 47, 6.35, '2016-05-15 17:09:22', 1, 1, 1, 0, '0000-00-00 00:00:00'),
(29, 1, 35, 15.55, '2016-05-18 09:34:16', 1, 1, 19, 0, '0000-00-00 00:00:00'),
(30, 1, 49, 38.5, '2016-05-18 12:43:15', 1, 20, 1, 0, '0000-00-00 00:00:00'),
(31, 1, 49, 38.5, '2016-05-18 12:43:24', 1, 20, 1, 0, '0000-00-00 00:00:00'),
(32, 1, 49, 38.5, '2016-05-18 12:48:48', 1, 20, 1, 0, '0000-00-00 00:00:00'),
(33, 1, 50, 10.2, '2016-05-18 14:32:24', 1, 1, 3, 0, '0000-00-00 00:00:00'),
(34, 1, 51, 29.4, '2016-05-18 14:48:31', 1, 1, 3, 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departure_address` (`departure_address`),
  ADD KEY `arrival_address` (`arrival_address`),
  ADD KEY `ordered_from` (`ordered_from`),
  ADD KEY `ordered_by` (`ordered_by`),
  ADD KEY `deliver_to` (`deliver_to`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`departure_address`) REFERENCES `Address` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`arrival_address`) REFERENCES `Address` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`ordered_from`) REFERENCES `RelayPoint` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`ordered_by`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`deliver_to`) REFERENCES `User` (`id`);
