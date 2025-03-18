-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2025 at 06:54 AM
-- Server version: 8.0.41-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `callapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `jwttokens`
--

CREATE TABLE `jwttokens` (
  `id` int NOT NULL,
  `token` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jwttokens`
--

INSERT INTO `jwttokens` (`id`, `token`, `createdat`) VALUES
(194, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhcHBsaWNhdGlvbl9pZCI6IjUwYzg3YjZmLTkwZTAtNDliNi1iNWRmLWQ3ZjAwZTU5NTBmYSIsImlhdCI6MTczOTA0MjY5MiwiZXhwIjoxNzM5MDQ0NDkyLCJqdGkiOiI2N2E3YWY4NGFhYjEyIn0.mIHROfOJk-2LW14mmwJTIgkMyYma9Wbbj-4eykVyaDLvLhyTWpKOA5KZg_F9sZ9LiI4pQIpJ8tAXpmgJxyKzDBiUIWLYWb3osqAJE-RAUkOHF8ockrXEv-krBxl68uE96lO_N8U02eZkQdlsv4USIoOox-mKYEy-swA5I38LJ3y9bBH1pAzq7XlTcD-Kv4IbQMZiAbqH_M8Jf2RMpjJ6jquvnEAHXUrBxzqQBFpRQOdb4eEGjY3bP3nRgkx-ZcLJ163HwBUe7-YA3WhGEFxu9_S9qPzDe0IdFA9Kx0gbHCkAU68d2iD-cengahSOyDyCzVHV5KL5ZnsOiL4aiG1Uiw', '2025-02-08 19:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(225) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `mobile`, `email`, `password`) VALUES
(1, 'testing name', '919875498754', 'testing@gmail.com', '$2y$10$QEKLsrfYTQTcMheMrLdboOWJ43HFS9sW6IsY1oOlOPRxGxvBkk5hm'),
(7, 'testing', '918630309213', 'testingmoulik@gmail.com', '$2y$10$4zxWfyWItm1GEGgGRv2ZAu4wXcVYAfkgzVejfnlFgffxkcCjwU9DK'),
(8, 'james', '3054344628', 'james2927@gmail.com', '$2y$10$BK.pqMzU39clyeVXpeRjzeubMbPWoeH2SM7dVgKDsJnXul88yscH6'),
(9, 'craig karlis', '2623259611', 'karlisc08@gmail.com', '$2y$10$LlHKuc6GJMH/ggH/B76hSeFarD10tHuEFDVPL/3AYJuv6jJJIY39m'),
(10, 'testing team', '9875698756', 'test@gmail.com', '$2y$10$kzGViZ97ywKIOKxuiDTPR.TOPnOZAPA75Bwxy5nCoy1sskUUabE0K'),
(11, 'Ernest Hernandez', '4086098144', 'geethapp01@gmail.com', '$2y$10$Z6Vn26CcSes/tYZia6lfU.4oTRXRczjLLpHD618vlRKXbBsfFxg9u'),
(12, 'test', '1234567890', 'test', '$2y$10$yJZ3Wm.UuqSQ/m/a.DPSWuJ2unNYHNxXqjUQHMt1iMwk/P8I96qkG'),
(13, 'q', 'q', 'q', '$2y$10$loQs/hoedNsAFofjuK7N3Oxj7ab02ziSAFVSJKNWV9.CSkn7Tq8KC'),
(14, 'c', 'c', 'c', '$2y$10$kUhgfBA6TcU8ysD7aI2J/Oodz3iFndQ9MA/jFxGQfdq1eHqH.KN9m'),
(15, '1', '1', '1', '$2y$10$lxW4HPhGR7u4mRade9Y8aeTQn0K21n4TO8vxziO98Mun0cPuZYdM2'),
(16, 'Ernest', '11122344', 'Ernest', '$2y$10$BAaUFI3wImGMxBFM1k0LUuow9kQX0EVC8oV2XbvsXrU1uW/UvZtCu'),
(17, 'Ernest', '1234123455', 'Ernest@', '$2y$10$DViz1icj/.0i2bd6SwktOuYPYVawWKO996c.vmWyoVzAoD2UUwS56'),
(18, 'Ernest', '4086912290', 'Ernest@gmail.com', '$2y$10$FhldZuugvbOQz7mNK9D69eF2TGX.fKJMSa9vxzSDnNbO43shAWVoG'),
(19, 'karen karlis', '239 313 0659', 'karenkarlis1@gmail.com', '$2y$10$/XLjB4Z7NeA6swoCINBoLOWU40IqRJZQeyqAeomzL1pxXoUdOCJfi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jwttokens`
--
ALTER TABLE `jwttokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `username` (`mobile`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jwttokens`
--
ALTER TABLE `jwttokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
