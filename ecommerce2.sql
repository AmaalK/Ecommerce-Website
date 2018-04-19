-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2018 at 11:24 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `BuyerID` int(9) NOT NULL,
  `CreditCardNo` int(12) NOT NULL,
  `UserID` int(9) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNo` int(12) NOT NULL,
  `Username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`BuyerID`, `CreditCardNo`, `UserID`, `Email`, `PhoneNo`, `Username`) VALUES
(1, 12, 2, 'bb@aucegypt.edu', 182, NULL),
(2, 3, 3, 'omar@aucegypt.edu', 3, NULL),
(3, 56, 4, 'f@aucegypt.edu', 12, NULL),
(4, 65, 5, 'faf@aucegypt.edu', 23123, NULL),
(5, 34, 6, 'ads@aucegypt.edu', 243, NULL),
(6, 243, 7, 'asdaf@aucegyt', 2930, NULL),
(7, 2687, 8, 'aaa@aucegypt.edu', 7, NULL),
(8, 9898, 9, 'bbbb@aucegypt.edu', 989, NULL),
(9, 89, 10, 'hfgf@aucegypt.edu', 545, NULL),
(10, 568, 11, 'try@aucegypt.edu', 10223, NULL),
(11, 125, 12, 'test@aucegypt.edu', 99, '098f6bcd4621d373cade4e832627b4f6');

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
  `ProductID` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--
-- --------------------------------------------------------

--
-- Table structure for table `product_item`
--

CREATE TABLE `product` (
  `ProductID` int(9) NOT NULL,
  `SellerID` int(9) NOT NULL,
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
  `PhoneNo` int(12) NOT NULL,
  `Username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`SellerID`, `UserID`, `Email`, `PhoneNo`, `Username`) VALUES
(1, 4, 'f@aucegypt.edu', 12, NULL),
(2, 5, 'faf@aucegypt.edu', 23123, NULL),
(3, 9, 'bbbb@aucegypt.edu', 989, NULL),
(4, 10, 'hfgf@aucegypt.edu', 545, NULL),
(5, 11, 'try@aucegypt.edu', 10223, NULL),
(6, 12, 'test@aucegypt.edu', 99, '098f6bcd4621d373cade4e832627b4f6');

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
  `Username` varchar(255) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `PhoneNo` int(12) NOT NULL,
  `CreditCardName` varchar(50) NOT NULL,
  `CreditCardNo` int(12) NOT NULL,
  `CreditCardPin` int(4) NOT NULL,
  `ExpDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usern`
--

INSERT INTO `usern` (`UserID`, `FirstName`, `LastName`, `Email`, `Password`, `Username`, `Country`, `City`, `PhoneNo`, `CreditCardName`, `CreditCardNo`, `CreditCardPin`, `ExpDate`) VALUES
(1, 'amaal', 'emam', 'amaalkhalid@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', '18b29aae028d52e346c429130812ee82', '', '', 1013076094, '', 1253, 0, '0000-00-00'),
(2, 'tarek', 'sama', 'bb@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', 'd4466cce49457cfea18222f5a7cd3573', '', '', 182, '', 12, 0, '0000-00-00'),
(3, 'aa', 'aa', 'omar@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', 'a44a3775b4dfcad29b79ce86faeb6443', '', '', 3, '', 3, 0, '0000-00-00'),
(4, 'aa', 'aa', 'f@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', '99c45e92383960ceef76ffa5314a9ba2', '', '', 12, '', 56, 0, '0000-00-00'),
(5, 'aa', 'aa', 'faf@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', '92eb5ffee6ae2fec3ad71c777531578f', '', '', 23123, '', 65, 0, '0000-00-00'),
(6, 'asd', 'asd', 'ads@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', '49f0bad299687c62334182178bfd75d8', '', '', 243, '', 34, 0, '0000-00-00'),
(7, 'amal', 'emam', 'asdaf@aucegyt', '4124bc0a9335c27f086f24ba207a4912', '68c42382c8b93fc29c2fcb6a444aeda5', '', '', 2930, '', 243, 0, '0000-00-00'),
(8, 'amaal', 'khalid', 'aaa@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', 'dd8e221b68dd31b1c8d16b5e875bb38a', '', '', 7, '', 2687, 0, '0000-00-00'),
(9, 'aa', 'aa', 'bbbb@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', '7e586dee60a6ab530489c64ea7a7748a', '', '', 989, '', 9898, 0, '0000-00-00'),
(10, 'aa', 'aa', 'hfgf@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', 'f6122c971aeb03476bf01623b09ddfd4', '', '', 545, '', 89, 0, '0000-00-00'),
(11, 'amaal', 'emam', 'try@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', '080f651e3fcca17df3a47c2cecfcb880', '', '', 10223, '', 568, 875, '0000-00-00'),
(12, 'Amaal', 'Emam', 'test@aucegypt.edu', '4124bc0a9335c27f086f24ba207a4912', '098f6bcd4621d373cade4e832627b4f6', '', '', 99, '', 125, 98, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`BuyerID`),
  ADD KEY `CreditCardNo` (`CreditCardNo`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `Email` (`Email`),
  ADD KEY `PhoneNo` (`PhoneNo`),
  ADD KEY `Username` (`Username`);

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
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `product`
--
--
-- Indexes for table `product_item`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `StoreID` (`StoreID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`SellerID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `Email` (`Email`),
  ADD KEY `PhoneNo` (`PhoneNo`),
  ADD KEY `Username` (`Username`);

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
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `CreditCardNo` (`CreditCardNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
  MODIFY `BuyerID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `SellerID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `StoreID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usern`
--
ALTER TABLE `usern`
  MODIFY `UserID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `buyer_ibfk_1` FOREIGN KEY (`CreditCardNo`) REFERENCES `usern` (`CreditCardNo`),
  ADD CONSTRAINT `buyer_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `usern` (`UserID`),
  ADD CONSTRAINT `buyer_ibfk_3` FOREIGN KEY (`Email`) REFERENCES `usern` (`Email`),
  ADD CONSTRAINT `buyer_ibfk_4` FOREIGN KEY (`PhoneNo`) REFERENCES `usern` (`PhoneNo`),
  ADD CONSTRAINT `buyer_ibfk_5` FOREIGN KEY (`Username`) REFERENCES `usern` (`Username`);

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
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `product_item`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`StoreID`) REFERENCES `store` (`StoreID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`SellerID`) REFERENCES `seller` (`SellerID`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `usern` (`UserID`),
  ADD CONSTRAINT `seller_ibfk_2` FOREIGN KEY (`Email`) REFERENCES `usern` (`Email`),
  ADD CONSTRAINT `seller_ibfk_3` FOREIGN KEY (`PhoneNo`) REFERENCES `usern` (`PhoneNo`),
  ADD CONSTRAINT `seller_ibfk_4` FOREIGN KEY (`Username`) REFERENCES `usern` (`Username`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `seller` (`SellerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
