-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2021 at 09:05 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internet_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `type` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `currency` varchar(20) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `delievery` varchar(100) NOT NULL,
  `salesman` varchar(100) NOT NULL,
  `customer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `location`, `type`, `description`, `price`, `currency`, `quantity`, `delievery`, `salesman`, `customer`) VALUES
(1, 'Bicikla Capriolo', 'Kragujevac', 'Bicikli', 'Lepa bicikla', 100, 'euro', '1', 'Brza posta', '', ''),
(2, 'Samsung Televizor', 'Kraljevo', 'TV i Video', 'Full HD, 1920x1080, KAO NOV', 10000, 'din', '1', 'Uzivo po uzecu', '', ''),
(3, 'Samsung A8', 'Beograd', 'Mobilni telefoni', 'Perfektno ocuvan, bez ikakve ogrebotine, koriscen godinu dana.', 80, 'euro', '1', 'Postom', '', ''),
(4, 'Sir od koze 5kg', 'Zlatibor', 'Domaca hrana', '5kg kvalitetnog sira od koze. Vrhunski ukus', 3500, 'din', '1', 'Po uzecu', '', ''),
(5, 'Televizor TESLA full hd', 'Backa Palanka', 'TV i Video', 'Kao nov, neostecen televizor od 30 inca.', 140, 'euro', '1', 'Post-express', '', ''),
(6, 'Hummel dres za rukomet', 'Cacak', 'Sport', 'Nenosen dres jer je preveliki, velicina XL.', 1500, 'din', '1', 'Post-express', '', ''),
(7, 'Elektricni trotinet', 'Beograd', 'Elektronika', 'Vrlo mocan elektricni trotinet, jedan od najjacih po snazi. Brzina do 30km/h. Baterija traje do 3h', 400, 'euro', '1', 'Po uzecu', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
