-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 24, 2016 at 02:52 PM
-- Server version: 5.7.10-log
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mwf_db_demo_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `USER_ID` bigint(20) NOT NULL,
  `PROD_ID` bigint(20) NOT NULL,
  `QTY` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PRODUCT_ID` bigint(20) NOT NULL,
  `PRODUCT_NAME` text NOT NULL,
  `PRODUCT_PRICE` double NOT NULL,
  `PRODUCT_DESC` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PRODUCT_ID`, `PRODUCT_NAME`, `PRODUCT_PRICE`, `PRODUCT_DESC`) VALUES
(1, 'TEST PRODUCT', 850, 'TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST '),
(2, 'afddasf', 500, 'dsasfdas'),
(3, 'dfadfsa', 99999, 'fadfasdfa');

-- --------------------------------------------------------

--
-- Table structure for table `products_pic`
--

CREATE TABLE `products_pic` (
  `PRODUCT_ID` bigint(20) NOT NULL,
  `PIC_ID` bigint(20) NOT NULL,
  `PIC_URL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_pic`
--

INSERT INTO `products_pic` (`PRODUCT_ID`, `PIC_ID`, `PIC_URL`) VALUES
(1, 1, 'https://www.ausmedia.com.au/Mmedia/4TO3.gif'),
(2, 2, 'https://www.ausmedia.com.au/Mmedia/4TO3.gif'),
(3, 3, 'https://www.ausmedia.com.au/Mmedia/4TO3.gif');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `USER_ID` bigint(20) NOT NULL,
  `NAME` text NOT NULL,
  `SURNAME` text NOT NULL,
  `ADDRESS` text NOT NULL,
  `TELEPHONE` text NOT NULL,
  `G_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`USER_ID`, `NAME`, `SURNAME`, `ADDRESS`, `TELEPHONE`, `G_ID`) VALUES
(1, 'Test', 'Administrator', 'Somewhere', '0812345678', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` bigint(20) NOT NULL DEFAULT '0',
  `USER_USERNAME` varchar(128) NOT NULL,
  `USER_PASSWORD` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USER_USERNAME`, `USER_PASSWORD`) VALUES
(1, 'admin', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`USER_ID`,`PROD_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRODUCT_ID`);

--
-- Indexes for table `products_pic`
--
ALTER TABLE `products_pic`
  ADD PRIMARY KEY (`PIC_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `PRODUCT_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products_pic`
--
ALTER TABLE `products_pic`
  MODIFY `PIC_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
