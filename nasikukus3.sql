-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2021 at 12:20 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nasikukus3`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuid` int(255) NOT NULL,
  `menuname` varchar(255) NOT NULL,
  `menudescription` varchar(255) NOT NULL,
  `menuprice` decimal(9,2) DEFAULT NULL,
  `menutype` varchar(255) NOT NULL,
  `menuphoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuid`, `menuname`, `menudescription`, `menuprice`, `menutype`, `menuphoto`) VALUES
(1, 'Nasi Kukus Ayam', 'Nasi, Ayam (1), Kuah, Sayar, Sambal', '5.00', 'Food', 'Nasi Kukus Ayam.jpeg'),
(2, 'Nasi Kukus Ayam Besar', 'Nasi, Ayam (2), Kuah, Sayur, Sambal', '8.00', 'Food', 'Nasi Kukus Ayam Besar.jpeg'),
(3, 'Nasi Ayam Kunyit', 'Nasi, Ayam Kunyit, Kuah, Sayur, Sambal', '4.00', 'Food', 'Nasi Ayam Kunyit.jpeg'),
(4, 'Nasi Ikan Keli Ulam', 'Nasi, Ikan Keli Kuah, Sayur, Sambal', '9.00', 'Food', 'Nasi Ikan Keli Ulam.jpeg'),
(5, 'Kepak Ayam Padu', 'Kepak Ayam Padu (6)', '4.00', 'Food', 'Kepak Ayam Padu.jpeg'),
(6, 'Keropok Lekor', 'Lekor (12)', '3.00', 'Food', 'Keropok Lekor.jpeg'),
(7, 'Bandung', 'Bandung Ice', '2.50', 'Drink', 'B.jpg'),
(8, 'BLACKPINK Pepsi', 'Random BLACKPINK Pepsi (1)', '3.00', 'Drink', 'cghf7bh5qj461.jpg'),
(9, 'Milo', 'Milo Ice', '3.50', 'Drink', 'chocolate-malt-drinks.jpg'),
(11, 'Nasi Daging', 'Nasi, Daging, Sambal', '10.00', 'Food', 'Nasi Kukus Daging Berlada.jpeg'),
(14, 'Nasi Lemak', 'Lemak', '8.90', 'Food', 'customernew.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orderedfood`
--

CREATE TABLE `orderedfood` (
  `ordersid` int(255) NOT NULL,
  `menuid` int(255) NOT NULL,
  `menuname` varchar(255) NOT NULL,
  `menuquantity` int(255) NOT NULL,
  `additionalcomments` varchar(255) NOT NULL,
  `orderedprice` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderedfood`
--

INSERT INTO `orderedfood` (`ordersid`, `menuid`, `menuname`, `menuquantity`, `additionalcomments`, `orderedprice`) VALUES
(1, 3, 'Nasi Ayam Kunyit', 2, 'extra kuah', '4.00'),
(1, 8, 'BLACKPINK Pepsi', 1, 'Jisoo pleasee??', '3.00'),
(1, 7, 'Bandung', 1, '', '2.50'),
(2, 1, 'Nasi Kukus Ayam', 3, '', '5.00'),
(2, 6, 'Keropok Lekor', 1, '', '3.00'),
(2, 7, 'Bandung', 3, '', '2.50'),
(3, 1, 'Nasi Kukus Ayam', 2, 'more sambal', '5.00'),
(4, 2, 'Nasi Kukus Ayam Besar', 3, '', '8.00'),
(4, 6, 'Keropok Lekor', 1, '', '3.00'),
(4, 8, 'BLACKPINK Pepsi', 3, 'Jennie or Lisa', '3.00'),
(5, 3, 'Nasi Ayam Kunyit', 1, '', '4.00'),
(7, 1, 'Nasi Kukus Ayam', 2, 'extra timun', '5.00'),
(7, 8, 'BLACKPINK Pepsi', 2, 'rose', '3.00'),
(8, 6, 'Keropok Lekor', 1, '', '3.00'),
(8, 8, 'BLACKPINK Pepsi', 4, '', '3.00'),
(8, 2, 'Nasi Kukus Ayam Besar', 3, '', '8.00'),
(9, 4, 'Nasi Ikan Keli Ulam', 2, 'no cucumber', '9.00'),
(9, 8, 'BLACKPINK Pepsi', 2, '', '3.00'),
(11, 6, 'Keropok Lekor', 2, 'extra kuah', '3.00'),
(11, 5, 'Kepak Ayam Padu', 1, '', '4.00'),
(13, 6, 'Keropok Lekor', 1, '', '3.00'),
(13, 7, 'Bandung', 1, '', '2.50'),
(13, 9, 'Milo', 1, '', '3.50'),
(14, 1, 'Nasi Kukus Ayam', 3, '', '5.00'),
(14, 9, 'Milo', 2, '', '3.50'),
(15, 8, 'BLACKPINK Pepsi', 1, '', '3.00'),
(15, 6, 'Keropok Lekor', 1, 'extra crispy', '3.00'),
(16, 3, 'Nasi Ayam Kunyit', 2, 'extra chicken', '4.00'),
(16, 9, 'Milo', 2, '', '3.50'),
(18, 2, 'Nasi Kukus Ayam Besar', 2, '', '8.00'),
(18, 7, 'Bandung', 1, 'extra ice', '2.50'),
(18, 6, 'Keropok Lekor', 1, '', '3.00'),
(19, 1, 'Nasi Kukus Ayam', 2, 'no sambal', '5.00'),
(19, 8, 'BLACKPINK Pepsi', 2, '', '3.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ordersid` int(255) NOT NULL,
  `ordersamount` decimal(9,2) NOT NULL,
  `orderstatus` varchar(255) DEFAULT NULL,
  `tablenumber` int(255) DEFAULT NULL,
  `orderdate` timestamp NULL DEFAULT NULL,
  `ordertime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ordersid`, `ordersamount`, `orderstatus`, `tablenumber`, `orderdate`, `ordertime`) VALUES
(1, '13.50', 'Completed', 8, '2021-07-30 04:44:06', '12:44:06'),
(2, '25.50', 'Completed', 2, '2021-07-30 04:44:55', '12:44:55'),
(3, '10.00', 'Completed', 0, '2021-07-30 04:45:38', '12:45:38'),
(4, '36.00', 'Completed', 5, '2021-07-31 04:52:46', '12:52:46'),
(5, '4.00', 'Completed', 0, '2021-07-31 04:55:11', '12:55:11'),
(7, '16.00', 'Completed', 0, '2021-07-31 05:09:02', '13:09:02'),
(8, '39.00', NULL, 0, '2021-07-31 05:11:55', '13:11:55'),
(9, '24.00', 'Completed', 12, '2021-07-31 05:32:45', '13:32:45'),
(11, '10.00', 'Completed', 0, '2021-07-31 07:57:28', '15:57:28'),
(13, '9.00', NULL, 0, '2021-07-31 19:39:41', '03:39:41'),
(14, '22.00', NULL, 7, '2021-07-31 19:40:08', '03:40:08'),
(15, '6.00', 'Completed', 1, '2021-08-03 03:02:04', '11:02:04'),
(16, '15.00', 'Completed', 6, '2021-08-05 20:05:29', '04:05:29'),
(18, '21.50', NULL, 0, '2021-08-05 20:16:53', '04:16:53'),
(19, '16.00', 'Completed', 4, '2021-08-08 20:54:10', '04:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(255) NOT NULL,
  `staffname` varchar(255) NOT NULL,
  `staffemail` varchar(255) NOT NULL,
  `staffposition` varchar(255) NOT NULL,
  `staffpassword` varchar(255) NOT NULL,
  `staffdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `staffname`, `staffemail`, `staffposition`, `staffpassword`, `staffdate`) VALUES
(1, 'Jennie', 'jennie@gmail.com', 'Admin', 'Jojo1234', '2021-05-19'),
(2, 'Lisa', 'lisa@gmail.com', 'Staff', 'Lisa1234', '2021-07-01'),
(3, 'Iskandar', 'iskandarmuzz@gmail.com', 'Staff', 'Whatmyname1', '2021-07-31'),
(5, 'Rosie', 'rose@gmail.com', 'Staff', 'Rosie5678', '2021-07-31'),
(6, 'Hasnah Abd Ghani', 'anabela105@yahoo.com', 'Staff', 'Midnight9', '2021-08-03'),
(8, 'Jisoo', 'jichu@gmail.com', 'Admin', 'Jisoo1234', '2021-08-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuid`);

--
-- Indexes for table `orderedfood`
--
ALTER TABLE `orderedfood`
  ADD KEY `ordersid` (`ordersid`),
  ADD KEY `menuid` (`menuid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ordersid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ordersid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderedfood`
--
ALTER TABLE `orderedfood`
  ADD CONSTRAINT `orderedfood_ibfk_1` FOREIGN KEY (`ordersid`) REFERENCES `orders` (`ordersid`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderedfood_ibfk_2` FOREIGN KEY (`menuid`) REFERENCES `menu` (`menuid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
