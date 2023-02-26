-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 05:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clotheshub`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brandname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brandname`) VALUES
(1, 'levis'),
(2, 'puma'),
(3, 'adidas'),
(4, 'nike'),
(12, 'H&M');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230214092519', '2023-02-14 10:25:28', 70),
('DoctrineMigrations\\Version20230215014601', '2023-02-16 09:57:10', 59),
('DoctrineMigrations\\Version20230216091243', '2023-02-16 10:12:56', 96),
('DoctrineMigrations\\Version20230222030252', '2023-02-22 04:04:18', 1769),
('DoctrineMigrations\\Version20230223051313', '2023-02-23 06:13:27', 733),
('DoctrineMigrations\\Version20230223051628', '2023-02-23 06:16:33', 57),
('DoctrineMigrations\\Version20230223052758', '2023-02-23 06:28:07', 131),
('DoctrineMigrations\\Version20230224101232', '2023-02-24 11:14:18', 1497),
('DoctrineMigrations\\Version20230224101507', '2023-02-24 11:15:11', 82),
('DoctrineMigrations\\Version20230224102412', '2023-02-24 11:24:28', 106),
('DoctrineMigrations\\Version20230224102556', '2023-02-24 11:26:00', 99),
('DoctrineMigrations\\Version20230224124448', '2023-02-24 13:44:54', 113),
('DoctrineMigrations\\Version20230224124812', '2023-02-24 13:48:16', 96),
('DoctrineMigrations\\Version20230224125045', '2023-02-24 13:50:50', 49),
('DoctrineMigrations\\Version20230224140553', '2023-02-24 15:05:59', 93);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `total`, `date`) VALUES
(241, 2, '93', '2023-02-25'),
(242, 2, '96', '2023-02-25'),
(243, 2, '62', '2023-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `orders_id`, `product_id`, `quantity`) VALUES
(74, 241, 6, 2),
(75, 241, 7, 3),
(76, 242, 1, 2),
(77, 242, 9, 3),
(78, 242, 4, 1),
(79, 243, 2, 2),
(80, 243, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `productdes` varchar(255) DEFAULT NULL,
  `productprice` decimal(10,0) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `productname`, `image`, `productdes`, `productprice`, `brand_id`) VALUES
(1, 'Levi\'s L1-Men', 'levis1-63ef59674f941.jpg', 'Product Dimensions: 30 x 27 x 0.5 cm; 350 Kilograms. Date First Available: 24 June 2016. Item Weight: ‎350g. Item Dimensions LxWxH:‎ 30 x 27 x 0.5 Centimeters. Department: ‎Men. Generic Name: T-Shirt.', '14', 1),
(2, 'Adidas A1-Men', 'adidas1-63efa62037a1c.jpg', 'Product Dimensions: ‎30 x 15 x 5 cm; 250 Grams. Date First Available: 11 May 2021. Item Weight: 250g. Item Dimensions LxWxH: 30 x 15 x 5 Centimeters. Department: ‎Men. Generic Name: ‎T-Shirt.', '16', 3),
(3, 'Puma P1-Men', 'puma1.jpg', 'Product Dimensions: ‎22 x 29 x 4 cm; 500 Grams. Date First Available: ‎2 June 2022. Item Weight: 500g. Item Dimensions LxWxH: 22 x 29 x 4 Centimeters. Department: ‎Men. Generic Name: T-Shirt', '18', 2),
(4, 'Levi\'s L2-Women', 'levis2.jpg', 'Product Dimensions: ‎30 x 27 x 0.5 cm; 350 Kilograms. Date First Available: 4 January 2018. Item Weight: ‎350 kg. Item Dimensions LxWxH: ‎30 x 27 x 0.5 Centimeters. Department:‎ Women. Generic Name: ‎T-Shirt', '17', 1),
(5, 'Adidas A2-Women', 'adidas2-63efa695a41bd.jpg', 'Product Dimensions: ‎25 x 15 x 5 cm; 250 Grams. Date First Available: 5 June 2021. Item Weight: 250g. Item Dimensions LxWxH: ‎25 x 15 x 5 Centimeters. Department: Women. Generic Name: T-Shirt', '16', 3),
(6, 'Puma P2-Women', 'puma2.jpg', 'Product Dimensions: ‎22 x 29 x 4 cm; 500 Grams. Date First Available: ‎8 June 2022. Item Weight: ‎500g. Item Dimensions LxWxH: ‎22 x 29 x 4 Centimeters. Department: ‎Women. Generic Name: ‎T-Shirt.', '18', 2),
(7, 'Nike N1-Men', 'nike1.png', 'Product Dimensions: ‎42 x 29 x 1.5 cm; 180 Grams. Date First Available: 10 January 2022. Item Weight: ‎180g. Item Dimensions LxWxH: ‎42 x 29 x 1.5 Centimeters. Department: ‎Men. Generic Name: T-Shirt.', '19', 4),
(8, 'Puma P3-Men', 'puma3.jpg', 'Product Dimensions: ‎18 x 26 x 3 cm; 400 Grams. Date First Available: ‎11 August 2022. Item Weight: 400g. Item Dimensions LxWxH: ‎18 x 26 x 3 Centimeters. Department: ‎Men. Generic Name: ‎T-Shirt.', '15', 2),
(9, 'Nike N2-Men', 'nike2.jpg', 'Product Dimensions: ‎30 x 15 x 5 cm; 250 Grams. Date First Available: 11 May 2021. Item Weight: 250g. Item Dimensions LxWxH: 30 x 15 x 5 Centimeters. Department: ‎Men. Generic Name: ‎T-Shirt.', '17', 4),
(10, 'Adidas A3-Men', 'adidas3.jpg', 'Product Dimensions: ‎25 x 15 x 5 cm; 110 Grams. Date First Available‏: ‎5 June 2021. Item Weight: 110g. Item Dimensions LxWxH: ‎25 x 15 x 5 Centimeters. Department: ‎Mens. Generic Name: ‎T-Shirt', '15', 3),
(11, 'Levi\'s L3-Men', 'levis3.jpg', 'Product Dimensions: ‎68.6 x 12 x 2.5 cm; 350 Grams. Date First Available: ‎4 February 2022. Item Weight: 350g. Item Dimensions LxWxH: ‎68.6 x 12 x 2.5 Centimeters. Department: ‎Men. Generic Name: ‎T-Shirt.', '19', 1),
(12, 'Nike N3-Men', 'nike3.jpg', 'Product Dimensions: ‎26 x 2 x 84 cm; 330 Grams. Date First Available: ‎2 July 2020. Item Weight: 330g. Item Dimensions LxWxH: ‎26 x 2 x 84 Centimeters. Department: ‎Men. Generic Name: ‎T-Shirt', '17', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `phone`, `address`) VALUES
(1, 'hieu@gmail.com', '[\"ROLE_USER\"]', '$2y$13$pzsPQoybhKrV/3v.6wJvNuVahVYC7owy/fMRnLLmSb75q7ZICCSvC', 'Hieu Dep Trai', '0907075654', 'Can Tho'),
(2, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$YWvBrgjVzt0u.J/cQGbrI.ECdJFam5PKBHEuvpVnCKvBaBeQO0Fdm', 'Admin', '0907075654', 'Can Tho'),
(5, 'quy@gmail.com', '[\"ROLE_USER\"]', '$2y$13$//VUJEBxTdhASipUmLBhHOYAeh4eJKe4UyBN.sOtq7TEBa6czGJ2u', 'Quy Rua', '0123456789', 'Can Tho');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BA388B7A76ED395` (`user_id`),
  ADD KEY `IDX_BA388B74584665A` (`product_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F5299398A76ED395` (`user_id`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_27A0E7F2CFFE9AD6` (`orders_id`),
  ADD KEY `IDX_27A0E7F24584665A` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD44F5D008` (`brand_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B74584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `FK_27A0E7F24584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_27A0E7F2CFFE9AD6` FOREIGN KEY (`orders_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD44F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
