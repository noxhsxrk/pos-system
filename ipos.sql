-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2021 at 11:49 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`) VALUES
(5, 'หนังสือ'),
(6, 'อุปกรณ์การเขียน');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL,
  `cashier_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `time_order` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total` float NOT NULL,
  `paid` float NOT NULL,
  `due` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `cashier_name`, `order_date`, `time_order`, `total`, `paid`, `due`) VALUES
(1, '102', '2021-02-25', '21:03', 150, 300, 150),
(94, 'admin', '2021-03-01', '22:28', 390, 1000, 390),
(95, 'admin', '2021-03-01', '23:39', 3250, 5000, -1750),
(96, 'admin', '2021-03-02', '12:32', 3250, 10000, -6750),
(97, 'admin', '2021-03-02', '15:15', 33150, 50000, -16850),
(98, 'user1', '2021-03-02', '15:25', 1560, 2000, -440),
(99, 'nox', '2021-03-02', '15:30', 1300, 1500, -200),
(100, 'admin', '2021-05-14', '13:15', 1300, 10000, -8700),
(101, 'book', '2021-05-14', '19:54', 1170, 20, 1150),
(102, 'book', '2021-05-14', '19:57', 780, 0, 780),
(103, 'book', '2021-05-14', '20:04', 390, 10, 380),
(104, 'book', '2021-05-14', '20:08', 650, 50, 600),
(105, 'book', '2021-05-14', '20:09', 780, 500, 280),
(106, 'book', '2021-05-14', '20:09', 780, 0, 780),
(107, 'book', '2021-05-14', '20:15', 1300, 500, 800),
(108, 'book', '2021-05-14', '20:24', 650, 50, -600),
(109, 'book', '2021-05-14', '20:25', 650, 5, -645),
(110, 'book', '2021-05-14', '20:36', 1300, 3453, -1300),
(111, 'book', '2021-05-14', '20:37', 780, 500000, 499220),
(112, 'book', '2021-05-14', '20:39', 390, 50000000000, 50000000000),
(113, 'book', '2021-05-14', '20:39', 780, 50, -730),
(114, 'book', '2021-05-14', '20:40', 2600, 5, -2595),
(115, 'book', '2021-05-14', '20:41', 390, 50, -340),
(116, 'book', '2021-05-14', '20:43', 650, 500, -150),
(117, 'book', '2021-05-14', '20:46', 780, 50, -780),
(118, 'book', '2021-05-14', '20:48', 390, 10, -390),
(119, 'book', '2021-05-14', '20:49', 650, 50, -650),
(120, 'book', '2021-05-14', '20:50', 390, 40, -390),
(121, 'book', '2021-05-14', '20:51', 650, 10, -650),
(122, 'book', '2021-05-14', '20:54', 650, 500, -150),
(123, 'book', '2021-05-14', '20:55', 650, 50, -600),
(126, 'admin', '2021-05-14', '22:36', 1180, 2000, 820),
(127, 'สหรัฐ', '2021-05-14', '22:44', 2250, 5000, 2750),
(128, 'สหรัฐ', '2021-05-14', '23:07', 700, 1000, 300);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_detail`
--

CREATE TABLE `tbl_invoice_detail` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` char(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice_detail`
--

INSERT INTO `tbl_invoice_detail` (`id`, `invoice_id`, `product_id`, `product_code`, `product_name`, `qty`, `price`, `total`, `order_date`) VALUES
(139, 94, 22, 'B00001', 'Core Java SE 9 for the Impatient', 1, 390, 390, '2021-03-01'),
(140, 95, 23, 'B00002', 'Cloud Native Java', 5, 650, 3250, '2021-03-01'),
(141, 96, 23, 'B00002', 'Cloud Native Java', 5, 650, 3250, '2021-03-02'),
(142, 97, 22, 'B00001', 'Core Java SE 9 for the Impatient', 85, 390, 33150, '2021-03-02'),
(143, 98, 22, 'B00001', 'Core Java SE 9 for the Impatient', 4, 390, 1560, '2021-03-02'),
(144, 99, 23, 'B00002', 'Cloud Native Java', 2, 650, 1300, '2021-03-02'),
(145, 100, 23, 'B00002', 'Cloud Native Java', 2, 650, 1300, '2021-05-14'),
(146, 101, 22, 'B00001', 'Core Java SE 9 for the Impatient', 3, 390, 1170, '2021-05-14'),
(147, 102, 22, 'B00001', 'Core Java SE 9 for the Impatient', 2, 390, 780, '2021-05-14'),
(148, 103, 22, 'B00001', 'Core Java SE 9 for the Impatient', 1, 390, 390, '2021-05-14'),
(149, 104, 23, 'B00002', 'Cloud Native Java', 1, 650, 650, '2021-05-14'),
(150, 105, 22, 'B00001', 'Core Java SE 9 for the Impatient', 2, 390, 780, '2021-05-14'),
(151, 106, 22, 'B00001', 'Core Java SE 9 for the Impatient', 2, 390, 780, '2021-05-14'),
(152, 107, 23, 'B00002', 'Cloud Native Java', 2, 650, 1300, '2021-05-14'),
(153, 108, 23, 'B00002', 'Cloud Native Java', 1, 650, 650, '2021-05-14'),
(154, 109, 23, 'B00002', 'Cloud Native Java', 1, 650, 650, '2021-05-14'),
(155, 110, 23, 'B00002', 'Cloud Native Java', 2, 650, 1300, '2021-05-14'),
(156, 111, 22, 'B00001', 'Core Java SE 9 for the Impatient', 2, 390, 780, '2021-05-14'),
(157, 112, 22, 'B00001', 'Core Java SE 9 for the Impatient', 1, 390, 390, '2021-05-14'),
(158, 113, 22, 'B00001', 'Core Java SE 9 for the Impatient', 2, 390, 780, '2021-05-14'),
(159, 114, 23, 'B00002', 'Cloud Native Java', 4, 650, 2600, '2021-05-14'),
(160, 115, 22, 'B00001', 'Core Java SE 9 for the Impatient', 1, 390, 390, '2021-05-14'),
(161, 116, 23, 'B00002', 'Cloud Native Java', 1, 650, 650, '2021-05-14'),
(162, 117, 22, 'B00001', 'Core Java SE 9 for the Impatient', 2, 390, 780, '2021-05-14'),
(163, 118, 22, 'B00001', 'Core Java SE 9 for the Impatient', 1, 390, 390, '2021-05-14'),
(164, 119, 23, 'B00002', 'Cloud Native Java', 1, 650, 650, '2021-05-14'),
(165, 120, 22, 'B00001', 'Core Java SE 9 for the Impatient', 1, 390, 390, '2021-05-14'),
(166, 121, 23, 'B00002', 'Cloud Native Java', 1, 650, 650, '2021-05-14'),
(167, 122, 23, 'B00002', 'Cloud Native Java', 1, 650, 650, '2021-05-14'),
(168, 123, 23, 'B00002', 'Cloud Native Java', 1, 650, 650, '2021-05-14'),
(171, 126, 22, 'B00001', 'Core Java SE 9 for the Impatient', 1, 400, 400, '2021-05-14'),
(172, 126, 25, 'A00002', 'Python ', 2, 390, 780, '2021-05-14'),
(173, 127, 26, 'A00003', 'Python 2', 5, 450, 2250, '2021-05-14'),
(174, 128, 27, 'A00004', 'Python 3', 2, 350, 700, '2021-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_code` char(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_category` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `purchase_price` float(10,0) NOT NULL,
  `sell_price` float(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `min_stock` int(11) NOT NULL,
  `product_satuan` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_code`, `product_name`, `product_category`, `purchase_price`, `sell_price`, `stock`, `min_stock`, `product_satuan`, `description`, `img`) VALUES
(22, 'B00001', 'Core Java SE 9 for the Impatient', 'หนังสือ', 360, 400, 49, 10, 'เล่ม', '.', '609e6ffb2cf22.jpg'),
(25, 'A00002', 'Python ', 'หนังสือ', 350, 390, 98, 10, 'เล่ม', 'Python Cookbook 1 By O\'reilly', '609e986c967a1.jpg'),
(26, 'A00003', 'Python 2', 'หนังสือ', 400, 450, 45, 10, 'เล่ม', '...', '609e9ad78c84e.jpg'),
(27, 'A00004', 'Python 3', 'หนังสือ', 300, 350, 48, 10, 'เล่ม', 'no description', '609ea045a7c2a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `kd_satuan` int(2) NOT NULL,
  `nm_satuan` varchar(20) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`kd_satuan`, `nm_satuan`) VALUES
(16, 'ชิ้น'),
(17, 'เล่ม');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_storedetail`
--

CREATE TABLE `tbl_storedetail` (
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tel` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_storedetail`
--

INSERT INTO `tbl_storedetail` (`name`, `address`, `detail`, `tel`, `id`) VALUES
('ภูมิศักดิ์การค้า', '18/5 ถนนประชาราษฎร์ 1 แขวงวงศ์สว่าง เขตบางซื่อ กรุงเทพฯ 10800', 'จำหน่ายหนังสือ และ อุปกรณ์การเรียน', '061-234-5678', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `fullname`, `password`, `role`, `is_active`) VALUES
(1, 'admin', 'admin', '123456', 'Admin', 1),
(7, 'book', 'book', '123123', 'Operator', 1),
(8, 'test', 'สหรัฐ', '123456', 'Operator', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`),
  ADD UNIQUE KEY `cat_name_2` (`cat_name`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tbl_invoice_detail`
--
ALTER TABLE `tbl_invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_code` (`product_code`,`product_name`);

--
-- Indexes for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`kd_satuan`),
  ADD UNIQUE KEY `nm_satuan` (`nm_satuan`);

--
-- Indexes for table `tbl_storedetail`
--
ALTER TABLE `tbl_storedetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `tbl_invoice_detail`
--
ALTER TABLE `tbl_invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `kd_satuan` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_storedetail`
--
ALTER TABLE `tbl_storedetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
