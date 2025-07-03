-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2025 at 12:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `first_project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory_in`
--

CREATE TABLE `inventory_in` (
  `id` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `toner_model` varchar(255) NOT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_in`
--

INSERT INTO `inventory_in` (`id`, `supplier`, `department`, `toner_model`, `quantity`) VALUES
(16, 'INKRITE', 'Admin', 'CF2266X', 0),
(17, 'INKRITE', 'Finance and Accounting', 'CF2266X', 0),
(18, 'INKRITE', 'Parts Counter', 'CF2266X', 2),
(19, 'CANON', 'Sales (Financing)', 'CEXVM', 6),
(20, 'CANON', 'Sales (Financing)', 'CEXVC', 6),
(21, 'CANON', 'Sales (Financing)', 'CEXVBK', 5),
(22, 'CANON', 'Sales (Financing)', 'CEXVBC', 5),
(23, 'CANON', 'Sales (MP)', 'NPG90', 2),
(24, 'ERBM', 'Sales Admin', 'CF2266X', 4),
(25, 'INKRITE', 'Finance and Accounting', 'CF2266X', 0),
(26, 'INKRITE', 'Finance and Accounting', 'CF2266X', 0),
(27, 'INKRITE', 'Admin', 'CF2266X', 0),
(31, 'INKRITE', 'Tool Room', 'CC388X', 3),
(32, 'INKRITE', 'Tsure', 'CF2266X', 4),
(33, 'CANON', 'Service', 'NPG90', 6),
(34, 'INKRITE', 'Parts Counter', 'CF2266X', 6),
(35, 'INKRITE', 'Sales Training', 'CF2266X', 5),
(36, 'INKRITE', 'Parts Warehouse', 'CF2266X', 5),
(37, 'ERBM', 'Finance and Accounting', 'CF2266X', 6),
(38, 'CANON', 'Finance and Accounting', 'NPG90', 7),
(39, 'INKRITE', 'Admin', 'CF2266X', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_out`
--

CREATE TABLE `inventory_out` (
  `id` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `toner_model` varchar(255) NOT NULL,
  `used_quantity` int(3) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_out`
--

INSERT INTO `inventory_out` (`id`, `supplier`, `department`, `toner_model`, `used_quantity`, `date_added`) VALUES
(3, 'CANON', 'Sales (Financing)', 'CEXVM', 2, '2025-07-03'),
(4, 'CANON', 'Sales (Financing)', 'CEXVC', 2, '2025-07-03'),
(5, 'CANON', 'Sales (Financing)', 'CEXVBK', 2, '2025-07-03'),
(6, 'CANON', 'Sales (Financing)', 'CEXVBC', 2, '2025-07-03'),
(7, 'INKRITE', 'Admin', 'CF2266X', 1, '2025-06-29'),
(8, 'INKRITE', 'Parts Counter', 'CF2266X', 2, '2025-08-01'),
(9, 'INKRITE', 'Finance and Accounting', 'CF2266X', 2, '2025-07-03'),
(10, 'INKRITE', 'Admin', 'CF2266X', 2, '2025-07-03'),
(11, 'INKRITE', 'Admin', 'CF2266X', 2, '2025-07-03'),
(12, 'INKRITE', 'Admin', 'CF2266X', 1, '2025-07-03'),
(13, 'INKRITE', 'Admin', 'CF2266X', 1, '2025-07-03'),
(14, 'INKRITE', 'Admin', 'CF2266X', 2, '2025-07-03'),
(15, 'INKRITE', 'Admin', 'CF2266X', 2, '2025-07-03'),
(16, 'INKRITE', 'Finance and Accounting', 'CF2266X', 1, '2025-07-03'),
(17, 'INKRITE', 'Admin', 'CF2266X', 4, '2025-07-03'),
(18, 'INKRITE', 'Admin', 'CF2266X', 1, '2025-07-03'),
(19, 'INKRITE', 'Admin', 'CF2266X', 1, '2025-07-03'),
(20, 'INKRITE', 'Tool Room', 'CC388X', 2, '2025-07-03'),
(21, 'INKRITE', 'Tsure', 'CF2266X', 2, '2025-07-03'),
(22, 'CANON', 'Service', 'NPG90', 1, '2025-07-03'),
(23, 'INKRITE', 'Parts Counter', 'CF2266X', 3, '2025-07-03'),
(26, 'INKRITE', 'Finance and Accounting', 'CF2266X', 2, '2025-07-03'),
(27, 'INKRITE', 'Finance and Accounting', 'CF2266X', 5, '2025-07-03'),
(28, 'INKRITE', 'Finance and Accounting', 'CF2266X', 2, '2025-07-03'),
(29, 'INKRITE', 'Admin', 'CF2266X', 5, '2025-07-04');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_request`
--

CREATE TABLE `inventory_request` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `quantity` int(3) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  `toner_model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_request`
--

INSERT INTO `inventory_request` (`id`, `full_name`, `supplier`, `department`, `quantity`, `date_added`, `toner_model`) VALUES
(24, 'Louie Mariano', 'CANON', 'Sales (Financing)', 2, '2025-07-03', 'CEXVM'),
(25, 'Louie Mariano', 'CANON', 'Sales (Financing)', 2, '2025-07-03', 'CEXVC'),
(26, 'Louie Mariano', 'CANON', 'Sales (Financing)', 2, '2025-07-03', 'CEXVBK'),
(27, 'Louie Mariano', 'CANON', 'Sales (Financing)', 2, '2025-07-03', 'CEXVBC'),
(28, 'Christian Mariano', 'INKRITE', 'Admin', 1, '2025-06-29', 'CF2266X'),
(29, 'CH Mariano', 'INKRITE', 'Parts Counter', 2, '2025-08-01', 'CF2266X'),
(30, 'Louie Mariano', 'INKRITE', 'Finance and Accounting', 2, '2025-07-03', 'CF2266X'),
(31, 'Christian Mariano', 'INKRITE', 'Admin', 2, '2025-07-03', 'CF2266X'),
(32, 'Louie Mariano', 'INKRITE', 'Admin', 2, '2025-07-03', 'CF2266X'),
(33, 'CH Mariano', 'INKRITE', 'Admin', 1, '2025-07-03', 'CF2266X'),
(34, '2', 'INKRITE', 'Admin', 1, '2025-07-03', 'CF2266X'),
(35, 'Louie Mariano', 'INKRITE', 'Admin', 2, '2025-07-03', 'CF2266X'),
(36, 'Christian Mariano', 'INKRITE', 'Admin', 2, '2025-07-03', 'CF2266X'),
(37, 'Louie Mariano', 'INKRITE', 'Finance and Accounting', 1, '2025-07-03', 'CF2266X'),
(38, 'Christian Mariano', 'INKRITE', 'Admin', 4, '2025-07-03', 'CF2266X'),
(39, 'Louie Mariano', 'INKRITE', 'Admin', 1, '2025-07-03', 'CF2266X'),
(40, 'Christian Mariano', 'INKRITE', 'Admin', 1, '2025-07-03', 'CF2266X'),
(41, 'Christian Mariano', 'INKRITE', 'Tool Room', 2, '2025-07-03', 'CC388X'),
(42, 'Louie Mariano', 'INKRITE', 'Tsure', 2, '2025-07-03', 'CF2266X'),
(43, 'Louie Mariano', 'CANON', 'Service', 1, '2025-07-03', 'NPG90'),
(44, 'CH Mariano', 'INKRITE', 'Parts Counter', 3, '2025-07-03', 'CF2266X');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transaction`
--

CREATE TABLE `inventory_transaction` (
  `id` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `toner_model` varchar(255) NOT NULL,
  `quantity` int(2) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_transaction`
--

INSERT INTO `inventory_transaction` (`id`, `supplier`, `department`, `toner_model`, `quantity`, `date_added`) VALUES
(20, 'INKRITE', 'Admin', 'CF2266X', 4, '2025-07-01'),
(21, 'INKRITE', 'Finance and Accounting', 'CF2266X', 5, '2025-07-01'),
(22, 'INKRITE', 'Parts Counter', 'CF2266X', 7, '2025-07-01'),
(23, 'CANON', 'Sales (Financing)', 'CEXVM', 8, '2025-06-29'),
(24, 'CANON', 'Sales (Financing)', 'CEXVC', 8, '2025-06-29'),
(25, 'CANON', 'Sales (Financing)', 'CEXVBK', 7, '2025-06-29'),
(26, 'CANON', 'Sales (Financing)', 'CEXVBC', 7, '2025-06-29'),
(27, 'CANON', 'Sales (MP)', 'NPG90', 2, '2025-07-02'),
(28, 'ERBM', 'Sales Admin', 'CF2266X', 4, '2025-07-02'),
(29, 'INKRITE', 'Finance and Accounting', 'CF2266X', 5, '2025-07-03'),
(30, 'INKRITE', 'Finance and Accounting', 'CF2266X', 2, '2025-07-03'),
(31, 'INKRITE', 'Admin', 'CF2266X', 5, '2025-07-03'),
(35, 'INKRITE', 'Tool Room', 'CC388X', 5, '2025-07-03'),
(36, 'INKRITE', 'Tsure', 'CF2266X', 6, '2025-07-03'),
(37, 'CANON', 'Service', 'NPG90', 7, '2025-07-03'),
(38, 'INKRITE', 'Parts Counter', 'CF2266X', 6, '2025-07-03'),
(39, 'INKRITE', 'Sales Training', 'CF2266X', 5, '2025-07-03'),
(40, 'INKRITE', 'Parts Warehouse', 'CF2266X', 5, '2025-07-03'),
(41, 'ERBM', 'Finance and Accounting', 'CF2266X', 6, '2025-07-03'),
(42, 'CANON', 'Finance and Accounting', 'NPG90', 7, '2025-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `usertype` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `birthday`, `usertype`, `status`, `username`) VALUES
(1, 'Admin, Firstname MI.', 'Admin123@gmail.com', '$2y$10$DVjnLK6PeJT8FSl3zFL0eOuWuGNPXI.tGx29fRrXVygseln3eaCri', '0000-00-00', 'admin', 'enabled', 'admin123'),
(25, 'John wick', '', '$2y$10$nBNfxfUasvd1uRozzDxDO.8fMNKt1Pm3Q3SHsTPsDy83kRNIMllzq', NULL, 'admin', 'enabled', 'John123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory_in`
--
ALTER TABLE `inventory_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_out`
--
ALTER TABLE `inventory_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_request`
--
ALTER TABLE `inventory_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_transaction`
--
ALTER TABLE `inventory_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory_in`
--
ALTER TABLE `inventory_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `inventory_out`
--
ALTER TABLE `inventory_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `inventory_request`
--
ALTER TABLE `inventory_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `inventory_transaction`
--
ALTER TABLE `inventory_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
