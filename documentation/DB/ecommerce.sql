-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 30, 2025 at 05:25 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.0

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
(1, 'Admin', 'needyamin@gmail.com', NULL, '$2y$12$/BZDb/GUEQ9szicuIUVL/.Ni9Mnd2ouXU4nKNmKa/CzlPZxdU1Qli', 'MW36teJu6qDOvu7NsWiK9nwHgJNSUQlVAadjGBOseJzCwcH74iXLytch8KRm', '2025-11-30 11:08:14', '2025-11-30 11:08:14');

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
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:124:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"admin.captcha\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:18:\"admin.users.lookup\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:15:\"admin.dashboard\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:27:\"admin.categories.check-slug\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:22:\"admin.categories.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:23:\"admin.categories.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:22:\"admin.categories.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:21:\"admin.categories.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:21:\"admin.categories.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:23:\"admin.categories.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:24:\"admin.categories.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:21:\"admin.products.lookup\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:19:\"admin.products.json\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:25:\"admin.products.check-slug\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:27:\"admin.products.page-builder\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:32:\"admin.products.page-builder.save\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:28:\"admin.products.images.delete\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:33:\"admin.products.images.set-primary\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:34:\"admin.products.images.update-order\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:20:\"admin.products.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:21:\"admin.products.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:20:\"admin.products.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:19:\"admin.products.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:19:\"admin.products.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:21:\"admin.products.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:22:\"admin.products.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:19:\"admin.orders.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:18:\"admin.orders.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:18:\"admin.orders.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:17:\"admin.orders.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:19:\"admin.orders.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:20:\"admin.orders.invoice\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:17:\"admin.users.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:16:\"admin.users.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:16:\"admin.users.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:18:\"admin.users.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:19:\"admin.users.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:26:\"admin.users.reset-password\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:25:\"admin.users.toggle-status\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:24:\"admin.users.coins.adjust\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:23:\"admin.users.coins.reset\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:29:\"admin.shipping-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:30:\"admin.shipping-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:26:\"admin.email-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:27:\"admin.email-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:25:\"admin.email-settings.test\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:28:\"admin.storage-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:29:\"admin.storage-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:17:\"admin.roles.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:18:\"admin.roles.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:17:\"admin.roles.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:16:\"admin.roles.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:18:\"admin.roles.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:19:\"admin.roles.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:16:\"admin.roles.copy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:22:\"admin.roles.copy.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:23:\"admin.permissions.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:24:\"admin.permissions.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:23:\"admin.permissions.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:22:\"admin.permissions.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:24:\"admin.permissions.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:25:\"admin.permissions.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:19:\"admin.coupons.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:20:\"admin.coupons.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:19:\"admin.coupons.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:18:\"admin.coupons.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:20:\"admin.coupons.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:21:\"admin.coupons.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:27:\"admin.coupons.toggle-status\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:22:\"admin.newsletter.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:23:\"admin.newsletter.toggle\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:24:\"admin.newsletter.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:19:\"admin.reviews.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:21:\"admin.reviews.approve\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:20:\"admin.reviews.reject\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:21:\"admin.reviews.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:28:\"admin.payment-gateways.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:27:\"admin.payment-gateways.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:29:\"admin.payment-gateways.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:36:\"admin.payment-gateways.toggle-status\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:27:\"admin.payment-gateways.test\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:81;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:24:\"admin.otp-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:82;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:25:\"admin.otp-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:83;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:34:\"admin.api.categories.subcategories\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:84;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:22:\"admin.activities.carts\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:85;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:26:\"admin.activities.wishlists\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:86;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:25:\"admin.activities.sessions\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:87;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:33:\"admin.activities.sessions.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:88;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:38:\"admin.activities.sessions.destroy-user\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:89;a:4:{s:1:\"a\";i:90;s:1:\"b\";s:21:\"admin.coupons.preview\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:90;a:4:{s:1:\"a\";i:91;s:1:\"b\";s:22:\"admin.currencies.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:91;a:4:{s:1:\"a\";i:92;s:1:\"b\";s:23:\"admin.currencies.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:92;a:4:{s:1:\"a\";i:93;s:1:\"b\";s:22:\"admin.currencies.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:93;a:4:{s:1:\"a\";i:94;s:1:\"b\";s:21:\"admin.currencies.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:94;a:4:{s:1:\"a\";i:95;s:1:\"b\";s:23:\"admin.currencies.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:95;a:4:{s:1:\"a\";i:96;s:1:\"b\";s:24:\"admin.currencies.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:96;a:4:{s:1:\"a\";i:97;s:1:\"b\";s:23:\"admin.currencies.toggle\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:97;a:4:{s:1:\"a\";i:98;s:1:\"b\";s:24:\"admin.currencies.default\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:98;a:4:{s:1:\"a\";i:99;s:1:\"b\";s:25:\"admin.site-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:99;a:4:{s:1:\"a\";i:100;s:1:\"b\";s:26:\"admin.site-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:100;a:4:{s:1:\"a\";i:101;s:1:\"b\";s:18:\"admin.admins.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:101;a:4:{s:1:\"a\";i:102;s:1:\"b\";s:19:\"admin.admins.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:102;a:4:{s:1:\"a\";i:103;s:1:\"b\";s:18:\"admin.admins.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:103;a:4:{s:1:\"a\";i:104;s:1:\"b\";s:17:\"admin.admins.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:104;a:4:{s:1:\"a\";i:105;s:1:\"b\";s:19:\"admin.admins.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:105;a:4:{s:1:\"a\";i:106;s:1:\"b\";s:20:\"admin.admins.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:106;a:4:{s:1:\"a\";i:107;s:1:\"b\";s:25:\"admin.coin-settings.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:107;a:4:{s:1:\"a\";i:108;s:1:\"b\";s:26:\"admin.coin-settings.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:108;a:4:{s:1:\"a\";i:109;s:1:\"b\";s:17:\"admin.pages.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:109;a:4:{s:1:\"a\";i:110;s:1:\"b\";s:18:\"admin.pages.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:110;a:4:{s:1:\"a\";i:111;s:1:\"b\";s:17:\"admin.pages.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:111;a:4:{s:1:\"a\";i:112;s:1:\"b\";s:16:\"admin.pages.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:112;a:4:{s:1:\"a\";i:113;s:1:\"b\";s:16:\"admin.pages.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:113;a:4:{s:1:\"a\";i:114;s:1:\"b\";s:18:\"admin.pages.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:114;a:4:{s:1:\"a\";i:115;s:1:\"b\";s:19:\"admin.pages.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:115;a:4:{s:1:\"a\";i:116;s:1:\"b\";s:21:\"admin.districts.index\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:116;a:4:{s:1:\"a\";i:117;s:1:\"b\";s:22:\"admin.districts.create\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:117;a:4:{s:1:\"a\";i:118;s:1:\"b\";s:21:\"admin.districts.store\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:118;a:4:{s:1:\"a\";i:119;s:1:\"b\";s:20:\"admin.districts.show\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:119;a:4:{s:1:\"a\";i:120;s:1:\"b\";s:20:\"admin.districts.edit\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:120;a:4:{s:1:\"a\";i:121;s:1:\"b\";s:22:\"admin.districts.update\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:121;a:4:{s:1:\"a\";i:122;s:1:\"b\";s:23:\"admin.districts.destroy\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:122;a:4:{s:1:\"a\";i:123;s:1:\"b\";s:29:\"admin.districts.toggle-status\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}i:123;a:4:{s:1:\"a\";i:124;s:1:\"b\";s:16:\"admin.datatables\";s:1:\"c\";s:5:\"admin\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:1:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"Super Admin\";s:1:\"c\";s:5:\"admin\";}}}', 1764609042);

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
(1, NULL, '4395a804-4d19-42e1-98b6-9aa9086cdc09', '336.78', '0.00', '0.00', '336.78', '2025-11-30 11:12:04', '2025-11-30 11:12:05', NULL, '0.00'),
(2, NULL, '9688659c-41ff-421b-a5ce-c6e743174f13', '0.00', '0.00', '0.00', '0.00', '2025-11-30 11:15:15', '2025-11-30 11:15:15', NULL, '0.00'),
(3, NULL, '709c465c-3c49-47c0-ab77-4c5273c91d37', '0.00', '0.00', '0.00', '0.00', '2025-11-30 11:15:24', '2025-11-30 11:15:24', NULL, '0.00');

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
(1, 1, 216, 1, '175.29', '175.29', '2025-11-30 11:12:04', '2025-11-30 11:12:04'),
(2, 1, 213, 1, '161.49', '161.49', '2025-11-30 11:12:05', '2025-11-30 11:12:05');

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
(18, NULL, 'Consequuntur perferendis', 'consequuntur-perferendis-N1wUv', 'Voluptates vero ut dolorum voluptates quos possimus magni suscipit dolorum neque aspernatur iusto expedita.', NULL, 1, '2025-11-30 11:10:36', '2025-11-30 11:10:36');

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
(1, 'WELCOME10', 'Welcome Discount', 'Get 10% off your first order', 'percentage', '10.00', '50.00', '25.00', 100, 1, '2025-11-30', '2026-03-02', 1, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(2, 'SAVE20', 'Save $20', 'Get $20 off orders over $100', 'fixed', '20.00', '100.00', NULL, 50, 2, '2025-11-30', '2026-01-30', 1, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(3, 'FREESHIP', 'Free Shipping', 'Free shipping on any order', 'fixed', '10.00', NULL, NULL, 200, 3, '2025-11-30', '2026-11-30', 1, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(4, 'HOLIDAY25', 'Holiday Special', '25% off for holiday season', 'percentage', '25.00', '75.00', '50.00', 30, 1, '2025-11-30', '2025-12-30', 1, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(5, 'STUDENT15', 'Student Discount', '15% off for students', 'percentage', '15.00', '30.00', '30.00', NULL, 5, '2025-11-30', '2026-05-30', 1, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:10:38');

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
(192, '2025_01_20_000001_update_orders_table_for_bangladesh', 1),
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
(247, '2025_11_30_002354_create_storage_settings_table', 1);

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
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `shipping_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unshipped',
  `billing_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'stripe', 'enabled', '0', 'Enable or disable Stripe payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(2, 'stripe', 'publishable_key', 'pk_test_51Q4QjQRPJ7xXyZxZ1234567890abcdefghijklmnopqrstuvwxyz', 'Stripe publishable key (starts with pk_)', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(3, 'stripe', 'secret_key', 'eyJpdiI6IlZXVFRLbllvT2FVMWNLcHNQd3ppWmc9PSIsInZhbHVlIjoiajljRmEvMDBPak1lZWQxdm5SYzVnL2p5aE1Oc3I3a09vZ0FQNCtjSHJLR2hhK0p5aHcwUXpQdGd4UmE1VkMwOCsycTNXbWJGb2Q3RnRvb1ZodFZWV3B3UVBuYjhIREZ0SDRYZHdjYmQ5dW89IiwibWFjIjoiZmY4NDFhYzU2ZjJhZDY3ZjYxMjZmMWJhNTVjMTcwNGM0YjhiMmI1MjNkNjRmNWE2Y2I0OGY2MzRhYzhlNTdhZCIsInRhZyI6IiJ9', 'Stripe secret key (starts with sk_)', 1, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(4, 'stripe', 'webhook_secret', 'eyJpdiI6Imw4Q21IOXo2NTFydmUzVk4xd2R1WGc9PSIsInZhbHVlIjoiNXdFc3BzSHVReGFRMk43V2g0NTFFQWtibkNBTU9LekJ5TG5BQzJ5WEtEcWpDMWNKcmNFS2VYSE95Tjdld01FUzQ3M2VMMmp0SFhqV1JURFRnV0RBR1E9PSIsIm1hYyI6IjExZTc3ZGVkNTMzYTk0ZDhjNTlmMTk3MzRmMzZlMjRiMGRmYmY5ZjQwOWY5NGY0OGFmYzViYzdlYjIwMjIyNWUiLCJ0YWciOiIifQ==', 'Stripe webhook endpoint secret', 1, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(5, 'stripe', 'sandbox_mode', '1', 'Use Stripe test mode for testing', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(6, 'paypal', 'enabled', '0', 'Enable or disable PayPal payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(7, 'paypal', 'client_id', 'sb-client_id_1234567890', 'PayPal application client ID', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(8, 'paypal', 'client_secret', 'eyJpdiI6IlNZNEJIWkJnMjdOWDRxR3M5YzkyQ0E9PSIsInZhbHVlIjoiY1Bnd2dOZEVqcFBmZEMzbVVNNXZMeWdkZjVXMlhWaFFCWjVXTVdQWFJWQm9RL2dQQjBBN3dPdytzQVdCRHJESiIsIm1hYyI6IjBkM2Y3MmU1MGUzZGEyNDgyMGEzMWNhMmQyZjllM2JhMDYxN2Y1ZjdjZTcyZDdiNzRmMTViNjdkNzNlMDgwMzAiLCJ0YWciOiIifQ==', 'PayPal application client secret', 1, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(9, 'paypal', 'sandbox_mode', '1', 'Use PayPal sandbox for testing', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(10, 'bkash', 'enabled', '0', 'Enable or disable bKash payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(11, 'bkash', 'api_key', '4f6o0cjiki2rfm34kfdadl1eqq', 'bKash App Key (from bKash merchant panel)', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(12, 'bkash', 'api_secret', 'eyJpdiI6IjRMVmErb2NaczM3OXFDeFZQVWZiakE9PSIsInZhbHVlIjoiZUhFMVo1UjFydWJsZHNHeEhlVkRjYXRsVDZ5Z2F2VDIzdncrQ1RVSzJEMDRacXFXZkRnZjV4WXQ5d1N0cjNobCIsIm1hYyI6IjIxZWJjZGQzODBjYTVhZjJlYWZjZDNmOGE2YTE0MjdhODFmNTUxNGI4YzcyOWJhNmIzNTYyMDUzNTYyYWJkM2IiLCJ0YWciOiIifQ==', 'bKash App Secret (from bKash merchant panel)', 1, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(13, 'bkash', 'username', 'sandboxTokenizedUser02', 'bKash Username (for tokenized checkout)', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(14, 'bkash', 'password', 'eyJpdiI6Ik1aa2QwNFYvOE13a0YzV0Q2dDN2N3c9PSIsInZhbHVlIjoiQlh2Z3d4ekpzbFFaaTkvUGNYbHozSDgyOFNqQzFGVVQ2cThwbVBCR1EwSEIxaWxrbFNTNEkzU3M5eGxLdTNOdyIsIm1hYyI6ImQ5M2U3NjM5OTI5NGVjMTkwZmQ1MWU1ZTE5NTM3ODRjYzhkZDE5YmZiNDAyNTk2MmU3NzZmZDE0N2YwZDQ4NTYiLCJ0YWciOiIifQ==', 'bKash Password (for tokenized checkout)', 1, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(15, 'bkash', 'sandbox_mode', '1', 'Use bKash sandbox for testing', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(16, 'nagad', 'enabled', '0', 'Enable or disable Nagad payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(17, 'nagad', 'merchant_number', '017XXXXXXXX', 'Nagad merchant account number', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(18, 'nagad', 'api_key', 'nagad_test_api_key_1234567890', 'Nagad API key', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(19, 'nagad', 'api_secret', 'eyJpdiI6ImN2b2FxYkhHY2RJM1k2cTg3cVhZc0E9PSIsInZhbHVlIjoianphM0NwM1VhK0ZTUllmZks4YlNxVTFmdDJ4OVJIL2UweE4xcXRuQllxVXZlQjlaQXkxVjhVNGJtNFpURzM3dCIsIm1hYyI6IjhkODAyMTFiZDU5OTUyZGYwNDNkNDRiODgxOTc0NzU0OTFlZWRlYzJkMmMyNzU0YTk2OWE5YjM2YTc4ZTNlOGUiLCJ0YWciOiIifQ==', 'Nagad API secret', 1, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(20, 'nagad', 'sandbox_mode', '1', 'Use Nagad sandbox for testing', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(21, 'rocket', 'enabled', '0', 'Enable or disable Rocket payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(22, 'rocket', 'merchant_number', '017XXXXXXXX', 'Rocket merchant account number', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(23, 'rocket', 'api_key', 'rocket_test_api_key_1234567890', 'Rocket API key', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(24, 'rocket', 'api_secret', 'eyJpdiI6IlVBeFUvY2grNGRtNFM1ajZkeFA1QlE9PSIsInZhbHVlIjoiMmg3ZXppUEZGa2N6WTJEb3ZxekdSMWFYak5aaHBiWXREWGhDOHg1VllBa24yRUYvRll5dWtpNzZsOU5MbkJyOCIsIm1hYyI6IjA5MGI2Y2Y1ZmRjZDIzMmIxYjRiOWZkMTMxMmM5ZGNkNGJlZmQ3YjZjODJjNzJlYzUxYzYxMjE2ZGFkZTcxN2EiLCJ0YWciOiIifQ==', 'Rocket API secret', 1, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(25, 'rocket', 'sandbox_mode', '1', 'Use Rocket sandbox for testing', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(26, 'ssl_commerce', 'enabled', '0', 'Enable or disable SSL Commerce payment gateway', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(27, 'ssl_commerce', 'store_id', 'testbox', 'SSL Commerce store ID', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(28, 'ssl_commerce', 'store_password', 'eyJpdiI6Iklwd0c2OCtWZ00zUit3Q25JODFlMWc9PSIsInZhbHVlIjoiZXNSeUIxb0dMcnYvSmlJTmJsWXVQUT09IiwibWFjIjoiYTU0MjAxOWU4NDBkMDE3OWNhNTc5NzE1YTg0Y2VjZjk4M2NlMDkyZTYzM2JlMmNhN2VkMjZmNzM2YzAyY2Q1NSIsInRhZyI6IiJ9', 'SSL Commerce store password', 1, '2025-11-30 11:08:18', '2025-11-30 11:10:38'),
(29, 'ssl_commerce', 'api_url', 'https://sandbox.sslcommerz.com', 'SSL Commerce API URL', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(30, 'ssl_commerce', 'success_url', 'http://localhost/payment/ssl-commerce/success', 'URL to redirect after successful payment', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(31, 'ssl_commerce', 'fail_url', 'http://localhost/payment/ssl-commerce/fail', 'URL to redirect after failed payment', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(32, 'ssl_commerce', 'cancel_url', 'http://localhost/payment/ssl-commerce/cancel', 'URL to redirect after cancelled payment', 0, '2025-11-30 11:08:18', '2025-11-30 11:08:18'),
(33, 'ssl_commerce', 'sandbox_mode', '1', 'Use SSL Commerce sandbox for testing', 0, '2025-11-30 11:08:18', '2025-11-30 11:10:38');

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
(124, 'admin.datatables', 'admin', '2025-11-30 11:08:15', '2025-11-30 11:08:15');

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
(216, 18, 'Nemo labore quis', 'nemo-labore-quis-KHNEk', 'ZRREZBNP', 'Amet illo eligendi unde libero veniam quas saepe delectus nulla.', 'Quod rerum animi exercitationem. Et aperiam at tempora minus in ut. Adipisci architecto dolorem mollitia odit odio. Beatae sequi aut quia nemo culpa saepe placeat.', '175.29', NULL, 59, 1, 1, 0, NULL, NULL, NULL, '2025-11-30 11:10:37', '2025-11-30 11:10:37');

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
(648, 216, 'products/bfd68700-a858-4933-9931-7f42de0114a2.jpg', 2, 0, '2025-11-30 11:10:38', '2025-11-30 11:10:38');

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
(124, 1);

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
('8qVVnsB0wh0VoHpf5g847WoXtVwG8K0lFRSsZeFE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibjdGaGFId1U4TEU3TWJLd1NjUnNOYmFaVU5NeFUzMEFkTWZrODI4TCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764522922),
('aWzpHNhZz9lhoaevL5MIUiFMcXfVoUbM5VSznKWY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3RYeXBHekJtVDdKNHZoSVhNT29lQU5uNG5wUFlwWjZiN0RhMXhadiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9lY29tbWVyY2UudGVzdCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764522917),
('ddEhB3320wHbT1kvvT4LAnyPj6W7JKBDaVMWMmI3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRGVmcXo5NlhHRGJmYXFsWGo4MDJPNTZ4a3BXMklISmRxckM0R240ZyI7czoxNToiY2FydF9zZXNzaW9uX2lkIjtzOjM2OiI3MDljNDY1Yy0zYzQ5LTQ3YzAtYWI3Ny00YzUyNzNjOTFkMzciO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vZWNvbW1lcmNlLnRlc3QvY2FydCI7czo1OiJyb3V0ZSI7czoxMDoiY2FydC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764522924),
('EpHC5bLrig6o0QAJTqTKiSrRIVdHV14Ox8nU0lpj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZW9wd0doenpNVmtmOUY2bFVQQXlHTmYyZ0JXVWl0Sk9pRHc3Mk5UUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764522921),
('FyDshCKCz5hXj0rnquQ8HB2Rw7PM0OAFx3tXXwp9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiU0hkeTRFbVB1ZEpNZlBDb0oxZFZsNEZaVUlJOVVqSjV0c01UeDdEZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764522921),
('KvKkohkJI9qLCkuYCOFvrx257kMdZ1ZtewNxRew0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQ0E2OTM5cURyMnhCQnVyV0g1dVlSRXBHRFZ5SUV2T3VYN1FCVExURCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764522922),
('LFuntpbSymJ4RdEJi4qX0pWtKkmi0MzHDoeGKSne', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiODJuVHVmc3Y2S0twd3F5eXczTVhBMWpzWXh3d2E3TnQ5U0RSTjZZayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764522920),
('lsNGkUUKKZYVQ8n153bzzW9hbK8S6rBIfDsa4AYY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUnZRNlFPSDA4UkQxdk5nRklPYnJQcDJIN1JJZHB5OU1QWDE5QW5oViI7czo1OiJlcnJvciI7czoxOToiWW91ciBjYXJ0IGlzIGVtcHR5LiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjE6e2k6MDtzOjU6ImVycm9yIjt9fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vZWNvbW1lcmNlLnRlc3QvY2hlY2tvdXQiO3M6NToicm91dGUiO3M6MTM6ImNoZWNrb3V0LnNob3ciO319', 1764522915),
('pk2MloXvW7beAQbGZrsl97Z0Sf3fMzUknXMpCHbU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZHZqZW9rbEMyQktSWUgwM0ZKejNxdG9PVFFvcWxFUE1TWGdHaWF6RSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vZWNvbW1lcmNlLnRlc3QvY2hlY2tvdXQiO3M6NToicm91dGUiO3M6MTM6ImNoZWNrb3V0LnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNToiY2FydF9zZXNzaW9uX2lkIjtzOjM2OiI0Mzk1YTgwNC00ZDE5LTQyZTEtOThiNi05YWE5MDg2Y2RjMDkiO30=', 1764523545),
('qMi4qKTQwI5k4Ha2unKzN1Ino1JRCt8hRTKnbKSV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYlltVEc2eWh6aFN5N01MRnFzTmRwTGhySDJDR2NsOTVWVDJTY0Q1UiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764522919),
('QRYgO029f5PRrKRASxlr7XMS8Cwyqkzf67RJILe6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaTdCWVdScXVEOXgyRzZpYzZPTHdDSEdSRUNrOUY3VDdDOXBYR0cyVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764522922),
('xSbG7WaS7xrq8L2w7HLkF7VDGfvYgSzScmxsawrY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:145.0) Gecko/20100101 Firefox/145.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVDFqckQxdDNlbjNJWDg2bGY0dTNQN3AzM25XMUxpUG1WOUVrMTdaWCI7czoxNToiY2FydF9zZXNzaW9uX2lkIjtzOjM2OiI5Njg4NjU5Yy00MWZmLTQyMWItYTVjZS1jNmU3NDMxNzRmMTMiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vZWNvbW1lcmNlLnRlc3QvY2FydCI7czo1OiJyb3V0ZSI7czoxMDoiY2FydC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764522915);

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

INSERT INTO `site_settings` (`id`, `site_name`, `site_tagline`, `logo_url`, `favicon_url`, `meta_title`, `meta_description`, `meta_keywords`, `footer_text`, `privacy_url`, `terms_url`, `cookies_url`, `help_center_url`, `shipping_info_url`, `returns_url`, `contact_us_url`, `wishlist_enabled`, `reviews_enabled`, `reviews_require_purchase`, `reviews_require_approval`, `reviews_allow_anonymous`, `newsletter_enabled`, `newsletter_double_opt_in`, `newsletter_send_welcome_email`, `social_facebook`, `social_twitter`, `social_instagram`, `social_linkedin`, `product_display_columns_mobile`, `product_display_columns_desktop`, `schema_enabled`, `schema_organization_name`, `schema_organization_logo`, `schema_organization_phone`, `schema_organization_email`, `schema_organization_address`, `schema_organization_type`, `sitemap_enabled`, `sitemap_priority_home`, `sitemap_priority_product`, `sitemap_priority_category`, `sitemap_priority_page`, `sitemap_change_frequency`, `google_analytics_code`, `facebook_pixel_code`, `microsoft_clarity_code`, `custom_head_code`, `custom_body_code`, `created_at`, `updated_at`) VALUES
(1, 'eCommerce Store', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 0, 1, 1, 1, NULL, NULL, NULL, NULL, 2, 3, 1, NULL, NULL, NULL, NULL, NULL, 'Store', 1, 10, 8, 7, 6, 'weekly', NULL, NULL, NULL, NULL, NULL, '2025-11-30 11:08:18', '2025-11-30 11:08:18');

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
(1, 'storage_driver', 'Storage Driver', 'local', 'Storage driver: local, s3, cloudflare, digitalocean, wasabi, backblaze, etc.', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(2, 's3_key', 'AWS Access Key ID', '', 'AWS S3 Access Key ID', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(3, 's3_secret', 'AWS Secret Access Key', '', 'AWS S3 Secret Access Key', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(4, 's3_region', 'AWS Region', 'us-east-1', 'AWS S3 Region (e.g., us-east-1, ap-southeast-1)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(5, 's3_bucket', 'S3 Bucket Name', '', 'AWS S3 Bucket Name', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(6, 's3_url', 'S3 URL', '', 'S3 URL (optional, auto-generated if empty)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(7, 's3_endpoint', 'S3 Endpoint', '', 'S3 Endpoint (for S3-compatible services like DigitalOcean, Wasabi, etc.)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(8, 's3_use_path_style', 'Use Path Style', '0', 'Use path-style endpoint (required for some S3-compatible services)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(9, 'cloudflare_account_id', 'Cloudflare Account ID', '', 'Cloudflare Account ID', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(10, 'cloudflare_access_key_id', 'Cloudflare Access Key ID', '', 'Cloudflare R2 Access Key ID', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(11, 'cloudflare_secret_access_key', 'Cloudflare Secret Access Key', '', 'Cloudflare R2 Secret Access Key', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(12, 'cloudflare_bucket', 'Cloudflare R2 Bucket', '', 'Cloudflare R2 Bucket Name', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(13, 'cloudflare_endpoint', 'Cloudflare R2 Endpoint', '', 'Cloudflare R2 Endpoint URL', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(14, 'digitalocean_key', 'DigitalOcean Spaces Key', '', 'DigitalOcean Spaces Access Key', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(15, 'digitalocean_secret', 'DigitalOcean Spaces Secret', '', 'DigitalOcean Spaces Secret Key', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(16, 'digitalocean_region', 'DigitalOcean Region', 'nyc3', 'DigitalOcean Spaces Region (e.g., nyc3, sgp1)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(17, 'digitalocean_bucket', 'DigitalOcean Spaces Bucket', '', 'DigitalOcean Spaces Bucket Name', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(18, 'digitalocean_endpoint', 'DigitalOcean Endpoint', '', 'DigitalOcean Spaces Endpoint (auto-generated if empty)', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(19, 'wasabi_key', 'Wasabi Access Key', '', 'Wasabi Access Key', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(20, 'wasabi_secret', 'Wasabi Secret Key', '', 'Wasabi Secret Key', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(21, 'wasabi_region', 'Wasabi Region', 'us-east-1', 'Wasabi Region', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(22, 'wasabi_bucket', 'Wasabi Bucket', '', 'Wasabi Bucket Name', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(23, 'wasabi_endpoint', 'Wasabi Endpoint', '', 'Wasabi Endpoint URL', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(24, 'backblaze_key_id', 'Backblaze Key ID', '', 'Backblaze B2 Application Key ID', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(25, 'backblaze_application_key', 'Backblaze Application Key', '', 'Backblaze B2 Application Key', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(26, 'backblaze_bucket_id', 'Backblaze Bucket ID', '', 'Backblaze B2 Bucket ID', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(27, 'backblaze_bucket_name', 'Backblaze Bucket Name', '', 'Backblaze B2 Bucket Name', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(28, 'cdn_enabled', 'Enable CDN', '0', 'Enable CDN for serving static files', '2025-11-30 11:07:23', '2025-11-30 11:07:23'),
(29, 'cdn_url', 'CDN URL', '', 'CDN URL (e.g., https://cdn.yourdomain.com or Cloudflare CDN URL)', '2025-11-30 11:07:23', '2025-11-30 11:07:23');

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
(1, 'Test User', 'needyamin@gmail.com', NULL, NULL, '$2y$12$FFu/.FQMgHOQijeuZ8X92O.yNyoDDU/t5FAxBBnzZ63r1H8krISam', 0, NULL, NULL, '2025-11-30 11:08:14', '2025-11-30 11:08:14', NULL);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `coin_settings`
--
ALTER TABLE `coin_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_codes`
--
ALTER TABLE `otp_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_settings`
--
ALTER TABLE `otp_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_gateway_settings`
--
ALTER TABLE `payment_gateway_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=649;

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
