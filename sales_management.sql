-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 05, 2019 at 01:24 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `amount` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `expire_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `title`, `amount`, `product_id`, `expire_date`, `created_at`) VALUES
(1, 'qw', 1, 1, '2019-10-06 18:00:00', '2019-10-22 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_06_30_134107_create_sales_table', 1),
(4, '2019_07_26_094125_create_admins_table', 2),
(5, '2019_09_17_123851_notice', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
CREATE TABLE IF NOT EXISTS `notice` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expdate` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `link`) VALUES
(1, 'Add A Sale', 'sales');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles_data`
--

DROP TABLE IF EXISTS `roles_data`;
CREATE TABLE IF NOT EXISTS `roles_data` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `role_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_desc_formal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_data`
--

INSERT INTO `roles_data` (`id`, `role_id`, `role_description`, `role_desc_formal`) VALUES
(1, 1, 'super_admin', 'Super Admin'),
(2, 2, 'sub_admin', 'Assistant Admin'),
(3, 3, 'user', 'Salesman');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `available` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `name`, `quantity`, `available`, `created_at`, `updated_at`) VALUES
(1, 'HP 22ES 22 Inch LED Monitor', 10, 5, '2019-06-19 04:50:05', '2019-08-23 03:19:57'),
(16, 'Saimum Complete Web Security Suite v1.3', 10, 5, '2019-07-26 04:53:18', '2019-07-27 06:28:38'),
(7, 'WinMac Classic Keyboard', 10, 0, '2019-07-12 05:05:55', '2019-08-23 03:24:23'),
(9, 'Saimum Mobile Antivirus Suite v1.5', 10, 8, '2019-07-12 05:07:34', '2019-07-26 06:22:03'),
(5, 'A4Tech Gaming Keyboard', 10, 7, '2019-07-12 05:04:49', '2019-07-19 05:15:18'),
(19, 'Micropack M1 Optical Mouse', 20, 0, '2019-07-27 06:30:27', '2019-08-23 03:20:24'),
(18, 'Dell E2190 19\' Monitor', 10, 5, '2019-07-27 06:25:51', '2019-07-27 06:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `sold`
--

DROP TABLE IF EXISTS `sold`;
CREATE TABLE IF NOT EXISTS `sold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sold`
--

INSERT INTO `sold` (`id`, `name`, `quantity`, `created_at`, `updated_at`) VALUES
(36, 'A4Tech Gaming Keyboard', 3, '2019-07-19 11:15:18', '2019-07-19 11:15:18'),
(35, 'Denis Ritchies Teach Yourself C', 3, '2019-07-19 11:14:53', '2019-07-19 11:14:53'),
(33, 'WinMac Classic Keyboard', 2, '2019-07-19 11:14:33', '2019-07-19 11:14:33'),
(34, 'HP 22ES 22 Inch LED Monitor', 9, '2019-07-19 11:14:45', '2019-07-19 11:14:45'),
(32, 'WinMac Classic Keyboard', 1, '2019-07-19 11:14:20', '2019-07-19 11:14:20'),
(31, 'Saimum Mobile Antivirus Suite', 9, '2019-07-19 11:14:09', '2019-07-19 11:14:09'),
(30, 'Denis Ritchies Teach Yourself C', 7, '2019-07-19 11:13:14', '2019-07-19 11:13:14'),
(29, 'Denis Ritchies Teach Yourself C', 3, '2019-07-19 11:13:04', '2019-07-19 11:13:04'),
(38, 'Saimum Mobile Antivirus Suite v1.5', 5, '2019-07-26 12:21:04', '2019-07-26 12:21:04'),
(37, 'HP 22ES 22 Inch LED Monitor', 5, '2019-07-26 11:57:12', '2019-07-26 11:57:12'),
(41, 'Dell E2190 19\' Monitor', 5, '2019-07-27 12:26:32', '2019-07-27 12:26:32'),
(40, 'HP 22ES 22 Inch LED Monitor', 5, '2019-07-26 12:22:38', '2019-07-26 12:22:38'),
(42, 'Saimum Complete Web Security Suite v1.3', 9, '2019-07-27 12:28:19', '2019-07-27 12:28:19'),
(43, 'Saimum Complete Web Security Suite v1.3', 5, '2019-07-27 12:28:38', '2019-07-27 12:28:38'),
(44, 'Micropack M1 Optical Mouse', 19, '2019-07-27 12:32:40', '2019-07-27 12:32:40'),
(47, 'HP 22ES 22 Inch LED Monitor', 1, '2019-08-23 09:19:57', '2019-08-23 09:19:57'),
(48, 'Micropack M1 Optical Mouse', 1, '2019-08-23 09:20:24', '2019-08-23 09:20:24'),
(49, 'WinMac Classic Keyboard', 8, '2019-08-23 09:24:23', '2019-08-23 09:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fariaz Khan', 'fariaz@sm.com', 1, '5d7b6e8e95a60.jpg', NULL, '$2y$10$IRSJF1DNq7w/fggQgz8SiuxSY0xzLL0I8TbjnN6JA.n..xTdUk.82', '3lf8ZDFWaut7XQn9ZLdfSqBDbuXDxwUZrXVBC820LeWxXYZVCzlBfM8o0EXI', '2019-07-19 05:55:41', '2019-09-17 06:26:03'),
(3, 'Shams', 'shams@sm.com', 2, '5d7b6b75ecd5a.jpg', NULL, '$2y$10$JsQ2bX5Fq5rqYxgmcq9EPumY.2.5dJi48qPqlqdaA8qANObogfN9C', 'pm33LLviCXAWSde80IcjaoxKA65tzpBkQrKSjWToCvGCaymRs5LrZn6DQuee', '2019-07-19 05:55:41', '2019-09-17 06:11:28'),
(4, 'Abdur Rahman', 'abdur.rahman@sm.com', 3, '5d72213ee553c.jpg', NULL, '$2y$12$5XhrKcQgB8lwTtl9SXDqm.u16BiN4memzNu/rDkJoWW.a0osEo6n6', NULL, '2019-09-06 02:43:47', '2019-09-06 03:05:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
