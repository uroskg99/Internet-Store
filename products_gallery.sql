-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 01:10 AM
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
-- Table structure for table `products_gallery`
--

CREATE TABLE `products_gallery` (
  `id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_gallery`
--

INSERT INTO `products_gallery` (`id`, `product`, `picture`) VALUES
(1, 'Bicikla Capriolo', 'capriolo.jpg'),
(2, 'Samsung Televizor', 'samsung-tv.jpg'),
(3, 'Samsung Televizor', 'samsung-tv2.jpg'),
(4, 'Samsung A8', 'samsung-a8.jpg'),
(5, 'Sir od koze 5kg', 'sir-koza.jpg'),
(6, 'Televizor TESLA full hd', 'tesla-tv.jpg'),
(7, 'Hummel dres za rukomet', 'hummel-dres.jpg'),
(8, 'Elektricni trotinet', 'elek-trotinet.jpg'),
(11, 'Mercedes G Klasa', 'slika1.jpg'),
(12, 'Mercedes G Klasa', 'slika2.jpg'),
(15, 'Muzicka enciklopedija', 'me0.jpg'),
(16, 'Muzicka enciklopedija', 'me1.jpg'),
(17, 'Michael Kors MK5996 Kinley Original Zenski Sat', 'sat.jpg'),
(18, '2001 Volkswagen Golf 4 1.4', 'auto1.jpg'),
(19, 'Med', 'med.jpg'),
(20, 'Na prodaju muzjak Srpskog goni?a', 'pas.gif'),
(21, 'Tunika', 'tunika.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products_gallery`
--
ALTER TABLE `products_gallery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products_gallery`
--
ALTER TABLE `products_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
