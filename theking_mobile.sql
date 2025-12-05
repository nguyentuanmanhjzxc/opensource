-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 05, 2025 lúc 02:44 PM
-- Phiên bản máy phục vụ: 9.1.0
-- Phiên bản PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `theking_mobile`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `code`) VALUES
(1, 'iPhone', 'iphone'),
(2, 'Samsung', 'samsung'),
(3, 'Xiaomi', 'xiaomi'),
(4, 'Phụ kiện', 'phukien');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci,
  `total_money` decimal(15,0) NOT NULL,
  `status` enum('pending','processing','completed','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,0) NOT NULL COMMENT 'Giá bán hiện tại',
  `old_price` decimal(15,0) DEFAULT NULL COMMENT 'Giá gốc trước khi giảm (nếu có)',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'img/no-image.jpg',
  `description` text COLLATE utf8mb4_unicode_ci,
  `stock` int DEFAULT '100',
  `series` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Dòng máy để lọc: iphone15, s_series, redmi...',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT 'Sản phẩm Hot',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `old_price`, `image`, `description`, `stock`, `series`, `is_hot`, `created_at`) VALUES
(1, 1, 'iPhone 13 128GB', 11500000, 12890000, 'img/9.jpg', NULL, 100, 'iphone13', 0, '2025-12-05 13:42:50'),
(2, 1, 'iPhone 14 Pro', 12990000, 13790000, 'img/19.jpg', NULL, 100, 'iphone14', 1, '2025-12-05 13:42:50'),
(3, 1, 'iPhone 15 Chính Hãng', 14500000, 15390000, 'img/10.jpg', NULL, 100, 'iphone15', 0, '2025-12-05 13:42:50'),
(4, 2, 'Samsung Galaxy S25 Ultra', 11800000, 12500000, 'img/20.jpg', NULL, 100, 's_series', 1, '2025-12-05 13:42:50'),
(5, 2, 'Samsung Galaxy Z Flip 5', 19000000, NULL, 'img/18.jpg', NULL, 100, 'z_series', 0, '2025-12-05 13:42:50'),
(6, 3, 'Xiaomi 14 5G', 19990000, NULL, 'img/xiaomi14.jpg', NULL, 100, 'xiaomi_flagship', 1, '2025-12-05 13:42:50'),
(7, 3, 'Xiaomi 14 Pro', 8990000, 10000000, 'img/17.jpg', NULL, 100, 'xiaomi_flagship', 0, '2025-12-05 13:42:50'),
(8, 3, 'Xiaomi 13T Pro', 11990000, NULL, 'img/xiaomi13t.jpg', NULL, 100, 'xiaomi_flagship', 0, '2025-12-05 13:42:50'),
(9, 3, 'Redmi Note 13', 4890000, NULL, 'img/redmi13.jpg', NULL, 100, 'redmi', 0, '2025-12-05 13:42:50'),
(10, 3, 'POCO X6 Pro 5G', 7500000, 8500000, 'img/poco.jpg', NULL, 100, 'poco', 0, '2025-12-05 13:42:50'),
(11, 4, 'Airpods Pro', 4200000, 5000000, 'img/14.jpg', NULL, 100, 'audio', 0, '2025-12-05 13:42:50'),
(12, 4, 'Airpods Pro 3', 6790000, NULL, 'img/11.jpg', NULL, 100, 'audio', 0, '2025-12-05 13:42:50'),
(13, 4, 'Sạc nhanh 20W Apple', 590000, 790000, 'img/sac20w.jpg', NULL, 100, 'charge', 0, '2025-12-05 14:09:55'),
(14, 4, 'Cáp sạc Type-C Samsung', 250000, NULL, 'img/capsac.jpg', NULL, 100, 'charge', 0, '2025-12-05 14:09:55'),
(15, 4, 'Ốp lưng iPhone 15 Pro Max', 150000, 200000, 'img/op15.jpg', NULL, 50, 'case', 0, '2025-12-05 14:09:55'),
(16, 4, 'Bao da iPad Air', 350000, NULL, 'img/baoda.jpg', NULL, 30, 'case', 0, '2025-12-05 14:09:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'THE KING - Cửa hàng điện thoại',
  `hotline` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '1900 1234',
  `email_contact` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'contact@theking.vn',
  `admin_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'admin@theking.vn',
  `maintenance_mode` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `hotline`, `email_contact`, `admin_email`, `maintenance_mode`) VALUES
(1, 'THE KING - Cửa hàng điện thoại', '1900 1234', 'contact@theking.vn', 'admin@theking.vn', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `address`, `role`, `created_at`) VALUES
(1, 'Quản Trị Viên', 'admin@theking.vn', '$2y$10$TowFbllSbm3qW9zk/2jQteGPlZQwiLpADLnruyTi5KjdHkGh8fxQ2', '0909000111', NULL, 'admin', '2025-12-05 13:42:50'),
(2, 'Khách Hàng Mẫu', 'khach@gmail.com', '$2y$10$TowFbllSbm3qW9zk/2jQteGPlZQwiLpADLnruyTi5KjdHkGh8fxQ2', '0909000222', NULL, 'customer', '2025-12-05 13:42:50'),
(3, 'Hoàng Hưng', 'hung@gmail.com', '$2y$10$Dod4cuQZguDYwa6spMGbVO0cVEuGnKWdXKsr284adhYs2CQAHP4ry', NULL, NULL, 'customer', '2025-12-05 14:33:32');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
