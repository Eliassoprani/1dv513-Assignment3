-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2022 at 06:02 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment3`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `stock_id`, `user_id`, `body`) VALUES
(1, 1, 1, 'This stock is on the way up, apple to the moon!!! 1000% upside minimum!'),
(2, 1, 1, 'This is a comment'),
(4, 4, 1, 'asdasd'),
(5, 4, 1, 'fsewra'),
(6, 2, 1, 'This company has been flying under the radar for a long time! They missed out on the two latest orders... But after they managed to get this order through they went soaring! To the moon!'),
(7, 11, 17, 'This company is doing good!'),
(8, 1, 17, 'This is a comment not made by official'),
(9, 1, 18, 'This is a comment'),
(10, 2, 1, 'This is a comment'),
(11, 1, 1, 'This is a comment made by official');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `user_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`user_id`, `stock_id`) VALUES
(1, 1),
(1, 2),
(1, 6),
(1, 7),
(1, 8),
(1, 12),
(1, 19),
(1, 21),
(4, 30),
(13, 2),
(14, 5),
(14, 38),
(15, 1),
(15, 2),
(17, 1),
(18, 1),
(18, 3);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `stockprice` decimal(11,2) NOT NULL,
  `stockprice1day` decimal(11,2) NOT NULL,
  `stockrating` int(10) UNSIGNED NOT NULL,
  `stockname` varchar(64) NOT NULL,
  `ammountrated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `stockprice`, `stockprice1day`, `stockrating`, `stockname`, `ammountrated`) VALUES
(1, '172.00', '171.00', 8, 'Apple Inc', 2),
(2, '90.00', '10.00', 4, 'eliasCorp', 1),
(3, '313.00', '312.00', 11, 'Microsoft Corporation', 5),
(4, '3245.00', '3244.00', 0, 'Amazon.com inc', 0),
(5, '1026.00', '1027.00', 0, 'Tesla Inc', 0),
(6, '2739.00', '2739.00', 3, 'Alphabet Inc, class A', 1),
(7, '332.00', '331.00', 0, 'Meta Platforms Inc, Class A', 0),
(8, '2741.00', '2740.00', 3, 'Alphabet Inc, class C', 1),
(9, '272.00', '271.00', 0, 'NVIDIA Corporation', 0),
(10, '319.78', '319.00', 0, 'Berkshire Hathaway Inc, class B', 0),
(11, '167.17', '167.00', 4, 'JPMorgan Chase & Co', 1),
(12, '173.96', '173.22', 0, 'Johnson & Johnson', 0),
(13, '458.63', '459.00', 0, 'UnitedHealth Group Incorporated', 0),
(14, '162.74', '162.74', 0, 'Procter & Gamble Company', 0),
(15, '216.79', '219.00', 0, 'Visa Inc, class A', 0),
(16, '49.50', '49.18', 0, 'Bank of America Corp', 0),
(17, '369.30', '369.90', 0, 'Mastercard incorporated class A', 0),
(18, '55.81', '55.71', 5, 'Pfizer Inc', 1),
(19, '68.93', '68.83', 0, 'Exxon Mobil Corporation', 0),
(20, '157.83', '158.00', 0, 'Walt Disney Company', 0),
(21, '618.51', '618.71', 0, 'Broadcom Inc.', 0),
(22, '61.70', '61.90', 0, 'Cisco Systems Inc.', 0),
(23, '540.88', '540.00', 0, 'Netflix Inc.', 0),
(24, '607.70', '609.20', 0, 'Thermo Fisher Scientific Inc.', 0),
(25, '510.50', '510.10', 0, 'Adobe Inc.', 0),
(26, '536.30', '531.10', 0, 'Costco Wholesale Corporation', 0),
(27, '174.00', '173.00', 0, 'PepsiCo Inc.', 0),
(28, '134.88', '134.12', 0, 'AbbVie Inc.', 0),
(29, '370.75', '370.00', 0, 'Accenture Plc Class A', 0),
(30, '135.56', '135.12', 0, 'Abbott Laboratories', 0),
(31, '125.00', '125.03', 0, 'Chevron Corporation', 0),
(32, '60.33', '60.00', 0, 'Coca-Cola Company', 0),
(33, '50.02', '50.00', 0, 'Comcast Corporation Class A', 0),
(34, '188.50', '188.90', 0, 'PayPal Holdings Inc.', 0),
(35, '228.31', '229.30', 0, 'salesforce.com inc.', 0),
(36, '54.24', '54.00', 0, 'Verizon Communications Inc.', 0),
(37, '53.55', '54.59', 0, 'Intel Corporation', 0),
(38, '54.77', '54.82', 0, 'Wells Fargo & Company', 0),
(39, '180.27', '180.00', 0, 'Qualcomm Imc', 0),
(40, '261.54', '261.23', 0, 'Eli Lilly and Company', 0),
(41, '157.07', '157.05', 0, 'NIKE Inc. Class B', 0),
(42, '144.89', '145.00', 0, 'Walmart Inc.', 0),
(43, '267.00', '267.06', 0, 'McDonald\'s Corporation', 0),
(44, '80.20', '80.00', 0, 'Merck & Co. Inc.', 0),
(45, '295.67', '296.00', 0, 'Danaher Corporation', 0),
(46, '26.29', '26.00', 0, 'AT&T Inc.', 0),
(47, '251.03', '251.00', 0, 'Lowe\'s Companis Inc.', 0),
(48, '343.50', '343.00', 0, 'Linde plc', 0),
(49, '179.63', '179.82', 0, 'Texas Instruments Incorporated', 0),
(50, '86.78', '86.68', 0, 'Nextra Energy Inc.', 0),
(51, '567.05', '564.00', 0, 'Intuit Inc.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `isofficial` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `isofficial`) VALUES
(1, 'eliassoprani', 'eliassoprani', 1),
(4, 'Aktiegurun', 'Aktiegurun123', 0),
(5, 'asdasd', 'asdasd', 0),
(7, 'Eliasandra', 'eliasandra', 0),
(9, 'Eliasandraas', 'asdasd', 0),
(11, 'fesrwfsrt', 'fwsfwrfasf', 0),
(13, '12333', '12333', 0),
(14, 'testacc', 'testacc', 0),
(15, 'elias123soprani', 'elias123soprani', 0),
(16, '132321312', '123321312', 0),
(17, 'testacc123', 'testacc123', 0),
(18, 'testaccount', 'testaccount', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `stock_id` (`stock_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`user_id`,`stock_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `stock_id` (`stock_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`stock_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `portfolio_ibfk_1` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`stock_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `portfolio_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
