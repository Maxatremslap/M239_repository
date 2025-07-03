-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2025 at 01:42 PM
-- Server version: 10.5.19-MariaDB-0+deb11u2
-- PHP Version: 8.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlaemmler_cart`
--
CREATE DATABASE IF NOT EXISTS `mlaemmler_cart` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mlaemmler_cart`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `session_id` varchar(128) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `session_id`, `product_id`, `product_name`, `price`, `quantity`, `created_at`) VALUES
(9, 'a9bfad486b5373c7d8d1a8a9883cf55b', 1, 'Lorem ipsum dolorsitamet.', '779.00', 1, '2025-05-05 12:08:38'),
(15, 'c803f556c98ecbfd94a7e086f3e87982', 1, 'Luxury Chair White', '479.00', 1, '2025-05-09 09:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `in_stock` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `in_stock`) VALUES
(1, 'Luxury Chair White', 'A sleek and refined chair with a plush seat, perfect for elegant interiors.', '479.00', 1),
(2, 'Relax Chair Pink', 'A cozy, ergonomically designed chair that provides ultimate relaxation.', '79.00', 1),
(3, 'Wooden Chair', 'A sturdy and timeless wooden chair crafted for comfort and durability.', '89.00', 1),
(4, 'Relax Couch Green', 'A soft, inviting couch with deep cushions, ideal for unwinding after a long day.', '779.00', 1),
(5, 'Luxury Couch Brown', 'A sophisticated brown couch with premium upholstery, adding a touch of class to any space.', '1229.00', 1),
(6, 'Wooden Shelf', 'Sturdy wooden shelf with multiple compartments for organization.', '179.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Database: `mlaemmler_users`
--
CREATE DATABASE IF NOT EXISTS `mlaemmler_users` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mlaemmler_users`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `email`, `google_id`, `profile_picture`) VALUES
(1, 'mlaemmler1', '$2y$12$ax0.KbUVdpbgNRsFkWLuHe/NS6947jhajUxmJOxf4wBrb/QRKPzYm', '2025-05-05 02:17:26', NULL, NULL, NULL),
(2, 'admin', '$2y$12$EBVRQpThE5Lp2lhjckHW3.sKs1p1KgAu1ZJL1W3RFHWXGUXK4lA7u', '2025-05-06 11:54:00', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `google_id` (`google_id`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
