-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 04:53 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `w3605`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `user_role` tinyint(4) DEFAULT NULL,
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`username`, `email`, `pass`, `user_role`, `id`) VALUES
('adminer', 'kramztech10@gmail.com', '$2y$10$9MEgCAM917unBKhnEI7/4.xyynASOf6VWv19dfdACendWjbstl6wS', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_name` varchar(100) DEFAULT NULL,
  `brand_image` varchar(255) DEFAULT NULL,
  `brand_slug` varchar(100) DEFAULT NULL,
  `brand_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_name`, `brand_image`, `brand_slug`, `brand_id`) VALUES
('PureFoods', 'purefoods.jpg', 'purefoods', 1),
('No Brand', 'noimage.jpg', 'no-brand', 2),
('Magnolia', 'Magnolia.jpg', 'magnolia', 3),
('Virginia', 'virginia brand.jpg', 'virginia', 4),
('Lucky Me', 'Luckyme.jpg', 'lucky-me', 5);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `name` varchar(25) NOT NULL,
  `slug` varchar(25) NOT NULL,
  `category_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`name`, `slug`, `category_id`) VALUES
('Groceries and Food', 'groceries-and-food', 1),
('Uncategorized', 'uncategorized', 2),
('Fruits', 'fruits', 3),
('Vegetables', 'vegetables', 4);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `complete_address` varchar(100) DEFAULT NULL,
  `address_type` varchar(20) NOT NULL,
  `other_details` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `delivery_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `order_item_id` bigint(20) NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `total_price` decimal(10,0) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(4) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `order_id` bigint(20) DEFAULT NULL,
  `payment_method` varchar(55) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `transaction_status` tinyint(4) DEFAULT NULL,
  `pay_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE `productimages` (
  `product_image` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productimages`
--

INSERT INTO `productimages` (`product_image`, `product_id`, `image_id`) VALUES
('fresh-ripe-mango_0.jpg', 4, 1),
('fresh-ripe-mango_1.jpeg', 4, 2),
('fresh-raw-vegetables_0.jpeg', 5, 3),
('fresh-raw-vegetables_1.jpeg', 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `brand_id` bigint(20) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_name`, `slug`, `short_description`, `long_description`, `quantity`, `price`, `status`, `category_id`, `brand_id`, `vendor_id`, `product_id`) VALUES
('GREEN EARTH YELLOW MANGO 1kg', 'green-earth-yellow-mango-1kg', 'A Guaranteed Fresh and Quality mango fruit with packaging/size: 1kg.', NULL, 1000, 60, NULL, 3, 2, 1, 2),
('Fresh Fruit Peach', 'fresh-fruit-peach', 'A Guaranteed Fresh and Quality Peach fruit.', NULL, 100, 60, NULL, 3, 2, 1, 3),
('Fresh Ripe Mango', 'fresh-ripe-mango', 'Sample Description:  fresh mango with sweet taste.', NULL, 10, 50, NULL, 3, 2, 1, 4),
('Fresh Raw Vegetables', 'fresh-raw-vegetables', 'Assortment of fresh raw vegetables isolated on white background. Tomato, cucumber, onion, salad, carrot, beetroot, potato.', NULL, 500, 220, NULL, 4, 2, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `producttagassociations`
--

CREATE TABLE `producttagassociations` (
  `product_id` bigint(20) DEFAULT NULL,
  `product_tag_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `producttags`
--

CREATE TABLE `producttags` (
  `product_tag` varchar(25) DEFAULT NULL,
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` bigint(20) NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `sales_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `extension` char(10) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `contact_number` varchar(25) NOT NULL,
  `email` varchar(254) NOT NULL,
  `account_status` int(11) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `user_role` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `middle_name`, `extension`, `username`, `photo`, `contact_number`, `email`, `account_status`, `pass`, `user_role`, `created_at`, `modified`, `user_id`) VALUES
('Jerrie', 'MacFayden', NULL, NULL, 'jerriemacfayden1701248782_46045f90', NULL, '09123381013', 'jmacfaydena@fda.gov', NULL, '$2y$10$3t2ml5Lj/X4.9vjHehqm6.YyTyiygqD4ZPzMIQFffs7c5tDxEw85q', 2, '2023-11-29 10:51:23', NULL, 1),
('Lenora', 'Proffitt', NULL, NULL, 'lenoraproffitt1701255899_8ecfba49', NULL, '09283850592', 'lproffitt8@examiner.com', NULL, '$2y$10$OYcalbixiMJEa2lti1na2uTlUYhQnz2ms6MJ7kDIM9C9zjoartITS', 2, '2023-11-29 11:11:00', NULL, 2),
('Creight', 'Leyson', NULL, NULL, 'creightleyson1701257092_45b03d94', NULL, '09670654118', 'cleyson0@chicagotribune.com', NULL, '$2y$10$sZ5Taaynb/E8yk2EKQrDuOHwu.UCZx0UX7xK3NTjjN8e47tBCIlXq', 1, '2023-11-29 11:24:52', NULL, 3),
('Herrick', 'Pittman', NULL, NULL, 'herrickpittman1701314679_e904ecea', NULL, '09201919204', 'hpittman1@jigsy.com', NULL, '$2y$10$NPvoh3luzc.frgQcIZpvd.DlohfCwJt3137aYZ58CMMDv3kLqWF/W', 1, '2023-11-30 03:24:40', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vendorshop`
--

CREATE TABLE `vendorshop` (
  `shop_name` varchar(100) NOT NULL,
  `Shop_description` text DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `vendor_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendorshop`
--

INSERT INTO `vendorshop` (`shop_name`, `Shop_description`, `user_id`, `vendor_id`) VALUES
('Fresh Mart Grocery', 'A family-owned grocery store with fresh produce and friendly staff', 3, 1),
('Retail Oasis', 'A trendy boutique offering the latest fashion trends.', 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `producttagassociations`
--
ALTER TABLE `producttagassociations`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_tag_id` (`product_tag_id`);

--
-- Indexes for table `producttags`
--
ALTER TABLE `producttags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vendorshop`
--
ALTER TABLE `vendorshop`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `order_item_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productimages`
--
ALTER TABLE `productimages`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `producttags`
--
ALTER TABLE `producttags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendorshop`
--
ALTER TABLE `vendorshop`
  MODIFY `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `productimages`
--
ALTER TABLE `productimages`
  ADD CONSTRAINT `productimages_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD CONSTRAINT `productreviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `productreviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendorshop` (`vendor_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `producttagassociations`
--
ALTER TABLE `producttagassociations`
  ADD CONSTRAINT `producttagassociations_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `producttagassociations_ibfk_2` FOREIGN KEY (`product_tag_id`) REFERENCES `producttags` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `vendorshop`
--
ALTER TABLE `vendorshop`
  ADD CONSTRAINT `vendorshop_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
