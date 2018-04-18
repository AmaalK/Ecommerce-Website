-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2018 at 12:10 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test3`
--

-- --------------------------------------------------------

--
-- Table structure for table `billinginformation`
--

CREATE TABLE `billinginformation` (
  `CreditCardName` varchar(50) NOT NULL,
  `CreditCardNo` int(12) NOT NULL,
  `CreditCardPin` int(4) NOT NULL,
  `ExpDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `BuyerID` int(9) NOT NULL,
  `CreditCardNo` int(12) NOT NULL,
  `UserID` int(9) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(9) NOT NULL,
  `BuyerID` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `Quantity` int(9) NOT NULL,
  `ProductID` int(9) NOT NULL,
  `CartID` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `StoreID` int(9) NOT NULL,
  `SellerID` int(9) NOT NULL,
  `CategoryID` int(9) NOT NULL,
  `CategoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderr`
--

CREATE TABLE `orderr` (
  `OrderID` int(9) NOT NULL,
  `OrderDate` date NOT NULL,
  `Cost` int(9) NOT NULL,
  `BuyerID` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `Quantity` int(9) NOT NULL,
  `OrderID` int(9) NOT NULL,
  `ProductID` int(9) NOT NULL,
  `StoreID` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(9) NOT NULL,
  `ProductName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_item`
--

CREATE TABLE `product_item` (
  `ProductID` int(9) NOT NULL,
  `StoreID` int(9) NOT NULL,
  `CategoryID` int(9) NOT NULL,
  `Price` int(9) NOT NULL,
  `In_Stock` int(9) NOT NULL,
  `Description_Item` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `SellerID` int(9) NOT NULL,
  `UserID` int(9) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `StoreID` int(9) NOT NULL,
  `SellerID` int(9) NOT NULL,
  `StoreName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usern`
--

CREATE TABLE `usern` (
  `UserID` int(9) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billinginformation`
--
ALTER TABLE `billinginformation`
  ADD PRIMARY KEY (`CreditCardNo`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`BuyerID`),
  ADD KEY `CreditCardNo` (`CreditCardNo`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `Email` (`Email`),
  ADD KEY `PhoneNo` (`PhoneNo`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `BuyerID` (`BuyerID`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`ProductID`,`CartID`),
  ADD KEY `CartID` (`CartID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`),
  ADD KEY `StoreID` (`StoreID`),
  ADD KEY `SellerID` (`SellerID`);

--
-- Indexes for table `orderr`
--
ALTER TABLE `orderr`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `BuyerID` (`BuyerID`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`OrderID`,`ProductID`,`StoreID`),
  ADD KEY `ProductID` (`ProductID`,`StoreID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`ProductID`,`StoreID`),
  ADD KEY `StoreID` (`StoreID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`SellerID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `Email` (`Email`),
  ADD KEY `PhoneNo` (`PhoneNo`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`StoreID`),
  ADD KEY `SellerID` (`SellerID`);

--
-- Indexes for table `usern`
--
ALTER TABLE `usern`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `PhoneNo` (`PhoneNo`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
  MODIFY `BuyerID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderr`
--
ALTER TABLE `orderr`
  MODIFY `OrderID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `SellerID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `StoreID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usern`
--
ALTER TABLE `usern`
  MODIFY `UserID` int(9) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `buyer_ibfk_1` FOREIGN KEY (`CreditCardNo`) REFERENCES `billinginformation` (`CreditCardNo`),
  ADD CONSTRAINT `buyer_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `usern` (`UserID`),
  ADD CONSTRAINT `buyer_ibfk_3` FOREIGN KEY (`Email`) REFERENCES `usern` (`Email`),
  ADD CONSTRAINT `buyer_ibfk_4` FOREIGN KEY (`PhoneNo`) REFERENCES `usern` (`PhoneNo`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`BuyerID`) REFERENCES `buyer` (`BuyerID`);

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `cart_product_ibfk_2` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`StoreID`) REFERENCES `store` (`StoreID`),
  ADD CONSTRAINT `category_ibfk_2` FOREIGN KEY (`SellerID`) REFERENCES `seller` (`SellerID`);

--
-- Constraints for table `orderr`
--
ALTER TABLE `orderr`
  ADD CONSTRAINT `orderr_ibfk_1` FOREIGN KEY (`BuyerID`) REFERENCES `buyer` (`BuyerID`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orderr` (`OrderID`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`ProductID`,`StoreID`) REFERENCES `product_item` (`ProductID`, `StoreID`);

--
-- Constraints for table `product_item`
--
ALTER TABLE `product_item`
  ADD CONSTRAINT `product_item_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `product_item_ibfk_2` FOREIGN KEY (`StoreID`) REFERENCES `store` (`StoreID`),
  ADD CONSTRAINT `product_item_ibfk_3` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `usern` (`UserID`),
  ADD CONSTRAINT `seller_ibfk_2` FOREIGN KEY (`Email`) REFERENCES `usern` (`Email`),
  ADD CONSTRAINT `seller_ibfk_3` FOREIGN KEY (`PhoneNo`) REFERENCES `usern` (`PhoneNo`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `seller` (`SellerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
