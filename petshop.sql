-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2020 at 12:11 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `Order_ID` int(15) NOT NULL,
  `Product_ID` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contains`
--

INSERT INTO `contains` (`Order_ID`, `Product_ID`) VALUES
(11, '0000000000'),
(7, '0000000001'),
(11, '0000000001'),
(7, '0000000002'),
(11, '0000000002');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Email` varchar(320) NOT NULL,
  `Pwd` char(60) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Address` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Email`, `Pwd`, `Name`, `Address`) VALUES
('user2@hotmail.com', '$2y$10$jN.MWrmH6N40tH5hHH77bed1QVHUm5buTFbGQCcQ6LUOz8g/xI4tW', 'user2', 'home address 2'),
('user3@hotmail.com', '$2y$10$1KtE2/V0Tif4JZM07/.FLOZJI/oLlF4ISBOcI.8XWkQeJSqET7s0K', 'user3', 'user3 home address'),
('user4@hotmail.com', '$2y$10$RzSQbXPGn0PmTli6FgGp/etXYbZ1wRgYAQ6N.vkyk6ONehCC28Ysm', 'user', 'Home Address'),
('user@hotmail.com', '$2y$10$OtO/fle6bPLcO2EneDv/9.YHebUpB5aZ5BYnkbC/IuanN2LgTwX0y', 'user', 'Home Address');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` char(5) NOT NULL,
  `Email` varchar(320) NOT NULL,
  `Pwd` char(60) NOT NULL,
  `Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `Email`, `Pwd`, `Name`) VALUES
('00000', 'admin@hotmail.com', '$2y$10$jN.MWrmH6N40tH5hHH77bed1QVHUm5buTFbGQCcQ6LUOz8g/xI4tW', 'MyAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `located_at`
--

CREATE TABLE `located_at` (
  `Warehouse_ID` char(10) NOT NULL,
  `Product_ID` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `managed_by`
--

CREATE TABLE `managed_by` (
  `Emp_ID` char(5) NOT NULL,
  `Order_ID` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `Product_ID` char(10) NOT NULL,
  `Quantity` smallint(10) NOT NULL,
  `Price` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`Product_ID`, `Quantity`, `Price`) VALUES
('0000000000', 1, '20.50'),
('0000000001', 4, '34.99'),
('0000000002', 1, '29.99');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `Card_no` char(19) NOT NULL,
  `Holder_name` char(21) NOT NULL,
  `Billing_address` varchar(1024) NOT NULL,
  `Order_ID` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` char(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Price` decimal(8,2) NOT NULL,
  `Img_File` varchar(260) NOT NULL,
  `Deleted_Flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Name`, `Price`, `Img_File`, `Deleted_Flag`) VALUES
('0000000000', 'Cat Brush', '20.50', 'Cat_Brush.jpg', 0),
('0000000001', 'Fresh Dog Food', '34.99', 'Fresh_Dog_Food.jpg', 0),
('0000000002', 'Scratch Post', '29.99', 'Scratch_Post.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `Order_ID` int(15) NOT NULL,
  `Order_Date` date DEFAULT NULL,
  `Order_Status` varchar(15) DEFAULT NULL,
  `Cust_email` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`Order_ID`, `Order_Date`, `Order_Status`, `Cust_email`) VALUES
(7, NULL, 'New', 'user@hotmail.com'),
(8, NULL, 'New', 'user2@hotmail.com'),
(11, NULL, 'New', 'user3@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE `recipient` (
  `Name` varchar(50) NOT NULL,
  `Order_ID` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recipient_address`
--

CREATE TABLE `recipient_address` (
  `Order_ID` int(15) NOT NULL,
  `Address` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `ID` char(10) NOT NULL,
  `Address` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD PRIMARY KEY (`Order_ID`,`Product_ID`),
  ADD KEY `fkprodid` (`Product_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `located_at`
--
ALTER TABLE `located_at`
  ADD PRIMARY KEY (`Warehouse_ID`,`Product_ID`),
  ADD KEY `fkprodid3` (`Product_ID`);

--
-- Indexes for table `managed_by`
--
ALTER TABLE `managed_by`
  ADD PRIMARY KEY (`Emp_ID`,`Order_ID`),
  ADD KEY `fkid4` (`Order_ID`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`Card_no`),
  ADD KEY `fkid3` (`Order_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `fkemail` (`Cust_email`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`Name`,`Order_ID`),
  ADD KEY `fkid1` (`Order_ID`);

--
-- Indexes for table `recipient_address`
--
ALTER TABLE `recipient_address`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `Order_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contains`
--
ALTER TABLE `contains`
  ADD CONSTRAINT `fkid5` FOREIGN KEY (`Order_ID`) REFERENCES `purchase` (`Order_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkprodid` FOREIGN KEY (`Product_ID`) REFERENCES `order_item` (`Product_ID`) ON DELETE CASCADE;

--
-- Constraints for table `located_at`
--
ALTER TABLE `located_at`
  ADD CONSTRAINT `fkprodid3` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkwarehouseid` FOREIGN KEY (`Warehouse_ID`) REFERENCES `warehouse` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `managed_by`
--
ALTER TABLE `managed_by`
  ADD CONSTRAINT `fkempid` FOREIGN KEY (`Emp_ID`) REFERENCES `employee` (`ID`),
  ADD CONSTRAINT `fkid4` FOREIGN KEY (`Order_ID`) REFERENCES `purchase` (`Order_ID`) ON DELETE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fkprodid2` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`);

--
-- Constraints for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `fkid3` FOREIGN KEY (`Order_ID`) REFERENCES `purchase` (`Order_ID`) ON DELETE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `fkemail` FOREIGN KEY (`Cust_email`) REFERENCES `customer` (`Email`);

--
-- Constraints for table `recipient`
--
ALTER TABLE `recipient`
  ADD CONSTRAINT `fkid1` FOREIGN KEY (`Order_ID`) REFERENCES `purchase` (`Order_ID`) ON DELETE CASCADE;

--
-- Constraints for table `recipient_address`
--
ALTER TABLE `recipient_address`
  ADD CONSTRAINT `fkid2` FOREIGN KEY (`Order_ID`) REFERENCES `recipient` (`Order_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
