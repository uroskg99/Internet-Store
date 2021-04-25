-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 01:12 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `profilepic` varchar(100) NOT NULL DEFAULT 'blank-profile-pic.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `email`, `password`, `role`, `profilepic`) VALUES
(1, 'Uros', 'Stanojkov', 'uros99', 'stanojkovu@gmail.com', '123456', 'admin', 'blank-profile-pic.png'),
(2, 'Aleksandar', 'Vucic', 'akiveliki', 'akiveliki@serbia.net', 'vucicuseceru', 'salesperson', 'blank-profile-pic.png'),
(3, 'Nemanja', 'Bogdanovic', 'nciric99', 'nciric44222@gmail.com', 'dubravka', 'customer', 'man2.jpg'),
(4, 'Jorgan', 'Hendikepovic', 'jorganxd', 'jorgan99@gmail.com', 'macka123', 'customer', 'Profilna.jpg'),
(6, 'Ljiljana', 'Matic', 'ljiljamatic99', 'ljiljamatic99@gmail.com', 'ljiljanamatic1', 'salesperson', 'woman.jpg'),
(7, 'Nina', 'Jankovic', 'nina11', 'nina@gmail.com', '1234567', 'salesperson', 'woman2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
