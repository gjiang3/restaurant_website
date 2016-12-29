-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2015 at 07:15 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xloop`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `Number` int(3) NOT NULL,
  `Course` varchar(50) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Number`, `Course`, `Price`) VALUES
(1, 'Sesame Seared Ahi Tuna', 8.95),
(2, 'Bacon Wrapped Scallops', 10.95),
(3, 'Jumbo Shrimp Cocktail', 12.95),
(4, 'Iceberg Lettuce Wedge', 9.95),
(5, 'Mixed Green Salad', 11.95),
(6, 'Classic Caesar Salad', 12.95),
(7, 'Filet Mignon', 19.95),
(8, 'Prime Bone-In Rib-Eye Steak', 21.95),
(9, 'Double Cut Lamb Rib Chops', 23.95),
(10, 'Prime New York Strip', 24.95),
(11, 'Flourless Chocolate Cake', 7.95),
(12, 'Big Chocolate Layer Cake', 8.95),
(13, 'New York Style Cheesecake', 11.95);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`ID` int(11) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `LastName`, `FirstName`, `Phone`) VALUES
(1, 'Troy', 'Helen', '4152252237'),
(2, 'Jiang', 'Guohua', '4082222223'),
(3, 'Smith', 'John', '5109962223'),
(4, 'Taylor', 'David', '4256278730'),
(5, 'Pearce', 'Jon', '4154234226'),
(6, 'Mccarthy', 'kevin', '5103426667'),
(7, 'Brown', 'Chris', '4022268734'),
(8, 'Thompson', 'Michael', '4256978434'),
(9, 'Pfeiffer', 'Michelle', '6567782064'),
(10, 'Bassett', 'Angela', '4228732632');

-- --------------------------------------------------------

--
-- Table structure for table `order_course`
--

CREATE TABLE IF NOT EXISTS `order_course` (
  `orderID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_course`
--

INSERT INTO `order_course` (`orderID`, `courseID`, `QTY`) VALUES
(1, 1, 2),
(1, 4, 1),
(1, 7, 1),
(1, 8, 1),
(2, 2, 1),
(2, 7, 2),
(2, 11, 2),
(3, 3, 1),
(3, 7, 1),
(3, 9, 1),
(3, 12, 1),
(4, 1, 1),
(4, 6, 1),
(4, 7, 2),
(5, 2, 1),
(5, 4, 1),
(5, 8, 1),
(5, 10, 1),
(6, 3, 1),
(6, 5, 2),
(6, 9, 2),
(6, 11, 1),
(7, 3, 2),
(7, 5, 1),
(7, 8, 1),
(7, 10, 1),
(8, 2, 1),
(8, 6, 1),
(8, 8, 2),
(8, 10, 2),
(9, 3, 1),
(9, 6, 2),
(9, 10, 3),
(9, 13, 1),
(10, 1, 2),
(10, 6, 1),
(10, 8, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`Number`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
