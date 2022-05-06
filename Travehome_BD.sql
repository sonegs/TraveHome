-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 13, 2020 at 04:34 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `travehome`
--

-- --------------------------------------------------------

--
-- Table structure for table `Booking`
--

CREATE TABLE `Booking` (
  `ID` int(255) NOT NULL,
  `ID_housing` int(255) NOT NULL,
  `ID_traveller` int(255) NOT NULL,
  `ID_owner` int(255) NOT NULL,
  `Checkin` date NOT NULL,
  `Checkout` date NOT NULL,
  `State` varchar(10) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `Booking`
--

INSERT INTO `Booking` (`ID`, `ID_housing`, `ID_traveller`, `ID_owner`, `Checkin`, `Checkout`, `State`) VALUES
(20, 27, 1, 1, '2020-05-21', '2020-06-18', 'Pendiente'),
(21, 27, 1, 1, '2018-04-24', '2018-04-26', 'Rechazada'),
(22, 3, 1, 3, '2020-04-30', '2020-05-08', 'Expirada');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `ID` int(255) NOT NULL,
  `Content` varchar(1000) COLLATE utf8_spanish2_ci NOT NULL,
  `Assessment` int(1) NOT NULL,
  `ID_traveller` int(255) NOT NULL,
  `ID_housing` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`ID`, `Content`, `Assessment`, `ID_traveller`, `ID_housing`) VALUES
(7, 'Ha merecido la pena, el lugar es increible!', 4, 2, 3),
(36, 'Hemos estado genial, Pepe es muy amable y nos recomendó sitios que visitar. Además, nos invitó a paella. Volveremos sin duda!', 4, 1, 27);

-- --------------------------------------------------------

--
-- Table structure for table `Housing`
--

CREATE TABLE `Housing` (
  `ID` int(255) NOT NULL,
  `Name_home` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `Name_img` varchar(6000) COLLATE utf8_spanish2_ci NOT NULL,
  `Description` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `Address` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `PC` int(5) NOT NULL,
  `City` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Country` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `ID_owner` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `Housing`
--

INSERT INTO `Housing` (`ID`, `Name_home`, `Name_img`, `Description`, `Address`, `PC`, `City`, `Country`, `ID_owner`) VALUES
(3, 'Casa en Riofrio', '2020-03-26-10:51:38-3-casa montaña.jpg', 'Bonita casa a la orilla de Pedregalejo, playa en la zona Este en MálagaBonita casa a la orilla de Pedregalejo, playa en la zona Este en MálagaBonita casa a la orilla de Pedregalejo, playa en la zona Este en Málagaen MálagaBonita casa a la orilla de Pedregalejo, playa en la zona Este en Málagaaaaaaaa', 'Carril de los arroyos', 29560, 'Riofrio', 'España', 3),
(27, 'Afueras de Málaga', '2020-03-27-11:18:27-1-cortijo.jpg', 'Casa en las afueras de Málaga, cerca al Puerto de la Torre. Ideal para hacer noche en Málaga. Dos habitaciones, un baño y una cocina.', 'Carril de la Amistad 4', 29006, 'MÁLAGA', 'España', 1),
(30, 'Puerto de la torre ', '2020-03-27-11:18:27-1-cortijo.jpg', 'Casa en las afueras de Málaga, cerca al Puerto de la Torre. Ideal para hacer noche en Málaga. Dos habitaciones, un baño y una cocina.', 'Calle Mauricio Moro Pareto', 29006, 'MÁLAGA', 'España', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Owners`
--

CREATE TABLE `Owners` (
  `ID` int(255) NOT NULL,
  `Name` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Surname` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `DNI_owner` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `Address` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `PC` int(5) NOT NULL,
  `City` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Country` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `Email` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Phone` varchar(12) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `Owners`
--

INSERT INTO `Owners` (`ID`, `Name`, `Surname`, `DNI_owner`, `Address`, `PC`, `City`, `Country`, `Email`, `Password`, `Phone`) VALUES
(1, 'admino', 'admino', '12345678B', 'Calle Franz Kafka 13', 29006, 'MÁLAGA', 'España', 'admino@admin.com', '$2y$10$4uZbI8KWWl13PX3zka5uUuGsT7v0ky1ziBuUA7w0yaCEtDKyjb5qC', '952331972'),
(3, 'Antonio', 'Castillo Román', '98798765G', 'Calle Mármoles 8 1 4', 29006, 'MÁLAGA', 'España', 'owner@gmail.com', '$2y$10$kMI7YGrwocSA1y2Vz73VSeuXQo1jxELdb6yOZuC8VqlzDsbpdKknm', '952331972');

-- --------------------------------------------------------

--
-- Table structure for table `Travellers`
--

CREATE TABLE `Travellers` (
  `ID` int(255) NOT NULL,
  `Name` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Surname` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `DNI_traveller` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `Address` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `PC` int(5) NOT NULL,
  `City` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `Country` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `Email` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `Phone` varchar(12) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `Travellers`
--

INSERT INTO `Travellers` (`ID`, `Name`, `Surname`, `DNI_traveller`, `Address`, `PC`, `City`, `Country`, `Email`, `Password`, `Phone`) VALUES
(1, 'admint', 'admint', '77370884B', 'Avenida Gregorio Prieto 4', 29006, 'MÁLAGA', 'España', 'admint@admin.com', '$2y$10$t6MYYnALV05LmAohVdy6GOTm/1iLDnCGRXwwPLDdJd/EQQjhIQjhe', '606603404'),
(2, 'Juan', 'Castro Lopez', '12312345B', 'Calle Mauricio Moro Pareto 17', 29006, 'MÁLAGA', 'España', 'travel@gmail.com', '$2y$10$AhzQ60RTOuA7DcxI1s7XMOtC.oerPwV6PmqQ4BjHYYOlwUoO2bBaO', '606605543'),
(11, 'Miguel', 'Cobo', '54989874G', 'Calle Carril 5', 29006, 'MÁLAGA', 'España', 'angel@gmail.com', '$2y$10$aHdjK/vaNxeHcD6n/rgpWOaZclpJoBC0P3NA56HSGiAMU/e5t66zK', '1234'),
(14, 'Miguel', 'Cobo', '87687659L', 'Avenida de los Tilos 14 5 K', 29006, 'MÁLAGA', 'España', 'asasdasdadaa@asda.agfd', '$2y$10$lCiYJ7gMJF4qBNGrHoXLg.xIEyy5gzkPbegKsLeXcOO2zSAarQr66', '952331972');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Booking`
--
ALTER TABLE `Booking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_housing` (`ID_housing`,`ID_traveller`,`ID_owner`),
  ADD KEY `ID_owner` (`ID_owner`),
  ADD KEY `ID_traveller` (`ID_traveller`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_traveller` (`ID_traveller`),
  ADD KEY `ID_housing` (`ID_housing`);

--
-- Indexes for table `Housing`
--
ALTER TABLE `Housing`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_owner` (`ID_owner`);
ALTER TABLE `Housing` ADD FULLTEXT KEY `Name_home` (`Name_home`);
ALTER TABLE `Housing` ADD FULLTEXT KEY `City` (`City`);
ALTER TABLE `Housing` ADD FULLTEXT KEY `Country` (`Country`);

--
-- Indexes for table `Owners`
--
ALTER TABLE `Owners`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `DNI_traveller` (`DNI_owner`);

--
-- Indexes for table `Travellers`
--
ALTER TABLE `Travellers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `DNI_traveller` (`DNI_traveller`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Booking`
--
ALTER TABLE `Booking`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `Housing`
--
ALTER TABLE `Housing`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Owners`
--
ALTER TABLE `Owners`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Travellers`
--
ALTER TABLE `Travellers`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Booking`
--
ALTER TABLE `Booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`ID_owner`) REFERENCES `Owners` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`ID_housing`) REFERENCES `Housing` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`ID_traveller`) REFERENCES `Travellers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ID_traveller`) REFERENCES `Travellers` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`ID_housing`) REFERENCES `Housing` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Housing`
--
ALTER TABLE `Housing`
  ADD CONSTRAINT `housing_ibfk_1` FOREIGN KEY (`ID_owner`) REFERENCES `Owners` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
