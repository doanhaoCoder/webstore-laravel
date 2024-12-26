-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2024 at 11:10 PM
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
-- Database: `doanhao`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
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
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(5, 'Hoa Hồng', 'Đại diện cho tình yêu', '2024-12-14 06:58:26', '2024-12-26 13:43:17'),
(7, 'Lan Hồ Điệp', 'Lan Hồ Điệp', '2024-12-14 13:29:34', '2024-12-14 13:32:22'),
(8, 'Hoa Cúc', 'Hoa Cúc', '2024-12-14 13:34:34', '2024-12-14 13:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(3, 'Minh Đại', 'minhdai@gmail.com', '0987654321', 'Tôi muốn cung cấp sản phẩm cho bên cửa hàng', '2024-12-23 06:52:06', '2024-12-23 06:52:06'),
(4, 'Trung Hiếu', 'trunghieu@gmail.com', '01313716371', 'đơn hàng của mình chưa đc giao tới ạ', '2024-12-26 01:42:44', '2024-12-26 01:42:44'),
(5, 'Trung Hiếu', 'trunghieu@gmail.com', '01313716371', 'tôi muốn cung cấp hàng cho bên bạn', '2024-12-26 14:36:24', '2024-12-26 14:36:24');

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
(1, '2024_12_14_153839_create_users_table', 1),
(2, '2024_12_14_205002_create_carts_table', 2),
(4, '2024_12_14_215908_create_orders_table', 3),
(5, '2024_12_14_223601_add_user_id_to_orders_table', 4),
(6, '2024_12_23_125738_create_contacts_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('Đang duyệt','Đang giao hàng','Đã nhận hàng') NOT NULL DEFAULT 'Đang duyệt',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `total`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(18, 'Đoàn Nhật Hào', 'doannhathao2310@gmail.com', '0967093770', 'Tây Ninh', 760000.00, 'Đang giao hàng', '2024-12-23 07:14:47', '2024-12-23 07:31:48', 8),
(19, 'Đại Nguyễn', 'dainguyen@gmail.com', '123456789', 'TP.HCM', 3940000.00, 'Đang duyệt', '2024-12-23 07:16:05', '2024-12-23 07:16:05', 10),
(20, 'admin', 'admin@gmail.com', '01231371', 'tphcm', 3980000.00, 'Đã nhận hàng', '2024-12-26 13:28:40', '2024-12-26 13:30:16', 8),
(21, 'admin', 'admin@gmail.com', '01231371', '123', 3270000.00, 'Đang duyệt', '2024-12-26 15:04:37', '2024-12-26 15:04:37', 8);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(19, 12, 'Hoa Hồng Đỏ', 380000.00, 1, '2024-12-14 16:40:10', '2024-12-14 16:40:10'),
(20, 13, 'Hoa Hồng Trắng', 520000.00, 3, '2024-12-15 01:26:24', '2024-12-15 01:26:24'),
(21, 13, 'Hoa Lan Cẩm Chướng', 430000.00, 1, '2024-12-15 01:26:24', '2024-12-15 01:26:24'),
(22, 14, 'Hoa Hồng Vàng', 540000.00, 1, '2024-12-15 01:48:32', '2024-12-15 01:48:32'),
(23, 14, 'Hoa Cúc Vàng', 730000.00, 1, '2024-12-15 01:48:32', '2024-12-15 01:48:32'),
(24, 15, 'Hoa Hồng Trắng', 520000.00, 3, '2024-12-16 00:32:01', '2024-12-16 00:32:01'),
(25, 16, 'Hoa Hồng Trắng', 520000.00, 3, '2024-12-23 07:06:20', '2024-12-23 07:06:20'),
(26, 16, 'Hoa Hồng Cam', 760000.00, 2, '2024-12-23 07:06:20', '2024-12-23 07:06:20'),
(27, 17, 'Hoa Hồng Vàng', 540000.00, 1, '2024-12-23 07:08:20', '2024-12-23 07:08:20'),
(28, 17, 'Hoa Hồng Cam', 760000.00, 1, '2024-12-23 07:08:20', '2024-12-23 07:08:20'),
(29, 17, 'Hoa Hồng Trắng', 520000.00, 1, '2024-12-23 07:08:20', '2024-12-23 07:08:20'),
(30, 17, 'Hoa Cúc Vàng', 730000.00, 1, '2024-12-23 07:08:20', '2024-12-23 07:08:20'),
(31, 18, 'Hoa Hồng Cam', 760000.00, 1, '2024-12-23 07:14:47', '2024-12-23 07:14:47'),
(32, 19, 'Hoa Hồng Đỏ', 380000.00, 7, '2024-12-23 07:16:05', '2024-12-23 07:16:05'),
(33, 19, 'Hoa Hồng Trắng', 520000.00, 1, '2024-12-23 07:16:05', '2024-12-23 07:16:05'),
(34, 19, 'Hoa Hồng Cam', 760000.00, 1, '2024-12-23 07:16:05', '2024-12-23 07:16:05'),
(35, 20, 'Hoa Hồng Vàng', 540000.00, 5, '2024-12-26 13:28:40', '2024-12-26 13:28:40'),
(36, 20, 'Hoa Hồng Trắng', 520000.00, 1, '2024-12-26 13:28:40', '2024-12-26 13:28:40'),
(37, 20, 'Hoa Hồng Cam', 760000.00, 1, '2024-12-26 13:28:40', '2024-12-26 13:28:40'),
(38, 21, 'Hoa Hồng Vàng', 540000.00, 4, '2024-12-26 15:04:37', '2024-12-26 15:04:37'),
(39, 21, 'Hoa Hồng Đỏ', 380000.00, 1, '2024-12-26 15:04:37', '2024-12-26 15:04:37'),
(40, 21, 'Hoa Cúc Vàng', 730000.00, 1, '2024-12-26 15:04:37', '2024-12-26 15:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Hoa Hồng Đỏ', 'Hoa hồng đỏ, biểu tượng của tình yêu nồng cháy và sự đam mê. Với vẻ đẹp quyến rũ, hoa hồng đỏ là món quà lý tưởng cho những dịp đặc biệt.', 380000.00, 5, 'images/trhsgmds.png', '2024-12-14 08:16:23', '2024-12-14 08:23:27'),
(3, 'Hoa Hồng Trắng', 'Hoa hồng trắng tượng trưng cho sự trong sáng, thuần khiết và tình yêu vô điều kiện. Một lựa chọn hoàn hảo cho những dịp lễ trọng.', 520000.00, 5, 'images/u4gk5qj1.png', '2024-12-14 13:26:56', '2024-12-14 13:26:56'),
(4, 'Hoa Hồng Vàng', 'Hoa hồng vàng đại diện cho tình bạn chân thành và niềm vui. Màu vàng tươi sáng mang lại cảm giác hạnh phúc và ấm áp.', 540000.00, 5, 'images/tf4gp3ia.png', '2024-12-14 13:27:44', '2024-12-14 13:27:44'),
(5, 'Hoa Hồng Cam', 'Hoa hồng cam tượng trưng cho sự hài lòng, sự nỗ lực và khuyến khích. Một lựa chọn tuyệt vời để thể hiện sự tôn trọng.', 760000.00, 5, 'images/lrlx4i6h.png', '2024-12-14 13:28:57', '2024-12-14 13:28:57'),
(6, 'Hoa Lan Hồ Điệp', 'Hoa lan hồ điệp với màu sắc đa dạng, mang đến sự quý phái và thanh lịch. Được coi là biểu tượng của sự trường thọ và may mắn.', 1420000.00, 7, 'images/yp46z9og.png', '2024-12-14 13:31:13', '2024-12-14 13:31:13'),
(7, 'Hoa Lan Vanda', 'Hoa lan vanda, một trong những giống lan quý hiếm, mang màu sắc mạnh mẽ và sang trọng. Thường được dùng để trang trí và làm quà.', 7100000.00, 7, 'images/6x0vduav.png', '2024-12-14 13:31:57', '2024-12-14 13:31:57'),
(8, 'Hoa Lan Cẩm Chướng', 'Hoa lan cẩm chướng có hương thơm đặc biệt và hình dáng nổi bật, là sự kết hợp giữa vẻ đẹp và sự kiêu sa.', 430000.00, 7, 'images/36bbk5fi.png', '2024-12-14 13:33:10', '2024-12-15 01:11:20'),
(9, 'Hoa Cúc Vàng', 'Hoa cúc vàng là biểu tượng của sự sống lâu dài và tình yêu vĩnh cửu. Với màu vàng tươi sáng, hoa cúc vàng mang lại năng lượng tích cực cho mọi không gian.', 730000.00, 8, 'images/uwbc7t3x.png', '2024-12-14 13:35:12', '2024-12-14 13:35:12'),
(10, 'Hoa Cúc Trắng', 'Hoa cúc trắng tượng trưng cho sự thuần khiết và bình an. Màu trắng của hoa giúp làm dịu không gian và mang đến sự thanh thoát.', 580000.00, 8, 'images/i4mdmgyf.png', '2024-12-14 13:36:02', '2024-12-14 13:36:02'),
(11, 'Khúc ca ngọt ngào', 'Hoa cúc đỏ là biểu tượng của tình yêu và sự kiên cường. Được yêu thích trong các dịp lễ hội và ngày kỷ niệm.', 2010000.00, 8, 'images/x1qwsnfh.png', '2024-12-14 13:37:42', '2024-12-14 13:37:42'),
(12, 'Hộp hoa cúc mẫu đơn', 'Hoa cúc cam mang đến niềm vui và sự hạnh phúc. Màu sắc cam tươi sáng giúp tạo không khí ấm áp và đầy sinh khí.', 1790000.00, 8, 'images/0oy3wpkn.png', '2024-12-14 13:44:15', '2024-12-14 13:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `phone`, `address`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'admin', 'admin@gmail.com', 'Đoàn Nhật Hào', '0967093770', 'Tây Ninh', NULL, '$2y$12$RPPmCajCvvflOl7NuGNJnOgWcyvSdDC4iotV/c9lLWIlvtkwwJF8K', 'admin', NULL, '2024-12-23 07:03:56', '2024-12-26 05:09:06'),
(9, 'mod', 'mod@gmail.com', '', NULL, NULL, NULL, '$2y$12$P/md/qBAaXqmxXk7R4C9Tu5X/8.jgJsricZiqgFNrIwVmjTGQx7XK', 'mod', NULL, '2024-12-23 07:04:56', '2024-12-23 07:04:56'),
(10, 'hao', 'doannhathao@gmail.com', 'daon hao', '0967093770', 'Tây Ninh', NULL, '$2y$12$anJ2l7wKiH2p7B/NJXjQ9ekN.GITo0opzc246q.VW5JQ0W8rHuDoe', 'user', NULL, '2024-12-23 07:06:49', '2024-12-26 05:21:55'),
(11, 'trunghieu', 'trunghieu@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$EJJuJASUb7D9ftsaiAV2luJBEXSHrZT0RfjB/PID/D.KLpsQ52N26', 'admin', NULL, '2024-12-26 05:32:23', '2024-12-26 05:33:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
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
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
