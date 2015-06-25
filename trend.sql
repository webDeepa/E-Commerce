-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2015 at 09:10 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trend`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`customerid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerid`, `firstname`, `lastname`, `email`, `password`, `phone`, `address`) VALUES
(1, 'Dave', 'Wadsworth', 'dave@gmail.com', '1610838743cc90e3e4fdda748282d9b8', '0210582123', 'address 1'),
(2, 'David', 'Miller', 'david@gmail.com', '172522ec1028ab781d9dfd17eaca4427', '0210784512', 'address 2'),
(3, 'John', 'Williams', 'john@gmail.com', '527bd5b5d689e2c32ae974c6229ff785', '078392174', 'Billing address'),
(4, 'Martin', 'Jones', 'martin@gmail.com', '925d7518fc597af0e43f5606f9a51512', '078352159', 'Billing address'),
(5, 'Harry', 'Jackson', 'harry@gmail.com', '3b87c97d15e8eb11e51aa25e9a5770e9', '0275253148', 'Billing address'),
(6, 'Robert', 'Redford', 'robert@gmail.com', '684c851af59965b680086b7b4896ff98', '0274561245', 'Billing address'),
(7, 'Deepa', 'Subra', 'deepa@gmail.com', '29987ce14a9c7b9137f616843eca049b', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `maincategory`
--

CREATE TABLE IF NOT EXISTS `maincategory` (
`maincategoryid` int(11) NOT NULL,
  `maincategoryname` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `maincategoryimageurl` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maincategory`
--

INSERT INTO `maincategory` (`maincategoryid`, `maincategoryname`, `description`, `maincategoryimageurl`) VALUES
(1, 'Formal', 'Formal men''s clothes', 'formal.jpg'),
(2, 'Casual', '						Casual men''s clothes', 'casual.jpg'),
(3, 'Winter Wear', 'Men''s winter wear', 'winterwear.jpg'),
(4, 'Sleepwear', 'Men''s sleepwear', 'sleepwear.jpg'),
(5, 'Accessories', 'Men&#039;s accessories - wallet, watch, scarf, tie.', 'accessories.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
`orderdetailid` int(11) NOT NULL,
  `ordernumber` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productname` varchar(60) NOT NULL,
  `productdescription` text NOT NULL,
  `size` varchar(15) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderdetailid`, `ordernumber`, `productid`, `productname`, `productdescription`, `size`, `price`, `quantity`, `subtotal`) VALUES
(3, 3, 3, 'Blue Shirt', 'Blue men''s formal shirt', 'small', '62.99', 2, '125.98'),
(4, 3, 12, 'Thermal top', 'Men''s thermal top', 'medium', '59.99', 2, '119.98'),
(5, 4, 3, 'Blue Shirt', 'Blue men''s formal shirt', 'small', '62.99', 2, '125.98'),
(6, 4, 12, 'Thermal top', 'Men''s thermal top', 'medium', '59.99', 2, '119.98'),
(7, 5, 16, 'Grey robe', 'Men''s grey robe', 'extralarge', '59.99', 1, '59.99'),
(8, 5, 13, 'Thermal pant', 'Men''s thermal pant', 'small', '69.99', 1, '69.99'),
(9, 6, 3, 'Blue Shirt', 'Blue men''s formal shirt', 'small', '62.99', 2, '125.98'),
(10, 6, 8, 'Khaki jean', 'Men''s casual khaki jean', 'small', '59.99', 1, '59.99'),
(11, 7, 3, 'Blue Shirt', 'Blue men''s formal shirt', 'small', '62.99', 2, '125.98'),
(12, 7, 8, 'Khaki jean', 'Men''s casual khaki jean', 'small', '59.99', 1, '59.99'),
(13, 8, 1, 'Purple shirt', 'Purple formal men''s shirt', 'small', '59.99', 1, '59.99'),
(14, 8, 14, 'Brown pyjama', 'Men''s brown pyjama set', 'small', '59.99', 1, '59.99'),
(15, 9, 15, 'Blue pyjama', 'Men''s blue pyjama set', 'small', '69.99', 1, '69.99'),
(16, 10, 15, 'Blue pyjama', 'Men''s blue pyjama set', 'small', '69.99', 2, '139.98'),
(17, 11, 18, 'Brown watch', 'Men''s brown watch', 'medium', '134.59', 8, '1076.72'),
(18, 12, 19, 'Long wallet', 'Men''s long wallet', 'medium', '124.99', 2, '249.98'),
(19, 13, 3, 'Blue Shirt', 'Blue men''s formal shirt', 'small', '62.99', 1, '62.99'),
(20, 14, 10, 'Brown jacket', 'Men''s brown jacket', 'small', '59.99', 1, '59.99');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`ordernumber` int(11) NOT NULL,
  `orderdate` date NOT NULL,
  `customerid` int(11) NOT NULL,
  `transactionstatus` varchar(20) NOT NULL,
  `shippingname` varchar(40) NOT NULL,
  `shippingaddress` text NOT NULL,
  `billingaddress` text NOT NULL,
  `deliverytype` varchar(20) NOT NULL,
  `phonenumber` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ordernumber`, `orderdate`, `customerid`, `transactionstatus`, `shippingname`, `shippingaddress`, `billingaddress`, `deliverytype`, `phonenumber`) VALUES
(3, '2015-05-20', 4, 'paid', 'Susan Jones', 'shipping address', 'billing address', 'standard', '0210458695'),
(4, '2015-05-20', 4, 'paid', 'Susan Jones', 'shipping address', 'billing address', 'standard', '0210458695'),
(5, '2015-05-20', 5, 'paid', 'Harry Jackson', 'Shipping address', 'Billing address', 'standard', '0275253148'),
(6, '2015-05-20', 3, 'paid', 'John Williams', 'Shipping address', 'Billing address', 'standard', '078392174'),
(7, '2015-05-20', 2, 'paid', 'Mary Miller', 'Shipping address', 'address 2', 'standard', '0210784512'),
(8, '2015-05-20', 1, 'paid', 'Preetha Wadsworth', 'Shipping address', 'address 1', 'standard', '0210582123'),
(9, '2015-05-20', 4, 'paid', 'Martin Jones', 'Shipping address', 'Billing address', 'standard', '078352159'),
(10, '2015-05-25', 6, 'paid', 'Robert Redford', 'Shipping address', 'Billing address', 'standard', '0270457878'),
(11, '2015-05-25', 6, 'paid', 'Robert Redford', 'Shipping address', 'Billing address', 'standard', '0274561245'),
(12, '2015-05-25', 4, 'paid', 'Martin Jones', 'Shipping address', 'Billing address', 'standard', '078352159'),
(13, '2015-05-25', 4, 'paid', 'Martin Jones', 'Shipping address', 'Billing address', 'standard', '078352159'),
(14, '2015-06-02', 2, 'paid', 'David Miller', 'Shipping address', 'address 2', 'express', '0210784512');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`productid` int(11) NOT NULL,
  `productname` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `productimageurl` varchar(50) NOT NULL,
  `sizeid` int(11) NOT NULL,
  `subcategoryid` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `productkeywords` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `productname`, `description`, `productimageurl`, `sizeid`, `subcategoryid`, `price`, `productkeywords`) VALUES
(1, 'Purple Shirt', 'Purple formal men&#039;s shirt', 'purpleshirt.jpg', 1, 1, '69.99', 'shirts, formals'),
(3, 'Blue Shirt', 'Blue men''s formal shirt', 'blueshirt.jpg', 2, 1, '62.99', 'shirts, formals'),
(4, 'Khaki Pant', 'Men''s formal khaki pant', 'khakipant.jpg', 3, 2, '59.99', 'pants, formals, Trousers'),
(5, 'Grey Pant', 'Men''s formal grey pant', 'greypant.jpg', 4, 2, '69.99', ' 	pants, formals, Trousers'),
(6, 'Blue T-Shirt', 'Men''s casual blue t-shirt', 'bluetshirt.jpg', 5, 3, '59.99', 'T-shirts, casuals, polo shirt'),
(7, 'White T-Shirt', 'Men''s casual white t-shirt', 'whitetshirt.jpg', 6, 3, '69.99', 'T-shirts, casuals, polo shirt'),
(8, 'Khaki Jean', 'Men''s casual khaki jean', 'khakijean.jpg', 7, 4, '59.99', 'jeans, casuals, party wear'),
(9, 'Blue Jean', 'Men&#039;s casual blue jean', 'bluejean.jpg', 8, 4, '69.99', 'jeans, casuals, party wear'),
(10, 'Brown Jacket', 'Men''s brown jacket', 'brownjacket.jpg', 9, 5, '59.99', 'jackets, overcoats, Winter wear'),
(11, 'Black Jacket', 'Men''s black jacket', 'blackjacket.jpg', 10, 5, '69.99', 'jackets, overcoats, Winter wear'),
(12, 'Thermal Top', 'Men''s thermal top', 'thermaltop.jpg', 11, 6, '59.99', 'thermals, Winter wear'),
(13, 'Thermal Pant', 'Men''s thermal pant', 'thermalpant.jpg', 12, 6, '69.99', 'thermals, Winter wear'),
(14, 'Brown Pyjama', 'Men''s brown pyjama set', 'bluebrownpyjama.jpg', 13, 7, '59.99', 'Sleepwear, pyjamas, night wear'),
(15, 'Blue Pyjama', 'Men''s blue pyjama set', 'bluepyjama.jpg', 14, 7, '69.99', 'Sleepwear, pyjamas, night wear'),
(16, 'Grey Robe', 'Men&#039;s grey robe', 'greyrobe.jpg', 15, 8, '69.99', 'Sleepwear, robes, night wear'),
(17, 'Blue Robe', 'Men&#039;s blue robe', 'bluerobe.jpg', 16, 8, '59.99', 'Sleepwear, robes, night wear'),
(18, 'Brown Watch', 'Men&#039;s  accessories  brown watch', 'brownwatch.jpg', 19, 11, '134.59', 'accessories, watches'),
(19, 'Long Wallet', 'Men&#039;s  accessories  long wallet', 'wallet1.jpg', 24, 10, '124.99', 'accessories, wallets');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE IF NOT EXISTS `size` (
`sizeid` int(11) NOT NULL,
  `small` int(11) NOT NULL,
  `medium` int(11) NOT NULL,
  `large` int(11) NOT NULL,
  `extralarge` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`sizeid`, `small`, `medium`, `large`, `extralarge`) VALUES
(1, 10, 10, 10, 10),
(2, 7, 0, 6, 9),
(3, 10, 25, 15, 0),
(4, 25, 28, 0, 30),
(5, 25, 28, 10, 30),
(6, 25, 5, 11, 30),
(7, 25, 11, 18, 30),
(8, 15, 9, 20, 30),
(9, 24, 28, 0, 30),
(10, 21, 28, 10, 15),
(11, 5, 28, 15, 30),
(12, 25, 28, 30, 0),
(13, 25, 0, 15, 30),
(14, 23, 0, 28, 30),
(15, 18, 19, 9, 21),
(16, 17, 13, 19, 12),
(19, 0, 51, 0, 0),
(24, 0, 43, 0, 0),
(25, 4, 0, 0, 0),
(26, 2, 0, 0, 0),
(27, 1, 0, 0, 0),
(28, 2, 0, 0, 0),
(29, 3, 0, 0, 0),
(30, 1, 1, 1, 1),
(31, 1, 4, 5, 0),
(32, 3, 3, 3, 3),
(33, 5, 5, 5, 55),
(34, 2, 4, 4, 4),
(35, 4, 4, 4, 14),
(36, 2, 20, 0, 0),
(37, 1, 0, 0, 0),
(38, 8, 8, 8, 8),
(39, 2, 1, 1, 0),
(40, 2, 2, 2, 2),
(41, 1, 1, 1, 1),
(42, 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
`subcategoryid` int(11) NOT NULL,
  `subcategoryname` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `subcategoryimageurl` varchar(50) NOT NULL,
  `maincategoryid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategoryid`, `subcategoryname`, `description`, `subcategoryimageurl`, `maincategoryid`) VALUES
(1, 'Shirts', 'Men''s formal shirts', 'shirt.jpg', 1),
(2, 'Pants', 'Men''s formal pants', 'pant.jpg', 1),
(3, 'T-Shirts', 'Men&#039;s casual T-shirt', 'casualtshirt.jpg', 2),
(4, 'Jeans', 'Men''s casual jeans', 'casualjeans.jpg', 2),
(5, 'Jackets', 'Men''s casual jackets and overcoats', 'subjacket.jpg', 3),
(6, 'Thermals', 'Men''s thermals', 'subthermal.jpg', 3),
(7, 'Pyjamas', 'Men''s pyjama sets', 'subpyjama.jpg', 4),
(8, 'Robes', 'Men''s robes', 'subrobe.jpg', 4),
(10, 'Wallets', 'Men&#039;s wallet', 'wallet.jpg', 5),
(11, 'Watches', 'Men&#039;s watches', 'watches.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
`wishlistid` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `productid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlistid`, `customerid`, `productid`) VALUES
(1, 1, 1),
(6, 2, 1),
(7, 3, 3),
(8, 4, 3),
(9, 1, 3),
(10, 2, 17),
(11, 4, 6),
(12, 5, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `maincategory`
--
ALTER TABLE `maincategory`
 ADD PRIMARY KEY (`maincategoryid`), ADD FULLTEXT KEY `maincategoryname` (`maincategoryname`,`description`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
 ADD PRIMARY KEY (`orderdetailid`), ADD KEY `ordernumber` (`ordernumber`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`ordernumber`), ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`productid`), ADD KEY `sizeid` (`sizeid`), ADD KEY `subcategoryid` (`subcategoryid`), ADD FULLTEXT KEY `FullText` (`description`,`productkeywords`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
 ADD PRIMARY KEY (`sizeid`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
 ADD PRIMARY KEY (`subcategoryid`), ADD KEY `maincategoryid` (`maincategoryid`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
 ADD PRIMARY KEY (`wishlistid`), ADD KEY `customerid` (`customerid`), ADD KEY `productid` (`productid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `maincategory`
--
ALTER TABLE `maincategory`
MODIFY `maincategoryid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
MODIFY `orderdetailid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `ordernumber` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
MODIFY `sizeid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
MODIFY `subcategoryid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
MODIFY `wishlistid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`ordernumber`) REFERENCES `orders` (`ordernumber`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`customerid`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`sizeid`) REFERENCES `size` (`sizeid`),
ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategoryid`) REFERENCES `subcategory` (`subcategoryid`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`maincategoryid`) REFERENCES `maincategory` (`maincategoryid`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`customerid`),
ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`productid`) REFERENCES `products` (`productid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
