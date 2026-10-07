-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 07, 2026 at 06:50 AM
-- Server version: 11.8.9-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u593703731_ramratan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$12$xHd2TdjsIcJgT0SpvVKJKuMZnzt9XTM9by6bgPISBp4xu58cE5TLO', '2025-09-15 22:45:52', '2025-09-15 22:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `tenant_id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(4, NULL, 'Ring', 'rings products', 'This is the best product here', '2025-09-22 03:44:38', '2025-09-22 03:44:38'),
(5, NULL, 'Bracelets', 'Platinum Bracelets products', 'This is the subcategory product  Bracelets', '2025-09-23 23:05:01', '2025-09-23 23:05:01'),
(6, NULL, 'Necklace', 'Necklace Products Best', 'This is the necklace product', '2025-09-23 23:15:03', '2025-09-23 23:15:03'),
(7, NULL, 'Ear Ring', 'Earring product', 'Testing', '2025-09-24 07:01:26', '2025-09-24 07:01:26'),
(8, NULL, 'Pendants', 'Pendants Product', 'testing', '2025-09-24 07:01:59', '2025-09-24 07:01:59'),
(9, NULL, 'Solitaires', 'Solitaires Product', 'testing', '2025-09-24 07:02:32', '2025-09-24 07:02:32'),
(10, NULL, 'Gold Coins', 'Gold Coins', 'test', '2025-09-24 07:03:08', '2025-09-24 07:03:08');

-- --------------------------------------------------------

--
-- Table structure for table `costum_forms`
--

CREATE TABLE `costum_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `costum_forms`
--

INSERT INTO `costum_forms` (`id`, `name`, `contact`, `description`, `images`, `material`, `created_at`, `updated_at`) VALUES
(1, 'Abhishek', '6437563363', 'test', 'images/1760675108.jpg', 'gold', '2025-10-16 22:55:08', '2025-10-16 22:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `min_purchase` decimal(10,2) NOT NULL DEFAULT 0.00,
  `expires_at` datetime DEFAULT NULL,
  `max_usage` int(11) NOT NULL DEFAULT 0,
  `usage_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `min_purchase`, `expires_at`, `max_usage`, `usage_count`, `created_at`, `updated_at`) VALUES
(6, 'ewrwewe', 'fixed', 334324.00, 0.00, '2025-09-27 17:09:00', 0, 0, '2025-09-24 06:09:12', '2025-09-24 06:09:12');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manage_bvs`
--

CREATE TABLE `manage_bvs` (
  `id` int(11) NOT NULL,
  `slider_image` varchar(255) DEFAULT NULL,
  `mines_video` varchar(255) DEFAULT NULL,
  `during_video` varchar(255) DEFAULT NULL,
  `gallery_video` varchar(225) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_bvs`
--

INSERT INTO `manage_bvs` (`id`, `slider_image`, `mines_video`, `during_video`, `gallery_video`, `created_at`, `updated_at`) VALUES
(1, '[\"693bad00d278a_1765518592.jpg\",\"693bad00d2a48_1765518592.jpg\",\"693bad00d2c8b_1765518592.jpg\",\"6a981ed5beda5_1788354261.jpeg\",\"6a981ed5bfa9d_1788354261.jpeg\",\"6a981ed5c037c_1788354261.jpeg\",\"6a981ed5c0a06_1788354261.jpeg\",\"6a981ed5c1815_1788354261.jpeg\"]', '[\"693bad00d2ee8_1765518592.mp4\",\"693bad00d488f_1765518592.mp4\",\"693bad00d6382_1765518592.mp4\",\"693bad00d7965_1765518592.mp4\",\"693bad00d9288_1765518592.mp4\",\"693bad00da2ae_1765518592.mp4\",\"693bad00dbbf8_1765518592.mp4\",\"6a982453e7bbc_1788355667.mp4\"]', '693bad1dd5516_1765518621.mp4', '693baf9086a55_1765519248.mp4', '2025-12-12 05:49:52', '2026-09-02 13:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '2025_09_15_083741_create_users_table', 1),
(3, '2025_09_15_124009_create_admins_table', 2),
(4, '2025_09_16_061047_create_tenants_table', 3),
(5, '2025_09_16_061208_create_users_table', 3),
(6, '2025_09_16_061503_create_categories_table', 3),
(7, '2025_09_16_061630_create_products_table', 3),
(8, '2025_09_16_061750_create_product_variants_table', 3),
(9, '2025_09_16_061920_create_variant_options_table', 3),
(10, '2025_09_16_062035_create_locations_table', 3),
(11, '2025_09_16_062126_create_inventories_table', 3),
(12, '2025_09_16_062226_create_coupons_table', 3),
(13, '2025_09_16_062342_create_orders_table', 3),
(14, '2025_09_16_062507_create_order_items_table', 3),
(15, '2025_09_16_062640_create_payments_table', 3),
(16, '2025_09_16_062736_create_shippings_table', 3),
(17, '2025_09_16_062850_create_cart_items_table', 3),
(18, '2025_09_16_063012_create_reviews_table', 3),
(19, '2025_09_16_064324_update_tenant_id_nullable_in_tables', 4),
(20, '2025_09_16_080254_make_category_nullable_in_products_table', 5),
(21, '2025_09_16_080728_make_name_nullable_in_variant_options_table', 6),
(22, '2025_09_16_082242_make_product_variant_id_nullable_in_variant_options_table', 7),
(23, '2025_09_16_110109_add_columns_to_products_table', 8),
(24, '2025_09_25_050118_create_subcategories_table', 9),
(25, '2025_09_25_062919_add_size_to_product_variants_table', 10),
(26, '2025_10_16_110744_create_price_settings_table', 11),
(27, '2025_10_16_124942_create_costum_forms_table', 12),
(28, '2025_10_18_070938_create_price_breack_downs_table', 13),
(29, '2025_10_29_085634_create_wish_lists_table', 14),
(30, '2025_12_01_090908_create_manage_bvs_table', 34),
(31, '2025_12_04_065723_create_pricebrdowns_table', 35);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `shipping_address` text NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `status`, `total_amount`, `payment_status`, `shipping_address`, `coupon_id`, `discount`, `created_at`, `updated_at`) VALUES
(27, 5, 'ORD-20250924-68D3D1A1542CB', 'paid', 32700.00, 'paid', 'ballia', NULL, 0.00, '2025-09-24 05:40:25', '2025-10-30 05:16:47'),
(28, 5, 'ORD-20250925-68D4CAD96B541', 'pending', 20700.00, 'unpaid', 'ballia', NULL, 0.00, '2025-09-24 23:23:45', '2025-09-24 23:23:45'),
(29, 5, 'ORD-20250925-68D513E4CF41C', 'pending', 6700.00, 'unpaid', 'ballia', NULL, 0.00, '2025-09-25 04:35:24', '2025-09-25 04:35:24'),
(30, 5, 'ORD-20251015-68EF91089E243', 'pending', 4700.00, 'unpaid', 'ballia', NULL, 0.00, '2025-10-15 06:48:16', '2025-10-15 06:48:16'),
(31, 5, 'ORD-20251023-68F9C02C7D28C', 'pending', 9880.00, 'unpaid', 'ballia', NULL, 0.00, '2025-10-23 00:12:04', '2025-10-23 00:12:04'),
(32, 5, 'ORD-20251029-6901E828691D9', 'pending', 9880.00, 'unpaid', 'ballia', NULL, 0.00, '2025-10-29 04:40:48', '2025-10-29 04:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(27, 28, 25, 1, 20000.00, '2025-09-24 23:23:45', '2025-09-24 23:23:45'),
(28, 29, 30, 1, 3000.00, '2025-09-25 04:35:24', '2025-09-25 04:35:24'),
(29, 29, 30, 1, 3000.00, '2025-09-25 04:35:24', '2025-09-25 04:35:24'),
(30, 30, 27, 1, 4000.00, '2025-10-15 06:48:16', '2025-10-15 06:48:16'),
(31, 31, 24, 1, 9180.00, '2025-10-23 00:12:04', '2025-10-23 00:12:04'),
(32, 32, 24, 1, 9180.00, '2025-10-29 04:40:48', '2025-10-29 04:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `oredr_supports`
--

CREATE TABLE `oredr_supports` (
  `id` int(11) NOT NULL,
  `order_id` bigint(11) DEFAULT NULL,
  `user_id` bigint(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('1','2') DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `oredr_supports`
--

INSERT INTO `oredr_supports` (`id`, `order_id`, `user_id`, `message`, `status`, `updated_at`, `created_at`) VALUES
(1, 37, 6, 'Hi', '1', '2025-11-11 06:20:17', '2025-11-11 06:20:17'),
(2, 37, 6, 'hello', '2', '2025-11-11 06:21:21', '2025-11-11 06:21:21'),
(3, 37, 6, 'what is ur query?', '2', '2025-11-11 06:31:26', '2025-11-11 06:31:26'),
(4, 37, 6, 'hello maam', '1', '2025-11-11 06:31:46', '2025-11-11 06:31:46'),
(5, 37, 6, 'hiiii', '2', '2025-11-11 06:37:19', '2025-11-11 06:37:19'),
(6, 37, 6, 'hello maam', '1', '2025-11-11 06:37:30', '2025-11-11 06:37:30'),
(7, 37, 6, 'hiii', '2', '2025-11-11 06:37:44', '2025-11-11 06:37:44'),
(8, 29, 5, 'hello', '1', '2025-12-11 23:30:52', '2025-12-12 05:00:52'),
(9, 29, 5, 'yes', '2', '2025-12-11 23:31:06', '2025-12-12 05:01:06'),
(10, 29, 5, 'kya haal hai', '2', '2026-05-30 09:05:18', '2026-05-30 09:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pricebrdowns`
--

CREATE TABLE `pricebrdowns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `material` varchar(255) DEFAULT NULL,
  `material_price` varchar(255) NOT NULL,
  `making_price` varchar(255) NOT NULL,
  `brdiscount` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pricebrdowns`
--

INSERT INTO `pricebrdowns` (`id`, `product_id`, `material`, `material_price`, `making_price`, `brdiscount`, `tax`, `created_at`, `updated_at`) VALUES
(1, '24', 'gold', '1000', '650', '654', '56', '2025-12-04 03:46:53', '2025-12-04 03:46:53'),
(2, '32', 'gold', '134', '145666', '4', '10', '2025-12-04 06:03:59', '2025-12-04 06:03:59'),
(3, '33', 'gold', '4335', '34', '5', '5', '2025-12-04 06:08:12', '2025-12-04 06:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `price_settings`
--

CREATE TABLE `price_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `gst` varchar(255) DEFAULT NULL,
  `making_charges` varchar(255) DEFAULT NULL,
  `purity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_settings`
--

INSERT INTO `price_settings` (`id`, `name`, `price`, `gst`, `making_charges`, `purity`, `created_at`, `updated_at`) VALUES
(1, 'Ring', '200', '3', '1000', '[\"24K\",\"22K\",\"18K\"]', '2025-10-16 06:12:07', '2025-10-16 06:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `purity` varchar(255) DEFAULT NULL,
  `net_weight` varchar(255) DEFAULT NULL,
  `gross_weight` varchar(225) DEFAULT NULL,
  `diamond_weight` varchar(255) DEFAULT NULL,
  `stone_weight` varchar(225) DEFAULT NULL,
  `silver_weight` varchar(225) DEFAULT NULL,
  `gold_weight` varchar(255) DEFAULT NULL,
  `dimensions` varchar(225) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `original_price` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `show_product` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gallery_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery_images`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `type` varchar(225) DEFAULT NULL,
  `hylighter` text DEFAULT NULL,
  `hylighter_two` text DEFAULT NULL,
  `mrptext` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `product_video` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `tenant_id`, `category_id`, `name`, `slug`, `description`, `purity`, `net_weight`, `gross_weight`, `diamond_weight`, `stone_weight`, `silver_weight`, `gold_weight`, `dimensions`, `price`, `original_price`, `stock`, `show_product`, `image`, `gallery_images`, `created_at`, `updated_at`, `color`, `type`, `hylighter`, `hylighter_two`, `mrptext`, `discount`, `product_video`) VALUES
(24, NULL, 4, 'Silver Ring', 'silver-ring', '<p>This is the silver ring good looking this product This is the silver ring good looking this product&nbsp;</p>', '24KT', '80.00g', '100g', NULL, NULL, NULL, NULL, NULL, 5637.67, '6632.55', 10, 'new_arrival', 'uploads/products/1764840368-693153b0e5a4b.jpg', '[\"uploads\\/products\\/gallery\\/1758533161-68d11629e319e.jpg\",\"uploads\\/products\\/gallery\\/1758533161-68d11629e37ff.jpg\",\"uploads\\/products\\/gallery\\/1758533161-68d11629e3c26.jpg\"]', '2025-09-22 03:47:14', '2025-12-04 05:54:39', 'Yellow', 'Gold', NULL, NULL, NULL, '15', NULL),
(25, NULL, 4, 'Golden Ring', 'golden-ring', '<p>This is the best gold ring it is bright and shining looks&nbsp;</p>', '24KT', '100grm', '80grm', NULL, NULL, NULL, NULL, NULL, 20000.00, '20000.00', 6, 'top', 'uploads/products/1758687069-68d36f5d1adab.jpg', '[\"uploads\\/products\\/gallery\\/1758687069-68d36f5d1b51d.jpg\",\"uploads\\/products\\/gallery\\/1758687069-68d36f5d1bb7b.jpg\"]', '2025-09-23 22:41:09', '2025-10-18 00:27:59', 'Silver', 'Silver', NULL, NULL, NULL, '0', NULL),
(26, NULL, 5, 'Platinum Bracelets', 'platinum-bracelets', '<p>This Is the best Platinum Bracelets color shilver</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5000.00, NULL, 30, 'new_arrival', 'uploads/products/1758688587-68d3754b02c78.jpg', '[\"uploads\\/products\\/gallery\\/1758688587-68d3754b0341d.jpg\",\"uploads\\/products\\/gallery\\/1758688587-68d3754b039b3.jpg\",\"uploads\\/products\\/gallery\\/1758688587-68d3754b03fc6.jpg\"]', '2025-09-23 23:06:27', '2025-09-23 23:06:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, NULL, 6, 'Golden Necklace', 'golden-necklace', '<p>It is the best product for necklace groups</p>', '18KT', '300gm', '400gm', NULL, NULL, NULL, NULL, NULL, 3880.00, '4000.00', 4, 'new_arrival', 'uploads/products/1758689205-68d377b53f591.jpg', '[\"uploads\\/products\\/gallery\\/1758689205-68d377b53fd90.jpg\"]', '2025-09-23 23:16:45', '2025-10-18 00:16:35', 'Yellow', 'Gold', NULL, NULL, NULL, '3', NULL),
(28, NULL, 6, 'Silver Necklace', 'silver-necklace', '<p>A necklace is <strong>jewelry you wear around your neck</strong>. You might decide your sparkly faux-diamond necklace is a bit dressy for your cousin\'s baseball game — but perfect for a fancy dinner out. A necklace can be a simple gold or silver chain, a length of beads or gems, or a pendant hanging from a cord.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 900.00, NULL, 5, 'new_arrival', 'uploads/products/1758689950-68d37a9e6461a.jpg', '[\"uploads\\/products\\/gallery\\/1758689950-68d37a9e64be6.jpg\",\"uploads\\/products\\/gallery\\/1758689950-68d37a9e6513d.jpg\"]', '2025-09-23 23:29:10', '2025-09-24 06:55:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, 5, 'Bangels', 'bangels', '<p>Page layouts look better with something in each section. Web page designers, content writers, and layout artists use lorem ipsum, also known as<a href=\"https://mailchimp.com/resources/how-to-design-a-beautiful-website/\"> placeholder copy</a>, to distinguish which areas on a page will hold advertisements, editorials, and filler before the final written content and<a href=\"https://mailchimp.com/resources/how-to-design-a-beautiful-website/\"> website designs</a> receive client approval</p>', '22KT', '150grm', '200grm', NULL, NULL, NULL, NULL, NULL, 2700.00, '3000.00', 10, 'new_arrival', 'uploads/products/1758789307-68d4febb2cc3e.jpg', '[\"uploads\\/products\\/gallery\\/1758789307-68d4febb2d68b.jpg\",\"uploads\\/products\\/gallery\\/1758789307-68d4febb2e1c7.jpg\",\"uploads\\/products\\/gallery\\/1758789307-68d4febb2e6b5.jpg\"]', '2025-09-25 03:05:07', '2025-10-18 00:17:48', 'Yellow', 'Gold', NULL, NULL, NULL, '10', NULL),
(33, NULL, 4, 'Silver Ring', 'silver-ring-1', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabouia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur</p>', '23', '10grm', '200grm', '2grm', '100grm', '10grm', '5grm', NULL, 160960.83, '167667.53', 4, 'top', 'uploads/products/1764852556-6931834cd4360.jpg', '[\"uploads\\/products\\/gallery\\/1764849191-693176278a62d.png\",\"uploads\\/products\\/gallery\\/1764849191-69317627abaa9.jpg\"]', '2025-12-04 06:08:12', '2025-12-04 07:25:30', 'Silver', 'Silver', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo', '1000', '4', '[\"uploads\\/products\\/video\\/1764848292-693172a4a2a9b.mp4\",\"uploads\\/products\\/video\\/1764849677-6931780d0c235.mp4\",\"uploads\\/products\\/video\\/1764849677-6931780d0de83.mp4\"]');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `size`, `product_id`, `sku`, `price`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(32, NULL, 26, 'Platinum Bracelets sine', 1200.00, 12, 'uploads/variants/1758688587-68d3754b07c64.jpg', '2025-09-23 23:06:27', '2025-09-23 23:06:27'),
(39, NULL, 28, 'SKU-E8HR2I-1-1', 0.00, 0, NULL, '2025-09-24 06:55:41', '2025-09-24 06:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0LucuZcjme9R4BiLxEwagcDOLiMAENP8RmbnFrlY', NULL, '2a02:4780:28:50c8::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1JtRFlrUnMwY2lpaTRnZVdKZEt5NlI3ZnJqYUFpN21OSG5TNmZpVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763547532),
('1ozqB1hHYousMupMUTjHHDS98085u3409Jzdr5Qg', NULL, '2604:a880:800:10::d54:f001', 'Mozilla/5.0 (l9scan/2.0.53836663a3136366a393636613a336831356a356235666a35343a303837343a323031623; +https://leakix.net)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2tNdGhPY0hRSURPU2txamU1SWlHWnJwbHpkakxLYmJVOHo5TW1PaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763659682),
('3WDDcKkIkzqifGUIHBTR2rIEjYLPBSkxfCQHQGnT', NULL, '103.4.251.17', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTF5SGkxa0FxOElvU3g5WXR4QWVoOWl0VEx4Y1AzUWFwWlNqQjdPdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763692119),
('49lJsUHYe5Q2OqB0eIODRWU3dP9tpGixYRhBgt4f', NULL, '35.74.21.184', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/91.0.4472.124', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib0hiNlVrUFMwR2s2NVlCUXlNdjNvZTRTVnAwazIwclBmNWFKYWxMbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763710234),
('4xAZ4HbFS4raK9gkwMJ7irwkkqS5eOaIqKPPQlug', NULL, '34.60.242.248', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFdMMTNLbGduMWhiZHlwbkNvc3haOEYwdjg4UXM5VzZESFhRSHFzUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763574285),
('6g4QF9MLRPRTG4PwQrpeFkSDVsx4Nzycqq8QGBmZ', NULL, '195.164.49.145', 'Mozilla/5.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTNtMHZ5UHF1aExucG9LM3J6cXlrWnNCcmd5ZzJrOFlmeE1oc0dCaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763673137),
('6LakNBBspk91zhUhfYl7imY5TVzCq6vlVmPl2wYe', NULL, '34.34.72.221', 'Scrapy/2.13.3 (+https://scrapy.org)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0hzN3JJZ1BQS2FmZlRVcGNVdTBvUUp1WnRRZFFuTUZsWXRTNXdoUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763520293),
('7D97bdG7Ia3hFYG1oSBKZmMTDYAZU96S7EUHF456', NULL, '2a03:b0c0:3:d0::402:d001', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzV2Mm04dWNBMXRlbEZuTDBteWNBbzFya2hURkFLR3J5eG5ua2dtVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763659681),
('89t3yoxaVSJ9H9PUcRZbM8MvPWZ4VnxXZ6f0f78T', NULL, '2604:a880:800:10::d54:f001', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOE53TUhMNTFNbWlZWUlTMVJqeThnYTNVMFVRMzlRSGlXc080NFhUOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763659681),
('8wuVkKyfsrpRckYLFjUeaHcmU9cydqgcbyYQ2Ei7', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSE5vaHhpVWdDQUh6bTkyZ1FRUGZQRnFxQUJEMk9tRDdaTmlWWDVEbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763349017),
('AD6Su0dTmUPGqh7aBRvT2JO2OG7UHfBQWhokBMge', NULL, '78.83.108.126', 'Mozilla/5.0 (compatible; WPHunt/1.0; +https://wphunt.com/bot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTZ4N2lPYVNqNUpwNEE0RFpzVFAzVVFGaDdSMURySGlmc29ka0x6UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763697691),
('AITtTKdyrYWt6kYpSVJhONW615996HCUqiCFb1yd', NULL, '2a14:7c1::2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDM4a2hBeUdEOGVHNnd6VTdBNkNySHRnVVNLa3VqNkxkaVRLaUJhTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763568623),
('BMlpRoFnU4uAbfvfVpvekbxtwZvGoaJp0xvyp9PC', NULL, '2a03:b0c0:3:d0::1413:d001', 'Mozilla/5.0 (l9scan/2.0.63469313a363269383a326466326a366031653a313366616a33343a303837343a323031623; +https://leakix.net)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDZXT3Yyd083eUZ1dHp6dGR1MGxTZkpPMklVOTBqRDBlb0l5VWpHQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763547530),
('BV4K20TB152VcQwMueNPEk05aGPMkGGGVMOSPNxX', NULL, '2405:201:a40b:89dd:7564:8d0a:1b8b:ded0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUtGa0hBRmE4cWx4U0JuM3pVZk1HVzVRdnlnNHlURW1zaFVVRG1lVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763528943),
('carBU9vMiFfVEe2fFPCJGZR4P9LWaIkpTLudBP0f', NULL, '3.89.108.182', 'okhttp/5.3.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWdkMDVBTjI3QlpSZ0xUTU04SjBxMFcxT3JnWDBUWFhqRE52RG82OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763549559),
('Cb6NACgQS0GOl6dCSOn1qgsapMBx5FGjPDTwWvvh', NULL, '128.192.12.115', 'Mozilla/5.0 (compatible; UGAResearchAgent/1.0; Please visit: NISLabUGA.github.io)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieUxzSkRCR3h1QzFKVWdaZ1lsTGZXalh4cWIxd1dxSUx0YkhxUkF0RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763664134),
('cOwOLlTyJX12AXS1v8XXgFXctdbgHwobMKPjaNGm', NULL, '2401:4900:7158:a31b::238:1ba2', 'Mozilla/5.0 (Linux; Android 8.1.0; SAMSUNG SM-G615F Build/M1AJQ) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/7.2 Chrome/59.0.3071.125 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicE1ac2lQNHBNUUxyRVBwek9BU1ZTdHl6UGg5Y0lNdlFqWEtYSVgzSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763019578),
('DRtHmaardvDho1dbtYPuOHWVR2LK2x7goJt3JIit', NULL, '2405:201:a40b:83eb:5cd0:3ace:dd4:ab04', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGNCeXoySVB4em9QUzhsZ0pOWFVxSjRtYmQyMmtUOUhtZk40UHRaQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763450583),
('EgebSFEG4fkrdfVJKc1BiFjtNUSOV2zQ2Mu2D5GN', NULL, '78.83.108.126', 'Mozilla/5.0 (compatible; WPHunt/1.0; +https://wphunt.com/bot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFlmUFhmZFYzODJiZWkzQkIySzlBVk1Za3VkTTRsQnhPUXVrVG1wRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763697696),
('fPi4k3peEYk4iKasmuEwW7p8WiXrMQKOYvm4ILIY', NULL, '78.83.108.126', 'Mozilla/5.0 (compatible; WPHunt/1.0; +https://wphunt.com/bot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVh5RlVRMHF4MmFPR0Y5aUNPc0I3Y1hNYlVpb042RHAzcmQ3ZDVpbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763697686),
('FUat5TZX1EbO9maYcZ3uYvXURcMtud7CT2CoigKo', NULL, '2401:4900:88a2:7850:edb9:8684:2b92:3703', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZkd0WVpoYk9wdGxiUTFHaWZYVGh6UEJDZG04alN6RzdBdVdaa1hhYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1762968987),
('FZqQloixXthB044u0rBLNmgBiWtPyoXxTgQf7cM2', NULL, '2a03:b0c0:3:d0::14a4:1001', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWlaTE02M0h5Y3NNa0xiWUwxcm1MMnQ5UHdRT3A5ZTNRUEw0cXpnayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763547528),
('GielAI4tzNJhQ1kxfFELKflgzRqN74hdRb7Omchb', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEdDaHpNcjhPQ01ab3JFd0NseU42dURUNDFhRmVXMmdjM0J1RE9vUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763012643),
('HduiO1rmYdbwbNJT3vTxQXoYk3VkZTAsMHUUyLCe', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNThpS2N5YTRYTFFoY294RmprTDhKVmxaRmRBRUVua1dVcHFRWDBSRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763086604),
('IKYcftS12yKiFkq8iWAAgh3KUTctrN6nZJ6SjsRr', NULL, '2a03:b0c0:3:d0::1413:d001', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkF5dkowcE9PcmZxczQ1aXFRNmdmdm1lS1ZMdExiQUFRVUREaXRTSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763547529),
('ixFGwhO7AUr8YPPAoLPCs5mTdGq3CGDhVKC8rIMH', NULL, '2a03:b0c0:3:d0::14a4:1001', 'Mozilla/5.0 (l9scan/2.0.46666616a363032636a3363693a336236613a313733643a35343a303837343a323031623; +https://leakix.net)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR09yS2tNYmFDMUpMV3l4RTZ2bVd3clIxTTRBMThTdExZYjdnd0szNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763547529),
('JewROYKnzIP2loZScTQu5SKzxSZ6TFP1cWYBQPQE', NULL, '103.4.251.17', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTlZQmw2MUl3cVpiTk9IbDBoMEc3OGhxQnNWN3UwaUY5UEtyREtCVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763692105),
('kCYV7KQOve9IrEGrMNzhS2Y34liRUDhrV3LgHMlr', NULL, '35.237.241.95', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2xIWkNaT0lsbmhDOEhQSjVSWnZQbWdRMmdBaHJSak5WNXpHNzNSZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763644518),
('lCc88lOC93ngIo6cPwkBx2toNW09bYN1bcSwzwj6', NULL, '2401:4900:88a3:593c:4c72:2072:7280:8d1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZVdYRXhXZjVQdU9aMFV5SEwxelN2aVZEYVhuUWRYWDl5cm9vVjQzTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763576292),
('mCLgstlWj95zoVBRBobMmAeme4jChY0FTNH20mIN', NULL, '78.83.108.126', 'Mozilla/5.0 (compatible; WPHunt/1.0; +https://wphunt.com/bot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVpsM3l0dENibEFLYUtjcUE3WE53T0ZCU0VsbkFHaERZZEVxSjUxRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763697692),
('mjCCNtuA3Zyg5urlGpsqXMR27tLxs1tV5jOxnH3a', NULL, '195.164.49.145', 'Mozilla/5.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidXdEVkU4U0J6ZGFXU0VXQkF2amc0dG1MVmNTQVpScDhmdHpwYWJURiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763713324),
('MvjNDHSrQyc1gLIu7CWgRcfAmeJe8s21Kiea2xuC', NULL, '63.33.43.146', 'Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienFmRVcxcnUwTzZHbkRyV3hYRTc4TEhualNobnhhVGg1ZkRRYTVjYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763438707),
('O04MRYxZ4EGUtjcM2iqgNNIixPXGgllkCzGVJego', NULL, '106.192.111.194', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHh5TWtxZmFlODJ5dmNrQ0FSOVg1OGUxRDR1STlibnduQm5mNHNEQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763661857),
('oAEOghYSCbFB7j6ly9znzvwk4Beq3RKuIm4DANYc', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiME5BWndHUXU3WkpaMkVOd1AzTFUxdVRZR00yMWxkc3lrOUppZ0RFTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763453356),
('oe0wJlsLtLwnI6GtXpPvDv55xDtWOiHJeLM9WIWs', NULL, '78.83.108.126', 'Mozilla/5.0 (compatible; WPHunt/1.0; +https://wphunt.com/bot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkNINFo3M0d0cnQySVlFNkFhUHl0N3JTMThlYVhrbFFROHYwVHhSUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763697692),
('oGLHMIf2NPKLjfVSEaCKj9tXrfma5rZyMUrijAXE', NULL, '78.83.108.126', 'Mozilla/5.0 (compatible; WPHunt/1.0; +https://wphunt.com/bot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXFYa2J1bXlOaXliemtCb2xsanBaSXpENmtieTZlWUVOVDVGYXY3dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763697693),
('OQ0lEluR4uOztyTVstPDONNLhTbNWfsGAv2zA2uX', NULL, '104.164.173.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibHJuNVNBbDhmQktOdWVzRU1jOFN1emxuczI0UmNwQ2NoMUU0bkhlSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763692111),
('OstnVtqr1Im6oVtFHlhQAtbXFjL9Dp3jOVnRLQSH', NULL, '66.249.65.204', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEUwVWsxelFDWW5zNXlLRDM1ajRjeVNaMDk0RjNyd25oZTdEcEpMVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763350852),
('OXn9abZSxoPcgS0JMHJfcEDhtZ9ufywzsgpo3f62', NULL, '3.80.61.171', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXBoU0dwSlBDazVPazdVaUxtcllSc29tcDN6RmlmTDRxWEJ3OWFoeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763568298),
('oYwuwk2DLY2LvkQJWKBy9sqhCxluB1Q7qyrccjpY', NULL, '195.164.49.145', 'Mozilla/5.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTJYTFlmUXdIeWpaWVJDblgwMUFvRzJaeURaTnlFOGtka1lrNTVIMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763654822),
('Q4zIBEGXxVKdJo4tHpiPrdbDtlpkIEeUyWDCUvaW', NULL, '34.241.206.134', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/91.0.4472.124', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzlLeGhoTDk3cVh0YVhZbTNGN0ZGYzY0am9FR0xod3BSUUZhVVdrTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763054912),
('Q9d1HyFMK9W86XKH0ohGkFSklUmC30ulFwpbkMX3', NULL, '35.240.185.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMk9leVlnNzJzUHNJR0JsejBSNzN6VFVmNHQ4U1RyWXVkd2xDTklsdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763679665),
('qg7vIShPByJUaItg3JSs2KpXg41IWNe8g1QcdtVR', NULL, '66.249.65.204', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVhmbW9wUGxIbDBvUkpUNEVLN29GeGJva3FTZnZQUjg5TUk3clJuSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763350852),
('qUbndSw2EfQ0g8t7NpIMIZWPTTUIIi3nA3s4yc9B', NULL, '98.98.47.149', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUJIcnBvWHhyeUVvQ0lnSlB2U0padFdBZnJTQ1JpczRvY0FLTFg4RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763642320),
('r8QjrnNhiBXEmVmCeeUpuArQi2kuBflZ7rW0Z0oV', NULL, '35.193.205.197', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFA0d2x3V0pYemNRb2VSWVNKZVFjUDJrWFZsb1FGRk5oTG95U2V0ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763642766),
('Rd6hqy1uSlzoeeTDjmdKXob34Q1ow3SotdbYA2co', NULL, '54.209.176.124', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOGNNQXBwcHVYQmlCTzFjUHlNbzZZampETXI2aDdVSXpzaUxpVDdONSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763664862),
('RZBMwr6PDtvv5RgtIr79hV6CF8Fe32ZZPxTnFP7X', NULL, '159.203.143.100', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEVTTmVIVTdFem5YOU5qNDc0RktVYklaN3c3czY5c1o4QXBMQVpOOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763286601),
('SV6x13YCxX1O1YGx9Y2NQWMFjsI4qCN7bjqpAlII', NULL, '2405:201:a40b:83eb:8911:6fc5:3bfa:de31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFR0Snk0cjVrWnlQWHl5dzU1YWJFRFhiSVdEWXB0amt4Q1VyQXZHWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763368072),
('tOCEbhmYjFGSoBnjdIy83JXjqV6D9B8n1B7uW9q5', NULL, '13.218.23.214', 'okhttp/5.3.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidExqdGo3QkRuR01HeWN6MFJVd1pRNGVDcWl3VmV6RFZ3SVhKdEU2cyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763548839),
('ttxEKEiGJQkEid4V8DozpksTvGvAlgfxwMapc97x', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0NwWWRsNjlHUEtzUHpwa2pHa3R2MXBrQlpyNHdORDRYMm1hR0NEbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763196703),
('ULFjQ0sumPkbOrnuBSnHJvB8anD60rpOl95cWA2V', NULL, '2401:4900:88a2:7850:6cb5:6f2:bce9:c8af', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGxhRElrRUtGZzNFSTlnb0dBbHYwa3pjeEM0NnhYeDBVUHM2RkhNTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763144294),
('WaAaX309hjOGVRL0UaAPqByTSiseHsik5WYrTYez', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic1NZS0lkVEh3ZmVxNGJGb1dQYkE5T1RIMTd1RmNkVEY1dDNNREdxMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763290794),
('WYQAkc8ZkkHheUqyihPb0UqXTTwNI3xSCcYKNHdo', NULL, '206.189.130.39', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2gwYTY4ZzltVnMxTkNzcHUyQ2VSdkd2SWRFQThib01qaE41U0p0ViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763645759),
('XHo4b5WrsKQHjDOKiZh2ILOdPGUBMZuM2VVNlJfF', NULL, '195.164.49.145', 'Mozilla/5.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibDJaY0hvTHRQeDAybk9taHFpMWxEdUdVc2g4VWd6THY3cHI1Sk82RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763650415),
('xRpLptvRsQUG6CEHmdfSzpJM1uZjvPyWYZTngP62', NULL, '66.249.65.193', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.7390.122 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHZzWnp1V3R6dkY1QTZnVks5dnB1bDQ5bGZhdTVQVjF0SkRTT0RlWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763350837),
('y0l0VrkY2FPPkIJyfHvgVAqhurWKWHgfChF0c9Bb', NULL, '136.112.142.168', 'Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibEJJb0tscDhWekthVzFoY0IyQnUzZ0lDSXVKejBKWG44Y3VUR1NNWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763560235),
('yTmxLtWgmEyjrIvlGf3EbFQ7Kj4bMggJKxL39Wa6', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZW00QktDdEZHc2VwMlN0bzRuRWdwZEpyMWZnN0R5Q3FudzhFa1l1QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763521053),
('yYyXkvgXwzBCC1ow5b7WY5i7gM9F5fqjsNXKBmep', NULL, '2405:201:a40b:83eb:5ded:12f2:3c3e:14ac', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUJDZjd4WENrQ3kwTlJsSXlvdzdNV2o0cTdKMlJzS1hsMll3Ylo5VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763713712),
('zL7KFbu6SzAsn90ZXjRoJDoNzEREwsIMfVwWdLpl', NULL, '2a03:b0c0:3:d0::402:d001', 'Mozilla/5.0 (l9scan/2.0.03634373a313262393a356268336a353366373a383262353a33343a303837343a323031623; +https://leakix.net)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieW5oTndWeHBQZHFFRlVEbjg1WWlvVHdoYTdzdzhaRTZ3NFp3MkhHVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763659711),
('zmCed44rd8R3TyvLQlMmKnWb6d0FO8tChI4umCGM', NULL, '2a02:4780:11:c0de::e', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGx4VEk2TUtVMVNvYUtJaUM4dU9kUHBlT2VGTkwydExFZFM2VDAzdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vcmFtcmF0YW4uZmlsbGlwc29mdHdhcmUuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763609733);

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `courier_name` varchar(255) NOT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `shipped_at` datetime DEFAULT NULL,
  `delivered_at` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `order_id`, `courier_name`, `tracking_number`, `shipped_at`, `delivered_at`, `status`, `created_at`, `updated_at`) VALUES
(2, 27, 'Rakesh rao', '12QWEDSER', '2025-09-27 17:09:00', '2025-09-30 17:09:00', 'shipped', '2025-09-24 06:09:57', '2025-09-24 06:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'Gold Ring', 4, '2025-09-25 00:26:55', '2025-09-25 00:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `tenant_id`, `name`, `email`, `password`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(5, NULL, 'Abhishek', 'developer4.filliptechnologies@gmail.com', '$2y$12$zM5GLE2k5AXUwPKVaCLVweyxKtXnDYpeDZ3OyHRUEkPofhcJa0F5W', '09235279546', 'ballia', '2025-09-24 00:49:46', '2025-10-30 06:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `variant_options`
--

CREATE TABLE `variant_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variant_options`
--

INSERT INTO `variant_options` (`id`, `variant_id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(27, 32, '', '', '2025-09-23 23:06:27', '2025-09-23 23:06:27'),
(34, 39, '', '', '2025-09-24 06:55:41', '2025-09-24 06:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `wish_lists`
--

CREATE TABLE `wish_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_user_id_foreign` (`user_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `costum_forms`
--
ALTER TABLE `costum_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_product_id_foreign` (`product_id`),
  ADD KEY `inventory_location_id_foreign` (`location_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_bvs`
--
ALTER TABLE `manage_bvs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_coupon_id_foreign` (`coupon_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `oredr_supports`
--
ALTER TABLE `oredr_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `pricebrdowns`
--
ALTER TABLE `pricebrdowns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_settings`
--
ALTER TABLE `price_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_tenant_id_foreign` (`tenant_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variants_sku_unique` (`sku`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_order_id_foreign` (`order_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tenants_domain_unique` (`domain`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `variant_options`
--
ALTER TABLE `variant_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variant_options_variant_id_foreign` (`variant_id`);

--
-- Indexes for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `costum_forms`
--
ALTER TABLE `costum_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_bvs`
--
ALTER TABLE `manage_bvs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `oredr_supports`
--
ALTER TABLE `oredr_supports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricebrdowns`
--
ALTER TABLE `pricebrdowns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `price_settings`
--
ALTER TABLE `price_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `variant_options`
--
ALTER TABLE `variant_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `wish_lists`
--
ALTER TABLE `wish_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variant_options`
--
ALTER TABLE `variant_options`
  ADD CONSTRAINT `variant_options_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
