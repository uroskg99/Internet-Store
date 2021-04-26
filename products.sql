-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 10:22 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

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
  `customer` varchar(100) NOT NULL,
  `sold` varchar(100) NOT NULL,
  `delievered` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `location`, `type`, `description`, `price`, `currency`, `quantity`, `delievery`, `salesman`, `customer`, `sold`, `delievered`) VALUES
(1, 'Bicikla Capriolo', 'Kragujevac', 'Bicikli', 'Lepa bicikla', 100, 'din', '1', '', 'akiveliki', '', '', ''),
(2, 'Samsung Televizor', 'Kraljevo', 'TV i Video', 'Full HD, 1920x1080, KAO NOV', 10000, 'din', '1', '', 'akiveliki', '', '', ''),
(3, 'Samsung A8', 'Beograd', 'Mobilni telefoni', 'Perfektno ocuvan, bez ikakve ogrebotine, koriscen godinu dana.', 80, 'din', '1', '', 'akiveliki', '', '', ''),
(4, 'Sir od koze 5kg', 'Zlatibor', 'Domaca hrana', '5kg kvalitetnog sira od koze. Vrhunski ukus', 3500, 'din', '1', '', 'akiveliki', '', '', ''),
(5, 'Televizor TESLA full hd', 'Backa Palanka', 'TV i Video', 'Kao nov, neostecen televizor od 30 inca.', 140, 'din', '1', '', 'akiveliki', '', 'yes', 'yes'),
(6, 'Hummel dres za rukomet', 'Cacak', 'Sport', 'Nenosen dres jer je preveliki, velicina XL.', 1500, 'din', '1', 'Po uzeÄ‡u', 'akiveliki', 'Å¾arko', '', ''),
(7, 'Elektricni trotinet', 'Beograd', 'Elektronika', 'Vrlo mocan elektricni trotinet, jedan od najjacih po snazi. Brzina do 30km/h. Baterija traje do 3h', 400, 'din', '1', 'Online', 'akiveliki', '', 'yes', 'yes'),
(9, 'Mercedes G Klasa', 'Beograd', 'Automobili', 'Nova G klasa. Tamno sive boje, povoljna cena, 2019. godiste, presao 1000km.', 12000000, 'din', '1', 'Po uzeÄ‡u', 'akiveliki', '', 'yes', 'yes'),
(11, 'Muzicka enciklopedija', 'Jagodina', 'Knjige', 'MUZICKA ENCIKLOPEDIJA \r\n1. A-J \r\n2. K-Z\r\nIzdanje: JUGOSLOVENSKOG LEKSIKOGRAFSKOG ZAVODA \r\nZAGREB 1963. \r\nStanje: Odlicno! Ocuvane u providnom, zastitnom omotu (videti slike).', 3500, 'din', '1', '', 'akiveliki', '', '', ''),
(12, 'Michael Kors MK5996 Kinley Original Zenski Sat', 'Beograd', 'Nakit, satovi', 'Sat je nov, original i dolazi u kompletnom, original pakovanju.  \r\nSvaki vid provere originalnosti sata je moguc. \r\n\r\nGarancija na mehanizam godinu dana. \r\n\r\nKod sata: MK5996', 18000, 'din', '1', '', 'ljiljamatic99', '', '', ''),
(13, '2001 Volkswagen Golf 4 1.4', 'Kraljevo', 'Automobili', 'Automobil je u odlicnom stanju, odrzavan, sa manjim ostecenjima. Registrovan do avgusta. Stavljen novi auspuh i promenjeni diskovi i plocice, novi amortizeri i solje. Servisna knjizica, prava kilometr', 240000, 'din', '1', '', 'ljiljamatic99', '', '', ''),
(14, 'Med', 'Novi Sad', 'Domaća hrana', 'Livadski med, kombinacija glog, bagrem, lipa, livada, dakle jedno vrcanje. Sa 620 metara nadmorske visine. Nema zaga?iva?a u okolini, potpuno prirodno. Još 70 kg u ponudi. \r\nDostava u Nišu po dogovoru', 800, 'din', '1', '', 'ljiljamatic99', '', '', ''),
(16, 'Tunika', 'Negotin', 'Odeća', 'Prodajem tuniku koja se može koristiti i kao tunika za plažu. Odgovara i lepo stoji svim velicinama.  ', 500, 'din', '1', 'Po uze?u', 'nina11', '', 'yes', 'yes'),
(17, 'Majica', 'Kikinda', 'Odeća', 'Ocuvana, velicina XS', 200, 'din', '1', '', 'akiveliki', '', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
