-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2023 at 07:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` varchar(255) DEFAULT NULL,
  `InvoiceNumber` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderNote` varchar(255) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `InvoiceNumber`, `quantity`, `orderNote`, `orderDate`, `paymentMethod`, `orderStatus`) VALUES
(59, 30, '63', 343098410, 2, 'Make sure you deliver fast', '2022-10-03 09:44:00', 'Cash On Delivery', NULL),
(60, 30, '72', 343098410, 1, 'Make sure you deliver fast', '2022-10-03 09:44:00', 'Cash On Delivery', NULL),
(61, 30, '79', 343098410, 3, 'Make sure you deliver fast', '2022-10-03 09:44:01', 'Cash On Delivery', NULL),
(65, 5, '64', 708811244, 3, 'Help and deliver fast', '2022-10-09 08:30:12', 'Cash On Delivery', NULL),
(66, 5, '71', 708811244, 2, 'Help and deliver fast', '2022-10-09 08:30:12', 'Cash On Delivery', NULL),
(67, 5, '82', 135898656, 5, '', '2023-02-11 14:21:07', 'Cash On Delivery', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createuser` varchar(255) DEFAULT NULL,
  `deleteuser` varchar(255) DEFAULT NULL,
  `createbid` varchar(255) DEFAULT NULL,
  `updatebid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `createuser`, `deleteuser`, `createbid`, `updatebid`) VALUES
(1, 'Superuser', '1', '1', '1', '1'),
(2, 'Admin', '1', NULL, '1', '1'),
(3, 'User', NULL, NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `productreviews`
--

INSERT INTO `productreviews` (`id`, `productId`, `rating`, `name`, `email`, `review`, `reviewDate`) VALUES
(8, 66, 5, 'Arinaitwe Gerald', 'gerald@gmail.com', 'your product is good', '2022-02-23 11:35:12'),
(12, 67, 4, 'John Simith', 'john@gmail.com', 'This is the quality product that I was been looking for many years', '2022-02-23 12:11:38'),
(13, 38, 3, 'Amanya Owen', 'owen@gmail.com', 'i like that laptop', '2022-03-01 09:11:28'),
(14, 41, 2, 'Arinaitwe Gerald', 'gerald@gmail.com', 'I like your product', '2022-03-07 08:19:40'),
(19, 68, 1, 'Arinaitwe owen', 'owen@gmail.com', 'This is product I was been looking', '2022-03-07 09:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `Tags` longtext DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `Description`, `Tags`, `creationDate`, `updationDate`) VALUES
(2, 4, 'Led Television', NULL, NULL, '2017-01-26 16:24:52', '26-01-2017 11:03:40 PM'),
(3, 4, 'Television', NULL, NULL, '2017-01-26 16:29:09', ''),
(4, 4, 'Mobiles', NULL, NULL, '2017-01-30 16:55:48', ''),
(5, 4, 'Mobile Accessories', NULL, NULL, '2017-02-04 04:12:40', ''),
(6, 4, 'Laptops', NULL, NULL, '2017-02-04 04:13:00', ''),
(7, 4, 'Computers', NULL, NULL, '2017-02-04 04:13:27', ''),
(8, 3, 'Comics', NULL, NULL, '2017-02-04 04:13:54', ''),
(9, 5, 'Beds', NULL, NULL, '2017-02-04 04:36:45', ''),
(10, 5, 'Sofas', NULL, NULL, '2017-02-04 04:37:02', ''),
(11, 5, 'Dining Tables', NULL, NULL, '2017-02-04 04:37:51', ''),
(12, 6, 'Men Footwears', NULL, NULL, '2017-03-10 20:12:59', ''),
(14, 65, 'winter ware', 'winter wear', 'wear,top', '2022-08-28 20:27:28', NULL),
(15, 60, 'HP probook', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'probook,laptop,hp', '2022-09-08 10:01:47', NULL),
(16, 60, 'Dell Latitute', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'dell,latitude,laptop', '2022-09-08 10:02:38', NULL),
(17, 60, 'HP Notebook', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'notebook,hp,laptop', '2022-09-08 10:04:35', NULL),
(18, 72, 'Dell Vostro', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'vostro,dell', '2022-09-08 10:05:09', NULL),
(19, 72, 'Dell Optiplex', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'optiplex,dell,laptop', '2022-09-08 10:12:45', NULL),
(20, 60, 'Lenovo Thinkpad', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'lenovo thinkpad,lenovo', '2022-09-08 10:58:04', NULL),
(21, 60, 'HP litebook', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'litebook,laptop', '2022-09-08 11:11:35', NULL),
(22, 61, 'HP Printer', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. \r\n', 'printers,hp', '2022-09-08 11:15:50', NULL),
(23, 73, 'Smart TV', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'Television,smart,Tv', '2022-09-08 11:22:46', NULL),
(24, 57, 'Realme', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. \r\n', 'smartphone,nokia,realme', '2022-09-08 11:47:37', NULL),
(25, 57, 'Nokia C1', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'nokia,smartphones', '2022-09-08 12:01:44', NULL),
(26, 17, 'wireless', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry.', 'wireless,headset', '2022-09-08 14:12:26', NULL),
(27, 16, 'Home cameras', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. \r\n', 'cameras,network,home cameras', '2022-09-08 14:17:49', NULL),
(28, 74, 'Led', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'torch,led', '2022-09-08 14:23:30', NULL),
(29, 75, 'wireless speakers', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'wireless speakers', '2022-09-08 14:28:46', NULL),
(30, 57, 'iphone', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'iphone,smartphone', '2022-09-21 07:30:09', NULL),
(31, 14, 'samsaung tablets', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'tablets,samsung', '2022-09-19 15:30:59', NULL),
(32, 16, 'Photo camera', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'camera,photo', '2022-09-19 15:35:22', NULL),
(33, 57, 'Samsung hot10', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'samsung,phone', '2022-09-19 15:40:20', NULL),
(35, 73, 'Hisense', 'Enter description here', 'hisense,smart tv', '2022-10-09 08:38:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `Staffid` int(10) DEFAULT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Birthday` varchar(255) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `activationcode` varchar(255) NOT NULL DEFAULT 'g2o9@h3$n%&h09',
  `Photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'avatar15.jpg',
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `Staffid`, `AdminName`, `UserName`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Birthday`, `Status`, `activationcode`, `Photo`, `Password`, `AdminRegdate`) VALUES
(2, 1002, 'Admin', 'admin', 'John', 'Simith', 770546590, 'john@gmail.com', NULL, 1, 'f6c2a1ba62f83fe43303523d42e60f4d', 'face19.jpg', '81dc9bdb52d04dc20036dbd8313ed055', '2021-06-21 10:18:39'),
(29, 1008, 'User', 'gloria', 'Patience', 'Gloria', 770546590, 'gloria@gmail.com', NULL, 1, 'g2o9@h3$n%&h09', 'avatar15.jpg', '81dc9bdb52d04dc20036dbd8313ed055', '2021-08-25 11:29:20'),
(30, NULL, NULL, 'gerald', 'Arinaitwe', 'Gerald', NULL, 'gerald@gmail.com', NULL, 0, 'g2o9@h3$n%&h09', 'avatar15.jpg', NULL, '2022-08-23 11:24:18'),
(32, NULL, NULL, 'gerald', 'Amanya', 'Owen', NULL, 'owen@gmail.com', NULL, 1, 'g2o9@h3$n%&h09', 'avatar15.jpg', NULL, '2022-08-23 11:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `tblapply`
--

CREATE TABLE `tblapply` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` int(11) DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblapply`
--

INSERT INTO `tblapply` (`id`, `name`, `email`, `contactno`, `session`) VALUES
(1, 'gerald', 'leading@gmail.com', 2147483647, NULL),
(8, 'John Simith', 'john@gmail.com', 2147483647, 'Morning');

-- --------------------------------------------------------

--
-- Table structure for table `tblbrand`
--

CREATE TABLE `tblbrand` (
  `id` int(10) NOT NULL,
  `BrandName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `BrandImage` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbrand`
--

INSERT INTO `tblbrand` (`id`, `BrandName`, `BrandImage`, `PostingDate`) VALUES
(1, 'Samsung', 'samsung.png', '2022-02-24 11:26:07'),
(2, 'Lenovo', 'lenovo.png', '2022-02-24 11:26:21'),
(3, 'Hp', 'hp.png', '2022-02-24 11:26:34'),
(4, 'Dell', 'dell.png', '2022-02-24 11:26:52'),
(5, 'Sony', 'sony.png', '2022-02-24 11:27:19'),
(6, 'Tecno', 'tecno.png', '2022-02-24 11:29:06'),
(7, 'Nokia', 'nokia.png', '2022-03-22 11:49:57'),
(13, 'iphone', 'apple.png', '2022-09-21 07:32:15'),
(22, 'Hisense', 'hisense.png', '2022-10-09 08:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Categorydescription` varchar(50) DEFAULT NULL,
  `Tags` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Categorydescription`, `Tags`, `PostingDate`) VALUES
(14, 'Tablets', NULL, NULL, '2022-02-09 10:56:57'),
(16, 'Cameras', NULL, NULL, '2022-02-10 09:13:05'),
(17, 'Headsets', NULL, NULL, '2022-02-10 09:14:21'),
(57, 'Smartphones', NULL, NULL, '2022-02-24 12:34:38'),
(59, 'Tablets', NULL, NULL, '2022-04-11 11:55:37'),
(60, '	Laptops', NULL, NULL, '2022-04-11 11:56:07'),
(61, 'Printers', NULL, NULL, '2022-04-11 11:56:46'),
(71, 'Bags', 'shopping bags', '', '2022-08-28 20:06:20'),
(72, 'Desktop', 'Lorem Ipsum is simply dummy text of the printing a', 'desktop,laptops', '2022-09-08 10:33:25'),
(73, 'Television', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the prin', 'Television,Tv', '2022-09-08 11:21:34'),
(74, 'Torch', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the prin', 'torch,light', '2022-09-08 14:22:07'),
(75, 'Speakers', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the prin', 'speakers', '2022-09-08 14:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `id` int(11) NOT NULL,
  `regno` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyemail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyphone` int(10) NOT NULL,
  `companyaddress` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `companylogo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'avatar15.jpg',
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`id`, `regno`, `companyname`, `companyemail`, `country`, `companyphone`, `companyaddress`, `companylogo`, `status`, `creationdate`) VALUES
(4, '0008778', 'CODE4BERRY  LTD', 'code4berry@gmail.com', 'Uganda', 770578453, 'Parliamentary Avenue, Eco bank plaza', 'logo.png', '1', '2021-02-02 12:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(11) NOT NULL,
  `CategoryName` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `BrandName` int(11) DEFAULT NULL,
  `ProductName` varchar(150) DEFAULT NULL,
  `Size` varchar(255) DEFAULT NULL,
  `Slug` varchar(255) DEFAULT NULL,
  `Grouptag` varchar(255) DEFAULT NULL,
  `Quantity` int(10) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `ProductImage` varchar(255) DEFAULT NULL,
  `ProductImage2` varchar(255) DEFAULT NULL,
  `ProductImage3` varchar(255) DEFAULT NULL,
  `ProductImage4` varchar(255) DEFAULT NULL,
  `ProductPrice` decimal(10,0) DEFAULT NULL,
  `PriceBefore` decimal(10,0) NOT NULL,
  `ProductDiscount` int(10) DEFAULT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productDetails` longtext DEFAULT NULL,
  `ProductStatus` varchar(255) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `CategoryName`, `Subcategory`, `BrandName`, `ProductName`, `Size`, `Slug`, `Grouptag`, `Quantity`, `Status`, `ProductImage`, `ProductImage2`, `ProductImage3`, `ProductImage4`, `ProductPrice`, `PriceBefore`, `ProductDiscount`, `productDescription`, `productDetails`, `ProductStatus`, `PostingDate`, `UpdationDate`) VALUES
(57, 72, '19', 4, 'OptiPlex 3090 MT /Core i5-10505/ 4GB (1x4GB)DDR4 /  1TB SATA.', NULL, NULL, 'optiplex,dell,desktop', 5, 'New', 'optiplex-7090-i5-mt-2.jpg', 'optiplex-7090-i5-mt-1.jpg', 'optiplex-7090-i5-mt-3.jpg', 'optiplex-7090-i5-mt-3.jpg', '500', '600', 30, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'  standard dummy text ever since the 1500s, when an unknown  printer took a galley of type and scrambled it to make a type specimen.', 'OptiPlex 7090 MT /Core i5-11500/ 4GB (1x4GB)DDR4 /  1TB SATA (7.2k rpm) 3.5\" /8x DVD+/-RW /Intel Integrated Graphics / Dell Multimedia Keyboard - UK (QWERTY) - Black / Dell Optical Mouse - MS116 - Black / Ubuntu Linux 20.04 /1Y ProSupport/CPU Only.', NULL, '2022-09-08 10:38:34', NULL),
(58, 72, '19', 4, 'OptiPlex 3090 MT /Core i5-10505/ 4GB (1x4GB)DDR4 /  1TB SATA.', NULL, NULL, 'optiplex,dell,desktop', 5, 'Special', 'optiplex-3090-i5-mt-1.jpg', 'optiplex-3090-i5-mt-2.jpg', 'optiplex-3090-i5-mt-3.jpg', 'optiplex-3090-i5-mt-3.jpg', '400', '450', 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'  standard dummy text ever since the 1500s, when an unknown  printer took a galley of type and scrambled it to make a type specimen.', 'OptiPlex 3090 MT /Core i5-10505/ 4GB (1x4GB)DDR4 /  1TB SATA (7.2k rpm) 3.5\" /8x DVD+/-RW/ Intel Integrated Graphics / Dell Multimedia Keyboard - UK (QWERTY) - Black / Dell Optical Mouse - MS116 - Black / Ubuntu Linux 20.04 /1Y ProSupport/CPU Only.', NULL, '2022-09-08 10:42:43', NULL),
(59, 72, '19', 4, 'OptiPlex 3090 MT /Core i3-10105/ 4GB (1x4GB)DDR4 /  1TB SATA.', NULL, NULL, 'optiplex,dell,desktop', 51, 'Best', 'optiplex-3090-mt-1.jpg', 'optiplex-3090-mt-2.jpg', 'optiplex-3090-mt-3.jpg', 'optiplex-3090-mt-3.jpg', '800', '900', 20, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'  standard dummy text ever since the 1500s, when an unknown  printer took a galley of type and scrambled it to make a type specimen.', 'OptiPlex 3090 MT /Core i3-10105/ 4GB (1x4GB)DDR4 /  1TB SATA (7.2k rpm) 3.5\" / 8x DVD+/-RW/Intel Integrated Graphics / Dell Multimedia Keyboard - UK (QWERTY) - Black / Dell Optical Mouse - MS116 - Black / Ubuntu Linux 20.04/1Y ProSupport/CPU Only!!', NULL, '2022-09-08 10:46:31', NULL),
(60, 72, '18', 4, 'VOSTRO- 3910 Mini Tower!!,Intel Core i5-12400/ 4GB (1x4GB) DDR4 / 1TB 7200rpm SATA HDD', NULL, NULL, 'vostro,dell,desktop', 10, 'New', 'VOSTRO- 3910-i5-1.jpg', 'VOSTRO- 3910-i5-1.jpg', 'VOSTRO- 3910-i5-1.jpg', 'VOSTRO- 3910-i5-1.jpg', '700', '750', 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'  standard dummy text ever since the 1500s, when an unknown  printer took a galley of type and scrambled it to make a type specimen.', 'VOSTRO- 3910 Mini Tower!!,Intel Core i5-12400/ 4GB (1x4GB) DDR4 / 1TB 7200rpm SATA HDD,/DVD+/-RW/Intel(R) Wi-Fi 6 2x2 (Gig+) and Bluetooth ,Dell Wired Mouse MS116 Black,Dell Multimedia Keyboard - UK (QWERTY) - Black,Ubuntu Linux 20.04,/1 Yr ProSupport/CPU Only.', NULL, '2022-09-08 10:50:00', NULL),
(61, 72, '18', 4, 'DELL Vostro 3910 i3-12100 Midi Tower Intel® Core™ i3', NULL, NULL, 'vostro,core i3 ,dell', 6, 'Special', 'dell-VOSTRO-3910-1.jpg', 'dell-VOSTRO-3910-2.jpg', 'dell-VOSTRO-3910-4.jpg', 'dell-VOSTRO-3910-4.jpg', '650', '700', 15, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'  standard dummy text ever since the 1500s, when an unknown  printer took a galley of type and scrambled it to make a type specimen.', 'VOSTRO- 3910 Mini Tower!!,Intel Core i3-12100/ 4GB (1x4GB)DDR4 / 1TB 7200rpm SATA HDD,/DVD+/-RW/Intel(R) Wi-Fi 6 2x2 (Gig+) and Bluetooth ,Dell Wired Mouse MS116 Black,Dell Multimedia Keyboard - UK (QWERTY) - Black,Ubuntu Linux 20.04,/1 Yr ProSupport /CPU Only.', NULL, '2022-09-08 10:53:35', NULL),
(62, 60, '20', 2, 'Lenovo Thinkpad', NULL, NULL, 'thinkpad,lenovo,laptop', 5, 'New', '4_1.jpg', '4_2.jpg', '4_1.jpg', '4_1.jpg', '550', '600', 30, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-09-08 11:02:40', NULL),
(63, 60, '15', 3, 'probook core i7', NULL, NULL, 'probook,laptop,hp', 18, 'New', '2_1.jpg', '2_1.jpg', '2_1.jpg', '2_1.jpg', '1000', '1200', 0, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-10-03 09:44:00', '2022-10-03 09:44:00'),
(64, 60, '17', 3, 'HP Notepad core i5', NULL, NULL, 'hp,notebook,laptop', 2, 'Best', '1_1.jpg', '1_2.jpg', '1_1.jpg', '1_1.jpg', '770', '800', 25, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-10-09 08:30:12', '2022-10-09 08:30:12'),
(66, 61, '22', 3, 'Hp printer', NULL, NULL, 'printer,hp', 3, 'New', 'officejet  pro 9023.jpg', 'officejet  pro2 9023.jpg', 'officejet  pro4 9023.jpg', 'officejet  pro4 9023.jpg', '770', '800', 5, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-09-22 22:12:47', '2022-09-22 22:12:47'),
(67, 73, '23', 1, 'smart tv', NULL, NULL, 'smart,tv,television', -6, 'New', 'tv.jpg', 'tv1.jpg', 'tv2.jpg', 'tv2.jpg', '300', '400', 0, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-10-08 20:45:37', '2022-10-08 20:45:37'),
(68, 57, '24', 6, 'Realme C11', NULL, NULL, 'realme,smartphone', 18, 'New', 'real.jpg', 'real1.jpg', 'real2.jpg', 'real2.jpg', '60', '70', 5, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-09-08 11:55:14', NULL),
(69, 57, '25', 7, 'Nokia C12E', NULL, NULL, 'nokia,phones', 2, 'Best', 'nokia.jpg', 'nokia2.jpg', 'nokia.jpg', 'nokia.jpg', '30', '50', 8, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-09-08 12:04:01', NULL),
(70, 60, '16', 4, 'Laptop i7 processor 1TB, 6GB', NULL, NULL, 'core i1,laptop,dell', 0, 'Special', '45_1.jpg', '45_2.jpg', '45_1.jpg', '45_1.jpg', '450', '500', 0, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-10-08 20:45:37', '2022-10-08 20:45:37'),
(71, 17, '26', 5, 'wireless blutooth headphone', NULL, '', 'wireless,headphone', -5, 'Special', '44_1.jpg', '44_2.jpg', '44_1.jpg', '44_1.jpg', '40', '45', 10, '\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-10-09 08:30:12', '2022-10-09 08:30:12'),
(72, 16, '27', 5, 'Sharp Air Purifier for homes', NULL, NULL, 'cameras,network cameras', 4, 'Best', '43_1.jpg', '43_2.jpg', '43_1.jpg', '43_1.jpg', '445', '500', 0, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-10-03 09:44:00', '2022-10-03 09:44:00'),
(73, 74, '28', 5, 'Led Torch Light', NULL, NULL, 'led,torch', 4, 'Best', '46_1.jpg', '46_2.jpg', '46_1.jpg', '46_1.jpg', '50', '60', 0, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-09-08 14:26:23', NULL),
(74, 75, '29', 5, 'JBLK wireless speakers', NULL, NULL, 'wireless speakers', -4, 'Best', '3_1.jpg', '3_2.jpg', '3_1.jpg', '3_1.jpg', '200', '300', 10, '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', '\r\n\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\n', NULL, '2022-09-23 14:30:05', '2022-09-23 14:30:05'),
(75, 57, '30', 13, 'iphone 13 max', NULL, NULL, 'iphone,smartphone', 4, 'Best', '42_1.jpg', '42_2.jpg', '42_1.jpg', '42_1.jpg', '1000', '1200', 10, '\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.\r\n', '\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.\r\n', NULL, '2022-09-23 14:30:05', '2022-09-23 14:30:05'),
(76, 17, '26', 5, 'wireless smart headsets', NULL, NULL, 'wireless,headsets', 5, 'Best', 'headsets.jpg', 'headsets.jpg', 'headsets.jpg', 'headsets.jpg', '100', '120', 0, '\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.\r\n', '\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.\r\n', NULL, '2022-09-21 07:47:10', NULL),
(77, 17, '26', 5, 'clear wireless headset', NULL, NULL, 'wireless,headsets', -3, 'New', 'wireless headsets.jpg', 'wireless headsets.jpg', 'wireless headsets.jpg', 'wireless headsets.jpg', '150', '160', 30, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', NULL, '2022-09-23 14:30:05', '2022-09-23 14:30:05'),
(78, 60, '16', 4, 'dell latitude core7', NULL, NULL, 'dell,laptop', 5, 'Special', 'i7-dell-latitude.jpg', 'i7-dell-latitude.jpg', 'i7-dell-latitude.jpg', 'i7-dell-latitude.jpg', '2000', '2200', 20, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', NULL, '2022-09-19 15:26:25', NULL),
(79, 14, '31', 1, 'Samsung tablet', NULL, NULL, 'samsung tablets', -1, 'Special', 'tablet.jpg', 'tablet.jpg', 'tablet.jpg', 'tablet.jpg', '800', '850', 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', NULL, '2022-10-08 20:45:37', '2022-10-08 20:45:37'),
(80, 16, '32', 5, 'Digital camera', NULL, NULL, 'camera,photo', 7, 'Special', 'digital_camera.jpg', 'digital_camera.jpg', 'digital_camera.jpg', 'digital_camera.jpg', '500', '600', 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', NULL, '2022-10-08 21:28:45', '2022-10-08 21:00:00'),
(81, 57, '33', 1, 'Samsung galaxy', NULL, NULL, 'samsung,phone,hot10', 12, 'Special', 'samsung_phone.jpg', 'samsung_phone.jpg', 'samsung_phone.jpg', 'samsung_phone.jpg', '600', '660', 10, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', NULL, '2022-10-08 13:17:51', '2022-10-07 21:00:00'),
(82, 60, '17', 2, 'Lenovo V15', NULL, NULL, 'lenovo v15,lenovo,laptop,notebook', 15, 'New', 'lenovo v15.jpg', 'lenovo v15_1.jpg', 'lenovo v15.jpg', 'lenovo v15.jpg', '350', '400', 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', NULL, '2023-02-11 14:21:07', '2023-02-11 14:21:07'),
(84, 73, '35', 22, 'Hisense smart tv', NULL, NULL, 'smart tv,hisense', 10, 'New', 'hisence.jpg', 'hisence1.jpg', 'hisence2.jpg', 'hisence2.jpg', '500', '600', 20, 'smart tv can be connect on youtube', '24 inc screen', NULL, '2022-10-09 08:41:29', '2022-10-08 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscribe`
--

CREATE TABLE `tblsubscribe` (
  `id` int(10) NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `subscribed_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubscribe`
--

INSERT INTO `tblsubscribe` (`id`, `email`, `subscribed_date`) VALUES
(2, 'gerald@gmail.com', '2022-03-01 12:46:06'),
(15, 'linda@gmail.com', '2022-09-23 09:57:58'),
(16, 'owen@gmail.com', '2022-09-23 10:00:01'),
(17, 'john@gmail.com', '2022-09-23 10:00:32'),
(18, 'dokampu@yahoo.com', '2022-09-23 10:01:50'),
(19, 'geraldarinaitwe123@gmail.com', '2022-09-23 10:02:12'),
(20, 'kevin@gmail.com', '2022-09-23 10:03:13'),
(21, 'owen2@gmail.com', '2022-11-05 19:27:08'),
(22, 'compsci@gmail.com', '2022-11-05 19:35:00'),
(23, 'john@gmail.com', '2022-11-05 19:35:53'),
(24, 'john@gmail.com', '2022-11-05 19:39:03'),
(25, 'john@gmail.com', '2022-11-05 19:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext DEFAULT NULL,
  `shippingCountry` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingZipcode` int(11) DEFAULT NULL,
  `shippingContact` int(10) DEFAULT NULL,
  `billingAddress` varchar(255) DEFAULT NULL,
  `billingCountry` varchar(255) DEFAULT NULL,
  `billingCity` varchar(255) DEFAULT NULL,
  `billingState` varchar(255) DEFAULT NULL,
  `billingZipcode` int(11) DEFAULT NULL,
  `billingContact` int(11) DEFAULT NULL,
  `activationcode` varchar(255) NOT NULL DEFAULT 'g2o9@h3$n%&h09',
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingCountry`, `shippingCity`, `shippingZipcode`, `shippingContact`, `billingAddress`, `billingCountry`, `billingCity`, `billingState`, `billingZipcode`, `billingContact`, `activationcode`, `regDate`, `updationDate`) VALUES
(5, ' Nicole Gerald', 'gerald@gmail.com', 770546590, '81dc9bdb52d04dc20036dbd8313ed055', 'Tankhill Road, Muyenga', NULL, 'New york', 256, NULL, 'Main street Road', NULL, 'New york', NULL, 256, 770546590, '98ab04547bf7fbb0b4805342453923e5', '2022-02-18 09:00:57', ''),
(30, 'Amanya Owen', 'owen@gmail.com', 770546590, '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL, NULL, NULL, NULL, 'Muyenga', 'USA', 'Town4', 'Western', 790, NULL, 'g2o9@h3$n%&h09', '2022-10-03 09:40:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `userId`, `productId`, `postingDate`) VALUES
(27, 30, 75, '2022-10-03 11:16:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblapply`
--
ALTER TABLE `tblapply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbrand`
--
ALTER TABLE `tblbrand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubscribe`
--
ALTER TABLE `tblsubscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tblapply`
--
ALTER TABLE `tblapply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblbrand`
--
ALTER TABLE `tblbrand`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tblsubscribe`
--
ALTER TABLE `tblsubscribe`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
