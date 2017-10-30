-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2017 at 09:50 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vending_machine`
--

-- --------------------------------------------------------

--
-- Table structure for table `cells`
--

CREATE TABLE `cells` (
  `cell_id`            INT(11) NOT NULL,
  `vending_machine_id` INT(11) NOT NULL,
  `cell_row`           INT(11) NOT NULL,
  `cell_column`        INT(11) NOT NULL,
  `combined_cell`      INT(11) NOT NULL,
  `cell_date_created`  DATE    NOT NULL,
  `cell_date_updated`  DATE    NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `cells`
--

INSERT INTO `cells` (`cell_id`, `vending_machine_id`, `cell_row`, `cell_column`, `combined_cell`, `cell_date_created`, `cell_date_updated`)
VALUES
  (4333, 429, 1, 1, 0, '2017-10-30', '0000-00-00'),
  (4334, 429, 1, 2, 0, '2017-10-30', '0000-00-00'),
  (4335, 429, 2, 1, 0, '2017-10-30', '0000-00-00'),
  (4336, 429, 2, 2, 0, '2017-10-30', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id`           INT(11)   NOT NULL,
  `product_type_id`      INT(11)   NOT NULL,
  `product_price`        FLOAT     NOT NULL,
  `product_expire_date`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_size`         INT(11)   NOT NULL,
  `cell_id`              INT(11)   NOT NULL,
  `product_date_created` DATETIME  NOT NULL,
  `product_date_updated` DATETIME  NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_type_id`, `product_price`, `product_expire_date`, `product_size`, `cell_id`, `product_date_created`, `product_date_updated`)
VALUES
  (5945, 3, 6, '2017-12-29 07:12:43', 1, 4333, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5946, 2, 5, '2017-12-29 07:12:43', 2, 4334, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5947, 2, 5, '2017-12-29 07:12:43', 2, 4334, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5948, 1, 3, '2017-12-29 07:12:43', 2, 4335, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5949, 1, 3, '2017-12-29 07:12:43', 2, 4335, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5950, 2, 5, '2017-12-29 07:12:43', 2, 4334, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5951, 1, 3, '2017-12-29 07:12:43', 2, 4335, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5952, 1, 3, '2017-12-29 07:12:43', 2, 4335, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5953, 3, 6, '2017-12-29 07:12:43', 1, 4333, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5954, 3, 6, '2017-12-29 07:12:43', 1, 4333, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5955, 3, 6, '2017-12-29 07:12:43', 1, 4333, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5956, 3, 6, '2017-12-29 07:12:43', 1, 4333, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5957, 3, 6, '2017-12-29 07:12:43', 1, 4333, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5958, 2, 5, '2017-12-29 07:12:43', 2, 4334, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5959, 2, 5, '2017-12-29 07:12:43', 2, 4334, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5960, 1, 3, '2017-12-29 07:12:43', 2, 4335, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5961, 1, 3, '2017-12-29 07:12:43', 2, 4336, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5962, 3, 6, '2017-12-29 07:12:43', 1, 4333, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5963, 1, 3, '2017-12-29 07:12:43', 2, 4336, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5964, 1, 3, '2017-12-29 07:12:43', 2, 4336, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5965, 1, 3, '2017-12-29 07:12:43', 2, 4336, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5966, 3, 6, '2017-12-29 07:12:43', 1, 4333, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5967, 1, 3, '2017-12-29 07:12:43', 2, 4336, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5968, 3, 6, '2017-12-29 07:12:43', 1, 4333, '2017-10-30 11:49:43', '0000-00-00 00:00:00'),
  (5969, 3, 6, '2017-12-29 07:12:43', 1, 4333, '2017-10-30 11:49:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `product_type_id`   INT(11)                    NOT NULL,
  `product_type_name` VARCHAR(50)
                      COLLATE utf8mb4_unicode_ci NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`product_type_id`, `product_type_name`) VALUES
  (1, 'cola'),
  (2, 'chips'),
  (3, 'snikers');

-- --------------------------------------------------------

--
-- Table structure for table `vending_machines`
--

CREATE TABLE `vending_machines` (
  `vending_machine_id`           INT(11)  NOT NULL,
  `vending_machine_rows`         INT(11)  NOT NULL,
  `vending_machine_columns`      INT(11)  NOT NULL,
  `machine_size`                 INT(11)  NOT NULL,
  `vending_machine_date_created` DATETIME NOT NULL,
  `vending_machine_date_updated` DATETIME NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `vending_machines`
--

INSERT INTO `vending_machines` (`vending_machine_id`, `vending_machine_rows`, `vending_machine_columns`, `machine_size`, `vending_machine_date_created`, `vending_machine_date_updated`)
VALUES
  (429, 2, 2, 10, '2017-10-30 11:49:43', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cells`
--
ALTER TABLE `cells`
  ADD PRIMARY KEY (`cell_id`),
  ADD KEY `vending_machine_id` (`vending_machine_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_type` (`product_type_id`),
  ADD KEY `cell_id` (`cell_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `vending_machines`
--
ALTER TABLE `vending_machines`
  ADD PRIMARY KEY (`vending_machine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cells`
--
ALTER TABLE `cells`
  MODIFY `cell_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4337;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5970;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `product_type_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `vending_machines`
--
ALTER TABLE `vending_machines`
  MODIFY `vending_machine_id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 430;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cells`
--
ALTER TABLE `cells`
  ADD CONSTRAINT `cells_ibfk_1` FOREIGN KEY (`vending_machine_id`) REFERENCES `vending_machines` (`vending_machine_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`product_type_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`cell_id`) REFERENCES `cells` (`cell_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
