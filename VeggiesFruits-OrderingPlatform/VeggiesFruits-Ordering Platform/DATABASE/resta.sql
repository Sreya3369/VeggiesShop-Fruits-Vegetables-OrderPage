-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 12:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `order` int(11) NOT NULL,
  `process` int(11) NOT NULL,
  `placed` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `quantity`, `price`, `order`, `process`, `placed`, `status`) VALUES
(126, '0', 1, 50, 0, 0, 0, ''),
(127, 'Banana', 4, 160, 0, 0, 0, ''),
(128, 'Cabbage', 25, 462.5, 0, 0, 0, ''),
(129, 'Capsicum', 1, 40, 0, 0, 0, ''),
(130, 'Carrot', 4, 102, 0, 0, 0, ''),
(131, 'Cauliflower', 13, 458.25, 0, 0, 0, ''),
(132, 'Mango', 3, 450, 0, 0, 0, ''),
(133, 'Onion', 4, 123, 0, 0, 0, ''),
(134, 'Potato', 2, 40, 0, 0, 0, ''),
(135, 'Pumpkin', 14, 308, 0, 0, 0, ''),
(136, 'Spinach', 4, 40, 0, 0, 0, ''),
(137, 'Tomato', 24, 360, 0, 0, 0, ''),
(138, 'Watermelon', 6, 300, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `fru`
--

CREATE TABLE `fru` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fru`
--

INSERT INTO `fru` (`id`, `name`, `price`) VALUES
(1, 'Apple', 100.5),
(2, 'Banana', 40),
(3, 'Orange', 60.75),
(4, 'Grapes', 80),
(5, 'Pineapple', 90),
(6, 'Mango', 150),
(7, 'Strawberry', 200),
(8, 'Watermelon', 50),
(9, 'Papaya', 45),
(10, 'Kiwi', 120);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `quantity`, `price`) VALUES
(1, '0', 1, 50),
(8, 'Banana', 4, 160),
(10, 'Cabbage', 25, 462.5),
(13, 'Capsicum', 1, 40),
(4, 'Carrot', 4, 102),
(11, 'Cauliflower', 13, 458.25),
(12, 'Mango', 3, 450),
(3, 'Onion', 4, 123),
(2, 'Potato', 2, 40),
(6, 'Pumpkin', 14, 308),
(9, 'Spinach', 4, 40),
(5, 'Tomato', 24, 360),
(7, 'Watermelon', 6, 300);

-- --------------------------------------------------------

--
-- Table structure for table `veg`
--

CREATE TABLE `veg` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `veg`
--

INSERT INTO `veg` (`id`, `name`, `price`) VALUES
(1, 'Carrot', 25.5),
(2, 'Potato', 20),
(3, 'Onion', 30.75),
(4, 'Tomato', 15),
(5, 'Cabbage', 18.5),
(6, 'Spinach', 10),
(7, 'Broccoli', 50),
(8, 'Cauliflower', 35.25),
(9, 'Capsicum', 40),
(10, 'Pumpkin', 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fru`
--
ALTER TABLE `fru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `veg`
--
ALTER TABLE `veg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `fru`
--
ALTER TABLE `fru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `veg`
--
ALTER TABLE `veg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
