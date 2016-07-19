-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 17, 2016 at 02:47 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ColiGoBackup`
--

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

CREATE TABLE `Address` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`id`, `address`, `zip_code`, `city`, `lat`, `lng`) VALUES
(1, '10 Rue Lisfranc', 75020, 'Paris', 48.8618, 2.40236),
(2, '34Rue Daniel Ouvrard', 86170, 'Vienne', 46.6835, 0.240793),
(3, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(4, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(5, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(6, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(7, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(8, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(9, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(10, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(11, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(12, '34Rue Daniel Ouvrard', 86170, 'Neuville de Poitou', NULL, NULL),
(13, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(14, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(15, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(16, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(17, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(18, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(19, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(20, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(21, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(22, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(23, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(24, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(25, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(26, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(27, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(28, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(29, '34Rue Daniel Ouvrard', 86170, 'Vienne', NULL, NULL),
(30, '23Rue des Petits Champs', 0, '', NULL, NULL),
(31, '23Rue des Petits Champs', 0, '', NULL, NULL),
(32, '23Rue des Petits Champs', 0, '', NULL, NULL),
(33, '157Avenue des Champs-Élysées', 0, '', NULL, NULL),
(34, '25Rue des Boulangers', 0, '', NULL, NULL),
(35, '39, Rue des Lilas', 86170, 'Neuville-de-Poitou', NULL, NULL),
(36, ', ', 0, '', NULL, NULL),
(37, ', ', 0, '', NULL, NULL),
(38, ', ', 0, '', NULL, NULL),
(39, ', ', 0, '', NULL, NULL),
(40, ', ', 0, '', NULL, NULL),
(41, ', ', 0, '', NULL, NULL),
(42, ', ', 0, '', NULL, NULL),
(43, '10, ', 75020, 'Paris', NULL, NULL),
(44, ', ', 0, '', NULL, NULL),
(45, '39, ', 86170, 'Neuville-de-Poitou', NULL, NULL),
(46, '182, Avenue dItalie', 75013, 'Paris', NULL, NULL),
(47, '76, Boulevard Voltaire', 75011, 'Paris', NULL, NULL),
(48, '14, Rue de Charonne', 75011, 'Paris', NULL, NULL),
(49, '14, Rue Monte-Cristo', 75020, 'Paris', 48.8559, 2.39746),
(50, '10, Rue Lisfranc', 75020, 'Paris', 48.8618, 2.40236),
(51, '43, Rue du Faubourg Saint-Honoré', 75008, 'Paris', NULL, NULL),
(53, '393, Rue de Vaugirard', 0, '', 0, 0),
(54, '393, Rue de Vaugirard', 75015, 'Paris', 48.834, 2.29191),
(55, '65, Boulevard Voltaire', 75011, 'Paris', 48.8618, 2.37404),
(56, '45, Avenue John Fitzgerald Kennedy', 71100, 'Chalon-sur-Saône', 46.8018, 4.86108),
(57, '30, Allée Maurice Sarraut', 31300, 'Toulouse', 43.5954, 1.4218),
(58, '34Rue Daniel Ouvrard, ', 86170, 'Vienne', NULL, NULL),
(59, '45, Avenue John Fitzgerald Kennedy, ', 71100, 'Chalon-sur-Saône', 0, 0),
(60, '30, Allée Maurice Sarraut, ', 31300, 'Toulouse', 0, 0),
(61, '4442, Rue des Petits Carreaux', 75002, 'Paris', 0, 0),
(62, '12, Boulevard Voltaire', 75011, 'Paris', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `DeliveryType`
--

CREATE TABLE `DeliveryType` (
  `id` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DeliveryType`
--

INSERT INTO `DeliveryType` (`id`, `label`) VALUES
(1, '8h'),
(2, 'express'),
(3, 'urgence'),
(4, 'fret');

-- --------------------------------------------------------

--
-- Table structure for table `Extra`
--

CREATE TABLE `Extra` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `explaination` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Extra`
--

INSERT INTO `Extra` (`id`, `label`, `price`, `explaination`) VALUES
(1, 'papier bulles', 0.6, 'Le colis sera emballé de papier bulles. Protège les objets fragiles des gros impacts.'),
(2, 'papier de soie', 0.4, 'Le colis sera emballé dans du papier de soie. Protège les objets très fragiles des faibles impacts.'),
(3, 'papier kraft', 0.2, 'Le colis sera emballé de papier kraft. Protège les objets peu fragiles des faibles impacts.'),
(4, 'polystyrene', 0.3, 'Le colis sera entouré de billes de polystyrène. Protège les objets de grande taille des impacts.'),
(5, 'ramassage domicile', 8, 'Ce service vous propose de ramasser votre colis chez vous et vous permet de ne pas le déposer en point relais.'),
(6, 'livraison samedi', 5, 'Ce service permet de livrer votre colis le samedi.'),
(7, 'prioritaire', 10, 'Ce service rend votre colis prioritaire.'),
(8, 'par tous les moyens', 37, 'En cas de problèmes sur le transport de votre colis, ce service permet la mise en place de tous les moyens possibles pour permettre la livraison de votre colis.'),
(9, 'indemnisation', 19, 'Ce service vous rembourse en cas de perte ou d avarie du colis.'),
(10, 'livraison domicile', 8, 'Ce service vous propose de livrer votre colis chez vous au lieu de le livrer en Point Relais.');

-- --------------------------------------------------------

--
-- Table structure for table `FavoriteRelayPoint`
--

CREATE TABLE `FavoriteRelayPoint` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `relay_point_id` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FavoriteRelayPoint`
--

INSERT INTO `FavoriteRelayPoint` (`id`, `user_id`, `relay_point_id`, `is_deleted`) VALUES
(1, 1, 4, 1),
(2, 1, 4, 1),
(3, 1, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `OrderParcel`
--

CREATE TABLE `OrderParcel` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `parcel_id` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `OrderParcel`
--

INSERT INTO `OrderParcel` (`id`, `order_id`, `parcel_id`, `is_deleted`) VALUES
(7, 13, 75, 0),
(9, 14, 77, 0),
(10, 15, 78, 0),
(11, 16, 79, 0),
(12, 17, 80, 0),
(13, 18, 81, 0),
(15, 19, 84, 0),
(16, 20, 85, 0),
(17, 21, 102, 0),
(18, 22, 103, 0),
(19, 23, 104, 0),
(20, 24, 105, 0),
(21, 25, 106, 0),
(22, 26, 107, 0),
(23, 27, 108, 0),
(24, 28, 109, 0),
(25, 29, 111, 0),
(27, 30, 113, 0),
(28, 31, 114, 0),
(29, 32, 115, 0),
(30, 33, 125, 0),
(32, 34, 130, 0),
(33, 35, 133, 0),
(34, 36, 134, 0),
(35, 37, 135, 0),
(36, 38, 136, 0),
(38, 39, 138, 0),
(39, 40, 139, 0),
(40, 41, 140, 0),
(41, 44, 141, 0),
(42, 45, 142, 0),
(43, 46, 143, 0),
(45, 47, 145, 0),
(46, 48, 146, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

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
(34, 1, 51, 29.4, '2016-05-18 14:48:31', 1, 1, 3, 0, '0000-00-00 00:00:00'),
(35, 1, 50, 93.5, '2016-06-05 17:29:49', 1, 1, 3, 0, '0000-00-00 00:00:00'),
(36, 1, 57, 90.15, '2016-06-05 20:26:32', 1, 1, 19, 0, '0000-00-00 00:00:00'),
(37, 1, 57, 93.8, '2016-06-05 20:53:34', 1, 1, 3, 0, '0000-00-00 00:00:00'),
(38, 1, 57, 93.2, '2016-06-10 07:56:43', 1, 1, 3, 0, '2016-06-10 07:56:43'),
(39, 1, 57, 89.95, '2016-06-10 08:13:55', 1, 24, 1, 0, '0000-00-00 00:00:00'),
(40, 1, 57, 118.7, '2016-06-10 10:23:44', 1, 1, 3, 0, '0000-00-00 00:00:00'),
(41, 1, 57, 118.7, '2016-06-10 10:26:45', 1, 1, 3, 0, '0000-00-00 00:00:00'),
(42, 1, 57, 69, '2016-06-10 10:53:29', 1, 25, 1, 0, '0000-00-00 00:00:00'),
(43, 1, 57, 79, '2016-06-10 10:57:25', 1, 25, 1, 0, '0000-00-00 00:00:00'),
(44, 1, 58, 10.2, '2016-06-24 20:25:37', 1, 1, 3, 0, '0000-00-00 00:00:00'),
(45, 60, 59, 47.6, '2016-07-09 13:15:24', NULL, 1, 3, 0, '0000-00-00 00:00:00'),
(46, 60, 59, 49.9, '2016-07-09 13:23:43', NULL, 1, 3, 0, '0000-00-00 00:00:00'),
(47, 62, 61, 87.2, '2016-07-10 13:29:15', NULL, 1, 19, 0, '0000-00-00 00:00:00'),
(48, 60, 58, 47.6, '2016-07-14 16:51:21', NULL, 1, 3, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Parcel`
--

CREATE TABLE `Parcel` (
  `id` int(11) NOT NULL,
  `weight` float NOT NULL,
  `status_id` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `delivery_type` int(11) NOT NULL,
  `tracking_number` bigint(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Parcel`
--

INSERT INTO `Parcel` (`id`, `weight`, `status_id`, `is_deleted`, `delivery_type`, `tracking_number`) VALUES
(1, 25.7, 5, 0, 2, NULL),
(2, 25.7, 4, 0, 2, 960),
(3, 25.7, 1, 0, 2, NULL),
(4, 25.7, 5, 0, 2, NULL),
(5, 25.7, 5, 0, 2, NULL),
(6, 25.7, 5, 0, 2, NULL),
(7, 25.7, 1, 0, 2, NULL),
(8, 25.7, 1, 0, 2, NULL),
(9, 25.7, 5, 0, 2, NULL),
(10, 25.7, 1, 0, 2, NULL),
(11, 25.7, 1, 0, 2, NULL),
(12, 25.7, 1, 0, 2, NULL),
(13, 25.7, 1, 0, 2, NULL),
(14, 25.7, 1, 0, 2, NULL),
(15, 25.7, 1, 0, 2, NULL),
(16, 25.7, 1, 0, 2, NULL),
(17, 25.7, 1, 0, 2, NULL),
(18, 25.7, 1, 0, 2, NULL),
(19, 25.7, 1, 0, 2, NULL),
(20, 25.7, 1, 0, 2, NULL),
(21, 25.7, 1, 0, 2, NULL),
(22, 25.7, 1, 0, 2, NULL),
(23, 25.7, 1, 0, 2, NULL),
(24, 25.7, 1, 0, 2, NULL),
(25, 25.7, 1, 0, 2, NULL),
(26, 25.7, 1, 0, 2, NULL),
(27, 25.7, 1, 0, 2, NULL),
(28, 25.7, 1, 0, 2, NULL),
(29, 25.7, 1, 0, 2, NULL),
(30, 25.7, 1, 0, 2, NULL),
(31, 25.7, 1, 0, 2, NULL),
(32, 25.7, 1, 0, 2, NULL),
(33, 25.7, 1, 0, 2, NULL),
(34, 25.7, 1, 0, 2, NULL),
(35, 25.7, 1, 0, 2, NULL),
(36, 25.7, 1, 0, 2, NULL),
(37, 25.7, 1, 0, 2, NULL),
(38, 25.7, 1, 0, 2, NULL),
(39, 25.7, 1, 0, 2, NULL),
(40, 25.7, 1, 0, 2, NULL),
(41, 25.7, 1, 0, 2, NULL),
(42, 25.7, 1, 0, 2, NULL),
(43, 25.7, 1, 0, 2, NULL),
(44, 25.7, 1, 0, 2, NULL),
(45, 25.7, 1, 0, 2, NULL),
(46, 25.7, 1, 0, 2, NULL),
(47, 25.7, 1, 0, 2, NULL),
(48, 25.7, 1, 0, 2, NULL),
(49, 25.7, 1, 0, 2, NULL),
(50, 25.7, 1, 0, 2, NULL),
(51, 25.7, 1, 0, 2, NULL),
(52, 25.7, 1, 0, 2, NULL),
(53, 25.7, 1, 0, 2, NULL),
(54, 25.7, 1, 0, 2, NULL),
(55, 25.7, 1, 0, 2, NULL),
(56, 25.7, 1, 0, 2, NULL),
(57, 25.7, 1, 0, 2, NULL),
(58, 25.7, 1, 0, 2, NULL),
(59, 25.7, 1, 0, 2, NULL),
(60, 25.7, 1, 0, 2, NULL),
(61, 25.7, 1, 0, 2, NULL),
(62, 25.7, 1, 0, 2, NULL),
(63, 25.7, 1, 0, 2, NULL),
(64, 25.7, 1, 0, 2, NULL),
(65, 25.7, 1, 0, 2, NULL),
(66, 25.7, 1, 0, 2, NULL),
(67, 25.7, 1, 0, 2, NULL),
(68, 25.7, 1, 0, 2, NULL),
(69, 25.7, 1, 0, 2, NULL),
(70, 25.7, 1, 0, 2, NULL),
(71, 25.7, 1, 0, 2, NULL),
(72, 25.7, 1, 0, 2, NULL),
(73, 25.7, 1, 0, 2, NULL),
(74, 25.7, 1, 0, 2, NULL),
(75, 25.7, 2, 0, 2, NULL),
(76, 16, 1, 0, 2, NULL),
(77, 16, 1, 0, 2, NULL),
(78, 16, 1, 0, 2, NULL),
(79, 16, 1, 0, 2, NULL),
(80, 16, 1, 0, 2, NULL),
(81, 16, 1, 0, 2, NULL),
(82, 29, 1, 0, 3, NULL),
(83, 3, 1, 0, 2, NULL),
(84, 3, 5, 0, 2, 689472894),
(85, 5, 1, 0, 1, 36015),
(86, 7, 1, 0, 3, 9390980),
(87, 7, 1, 0, 3, 6),
(88, 7, 1, 0, 3, 2316045),
(89, 7, 1, 0, 3, 9223372036854775807),
(90, 7, 1, 0, 3, 86139850570),
(91, 7, 1, 0, 3, 54229070030),
(92, 7, 1, 0, 3, 9232054),
(93, 7, 1, 0, 3, 98009),
(94, 7, 1, 0, 3, 986),
(95, 7, 1, 0, 3, 8128705),
(96, 7, 1, 0, 3, 266570096),
(97, 7, 1, 0, 3, 110),
(98, 7, 1, 0, 3, 99150),
(99, 7, 1, 0, 3, 7),
(100, 7, 1, 0, 3, 964314150),
(101, 7, 1, 0, 3, 380478704),
(102, 7, 1, 0, 3, 7077),
(103, 8.9, 1, 0, 2, 8440615274),
(104, 8.9, 1, 0, 2, 4665513527),
(105, 8.9, 1, 0, 2, 1208458413),
(106, 8.9, 1, 0, 2, 8175903860),
(107, 2.5, 1, 0, 1, 5627756053),
(108, 1, 1, 0, 2, 7514190033),
(109, 1, 1, 0, 2, 9621307663),
(110, 17, 1, 0, 1, 5109627172),
(111, 8, 1, 0, 3, 3573409194),
(112, 3, 1, 0, 1, 2028733944),
(113, 3, 1, 0, 1, 788845390),
(114, 3, 1, 0, 1, 9243430321),
(115, 3, 1, 0, 1, 4175796743),
(116, 3.7, 1, 0, 3, 3112383299),
(117, 3.7, 1, 0, 3, 7379332324),
(118, 3.7, 1, 0, 3, 8065011133),
(119, 3.7, 1, 0, 3, 6000959390),
(120, 3.7, 1, 0, 3, 8420491488),
(121, 3.7, 1, 0, 3, 4707772104),
(122, 3.7, 1, 0, 3, 9147990852),
(123, 3.7, 1, 0, 3, 2212996059),
(124, 3.7, 1, 0, 3, 5056502454),
(125, 3.7, 1, 0, 3, 5359147825),
(126, 12.9, 1, 0, 2, 2659941891),
(127, 12.9, 1, 0, 2, 6182760065),
(128, 12.9, 1, 0, 2, 6741990894),
(129, 12.9, 1, 0, 2, 3249914471),
(130, 12.5, 1, 0, 3, 3489039835),
(131, 10, 1, 0, 2, 7287085423),
(132, 24, 1, 0, 3, 8856933182),
(133, 13, 1, 0, 2, 1188815500),
(134, 8, 4, 0, 2, 8491055516),
(135, 19, 4, 0, 2, 1151028363),
(136, 18, 4, 0, 2, 1482315297),
(137, 5, 4, 0, 2, 3374370727),
(138, 9, 1, 0, 2, 2509146242),
(139, 3, 1, 0, 3, 3860041321),
(140, 3, 1, 0, 3, 5678420581),
(141, 3, 1, 0, 2, 6799667589),
(142, 3, 1, 0, 2, 2062732626),
(143, 5, 1, 0, 3, 5854747701),
(144, 15, 1, 0, 2, 784227853),
(145, 3, 1, 0, 4, 1333279438),
(146, 4.5, 1, 0, 2, 8758238342);

-- --------------------------------------------------------

--
-- Table structure for table `ParcelExtra`
--

CREATE TABLE `ParcelExtra` (
  `id` int(11) NOT NULL,
  `parcel_id` int(11) NOT NULL,
  `extra_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ParcelExtra`
--

INSERT INTO `ParcelExtra` (`id`, `parcel_id`, `extra_id`) VALUES
(1, 129, 2),
(2, 129, 7),
(3, 130, 3),
(4, 130, 7),
(5, 131, 1),
(6, 131, 7),
(7, 131, 8),
(8, 131, 9),
(9, 131, 5),
(10, 132, 1),
(11, 132, 7),
(12, 132, 8),
(13, 132, 9),
(14, 132, 5),
(15, 133, 4),
(16, 133, 7),
(17, 133, 8),
(18, 133, 9),
(19, 133, 5),
(20, 134, 1),
(21, 134, 7),
(22, 134, 8),
(23, 134, 9),
(24, 134, 5),
(25, 135, 1),
(26, 135, 7),
(27, 135, 8),
(28, 135, 9),
(29, 135, 5),
(30, 136, 7),
(31, 136, 8),
(32, 136, 9),
(33, 136, 5),
(34, 137, 2),
(35, 137, 7),
(36, 137, 8),
(37, 137, 9),
(38, 137, 5),
(39, 138, 2),
(40, 138, 7),
(41, 138, 8),
(42, 138, 9),
(43, 138, 5),
(44, 139, 7),
(45, 139, 8),
(46, 139, 9),
(47, 139, 5),
(48, 139, 6),
(49, 140, 7),
(50, 140, 8),
(51, 140, 9),
(52, 140, 5),
(53, 140, 6);

-- --------------------------------------------------------

--
-- Table structure for table `ParcelStatus`
--

CREATE TABLE `ParcelStatus` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ParcelStatus`
--

INSERT INTO `ParcelStatus` (`id`, `label`, `description`) VALUES
(1, 'dépot', 'Votre colis a bien été déposé. Il est en attente de livraison.'),
(2, 'prise en charge', 'Votre colis a été pris en charge par le livreur et est en cours de livraison.'),
(3, 'livraison', 'Votre colis a été déposé en point relais et peut dès à présent être récupéré.'),
(4, 'distribution', 'Votre colis a bien été distribué.'),
(5, 'perdu', 'Votre colis a malencontreusement été perdu. Nous faisons tout notre possible pour remédier à cette situation.');

-- --------------------------------------------------------

--
-- Table structure for table `RelayPoint`
--

CREATE TABLE `RelayPoint` (
  `id` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RelayPoint`
--

INSERT INTO `RelayPoint` (`id`, `address`, `owner_id`, `is_deleted`, `label`) VALUES
(1, 2, 2, 0, 'Chez Moïse'),
(2, 55, 17, 1, 'Relais Voltaire'),
(3, 56, 13, 0, 'Sponge Bob Store'),
(4, 57, 15, 0, 'Miria');

-- --------------------------------------------------------

--
-- Table structure for table `Remuneration`
--

CREATE TABLE `Remuneration` (
  `id` int(11) NOT NULL,
  `relay_point_id` int(11) NOT NULL,
  `remuneration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `xml` varchar(255) NOT NULL,
  `is_paid` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Stock`
--

CREATE TABLE `Stock` (
  `id` int(11) NOT NULL,
  `relay_point_id` int(11) NOT NULL,
  `extra_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tracking`
--

CREATE TABLE `Tracking` (
  `id` int(11) NOT NULL,
  `parcel_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `new_status_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tracking`
--

INSERT INTO `Tracking` (`id`, `parcel_id`, `status_id`, `new_status_date`) VALUES
(1, 1, 1, '2016-04-25 16:56:13'),
(2, 2, 1, '2016-04-25 17:02:47'),
(3, 3, 1, '2016-04-25 17:09:05'),
(4, 4, 1, '2016-04-25 17:09:57'),
(5, 5, 1, '2016-04-25 17:10:35'),
(6, 6, 1, '2016-04-25 17:12:07'),
(7, 7, 1, '2016-04-25 17:12:43'),
(8, 8, 1, '2016-04-25 17:14:58'),
(9, 9, 1, '2016-04-25 17:16:24'),
(10, 10, 1, '2016-04-25 17:16:38'),
(11, 11, 1, '2016-04-25 17:16:57'),
(12, 12, 1, '2016-04-25 17:17:10'),
(13, 13, 1, '2016-04-25 17:17:26'),
(14, 14, 1, '2016-04-25 17:17:38'),
(15, 15, 1, '2016-04-25 17:18:32'),
(16, 16, 1, '2016-04-25 17:19:52'),
(17, 17, 1, '2016-04-25 17:19:57'),
(18, 18, 1, '2016-04-25 17:20:34'),
(19, 19, 1, '2016-04-25 17:20:36'),
(20, 20, 1, '2016-04-25 17:20:46'),
(21, 21, 1, '2016-04-25 17:21:05'),
(22, 22, 1, '2016-04-25 17:21:06'),
(23, 23, 1, '2016-04-25 17:22:44'),
(24, 24, 1, '2016-04-25 17:22:47'),
(25, 25, 1, '2016-04-25 17:23:00'),
(26, 26, 1, '2016-04-25 17:23:02'),
(27, 27, 1, '2016-04-25 17:23:04'),
(28, 28, 1, '2016-04-25 17:23:16'),
(29, 29, 1, '2016-04-25 17:23:18'),
(30, 30, 1, '2016-04-25 17:23:47'),
(31, 31, 1, '2016-04-25 17:24:29'),
(32, 32, 1, '2016-04-25 17:27:04'),
(33, 33, 1, '2016-04-25 17:29:09'),
(34, 34, 1, '2016-04-25 17:29:40'),
(35, 35, 1, '2016-04-25 17:29:41'),
(36, 36, 1, '2016-04-25 17:30:20'),
(37, 37, 1, '2016-04-25 17:30:21'),
(38, 38, 1, '2016-04-25 17:30:29'),
(39, 39, 1, '2016-04-25 17:30:34'),
(40, 40, 1, '2016-04-25 17:30:44'),
(41, 41, 1, '2016-04-25 17:31:03'),
(42, 42, 1, '2016-04-25 17:31:06'),
(43, 43, 1, '2016-04-25 17:31:17'),
(44, 44, 1, '2016-04-25 17:31:19'),
(45, 45, 1, '2016-04-25 17:31:21'),
(46, 46, 1, '2016-04-25 17:31:45'),
(47, 47, 1, '2016-04-25 17:31:46'),
(48, 48, 1, '2016-04-25 17:33:46'),
(49, 49, 1, '2016-04-25 17:39:28'),
(50, 50, 1, '2016-04-25 17:39:46'),
(51, 51, 1, '2016-04-25 17:39:47'),
(52, 52, 1, '2016-04-25 17:40:12'),
(53, 53, 1, '2016-04-25 17:40:34'),
(54, 54, 1, '2016-04-25 17:41:18'),
(55, 55, 1, '2016-04-25 17:41:27'),
(56, 56, 1, '2016-04-25 17:41:29'),
(57, 57, 1, '2016-04-25 17:41:30'),
(58, 58, 1, '2016-04-25 17:41:44'),
(59, 59, 1, '2016-04-25 17:44:03'),
(60, 60, 1, '2016-04-25 17:47:15'),
(61, 61, 1, '2016-04-25 17:51:39'),
(62, 62, 1, '2016-04-25 17:55:46'),
(63, 63, 1, '2016-04-25 17:56:04'),
(64, 64, 1, '2016-04-25 17:58:38'),
(65, 65, 1, '2016-04-25 18:00:53'),
(66, 66, 1, '2016-04-25 18:01:27'),
(67, 67, 1, '2016-04-25 18:01:44'),
(68, 68, 1, '2016-04-25 18:01:45'),
(69, 69, 1, '2016-04-25 18:02:31'),
(70, 70, 1, '2016-04-25 18:04:00'),
(71, 71, 1, '2016-04-25 18:04:52'),
(72, 72, 1, '2016-04-25 18:05:18'),
(73, 73, 1, '2016-04-25 18:05:54'),
(74, 74, 1, '2016-04-25 18:06:35'),
(75, 75, 1, '2016-04-25 18:09:01'),
(76, 1, 5, '2016-05-04 21:08:53'),
(77, 2, 2, '2016-05-04 21:08:59'),
(78, 2, 3, '2016-05-04 21:09:07'),
(79, 5, 5, '2016-05-04 21:11:34'),
(80, 5, 5, '2016-05-04 21:11:36'),
(81, 5, 5, '2016-05-04 21:12:09'),
(82, 6, 5, '2016-05-04 21:12:14'),
(83, 9, 5, '2016-05-04 21:12:43'),
(84, 76, 1, '2016-05-05 09:26:58'),
(85, 77, 1, '2016-05-05 09:27:11'),
(86, 78, 1, '2016-05-05 09:30:26'),
(87, 79, 1, '2016-05-05 09:30:47'),
(88, 80, 1, '2016-05-05 09:35:08'),
(89, 81, 1, '2016-05-05 09:36:39'),
(90, 82, 1, '2016-05-05 09:38:02'),
(91, 84, 1, '2016-05-05 09:57:58'),
(92, 84, 2, '2016-05-05 10:09:20'),
(93, 84, 3, '2016-05-05 10:22:47'),
(94, 84, 4, '2016-05-05 10:23:19'),
(95, 84, 5, '2016-05-05 10:23:41'),
(96, 85, 1, '2016-05-06 10:46:40'),
(97, 86, 1, '2016-05-06 17:29:16'),
(98, 87, 1, '2016-05-06 17:30:35'),
(99, 88, 1, '2016-05-06 17:31:18'),
(100, 89, 1, '2016-05-06 17:32:30'),
(101, 90, 1, '2016-05-06 17:32:47'),
(102, 91, 1, '2016-05-06 17:33:12'),
(103, 92, 1, '2016-05-06 17:35:25'),
(104, 93, 1, '2016-05-06 17:37:53'),
(105, 94, 1, '2016-05-06 17:38:39'),
(106, 95, 1, '2016-05-06 17:39:01'),
(107, 96, 1, '2016-05-06 17:39:05'),
(108, 97, 1, '2016-05-06 17:39:06'),
(109, 98, 1, '2016-05-06 17:39:30'),
(110, 99, 1, '2016-05-06 17:40:02'),
(111, 100, 1, '2016-05-08 12:01:56'),
(112, 101, 1, '2016-05-08 12:02:53'),
(113, 102, 1, '2016-05-08 12:03:07'),
(114, 103, 1, '2016-05-15 16:39:22'),
(115, 104, 1, '2016-05-15 16:40:34'),
(116, 105, 1, '2016-05-15 16:41:39'),
(117, 106, 1, '2016-05-15 16:41:42'),
(118, 107, 1, '2016-05-15 16:43:49'),
(119, 108, 1, '2016-05-15 17:09:11'),
(120, 109, 1, '2016-05-15 17:09:22'),
(121, 110, 1, '2016-05-15 17:10:29'),
(122, 111, 1, '2016-05-18 09:34:16'),
(123, 112, 1, '2016-05-18 12:42:50'),
(124, 113, 1, '2016-05-18 12:43:15'),
(125, 114, 1, '2016-05-18 12:43:24'),
(126, 115, 1, '2016-05-18 12:48:48'),
(127, 116, 1, '2016-05-18 14:29:41'),
(128, 117, 1, '2016-05-18 14:30:30'),
(129, 118, 1, '2016-05-18 14:30:36'),
(130, 119, 1, '2016-05-18 14:31:03'),
(131, 120, 1, '2016-05-18 14:31:06'),
(132, 121, 1, '2016-05-18 14:31:08'),
(133, 122, 1, '2016-05-18 14:31:30'),
(134, 123, 1, '2016-05-18 14:31:46'),
(135, 124, 1, '2016-05-18 14:31:59'),
(136, 125, 1, '2016-05-18 14:32:24'),
(137, 126, 1, '2016-05-18 14:38:25'),
(138, 127, 1, '2016-05-18 14:40:03'),
(139, 128, 1, '2016-05-18 14:41:00'),
(140, 129, 1, '2016-05-18 14:41:18'),
(141, 130, 1, '2016-05-18 14:48:31'),
(142, 131, 1, '2016-06-04 16:01:47'),
(143, 132, 1, '2016-06-04 16:02:18'),
(144, 133, 1, '2016-06-05 17:29:48'),
(145, 134, 1, '2016-06-05 20:26:32'),
(146, 134, 2, '2016-06-05 20:37:36'),
(147, 134, 3, '2016-06-05 20:38:06'),
(148, 134, 4, '2016-06-05 20:38:33'),
(149, 135, 1, '2016-06-05 20:53:34'),
(150, 135, 2, '2016-06-05 20:53:50'),
(151, 135, 3, '2016-06-05 20:53:55'),
(152, 135, 4, '2016-06-05 20:53:58'),
(153, 136, 1, '2016-06-05 21:12:07'),
(154, 136, 2, '2016-06-05 21:12:26'),
(155, 136, 3, '2016-06-05 21:12:31'),
(156, 136, 4, '2016-06-05 21:12:34'),
(157, 137, 1, '2016-06-10 07:59:25'),
(158, 137, 2, '2016-06-10 07:59:48'),
(159, 137, 3, '2016-06-10 07:59:54'),
(160, 137, 4, '2016-06-10 08:00:00'),
(161, 138, 1, '2016-06-10 08:13:55'),
(162, 139, 1, '2016-06-10 10:23:44'),
(163, 140, 1, '2016-06-10 10:26:45'),
(164, 141, 1, '2016-06-24 20:25:37'),
(165, 142, 1, '2016-07-09 13:15:24'),
(166, 143, 1, '2016-07-09 13:23:43'),
(167, 144, 1, '2016-07-09 13:28:10'),
(168, 145, 1, '2016-07-10 13:29:15'),
(169, 146, 1, '2016-07-14 16:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `lost_pwd_key` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `first_name`, `last_name`, `mail`, `password`, `type_id`, `address_id`, `is_deleted`, `lost_pwd_key`) VALUES
(1, 'Marion', 'Hurteau', 'marion.hurteau1@gmail.com', 'ab4f63f9ac65152575886860dde480a1', 1, 1, 0, 2147483647),
(2, 'Ulysse', 'Debernardy', 'ulyssedg@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 0, 0, NULL),
(3, 'Oriane', 'Payen', 'oriane.payen@yopmail.fr', 'ab4f63f9ac65152575886860dde480a1', 4, 1, 0, NULL),
(4, 'Moi', 'Boudin', 'moiboudin@yomail.fr', '', 4, 0, 0, NULL),
(5, 'Romain', 'Ouriet', 'ouriet.romain@gmail.com', 'ab4f63f9ac65152575886860dde480a1', 4, 1, 0, NULL),
(6, 'Livreur', 'Goligo', 'livreur@coligo.fr', 'ab4f63f9ac65152575886860dde480a1', 3, 1, 0, NULL),
(7, 'PrenomClient', 'NomClient', 'mail@client.fr', '', 2, 0, 0, NULL),
(8, 'Robert', 'Dansac', 'bob-gujan@yopmail.fr', '', 4, 0, 0, NULL),
(9, 'Françoise', 'Dansac', 'fan-gujan@yopmail.fr', '', 4, 0, 0, NULL),
(10, 'Moïse', 'Guyonneau', '', '', 2, NULL, 0, NULL),
(11, 'Ghislaine', 'Dansac', 'ghislaine@yopmail.fr', 'ab4f63f9ac65152575886860dde480a1', 4, 35, 0, NULL),
(12, 'Ghislaine', 'Dansac', 'ghislaine@yopmail.fr', 'ab4f63f9ac65152575886860dde480a1', 4, 36, 0, NULL),
(13, 'Patrick', 'Seastar', 'patrick_the_sea_star@yopmail.fr', 'ab4f63f9ac65152575886860dde480a1', 2, 0, 0, NULL),
(14, '', '', '', '', 4, NULL, 0, NULL),
(15, 'Milka', '', 'milkalavache@yopmail.fr', 'ab4f63f9ac65152575886860dde480a1', 2, 0, 0, NULL),
(16, 'Zelda', '', 'zeldouche@yopmail.fr', '', 2, 0, 0, NULL),
(17, 'efzef', 'zefze', 'zefzef@zvz.fr', '', 2, 0, 0, NULL),
(18, 'Marion2', 'Hurteau2', '', '', 4, 0, 0, NULL),
(19, 'Milka', 'Lavache', '', '', 4, 0, 0, NULL),
(20, 'Laura', 'Geiger', 'laura.geiger@yopmail.fr', '', 4, 0, 0, NULL),
(21, 'Catherine', 'Dupuy', '', '', 4, 0, 0, NULL),
(22, 'Christophe', 'Garcia', '', '', 4, 0, 0, NULL),
(23, 'Fabien', 'Maertens', '', '', 4, 0, 0, NULL),
(24, 'Oriane', 'Payen', 'oriane.payen@wanadoo.fr', '', 4, 0, 0, NULL),
(25, 'Sabine', 'Rentin', 'sabinette@yopmail.com', 'e10adc3949ba59abbe56e057f20f883e', 4, 36, 0, NULL),
(26, 'Marion', 'Herisson', 'marion.herisson@yopmail.com', NULL, 4, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `UserType`
--

CREATE TABLE `UserType` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserType`
--

INSERT INTO `UserType` (`id`, `label`) VALUES
(1, 'Admin'),
(2, 'PointRelais'),
(3, 'Livreur'),
(4, 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `WeightPrice`
--

CREATE TABLE `WeightPrice` (
  `id` int(11) NOT NULL,
  `delivery_type` int(11) NOT NULL,
  `min_weight` float NOT NULL,
  `max_weight` float NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `WeightPrice`
--

INSERT INTO `WeightPrice` (`id`, `delivery_type`, `min_weight`, `max_weight`, `price`) VALUES
(1, 1, 0, 2, '33.45'),
(2, 1, 2.1, 5, '38.50'),
(3, 1, 5.1, 10, '44.05'),
(4, 1, 10.1, 15, '50.65'),
(5, 1, 15.1, 20, '56.90'),
(6, 1, 20.1, 25, '63.15'),
(7, 1, 25.1, 30, '68.70'),
(8, 2, 0, 0.5, '5.00'),
(9, 2, 0.6, 1, '6.35'),
(10, 2, 1.1, 2, '7.20'),
(11, 2, 2.1, 5, '10.20'),
(12, 2, 5.1, 10, '15.55'),
(13, 2, 10.1, 20, '19.20'),
(14, 2, 20.1, 30, '22.70'),
(15, 3, 0, 0.5, '35.00'),
(16, 3, 0.6, 1, '36.20'),
(17, 3, 1.1, 2, '37.00'),
(18, 3, 2.1, 5, '39.70'),
(19, 3, 5.1, 10, '44.30'),
(20, 3, 10.1, 20, '47.10'),
(21, 3, 20.1, 30, '50.20'),
(22, 4, 0, 10000, '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `DeliveryType`
--
ALTER TABLE `DeliveryType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Extra`
--
ALTER TABLE `Extra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `FavoriteRelayPoint`
--
ALTER TABLE `FavoriteRelayPoint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `relay_point_id` (`relay_point_id`);

--
-- Indexes for table `OrderParcel`
--
ALTER TABLE `OrderParcel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `parcel_id` (`parcel_id`);

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
-- Indexes for table `Parcel`
--
ALTER TABLE `Parcel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `delivery_type` (`delivery_type`);

--
-- Indexes for table `ParcelExtra`
--
ALTER TABLE `ParcelExtra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcel_id` (`parcel_id`),
  ADD KEY `extra_id` (`extra_id`);

--
-- Indexes for table `ParcelStatus`
--
ALTER TABLE `ParcelStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RelayPoint`
--
ALTER TABLE `RelayPoint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address` (`address`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `Remuneration`
--
ALTER TABLE `Remuneration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relay_point_id` (`relay_point_id`);

--
-- Indexes for table `Stock`
--
ALTER TABLE `Stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relay_point_id` (`relay_point_id`),
  ADD KEY `extra_id` (`extra_id`);

--
-- Indexes for table `Tracking`
--
ALTER TABLE `Tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcel_id` (`parcel_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `UserType`
--
ALTER TABLE `UserType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `WeightPrice`
--
ALTER TABLE `WeightPrice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `DeliveryType`
--
ALTER TABLE `DeliveryType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Extra`
--
ALTER TABLE `Extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `FavoriteRelayPoint`
--
ALTER TABLE `FavoriteRelayPoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `OrderParcel`
--
ALTER TABLE `OrderParcel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `Parcel`
--
ALTER TABLE `Parcel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `ParcelExtra`
--
ALTER TABLE `ParcelExtra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `ParcelStatus`
--
ALTER TABLE `ParcelStatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `RelayPoint`
--
ALTER TABLE `RelayPoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Remuneration`
--
ALTER TABLE `Remuneration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Stock`
--
ALTER TABLE `Stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Tracking`
--
ALTER TABLE `Tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `UserType`
--
ALTER TABLE `UserType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `WeightPrice`
--
ALTER TABLE `WeightPrice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `FavoriteRelayPoint`
--
ALTER TABLE `FavoriteRelayPoint`
  ADD CONSTRAINT `favoriterelaypoint_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `favoriterelaypoint_ibfk_2` FOREIGN KEY (`relay_point_id`) REFERENCES `relaypoint` (`id`);

--
-- Constraints for table `OrderParcel`
--
ALTER TABLE `OrderParcel`
  ADD CONSTRAINT `orderparcel_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderparcel_ibfk_2` FOREIGN KEY (`parcel_id`) REFERENCES `parcel` (`id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`departure_address`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`arrival_address`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`ordered_from`) REFERENCES `relaypoint` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`ordered_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`deliver_to`) REFERENCES `user` (`id`);

--
-- Constraints for table `Parcel`
--
ALTER TABLE `Parcel`
  ADD CONSTRAINT `parcel_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `parcelstatus` (`id`),
  ADD CONSTRAINT `parcel_ibfk_2` FOREIGN KEY (`delivery_type`) REFERENCES `deliverytype` (`id`);

--
-- Constraints for table `ParcelExtra`
--
ALTER TABLE `ParcelExtra`
  ADD CONSTRAINT `parcelextra_ibfk_1` FOREIGN KEY (`parcel_id`) REFERENCES `parcel` (`id`),
  ADD CONSTRAINT `parcelextra_ibfk_2` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`);

--
-- Constraints for table `RelayPoint`
--
ALTER TABLE `RelayPoint`
  ADD CONSTRAINT `relaypoint_ibfk_1` FOREIGN KEY (`address`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `relaypoint_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `Remuneration`
--
ALTER TABLE `Remuneration`
  ADD CONSTRAINT `remuneration_ibfk_1` FOREIGN KEY (`relay_point_id`) REFERENCES `relaypoint` (`id`);

--
-- Constraints for table `Stock`
--
ALTER TABLE `Stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`relay_point_id`) REFERENCES `relaypoint` (`id`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id`);

--
-- Constraints for table `Tracking`
--
ALTER TABLE `Tracking`
  ADD CONSTRAINT `tracking_ibfk_1` FOREIGN KEY (`parcel_id`) REFERENCES `parcel` (`id`),
  ADD CONSTRAINT `tracking_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `parcelstatus` (`id`);

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `usertype` (`id`);

