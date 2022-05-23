-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2022 at 09:08 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `catid` varchar(45) DEFAULT NULL,
  `catname` varchar(45) DEFAULT NULL,
  `attunique` varchar(45) DEFAULT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `type`, `name`, `catid`, `catname`, `attunique`, `status`) VALUES
(1, 'category', 'VEGETABLES', NULL, NULL, 'categoryVEGETABLES', 1),
(2, 'category', 'NUTS', NULL, NULL, 'categoryNUTS', 1),
(3, 'category', 'HERBS', NULL, NULL, 'categoryHERBS', 1),
(4, 'brand', 'LAHORE', '2', 'NUTS', 'brandLAHORE2', 1),
(5, 'brand', 'KASHMIR', '2', 'NUTS', 'brandKASHMIR2', 1),
(6, 'brand', 'SWAT', '2', 'NUTS', 'brandSWAT2', 1),
(7, 'brand', 'KASHMIR', '3', 'HERBS', 'brandKASHMIR3', 1),
(8, 'brand', 'GILGIT', '3', 'HERBS', 'brandGILGIT3', 1),
(9, 'brand', 'CHINA', '1', 'VEGETABLES', 'brandCHINA1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `totalamount` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `payableamount` varchar(45) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `totalamount`, `discount`, `payableamount`, `datetime`) VALUES
(1, '2726', '26', '2700', '2022-05-20 10:59:49'),
(2, '840', '0', '840', '2022-05-21 11:00:23'),
(3, '150', '0', '150', '2022-05-21 11:00:30'),
(4, '140', '0', '140', '2022-05-22 11:00:39'),
(5, '567.5', '7.5', '560', '2022-05-22 11:01:06'),
(6, '1200', '100', '1100', '2022-05-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetail`
--

CREATE TABLE `invoicedetail` (
  `id` int(11) NOT NULL,
  `invoiceid` varchar(45) DEFAULT NULL,
  `productname` varchar(45) DEFAULT NULL,
  `productid` varchar(45) DEFAULT NULL,
  `categoryid` varchar(45) DEFAULT NULL,
  `brandid` varchar(45) DEFAULT NULL,
  `productdetail` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `stock` varchar(45) DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  `units` varchar(45) DEFAULT NULL,
  `rate` varchar(45) DEFAULT NULL,
  `finalrate` varchar(45) DEFAULT NULL,
  `totalprice` varchar(45) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoicedetail`
--

INSERT INTO `invoicedetail` (`id`, `invoiceid`, `productname`, `productid`, `categoryid`, `brandid`, `productdetail`, `description`, `stock`, `quantity`, `units`, `rate`, `finalrate`, `totalprice`, `datetime`) VALUES
(1, '1', '342', '5', '2', '5', 'NUTS2 - KASHMIR5', 'sadasd', '199', '99', 'Kg', '20', '19', '1881.00', '2022-05-20 10:59:49'),
(2, '1', '3SDSA', '7', '3', '8', 'HERBS3 - GILGIT8', 'asdsadas', '45', '5', 'Pounds', '120', '119', '595.00', '2022-05-20 10:59:49'),
(3, '1', '23', '6', '2', '5', 'NUTS2 - KASHMIR5', 'asdasdas', '140', '20', 'Nos', '13', '12.5', '250.00', '2022-05-20 10:59:49'),
(4, '2', '3SDSA', '7', '3', '8', 'HERBS3 - GILGIT8', 'asdsadas', '40', '5', 'Pounds', '120', '120', '600.00', '2022-05-21 11:00:23'),
(5, '2', '3SDSA', '7', '3', '8', 'HERBS3 - GILGIT8', 'asdsadas', '40', '2', 'Pounds', '120', '120', '240.00', '2022-05-21 11:00:23'),
(6, '3', 'CHIVEG', '9', '1', '9', 'VEGETABLES1 - CHINA9', '', '120', '10', 'Kg', '15', '15', '150.00', '2022-05-21 11:00:30'),
(7, '4', 'CHIVEG', '9', '1', '9', 'VEGETABLES1 - CHINA9', '', '110', '10', 'Kg', '15', '14', '140.00', '2022-05-22 11:00:39'),
(8, '5', '23', '6', '2', '5', 'NUTS2 - KASHMIR5', 'asdasdas', '120', '15', 'Nos', '13', '12.5', '187.50', '2022-05-22 11:01:06'),
(9, '5', '342', '5', '2', '5', 'NUTS2 - KASHMIR5', 'sadasd', '100', '20', 'Kg', '20', '19', '380.00', '2022-05-22 11:01:06'),
(10, '6', '3SDSA', '7', '3', '8', 'HERBS3 - GILGIT8', 'asdsadas', '33', '10', 'Pounds', '120', '120', '1200.00', '2022-05-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `catname` varchar(45) DEFAULT NULL,
  `catid` varchar(45) DEFAULT NULL,
  `brandname` varchar(45) DEFAULT NULL,
  `brandid` varchar(45) DEFAULT NULL,
  `productname` varchar(45) DEFAULT NULL,
  `productdescrpt` varchar(255) DEFAULT NULL,
  `units` varchar(45) DEFAULT NULL,
  `stock` varchar(45) DEFAULT '0',
  `buying` varchar(45) DEFAULT '0',
  `selling` varchar(45) DEFAULT '0',
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `catname`, `catid`, `brandname`, `brandid`, `productname`, `productdescrpt`, `units`, `stock`, `buying`, `selling`, `status`) VALUES
(5, 'NUTS', '2', 'KASHMIR', '5', '342', 'sadasd', 'Kg', '80', '18', '20', 1),
(6, 'NUTS', '2', 'KASHMIR', '5', '23', 'asdasdas', 'Nos', '105', '10', '13', 1),
(7, 'HERBS', '3', 'GILGIT', '8', '3SDSA', 'asdsadas', 'Pounds', '23', '50', '120', 1),
(9, 'VEGETABLES', '1', 'CHINA', '9', 'CHIVEG', '', 'Kg', '100', '12', '15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stockdetails`
--

CREATE TABLE `stockdetails` (
  `id` int(11) NOT NULL,
  `productid` varchar(45) DEFAULT NULL,
  `productname` varchar(100) DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  `unitprice` varchar(45) DEFAULT NULL,
  `totalprice` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `sellername` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockdetails`
--

INSERT INTO `stockdetails` (`id`, `productid`, `productname`, `quantity`, `unitprice`, `totalprice`, `date`, `sellername`) VALUES
(1, '8', 'ASDASD', '12', '90', '1080.00', '2022-05-20', 'ABC'),
(2, '7', '3SDSA', '15', '87', '1305.00', '2022-05-20', 'XYZ'),
(3, '8', 'ASDASD', '35', '80', '2800.00', '2022-05-21', 'TBC'),
(4, '7', '3SDSA', '10', '95', '950.00', '2022-05-21', 'XYW'),
(5, '9', 'CHIVEG', '120', '12', '1440.00', '2022-05-21', 'test'),
(6, '7', '3SDSA', '20', '50', '1000.00', '2022-05-21', 'deno'),
(7, '6', '23', '140', '10', '1400.00', '2022-05-21', 'wea'),
(8, '5', '342', '199', '18', '3582.00', '2022-05-21', 'asasd');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role` varchar(45) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `password`, `role`, `status`) VALUES
(-1, 'imrul 123', 'admin', 'admin', 'admin', 1),
(1, 'md', 'md', '123123', 'Cashier', 1),
(3, 'imrul', 'imrul', '123', 'Staff', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attunique_UNIQUE` (`attunique`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoicedetail`
--
ALTER TABLE `invoicedetail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productname_UNIQUE` (`productname`);

--
-- Indexes for table `stockdetails`
--
ALTER TABLE `stockdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoicedetail`
--
ALTER TABLE `invoicedetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stockdetails`
--
ALTER TABLE `stockdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
