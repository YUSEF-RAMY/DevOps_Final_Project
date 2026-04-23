-- Laravel eCommerce System - Database Dump
-- Version: 1.0.0
-- Generated: 2025
-- 
-- This SQL file contains the complete database structure and sample data
-- for the Laravel eCommerce System.
--
-- Database: ecommerce
-- Tables: 30+ tables
-- Includes: Sample products, categories, users, orders, settings, and more
--
-- Installation:
-- 1. Create a new database: CREATE DATABASE ecommerce;
-- 2. Import this file: mysql -u username -p ecommerce < ecommerce.sql
--    OR use phpMyAdmin import feature
--
-- Note: This dump includes sample data for testing purposes.
-- For production, use migrations: php artisan migrate --seed

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'needyamin@gmail.com', NULL, '$2y$12$XixxSkXdgHltgueGs7t2veyK0/rgE0hi7iJe9W7N81IFgxG7VTrz.', 'MW36teJu6qDOvu7NsWiK9nwHgJNSUQlVAadjGBOseJzCwcH74iXLytch8KRm', '2025-11-30 11:08:14', '2025-11-30 12:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-license_last_validation', 'O:25:\"Illuminate\\Support\\Carbon\":3:{s:4:\"date\";s:26:\"2025-12-19 22:38:11.749953\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}', 2081543891),
('laravel-cache-license_valid_8bd8702df2a6b2bb9d88d4566cdc4998', 'b:1;', 1766270291),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:134:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"admin.captcha\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:18:\"admin.users.lookup\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:15:\"admin.dashboard\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:27:\"admin.categories.check-slug\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:22:\"admin.categories.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:23:\"admin.categories.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:22:\"admin.categories.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:21:\"admin.categories.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:21:\"admin.categories.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:23:\"admin.categories.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:24:\"admin.categories.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:21:\"admin.products.lookup\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:19:\"admin.products.json\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:25:\"admin.products.check-slug\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:27:\"admin.products.page-builder\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:32:\"admin.products.page-builder.save\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:28:\"admin.products.images.delete\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:33:\"admin.products.images.set-primary\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:34:\"admin.products.images.update-order\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:20:\"admin.products.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:21:\"admin.products.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:20:\"admin.products.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:19:\"admin.products.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:19:\"admin.products.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:21:\"admin.products.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:22:\"admin.products.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:19:\"admin.orders.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:18:\"admin.orders.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:18:\"admin.orders.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:17:\"admin.orders.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:19:\"admin.orders.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:20:\"admin.orders.invoice\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:17:\"admin.users.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:16:\"admin.users.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:16:\"admin.users.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:18:\"admin.users.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:19:\"admin.users.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:26:\"admin.users.reset-password\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:25:\"admin.users.toggle-status\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:24:\"admin.users.coins.adjust\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:23:\"admin.users.coins.reset\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:29:\"admin.shipping-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:30:\"admin.shipping-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:26:\"admin.email-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:27:\"admin.email-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:25:\"admin.email-settings.test\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:28:\"admin.storage-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:29:\"admin.storage-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:17:\"admin.roles.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:18:\"admin.roles.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:17:\"admin.roles.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:16:\"admin.roles.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:18:\"admin.roles.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:19:\"admin.roles.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:16:\"admin.roles.copy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:22:\"admin.roles.copy.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:23:\"admin.permissions.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:24:\"admin.permissions.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:23:\"admin.permissions.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:22:\"admin.permissions.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:24:\"admin.permissions.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:25:\"admin.permissions.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:19:\"admin.coupons.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:20:\"admin.coupons.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:19:\"admin.coupons.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:18:\"admin.coupons.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:20:\"admin.coupons.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:21:\"admin.coupons.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:27:\"admin.coupons.toggle-status\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:22:\"admin.newsletter.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:23:\"admin.newsletter.toggle\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:24:\"admin.newsletter.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:19:\"admin.reviews.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:21:\"admin.reviews.approve\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:20:\"admin.reviews.reject\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:21:\"admin.reviews.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:28:\"admin.payment-gateways.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:27:\"admin.payment-gateways.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:29:\"admin.payment-gateways.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:36:\"admin.payment-gateways.toggle-status\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:27:\"admin.payment-gateways.test\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:81;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:24:\"admin.otp-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:82;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:25:\"admin.otp-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:83;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:34:\"admin.api.categories.subcategories\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:84;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:22:\"admin.activities.carts\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:85;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:26:\"admin.activities.wishlists\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:86;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:25:\"admin.activities.sessions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:87;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:33:\"admin.activities.sessions.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:88;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:38:\"admin.activities.sessions.destroy-user\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:89;a:4:{s:1:\"a\";i:90;s:1:\"b\";s:21:\"admin.coupons.preview\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:90;a:4:{s:1:\"a\";i:91;s:1:\"b\";s:22:\"admin.currencies.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:91;a:4:{s:1:\"a\";i:92;s:1:\"b\";s:23:\"admin.currencies.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:92;a:4:{s:1:\"a\";i:93;s:1:\"b\";s:22:\"admin.currencies.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:93;a:4:{s:1:\"a\";i:94;s:1:\"b\";s:21:\"admin.currencies.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:94;a:4:{s:1:\"a\";i:95;s:1:\"b\";s:23:\"admin.currencies.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:95;a:4:{s:1:\"a\";i:96;s:1:\"b\";s:24:\"admin.currencies.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:96;a:4:{s:1:\"a\";i:97;s:1:\"b\";s:23:\"admin.currencies.toggle\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:97;a:4:{s:1:\"a\";i:98;s:1:\"b\";s:24:\"admin.currencies.default\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:98;a:4:{s:1:\"a\";i:99;s:1:\"b\";s:25:\"admin.site-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:99;a:4:{s:1:\"a\";i:100;s:1:\"b\";s:26:\"admin.site-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:100;a:4:{s:1:\"a\";i:101;s:1:\"b\";s:18:\"admin.admins.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:101;a:4:{s:1:\"a\";i:102;s:1:\"b\";s:19:\"admin.admins.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:102;a:4:{s:1:\"a\";i:103;s:1:\"b\";s:18:\"admin.admins.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:103;a:4:{s:1:\"a\";i:104;s:1:\"b\";s:17:\"admin.admins.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:104;a:4:{s:1:\"a\";i:105;s:1:\"b\";s:19:\"admin.admins.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:105;a:4:{s:1:\"a\";i:106;s:1:\"b\";s:20:\"admin.admins.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:106;a:4:{s:1:\"a\";i:107;s:1:\"b\";s:25:\"admin.coin-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:107;a:4:{s:1:\"a\";i:108;s:1:\"b\";s:26:\"admin.coin-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:108;a:4:{s:1:\"a\";i:109;s:1:\"b\";s:17:\"admin.pages.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:109;a:4:{s:1:\"a\";i:110;s:1:\"b\";s:18:\"admin.pages.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:110;a:4:{s:1:\"a\";i:111;s:1:\"b\";s:17:\"admin.pages.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:111;a:4:{s:1:\"a\";i:112;s:1:\"b\";s:16:\"admin.pages.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:112;a:4:{s:1:\"a\";i:113;s:1:\"b\";s:16:\"admin.pages.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:113;a:4:{s:1:\"a\";i:114;s:1:\"b\";s:18:\"admin.pages.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:114;a:4:{s:1:\"a\";i:115;s:1:\"b\";s:19:\"admin.pages.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:115;a:4:{s:1:\"a\";i:116;s:1:\"b\";s:21:\"admin.districts.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:116;a:4:{s:1:\"a\";i:117;s:1:\"b\";s:22:\"admin.districts.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:117;a:4:{s:1:\"a\";i:118;s:1:\"b\";s:21:\"admin.districts.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:118;a:4:{s:1:\"a\";i:119;s:1:\"b\";s:20:\"admin.districts.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:119;a:4:{s:1:\"a\";i:120;s:1:\"b\";s:20:\"admin.districts.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:120;a:4:{s:1:\"a\";i:121;s:1:\"b\";s:22:\"admin.districts.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:121;a:4:{s:1:\"a\";i:122;s:1:\"b\";s:23:\"admin.districts.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:122;a:4:{s:1:\"a\";i:123;s:1:\"b\";s:29:\"admin.districts.toggle-status\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:123;a:4:{s:1:\"a\";i:124;s:1:\"b\";s:16:\"admin.datatables\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:124;a:4:{s:1:\"a\";i:125;s:1:\"b\";s:12:\"admin.logout\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:125;a:4:{s:1:\"a\";i:126;s:1:\"b\";s:22:\"admin.license.activate\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:126;a:4:{s:1:\"a\";i:127;s:1:\"b\";s:27:\"admin.license.activate.post\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:127;a:4:{s:1:\"a\";i:128;s:1:\"b\";s:20:\"admin.license.remove\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:128;a:4:{s:1:\"a\";i:129;s:1:\"b\";s:19:\"admin.license.check\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:129;a:4:{s:1:\"a\";i:130;s:1:\"b\";s:18:\"admin.backup.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:130;a:4:{s:1:\"a\";i:131;s:1:\"b\";s:27:\"admin.backup.export-product\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:131;a:4:{s:1:\"a\";i:132;s:1:\"b\";s:23:\"admin.backup.export-all\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:132;a:4:{s:1:\"a\";i:133;s:1:\"b\";s:19:\"admin.backup.import\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:133;a:4:{s:1:\"a\";i:134;s:1:\"b\";s:27:\"admin.backup.process-import\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"Super Admin\";s:1:\"c\";s:5:\"admin\";}}}', 1766346637);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_id` bigint UNSIGNED DEFAULT NULL,
  `coupon_discount` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `session_id`, `subtotal`, `discount_total`, `tax_total`, `grand_total`, `created_at`, `updated_at`, `coupon_id`, `coupon_discount`) VALUES
(2, NULL, '9688659c-41ff-421b-a5ce-c6e743174f13', '0.00', '0.00', '0.00', '0.00', '2025-11-30 11:15:15', '2025-11-30 11:15:15', NULL, '0.00'),
(3, NULL, '709c465c-3c49-47c0-ab77-4c5273c91d37', '0.00', '0.00', '0.00', '0.00', '2025-11-30 11:15:24', '2025-11-30 11:15:24', NULL, '0.00'),
(4, 1, NULL, '813.37', '0.00', '0.00', '813.37', '2025-11-30 11:39:12', '2025-11-30 12:28:42', NULL, '0.00'),
(6, NULL, '7d15a7e2-4d44-4f43-8b00-aad352980c6d', '1376.65', '0.00', '0.00', '1376.65', '2025-12-19 15:18:48', '2025-12-19 16:02:41', NULL, '0.00'),
(7, NULL, 'a9b63e8e-e0aa-4493-be39-cd1e3628c3ec', '912.97', '0.00', '0.00', '912.97', '2025-12-20 13:36:03', '2025-12-20 13:44:30', NULL, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL DEFAULT '1',
  `unit_price` decimal(10,2) NOT NULL,
  `line_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `unit_price`, `line_total`, `created_at`, `updated_at`) VALUES
(3, 4, 287, 1, '275.57', '275.57', '2025-11-30 11:39:12', '2025-11-30 11:39:12'),
(5, 4, 416, 1, '254.78', '254.78', '2025-11-30 12:23:03', '2025-11-30 12:25:32'),
(6, 4, 427, 3, '94.34', '283.02', '2025-11-30 12:23:04', '2025-11-30 12:25:32'),
(8, 6, 497, 1, '17.66', '17.66', '2025-12-19 15:18:59', '2025-12-19 15:18:59'),
(9, 6, 485, 1, '170.95', '170.95', '2025-12-19 15:42:57', '2025-12-19 15:42:57'),
(10, 6, 481, 1, '72.49', '72.49', '2025-12-19 15:42:58', '2025-12-19 15:42:58'),
(11, 6, 469, 4, '121.94', '487.76', '2025-12-19 15:45:40', '2025-12-19 16:02:41'),
(12, 6, 470, 1, '280.28', '280.28', '2025-12-19 15:45:41', '2025-12-19 15:45:41'),
(13, 6, 471, 1, '257.56', '257.56', '2025-12-19 15:45:41', '2025-12-19 15:45:41'),
(14, 6, 472, 1, '89.95', '89.95', '2025-12-19 15:45:42', '2025-12-19 15:45:42'),
(16, 7, 497, 2, '17.66', '35.32', '2025-12-20 13:36:03', '2025-12-20 13:36:11'),
(18, 7, 498, 3, '292.55', '877.65', '2025-12-20 13:36:24', '2025-12-20 13:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `description`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Quam velit', 'quam-velit-PhSiY', 'Eius maiores deserunt quod iste quas eius veritatis odit accusantium fugiat.', NULL, 1, '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(2, NULL, 'Illo quis', 'illo-quis-z8wga', 'Eveniet adipisci eaque dolor consequatur deleniti possimus voluptas et quia consequuntur atque.', NULL, 1, '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(3, NULL, 'Quia et', 'quia-et-W7VkL', 'Optio veniam alias nobis nisi facilis iusto minus quae officia voluptas recusandae vitae.', NULL, 1, '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(4, NULL, 'Illo debitis', 'illo-debitis-DYowv', 'Perferendis hic sit impedit aut fuga impedit libero consequuntur eos sint expedita reiciendis dolor.', NULL, 1, '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(5, NULL, 'Modi veritatis', 'modi-veritatis-vcfgL', 'Velit inventore nesciunt voluptatum libero quibusdam animi rerum non sunt sunt.', NULL, 1, '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(6, NULL, 'Officia et', 'officia-et-0IlZ7', 'Qui porro veniam distinctio tempore quibusdam eos quia accusamus doloribus et.', NULL, 1, '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(7, NULL, 'Accusamus rerum', 'accusamus-rerum-3bK77', 'Occaecati consequuntur fuga sed consequatur fuga qui quo quam dolorem cum.', NULL, 1, '2025-11-30 11:10:00', '2025-11-30 11:10:00'),
(8, NULL, 'Voluptas a', 'voluptas-a-CPE8r', 'Recusandae nulla sed consectetur non molestias odit optio nostrum enim placeat exercitationem.', NULL, 1, '2025-11-30 11:10:00', '2025-11-30 11:10:00'),
(9, NULL, 'Numquam facere', 'numquam-facere-2gyI7', 'Sapiente reprehenderit dolorum voluptas atque aut et explicabo cum.', NULL, 1, '2025-11-30 11:10:00', '2025-11-30 11:10:00'),
(10, NULL, 'Nihil facilis', 'nihil-facilis-qddkk', 'Ut aut excepturi omnis blanditiis voluptatibus sit beatae veniam tempore in.', NULL, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(11, NULL, 'Quaerat consequatur', 'quaerat-consequatur-IKMPO', 'Omnis architecto eaque cumque magni esse vero dignissimos repudiandae reiciendis ullam delectus.', NULL, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(12, NULL, 'Qui maxime', 'qui-maxime-1jkbf', 'Voluptas qui cumque qui in necessitatibus eius similique fugiat modi provident.', NULL, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(13, NULL, 'Quidem quos', 'quidem-quos-VoHf2', 'Labore et ut qui iure nobis repellendus.', NULL, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(14, NULL, 'In vel', 'in-vel-mwxMk', 'Qui harum qui quo optio rem accusamus eius quo ut aut consequatur numquam illum velit.', NULL, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(15, NULL, 'Vel alias', 'vel-alias-qyP2t', 'Neque est maiores voluptatem similique enim iure odit necessitatibus molestias et excepturi totam.', NULL, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(16, NULL, 'Ipsam cupiditate', 'ipsam-cupiditate-4hMLG', 'Voluptas pariatur illo veniam eum et reiciendis animi.', NULL, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(17, NULL, 'Hic aspernatur', 'hic-aspernatur-Zw1ja', 'Ullam modi assumenda officia quas quo et corporis dolorem repellat accusantium harum nostrum distinctio.', NULL, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(18, NULL, 'Consequuntur perferendis', 'consequuntur-perferendis-N1wUv', 'Voluptates vero ut dolorum voluptates quos possimus magni suscipit dolorum neque aspernatur iusto expedita.', NULL, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(19, NULL, 'Numquam quia', 'numquam-quia-8g4DN', 'Qui nam qui aut voluptatem blanditiis voluptatem ut aut tempora ratione vel cupiditate et.', NULL, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(20, NULL, 'Aut impedit', 'aut-impedit-2kMh7', 'Qui praesentium ex velit et enim earum quos quam eos.', NULL, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(21, NULL, 'Consequatur accusantium', 'consequatur-accusantium-0gqk5', 'Voluptatem illo sed asperiores accusantium aliquid nobis qui labore explicabo consequatur ducimus quia.', NULL, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(22, NULL, 'Ipsam numquam', 'ipsam-numquam-5vMTl', 'Consequatur id explicabo optio recusandae dolor possimus dicta sed eaque voluptatem.', NULL, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(23, NULL, 'Quaerat exercitationem', 'quaerat-exercitationem-WY196', 'Aut qui odio necessitatibus ut veritatis natus.', NULL, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(24, NULL, 'Doloremque qui', 'doloremque-qui-nolwp', 'Illum et eos cum repudiandae id unde autem odit dolores ratione rerum earum.', NULL, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(25, NULL, 'Voluptatem rerum', 'voluptatem-rerum-If7B1', 'Sed ducimus esse voluptas est aliquid ex cupiditate fuga error quaerat et adipisci.', NULL, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(26, NULL, 'Aut soluta', 'aut-soluta-sq9j4', 'Cumque labore hic quo rem enim saepe nesciunt praesentium libero et explicabo.', NULL, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(27, NULL, 'Et quaerat', 'et-quaerat-LO7BA', 'Architecto aliquam dolore consequatur et est omnis consectetur mollitia cupiditate nihil reiciendis.', NULL, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(28, NULL, 'At magnam', 'at-magnam-c9XW2', 'Assumenda ut esse ipsa rerum ullam sunt.', NULL, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(29, NULL, 'Omnis sit', 'omnis-sit-dQnDb', 'Dolores impedit possimus sapiente ut earum et soluta voluptatum ut.', NULL, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(30, NULL, 'Repudiandae quod', 'repudiandae-quod-VLVD1', 'Beatae blanditiis voluptas et blanditiis a exercitationem distinctio asperiores animi placeat.', NULL, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(31, NULL, 'Dolorem et', 'dolorem-et-8m8OA', 'At recusandae beatae odit architecto ut porro quis.', NULL, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(32, NULL, 'Eum voluptatem', 'eum-voluptatem-o8wqg', 'Deserunt debitis rem neque enim voluptatum nesciunt alias repudiandae.', NULL, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(33, NULL, 'Aliquam occaecati', 'aliquam-occaecati-6TbYI', 'Accusantium temporibus quia quia et rerum molestiae odio eligendi et fuga quo non rerum.', NULL, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(34, NULL, 'Necessitatibus voluptatem', 'necessitatibus-voluptatem-yKhnl', 'Ducimus eum quasi rerum minima laudantium sit quaerat ad et.', NULL, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(35, NULL, 'Quia numquam', 'quia-numquam-clRUB', 'In perspiciatis facilis ducimus voluptate necessitatibus provident.', NULL, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(36, NULL, 'Recusandae qui', 'recusandae-qui-Ri8Nh', 'Voluptate omnis et perspiciatis officia ipsa ut magni qui aliquam optio eaque et quibusdam.', NULL, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(37, NULL, 'Aut nesciunt', 'aut-nesciunt-z0A3C', 'Laudantium esse ut error nulla et porro quos officia natus accusantium vero.', NULL, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(38, NULL, 'Incidunt consectetur', 'incidunt-consectetur-mN48x', 'Quasi est illum rerum eum rem praesentium ullam cupiditate quod odio quam.', NULL, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(39, NULL, 'Modi inventore', 'modi-inventore-6UY6y', 'Eum excepturi earum eligendi ut voluptate non voluptatem alias.', NULL, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(40, NULL, 'Qui vel', 'qui-vel-oaSF6', 'Quod odit in ducimus repellat aut voluptas labore autem aut et.', NULL, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(41, NULL, 'Inventore et', 'inventore-et-96MtR', 'At velit quaerat in enim nemo facere iure.', NULL, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(42, NULL, 'Dolorem quaerat', 'dolorem-quaerat-hckJM', 'Non qui doloribus quos labore quasi aliquam nostrum nihil sit natus quibusdam exercitationem minus.', NULL, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `coin_settings`
--

CREATE TABLE `coin_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `coins_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `add_to_cart_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `order_award_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `cod_bonus_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `referral_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `add_to_cart_award` int UNSIGNED NOT NULL DEFAULT '1',
  `add_to_cart_daily_cap` int UNSIGNED NOT NULL DEFAULT '10',
  `order_rate_per` int UNSIGNED NOT NULL DEFAULT '100',
  `order_rate_coins` int UNSIGNED NOT NULL DEFAULT '1',
  `order_min_award` int UNSIGNED NOT NULL DEFAULT '1',
  `cod_bonus` int UNSIGNED NOT NULL DEFAULT '1',
  `referral_signup_bonus` int UNSIGNED NOT NULL DEFAULT '10',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coin_settings`
--

INSERT INTO `coin_settings` (`id`, `coins_enabled`, `add_to_cart_enabled`, `order_award_enabled`, `cod_bonus_enabled`, `referral_enabled`, `add_to_cart_award`, `add_to_cart_daily_cap`, `order_rate_per`, `order_rate_coins`, `order_min_award`, `cod_bonus`, `referral_signup_bonus`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 10, 100, 1, 1, 1, 10, '2025-11-30 11:39:12', '2025-11-30 11:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `minimum_amount` decimal(10,2) DEFAULT NULL,
  `maximum_discount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `usage_limit_per_user` int DEFAULT NULL,
  `starts_at` date DEFAULT NULL,
  `expires_at` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `applicable_categories` json DEFAULT NULL,
  `applicable_products` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `name`, `description`, `type`, `value`, `minimum_amount`, `maximum_discount`, `usage_limit`, `usage_limit_per_user`, `starts_at`, `expires_at`, `is_active`, `applicable_categories`, `applicable_products`, `created_at`, `updated_at`) VALUES
(1, 'WELCOME10', 'Welcome Discount', 'Get 10% off your first order', 'percentage', '10.00', '50.00', '25.00', 100, 1, '2025-11-30', '2026-03-02', 1, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(2, 'SAVE20', 'Save $20', 'Get $20 off orders over $100', 'fixed', '20.00', '100.00', NULL, 50, 2, '2025-11-30', '2026-01-30', 1, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(3, 'FREESHIP', 'Free Shipping', 'Free shipping on any order', 'fixed', '10.00', NULL, NULL, 200, 3, '2025-11-30', '2026-11-30', 1, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(4, 'HOLIDAY25', 'Holiday Special', '25% off for holiday season', 'percentage', '25.00', '75.00', '50.00', 30, 1, '2025-11-30', '2025-12-30', 1, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(5, 'STUDENT15', 'Student Discount', '15% off for students', 'percentage', '15.00', '30.00', '30.00', NULL, 5, '2025-11-30', '2026-05-30', 1, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 12:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usages`
--

CREATE TABLE `coupon_usages` (
  `id` bigint UNSIGNED NOT NULL,
  `coupon_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `name`, `symbol`, `is_active`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'BDT', 'Bangladeshi Taka', '৳', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(2, 'USD', 'US Dollar', '$', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(3, 'EUR', 'Euro', '€', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(4, 'GBP', 'British Pound', '£', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `division`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 'Dhaka', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(2, 'Gazipur', 'Dhaka', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(3, 'Kishoreganj', 'Dhaka', 1, 2, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(4, 'Manikganj', 'Dhaka', 1, 3, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(5, 'Munshiganj', 'Dhaka', 1, 4, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(6, 'Narayanganj', 'Dhaka', 1, 5, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(7, 'Narsingdi', 'Dhaka', 1, 6, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(8, 'Tangail', 'Dhaka', 1, 7, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(9, 'Faridpur', 'Dhaka', 1, 8, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(10, 'Gopalganj', 'Dhaka', 1, 9, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(11, 'Madaripur', 'Dhaka', 1, 10, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(12, 'Rajbari', 'Dhaka', 1, 11, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(13, 'Shariatpur', 'Dhaka', 1, 12, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(14, 'Bandarban', 'Chittagong', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(15, 'Brahmanbaria', 'Chittagong', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(16, 'Chandpur', 'Chittagong', 1, 2, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(17, 'Chittagong', 'Chittagong', 1, 3, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(18, 'Comilla', 'Chittagong', 1, 4, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(19, 'Cox\'s Bazar', 'Chittagong', 1, 5, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(20, 'Feni', 'Chittagong', 1, 6, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(21, 'Khagrachhari', 'Chittagong', 1, 7, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(22, 'Lakshmipur', 'Chittagong', 1, 8, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(23, 'Noakhali', 'Chittagong', 1, 9, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(24, 'Rangamati', 'Chittagong', 1, 10, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(25, 'Bogura', 'Rajshahi', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(26, 'Joypurhat', 'Rajshahi', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(27, 'Naogaon', 'Rajshahi', 1, 2, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(28, 'Natore', 'Rajshahi', 1, 3, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(29, 'Chapai Nawabganj', 'Rajshahi', 1, 4, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(30, 'Pabna', 'Rajshahi', 1, 5, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(31, 'Rajshahi', 'Rajshahi', 1, 6, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(32, 'Sirajganj', 'Rajshahi', 1, 7, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(33, 'Bagerhat', 'Khulna', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(34, 'Chuadanga', 'Khulna', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(35, 'Jashore', 'Khulna', 1, 2, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(36, 'Jhenaidah', 'Khulna', 1, 3, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(37, 'Khulna', 'Khulna', 1, 4, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(38, 'Kushtia', 'Khulna', 1, 5, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(39, 'Magura', 'Khulna', 1, 6, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(40, 'Meherpur', 'Khulna', 1, 7, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(41, 'Narail', 'Khulna', 1, 8, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(42, 'Satkhira', 'Khulna', 1, 9, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(43, 'Barguna', 'Barisal', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(44, 'Barisal', 'Barisal', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(45, 'Bhola', 'Barisal', 1, 2, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(46, 'Jhalokati', 'Barisal', 1, 3, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(47, 'Patuakhali', 'Barisal', 1, 4, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(48, 'Pirojpur', 'Barisal', 1, 5, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(49, 'Habiganj', 'Sylhet', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(50, 'Moulvibazar', 'Sylhet', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(51, 'Sunamganj', 'Sylhet', 1, 2, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(52, 'Sylhet', 'Sylhet', 1, 3, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(53, 'Dinajpur', 'Rangpur', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(54, 'Gaibandha', 'Rangpur', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(55, 'Kurigram', 'Rangpur', 1, 2, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(56, 'Lalmonirhat', 'Rangpur', 1, 3, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(57, 'Nilphamari', 'Rangpur', 1, 4, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(58, 'Panchagarh', 'Rangpur', 1, 5, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(59, 'Rangpur', 'Rangpur', 1, 6, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(60, 'Thakurgaon', 'Rangpur', 1, 7, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(61, 'Jamalpur', 'Mymensingh', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(62, 'Mymensingh', 'Mymensingh', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(63, 'Netrokona', 'Mymensingh', 1, 2, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(64, 'Sherpur', 'Mymensingh', 1, 3, '2025-11-30 11:08:18', '2025-11-30 11:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `key`, `name`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'from_name', 'From Name', 'eCommerce Store', 'The name that appears in the \"From\" field of emails', '2025-11-30 11:07:22', '2025-11-30 11:07:22'),
(2, 'from_email', 'From Email', 'noreply@ecommercestore.com', 'The email address that appears in the \"From\" field of emails', '2025-11-30 11:07:22', '2025-11-30 11:07:22'),
(3, 'order_confirmation_enabled', 'Order Confirmation Emails', '1', 'Send confirmation emails when orders are placed', '2025-11-30 11:07:22', '2025-11-30 11:07:22'),
(4, 'order_status_update_enabled', 'Order Status Update Emails', '1', 'Send emails when order status is updated', '2025-11-30 11:07:22', '2025-11-30 11:07:22'),
(5, 'smtp_enabled', 'Enable SMTP', '0', 'Enable SMTP for sending emails', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(6, 'smtp_host', 'SMTP Host', '', 'SMTP server hostname (e.g., mail.yourdomain.com, smtp.gmail.com)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(7, 'smtp_port', 'SMTP Port', '587', 'SMTP server port (587 for TLS, 465 for SSL, 25 for non-encrypted)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(8, 'smtp_username', 'SMTP Username', '', 'SMTP authentication username (usually your email address)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(9, 'smtp_password', 'SMTP Password', '', 'SMTP authentication password', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(10, 'smtp_encryption', 'SMTP Encryption', 'tls', 'Encryption method (tls, ssl, or none)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(11, 'smtp_from_address', 'SMTP From Address', '', 'Email address to send from (must match SMTP username for some providers)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(12, 'smtp_from_name', 'SMTP From Name', '', 'Name to display in the \"From\" field', '2025-11-30 11:07:23', '2025-11-30 11:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest_wishlists`
--

CREATE TABLE `guest_wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `session_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(189, '0001_01_01_000000_create_users_table', 1),
(190, '0001_01_01_000001_create_cache_table', 1),
(191, '0001_01_01_000002_create_jobs_table', 1),
(193, '2025_01_20_000002_update_shipping_settings_for_bangladesh', 1),
(194, '2025_01_20_000003_remove_unused_shipping_fields', 1),
(195, '2025_01_20_000004_create_districts_table', 1),
(196, '2025_01_20_000005_create_upazilas_table', 1),
(197, '2025_01_20_000006_add_missing_shipping_settings_columns', 1),
(198, '2025_10_23_183914_create_categories_table', 1),
(199, '2025_10_23_183914_create_products_table', 1),
(200, '2025_10_23_183915_create_product_images_table', 1),
(201, '2025_10_23_183916_create_carts_table', 1),
(202, '2025_10_23_183917_create_orders_table', 1),
(203, '2025_10_23_183918_create_order_items_table', 1),
(204, '2025_10_23_183919_create_cart_items_table', 1),
(205, '2025_10_23_190126_create_admins_table', 1),
(206, '2025_10_23_192021_create_permission_tables', 1),
(207, '2025_10_23_202744_create_personal_access_tokens_table', 1),
(208, '2025_10_23_211855_create_user_addresses_table', 1),
(209, '2025_10_23_212524_create_email_settings_table', 1),
(210, '2025_10_23_213639_create_coupons_table', 1),
(211, '2025_10_23_213657_create_coupon_usages_table', 1),
(212, '2025_10_23_213716_add_coupon_fields_to_carts_table', 1),
(213, '2025_10_23_215402_create_payment_gateway_settings_table', 1),
(214, '2025_10_23_215408_create_payment_logs_table', 1),
(215, '2025_10_23_221538_create_newsletter_subscribers_table', 1),
(216, '2025_10_23_221549_create_newsletter_settings_table', 1),
(217, '2025_10_23_223108_create_currencies_table', 1),
(218, '2025_10_23_233551_create_otp_codes_table', 1),
(219, '2025_10_23_234439_create_otp_settings_table', 1),
(220, '2025_10_24_000001_update_users_email_nullable_and_phone_unique', 1),
(221, '2025_10_24_120000_create_site_settings_table', 1),
(222, '2025_10_24_130000_add_coins_to_users_and_create_user_points_table', 1),
(223, '2025_10_24_131000_create_coin_settings_table', 1),
(224, '2025_10_24_132000_add_referral_fields_to_users_table', 1),
(225, '2025_10_24_134000_create_shipping_settings_table', 1),
(226, '2025_11_04_120000_create_wishlists_table', 1),
(227, '2025_11_04_120100_add_wishlist_enabled_to_site_settings', 1),
(228, '2025_11_04_120200_create_guest_wishlists_table', 1),
(229, '2025_11_07_022231_create_product_reviews_table', 1),
(230, '2025_11_07_022251_add_review_settings_to_site_settings_table', 1),
(231, '2025_11_07_023046_add_newsletter_settings_to_site_settings_table', 1),
(232, '2025_11_07_024826_add_customer_service_links_to_site_settings_table', 1),
(233, '2025_11_07_025029_create_pages_table', 1),
(234, '2025_11_08_190255_add_product_display_columns_to_site_settings_table', 1),
(235, '2025_11_08_205615_add_schema_sitemap_settings_to_site_settings_table', 1),
(236, '2025_11_08_212732_add_tracking_codes_to_site_settings_table', 1),
(237, '2025_11_15_210150_update_shipping_settings_table_add_flat_rate', 1),
(238, '2025_11_29_205046_add_tax_settings_to_shipping_settings_table', 1),
(239, '2025_11_29_212009_remove_union_fields_from_orders_table', 1),
(240, '2025_11_29_212144_remove_unused_shipping_settings_fields', 1),
(241, '2025_11_29_213039_add_bangladeshi_fields_to_user_addresses_table', 1),
(242, '2025_11_29_213506_remove_unused_city_fields_from_orders_table', 1),
(243, '2025_11_29_214554_simplify_currencies_table', 1),
(244, '2025_11_29_230952_add_sms_package_and_sandbox_to_otp_settings_table', 1),
(245, '2025_11_29_232138_add_smtp_settings_to_email_settings_table', 1),
(246, '2025_11_29_235516_add_page_builder_to_products_table', 1),
(248, '2025_11_30_002354_create_storage_settings_table', 2),
(249, '2025_01_20_000001_update_orders_table_for_bangladesh', 3),
(250, '2025_11_30_173516_add_bangladeshi_address_fields_to_orders_table', 4),
(251, '2025_11_30_180116_add_installer_enabled_to_site_settings_table', 5),
(252, '2025_12_19_212323_add_theme_to_site_settings_table', 6),
(253, '2025_01_20_000000_add_license_key_to_site_settings', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_settings`
--

CREATE TABLE `newsletter_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `double_opt_in` tinyint(1) NOT NULL DEFAULT '0',
  `send_welcome_email` tinyint(1) NOT NULL DEFAULT '0',
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local',
  `provider_config` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'subscribed',
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscribed_at` timestamp NULL DEFAULT NULL,
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shipping_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BDT',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `shipping_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_courier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unshipped',
  `billing_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `billing_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_upazila` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_union` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_upazila` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_union` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_transaction_details` text COLLATE utf8mb4_unicode_ci,
  `shipping_tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `number`, `user_id`, `status`, `subtotal`, `discount_total`, `tax_total`, `shipping_total`, `grand_total`, `currency`, `payment_method`, `payment_transaction_id`, `payment_status`, `shipping_method`, `shipping_courier`, `shipping_status`, `billing_name`, `billing_email`, `billing_phone`, `billing_address`, `billing_postcode`, `billing_country`, `billing_division`, `shipping_name`, `shipping_phone`, `shipping_address`, `shipping_postcode`, `shipping_country`, `shipping_division`, `created_at`, `updated_at`, `billing_district`, `billing_upazila`, `billing_union`, `shipping_district`, `shipping_upazila`, `shipping_union`, `payment_transaction_details`, `shipping_tracking_number`) VALUES
(1, 'T61ROOYABH', NULL, 'pending', '336.78', '0.00', '0.00', '0.00', '336.78', 'BDT', 'cod', NULL, 'failed', NULL, NULL, 'unshipped', 'Yamin', 'needyamiN@gmail.com', '01878578504', 'sada', '7400', 'Bangladesh', 'Chittagong', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-30 11:36:04', '2025-11-30 11:36:04', 'Chittagong', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '7X92YQR4FD', NULL, 'pending', '336.78', '0.00', '0.00', '0.00', '336.78', 'BDT', 'cod', NULL, 'failed', NULL, NULL, 'unshipped', 'Yamin', 'needyamiN@gmail.com', '01878578504', 'sada', NULL, 'Bangladesh', 'Dhaka', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-30 11:36:37', '2025-11-30 11:36:37', 'Dhaka', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'X6EJNYPQGV', NULL, 'pending', '336.78', '0.00', '0.00', '0.00', '336.78', 'BDT', 'cod', NULL, 'pending', NULL, NULL, 'unshipped', 'Yamin', 'needyamiN@gmail.com', '01878578504', 'sada', '7400', 'Bangladesh', 'Dhaka', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-30 11:38:10', '2025-11-30 11:38:10', 'Dhaka', 'DDD', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'GMP4Q1H0RI', 1, 'pending', '275.57', '0.00', '0.00', '0.00', '275.57', 'BDT', 'bkash', NULL, 'failed', NULL, NULL, 'unshipped', 'Test User', 'needyamin@gmail.com', '01878578504', 'sada', '7400', 'Bangladesh', 'Dhaka', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-30 11:39:43', '2025-11-30 11:39:44', 'Gazipur', 'DDD', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `line_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_sku`, `quantity`, `unit_price`, `line_total`, `created_at`, `updated_at`) VALUES
(1, 1, 213, 'Quis qui est', 'DSELZAFV', 1, '161.49', '161.49', '2025-11-30 11:36:04', '2025-11-30 11:36:04'),
(2, 1, 216, 'Nemo labore quis', 'ZRREZBNP', 1, '175.29', '175.29', '2025-11-30 11:36:04', '2025-11-30 11:36:04'),
(3, 2, 213, 'Quis qui est', 'DSELZAFV', 1, '161.49', '161.49', '2025-11-30 11:36:37', '2025-11-30 11:36:37'),
(4, 2, 216, 'Nemo labore quis', 'ZRREZBNP', 1, '175.29', '175.29', '2025-11-30 11:36:37', '2025-11-30 11:36:37'),
(5, 3, 213, 'Quis qui est', 'DSELZAFV', 1, '161.49', '161.49', '2025-11-30 11:38:10', '2025-11-30 11:38:10'),
(6, 3, 216, 'Nemo labore quis', 'ZRREZBNP', 1, '175.29', '175.29', '2025-11-30 11:38:10', '2025-11-30 11:38:10'),
(7, 4, 287, 'Odio sit sunt', 'OCUCQ5PO', 1, '275.57', '275.57', '2025-11-30 11:39:43', '2025-11-30 11:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `otp_codes`
--

CREATE TABLE `otp_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `otptable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otptable_id` bigint UNSIGNED DEFAULT NULL,
  `channel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'login',
  `expires_at` timestamp NOT NULL,
  `used_at` timestamp NULL DEFAULT NULL,
  `attempts` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otp_settings`
--

CREATE TABLE `otp_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `email_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `sms_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `length` tinyint UNSIGNED NOT NULL DEFAULT '6',
  `ttl_minutes` tinyint UNSIGNED NOT NULL DEFAULT '10',
  `max_attempts` tinyint UNSIGNED NOT NULL DEFAULT '5',
  `sms_gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_package` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sandbox_mode` tinyint(1) NOT NULL DEFAULT '0',
  `sms_masking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_api_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_sender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp_settings`
--

INSERT INTO `otp_settings` (`id`, `email_enabled`, `sms_enabled`, `length`, `ttl_minutes`, `max_attempts`, `sms_gateway`, `sms_package`, `sandbox_mode`, `sms_masking`, `sms_api_url`, `sms_api_key`, `sms_username`, `sms_password`, `sms_sender`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 6, 10, 5, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-30 11:28:26', '2025-11-30 11:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Help Center', 'help-center', '<h2>Welcome to Our Help Center</h2>\n<p>We are here to help you with any questions or concerns you may have. Below you will find answers to the most frequently asked questions.</p>\n\n<h3>Frequently Asked Questions</h3>\n\n<h4>How do I place an order?</h4>\n<p>Placing an order is easy! Simply browse our products, add items to your cart, and proceed to checkout. You can pay using various payment methods including credit cards, PayPal, or Cash on Delivery.</p>\n\n<h4>How can I track my order?</h4>\n<p>Once your order is shipped, you will receive a tracking number via email. You can use this tracking number to monitor your package\'s journey to your doorstep.</p>\n\n<h4>What if I forgot my password?</h4>\n<p>Click on the \"Forgot Password\" link on the login page. Enter your email address and we\'ll send you instructions to reset your password.</p>\n\n<h4>How do I update my account information?</h4>\n<p>You can update your account information by logging into your account and visiting the Profile section. From there, you can edit your personal details, shipping addresses, and more.</p>\n\n<h4>Do you offer international shipping?</h4>\n<p>Currently, we ship to select countries. Please check our Shipping Info page for more details about shipping destinations and rates.</p>\n\n<h3>Still Need Help?</h3>\n<p>If you can\'t find the answer you\'re looking for, please don\'t hesitate to <a href=\"/page/contact-us\">contact us</a>. Our customer service team is available to assist you.</p>', 'Help Center - Frequently Asked Questions', 'Find answers to frequently asked questions about ordering, shipping, returns, and more.', 'help center, FAQ, customer support, questions, answers', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(2, 'Shipping Info', 'shipping-info', '<h2>Shipping Information</h2>\n<p>We want to make sure your order arrives safely and on time. Here\'s everything you need to know about our shipping policies.</p>\n\n<h3>Shipping Methods</h3>\n<p>We offer several shipping options to meet your needs:</p>\n<ul>\n    <li><strong>Standard Shipping:</strong> 5-7 business days - Free on orders over $50</li>\n    <li><strong>Express Shipping:</strong> 2-3 business days - $15.00</li>\n    <li><strong>Overnight Shipping:</strong> Next business day - $25.00</li>\n</ul>\n\n<h3>Shipping Rates</h3>\n<table class=\"table table-bordered\">\n    <thead>\n        <tr>\n            <th>Order Value</th>\n            <th>Standard Shipping</th>\n            <th>Express Shipping</th>\n        </tr>\n    </thead>\n    <tbody>\n        <tr>\n            <td>Under $50</td>\n            <td>$5.99</td>\n            <td>$15.00</td>\n        </tr>\n        <tr>\n            <td>$50 - $100</td>\n            <td>FREE</td>\n            <td>$15.00</td>\n        </tr>\n        <tr>\n            <td>Over $100</td>\n            <td>FREE</td>\n            <td>$10.00</td>\n        </tr>\n    </tbody>\n</table>\n\n<h3>Processing Time</h3>\n<p>Orders are typically processed within 1-2 business days. During peak seasons or sales, processing may take up to 3 business days.</p>\n\n<h3>International Shipping</h3>\n<p>We currently ship to the following countries:</p>\n<ul>\n    <li>United States</li>\n    <li>Canada</li>\n    <li>United Kingdom</li>\n    <li>Australia</li>\n    <li>Select European countries</li>\n</ul>\n<p>International shipping rates vary by destination and are calculated at checkout.</p>\n\n<h3>Order Tracking</h3>\n<p>Once your order ships, you\'ll receive a tracking number via email. You can use this number to track your package on the carrier\'s website.</p>\n\n<h3>Shipping Restrictions</h3>\n<p>Some items may have shipping restrictions due to size, weight, or regulations. These restrictions will be noted on the product page.</p>\n\n<h3>Questions?</h3>\n<p>If you have any questions about shipping, please <a href=\"/page/contact-us\">contact our customer service team</a>.</p>', 'Shipping Information - Delivery Options & Rates', 'Learn about our shipping methods, rates, processing times, and international shipping options.', 'shipping, delivery, shipping rates, shipping methods, international shipping', 1, 2, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(3, 'Returns', 'returns', '<h2>Returns & Refunds Policy</h2>\n<p>We want you to be completely satisfied with your purchase. If you\'re not happy with your order, we\'re here to help.</p>\n\n<h3>Return Policy</h3>\n<p>You have <strong>30 days</strong> from the date of delivery to return items for a full refund or exchange.</p>\n\n<h3>Eligible Items</h3>\n<p>Items must be:</p>\n<ul>\n    <li>Unused and in original condition</li>\n    <li>In original packaging with all tags attached</li>\n    <li>Accompanied by proof of purchase</li>\n</ul>\n\n<h3>Non-Returnable Items</h3>\n<p>The following items cannot be returned:</p>\n<ul>\n    <li>Personalized or customized products</li>\n    <li>Items damaged by misuse or normal wear</li>\n    <li>Items without proof of purchase</li>\n    <li>Digital products or downloadable content</li>\n    <li>Gift cards</li>\n</ul>\n\n<h3>How to Return an Item</h3>\n<ol>\n    <li>Log into your account and go to \"My Orders\"</li>\n    <li>Select the order containing the item you want to return</li>\n    <li>Click \"Request Return\" and select the items</li>\n    <li>Print the return label provided</li>\n    <li>Package the item securely with the return label</li>\n    <li>Drop off at any authorized carrier location</li>\n</ol>\n\n<h3>Return Shipping</h3>\n<p>Return shipping costs are the responsibility of the customer unless the item was defective or incorrect. If you received a wrong or defective item, we\'ll cover the return shipping costs.</p>\n\n<h3>Refund Process</h3>\n<p>Once we receive your return:</p>\n<ul>\n    <li>We\'ll inspect the item within 2-3 business days</li>\n    <li>If approved, your refund will be processed</li>\n    <li>Refunds are issued to the original payment method</li>\n    <li>You\'ll receive your refund within 5-10 business days</li>\n</ul>\n\n<h3>Exchanges</h3>\n<p>We currently don\'t offer direct exchanges. To exchange an item:</p>\n<ol>\n    <li>Return the original item following the return process</li>\n    <li>Place a new order for the item you want</li>\n</ol>\n\n<h3>Damaged or Defective Items</h3>\n<p>If you receive a damaged or defective item, please contact us immediately. We\'ll arrange for a replacement or full refund, including return shipping costs.</p>\n\n<h3>Questions?</h3>\n<p>If you have questions about returns or need assistance, please <a href=\"/page/contact-us\">contact us</a>. Our customer service team is happy to help!</p>', 'Returns & Refunds Policy - Easy Returns', 'Learn about our return policy, how to return items, refund process, and return shipping information.', 'returns, refunds, return policy, exchange, return shipping', 1, 3, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(4, 'Contact Us', 'contact-us', '<h2>Get in Touch</h2>\n<p>We\'d love to hear from you! Whether you have a question, feedback, or need assistance, our team is here to help.</p>\n\n<h3>Contact Information</h3>\n<div class=\"row\">\n    <div class=\"col-md-6\">\n        <h4><i class=\"bi bi-envelope\"></i> Email</h4>\n        <p>For general inquiries: <a href=\"mailto:support@example.com\">support@example.com</a></p>\n        <p>For business inquiries: <a href=\"mailto:business@example.com\">business@example.com</a></p>\n    </div>\n    <div class=\"col-md-6\">\n        <h4><i class=\"bi bi-telephone\"></i> Phone</h4>\n        <p>Customer Service: <strong>1-800-123-4567</strong></p>\n        <p>Hours: Monday - Friday, 9:00 AM - 6:00 PM EST</p>\n    </div>\n</div>\n\n<h3>Office Address</h3>\n<p>\n    <strong>eCommerce Store</strong><br>\n    123 Commerce Street<br>\n    Business City, BC 12345<br>\n    United States\n</p>\n\n<h3>Response Time</h3>\n<p>We aim to respond to all inquiries within 24-48 hours during business days. For urgent matters, please call our customer service line.</p>\n\n<h3>Social Media</h3>\n<p>Follow us on social media for updates, promotions, and more:</p>\n<ul>\n    <li><strong>Facebook:</strong> <a href=\"#\" target=\"_blank\">@ecommercestore</a></li>\n    <li><strong>Twitter:</strong> <a href=\"#\" target=\"_blank\">@ecommercestore</a></li>\n    <li><strong>Instagram:</strong> <a href=\"#\" target=\"_blank\">@ecommercestore</a></li>\n    <li><strong>LinkedIn:</strong> <a href=\"#\" target=\"_blank\">eCommerce Store</a></li>\n</ul>\n\n<h3>Frequently Asked Questions</h3>\n<p>Before contacting us, you might find the answer in our <a href=\"/page/help-center\">Help Center</a> or <a href=\"/page/shipping-info\">Shipping Info</a> pages.</p>\n\n<h3>Feedback</h3>\n<p>We value your feedback! If you have suggestions on how we can improve our service, please don\'t hesitate to reach out. Your input helps us serve you better.</p>', 'Contact Us - Get in Touch', 'Contact our customer service team via email, phone, or visit our office. We\'re here to help!', 'contact, customer service, support, email, phone, address', 1, 4, '2025-11-30 11:08:18', '2025-11-30 11:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_settings`
--

CREATE TABLE `payment_gateway_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `gateway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_encrypted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateway_settings`
--

INSERT INTO `payment_gateway_settings` (`id`, `gateway`, `key`, `value`, `description`, `is_encrypted`, `created_at`, `updated_at`) VALUES
(1, 'stripe', 'enabled', '0', 'Enable or disable Stripe payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(2, 'stripe', 'publishable_key', 'pk_test_51Q4QjQRPJ7xXyZxZ1234567890abcdefghijklmnopqrstuvwxyz', 'Stripe publishable key (starts with pk_)', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(3, 'stripe', 'secret_key', 'eyJpdiI6ImlJRjJ0V2ZlN3RpNHIwSVlCS2ZVbFE9PSIsInZhbHVlIjoic3JldWZ5RTBHN2JvdzNsNHBmcmc1N1RMSnhJRkZ3S1FDZm9LOWlSa1Y0UDluK0dzTjBpQ2t2V0tsYXhxOU1OeFRLcm5oL2ZocnNEZTlRVzlCM2sxOXZTbFRZSkNsUksrVHNucm1UdnNQbDQ9IiwibWFjIjoiNWRlOTIzOTU5M2UwMTlkY2JhMDcwMjVmMGU1NGM4Nzc4ZWUwMzEzODQ5MDQ3ZThhNWM0YjA4YzBiZTk5NDNiOCIsInRhZyI6IiJ9', 'Stripe secret key (starts with sk_)', 1, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(4, 'stripe', 'webhook_secret', 'eyJpdiI6IkRwS01iZVZrTmlKZHZxWi81eUVWNXc9PSIsInZhbHVlIjoiWmsrNXJrOGdlRzBQVDZMeE5uSGV4dXVNUmsrMWJoempsT0JhNEw0SEQ2SGdQczB3SzYzc1JCdXBhS2VWanFmUTNsYWFDRlZHekl1aGpJb1BqNFhnUEE9PSIsIm1hYyI6IjdhZTc5MmRmOTk2YTI5MTU4MWQ1OWU1OTdmYzk4ZjQ3OGM3YjM0NjA1MTJjMDcyYzEyYzRmMjMzODFiYmE5ZWYiLCJ0YWciOiIifQ==', 'Stripe webhook endpoint secret', 1, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(5, 'stripe', 'sandbox_mode', '1', 'Use Stripe test mode for testing', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(6, 'paypal', 'enabled', '0', 'Enable or disable PayPal payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(7, 'paypal', 'client_id', 'sb-client_id_1234567890', 'PayPal application client ID', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(8, 'paypal', 'client_secret', 'eyJpdiI6IkxlT1UzZEdoQTJrUUpiNVBMT1NSWlE9PSIsInZhbHVlIjoiWU85azF1SGRiSktRZnVicVY5cEpabHBBajd2MW0vN0tCYlBleG5idnNuRkxidFUrT2ZsSVRiMlBTeG9sOGlvbiIsIm1hYyI6IjIxZGVlZWNhNmFkNmIyOGI5ZGM4NDk5YWFiODEyNjZmOTdhODE2MmZlNDBlNWY5MDc3ZTlhMjA5NWE0ZTgyMzYiLCJ0YWciOiIifQ==', 'PayPal application client secret', 1, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(9, 'paypal', 'sandbox_mode', '1', 'Use PayPal sandbox for testing', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(10, 'bkash', 'enabled', '0', 'Enable or disable bKash payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(11, 'bkash', 'api_key', '4f6o0cjiki2rfm34kfdadl1eqq', 'bKash App Key (from bKash merchant panel)', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(12, 'bkash', 'api_secret', 'eyJpdiI6IkFzMDlYcUNGcmdRQkxQc3owMDNCRGc9PSIsInZhbHVlIjoia2ppMlZ2WUpKeWNVM3djY1Y3YnM2NVlPRHdOcGx6NkNWNFZlREJZakswVlB0NkJLbEowTGFpNmg5ZDBaeC9OdyIsIm1hYyI6ImUyNDM3N2ZlNmY5N2VlMWYyZmJlZThkNzhlNTdiODg5OTE2NzJmNDY1ZDk0YzkyNTdkYjRjMWRkZGJjYmQwZDIiLCJ0YWciOiIifQ==', 'bKash App Secret (from bKash merchant panel)', 1, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(13, 'bkash', 'username', 'sandboxTokenizedUser02', 'bKash Username (for tokenized checkout)', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(14, 'bkash', 'password', 'eyJpdiI6IlZ4azhSaytqVjlXY3FpakV3Smgyc1E9PSIsInZhbHVlIjoiMFpMVEE1aXZIOTdLY2VKb3d5alc1aTVwNHEvODZha0U4TWJNS1o5Z2JJSU83MU5Wb1dFbThqd0E5YWtLUmh3ciIsIm1hYyI6IjYwNGNjOTNlODQyMjBhOWNmMjI2MTIxYmU2NzQwNjc0NDlhMGI4MzZlYjRhMWE3YjA1NTA4OGE3NWZiYTlkZjAiLCJ0YWciOiIifQ==', 'bKash Password (for tokenized checkout)', 1, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(15, 'bkash', 'sandbox_mode', '1', 'Use bKash sandbox for testing', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(16, 'nagad', 'enabled', '0', 'Enable or disable Nagad payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(17, 'nagad', 'merchant_number', '017XXXXXXXX', 'Nagad merchant account number', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(18, 'nagad', 'api_key', 'nagad_test_api_key_1234567890', 'Nagad API key', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(19, 'nagad', 'api_secret', 'eyJpdiI6IjVRSEtPU3JMRkdrcEpwNTMvWmRBVGc9PSIsInZhbHVlIjoieGtRMFdra3duektsdmZ0UmJEY1MyVTY3aXRaZ0lyYjJudUUvRnRmb1B0M1JIWjM3dWpTMkZXbkZxWmRxakY2KyIsIm1hYyI6IjUzY2RiZDhmZWFmNDQ4ZDg0MWNiYWYyZTM5Mjk0NjAyNjVjZmVhNzk0MmU3ZWU0M2NmYWY3YjI3OGYzYzljNjciLCJ0YWciOiIifQ==', 'Nagad API secret', 1, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(20, 'nagad', 'sandbox_mode', '1', 'Use Nagad sandbox for testing', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(21, 'rocket', 'enabled', '0', 'Enable or disable Rocket payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(22, 'rocket', 'merchant_number', '017XXXXXXXX', 'Rocket merchant account number', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(23, 'rocket', 'api_key', 'rocket_test_api_key_1234567890', 'Rocket API key', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(24, 'rocket', 'api_secret', 'eyJpdiI6Ik9MNDk5N1FRTVRJZjdSVHEyMnpOUnc9PSIsInZhbHVlIjoiVEw3bFcwZ0JPS0JtQlZmWmZxVXlLTDBpb0lkU1BZTDB6bXpYTnlFMm1ZZndCYmpualpsREMyZUtGTW55a3ByVSIsIm1hYyI6IjA3NDczODYzYThkOGUxNDM0MmJjZDlhMjA2MDRlZjdlYTM5NWRhMWJkZDhhYTQ2ZmI3YzIyMzBhOGQ1NWZjMmQiLCJ0YWciOiIifQ==', 'Rocket API secret', 1, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(25, 'rocket', 'sandbox_mode', '1', 'Use Rocket sandbox for testing', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(26, 'ssl_commerce', 'enabled', '0', 'Enable or disable SSL Commerce payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(27, 'ssl_commerce', 'store_id', 'testbox', 'SSL Commerce store ID', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(28, 'ssl_commerce', 'store_password', 'eyJpdiI6ImNlWDNPUUFiUFlhN1NiUXIvRDhGcnc9PSIsInZhbHVlIjoiZUR4dnBOV2JOMHBFQ2dzYlBwN3haQT09IiwibWFjIjoiMjAzMTQ1NWM2NmQwYTAyZTE4MzEyYTVlYzU0MzdmNmE1YmI4MTYxMzU1MDA4N2UxMzE4YTJiMTg5NmE5NzAzYiIsInRhZyI6IiJ9', 'SSL Commerce store password', 1, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(29, 'ssl_commerce', 'api_url', 'https://sandbox.sslcommerz.com', 'SSL Commerce API URL', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(30, 'ssl_commerce', 'success_url', 'http://localhost/payment/ssl-commerce/success', 'URL to redirect after successful payment', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(31, 'ssl_commerce', 'fail_url', 'http://localhost/payment/ssl-commerce/fail', 'URL to redirect after failed payment', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(32, 'ssl_commerce', 'cancel_url', 'http://localhost/payment/ssl-commerce/cancel', 'URL to redirect after cancelled payment', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(33, 'ssl_commerce', 'sandbox_mode', '1', 'Use SSL Commerce sandbox for testing', 0, '2025-11-30 11:08:18', '2025-11-30 12:25:45'),
(34, 'cod', 'enabled', '1', 'Enable or disable Cash on Delivery payment method', 0, '2025-11-30 11:36:24', '2025-11-30 12:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `gateway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_logs`
--

INSERT INTO `payment_logs` (`id`, `gateway`, `action`, `data`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 'bkash', 'payment_error', '\"{\\\"error\\\":\\\"cURL error 6: Could not resolve host: tokenized.sandbox.bkash.sh (see https:\\\\\\/\\\\\\/curl.haxx.se\\\\\\/libcurl\\\\\\/c\\\\\\/libcurl-errors.html) for https:\\\\\\/\\\\\\/tokenized.sandbox.bkash.sh\\\\\\/tokenized\\\\\\/checkout\\\\\\/token\\\\\\/grant\\\",\\\"order_id\\\":4}\"', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', '2025-11-30 11:39:44', '2025-11-30 11:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin.captcha', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(2, 'admin.users.lookup', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(3, 'admin.dashboard', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(4, 'admin.categories.check-slug', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(5, 'admin.categories.index', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(6, 'admin.categories.create', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(7, 'admin.categories.store', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(8, 'admin.categories.show', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(9, 'admin.categories.edit', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(10, 'admin.categories.update', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(11, 'admin.categories.destroy', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(12, 'admin.products.lookup', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(13, 'admin.products.json', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(14, 'admin.products.check-slug', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(15, 'admin.products.page-builder', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(16, 'admin.products.page-builder.save', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(17, 'admin.products.images.delete', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(18, 'admin.products.images.set-primary', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(19, 'admin.products.images.update-order', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(20, 'admin.products.index', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(21, 'admin.products.create', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(22, 'admin.products.store', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(23, 'admin.products.show', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(24, 'admin.products.edit', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(25, 'admin.products.update', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(26, 'admin.products.destroy', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(27, 'admin.orders.create', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(28, 'admin.orders.store', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(29, 'admin.orders.index', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(30, 'admin.orders.show', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(31, 'admin.orders.update', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(32, 'admin.orders.invoice', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(33, 'admin.users.index', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(34, 'admin.users.show', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(35, 'admin.users.edit', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(36, 'admin.users.update', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(37, 'admin.users.destroy', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(38, 'admin.users.reset-password', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(39, 'admin.users.toggle-status', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(40, 'admin.users.coins.adjust', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(41, 'admin.users.coins.reset', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(42, 'admin.shipping-settings.index', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(43, 'admin.shipping-settings.update', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(44, 'admin.email-settings.index', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(45, 'admin.email-settings.update', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(46, 'admin.email-settings.test', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(47, 'admin.storage-settings.index', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(48, 'admin.storage-settings.update', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(49, 'admin.roles.index', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(50, 'admin.roles.create', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14'),
(51, 'admin.roles.store', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(52, 'admin.roles.edit', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(53, 'admin.roles.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(54, 'admin.roles.destroy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(55, 'admin.roles.copy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(56, 'admin.roles.copy.store', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(57, 'admin.permissions.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(58, 'admin.permissions.create', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(59, 'admin.permissions.store', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(60, 'admin.permissions.edit', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(61, 'admin.permissions.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(62, 'admin.permissions.destroy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(63, 'admin.coupons.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(64, 'admin.coupons.create', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(65, 'admin.coupons.store', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(66, 'admin.coupons.edit', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(67, 'admin.coupons.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(68, 'admin.coupons.destroy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(69, 'admin.coupons.toggle-status', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(70, 'admin.newsletter.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(71, 'admin.newsletter.toggle', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(72, 'admin.newsletter.destroy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(73, 'admin.reviews.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(74, 'admin.reviews.approve', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(75, 'admin.reviews.reject', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(76, 'admin.reviews.destroy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(77, 'admin.payment-gateways.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(78, 'admin.payment-gateways.show', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(79, 'admin.payment-gateways.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(80, 'admin.payment-gateways.toggle-status', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(81, 'admin.payment-gateways.test', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(82, 'admin.otp-settings.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(83, 'admin.otp-settings.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(84, 'admin.api.categories.subcategories', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(85, 'admin.activities.carts', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(86, 'admin.activities.wishlists', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(87, 'admin.activities.sessions', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(88, 'admin.activities.sessions.destroy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(89, 'admin.activities.sessions.destroy-user', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(90, 'admin.coupons.preview', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(91, 'admin.currencies.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(92, 'admin.currencies.create', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(93, 'admin.currencies.store', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(94, 'admin.currencies.edit', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(95, 'admin.currencies.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(96, 'admin.currencies.destroy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(97, 'admin.currencies.toggle', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(98, 'admin.currencies.default', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(99, 'admin.site-settings.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(100, 'admin.site-settings.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(101, 'admin.admins.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(102, 'admin.admins.create', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(103, 'admin.admins.store', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(104, 'admin.admins.edit', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(105, 'admin.admins.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(106, 'admin.admins.destroy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(107, 'admin.coin-settings.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(108, 'admin.coin-settings.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(109, 'admin.pages.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(110, 'admin.pages.create', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(111, 'admin.pages.store', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(112, 'admin.pages.show', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(113, 'admin.pages.edit', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(114, 'admin.pages.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(115, 'admin.pages.destroy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(116, 'admin.districts.index', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(117, 'admin.districts.create', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(118, 'admin.districts.store', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(119, 'admin.districts.show', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(120, 'admin.districts.edit', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(121, 'admin.districts.update', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(122, 'admin.districts.destroy', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(123, 'admin.districts.toggle-status', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(124, 'admin.datatables', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15'),
(125, 'admin.logout', 'admin', '2025-12-19 15:28:27', '2025-12-19 15:28:27'),
(126, 'admin.license.activate', 'admin', '2025-12-20 13:50:30', '2025-12-20 13:50:30'),
(127, 'admin.license.activate.post', 'admin', '2025-12-20 13:50:30', '2025-12-20 13:50:30'),
(128, 'admin.license.remove', 'admin', '2025-12-20 13:50:30', '2025-12-20 13:50:30'),
(129, 'admin.license.check', 'admin', '2025-12-20 13:50:30', '2025-12-20 13:50:30'),
(130, 'admin.backup.index', 'admin', '2025-12-20 13:50:30', '2025-12-20 13:50:30'),
(131, 'admin.backup.export-product', 'admin', '2025-12-20 13:50:30', '2025-12-20 13:50:30'),
(132, 'admin.backup.export-all', 'admin', '2025-12-20 13:50:30', '2025-12-20 13:50:30'),
(133, 'admin.backup.import', 'admin', '2025-12-20 13:50:30', '2025-12-20 13:50:30'),
(134, 'admin.backup.process-import', 'admin', '2025-12-20 13:50:30', '2025-12-20 13:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `compare_at_price` decimal(10,2) DEFAULT NULL,
  `stock` int UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `use_custom_page` tinyint(1) NOT NULL DEFAULT '0',
  `page_builder_data` json DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `short_description`, `description`, `price`, `compare_at_price`, `stock`, `is_active`, `is_featured`, `use_custom_page`, `page_builder_data`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Qui placeat dolor', 'qui-placeat-dolor-uMEJ0', 'EUIQVSEN', 'Et ullam itaque saepe ut molestiae dolorum ut natus dolorem.', 'Accusamus autem laudantium mollitia nemo non facere. Odit quis et quae enim accusamus. Repellendus quas animi ea dignissimos ducimus dolor. Et ut rem cum sequi ea. Aspernatur odit ex corporis iusto ad est. Et saepe perspiciatis unde tempore incidunt.', '150.91', NULL, 198, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(2, 1, 'Ullam et enim', 'ullam-et-enim-uj7GT', '4VDVQEAH', 'Magni qui placeat pariatur ab dolorum deserunt et sit qui ad dolores.', 'Et quos nulla sit adipisci eos beatae praesentium exercitationem. Ducimus repellat eveniet consequatur quia. Doloribus laboriosam sunt a voluptatem. Et aut blanditiis aut nesciunt. Quasi repellendus doloremque nam porro dignissimos eum voluptatem.', '150.99', '174.54', 141, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(3, 1, 'Architecto omnis possimus', 'architecto-omnis-possimus-AteOJ', 'LYX34AJ1', 'Voluptatem est dolorum occaecati veniam dicta voluptates unde quia hic voluptates officia maiores porro maiores rerum veniam.', 'Qui sed unde accusantium qui. Illum occaecati unde impedit et dignissimos maiores ullam. Molestiae officiis distinctio explicabo modi.', '50.77', NULL, 127, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(4, 1, 'Fugit laboriosam dolorem', 'fugit-laboriosam-dolorem-uIz3F', '96JT8JMR', 'Qui quae non tenetur incidunt ut architecto et harum beatae quis consectetur incidunt et libero.', 'Velit voluptates labore id mollitia necessitatibus. Quia qui vel pariatur nobis non. Officia corrupti vel iure aut nam veritatis. Consequuntur iure magni voluptate qui nesciunt dicta deleniti. Aliquam consequuntur temporibus odit dolorum quos dolorum.', '73.30', NULL, 75, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(5, 1, 'Eum consectetur saepe', 'eum-consectetur-saepe-6fjKI', 'CN22LFTM', 'Minima aut commodi assumenda deserunt minima qui blanditiis tempore et vero suscipit at et omnis.', 'Enim est qui eligendi quos sed modi. Enim voluptates consequatur in vero quibusdam modi laudantium. Rem a sunt ad rem neque voluptatum. Fuga nihil architecto eos ipsum.', '133.08', NULL, 127, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(6, 1, 'Ab ipsa est', 'ab-ipsa-est-JclgZ', 'XQZK8ANO', 'Velit non occaecati ut error voluptatem autem ex omnis et adipisci dolor voluptas repellat iure quod.', 'Labore consequatur recusandae rerum qui aspernatur. Eos delectus qui omnis illo. Occaecati dolorem nemo laborum maiores. Doloribus dolores eius quasi.', '123.59', NULL, 21, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(7, 1, 'Ab doloremque tempora', 'ab-doloremque-tempora-0xQEY', 'F0FSP8VK', 'Accusantium aut quia illo voluptatem est quis eos nihil voluptas magnam assumenda quas ut.', 'Harum quae quis est mollitia quos consequatur ipsam. Rerum laboriosam rerum aspernatur totam. Laborum consectetur est voluptatibus dignissimos repellendus aut sit. Commodi dolorem voluptate quo dolorum qui totam repudiandae. Labore maiores ut et et. Eos aperiam praesentium inventore maiores repellendus.', '104.53', NULL, 184, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(8, 1, 'Vitae consequatur delectus', 'vitae-consequatur-delectus-biGac', 'PHQ9QC9N', 'Harum dolores non praesentium qui quae quis maiores sint impedit ullam cupiditate adipisci blanditiis velit deserunt.', 'Quidem tenetur nihil non est. Dolor dolores provident esse iste eligendi cumque accusamus qui. Deserunt mollitia eaque rem consectetur qui aliquid. Dolores et repellat ipsam non dolorum. Ut iusto voluptatem necessitatibus sit beatae ut.', '208.81', NULL, 45, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(9, 1, 'Impedit modi dolorem', 'impedit-modi-dolorem-3nz2i', 'XKWHZFQQ', 'Et est eos placeat quo consequatur commodi suscipit ut sint animi magni rerum.', 'In excepturi voluptate esse ut velit cupiditate facilis. Et nostrum error nobis quis ducimus ut possimus. Ut eos rem accusantium dolorum accusamus. Quisquam tenetur minima voluptatem. Tempora deleniti tenetur ut aut.', '43.11', '85.70', 42, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(10, 1, 'Harum aut iste', 'harum-aut-iste-lsX3Z', 'C5CY1RMD', 'In quod qui perspiciatis molestias esse iusto illum totam commodi illo asperiores et quo est.', 'Et eos impedit qui blanditiis unde dolor. Quidem voluptas adipisci ut ut. Voluptatum cumque ipsum sint pariatur accusamus tenetur praesentium. Rerum ducimus aut ullam reprehenderit molestiae fuga.', '204.14', '225.99', 171, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(11, 1, 'Dolores tempora voluptates', 'dolores-tempora-voluptates-gqN8N', 'EV3ZDAU0', 'Commodi id aut et eveniet deleniti non delectus est aliquid ad distinctio in ut suscipit in labore.', 'Quae et laudantium nihil ut possimus. Molestiae porro veniam et beatae ut. Facere sed soluta id soluta inventore aliquid. Mollitia debitis maiores dolores sunt.', '295.63', '306.89', 9, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(12, 1, 'Animi distinctio ipsum', 'animi-distinctio-ipsum-0G05c', 'MD2RE71O', 'Dolorem unde facere corporis et qui at ut placeat odit sit.', 'Quibusdam illo necessitatibus tempora eligendi quas. Ipsam sunt eum ex qui vel eius illo id. Et quos est et placeat. Voluptas sint quasi rerum et non. Illo et quibusdam quia est sapiente. Odit non dolores ut magni quis et.', '206.81', NULL, 115, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(13, 2, 'Voluptatem consequatur magnam', 'voluptatem-consequatur-magnam-jDtaI', 'EYJ9P9BL', 'Laborum quia placeat officiis quis tempore est inventore asperiores in quibusdam perspiciatis tempore.', 'Deserunt dignissimos distinctio fugit. Delectus quas quo cum. Quisquam molestiae aperiam ea ut aut voluptatibus animi et. Repellendus et voluptatum dolor.', '46.14', '66.43', 126, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(14, 2, 'Est aut asperiores', 'est-aut-asperiores-0Gqos', 'QBRZECQV', 'Enim aspernatur doloribus provident non sit sapiente esse dolorem eaque ut beatae quia aliquid exercitationem nihil provident.', 'Aut ipsum dolore sequi exercitationem harum. Et sequi odio ea aliquam ea. Praesentium quia ipsum consequuntur molestiae dolor sed. Ab eos ut voluptate rerum.', '65.83', NULL, 7, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(15, 2, 'Sunt illum tempora', 'sunt-illum-tempora-KKDBM', 'CJR4PYSX', 'Nostrum eaque cupiditate vitae laborum velit adipisci sapiente.', 'Quia quisquam debitis aut. Soluta nesciunt atque rerum ut quibusdam. Eius vero omnis consectetur voluptas placeat.', '47.34', '72.65', 36, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(16, 2, 'Autem repellendus blanditiis', 'autem-repellendus-blanditiis-RNQ4P', 'QYZ7KQAX', 'Iure ad in adipisci veniam eum voluptatibus aut impedit quis.', 'In libero quasi aliquid ut eos molestiae earum hic. Recusandae a iure assumenda quia est. Quia occaecati id sit molestiae eum eaque qui. Distinctio sed ex autem sed error maiores. Quaerat rerum amet et velit enim.', '125.01', NULL, 194, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(17, 2, 'Totam et voluptatem', 'totam-et-voluptatem-BktIJ', '2LYVAFQE', 'Aut soluta blanditiis dolorem blanditiis illo amet sint non.', 'Magnam pariatur nemo id doloribus id qui. Ex quo omnis reprehenderit qui dolorem pariatur. Aperiam nesciunt unde ut dolor laboriosam eos quae. Minima consequatur quis repudiandae non aliquid nihil. Doloremque sit necessitatibus reiciendis autem corporis.', '9.17', NULL, 85, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(18, 2, 'Et voluptates eos', 'et-voluptates-eos-FKU1I', 'HHPNXAGU', 'Ut earum beatae iure omnis aut veniam qui provident eos reprehenderit assumenda ullam.', 'Commodi qui quia sed. Doloremque sit dolor qui nulla corrupti. Reiciendis ut ratione eaque provident odit ex dolores. Earum nisi et quo molestiae assumenda voluptatem illum. Ea commodi vel possimus.', '37.56', '81.41', 169, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(19, 2, 'Magnam nostrum vel', 'magnam-nostrum-vel-b07mB', 'VH2NDGGO', 'Vel doloremque excepturi repudiandae nostrum doloremque repellat necessitatibus doloribus architecto velit amet exercitationem aut dolorem.', 'Odit nulla occaecati reprehenderit quia. Est quia et molestiae mollitia qui dolorem vero. Dolorum dolorem laborum voluptatibus porro. Dolores pariatur odit ut minus magnam blanditiis. Perspiciatis repellendus at deserunt asperiores fuga temporibus.', '202.86', NULL, 135, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(20, 2, 'Rerum ratione ut', 'rerum-ratione-ut-sqvcN', '9SX39FMD', 'Nesciunt architecto in distinctio amet quis mollitia ducimus dolor velit perferendis qui incidunt voluptatem non sit repudiandae.', 'Ex vitae quas quia repellat omnis facere. Laborum error ipsum doloribus eaque possimus. Et tenetur esse saepe et. Debitis sit accusantium quaerat ut. Et eius et qui sint consectetur. Qui voluptatem facere harum quasi earum et molestiae.', '149.42', NULL, 124, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(21, 2, 'Nesciunt vero laborum', 'nesciunt-vero-laborum-Ilk2D', 'TBEFUTMZ', 'Nisi aut excepturi sit ut numquam fugit blanditiis autem ratione nulla ut.', 'Qui dignissimos excepturi vero repellat possimus ut fuga. Vero sint reiciendis quidem et dolor qui voluptatum. Facilis nemo quos sit debitis. Iure occaecati ex maiores rerum minima alias et. Ut quia omnis ea laboriosam voluptatibus molestias voluptatum.', '42.12', NULL, 132, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(22, 2, 'Explicabo culpa autem', 'explicabo-culpa-autem-DfTKG', 'JGCIJZZT', 'Debitis voluptatem voluptas doloremque dolores dolor inventore aut praesentium ipsa.', 'Eaque quisquam dicta omnis aut sequi quam. Consectetur voluptatem dolores laborum at ut. Nostrum reprehenderit in beatae sit rerum.', '196.41', NULL, 85, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(23, 2, 'Omnis dolor sint', 'omnis-dolor-sint-P5qSJ', 'PWVGNVMF', 'Qui porro dolorum odit et sapiente natus est repellendus est similique fugit temporibus.', 'Qui consectetur qui rerum et. Molestiae consequatur reiciendis possimus illum officia. Nam dolorem accusamus ipsum ut. Veritatis sed explicabo et aut iusto quidem est. Vitae recusandae blanditiis ducimus nam et.', '49.65', '55.45', 177, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(24, 2, 'Qui est eius', 'qui-est-eius-BCngK', 'YKCXHNVS', 'Similique autem quia quia non ipsa commodi repellendus impedit quo quia minima voluptatibus qui deserunt.', 'Architecto autem voluptatem minima veniam qui maxime quaerat. Voluptatem qui accusamus nesciunt consequatur mollitia in. Omnis at excepturi sed porro est. Tempora quis eum asperiores omnis nisi. Saepe eos facere rerum vel. Voluptatem aut a officia fugiat ut est aperiam quidem.', '197.30', '245.83', 52, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(25, 3, 'Tempora est iure', 'tempora-est-iure-Stbp5', 'QIMSDIKP', 'Est iste laboriosam saepe et minima id cum ullam et quis tempora.', 'Aperiam rem iste praesentium et nisi totam eligendi. Explicabo atque dignissimos est ullam non beatae excepturi veritatis. Explicabo exercitationem consequatur saepe cum suscipit dolor. Praesentium et qui est laudantium.', '165.51', '201.57', 169, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(26, 3, 'Ducimus voluptatem eveniet', 'ducimus-voluptatem-eveniet-14NoT', '77YWOKEC', 'Distinctio sapiente sint maxime perferendis suscipit deleniti ea eos omnis autem autem.', 'Ut quia sit sed dolores. Consectetur magni sed fugiat deserunt. Sequi et consequatur ut ipsum aut. Assumenda aspernatur dolor omnis quia ullam.', '284.52', NULL, 153, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(27, 3, 'Sunt neque ea', 'sunt-neque-ea-D5EVp', '4JK5UM8N', 'Pariatur natus voluptates ipsa quia saepe perferendis dolorem accusantium sed sed accusantium.', 'Iste est in in deleniti quae voluptas. In aliquam assumenda praesentium ab consequatur. Vel nobis aliquid quis non laboriosam voluptas ducimus. Perferendis officiis harum ex soluta. Earum aut rerum explicabo.', '156.29', '172.51', 20, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(28, 3, 'Est cum qui', 'est-cum-qui-I2eqX', 'ZGI7HRYB', 'Fuga tempore est nemo voluptatem amet sint aut.', 'Accusamus quia provident ad rerum asperiores. Nulla rerum eos labore expedita numquam labore nesciunt. Eum enim dicta recusandae quaerat aut consectetur mollitia. Mollitia laudantium neque rerum exercitationem vel aut aliquam. Ipsam eos voluptatem tempore fuga eum itaque asperiores.', '123.87', NULL, 188, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(29, 3, 'Omnis vel saepe', 'omnis-vel-saepe-OYFOv', 'TBWNACYJ', 'Eum enim possimus sequi excepturi nostrum reprehenderit eaque fugit quia.', 'Sunt reprehenderit dolores velit officiis impedit. Fugiat possimus sint eaque consequatur dolor. Et alias natus libero. Necessitatibus temporibus quia itaque.', '11.37', NULL, 69, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(30, 3, 'Temporibus necessitatibus earum', 'temporibus-necessitatibus-earum-hcvtn', 'NOGIFLLT', 'Pariatur consequatur corrupti iste quas eos totam omnis laborum minima qui hic.', 'Doloremque quisquam quis omnis quis a et natus. Velit occaecati accusantium ullam ea culpa vitae molestiae. Quos beatae quae ut aut quis corporis sequi. Veritatis deserunt rerum quibusdam voluptatem.', '89.63', NULL, 173, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(31, 3, 'Tenetur nesciunt ut', 'tenetur-nesciunt-ut-xsoCi', 'VGVVB1N9', 'Laboriosam vero autem dolor omnis assumenda ratione expedita occaecati iste quidem officiis.', 'Non inventore nostrum incidunt quos accusantium. Aut voluptatum architecto velit non perferendis. Qui corrupti voluptates impedit repudiandae quaerat sequi autem laboriosam. Quae corrupti itaque eligendi ullam mollitia et sed quasi. Excepturi quaerat quae ad.', '294.20', '309.46', 57, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(32, 3, 'Eos in autem', 'eos-in-autem-7xI3Z', 'A1EIJOZC', 'Ullam est rerum inventore voluptatum nemo nostrum ab et ea magni atque sint quia accusamus vel.', 'Eos minus nam minima quibusdam harum dolor quia. Aperiam velit rerum occaecati reprehenderit quibusdam et itaque. At expedita inventore accusamus dolor est porro nisi. Accusantium tempore deleniti qui. Officia quibusdam qui assumenda in aut.', '276.34', NULL, 160, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(33, 3, 'Vero quidem et', 'vero-quidem-et-kGxbQ', 'CDYX9SNK', 'Sit sit reiciendis incidunt asperiores accusantium dolorum itaque neque aut ipsa sequi.', 'Nulla aut temporibus velit nulla. Nisi est neque ut voluptatem. Et et fuga mollitia adipisci quasi atque. Sequi doloribus earum illo est minus sint voluptatibus.', '273.32', NULL, 69, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(34, 3, 'Quia libero sit', 'quia-libero-sit-btIQH', 'PPYGCR5W', 'At ut labore voluptatem recusandae enim nisi repellat debitis.', 'Ut blanditiis iure quae error. Rerum reiciendis quos ut a optio error. Eligendi amet quasi aperiam. Tempore incidunt a autem iure excepturi. Rerum repellendus eos voluptas placeat.', '201.76', NULL, 13, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(35, 3, 'Molestias distinctio est', 'molestias-distinctio-est-qbGbV', 'ULG0QMFX', 'Molestiae eos corporis dolore doloremque iure quaerat qui.', 'Reiciendis vel dignissimos dolores facilis consequuntur sed. Qui officiis ipsa voluptates quo quas libero. Cupiditate corrupti voluptatibus voluptatibus minima et et ducimus reprehenderit. Libero voluptas consequuntur odio quisquam adipisci. Incidunt aut provident voluptatem ab eos.', '262.26', NULL, 17, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(36, 3, 'Accusamus dolorum harum', 'accusamus-dolorum-harum-Jgoa7', 'DNZYKPWH', 'Asperiores deleniti explicabo omnis illo consequatur omnis quis magni provident et harum.', 'Illum voluptatibus qui dolore assumenda illum et est accusamus. Magni occaecati omnis sunt enim aliquam voluptate. Delectus fugiat quam repudiandae laboriosam molestiae ad.', '74.83', '76.84', 113, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(37, 4, 'Quia fugit provident', 'quia-fugit-provident-9PErL', 'G73CGVPS', 'Assumenda qui fugiat quidem laborum aperiam vitae neque natus rerum nisi ea dolorem omnis nemo ipsum.', 'Sed laborum qui nobis pariatur aut pariatur sunt. Natus a iure praesentium voluptatem sed quis quis. In quia asperiores nesciunt repellendus. Laboriosam vel vel odit vel similique. Velit aut nesciunt maxime ut.', '290.43', NULL, 22, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(38, 4, 'Beatae perspiciatis quia', 'beatae-perspiciatis-quia-fncNS', 'GFYQN408', 'Neque quis ratione dolores praesentium ut iusto molestiae quis ab vitae placeat aut dolor sequi.', 'Omnis perferendis mollitia nostrum suscipit. Dolorem esse dolor consequatur excepturi odio. Saepe delectus occaecati et laboriosam vel molestias omnis quod. Eligendi sint debitis tempora magni autem qui dignissimos aut. Labore ad qui tempora exercitationem ducimus.', '288.40', '324.67', 99, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(39, 4, 'Velit corporis voluptatem', 'velit-corporis-voluptatem-1OFKN', 'NHPKDFVY', 'Occaecati eos commodi quis recusandae quae placeat ipsum velit consectetur laborum.', 'Ipsa error eum autem voluptas sed harum. Modi tenetur accusantium recusandae rem saepe aliquid. Accusamus mollitia deserunt voluptatem aut unde est nisi.', '278.75', NULL, 28, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(40, 4, 'Nemo labore et', 'nemo-labore-et-xwVXa', 'DV4EEY9J', 'Est exercitationem ut qui tempore amet adipisci quia nostrum labore culpa deserunt dolores fugit quibusdam maxime.', 'Magni esse iusto repudiandae consectetur quod expedita consequatur. Cumque quia quo earum quo ipsum. Aut aut porro amet facere minus deleniti. Architecto eos aspernatur repellendus reprehenderit et tempora odit dolorem. Quibusdam ut iure aut nihil omnis.', '115.01', '147.83', 182, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(41, 4, 'Fugit quibusdam error', 'fugit-quibusdam-error-CB0VB', 'QNDBWXKC', 'Temporibus possimus qui saepe est aut odit praesentium consequatur rerum voluptatum ut iure temporibus dolores amet.', 'Quo molestias excepturi velit esse. Ut debitis sequi mollitia earum error doloribus. Ad veniam dolores voluptatem corrupti amet. Dicta asperiores esse nihil inventore sunt.', '51.76', NULL, 75, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(42, 4, 'Totam consequatur magni', 'totam-consequatur-magni-yWAgO', 'FRGRLRQJ', 'Et excepturi et deserunt quia ea at sit vitae sapiente ut perferendis.', 'Ipsam dicta hic et hic blanditiis. Dolor blanditiis quis et ut. Quo culpa voluptates corporis ducimus quia aut. Sapiente labore aliquid maxime. Eligendi animi sunt et fugit velit ipsa. Ab praesentium deleniti earum eos ut ut.', '48.56', '58.11', 51, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(43, 4, 'Sunt perspiciatis voluptatum', 'sunt-perspiciatis-voluptatum-ld1Xn', 'RK4C0JUU', 'Mollitia eius asperiores facilis eaque quos enim et tempora sed quam molestiae eveniet ad consequuntur quos.', 'Mollitia nihil vel rerum tempore consequatur. Est saepe sed excepturi fugiat. Sit alias consequuntur architecto qui et ea et. Sequi illo reiciendis impedit suscipit molestiae beatae. Voluptatibus maxime soluta quia dolore velit. Voluptatem et ducimus perspiciatis quas consequatur voluptas.', '89.49', NULL, 20, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(44, 4, 'Quia excepturi ratione', 'quia-excepturi-ratione-8hfZ5', 'EXOAVRKO', 'Rem quam deserunt sunt adipisci omnis dolorum dolores ab minus aut ab atque.', 'Nostrum doloribus velit esse qui et. Neque voluptatibus est iste doloremque aliquam nesciunt eum. At velit tempore tempore omnis. Reiciendis omnis illo et qui ut quibusdam.', '28.05', NULL, 198, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(45, 4, 'Beatae atque facilis', 'beatae-atque-facilis-3F9lr', '33QNWJKL', 'Voluptas suscipit rerum pariatur ex quasi esse ut et est natus rerum est est et et doloremque.', 'Molestiae quis beatae et suscipit quod hic quia. Sunt labore nemo eos. Dicta architecto animi rerum consequatur quaerat quia qui. Possimus dolores ut ipsum ut ut odit voluptas.', '210.81', NULL, 92, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(46, 4, 'Ratione et et', 'ratione-et-et-nStUH', 'ZWWF1INH', 'Commodi quibusdam quis laudantium perspiciatis repudiandae voluptas voluptatem sed id pariatur repellat.', 'Ducimus non ut omnis architecto atque et. Exercitationem asperiores modi in repellat. Omnis rerum necessitatibus deleniti maxime at officiis ratione. Ut nostrum saepe odit illum.', '255.02', NULL, 156, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(47, 4, 'Voluptatem maxime facilis', 'voluptatem-maxime-facilis-l5Bv3', '6MRA9BLQ', 'Repellendus vel autem qui explicabo aut qui iste laboriosam distinctio dolor impedit quas repudiandae est.', 'Ut et magni aut exercitationem tempora. In reprehenderit nam ipsa maiores ut eum ex. Architecto voluptatibus sint ex sapiente molestias ratione. Voluptate aliquid non consequatur consequuntur aut beatae. Qui consequatur adipisci qui accusamus ut qui quasi.', '193.38', '211.55', 166, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(48, 4, 'Nisi aut ex', 'nisi-aut-ex-3I7JX', 'B6INI68D', 'Excepturi quisquam sint tempora hic aut itaque animi.', 'Quae totam at soluta ipsum amet. Porro numquam ullam aut consequatur ea ea iste. Molestiae ullam corporis quaerat dolorem. Autem veritatis accusamus temporibus tempora neque necessitatibus.', '33.81', '62.03', 123, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(49, 5, 'Error porro itaque', 'error-porro-itaque-h8RKA', 'ESHCV5II', 'Rerum libero atque est ab beatae sint et esse labore inventore perferendis consectetur fuga aut debitis.', 'Dicta eaque laudantium reiciendis non dolores. Non accusamus eum non illum soluta consequatur. Voluptas voluptas earum est. Totam accusantium et sit ut nisi quos in.', '201.59', NULL, 96, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(50, 5, 'Esse iure nam', 'esse-iure-nam-cVkbc', 'THCLGRZW', 'Modi voluptatibus illum consectetur vel beatae voluptas et distinctio rem quas necessitatibus aut cum nihil exercitationem.', 'Dolore sed voluptatem laboriosam impedit voluptas labore. Cumque odio similique quam maxime asperiores et saepe. Et placeat rerum vero ad.', '94.20', NULL, 199, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(51, 5, 'Iusto quasi dolor', 'iusto-quasi-dolor-5ewdx', 'HIEBRUEW', 'Qui iusto sint iure atque non illo laudantium alias velit consequatur fugiat at iure.', 'Odio perferendis accusantium aut ut. Magni iure sunt est rerum. Excepturi autem non molestias atque. Consequatur ex iusto ducimus est ipsum sapiente itaque. Sed velit ex ducimus dolor qui laboriosam ipsa quas.', '35.98', '73.63', 91, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(52, 5, 'Temporibus dolor dolorem', 'temporibus-dolor-dolorem-sf3rX', 'BSWFYVGE', 'Omnis officia quidem et reprehenderit ex ea vitae omnis dolores.', 'Eius sit fuga non. Sunt repellendus ipsum nisi. Molestias est ut aut. Accusantium eos voluptatibus itaque totam tenetur et. Eius pariatur corporis libero corporis expedita. Sit tenetur iste maxime fugiat iusto.', '127.53', NULL, 74, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(53, 5, 'Dolorum quo velit', 'dolorum-quo-velit-w9NdW', 'OFK9YTUB', 'Expedita omnis temporibus fugit blanditiis quis distinctio qui voluptate ut odio sed.', 'Illum quis error omnis et et. Sit quia minima nisi dicta iste dolorem. Consequatur numquam animi blanditiis quia debitis quam enim. Recusandae quo sunt tempore eum iure et. Deleniti est velit rerum et.', '287.45', NULL, 126, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(54, 5, 'Architecto quidem nihil', 'architecto-quidem-nihil-sbyoO', '7FT9UMCG', 'Ut ex veritatis laudantium aut autem ea voluptatem iusto beatae eius soluta exercitationem.', 'Aut autem ducimus est id sunt enim earum. Qui temporibus itaque necessitatibus vitae aperiam. Voluptas quis aut unde distinctio dicta minima iure. Eligendi ipsum atque beatae ut aperiam.', '45.97', '91.29', 51, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(55, 5, 'Aut quod ea', 'aut-quod-ea-evyst', '3UYRYSTU', 'Est voluptatum ea voluptatem assumenda eos et tenetur architecto.', 'Veritatis autem laudantium occaecati voluptatem et occaecati occaecati. Eius reiciendis perferendis quibusdam occaecati animi repellat doloremque. Voluptas quia distinctio accusamus saepe quidem. Amet neque minus ut impedit. Aut nemo soluta magni exercitationem eum consequatur consequuntur. Non modi eum facilis vel dignissimos laborum blanditiis.', '9.69', NULL, 95, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(56, 5, 'Odit tempora perspiciatis', 'odit-tempora-perspiciatis-mOxbm', 'JLBS88HS', 'Ut nostrum dolorem corporis quos eos natus repudiandae tempore provident rerum quod fugiat eligendi enim.', 'Omnis sit explicabo enim et aut et. Dolorum qui voluptatibus dicta. Quas ea voluptates nostrum vero. Ut quibusdam aspernatur quasi est.', '110.35', NULL, 103, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(57, 5, 'Consequatur voluptatem velit', 'consequatur-voluptatem-velit-bZdEa', 'SONUZQTI', 'Quia praesentium quis minima aliquid placeat sequi doloremque molestias impedit voluptas ut dolor.', 'Voluptatem et doloribus et. Provident facilis nam illo unde rem. Blanditiis molestias asperiores similique. Maiores possimus omnis illo deleniti quia accusantium laudantium. Aliquam quae qui mollitia fugiat nihil possimus itaque explicabo.', '225.56', NULL, 62, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(58, 5, 'Modi magnam veritatis', 'modi-magnam-veritatis-UY4Q2', 'CDNJORGM', 'Eos nam pariatur eveniet est consequatur expedita mollitia dolorem modi quaerat nulla facilis aliquid et aut.', 'Quaerat eaque ut cumque. Mollitia omnis accusantium ipsum vitae. Soluta laborum laudantium tenetur amet. Unde ipsa inventore sed aut.', '189.33', '227.74', 103, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(59, 5, 'Provident voluptas numquam', 'provident-voluptas-numquam-VhEd3', 'ZH7KJTPW', 'Vel animi iste consequuntur omnis deserunt dolorem qui.', 'Aut nihil necessitatibus et quisquam consectetur voluptatem maxime. Illum modi harum autem labore aliquid temporibus omnis. Optio sint dolores officiis porro numquam. Aperiam reprehenderit eius rerum sequi laborum. Corrupti dolor nemo quam commodi. Est iusto eligendi soluta dignissimos adipisci voluptas libero.', '291.87', '302.88', 145, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(60, 5, 'Adipisci officiis libero', 'adipisci-officiis-libero-MOWqD', 'VOWAAZT5', 'Et ipsam omnis et veniam excepturi voluptate beatae odit voluptatem ea magni voluptate natus.', 'Sed velit quaerat commodi harum rerum nihil sint. Est fugiat beatae iste voluptatem eligendi. Aut dolore excepturi cumque similique. Sunt molestiae vitae molestiae ipsum illo nulla magnam. Et nobis aliquam voluptatibus non ea in occaecati incidunt.', '209.16', '241.18', 70, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(61, 6, 'Quis excepturi voluptatum', 'quis-excepturi-voluptatum-NXrhT', '49WRFBOM', 'Aperiam et qui eveniet amet veritatis excepturi quas eius qui laboriosam est et perferendis.', 'Minus alias harum ut aspernatur placeat dolorem possimus. Labore neque saepe dicta optio corrupti. Consequatur rerum porro et dolores. Voluptas incidunt a dicta at hic. Odit corporis facilis minima ipsam quo. Qui ratione qui labore quas aliquam quia.', '69.60', NULL, 27, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(62, 6, 'Aperiam totam expedita', 'aperiam-totam-expedita-15gs3', '3HTBUQBK', 'Quo asperiores aut sequi quae nulla voluptate corrupti deleniti velit expedita fugit necessitatibus.', 'Officia tempora adipisci sunt ducimus est. Iusto vitae sed dolor quis ut. Aspernatur voluptas dolor dicta quam repellat natus aspernatur. Omnis maiores aut aut eaque fugit officiis in. Officiis ipsum expedita magni error nostrum laudantium illum.', '147.90', '183.78', 30, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(63, 6, 'Voluptas dicta pariatur', 'voluptas-dicta-pariatur-UUbwg', '7ASPBYKE', 'Vero quo tempora voluptatem totam quasi occaecati deleniti et ullam eum beatae rem.', 'Voluptatem quos ullam vitae dolorem. Repellat aperiam qui cum voluptatem. Soluta nemo consectetur deleniti et explicabo maxime et. Veritatis magnam maxime quam qui. Et cum ut est vel modi. Nemo sunt dolores nostrum vel placeat officia aut.', '45.91', NULL, 118, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(64, 6, 'Atque eum voluptatibus', 'atque-eum-voluptatibus-jOOqg', 'VDT1SYED', 'Non quis totam omnis est distinctio ab aut enim ut et quo neque.', 'Dolor rerum excepturi repudiandae quae blanditiis aut. Rem omnis cum harum itaque. Non ea ut nulla itaque.', '174.96', NULL, 66, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(65, 6, 'Exercitationem praesentium ea', 'exercitationem-praesentium-ea-8ny9f', 'YIFWEAKX', 'Et est iusto veritatis minus voluptas ex eius ullam aut blanditiis deleniti est soluta.', 'Tenetur quis esse eum voluptatem beatae nihil quas. A quia unde sint sint quasi atque et nemo. Qui cumque rerum dolorem. Enim quis voluptas rerum quas cumque.', '132.29', NULL, 61, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(66, 6, 'Quo molestiae cumque', 'quo-molestiae-cumque-rYliR', '47RKSQBF', 'Voluptas optio sed esse velit repellat consequuntur exercitationem similique aliquam atque neque debitis laborum temporibus.', 'Dolor earum dolorum eius voluptatum quae ad iusto eius. Laboriosam corporis est adipisci expedita tempora. Et sit facere est adipisci id. Dolorem eum consectetur nesciunt non ut.', '163.47', NULL, 112, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(67, 6, 'Aut repudiandae delectus', 'aut-repudiandae-delectus-i5DkS', 'VXOKCXT2', 'Perspiciatis earum autem quod neque perferendis et distinctio quibusdam beatae.', 'Veritatis voluptatum et non quo et neque. Ratione aliquam ipsum veritatis vel. Ut dolor earum pariatur nihil vitae.', '44.52', NULL, 126, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(68, 6, 'Aliquid vitae itaque', 'aliquid-vitae-itaque-9X7yd', 'FFWD5I7B', 'A voluptas tempore vitae fugiat est omnis omnis quo nesciunt quia et alias omnis enim blanditiis.', 'Esse laboriosam autem quod dolore officiis eligendi. Ratione aliquid modi velit. Delectus quia quis minus sit sed repellendus tempore ipsum. Soluta dolor distinctio omnis. Autem minima in reiciendis et nihil.', '74.05', NULL, 200, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(69, 6, 'Quo enim ipsa', 'quo-enim-ipsa-7tDp3', 'YZQSUOHJ', 'Aut aliquid sit impedit doloremque qui velit quo est.', 'Aut nobis necessitatibus doloribus. Facere in repellendus aperiam voluptatem minus aut doloribus. Quo ad est maiores. Est ut odio delectus praesentium. Culpa harum consequuntur velit sequi. Quos quo ipsa tempora inventore excepturi voluptatibus enim aut.', '50.80', NULL, 131, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(70, 6, 'Dolorem non nemo', 'dolorem-non-nemo-8G8Pu', '9TMZPMI2', 'Illum saepe minus at nihil voluptate ad incidunt facilis recusandae mollitia tempora molestias est.', 'Occaecati reiciendis fugit quas non rerum et rerum. Porro inventore culpa distinctio velit commodi et sed. Quas sunt molestias et incidunt. Architecto error exercitationem et quia porro voluptas sed. Laborum sunt sit quia quo eligendi. Minima velit eaque velit dolorem.', '174.38', NULL, 107, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(71, 6, 'Nisi autem esse', 'nisi-autem-esse-M2Lyu', 'IHIQGX2S', 'Ut ipsum et dignissimos et voluptas est accusantium voluptatem nisi inventore delectus quis rerum nulla.', 'Harum illum nobis et dolorem quia. Et inventore autem laborum nobis dolores ducimus eum. Iusto debitis cum ex et consectetur reiciendis in. Error illum ducimus voluptas vel ullam qui praesentium eaque.', '246.80', NULL, 75, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(72, 6, 'Doloremque excepturi porro', 'doloremque-excepturi-porro-gemiF', 'ETWZHIU1', 'Commodi et nam in ipsam enim ab itaque sit consequatur et sequi illo vitae.', 'Voluptas necessitatibus illo tempora adipisci. Omnis quisquam aut sunt suscipit nihil. Quos quo quaerat doloremque. Et quia similique voluptatibus quo aperiam aut.', '264.57', '276.66', 117, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(73, 7, 'Corrupti nulla cumque', 'corrupti-nulla-cumque-y4gm9', 'E5LFNKI9', 'Molestias iusto aliquam sapiente officia corrupti amet eius consequatur labore.', 'Possimus totam facilis ut minima aliquid. Qui ducimus est nihil sed repellat blanditiis exercitationem dicta. Consequatur magni quam laborum est saepe facere. Dolore nam est repudiandae rerum. Sint quis exercitationem voluptas dolor blanditiis est quo.', '138.12', '182.62', 196, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(74, 7, 'Omnis fugiat laborum', 'omnis-fugiat-laborum-3vRW9', 'OW6J6TXD', 'Quos quidem voluptas aut et dolor occaecati harum vel nihil labore sit.', 'Sed consequatur dolorem omnis odio. Repellendus iure quidem eum doloribus. Perspiciatis id error sed quod porro. Dolor veritatis qui molestias et ipsam dolore.', '59.79', NULL, 3, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(75, 7, 'Quod dolores aut', 'quod-dolores-aut-4He7Z', 'HOM7INUY', 'In nemo aut vero aut quis qui harum est explicabo at et aut nihil id tempore.', 'Quis dolorem cupiditate est consequuntur sunt qui sunt et. Nulla ex voluptatem eius impedit. Qui aut ipsum et ipsum. Voluptatum repudiandae tempore laboriosam est eum commodi sequi. Incidunt cumque et et natus nostrum dolorum omnis. Est sit et incidunt.', '280.64', '328.93', 7, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(76, 7, 'Explicabo animi id', 'explicabo-animi-id-t8fgJ', 'CFBAH0FA', 'Quidem fugiat id et suscipit blanditiis at sint unde corporis accusamus.', 'Rerum fugit dolorem aut possimus error itaque perferendis officia. Non tenetur laborum animi voluptatem non blanditiis. Enim nobis commodi dolorem corporis alias quasi.', '21.95', NULL, 117, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(77, 7, 'Facilis voluptates possimus', 'facilis-voluptates-possimus-fGOF4', 'EZDOEWBL', 'Similique laboriosam rerum at ut laboriosam voluptates ut occaecati et.', 'Cupiditate minima optio autem. Ut ipsam dolorem laborum. Labore exercitationem et omnis quaerat laudantium dolore vel. Temporibus laudantium consequuntur et tenetur voluptate aut.', '140.97', NULL, 102, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(78, 7, 'Vel natus commodi', 'vel-natus-commodi-cZ8Kl', 'ITSHPRMB', 'Adipisci quisquam esse repudiandae sed non sunt asperiores odio esse sed eos error neque qui cumque architecto.', 'Nulla et quod doloribus dolores. Laboriosam repudiandae accusantium sint repudiandae deserunt eligendi occaecati. Nostrum magnam accusamus neque suscipit culpa dolores quisquam. Sequi laboriosam est voluptas sed nihil perferendis. Maxime aspernatur mollitia ullam reiciendis.', '256.52', NULL, 125, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(79, 7, 'Eos deserunt hic', 'eos-deserunt-hic-iW19g', 'MFLXY0JM', 'At expedita aut eos molestiae harum voluptatibus rerum autem tenetur cum tenetur expedita voluptas quis harum.', 'Dolorem minus voluptates odio cumque esse voluptatum. Nam dolore sed et voluptates alias. Quam repudiandae voluptas aut consequatur modi et. Error corporis dolorem quidem in impedit qui sed. Velit vero perferendis quis maxime quia soluta.', '55.37', NULL, 161, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(80, 7, 'Itaque rem doloremque', 'itaque-rem-doloremque-mdPlD', 'UXKZZKZ0', 'Exercitationem occaecati eos ut nihil perspiciatis doloremque ut repellat aut quo a.', 'Ut aperiam illum ipsum minus eos qui. Reiciendis nesciunt ratione atque quis. Molestias iure voluptatem magnam rerum. Et ipsum sed dolores recusandae eum quia sequi.', '149.85', '172.14', 85, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(81, 7, 'Error natus sapiente', 'error-natus-sapiente-Vp6zW', 'C93JWOGW', 'Accusantium voluptas accusamus aspernatur repellat sit quis illum aut qui et sint vel ratione mollitia.', 'Qui iure id enim sequi. Molestiae hic soluta autem autem nihil ea labore. Sint aut porro et doloremque perferendis asperiores facere. Sint quia iusto impedit saepe quisquam doloribus.', '154.70', NULL, 154, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(82, 7, 'Consequuntur aut pariatur', 'consequuntur-aut-pariatur-2Z5Gm', 'VNOPVL1E', 'Harum consequuntur nam ut modi distinctio velit quia aut quisquam dolorem ducimus expedita nihil ab nam earum.', 'Sunt quia labore natus dolor suscipit. Et quod dolorum voluptatem harum sit. Similique suscipit voluptatibus quo non. Sint sunt velit sed in. Quas iste eos fuga eveniet.', '21.84', NULL, 63, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(83, 7, 'Voluptatem incidunt corrupti', 'voluptatem-incidunt-corrupti-LVBSg', 'CC9VNAUM', 'Nesciunt delectus repellat vel totam consequatur ducimus sapiente iusto.', 'Nemo vel nostrum sed in aliquam. Est voluptas eos porro veniam et natus. Nihil aliquid sit excepturi et doloremque aspernatur. Reiciendis neque ab nulla. Fuga ut iusto eum repudiandae vero minus est. Molestiae nam sit laborum dolore eos.', '217.61', NULL, 101, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(84, 7, 'Harum est vero', 'harum-est-vero-OcvUb', '2ZYGT0AW', 'Cupiditate magni et neque deleniti est nam unde dolores repellendus laborum dolorum perferendis.', 'Distinctio nulla dicta dolore in maiores in accusantium. Qui corrupti tempore non dolores. Sequi saepe est error voluptatem cum molestias facere commodi. Dignissimos dicta delectus error possimus ea ut asperiores. Earum voluptas maxime inventore quasi dignissimos.', '171.39', NULL, 101, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(85, 8, 'Libero reiciendis et', 'libero-reiciendis-et-HgYNY', 'Q44J740H', 'Quis voluptatem officiis aliquam excepturi numquam totam fugiat et optio saepe animi quo atque autem nihil.', 'Quam quam non debitis praesentium expedita. Perferendis dolorum architecto accusantium veniam mollitia quia a. Fugit possimus qui qui saepe aut corrupti earum quisquam. Voluptatem quasi libero quas perferendis soluta maxime consectetur.', '220.17', NULL, 90, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(86, 8, 'Pariatur eius est', 'pariatur-eius-est-59lAF', 'WIRNQO9O', 'Repudiandae saepe nobis beatae doloremque esse praesentium et tenetur est ab aliquam vel.', 'Rerum officia iste possimus tempore. Qui a perspiciatis facilis. Et rem ullam facilis esse consequuntur et adipisci incidunt. Quaerat ducimus rerum similique distinctio illum et commodi consequuntur. Necessitatibus sunt qui aperiam expedita modi sit.', '175.66', NULL, 103, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(87, 8, 'Nulla consequuntur quaerat', 'nulla-consequuntur-quaerat-UvWwi', 'R1BKZR0X', 'Est omnis aut rerum amet repellendus sequi odio necessitatibus unde voluptatibus.', 'Eveniet qui occaecati voluptas praesentium eum sit. Corrupti perspiciatis voluptatem a fuga quo. Quam blanditiis quisquam delectus explicabo numquam. At fuga delectus esse quam qui. Hic et saepe perferendis sit possimus eligendi sit.', '139.86', NULL, 10, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(88, 8, 'Expedita est blanditiis', 'expedita-est-blanditiis-VQ7XH', 'NZMO2HL2', 'Nihil repudiandae reiciendis corrupti ut sed molestias vero animi minima quia nihil nobis libero.', 'Ab error quia consequuntur qui alias aperiam veritatis et. Veniam reiciendis quidem dicta consequatur est velit. Nostrum et earum facere illo dolorem vitae est. Ad eaque exercitationem est modi sed molestias sit. Non quas eius ut dolor tenetur et. Aut quod qui sed earum autem et et.', '263.51', '276.09', 80, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(89, 8, 'Enim omnis repudiandae', 'enim-omnis-repudiandae-6Bbge', 'IKMM02XM', 'Nostrum praesentium rerum sit nisi sed necessitatibus ut ea illum aut vel enim qui.', 'Necessitatibus dolorum voluptate quo expedita. Ex labore quod vel deserunt consequatur temporibus et. Sint molestias molestiae esse ullam vel ducimus. Et et debitis qui et. Aperiam aut dolorum veniam corporis.', '28.13', NULL, 105, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(90, 8, 'Natus aut omnis', 'natus-aut-omnis-Fx1b7', 'RIUKWMED', 'Quia iste repellendus reiciendis reiciendis debitis corrupti quos doloribus et minima blanditiis.', 'Ipsam id et ex iusto omnis. Tempore ex rerum omnis at qui reprehenderit. Quia libero quas sed dolorem consequatur alias. Porro numquam dolorum aut distinctio hic et. Sint perspiciatis recusandae similique maiores. Minima deserunt qui deserunt ut natus autem inventore atque.', '26.27', '72.89', 198, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(91, 8, 'Sunt repellat ut', 'sunt-repellat-ut-pvZtM', 'SNMAXCC7', 'Voluptate quasi repellat deleniti eos blanditiis fugiat et provident dolores explicabo animi dolorum qui exercitationem.', 'Mollitia quam incidunt provident id repellendus quae. Dolorem quis iusto voluptatem sit qui voluptatem. Et ex voluptas hic doloribus consectetur. Tenetur cumque odio repellendus. Laudantium excepturi doloremque autem. Eaque esse atque sed voluptatem.', '97.04', '139.08', 88, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(92, 8, 'Accusantium nemo maiores', 'accusantium-nemo-maiores-MYgv2', '6TFKNCZZ', 'Quidem assumenda sint sunt nobis distinctio tempora quibusdam quisquam molestiae repellendus facilis.', 'Quia facere facilis sequi qui qui vitae. Laudantium quidem non facere a eos et dolores officia. Aliquid fuga velit pariatur aliquid et dicta. At itaque praesentium iste fuga non ut. Blanditiis ipsum qui consectetur dolorem aut et. Exercitationem repellat modi alias vel tenetur.', '295.18', '307.36', 72, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(93, 8, 'Et perferendis suscipit', 'et-perferendis-suscipit-lyuOf', 'HQLWGRUD', 'Temporibus architecto in nesciunt et illum nemo aut aut maiores.', 'Vel dolores ex qui aspernatur esse. Laborum est nesciunt dolorum nesciunt aperiam nisi. Eaque ut omnis nostrum in nisi recusandae et. Eveniet qui libero pariatur sequi in.', '251.92', NULL, 162, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(94, 8, 'Soluta eos est', 'soluta-eos-est-DOv8e', 'WCB8KFYL', 'Ipsam necessitatibus consequuntur ut nam dignissimos sit ex porro animi libero non aliquam repellendus eveniet excepturi.', 'Maiores aut neque sint animi ipsum consequatur tenetur. Adipisci eum rerum quos quae dolore saepe aut esse. Non et provident illo adipisci. Quia laudantium et dolor sint officiis sunt et sed. Voluptatem asperiores harum odit id corrupti animi sit aut.', '272.91', NULL, 19, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(95, 8, 'Et optio dolore', 'et-optio-dolore-3rio7', '41UQQI0C', 'Doloribus officia ea est officiis tempora et vero aut aut repudiandae et voluptatibus.', 'Ut nam harum et perspiciatis voluptatem. Aut sit numquam voluptate. Fuga deleniti laborum sed praesentium.', '227.43', NULL, 187, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(96, 8, 'Et et amet', 'et-et-amet-0fkhT', 'DLRMUZWK', 'Illo id at ratione excepturi molestiae et excepturi aliquid maxime voluptatum vel dolorum id aspernatur.', 'Qui blanditiis sed quaerat veniam totam sequi aperiam. Magni optio adipisci eligendi. Iste accusamus dolor nostrum vitae qui illo libero ipsam. Qui ex sit et sequi beatae.', '38.71', NULL, 134, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(97, 9, 'Nihil reiciendis dolor', 'nihil-reiciendis-dolor-9AFEp', 'KFVSWZ98', 'Optio nihil eum et molestias nostrum aut dolores qui.', 'Dolor suscipit dolor quisquam nam. Exercitationem temporibus eaque provident facere odit cum aliquam. Vitae aut voluptate dicta repellat recusandae aut. Natus aut maiores est.', '264.34', NULL, 0, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(98, 9, 'Et qui cupiditate', 'et-qui-cupiditate-lWs7J', 'F9FMQABI', 'Doloribus pariatur nemo ipsam qui voluptas quae voluptas ex est laudantium.', 'Exercitationem aliquam sunt optio tenetur est voluptas quia. Repudiandae reprehenderit mollitia beatae odit. Unde alias possimus voluptas quae quo nesciunt. Vero quod vero aut et aliquam ducimus fuga. Ipsum esse eius nobis est et.', '240.66', '262.53', 117, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(99, 9, 'Et illum illo', 'et-illum-illo-w3Nic', 'D36INKWH', 'Illum numquam reprehenderit nobis non vitae impedit voluptas ducimus dolorum corrupti odio rerum vitae.', 'Quae quia fugiat dolorem non. Aut suscipit veritatis omnis sit voluptatem corrupti labore. Ut qui culpa qui dolorem. Veniam sapiente nihil aut quam. Occaecati rerum itaque delectus et eos eum.', '245.43', '288.31', 13, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(100, 9, 'Adipisci rerum et', 'adipisci-rerum-et-lIHTJ', 'HNFVKDTZ', 'Fuga dolore voluptatem aliquam possimus odio sit sed debitis facilis ducimus nesciunt molestias.', 'Dolor est voluptatem deserunt. Aperiam autem aliquid earum. Qui ut ea sequi consectetur quod soluta ut officiis. Numquam autem quam eos. Voluptatem repellat doloribus eum. Corrupti quae accusamus qui.', '143.76', '193.56', 60, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(101, 9, 'Nihil in odit', 'nihil-in-odit-f8qA2', 'MEGAILYC', 'Incidunt maiores magnam distinctio aut odit molestias praesentium.', 'Ut numquam facilis non eius quia suscipit dicta corporis. Quisquam nam dolores nesciunt hic vel. Maiores non id dolor et reiciendis. Eaque nemo assumenda odit consequatur.', '73.09', NULL, 145, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(102, 9, 'Dolores dolor inventore', 'dolores-dolor-inventore-YRekO', '6IKB4OPB', 'Laboriosam architecto saepe tempora sit nam incidunt minus eveniet omnis qui molestiae nesciunt eaque quia.', 'Placeat ipsam aspernatur et illo recusandae quia. Perspiciatis delectus similique magni et. Explicabo assumenda corporis rerum qui dolorem quia ut. Placeat provident mollitia exercitationem perspiciatis eum sed quos.', '238.39', '244.31', 24, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(103, 9, 'Aspernatur molestiae corporis', 'aspernatur-molestiae-corporis-FLlye', 'JRWCTK5Y', 'Expedita voluptate nihil eligendi sunt ut laudantium ab iusto consequatur qui enim et est nemo et sed.', 'Eligendi non fuga nam unde perspiciatis ea sint. Unde sint eos delectus rem at porro. Nam aspernatur facilis atque iste consequatur dolores ipsum.', '17.13', NULL, 31, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(104, 9, 'Dolorem omnis itaque', 'dolorem-omnis-itaque-ayfen', '9CTSBUUT', 'Doloremque illo a dolorum distinctio ipsa blanditiis architecto ut ducimus vel molestiae aut similique sit.', 'Molestias cumque quia rerum totam. Numquam sapiente excepturi voluptatem autem aut quia quaerat et. Ea iste consequuntur voluptas necessitatibus laboriosam repellat in. Doloremque quo omnis odit sit voluptatibus recusandae.', '271.44', '306.96', 95, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01');
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `short_description`, `description`, `price`, `compare_at_price`, `stock`, `is_active`, `is_featured`, `use_custom_page`, `page_builder_data`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(105, 9, 'Reprehenderit id consequatur', 'reprehenderit-id-consequatur-IeA1g', 'QS8FPAEA', 'Consequatur tenetur debitis vel consequatur iure labore occaecati et adipisci.', 'Placeat nihil recusandae atque assumenda. Commodi qui blanditiis quia distinctio voluptatibus a. Quis enim non amet eos aliquam id molestiae. Impedit eos et culpa id. Deleniti odio nam autem eos. Quis similique dignissimos est architecto sunt.', '49.32', NULL, 7, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(106, 9, 'Ad unde iusto', 'ad-unde-iusto-Jvcjn', 'UPTJALU8', 'Repellat sint quaerat et rerum qui qui ullam veniam quod laborum ab omnis accusantium maiores corrupti.', 'Ipsam alias reiciendis voluptas est possimus nemo. Aliquam enim labore consequatur. Enim provident error perferendis. Maiores et quo ut quasi quo dignissimos.', '193.96', NULL, 132, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(107, 9, 'Libero nulla eligendi', 'libero-nulla-eligendi-hOYGz', 'UBOZBTJV', 'Odit similique quo ut voluptate aut debitis ex temporibus minima quaerat.', 'Consequatur explicabo placeat non. Et pariatur voluptatibus non sequi quo hic consequatur. Eum ut dolorum incidunt.', '101.73', NULL, 171, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(108, 9, 'Dicta autem consequatur', 'dicta-autem-consequatur-csUyS', 'U5SLRRGA', 'Vel eveniet excepturi minima tenetur esse laudantium enim pariatur.', 'Mollitia ut voluptatum unde dolor sapiente qui quis. Numquam voluptatem et veritatis error neque. Tempora harum nisi nesciunt.', '246.32', NULL, 82, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(109, 10, 'Repudiandae ex qui', 'repudiandae-ex-qui-x2ZIM', 'AMCC570X', 'Hic qui esse sint excepturi labore eum et quo.', 'Nobis sed tempora voluptas consequatur. Sunt dignissimos facere aut dolorum consequuntur accusamus quia. Qui dicta molestiae quis mollitia est. Temporibus qui ad ipsam et. Laboriosam consequatur cupiditate porro id consequatur sed voluptatem mollitia. Dolor molestias aliquam officia vel qui voluptatibus.', '265.43', '266.78', 87, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(110, 10, 'Molestiae repudiandae quis', 'molestiae-repudiandae-quis-buGMJ', 'NOOGVLEI', 'Debitis nisi nihil est qui perferendis assumenda alias laboriosam laborum vel.', 'Eum architecto eum voluptas dolore. Aliquid eligendi ea rerum distinctio id tempora. Quo nostrum doloribus ex accusamus labore. Distinctio ab esse velit error. Pariatur laborum odit nemo iusto vel.', '295.14', NULL, 168, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(111, 10, 'Officiis mollitia aliquam', 'officiis-mollitia-aliquam-Uwr2d', 'DWYDTF8M', 'Dolore quas nobis dolores ut sed ut molestias cum eaque esse neque ut.', 'Nostrum porro et aut. Ea quia deleniti et fugiat. Repellat aut porro veritatis maxime. Asperiores sunt vel ipsa et est. Dolorem saepe odio sit fugit nihil dolorum. Culpa sint eligendi explicabo voluptas.', '202.45', '220.02', 192, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(112, 10, 'Aut est eveniet', 'aut-est-eveniet-bHfc0', '2UIFRDF2', 'Et nulla minus ut labore voluptatibus in sint totam aut quidem.', 'Sunt nostrum maxime distinctio sit provident amet nemo facilis. Voluptas quam ipsa illo non ipsum. Occaecati et minus maxime sed. Magnam qui dicta temporibus blanditiis. Nihil provident nihil ut voluptates autem.', '252.94', NULL, 26, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(113, 10, 'Non voluptate impedit', 'non-voluptate-impedit-XgGdc', 'LKSZ2IEW', 'Accusantium nulla perferendis magni in necessitatibus sed saepe deleniti nemo itaque minima deleniti exercitationem aut.', 'Dolore dolore molestiae libero cum. Molestiae autem id qui reprehenderit aut laborum iure. Excepturi repudiandae assumenda rerum dolorem ut a. Odio voluptate harum ab. Cupiditate quis fugit sunt.', '110.90', NULL, 114, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(114, 10, 'Provident quo ipsum', 'provident-quo-ipsum-o91V0', 'CATORZPF', 'Voluptatibus maxime maiores exercitationem provident aliquid voluptas sit unde neque ex et quasi enim.', 'Rerum fugit doloremque voluptatibus beatae enim est. Vitae voluptatibus hic eos dolorum minus. Dignissimos laboriosam aut qui. Necessitatibus tempora facilis dolorem natus tempore.', '243.61', '248.84', 91, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(115, 10, 'Tenetur ducimus vero', 'tenetur-ducimus-vero-Tw8dx', 'MK9NGLCG', 'Eius in voluptatum molestiae quidem nam rerum quaerat quas sequi.', 'Aut nesciunt laboriosam vitae voluptatem assumenda harum. Laborum blanditiis veniam sit dolorum. Rerum autem voluptatem necessitatibus aperiam officia excepturi. Enim dolorum tenetur ex debitis sunt aut ut.', '200.08', NULL, 4, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(116, 10, 'Consequuntur iste necessitatibus', 'consequuntur-iste-necessitatibus-53y94', 'DMIUAZXN', 'Consequatur assumenda et perspiciatis sint dolor ipsa cupiditate sit quia quisquam natus sed et omnis necessitatibus.', 'Ut omnis quis aut omnis sed quia. Consequatur ad quo aut incidunt sint cupiditate. Quos sapiente suscipit quaerat. Ipsum omnis corporis corporis qui deleniti cum aut quis.', '244.68', '294.13', 164, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(117, 10, 'Voluptatem labore aspernatur', 'voluptatem-labore-aspernatur-mP02o', 'DCHBKQDJ', 'Explicabo unde qui dolores ut enim voluptatum id architecto beatae vel sed aut sint eligendi nihil ut.', 'Provident sit provident laborum qui at. Ipsa delectus velit amet eligendi explicabo minima est. Autem expedita voluptas nisi facere rerum. Eius autem excepturi nam aut earum reiciendis. Debitis aut nesciunt voluptatum laboriosam id.', '284.53', '311.15', 187, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(118, 10, 'Et incidunt recusandae', 'et-incidunt-recusandae-9IraQ', 'UVTEKECI', 'In reprehenderit nihil dolor rerum at nesciunt cum quaerat aut sed eos occaecati praesentium.', 'Quod et possimus iusto enim ut autem et. Reprehenderit occaecati vel quasi id rerum asperiores ad. Fuga vitae dolor a adipisci. Ipsam nesciunt odio incidunt non totam voluptatem sit voluptatibus. Ut aut minima tempora.', '261.15', NULL, 58, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(119, 10, 'Harum sequi qui', 'harum-sequi-qui-nieow', 'V4CRKQY3', 'Odit eaque vitae minima velit fuga eius molestiae harum.', 'Quo ullam et tempora consequatur commodi. Nam pariatur illum sapiente quo praesentium non. Sequi quia iste consectetur. Sapiente unde provident delectus eligendi.', '113.21', NULL, 3, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(120, 10, 'Culpa vel sunt', 'culpa-vel-sunt-ipt8N', 'TMOFXP1B', 'Provident aut voluptas nostrum asperiores ipsum doloribus eum dolores qui voluptas accusantium fugiat voluptatem tenetur.', 'Sed fugiat debitis sed pariatur. Id sit vitae blanditiis accusamus dolorum itaque facere eum. Unde itaque est magni cumque. Sed ut et enim quia quos enim. Reiciendis ipsam praesentium quia culpa molestias.', '84.96', NULL, 15, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(121, 11, 'Sunt enim itaque', 'sunt-enim-itaque-cPy3W', 'RSHD22O9', 'Accusantium ab delectus suscipit vel ipsa asperiores quidem praesentium ad modi vel.', 'Corporis et voluptatum maxime. Magnam commodi rerum id magni consequuntur doloribus. Non eligendi est ea tempore animi quaerat esse. Praesentium odit dolore est magni consequatur. Excepturi rem laborum id voluptatem eum reprehenderit optio.', '82.84', '99.66', 110, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(122, 11, 'Consequatur ex eum', 'consequatur-ex-eum-jepeH', 'DBM8J5TH', 'Ad et et veritatis aliquid accusamus alias sed quisquam inventore perspiciatis rerum soluta quae doloribus dolores.', 'Ea culpa corrupti non autem debitis fuga. Sapiente ut impedit earum. Qui qui voluptatum tempore quis corporis omnis. Temporibus ut voluptate nostrum aut cupiditate velit. Incidunt hic provident sit. Ut blanditiis ea cum natus voluptates provident.', '92.94', NULL, 107, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(123, 11, 'Sapiente beatae commodi', 'sapiente-beatae-commodi-I2AAD', 'MYRH3VIY', 'Quia est ex vel atque magni in exercitationem et.', 'In totam necessitatibus vel dolor molestiae sed maiores. Maiores laboriosam dicta aut quidem qui dolore. Esse consectetur id occaecati. Vero hic dolorem dolorum perspiciatis quasi expedita deleniti. Consequatur fugit eaque aut et deleniti.', '116.02', '147.12', 148, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(124, 11, 'Optio et dolorum', 'optio-et-dolorum-WI7wc', 'NZKDART7', 'Iure aspernatur esse aspernatur voluptatum ipsum consequuntur accusamus mollitia qui.', 'Error id ex sunt nam iste tempora ut temporibus. Voluptatem voluptatem asperiores non. Doloremque vitae illum eligendi mollitia atque quis est. Eius nihil sint non tempore ut repellat quasi. Eum facilis eos natus esse occaecati porro ut fuga.', '117.83', NULL, 113, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(125, 11, 'Minus voluptatem et', 'minus-voluptatem-et-iIPPr', 'ZDSXTCFE', 'Vero consectetur deleniti porro sed cum itaque earum.', 'Dolores dolor et recusandae reprehenderit. Nihil quis illum et culpa omnis sit in non. Aperiam minus veniam reprehenderit. At quod fuga beatae ex sint architecto ratione. Voluptatem rerum ducimus incidunt odit tempora.', '111.77', '138.62', 187, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(126, 11, 'Dolorum soluta in', 'dolorum-soluta-in-DHq6d', 'PNCJHSWJ', 'Ut aut velit est molestiae non quia aut consequatur fuga necessitatibus neque libero sit repudiandae saepe.', 'Rerum veritatis odio cupiditate dolore. Magni deserunt sequi ab sit unde accusamus quisquam. Officiis autem nostrum est facilis eum sed. Sequi occaecati in nobis nobis nisi fugiat nihil voluptas.', '105.11', '108.34', 130, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(127, 11, 'Ducimus impedit dolor', 'ducimus-impedit-dolor-ZrNvu', 'SJLAP46Q', 'Repudiandae officiis asperiores odio ut nobis nostrum ex numquam vel.', 'Sed doloribus et sunt. Aut cum rem inventore eligendi eius nesciunt aut fuga. Incidunt distinctio veritatis aut corporis commodi. Accusantium est animi optio animi adipisci ratione dolorum beatae.', '281.28', '308.13', 87, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(128, 11, 'Numquam vero molestias', 'numquam-vero-molestias-jsv1a', 'VSDHGUWG', 'Aut velit at corrupti eos autem veritatis eaque.', 'Vitae voluptas iste perferendis at ad. Fuga esse aliquam voluptas aut occaecati placeat placeat. Quia praesentium in eum labore. Labore nisi natus iusto unde laboriosam perspiciatis et qui.', '246.82', '287.08', 195, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(129, 11, 'Quis quisquam sit', 'quis-quisquam-sit-IJJ3m', 'FH0EC5WA', 'Quia possimus in id animi itaque aliquid natus explicabo officia eius nobis est delectus ducimus qui repellendus.', 'Sunt et similique itaque repellendus non laudantium qui. Pariatur est ea omnis est nemo eum qui. Temporibus incidunt distinctio minus nisi non distinctio cupiditate aut. Odio nihil et ipsum dolore omnis libero.', '88.41', NULL, 190, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(130, 11, 'Earum labore voluptate', 'earum-labore-voluptate-rdCAP', 'YNKGDGYM', 'Qui qui tempora doloremque veritatis et ex quae consequatur assumenda voluptates voluptatem non quidem minus.', 'Et modi et voluptates dolor assumenda eum. Harum ut ratione ut illum quis. Cupiditate fugiat doloribus nostrum reiciendis non.', '260.01', '284.59', 3, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(131, 11, 'Officia consequatur numquam', 'officia-consequatur-numquam-4rhgn', 'WJ5FF0VP', 'Enim ad porro quis culpa neque inventore et cumque aliquid omnis magni dolor exercitationem illo officiis aliquid.', 'Voluptate alias dolor blanditiis quod qui. Non et praesentium tempora in et. Qui magni et qui reiciendis voluptatem voluptates consequatur. Ducimus ut architecto odio unde repellat consequatur odit. Exercitationem doloribus est ipsum non.', '140.72', NULL, 68, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(132, 11, 'Omnis vel minima', 'omnis-vel-minima-yHyZy', 'TOKNPNKF', 'Et dolorum et qui labore maxime maiores optio dolorem et est iste facere suscipit amet.', 'Enim quaerat unde temporibus corporis animi vel ipsa. Aliquam et rerum beatae dolorem qui. Qui consequatur corrupti eaque quia fuga aliquam ipsum. Repellendus eaque quisquam nam est consequatur maxime. Sapiente nostrum beatae cum ut. Veniam hic rerum ab.', '69.47', NULL, 186, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(133, 12, 'Voluptatem qui pariatur', 'voluptatem-qui-pariatur-XeF8P', 'U1818DT4', 'Voluptatem molestias molestiae perspiciatis unde repudiandae accusamus laudantium et dolorem consequuntur esse sint.', 'Distinctio aperiam sunt facere ut. Quibusdam et quasi accusantium est itaque similique velit. Illo dolorem enim quaerat qui distinctio. Sequi necessitatibus et ut. Non officia possimus autem placeat.', '147.72', NULL, 25, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(134, 12, 'Aut a vitae', 'aut-a-vitae-LCeAS', 'UZ6YCAIC', 'Saepe totam non voluptate iste sint eum deserunt deleniti modi.', 'Doloremque excepturi et sunt similique. Sunt assumenda adipisci dolores necessitatibus blanditiis saepe et. Velit facere sed ipsa ut laboriosam labore. Est consequatur adipisci unde ipsam molestiae rerum. Necessitatibus placeat assumenda est ab voluptatum suscipit.', '81.75', NULL, 81, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(135, 12, 'Qui incidunt debitis', 'qui-incidunt-debitis-y2RKU', '7HOKBVNT', 'Ut sint in quis aperiam amet et quo.', 'Saepe tenetur et sed repellat ratione. Debitis assumenda eum vel illum. Possimus et soluta eligendi labore eos. Nesciunt aut debitis alias deleniti. Veniam dolores dolores voluptatem quod deleniti fuga quaerat. Voluptatum qui aperiam incidunt in porro odit asperiores.', '236.18', NULL, 108, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(136, 12, 'Et dolorum est', 'et-dolorum-est-MtB4L', 'MVXJAZMF', 'Harum ea voluptas voluptates labore quia occaecati consectetur vero reprehenderit sunt sint nulla dolor explicabo itaque.', 'Repudiandae qui necessitatibus deserunt nisi iste vel. Ut modi ipsam tempora reiciendis aperiam dolorem nisi reprehenderit. Vel quae labore pariatur voluptatem. Illum explicabo est qui quia eveniet. Sit vero ipsum maxime magni sint.', '248.59', '283.12', 200, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(137, 12, 'Ullam fugit sint', 'ullam-fugit-sint-zLX1x', 'BBBDDIH9', 'Qui ut sunt architecto voluptatum eos est dolorum corporis repellat consequuntur sit nihil quia.', 'Similique rerum et esse voluptatem distinctio recusandae soluta sed. Sapiente laboriosam dolor cumque vero omnis possimus. Odit illum suscipit perferendis repellat tempora. Aut exercitationem omnis molestias in.', '29.62', NULL, 110, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(138, 12, 'Est quia sunt', 'est-quia-sunt-M9iJV', '8FZLJQYZ', 'In reprehenderit rerum aut ducimus hic doloremque consequuntur debitis nisi quaerat asperiores doloremque.', 'Rerum repudiandae necessitatibus facere. Veniam unde velit accusantium voluptatem qui eius aut. Delectus omnis error aspernatur voluptatem fugiat harum numquam. Sint est dolore neque eum.', '246.33', NULL, 35, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(139, 12, 'Voluptatibus sed unde', 'voluptatibus-sed-unde-mQkOP', '2BRVC0B7', 'Molestiae perferendis iusto et ad officia voluptas fuga autem quidem temporibus at.', 'Odit facere et illo dicta laborum. Vel occaecati veniam corporis explicabo dolores id esse. Officiis eius dolor illo.', '113.32', '123.81', 190, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(140, 12, 'Quia eos doloremque', 'quia-eos-doloremque-yc3aR', 'UGUEVCOY', 'Accusamus facilis odit consequatur et qui voluptatibus quidem quas dolor sit sint ut facere et.', 'Velit harum id dolore. Aperiam quaerat ut corporis provident ducimus beatae et harum. Reiciendis omnis neque doloribus provident laboriosam porro qui.', '282.58', '308.84', 54, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(141, 12, 'Minus ut illo', 'minus-ut-illo-hQ1PM', 'KE8LDEPW', 'Tempore molestias aut quasi quos unde unde molestiae nihil doloribus doloremque maiores et officiis.', 'Officiis architecto tempore sequi sint sed rem temporibus. Aperiam perferendis quae tenetur voluptates dolore voluptas. Ut tempore nihil quia ducimus. Aut minima voluptatem veritatis aut necessitatibus harum maiores. Placeat ipsum beatae repudiandae magnam delectus. Error facere sed illo deserunt.', '258.33', NULL, 111, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(142, 12, 'Dolorum blanditiis tenetur', 'dolorum-blanditiis-tenetur-sR7oG', '70MZ6GCF', 'Perferendis neque enim nobis voluptates officiis ut ea id velit perferendis sequi corporis.', 'Rerum doloremque tenetur sed libero est doloremque magni illum. Quisquam ut animi soluta voluptates distinctio dolores. Nam aliquam eos corporis velit maxime voluptate animi. Sed praesentium quam consequatur sed explicabo. Dolores voluptate aperiam consequatur nisi rerum. Rem sint quae eligendi.', '283.17', '325.19', 62, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(143, 12, 'Illo labore ut', 'illo-labore-ut-P4jNF', 'RDB36RX2', 'Dolor amet ex dolore ducimus et fuga ipsum et rem.', 'Recusandae porro et quos rerum ad velit et. Ad quia est occaecati qui modi eius. Nam totam neque iusto ducimus omnis. Et aut rerum qui blanditiis. Enim consectetur consequatur quia incidunt et omnis ratione. Animi voluptatibus dolorem ut placeat vitae omnis in.', '274.29', '279.92', 196, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(144, 12, 'Sed officia enim', 'sed-officia-enim-UjBCU', '1XACKBJQ', 'Modi aperiam omnis consequatur possimus eum eos facere dolorum.', 'Dolore facilis fuga et omnis libero rerum. Et laboriosam dolores non quia esse ipsum odio commodi. Iste deserunt cum eligendi numquam. Fuga vero quisquam officiis possimus sapiente.', '9.26', '45.59', 13, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(145, 13, 'Et laboriosam et', 'et-laboriosam-et-ZXoUS', '0U3YRGS0', 'Eveniet sit perferendis accusamus qui sint rem a accusamus.', 'Officia minima nisi dicta rerum commodi repellendus est ut. Est inventore veniam similique officiis. Impedit deleniti et tempore amet reprehenderit aut ullam. Explicabo rerum sapiente doloribus. Molestias repellat itaque consequatur occaecati rerum ut distinctio. Praesentium et sequi in necessitatibus quia nam delectus.', '215.49', '216.95', 87, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(146, 13, 'Dolor vitae excepturi', 'dolor-vitae-excepturi-R7bZ6', 'SOZWMSBL', 'Beatae blanditiis doloremque et rem tempora voluptas consequuntur porro et occaecati eius odio exercitationem vitae illo id.', 'Adipisci laboriosam aut doloribus hic repellendus doloremque. Illo dolores eius fugit quia assumenda enim et. Ipsum ipsam dolorem vero accusantium magnam. Illo tempore fugit ut et et id omnis.', '75.83', NULL, 191, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(147, 13, 'Architecto nisi iure', 'architecto-nisi-iure-4ziXk', 'OGVVWF9T', 'Molestiae omnis explicabo nisi enim debitis deleniti ut quas nulla provident debitis libero.', 'Repellat qui natus voluptatem voluptates. Et porro nobis nesciunt. Esse dolores perferendis in temporibus iste non.', '48.90', '72.12', 106, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(148, 13, 'Autem cupiditate inventore', 'autem-cupiditate-inventore-5VBcR', 'XEHZUALW', 'Facere porro fuga perferendis alias voluptate vitae pariatur atque minima pariatur fugit facilis numquam beatae dicta veritatis.', 'Aspernatur soluta nemo est sunt accusamus. Quibusdam labore distinctio inventore omnis. Rerum consequatur modi unde et aspernatur est enim. Est quis est omnis quod culpa. Consequatur soluta aspernatur dolores non itaque cum accusantium. Voluptate fuga at qui blanditiis illo.', '226.41', NULL, 84, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(149, 13, 'Aut atque commodi', 'aut-atque-commodi-fEguZ', 'BSI01IEZ', 'Enim voluptatem veritatis quidem alias aut minima quaerat consequatur praesentium et mollitia adipisci.', 'Dolore repudiandae quia enim rerum atque consectetur. Et et facere debitis et numquam consequatur amet. Repellendus modi voluptate dicta voluptatem velit facere ea. Laboriosam et odio laborum perspiciatis quidem quia explicabo.', '110.37', NULL, 176, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(150, 13, 'Consectetur neque explicabo', 'consectetur-neque-explicabo-Ujwnx', 'SXP5IR5O', 'Architecto delectus blanditiis sit id corrupti tenetur rerum.', 'Est omnis quasi quaerat sunt impedit. Vitae alias vel quis officia. Asperiores ullam enim nostrum nam minima earum. Explicabo quo officiis et porro et.', '254.75', '294.92', 187, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(151, 13, 'Commodi veniam quo', 'commodi-veniam-quo-iOqWu', '3EACZSHN', 'Sint et sit fuga alias laborum possimus ea provident amet ab quasi dignissimos quisquam et aut.', 'Nisi ullam quos nihil cum quisquam quia voluptatem ipsam. At eveniet quia iste voluptatem ut eligendi. Voluptatum distinctio aspernatur corporis. Suscipit fuga sunt ipsum consequuntur cupiditate qui facere necessitatibus.', '219.87', NULL, 18, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(152, 13, 'Quia modi doloremque', 'quia-modi-doloremque-Y8SYR', '5UUPZ3LC', 'Ex iusto natus laborum impedit ut accusamus in impedit architecto officia.', 'Aut excepturi delectus et aperiam blanditiis. Qui ut quod omnis praesentium voluptas iusto. Non unde sequi dignissimos neque ipsa et. Sed qui ea enim pariatur. Illo dolorum sit iusto libero sunt iure quidem.', '181.26', '185.23', 155, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(153, 13, 'Quae dolorem quia', 'quae-dolorem-quia-ZX3Br', 'DARQTFLY', 'Quo quidem aspernatur id laboriosam magni autem qui ad alias ad.', 'Aut quisquam omnis cum accusantium vitae sed ducimus voluptas. Labore sint nostrum adipisci. Culpa fuga delectus deserunt non. Fugit quia nam consectetur aliquid. Perspiciatis tempore eum distinctio sit illum. Porro nulla ut nobis qui ducimus reprehenderit perspiciatis.', '129.71', '134.34', 79, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(154, 13, 'Quia ab praesentium', 'quia-ab-praesentium-UzCqw', 'OBUAJEDA', 'Non perferendis aliquid eos qui eligendi quod quas aut illo.', 'Et molestias qui fuga quo qui asperiores modi. Esse debitis qui qui rerum non itaque exercitationem. Amet odit at id consequatur. Ut non in explicabo omnis.', '179.55', NULL, 64, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(155, 13, 'Qui aut aperiam', 'qui-aut-aperiam-CTEmC', 'XNPE1XLX', 'Excepturi eum deleniti ipsum sit optio aut vel omnis quod porro ex nobis veniam.', 'Accusantium in quaerat consequatur quo recusandae animi. Ea quo porro hic. Placeat perspiciatis id quia ea nesciunt ullam qui temporibus. Ut sit quis eos excepturi.', '159.78', NULL, 27, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(156, 13, 'Aliquam sunt consequatur', 'aliquam-sunt-consequatur-RiTsu', 'WWCZ4XUN', 'Quidem ut cumque quaerat voluptatem aliquam ut perferendis.', 'Exercitationem assumenda esse aut. Repudiandae sit saepe ullam voluptatem inventore velit vero. Reiciendis explicabo expedita provident tempore. Unde quam necessitatibus earum sunt velit. At repudiandae inventore aspernatur.', '105.07', '145.83', 76, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(157, 14, 'Neque rem id', 'neque-rem-id-5tZIC', 'FCJ2DEDK', 'Magni odit quo quia eaque consequuntur et eveniet nisi aut ut explicabo maiores ea.', 'Voluptatem iste quia vel id eligendi aut quod. Voluptates aut molestiae ea autem dolor tenetur nesciunt in. Alias nemo possimus excepturi voluptatem qui.', '49.14', NULL, 77, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(158, 14, 'Quis repellendus culpa', 'quis-repellendus-culpa-y4vQT', 'B3CUS1LT', 'Deserunt adipisci voluptate suscipit ad commodi voluptatem id ut non odit maxime culpa ut aliquam facere.', 'Nesciunt et quasi aut ducimus aut enim dolore. Consectetur voluptas aut unde animi alias. Dignissimos sunt debitis praesentium. Officiis amet et totam id a. Aspernatur quia alias pariatur aut aperiam accusantium. Eligendi qui nihil omnis officiis incidunt.', '223.72', NULL, 148, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(159, 14, 'Qui et voluptas', 'qui-et-voluptas-wgNgv', '9XIYWMLX', 'Rem accusantium pariatur dolor dolorum assumenda doloremque eligendi reiciendis voluptas ab vitae ut velit tenetur.', 'Laboriosam iusto beatae voluptas dicta nam. Corrupti est maxime et dolores et. Labore eos asperiores debitis saepe.', '131.16', NULL, 29, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(160, 14, 'Commodi non et', 'commodi-non-et-PFBNY', '4I3CBVWK', 'Repudiandae odit est soluta ipsam ratione nemo quo possimus autem illo et rerum ut officia sequi.', 'Voluptas nostrum doloribus minima ut iste dolor. Vitae occaecati incidunt qui iure. Voluptatum tenetur ullam vitae repudiandae sed quo recusandae. Voluptatem odit ab est numquam iste. Dolorem aspernatur laudantium quis dicta distinctio quam quidem.', '160.57', NULL, 96, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(161, 14, 'Eius necessitatibus totam', 'eius-necessitatibus-totam-pXM32', 'F5ODSJ3Z', 'Asperiores odit consequatur sit iure reprehenderit magni est suscipit architecto magnam deserunt recusandae.', 'Eveniet aut sed ut enim provident soluta maiores occaecati. Non et ut animi dicta. Qui totam voluptate quis odit culpa.', '145.06', NULL, 115, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(162, 14, 'In ipsam cumque', 'in-ipsam-cumque-lXqMT', 'KAAPNL6A', 'Eum aut est reiciendis aspernatur id illum et in ut occaecati ex sapiente et dignissimos.', 'Ea eveniet est ipsum quia explicabo architecto. Ex ut dolorem praesentium voluptatem eos. Maiores impedit eius consequatur ut et ea.', '155.55', NULL, 188, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(163, 14, 'Quia error natus', 'quia-error-natus-p664s', 'KKCRZLIR', 'Tempora mollitia totam modi eum quibusdam voluptatum ullam eius iusto veritatis ea.', 'Iste officia minus non veniam aliquam. Laboriosam ut sint velit. Enim voluptatem consequatur similique ut ut. Dolor quia placeat eaque reprehenderit illum voluptatibus ab. Magni praesentium natus ducimus aliquid.', '135.40', '141.99', 49, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(164, 14, 'Sit dicta omnis', 'sit-dicta-omnis-0f9fe', 'OMVRGS8J', 'Officiis velit neque repudiandae voluptates sit sapiente et quo assumenda ducimus.', 'Quia incidunt et voluptatem. Fuga quis impedit quidem nisi temporibus corrupti. Veniam adipisci quis ex fuga. Deserunt maiores blanditiis ducimus molestiae consequatur reprehenderit excepturi. Qui qui ad deleniti dolorem.', '212.82', NULL, 178, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(165, 14, 'Quaerat totam animi', 'quaerat-totam-animi-FPsIz', '7RCLS5LP', 'Cumque maxime voluptatem aut nemo vitae doloremque illum iure consectetur quia dolor.', 'Voluptas odit debitis itaque architecto natus sapiente sunt. Distinctio praesentium similique iste quos cupiditate voluptate. Neque dolor autem tenetur et quas incidunt omnis. Laborum est rerum aliquam dolore quia id ut. A optio ut consectetur et in tempore.', '102.31', NULL, 26, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(166, 14, 'Nisi sint et', 'nisi-sint-et-iY9Hx', 'SSRG9QZ5', 'Quibusdam officia atque quo quae ipsum voluptatem doloribus sunt occaecati sapiente magnam.', 'Perspiciatis sunt iure eum officia et laboriosam. Rerum architecto dignissimos consectetur animi quis ut. In alias officiis eius est dolorum et veritatis.', '254.17', NULL, 41, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(167, 14, 'Necessitatibus animi atque', 'necessitatibus-animi-atque-Laedd', 'BHSZVIWF', 'In exercitationem qui quo rerum consequatur sit sint sed omnis sint harum dolorem tempore.', 'Cumque voluptas vitae laborum maxime ea. Omnis rerum repudiandae velit aperiam delectus in qui voluptatem. Dignissimos sit magni cumque dolorum eveniet consequatur ad. Aut accusantium nesciunt quod animi quaerat nihil eos at.', '132.45', NULL, 51, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(168, 14, 'Animi debitis non', 'animi-debitis-non-VV1D9', 'OY3TS0MB', 'Porro veniam culpa maxime ipsum sit sit est vitae nulla cupiditate et.', 'Doloremque non laborum voluptatem qui quod. Amet illum consequatur nihil. In possimus deserunt nihil saepe in sint.', '116.94', NULL, 112, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(169, 15, 'Est sint optio', 'est-sint-optio-iWe1z', 'TOT0XGAZ', 'Nesciunt quasi libero et nihil et nihil illo accusamus sit dicta autem dolor.', 'Necessitatibus quas aut et harum. Error architecto aliquid doloribus ut omnis deserunt est quo. Dolorem rerum iusto laborum at amet quis velit. Consequatur similique fugit tempora autem ut optio. Rerum corporis quia iste veritatis illum expedita. Ea quis est aut doloribus sequi.', '17.81', '52.17', 31, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(170, 15, 'Ipsam est dicta', 'ipsam-est-dicta-8FltS', 'PPTTI7LN', 'Corrupti et laborum necessitatibus quis excepturi nostrum et sed voluptas libero sed.', 'Corrupti sit sit ipsum non. Recusandae vero rerum quas non autem vero. Sit et quaerat earum. Perferendis aut molestiae minus provident.', '173.82', NULL, 86, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(171, 15, 'Porro quo similique', 'porro-quo-similique-X15OC', 'KEVIFC4A', 'Molestiae possimus doloremque impedit nulla sunt aut modi modi nulla libero cupiditate est voluptas.', 'Quia dolor autem mollitia et similique itaque. Rerum voluptatem in sed eum dolorem dolore dolorum. Esse incidunt sapiente asperiores eius dignissimos soluta dolores a. Atque sit voluptatibus quaerat. Officia id et ab est assumenda magnam.', '153.16', NULL, 143, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(172, 15, 'Praesentium voluptates vitae', 'praesentium-voluptates-vitae-eCGoR', '50IB3QNC', 'Officiis ipsa voluptas esse molestiae aut qui cupiditate sint optio sit ea debitis aut blanditiis voluptatem quo.', 'Adipisci officiis sed dolor corrupti. Numquam odio fugiat dignissimos adipisci est expedita facilis. Aperiam et quo rerum quos incidunt. Corporis dolor possimus exercitationem accusamus. Temporibus nobis ratione sunt voluptatibus voluptas cupiditate.', '129.79', NULL, 175, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(173, 15, 'Eligendi voluptatem a', 'eligendi-voluptatem-a-Bahgt', 'KUYOV2TT', 'Possimus nemo laboriosam repudiandae eveniet qui sit sint.', 'Repudiandae debitis libero animi qui iste odio sit. Nam modi asperiores hic natus delectus dolorem optio vitae. Ipsam placeat ut ipsam laborum adipisci quibusdam. Accusantium dicta temporibus laboriosam aspernatur.', '56.16', NULL, 10, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(174, 15, 'Sint ut vero', 'sint-ut-vero-FTtsN', 'WVXRIOP2', 'Voluptatum et facere et id debitis quia doloribus et iste quo quibusdam sint dolorum ipsam iste odio.', 'Et quod dolor similique dolores sapiente. Officiis est sit odit dolor reiciendis quis nemo. Adipisci dolore modi temporibus repellat. Qui aperiam dolores reprehenderit iusto sed rerum maxime.', '175.24', '181.98', 154, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(175, 15, 'Voluptas aut qui', 'voluptas-aut-qui-Ikf7h', 'PVVWQYE5', 'Ex voluptas dolores hic eius quis debitis quos temporibus.', 'In molestiae ut amet dolore vel quo. Hic earum assumenda omnis vel ipsa. In ut vero suscipit consequuntur atque repudiandae et. Placeat voluptas delectus quia nostrum vero.', '213.28', NULL, 91, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(176, 15, 'Consequatur expedita commodi', 'consequatur-expedita-commodi-J0xXi', 'IVCVH3CP', 'Qui modi voluptatem delectus mollitia est quasi quia accusamus dolorum id molestiae.', 'Autem ad inventore nostrum autem in. Et tempora dolorem ut id qui vero. Distinctio accusantium qui veritatis. Temporibus molestiae magni deleniti doloremque eum quas.', '138.66', '140.35', 152, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(177, 15, 'Est quam reiciendis', 'est-quam-reiciendis-hvZ67', 'QIXXFD0C', 'Totam sint consequuntur consequatur quia et quidem eum nam error maiores facere illo occaecati odit consectetur.', 'Voluptatem ut et sit sit sequi repudiandae voluptas. Sit ratione doloribus harum. Reprehenderit autem minus quis blanditiis dolores quo.', '85.79', NULL, 119, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(178, 15, 'Animi aspernatur nisi', 'animi-aspernatur-nisi-3cfQI', 'CW6JEWZQ', 'Eligendi dolores amet aliquam delectus reprehenderit est qui.', 'Eligendi ipsam dicta aut ut corporis. Aliquam qui vitae et dolor harum ex. Et libero excepturi qui tempora doloribus hic. Ad commodi ut rerum corrupti voluptas. Ut repudiandae enim blanditiis quia fuga similique tempore. Rerum excepturi repudiandae animi accusamus voluptatibus consequatur.', '123.94', NULL, 89, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(179, 15, 'Qui ratione qui', 'qui-ratione-qui-EOhsg', 'XJGZMYJB', 'Ea nisi sed omnis est nesciunt nesciunt maiores deserunt sunt aliquid et delectus.', 'Qui quaerat alias enim aliquid in. Non ducimus molestiae dolorum debitis. Harum qui omnis impedit vel nihil quasi magnam. Distinctio qui sunt expedita voluptate.', '172.89', NULL, 42, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(180, 15, 'Nostrum qui aut', 'nostrum-qui-aut-rpWIb', 'MQXNHIBP', 'Eligendi totam corrupti tempora laborum facilis architecto iure voluptas nostrum velit qui voluptatem et est illo magni.', 'Quasi corrupti voluptate ipsum neque. Odio est voluptate aut mollitia et debitis. Quasi veniam a qui quidem ut. Neque dolorum quia laboriosam non magnam laboriosam voluptas aspernatur.', '182.61', NULL, 53, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(181, 16, 'Fugiat laboriosam qui', 'fugiat-laboriosam-qui-pIJKx', '5XLMONMD', 'Et laborum consequatur aut qui nostrum harum repellat quo unde voluptas deserunt.', 'Ut ut earum consequatur. Perspiciatis et quos a ad fuga et. Quis voluptates fugit possimus iste. Sit impedit voluptate eos provident.', '85.31', NULL, 176, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(182, 16, 'Molestias eveniet nam', 'molestias-eveniet-nam-Lcjd5', 'MXPS1T35', 'Ex distinctio voluptatem maiores consequatur nihil et dignissimos dolores sit voluptatem non aut ullam est ut.', 'Numquam facere qui rem quod vel vel esse. Eum rem ut velit molestiae sit quasi explicabo. Dolorem facilis nihil voluptatibus nulla omnis magnam. Ut nulla et repudiandae aut iusto porro. Rerum quia et ipsam eligendi blanditiis. Maxime maiores impedit odio reiciendis provident velit maiores.', '215.66', NULL, 100, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(183, 16, 'Sapiente repellat recusandae', 'sapiente-repellat-recusandae-By7YP', 'BBHTR32X', 'Optio reprehenderit nihil aut dolores alias aliquam aspernatur perspiciatis eum ex saepe aut distinctio veniam dolorem.', 'Atque corrupti omnis quia incidunt ut. Quae autem culpa quidem repellat commodi est. Voluptatem et ex fugiat quibusdam aut voluptas facilis.', '277.76', NULL, 32, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(184, 16, 'Nesciunt unde saepe', 'nesciunt-unde-saepe-Rqvw5', 'DMNV3Z4G', 'Laborum magnam earum sed sit aspernatur dolores earum ut temporibus praesentium animi aut in iusto provident unde.', 'Aperiam enim ullam voluptate fugiat repudiandae. Rem dolores tempora consequatur beatae doloribus possimus. Provident minus id nobis sunt. Sapiente voluptatibus consequatur aut quia ipsum. Dolor deserunt id cupiditate nisi.', '199.24', NULL, 127, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(185, 16, 'Ullam ipsam quia', 'ullam-ipsam-quia-ZXQid', 'VD5OCFUX', 'Omnis veniam officia necessitatibus exercitationem nesciunt nihil ut numquam.', 'Culpa autem pariatur ipsam laudantium in dicta. Consequatur optio blanditiis mollitia molestiae voluptate enim. Et blanditiis accusantium numquam porro nihil velit numquam eos. Quisquam et nobis voluptates porro accusamus quis. Labore fuga ad quia rerum temporibus. Dolorem qui nisi est.', '172.02', NULL, 128, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(186, 16, 'Qui minima saepe', 'qui-minima-saepe-ssN9y', 'UNOUANJR', 'Deleniti reiciendis in facilis id saepe qui ad libero asperiores optio et accusantium ducimus.', 'Sapiente voluptatibus eum quis ut dolore quis. Voluptas vel odio dolorem eveniet doloremque. Consequatur sint dolore molestiae consequatur. Magnam totam nihil a consequuntur fugiat explicabo debitis.', '7.23', '13.55', 159, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(187, 16, 'Mollitia eveniet ut', 'mollitia-eveniet-ut-FKHZ7', '2IVPWZKP', 'Dolores hic ut sapiente est voluptatum quibusdam enim omnis dignissimos amet illo hic fuga aut vel sequi.', 'Commodi cumque eveniet culpa amet qui sed debitis aliquid. Similique laudantium dolores quia ipsum qui. Autem laboriosam ex sunt velit facere.', '258.93', '280.98', 9, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(188, 16, 'Ut iure corrupti', 'ut-iure-corrupti-SFNgO', 'WPEJGXNN', 'Facere placeat veritatis aut quam facilis distinctio minus dicta voluptatem neque ut dolores id alias qui nobis.', 'Harum animi accusantium et sequi ullam. Incidunt cupiditate voluptas ipsa incidunt. Et perspiciatis velit consequatur sint officiis. Eveniet occaecati consectetur est animi ab. Nostrum vitae dolores autem laudantium iusto sit.', '284.64', NULL, 40, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(189, 16, 'Cupiditate earum cum', 'cupiditate-earum-cum-EyWfv', 'JGEIIAKX', 'Ullam nihil illo qui eligendi nisi deserunt delectus impedit perspiciatis numquam illo et.', 'Quisquam culpa porro et quod praesentium et. Expedita nostrum nemo nesciunt. Est et aut esse commodi nihil sed. Suscipit vel numquam assumenda aut sequi fugiat enim. Sit quos facilis voluptatem totam non.', '103.20', NULL, 67, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(190, 16, 'Alias esse voluptatem', 'alias-esse-voluptatem-PHDvU', 'ZLROLMAY', 'Assumenda asperiores ut expedita mollitia quae quas molestiae omnis voluptates sed qui atque voluptatem.', 'Commodi deleniti voluptatem quis ex. Perferendis aliquid reiciendis iure mollitia. Ipsum autem quam similique est aperiam autem. Ipsum vero necessitatibus dolorum natus. Corrupti veritatis eum placeat veniam facilis est.', '192.50', NULL, 84, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(191, 16, 'Facilis distinctio occaecati', 'facilis-distinctio-occaecati-9iQIr', 'LIQETM0B', 'Commodi et quo iste explicabo omnis accusamus in dolorem aut consequuntur molestias assumenda a praesentium.', 'Et at ratione molestiae. Molestiae cumque occaecati officiis adipisci. Sit est est tempore qui vitae sit aut in.', '87.15', '93.17', 15, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(192, 16, 'Reiciendis in dolore', 'reiciendis-in-dolore-J0UlS', 'BSRIMB9R', 'Accusamus vero accusantium non ea sit tempore molestias sit animi quia.', 'Nisi aperiam unde vitae. Repudiandae et est qui consectetur neque facilis. Harum magnam quisquam ratione in explicabo omnis. Quia cum alias corrupti nisi illo.', '76.50', NULL, 133, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(193, 17, 'Quod sit nisi', 'quod-sit-nisi-oj2dS', 'ZKYBVEBD', 'Ut odio officiis cum doloribus delectus occaecati quia est eaque corporis aut fugiat.', 'Commodi nesciunt et est. Sit quis consectetur incidunt in neque fugiat voluptas. Impedit eligendi tempore placeat nulla dolores possimus. Nihil minus facilis praesentium sint incidunt dicta cum.', '69.51', NULL, 132, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(194, 17, 'Nostrum rerum tenetur', 'nostrum-rerum-tenetur-B6LC6', '4DX1AOTW', 'Fugit tenetur aperiam qui aliquid mollitia consequatur minus totam.', 'Mollitia dolore maxime recusandae labore fugit vero. Dolorem aliquid velit numquam cumque perspiciatis officia qui. Officia nostrum veritatis aut omnis dolore unde consequatur. Adipisci eos ut corporis velit enim voluptatem id autem. Suscipit nostrum id consequatur. Enim consequatur et nihil autem voluptatem aut ratione qui.', '231.62', '241.10', 42, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(195, 17, 'Non ea incidunt', 'non-ea-incidunt-uYsXF', 'KFPSCF52', 'Nam maxime voluptatem quos aliquid animi omnis aliquid totam quis quo eum.', 'Maxime voluptas voluptas at nobis. Eum minima facere sit. Similique in quia est aut voluptatibus praesentium magni. Rem debitis non quia cupiditate blanditiis sint. Autem ipsum ipsum debitis ut magni animi a sed.', '237.40', NULL, 125, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(196, 17, 'Quaerat magnam nisi', 'quaerat-magnam-nisi-WdTWy', '61FP1NIR', 'Placeat saepe atque sunt id ut amet totam error consequatur.', 'Quos et est aut est architecto molestiae. Laborum corporis repellat distinctio quam reprehenderit ut. Voluptas omnis quia quos rem. Vel veniam ipsum neque nemo est quo. Laudantium impedit temporibus iusto aut possimus.', '260.69', NULL, 42, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(197, 17, 'Illo dolor est', 'illo-dolor-est-X40IP', '6RUQZ3RE', 'Enim sunt iusto officia ea sunt laboriosam occaecati dolores nostrum velit aperiam iure.', 'Voluptatum quae quis sit minima similique ea doloremque. Eum perferendis aspernatur dolor nihil voluptas. Natus dolor sit atque error. Placeat suscipit aut ad voluptatibus qui reiciendis suscipit. Excepturi unde adipisci dicta voluptas occaecati ullam. Magnam facere eius nostrum temporibus et dolores est.', '280.21', '289.27', 42, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(198, 17, 'Ipsa nisi ab', 'ipsa-nisi-ab-L86RY', 'E6OLYQK9', 'Voluptatem expedita ea provident id autem quo reprehenderit quae nostrum nihil laudantium.', 'Dolorem mollitia architecto laboriosam aut itaque ad consequatur. Iusto molestiae expedita recusandae nesciunt sit aut autem. Corporis voluptatibus magni repellendus nihil. Quod aut tempora quae beatae quisquam dicta tempora.', '11.11', NULL, 176, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(199, 17, 'Deserunt blanditiis aut', 'deserunt-blanditiis-aut-ZLkUr', 'R9UTB46U', 'Necessitatibus magnam aut molestias qui molestias ut officiis.', 'Esse voluptatem ab enim cupiditate quod molestiae aut. Quaerat reiciendis rerum aperiam sed. Ea eveniet quaerat eos minima ut quo ea temporibus. Praesentium eum at quis qui. Optio provident rerum est illum eligendi.', '178.42', '187.86', 157, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(200, 17, 'Officiis at sed', 'officiis-at-sed-4yfiY', 'WB2B95CK', 'Culpa aliquam saepe accusantium architecto qui laudantium quae alias aspernatur voluptatem veritatis et et distinctio sunt quae.', 'Sequi totam tenetur inventore aut consequatur officia labore. Ex ut nihil qui id doloremque rerum aut eum. Explicabo tempora laudantium asperiores. Doloribus optio alias mollitia ea in in explicabo. Minus rem maiores tempore ex et dicta sit quo.', '173.19', NULL, 72, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(201, 17, 'Voluptatem et porro', 'voluptatem-et-porro-9YTDA', 'HF9JBHHV', 'Ducimus esse id ipsa reprehenderit consequatur ea minima ea.', 'Id voluptate hic et dolores quisquam odit. Amet temporibus consequuntur quasi. Cum aliquid voluptate et voluptates qui asperiores ex. Autem corporis sunt sequi expedita quidem.', '78.01', NULL, 172, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(202, 17, 'Officiis aut officiis', 'officiis-aut-officiis-TCdn3', 'MSFLVUKA', 'Similique maxime incidunt aut alias laudantium a sit unde qui consequuntur temporibus eos qui reiciendis iure ea.', 'Sit omnis cum non nihil velit. Facere nihil totam voluptatum rerum porro totam. Eius autem id iure molestiae id saepe tenetur. Veniam debitis molestias accusamus unde. Et soluta et voluptatum nam architecto est magnam. Sint maiores dolor itaque vero autem nesciunt.', '20.16', '24.46', 92, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(203, 17, 'Nobis voluptas eligendi', 'nobis-voluptas-eligendi-0gOft', 'CBARCXSA', 'Id eligendi deleniti aut officia dolores excepturi quisquam maxime voluptatem doloremque.', 'Quidem cupiditate quia sit facilis. Voluptate corrupti vitae modi minima. Et vel nihil quisquam dicta. Sit non ex et optio maxime. Eligendi molestiae eos reiciendis quia.', '176.55', NULL, 89, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(204, 17, 'Cumque eius possimus', 'cumque-eius-possimus-03v0A', 'IS03O85I', 'Molestiae nam et quod animi id quibusdam nihil velit incidunt quis quia nemo sit amet iusto quia.', 'Quaerat autem doloremque iure quia. Enim doloribus aut asperiores aspernatur tempore repellat. Est culpa vel hic rem dignissimos quia. Iusto non adipisci inventore eos perspiciatis sunt dolor. Cum ipsam beatae magni iusto.', '264.23', NULL, 30, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(205, 18, 'Autem nihil est', 'autem-nihil-est-rl61Q', 'EW9QTVZW', 'Incidunt dolorem quod consequatur est ut quod qui rerum voluptates.', 'Ipsa vitae soluta distinctio corporis. Ex esse cupiditate ut quia rerum. Quod vitae est ratione cum voluptatum. Accusamus praesentium maiores eos quo vero repudiandae. Soluta aut fugit quasi error. Et tempore consequuntur qui sed.', '44.05', '53.60', 163, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(206, 18, 'Animi dolor rerum', 'animi-dolor-rerum-wUJaE', 'VLS7KEMW', 'Repudiandae enim sed delectus nam eum enim excepturi ex reiciendis accusantium.', 'Nobis et adipisci placeat molestiae. Cupiditate placeat facilis iste voluptas exercitationem. Et ipsa cumque et iusto.', '39.67', NULL, 14, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(207, 18, 'Quis nihil laboriosam', 'quis-nihil-laboriosam-oynBz', 'VU93TJUP', 'Dolore culpa voluptatum cum eos ut et autem et.', 'Nulla quasi porro perferendis veritatis sapiente quis assumenda. Dolorem sint quod commodi doloribus et. Suscipit quos mollitia quaerat voluptas voluptas tenetur fugit.', '171.81', '199.64', 196, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(208, 18, 'Deserunt sit labore', 'deserunt-sit-labore-QdoAa', 'RNOFVE30', 'Deserunt et quis rerum molestiae hic doloribus qui exercitationem.', 'Est sequi expedita aliquid rerum esse. Possimus qui reiciendis officia accusantium ex vitae est. Nulla ad iure dolorum aut magnam. Dolore incidunt vel architecto quis. Officiis ab ad consequuntur facere.', '112.76', '115.65', 143, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(209, 18, 'Ipsam et natus', 'ipsam-et-natus-xOk6r', 'Y9PPBZO3', 'Ut similique quam nostrum adipisci atque quod eos.', 'Nostrum esse non aliquid accusamus quod. Suscipit deleniti rem consequatur vel aut placeat. Veritatis non voluptas nihil eius. Ut vel nemo officiis a eaque rem. Nemo ab est quasi consectetur ea enim sit et.', '22.04', '44.87', 190, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(210, 18, 'Perspiciatis sit qui', 'perspiciatis-sit-qui-6k2TK', 'CTDGQD5H', 'Iure voluptate deleniti eligendi optio esse velit officiis a quia saepe voluptas.', 'Velit assumenda possimus sit saepe. Occaecati quis ullam recusandae similique ut et tenetur. Deleniti et molestiae a voluptatibus. Doloremque dolorem natus dolor suscipit ex suscipit.', '133.06', NULL, 60, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37');
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `short_description`, `description`, `price`, `compare_at_price`, `stock`, `is_active`, `is_featured`, `use_custom_page`, `page_builder_data`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(211, 18, 'Consequatur sunt tempore', 'consequatur-sunt-tempore-jlQRS', 'OBP4UUKA', 'Molestiae placeat voluptates blanditiis incidunt dolores nemo voluptas.', 'Illum distinctio quia enim sapiente aut reprehenderit aliquam. Alias et asperiores quas accusamus. Ut cupiditate tenetur qui et enim ducimus sit.', '11.69', NULL, 105, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(212, 18, 'Quas dolorem eaque', 'quas-dolorem-eaque-Ha5qH', 'ZPNWJOGX', 'Eius ratione ut veritatis blanditiis eius qui voluptas pariatur quidem voluptatem sed dolore deleniti veritatis.', 'Minus velit ut quia et ipsum qui tenetur sequi. Cumque et nulla qui ea consectetur. Reiciendis dolorem fuga quis occaecati sit aspernatur. Consequatur accusantium praesentium non et enim voluptates.', '243.85', NULL, 134, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(213, 18, 'Quis qui est', 'quis-qui-est-QoN6Q', 'DSELZAFV', 'Perspiciatis nesciunt tempore accusantium non quo sed nihil magni necessitatibus tenetur atque ut dolorum fugiat.', 'Velit ut ab id aperiam non eos aut. Et facere praesentium ad nihil. Neque eveniet accusamus rerum rerum accusamus ratione. Et quis ullam sit illo officiis. Officiis qui rem asperiores.', '161.49', NULL, 139, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(214, 18, 'Deleniti sed est', 'deleniti-sed-est-RJZhL', 'K13LKTE4', 'Est libero mollitia ut distinctio voluptatum asperiores dolorem accusantium ea.', 'Architecto eos sequi velit ut ipsam ex. Repudiandae excepturi vel qui. Et laboriosam aperiam nulla deserunt quia consequatur.', '15.36', NULL, 165, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(215, 18, 'Omnis quae voluptatem', 'omnis-quae-voluptatem-cC13W', 'YZCBI5G8', 'Iusto ratione voluptatem ut quisquam praesentium nemo maxime est dolorem officiis fugit veritatis.', 'Illo harum delectus omnis quaerat repellendus ut dolore. Corrupti suscipit eum ut qui. Accusamus et nisi voluptas. Nisi ipsa recusandae quaerat autem eius voluptatem numquam. Ut excepturi doloremque maiores consectetur sunt omnis molestiae.', '129.06', NULL, 144, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(216, 18, 'Nemo labore quis', 'nemo-labore-quis-KHNEk', 'ZRREZBNP', 'Amet illo eligendi unde libero veniam quas saepe delectus nulla.', 'Quod rerum animi exercitationem. Et aperiam at tempora minus in ut. Adipisci architecto dolorem mollitia odit odio. Beatae sequi aut quia nemo culpa saepe placeat.', '175.29', NULL, 59, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(217, 19, 'Exercitationem molestiae voluptate', 'exercitationem-molestiae-voluptate-6CtsV', 'RNZGIRY5', 'Porro illum eos ratione impedit recusandae aliquam distinctio dolore excepturi tempore hic.', 'Temporibus aut consequatur aut consequatur unde optio repellat. Est rerum voluptas cupiditate dicta voluptatem sequi. Dolorem voluptas animi deserunt dolores aliquam et odio. Sed quibusdam voluptatem placeat temporibus. Quibusdam officiis animi ratione est sequi.', '107.90', NULL, 5, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(218, 19, 'Similique accusamus eum', 'similique-accusamus-eum-JRCdA', 'R8VIMI4E', 'Numquam et est ut non ratione dolorum excepturi ut atque est quae provident et qui quam.', 'Veniam veniam ut reiciendis optio totam placeat. Doloribus voluptatum aspernatur rerum consequatur nobis cupiditate. Quos aut qui temporibus tempora nostrum. Mollitia accusantium quia est aspernatur distinctio quis. Vitae qui aut consequatur magnam voluptatum.', '30.88', NULL, 18, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(219, 19, 'Facere qui atque', 'facere-qui-atque-6l7j6', 'T5HLWK0W', 'Quis dignissimos eum quisquam quisquam voluptates sit quia cumque earum possimus quibusdam explicabo velit magnam.', 'Voluptatibus amet totam possimus iusto. Ipsa facilis sit sunt. Dignissimos dolore occaecati eligendi odio omnis unde.', '129.16', NULL, 65, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(220, 19, 'Fuga et id', 'fuga-et-id-TQ97F', 'CLOGSE9P', 'Explicabo doloribus vero voluptatem ipsum iste sunt at sed.', 'Dolorem cum perspiciatis tenetur adipisci neque excepturi vero. Earum omnis deserunt laudantium aut qui delectus sed nihil. Omnis veritatis quia sit in accusantium architecto ut perferendis. Est vel minima veniam dolorem.', '87.55', '99.70', 98, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(221, 19, 'Eligendi neque repellendus', 'eligendi-neque-repellendus-6NC4B', 'MTBX5YQG', 'Quod autem ut voluptates laudantium ipsam nesciunt in ullam recusandae tempora maiores illo eum consectetur est deleniti.', 'Nam quis repudiandae est rerum quidem. Magni est officiis repellendus. Ipsum voluptatem qui nam eos ut. A quos sit aut enim ullam nostrum rem. Ad veniam culpa sed eligendi sed qui est eum.', '133.41', NULL, 29, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(222, 19, 'Aut hic dolorem', 'aut-hic-dolorem-VoIUW', 'KZDBBRF2', 'Sit error autem omnis animi aliquid excepturi ipsam velit voluptas aut molestias voluptatem.', 'Quibusdam maiores et suscipit incidunt dignissimos fuga maiores quis. Occaecati dolorum quod a blanditiis in. Sit pariatur fugiat quia et. Quaerat voluptatibus molestiae ut quasi veritatis. Sed et neque quisquam. Nesciunt quibusdam consequuntur expedita porro quibusdam id.', '15.25', NULL, 97, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(223, 19, 'Quasi enim totam', 'quasi-enim-totam-7W3Cg', 'IVKLZ3DT', 'Tempore delectus ab rerum natus eaque quia dolorem nesciunt velit quam est omnis et non incidunt.', 'Consequuntur commodi earum excepturi odit aut ducimus. Aut molestiae qui dolorem aliquid. Provident corrupti quis nulla alias.', '295.16', NULL, 128, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(224, 19, 'Qui modi voluptatem', 'qui-modi-voluptatem-WQUnw', 'LVAQYRQ7', 'Fuga delectus ut sequi vel in omnis molestiae beatae.', 'Ad libero consequuntur itaque. Quod vero corporis aut eum voluptas error. Veniam expedita sed officia non sunt. Inventore et quae nemo nisi.', '250.80', NULL, 11, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(225, 19, 'Numquam minima aperiam', 'numquam-minima-aperiam-ptLqe', 'UOW9TJRT', 'Aliquam quaerat sapiente qui autem qui dicta explicabo mollitia ipsa omnis sit ad.', 'Aut repellendus voluptatum ipsum quasi aut eligendi quisquam. Nemo vero itaque praesentium animi aut eaque. Accusamus reprehenderit eum consectetur fugiat aut quo quia. Similique provident rerum nulla commodi.', '207.85', '234.48', 106, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(226, 19, 'At optio vel', 'at-optio-vel-cOYMC', '56AYLSEL', 'Doloribus impedit laudantium distinctio sequi temporibus ipsam occaecati ut consequatur nemo.', 'A omnis suscipit a voluptatem dolorem aspernatur et adipisci. Non quo dolorem officiis consequatur id. Non aut eligendi accusamus est ut. Autem possimus ut iste deserunt.', '122.77', NULL, 108, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(227, 19, 'Ab qui ad', 'ab-qui-ad-eh94e', 'UZ5XXNRO', 'Laborum non qui vitae officiis voluptatem dolores corrupti hic ratione et iusto et.', 'Aliquid voluptatem laudantium hic cumque ex. Sint blanditiis iure commodi quas qui. Pariatur velit eaque illum officiis iusto saepe. Sint neque provident qui.', '49.80', NULL, 102, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(228, 19, 'Nihil expedita non', 'nihil-expedita-non-TpxHA', 'REBI4DO1', 'Sed facilis et cum et enim omnis dicta sint.', 'Aperiam voluptas dolorem similique odit. Qui quos accusantium sint eos est. Numquam sed est fugit vero. Nisi dolor autem autem dolorum exercitationem veritatis. Et laboriosam sed dolores corporis illo necessitatibus non. Aperiam voluptas fuga beatae sapiente cum.', '58.19', NULL, 88, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(229, 20, 'Libero eius fugiat', 'libero-eius-fugiat-WVgcS', '674QU9H4', 'Illo error occaecati ut culpa et omnis qui temporibus.', 'Officiis sed officiis atque voluptas. Harum deleniti est nisi quidem consequatur laudantium. Suscipit est fugit dolores assumenda ducimus. Nobis quia laborum sed velit provident magni maiores nulla. Incidunt sequi veniam nostrum qui et.', '268.98', NULL, 110, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(230, 20, 'Enim consequatur veritatis', 'enim-consequatur-veritatis-XICyX', 'DXDEUSIH', 'Aut quisquam odio dolores corporis et et animi quos cumque quasi.', 'Neque cum qui facilis dolore molestias ut. Iure maxime earum velit voluptate non molestias molestias. Sapiente error accusantium sunt qui. Magnam at non omnis suscipit.', '167.36', NULL, 143, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(231, 20, 'Aut molestiae totam', 'aut-molestiae-totam-x8y07', 'ING8UJWE', 'Quia dolore ut est enim illum voluptate dignissimos ex dolorem vero qui recusandae rerum quasi qui.', 'Enim nostrum porro omnis. Quae repellat blanditiis enim qui. Blanditiis rem eveniet dolores rem excepturi numquam rem. Incidunt dolores numquam enim et.', '70.54', NULL, 153, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(232, 20, 'Est expedita explicabo', 'est-expedita-explicabo-hhE0g', 'DNSTJG71', 'Animi voluptate at nulla et et dicta quasi ut.', 'Quae sunt autem quasi occaecati ab est. Rerum omnis magnam dolorem similique accusantium sit nesciunt. Ipsam quia repudiandae quo harum. Voluptas esse doloribus rem beatae et. Accusamus est qui est ipsa. Saepe inventore nobis magnam corrupti dolore corporis.', '193.48', NULL, 152, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(233, 20, 'Molestiae est eveniet', 'molestiae-est-eveniet-nNJNv', '8B6LBGK1', 'Ratione soluta architecto maxime quo eaque ipsam corrupti illo et sed similique possimus corrupti necessitatibus fugit ut.', 'Est ad omnis cum non optio iusto. Est voluptatibus amet vitae dolor deserunt tempore magnam. Id molestias sed magnam possimus omnis sunt. Eum laborum nihil rerum consequatur molestiae est.', '86.57', NULL, 171, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(234, 20, 'Architecto hic corrupti', 'architecto-hic-corrupti-Glybj', 'JNXFD2EK', 'Numquam repellat mollitia consectetur nihil voluptas non minus et quae temporibus debitis aut laudantium perferendis velit voluptas.', 'Quis qui saepe omnis ut facere repellendus voluptatem. Corrupti vero expedita error asperiores. Similique aut itaque ea aut a sit. Et autem unde mollitia quia sunt. Quasi consectetur ad commodi.', '85.63', NULL, 133, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(235, 20, 'Vel qui eligendi', 'vel-qui-eligendi-OFgq6', 'UTSEXYCH', 'Assumenda ut sit dignissimos voluptatem labore in dolore atque inventore.', 'Enim quae saepe nisi minima est ipsum. Fugiat aut ullam hic excepturi voluptas dolores. Deserunt nulla est ut tempora magni animi. Aliquam enim aliquam a doloremque.', '67.77', '84.22', 194, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(236, 20, 'Dolorem quod et', 'dolorem-quod-et-nu7RR', 'GU3BJI7G', 'Sint sapiente est non aut quis ducimus libero omnis possimus.', 'Aut accusamus quia non sint quos adipisci aut. Ut et voluptas quam sapiente sed. Quia laboriosam illo doloremque. Voluptatem laudantium occaecati placeat suscipit porro est. Ut qui laboriosam ratione quisquam ipsa qui. Ipsam adipisci cupiditate et non sed.', '141.00', NULL, 189, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(237, 20, 'Accusamus officiis cum', 'accusamus-officiis-cum-FBqPi', 'MGZPZIOL', 'Maiores numquam placeat ex non aut aperiam autem beatae est quasi ad rem sit.', 'Labore rerum quis esse temporibus minus dignissimos nostrum. Aut reiciendis laboriosam labore dolore velit. Odio voluptates nam nesciunt debitis in ut hic non. Temporibus mollitia incidunt cumque esse. Quasi consectetur qui voluptas animi a et eaque cum. Nostrum similique illo nesciunt aspernatur magni natus ipsum.', '212.59', '243.38', 5, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(238, 20, 'Suscipit earum dignissimos', 'suscipit-earum-dignissimos-5J27n', 'NST8TZYY', 'Excepturi quibusdam recusandae nisi consequatur reiciendis ut iure.', 'Distinctio minima dolorum provident sint repellendus. Qui impedit reprehenderit corporis. Possimus quos numquam est est quos qui. Odio nesciunt dignissimos quibusdam sed explicabo. Eveniet corporis enim laborum saepe ut odit. At aut magnam repellendus explicabo beatae.', '144.83', NULL, 177, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(239, 20, 'Harum et ab', 'harum-et-ab-OQNZL', 'K49OBYE1', 'Labore earum tempore consectetur accusamus commodi delectus perspiciatis aliquid dolor fugit.', 'Omnis quos culpa aut odit. Dicta modi tempora id quisquam. Sunt recusandae consequatur magni accusantium sit qui.', '83.00', NULL, 102, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(240, 20, 'Architecto repellat quasi', 'architecto-repellat-quasi-dzKBz', 'HHPSOK9M', 'Cum distinctio perspiciatis voluptate fugit labore aperiam ut sunt est et consequuntur.', 'Optio fuga asperiores doloremque ea omnis. Qui dolorum quaerat accusamus consequuntur architecto quia suscipit. Tempora animi et ut dicta dolorem itaque ut. Inventore est consequatur aut atque eum quibusdam. Pariatur numquam voluptatem ut in voluptatem autem voluptatibus. Et nam itaque aliquid.', '151.61', NULL, 177, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(241, 21, 'Iusto magni sunt', 'iusto-magni-sunt-a2Zwt', 'AASJKBJU', 'Iusto ea nobis voluptates facilis facilis voluptatem et omnis eaque doloremque illo sunt occaecati neque delectus.', 'Quasi pariatur veritatis perspiciatis at. Minus quae nam voluptatem praesentium eaque cumque. A sint iusto accusamus reiciendis rerum sint. Vel quo eum illo vitae.', '201.23', '235.47', 79, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(242, 21, 'Fugiat eum perferendis', 'fugiat-eum-perferendis-HyEs0', '9GCIUAQW', 'Ut iste debitis consequuntur qui incidunt et sequi molestiae iure aut id temporibus autem saepe exercitationem.', 'Harum fugit aut qui aut nostrum eum. In fugit aut repudiandae et porro. Est numquam sunt fugit molestiae accusantium eum. Ad minus reprehenderit ipsa architecto quo. At necessitatibus eum facere doloribus.', '163.42', NULL, 11, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(243, 21, 'Assumenda qui molestiae', 'assumenda-qui-molestiae-2Ak8D', 'OEVG2ZVK', 'Culpa ab et nihil esse doloremque error rem dolorem quas sapiente unde accusantium molestiae rem.', 'Tempore aliquid ratione quia delectus. Dolores omnis est quibusdam voluptas natus hic et. Voluptatem perspiciatis esse voluptatem non quaerat. Rerum sit non maiores odit.', '284.20', NULL, 81, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(244, 21, 'Mollitia hic rem', 'mollitia-hic-rem-iIuUH', 'GIZIH6IX', 'Dolor amet sunt est officia et ipsa dolor.', 'Enim velit et eveniet et tenetur eum. Nihil sunt in sapiente aliquam nesciunt rerum repellat. Cumque voluptatum nobis illo neque velit sequi. Maxime aut enim quo non laudantium nisi libero dolorum. Eligendi molestiae non hic at debitis velit numquam. Sint suscipit quas sit distinctio.', '212.71', NULL, 153, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(245, 21, 'Quis eaque nemo', 'quis-eaque-nemo-mjrdF', '12VF5ZSM', 'Eum nulla sed praesentium aut est quia ab doloremque dolores et tenetur nisi dolores.', 'Veritatis repellendus officiis aut laborum fuga. Eveniet qui non rem eum aliquam maxime dolores. Fuga reiciendis sit consequuntur nobis esse autem est.', '121.13', '150.87', 181, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(246, 21, 'Iste distinctio et', 'iste-distinctio-et-MpMlw', 'AZ7D6D5F', 'Rerum et natus non id officiis debitis consequatur.', 'Provident incidunt error saepe non. Accusantium soluta quisquam voluptatem. Et facere non et consequuntur et. Qui odio numquam quis tempora.', '46.73', NULL, 140, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(247, 21, 'Laudantium est ut', 'laudantium-est-ut-AxfD1', 'ZTIXLKWJ', 'Rerum placeat libero fugit quod delectus voluptatibus commodi voluptatum non rem laborum ipsa sapiente.', 'Assumenda odio autem perspiciatis et harum. Sunt autem culpa repudiandae doloremque. Ut consectetur velit qui dolorem voluptate. Ut soluta quia explicabo error.', '188.50', '198.75', 89, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(248, 21, 'Autem et dolorum', 'autem-et-dolorum-Iuuxg', 'XWUFAE7K', 'Suscipit nulla qui aliquid nulla cumque sapiente eos labore hic aut aut laudantium maiores cumque ut omnis.', 'Ut reprehenderit adipisci quae magni non qui perspiciatis. Rem et explicabo itaque iure numquam. Consequatur eligendi tenetur illo. Neque sed qui fugiat id deserunt deleniti excepturi. Perferendis voluptates maiores quas atque eveniet.', '81.84', '91.64', 110, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(249, 21, 'Quod sed qui', 'quod-sed-qui-7NENb', 'QJQRA9YP', 'Ab dicta provident accusantium aut saepe amet error pariatur distinctio et.', 'Ut omnis nisi accusamus vel rerum. Dolores labore cum id sapiente architecto et. Ipsam ad nihil aut quasi unde. Eveniet veritatis sunt ut quam ea aut.', '217.70', '229.61', 138, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(250, 21, 'Nam sunt dolorem', 'nam-sunt-dolorem-Fb1zk', 'BWQYQDXX', 'Soluta quasi ad dolore aperiam quasi voluptas sequi.', 'Dolores sint laborum est omnis praesentium. Beatae ducimus et est dolorum quis et quo. Consequuntur unde labore beatae sint ea ut saepe.', '193.47', NULL, 198, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(251, 21, 'Odit cupiditate perferendis', 'odit-cupiditate-perferendis-BuoD0', 'JIY7OAOD', 'Corrupti tenetur incidunt officia cumque alias explicabo voluptate nemo aut eos enim rerum.', 'Ipsam hic sapiente dolorem voluptatem. Voluptatem dignissimos a sit iure voluptas sed esse et. Sapiente ipsum iure ut non.', '77.48', NULL, 90, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(252, 21, 'Id quia illo', 'id-quia-illo-PjBsq', 'ZJR5HWYE', 'Et expedita aperiam praesentium cumque explicabo deleniti numquam esse voluptatem dolores dolores quibusdam quam.', 'In sunt dolores provident est. Alias ut iusto necessitatibus repellat deleniti. Consequuntur doloribus molestiae minus tempora ut. Atque veritatis non aut sequi quidem aperiam facere ut. Aliquam voluptatem vero optio et.', '291.99', NULL, 165, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(253, 22, 'Doloribus veritatis sit', 'doloribus-veritatis-sit-P4y51', '0E83LMBJ', 'Qui et tempora illo aut sit velit molestiae saepe sit quis sit.', 'Quisquam beatae aperiam labore. Qui sed libero et quam. Commodi autem corrupti commodi et quod consectetur. Sapiente eum qui a.', '260.88', NULL, 138, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(254, 22, 'Voluptatem repellendus distinctio', 'voluptatem-repellendus-distinctio-18x8q', '9MYR284P', 'Id sed explicabo in officia dolor tenetur eos.', 'Magnam ut nulla nulla. Ut quis dignissimos consectetur nihil. Reiciendis totam suscipit rerum autem. Consequuntur dicta consequatur itaque id sit consectetur. Voluptas magni voluptas rerum.', '243.84', NULL, 170, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(255, 22, 'Blanditiis nihil molestiae', 'blanditiis-nihil-molestiae-mOHy7', 'HGAJ3LMT', 'Atque dolores unde iusto sit voluptates eaque et quas placeat magnam dolore veniam nisi fuga.', 'Tempore est sed sit sit eum nihil. Voluptatem sunt dolor fuga quos quasi aliquam. Eaque sit eligendi necessitatibus ex et fuga animi alias.', '213.91', '244.35', 73, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(256, 22, 'Ad molestiae harum', 'ad-molestiae-harum-AVS1z', '9XIV2Z7O', 'Similique tempora autem sunt consequatur et fugit fugiat tenetur necessitatibus et magni.', 'Debitis animi aperiam porro officia non. Ullam maxime aut est quisquam. Ut quo dolore atque qui magni qui assumenda. Vel sunt nihil iure voluptas quo et nihil. Dolores quis ab et quia itaque earum quis nihil. Vel quisquam ut provident dolorem.', '130.92', '147.36', 200, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(257, 22, 'Blanditiis voluptates nobis', 'blanditiis-voluptates-nobis-n0ZQ2', 'TNP57XYQ', 'Voluptates placeat repellendus eligendi natus id et non cumque ea.', 'Amet voluptas perspiciatis commodi vel quis. Dolorum totam ut culpa id. Voluptatem sed odio accusamus atque. Facilis beatae error distinctio quaerat sunt doloremque.', '275.35', NULL, 151, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(258, 22, 'Et qui ut', 'et-qui-ut-0udCY', 'LB7HS82M', 'Sed doloremque velit magnam fuga non reiciendis excepturi esse.', 'Officiis eveniet labore autem error quidem consequuntur dolor. Ullam totam facere labore optio quos. A quod laboriosam nihil nam voluptatem ea atque.', '38.27', '73.67', 66, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(259, 22, 'Dolorum deserunt illo', 'dolorum-deserunt-illo-xOl5X', 'MAFB6T71', 'Ut dolores quos dolores voluptas quod laborum quo ut est debitis possimus reiciendis.', 'Reiciendis error id sint aut. Totam dicta reiciendis expedita voluptas totam ut. Et itaque nostrum consequatur nisi repudiandae est et. Itaque molestias dicta voluptatem perferendis sequi. Qui dolorem est unde ullam asperiores.', '265.77', NULL, 70, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(260, 22, 'Enim libero mollitia', 'enim-libero-mollitia-M8Eod', 'RF51RTAC', 'Ea quia provident maiores similique dolores excepturi voluptas aut ratione est rem fugiat ea neque amet.', 'Necessitatibus omnis magni sed nam occaecati aut molestiae. Voluptatem similique est a sed dolore aspernatur. Illum tenetur exercitationem et rem. Quo nam fuga est et earum.', '45.23', NULL, 107, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(261, 22, 'Fugit beatae veniam', 'fugit-beatae-veniam-7MAQe', 'KU9MBNXE', 'Ut ea quod mollitia vel voluptatibus ipsam voluptatem quia illo veniam suscipit.', 'Recusandae commodi accusantium minima impedit laborum quae consequatur velit. Ut quia et facilis praesentium alias alias ipsa. Molestiae eius quas quo dolorum. Dolores qui repellat rerum amet. Eaque sed maxime libero. Omnis temporibus dolor modi neque.', '256.83', NULL, 128, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(262, 22, 'Vitae aperiam delectus', 'vitae-aperiam-delectus-maDY7', 'SFDOJYRT', 'Exercitationem nihil atque enim ea sit occaecati aut vel deleniti sint quia.', 'Eaque voluptatibus voluptatum doloribus voluptate voluptas eos aut nostrum. Ad quia necessitatibus voluptate labore quos eius. Eveniet dicta perspiciatis accusantium illum voluptatum deleniti voluptatum. Ut dolor temporibus sint pariatur.', '53.19', NULL, 71, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(263, 22, 'Facere sunt omnis', 'facere-sunt-omnis-rerBm', 'ZRFZHRM5', 'At necessitatibus sed quia voluptate nam voluptas ut aliquam aut sed sapiente.', 'Quisquam est rem et voluptatum amet. Ut natus error autem aspernatur alias vel. Voluptate id deleniti labore aliquid totam vel at at. Magnam tempore praesentium amet corporis ipsam.', '273.69', NULL, 199, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(264, 22, 'Et molestiae enim', 'et-molestiae-enim-FocaC', 'YYOCYJOX', 'Dignissimos dolorum aut repellat quae consequatur unde blanditiis placeat est iure cum provident blanditiis quis.', 'Dolorum et iste in pariatur esse. Commodi ab temporibus quaerat excepturi pariatur. Impedit qui molestiae laborum. Voluptatem exercitationem aut ipsum illo.', '87.74', NULL, 103, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(265, 23, 'Ad vitae natus', 'ad-vitae-natus-97qUR', 'F5WLZXAZ', 'Vitae optio velit libero quam aut consequatur quo in doloremque ut minus quibusdam deleniti ut cumque autem.', 'Et omnis ea eveniet consequatur sed illo. Tempore consequatur laborum illum sed soluta rerum veniam. Ut laudantium in quibusdam sed autem. Ea tempore quo voluptatem doloremque nam. Saepe voluptatum explicabo facilis ex rerum.', '213.20', '253.06', 177, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(266, 23, 'Nemo fugit esse', 'nemo-fugit-esse-rYp8w', 'FSAW9FZX', 'Sunt harum ut voluptatibus aspernatur ratione quidem ea est repellat.', 'Tempore veritatis eaque et deleniti quod et ad repellendus. Et odio nulla aliquam et sit quia. Ea qui dolores vero autem ullam sint. Nostrum enim est qui nostrum. Ea sunt incidunt deserunt molestias exercitationem sed.', '209.45', NULL, 121, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(267, 23, 'Soluta quidem voluptas', 'soluta-quidem-voluptas-peaGd', 'PIAL8MEN', 'Eveniet aut eos perferendis corrupti perspiciatis vel quam ducimus laboriosam deleniti iusto perspiciatis eius maxime praesentium.', 'Ipsam id blanditiis esse aliquam ducimus voluptatem. Est tempora eos deserunt dolor aut voluptas id porro. Est sit iste perferendis dolorum sequi. Assumenda cum officia aut praesentium voluptatem odit expedita odio. Nesciunt excepturi neque nihil enim est corporis.', '250.38', NULL, 60, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(268, 23, 'Occaecati dolores dolore', 'occaecati-dolores-dolore-QuPgk', 'WB1OGEVP', 'Neque optio rerum rerum nulla maxime consequuntur eos velit.', 'Sit ad animi qui. Consequatur dolores error quaerat fugit. Consequuntur est quis vel doloremque aut.', '227.34', NULL, 78, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(269, 23, 'Iusto corporis ut', 'iusto-corporis-ut-mlJJZ', 'NP5HTECD', 'Voluptatum molestiae aut ut harum sunt tempora quasi aut.', 'Eligendi aliquam voluptate ullam cupiditate odit sed sit explicabo. Quos qui voluptate quia quam inventore aspernatur et autem. Ut et sunt rerum ducimus et. Enim autem et eos eaque qui eum voluptatem. Earum tempora ex eius voluptates nihil pariatur.', '200.00', '232.40', 42, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(270, 23, 'Corporis qui quod', 'corporis-qui-quod-oiRCR', 'Z8EGF3UE', 'Minus non et ducimus iusto beatae ipsa aut cum quam aut dicta est.', 'Qui excepturi assumenda tempore culpa dolorem maxime. Corporis ratione delectus qui qui. Nisi est cum sunt.', '6.20', NULL, 162, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(271, 23, 'Asperiores maxime dolor', 'asperiores-maxime-dolor-9Q3D7', 'GUCRLZW0', 'Dignissimos ad nesciunt ipsa aut praesentium ipsam qui quibusdam autem.', 'Minima natus voluptas aut sunt. Reiciendis id harum doloremque distinctio et quia et. Optio sequi et molestiae officiis. Porro est minus distinctio tenetur minima ea omnis. Libero atque iure molestiae nisi. Velit fugiat qui voluptas voluptas qui dolores fuga autem.', '88.16', '135.20', 165, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(272, 23, 'Ea aut ipsam', 'ea-aut-ipsam-PfVqR', 'BGA3M7CJ', 'Quia quia debitis explicabo voluptates aliquid voluptatibus aliquid veritatis magni officia aperiam ut voluptatum fugit voluptas.', 'Consequatur maxime dolorem sed ut et. Rerum non nam sint voluptas minus occaecati. Consectetur a nam consequatur dicta velit qui facilis. Sit et commodi dolor minima necessitatibus vel quia. Sint repellat fugiat reiciendis illo nihil aspernatur dolores qui.', '137.57', '162.74', 145, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(273, 23, 'Dolorem omnis eaque', 'dolorem-omnis-eaque-JMYtX', 'LSU9OVU6', 'Officiis ut deleniti mollitia numquam aliquid natus voluptatem distinctio qui et rerum.', 'Quae asperiores ex numquam aut labore occaecati. Qui dignissimos nobis atque sint quae. Harum reiciendis sunt hic laboriosam aliquam voluptatem. Iure non unde ratione voluptas eligendi repellat incidunt vel. Est perferendis molestiae maxime vero ea aliquid rerum neque. Aut ut praesentium eaque dolor culpa ipsam.', '119.88', NULL, 189, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(274, 23, 'Facere nam libero', 'facere-nam-libero-guuOD', 'TOVTWU5B', 'Reprehenderit adipisci atque minus voluptas a quae molestias sunt est officiis.', 'Perferendis eligendi omnis similique amet voluptatum at non. Tempora commodi deleniti dolorem aperiam quia. Quidem quos illo adipisci facere sed aut rem et. Dolor dolor excepturi ut et qui.', '59.52', '81.38', 0, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(275, 23, 'Libero consequatur et', 'libero-consequatur-et-hLijP', 'QPVMYPLH', 'Deleniti id recusandae est tempore iure dignissimos sit nam consequatur harum tenetur omnis.', 'Rerum officiis est esse cupiditate quasi et. Enim facere sed quis adipisci similique voluptas fugit. Velit quibusdam earum expedita voluptates. Nihil dignissimos eum quas unde. Cum aut explicabo pariatur asperiores. Quis ut vitae et exercitationem consequatur in.', '284.51', NULL, 5, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(276, 23, 'Pariatur rem cupiditate', 'pariatur-rem-cupiditate-j7pmH', 'C4NDFSX2', 'Asperiores beatae eum blanditiis modi ut cupiditate similique cupiditate velit.', 'Ut eos occaecati enim deleniti. Aspernatur magni voluptas quod. Porro nemo dolorum sint ipsam. Enim est accusamus dolores. Aspernatur eveniet eaque tempora recusandae sunt ex quia. Quam assumenda voluptatum dolores sunt.', '101.26', NULL, 124, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(277, 24, 'Quae consectetur iste', 'quae-consectetur-iste-aRRsT', 'OOKGTDMQ', 'Voluptas ullam necessitatibus ipsum laborum voluptas iste cum.', 'Ea harum nihil quae enim vel. Explicabo amet ex et impedit molestiae. Non earum qui culpa optio ex consequuntur nostrum consectetur. Sit deserunt et culpa. Saepe necessitatibus odit voluptas accusantium excepturi omnis sit.', '121.39', NULL, 192, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(278, 24, 'Sit non similique', 'sit-non-similique-OZ2vr', 'PQ2TR9B9', 'At ab eligendi aut occaecati molestiae sequi necessitatibus quod quas ea cumque.', 'Aut nam voluptates assumenda voluptates sit. Et eius voluptate consequatur nisi. Pariatur sint id autem qui animi. Suscipit aut commodi voluptatem.', '80.88', NULL, 36, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(279, 24, 'Vel eveniet tempora', 'vel-eveniet-tempora-IFrD7', 'NPETTW7Z', 'Eveniet et nihil sit est voluptatum non dolorem ex dicta voluptatibus est quasi unde et.', 'Doloremque ad et placeat. Reiciendis aut provident occaecati at nihil numquam beatae. Aliquid et aliquam inventore qui est. Vel sunt sequi iste facilis natus aspernatur.', '199.24', '212.96', 79, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(280, 24, 'Architecto saepe culpa', 'architecto-saepe-culpa-RrKSC', 'S5EMYBFJ', 'Autem suscipit dolore voluptas et exercitationem id id vero non doloribus rerum voluptas laborum.', 'Ipsum quo at ducimus voluptas itaque est. Sint ad et natus modi ab unde incidunt. Ea necessitatibus laudantium autem velit. Laboriosam voluptas est enim voluptatem qui fugiat id.', '215.28', NULL, 194, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(281, 24, 'Itaque corrupti aperiam', 'itaque-corrupti-aperiam-skm90', 'KUYBZHP6', 'Neque qui impedit omnis pariatur ullam cum dicta consequatur.', 'Commodi est nihil molestiae fugit fugit deleniti voluptatem rerum. Reprehenderit consequatur velit blanditiis velit odio alias adipisci. Et nulla necessitatibus aut aut perspiciatis possimus saepe eum.', '293.91', '329.21', 9, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(282, 24, 'Error velit saepe', 'error-velit-saepe-XEOhj', 'ZZQMYAJW', 'Est sed nihil beatae qui dicta aut quia voluptas quam ad dolores sed esse et.', 'Explicabo hic fugiat veritatis similique aut in ratione sit. Id alias repellendus velit odio qui molestiae. Facere quo est non magnam voluptas accusantium culpa. Saepe iusto culpa et ea molestiae consequatur optio.', '5.79', '30.47', 174, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(283, 24, 'A eos quibusdam', 'a-eos-quibusdam-E5IoH', 'YFDMTUVR', 'Quo voluptatem dicta quia dolore quas praesentium nesciunt cupiditate tempore rerum molestias aut.', '<p>Ea cum rerum quis non aspernatur quasi. Et reiciendis velit maiores earum doloremque fugit officiis. Dolorem sed harum unde delectus accusamus. Tempore perspiciatis et dolores officiis. Sed ut blanditiis non et velit quis.</p>', '266.01', '305.00', 191, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-12-19 16:25:53'),
(284, 24, 'Est rerum aspernatur', 'est-rerum-aspernatur-bwkKA', 'EE3CXJXS', 'Aut repudiandae et ipsam repellendus magni ut qui excepturi neque non quae ab.', 'Maiores reprehenderit in a cum et incidunt. Aut ea a deleniti consequuntur. Dolor accusamus et praesentium quo non ex est. Voluptatem consectetur voluptas ducimus aut sed.', '195.80', NULL, 72, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(285, 24, 'Beatae corporis magnam', 'beatae-corporis-magnam-n9H9B', '4FXILVL1', 'Est molestiae et sed fugiat dolore sapiente ut rerum aut ut aliquam reprehenderit aut.', 'Suscipit placeat corporis tenetur temporibus est rerum ipsam. Ad maxime rerum qui. Quisquam sed provident adipisci fugit quidem. Accusantium ullam delectus et eveniet eveniet ut nulla. Nihil inventore rerum eos sint.', '202.83', NULL, 85, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(286, 24, 'Qui perspiciatis harum', 'qui-perspiciatis-harum-c7x32', 'KE64V9RF', 'Reiciendis quia ipsam possimus praesentium perspiciatis maiores corporis commodi illo.', 'Molestiae non cum minus sunt deleniti doloribus. Voluptatem unde similique molestias ad tempora veritatis. Nam magnam qui voluptatem libero veniam. Et rem qui quis qui. Est vel mollitia voluptatem aut quis.', '264.76', NULL, 128, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(287, 24, 'Odio sit sunt', 'odio-sit-sunt-IEOfh', 'OCUCQ5PO', 'Quasi nam possimus aspernatur dolor voluptatum amet aspernatur iusto quia et et ut laudantium tenetur hic.', 'Consequatur et a explicabo facilis. Voluptatum sint cumque maxime ab velit omnis. Minus ut labore ut blanditiis.', '275.57', NULL, 138, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(288, 24, 'Ut accusamus neque', 'ut-accusamus-neque-4XnPL', 'MZG9W0SU', 'Similique vero doloremque quod fuga facilis aperiam expedita expedita placeat voluptatem provident rerum suscipit numquam recusandae.', 'Earum quasi vero et ipsum debitis nesciunt. Et incidunt vel cumque unde. Dolor labore quia recusandae qui hic animi et commodi.', '218.89', NULL, 119, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(289, 25, 'Beatae quaerat deserunt', 'beatae-quaerat-deserunt-TJOyx', 'HSR13ZEW', 'Consequatur optio voluptatem modi aut error ut consequatur id ratione voluptatibus libero ut ad sequi.', 'Eos quidem et voluptatum reiciendis. Error unde dignissimos laboriosam. Et nostrum autem harum itaque ut corrupti dolores. Quia numquam tempora voluptatem ut ducimus rem.', '32.38', NULL, 159, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(290, 25, 'Architecto et tenetur', 'architecto-et-tenetur-b9jIy', '3UIU2AX0', 'Sequi aut sint pariatur placeat alias neque ut ipsa quia error ex laudantium iure.', 'Omnis possimus fuga voluptatibus ut voluptatem nihil. Voluptatem distinctio fuga in amet facilis eos quam. Qui eligendi qui ea expedita quis.', '152.91', '156.39', 74, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(291, 25, 'Ad consequatur est', 'ad-consequatur-est-RcGpH', '6ZCTF0HK', 'Nam beatae id velit quia officia distinctio accusamus nemo quis voluptatem ea.', 'Eius quia iste quasi laboriosam atque ut laborum reprehenderit. Fugiat ut qui libero voluptatibus voluptatibus sequi. In assumenda omnis dolores odit.', '32.35', NULL, 123, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(292, 25, 'Et est harum', 'et-est-harum-vkzy5', '4EL3LPOP', 'Et assumenda cupiditate ullam consequatur occaecati laborum minus.', 'Tempore sit ex eum officiis consequatur impedit. Beatae sint dolor ut excepturi perspiciatis repellat error. Commodi porro culpa sit aliquam eligendi perferendis.', '85.52', NULL, 15, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(293, 25, 'Placeat odio dolorem', 'placeat-odio-dolorem-qiAco', 'GRFLTUPI', 'Quia ut iure iure recusandae eum voluptatem cum omnis perspiciatis ipsam quisquam laboriosam.', 'A architecto dolor et at corrupti. Soluta ut non rem consectetur. Aut dolor autem excepturi id laborum. Quae et placeat architecto aut enim sit. Autem non quis voluptas ut dolores saepe tempora. Nobis consequuntur ad qui quia soluta adipisci.', '133.13', NULL, 29, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(294, 25, 'Soluta magnam enim', 'soluta-magnam-enim-gOAv3', 'AMKJ0XAN', 'Sapiente error et ratione quidem distinctio quia rerum rerum cumque quibusdam fugiat odit ipsum.', 'Reprehenderit vel adipisci quasi voluptatem quis. Eos quibusdam doloribus assumenda a. Itaque facere sed veritatis id consequatur. Dolor blanditiis voluptatum ut natus.', '135.43', NULL, 3, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(295, 25, 'At in dolores', 'at-in-dolores-HDAPP', 'WZDXUYYK', 'Animi est aut ut sunt eos quis quia.', 'Et aut vel dicta et error dolores atque. Sed doloremque dolorem ea impedit. Neque dolorem voluptas quae officia. Rem sunt cum officia sed doloribus voluptatum laudantium. Reiciendis exercitationem soluta vel.', '241.20', NULL, 100, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(296, 25, 'Expedita animi iste', 'expedita-animi-iste-3fyjR', 'LZTRJIBD', 'Corrupti mollitia ullam iusto provident alias doloribus in voluptas incidunt.', 'Eum commodi magnam repellat quis libero sint aliquid. Consequuntur quod quia porro excepturi qui. Cupiditate distinctio occaecati veritatis. Debitis qui fugit sint itaque velit sed voluptatem. Natus autem vel harum.', '275.31', NULL, 81, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(297, 25, 'Autem exercitationem tempora', 'autem-exercitationem-tempora-qGyoJ', 'BDCPVQAW', 'Atque vero velit blanditiis natus rem dolore odit repellat quam culpa et veritatis.', 'Eaque praesentium et rerum odio quae. Repellat aliquam est qui. Vitae et voluptatibus aut recusandae illum qui. Facere doloribus odio cupiditate omnis.', '63.81', '67.24', 134, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(298, 25, 'Et sit in', 'et-sit-in-CtfEV', 'RH0RMPER', 'Vel unde quibusdam omnis vel iure voluptatem at.', 'Ducimus quam et cupiditate dolores voluptas molestias saepe. Nobis reiciendis doloremque est cum et non eius tempore. Deserunt reiciendis dolorum quia minima rerum. Debitis non tenetur optio hic sunt et nihil.', '165.15', NULL, 23, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(299, 25, 'Voluptatem aut perferendis', 'voluptatem-aut-perferendis-MImW3', 'JWGL4G6C', 'Veniam blanditiis aut impedit tenetur sit et et eligendi atque iste blanditiis id quam qui.', 'Cum et ea quam alias. Aut et laborum tenetur incidunt. Dolorum eligendi aut deleniti ipsum. Omnis repudiandae sit excepturi optio. Numquam fugiat fugiat et dicta minus in. Possimus praesentium assumenda et vitae maiores.', '109.92', '158.56', 146, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(300, 25, 'Vitae quia culpa', 'vitae-quia-culpa-qXOvU', '98YAM5JL', 'Quibusdam consectetur quaerat quidem totam minus provident cumque necessitatibus id.', 'Aut nihil quas sunt quod quia similique. Nihil ipsam maxime vero dolor praesentium aut. Sint autem provident totam molestiae consectetur qui iure. Veniam voluptatem debitis magnam cum assumenda.', '13.22', NULL, 31, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(301, 26, 'Rerum dicta sit', 'rerum-dicta-sit-SPfrb', 'XEYCDG4K', 'Et similique cumque ipsum inventore tempora commodi facere nemo qui placeat error dignissimos deleniti praesentium ut est.', 'Alias inventore ex dolores voluptatem. Vitae mollitia voluptatibus dicta error excepturi. Enim sint et quam iure. Eos molestias quae laboriosam officia.', '282.07', NULL, 81, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(302, 26, 'Doloribus quidem a', 'doloribus-quidem-a-XTW6C', 'UQKZJG1Z', 'Eligendi et a deserunt facere provident tenetur id dicta ratione eligendi nisi eum necessitatibus impedit et.', 'Earum natus laboriosam impedit voluptas modi odit nihil. Velit autem aut et consequatur. Laudantium est et perferendis odit velit sunt reprehenderit. Magnam molestiae eligendi quos exercitationem eius officiis sint.', '147.64', NULL, 191, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(303, 26, 'Ut eos voluptatum', 'ut-eos-voluptatum-p92hA', 'ZFSNWRFH', 'Provident nihil sapiente quam iure sint autem reiciendis aperiam aliquid qui omnis et iste.', 'Rem delectus iusto sint est voluptatem recusandae. Et rem rerum deserunt maxime. Quod in itaque voluptate voluptatum repudiandae cumque qui.', '126.49', NULL, 155, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(304, 26, 'Nostrum id culpa', 'nostrum-id-culpa-qm5AI', 'DIUGAMJW', 'Ut eos est in expedita ullam corporis aspernatur earum aut enim dolore dolorem doloribus qui.', 'Tempora corporis voluptate mollitia provident sit veniam deserunt ipsa. Sapiente error in et nihil voluptate laboriosam. Eaque aliquid dolorem omnis nulla voluptas. Voluptate accusantium sit exercitationem temporibus impedit est. Sequi quasi qui et. Nisi illo doloribus expedita suscipit.', '244.59', NULL, 46, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(305, 26, 'Consequuntur cupiditate aut', 'consequuntur-cupiditate-aut-7WIbM', 'JPHAHXE5', 'Dolor cumque qui repudiandae eos occaecati est ipsum eligendi dolorem consectetur.', 'Architecto esse aut animi aliquid. Autem quidem unde aut. Non voluptatem veniam quisquam ut. Sequi natus vel culpa sint molestiae unde. Aut adipisci aspernatur voluptates nobis aut qui ut. Porro enim exercitationem dolores sint quos quis accusantium.', '106.84', NULL, 177, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(306, 26, 'Itaque sit iusto', 'itaque-sit-iusto-EOVKu', 'CPXHUBN0', 'Voluptatem nihil sequi qui adipisci commodi atque id fuga dolores a natus.', 'Nesciunt qui libero ex non ea illum. Adipisci laborum amet qui ipsa. Assumenda minus ut ut nulla quasi in.', '31.65', NULL, 40, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(307, 26, 'Vel pariatur dolorem', 'vel-pariatur-dolorem-XOGMT', 'SUN2KTK0', 'Quis dignissimos alias quod quibusdam saepe ut culpa cumque aut quis quam.', 'Qui illum est et doloribus molestiae corporis. Voluptatum aliquid saepe a ut. Accusamus exercitationem commodi qui facilis dolores dolorem. Suscipit numquam eos fuga. Eum adipisci minima ratione occaecati est cum saepe eveniet.', '196.98', NULL, 149, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(308, 26, 'Fugiat ratione velit', 'fugiat-ratione-velit-1V8EX', 'I7UPUTF6', 'Aliquam cupiditate unde qui qui omnis voluptas in sunt et sapiente.', 'Sed earum libero autem eos totam tenetur alias. Sit eveniet molestiae asperiores vel occaecati sunt in. Hic impedit rerum et vero hic fuga totam. Culpa incidunt ut dignissimos. Iste deserunt assumenda asperiores in eveniet.', '145.27', NULL, 174, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(309, 26, 'Non aut aut', 'non-aut-aut-UHtoP', 'RV5EEQID', 'Qui molestiae ut et quis maxime qui quaerat ea in sit voluptas nemo autem sint doloribus.', 'Ratione consequatur et laudantium sunt sed aut. Deserunt dicta est veniam. Accusantium ducimus hic id ipsa similique eveniet. Expedita magni nam rerum enim non. Quidem illo deserunt distinctio dicta veritatis soluta.', '254.65', NULL, 117, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(310, 26, 'Vel soluta impedit', 'vel-soluta-impedit-YNwZF', 'SERPU4Z2', 'Culpa facilis ducimus minus quasi sit et facilis harum ex.', 'Assumenda libero tenetur et mollitia quidem iusto alias. Tenetur laboriosam et dolorem unde magnam et in. Alias fugit quia excepturi sunt aut placeat. Illum sit dolor qui. Tempora id delectus minima qui asperiores.', '70.20', NULL, 147, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(311, 26, 'Omnis dolorum voluptas', 'omnis-dolorum-voluptas-YzTrO', 'J7I0KDFT', 'Beatae voluptatum voluptatem dolor incidunt quidem est facere corporis nostrum quod placeat sit.', 'Cupiditate voluptatum quod dolor in. At iusto repudiandae odio animi et. Qui aspernatur eum rerum. Consectetur nesciunt ipsa possimus error ab ad quo. Id sit pariatur autem hic rerum.', '155.18', '178.26', 138, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(312, 26, 'Aliquid esse quasi', 'aliquid-esse-quasi-LQOfO', 'LQH9UYFP', 'At nisi sit maxime quidem dignissimos dolorem possimus.', 'Et sint omnis at ipsam fugiat dolore. Et veritatis qui blanditiis quo rerum voluptas ex. Iusto quis qui et quis. Consectetur numquam odio quia itaque ad qui.', '176.30', NULL, 149, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(313, 27, 'Dicta saepe architecto', 'dicta-saepe-architecto-UiVcU', 'D8RWX5GX', 'Maxime consectetur illum minus tempore cumque nihil sit omnis non sequi quam in nihil sint.', 'Est facilis nulla quaerat veritatis recusandae eum ab. Harum iste velit corporis nisi eum voluptas. Vel ab et necessitatibus consequatur harum et. A nobis accusantium aut vel deleniti sint.', '45.14', '89.61', 150, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(314, 27, 'Sed atque nobis', 'sed-atque-nobis-OKnVl', 'WIZCFGC3', 'Provident aspernatur a exercitationem suscipit ab est facilis iure corrupti.', 'Qui et amet sequi esse consequatur voluptas et. Sit qui earum tenetur quae sed aliquid. Molestiae ut nesciunt impedit eius harum nihil repudiandae. Magni molestiae ut consequatur.', '56.94', NULL, 4, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(315, 27, 'Nam cumque iure', 'nam-cumque-iure-8b5eg', 'ZTYJMPNM', 'Totam et soluta sed asperiores non error nihil praesentium repellendus officiis ipsa.', 'Quas modi quaerat omnis fuga impedit recusandae quisquam. Est quas doloremque quia totam soluta ut impedit. Animi quibusdam et numquam molestiae recusandae sit ipsam.', '58.58', NULL, 99, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(316, 27, 'Et neque repellat', 'et-neque-repellat-Z5gGi', '087WYUBN', 'Provident fugit cupiditate est corporis qui nobis soluta consectetur repellat quae eius laborum qui blanditiis placeat qui.', 'Suscipit et tenetur reiciendis accusamus quam aliquid atque. Voluptas asperiores voluptas sint voluptas beatae. Exercitationem non sed qui. Similique debitis dolorum impedit ea vel natus. Dolor quae aut facere qui ut laudantium explicabo iure.', '191.75', NULL, 165, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(317, 27, 'Iste ab possimus', 'iste-ab-possimus-CgraH', 'QZ7TP1DH', 'In quidem facilis distinctio velit suscipit possimus voluptatum odit dicta omnis esse rerum dolorem.', 'Laborum perferendis rerum repellat. Dolorem blanditiis mollitia voluptatem a magni dignissimos nostrum et. Consequatur neque adipisci magni voluptatem. Voluptatem velit ducimus nisi qui suscipit tenetur doloribus ipsa. Facilis modi labore dolorum corporis unde corrupti placeat. Praesentium molestiae consequatur vero similique in.', '53.94', NULL, 55, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(318, 27, 'Possimus libero itaque', 'possimus-libero-itaque-GVBXa', '61CCOLYF', 'Quidem consequuntur et consectetur sunt ea facilis necessitatibus omnis et.', 'Magni architecto quasi mollitia qui qui. Sunt asperiores quam voluptate esse quasi dicta. In possimus ut delectus. Sunt fugit ratione neque quisquam voluptas at quam.', '222.48', NULL, 64, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(319, 27, 'Est natus doloribus', 'est-natus-doloribus-ASFoc', '8MAW93K4', 'Quia consequatur repudiandae et ducimus id totam ratione corrupti et facere et explicabo neque possimus reiciendis.', 'Temporibus dicta excepturi aspernatur aut atque voluptatem amet dolor. Omnis ut facilis praesentium quis. Delectus omnis maxime nisi consequuntur nemo aliquam temporibus excepturi. Culpa eveniet in culpa sit quas magni sequi.', '113.15', NULL, 140, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42');
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `short_description`, `description`, `price`, `compare_at_price`, `stock`, `is_active`, `is_featured`, `use_custom_page`, `page_builder_data`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(320, 27, 'Est officia dolores', 'est-officia-dolores-WPtlB', 'NKZSOOBE', 'Nesciunt asperiores ad dignissimos dolorem voluptas et omnis incidunt est blanditiis id sunt odit minima.', 'Modi quos enim deleniti temporibus nobis eum est. Corrupti harum rerum quia neque. Odio et ducimus voluptatum eum consequatur cupiditate. Nam similique quae nulla et dignissimos et quaerat. Explicabo non ipsum velit similique accusamus similique ullam. Aut tempora totam distinctio sequi quo enim.', '40.69', NULL, 194, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(321, 27, 'Unde perferendis et', 'unde-perferendis-et-4U7Ub', 'P8EX8HIV', 'Rerum deserunt sed nesciunt rerum dolorem vero nesciunt et nihil magnam sint quae aspernatur corrupti eum.', 'Iusto labore et reprehenderit quia molestias libero. Enim aut et dignissimos quisquam non est nemo. Molestias quas facilis hic et. Et nulla quidem harum aspernatur.', '72.49', NULL, 38, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(322, 27, 'Iste id voluptas', 'iste-id-voluptas-kXnxm', 'GQM6QPMC', 'Nostrum officia ipsa eligendi qui dolores inventore commodi.', 'Voluptatibus placeat ea sit. Voluptatibus corporis rerum modi quis. In tenetur ut ut vel officiis animi ex vel. Sequi illum recusandae ad fugit. Aut et maxime asperiores consequatur nesciunt.', '199.72', NULL, 152, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(323, 27, 'Aut placeat ex', 'aut-placeat-ex-twzNk', '7QDSUR0T', 'Aut perferendis ut facere aliquam dolores autem velit.', 'In quia accusantium quasi culpa id. Et ratione sint hic nihil omnis facilis. Et maiores fuga quis.', '157.92', '182.29', 74, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(324, 27, 'Est non odit', 'est-non-odit-7oiOU', 'BWOP9AKE', 'Incidunt perferendis et fugit temporibus nihil hic qui harum amet facilis et aut at doloremque.', 'Ea ut eum ut aliquid qui dolorem. Eum illum et voluptates magni minus quis. Ipsa placeat rerum ut odit perferendis dolore aut odit. At consequuntur tempore quo eos quaerat recusandae ad ut.', '86.57', '121.82', 93, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(325, 28, 'Maxime qui dolore', 'maxime-qui-dolore-mRUx8', '4FCCUOMK', 'Et est iure enim eos unde veritatis consequuntur voluptatem neque quis voluptatem hic.', 'Ad sunt sed sint quisquam autem dolorem. Error ut nihil ipsam maxime eveniet ex rerum. Molestiae qui qui nisi ut accusantium. Ut enim ut eum et eum. Et laborum nobis ipsam corrupti autem maiores.', '99.19', '127.29', 137, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(326, 28, 'Repudiandae enim est', 'repudiandae-enim-est-qMgzx', 'TR42GNOT', 'Commodi expedita delectus magnam commodi tempore maxime dignissimos est.', 'Fugit sint amet tenetur rerum ut aut. Eaque ut qui dicta quia aut id. Qui incidunt omnis voluptatibus sequi quia.', '200.36', NULL, 122, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(327, 28, 'Culpa distinctio ducimus', 'culpa-distinctio-ducimus-ABkk7', 'XTIUFIW8', 'Unde dolore amet culpa consequuntur porro suscipit beatae qui nulla non at non ab nobis.', 'Accusantium quo veniam quis dolor sit harum id. Voluptatem magnam adipisci eos natus. Voluptates modi excepturi minima.', '245.97', NULL, 3, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(328, 28, 'Ratione eum qui', 'ratione-eum-qui-rdWlF', 'IO22KLQH', 'Ut pariatur fugiat rerum excepturi neque odio dicta iure ad natus repudiandae.', 'Dolore vitae rerum architecto eligendi dolores error iste magnam. Sunt fugit voluptatem et omnis nostrum qui. Alias et eum corporis nihil aut dolore qui. Aut quo in architecto consequatur est quos. Dolorem voluptas cumque neque autem dolor alias provident.', '277.77', NULL, 51, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(329, 28, 'Eum dicta ut', 'eum-dicta-ut-AZHwj', '3OCCHJBN', 'Deserunt ipsam laboriosam eos quaerat minus suscipit occaecati blanditiis aliquam.', 'Architecto rerum aliquam odit aut voluptatem eos. Iusto est nihil aperiam. In officiis corrupti rem ullam.', '173.20', NULL, 126, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(330, 28, 'Rerum sed quo', 'rerum-sed-quo-4Pmk9', 'XO4GKDZD', 'Tenetur sapiente tenetur dicta porro officia quae aperiam doloribus non assumenda nihil qui dolores praesentium.', 'Dolores sapiente beatae dolorem quas eligendi modi. Quas rem cum aut et doloribus consectetur magni voluptate. Suscipit omnis facere qui sapiente. Molestias fugit dolor sint ea ut nam. Accusantium aut tempore molestiae nostrum et quam.', '156.32', '188.11', 118, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(331, 28, 'Eius provident aut', 'eius-provident-aut-Aegyi', 'GCQWJV3E', 'Dolorum dolores quia cupiditate et ut dolores fuga.', 'Occaecati et perspiciatis soluta ut fugiat. Voluptatem deleniti dolores facilis corporis nulla. Qui nam et et nulla incidunt natus a sit. Perspiciatis voluptate consequuntur reprehenderit aut quod ut ut. Minima fugiat est sit sed error. Sequi quia fuga et laudantium.', '277.56', '312.22', 158, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(332, 28, 'Officia placeat est', 'officia-placeat-est-k8Yyd', 'CDP8IPCB', 'Illo eveniet alias quia quas illo qui sint aut quis assumenda saepe voluptatibus omnis.', 'Explicabo et tempora nihil mollitia mollitia nisi corrupti. Debitis itaque delectus fugit ea. Facere eaque ex tenetur dolores qui eaque occaecati est. Architecto sint provident aut consectetur et sed. Quam eius non non eius quidem. Et voluptatem voluptatum dolore repudiandae libero voluptas est.', '229.83', NULL, 183, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(333, 28, 'Modi inventore quia', 'modi-inventore-quia-RgNft', 'ZTJS0RYI', 'Molestiae nisi modi et repellat voluptatem tenetur voluptatem commodi iusto.', 'Omnis voluptatem quaerat quia fugit. Ipsum mollitia harum cupiditate autem. Fugiat voluptas facilis placeat quos.', '10.43', '23.00', 166, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(334, 28, 'Voluptas rem magnam', 'voluptas-rem-magnam-ca6Sw', '6RCZUZWT', 'Temporibus ut sint pariatur sit autem doloremque corporis omnis qui quisquam et ea molestiae eos eos.', 'Beatae ea velit autem rerum. Consequuntur omnis voluptatem unde fugiat cupiditate. Nihil commodi blanditiis nihil magnam eum cum. Reprehenderit et similique aut perspiciatis est. Nihil corporis numquam modi quam minima nisi aliquid. Tempore rem nam repellendus accusamus adipisci autem libero iste.', '17.65', NULL, 142, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(335, 28, 'Soluta ut rem', 'soluta-ut-rem-5yYll', 'WBNGESI3', 'Qui esse id voluptatem exercitationem et ut omnis voluptatum corrupti quia repudiandae.', 'Quia ut et qui et veritatis eum odio. Porro aut eius praesentium et aperiam. Aliquam at eum et voluptatem laboriosam nisi. Deleniti sapiente ad dolores dolorem saepe velit est.', '133.72', NULL, 163, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(336, 28, 'Quisquam cum aut', 'quisquam-cum-aut-Ccc9N', 'DXFQNKEE', 'Ea est sed autem inventore omnis quaerat quam ullam deleniti.', 'Laboriosam veritatis qui beatae illum. Sint similique dicta deserunt officiis. Quo ea sapiente esse eveniet omnis eum inventore. Quia minus qui voluptatum et illo. Odio tenetur qui facere ab voluptas accusantium ducimus. Sit et qui eligendi delectus.', '223.86', NULL, 74, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(337, 29, 'Ea tempore atque', 'ea-tempore-atque-2LxpZ', 'HQDMB31U', 'Repudiandae vero placeat qui enim molestias nisi et aliquam aperiam veritatis ducimus maiores sunt.', 'Et exercitationem occaecati corrupti quidem tenetur consectetur esse. Tempora pariatur ut sit autem. In ut accusantium neque ab et et inventore labore. Eum ut est vel inventore porro adipisci. Qui aut dolorum ratione cumque natus illo.', '53.73', NULL, 89, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(338, 29, 'Unde ex autem', 'unde-ex-autem-NBOWP', 'RTKE7HPH', 'Vel id cupiditate eos id quo quia culpa incidunt eos qui.', 'Minus laboriosam temporibus aut incidunt autem facilis. Magnam eum sed ea consequatur necessitatibus doloremque expedita iste. Qui fugiat qui tenetur et dolorem non eum fuga.', '6.03', '18.74', 141, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(339, 29, 'Expedita mollitia sit', 'expedita-mollitia-sit-XHWvR', 'EOICEMDK', 'Quo facere molestiae accusamus fugit nulla qui accusamus aut.', 'Porro dolore quam veritatis illo aut magni provident. Nesciunt et quas numquam eum sit et. Sed quas quis ea. Quasi numquam incidunt qui velit eum. Rerum enim qui nemo nemo asperiores. Minus omnis amet et repellat sint adipisci in.', '203.18', '232.67', 159, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(340, 29, 'Enim consequatur velit', 'enim-consequatur-velit-4FZ3d', 'MRFV8YQN', 'Repudiandae maiores est voluptatem dicta veritatis nam assumenda quo nisi perspiciatis iusto quos voluptas.', 'Magni reiciendis est ab vitae omnis. Aut neque consequatur explicabo magnam itaque consequatur. Nihil atque provident eum unde voluptatem. Aliquam atque consequatur iste eos explicabo quidem aut.', '270.36', NULL, 179, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(341, 29, 'Error nihil alias', 'error-nihil-alias-5eLJX', 'QNRNEDYI', 'Nam dolorem ut qui quis autem dolorem qui quis aspernatur rerum ab enim ut hic voluptas.', 'Recusandae ea voluptatem sed tempora ipsum. Inventore iure nemo quaerat autem praesentium eum. Dicta magni eaque voluptas minus omnis quas totam. Autem quia earum cupiditate natus nihil explicabo id dolorem.', '19.21', '42.33', 24, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(342, 29, 'Et consequatur dolores', 'et-consequatur-dolores-eQbSI', 'XM8DQ60P', 'In nam maxime modi velit voluptatem nemo sed in.', 'Excepturi ratione ducimus in aut eveniet assumenda. Deleniti alias qui et omnis nihil qui praesentium sed. At et accusamus ut et. Voluptatem et optio repellendus aut. Ut voluptas facere nobis tempore dicta inventore.', '165.67', '200.51', 11, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(343, 29, 'Corrupti sed iste', 'corrupti-sed-iste-xIkgK', 'KASM1CFM', 'Velit optio rerum modi dolorem sint impedit quam eum sunt omnis laboriosam.', 'Aperiam non similique autem soluta error minima molestias. Qui eius ut qui eum aut iusto. Tenetur reiciendis quidem et minima corrupti magni qui. At ut et voluptas molestiae qui. Inventore suscipit non placeat odit.', '103.30', NULL, 15, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(344, 29, 'Necessitatibus eaque quam', 'necessitatibus-eaque-quam-xKslX', 'MSY9DJGP', 'Tempore ut ipsum adipisci iste qui odit doloribus omnis enim aut sunt consequuntur.', 'Voluptas laboriosam unde quia optio ut voluptatem. Est sequi nisi eum quibusdam asperiores. Est pariatur error eligendi itaque neque expedita nulla. Doloremque eaque debitis minus inventore voluptatem ut eos. Ratione ea repellendus ut qui.', '88.82', '120.56', 168, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(345, 29, 'Sapiente architecto quisquam', 'sapiente-architecto-quisquam-YqtH4', 'IZSYGQOY', 'Saepe dicta dolor eaque fuga aut aliquam perspiciatis eos aspernatur mollitia rerum velit asperiores aut quia est.', 'Voluptates voluptatem voluptatem nihil expedita vitae. Sed nemo et voluptatem non dolor numquam et. Aspernatur maiores quas consectetur accusantium. Est accusantium occaecati aperiam laudantium enim sint non rerum.', '234.97', '283.09', 8, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(346, 29, 'Vero amet nihil', 'vero-amet-nihil-OnYA8', '3L83RMT9', 'Eum voluptas quaerat enim voluptatem aut minima voluptas et.', 'Possimus esse ducimus qui et quis repellat. Iusto quibusdam nesciunt ab est hic recusandae magni. Eius nobis reiciendis numquam eum non. Earum autem odit quam sed.', '226.24', '240.81', 57, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(347, 29, 'Animi aliquam quia', 'animi-aliquam-quia-xFxR6', 'LNZ0YU0V', 'Perferendis suscipit quia aut ut placeat blanditiis autem aliquam at magnam sunt.', 'Sed ipsum occaecati sequi quaerat totam quidem mollitia. Ut blanditiis et eos aliquam. Magni cupiditate autem ipsum nobis rerum dolor similique. Hic nostrum corporis quis temporibus minus est. Quasi quia qui et laborum doloribus officia aut. Est asperiores aut sequi repudiandae.', '159.60', NULL, 59, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(348, 29, 'Unde praesentium voluptatibus', 'unde-praesentium-voluptatibus-h1zWc', 'WH6DDAET', 'Minus et est odio quia quam sequi eum.', 'Dignissimos qui aperiam tempora in a aspernatur explicabo. Fuga doloribus aut suscipit officia atque. Rerum nihil itaque nemo. Quasi voluptatem tempore fugiat voluptas molestiae porro.', '299.28', '303.50', 90, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(349, 30, 'Qui neque est', 'qui-neque-est-XEecA', 'YYVTDBRW', 'Est voluptatem sunt autem vel iure et quia qui voluptatem laudantium distinctio velit aperiam sed.', 'Mollitia sequi saepe consectetur rerum doloribus aut. Ut ut veniam et voluptatem repellendus modi. Reiciendis ratione accusantium sit velit et nemo. Numquam et voluptate ut alias eligendi qui. Nulla nihil et et quo exercitationem sunt quis.', '212.89', '225.90', 186, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(350, 30, 'Sit dicta ut', 'sit-dicta-ut-de0gK', 'HZPTSPK8', 'Minima est id est occaecati deserunt dolor autem rerum porro nihil reprehenderit.', 'Deserunt animi sit consectetur repellat dolorum consequatur voluptatem. Temporibus aut ea totam praesentium iste ut. Rerum soluta molestias qui voluptatem et mollitia dolor. Corporis qui dolore quos et consequatur perferendis ratione. Delectus fugiat cum sint omnis voluptas quis est itaque.', '153.80', NULL, 15, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(351, 30, 'Et deleniti et', 'et-deleniti-et-NNdOu', 'NAHMIXG8', 'Maiores quam tempora ut asperiores eos hic et voluptas sunt labore quia fugit et.', 'Sit aut necessitatibus a laborum minima. Expedita sit quaerat esse repudiandae quisquam praesentium porro. Quaerat dolorem quia enim libero recusandae vero.', '180.53', NULL, 20, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(352, 30, 'Sed quas molestiae', 'sed-quas-molestiae-UWvP4', '3SXZT1BC', 'Nostrum eligendi cum esse nisi est enim deserunt id accusantium et enim delectus est.', 'Eos et nostrum nisi culpa magnam repellendus. Repellat maxime maxime aut consequatur ducimus. Autem non officiis iure aut quia asperiores laborum. Ratione voluptatem quis doloribus numquam inventore ratione non. Reiciendis placeat laborum molestiae ducimus itaque. Deleniti excepturi sed quia accusantium.', '111.52', '149.09', 59, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(353, 30, 'Laudantium adipisci ad', 'laudantium-adipisci-ad-lKmpm', '89QYMCAS', 'Laudantium velit laborum similique earum quas est labore similique vero dolores recusandae dolores repellendus quia.', 'Expedita molestiae nostrum quia doloremque aut ratione et. Nihil facilis aut asperiores consequatur assumenda exercitationem sed. Atque voluptas quo expedita doloremque odio. Qui doloremque sunt ipsa provident qui ea ea. Enim eaque voluptates maiores eum molestiae.', '89.34', '109.32', 29, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(354, 30, 'Dolores id fugiat', 'dolores-id-fugiat-nf0jk', '8FROVVMX', 'In sapiente laboriosam et ut quidem accusantium quis corporis dolore omnis earum quaerat.', 'Et dolor beatae laborum. Libero dolorum cupiditate ad tempora et sunt aut. Ut est ut quisquam et in nobis.', '148.87', '179.98', 180, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(355, 30, 'Corporis repellendus temporibus', 'corporis-repellendus-temporibus-D974t', '6HJAOQPN', 'Dolore ab sed perferendis iure dicta aut temporibus asperiores fugit excepturi.', 'Qui ratione alias perferendis. Exercitationem fugiat vel deleniti omnis autem itaque voluptatem. Nesciunt repellendus voluptates facere amet quas odio eos error. Ullam officia nam voluptatibus reiciendis consequuntur.', '290.66', NULL, 77, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(356, 30, 'Exercitationem doloribus libero', 'exercitationem-doloribus-libero-3ajWQ', 'OMIGMZGW', 'Qui voluptatem incidunt voluptas voluptas illum natus sed quos maxime molestias dolorum numquam.', 'Dicta neque illum minus id ut qui. Explicabo et fugit autem nisi aperiam ea. Necessitatibus distinctio placeat consequuntur. Et accusamus incidunt autem sed aut.', '261.56', NULL, 91, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(357, 30, 'Cumque nihil dolorem', 'cumque-nihil-dolorem-iRB1l', 'LT2V5JOT', 'Veniam omnis eum nemo veniam maxime voluptatem ut doloribus repudiandae ipsam.', 'Eum est ut labore facilis quibusdam cum. Recusandae est itaque dolores voluptatem consequuntur. Sint doloremque sequi modi et. Repellendus aperiam ratione vitae mollitia autem eos soluta.', '291.63', NULL, 137, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(358, 30, 'Eveniet aut molestiae', 'eveniet-aut-molestiae-LU2Wv', '3U9WIMTC', 'Vel veritatis ut et aperiam mollitia qui ad necessitatibus quis ut porro et suscipit non quidem.', 'Fuga assumenda sequi enim dolorem. Sint rerum eos architecto ea. Laudantium minima laboriosam tempora dolores sit. Omnis ea quo minus.', '248.17', NULL, 0, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(359, 30, 'Eaque modi et', 'eaque-modi-et-sf7WI', 'FFFPOFW7', 'Nobis at voluptatibus aut quo et numquam doloremque voluptatem corrupti qui.', 'Sunt ipsam error consequatur mollitia. Et ut tempora qui inventore incidunt laborum error. Doloribus totam in iure laborum consectetur. Deserunt ut quo necessitatibus inventore.', '102.80', NULL, 35, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(360, 30, 'Omnis ut maiores', 'omnis-ut-maiores-a96LO', 'A4I36QBI', 'Culpa tempora occaecati rem ducimus illum tempore id et commodi repellendus assumenda.', 'Ea ut sed dolorum voluptas vel reprehenderit quia. Voluptas magni rerum ut iste omnis quisquam. Cumque dolorem aperiam voluptas recusandae voluptas eos voluptas excepturi. Cumque illum voluptatem at quidem mollitia consequatur sapiente. Minus dignissimos non velit cum et.', '168.89', '189.04', 35, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(361, 31, 'Ea repudiandae officia', 'ea-repudiandae-officia-KlNgp', 'NNJMN9YF', 'At incidunt aliquam distinctio sunt nulla vel minima et repellendus.', 'Aliquid quia atque laborum doloremque ea ducimus. Consectetur fugit quas rerum accusantium sed. Itaque molestiae error maxime. Dolor ea dolores vel tempora autem porro libero.', '6.94', '33.03', 16, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(362, 31, 'Cumque illo ullam', 'cumque-illo-ullam-BYMSW', 'KWTPUWJR', 'Dolorem magnam nihil aut vel non quidem aut nam iusto sunt pariatur iste exercitationem velit nemo.', 'Sit est iusto et voluptas. Nam neque officiis rerum porro nulla et aut. Animi quae molestias sit eos hic.', '113.60', NULL, 38, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(363, 31, 'Deleniti est a', 'deleniti-est-a-F5CLp', '4OUEIEQA', 'Officiis et accusantium quisquam voluptas et laboriosam delectus voluptas pariatur vitae magnam error.', 'Aut culpa quo dignissimos. Modi omnis dolor aut ex. Similique est alias aspernatur consequuntur sed odio.', '180.61', '190.18', 157, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(364, 31, 'Eveniet odio id', 'eveniet-odio-id-9gIq9', 'ABJ43IZL', 'Vel quia est qui sunt libero libero maxime dolorem non porro facilis sunt est veniam temporibus aperiam.', 'Ut sunt culpa est. Eius dolores et qui quod officiis. Suscipit dolor quia rerum reprehenderit et doloremque aliquid. Voluptate id eos soluta commodi illum. Eius natus modi eveniet quia consequatur. Eaque in incidunt commodi quia optio fugit ut quaerat.', '186.23', '192.61', 173, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(365, 31, 'Sed quis numquam', 'sed-quis-numquam-SOZXH', 'L1XWHYQY', 'Eos occaecati quasi cupiditate voluptatum dolorem dolor recusandae deleniti qui sunt autem tempora magnam.', 'Quo et et omnis ut. Odio quia vel itaque aut. Sunt provident et necessitatibus minima ut ducimus. Totam laborum iste enim molestiae. Recusandae architecto repellendus excepturi sint ullam. Ea ratione est excepturi a esse consequatur sint et.', '23.93', '29.97', 157, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(366, 31, 'Voluptates repudiandae rem', 'voluptates-repudiandae-rem-EiHt1', 'WTVLRRMU', 'Qui sint fugiat necessitatibus quam laborum commodi molestiae eum vel a laborum consectetur.', 'Odio ipsam aut a qui odit. Sint nisi id similique vero voluptas voluptas. Delectus voluptatem nihil aliquam ipsum architecto.', '269.41', NULL, 76, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(367, 31, 'Assumenda suscipit eaque', 'assumenda-suscipit-eaque-Se85V', 'XD1NQYMR', 'Aut enim soluta eaque aliquam ducimus odio magnam ipsa et laboriosam natus.', 'Voluptatum culpa et magnam consequatur natus delectus quas accusamus. Magni quas saepe voluptas nihil. Assumenda vitae illum et nostrum quam. Esse corporis necessitatibus tenetur omnis ut ea. Non qui sit minima voluptas.', '281.36', NULL, 32, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(368, 31, 'Ut necessitatibus quam', 'ut-necessitatibus-quam-mk1MR', 'FENGC5E6', 'Possimus sint voluptas delectus minima quia quasi deserunt dolor ullam et est veniam dolorem.', 'Qui quasi eveniet aut omnis expedita voluptatem. Magnam aut provident odio. Est velit officiis totam qui. Nihil facere dolorem ut aperiam quisquam eveniet. Repellendus ea omnis quas facere autem inventore.', '190.30', NULL, 140, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(369, 31, 'Ipsa quaerat sit', 'ipsa-quaerat-sit-3Kkxx', 'I6FINMJB', 'Suscipit soluta expedita unde velit et reiciendis consequatur architecto.', 'Aspernatur similique aut ut id inventore ea. Et quaerat ut dolorem maiores. Optio fuga impedit in qui necessitatibus molestias expedita. Velit cumque provident deserunt veniam vero modi repellendus vero.', '216.96', NULL, 51, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(370, 31, 'Cupiditate voluptates earum', 'cupiditate-voluptates-earum-TJcWk', 'MI4YMKKA', 'Perspiciatis ea maxime aspernatur numquam neque eaque odit quae eius modi.', 'Cumque optio et et magnam odio quas sunt. Ea ut modi architecto debitis sequi. Fuga omnis assumenda nobis eos ipsa. Provident quis nemo ut eaque deserunt.', '242.50', '274.82', 57, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(371, 31, 'Temporibus qui quo', 'temporibus-qui-quo-KlUNI', 'ZHW6PEXP', 'Quidem dolorem facilis eius tempora facere et dolor id officiis maxime sed pariatur atque.', 'Qui quisquam expedita commodi. Et et delectus dolorem. Suscipit unde sunt excepturi voluptas quia expedita non. Vel et eius est et et non. Magnam possimus qui error possimus officia vel autem. Sunt ratione sunt ad fugiat voluptatibus dicta eaque voluptates.', '180.41', NULL, 116, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(372, 31, 'Nisi velit esse', 'nisi-velit-esse-ZrltR', 'CSBXSR1W', 'Temporibus doloremque officia placeat aut odit hic repellendus ut dolores iusto et consequatur consectetur.', 'Rerum ut autem molestiae excepturi quas aspernatur. Quisquam omnis itaque autem omnis ducimus. Autem magni error debitis blanditiis laborum. Ut possimus nihil officiis aliquid ad.', '57.18', NULL, 128, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(373, 32, 'Fugit rerum similique', 'fugit-rerum-similique-2YsRo', 'NXYFFLRP', 'Ea est et quas voluptas aliquid et ex architecto veniam sed sapiente.', 'Adipisci blanditiis laborum expedita qui repudiandae possimus sint. Est sed ut sint qui aut. Pariatur modi aut enim voluptatem et. Quia libero ab maiores. Mollitia fugiat reiciendis voluptatum pariatur est voluptatum tempora. Quam doloremque qui est voluptas.', '284.32', NULL, 72, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(374, 32, 'Omnis dignissimos vel', 'omnis-dignissimos-vel-AKa3L', '107EZFQJ', 'Qui fuga inventore rerum veritatis magnam voluptatem minus et dolorum expedita.', 'Expedita aliquam veritatis consequuntur dolores eligendi pariatur assumenda. Aspernatur est qui ut a nisi dolorem sit. Blanditiis maxime aut itaque itaque. Dolor enim pariatur modi laboriosam. Accusamus suscipit architecto et velit ipsum vel. Eos iure nihil sunt a facere minima explicabo.', '182.92', NULL, 133, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(375, 32, 'Quod omnis rem', 'quod-omnis-rem-itZq0', 'VFLX9C2A', 'Nobis rerum similique ratione praesentium dolores ad ipsam molestiae eligendi nihil quae pariatur fuga.', 'Officia cumque debitis qui consectetur quis sed. Voluptatem et veniam aut error consectetur et voluptatem fuga. Et hic repellendus sit culpa.', '185.79', NULL, 179, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(376, 32, 'Qui ad dolores', 'qui-ad-dolores-4oIwg', 'MYTJRTDD', 'Molestias velit repellat quas quia qui accusamus repellat architecto adipisci omnis asperiores temporibus eveniet.', 'Id sed tempore in est. Sed corrupti quod rerum aut aliquam. Delectus quod cumque id non. Vero dignissimos vel deleniti. Enim asperiores id quibusdam accusantium aut.', '147.46', '191.96', 185, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(377, 32, 'Quidem officiis ratione', 'quidem-officiis-ratione-kubtL', 'VWE9DMA6', 'Architecto eos voluptatem reprehenderit ipsam aliquam laudantium rerum labore non est.', 'Ut voluptates et nulla quia. Est tempore accusamus excepturi harum officia magnam magni. Ut repudiandae voluptatibus magni odit nam.', '178.09', NULL, 185, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(378, 32, 'Omnis ratione praesentium', 'omnis-ratione-praesentium-zzNoe', 'EJGONBZZ', 'Et officia corrupti eum vitae et et labore quos ut a nobis.', 'Hic dicta maxime quia nihil. Molestias fugiat quas velit et. Voluptas a et atque repellat cupiditate atque. Corporis dolore dolorem laborum sunt animi. Asperiores temporibus quia minima. Dolor eos incidunt minima.', '292.47', NULL, 69, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(379, 32, 'Voluptates vitae quo', 'voluptates-vitae-quo-REBJh', 'KKFZI342', 'Minus voluptates quasi et vel sed et velit totam tempore sint quibusdam iure quae et.', 'Dolor rerum nemo perspiciatis dolorem. Ex quaerat rerum enim non ut cupiditate dolorum. Velit et nesciunt qui nostrum. Qui aut quo quia a est. Perspiciatis nemo deleniti magni fugiat. Quidem id maiores quae mollitia.', '125.85', NULL, 102, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(380, 32, 'Eius ullam iusto', 'eius-ullam-iusto-ropAT', 'W8I9LOMA', 'Aut qui consequatur sed saepe praesentium sunt ut quis tenetur fugiat culpa labore.', 'Ut provident quas ullam officiis. Voluptatem qui adipisci occaecati harum dolor autem est nam. Sunt corporis et culpa enim eos rem. Provident veniam enim provident ut.', '191.94', '213.38', 199, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(381, 32, 'Nesciunt recusandae quia', 'nesciunt-recusandae-quia-LnN0Q', '1MTSWPAF', 'Quod enim dolores ut reprehenderit minus fugiat et reprehenderit et.', 'Odio in possimus accusantium rerum. Unde enim illum ullam voluptatibus consequatur. Ipsum qui ex vitae reprehenderit ut veritatis veritatis.', '299.87', NULL, 152, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(382, 32, 'Animi voluptas omnis', 'animi-voluptas-omnis-OE4Yc', 'DQICDWTV', 'Exercitationem velit repellendus explicabo aut ipsum est eum repudiandae voluptas voluptas omnis.', 'Saepe quos mollitia aliquam doloremque error sapiente facere est. Quidem quia cum quis omnis sint. Et qui eligendi veritatis sunt ipsam natus. Explicabo saepe nam architecto aperiam reprehenderit deleniti vel. Cumque qui nemo est porro ea.', '40.70', NULL, 160, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(383, 32, 'Nostrum necessitatibus perferendis', 'nostrum-necessitatibus-perferendis-C7UbX', 'URLN5OAL', 'Unde cum qui sunt non doloribus consectetur unde quae aut itaque quo.', 'Repudiandae vero id molestiae alias temporibus quos. Necessitatibus aliquam ipsam quia voluptatibus eos. Omnis accusamus quia totam cum distinctio voluptatem dolorem. Adipisci possimus eius ratione reiciendis et. Quas et eveniet quaerat qui. At modi accusantium rerum eum harum consequatur fugit.', '90.98', NULL, 175, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(384, 32, 'Temporibus sed ea', 'temporibus-sed-ea-dzxMR', 'ENWZHSN1', 'Facere et beatae cum ducimus reprehenderit recusandae repellendus odit vero inventore odio deserunt et.', 'Animi reprehenderit natus iusto ut rerum asperiores error. Rerum provident illo et. Magnam est quis molestias at velit. Vel et rem sapiente.', '252.41', NULL, 60, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(385, 33, 'Rem fuga nisi', 'rem-fuga-nisi-tbuqd', '6KYXULEA', 'Fugit laboriosam enim beatae sed quia deleniti dolores saepe enim.', 'Ipsa et tempore deserunt porro. Blanditiis ducimus non corporis vero. Voluptas quia et et et ut. Architecto doloremque aliquam neque. Reprehenderit dolor iusto voluptas eos sunt illo aut. Unde aut aut est expedita porro.', '148.58', NULL, 59, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(386, 33, 'Qui laudantium sed', 'qui-laudantium-sed-aExbL', 'CUQE0HEO', 'Tenetur quasi distinctio ad ut ipsam nisi dolorum qui commodi debitis perspiciatis earum quia accusantium ut voluptas.', 'Aut et est eius magnam doloribus similique dolores. Nostrum amet magnam aliquam et qui. Voluptatem totam ex debitis hic deserunt qui est sint. Eaque harum perspiciatis rem. Est culpa corrupti natus aut.', '153.81', NULL, 145, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(387, 33, 'Est ut magni', 'est-ut-magni-5iiqA', '6PUH1CVO', 'Non qui in totam tenetur quisquam qui sapiente assumenda perspiciatis vero earum culpa repellat rerum id.', 'Laboriosam totam et alias voluptatem temporibus suscipit ratione nemo. Ab voluptate at est dolores. Vero qui voluptatem exercitationem sit ea magni. Sed eveniet iusto et iusto est. Architecto voluptatem et numquam a ea eum atque.', '256.39', NULL, 18, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(388, 33, 'Reiciendis fugiat libero', 'reiciendis-fugiat-libero-W1YB0', 'R4VSR4GO', 'Nobis autem sed porro quam deleniti qui consequatur.', 'Commodi expedita soluta ut vero. Facilis excepturi repellat dignissimos ab ut velit. Iusto fuga sunt assumenda consequatur dolorem odio sed labore. Sit voluptatem praesentium sit delectus.', '160.83', NULL, 160, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(389, 33, 'Tempora at natus', 'tempora-at-natus-kmxBO', 'ISIJBZ1U', 'Veritatis sint sint voluptatibus dolorum officia voluptatem perspiciatis nemo et magnam fugiat saepe tempora.', 'Totam voluptates numquam nihil consequuntur autem autem. Dolore dolorum hic illum doloribus fugit ut. Voluptas facilis placeat eos aut dolores dolorum aut. Vel quod at incidunt rerum et.', '235.78', NULL, 140, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(390, 33, 'Sit quaerat non', 'sit-quaerat-non-QvqwF', 'WEQLF7DX', 'Delectus pariatur aut nemo mollitia quasi deserunt odit asperiores velit cum quis voluptatem quas unde.', 'Dolorem quibusdam veniam et consectetur est. Corrupti veritatis est alias. Temporibus aperiam et earum aspernatur.', '51.07', NULL, 60, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(391, 33, 'Dignissimos repellendus inventore', 'dignissimos-repellendus-inventore-wqIIa', 'GF2SJRYG', 'Veritatis dolore repellat quia illo quas qui alias cupiditate odio.', 'Asperiores cumque repudiandae sed sed quod eligendi. Nisi sit nihil error ut dolor. Iste non aliquam corporis similique illum excepturi. Quia in quaerat consequuntur aut repellendus est doloremque. Ducimus ea qui quia molestias sapiente tempore.', '231.14', '254.05', 184, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(392, 33, 'Optio ut ut', 'optio-ut-ut-lTrBf', 'JYWCEYJ8', 'Incidunt sint hic fugit voluptatem officiis est doloribus eum voluptatem est recusandae commodi sunt quia fuga.', 'Dignissimos molestiae tempore dolor aut qui id. Et repudiandae porro veniam dolorem dolorem. Aspernatur doloremque officia soluta aperiam eos modi possimus aut. Est nam nihil molestiae voluptatum molestiae laudantium.', '104.06', NULL, 96, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(393, 33, 'Temporibus accusamus accusantium', 'temporibus-accusamus-accusantium-9maBe', 'LUR3SU5M', 'Ad non ut optio omnis et voluptas ea provident eaque et aut praesentium porro voluptates.', 'Deleniti commodi quisquam atque doloremque quo aut. Iure sint sunt nostrum quaerat mollitia ut est. Et quia et ut totam. Quos in eveniet beatae voluptatem iusto.', '62.74', NULL, 5, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(394, 33, 'Illum harum dolor', 'illum-harum-dolor-IewCF', 'BGEZ8P1C', 'Omnis exercitationem officia velit sunt numquam porro qui accusamus harum explicabo necessitatibus tempora.', 'Animi unde cupiditate cupiditate perferendis adipisci sint. Ipsa autem autem deserunt nulla labore amet tenetur. Dolorem minus earum consequatur vero et. Esse corporis sed accusamus amet sint quis quod.', '221.76', NULL, 159, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(395, 33, 'Delectus ea et', 'delectus-ea-et-Itk1E', 'ZYTLM0RI', 'Sit tenetur aut ex sunt quia consequatur necessitatibus pariatur dolorem quia culpa nihil quasi.', 'Minima et dolorem amet. Sint omnis quod laborum iure veniam. Voluptas aperiam occaecati quaerat quis aspernatur molestiae voluptatem. Praesentium aliquam ullam qui unde.', '53.59', NULL, 128, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(396, 33, 'Perspiciatis magni nam', 'perspiciatis-magni-nam-YEAIE', 'BKYYTS1Y', 'Non dolor qui ea voluptatum mollitia consequuntur aperiam explicabo qui.', 'Autem quia quos debitis sint nisi. Earum nulla deserunt aut neque debitis quisquam. Quidem error eius amet dolorum ea libero voluptatem. Neque veniam eos vitae delectus. Inventore repellat voluptatibus sed sed voluptatem ea magnam.', '46.01', NULL, 173, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(397, 34, 'Amet maiores soluta', 'amet-maiores-soluta-ZAne2', 'RQRYNCUB', 'Qui aut eos ut est mollitia quidem adipisci architecto accusamus iusto veritatis doloremque alias voluptatem.', 'Et fugit et perferendis quae est. Iste consequatur quos aut consequatur ad. Voluptatum quia et consequuntur quis. Deserunt consequatur provident tempore adipisci laudantium qui voluptatibus accusamus.', '244.56', '286.24', 50, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(398, 34, 'Et doloremque molestias', 'et-doloremque-molestias-rH1JJ', 'SLDXQXDB', 'Atque rerum repellendus inventore doloribus aut voluptatum qui nihil et.', 'Quas impedit commodi et iste adipisci odit quia. At voluptas aut quia libero doloribus quis aperiam. Necessitatibus totam aut nulla in voluptatibus. Dicta sint eos natus rerum veritatis ex excepturi.', '218.54', NULL, 192, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(399, 34, 'Enim pariatur quibusdam', 'enim-pariatur-quibusdam-D1lJq', 'TCPKD7OU', 'Voluptatem distinctio voluptas optio officiis sed a expedita facere.', 'Beatae odio quis magni velit. Consequatur ipsa necessitatibus voluptatem. Totam eaque ipsum suscipit sit. Ab sit facilis a qui eum. Aut dolor fugit sit explicabo nemo.', '152.23', '174.49', 125, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(400, 34, 'Commodi veritatis corporis', 'commodi-veritatis-corporis-EbXct', 'ZUS2JREO', 'Velit ut sequi qui magni voluptatem aut nostrum.', 'Omnis iure et sit excepturi fugiat exercitationem dolor. Et unde inventore quis molestias eum. Eveniet enim dolores fuga magni rem ea totam officia.', '15.59', NULL, 74, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(401, 34, 'Et adipisci voluptatem', 'et-adipisci-voluptatem-Tf8Nl', 'A8JW9XF6', 'Quaerat placeat deserunt doloremque ut sequi porro totam optio ad at at.', 'Minus occaecati provident voluptatem eum aut sapiente. Fugit animi voluptate aut qui dolorem. Ipsam aperiam et sit incidunt. Architecto sed ducimus sunt in. Expedita eligendi expedita aut saepe.', '90.48', NULL, 127, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(402, 34, 'Eveniet veniam modi', 'eveniet-veniam-modi-8AgiI', 'NOWRSKO1', 'Qui sequi nesciunt veritatis ad ut voluptatem in.', 'Ipsam eius numquam molestiae nostrum maiores. Recusandae ipsa beatae sapiente magnam. Perferendis impedit laboriosam molestiae aut rerum. Vero molestiae et provident consequatur. Provident eum placeat quaerat.', '72.46', NULL, 45, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(403, 34, 'Quos et repellat', 'quos-et-repellat-ow6eG', '9JGPG4S2', 'Nihil rerum delectus deleniti voluptatem et perspiciatis nostrum rerum nobis saepe dignissimos est consequatur tempora modi.', 'Placeat pariatur quasi assumenda est nihil. Commodi et inventore ipsa sint officiis sunt dolor perferendis. Et odit eos dolorum nihil error magni. Mollitia sunt odit numquam quia quia incidunt ratione aut. Earum labore totam beatae quisquam. Vel sed in quod quibusdam est ipsam.', '258.52', '287.50', 124, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(404, 34, 'Aut nihil perspiciatis', 'aut-nihil-perspiciatis-zSSpb', 'V0ENQHJS', 'Non dolorem esse voluptatem autem molestias autem officia at nisi sit vel in corrupti.', 'Consequatur est tempora labore qui quasi occaecati. Esse qui aspernatur quae quasi voluptatibus. Amet nam nam explicabo possimus voluptas eveniet quis.', '199.31', '215.69', 151, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(405, 34, 'Exercitationem eum suscipit', 'exercitationem-eum-suscipit-zVaGV', 'SSAOPMND', 'Sint placeat eum vel vero deleniti ut sit omnis et quos.', 'Et harum aut aut. Sequi earum commodi et. Quidem quisquam perspiciatis omnis consequatur aut. Unde fuga laborum temporibus quisquam. Nihil quibusdam corrupti non id laudantium.', '294.37', NULL, 70, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(406, 34, 'Ut molestias omnis', 'ut-molestias-omnis-Y8K9w', 'OL1EDIXS', 'Minus itaque molestias dolore magnam cumque autem repellat quidem odio et non vel est.', 'Facilis sed reiciendis aut et mollitia enim. Id voluptas molestias voluptatem sit provident libero voluptas. Eius autem voluptatem rerum tenetur numquam voluptates. Explicabo natus quisquam labore et id et. Illum cupiditate autem culpa reprehenderit quaerat et harum.', '138.52', NULL, 95, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(407, 34, 'Accusamus aperiam praesentium', 'accusamus-aperiam-praesentium-7TY3z', 'TWMHESFU', 'Aut sapiente rerum recusandae eum tempora non et et sit tempora reiciendis temporibus corporis cumque.', 'Dignissimos vel adipisci et mollitia ratione non. Qui iste nesciunt recusandae et a. Illo officia odio vero. Et placeat illo a animi laborum. Repellendus suscipit sapiente voluptatibus est quia.', '39.60', NULL, 16, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(408, 34, 'Fugiat qui quisquam', 'fugiat-qui-quisquam-vEyVF', 'EIESXYKD', 'Quis ut esse officia aut esse omnis aperiam porro adipisci aut.', 'Qui neque nostrum aut fuga sed. Iure ut sequi modi id repellat repellendus. Et tempore quaerat expedita iusto tempore ex. Architecto quam quod ipsa officiis amet rerum repudiandae sed. Modi ducimus ullam suscipit accusamus.', '278.92', '295.18', 17, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(409, 35, 'Incidunt sapiente porro', 'incidunt-sapiente-porro-cD3cf', 'S4HUVUOR', 'Provident saepe est vero sed mollitia facilis impedit inventore et sunt et deleniti voluptatem quisquam.', 'Quia voluptatum et et. Sunt soluta consequatur esse dolorem qui vitae. Ea velit et aliquam maxime perferendis sit. Quo error esse recusandae aut deserunt in. Quasi nam itaque autem dolorum accusantium est.', '34.37', '68.57', 161, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(410, 35, 'Dolorem sint et', 'dolorem-sint-et-pDGVo', 'WK5UFQG0', 'Voluptatem quia est qui tempore amet laboriosam ducimus recusandae.', 'Dignissimos quia iure repellat voluptatem illo ducimus cum. Labore molestiae omnis ullam aliquid ipsa. Dignissimos qui voluptas fugiat quia perspiciatis facere. Omnis ullam ut ducimus at et aut est. Tenetur optio ut placeat voluptatem rerum non. Est repellendus nihil non minima ut dolor fuga.', '74.76', NULL, 14, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(411, 35, 'Magni voluptas et', 'magni-voluptas-et-hkW8C', 'WLU3FWXW', 'Ipsam at vero neque voluptatem doloribus et totam aut aut odio sapiente.', 'Illum molestiae aperiam et est voluptatum laboriosam. Qui in dolores ea voluptatem et. Molestias assumenda temporibus animi sapiente et. Aspernatur quo inventore hic ratione similique et.', '290.07', NULL, 97, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(412, 35, 'Labore veritatis sunt', 'labore-veritatis-sunt-CBtYP', 'ADFOZMUY', 'Harum numquam totam ipsum soluta sed excepturi aspernatur animi.', 'Dolores facere consequatur ea rem quaerat unde possimus. Eveniet aut et quo qui laudantium. Aspernatur qui voluptatem dolorem explicabo consequatur quia.', '271.45', NULL, 86, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(413, 35, 'Ut laborum similique', 'ut-laborum-similique-zEAXi', 'ZM8AAXB7', 'Omnis sed est dolor quis deserunt quo repudiandae eaque unde.', 'Et cum voluptas molestiae fugit dolor. Consectetur vero omnis quis. Asperiores dolorem ut praesentium itaque ad quibusdam.', '254.52', NULL, 164, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(414, 35, 'Nihil beatae neque', 'nihil-beatae-neque-6NaTf', 'Z5SLLIIP', 'Temporibus sequi explicabo sit asperiores reprehenderit magni sint nesciunt consequatur est in.', 'Reiciendis minima nulla quia amet est dolores. Fuga eveniet ut ullam maxime aut. Eveniet occaecati dolor earum facere qui. Ducimus sunt iure doloribus nobis.', '133.68', NULL, 177, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(415, 35, 'Sunt dolorem earum', 'sunt-dolorem-earum-6Szdl', 'REGFMGFK', 'Quo earum optio similique aut aperiam in dolores.', 'Aut dolores fugiat deserunt saepe illum. Autem hic ipsam nobis laborum. Eveniet iste tempore quidem eligendi autem nemo quis.', '240.25', '258.33', 130, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(416, 35, 'Ut voluptas nisi', 'ut-voluptas-nisi-uKPsd', 'QEMYSUG6', 'Expedita repellat non iste est aliquid ullam maxime eos.', 'Dolor nihil error laborum nihil hic. Quidem in quidem nobis exercitationem sunt pariatur et. Consequatur saepe voluptatem est quia illo voluptas ipsum.', '254.78', NULL, 99, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(417, 35, 'Nostrum sit ullam', 'nostrum-sit-ullam-Th4t7', 'KQRZXDSJ', 'Accusamus et est ut cumque pariatur et natus qui adipisci.', 'Ex quia sit laborum est numquam voluptatibus. Minima veritatis et qui omnis eum. Minus non non assumenda ex. Aut magnam expedita reiciendis vero soluta quaerat cum. Exercitationem consequatur nisi ab molestias porro libero est. Dicta nisi provident possimus itaque aut eligendi rerum.', '192.59', NULL, 189, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(418, 35, 'Maiores cupiditate doloribus', 'maiores-cupiditate-doloribus-lk3q0', 'WPQ4Y4N3', 'Non sapiente suscipit omnis vel possimus maiores tempora consequatur repellendus.', 'Sequi odit fugiat id harum eaque et. Voluptates ducimus dolorem dolorem sit ea eveniet. Ut rerum deleniti quidem sunt et. Nemo quis natus dolorem et ea assumenda. Qui maiores autem accusamus.', '57.95', NULL, 191, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(419, 35, 'Neque rem incidunt', 'neque-rem-incidunt-Pk2DD', 'WEZVM1QT', 'Officia omnis vero minima qui delectus magnam reiciendis cumque laboriosam quo quia eum ipsa velit modi.', 'Sint dicta doloribus dicta aut. Tempore at est officiis soluta ducimus omnis. Delectus et accusamus voluptatem culpa. Cum labore voluptatum et. A neque officiis qui consequatur architecto. Quisquam corporis enim quis rerum.', '155.64', NULL, 94, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(420, 35, 'Ad aut quisquam', 'ad-aut-quisquam-LnA19', 'JDO4FITG', 'Alias dolorum perspiciatis porro voluptatem quos itaque veniam eveniet quisquam eos ducimus quasi.', 'Odit qui deleniti aut molestiae laboriosam tempore. Reiciendis exercitationem praesentium dignissimos voluptas nemo velit. Earum accusantium nobis id mollitia recusandae fugiat nostrum. Voluptatem excepturi sunt velit ipsum ut ratione qui. Voluptatem commodi quo quibusdam voluptates impedit iusto. Voluptatum et impedit quia dolor placeat.', '169.95', '186.65', 166, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(421, 36, 'Enim mollitia rerum', 'enim-mollitia-rerum-mYvte', '0EMHHM1U', 'Itaque est minima atque accusamus et molestiae quisquam impedit sit corporis et aut.', 'Rerum in explicabo qui. Aut eaque et fuga sunt. Consequuntur incidunt incidunt ab cum quis neque saepe. Tempore ut nihil iste.', '236.94', '241.17', 61, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(422, 36, 'Porro repudiandae impedit', 'porro-repudiandae-impedit-brkqn', '1I4QEDUF', 'In enim quo nihil quo quia laudantium nisi debitis dolorum tempore molestiae necessitatibus sapiente illo qui cupiditate.', 'Accusamus non cumque et omnis. Non voluptates sit explicabo. Qui sed eum numquam aspernatur accusamus enim.', '53.36', '86.05', 43, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(423, 36, 'Voluptate ut tenetur', 'voluptate-ut-tenetur-joDAj', 'QQHGPXJK', 'Autem adipisci ut et voluptatem reiciendis rerum iure mollitia ut magnam et id qui occaecati.', 'Quia itaque ducimus rerum ut expedita voluptas praesentium. Nam eos laborum et laborum perspiciatis sint at. Vitae qui consequuntur reiciendis perspiciatis voluptatum aut rerum. Numquam pariatur nihil nulla est est mollitia impedit.', '119.05', NULL, 163, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(424, 36, 'Dolor consectetur incidunt', 'dolor-consectetur-incidunt-eYjyP', 'RULXMJIZ', 'Rerum voluptatem voluptates et quos sed nulla qui libero.', 'Nam molestiae alias eveniet quo. Possimus odio et corrupti provident molestias sunt dolorem. Dolorem eveniet occaecati quasi incidunt assumenda esse.', '137.36', NULL, 29, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(425, 36, 'Voluptas nulla beatae', 'voluptas-nulla-beatae-LOETW', 'HXYCEFPR', 'Consequatur iste ea sunt quas alias quae voluptatibus rerum placeat debitis exercitationem natus.', 'Tempore corporis accusantium sequi excepturi quos harum corporis eveniet. Consequatur qui est vel perspiciatis repellat. Et tempora quasi rerum praesentium ut officia aut. Et itaque placeat aspernatur in possimus ipsa. Hic et sed quia exercitationem impedit id. Iusto odio nostrum velit natus voluptate consequatur porro.', '156.41', NULL, 145, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(426, 36, 'Molestiae eum est', 'molestiae-eum-est-dazaY', 'A4AFMPAW', 'Illo ratione magni et esse quaerat in officia corrupti commodi nesciunt vitae vel aspernatur aspernatur ut.', 'Incidunt natus quae laborum repudiandae laudantium qui. Repellendus quaerat quia impedit excepturi id enim quis. Consectetur eum corrupti praesentium. Vel aut est et dolores. Aspernatur ducimus inventore voluptas et voluptatem quisquam nisi.', '85.78', '110.78', 57, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36');
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `short_description`, `description`, `price`, `compare_at_price`, `stock`, `is_active`, `is_featured`, `use_custom_page`, `page_builder_data`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(427, 36, 'Nesciunt earum id', 'nesciunt-earum-id-cuCT8', 'K1GLGYTH', 'Veniam ex voluptas officia dolorum temporibus ipsa ratione maxime possimus.', 'Quia omnis odit animi quidem. Delectus ab sit occaecati et provident voluptatem similique. Iusto ea ullam a exercitationem omnis asperiores nostrum. Tempore et molestias facere officiis sit. Accusantium nisi qui ratione.', '94.34', NULL, 22, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(428, 36, 'Reprehenderit fugit dolores', 'reprehenderit-fugit-dolores-H42fD', 'JESHCAQO', 'Non dignissimos suscipit sed natus enim ipsa repellat et nemo et illum rerum.', 'Occaecati eos saepe aut ut qui in. Blanditiis laboriosam et et et autem rerum. Omnis dolor doloribus alias dolorem. Enim quae sint nobis qui assumenda sunt saepe.', '157.68', '206.01', 192, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(429, 36, 'Dolorem esse fugit', 'dolorem-esse-fugit-ij3pw', 'DM7SEZZC', 'Non nesciunt unde ducimus molestiae repellendus molestiae excepturi.', 'Sint quia voluptate expedita ut voluptatem. Ea incidunt esse nam officiis vitae explicabo. Exercitationem a ut et. Esse rem enim recusandae quo animi optio enim sapiente. Dolore sapiente est est excepturi tempore. Facere ullam ad reprehenderit ea illum aliquam tempora.', '168.23', NULL, 96, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(430, 36, 'Dolorem laudantium porro', 'dolorem-laudantium-porro-PC39e', 'LHDNU6FD', 'Quia vitae exercitationem sed repellat corporis est nihil amet vel magni nemo numquam molestiae facere amet sequi.', 'Est molestiae quae aut voluptatem. Quisquam aut temporibus dicta quia at in blanditiis. Esse unde amet rerum rerum eos nam fuga.', '111.97', '124.81', 6, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(431, 36, 'Suscipit qui nemo', 'suscipit-qui-nemo-reFc9', 'USSQ0T7Y', 'Quam et ex laborum amet ducimus rerum nisi et excepturi ut aliquid occaecati rerum repudiandae molestias.', 'Accusantium maxime non molestiae quam mollitia porro voluptatem. Iure id consequatur voluptas accusantium. Optio quidem quae modi fugit. Reiciendis et et sit neque. Corrupti placeat omnis excepturi eveniet quo sed quia autem.', '103.43', '141.65', 128, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(432, 36, 'Vero ut et', 'vero-ut-et-7mmw9', 'BKRF2KRQ', 'Eum iusto facilis dolorem dolorum quis laudantium modi architecto et.', 'Enim et ratione aut nulla rerum repellat assumenda. Culpa asperiores est sint rerum et facilis quia. Reprehenderit occaecati ullam ut libero delectus non. Facilis ullam eos dolores incidunt corporis.', '139.11', NULL, 134, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(433, 37, 'Ut explicabo alias', 'ut-explicabo-alias-YJUy6', 'MKKWMOG0', 'Accusamus incidunt nihil qui dolorum sunt enim ex sit ea quod dolor doloremque quis officia.', 'Beatae hic tenetur laboriosam vel. At minima repellendus qui similique voluptatibus enim. Voluptatem libero quis et. Ipsa qui molestias harum et pariatur. Rerum et ea quas quis delectus sit.', '133.04', NULL, 100, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(434, 37, 'Exercitationem facilis natus', 'exercitationem-facilis-natus-6gwQT', 'GJGA2ULJ', 'Qui impedit ipsa nobis ea ut perferendis vero nostrum perspiciatis dolores enim cum sit quia tempora.', 'Quaerat et vero commodi delectus voluptatum tempore dolor. Necessitatibus voluptatem inventore quaerat magni nostrum sit sunt. Quidem est pariatur quos totam. Consequuntur perferendis est tempore mollitia quis et. Est id architecto et possimus autem iure cupiditate.', '173.64', NULL, 163, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(435, 37, 'Quisquam debitis iusto', 'quisquam-debitis-iusto-6doAS', 'LGBM77CD', 'Accusantium inventore et qui deleniti quidem non porro eum tenetur optio qui.', 'Beatae sit neque et delectus sunt vel voluptatem. Placeat inventore ut doloremque aliquam voluptas porro. Id laudantium assumenda nihil fugit libero sint provident. Doloremque libero delectus voluptatum inventore libero sit aperiam.', '65.76', NULL, 164, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(436, 37, 'Eos quam sunt', 'eos-quam-sunt-2aqhx', 'WSNDM17P', 'Sunt eveniet praesentium laborum ut eos sequi suscipit est animi et alias unde.', 'Ullam in provident numquam vitae enim quo. Accusantium sit dolorem a similique fuga ut. Unde maxime quisquam exercitationem amet. Iste consequatur ullam sequi perferendis.', '295.47', '318.02', 46, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(437, 37, 'Tempora perferendis voluptas', 'tempora-perferendis-voluptas-m0bi9', 'XF7LNHZV', 'Quasi magnam sunt in aut distinctio corrupti aliquid magni aperiam deleniti consequatur.', 'Error consequatur facere officia. Voluptatum a iure facilis corporis mollitia est facere. Aspernatur error blanditiis voluptatem repudiandae voluptas. Quia minus quaerat repudiandae delectus molestiae hic adipisci. Earum sed at et omnis consequatur voluptatibus delectus in. Eum est nisi est perspiciatis blanditiis eveniet voluptas nam.', '154.43', NULL, 111, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(438, 37, 'Maiores distinctio consequatur', 'maiores-distinctio-consequatur-YPYiB', 'YOQAA73R', 'Nihil sunt dolorum aliquid voluptate delectus incidunt qui omnis numquam ut natus illum voluptatem.', 'Qui et ipsa ut aperiam sed provident. Corrupti atque eos aperiam facere adipisci. Maxime et molestias harum facere. Enim consequatur et architecto dignissimos. Facilis quo quas unde quisquam.', '147.45', NULL, 14, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(439, 37, 'Earum cumque non', 'earum-cumque-non-ChaQj', 'QDGKOR8L', 'Voluptatem voluptatum in et enim voluptates illo est voluptas et corrupti est ipsum est dolorum.', 'Harum recusandae dolor id voluptatibus odio adipisci. Commodi enim dolor porro est quidem quia. Unde quasi perspiciatis ad et dolores cum. Quod necessitatibus dolores et corrupti earum odit recusandae.', '201.27', NULL, 157, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(440, 37, 'Quis libero voluptates', 'quis-libero-voluptates-7lrrd', 'QVMHKPH6', 'Dolorem cupiditate impedit vero soluta perferendis consequatur temporibus in tempora quibusdam qui cumque voluptates molestiae voluptatem ut.', 'Consectetur explicabo et et qui sit quisquam. Facere vel fuga quod a hic. Voluptatem sint autem esse necessitatibus nam maiores facere illum. Commodi quibusdam aliquam veritatis rerum odit. Molestiae ea voluptatibus amet rerum.', '178.25', NULL, 76, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(441, 37, 'Officia et ab', 'officia-et-ab-Iarhp', '1VWWJLLH', 'Eum ad repellat ut eius deleniti debitis similique.', 'Voluptatem officiis reprehenderit et doloremque dignissimos minima. Sed quisquam recusandae iste. Tempore itaque aut quisquam qui quia.', '73.75', NULL, 175, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(442, 37, 'Occaecati consectetur accusamus', 'occaecati-consectetur-accusamus-mPOd5', 'SGLAIH7Q', 'Nihil est voluptatibus qui voluptate mollitia inventore non.', 'Fugit fugiat recusandae ad tenetur dolores. Totam delectus accusamus ullam quia eaque ab suscipit. Deleniti quia quidem quaerat ad eum quia.', '62.84', NULL, 159, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(443, 37, 'Repellendus sed veritatis', 'repellendus-sed-veritatis-MRTon', '5PW4MUVK', 'Consequatur aut voluptas enim unde sit similique amet.', 'Quo aut nemo nesciunt minus ea est dolor. Qui iste perferendis expedita mollitia voluptatibus. Voluptates repudiandae non minus veniam quia. Maxime fugit et maiores et velit eos. Sunt inventore soluta praesentium fuga consequatur consequuntur voluptatem officia.', '111.76', NULL, 182, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(444, 37, 'Qui aut aperiam', 'qui-aut-aperiam-4BAgp', 'MKDRHDI5', 'Eos blanditiis molestias quis vitae quia sint error et ab mollitia quam dolores consectetur iste.', 'Iusto et non illo dolorem sunt quos et. Minus earum velit saepe ipsam mollitia eaque. Vitae omnis incidunt quis sit non suscipit. Nulla molestiae nam est quae enim nesciunt.', '175.59', NULL, 48, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(445, 38, 'Fugit consequatur velit', 'fugit-consequatur-velit-oNLth', 'PXMYMMI4', 'Debitis eaque corporis eum qui et asperiores corrupti.', 'Perferendis ad ad commodi ut exercitationem. Consequatur aut consequatur nemo. Amet illum et quam dolor et qui.', '111.32', NULL, 188, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(446, 38, 'In et non', 'in-et-non-GHfAp', 'E1ECBYT8', 'Perspiciatis id eveniet placeat ea nisi officiis quia molestias quas est nostrum quis.', 'Est quia cum dolor aut nulla est adipisci. Et nostrum eius similique ad commodi et dolorum dolor. Officia quis explicabo illum numquam fugit ipsam assumenda placeat. Ipsam officia ut tenetur cumque. Et nisi optio a velit ea magni et.', '253.19', NULL, 79, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(447, 38, 'Voluptatum quas illum', 'voluptatum-quas-illum-wDN2N', 'PQZTSURL', 'Ipsam non dolorem reiciendis voluptatem maxime minus ullam earum illum.', 'Consequuntur et voluptatem excepturi dolorum ut id. Incidunt nostrum porro quidem harum reprehenderit deserunt. Ex accusamus dolore esse libero sit autem adipisci. Pariatur reiciendis aspernatur molestiae perferendis et.', '202.14', '227.96', 152, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(448, 38, 'Error quis saepe', 'error-quis-saepe-PoOQ5', 'EG2W2RX8', 'Nihil explicabo ex natus aliquam similique perferendis voluptas dolores minus delectus error minus doloribus.', 'Qui et pariatur inventore ea. Rem nisi laborum atque expedita. Doloremque ut a laudantium necessitatibus animi sit non. Voluptatem impedit excepturi est suscipit voluptatem officia.', '268.92', NULL, 122, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(449, 38, 'Velit rem cum', 'velit-rem-cum-H1L2B', 'IQM20HAM', 'Sed rerum ut sed praesentium aut quaerat id voluptatum et.', 'Qui voluptas laboriosam id eligendi itaque aut qui. Nemo qui non aut aut ducimus praesentium accusamus. Autem ad facere dignissimos. Dicta doloribus et quia ullam praesentium. Ut vitae aut soluta dolore sit. Corrupti consequatur voluptatem quam.', '23.38', '27.27', 119, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(450, 38, 'Voluptatem qui quam', 'voluptatem-qui-quam-GgeKR', 'JJ3ZQLJU', 'In dicta vero dolor eum et aut error pariatur repellat quia ad.', 'Consequatur nesciunt error et corrupti sint sed. Autem corporis deserunt dolorum voluptatum molestias quis. Aut molestias ratione rerum esse illo.', '228.41', NULL, 187, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(451, 38, 'Voluptatem et est', 'voluptatem-et-est-4lPVO', 'PGIK9Q8Q', 'Molestias voluptatibus hic enim velit eos illo dignissimos animi dolores est.', 'Sint distinctio quae officia est amet neque. Soluta quo eligendi sit voluptatem doloribus qui eos officia. Fugit molestiae incidunt sequi enim. Totam fugiat ea ipsum et sunt nihil. Repudiandae sequi totam voluptatem iste odio inventore. Veritatis quo commodi et tempora velit.', '196.95', NULL, 76, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(452, 38, 'Nam ipsum quia', 'nam-ipsum-quia-MK7W8', 'XHV7GQIX', 'Enim ullam suscipit amet quis at quos placeat est sed aspernatur.', 'Quo ut eveniet ratione. Non quis non alias voluptatem consequuntur. Quod architecto sit corporis. Quidem quo molestias in doloribus enim. Hic quam non cupiditate voluptatem. Soluta consequatur similique laboriosam et qui.', '245.16', NULL, 120, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(453, 38, 'Nulla accusamus ducimus', 'nulla-accusamus-ducimus-9ygu3', 'Y1ZVL71Z', 'Quisquam et ut aperiam et laborum quia qui autem alias et nam in maiores corporis eos sed.', 'Optio incidunt optio ipsum blanditiis. Doloribus aliquam et rerum repudiandae. Eos architecto ipsa architecto sequi dolores perspiciatis. Nihil ut sapiente quas et ducimus cum. Deserunt sed at reiciendis molestias. Aspernatur reiciendis vel esse alias.', '87.69', NULL, 31, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(454, 38, 'At at ut', 'at-at-ut-OdvVP', 'G606U71Q', 'Aliquam dolorum quidem reiciendis minus maiores dolor et ullam cupiditate eaque cumque aut.', 'Autem nulla consequuntur est totam error veniam commodi omnis. Earum dignissimos explicabo rerum nulla voluptate. Et ea nihil dicta exercitationem. Sit fugit asperiores et velit aliquid dolorem repellat. Cumque ex sit atque voluptates eaque ea. Eaque enim dolore aut nulla omnis sit.', '122.26', NULL, 196, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(455, 38, 'Eligendi aut voluptatem', 'eligendi-aut-voluptatem-Zn9Ai', '478TLHYO', 'Iste unde aut non dolorum quis commodi et sint suscipit impedit optio velit voluptatem est.', 'Et dolores et ut id. Hic enim et non. Sit impedit consequatur velit dicta. Laboriosam enim et nobis rem recusandae.', '168.74', '203.30', 15, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(456, 38, 'Rerum animi sint', 'rerum-animi-sint-h26hG', '2Q0XSV1C', 'Ut corrupti asperiores vel molestias vitae distinctio molestias.', 'Qui delectus in temporibus eos et. Sed enim qui exercitationem asperiores in veritatis facilis. A rerum porro iusto consectetur blanditiis. Voluptatem adipisci modi unde voluptatem molestiae quidem.', '221.54', NULL, 31, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(457, 39, 'Ipsum pariatur aliquid', 'ipsum-pariatur-aliquid-jIrQi', 'FTQ6DBUM', 'Et assumenda nihil quaerat a saepe minus deserunt corrupti veniam earum excepturi animi.', 'Repudiandae itaque consequatur minus debitis sunt assumenda accusamus. Aut ut soluta debitis eos ullam omnis molestias. Sint quaerat est amet corporis in maxime aut. Laborum impedit explicabo praesentium sint nesciunt sequi qui.', '274.88', '298.30', 108, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(458, 39, 'Ut rerum veritatis', 'ut-rerum-veritatis-B0mJG', '7SRQUGGT', 'Omnis placeat occaecati totam sunt rem vero dolor necessitatibus omnis.', 'Laboriosam esse aut vel tenetur optio. Incidunt at beatae culpa id laborum fugit. Maxime voluptates cumque magni aut non numquam possimus. Eius non dolorem voluptas omnis. Animi ea sapiente vitae omnis quo ab.', '42.57', '56.03', 67, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(459, 39, 'Iste harum rerum', 'iste-harum-rerum-gHI2s', 'MTJ6QLJQ', 'Et dolor quas quo repellat praesentium aut deserunt quam voluptatem.', 'Veritatis eaque sed quam corrupti reprehenderit molestiae dolores. Voluptatibus laborum et deserunt quia. Autem quidem neque voluptatem dolorum consectetur voluptatem optio.', '212.07', '259.05', 92, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(460, 39, 'Ipsum deleniti modi', 'ipsum-deleniti-modi-rnwsv', 'I4TMGDXB', 'Et rem et ut vel voluptatibus aut sapiente nihil inventore similique sed.', 'Quam labore ut voluptatem rem laboriosam. Tempore hic expedita est dolores ut consequuntur inventore nihil. Est a neque est delectus est rerum quidem. Voluptas est possimus quaerat odit voluptas neque. Explicabo unde molestias aut beatae ipsum rem.', '140.93', NULL, 116, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(461, 39, 'Mollitia ex asperiores', 'mollitia-ex-asperiores-JxTtw', 'LHDL78NZ', 'Modi facilis quae enim odit culpa et a consequuntur voluptas.', 'Et quidem eius magni ratione deserunt labore ea. Sint debitis numquam expedita reprehenderit et consequatur rerum. Ex ratione quis earum at repudiandae voluptas et. Sed iusto aliquam est modi esse necessitatibus. Vero iure sunt inventore unde.', '268.15', NULL, 183, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(462, 39, 'Voluptatem dicta esse', 'voluptatem-dicta-esse-1oSol', 'QQV9CPAT', 'Temporibus omnis aut atque nihil occaecati voluptatem quia tenetur laudantium omnis consequatur quo et vel voluptates.', 'Fugiat a recusandae reiciendis autem dolore quam. Alias quas at veniam rem. Sequi voluptate voluptatem error quia laboriosam ipsa. Neque earum quo sequi maiores facilis maxime. Repudiandae et vel dolores pariatur.', '64.98', '69.00', 91, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(463, 39, 'Repellendus voluptates deserunt', 'repellendus-voluptates-deserunt-JIBcz', 'PX3XOWZY', 'Consequuntur laboriosam aut nesciunt repellendus ex ipsa eius nulla eveniet aut temporibus perferendis consequatur quis.', 'Consequuntur sed neque possimus repellendus harum sunt quos assumenda. Quia occaecati omnis distinctio repudiandae provident id accusantium. Ut rem odit vel incidunt dicta voluptate. Modi culpa nisi porro fugiat quo. Quis suscipit eum velit odio sapiente vel ea illo. Deleniti repellendus voluptas voluptas odio reprehenderit.', '166.56', '212.14', 65, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(464, 39, 'Praesentium dolores ut', 'praesentium-dolores-ut-xBzKX', '9ZNQZHFC', 'Consequatur illum quod ipsa rerum et qui minus eius ratione inventore ad et deleniti ad.', 'Iste veritatis sunt quia maiores molestias ab. Cum consectetur quae inventore fugiat aperiam aut illo. Quia porro qui quia aut est voluptate. Eum dignissimos suscipit est fugit consectetur. Nam laborum suscipit incidunt nihil minus qui. Iusto et mollitia sit ad natus explicabo maxime architecto.', '54.73', NULL, 154, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(465, 39, 'Ut ex in', 'ut-ex-in-OGbKu', '8VBPOQRL', 'Iusto optio et sed sunt et ut est quae quibusdam omnis.', 'Est sunt eaque ut quam veniam eum id modi. Aut illo rerum et fuga. Voluptatem nihil reiciendis deserunt qui aut temporibus amet.', '84.69', NULL, 165, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(466, 39, 'Et et molestiae', 'et-et-molestiae-y5D6E', 'MTSLW9VO', 'Quo sed ex ducimus cupiditate consequuntur pariatur dolor repudiandae laudantium unde aut.', 'Perferendis asperiores autem voluptatem ut quasi distinctio. Accusamus est numquam perferendis accusantium earum voluptas qui. Eaque alias architecto quia corrupti. Consequatur earum recusandae maxime accusamus omnis ut cum. Omnis sequi fugiat nesciunt qui id.', '114.50', NULL, 97, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(467, 39, 'Eos sint quia', 'eos-sint-quia-ryp7H', 'RLVAZDCY', 'Voluptatem earum rerum doloremque dolores voluptatem deserunt mollitia qui impedit praesentium veritatis.', 'Dolorem et dolorum voluptates quisquam. Facilis numquam ut dolores dicta consequatur eos. Qui ab maiores nulla. Eum nesciunt aut ea sunt consequatur incidunt voluptatibus repellendus. Doloribus doloremque voluptate expedita perferendis.', '223.34', NULL, 44, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(468, 39, 'Quod qui itaque', 'quod-qui-itaque-Ufw9V', 'KPQPLH90', 'Aperiam dolores qui autem ullam nulla optio distinctio.', 'Omnis eveniet id maiores doloremque eos. Est rerum atque hic fugit. Recusandae et provident ab.', '52.41', NULL, 106, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(469, 40, 'Omnis a quasi', 'omnis-a-quasi-x6GAt', 'S9C00EKA', 'Itaque deleniti beatae eaque non aut et labore expedita necessitatibus et ad enim ad et hic.', 'Necessitatibus quo sit et et similique enim est. Explicabo assumenda sint ipsa magnam esse. Omnis impedit magnam consectetur placeat. Nobis consequatur minima illum officia quis occaecati minima.', '121.94', NULL, 107, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(470, 40, 'Sed ullam saepe', 'sed-ullam-saepe-mYEBf', 'ZQENTDWP', 'Quas accusamus itaque ab molestias explicabo incidunt voluptates nihil tempore asperiores aut aut.', 'Aliquid eos placeat qui ut eos fugiat id. Quo perferendis laborum hic error aperiam dolorem eum. Quasi non natus illo. Et ut qui illo aut delectus. Reprehenderit quia tempore explicabo sit debitis dolorum.', '280.28', '328.39', 30, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(471, 40, 'Omnis voluptas harum', 'omnis-voluptas-harum-STYwZ', '5KTOQ16N', 'Saepe ea aut illo quasi rem rerum fuga est.', 'Id qui aliquid quam sequi inventore. Quod perspiciatis ut id corporis eos. Ducimus officia impedit libero hic. Totam et quidem doloremque qui. Ullam deleniti voluptatem perferendis tempore laboriosam.', '257.56', NULL, 147, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(472, 40, 'Nisi ut cupiditate', 'nisi-ut-cupiditate-XjDFk', 'E9PNSP0E', 'Ea voluptatem molestiae tempore nulla ut in ipsa.', 'Quas suscipit quia quas laboriosam qui. Commodi voluptatem ipsam autem at tempore officiis velit suscipit. Natus beatae non dolor voluptatem. Ducimus aperiam quod quis.', '89.95', NULL, 137, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(473, 40, 'A excepturi quia', 'a-excepturi-quia-MB2tW', '9BJWU6SS', 'Aut cum doloremque aspernatur modi ipsum earum laborum dolorem laboriosam unde cum impedit atque corrupti.', 'Itaque eveniet qui odio deserunt ducimus quaerat numquam. Recusandae exercitationem et qui quia est molestiae rem. Sint dolorum quis asperiores ullam et.', '24.60', '68.64', 0, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(474, 40, 'Unde dolores dolorem', 'unde-dolores-dolorem-Ufbrh', 'PBVEKXFX', 'Molestias quia porro esse culpa consectetur suscipit enim consequuntur quis et qui.', 'Rerum odit expedita sapiente temporibus quasi esse. Perspiciatis est error nihil rerum ullam. Aspernatur sed et consequuntur eveniet quidem in. Soluta adipisci ex dolores nemo. Sint ducimus aut accusamus nam natus rem et. Distinctio doloremque expedita aut et.', '164.45', NULL, 58, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(475, 40, 'Vitae ut libero', 'vitae-ut-libero-xGL7Y', '6SSGLIZ7', 'Et deleniti autem soluta et sunt quisquam earum eius repellat.', 'Quia expedita quam dolor est libero. Vel accusamus tenetur non a aut mollitia distinctio. Quasi voluptates officia molestias maxime a repudiandae non. Laboriosam aut maiores laboriosam deserunt consectetur non alias.', '255.34', NULL, 164, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(476, 40, 'Dolorem quisquam voluptatem', 'dolorem-quisquam-voluptatem-VkHpI', 'CBYBB3NJ', 'Consequatur quis debitis facilis repellendus quod repudiandae veniam sint occaecati.', 'Alias quidem et consequatur suscipit. Quia et dolores vero quas rem. Voluptas autem voluptatem exercitationem dolorem fugit reiciendis.', '264.04', '295.72', 125, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(477, 40, 'Alias totam corrupti', 'alias-totam-corrupti-zVvsH', '9VTQAVIG', 'Sunt ut nostrum et consectetur corrupti commodi necessitatibus quibusdam in praesentium voluptatem et hic nesciunt exercitationem.', 'Eius reprehenderit corrupti accusantium omnis officia natus quas. Et beatae eius ullam deleniti. A error ratione similique ad doloribus rerum et. Consectetur laboriosam ad iusto non ut.', '65.44', '71.91', 107, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(478, 40, 'Delectus dicta et', 'delectus-dicta-et-ZBo97', 'SQGI4XGR', 'Qui ullam rerum voluptatem quo illo quaerat doloremque quasi aut dolorem ut maxime voluptatum.', 'Sunt sunt autem nam minus ratione et et. Omnis consequuntur accusantium voluptatibus id repellendus eos unde. Temporibus et quidem et et quis. Non ea id quia veritatis.', '263.94', NULL, 183, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(479, 40, 'Sequi consequatur praesentium', 'sequi-consequatur-praesentium-5yHX2', 'GICJQUOD', 'Nulla dolorem ea ab sequi eveniet nobis eos voluptatum.', 'Autem molestiae pariatur laboriosam exercitationem ut ipsa. Animi libero veniam mollitia id fugit at et. Repellendus dolor repellendus voluptas amet cum. Voluptate est nesciunt possimus sequi consequuntur rerum.', '88.77', '90.90', 86, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(480, 40, 'Autem dolore aut', 'autem-dolore-aut-VIg1e', 'CUNL86KM', 'Aspernatur expedita necessitatibus voluptatem velit fuga omnis porro sapiente.', 'Atque rerum aliquam minima id ut laboriosam. Tempora vel molestiae eligendi. Sunt qui perferendis repellat vel.', '146.34', NULL, 106, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(481, 41, 'Accusamus officia non', 'accusamus-officia-non-NOZKw', 'JCEBFVJ9', 'Harum qui omnis voluptatibus vel vel recusandae accusantium sit illo ullam nihil ut consequatur ab.', 'Dolorum quisquam enim quaerat aperiam at. Possimus quidem consequuntur omnis ea quo dolorem atque. Rerum est quo inventore. Architecto maxime laudantium eos et et. Voluptatem libero culpa occaecati consectetur aliquid deserunt quis laboriosam. Sit quia consequatur sapiente.', '72.49', NULL, 27, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(482, 41, 'Et ut et', 'et-ut-et-iD8e3', '5HVMIHP6', 'Ut nulla in maxime ipsam nemo natus nesciunt iste odio non.', 'Accusantium deserunt repellat reiciendis. Facere cupiditate nesciunt qui quos voluptatem inventore quae velit. Culpa eligendi autem necessitatibus atque minus non quibusdam. Totam eius est necessitatibus rerum ad. Fugiat maxime aut ratione debitis mollitia ipsam. Eos illo cum voluptate eveniet blanditiis iure non.', '65.11', NULL, 194, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(483, 41, 'Dicta et aut', 'dicta-et-aut-BhkfZ', 'YO5GV6DJ', 'Iste id et eius aut autem rerum accusamus porro tenetur odit neque.', 'Aperiam et aut et tempore atque fuga natus. Et nihil possimus similique. Qui quia vitae possimus. Quisquam sit quis qui corporis repellat. Voluptate praesentium sequi facilis aliquid vel fugiat.', '12.55', '59.69', 20, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(484, 41, 'Qui saepe sed', 'qui-saepe-sed-DsEfL', 'RT3XH78C', 'Culpa et aut quam dolore autem et natus dolorem illum adipisci.', 'Esse vero voluptate possimus dolor. Minus qui facere et magni delectus error. Voluptatibus omnis assumenda sed molestiae neque. Voluptatem commodi quia itaque adipisci incidunt. Sequi perspiciatis est et natus vel officiis. Perferendis magni et aut ea.', '246.54', NULL, 108, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(485, 41, 'Qui est vel', 'qui-est-vel-a1nQ0', 'P7ZZJ2UJ', 'Qui illum recusandae dolore dolorem quia facere ipsam non tempore cumque modi.', 'Corrupti dolores aut cum et sed beatae. Perspiciatis vel consequatur porro voluptas non. Autem voluptatem vitae quaerat. Nobis quae aliquam quia nulla. Corrupti officiis quae est veritatis vero ut officia facilis.', '170.95', NULL, 101, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(486, 41, 'Autem et enim', 'autem-et-enim-9o5R6', 'L10SAA8Y', 'Adipisci sit reprehenderit perspiciatis at inventore dolorum fuga quaerat aperiam ut corporis.', 'Commodi qui rerum vel velit autem. Numquam ratione perspiciatis quidem quo. Accusamus quia cum corporis eum enim rerum. Minima nisi alias ducimus earum aut provident culpa. Beatae suscipit nihil consequatur dolorum. Earum vel hic quasi ipsa animi.', '268.65', '307.81', 106, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(487, 41, 'Impedit est nesciunt', 'impedit-est-nesciunt-oMJHF', 'YXXMV403', 'Explicabo quisquam ea ducimus veritatis dolore maiores id culpa eum non repellat ratione.', 'Repellat atque dolorum nihil dolorum ab sequi. Suscipit dolores itaque enim repellat repudiandae a unde. Qui vero impedit cupiditate nihil et quia est. Eaque quam at aliquid rerum ea molestias.', '50.44', NULL, 159, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(488, 41, 'Neque architecto quia', 'neque-architecto-quia-dPG59', 'I6D4XG9Q', 'Ex tempore distinctio iusto omnis accusamus quis ad et.', 'Laborum quis occaecati maiores necessitatibus. Placeat eos voluptatum qui ea ex molestias fugiat assumenda. Eos dolorem mollitia dolores.', '180.08', NULL, 134, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(489, 41, 'Aut id eos', 'aut-id-eos-faWGY', '3F1TWF7Q', 'Non modi consequuntur dolorem qui dolore ut officiis qui ut magni omnis voluptas sit dolorem vel.', 'Mollitia dicta ipsam quia dolore fuga cupiditate. Optio molestias doloribus sapiente quidem. Sunt velit eos et officiis nemo accusantium. Eos soluta quae quia soluta recusandae inventore. Omnis ipsam minima amet et. Quibusdam excepturi nihil sed consectetur dolor voluptas.', '13.55', NULL, 99, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(490, 41, 'Eveniet error cum', 'eveniet-error-cum-5ZnDe', '3QCYAWHZ', 'Quis aut vero aut fuga sit consectetur unde fuga id at ut ea omnis omnis cupiditate.', 'Voluptates consequatur voluptatem soluta omnis occaecati voluptas. Nihil dolore vitae et perferendis rerum. Sint non sit nihil. Quia est ut distinctio. Amet ipsam ut distinctio voluptates laborum quis non. Magnam dolor inventore iste totam aut.', '131.25', '153.91', 77, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(491, 41, 'Et cumque assumenda', 'et-cumque-assumenda-SloMM', 'JPGATEX4', 'Consequatur est at alias quaerat mollitia harum rem optio.', 'Rem nisi ut ut earum. Eum ab temporibus et harum quam consequatur numquam hic. Laudantium quam optio in. Labore placeat nesciunt nam omnis. Aliquid molestias alias aut. Aut consectetur neque et modi.', '19.43', NULL, 182, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(492, 41, 'Quo deserunt delectus', 'quo-deserunt-delectus-vLpsU', 'DQHXAIMO', 'Ipsa debitis debitis eum perspiciatis ducimus eius saepe deserunt.', 'Quae nobis quos sed est in. Omnis aperiam labore dignissimos aliquam. Doloremque sint est voluptate cum. Expedita corporis id dolorum earum eveniet. Asperiores voluptas vitae explicabo doloremque sit et ut voluptatem. Rerum perspiciatis veritatis nihil.', '177.02', NULL, 118, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(493, 42, 'Nostrum et dolor', 'nostrum-et-dolor-nxi0O', 'EFUZULKO', 'Possimus vel possimus beatae et doloribus necessitatibus sed dolore.', 'Doloribus veritatis sit impedit sed iste. Optio corporis non ea. Ut aut voluptatem hic nihil laborum. Sequi ut vitae molestias totam perspiciatis veritatis.', '66.63', NULL, 36, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(494, 42, 'Laudantium voluptas a', 'laudantium-voluptas-a-nLevb', '1EZHDD60', 'Dolores enim blanditiis exercitationem voluptas repellendus perferendis quibusdam blanditiis animi itaque.', 'Impedit aliquam vel veniam deserunt nesciunt laudantium quis. Sed corrupti nisi est culpa. Beatae ullam voluptatem non corporis. Laboriosam numquam in voluptates perferendis et. Rem suscipit et sapiente in libero possimus sunt.', '275.83', NULL, 177, 0, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(495, 42, 'Laboriosam ducimus deleniti', 'laboriosam-ducimus-deleniti-ytqtc', 'JNRHQTKU', 'Esse ipsam non vero ut culpa placeat dolor recusandae porro incidunt fuga.', 'Est ut blanditiis et placeat cumque iste iste. Animi accusamus aut ut repellat et. Nihil optio mollitia debitis consequatur qui iusto. Excepturi voluptates vero et ex vero. Ut numquam deleniti sapiente facere veniam velit.', '174.67', NULL, 88, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(496, 42, 'Officia assumenda incidunt', 'officia-assumenda-incidunt-ym2ts', 'R7CMPTAL', 'Fugit rerum eos magnam et ea pariatur harum minus esse reprehenderit et suscipit maxime sint omnis dolores.', 'Odio autem esse cum quaerat rerum tempora praesentium. Culpa praesentium voluptas inventore. Deserunt et suscipit et totam modi nobis et ut. Consectetur numquam nesciunt ut dolores.', '220.69', NULL, 173, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(497, 42, 'Dolores minus ut', 'dolores-minus-ut-tClVl', 'PWF8UP58', 'Repudiandae culpa consequatur et voluptates accusantium adipisci quasi asperiores at possimus facilis rerum et dolores laborum quos.', 'Officiis tempore sequi rerum voluptas. Itaque facilis accusamus dolor ratione. Provident odit voluptas recusandae. Id dolores non placeat veritatis exercitationem accusantium.', '17.66', '20.36', 135, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(498, 42, 'Maxime odit occaecati', 'maxime-odit-occaecati-olo3D', 'UJLIOHES', 'Quo adipisci nostrum odio dolorem maxime numquam aperiam voluptatem eum rerum tempora corrupti molestiae.', 'Qui perferendis asperiores ipsam voluptatibus debitis tempora. Dolor quia quaerat quas id beatae id sequi. Distinctio molestiae qui nisi nobis amet ut. Nihil enim quod expedita nam. Aperiam quod deleniti quis et accusantium cumque voluptatibus.', '292.55', NULL, 21, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(499, 42, 'Accusamus et molestiae', 'accusamus-et-molestiae-UZFY7', '0WDZAVND', 'Eveniet quisquam aut et expedita asperiores suscipit occaecati dolorem officia.', 'Dolor eius dolore labore. Maiores qui aut temporibus delectus accusantium rem. Sed cupiditate autem impedit. Eveniet repudiandae quam at dolores excepturi non qui. Deserunt velit maxime perspiciatis reprehenderit quam.', '264.34', '288.25', 187, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(500, 42, 'Eum officia tenetur', 'eum-officia-tenetur-1qIbT', '84SI6APO', 'Maiores omnis impedit quo laborum ut qui ducimus.', 'Et reiciendis voluptatem non sunt. In rem repudiandae quos. Expedita sit porro rerum velit sunt.', '244.63', NULL, 110, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(501, 42, 'Veniam minima omnis', 'veniam-minima-omnis-TnbdG', '1XTGGMAN', 'Quibusdam ut et error qui id ut voluptatem consequatur voluptatibus atque.', 'Occaecati est assumenda est fugiat sunt. Autem ipsum similique aperiam qui consequatur voluptatibus beatae. Est totam eaque qui nisi aut quibusdam in. Culpa ex eum ullam unde. Nobis harum ea deleniti nostrum. Quisquam qui pariatur eveniet.', '91.44', NULL, 27, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(502, 42, 'Modi debitis libero', 'modi-debitis-libero-cuXxI', 'PFSPUEHY', 'Ut earum et animi aut qui voluptatum eveniet doloremque.', 'Fuga vel sint repellendus. Eaque voluptatem veritatis enim sunt. Quas neque molestiae eum illo et. Aliquam et facere qui quod ipsa pariatur.', '295.46', NULL, 119, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(503, 42, 'Rerum voluptate aut', 'rerum-voluptate-aut-YU3TV', 'CJRXVVG9', 'A eveniet praesentium debitis minima ducimus sed et provident.', 'Dolorem vero et corporis fuga eos. Optio fugit voluptatibus cum sapiente assumenda. Reiciendis doloremque inventore nostrum possimus sint recusandae rerum.', '137.19', NULL, 53, 1, 0, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(504, 42, 'Non fuga aut', 'non-fuga-aut-3rDMV', 'WMMBFGML', 'Quia officia et dicta libero vero assumenda doloribus aspernatur cum ea non iure.', 'Repellat non rerum aut corporis sunt. Fugiat consequatur consequatur quis perferendis et delectus delectus et. Eum corrupti sit rerum omnis ut maiores et. Rem inventore sit at alias sunt.', '88.47', NULL, 156, 0, 1, 0, NULL, NULL, NULL, '2025-11-30 12:25:45', '2025-11-30 12:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int UNSIGNED NOT NULL DEFAULT '0',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `path`, `position`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 1, 'products/ad148123-9b78-4545-8993-d48ff401cee4.jpg', 1, 1, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(2, 1, 'products/9ab64222-87a1-4d9d-b636-c8740ab5abf4.jpg', 1, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(3, 1, 'products/2ff645c8-d6b1-41fb-a3fa-ba32145ea146.jpg', 2, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(4, 2, 'products/24109144-5429-4458-92d4-119714b05185.jpg', 1, 1, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(5, 2, 'products/a86efef0-bcf5-4c66-a442-a4ea83d93609.jpg', 1, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(6, 2, 'products/89a2259b-7b50-4932-9729-eaef775208f2.jpg', 2, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(7, 3, 'products/fcdd65d3-aab2-4e62-ba2c-3b210e71c12e.jpg', 1, 1, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(8, 3, 'products/5ff2199e-35a6-4b41-a322-c1d928683343.jpg', 1, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(9, 3, 'products/72ba5cb1-1180-4020-8bf6-5392dde57ad3.jpg', 2, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(10, 4, 'products/53377a09-280a-4bdb-8fe8-3b62cd1b6f59.jpg', 1, 1, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(11, 4, 'products/d6976c50-17c7-44ec-a3d4-564444201ba4.jpg', 1, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(12, 4, 'products/a5d2608d-ac6f-41cc-b04f-2025bd36fe9c.jpg', 2, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(13, 5, 'products/aad5f5b6-69a5-4d8b-ab5f-88cb17a07cf2.jpg', 1, 1, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(14, 5, 'products/b169f978-8cdf-4a19-a624-e08eed6f2109.jpg', 1, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(15, 5, 'products/5771b8ad-09b8-4e70-b600-2be3826ec8b3.jpg', 2, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(16, 6, 'products/9c94f7be-07ba-4302-88b8-a72633d41f92.jpg', 1, 1, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(17, 6, 'products/4987202f-2b03-4d4c-a6bc-a556ab92d797.jpg', 1, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(18, 6, 'products/f1e3bbf8-b306-4fb6-9eee-ac5d72f66b17.jpg', 2, 0, '2025-11-30 11:08:16', '2025-11-30 11:08:16'),
(19, 7, 'products/9fdb9f86-3c37-4dbf-bcd4-96b95988c181.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(20, 7, 'products/76d235c9-d673-4109-a39a-3b4ae4c437c2.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(21, 7, 'products/41b53399-fdf2-4de3-be10-374b1c82a51d.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(22, 8, 'products/8a512973-0351-4ec0-a209-64242ab4f1ab.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(23, 8, 'products/1d90a23f-1da1-4a37-b138-498a25c3e6ad.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(24, 8, 'products/3fdf488a-e9e1-483d-8dfa-b0be446088f3.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(25, 9, 'products/fdf82ca3-9e98-4e65-ba30-5a8c87e68af4.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(26, 9, 'products/1409101d-14e5-484a-aae8-4a79e25ea4a7.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(27, 9, 'products/82b08d4c-4e53-476d-85d2-5ff6d0e156ce.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(28, 10, 'products/4d1eb876-ddc0-4c9d-bd15-a182f7107434.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(29, 10, 'products/dee05ace-6860-4b76-9045-f45f82eed9a0.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(30, 10, 'products/ecad51d4-3bd0-4941-b754-293a57329f43.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(31, 11, 'products/16be7e44-0c40-4139-8162-29b5ff8b6be5.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(32, 11, 'products/bb4f9cd8-fdf3-4418-b22b-17167d92539c.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(33, 11, 'products/cab307a1-a513-4d1f-a56a-a6b2924ea0d4.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(34, 12, 'products/9b16f359-4091-4359-bbd6-513e49c4a8cd.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(35, 12, 'products/4ae062ad-e1d6-48cc-97b6-9e8e97d966bb.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(36, 12, 'products/38ff9c8a-eae1-4630-af88-69b551796287.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(37, 13, 'products/16f650a3-6927-4e6b-a6c9-1956df7d8924.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(38, 13, 'products/9084a409-dd6f-4f7d-af21-accd4c823854.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(39, 13, 'products/6f5adfee-5562-4bea-8b27-8ad39c9ffa79.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(40, 14, 'products/0042bd10-7d66-42e7-a253-3842a137a003.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(41, 14, 'products/f95ea2eb-5e28-413b-abb1-ef1ad20cc6f8.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(42, 14, 'products/18a8e037-1d5a-4107-99f1-df6f5d5840f2.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(43, 15, 'products/650bf83d-2184-4f35-b219-090228afe93d.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(44, 15, 'products/b7d53c65-f580-4560-86ba-986996b5d4c8.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(45, 15, 'products/86197fdb-354f-464f-90cd-ba89e2fe1477.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(46, 16, 'products/5177dabd-7528-4b6e-8457-e1f0604e59ac.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(47, 16, 'products/eca6b86a-4329-4a8a-92d3-8edb2e571b8a.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(48, 16, 'products/bde9e5da-6f11-4aa9-b186-52114dec0c84.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(49, 17, 'products/5b4cd05b-3e7b-4459-af46-066308618da2.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(50, 17, 'products/d113f45c-a5c3-485e-8ab0-e75fc3f54994.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(51, 17, 'products/c083e534-ecef-47d0-abda-8867c455d2f9.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(52, 18, 'products/5dfb9f73-6c4f-4c6a-b233-de33e5868aa7.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(53, 18, 'products/59cccfde-1e14-41e9-8be7-d2fd6888f310.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(54, 18, 'products/3d3d5959-c7fe-4470-953c-f813049ffdc5.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(55, 19, 'products/5947de60-8e09-4078-932f-85427dde84d7.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(56, 19, 'products/762781b0-fa1a-434f-a91d-fafdee69fd71.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(57, 19, 'products/387eb2fc-4687-4978-a597-000bccf0d9f7.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(58, 20, 'products/585e8977-d03d-42e5-a5dc-8c89f7e64f1f.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(59, 20, 'products/2482ffa1-1254-4545-8875-520ebfffca72.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(60, 20, 'products/6c95b9d1-52b9-4201-ab31-63305f618145.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(61, 21, 'products/7232582b-e892-4fcc-80b5-ba50ab846657.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(62, 21, 'products/6d36cbd6-4533-4036-8bc6-a0c52607159b.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(63, 21, 'products/9a81278f-f5ef-4b5d-a851-b05def3d4993.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(64, 22, 'products/4e1cc100-bad5-4d60-a534-e999e3aaecae.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(65, 22, 'products/45dcae77-de31-4555-aec2-fac435e40ddd.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(66, 22, 'products/0b171fd4-59f5-44a0-991a-4efdb00a9402.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(67, 23, 'products/a13fb44d-1d60-4ac2-8777-bc24f718e900.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(68, 23, 'products/13dfccd0-016f-4173-ac21-21657da386a3.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(69, 23, 'products/394b7ca1-6c08-46a0-8a3e-feb47f5032e2.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(70, 24, 'products/b26f6788-32c3-435f-a4b9-30dd9608d67b.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(71, 24, 'products/6e5e73e2-1889-4fb9-a238-8fa93d68a75e.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(72, 24, 'products/44ac3636-1155-4865-9b5d-093ad1300cc3.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(73, 25, 'products/effcbd94-7ae0-43b2-90ca-9d220ec9f69d.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(74, 25, 'products/6b6d6d40-73ca-479b-83c4-178fbc5ef68d.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(75, 25, 'products/4c568f4f-7012-46e3-bdcd-26fec9106e88.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(76, 26, 'products/50c5a208-fc90-4ed1-a2d0-098279fc1397.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(77, 26, 'products/6a6a812d-85da-40a3-9009-1e45565303e4.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(78, 26, 'products/7853f4fe-285a-48ce-8db1-2562cc588185.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(79, 27, 'products/86f38333-6210-4fbd-9e36-bdfe2ff05541.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(80, 27, 'products/f666de47-e950-4d87-bffc-19b2b0c54967.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(81, 27, 'products/7e8e0832-3b8c-4ce0-92d6-9420740c5a78.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(82, 28, 'products/98b58a08-a43c-4549-aaf2-2af34c3760cc.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(83, 28, 'products/cee062c3-111c-4b7f-850e-8dba90e755df.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(84, 28, 'products/69a5a240-0902-4602-8de6-b85e32bd8508.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(85, 29, 'products/5b79a9ee-6f4a-4324-9969-0817cf4f6c69.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(86, 29, 'products/c8d2ad96-8290-4013-a902-a71b502084df.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(87, 29, 'products/09c86e0f-38bc-4275-a570-80147c0db858.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(88, 30, 'products/7e74a61b-c66a-4442-b2fa-dfc678218407.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(89, 30, 'products/c8ab1e2e-7c8c-4294-b8e0-619ad74ac8a0.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(90, 30, 'products/9005bb6c-d2d7-4a15-8d6a-d0f634dad63c.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(91, 31, 'products/53c02fe8-9fdb-4410-9238-9dc7b31606dc.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(92, 31, 'products/9f8809c7-9e71-4865-9c4c-f076a60df4b4.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(93, 31, 'products/1a98c697-71d6-4719-95c7-1627ea386d59.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(94, 32, 'products/be14ba70-6cf5-4dac-a284-204cefbafc86.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(95, 32, 'products/2e6f2540-8864-4517-9922-0607048d8d99.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(96, 32, 'products/26b80590-e488-445e-9b80-a8d978d27316.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(97, 33, 'products/59c425b9-e076-43d4-a082-845ec4e5c59a.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(98, 33, 'products/63f9373c-ebeb-4e08-af4a-04530a15d015.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(99, 33, 'products/dd96665b-0b35-48bb-a9dd-dfc891d697cb.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(100, 34, 'products/b2f8c8e0-474c-49c4-afa5-6d3562b4d0c8.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(101, 34, 'products/ab2bd74d-3ddf-45dc-9028-aaf01d39eeb4.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(102, 34, 'products/fbafad7c-83b6-4697-9241-2311bbe38d2c.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(103, 35, 'products/e20b65da-532d-449a-b388-ddca26f5adcc.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(104, 35, 'products/7bf0b76e-054e-4e39-bd2c-7c70b647260b.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(105, 35, 'products/f6c3e60c-9b6d-4abb-be1b-b31bbe5fba88.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(106, 36, 'products/ced06fad-bab3-4122-ad60-d7ca767ef8f7.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(107, 36, 'products/856c3906-9097-45cd-8d44-74f49b4f151b.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(108, 36, 'products/d1bad607-2774-4868-98e4-5ea7360ec238.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(109, 37, 'products/b2380b81-434b-4787-9eb9-46eb4a697a11.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(110, 37, 'products/b38d1298-8068-4172-b7cd-f1097d090948.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(111, 37, 'products/d675e855-b58b-43da-b52d-750cf8dc874e.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(112, 38, 'products/4d5b1963-57eb-4da1-9e1e-4620ed1adab4.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(113, 38, 'products/1be401bd-1548-4a0a-88aa-2f27cd4412e3.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(114, 38, 'products/0b8d965a-93e6-420a-97bc-29b59e23e049.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(115, 39, 'products/aba35e52-5ddb-4e07-8a74-970739d65744.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(116, 39, 'products/7d813215-3bef-4f8b-8abd-0c910df2fcbe.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(117, 39, 'products/411f6bd7-c542-4f79-994e-1647090a5cdd.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(118, 40, 'products/6393b6fa-384f-46c2-b560-b266a241cc72.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(119, 40, 'products/c1d6116f-ebd6-41c5-a8d1-7488ec5ea69c.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(120, 40, 'products/060cbe87-51a2-41cf-bf61-e5d6ef061c4c.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(121, 41, 'products/94e2a5bf-0dc7-4338-bb88-31294561be34.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(122, 41, 'products/6aa65327-028e-40ba-b535-00ba1e5e474f.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(123, 41, 'products/37f91a56-b601-48c6-a9c2-db43729bbf35.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(124, 42, 'products/4e80b7d2-06f6-44a6-941f-e765d68bd20b.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(125, 42, 'products/49cee8a1-d430-4aad-8c50-8e99de266752.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(126, 42, 'products/82c6da5a-6883-4295-a831-3b51d24413e2.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(127, 43, 'products/15383fe9-1b73-443a-bf53-66ff595a8e63.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(128, 43, 'products/d7b26890-658b-42db-a839-ed8a070d325e.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(129, 43, 'products/6bb8f386-eab9-4900-8f6d-6d03dc945cf5.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(130, 44, 'products/ba412e41-c4f1-4436-a44b-31a014045339.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(131, 44, 'products/f9ef2d13-bc1b-4691-893b-786afe6aa36c.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(132, 44, 'products/6cd79ce0-62cd-4c21-9ee5-93ada2db57c2.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(133, 45, 'products/b20a422b-be6d-4fd0-9e59-26af89134568.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(134, 45, 'products/6015c74c-5561-431f-b29e-3af5c638fbaa.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(135, 45, 'products/0d7f8d2a-9285-44fa-b002-63f1a4b616c7.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(136, 46, 'products/c52e8761-827c-488b-a333-9838100423c9.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(137, 46, 'products/e1eac327-bbc8-476c-b6cf-7059a10b5cfb.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(138, 46, 'products/cd15d0fc-972d-4459-92f6-0bdb64d066c5.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(139, 47, 'products/ffbd08d5-7959-4e7e-a9a1-1e8839487396.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(140, 47, 'products/48b52594-4ef9-4392-86c5-1bbab7bc7553.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(141, 47, 'products/d57b8d7d-2c90-4c31-b2af-e82da1814fa1.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(142, 48, 'products/4ccf3d54-e7e1-434a-86f4-e650a519bbf8.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(143, 48, 'products/59b5d9ec-fad6-4ce4-ab2d-2132bf6e431a.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(144, 48, 'products/8d6db588-cd6d-4e66-a49d-e942d34dd1f8.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(145, 49, 'products/eb3f435f-266b-4dd0-aca1-46657315ccea.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(146, 49, 'products/d461b5e7-54c0-40ab-9443-4d84729928d3.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(147, 49, 'products/c41b7e89-5ed0-406c-9cb7-ce89f067e931.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(148, 50, 'products/9b20e98d-5478-4e3b-b9d7-25fbc9422878.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(149, 50, 'products/d3b21d11-80b0-4f33-aef5-a1c384c62d18.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(150, 50, 'products/50d2c195-e1ed-457c-9c71-fab6cb816805.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(151, 51, 'products/f7ed8c43-4111-4565-b485-3bb35b1c293b.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(152, 51, 'products/fd41c76b-7f8b-4ae8-8b8c-4fe49f2dac11.jpg', 1, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(153, 51, 'products/5e68e04a-5588-4dfa-b256-08698e3f382c.jpg', 2, 0, '2025-11-30 11:08:17', '2025-11-30 11:08:17'),
(154, 52, 'products/b956c176-f355-4452-a14d-e82a5c50cae6.jpg', 1, 1, '2025-11-30 11:08:17', '2025-11-30 11:08:18'),
(155, 52, 'products/3bd6af1a-1040-4474-a9e6-1d889ac9b857.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(156, 52, 'products/98e0895a-48d9-4443-aedf-2a8ffef1993a.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(157, 53, 'products/c8157f4a-b199-4cf2-b546-998712a55431.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(158, 53, 'products/ef830b46-84ca-46ab-a2f1-edc0dd2fe829.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(159, 53, 'products/9e458048-971d-48bf-b40b-32fd38a79d90.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(160, 54, 'products/005b0301-82ed-4ddf-8fcd-3b6f5f2b8682.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(161, 54, 'products/57e2c1fa-1f48-4fd8-82ca-61276b311b00.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(162, 54, 'products/1703f0d0-071b-4fa9-b450-de31ceb6cd26.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(163, 55, 'products/c314abaa-750f-4ae8-8f3b-5748f6f2eda8.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(164, 55, 'products/381152fd-77e9-493c-aa3d-9430682e7d0e.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(165, 55, 'products/dec4f298-f3b8-493d-b5d9-b9440774bd55.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(166, 56, 'products/6c514720-0f07-4081-a1e3-178afa5e6dc8.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(167, 56, 'products/d44a2532-0405-4ced-abe3-455841d6d2fd.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(168, 56, 'products/1eca827b-46f7-4b9d-be7e-e5fc428ae0c5.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(169, 57, 'products/e7fa447a-9539-4e35-b45b-b24f52a896b6.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(170, 57, 'products/b3838176-8639-4b73-9e1c-22d97c4f8898.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(171, 57, 'products/2d5cfa7a-888b-4dc1-bd35-843ac2155064.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(172, 58, 'products/bcee2e05-bde4-4c81-b054-f8f4cf9e38f1.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(173, 58, 'products/f2f60cc8-2695-44dc-b141-f6fa575a1f06.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(174, 58, 'products/cb5ce131-4d22-4f87-905f-23ba908801e0.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(175, 59, 'products/47dea659-9a8b-4055-919a-6574e4a41d1b.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(176, 59, 'products/19a0e44c-aa53-44e7-a0b5-75aa533f8007.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(177, 59, 'products/4d638396-9238-45c4-be56-dd863533fd38.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(178, 60, 'products/9faa1049-4b82-4d7a-8b10-d5bc57655731.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(179, 60, 'products/68af7feb-80ff-4bc9-bb92-96b96485fd26.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(180, 60, 'products/02d460af-a613-4708-9b39-6bbf293d6f6f.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(181, 61, 'products/f6f2f3ce-ad5d-424d-85a9-5df490413825.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(182, 61, 'products/c85db5d5-c684-4b6c-b9a6-6a2b8adec1de.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(183, 61, 'products/6222f51a-f1c2-45ed-a8d6-40e7a2d356cf.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(184, 62, 'products/203670b9-908b-4da5-96a8-93529661f59c.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(185, 62, 'products/686ff41a-f72d-498d-b3d1-b9f24c664d72.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(186, 62, 'products/9648f4db-1c45-402e-bbf6-1532c0c48007.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(187, 63, 'products/8e6620ab-266a-42f3-bcc1-dbf7e6031ccb.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(188, 63, 'products/593447ac-8ed6-46db-aec1-776303044b91.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(189, 63, 'products/9b7df753-adc8-4d86-8b30-aacd6e50a59d.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(190, 64, 'products/9833cfb8-4af5-4716-98ab-55f00b0a7a78.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(191, 64, 'products/56d894e8-e937-4e30-a270-49b7941451fa.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(192, 64, 'products/9969b39d-3abe-4371-9376-acadcc8ef2e5.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(193, 65, 'products/2d0a20fe-deb5-4baf-ab49-aeccafa716a4.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(194, 65, 'products/79c397eb-d1c2-4b7b-803a-48e3d23ae72f.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(195, 65, 'products/10d2b4c8-1553-478c-a277-65ec615709c0.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(196, 66, 'products/79759b01-b2a1-4f44-9ea6-759f5932fceb.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(197, 66, 'products/2769851d-9d28-411e-ae0f-03eda8b52e98.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(198, 66, 'products/2cc70e3f-93d7-4df3-b990-75eda318c503.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(199, 67, 'products/78547a18-7f2c-4703-a964-846e0781bd9f.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(200, 67, 'products/9826a5e9-6482-4b39-9b91-f75b7184ca47.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(201, 67, 'products/ae14f430-f8d2-47c8-98e5-91462ac39b32.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(202, 68, 'products/c2008b75-47d9-4e0b-be30-87764820d1cd.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(203, 68, 'products/a1b18901-fddf-42bd-836b-3259ccc7a4b4.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(204, 68, 'products/cc9e6111-387b-4084-85bb-efaddde0542b.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(205, 69, 'products/4bffcc0b-b118-41d3-b65c-20f0930c1b10.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(206, 69, 'products/3f34df08-01bb-47b2-b955-236d91685b92.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(207, 69, 'products/f88bf916-b203-487b-9120-4aeb0f8ca199.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(208, 70, 'products/777e65fc-479b-4065-be92-dd3cc9935672.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(209, 70, 'products/8ef55f09-f340-426f-844f-d1de99d6e511.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(210, 70, 'products/53b74519-7bfc-4c7e-b7b0-20a4d95e2e48.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(211, 71, 'products/9baa056a-7a10-4923-8e32-20c44926360d.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(212, 71, 'products/761567c4-d1c8-4ad4-9d27-b715b5a2a28b.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(213, 71, 'products/a01d7a7a-66ef-4b2d-b286-4a9cbaf73649.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(214, 72, 'products/dbfe7e18-dadd-4f04-9953-b2e513ccf442.jpg', 1, 1, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(215, 72, 'products/3ed9327a-5f9b-4391-a146-60be13e582d0.jpg', 1, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(216, 72, 'products/0ce98a40-973c-4851-98a6-52b49fe844dc.jpg', 2, 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(217, 73, 'products/04658691-8889-4ce5-9737-d3dc577fef8a.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(218, 73, 'products/cf53fa27-b37c-47af-abbe-ca5cfaf80c17.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(219, 73, 'products/913728ca-6209-46a5-83f8-43e6cbe82177.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(220, 74, 'products/a4e7f3b5-5a71-4eaa-9b35-593f2cb69fa4.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(221, 74, 'products/0a413817-a220-403e-b1a4-89cbb369d544.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(222, 74, 'products/790658e5-edc9-4ff6-a510-ca13e0c283ae.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(223, 75, 'products/c3a52907-88fc-4387-a880-bf5c1e2b7c8f.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(224, 75, 'products/c7ffbd21-cd6a-43ca-848f-361df79ffcfd.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(225, 75, 'products/a7eb043b-ed29-4230-92e1-172ec09dfbf3.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(226, 76, 'products/49c375be-4bde-4113-bbdf-9e12c61bd870.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(227, 76, 'products/bc635470-4a2f-4566-9458-4628d6a65dff.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(228, 76, 'products/0168c083-24e6-481b-976a-f68b2573fbbf.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(229, 77, 'products/5c4808e4-5524-4572-8f18-51cefa0a9103.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(230, 77, 'products/3f6921c8-4bb4-4fb5-9003-ff0c4368b780.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(231, 77, 'products/c6c52f25-60eb-406d-9104-fa7926d11fdc.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(232, 78, 'products/05c3cb84-289d-4297-86f1-af1478f2299c.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(233, 78, 'products/f0454785-ab43-47d0-ba58-af982be4d44a.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(234, 78, 'products/7188127f-1703-49b2-908c-a2bab39d9ce4.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(235, 79, 'products/56515a0f-88e4-4c14-82ed-4a45941b5978.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(236, 79, 'products/cde2142d-4591-48b6-a6df-c6a14de80f0e.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(237, 79, 'products/fa4c052f-72a6-49f9-9561-1a1215fa1686.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(238, 80, 'products/b5a08adb-c5a1-4ee6-8c28-c7dfe0eeefaa.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(239, 80, 'products/5d3e6aec-d2f9-4fad-a3ea-f6ca57d03994.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(240, 80, 'products/e124679c-4b03-48a7-b4ca-a1f73a055183.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(241, 81, 'products/6325ecdb-1531-4437-8e98-21eb7bbff0e0.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(242, 81, 'products/6d8026ab-9ff7-465b-b597-9d3e96ec635c.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(243, 81, 'products/055c431f-5e48-4d39-9279-3b5c8b80ac9d.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(244, 82, 'products/1ab6adb7-a24c-4965-84f6-9f94d4076c33.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(245, 82, 'products/f42f48b6-deae-406e-84b9-e83f2ffeec99.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(246, 82, 'products/81e9b843-cafa-4af9-9483-bc2df87461f9.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(247, 83, 'products/7d5475b9-ee1c-4db7-9d83-5e5002fd7e8e.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(248, 83, 'products/89e0d3b7-b06f-4597-902e-57e176b38256.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(249, 83, 'products/2f1d0ef4-8bcd-4d0e-8cd3-4b9b695168bf.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(250, 84, 'products/8d7f36f7-d56a-4a0e-b412-ba94ae8cc500.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(251, 84, 'products/21369f26-3647-4c01-8bc5-14818d6c4033.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(252, 84, 'products/f8da859b-0ce6-4840-be03-a0238125b657.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(253, 85, 'products/01d87f5d-7763-458c-bea5-79c0e2be31d1.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(254, 85, 'products/4602dc9f-4a2d-4782-b9cb-3da2fc9958d3.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(255, 85, 'products/519a58a9-42dd-43c6-afb7-5d645a7196f3.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(256, 86, 'products/fce2e1be-5c48-4b06-8c3d-d409fe3ac8c6.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(257, 86, 'products/fd96f99b-85df-43dd-b5a8-5e226411d297.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(258, 86, 'products/5dbf4b40-3f64-4c2e-b40c-df181d21ce15.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(259, 87, 'products/b4b5d7e9-fb8d-46a1-b5c4-a634f2c77de6.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(260, 87, 'products/454aa148-c81a-4a1d-8e0a-fe92cb711f72.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(261, 87, 'products/30dbcc6a-0376-4dd2-808f-9db01497e711.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(262, 88, 'products/fd789792-0583-4f22-bbc3-14fd2f3dc928.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(263, 88, 'products/34a517d0-44f4-42e3-9257-dc5a3fe645f1.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(264, 88, 'products/24f8ebf3-89c2-4104-b650-8b3e22d3aae2.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(265, 89, 'products/6c9b3894-56fd-42c2-ab3a-85ce0f99e01a.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(266, 89, 'products/34b07b25-fbcd-435a-b4e9-6947c45a4b2b.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(267, 89, 'products/d2513593-0cd0-4815-977c-9b35c84733ae.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(268, 90, 'products/39e2e89e-8235-4fba-a6fd-36ad0937b118.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(269, 90, 'products/f7bc7778-4952-48b9-88a9-7235fa986ce7.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(270, 90, 'products/37024129-8843-4da6-8e15-38764d26a4a8.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(271, 91, 'products/4c4b9a70-480a-41a9-aa63-b602f7e80e7c.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(272, 91, 'products/4fcab25e-2e6d-474e-89ce-70fc08be1069.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(273, 91, 'products/582a4993-4cc0-4c6b-858b-e9e92c148205.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(274, 92, 'products/0bd196ce-fdd1-4aec-9e54-25392d219cc3.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(275, 92, 'products/a4915c92-86dc-41ce-b9d3-21fd7f7e1e2b.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(276, 92, 'products/fb264bf0-92a2-4cfc-9d51-e39f877def9d.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(277, 93, 'products/cf0d9ff0-cd51-4b6e-a1e8-6f179eadd78b.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(278, 93, 'products/611a600a-eedf-4077-8b02-706549008635.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(279, 93, 'products/ff8986ef-7a8e-4573-b824-45a67a48c131.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(280, 94, 'products/49cc569f-1783-4f5c-a78d-53b87eced884.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(281, 94, 'products/6cdbcbb7-6ef9-4592-b72d-a37625376a89.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(282, 94, 'products/76d14188-a57f-48cd-b593-1b5ae9d7ae77.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(283, 95, 'products/30ad7f07-417f-4aab-ac5b-393450ff4910.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(284, 95, 'products/1a0b8ad6-cdfa-4bc8-9d7c-25b9ce74e2fd.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(285, 95, 'products/df0f57f7-f1d7-4156-95e1-5c8824e7b5a5.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(286, 96, 'products/7ed47d7f-5eb9-4a09-85e7-e9be3ea0e52c.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(287, 96, 'products/7874e168-1e1b-4af3-9e6f-4f9038258965.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(288, 96, 'products/a08b8b04-c348-4919-abfc-eb0fce7b3d66.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(289, 97, 'products/c7b287cd-1287-4cfb-996a-8d1846cc5144.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(290, 97, 'products/9502b3c0-e7f5-4620-a110-2cd0e69b94a7.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(291, 97, 'products/06ea3bdc-c93d-4fea-ae44-7022f5414d5e.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(292, 98, 'products/3d40ac50-6784-473a-b374-6a096490a146.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(293, 98, 'products/71a75fc5-6646-421e-9339-5bc9e905f8d4.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(294, 98, 'products/951aa7f0-fc3e-4cbe-bfca-4fac81cc4f25.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(295, 99, 'products/207759ef-9a89-45e3-82f0-d67737c08f59.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(296, 99, 'products/7f2e60cd-f49a-42a8-bf07-92c98e218ea8.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(297, 99, 'products/3cff20eb-1194-4894-9473-fedbbcbb4b30.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(298, 100, 'products/fc4c8471-e7c1-449a-b022-30ccdf5f0242.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(299, 100, 'products/fd46a402-0ee3-4da1-8a08-d66f6dc8de2a.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(300, 100, 'products/9092ef98-cdb7-49d9-aece-f6b87e19d49c.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(301, 101, 'products/c6f0030e-7c0a-4876-a5ab-af9d8532f4e9.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(302, 101, 'products/2a8bff71-20ac-4bf3-ad60-c5b16953bb9f.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(303, 101, 'products/af6dc1d8-d207-4d31-b8b4-201c6150213f.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(304, 102, 'products/87e0a64b-426b-45b6-920b-f6548e193a99.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(305, 102, 'products/ef694e26-5c38-424d-bae2-54e84869fdf4.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(306, 102, 'products/c9e11aac-dedd-46b6-89d0-3ebecc933725.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(307, 103, 'products/55abbf0b-9919-4c68-9d37-c80402e974c2.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(308, 103, 'products/34c586a7-bf37-49c5-a1d1-37af651e3764.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(309, 103, 'products/cb60d5e2-d1df-4130-89af-7bd0b79abb25.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(310, 104, 'products/d68f1480-1128-4869-9717-8885ee78b4ee.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(311, 104, 'products/a9a65dca-e985-409b-b269-09666753cb76.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(312, 104, 'products/d3387e56-cd33-4d07-8683-44f627ff96cb.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(313, 105, 'products/91888f10-d8cb-495e-83ee-344fc2a1ffba.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(314, 105, 'products/15fceaa0-c660-426c-8de3-8e862eccc9c4.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(315, 105, 'products/f4985ffc-4a27-4b48-8283-9df3f3c0775b.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(316, 106, 'products/fae5e82f-57de-40ae-bd3b-ad238691d022.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(317, 106, 'products/9db9e84d-88ae-4de0-a72c-dfda359494ca.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(318, 106, 'products/042e3a79-bcbf-4508-ae07-67e7ad3bb54c.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(319, 107, 'products/047bc8f3-a3e3-4617-9fc2-4b50d5067262.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(320, 107, 'products/e760748b-6481-4647-beae-078d10d3e3c6.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(321, 107, 'products/926dd74c-337a-4e38-a7f0-f3ebe38a262f.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(322, 108, 'products/0929d9b4-db30-49b7-9091-b9320cc7c9b3.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(323, 108, 'products/07a7a31c-c346-4a03-b439-f6bb3f85a2a0.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(324, 108, 'products/cbba4f69-96be-4328-8aff-5230bccd8b75.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(325, 109, 'products/f8794785-8bc3-498a-94ad-3e336942139b.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(326, 109, 'products/f0092503-ac53-44c5-bce8-5a2e799d5604.jpg', 1, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(327, 109, 'products/c86683fe-2fe7-411f-9043-37c8a3f26ac5.jpg', 2, 0, '2025-11-30 11:10:01', '2025-11-30 11:10:01'),
(328, 110, 'products/97b879d4-ee67-4aca-8a8e-560b7d366c71.jpg', 1, 1, '2025-11-30 11:10:01', '2025-11-30 11:10:02'),
(329, 110, 'products/3cb62d06-2020-41ce-9e4a-37705b962a82.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(330, 110, 'products/34e52fd7-f700-4842-a477-5d148c6dd3c1.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(331, 111, 'products/6d03f407-b6b2-430a-8e30-b045a7825fa7.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(332, 111, 'products/1f0a4683-0994-4b64-a594-0cca2cdf0542.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(333, 111, 'products/d12e39a2-70a9-458d-b6aa-b943abe4b395.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(334, 112, 'products/529813fc-dcf4-489c-9423-832babf3973e.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(335, 112, 'products/f083779f-e004-431b-84bf-4cc95c05b922.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(336, 112, 'products/0e6ac903-3f64-4b43-a375-4dfe53446b03.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(337, 113, 'products/f7fbada9-5fd4-4a16-aad6-eefeb16fd19d.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(338, 113, 'products/bfbaf6ff-4268-49fa-b76e-464bd35d1e70.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(339, 113, 'products/6eccce81-f517-4c18-8705-804b55ed3cc0.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(340, 114, 'products/d9ae5b51-1aa1-440b-a4eb-f0dd11ff2d5e.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(341, 114, 'products/43d31890-77a1-43d1-86e3-b1e1026eb260.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(342, 114, 'products/805542dc-0fc5-4232-a68a-24bea2dbaed9.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(343, 115, 'products/e4746c28-1106-4d77-accd-4c9a0fb0de38.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(344, 115, 'products/8d767464-33cb-4643-8e87-da08a3c925a4.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(345, 115, 'products/4ed01609-f4df-46eb-9ca7-ec67126da35f.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(346, 116, 'products/a68dfbe4-1225-4cde-bf57-1b687ca26388.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(347, 116, 'products/669a2a5d-7cf3-49c0-a2c0-b5c38af499f6.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(348, 116, 'products/ed68c46e-f77d-4a4f-a9fc-5d3059666737.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(349, 117, 'products/0579d221-a464-4959-8398-f85680bcbca9.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(350, 117, 'products/79256acf-814d-40db-9f37-2c4f0a6780d1.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(351, 117, 'products/7b258ff7-eecf-4d62-aedb-d17357cd5d4f.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(352, 118, 'products/8d2d2d9c-0896-4aa1-933e-d260d9c8a310.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(353, 118, 'products/a3b1b6e9-a43c-415d-8005-f3f95a898b56.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(354, 118, 'products/96065567-9a54-46af-aec0-e3eab2c63605.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(355, 119, 'products/56c3e003-df4e-4551-aa11-e2fc5e094c50.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(356, 119, 'products/17a46ae5-189e-470c-88d9-f984320de004.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(357, 119, 'products/5a733005-0f3a-4148-854a-70df1e986207.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(358, 120, 'products/17d92611-5398-4803-99ff-92019b256e36.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(359, 120, 'products/99308761-8ab3-4622-890e-14d853629d06.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(360, 120, 'products/c968c79e-d181-4da4-bd90-8da5582165a1.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(361, 121, 'products/8f3ce1e4-398f-4cca-ad2d-f966a185c82e.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(362, 121, 'products/a3a3b5cd-2833-418c-9bf2-66c8e5638730.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(363, 121, 'products/a917f98d-3974-4e66-b22b-ea149f3e17bf.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(364, 122, 'products/2da78e15-3107-43c4-a966-01b8f163bb48.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(365, 122, 'products/b738af40-4cb9-4b6a-a461-a8cd62a83e6f.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(366, 122, 'products/c22e83d5-8b96-4fed-a2a0-5e71532de22b.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(367, 123, 'products/00cf761d-762e-464a-8a62-07263eba0170.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(368, 123, 'products/5be1d715-4fdf-43d6-aef3-d8981607226b.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(369, 123, 'products/f77fd749-1cc0-478b-86b0-2cb20766f9fa.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(370, 124, 'products/4a90fe17-5e53-45cc-9833-240c454b727e.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(371, 124, 'products/3f6c64fa-a1fc-4fe4-8858-f8428729d05c.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(372, 124, 'products/88640b6d-dfe9-4f36-8074-cfafeec69272.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(373, 125, 'products/b3562752-4143-4ad1-804c-b6e83a1e9255.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(374, 125, 'products/7466ce5a-d534-45d6-bac3-d1305c373b8a.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(375, 125, 'products/773b5a25-ccfb-43d5-9ccf-68743585388e.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(376, 126, 'products/c277be5b-a24e-4df8-9798-81db69dae10c.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(377, 126, 'products/9ae24e73-0536-457a-854f-58eb831d7add.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(378, 126, 'products/b780f62d-6838-4ad1-9237-dc03067d91de.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(379, 127, 'products/49aa0962-6ce9-48f4-9900-f57b2b05401c.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(380, 127, 'products/3bd8eff9-76b8-4b3e-8a4c-3867aedd3c3a.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(381, 127, 'products/49d11632-2270-43b6-bd25-db2bbb398143.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(382, 128, 'products/c57dd095-ac9b-4586-88e0-b3e5602cb2c7.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(383, 128, 'products/915feb5b-aaa8-48da-ad52-74d8f0cd629f.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(384, 128, 'products/76a47640-1b3e-4328-879e-83a3c2f8d1a6.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(385, 129, 'products/23654332-1636-455a-b204-37fd3e745986.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(386, 129, 'products/d5e19c5a-f737-4290-a618-ec898c6acc86.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(387, 129, 'products/7a10f317-fbbb-49c4-ad45-707d57d2ab12.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(388, 130, 'products/d4cd33e7-fb1f-43c3-b540-b946d856cb2f.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(389, 130, 'products/9caad6c1-8259-4736-96db-dfbdec971933.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(390, 130, 'products/09bde3c6-be32-440d-b608-cec26db4f03b.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(391, 131, 'products/4c6bdd00-0ee1-4295-8a0d-12d51de5fad3.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(392, 131, 'products/98efe1dd-c60f-4dc2-acc6-ee7821240f7c.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(393, 131, 'products/11d328f3-3770-4b79-92b8-8c33c493276e.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(394, 132, 'products/81a24b98-0786-4609-a8ff-4ac9b3b1ba45.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(395, 132, 'products/c804c8dd-bb3a-4319-adbf-76684812f221.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(396, 132, 'products/353b0f2b-4b53-42bd-8334-db050846015d.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(397, 133, 'products/47f44483-50d4-4ef2-b45d-241388cc4f73.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(398, 133, 'products/7e15134a-3ace-4db2-8fe5-6c5ad6a5065e.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(399, 133, 'products/211b18fd-35a4-4d05-b5b7-a6d7bbe02521.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(400, 134, 'products/d1d1c65c-10c9-49be-9a46-707fbe47b461.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(401, 134, 'products/c92e2a0a-629a-4d78-8ff8-b98b3a7566f0.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(402, 134, 'products/923fd7fa-4718-42ee-933a-4e3a78047ef8.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(403, 135, 'products/81d39027-2e1b-40f2-9672-03a12910ca18.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(404, 135, 'products/319631f1-1391-4ed1-97f9-8b4e00d3a96e.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(405, 135, 'products/7b02bd64-732a-46db-aeca-f0648256bd85.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(406, 136, 'products/459b432d-7c9d-4faa-a869-900abf7ca3a3.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(407, 136, 'products/66051170-61c0-4df2-baf5-87475ff4eb31.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(408, 136, 'products/8adb1a77-3be2-4227-933b-77cc9c67c8ff.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(409, 137, 'products/edfa952f-2e38-4841-9e3e-7b3f532c7d03.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(410, 137, 'products/a4979771-6c54-4f01-b7ea-361e97492f54.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(411, 137, 'products/76b7e53e-6d0b-482e-8f3c-850309e2eb3c.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(412, 138, 'products/b64dc839-c209-4286-97e7-d58c1858a948.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(413, 138, 'products/a6c250a6-e686-4820-9443-0fc0e164e1da.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(414, 138, 'products/9c54f548-4fae-463a-b491-cab01c61bd6b.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(415, 139, 'products/a03609f4-b200-437e-babe-b39018861718.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(416, 139, 'products/8ed45a30-04b3-45d0-802b-c16b9485bf32.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(417, 139, 'products/c8d06aaa-f329-422b-b9c4-70ca8d4cd007.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(418, 140, 'products/a9920aa2-6869-45ef-a729-353cc4c14483.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(419, 140, 'products/a6c6c6b8-6146-4ebd-8a4e-98f64b8ed96e.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(420, 140, 'products/b2a6ba13-8344-47f3-996b-b3cbdfb3ba62.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(421, 141, 'products/15d266fc-6718-4a0c-b844-4383ec9340af.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(422, 141, 'products/716ce85d-d9f6-4f29-9227-f664836806c4.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(423, 141, 'products/87171acf-01f4-44b5-8e6a-7a7b91cfd7c3.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(424, 142, 'products/d4f1472d-46dc-4085-bf31-4448f393aff6.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(425, 142, 'products/c8dda417-6f0c-488b-87b4-c2efeb187dd8.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(426, 142, 'products/de1ef6bb-adec-466e-aee4-04715accd8cc.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(427, 143, 'products/f76db6b1-46a6-4482-8618-84c3421b29a0.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(428, 143, 'products/dd98d561-c155-48af-8c2c-22218044398a.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(429, 143, 'products/e79d4ce0-8760-4871-b0b4-ccbb5ca76dd2.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(430, 144, 'products/7ded2ba3-3bda-4d1f-829e-d4ecb1c95f4d.jpg', 1, 1, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(431, 144, 'products/d85031c1-2473-470a-859c-b923087b1066.jpg', 1, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(432, 144, 'products/fe1a2119-3746-4a72-b657-4fd7c5ddd954.jpg', 2, 0, '2025-11-30 11:10:02', '2025-11-30 11:10:02'),
(433, 145, 'products/18f05002-3a1c-4dfe-8103-fae462e1d4a9.jpg', 1, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(434, 145, 'products/6164562e-f39c-4902-87a8-df0c46b7e382.jpg', 1, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(435, 145, 'products/0058aeab-b551-42ef-80eb-6748605faf77.jpg', 2, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(436, 146, 'products/b97da696-6171-410f-97d6-22a3fa55238d.jpg', 1, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(437, 146, 'products/36eda3fc-53e3-4fe4-9c4c-ca2fbaee0166.jpg', 1, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36');
INSERT INTO `product_images` (`id`, `product_id`, `path`, `position`, `is_primary`, `created_at`, `updated_at`) VALUES
(438, 146, 'products/8f283d3e-a3b4-46d5-9ff3-9874f85791d0.jpg', 2, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(439, 147, 'products/ff5f02a0-3c36-4d9c-b49a-f752ca85f9df.jpg', 1, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(440, 147, 'products/2567c20a-07ae-4cc5-a8ac-2597d4837672.jpg', 1, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(441, 147, 'products/e9cafaee-6cab-4e8e-8ecb-9ee398f2976e.jpg', 2, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(442, 148, 'products/17b9a86e-e62d-43fc-b460-934bde7d20f4.jpg', 1, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(443, 148, 'products/dbaa72a0-317f-481b-a968-432ba7a98db9.jpg', 1, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(444, 148, 'products/3cb8a038-61c2-4b06-9e71-6bb05eab2120.jpg', 2, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(445, 149, 'products/b450bb1f-b622-4e2f-afaa-4179ed60b5f0.jpg', 1, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(446, 149, 'products/d1ef026d-9d23-4374-aaa6-013ca181a15d.jpg', 1, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(447, 149, 'products/9564f3ce-928d-42de-9148-da60cc1a9c0f.jpg', 2, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(448, 150, 'products/0da028be-4488-4a32-94a4-9b5bfd48e63d.jpg', 1, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(449, 150, 'products/3654d6cc-5c45-406f-9fe2-90863b05fa0e.jpg', 1, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(450, 150, 'products/c1d48f90-c8d3-43dd-97e4-3e0e360f91d3.jpg', 2, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(451, 151, 'products/5c442bb1-0843-41a4-8a0e-7481eb4689b4.jpg', 1, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(452, 151, 'products/e61fb388-56fb-4199-81b5-e7810d362326.jpg', 1, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(453, 151, 'products/5cd591d8-4266-471c-8b2d-d995c904152a.jpg', 2, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(454, 152, 'products/ec919d6d-c977-4c8d-ae22-9754c08736df.jpg', 1, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(455, 152, 'products/f79e6624-3149-40f1-84fc-569a8581d63b.jpg', 1, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(456, 152, 'products/0179de79-7fec-430d-b36f-ce749c2ed5d2.jpg', 2, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(457, 153, 'products/53f21da5-a89b-4b63-a934-bcdcfc0ec156.jpg', 1, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(458, 153, 'products/8662343f-4bde-4103-b3d6-134c2dc170c2.jpg', 1, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(459, 153, 'products/bf7294c8-7184-432c-b579-f4210ed269bd.jpg', 2, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(460, 154, 'products/c21a4151-622f-4a00-b512-f1c72496d5a6.jpg', 1, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:37'),
(461, 154, 'products/f8544951-b323-4c90-85c3-fd754d123af0.jpg', 1, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(462, 154, 'products/882e86b7-f355-4800-98a3-538668b18b98.jpg', 2, 0, '2025-11-30 11:10:36', '2025-11-30 11:10:36'),
(463, 155, 'products/45577a83-3d58-4661-a6fa-2b41d41db467.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(464, 155, 'products/19124424-5d4d-4706-a5f7-41ee9e89f86a.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(465, 155, 'products/f159bb08-cb7d-48d4-8399-1c3f34bf95d1.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(466, 156, 'products/91c38ad3-3f15-4b12-8e38-aa79d3840e7b.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(467, 156, 'products/d3083971-6652-4eb7-9d6d-4aa16637eeae.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(468, 156, 'products/4e1ad09f-e99f-459a-95df-8e71eb0ea2f4.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(469, 157, 'products/4042aada-e514-4d7b-96f5-cff50d4394ba.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(470, 157, 'products/ce1ec30f-3477-4317-ae5e-8522d2c6dbba.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(471, 157, 'products/4efe1aae-fcb0-4075-8bce-742d770fc34d.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(472, 158, 'products/886db5f0-d9d3-485d-9e59-1b6369f94d72.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(473, 158, 'products/6c78a674-fbb4-4d54-9093-e1bfc30e6552.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(474, 158, 'products/bdecf100-edee-4f54-8924-c22001fe2868.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(475, 159, 'products/a5cd269e-fb5f-4666-a0f5-570cdf14e131.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(476, 159, 'products/03f9bb7d-3e51-4b18-987a-8f4d23ce1058.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(477, 159, 'products/69104588-7fd1-4cd1-bc2a-ea79813858d0.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(478, 160, 'products/a1ec0ffd-c9df-4dc4-9da3-ccf81db70d39.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(479, 160, 'products/04f9d843-3616-4fdd-a4a2-34953906bb08.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(480, 160, 'products/65bb9e33-bbba-4a17-88b8-0bcd6f223f5e.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(481, 161, 'products/e4d87bcd-683b-427f-b754-6491526a42f2.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(482, 161, 'products/69adbb66-811e-40a6-b6b2-11269ee1ca4c.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(483, 161, 'products/c05bb8a8-427b-4d79-bbd8-2498ceb71956.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(484, 162, 'products/b67137e2-8ee0-440c-867f-4d70c7503a8b.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(485, 162, 'products/7ad68a70-82f7-4532-b567-6f80ff9ae35a.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(486, 162, 'products/ee58a475-451c-46c3-957d-fa698f26ceab.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(487, 163, 'products/af978daf-9310-48a5-8a44-2955646e1f02.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(488, 163, 'products/626ac8b7-dd3f-428c-8913-c6f4e85b8c7f.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(489, 163, 'products/39212a66-cf4b-4b31-a429-ebefcf3e889c.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(490, 164, 'products/7f665bee-57ba-4706-a45f-b33412004ddd.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(491, 164, 'products/4a712b8d-4c80-444f-b708-736d7c4b2e12.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(492, 164, 'products/12e012d9-53b7-4a6e-adeb-580e0634cd8e.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(493, 165, 'products/7e2ba6ca-ac59-4048-ba82-c01d55dbdeb8.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(494, 165, 'products/d614425c-3526-4e09-878f-e6b0b7776eda.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(495, 165, 'products/1cba3603-65a7-4fc0-90db-e7ee29b267a3.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(496, 166, 'products/543f4fb4-d237-45a5-834b-dc1825838efd.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(497, 166, 'products/23c24f24-5124-4abb-a9a8-41c8d40ae482.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(498, 166, 'products/3c2cb49d-4532-49b0-a7f1-7e85d4cb49a6.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(499, 167, 'products/dd083e2b-9bef-4028-b319-ce413b963aa4.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(500, 167, 'products/ceb60756-9cbb-4ae5-9aef-ad8eca1fbf74.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(501, 167, 'products/3f6d86f0-56fe-4e91-b36f-2fa0e530a135.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(502, 168, 'products/f12d5ee0-3e1a-4158-9fb9-ab911af9c095.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(503, 168, 'products/06effaa4-f117-4ada-833f-a5fc7639dadc.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(504, 168, 'products/f3d06c77-e115-48ae-8873-e539f9476ec1.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(505, 169, 'products/ea0e9576-df07-4df0-a0c4-e62e8303798c.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(506, 169, 'products/1eb42074-0321-417f-a6fe-55221f607c85.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(507, 169, 'products/7d5d8398-be10-423d-9df1-0a36db9f9ccc.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(508, 170, 'products/368fed27-f8a6-485a-b390-e13151833635.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(509, 170, 'products/e0d978e0-a636-4c8d-8662-9f6365d8005d.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(510, 170, 'products/276e8214-e228-449a-a6b5-ec2ad1045688.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(511, 171, 'products/517cbace-998d-4ea3-8538-4c47919a1718.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(512, 171, 'products/eaad0712-c108-4a5a-be41-940fbdfca40f.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(513, 171, 'products/6429bd7a-fef3-4a59-90d4-228c208da1fc.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(514, 172, 'products/82306ede-f4f9-453b-a59f-7e33727dee88.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(515, 172, 'products/af817246-a10e-40cb-ba5b-45b5d78858e2.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(516, 172, 'products/6a13094e-ba7f-4f82-8656-af9f66807492.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(517, 173, 'products/643c1af2-87f4-41c7-8ff4-c0250d148265.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(518, 173, 'products/4acf2da4-1446-462c-a721-013d3cef3832.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(519, 173, 'products/3989f350-8754-401b-ab6d-6bb3c86312d7.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(520, 174, 'products/2fe0b388-a914-4494-ab06-3244b12e6808.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(521, 174, 'products/19ee257d-637c-46af-b27f-5ff298877d10.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(522, 174, 'products/87a426b9-833f-4076-8508-7c372a60b348.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(523, 175, 'products/29400b9f-3284-436d-9bb2-be272295301b.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(524, 175, 'products/d134a622-1648-4f39-b490-b2cc48da4830.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(525, 175, 'products/8817338d-45fd-41e1-8bd8-52922e160d7f.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(526, 176, 'products/c641480f-732a-4e48-abce-3ad1c31a236a.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(527, 176, 'products/720cf410-6715-41d4-b9fa-fe16314e3cde.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(528, 176, 'products/4cd50f03-4da2-4893-9346-6c0664b8a804.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(529, 177, 'products/abcaf9b7-9c45-409a-9bea-936d9418221d.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(530, 177, 'products/f5ac5c4a-77a1-43dd-ba2a-6704e70e36d0.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(531, 177, 'products/fa52a2a9-4565-4fd5-ae99-ef6d08681a97.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(532, 178, 'products/fe9f1af3-dea1-4af7-b1e5-4eee0fabccc2.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(533, 178, 'products/c5029052-c8bf-464f-b290-fb3f3d6d18d3.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(534, 178, 'products/d0366a5d-7d01-4135-ba64-cc187878686c.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(535, 179, 'products/dfb5de60-ffd7-416a-a831-7b714774488d.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(536, 179, 'products/7fe2d6fb-0bc3-4c8d-8af8-4bd7ec0c505a.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(537, 179, 'products/87405385-81e7-4265-a86b-3e93364c062e.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(538, 180, 'products/2ada241b-48af-43e5-a59e-3c6257b5d8ca.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(539, 180, 'products/8af87b6d-e162-4858-90f9-17853656a270.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(540, 180, 'products/1d3ec390-a766-47c1-96d0-b55c1e0870b7.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(541, 181, 'products/c14a017d-5034-4b44-9ccc-152e9f783d4a.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(542, 181, 'products/83d9e62f-2255-4f22-a003-02c0a60af0be.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(543, 181, 'products/fc929665-2ebc-49ac-b4ad-8c35d3799d30.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(544, 182, 'products/f4b0d20a-8c79-43de-9a65-837f306a7e93.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(545, 182, 'products/84c2847f-9204-496c-9319-ca09742124df.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(546, 182, 'products/650caddd-cd80-4784-9c1a-7bbf8f2d57b8.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(547, 183, 'products/a1573fe2-b07d-48c7-8422-bcc4fdf82bc2.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(548, 183, 'products/37d9fd17-87bc-4771-83dc-edbb10902c29.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(549, 183, 'products/3210ce69-6313-4d18-8306-1620691d342c.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(550, 184, 'products/231b69dd-9d5c-4d0f-93d2-b0753fd54c40.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(551, 184, 'products/7e907e2d-d747-42c9-abb5-c76ed871b281.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(552, 184, 'products/5a8ebbfb-5a92-43ba-9e7b-a041c08d062b.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(553, 185, 'products/3e940e72-58cc-46c4-9be9-bce877c40499.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(554, 185, 'products/134cf179-442f-4da1-9701-cb61d7830aeb.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(555, 185, 'products/cabf1d44-341d-4e5f-9a43-e4282e43def1.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(556, 186, 'products/7b2a9796-884a-4564-8963-188ec889874d.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(557, 186, 'products/cba96ef6-28f2-49ed-9557-85ea7070c577.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(558, 186, 'products/60ad7ca4-b81f-4195-b11a-bfad458d974d.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(559, 187, 'products/31e44126-d768-46f4-b7ac-2275fc169043.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(560, 187, 'products/3ca5e17f-7f3f-4e40-99cb-d4220f3e3630.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(561, 187, 'products/8fec9b31-bdfd-4584-af1b-c405ba539909.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(562, 188, 'products/bca59af0-b78b-4539-a5b8-0fdddbacdfca.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(563, 188, 'products/ba9a53c3-5fa0-4221-85d1-7869675fdba0.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(564, 188, 'products/73a8adab-f81a-4d17-9027-29076df897d8.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(565, 189, 'products/a0bf8441-5d09-4b20-aba6-fca306a587a0.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(566, 189, 'products/83d14ce0-fa56-4c36-a43a-bf8e7501c06e.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(567, 189, 'products/4ef374cc-f526-428f-9b94-343997be0acd.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(568, 190, 'products/2d216486-fd5d-47c3-8531-b4f798fc4bd1.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(569, 190, 'products/12d7c02c-bcdc-4b4c-8c31-867addc4471d.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(570, 190, 'products/25f29e32-d275-42d6-b3e4-1686e479108f.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(571, 191, 'products/b4e257e5-4171-45ed-899e-9d23100dbf69.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(572, 191, 'products/c901b27c-2f7d-4e95-a796-69dc664f1b4a.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(573, 191, 'products/77265d96-0ba1-4140-acbd-395454eec7e3.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(574, 192, 'products/9a780846-cbed-4650-b3ad-033c5d7325da.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(575, 192, 'products/63e91b47-3c87-4fdb-abf9-6a5c7190e1c2.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(576, 192, 'products/ddf6e371-5409-4294-92c4-fc6c6ba974e5.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(577, 193, 'products/efc87de4-b161-4b3f-b09f-477e0b48c435.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(578, 193, 'products/79a189b0-627d-4e78-9b2a-d7e0b19784d8.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(579, 193, 'products/1ad91f92-097f-449a-908a-775ebd380b78.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(580, 194, 'products/4ebbcfae-9dbe-47d4-8222-90d573b9d3a1.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(581, 194, 'products/562a8800-72ee-4c33-99cb-0bc59df26cd8.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(582, 194, 'products/4dee72f4-bd0b-4ea9-9025-fdb4b219c0cc.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(583, 195, 'products/f71873ba-55d6-4d4f-9dd0-76956953de58.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(584, 195, 'products/cc49df84-f8e6-4174-992f-0a18fc766b46.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(585, 195, 'products/5d127f42-50da-4e0e-8926-954bddb69a3d.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(586, 196, 'products/73f86c33-d4e4-4c2a-8e2a-e9237dc7bb95.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(587, 196, 'products/9bb8828b-e9b4-42c4-b6ff-ffca3efb38a3.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(588, 196, 'products/005d1915-fbb3-44e7-ae39-dfe718571958.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(589, 197, 'products/58d8ee42-910b-4d04-924e-3f40c621376f.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(590, 197, 'products/94791ea7-7da1-49ec-8ec6-efb556c3f65e.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(591, 197, 'products/8b90f2a4-fc52-4aa6-8166-c149e1f2bdf1.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(592, 198, 'products/c06786c4-48ca-472d-954a-800d285f8936.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(593, 198, 'products/645ee23d-eea7-4094-94f6-d1209ca7cb08.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(594, 198, 'products/deec7481-e05c-4af2-8465-e4bc3ac8de33.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(595, 199, 'products/b8aad532-7ae6-46cc-9bed-6967d1796dba.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(596, 199, 'products/588a4cdc-d3eb-4b2a-bc7f-be3bd50f5249.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(597, 199, 'products/d6d08669-b8d0-447a-822a-5a249c61c541.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(598, 200, 'products/844deda3-cf06-4938-8c02-e661d27e8b80.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(599, 200, 'products/c4935b53-f1f1-468d-b7ed-21eb1fad0780.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(600, 200, 'products/7f8b8b5c-6fba-454a-8eb3-01de2abfe3ea.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(601, 201, 'products/f1dbf9f0-c0f4-4cd1-bce6-2fb3e0ef45c5.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(602, 201, 'products/5d9833e9-18c5-4392-8937-edacac96098d.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(603, 201, 'products/692ad649-4ffb-4eaa-bebf-8cabdad335d6.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(604, 202, 'products/d338411a-9308-4b66-b695-7649b0e8aa18.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(605, 202, 'products/c53972ea-82b9-49d3-aa56-ae861ffde013.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(606, 202, 'products/ae2e72fe-6146-40db-9361-772fece56c28.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(607, 203, 'products/6da3f236-fbdb-45fa-b9df-cebc86f13a17.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(608, 203, 'products/f93b0428-3f7f-49c2-ae39-38033876770d.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(609, 203, 'products/9c3ccae0-1dbd-456e-a226-5593644c9b9c.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(610, 204, 'products/6df1f00d-de80-4054-b987-fb95d5bf6f32.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(611, 204, 'products/948eab7f-e1ff-4ba7-b8de-2b3d8c4ff23c.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(612, 204, 'products/b7a63e75-722e-42e5-bc45-f22e187c0929.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(613, 205, 'products/c4fa9c9b-b713-4971-869d-96c32e72226f.jpg', 1, 1, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(614, 205, 'products/5f964e83-80a1-403e-bdf8-c76d6bc670fc.jpg', 1, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(615, 205, 'products/20240b01-6937-4ac3-a3a9-fde283c3c249.jpg', 2, 0, '2025-11-30 11:10:37', '2025-11-30 11:10:37'),
(616, 206, 'products/2309e636-db3f-4b4d-a6d0-13166f457bd2.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(617, 206, 'products/4afd3ad1-4524-466d-8fb6-724eb3b9590e.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(618, 206, 'products/418beae5-b99b-42e4-8434-82660c4581db.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(619, 207, 'products/ec077749-dcb9-434b-8e77-1bb99ef07f10.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(620, 207, 'products/adbd7b35-d819-4ad9-9716-79d0255d44ff.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(621, 207, 'products/73ecf451-33c4-4440-93a9-c6d869f3b7cb.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(622, 208, 'products/3291e37f-e28e-4597-9151-78185fed0ad2.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(623, 208, 'products/4312fcfc-d356-4507-84d7-8e68b7988880.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(624, 208, 'products/5c2915bf-9147-4c6e-b1cf-b2f21758b918.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(625, 209, 'products/b1e9f536-f0e5-44ed-8afc-1bba999e7da2.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(626, 209, 'products/1f95b258-edd3-431b-a58b-da7a7a798664.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(627, 209, 'products/7bd91751-19e1-493c-924b-7d16a10d28d3.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(628, 210, 'products/b0078753-e05d-4f64-9f9c-7137946d1dba.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(629, 210, 'products/0905682d-d3c2-4d96-9c59-c5ec85386a90.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(630, 210, 'products/e30a98b0-4423-48cb-ba8a-8f0f0f8a11e8.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(631, 211, 'products/ab4c6ffc-9117-4050-bd58-f719baed924f.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(632, 211, 'products/8d6924ae-0e7c-44f9-a459-11ceabe868b2.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(633, 211, 'products/3a4a2e66-c219-4935-9a1c-9e58fea19490.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(634, 212, 'products/91aa6978-c989-4e31-9575-8dc9f5ec43e8.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(635, 212, 'products/bfe975e4-11fd-47c0-abc6-fe2b2b7dfd73.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(636, 212, 'products/21404a1a-3a4b-460f-a021-468eaed7c2b0.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(637, 213, 'products/560f8a72-ab38-400e-8a34-2d388b316ba7.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(638, 213, 'products/d5e25472-69fb-4056-8eba-c3daac88be9b.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(639, 213, 'products/c7d43411-974a-430d-8312-9a71c26ca984.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(640, 214, 'products/615c8c19-7729-44f7-b545-5ad563eb5afe.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(641, 214, 'products/67f95e18-99aa-4fc6-9162-80d8d971fa53.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(642, 214, 'products/0132e918-9de0-4bcc-86ea-616c3d9f9eb8.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(643, 215, 'products/05d0b8dd-bb48-4c64-99c7-42be1629fbf3.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(644, 215, 'products/9d4ce1a5-3668-4287-9a1d-2fb9adfeed4f.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(645, 215, 'products/ce7b0ac5-4e07-4ead-82da-68b81271a498.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(646, 216, 'products/42d1b429-4ba9-42d4-90d3-357ab43212d8.jpg', 1, 1, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(647, 216, 'products/9f92024b-bba1-4e2c-93f8-4988b8dc1780.jpg', 1, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(648, 216, 'products/bfd68700-a858-4933-9931-7f42de0114a2.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38'),
(649, 217, 'products/ebad949c-5dcc-4289-a7ec-fe39c059752e.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(650, 217, 'products/e037afaf-d74b-4a96-9efa-d0d188c193e5.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(651, 217, 'products/de7d4dc4-60ee-4b1b-8c0b-327b2b9cbdca.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(652, 218, 'products/e84d101e-9962-431d-8582-3debc40ae75b.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(653, 218, 'products/009f5ec5-1c30-4783-a53e-ec4706cc2a88.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(654, 218, 'products/2169ff90-d245-49cb-bd68-d79377954318.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(655, 219, 'products/2c644585-8f0a-40c8-82d6-7365f92b8ac5.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(656, 219, 'products/43512545-a5b0-4c00-9e08-5eb847e88c4d.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(657, 219, 'products/760080df-89c2-4397-a916-9ca805f76ca0.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(658, 220, 'products/3a029f96-ae7f-401a-8d0a-8d3bde6005f7.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(659, 220, 'products/f7d1ac7e-36a7-489a-ba8c-14aa0eb59c2d.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(660, 220, 'products/ae9b67fb-9926-4cc5-b34c-08426119e728.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(661, 221, 'products/e5f5c681-fe9a-4a2e-b480-37dee66d6b40.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(662, 221, 'products/9e132203-0c80-4022-b5fd-04410333047f.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(663, 221, 'products/c8cef629-8404-4e59-9203-11333ab4301c.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(664, 222, 'products/1104e3ef-b6ce-47d1-8493-9657bd73915c.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(665, 222, 'products/8718385c-bd3d-4a3f-a3dc-4f82c1e7dc76.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(666, 222, 'products/79905264-b1ff-47da-a18a-cdc812741ba7.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(667, 223, 'products/fb845b23-868e-4bb8-b45e-117e8b81a161.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(668, 223, 'products/38412e27-983c-4397-8bed-f40630953561.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(669, 223, 'products/4ab9cc44-7f64-462a-8d39-705193639261.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(670, 224, 'products/2d8e62f6-70f8-4c68-a98b-a2617cc9a5b3.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(671, 224, 'products/3f74e2e4-fd3d-473f-83db-0f00da019e3a.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(672, 224, 'products/335a3ced-34ce-4be1-b037-510504f7bd04.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(673, 225, 'products/80ad7458-da7f-464b-b7f1-0901f4e62311.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(674, 225, 'products/235b6bed-36c8-4e2e-ba0b-be41f97e3922.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(675, 225, 'products/06c32305-e8be-4f2d-ac2f-71f25577aba7.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(676, 226, 'products/f2145079-77de-4b43-9893-40d8f566ab1d.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(677, 226, 'products/a36d5d27-c50e-4020-aa35-bd940dbda626.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(678, 226, 'products/5a57f114-43ba-4b9a-a771-e90b052b3aef.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(679, 227, 'products/8af3d531-7b93-4a82-8b18-060e6c16d6eb.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(680, 227, 'products/72168f48-2571-45a6-97cd-5f7153ff96bb.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(681, 227, 'products/d7e4dbbf-e755-45f6-8662-39498506d2d7.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(682, 228, 'products/e182e8eb-c0cb-4d8e-b849-9b3302d92ab0.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(683, 228, 'products/8f584332-afdb-4369-97c6-b0153563b935.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(684, 228, 'products/be26265a-201f-4419-934e-381336ab339d.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(685, 229, 'products/19f368e8-7d9a-4424-86eb-64ca46c03501.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(686, 229, 'products/ebf56f84-b356-4115-94a3-143aab8303f0.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(687, 229, 'products/4d73a13a-c212-404e-8e92-813ad9044090.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(688, 230, 'products/2a12b69d-6a3e-40d8-b253-c07ef9825974.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(689, 230, 'products/275d35e6-82aa-4942-86fa-cb16fa358f59.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(690, 230, 'products/7c0699ea-6071-40b3-851d-4079be6353fe.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(691, 231, 'products/e6de364e-bd8b-4884-849d-2bdcdc41075b.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(692, 231, 'products/34188875-3fca-4bd8-83ab-a85ad127c491.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(693, 231, 'products/177ea39e-bf92-40a1-b16a-4bbee292a909.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(694, 232, 'products/4c0b778b-8dc1-42d3-ae2b-a5b61cef313c.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(695, 232, 'products/921f591a-1837-4b97-9ec4-8de398024b13.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(696, 232, 'products/704b5cec-0d54-4f31-9be2-befa7cb0b48f.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(697, 233, 'products/acf814a0-57f5-43bb-9ab7-b6d16bf231ca.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(698, 233, 'products/ddb52523-62d1-49a9-8e82-678416b1a52c.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(699, 233, 'products/8789e9d1-1c49-4bc4-a1a4-b3edcc2bfc47.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(700, 234, 'products/61d60e57-32d2-4dfd-9647-a4e42cd6ff59.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(701, 234, 'products/da9e90ad-9196-42b9-8cdd-4a856652b443.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(702, 234, 'products/0723e852-59cc-4f3c-8c8b-ae90a02791d6.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(703, 235, 'products/81b53788-0814-405d-a9e6-00c1dcf6f8fc.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(704, 235, 'products/aedfb694-58a3-4813-919a-41677236f6ca.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(705, 235, 'products/27a96c08-f7d0-455e-9b6b-5db8cd16f85b.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(706, 236, 'products/f40ee954-0ef8-4323-aa7b-699797e0aa95.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(707, 236, 'products/29a7f20c-160b-41bc-b23c-87378fc1f709.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(708, 236, 'products/d4091b41-fd0b-4f83-b75d-efbcbbf6b139.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(709, 237, 'products/24cc34e3-033a-47fb-9ba8-2901ac2a47be.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(710, 237, 'products/f2e9637a-57c5-4186-87d0-588ed32385b6.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(711, 237, 'products/212d1e54-e11b-44c1-b5c5-9bd85d4c266d.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(712, 238, 'products/8a640a34-5f13-4395-9d67-a22f8f1ce7b1.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(713, 238, 'products/f00f6362-6554-4336-984d-066e20558504.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(714, 238, 'products/85eb42cc-af34-41ae-899e-1e249398c8a2.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(715, 239, 'products/2e65f9c5-b5d5-4f7d-8bea-904900ade27b.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(716, 239, 'products/c5c8f8fd-e92c-41c4-a585-f75041ae7d54.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(717, 239, 'products/c4e214d6-f62f-4243-bdbe-bc900b3c63f0.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(718, 240, 'products/39e5cce6-4101-4f82-9695-a0c41654414a.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(719, 240, 'products/5bf18a59-f964-4db5-b8fb-5c36723e2f54.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(720, 240, 'products/b190674a-8315-4933-bdc1-8579f705f673.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(721, 241, 'products/e27001c7-a654-4638-a0c7-48c965f84738.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(722, 241, 'products/2053a46b-58f3-4a2c-a6f5-d6e3c1846d5a.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(723, 241, 'products/1fd123f8-d9d0-4754-86eb-7942f3bfad7e.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(724, 242, 'products/97634962-8b6f-4d15-8446-cd3d100083f8.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(725, 242, 'products/b1a9e639-271b-467b-9a74-08a73d62e2d1.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(726, 242, 'products/095457cb-348c-435d-a416-6767136f97f4.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(727, 243, 'products/c31c69cc-b389-44af-ba14-3e10645dc08e.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(728, 243, 'products/bde44b79-9c01-4ecb-b77e-d5dd7e2a99cb.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(729, 243, 'products/2e18dd36-4479-4693-8b2d-e430a50355d6.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(730, 244, 'products/777c46b2-a87d-43e6-a2e6-85b4940e3e13.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(731, 244, 'products/e7d34af8-b0b2-4f02-a25b-737f30ad3ab8.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(732, 244, 'products/a2249e13-5f5d-4166-b1c4-ac225646cbea.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(733, 245, 'products/c53d2204-c1cd-4adc-aca0-72ceef2a9ab5.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(734, 245, 'products/3853d423-4f76-4454-8900-d8fb711cf0fc.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(735, 245, 'products/142c79c5-5e64-43d7-97bc-9c6d843cb738.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(736, 246, 'products/e65811b3-0a9b-486b-8e40-f89fb16afe9d.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(737, 246, 'products/3c3d6b93-4bc3-4229-8551-7599f554cd55.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(738, 246, 'products/29585688-5398-459b-869e-971d6bef3160.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(739, 247, 'products/7cddce96-7c39-4f97-86e6-b61936a19776.jpg', 1, 1, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(740, 247, 'products/df3dd43b-fc5a-44f7-8751-0e86fe0af7af.jpg', 1, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(741, 247, 'products/585a3445-eefa-4b6b-955e-7a7e3e6e7e8d.jpg', 2, 0, '2025-11-30 11:38:13', '2025-11-30 11:38:13'),
(742, 248, 'products/75f4c360-c627-4d4f-b425-4fe7c07f6e80.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(743, 248, 'products/74d50ce4-c4ba-4d79-8988-acfa84c2d037.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(744, 248, 'products/e7a746db-3a39-4f3d-84df-1d366b444dde.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(745, 249, 'products/ee9eb5ca-e03f-40ae-a5db-9d5b896121d5.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(746, 249, 'products/ebe2755c-e6a0-4859-b78e-7e87a4a622f4.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(747, 249, 'products/30394bc0-8edd-4faf-a4c6-90e7acc56a09.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(748, 250, 'products/c496fe3b-9e86-434c-9137-1035a2aa55bc.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(749, 250, 'products/cdd6d2cd-3e57-4f50-a2a9-48f44ce3e4c0.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(750, 250, 'products/7fce48cd-2030-460c-a92f-e84c8e1e5d7a.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(751, 251, 'products/da380a6d-7a32-4dd5-8206-62287a9faaa3.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(752, 251, 'products/faa49b77-3bb0-4a01-9ab8-ac984796a04a.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(753, 251, 'products/1cd92bec-6fdb-4cd9-b96a-776fa3b33058.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(754, 252, 'products/e96aaac7-885a-446f-9ade-4a924abee28f.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(755, 252, 'products/de68fe38-56a6-4b0b-bd9f-7cd5ac111d41.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(756, 252, 'products/7851568c-e4da-4124-9b6c-9b7a9d506f05.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(757, 253, 'products/975bfa7d-5fa6-4501-98e8-9965d2ff4a82.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(758, 253, 'products/bc6ec044-ccf4-4145-8357-be28a05630c2.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(759, 253, 'products/fda159dc-e5b7-4c5f-a3dd-2c17d778f77e.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(760, 254, 'products/9511cb1a-05ad-4ffb-a0df-01120df1bf81.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(761, 254, 'products/66f8f392-44c6-475f-9a1e-fa363dbc1a17.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(762, 254, 'products/469e094e-a438-4134-9029-954479828202.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(763, 255, 'products/2583de8d-7369-43de-b696-600f6d3d83d1.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(764, 255, 'products/fda4f2df-5d68-4ee4-9d87-d02d52016f8f.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(765, 255, 'products/1d5f0693-3833-47c4-a774-82f2a04e5259.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(766, 256, 'products/eaf6375c-9365-433d-8a60-3584603880a9.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(767, 256, 'products/582090ad-26ab-4f80-aaa0-fe1ed2e54b26.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(768, 256, 'products/fdf8b84f-be04-4e14-8979-02c74c560013.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(769, 257, 'products/305f0d1b-05fe-429c-be77-78a2baf0bea4.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(770, 257, 'products/2cd50d85-fb41-47ad-940b-c7c07bdf71aa.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(771, 257, 'products/2747ba10-b1b2-4791-a5a8-265f65c5ec83.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(772, 258, 'products/f823a793-91ea-40ca-a887-f1e1ea02cbdb.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(773, 258, 'products/7ed0f8e4-ec69-450c-8c45-8ae580da00b9.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(774, 258, 'products/18b24bf3-b384-45bc-be79-0eaaa8fd1279.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(775, 259, 'products/a4fd8a2d-ca5a-4ebd-839e-8889fe5bcee1.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(776, 259, 'products/4415108a-cc49-478d-8823-9a7370dac485.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(777, 259, 'products/1d4a1789-5ff8-4447-b231-4c13d0f808fd.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(778, 260, 'products/4124b3c9-cfde-459f-9df6-c7a409976a66.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(779, 260, 'products/273ccb71-b996-44d0-b36d-6c2aa6abf4f2.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(780, 260, 'products/47493fc4-3d99-471f-a6f8-5ef2e70aad2f.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(781, 261, 'products/eea18317-716a-467e-82e0-1d99a17b9414.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(782, 261, 'products/d955fe47-d5f8-467f-b9d0-4bd97f2e6483.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(783, 261, 'products/54152e2b-2dfe-4779-bd42-0e39f3e7d8d9.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(784, 262, 'products/a980d932-53d8-48d5-8015-8a81b73648a3.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(785, 262, 'products/205732cb-f8ca-413d-a6dc-8ffd9ab50fef.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(786, 262, 'products/70c97c5e-1495-4e39-9ace-dccf3cddc18e.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(787, 263, 'products/637c7c3f-9ff7-450d-a3b2-c725443cc792.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(788, 263, 'products/59ad274b-6ac9-4919-bc93-eb202ba5bf47.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(789, 263, 'products/9fb82f9a-e083-4d82-979c-b26e68eb3a0a.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(790, 264, 'products/d66017c6-ee7a-43ef-a262-61d430f4bba0.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(791, 264, 'products/61815cd5-5877-4468-b47e-e9c76d5cfaec.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(792, 264, 'products/846d0d6d-c5e9-420a-b8b6-745af6ece5d2.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(793, 265, 'products/b578cf05-0042-4fe0-9311-fb206eae900f.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(794, 265, 'products/8079891d-336c-457d-a2fb-2bb5751783ba.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(795, 265, 'products/91802e0d-597a-4236-841d-a06649cbbf95.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(796, 266, 'products/ff3271b2-c58c-4f6b-8f22-828c545ac89d.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(797, 266, 'products/bc1891f7-455b-454d-a694-8c238e78ad3a.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(798, 266, 'products/d6f77d8d-cc9c-4dad-9f42-dbf83bae4582.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(799, 267, 'products/bac51ecf-6906-4783-aa98-f135594b3a9c.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(800, 267, 'products/f09d8dfa-b11b-4dfd-8974-0f82e64f2a2a.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(801, 267, 'products/275cbd8a-179c-4531-af91-ff0d2bdc1b04.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(802, 268, 'products/e9e0a690-d3b5-4886-946c-de7c7cb3b427.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(803, 268, 'products/583763f7-f6d5-41c7-bfd2-b7212dec9d64.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(804, 268, 'products/234c317d-b769-474a-9879-67a46e26a16c.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(805, 269, 'products/23af6de8-f0ca-4018-aa63-2e12d14e36df.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(806, 269, 'products/827842f4-bcdf-4d2e-813f-cea07cc73489.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(807, 269, 'products/96e8dfc2-0dd2-4b25-8919-c0b6b34aaa34.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(808, 270, 'products/3ab2fc30-96df-4761-8500-5b35d96f58db.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(809, 270, 'products/60163e50-798a-4d2a-a283-d56b28e900d3.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(810, 270, 'products/483fa7a0-c1c4-453d-bc41-d4ccf1b31d72.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(811, 271, 'products/04aab500-af67-44d4-a796-f8b4929905e4.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(812, 271, 'products/ab60d382-51ca-4975-b8cd-379cc68368ec.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(813, 271, 'products/ae9df804-90bc-4cfc-b604-33b15960a8b8.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(814, 272, 'products/57448789-eea3-4052-b2e3-a1d139ca2c89.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(815, 272, 'products/5837fa2d-ed8e-4cc4-b3d7-111101b69aea.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(816, 272, 'products/26c475ee-a776-472b-aceb-7cfd331fcba3.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(817, 273, 'products/5ea80d2d-4f4c-46b5-a755-0a5e77903856.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(818, 273, 'products/4c891337-8da8-42e7-8a93-20d0770d0137.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(819, 273, 'products/6ac525ea-e1db-4acc-86d2-3e622584693e.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(820, 274, 'products/0fc0ceb8-a09e-42a7-893a-e21c242fe1b2.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(821, 274, 'products/108cb29f-a1aa-4e56-89e8-fb7f0ac6fe55.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(822, 274, 'products/2bd2fe8c-1453-4c5e-9f24-e9e9afa9a157.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(823, 275, 'products/1a377035-766e-48b7-b185-4de92ef046f3.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(824, 275, 'products/98698c0b-d158-4c52-bcd0-bf177888d7cb.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(825, 275, 'products/527abb17-499b-4758-baa3-8c3267d4abca.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(826, 276, 'products/53425bfc-4f7d-45c9-9552-cf047b79a1d5.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(827, 276, 'products/becfcda1-a025-4374-9d55-2c0bd1ffca95.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(828, 276, 'products/14ef5eee-6c2a-433c-828f-d3f6deec698a.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(829, 277, 'products/0566577e-7ea2-4e8a-9322-6b6c2b1b7bdc.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(830, 277, 'products/e3d7b575-b601-474c-b1b8-687e2e674b9a.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(831, 277, 'products/43ef1459-99fc-40a6-adc0-0e4dee1ed4fd.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(832, 278, 'products/ce576e33-e40f-4a31-9759-c58757929d8c.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(833, 278, 'products/c319ac94-f7f5-48b0-b7fe-557ab177fa9e.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(834, 278, 'products/25c7f801-e14c-4392-8c43-ee8dac1bb940.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(835, 279, 'products/019cb659-02da-403d-94e2-b13007885b53.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(836, 279, 'products/df71c6ad-7f6a-42c4-8054-c07943374693.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(837, 279, 'products/2660d469-5e5f-4598-8f89-7c7427e3149d.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(838, 280, 'products/e71dbc15-9789-47a9-9967-2efbec0f9f20.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(839, 280, 'products/6b8588e2-6da6-4f34-a2fe-9a8a74212994.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(840, 280, 'products/64b90bc9-4694-4265-b311-0d35f6fcdf8e.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(841, 281, 'products/4ec12e71-cea9-403a-87c9-33433b5d3b4f.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(842, 281, 'products/e27a2a2f-60ab-48bc-a37f-c4b34dff93cf.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(843, 281, 'products/fd265004-9684-445b-8b5f-58952d7d85ab.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(844, 282, 'products/fe002907-38f4-4da7-ad8e-990c9516dab2.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(845, 282, 'products/52492818-19b3-4464-92a7-476c18fde5f5.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(846, 282, 'products/5ef2dc3c-0df3-4f39-9e1a-20175f2cf361.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(847, 283, 'products/de4474c9-3071-41d6-85dc-44e1f87ba298.jpg', 1, 1, '2025-11-30 11:38:14', '2025-12-19 15:20:30'),
(848, 283, 'products/75dd8ca0-20f0-4e01-a41c-10449a682f23.jpg', 2, 0, '2025-11-30 11:38:14', '2025-12-19 15:20:30'),
(849, 283, 'products/43cc3f02-19ac-4a9d-98c0-3f05bf9a8ef8.jpg', 3, 0, '2025-11-30 11:38:14', '2025-12-19 15:20:30'),
(850, 284, 'products/180667e6-b758-4e0e-8dfc-f5bd7e8e18b9.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(851, 284, 'products/b9cf23ae-f817-400e-96fb-ee213379fd91.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(852, 284, 'products/f3f2a09a-4079-4753-b812-06cfea6fd86f.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(853, 285, 'products/aecaeb57-a3b4-4fd7-ba8a-7866ac8cb677.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(854, 285, 'products/0fbe606b-8936-424f-8b5b-60d14eb0da1c.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(855, 285, 'products/b3996324-8394-4362-a745-94df7d9dda09.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(856, 286, 'products/444d400f-e4ae-4414-abf8-edfaf61cdad3.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(857, 286, 'products/cc294c41-02a3-4814-b094-55874a586357.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(858, 286, 'products/1509accd-5416-4114-b890-cbf378e91038.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(859, 287, 'products/3470a6dc-2e2c-4174-89ea-d08e4d381115.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(860, 287, 'products/083bd599-7c7b-46a0-b55d-1f4d43158b76.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(861, 287, 'products/3c41452b-8bfb-4041-9e51-3eb22de216c6.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(862, 288, 'products/8a64649c-4c3e-4d48-b6b1-96dca255abed.jpg', 1, 1, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(863, 288, 'products/d75e686a-dfed-4d28-8d0f-3e9e0c8d3c88.jpg', 1, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(864, 288, 'products/9899744f-5d0a-4968-8c72-f24bdc01f94e.jpg', 2, 0, '2025-11-30 11:38:14', '2025-11-30 11:38:14'),
(865, 289, 'products/0d1bc844-81b7-4220-b11b-38e641e0f0d5.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(866, 289, 'products/674ad071-63d3-4249-8b59-13b4a9da1683.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(867, 289, 'products/999c6520-ec3d-42d0-887f-f8540b827a45.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(868, 290, 'products/f1d88b5b-a989-482a-9d7c-a8eb011c3a76.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(869, 290, 'products/a1a394ce-84e2-4a11-989e-d206d05b2205.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(870, 290, 'products/25ce7734-6d57-436c-8915-8ef35d95be37.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42');
INSERT INTO `product_images` (`id`, `product_id`, `path`, `position`, `is_primary`, `created_at`, `updated_at`) VALUES
(871, 291, 'products/6df0b0f0-945c-40be-b155-75590790e514.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(872, 291, 'products/cb4a038f-04b4-4b92-a1ed-51540ea44fed.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(873, 291, 'products/65f70b64-da80-464f-9b98-e0375d22db10.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(874, 292, 'products/33619615-426e-4b10-ae42-e471d850b402.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(875, 292, 'products/bbf27980-07f0-4686-a646-3aa756059d0b.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(876, 292, 'products/87554535-6e7e-4ef3-8e33-3e706f865007.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(877, 293, 'products/498f708a-1319-4e85-866a-9718721709c2.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(878, 293, 'products/c15be339-c6c2-4633-9b76-4ba82c76075f.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(879, 293, 'products/0658d931-fdb2-42be-9cdd-6b3c576bb2ec.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(880, 294, 'products/7f89ae62-4ef6-4c0f-b9fd-f33d379cfa22.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(881, 294, 'products/bf0a5e2a-f44a-4c48-b76e-87c5f997c3ea.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(882, 294, 'products/ac6fe0bc-2a58-48b0-8a64-99a9e7b43128.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(883, 295, 'products/e915bbdc-2d37-402d-bfce-13c2f4bbfb74.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(884, 295, 'products/c0b00ab7-b776-4a4c-9a0a-e984822b1841.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(885, 295, 'products/c2e770e0-b78f-4e38-b264-f709aec59247.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(886, 296, 'products/b9eb88b6-af1d-4000-a329-7432ef54540a.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(887, 296, 'products/ebb61082-dcc6-4e45-81c6-25b8eece2142.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(888, 296, 'products/75e8c5f4-0d68-4015-8912-6a8f86a2340f.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(889, 297, 'products/bd3fa1fd-668c-4be8-ad69-c38f5a2783e6.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(890, 297, 'products/3e9903b6-f575-419a-b5de-008af8b3302b.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(891, 297, 'products/b9aa9d58-36a6-4744-91c4-019a6cd69fdb.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(892, 298, 'products/8d0c0a2d-33f4-490c-ba87-7f3c72d60033.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(893, 298, 'products/213010d1-238e-4eac-ade6-dc5a0ee0667a.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(894, 298, 'products/b16c0a4f-483a-482f-b68e-f0a600a3d37c.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(895, 299, 'products/b7a9464f-f4cc-46e5-a3de-bf353c7732db.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(896, 299, 'products/d88a8e6e-d450-46a8-8a99-5f1051a3fa49.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(897, 299, 'products/a2cbfa76-1cf9-4e60-ab36-74a6422419ac.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(898, 300, 'products/e3aa8c7a-8017-47cd-ac30-eca290f7892a.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(899, 300, 'products/6946a926-9d43-4e49-bc49-aa1ce7be0fea.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(900, 300, 'products/d181cbaf-fcb6-4e81-a981-88b7a9eed9c3.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(901, 301, 'products/8b4ee569-2fe5-4db3-83c6-f5ec991c31c6.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(902, 301, 'products/92a684e3-e996-47a6-ad41-623521a8a821.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(903, 301, 'products/cdbd4528-a078-4c88-9b4b-7e7f2f700e18.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(904, 302, 'products/41440de1-62bf-4985-af09-74978ec8b0b4.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(905, 302, 'products/6d12a10a-f3dd-491e-bb71-195905669471.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(906, 302, 'products/5fe70750-5b13-447e-ba09-3c7a032c599b.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(907, 303, 'products/9e82cba1-0c63-4a5d-ae39-87d606c0a3f0.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(908, 303, 'products/9785f09c-7e6d-4f1d-a4e7-acc7a76d2ea6.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(909, 303, 'products/7055e475-8adf-4279-bf82-6fbdf6b6c7c0.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(910, 304, 'products/deb63a3b-b21e-47f1-8eaf-46045a44f020.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(911, 304, 'products/ccabe074-d812-4fe0-af72-8784f4d5d893.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(912, 304, 'products/58347336-98c0-4ad0-af10-8c681aa76ddb.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(913, 305, 'products/45adbec1-41c0-4165-8aec-227253377bb5.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(914, 305, 'products/dd78569b-4c99-4dbb-bf70-e38db41de236.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(915, 305, 'products/4930faf9-7b96-4a17-8949-07dddaef0bcc.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(916, 306, 'products/c481c311-7a1a-402c-939b-169eca3a5408.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(917, 306, 'products/f31a7faf-6555-4f7b-ad2b-503090184eae.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(918, 306, 'products/bb0415d9-5aa7-448a-9436-92fa92d4517f.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(919, 307, 'products/127cced4-e894-4ba6-93da-7d9a97e2bc27.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(920, 307, 'products/c1e6d234-9dfb-46af-92ab-f5aebf5630a2.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(921, 307, 'products/2368e872-eae5-48f1-a4e2-51e2aa488938.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(922, 308, 'products/50754d97-ac2d-4a5b-8394-d06430b7adef.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(923, 308, 'products/33c97770-0e6d-444d-8737-7758bfcff141.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(924, 308, 'products/fd569ea8-3f4f-4760-9e29-6956b8e997c3.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(925, 309, 'products/0ca0c6ab-01ce-4828-bfb4-89565596757a.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(926, 309, 'products/d2a95045-33ab-4c00-aff8-18372e12bed5.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(927, 309, 'products/f3acd241-89bb-475a-a2c9-7c621bb2d33c.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(928, 310, 'products/3abf50a4-f1a8-4d03-8673-e78b01124465.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(929, 310, 'products/9da0cebe-a8a8-4a42-9e14-a2118587c393.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(930, 310, 'products/876249c2-e3bf-4298-a843-3604e51ed3d5.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(931, 311, 'products/b99c94b2-64c5-4fe7-8624-8e78e43f0f04.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(932, 311, 'products/7fd948f8-e782-4703-8a03-6691b392c13e.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(933, 311, 'products/4762ddd3-1f03-4a41-a765-6db9f2d21265.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(934, 312, 'products/275104f5-a7eb-456f-b3da-225cdb2a69cd.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(935, 312, 'products/d548dd0f-da4f-4267-b26c-89bf91a6da81.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(936, 312, 'products/2dd66893-dd68-478d-b716-57ae0edcbd7a.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(937, 313, 'products/532767cb-0a66-4195-9f1c-b6239aac180c.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(938, 313, 'products/0a2c1f01-286d-4ae7-b242-db139a8d3d3d.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(939, 313, 'products/a6b7d1c2-ddef-4904-bdce-b3fbc0a711d0.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(940, 314, 'products/28cee68e-f5a9-45e9-a024-be6d9fb441b4.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(941, 314, 'products/19463286-e7a1-4e89-abd2-25015a7a2f76.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(942, 314, 'products/6360197f-2d7c-40df-9937-25f29ddc55ff.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(943, 315, 'products/2d1f5ad0-38ce-47d7-b0b7-bdf2963df357.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(944, 315, 'products/35aa9d61-92dd-4a38-8b99-0ffc1d7c1cab.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(945, 315, 'products/2a47662c-b086-4e22-84d4-57590c4de4e4.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(946, 316, 'products/56ad942c-73e2-46a9-9ab4-a928ca15a5da.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(947, 316, 'products/b6dfa075-e0f4-401c-9929-6de53d5ffb36.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(948, 316, 'products/1d7c2e65-33f9-4a40-8598-261122d5590b.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(949, 317, 'products/49197960-15ab-4940-af8e-926319b5c843.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(950, 317, 'products/973f6a34-5770-48e7-baf0-cfd728461ab1.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(951, 317, 'products/18d7bbde-cc20-470a-bdd4-c219373911cf.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(952, 318, 'products/6ec52a13-8c9d-4c17-bf86-1c5c90af7191.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(953, 318, 'products/51bb93d6-8225-4e17-bb7a-219fe35eaf64.jpg', 1, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(954, 318, 'products/d4f4b9c1-2506-4435-b9d9-5c54009b4275.jpg', 2, 0, '2025-11-30 11:52:42', '2025-11-30 11:52:42'),
(955, 319, 'products/d4fc372f-323f-45d0-8325-cff95fdb88c9.jpg', 1, 1, '2025-11-30 11:52:42', '2025-11-30 11:52:43'),
(956, 319, 'products/f04bb488-19bd-4e38-abce-a984360ed645.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(957, 319, 'products/a291a5af-4dc1-42ec-8ae4-79f703e70ddd.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(958, 320, 'products/e6425084-a278-4fda-881a-14b0a7e0bcf2.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(959, 320, 'products/49edc1ce-cef2-4c85-bf27-46a70aedb715.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(960, 320, 'products/e5c8c9a5-1ab4-4b2f-86cc-e7d8f243d415.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(961, 321, 'products/746e4c08-bbb2-4ef5-bd46-4d569c8fc37a.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(962, 321, 'products/41ca1dcf-8f5f-448e-af68-0cb4a4166f79.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(963, 321, 'products/3acb9b94-0321-4c0d-b46c-e77aede88b63.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(964, 322, 'products/c5b69682-70fc-4fb7-a035-59730e7f5558.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(965, 322, 'products/deb3094e-ead3-49b7-8661-593604c44941.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(966, 322, 'products/e0547862-1388-4cc6-90dd-13325b79ec61.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(967, 323, 'products/0aac0c00-e960-470e-9d87-6f569c0014ad.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(968, 323, 'products/1eae2ed3-5541-4308-adaf-0f371c5a971c.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(969, 323, 'products/92daa56a-ce7f-4edd-82ec-14bf382fe81d.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(970, 324, 'products/0d5ea29c-a215-442f-bafd-5f0f5518ecb3.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(971, 324, 'products/aa12aa47-7244-40d9-954e-1e0b049dfe99.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(972, 324, 'products/080b067e-8900-42a1-b9ec-0ee679546b47.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(973, 325, 'products/c0a3a10b-7374-4670-b50e-1e4a692ef0c5.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(974, 325, 'products/a74aa5d0-7c23-4965-b387-7053e546d3f6.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(975, 325, 'products/bbbafcad-df42-4087-a556-65dc1f88b60c.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(976, 326, 'products/abccb0e4-0e58-4ccf-8b57-ce55a66912d2.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(977, 326, 'products/a416810d-82a0-41b0-8cf8-722faf4f5fb0.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(978, 326, 'products/9c3e4dfe-7f3f-4562-9641-a5bb81422f4a.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(979, 327, 'products/8b0eab66-75bb-4a62-9592-0a8d3b7b3738.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(980, 327, 'products/95f11f35-2b98-4f02-9f9a-fcd71db55478.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(981, 327, 'products/77eeba8b-a38f-4470-92a5-e6fcf9b45811.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(982, 328, 'products/d43a25ac-553a-4010-8212-b2ce5250be70.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(983, 328, 'products/3303bca0-fbdc-4613-ac2e-b8ea2031dc6c.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(984, 328, 'products/db2e9d6c-f9c7-47ac-811b-8bef9000580b.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(985, 329, 'products/6e72d9a3-47ce-42bc-baa9-0c6883002d71.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(986, 329, 'products/0ec1de84-177b-4c4e-96ca-6bf8cab94af3.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(987, 329, 'products/84d35de6-4cab-40ca-8996-ef9957b31b79.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(988, 330, 'products/065882d5-e586-4637-ba02-f4faeb3f9c5d.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(989, 330, 'products/94925d40-238e-44c6-972c-24cfa4c598c5.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(990, 330, 'products/81e153ff-d11e-4c35-b31f-9dc77975e052.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(991, 331, 'products/da8e65be-a404-423a-a55a-33607ecbfb73.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(992, 331, 'products/f6c35804-773f-46d1-bfc5-32c2682ca2f4.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(993, 331, 'products/4a1a1b66-fdd8-4842-bb23-6119b07b7982.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(994, 332, 'products/07cea583-07fe-4aa7-bbcb-2bcdb6562daf.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(995, 332, 'products/293074c2-1e13-404d-8c60-80ac2f7b78b6.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(996, 332, 'products/fdf5153f-c79c-484e-b296-4c6eae546f00.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(997, 333, 'products/b7ed748a-bf4b-4250-ae35-d4346c007149.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(998, 333, 'products/fb29633a-4c45-48af-9c9e-85eb2bed69f0.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(999, 333, 'products/f1e687ca-9b54-4f0b-ab78-c91664dab1dd.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1000, 334, 'products/6b8346ad-7c32-46f6-bfd6-a6d157064798.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1001, 334, 'products/bec31fe1-0ae8-473f-880c-162b73d24412.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1002, 334, 'products/bdf55553-dc44-4836-b6ce-744badfb1e41.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1003, 335, 'products/efd6b891-d4a8-4df2-81d7-68ac2a4dfec8.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1004, 335, 'products/26be88af-577d-4b80-a6cc-730e7ba58266.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1005, 335, 'products/64f85f2b-3ee5-4bd5-aec0-68eb0758d294.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1006, 336, 'products/6cda46c4-8f6c-4576-9b63-608e670c1330.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1007, 336, 'products/74937c5d-277f-479d-83d6-4d3264c14e41.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1008, 336, 'products/be4709d8-f4bd-498f-96eb-6e6579661be8.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1009, 337, 'products/db4ae4fc-2ab4-44d3-8476-93253aad0804.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1010, 337, 'products/d9fcf062-2c9c-4706-9fc2-9a40c4923ded.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1011, 337, 'products/c35beb24-b782-4f9a-ac05-17416bcd42a8.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1012, 338, 'products/bbb80963-bdf4-4b3a-9c93-ce036e832b3d.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1013, 338, 'products/640d8514-29e5-4651-b84a-385c3f6dfe2b.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1014, 338, 'products/a6b4e144-b86f-4ce2-b0e3-d9b8c81a2b2f.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1015, 339, 'products/a56e67cb-edf4-4f87-b3fd-822fb6787944.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1016, 339, 'products/46732479-e312-437d-9366-3520ebd9a359.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1017, 339, 'products/ce4c2c8a-ffee-4390-b472-f9b3c64b3d31.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1018, 340, 'products/7c0b21d3-10ce-428c-9718-e73292b594ed.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1019, 340, 'products/dedb22d1-8636-486c-bd77-1948bcb7a977.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1020, 340, 'products/01c403b0-7145-4760-bed4-b650cfdaa34e.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1021, 341, 'products/7404c5f5-f924-4d7c-9541-52278af9fed4.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1022, 341, 'products/99250386-3500-4421-84ff-773afd8c5d90.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1023, 341, 'products/43833568-df0e-4639-b4e3-6f3c29e2daa5.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1024, 342, 'products/c5babd30-0038-47bd-8b54-8b96a5c2ca0d.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1025, 342, 'products/d03ea5c6-3f6c-45fe-b30c-2e70007a1545.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1026, 342, 'products/fd9bd9a8-3eae-4de6-80d5-5fecfe157f12.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1027, 343, 'products/522ff669-e650-4e05-92f3-7635f6599ed7.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1028, 343, 'products/9aa0ad43-1ab2-479e-a0ec-8308af96940d.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1029, 343, 'products/ac2dbc13-115f-40c0-b5d0-1798c5e9bc37.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1030, 344, 'products/eab13133-d91a-4b30-b068-9db6abfd569a.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1031, 344, 'products/0f6fc7f8-27e1-49f4-a4dc-65746a69a3c3.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1032, 344, 'products/a7af8e9b-6771-48b4-91b5-ef3ed51b194f.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1033, 345, 'products/5544bf53-6786-4fd0-8d31-e0853980d671.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1034, 345, 'products/af0ca763-c8f5-41b3-a2f7-0fe942a4aedb.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1035, 345, 'products/363f7201-dfd9-4d0f-9992-60a4cbeadcc1.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1036, 346, 'products/a98bcf6b-b6a0-4364-8611-74b680ef5959.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1037, 346, 'products/c1fe9c9c-1432-404d-8427-c87e3ed213cd.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1038, 346, 'products/a88e37ce-0471-482f-95ab-3b4df1cb3ebb.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1039, 347, 'products/74d690be-6f92-41c5-972c-3c47d44fbbf0.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1040, 347, 'products/21ca3577-dbbe-4732-ac48-bc3180240d52.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1041, 347, 'products/e524f62f-b0dd-4f5f-8579-cbc0c696ad56.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1042, 348, 'products/75976699-ebc0-448d-82a9-d7bc7e0e98f9.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1043, 348, 'products/d2310fe8-64ba-48de-ac3b-f1494fb3b024.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1044, 348, 'products/c8c4149b-08ac-41a9-a564-52b30185b36f.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1045, 349, 'products/a4bed473-0d30-44dc-8fc7-524f210f99e5.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1046, 349, 'products/976e5d26-522b-4857-99ee-0b607d7a5324.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1047, 349, 'products/dd910e8c-4fba-4aab-822b-c3ac72d3d381.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1048, 350, 'products/13498ce7-3e72-430c-b7ef-99dd1b9c0aa8.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1049, 350, 'products/ee1b3989-14a8-4905-8dd5-19089f977ee0.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1050, 350, 'products/f36bbbfb-23af-4be8-83a3-4effa8d22521.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1051, 351, 'products/c6b21923-dcc0-4adf-b562-1795652c02f4.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1052, 351, 'products/71e6ccf8-f1dc-44e9-8459-5cf0bccfad79.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1053, 351, 'products/56835cd2-437c-4906-ae45-30635b498adb.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1054, 352, 'products/0f6025c0-ea54-4971-ab8d-66ca373ee3b2.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1055, 352, 'products/fdac8b0b-7e76-4fdd-9151-77e31a78aea4.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1056, 352, 'products/948d6d89-84ac-4159-9614-dc34640282db.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1057, 353, 'products/8ce5d3ff-523c-48c1-a082-5943c1b06851.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1058, 353, 'products/f8eb13db-89fd-4d19-876a-a0e48c690b19.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1059, 353, 'products/655b3545-90ed-4302-93b7-fe346bb5dc93.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1060, 354, 'products/d39f1669-f42f-4bbd-a5e3-9cb85dc9000e.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1061, 354, 'products/ac7fdc46-dd80-4ec1-abdb-b1d42ddb7f1a.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1062, 354, 'products/a0cffae9-b1ca-457a-8e68-ad77147374c4.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1063, 355, 'products/5089c7fe-a036-48b0-b5c5-d98ea96dd1b2.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1064, 355, 'products/0080ad46-4322-4cc5-b099-c878d98c5638.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1065, 355, 'products/4116b4fc-7ac7-4f37-9bdc-aafd32bb7429.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1066, 356, 'products/edd68a61-3a05-4c17-8a3f-8189eaf1a193.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1067, 356, 'products/8b52e04e-c7d0-4ea3-a1f9-8ddcb58ddb2b.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1068, 356, 'products/465031b9-bfed-43e7-b76e-4b2f165b3e67.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1069, 357, 'products/dc17f9a0-a218-453d-b543-058e35a205ec.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1070, 357, 'products/ceeeddf5-b83e-44f4-a276-480fd04b7f96.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1071, 357, 'products/7daa2e39-39a7-4702-8d33-548699c8b34c.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1072, 358, 'products/96ad1ed8-9168-48e5-bce1-1696ef478253.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1073, 358, 'products/58fde06a-b546-40c9-94ac-b895a48e16d3.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1074, 358, 'products/9363d1ec-b236-42cc-848e-c7c6503fddd7.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1075, 359, 'products/53e07774-2e8e-42fa-97ec-42dc0f47aece.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1076, 359, 'products/0225d6ce-c512-479c-b45b-c47df30b0fad.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1077, 359, 'products/d40997ed-bdb2-4a9b-88d3-e8e0ad5d0c18.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1078, 360, 'products/dc4e7c77-32d1-4890-9d2c-e088796b31ae.jpg', 1, 1, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1079, 360, 'products/07afe61b-15d1-430f-af5e-67c1aaafcfb3.jpg', 1, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1080, 360, 'products/047bdeb8-94d9-4730-9905-3ae72d4521f1.jpg', 2, 0, '2025-11-30 11:52:43', '2025-11-30 11:52:43'),
(1081, 361, 'products/29b55daf-3ade-4241-8aeb-cd2785be0a14.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1082, 361, 'products/cd5687d9-1b33-49dd-beca-25606cf823b0.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1083, 361, 'products/0742dab2-c625-4231-a128-7df4ac6bbf04.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1084, 362, 'products/5ec519d9-e3ae-4bb9-9b3f-cd0abd17f851.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1085, 362, 'products/181f7565-8fab-498f-9080-82cca7fdfbff.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1086, 362, 'products/a100409a-b49e-41b3-a8c9-fb61a567e18e.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1087, 363, 'products/492e9122-9219-4d13-b8df-02709532beef.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1088, 363, 'products/c559f7ae-adfc-43eb-b3cc-88864f5f91e5.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1089, 363, 'products/92eb9384-5c25-4ba8-91f1-f2f5c2f07c2f.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1090, 364, 'products/52fa05ca-1dc7-4e24-bb27-485e3c8c0388.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1091, 364, 'products/11162bb7-0d82-4051-ba39-269e8727bcfe.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1092, 364, 'products/a6c06cdc-56d2-47a6-a517-5e81e2cda8ab.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1093, 365, 'products/9e3be910-e885-4686-9b4b-75a232e21f1b.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1094, 365, 'products/9f5a4165-fee2-443d-b7ea-0d4ea1db1cb6.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1095, 365, 'products/6073b6ed-e0c8-4e23-81c5-5f89d0a0776f.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1096, 366, 'products/2d0db6f6-efbc-4e24-90be-7fe9077dd791.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1097, 366, 'products/4f3a8e9c-6f44-47be-88d5-0682f6ad6684.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1098, 366, 'products/46b96e6b-ecaa-4c48-9b4b-a42f9f68e23a.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1099, 367, 'products/e54fee1c-3f08-49e7-87a0-5b915a0a9f03.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1100, 367, 'products/ef3603db-0903-4ca3-8dcc-507ffa10f54b.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1101, 367, 'products/fab607c0-bbc5-466e-9425-cbe479111e89.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1102, 368, 'products/8df1b735-f5fe-47f0-b25c-35abb0c93e85.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1103, 368, 'products/4ac77996-6fac-4dea-867c-01b421398dbc.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1104, 368, 'products/061fcd55-8cf0-4b83-8519-91aed13d97ba.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1105, 369, 'products/1554a6a4-6817-47a1-9594-1cd05eb9c6a1.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1106, 369, 'products/4b7b27f6-8808-41ed-95a3-649d71e59435.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1107, 369, 'products/664e3561-a170-4d6f-98e1-01c2fd043923.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1108, 370, 'products/1dc5ef44-7a85-43a5-8d52-9c9c2526fbeb.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1109, 370, 'products/feb426c0-5645-4de0-80f8-c6617b6ad97f.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1110, 370, 'products/300d05ba-a60b-4845-bb41-bd6eaa1b375b.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1111, 371, 'products/fb9501d5-0733-446b-b2ad-31c4add3d057.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1112, 371, 'products/de7daf67-86cf-44ff-95e3-76d9b7d134f4.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1113, 371, 'products/49d5ac3b-bff0-4cfb-8212-025b9e7b5709.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1114, 372, 'products/615be2e0-a520-4809-a93a-e7063d2613fc.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1115, 372, 'products/0d15e39f-20aa-4adc-bbd5-aeec1158b171.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1116, 372, 'products/d5f561b6-3082-4025-b977-6a44bcbb264f.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1117, 373, 'products/12da1d5e-395c-48b0-8012-1ea79052ab84.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1118, 373, 'products/7c3463ef-b43a-49d6-ab48-392163a2768b.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1119, 373, 'products/3b8e7c5c-467d-4350-88bf-a9877f71d7c1.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1120, 374, 'products/5eaa33de-ce30-408d-9722-05cfcd8fce73.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1121, 374, 'products/535840e5-2565-4cd0-87d5-fc5b88a2aad8.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1122, 374, 'products/469f5a21-26d3-4c49-bd39-624386b1d4fb.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1123, 375, 'products/2e9410db-74aa-4a47-ab86-cb300c796002.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1124, 375, 'products/f60f99d7-5273-402b-bde3-1729161621d9.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1125, 375, 'products/834b78ee-2996-468d-98dd-478ca87facf2.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1126, 376, 'products/60a30789-d8c2-4f0c-ae23-28ccefce91bb.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1127, 376, 'products/cd02cd6a-3d56-4efa-bd01-8ab3f241cb79.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1128, 376, 'products/4279da12-35cd-4b64-96ff-4516fd24d766.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1129, 377, 'products/12bd0819-df09-4418-9874-08e48d4cac03.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1130, 377, 'products/02682c83-1507-4e87-80bf-897df98dea2f.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1131, 377, 'products/9597d128-39b2-46a8-b2bb-d36dc752dcd6.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1132, 378, 'products/b95ed5f1-8ad3-4957-a331-1d7b966c9c00.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1133, 378, 'products/f3f61489-8a15-4765-89b9-cdd34bdf64da.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1134, 378, 'products/bbf713de-2386-46a6-ba84-14f1ad0b020e.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1135, 379, 'products/ca78fa50-59ba-400e-82d3-fc18307374e9.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1136, 379, 'products/8e7799b8-ba9c-46ce-af33-33062bc2cd94.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1137, 379, 'products/fb545f03-8a66-4524-a8f3-a2cbe2c74d0c.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1138, 380, 'products/75a1fe40-0d8a-4959-8ae8-8745747f2c28.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1139, 380, 'products/54053507-e1d9-4d9d-9ab8-a5e3d3ab2851.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1140, 380, 'products/d3598fc3-44d2-4f8c-a329-04eb578ce074.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1141, 381, 'products/52c8dfd8-dc3f-449e-963c-cedf321b431a.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1142, 381, 'products/74891787-abc0-48f5-9cf3-52056a8cc092.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1143, 381, 'products/cb0b7f00-bde8-4c4a-8c05-9fd4075aff50.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1144, 382, 'products/887e542c-bc08-4167-bc89-1145ea433e9a.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1145, 382, 'products/63fadad3-e91a-4bfe-810c-2e0a6a2c3aed.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1146, 382, 'products/b94a3bd9-574e-4ccc-8762-d4fc6794d4ac.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1147, 383, 'products/989fc0eb-b88b-4a7c-8dca-9e02bfb75c0d.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1148, 383, 'products/fb5d8b3a-d152-4d39-a43f-e8200d80bad8.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1149, 383, 'products/27831b09-9b46-4ae1-8ec2-2869482eeeff.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1150, 384, 'products/fdd738ef-7106-4353-8389-fa04de719600.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1151, 384, 'products/f35001f6-2f67-4516-86d0-5722c3b0c1b6.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1152, 384, 'products/d51f4f1e-f358-41dd-9b08-6251624b4cfd.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1153, 385, 'products/845c8831-0aef-4856-811d-1dbf1082a4e5.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1154, 385, 'products/bfd71938-16e1-43a1-9c45-00c525791ef7.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1155, 385, 'products/7dabe7e2-f627-443d-bfc8-62d45f1c66a5.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1156, 386, 'products/b72399e0-ae25-444e-ac05-988cfa9f4050.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1157, 386, 'products/6bad9b97-452b-41d0-bae2-9ca7a4497e39.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1158, 386, 'products/0d834dc6-e0e6-48d5-a279-42b36f72530b.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1159, 387, 'products/6a75461f-86c5-4e01-94b0-17ad03c0d7db.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1160, 387, 'products/c3485b2b-df16-4c32-a4df-9c6c36249179.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1161, 387, 'products/9174f55b-ea86-4f78-a597-5e9d09694809.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1162, 388, 'products/02d695ba-d01a-4e26-849d-bb0bc84cfff6.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1163, 388, 'products/94ffe5ed-684f-469a-946d-35596b85c5a4.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1164, 388, 'products/503836f3-0d7b-4ec9-91e4-0425036a5e43.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1165, 389, 'products/2726b6a1-0503-4b9e-bbeb-4b676cd6980c.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1166, 389, 'products/b6bd8438-961e-4ef0-80a0-ee6734939f66.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1167, 389, 'products/42d4e092-82a8-45f3-bbd5-721db05188a4.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1168, 390, 'products/ed8b08f9-7b64-4cf4-9422-5d417c5a512c.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1169, 390, 'products/f2e8f486-a567-4fad-8561-d82db6397a7a.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1170, 390, 'products/47a57c1d-33bc-4073-92b0-0176d313f705.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1171, 391, 'products/e8ffe8f3-4bfb-4917-8b34-41d2873cc676.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1172, 391, 'products/91f2b416-2877-424f-9cfc-2c15e6acd4ec.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1173, 391, 'products/864525fd-8a45-4262-ad41-4d44e6b0ea1a.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1174, 392, 'products/41f06ede-e391-41a7-aeb7-d1a2e66c0918.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1175, 392, 'products/f420565a-fbb4-4467-841f-4c0e865d474c.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1176, 392, 'products/bdf68866-c6c7-4299-ad2b-316dca0ff849.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1177, 393, 'products/2121c2ff-adc5-452c-a7e8-d61e994a9408.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1178, 393, 'products/a3b7b1c6-b806-4530-b927-83fcc7df5ab0.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1179, 393, 'products/81ab6cbc-d4cd-422a-b076-43257e81d18b.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1180, 394, 'products/0943233a-5227-4eca-82e8-9edbf861dc40.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1181, 394, 'products/4ebcfa07-6249-43d7-93da-2ca724e2be20.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1182, 394, 'products/521e1f1e-d1b2-4d71-9c7d-b37b88e2d793.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1183, 395, 'products/b102ac7d-f766-4e7f-986b-232b8794c98d.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1184, 395, 'products/ec6ace0d-462a-4b0d-9eb7-4e69aafea5c1.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1185, 395, 'products/5bfeaa3a-97db-4781-a047-bd4ad78acb4a.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1186, 396, 'products/134fbc12-47f1-4757-bffc-c591fcbac435.jpg', 1, 1, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1187, 396, 'products/c6883292-f024-4ce6-9a21-68b30c48a276.jpg', 1, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1188, 396, 'products/7ec29116-83ae-4d2a-b930-08fd4c7808f8.jpg', 2, 0, '2025-11-30 12:04:35', '2025-11-30 12:04:35'),
(1189, 397, 'products/34caa62f-8b30-4cdf-bcc5-0bd16f9cbf8c.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1190, 397, 'products/41c7eff9-a68b-49ce-a92f-4ca392a30b20.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1191, 397, 'products/65e45a43-1d43-483d-9fc7-161e7c69535d.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1192, 398, 'products/e8c55a44-9398-472e-895e-bb6deebc545b.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1193, 398, 'products/f8ea982b-1ce3-4fff-b418-df632a6ac6f9.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1194, 398, 'products/5fc9d1c8-0ca0-4e96-8775-e36eef56633c.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1195, 399, 'products/5da18cc8-7397-41f6-905b-77d16ddb4a6e.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1196, 399, 'products/fc0e721f-910d-4e29-a253-4dc2978c9a1d.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1197, 399, 'products/e87ae1b6-033e-4375-b14f-3ee1ce803764.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1198, 400, 'products/2b64135f-6639-4a99-b2f9-a6bb06595858.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1199, 400, 'products/7413a3ef-4ca8-4ee2-8cf8-b0d1fc744241.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1200, 400, 'products/673eb893-b23d-4252-b6d8-d29e09aec316.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1201, 401, 'products/e54caaf1-705b-4cbf-9c66-04bbeb8cd3e9.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1202, 401, 'products/c2e68a54-33b7-41ad-a1d1-3a23cf85609b.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1203, 401, 'products/93100f03-184f-4785-bb29-6b9b92b29feb.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1204, 402, 'products/164b22d5-7da6-47f2-b801-b6252b47bcdf.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1205, 402, 'products/905ebea7-1951-46ca-9206-fbca5cfa2159.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1206, 402, 'products/40bafbaf-ae91-4aac-a45b-429da1f3748e.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1207, 403, 'products/0e859f71-8734-40fa-b442-f3639bd7f25e.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1208, 403, 'products/b50ffaba-ab1d-42aa-aa01-d05ba75b90aa.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1209, 403, 'products/cfef51e0-fd1b-43d9-b9c4-6a1958bfd856.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1210, 404, 'products/358fce0f-33ac-407d-95a9-0f16fa0b8d4f.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1211, 404, 'products/e36ee7a1-d8c8-4aff-a999-1028f1527e8c.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1212, 404, 'products/25683fea-15fb-4e56-9a6d-9dd66ec7dfb4.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1213, 405, 'products/b3ada77e-78e3-4768-8bef-3318b8255320.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1214, 405, 'products/6f72e260-d554-45c3-8fcc-f859fe70a435.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1215, 405, 'products/c6259b22-75d1-4d46-99a8-1a1bdbedc217.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1216, 406, 'products/9e2f63e7-24e3-4db4-a4ac-7744d2346dbb.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1217, 406, 'products/bbc0647e-ab0a-4b5e-8b38-b0f40fd0902a.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1218, 406, 'products/75368e9b-4df0-42e1-a47c-e5da7fe2c6ef.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1219, 407, 'products/c4108c5b-4e0d-4b07-8d43-b17c9c7fb020.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1220, 407, 'products/05e2ba98-3e29-4e08-bea3-c77ac1ed3948.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1221, 407, 'products/50876707-af25-4f64-935b-1a9a86bae0a2.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1222, 408, 'products/f3145fcc-6f4a-4501-a615-70820b49e9ca.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1223, 408, 'products/6a3052f4-9718-4310-a5e4-c618651b161d.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1224, 408, 'products/e18e349e-f8fc-417f-b960-eef53da9fd92.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1225, 409, 'products/253362de-8d1b-460e-b19c-3d283df583ed.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1226, 409, 'products/88603983-7966-4f0a-a976-b951065ac42e.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1227, 409, 'products/c36e41d5-e2f6-46c8-b7a7-b4db11109088.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1228, 410, 'products/8c8538e3-a193-4592-b6a7-70840ac10fc1.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1229, 410, 'products/0d60c1ba-0be5-440f-8387-5d3e20599838.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1230, 410, 'products/bb8997f2-d5b6-4447-8413-73d23a28fdf7.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1231, 411, 'products/aa39e852-aee0-4d05-a89a-06120e6beb45.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1232, 411, 'products/976c2620-9c6c-4d7b-bcda-66a87f8b0ac7.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1233, 411, 'products/720bdb79-478c-4523-9f09-343e10c66b71.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1234, 412, 'products/2e42f591-2a9a-4371-a5da-0614f73b058a.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1235, 412, 'products/cba19393-1744-4be9-9266-8696760fac9f.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1236, 412, 'products/2d0e8421-2e8f-4ba1-9185-3fdb90e3eab0.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1237, 413, 'products/3660451a-8b1e-41a4-bc62-798c53eaa1bd.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1238, 413, 'products/ce6fc312-95d1-44d7-b342-80f2a5e988c5.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1239, 413, 'products/1af486cd-32c8-4105-b37e-729c6cd48019.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1240, 414, 'products/70128b22-91c2-449a-83b7-a050f8e8e5de.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1241, 414, 'products/42769545-1559-4517-b64c-eeae678bd8c5.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1242, 414, 'products/c8a58089-89b0-4a99-8a62-5d57606576a3.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1243, 415, 'products/1993203b-15c5-4553-966f-26d62b346db1.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1244, 415, 'products/933e70cc-fe5a-4ffd-a0f7-cc065d2ade85.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1245, 415, 'products/14a69606-768b-411e-b3fa-6a763bb24d30.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1246, 416, 'products/0d3349b5-1476-4278-ae16-e41d15560768.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1247, 416, 'products/a279b35c-df97-498e-8869-718da42534bf.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1248, 416, 'products/be543052-4555-4646-a07a-743c35ceef54.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1249, 417, 'products/dc2ac8fd-2a50-4525-b513-13783e57922a.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1250, 417, 'products/55223365-9825-4437-a11b-63e60946f9aa.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1251, 417, 'products/9409985f-8a90-44bc-be0d-974a4b6b1c13.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1252, 418, 'products/710ca367-7623-4cc4-b6ba-da956680f5d1.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1253, 418, 'products/c3594ff9-e947-45bc-bc4d-49219e9d80f4.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1254, 418, 'products/3f42ee22-22c6-42ba-81b8-5a72bfdde9e0.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1255, 419, 'products/667bfce4-f07f-46f5-bcb6-33a56f555a16.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1256, 419, 'products/5e0c56ce-97f9-424c-abfd-f41a2cd7cc05.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1257, 419, 'products/1e3fe978-fdc4-4736-a35a-4eec6d3166be.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1258, 420, 'products/29e9f040-66ff-4a39-b895-3a9922c40783.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1259, 420, 'products/09c84f88-6283-49cb-8339-71f2ce0ef000.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1260, 420, 'products/60f79cbe-4ae5-4ff9-bfd6-f476ed65b028.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1261, 421, 'products/83d42299-dbf5-4112-9512-4ce90593f382.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1262, 421, 'products/d1821ea5-ab3d-4202-9b22-408f6f25f0da.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1263, 421, 'products/57ba0c18-0e1b-4c2f-8c94-08797b72996c.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1264, 422, 'products/d741555a-62e4-4066-af65-01d7c5623811.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1265, 422, 'products/57b9800f-c648-4f36-af8b-9069711e975f.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1266, 422, 'products/1d0aac97-c56b-4794-9e93-0a6a886a7247.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1267, 423, 'products/49f4c0c7-2ee4-46d9-94b8-59d479bdffb9.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1268, 423, 'products/e82ecdf6-d060-4d29-ba48-3b46ce93c867.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1269, 423, 'products/d815fc5f-9049-46ba-91d4-a7f88685c039.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1270, 424, 'products/679d891e-acef-42d2-ba4b-f6948f09e021.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1271, 424, 'products/4398062a-eb82-468a-ba07-54854789e4e4.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1272, 424, 'products/158fd54a-5dae-48fe-bb75-bc0fcf94bcb9.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1273, 425, 'products/26dfcafd-774a-4a81-bd05-af1351d605f9.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1274, 425, 'products/f5e9272e-8225-43e1-a7c2-e8ffb1c5e733.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1275, 425, 'products/faf80615-d6b2-4c95-8542-bf1691be7588.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1276, 426, 'products/4244c524-3441-4d13-978c-2fbd62b534ce.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1277, 426, 'products/8d04d3ad-fb12-4e55-abcd-1e13cfd9bbe5.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1278, 426, 'products/11cc5461-1023-4b5a-a167-6d8c936a63ce.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1279, 427, 'products/63a89df4-3270-45c5-8abf-de91da5b2ccc.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1280, 427, 'products/3fc1c94c-acb9-4d35-9103-b40f52f48ed7.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1281, 427, 'products/0a1e1522-928c-40eb-a43c-828f438b645a.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1282, 428, 'products/65474c93-6e48-4e92-a0d2-3a0759153ebe.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1283, 428, 'products/1ff28024-d676-44c7-8950-dde5bbe5929d.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1284, 428, 'products/7eb870bb-4c57-4e41-94a2-6c46c9ba3064.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1285, 429, 'products/8f1ba9fe-aaaf-4e16-97ca-536bf1895cd0.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1286, 429, 'products/568993e4-167e-484a-8479-15b939158bc8.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1287, 429, 'products/698af5ea-e63d-49a3-a39f-eaae174aa3fc.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1288, 430, 'products/248833ca-8eab-4b71-90af-15cd60b80de9.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1289, 430, 'products/46e5a877-fbae-4014-aa71-682b3c4e47a6.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1290, 430, 'products/82fa3c0e-0a0f-4337-8b8b-0f34da0470e1.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1291, 431, 'products/70a71639-cd6a-431d-aff6-9a6afe0c1bad.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1292, 431, 'products/1ea9d5e4-42fd-4ae7-b965-d3694eda2b4b.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1293, 431, 'products/dfb7c3d2-1152-4ff5-b121-4aa654909cfa.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1294, 432, 'products/d5e40c9c-eb12-437f-8f06-92f79da6be05.jpg', 1, 1, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1295, 432, 'products/d9484d59-82c6-4710-b212-d30365e7fbe7.jpg', 1, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1296, 432, 'products/815d586e-2248-4231-8a7a-1345a58a6880.jpg', 2, 0, '2025-11-30 12:04:36', '2025-11-30 12:04:36'),
(1297, 433, 'products/08c67831-5c54-442a-9974-8fecd5f48b0d.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1298, 433, 'products/57ca7c38-0794-4fbe-a6cb-1f077aa25806.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1299, 433, 'products/84f646be-2cae-42bc-a3c5-bf7488983cf2.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1300, 434, 'products/d9969a9f-7d65-40bb-9c03-0a4bcbd6d9ec.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1301, 434, 'products/b039bf74-e8a1-4776-9d06-22f33670577b.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43');
INSERT INTO `product_images` (`id`, `product_id`, `path`, `position`, `is_primary`, `created_at`, `updated_at`) VALUES
(1302, 434, 'products/39e33156-6da0-43fb-b1a0-1e15ba314369.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1303, 435, 'products/36e81d20-5c27-44ca-933d-8ef44564470f.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1304, 435, 'products/b952fe88-017f-4e35-9619-fa5b12ff9458.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1305, 435, 'products/b312ef91-49c8-47ac-8965-e816c3667fb7.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1306, 436, 'products/a151dafe-5769-4ae7-9e07-6540471470f9.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1307, 436, 'products/c63a0fc8-dfa6-4800-9283-9b30747e4638.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1308, 436, 'products/59d981f4-4c43-4db1-844c-cd378a0698ee.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1309, 437, 'products/1818503d-2ed7-4d9a-8ae7-20288b82946c.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1310, 437, 'products/01eebd44-4d70-4dfb-ad8e-a62a04107f13.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1311, 437, 'products/02790f21-b0bc-4694-9717-08ffbf679a92.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1312, 438, 'products/70fc8c01-7991-473d-86c4-ee1bbc304769.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1313, 438, 'products/86e05029-93d5-4f1a-a890-72328b554239.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1314, 438, 'products/4eced77e-c140-4301-aa2c-0e382c91554d.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1315, 439, 'products/c6b82083-4ca4-4635-8c6a-34f2450942a5.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1316, 439, 'products/db572b66-4916-4395-a3fd-87a4640c5102.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1317, 439, 'products/83a13692-8c2a-438e-839e-1c60b1c9aaa3.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1318, 440, 'products/8a65bc60-11e2-4957-8234-e3ead63b12b9.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1319, 440, 'products/880c6d16-67d7-474c-abb1-5bce09afc76e.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1320, 440, 'products/b036effc-48d5-403c-8426-d0b6da8152b4.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1321, 441, 'products/a52f36ce-95d4-4d20-a17a-835c2cd2bce3.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1322, 441, 'products/85472be7-38bc-4561-b9f7-fa1c3dcc9bb0.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1323, 441, 'products/d346ab46-2360-4f4f-9e2a-631a67513010.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1324, 442, 'products/60636d02-0112-4a64-8984-03e75fa17cc2.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1325, 442, 'products/455335d7-d6b9-43df-9315-661c2ff886e3.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1326, 442, 'products/9296e222-2f15-4ea1-993a-5dc0f67400ff.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1327, 443, 'products/d3f487f7-6ad3-431d-90ce-45702c017d27.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1328, 443, 'products/d5f66912-868d-4464-ae13-e143e192e0f5.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1329, 443, 'products/1cfd6e21-6fd4-4d5c-9f80-667e3b55d08a.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1330, 444, 'products/eddd3929-7f02-43d8-ba1c-b62454db325e.jpg', 1, 1, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1331, 444, 'products/7c35dda5-af4f-416d-acd3-c31c21bd8aae.jpg', 1, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1332, 444, 'products/38a516f5-e84f-4ca5-95f8-c060b1e3a862.jpg', 2, 0, '2025-11-30 12:25:43', '2025-11-30 12:25:43'),
(1333, 445, 'products/2e76874d-2b72-4fae-9ce9-e3f09376c35b.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1334, 445, 'products/94ac7c9e-3fe6-4b41-a7e2-d129110739c0.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1335, 445, 'products/718609bd-5052-4c29-b159-ee33507fd330.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1336, 446, 'products/d3b8f29f-f0ca-435e-88d8-20ea60bcc089.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1337, 446, 'products/fb2102f2-1af0-4160-9805-6ce9562fe882.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1338, 446, 'products/a4bf2b51-312b-4c55-8ed4-506116cd1714.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1339, 447, 'products/35c8f228-0285-4ff3-a252-0f1515a54f05.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1340, 447, 'products/7e5f998a-95e9-49e5-8904-a07bd53e636f.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1341, 447, 'products/4b5931c3-a9ba-4e8d-8e65-58eb2c07300a.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1342, 448, 'products/1c184a10-2b7f-4ccd-903e-473728cb9344.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1343, 448, 'products/4da34240-ac5d-4ad8-b67d-7e65773691a9.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1344, 448, 'products/56375589-6b13-4bf1-a27d-f8c5565cf584.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1345, 449, 'products/fb57a4eb-786a-4f8e-a33e-45d4a1a90dd4.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1346, 449, 'products/94f58720-a7c4-4d26-b264-eb0c9d8d4f04.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1347, 449, 'products/f5f63e75-2d89-457f-94b9-141c982bebc1.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1348, 450, 'products/071306b1-d65d-4413-b63a-45a94d2c0d95.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1349, 450, 'products/f0955869-1328-4b2e-ab0c-1f9ad02ae9fc.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1350, 450, 'products/22912c16-409d-46c9-8d4a-ea71b9833c55.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1351, 451, 'products/b98e38d4-5265-4d73-bb67-0c39ace997cc.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1352, 451, 'products/4b174111-884c-4b93-bbfc-7492e1de37ce.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1353, 451, 'products/e43bdd8b-6e46-43cc-ad9e-7d797b7e14e8.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1354, 452, 'products/2fd3dd7e-3416-44ed-ba0e-d41bc7f7db0a.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1355, 452, 'products/4decf559-1ed0-4c15-8cf6-dec1dfc16ac9.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1356, 452, 'products/7c04fa0a-7208-4a2b-a6e9-172a76c4caec.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1357, 453, 'products/e6314485-4bb5-4395-9089-e064715ae632.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1358, 453, 'products/41123ec9-c20f-42ca-8c02-3b3e7700e032.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1359, 453, 'products/3b0b31cf-214b-468f-a3db-c613951f8f37.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1360, 454, 'products/b5e6eb8a-6b5f-402c-b243-3d43ab5f0201.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1361, 454, 'products/7fe2eb19-46e2-4bc0-af1a-847aceafe955.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1362, 454, 'products/461f1fc4-191a-4597-82bc-934af1000775.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1363, 455, 'products/7ec399e6-365b-44e8-aeb6-7ba8c0213441.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1364, 455, 'products/833b883f-1581-41e9-835a-237c5ba23fbd.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1365, 455, 'products/a03e5a9c-c840-45f4-b209-ea583c5ad15a.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1366, 456, 'products/d45fb2be-44c9-485e-b583-7abaf4670b78.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1367, 456, 'products/4ec3de97-284f-4663-a3ac-a10d3290667a.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1368, 456, 'products/681c5692-0960-4dfb-8b4f-0c237149d05b.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1369, 457, 'products/0df4a51e-a2e5-4884-b929-f3b6fe7efe85.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1370, 457, 'products/5ba61519-5931-4fa6-bb91-e0e8f0be76e6.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1371, 457, 'products/ae46cad2-a39f-463a-bcf1-cb95be3d2f87.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1372, 458, 'products/c85af5dc-52a9-44f0-a59b-43b632d3edf2.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1373, 458, 'products/5e4a86a3-5e62-4444-92af-ff9e2d2ccc7a.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1374, 458, 'products/2de5daf5-7d68-4789-bb38-337b82fb8139.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1375, 459, 'products/f77f9b06-9722-4a9f-b7c6-8c777b7baf26.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1376, 459, 'products/810b2897-4837-4a4a-bbd3-78206a71fdf7.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1377, 459, 'products/97666dc4-d5a9-48fd-817d-ab6e8f377d33.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1378, 460, 'products/8114982d-7656-475e-8bda-c4b8aa31a87c.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1379, 460, 'products/ed444f57-ac63-4d15-b4ea-e525feb04f98.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1380, 460, 'products/404a5029-65c5-4979-b9b6-d3fd80d5af20.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1381, 461, 'products/ec2f53d2-359a-4446-bb0d-a5dd07400901.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1382, 461, 'products/3f28c8a6-4b5f-4ba6-91da-728253f45aa0.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1383, 461, 'products/f393ab3e-bc01-4d3f-875c-af78321c78e2.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1384, 462, 'products/06744a6c-5b27-4a37-8791-79c0ac02d922.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1385, 462, 'products/bf7adf95-dee2-46bc-bb86-88cab19c9afb.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1386, 462, 'products/25e0e23f-7191-47f3-8300-db0e000aee5f.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1387, 463, 'products/7a94c832-050e-42a5-ba60-2e6a0bb13d72.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1388, 463, 'products/711e5fa2-469b-4be4-b2f0-624840100e52.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1389, 463, 'products/6f827539-1c49-4969-8e33-fff712b7b2c0.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1390, 464, 'products/2e20d611-2324-4628-9746-a272d66c3495.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1391, 464, 'products/a541743f-8d12-47cf-bf57-7e2267abc02f.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1392, 464, 'products/a9c084ee-2334-4b23-86a4-2218457b2325.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1393, 465, 'products/74f74c7a-1c33-48ad-8ff2-2df78c457fa5.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1394, 465, 'products/7b6442f1-d64b-4aab-99e9-7b3c396cc4f1.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1395, 465, 'products/5c78cb09-1bc1-4e00-897f-cdace845a4e9.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1396, 466, 'products/8af609ed-982c-46a8-930a-b222b54034b1.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1397, 466, 'products/261465cd-f886-463e-a660-edc7c1e8389f.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1398, 466, 'products/4e1a38da-6f45-4daf-a891-04150a57620d.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1399, 467, 'products/a5da7ffc-1634-40a0-8216-0bf84824f060.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1400, 467, 'products/c6ad5b83-bacc-4c55-9248-a3af35b68eba.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1401, 467, 'products/1b8a94bc-5cf8-4271-8575-5864b71909e8.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1402, 468, 'products/02db2465-bd4b-4751-a323-5eb11d293563.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1403, 468, 'products/eb9c53ef-c224-4667-a021-16b8de35a829.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1404, 468, 'products/2220d48e-9ea2-4d5d-8563-b2cc0ca59685.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1405, 469, 'products/69551571-18c3-4f93-924d-cae1281593b4.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1406, 469, 'products/5a2e1de7-454a-484c-be0f-9b27d21ff724.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1407, 469, 'products/eb9a6708-f6e4-411c-bc24-c3ce20699ed0.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1408, 470, 'products/e0c84e66-147b-4803-9048-38387de56e9b.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1409, 470, 'products/ad282fb2-8b57-4ccc-b23c-9933c41e14ad.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1410, 470, 'products/5e40aedc-b984-47db-90d8-c3f817c6cdbc.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1411, 471, 'products/7a19f2a6-634b-4865-bab1-553e3bcd2419.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1412, 471, 'products/5a87f0aa-edae-4ff0-8561-7fdfe7cc684c.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1413, 471, 'products/93355179-29fa-4e1c-bff1-cd37c57684b9.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1414, 472, 'products/94f38b8c-9c3a-4ce6-8b58-74e2553fccdf.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1415, 472, 'products/c90df7d1-acb6-4a29-8f13-7359bb66a009.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1416, 472, 'products/9cac9492-07fe-42a3-8e0e-8adea5484f3d.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1417, 473, 'products/ba2449a0-5dcf-4937-b204-03bfd751b9b3.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1418, 473, 'products/6c3c6286-efc3-4372-a3b4-cf8f72e400d9.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1419, 473, 'products/05e02aab-ac34-449e-8074-86723c34bdaf.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1420, 474, 'products/2d484831-34ae-440a-b280-fb2c251bde0f.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1421, 474, 'products/f3b9cb9a-a776-4e92-a3b7-0714c74fd40e.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1422, 474, 'products/5ad79d5c-c1d1-43dc-a4c6-6a03a0a4fcb9.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1423, 475, 'products/e8b9b7a1-1d0f-4bf6-9abb-db2533b9c456.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1424, 475, 'products/eea32c41-a5d3-462a-ad39-a0ab67c3b272.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1425, 475, 'products/3913d911-379c-432f-9596-3b2cf5a614db.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1426, 476, 'products/cf7b2942-037f-45b7-96ce-2c9a351d501e.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1427, 476, 'products/2c202644-bdb6-4b3d-b84c-715d507ca883.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1428, 476, 'products/456cab6d-7f48-4524-8ea8-a4c6447f1e31.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1429, 477, 'products/cd6436ef-e758-4596-a896-afc4cc52d7c6.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1430, 477, 'products/70d60048-8d7d-4045-835d-23fe8d423d5e.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1431, 477, 'products/6eac8248-2d47-4774-92ff-574c56791a58.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1432, 478, 'products/7fb7e20f-15bb-495b-83c7-47c6b4c9eb6a.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1433, 478, 'products/42f21924-1fbe-4167-9759-f5a9fd91d07f.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1434, 478, 'products/df26c1f7-4fc4-4780-97dd-bbafb3ffa351.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1435, 479, 'products/1b7b2963-3d1a-4474-adbe-23f54fe1ea4e.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1436, 479, 'products/2e910c94-1382-44a1-a7e8-b949406431b0.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1437, 479, 'products/69931135-7144-4d53-8968-0485eec4585e.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1438, 480, 'products/fba680d2-817d-4cb4-ba20-4d9d46a2e766.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1439, 480, 'products/6250129e-403c-4625-ae87-f0cdf17f8a79.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1440, 480, 'products/f9ee586c-d873-4f38-a81e-3ef5499a83af.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1441, 481, 'products/672b0026-529a-4c0b-9075-d011f26c4563.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1442, 481, 'products/99d95acd-0b95-4e36-894b-1084ff882089.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1443, 481, 'products/a333e843-c735-40d2-a02b-d5ff5f1404a8.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1444, 482, 'products/4d3db341-7c0a-4306-81f7-5e3dae533f3a.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1445, 482, 'products/d731988e-90cf-402f-86e1-887d2d72ad02.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1446, 482, 'products/8dabced4-8ca2-40b9-9d7a-0c8fdcaed95c.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1447, 483, 'products/41322818-58f2-4b0f-87eb-3b54ffcfa5ad.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1448, 483, 'products/7afae8c2-8a38-41f2-9f21-4b78aea1ad70.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1449, 483, 'products/fe1fafeb-1eff-46e1-9648-c29aac13c752.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1450, 484, 'products/e5552ec4-e2f1-4e61-b482-cf2a367301ff.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1451, 484, 'products/7883e668-2637-45ce-b5fb-74a490a5c3a6.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1452, 484, 'products/31c49db2-0c1d-4120-aa92-9338c9c7101b.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1453, 485, 'products/34f73a24-641c-49fa-ab22-d4504cfb8bb8.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1454, 485, 'products/8d8d4fd9-15e0-4059-9c50-e7a381a7130e.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1455, 485, 'products/ef525d32-75d3-4b2a-9fce-53dc9f77163d.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1456, 486, 'products/4a00611e-46ab-4384-b979-ad340e72ac6b.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1457, 486, 'products/66e6cb37-634a-4bbd-afbc-7ff0cfa0ad00.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1458, 486, 'products/30d0c364-045b-45a8-81a3-af33bd7756dc.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1459, 487, 'products/e3b49bb8-fcee-4c6e-938e-b288edd65743.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1460, 487, 'products/bb34c177-6939-49cb-9da7-416056b125ea.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1461, 487, 'products/c05217b7-a8a7-4e53-8904-2bba094ff8dd.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1462, 488, 'products/f56c8eab-9b1b-421e-b87a-ba2c14d54050.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1463, 488, 'products/7e8da35b-346e-4375-921b-df8470d1ea20.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1464, 488, 'products/b1f3cfeb-55a9-4cc4-ac96-8ce922a559b7.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1465, 489, 'products/0148e0c9-5b25-4bcd-a273-99037de606cf.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1466, 489, 'products/ac3c7992-c3b6-407e-897a-3b9281c43ef2.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1467, 489, 'products/9d748820-184c-4e53-b572-d652068a4f32.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1468, 490, 'products/287b7cb8-9f40-4450-8573-e2ae7c3f4f51.jpg', 1, 1, '2025-11-30 12:25:44', '2025-11-30 12:25:45'),
(1469, 490, 'products/081a3b5f-77c2-48c0-8796-7a78c12e5d7b.jpg', 1, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1470, 490, 'products/350dd045-7129-4402-ba70-970c2cf66c85.jpg', 2, 0, '2025-11-30 12:25:44', '2025-11-30 12:25:44'),
(1471, 491, 'products/de21b21f-fe21-41a7-998a-77050bd85ec9.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1472, 491, 'products/004cd51f-91e3-4518-bceb-838d9384d056.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1473, 491, 'products/4205e471-1ccd-4a4b-a2f3-a04207d77cf4.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1474, 492, 'products/80e61431-dcce-4be8-8e47-25d97ed87959.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1475, 492, 'products/57b9ac56-1dff-487b-a0bf-0cac883be025.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1476, 492, 'products/974165e4-1f9e-40b8-9d8e-6708c426b0d5.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1477, 493, 'products/ce9c5165-ae06-45d2-b557-c5da071570fa.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1478, 493, 'products/34295980-ff07-4c6a-a950-7127e96aa533.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1479, 493, 'products/cb42e378-dc49-43c6-b153-bbf9b011a55b.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1480, 494, 'products/6cacb3a2-66e1-41af-82f7-b6e0e19c07a2.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1481, 494, 'products/80323f03-367d-45d6-92f6-92285840ca3e.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1482, 494, 'products/28bbf4ca-aa28-4b77-bf92-d48a037819a1.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1483, 495, 'products/47c31b60-7288-4af4-a89d-17042c09c2cd.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1484, 495, 'products/8f9aa348-92e8-421d-b441-187b4040c1fc.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1485, 495, 'products/a19930c2-3cd9-457c-bb83-df22f4c7bb56.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1486, 496, 'products/f868c380-e988-4a59-b50e-dbbadc41e02c.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1487, 496, 'products/0d880d91-10ff-453b-9f24-1ff0482c5e8b.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1488, 496, 'products/f05487bb-7b56-4fae-89df-b5721fe1404b.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1489, 497, 'products/68bc0aad-9aec-4474-9110-b3ce0c761602.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1490, 497, 'products/36c0730e-8556-41a3-bff6-d84d1a977ca5.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1491, 497, 'products/d998087a-d543-49e4-9d88-78a32a385001.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1492, 498, 'products/72a1b8fb-a26f-4a12-b415-8382c56bc109.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1493, 498, 'products/15a183e7-5fa2-407c-8568-efcdc234c590.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1494, 498, 'products/131070bd-0d47-4402-8c50-cec971da75b9.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1495, 499, 'products/1f2f93a1-7003-4f13-8574-04f8f55bb5b0.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1496, 499, 'products/953b155d-379b-4fa1-b734-513bc926455d.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1497, 499, 'products/008fe9fc-2343-490e-9df4-0e9a2a22e4cf.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1498, 500, 'products/b8a2904a-b934-4653-8033-9bd607ca302d.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1499, 500, 'products/59a28d24-c88f-453b-94e5-3a443d821e92.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1500, 500, 'products/6eb8ea55-f5c2-4c66-99af-144cc183803a.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1501, 501, 'products/55e6119c-de68-4788-bdcb-15a0c17ceff9.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1502, 501, 'products/7f6a14b0-4de5-4a64-8e6f-9588d46670f8.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1503, 501, 'products/604bf995-cc4e-458e-8e1c-688770798c86.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1504, 502, 'products/c3041ce5-bc15-4c13-b94e-ffad0d192dac.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1505, 502, 'products/01f788d2-141f-4571-b889-b5f7c468db7f.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1506, 502, 'products/5d8d25b1-a84d-4eee-9d65-218f1ef5cc72.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1507, 503, 'products/f1274753-4757-48fc-9d3f-62be37848852.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1508, 503, 'products/5cd95d63-35f7-4fad-8f25-2ca18d74b86f.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1509, 503, 'products/01e1b87b-06fd-480b-a050-8a44fe9397f0.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1510, 504, 'products/0d45ef3e-a1a9-4316-80c3-df600612b1e5.jpg', 1, 1, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1511, 504, 'products/bf6b8a10-f2f8-4954-9d8b-e21fadc95b7b.jpg', 1, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45'),
(1512, 504, 'products/346e9a44-79f7-4fd9-bd37-2959c9e50310.jpg', 2, 0, '2025-11-30 12:25:45', '2025-11-30 12:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `rating` int UNSIGNED NOT NULL DEFAULT '5',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `is_verified_purchase` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', '2025-11-30 11:08:14', '2025-11-30 11:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2CFjwmHNhUFdlmlemwKyuddI871ampCN8P3dJDAJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0pTN3ZBYnRvWFdyZ2trblpyekwyR2RHNnNMV01YR3ROSG1YbXAwNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9lY29tbWVyY2UudGVzdC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766259065),
('3oq711FJ8I0Py6HakBr3ioFBKV95zYLsXQYaeSeU', NULL, '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibXd4NGtycXBIOWEzM0xwRVlXU1BWbHczdUM5R3luQ3hYT3hlSlNWbiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cHM6Ly9lY29tbWVyY2UudGVzdC9hZG1pbi91c2VycyI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM0OiJodHRwczovL2Vjb21tZXJjZS50ZXN0L2FkbWluL3VzZXJzIjtzOjU6InJvdXRlIjtzOjE3OiJhZG1pbi51c2Vycy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766258331),
('6i2OGpji5CLmnXnDsir9pk4MM1jUxjPGw7RiUmcT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieHh2QWd0TGhLdW5XTWJneXFySnpNVWVGdHFTNEJEdDY0TnQzTFIyeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZWNvbW1lcmNlLnRlc3QvYWRtaW4iO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE1OiJjYXJ0X3Nlc3Npb25faWQiO3M6MzY6ImE5YjYzZThlLWUwYWEtNDQ5My1iZTM5LWNkMWUzNjI4YzNlYyI7fQ==', 1766260765),
('A4h2W8ISGLrrtMSQwkCr4ffVLoTKigy5diyoH7GD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib0l6alQzWlRLMEJsamRZamNCanlBUUhmOWdyVktWRER6R3B4T1VhNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9lY29tbWVyY2UudGVzdC9wcm9kdWN0cz9xPWFjY3VzYW11cy1yZXJ1bSI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1766258105),
('aoEreJBWlnv8fbOaVVrb2Wof4zS9HxLSqimjFGph', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRjRkTDJEaXY2aFI0cUpLUlVtMVNoR083UHZXbEU2M3QyNm51NjJFQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9lY29tbWVyY2UudGVzdCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766258285),
('cCbu8utZ9fbfXRkM2z5l8KLZu4xsfHeM5EKVwgh6', NULL, '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUldDT1lYYmN1NUcyT2VtUGg5QjVvRWx5SkRybmRibGtOR3VNeTJZbCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cHM6Ly9lY29tbWVyY2UudGVzdC9hZG1pbi9wcm9kdWN0cyI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM3OiJodHRwczovL2Vjb21tZXJjZS50ZXN0L2FkbWluL3Byb2R1Y3RzIjtzOjU6InJvdXRlIjtzOjIwOiJhZG1pbi5wcm9kdWN0cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766258331),
('cdaK4mCsnKU7iwJOn2O2uI1VnckbqIZdIEcMSxIG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWhFM2ZYUTdNaW1GVGY0NXBkVVZYcjdlWDVkZVN5Q0JPcWJJb29hdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9lY29tbWVyY2UudGVzdC9wcm9kdWN0cz9xPWFjY3VzYW11cyI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1766258109),
('eMgPvGg7lJqyrBZvytqOYCSLfR30KvcWWdx2RNYz', NULL, '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3FPbmNMQXBPVmVLMjFnbUwxb1RpVUJLTGp6d20wbWtSeUhWR3ptMCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozOToiaHR0cHM6Ly9lY29tbWVyY2UudGVzdC9hZG1pbi9jYXRlZ29yaWVzIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZWNvbW1lcmNlLnRlc3QvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1766258331),
('fcCQ7tzZQLgK1Ou5R90aquFFHGOJXNy1eIU84Dd9', NULL, '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRzhmQzhCaHhOa3c0YlJuSk9QZ0VXcXE5ZmZBTTRhMmlUTDJYNlNrcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cHM6Ly9lY29tbWVyY2UudGVzdC9hZG1pbi9wZXJtaXNzaW9ucyI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI4OiJodHRwczovL2Vjb21tZXJjZS50ZXN0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766258331),
('ilo6Q5hQhPIE7WELEv0B5wBH4gjU4Z1IBnDp7LcM', NULL, '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMEdkRW1LZEo2MmllM1VpQTZPNHp5V0pKd3prZVlPQ1FpVERQWGpGWiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyODoiaHR0cHM6Ly9lY29tbWVyY2UudGVzdC9hZG1pbiI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI4OiJodHRwczovL2Vjb21tZXJjZS50ZXN0L2FkbWluIjtzOjU6InJvdXRlIjtzOjE1OiJhZG1pbi5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1766258331),
('iRydqrcB5szPqDvaCHvu9VsOe6DDc2r4kQ3XoJrg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiM3cyR1ZWaVpncGFlN0NKVzJDQjdZMmIyUUlXZTJsa0pPRjlSalQ3RiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766258111),
('iwdW6hcQZvDscLd1cUmvnpYmISJziVIfXoba5q9o', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUE1TcEZvclZsNG5GVEp1Y2ZvM1ZTMG5Wd0FKM3ZBMnRSRHNYV0F0ZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9lY29tbWVyY2UudGVzdC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766259059),
('JmcdgXs9giVQZzFOTyKvnnmJu8OINrZM5jVkIo18', NULL, '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWHBVeGVIQWk5TGVndzZZRldJcWNUM3VZRFY5VzR2bFNOMTRlSnhhNSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cHM6Ly9lY29tbWVyY2UudGVzdC9hZG1pbi9zaXRlLXNldHRpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZWNvbW1lcmNlLnRlc3QvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1766258331),
('JrnrL81dyf781U04s1b8CmZFG8NN0e5wI7aCroJN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMmloNFpEZUdDOVB5Z01GaEhRWDhEb3FuM3JiamZVMHQ5bFBqZUhHZCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovL2Vjb21tZXJjZS50ZXN0L2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9lY29tbWVyY2UudGVzdC9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766259061),
('ljvYrxx9IZoks2IUV3qODVDx5toBs7QlNuR0LcIU', NULL, '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTVdzcXc1MGFhY0s4elZETFdqODExUnBoNEt4a1QzaVhkRWNNQ3lxWCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MzoiaHR0cHM6Ly9lY29tbWVyY2UudGVzdC9hZG1pbi9lbWFpbC1zZXR0aW5ncyI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI4OiJodHRwczovL2Vjb21tZXJjZS50ZXN0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766258331),
('mGR2FJcYOundDlvY6Y8plmXqSziRv9O2NbqAjujH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVVvWWF2WFQ1SFd4VEw0OHQ3a3hEZktrS2I1WnNBMldXdnpJZ0pFbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9lY29tbWVyY2UudGVzdCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766258124),
('OWI7ywkEWTjNXlecpH9HQa3BDN3g9YW8aF0OI8xD', NULL, '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY1Z2TUVJYm9NZEJXS0xzaVJYWHlMWXQ5TTR1cXJyems1Wm5WQkdmayI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNToiaHR0cHM6Ly9lY29tbWVyY2UudGVzdC9hZG1pbi9vcmRlcnMiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozNToiaHR0cHM6Ly9lY29tbWVyY2UudGVzdC9hZG1pbi9vcmRlcnMiO3M6NToicm91dGUiO3M6MTg6ImFkbWluLm9yZGVycy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766258331),
('PCAcyZqMZXDkfDgkZOIly6Al5xqRVjYDI4SAJtLt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibE9tS2NHc2F0MEg2alo1VkJRZ1lNaWlRcWVUYjNuWmhud2U0NzkySSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9lY29tbWVyY2UudGVzdCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766259068),
('pFvLUiZgcDqkQxxmnfMv5LyOpzWbBL49HBkHwbLq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2FTS2t4SUpvcmNqd3F5MW1VTkZBa3h3eWtjTDZjN2tvaDNkb1FpVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTM6Imh0dHBzOi8vZWNvbW1lcmNlLnRlc3QvcHJvZHVjdHMvYS1lb3MtcXVpYnVzZGFtLUU1SW9IIjtzOjU6InJvdXRlIjtzOjEzOiJwcm9kdWN0cy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766259582),
('QY67n2rSZdktwdI3P2C4VUtJg9tZ5tzjivbKIQaa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUjFDbkZQT0xCeTlkN0FnbmtEbWV6bnl2MEV5V0o4Wjc5UFRHNzg1eiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovL2Vjb21tZXJjZS50ZXN0L2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9lY29tbWVyY2UudGVzdC9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766259065),
('RdiBI4A2BcUy8zLBnDSy0kciIWdcLcsnZQGQcDQ3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3Q3ZkoyV2RLYVFTNGxWT0c4MlRXcTB6RlB2QnFHdUVsMXdFeUpYMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9lY29tbWVyY2UudGVzdCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1766259058),
('xNYSbMqzcnDdxsNjq2btrBBks8TWvN9Z5HYIEtbG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:146.0) Gecko/20100101 Firefox/146.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQklOSEt1bmV6R2RWb3RWM0NZbHBWaTM5OGFlMlVlSzdnUUlhcXRLVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9lY29tbWVyY2UudGVzdC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1766259062);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_settings`
--

CREATE TABLE `shipping_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `free_shipping_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `free_shipping_min_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `tax_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percent',
  `tax_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_settings`
--

INSERT INTO `shipping_settings` (`id`, `enabled`, `free_shipping_enabled`, `free_shipping_min_total`, `tax_enabled`, `tax_type`, `tax_rate`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0.00', 0, 'percent', '0.00', '2025-11-30 11:12:04', '2025-11-30 11:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'eCommerce Store',
  `site_tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `footer_text` text COLLATE utf8mb4_unicode_ci,
  `privacy_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cookies_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `help_center_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_info_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `returns_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_us_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wishlist_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `reviews_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `reviews_require_purchase` tinyint(1) NOT NULL DEFAULT '0',
  `reviews_require_approval` tinyint(1) NOT NULL DEFAULT '1',
  `reviews_allow_anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `newsletter_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `newsletter_double_opt_in` tinyint(1) NOT NULL DEFAULT '1',
  `newsletter_send_welcome_email` tinyint(1) NOT NULL DEFAULT '1',
  `social_facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_display_columns_mobile` tinyint NOT NULL DEFAULT '2',
  `product_display_columns_desktop` tinyint NOT NULL DEFAULT '3',
  `schema_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `schema_organization_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schema_organization_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schema_organization_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schema_organization_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schema_organization_address` text COLLATE utf8mb4_unicode_ci,
  `schema_organization_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Store',
  `sitemap_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `sitemap_priority_home` int NOT NULL DEFAULT '10',
  `sitemap_priority_product` int NOT NULL DEFAULT '8',
  `sitemap_priority_category` int NOT NULL DEFAULT '7',
  `sitemap_priority_page` int NOT NULL DEFAULT '6',
  `sitemap_change_frequency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'weekly',
  `installer_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'theme1',
  `license_key` text COLLATE utf8mb4_unicode_ci,
  `google_analytics_code` text COLLATE utf8mb4_unicode_ci,
  `facebook_pixel_code` text COLLATE utf8mb4_unicode_ci,
  `microsoft_clarity_code` text COLLATE utf8mb4_unicode_ci,
  `custom_head_code` text COLLATE utf8mb4_unicode_ci,
  `custom_body_code` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_tagline`, `logo_url`, `favicon_url`, `meta_title`, `meta_description`, `meta_keywords`, `footer_text`, `privacy_url`, `terms_url`, `cookies_url`, `help_center_url`, `shipping_info_url`, `returns_url`, `contact_us_url`, `wishlist_enabled`, `reviews_enabled`, `reviews_require_purchase`, `reviews_require_approval`, `reviews_allow_anonymous`, `newsletter_enabled`, `newsletter_double_opt_in`, `newsletter_send_welcome_email`, `social_facebook`, `social_twitter`, `social_instagram`, `social_linkedin`, `product_display_columns_mobile`, `product_display_columns_desktop`, `schema_enabled`, `schema_organization_name`, `schema_organization_logo`, `schema_organization_phone`, `schema_organization_email`, `schema_organization_address`, `schema_organization_type`, `sitemap_enabled`, `sitemap_priority_home`, `sitemap_priority_product`, `sitemap_priority_category`, `sitemap_priority_page`, `sitemap_change_frequency`, `installer_enabled`, `theme`, `license_key`, `google_analytics_code`, `facebook_pixel_code`, `microsoft_clarity_code`, `custom_head_code`, `custom_body_code`, `created_at`, `updated_at`) VALUES
(1, 'eCommerce Store', NULL, 'http://ecommerce.test/storage/products/d9969a9f-7d65-40bb-9c03-0a4bcbd6d9ec.jpg', 'http://ecommerce.test/storage/products/d9969a9f-7d65-40bb-9c03-0a4bcbd6d9ec.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 0, 1, 1, 1, NULL, NULL, NULL, NULL, 3, 3, 1, NULL, NULL, NULL, NULL, NULL, 'Store', 1, 10, 8, 7, 6, 'weekly', 0, 'theme1', 'pub-2069693345597629', NULL, NULL, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-12-20 13:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `storage_settings`
--

CREATE TABLE `storage_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storage_settings`
--

INSERT INTO `storage_settings` (`id`, `key`, `name`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'storage_driver', 'Storage Driver', 'local', 'Storage driver: local, s3, cloudflare, digitalocean, wasabi, backblaze, etc.', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(2, 's3_key', 'AWS Access Key ID', '', 'AWS S3 Access Key ID', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(3, 's3_secret', 'AWS Secret Access Key', '', 'AWS S3 Secret Access Key', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(4, 's3_region', 'AWS Region', 'us-east-1', 'AWS S3 Region (e.g., us-east-1, ap-southeast-1)', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(5, 's3_bucket', 'S3 Bucket Name', '', 'AWS S3 Bucket Name', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(6, 's3_url', 'S3 URL', '', 'S3 URL (optional, auto-generated if empty)', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(7, 's3_endpoint', 'S3 Endpoint', '', 'S3 Endpoint (for S3-compatible services like DigitalOcean, Wasabi, etc.)', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(8, 's3_use_path_style', 'Use Path Style', '0', 'Use path-style endpoint (required for some S3-compatible services)', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(9, 'cloudflare_account_id', 'Cloudflare Account ID', '', 'Cloudflare Account ID', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(10, 'cloudflare_access_key_id', 'Cloudflare Access Key ID', '', 'Cloudflare R2 Access Key ID', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(11, 'cloudflare_secret_access_key', 'Cloudflare Secret Access Key', '', 'Cloudflare R2 Secret Access Key', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(12, 'cloudflare_bucket', 'Cloudflare R2 Bucket', '', 'Cloudflare R2 Bucket Name', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(13, 'cloudflare_endpoint', 'Cloudflare R2 Endpoint', '', 'Cloudflare R2 Endpoint URL', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(14, 'digitalocean_key', 'DigitalOcean Spaces Key', '', 'DigitalOcean Spaces Access Key', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(15, 'digitalocean_secret', 'DigitalOcean Spaces Secret', '', 'DigitalOcean Spaces Secret Key', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(16, 'digitalocean_region', 'DigitalOcean Region', 'nyc3', 'DigitalOcean Spaces Region (e.g., nyc3, sgp1)', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(17, 'digitalocean_bucket', 'DigitalOcean Spaces Bucket', '', 'DigitalOcean Spaces Bucket Name', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(18, 'digitalocean_endpoint', 'DigitalOcean Endpoint', '', 'DigitalOcean Spaces Endpoint (auto-generated if empty)', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(19, 'wasabi_key', 'Wasabi Access Key', '', 'Wasabi Access Key', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(20, 'wasabi_secret', 'Wasabi Secret Key', '', 'Wasabi Secret Key', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(21, 'wasabi_region', 'Wasabi Region', 'us-east-1', 'Wasabi Region', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(22, 'wasabi_bucket', 'Wasabi Bucket', '', 'Wasabi Bucket Name', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(23, 'wasabi_endpoint', 'Wasabi Endpoint', '', 'Wasabi Endpoint URL', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(24, 'backblaze_key_id', 'Backblaze Key ID', '', 'Backblaze B2 Application Key ID', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(25, 'backblaze_application_key', 'Backblaze Application Key', '', 'Backblaze B2 Application Key', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(26, 'backblaze_bucket_id', 'Backblaze Bucket ID', '', 'Backblaze B2 Bucket ID', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(27, 'backblaze_bucket_name', 'Backblaze Bucket Name', '', 'Backblaze B2 Bucket Name', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(28, 'cdn_enabled', 'Enable CDN', '0', 'Enable CDN for serving static files', '2025-11-30 11:35:10', '2025-11-30 11:35:10'),
(29, 'cdn_url', 'CDN URL', '', 'CDN URL (e.g., https://cdn.yourdomain.com or Cloudflare CDN URL)', '2025-11-30 11:35:10', '2025-11-30 11:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coins_balance` bigint UNSIGNED NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referred_by_user_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `coins_balance`, `remember_token`, `referral_code`, `created_at`, `updated_at`, `referred_by_user_id`) VALUES
(1, 'Test User', 'needyamin@gmail.com', '01878578504', NULL, '$2y$12$FFu/.FQMgHOQijeuZ8X92O.yNyoDDU/t5FAxBBnzZ63r1H8krISam', 0, NULL, '475BD3A0', '2025-11-30 11:08:14', '2025-11-30 11:38:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'billing',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upazila` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_points`
--

CREATE TABLE `user_points` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_id` bigint UNSIGNED DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_session_id_index` (`session_id`),
  ADD KEY `carts_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_items_cart_id_product_id_unique` (`cart_id`,`product_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `coin_settings`
--
ALTER TABLE `coin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_usages_user_id_foreign` (`user_id`),
  ADD KEY `coupon_usages_order_id_foreign` (`order_id`),
  ADD KEY `coupon_usages_coupon_id_user_id_index` (`coupon_id`,`user_id`),
  ADD KEY `coupon_usages_coupon_id_session_id_index` (`coupon_id`,`session_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_code_unique` (`code`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_division_index` (`division`),
  ADD KEY `districts_is_active_index` (`is_active`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_settings_key_unique` (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guest_wishlists`
--
ALTER TABLE `guest_wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guest_wishlists_session_id_product_id_unique` (`session_id`,`product_id`),
  ADD KEY `guest_wishlists_product_id_foreign` (`product_id`),
  ADD KEY `guest_wishlists_session_id_index` (`session_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `newsletter_settings`
--
ALTER TABLE `newsletter_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletter_subscribers_email_unique` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_number_unique` (`number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `otp_codes`
--
ALTER TABLE `otp_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otp_codes_otptable_type_otptable_id_index` (`otptable_type`,`otptable_id`),
  ADD KEY `otp_codes_channel_index` (`channel`),
  ADD KEY `otp_codes_identifier_index` (`identifier`),
  ADD KEY `otp_codes_code_index` (`code`),
  ADD KEY `otp_codes_purpose_index` (`purpose`),
  ADD KEY `otp_codes_expires_at_index` (`expires_at`);

--
-- Indexes for table `otp_settings`
--
ALTER TABLE `otp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_gateway_settings`
--
ALTER TABLE `payment_gateway_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_gateway_settings_gateway_key_unique` (`gateway`,`key`),
  ADD KEY `payment_gateway_settings_gateway_index` (`gateway`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_logs_gateway_action_index` (`gateway`,`action`),
  ADD KEY `payment_logs_created_at_index` (`created_at`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_order_id_foreign` (`order_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_settings`
--
ALTER TABLE `shipping_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_settings`
--
ALTER TABLE `storage_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `storage_settings_key_unique` (`key`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upazilas_district_id_index` (`district_id`),
  ADD KEY `upazilas_is_active_index` (`is_active`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_referral_code_unique` (`referral_code`),
  ADD KEY `users_referred_by_user_id_foreign` (`referred_by_user_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_points`
--
ALTER TABLE `user_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_points_related_type_related_id_index` (`related_type`,`related_id`),
  ADD KEY `user_points_user_id_type_index` (`user_id`,`type`),
  ADD KEY `user_points_type_index` (`type`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `coin_settings`
--
ALTER TABLE `coin_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest_wishlists`
--
ALTER TABLE `guest_wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `newsletter_settings`
--
ALTER TABLE `newsletter_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `otp_codes`
--
ALTER TABLE `otp_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_settings`
--
ALTER TABLE `otp_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_gateway_settings`
--
ALTER TABLE `payment_gateway_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1513;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_settings`
--
ALTER TABLE `shipping_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `storage_settings`
--
ALTER TABLE `storage_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_points`
--
ALTER TABLE `user_points`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD CONSTRAINT `coupon_usages_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_usages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_usages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guest_wishlists`
--
ALTER TABLE `guest_wishlists`
  ADD CONSTRAINT `guest_wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD CONSTRAINT `upazilas_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_referred_by_user_id_foreign` FOREIGN KEY (`referred_by_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_points`
--
ALTER TABLE `user_points`
  ADD CONSTRAINT `user_points_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
