-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 24, 2025 at 06:14 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afsar`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1758737014;', 1758737014),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1758737014),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:5:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:8:\"group_id\";s:1:\"c\";s:4:\"name\";s:1:\"d\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:38:{i:0;a:5:{s:1:\"a\";i:1;s:1:\"b\";i:1;s:1:\"c\";s:15:\"View Permission\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:1;a:5:{s:1:\"a\";i:2;s:1:\"b\";i:1;s:1:\"c\";s:17:\"Create Permission\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:5:{s:1:\"a\";i:3;s:1:\"b\";i:1;s:1:\"c\";s:15:\"Edit Permission\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:5:{s:1:\"a\";i:4;s:1:\"b\";i:1;s:1:\"c\";s:17:\"Delete Permission\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:5:{s:1:\"a\";i:5;s:1:\"b\";i:2;s:1:\"c\";s:10:\"View Roles\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:5;a:5:{s:1:\"a\";i:6;s:1:\"b\";i:2;s:1:\"c\";s:11:\"Create Role\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:5:{s:1:\"a\";i:7;s:1:\"b\";i:2;s:1:\"c\";s:9:\"Edit Role\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:5:{s:1:\"a\";i:8;s:1:\"b\";i:2;s:1:\"c\";s:11:\"Delete Role\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:5:{s:1:\"a\";i:9;s:1:\"b\";i:2;s:1:\"c\";s:18:\"Assign Permissions\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:5:{s:1:\"a\";i:10;s:1:\"b\";i:3;s:1:\"c\";s:21:\"View Permission Group\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:10;a:5:{s:1:\"a\";i:11;s:1:\"b\";i:3;s:1:\"c\";s:23:\"Create Permission Group\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:5:{s:1:\"a\";i:12;s:1:\"b\";i:3;s:1:\"c\";s:21:\"Edit Permission Group\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:5:{s:1:\"a\";i:13;s:1:\"b\";i:3;s:1:\"c\";s:23:\"Delete Permission Group\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:5:{s:1:\"a\";i:14;s:1:\"b\";i:4;s:1:\"c\";s:10:\"View Users\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:14;a:5:{s:1:\"a\";i:15;s:1:\"b\";i:4;s:1:\"c\";s:12:\"Create Users\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:5:{s:1:\"a\";i:16;s:1:\"b\";i:4;s:1:\"c\";s:10:\"Edit Users\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:5:{s:1:\"a\";i:17;s:1:\"b\";i:4;s:1:\"c\";s:12:\"Delete Users\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:5:{s:1:\"a\";i:18;s:1:\"b\";i:4;s:1:\"c\";s:21:\"View User Permissions\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:5:{s:1:\"a\";i:19;s:1:\"b\";i:8;s:1:\"c\";s:13:\"View Division\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:19;a:5:{s:1:\"a\";i:20;s:1:\"b\";i:8;s:1:\"c\";s:15:\"Create Division\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:5:{s:1:\"a\";i:21;s:1:\"b\";i:8;s:1:\"c\";s:13:\"Edit Division\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:5:{s:1:\"a\";i:22;s:1:\"b\";i:8;s:1:\"c\";s:15:\"Delete Division\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:5:{s:1:\"a\";i:23;s:1:\"b\";i:9;s:1:\"c\";s:9:\"View Zone\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:23;a:5:{s:1:\"a\";i:24;s:1:\"b\";i:9;s:1:\"c\";s:11:\"Create Zone\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:5:{s:1:\"a\";i:25;s:1:\"b\";i:9;s:1:\"c\";s:9:\"Edit Zone\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:5:{s:1:\"a\";i:26;s:1:\"b\";i:9;s:1:\"c\";s:11:\"Delete Zone\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:5:{s:1:\"a\";i:27;s:1:\"b\";i:10;s:1:\"c\";s:13:\"View District\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:27;a:5:{s:1:\"a\";i:28;s:1:\"b\";i:10;s:1:\"c\";s:15:\"Create District\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:5:{s:1:\"a\";i:29;s:1:\"b\";i:10;s:1:\"c\";s:13:\"Edit District\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:5:{s:1:\"a\";i:30;s:1:\"b\";i:10;s:1:\"c\";s:15:\"Delete District\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:5:{s:1:\"a\";i:31;s:1:\"b\";i:11;s:1:\"c\";s:12:\"View Upazila\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:31;a:5:{s:1:\"a\";i:32;s:1:\"b\";i:11;s:1:\"c\";s:14:\"Create Upazila\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:5:{s:1:\"a\";i:33;s:1:\"b\";i:11;s:1:\"c\";s:12:\"Edit Upazila\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:5:{s:1:\"a\";i:34;s:1:\"b\";i:11;s:1:\"c\";s:14:\"Delete Upazila\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:5:{s:1:\"a\";i:35;s:1:\"b\";i:12;s:1:\"c\";s:14:\"View Component\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:35;a:5:{s:1:\"a\";i:36;s:1:\"b\";i:12;s:1:\"c\";s:16:\"Create Component\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:5:{s:1:\"a\";i:37;s:1:\"b\";i:12;s:1:\"c\";s:14:\"Edit Component\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:5:{s:1:\"a\";i:38;s:1:\"b\";i:12;s:1:\"c\";s:16:\"Delete Component\";s:1:\"d\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"c\";s:5:\"Admin\";s:1:\"d\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:6;s:1:\"c\";s:19:\"Monitoring Engineer\";s:1:\"d\";s:3:\"web\";}}}', 1758822515),
('laravel-cache-iconbangla.soft@gmail.com|127.0.0.1:timer', 'i:1758737014;', 1758737014),
('laravel-cache-iconbangla.soft@gmail.com|127.0.0.1', 'i:1;', 1758737014);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

DROP TABLE IF EXISTS `components`;
CREATE TABLE IF NOT EXISTS `components` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Big Classroom', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(2, 'Head Teacher Room', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(3, 'Staff Room', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(4, 'Library', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(5, 'Computer Lab', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(6, 'Playground', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(7, 'Canteen', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(8, 'Toilet Block', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(9, 'Boundary Wall', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(10, 'Science Lab', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(11, 'Assembly Hall', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(12, 'Laboratory Storage Room', NULL, '2025-09-24 09:45:18', '2025-09-24 09:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `districts_zone_id_foreign` (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `zone_id`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 1, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(2, 'Faridpur', 1, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(3, 'Gazipur', 1, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(4, 'Tangail', 2, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(5, 'Madaripur', 2, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(6, 'Chattogram', 3, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(7, 'Coxs Bazar', 3, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(8, 'Comilla', 3, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(9, 'Feni', 4, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(10, 'Brahmanbaria', 4, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(11, 'Khulna', 5, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(12, 'Jessore', 5, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(13, 'Bagerhat', 6, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(14, 'Satkhira', 6, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(15, 'Rajshahi', 7, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(16, 'Pabna', 7, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(17, 'Natore', 7, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(18, 'Barishal', 8, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(19, 'Patuakhali', 8, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(20, 'Sylhet', 9, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(21, 'Moulvibazar', 9, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(22, 'Rangpur', 10, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(23, 'Dinajpur', 10, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(24, 'Mymensingh', 11, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(25, 'Netrokona', 11, '2025-09-24 09:45:18', '2025-09-24 09:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
CREATE TABLE IF NOT EXISTS `divisions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `divisions_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', '2025-09-24 09:45:18', '2025-09-24 11:48:45'),
(2, 'Chattogram', '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(3, 'Khulna', '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(4, 'Rajshahi', '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(5, 'Barishal', '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(6, 'Sylhet', '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(7, 'Rangpur', '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(8, 'Mymensingh', '2025-09-24 09:45:18', '2025-09-24 09:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_18_170452_create_permission_tables', 1),
(5, '2025_09_19_044952_create_permission_groups_table', 1),
(6, '2025_09_19_050039_add_group_id_to_permissions_table', 1),
(16, '2025_09_24_144520_create_components_table', 2),
(15, '2025_09_24_144213_create_upazilas_table', 2),
(14, '2025_09_24_144122_create_districts_table', 2),
(13, '2025_09_24_143958_create_zones_table', 2),
(12, '2025_09_24_143729_create_divisions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(21, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 4),
(6, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  KEY `permissions_group_id_foreign` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `group_id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'View Permission', 'web', '2025-09-21 09:31:55', '2025-09-21 11:20:18'),
(2, 1, 'Create Permission', 'web', '2025-09-21 09:32:13', '2025-09-21 11:21:01'),
(3, 1, 'Edit Permission', 'web', '2025-09-21 09:32:27', '2025-09-23 03:51:25'),
(4, 1, 'Delete Permission', 'web', '2025-09-21 09:32:43', '2025-09-21 11:21:27'),
(5, 2, 'View Roles', 'web', '2025-09-21 11:53:11', '2025-09-21 11:53:11'),
(6, 2, 'Create Role', 'web', '2025-09-21 11:53:28', '2025-09-21 11:53:28'),
(7, 2, 'Edit Role', 'web', '2025-09-21 11:53:52', '2025-09-21 11:53:52'),
(8, 2, 'Delete Role', 'web', '2025-09-21 11:54:11', '2025-09-21 11:54:11'),
(9, 2, 'Assign Permissions', 'web', '2025-09-21 11:54:41', '2025-09-21 11:54:41'),
(10, 3, 'View Permission Group', 'web', '2025-09-21 12:40:28', '2025-09-21 12:40:28'),
(11, 3, 'Create Permission Group', 'web', '2025-09-21 12:40:45', '2025-09-21 12:40:45'),
(12, 3, 'Edit Permission Group', 'web', '2025-09-21 12:41:05', '2025-09-21 12:41:05'),
(13, 3, 'Delete Permission Group', 'web', '2025-09-21 12:41:34', '2025-09-21 12:41:34'),
(14, 4, 'View Users', 'web', '2025-09-21 12:55:21', '2025-09-23 03:12:27'),
(15, 4, 'Create Users', 'web', '2025-09-21 12:55:43', '2025-09-21 12:55:43'),
(16, 4, 'Edit Users', 'web', '2025-09-21 12:56:01', '2025-09-21 12:56:01'),
(17, 4, 'Delete Users', 'web', '2025-09-21 12:56:18', '2025-09-21 12:56:18'),
(18, 4, 'View User Permissions', 'web', '2025-09-21 12:56:36', '2025-09-21 12:56:36'),
(19, 8, 'View Division', 'web', '2025-09-24 11:27:02', '2025-09-24 11:27:02'),
(20, 8, 'Create Division', 'web', '2025-09-24 11:27:20', '2025-09-24 11:27:20'),
(21, 8, 'Edit Division', 'web', '2025-09-24 11:27:33', '2025-09-24 11:27:33'),
(22, 8, 'Delete Division', 'web', '2025-09-24 11:27:50', '2025-09-24 11:27:50'),
(23, 9, 'View Zone', 'web', '2025-09-24 11:28:21', '2025-09-24 11:28:21'),
(24, 9, 'Create Zone', 'web', '2025-09-24 11:28:35', '2025-09-24 11:28:35'),
(25, 9, 'Edit Zone', 'web', '2025-09-24 11:28:47', '2025-09-24 11:28:47'),
(26, 9, 'Delete Zone', 'web', '2025-09-24 11:29:05', '2025-09-24 11:29:05'),
(27, 10, 'View District', 'web', '2025-09-24 11:30:04', '2025-09-24 11:30:04'),
(28, 10, 'Create District', 'web', '2025-09-24 11:30:17', '2025-09-24 11:30:17'),
(29, 10, 'Edit District', 'web', '2025-09-24 11:30:35', '2025-09-24 11:30:35'),
(30, 10, 'Delete District', 'web', '2025-09-24 11:30:52', '2025-09-24 11:30:52'),
(31, 11, 'View Upazila', 'web', '2025-09-24 11:31:26', '2025-09-24 11:31:26'),
(32, 11, 'Create Upazila', 'web', '2025-09-24 11:31:39', '2025-09-24 11:31:39'),
(33, 11, 'Edit Upazila', 'web', '2025-09-24 11:31:52', '2025-09-24 11:31:52'),
(34, 11, 'Delete Upazila', 'web', '2025-09-24 11:32:10', '2025-09-24 11:32:10'),
(35, 12, 'View Component', 'web', '2025-09-24 11:33:23', '2025-09-24 11:33:23'),
(36, 12, 'Create Component', 'web', '2025-09-24 11:33:43', '2025-09-24 11:33:43'),
(37, 12, 'Edit Component', 'web', '2025-09-24 11:33:56', '2025-09-24 11:33:56'),
(38, 12, 'Delete Component', 'web', '2025-09-24 11:34:08', '2025-09-24 11:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `permission_groups`
--

DROP TABLE IF EXISTS `permission_groups`;
CREATE TABLE IF NOT EXISTS `permission_groups` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Permission Management', '2025-09-21 09:31:09', '2025-09-21 09:31:09'),
(2, 'Role Managements', '2025-09-21 11:52:48', '2025-09-23 04:03:00'),
(3, 'Permission Group Management', '2025-09-21 12:37:56', '2025-09-21 12:37:56'),
(4, 'User Management', '2025-09-21 12:38:15', '2025-09-22 23:56:09'),
(8, 'Division Management', '2025-09-23 03:50:03', '2025-09-24 11:24:26'),
(9, 'Zone Management', '2025-09-24 11:24:50', '2025-09-24 11:24:50'),
(10, 'District Management', '2025-09-24 11:25:05', '2025-09-24 11:25:05'),
(11, 'Upazila Management', '2025-09-24 11:25:40', '2025-09-24 11:32:31'),
(12, 'Component Management', '2025-09-24 11:25:58', '2025-09-24 11:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-09-21 09:31:24', '2025-09-21 09:31:24'),
(6, 'Monitoring Engineer', 'web', '2025-09-24 11:40:55', '2025-09-24 11:40:55'),
(4, 'Super Admin', 'web', '2025-09-22 00:16:26', '2025-09-22 00:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 6),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 6),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 6),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(14, 6),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(19, 6),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(23, 6),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(27, 6),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(31, 6),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(35, 6),
(36, 1),
(37, 1),
(38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('THx8s4XjapVJRwmmV7hBQpyveepelWLRixMDQKGr', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN3RJWG1HQ2tEQjhPYzBBR0F2S3JQalhPRkpIemhvVGdLY0ZhcDMxRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2Vycy8xMS9lZGl0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1758737376),
('Hapyug0sLeMcIGS1wU0qNEzUfLyYQz4MQ9r8VKDf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3Nhd1RuVG1aQU1LYzFXYlZ5ZG5YRTdwNkdvZGpWZTZpRGQxSGlRbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3Jnb3QtcGFzc3dvcmQiO319', 1758736984);

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

DROP TABLE IF EXISTS `upazilas`;
CREATE TABLE IF NOT EXISTS `upazilas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upazilas_district_id_foreign` (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upazilas`
--

INSERT INTO `upazilas` (`id`, `name`, `district_id`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka Upazila 1', 1, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(2, 'Dhaka Upazila 2', 1, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(3, 'Faridpur Upazila 1', 2, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(4, 'Faridpur Upazila 2', 2, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(5, 'Gazipur Upazila 1', 3, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(6, 'Gazipur Upazila 2', 3, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(7, 'Tangail Upazila 1', 4, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(8, 'Tangail Upazila 2', 4, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(9, 'Madaripur Upazila 1', 5, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(10, 'Madaripur Upazila 2', 5, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(11, 'Chattogram Upazila 1', 6, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(12, 'Chattogram Upazila 2', 6, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(13, 'Coxs Bazar Upazila 1', 7, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(14, 'Coxs Bazar Upazila 2', 7, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(15, 'Comilla Upazila 1', 8, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(16, 'Comilla Upazila 2', 8, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(17, 'Feni Upazila 1', 9, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(18, 'Feni Upazila 2', 9, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(19, 'Brahmanbaria Upazila 1', 10, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(20, 'Brahmanbaria Upazila 2', 10, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(21, 'Khulna Upazila 1', 11, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(22, 'Khulna Upazila 2', 11, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(23, 'Jessore Upazila 1', 12, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(24, 'Jessore Upazila 2', 12, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(25, 'Bagerhat Upazila 1', 13, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(26, 'Bagerhat Upazila 2', 13, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(27, 'Satkhira Upazila 1', 14, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(28, 'Satkhira Upazila 2', 14, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(29, 'Rajshahi Upazila 1', 15, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(30, 'Rajshahi Upazila 2', 15, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(31, 'Pabna Upazila 1', 16, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(32, 'Pabna Upazila 2', 16, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(33, 'Natore Upazila 1', 17, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(34, 'Natore Upazila 2', 17, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(35, 'Barishal Upazila 1', 18, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(36, 'Barishal Upazila 2', 18, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(37, 'Patuakhali Upazila 1', 19, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(38, 'Patuakhali Upazila 2', 19, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(39, 'Sylhet Upazila 1', 20, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(40, 'Sylhet Upazila 2', 20, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(41, 'Moulvibazar Upazila 1', 21, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(42, 'Moulvibazar Upazila 2', 21, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(43, 'Rangpur Upazila 1', 22, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(44, 'Rangpur Upazila 2', 22, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(45, 'Dinajpur Upazila 1', 23, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(46, 'Dinajpur Upazila 2', 23, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(47, 'Mymensingh Upazila 1', 24, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(48, 'Mymensingh Upazila 2', 24, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(49, 'Netrokona Upazila 1', 25, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(50, 'Netrokona Upazila 2', 25, '2025-09-24 09:45:18', '2025-09-24 09:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'admin', 'admin@email.com', NULL, '$2y$12$tw.HDc7u73ZyWKPGVVrGwOyd3uFwImrt7OaqSgGsXWQzgZNRJ.TWy', 1, NULL, '2025-09-20 23:25:33', '2025-09-22 10:15:08'),
(11, 'Afsarul Hoque', 'afsar@email.com', NULL, '$2y$12$ipGBsLBiPtE/SpeYkPQYvun7cHe03W6guZYi07a4Ver/QLMrkhism', 1, NULL, '2025-09-24 11:42:18', '2025-09-24 11:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
CREATE TABLE IF NOT EXISTS `zones` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zones_division_id_foreign` (`division_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `name`, `division_id`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka Zone', 1, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(2, 'Tangail Zone', 1, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(3, 'Chattogram Zone', 2, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(4, 'Feni Zone', 2, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(5, 'Khulna Zone', 3, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(6, 'Bagerhat Zone', 3, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(7, 'Rajshahi Zone', 4, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(8, 'Barishal Zone', 5, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(9, 'Sylhet Zone', 6, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(10, 'Rangpur Zone', 7, '2025-09-24 09:45:18', '2025-09-24 09:45:18'),
(11, 'Mymensingh Zone', 8, '2025-09-24 09:45:18', '2025-09-24 09:45:18');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
