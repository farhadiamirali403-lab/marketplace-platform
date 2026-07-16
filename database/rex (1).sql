-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2026 at 09:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rex`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_persian_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_persian_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success` tinyint(1) DEFAULT 0,
  `attempt_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `username`, `ip_address`, `user_agent`, `success`, `attempt_time`) VALUES
(1, 'aliasgharsheykhzadeh@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 0, '2026-07-13 20:58:46'),
(2, 'jeysonreal66@gmail.com', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 0, '2026-07-13 20:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_persian_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'متفرقه',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount_price` decimal(15,2) DEFAULT 0.00,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `category`, `description`, `price`, `discount_price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'سروش', 'آموزشی', 'خیلی خوب کار میکند (مزارع پنبه)', '10000.00', '100000.00', '1784140909_6a57d46d0c84f.png', 1, '2026-07-15 18:41:49', '2026-07-15 18:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_persian_ci DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `status` tinyint(1) DEFAULT 1,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg',
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `registered_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `phone`, `password`, `role`, `status`, `avatar`, `ip_address`, `remember_token`, `token_expiry`, `last_login`, `registered_at`, `created_at`, `updated_at`) VALUES
(1, 'علی اصغر شیخ زاده', 'aliasghar13888', 'jeysonreal66@gmail.com', '09307105825', '$2y$12$P1THlHMyFi4rjugLrxwqa.6rqQUcK0LN.8KcpqaR/gpibLCbDORR6', 'user', 1, 'default.jpg', '127.0.0.1', NULL, NULL, NULL, '2026-07-13 20:58:10', '2026-07-13 17:28:10', '2026-07-13 17:28:10'),
(2, 'سینا رضایی', 'sinax', 'sinarezayyi@gmail.com', '09357105826', '$2y$12$EDM3XgAOhBEMmQ8dMi57meUkV8KLajlORAeOD/Fn73nxymhjRpsFW', 'user', 1, 'default.jpg', '127.0.0.1', NULL, NULL, NULL, '2026-07-13 21:14:17', '2026-07-13 17:44:17', '2026-07-13 17:44:17'),
(3, 'aliasgharsheykhzadeh', 'aliasghar138888', 'aliasgharsheykhzadeh@gmail.com', '09307105382', '$2y$12$nX67jPbni9/zWrDylt/INupDlzSX6qpHZ8f/pGn2JxSq657/6YEOG', 'user', 1, 'default.jpg', '127.0.0.1', NULL, NULL, '2026-07-13 21:18:23', '2026-07-13 21:17:17', '2026-07-13 17:47:17', '2026-07-13 17:48:23'),
(4, 'علی اصغر شیخ زاده', 'alialiali13888', 'aliasghar18ali88@gmail.com', '09144209273', '$2y$12$QnO4vg1iSx6gjj2kD0.ay.yf4FcS0F2aqnY/uRNAjYwFkanuaYYL.', 'user', 1, 'default.jpg', '127.0.0.1', NULL, NULL, NULL, '2026-07-14 19:47:09', '2026-07-14 16:17:09', '2026-07-14 16:17:09'),
(5, 'علی اصغر شیخ زاده', '8alialiali13888', 'aliasghar@gmail.com', '09307105829', '$2y$12$SoQKmq.SRMIVDlbdVkUtrOxyFYDeWuBJ1FUn2E/kcuH0XVdtmT1bq', 'admin', 1, 'default.jpg', '127.0.0.1', '5870da93cbe5f84772fed7947b6dac47d63384c5b35d681f6d6c4978547bcf0b', '2026-08-14 19:58:31', '2026-07-15 21:39:04', '2026-07-14 19:49:33', '2026-07-14 16:19:33', '2026-07-15 18:09:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_ip` (`ip_address`),
  ADD KEY `idx_time` (`attempt_time`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
