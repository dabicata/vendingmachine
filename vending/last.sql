-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2018 at 12:53 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vending_machine`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_days`
--

CREATE TABLE `active_days` (
  `machine_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `active_days`
--

INSERT INTO `active_days` (`machine_id`, `day_id`) VALUES
(787, 1),
(787, 5),
(787, 6),
(787, 7);

-- --------------------------------------------------------

--
-- Table structure for table `cells`
--

CREATE TABLE `cells` (
  `cell_id` int(11) NOT NULL,
  `vending_machine_id` int(11) NOT NULL,
  `cell_row` int(11) NOT NULL,
  `cell_column` int(11) NOT NULL,
  `combined_cell` int(11) NOT NULL,
  `cell_date_created` date NOT NULL,
  `cell_date_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cells`
--

INSERT INTO `cells` (`cell_id`, `vending_machine_id`, `cell_row`, `cell_column`, `combined_cell`, `cell_date_created`, `cell_date_updated`) VALUES
(1630875, 786, 0, 0, 0, '2018-01-03', '0000-00-00'),
(1630876, 786, 0, 1, 0, '2018-01-03', '0000-00-00'),
(1630877, 786, 0, 2, 0, '2018-01-03', '0000-00-00'),
(1630878, 786, 0, 3, 0, '2018-01-03', '0000-00-00'),
(1630879, 786, 0, 4, 0, '2018-01-03', '0000-00-00'),
(1630880, 786, 1, 0, 0, '2018-01-03', '0000-00-00'),
(1630881, 786, 1, 1, 0, '2018-01-03', '0000-00-00'),
(1630882, 786, 1, 2, 0, '2018-01-03', '0000-00-00'),
(1630883, 786, 1, 3, 0, '2018-01-03', '0000-00-00'),
(1630884, 786, 1, 4, 0, '2018-01-03', '0000-00-00'),
(1630885, 786, 2, 0, 0, '2018-01-03', '0000-00-00'),
(1630886, 786, 2, 1, 0, '2018-01-03', '0000-00-00'),
(1630887, 786, 2, 2, 0, '2018-01-03', '0000-00-00'),
(1630888, 786, 2, 3, 0, '2018-01-03', '0000-00-00'),
(1630889, 786, 2, 4, 0, '2018-01-03', '0000-00-00'),
(1630890, 786, 3, 0, 0, '2018-01-03', '0000-00-00'),
(1630891, 786, 3, 1, 0, '2018-01-03', '0000-00-00'),
(1630892, 786, 3, 2, 0, '2018-01-03', '0000-00-00'),
(1630893, 786, 3, 3, 0, '2018-01-03', '0000-00-00'),
(1630894, 786, 3, 4, 0, '2018-01-03', '0000-00-00'),
(1630895, 786, 4, 0, 0, '2018-01-03', '0000-00-00'),
(1630896, 786, 4, 1, 0, '2018-01-03', '0000-00-00'),
(1630897, 786, 4, 2, 0, '2018-01-03', '0000-00-00'),
(1630898, 786, 4, 3, 0, '2018-01-03', '0000-00-00'),
(1630899, 786, 4, 4, 0, '2018-01-03', '0000-00-00'),
(1630900, 787, 0, 0, 0, '2018-01-04', '0000-00-00'),
(1630901, 787, 0, 1, 0, '2018-01-04', '0000-00-00'),
(1630902, 787, 0, 2, 0, '2018-01-04', '0000-00-00'),
(1630903, 787, 0, 3, 0, '2018-01-04', '0000-00-00'),
(1630904, 787, 0, 4, 0, '2018-01-04', '0000-00-00'),
(1630905, 787, 0, 5, 0, '2018-01-04', '0000-00-00'),
(1630906, 787, 0, 6, 0, '2018-01-04', '0000-00-00'),
(1630907, 787, 0, 7, 0, '2018-01-04', '0000-00-00'),
(1630908, 787, 0, 8, 0, '2018-01-04', '0000-00-00'),
(1630909, 787, 0, 9, 0, '2018-01-04', '0000-00-00'),
(1630910, 787, 0, 10, 0, '2018-01-04', '0000-00-00'),
(1630911, 787, 0, 11, 0, '2018-01-04', '0000-00-00'),
(1630912, 787, 1, 0, 0, '2018-01-04', '0000-00-00'),
(1630913, 787, 1, 1, 0, '2018-01-04', '0000-00-00'),
(1630914, 787, 1, 2, 0, '2018-01-04', '0000-00-00'),
(1630915, 787, 1, 3, 0, '2018-01-04', '0000-00-00'),
(1630916, 787, 1, 4, 0, '2018-01-04', '0000-00-00'),
(1630917, 787, 1, 5, 0, '2018-01-04', '0000-00-00'),
(1630918, 787, 1, 6, 0, '2018-01-04', '0000-00-00'),
(1630919, 787, 1, 7, 0, '2018-01-04', '0000-00-00'),
(1630920, 787, 1, 8, 0, '2018-01-04', '0000-00-00'),
(1630921, 787, 1, 9, 0, '2018-01-04', '0000-00-00'),
(1630922, 787, 1, 10, 0, '2018-01-04', '0000-00-00'),
(1630923, 787, 1, 11, 0, '2018-01-04', '0000-00-00'),
(1630924, 787, 2, 0, 0, '2018-01-04', '0000-00-00'),
(1630925, 787, 2, 1, 0, '2018-01-04', '0000-00-00'),
(1630926, 787, 2, 2, 0, '2018-01-04', '0000-00-00'),
(1630927, 787, 2, 3, 0, '2018-01-04', '0000-00-00'),
(1630928, 787, 2, 4, 0, '2018-01-04', '0000-00-00'),
(1630929, 787, 2, 5, 0, '2018-01-04', '0000-00-00'),
(1630930, 787, 2, 6, 0, '2018-01-04', '0000-00-00'),
(1630931, 787, 2, 7, 0, '2018-01-04', '0000-00-00'),
(1630932, 787, 2, 8, 0, '2018-01-04', '0000-00-00'),
(1630933, 787, 2, 9, 0, '2018-01-04', '0000-00-00'),
(1630934, 787, 2, 10, 0, '2018-01-04', '0000-00-00'),
(1630935, 787, 2, 11, 0, '2018-01-04', '0000-00-00'),
(1630936, 787, 3, 0, 0, '2018-01-04', '0000-00-00'),
(1630937, 787, 3, 1, 0, '2018-01-04', '0000-00-00'),
(1630938, 787, 3, 2, 0, '2018-01-04', '0000-00-00'),
(1630939, 787, 3, 3, 0, '2018-01-04', '0000-00-00'),
(1630940, 787, 3, 4, 0, '2018-01-04', '0000-00-00'),
(1630941, 787, 3, 5, 0, '2018-01-04', '0000-00-00'),
(1630942, 787, 3, 6, 0, '2018-01-04', '0000-00-00'),
(1630943, 787, 3, 7, 0, '2018-01-04', '0000-00-00'),
(1630944, 787, 3, 8, 0, '2018-01-04', '0000-00-00'),
(1630945, 787, 3, 9, 0, '2018-01-04', '0000-00-00'),
(1630946, 787, 3, 10, 0, '2018-01-04', '0000-00-00'),
(1630947, 787, 3, 11, 0, '2018-01-04', '0000-00-00'),
(1630948, 787, 4, 0, 0, '2018-01-04', '0000-00-00'),
(1630949, 787, 4, 1, 0, '2018-01-04', '0000-00-00'),
(1630950, 787, 4, 2, 0, '2018-01-04', '0000-00-00'),
(1630951, 787, 4, 3, 0, '2018-01-04', '0000-00-00'),
(1630952, 787, 4, 4, 0, '2018-01-04', '0000-00-00'),
(1630953, 787, 4, 5, 0, '2018-01-04', '0000-00-00'),
(1630954, 787, 4, 6, 0, '2018-01-04', '0000-00-00'),
(1630955, 787, 4, 7, 0, '2018-01-04', '0000-00-00'),
(1630956, 787, 4, 8, 0, '2018-01-04', '0000-00-00'),
(1630957, 787, 4, 9, 0, '2018-01-04', '0000-00-00'),
(1630958, 787, 4, 10, 0, '2018-01-04', '0000-00-00'),
(1630959, 787, 4, 11, 0, '2018-01-04', '0000-00-00'),
(1630960, 787, 5, 0, 0, '2018-01-04', '0000-00-00'),
(1630961, 787, 5, 1, 0, '2018-01-04', '0000-00-00'),
(1630962, 787, 5, 2, 0, '2018-01-04', '0000-00-00'),
(1630963, 787, 5, 3, 0, '2018-01-04', '0000-00-00'),
(1630964, 787, 5, 4, 0, '2018-01-04', '0000-00-00'),
(1630965, 787, 5, 5, 0, '2018-01-04', '0000-00-00'),
(1630966, 787, 5, 6, 0, '2018-01-04', '0000-00-00'),
(1630967, 787, 5, 7, 0, '2018-01-04', '0000-00-00'),
(1630968, 787, 5, 8, 0, '2018-01-04', '0000-00-00'),
(1630969, 787, 5, 9, 0, '2018-01-04', '0000-00-00'),
(1630970, 787, 5, 10, 0, '2018-01-04', '0000-00-00'),
(1630971, 787, 5, 11, 0, '2018-01-04', '0000-00-00'),
(1630972, 787, 6, 0, 0, '2018-01-04', '0000-00-00'),
(1630973, 787, 6, 1, 0, '2018-01-04', '0000-00-00'),
(1630974, 787, 6, 2, 0, '2018-01-04', '0000-00-00'),
(1630975, 787, 6, 3, 0, '2018-01-04', '0000-00-00'),
(1630976, 787, 6, 4, 0, '2018-01-04', '0000-00-00'),
(1630977, 787, 6, 5, 0, '2018-01-04', '0000-00-00'),
(1630978, 787, 6, 6, 0, '2018-01-04', '0000-00-00'),
(1630979, 787, 6, 7, 0, '2018-01-04', '0000-00-00'),
(1630980, 787, 6, 8, 0, '2018-01-04', '0000-00-00'),
(1630981, 787, 6, 9, 0, '2018-01-04', '0000-00-00'),
(1630982, 787, 6, 10, 0, '2018-01-04', '0000-00-00'),
(1630983, 787, 6, 11, 0, '2018-01-04', '0000-00-00'),
(1630984, 787, 7, 0, 0, '2018-01-04', '0000-00-00'),
(1630985, 787, 7, 1, 0, '2018-01-04', '0000-00-00'),
(1630986, 787, 7, 2, 0, '2018-01-04', '0000-00-00'),
(1630987, 787, 7, 3, 0, '2018-01-04', '0000-00-00'),
(1630988, 787, 7, 4, 0, '2018-01-04', '0000-00-00'),
(1630989, 787, 7, 5, 0, '2018-01-04', '0000-00-00'),
(1630990, 787, 7, 6, 0, '2018-01-04', '0000-00-00'),
(1630991, 787, 7, 7, 0, '2018-01-04', '0000-00-00'),
(1630992, 787, 7, 8, 0, '2018-01-04', '0000-00-00'),
(1630993, 787, 7, 9, 0, '2018-01-04', '0000-00-00'),
(1630994, 787, 7, 10, 0, '2018-01-04', '0000-00-00'),
(1630995, 787, 7, 11, 0, '2018-01-04', '0000-00-00'),
(1630996, 787, 8, 0, 0, '2018-01-04', '0000-00-00'),
(1630997, 787, 8, 1, 0, '2018-01-04', '0000-00-00'),
(1630998, 787, 8, 2, 0, '2018-01-04', '0000-00-00'),
(1630999, 787, 8, 3, 0, '2018-01-04', '0000-00-00'),
(1631000, 787, 8, 4, 0, '2018-01-04', '0000-00-00'),
(1631001, 787, 8, 5, 0, '2018-01-04', '0000-00-00'),
(1631002, 787, 8, 6, 0, '2018-01-04', '0000-00-00'),
(1631003, 787, 8, 7, 0, '2018-01-04', '0000-00-00'),
(1631004, 787, 8, 8, 0, '2018-01-04', '0000-00-00'),
(1631005, 787, 8, 9, 0, '2018-01-04', '0000-00-00'),
(1631006, 787, 8, 10, 0, '2018-01-04', '0000-00-00'),
(1631007, 787, 8, 11, 0, '2018-01-04', '0000-00-00'),
(1631008, 787, 9, 0, 0, '2018-01-04', '0000-00-00'),
(1631009, 787, 9, 1, 0, '2018-01-04', '0000-00-00'),
(1631010, 787, 9, 2, 0, '2018-01-04', '0000-00-00'),
(1631011, 787, 9, 3, 0, '2018-01-04', '0000-00-00'),
(1631012, 787, 9, 4, 0, '2018-01-04', '0000-00-00'),
(1631013, 787, 9, 5, 0, '2018-01-04', '0000-00-00'),
(1631014, 787, 9, 6, 0, '2018-01-04', '0000-00-00'),
(1631015, 787, 9, 7, 0, '2018-01-04', '0000-00-00'),
(1631016, 787, 9, 8, 0, '2018-01-04', '0000-00-00'),
(1631017, 787, 9, 9, 0, '2018-01-04', '0000-00-00'),
(1631018, 787, 9, 10, 0, '2018-01-04', '0000-00-00'),
(1631019, 787, 9, 11, 0, '2018-01-04', '0000-00-00'),
(1631020, 787, 10, 0, 0, '2018-01-04', '0000-00-00'),
(1631021, 787, 10, 1, 0, '2018-01-04', '0000-00-00'),
(1631022, 787, 10, 2, 0, '2018-01-04', '0000-00-00'),
(1631023, 787, 10, 3, 0, '2018-01-04', '0000-00-00'),
(1631024, 787, 10, 4, 0, '2018-01-04', '0000-00-00'),
(1631025, 787, 10, 5, 0, '2018-01-04', '0000-00-00'),
(1631026, 787, 10, 6, 0, '2018-01-04', '0000-00-00'),
(1631027, 787, 10, 7, 0, '2018-01-04', '0000-00-00'),
(1631028, 787, 10, 8, 0, '2018-01-04', '0000-00-00'),
(1631029, 787, 10, 9, 0, '2018-01-04', '0000-00-00'),
(1631030, 787, 10, 10, 0, '2018-01-04', '0000-00-00'),
(1631031, 787, 10, 11, 0, '2018-01-04', '0000-00-00'),
(1631032, 787, 11, 0, 0, '2018-01-04', '0000-00-00'),
(1631033, 787, 11, 1, 0, '2018-01-04', '0000-00-00'),
(1631034, 787, 11, 2, 0, '2018-01-04', '0000-00-00'),
(1631035, 787, 11, 3, 0, '2018-01-04', '0000-00-00'),
(1631036, 787, 11, 4, 0, '2018-01-04', '0000-00-00'),
(1631037, 787, 11, 5, 0, '2018-01-04', '0000-00-00'),
(1631038, 787, 11, 6, 0, '2018-01-04', '0000-00-00'),
(1631039, 787, 11, 7, 0, '2018-01-04', '0000-00-00'),
(1631040, 787, 11, 8, 0, '2018-01-04', '0000-00-00'),
(1631041, 787, 11, 9, 0, '2018-01-04', '0000-00-00'),
(1631042, 787, 11, 10, 0, '2018-01-04', '0000-00-00'),
(1631043, 787, 11, 11, 0, '2018-01-04', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `day_id` int(11) NOT NULL,
  `days` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`day_id`, `days`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_expire_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_size` int(11) NOT NULL,
  `cell_id` int(11) NOT NULL,
  `product_date_created` datetime NOT NULL,
  `product_date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `product_type_id` int(11) NOT NULL,
  `product_type_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`product_type_id`, `product_type_name`) VALUES
(1, 'Cola'),
(2, 'Chips'),
(3, 'Snikers');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status`) VALUES
(1, 'Active'),
(2, 'Inactive'),
(3, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `vending_machines`
--

CREATE TABLE `vending_machines` (
  `vending_machine_id` int(11) NOT NULL,
  `vending_machine_rows` int(11) NOT NULL,
  `vending_machine_columns` int(11) NOT NULL,
  `machine_size` int(11) NOT NULL,
  `vending_machine_date_created` datetime NOT NULL,
  `vending_machine_date_updated` datetime NOT NULL,
  `vending_machine_status_id` int(11) NOT NULL,
  `vending_machine_desc` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vending_machine_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vending_machines`
--

INSERT INTO `vending_machines` (`vending_machine_id`, `vending_machine_rows`, `vending_machine_columns`, `machine_size`, `vending_machine_date_created`, `vending_machine_date_updated`, `vending_machine_status_id`, `vending_machine_desc`, `vending_machine_name`) VALUES
(786, 5, 5, 5, '2018-01-03 23:50:18', '2018-01-04 00:37:04', 2, 'this is test machine', 'yay'),
(787, 11, 11, 11, '2018-01-04 00:30:34', '2018-01-04 00:40:29', 1, '12', '12');

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
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`day_id`);

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
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

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
  MODIFY `cell_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1631044;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40417;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vending_machines`
--
ALTER TABLE `vending_machines`
  MODIFY `vending_machine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=788;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
