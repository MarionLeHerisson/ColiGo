-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 19, 2016 at 03:23 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ColiGO`
--

-- --------------------------------------------------------

--
-- Table structure for table `AdditionnalPrice`
--

CREATE TABLE `AdditionnalPrice` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`id`, `address`, `zip_code`, `city`, `lat`, `lng`) VALUES
(1, '14, Rue Monte-Cristo', 75020, 'Paris', 0, 0),
(2, ', ', 0, '', 0, 0),
(3, '10, Rue Lisfranc', 75020, 'Paris', 48.8618, 2.40236),
(4, '12, Rue de la Mer', 62600, 'Berck', 50.4069, 1.56102),
(5, '3, Rue de Cugnaux', 31300, 'Toulouse', 43.5917, 1.4196),
(7, '16, Boulevard Voltaire', 75011, 'Paris', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `DeliveryType`
--

CREATE TABLE `DeliveryType` (
  `id` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DeliveryType`
--

INSERT INTO `DeliveryType` (`id`, `label`) VALUES
(1, '8h'),
(2, 'express'),
(3, 'urgence'),
(4, 'fret'),
(5, '8h'),
(6, 'express'),
(7, 'urgence'),
(8, 'fret');

-- --------------------------------------------------------

--
-- Table structure for table `DriversBill`
--

CREATE TABLE `DriversBill` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `bill_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Extra`
--

CREATE TABLE `Extra` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `explaination` tinytext,
  `is_stockable` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Extra`
--

INSERT INTO `Extra` (`id`, `label`, `price`, `explaination`, `is_stockable`) VALUES
(1, 'papier bulles', '0.40', 'Le colis sera emballé de papier bulles. Protège les objets fragiles des gros impacts.', 1),
(2, 'papier de soie', '0.60', 'Le colis sera emballé dans du papier de soie. Protège les objets très fragiles des faibles impacts.', 1),
(3, 'papier kraft', '0.20', 'Le colis sera emballé de papier kraft. Protège les objets peu fragiles des faibles impacts.', 1),
(4, 'polystyrene', '0.30', 'Le colis sera entouré de billes de polystyrène. Protège les objets de grande taille des impacts.', 1),
(5, 'ramassage domicile', '8.00', 'Ce service vous propose de ramasser votre colis chez vous et vous permet de ne pas le déposer en point relais.', 0),
(6, 'livraison domicile', '8.00', 'Ce service vous propose de livrer votre colis chez vous au lieu de le livrer en Point Relais.', 0),
(7, 'livraison samedi', '5.00', 'Ce service permet de livrer votre colis le samedi.', 0),
(8, 'prioritaire', '10.00', 'Ce service rend votre colis prioritaire.', 0),
(9, 'par tous les moyens', '37.00', 'En cas de problèmes sur le transport de votre colis, ce service permet la mise en place de tous les moyens possibles pour permettre la livraison de votre colis.', 0),
(10, 'indemnisation', '19.00', 'Ce service vous rembourse en cas de perte ou d avarie du colis.', 0),
(11, 'papier bulles', '0.40', 'Le colis sera emballé de papier bulles. Protège les objets fragiles des gros impacts.', 1),
(12, 'papier de soie', '0.60', 'Le colis sera emballé dans du papier de soie. Protège les objets très fragiles des faibles impacts.', 1),
(13, 'papier kraft', '0.20', 'Le colis sera emballé de papier kraft. Protège les objets peu fragiles des faibles impacts.', 1),
(14, 'polystyrene', '0.30', 'Le colis sera entouré de billes de polystyrène. Protège les objets de grande taille des impacts.', 1),
(15, 'ramassage domicile', '8.00', 'Ce service vous propose de ramasser votre colis chez vous et vous permet de ne pas le déposer en point relais.', 0),
(16, 'livraison domicile', '8.00', 'Ce service vous propose de livrer votre colis chez vous au lieu de le livrer en Point Relais.', 0),
(17, 'livraison samedi', '5.00', 'Ce service permet de livrer votre colis le samedi.', 0),
(18, 'prioritaire', '10.00', 'Ce service rend votre colis prioritaire.', 0),
(19, 'par tous les moyens', '37.00', 'En cas de problèmes sur le transport de votre colis, ce service permet la mise en place de tous les moyens possibles pour permettre la livraison de votre colis.', 0),
(20, 'indemnisation', '19.00', 'Ce service vous rembourse en cas de perte ou d avarie du colis.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `FavoriteRelayPoint`
--

CREATE TABLE `FavoriteRelayPoint` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `relay_point_id` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OrderParcel`
--

CREATE TABLE `OrderParcel` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `parcel_id` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `OrderParcel`
--

INSERT INTO `OrderParcel` (`id`, `order_id`, `parcel_id`, `is_deleted`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 0),
(3, 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `departure_address` int(11) NOT NULL,
  `arrival_address` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delivery_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordered_from` int(11) DEFAULT NULL,
  `ordered_by` int(11) NOT NULL,
  `deliver_to` int(11) NOT NULL,
  `delivered_by` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`id`, `departure_address`, `arrival_address`, `total_price`, `order_date`, `delivery_date`, `ordered_from`, `ordered_by`, `deliver_to`, `delivered_by`, `is_deleted`) VALUES
(1, 3, 5, '25.40', '2016-07-19 10:18:50', '0000-00-00 00:00:00', NULL, 1, 5, NULL, 0),
(2, 4, 7, '74.80', '2016-07-19 10:06:51', '0000-00-00 00:00:00', NULL, 1, 6, NULL, 0),
(3, 3, 5, '49.10', '2016-07-19 10:16:53', '0000-00-00 00:00:00', NULL, 1, 4, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Parcel`
--

CREATE TABLE `Parcel` (
  `id` int(11) NOT NULL,
  `tracking_number` bigint(20) NOT NULL,
  `weight` float NOT NULL,
  `status_id` int(11) NOT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `delivery_type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Parcel`
--

INSERT INTO `Parcel` (`id`, `tracking_number`, `weight`, `status_id`, `is_deleted`, `delivery_type`) VALUES
(1, 7458583614, 4, 1, 0, 2),
(2, 6989944237, 27, 1, 0, 3),
(3, 5296921979, 5, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ParcelExtra`
--

CREATE TABLE `ParcelExtra` (
  `id` int(11) NOT NULL,
  `parcel_id` int(11) NOT NULL,
  `extra_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ParcelExtra`
--

INSERT INTO `ParcelExtra` (`id`, `parcel_id`, `extra_id`) VALUES
(1, 1, 3),
(2, 1, 7),
(3, 1, 8),
(4, 2, 2),
(5, 2, 7),
(6, 2, 10),
(7, 3, 2),
(8, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `ParcelStatus`
--

CREATE TABLE `ParcelStatus` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ParcelStatus`
--

INSERT INTO `ParcelStatus` (`id`, `label`, `description`) VALUES
(1, 'dépot', 'Votre colis a bien été déposé. Il est en attente de livraison.'),
(2, 'prise en charge', 'Votre colis a été pris en charge par le livreur et est en cours de livraison.'),
(3, 'livraison', 'Votre colis a été déposé en point relais et peut dès à présent être récupéré.'),
(4, 'distribution', 'Votre colis a bien été distribué.'),
(5, 'perdu', 'Votre colis a malencontreusement été perdu. Nous faisons tout notre possible pour remédier à cette situation.'),
(6, 'dépot', 'Votre colis a bien été déposé. Il est en attente de livraison.'),
(7, 'prise en charge', 'Votre colis a été pris en charge par le livreur et est en cours de livraison.'),
(8, 'livraison', 'Votre colis a été déposé en point relais et peut dès à présent être récupéré.'),
(9, 'distribution', 'Votre colis a bien été distribué.'),
(10, 'perdu', 'Votre colis a malencontreusement été perdu. Nous faisons tout notre possible pour remédier à cette situation.');

-- --------------------------------------------------------

--
-- Table structure for table `RelayPoint`
--

CREATE TABLE `RelayPoint` (
  `id` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `is_deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RelayPoint`
--

INSERT INTO `RelayPoint` (`id`, `address`, `owner_id`, `label`, `is_deleted`) VALUES
(1, 4, 3, 'Mon Beau Bateau', 0),
(2, 3, 4, 'Usine à Nuages', 0),
(3, 5, 5, 'La Bonne Pinte', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tracking`
--

INSERT INTO `Tracking` (`id`, `parcel_id`, `status_id`, `new_status_date`) VALUES
(1, 1, 1, '2016-07-19 09:54:25'),
(2, 2, 1, '2016-07-19 10:06:51'),
(3, 3, 1, '2016-07-19 10:16:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `first_name`, `last_name`, `mail`, `password`, `type_id`, `address_id`, `is_deleted`, `lost_pwd_key`) VALUES
(1, 'Marion', 'Hurteau', 'marion.hurteau1@gmail.com', 'ab4f63f9ac65152575886860dde480a1', 1, 1, 0, NULL),
(2, 'Romain', 'Ouriet', 'romain.ouriet@gmail.com', 'ab4f63f9ac65152575886860dde480a1', 1, 2, 0, NULL),
(3, 'Catherine', 'Dupuy', 'cathy.dupuy-dansac@live.fr', 'ab4f63f9ac65152575886860dde480a1', 2, 1, 0, NULL),
(4, 'Oriane', 'Payen', 'oriane.payen@wanadoo.fr', 'ab4f63f9ac65152575886860dde480a1', 2, 3, 0, NULL),
(5, 'Maxime', 'Cohet', 'maxime.cohet@coligo.fr', 'ab4f63f9ac65152575886860dde480a1', 2, 2, 0, NULL),
(6, 'Michel', 'Maubert', 'michel.maubert@coligo.fr', 'ab4f63f9ac65152575886860dde480a1', 3, 7, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `UserType`
--

CREATE TABLE `UserType` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserType`
--

INSERT INTO `UserType` (`id`, `label`) VALUES
(1, 'Admin'),
(2, 'PointRelais'),
(3, 'Livreur'),
(4, 'Client'),
(5, 'Admin'),
(6, 'PointRelais'),
(7, 'Livreur'),
(8, 'Client');

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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `WeightPrice`
--

INSERT INTO `WeightPrice` (`id`, `delivery_type`, `min_weight`, `max_weight`, `price`) VALUES
(1, 1, 0, 0.5, '27.60'),
(2, 1, 0.6, 1, '29.95'),
(3, 1, 1.1, 2, '33.45'),
(4, 1, 2.1, 5, '38.50'),
(5, 1, 5.1, 10, '44.05'),
(6, 1, 10.1, 15, '50.65'),
(7, 1, 15.1, 20, '56.90'),
(8, 1, 20.1, 25, '63.15'),
(9, 1, 25.1, 30, '68.70'),
(10, 2, 0, 0.5, '5.00'),
(11, 2, 0.6, 1, '6.35'),
(12, 2, 1.1, 2, '7.20'),
(13, 2, 2.1, 5, '10.20'),
(14, 2, 5.1, 10, '15.55'),
(15, 2, 10.1, 15, '17.85'),
(16, 2, 15.1, 20, '19.20'),
(17, 2, 20.1, 25, '21.35'),
(18, 2, 25.1, 30, '22.70'),
(19, 3, 0, 0.5, '35.00'),
(20, 3, 0.6, 1, '36.20'),
(21, 3, 1.1, 2, '37.00'),
(22, 3, 2.1, 5, '39.70'),
(23, 3, 5.1, 10, '44.30'),
(24, 3, 10.1, 20, '47.10'),
(25, 3, 20.1, 30, '50.20'),
(26, 4, 0, 10000, '0.00'),
(27, 1, 0, 0.5, '27.60'),
(28, 1, 0.6, 1, '29.95'),
(29, 1, 1.1, 2, '33.45'),
(30, 1, 2.1, 5, '38.50'),
(31, 1, 5.1, 10, '44.05'),
(32, 1, 10.1, 15, '50.65'),
(33, 1, 15.1, 20, '56.90'),
(34, 1, 20.1, 25, '63.15'),
(35, 1, 25.1, 30, '68.70'),
(36, 2, 0, 0.5, '5.00'),
(37, 2, 0.6, 1, '6.35'),
(38, 2, 1.1, 2, '7.20'),
(39, 2, 2.1, 5, '10.20'),
(40, 2, 5.1, 10, '15.55'),
(41, 2, 10.1, 15, '17.85'),
(42, 2, 15.1, 20, '19.20'),
(43, 2, 20.1, 25, '21.35'),
(44, 2, 25.1, 30, '22.70'),
(45, 3, 0, 0.5, '35.00'),
(46, 3, 0.6, 1, '36.20'),
(47, 3, 1.1, 2, '37.00'),
(48, 3, 2.1, 5, '39.70'),
(49, 3, 5.1, 10, '44.30'),
(50, 3, 10.1, 20, '47.10'),
(51, 3, 20.1, 30, '50.20'),
(52, 4, 0, 10000, '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AdditionnalPrice`
--
ALTER TABLE `AdditionnalPrice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

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
-- Indexes for table `DriversBill`
--
ALTER TABLE `DriversBill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`);

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
  ADD KEY `deliver_to` (`deliver_to`),
  ADD KEY `delivered_by` (`delivered_by`);

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
-- AUTO_INCREMENT for table `AdditionnalPrice`
--
ALTER TABLE `AdditionnalPrice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `DeliveryType`
--
ALTER TABLE `DeliveryType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `DriversBill`
--
ALTER TABLE `DriversBill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Extra`
--
ALTER TABLE `Extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `FavoriteRelayPoint`
--
ALTER TABLE `FavoriteRelayPoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `OrderParcel`
--
ALTER TABLE `OrderParcel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Parcel`
--
ALTER TABLE `Parcel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ParcelExtra`
--
ALTER TABLE `ParcelExtra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ParcelStatus`
--
ALTER TABLE `ParcelStatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `RelayPoint`
--
ALTER TABLE `RelayPoint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `UserType`
--
ALTER TABLE `UserType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `WeightPrice`
--
ALTER TABLE `WeightPrice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `AdditionnalPrice`
--
ALTER TABLE `AdditionnalPrice`
  ADD CONSTRAINT `additionnalprice_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`id`);

--
-- Constraints for table `DriversBill`
--
ALTER TABLE `DriversBill`
  ADD CONSTRAINT `driversbill_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `FavoriteRelayPoint`
--
ALTER TABLE `FavoriteRelayPoint`
  ADD CONSTRAINT `favoriterelaypoint_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `favoriterelaypoint_ibfk_2` FOREIGN KEY (`relay_point_id`) REFERENCES `RelayPoint` (`id`);

--
-- Constraints for table `OrderParcel`
--
ALTER TABLE `OrderParcel`
  ADD CONSTRAINT `orderparcel_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`id`),
  ADD CONSTRAINT `orderparcel_ibfk_2` FOREIGN KEY (`parcel_id`) REFERENCES `Parcel` (`id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`departure_address`) REFERENCES `Address` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`arrival_address`) REFERENCES `Address` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`ordered_from`) REFERENCES `RelayPoint` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`ordered_by`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`deliver_to`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `orders_ibfk_6` FOREIGN KEY (`delivered_by`) REFERENCES `User` (`id`);

--
-- Constraints for table `Parcel`
--
ALTER TABLE `Parcel`
  ADD CONSTRAINT `parcel_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `ParcelStatus` (`id`),
  ADD CONSTRAINT `parcel_ibfk_2` FOREIGN KEY (`delivery_type`) REFERENCES `DeliveryType` (`id`);

--
-- Constraints for table `ParcelExtra`
--
ALTER TABLE `ParcelExtra`
  ADD CONSTRAINT `parcelextra_ibfk_1` FOREIGN KEY (`parcel_id`) REFERENCES `Parcel` (`id`),
  ADD CONSTRAINT `parcelextra_ibfk_2` FOREIGN KEY (`extra_id`) REFERENCES `Extra` (`id`);

--
-- Constraints for table `RelayPoint`
--
ALTER TABLE `RelayPoint`
  ADD CONSTRAINT `relaypoint_ibfk_1` FOREIGN KEY (`address`) REFERENCES `Address` (`id`),
  ADD CONSTRAINT `relaypoint_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `Remuneration`
--
ALTER TABLE `Remuneration`
  ADD CONSTRAINT `remuneration_ibfk_1` FOREIGN KEY (`relay_point_id`) REFERENCES `RelayPoint` (`id`);

--
-- Constraints for table `Stock`
--
ALTER TABLE `Stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`relay_point_id`) REFERENCES `RelayPoint` (`id`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`extra_id`) REFERENCES `Extra` (`id`);

--
-- Constraints for table `Tracking`
--
ALTER TABLE `Tracking`
  ADD CONSTRAINT `tracking_ibfk_1` FOREIGN KEY (`parcel_id`) REFERENCES `Parcel` (`id`),
  ADD CONSTRAINT `tracking_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `ParcelStatus` (`id`);

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `UserType` (`id`);
