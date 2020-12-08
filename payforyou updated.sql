-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 08:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payforyou`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `acNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `methodID` int(11) NOT NULL,
  `balance` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acNumber`, `methodID`, `balance`) VALUES
(1, '01818105488', 2, '890'),
(3, 'balchal@skrillaccount', 6, '7.789'),
(4, '01677096016', 2, '51');

-- --------------------------------------------------------

--
-- Table structure for table `advertise`
--

CREATE TABLE `advertise` (
  `id` int(11) NOT NULL,
  `placement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adlink` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `advertise`
--

INSERT INTO `advertise` (`id`, `placement`, `adlink`, `active`) VALUES
(1, 'indexAD1', '<a href=\"http://s.click.aliexpress.com/e/eXMq6oIG?bz=320*480\" target=\"_parent\"><img width=\"320\" height=\"480\" src=\"https://ae01.alicdn.com/kf/HTB1WU.XJ3HqK1RjSZFkq6x.WFXaK/EN_320_480.jpg\"/></a>', 1),
(2, 'indexAD2', '<a href=\"https://s.click.aliexpress.com/e/_dZvR7OK?bz=500*500\" target=\"_parent\"><img width=\"300\" height=\"250\" src=\"//ae01.alicdn.com/kf/H570a54cd21fa4c59ba7a0ec6d368dfe08.png\"/></a>', 1),
(3, 'indexAD3', '', 1),
(4, 'indexAD4', '', 1),
(5, 'checkoutADLeft', '', 1),
(6, 'checkoutADRight', '', 1),
(7, 'contactADLeft', '', 1),
(8, 'contactADRight', '', 1),
(9, 'regADLeft', '', 1),
(10, 'regADRight', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Electricity Updated');

-- --------------------------------------------------------

--
-- Table structure for table `cominfo`
--

CREATE TABLE `cominfo` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `mail_address` varchar(50) DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cominfo`
--

INSERT INTO `cominfo` (`id`, `name`, `mobile`, `address`, `mail_address`, `fb_link`, `twitter_link`, `about`) VALUES
(1, 'Pay4You', '01831586368', 'Company Address..', 'mail@mail.com', 'facebook.com/joydas69', 'facebook.com/joydas69', 'Company updated About us..');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense_date` varchar(255) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `additional_comment` text DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_date`, `category`, `amount`, `additional_comment`, `date`, `added_by`) VALUES
(3, '1586023200', 1, '500', 'February, 2020 Updated.', '1586105892', 1),
(4, '1586023200', 1, '100', 'bill dichi... to kiribi???', '1586105892', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `permission` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'developer', 'a:14:{i:0;s:13:\"createMethods\";i:1;s:13:\"updateMethods\";i:2;s:11:\"viewMethods\";i:3;s:13:\"deleteMethods\";i:4;s:9:\"createWeb\";i:5;s:9:\"updateWeb\";i:6;s:7:\"viewWeb\";i:7;s:9:\"deleteWeb\";i:8;s:11:\"createGroup\";i:9;s:11:\"updateGroup\";i:10;s:9:\"viewGroup\";i:11;s:11:\"deleteGroup\";i:12;s:13:\"updateControl\";i:13;s:11:\"viewControl\";}'),
(2, 'Users', NULL),
(3, 'Himel Control', 'a:14:{i:0;s:13:\"createMethods\";i:1;s:13:\"updateMethods\";i:2;s:11:\"viewMethods\";i:3;s:13:\"deleteMethods\";i:4;s:9:\"createWeb\";i:5;s:9:\"updateWeb\";i:6;s:7:\"viewWeb\";i:7;s:9:\"deleteWeb\";i:8;s:11:\"createGroup\";i:9;s:11:\"updateGroup\";i:10;s:9:\"viewGroup\";i:11;s:11:\"deleteGroup\";i:12;s:13:\"updateControl\";i:13;s:11:\"viewControl\";}'),
(4, 'Random', 'a:14:{i:0;s:13:\"createMethods\";i:1;s:13:\"updateMethods\";i:2;s:11:\"viewMethods\";i:3;s:13:\"deleteMethods\";i:4;s:9:\"createWeb\";i:5;s:9:\"updateWeb\";i:6;s:7:\"viewWeb\";i:7;s:9:\"deleteWeb\";i:8;s:11:\"createGroup\";i:9;s:11:\"updateGroup\";i:10;s:9:\"viewGroup\";i:11;s:11:\"deleteGroup\";i:12;s:13:\"updateControl\";i:13;s:11:\"viewControl\";}');

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` int(11) NOT NULL,
  `invest_date` varchar(255) DEFAULT NULL,
  `investorID` int(11) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `invest_date`, `investorID`, `amount`, `purpose`, `date`, `added_by`) VALUES
(1, '1586103746', 1, '5000', 'Demo Invest Updated', '1586103746', 1);

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`id`, `name`, `mobile`, `percentage`, `address`, `date`) VALUES
(1, 'Joy Das', '01831586368', '20', 'ghfgfh', '2020-03-12 00:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `methods`
--

CREATE TABLE `methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_dollar` int(11) DEFAULT NULL,
  `pending` varchar(255) DEFAULT '0',
  `available` varchar(255) DEFAULT '0',
  `processing_fee` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `buy_rate` varchar(255) DEFAULT NULL,
  `sell_rate` varchar(255) DEFAULT NULL,
  `cashInAmountDaily` varchar(255) NOT NULL,
  `cashInCountDaily` int(11) NOT NULL,
  `cashInAmountMonthly` varchar(255) NOT NULL,
  `cashInCountMonthly` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `methods`
--

INSERT INTO `methods` (`id`, `name`, `icon`, `is_dollar`, `pending`, `available`, `processing_fee`, `buy_rate`, `sell_rate`, `cashInAmountDaily`, `cashInCountDaily`, `cashInAmountMonthly`, `cashInCountMonthly`) VALUES
(2, 'Bkash', 'assets/images/methods/IMG_1583085667_JDPic2.jpg', 0, '-155', '940', '2', '50', '100', '30000', 5, '200000', 25),
(3, 'Web Money', 'assets/images/methods/IMG_1583261815_JDPic1.jpg', 1, '-11', '283', '0.8', '85', '98', '', 0, '', 0),
(4, 'Web Money 1', 'assets/images/methods/IMG_1583261815_JDPic1.jpg', 1, '-1', '396', '0.8', '84', '98', '', 0, '', 0),
(5, 'Bkash 1', 'assets/images/methods/IMG_1583085667_JDPic2.jpg', 0, '1340', '300', '2', '50', '100', '', 0, '', 0),
(6, 'Skrill', 'assets/images/methods/IMG_1585935585_CYMERA_20180207_193157.jpg', 1, '0', '107.789', '1', '85', '100', '1000', 10, '100000', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `active`) VALUES
(1, 'hell yeah updated', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `send_pro_fee` varchar(50) DEFAULT NULL,
  `receive_pro_fee` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `from_method` int(11) DEFAULT NULL,
  `from_method_account` int(11) NOT NULL,
  `from_account_no` varchar(255) DEFAULT NULL,
  `tranx_id` varchar(255) DEFAULT NULL,
  `to_method` int(11) DEFAULT NULL,
  `to_method_account` int(11) NOT NULL DEFAULT 0,
  `to_account_no` varchar(255) DEFAULT NULL,
  `amount_give` varchar(255) DEFAULT NULL,
  `processing_fee` varchar(50) DEFAULT NULL,
  `total_amount` varchar(50) DEFAULT NULL,
  `amount_received` varchar(255) DEFAULT NULL,
  `is_completed` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `completed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `send_pro_fee`, `receive_pro_fee`, `user_id`, `invoice`, `from_method`, `from_method_account`, `from_account_no`, `tranx_id`, `to_method`, `to_method_account`, `to_account_no`, `amount_give`, `processing_fee`, `total_amount`, `amount_received`, `is_completed`, `date`, `completed_by`) VALUES
(14, '0', '0', 1, '2020040568607', 6, 3, '12345@skrillaccount', 'asdasd', 2, 1, '01818105488', '1', '0', '1', '85', 1, '1586027007', 1),
(15, '0', '0', 7, '2020040735945', 6, 3, '12345@skrillaccount', 'hvkhvkhvkhvkv', 2, 1, '01818105488', '1', '0', '1', '85', 1, '1586253545', 1),
(16, '22.22', '0.111', 1, '2020040736204', 2, 1, '01818105499', 'hvkhvkhvkhvkv', 6, 3, 'asda@asda.com', '1111', '33.3', '1145', '11.1', 1, '1586253804', 1),
(17, '0', '0', 1, '2020040969621', 6, 3, '12345@skrillaccount', 'hvkhvkhvkhvkv', 2, 1, '29526216951', '1', '0', '1', '85', 1, '1586373621', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pending_review`
--

CREATE TABLE `pending_review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pending_review`
--

INSERT INTO `pending_review` (`id`, `user_id`, `review`, `date`, `status`) VALUES
(1, 1, 'Hi there.. Test Review', '1586103746', 1),
(4, 7, 'baal chaal', '1586103746', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addedBy` int(11) NOT NULL,
  `stockInvoice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accountPreviousAmount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `methodPreviousAmount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `accountID`, `amount`, `datetime`, `addedBy`, `stockInvoice`, `accountPreviousAmount`, `methodPreviousAmount`, `description`) VALUES
(1, 4, '10', '1586096718', 1, 'S2020040551918', '41', '125', ''),
(2, 3, '10', '1586096784', 1, 'S2020040551984', '5', '105', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `user_group` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password`, `gender`, `address`, `user_group`, `created_at`) VALUES
(1, 'Joy Das', 'joyd451@gmail.com', '01831586368', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, 'Hello', 1, '2020-02-08 19:18:57'),
(2, 'Prothom', 'prothom@prothom.com', '12345', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, 'Prothom\'s Address.', 1, '2020-03-10 15:08:40'),
(3, 'Himel Barua', 'himel@himel.com', '012345', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, 'Himel\'s Address.', 1, '2020-03-10 15:11:41'),
(4, 'aa', 'joyd451@gmail.com', '01', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, '', 1, '2020-03-12 11:51:31'),
(5, 'jj', 'joyd451@gmail.com', '012', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, '', 1, '2020-03-12 12:00:11'),
(6, 'JJ', 'joydas@gmail.com', '0123', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 2, '', 1, '2020-03-12 12:07:45'),
(7, 'Prothom Acharjee', 'peculiarprothom@gmail.com', '01818105488', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, 'Nunu', 1, '2020-04-02 06:42:09'),
(9, 'adasdasd', 'asdasd@adasd.com', '01819621420', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, '4776 N French Rd', 1, '2020-04-02 06:46:13'),
(10, 'asdasd', 'asda@afd.com', '8554238977', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, '4776 N French Rd', 1, '2020-04-02 06:47:38'),
(12, 'asdasd', 'asdasd@adad.com', '23', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, '', 1, '2020-04-03 15:52:10'),
(13, 'sddfsdf', 'sdfsd@sfsf.com', '01888888', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, '', 1, '2020-04-07 09:32:27'),
(14, 'asd', 'asda@asd.com', '01818105482', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, '', 1, '2020-04-09 13:24:52'),
(15, 'asd', 'asda@asd.com', '01818105487', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, '', 1, '2020-04-09 13:32:46'),
(16, 'mnnmmn', 'asd@sdsd.com', '85542389771', '$2y$10$uTzwxmMrvMxMnvcb6XPo4.tvd2hxbjgPcAmnVv70S2U5SPNZPL5ve', 1, '4776 N French Rd', 1, '2020-04-09 14:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 2),
(5, 5, 2),
(6, 6, 2),
(8, 7, 2),
(9, 9, 2),
(10, 10, 2),
(12, 12, 2),
(13, 13, 2),
(14, 14, 2),
(15, 15, 2),
(16, 16, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertise`
--
ALTER TABLE `advertise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cominfo`
--
ALTER TABLE `cominfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `methods`
--
ALTER TABLE `methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_review`
--
ALTER TABLE `pending_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `advertise`
--
ALTER TABLE `advertise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cominfo`
--
ALTER TABLE `cominfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `methods`
--
ALTER TABLE `methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pending_review`
--
ALTER TABLE `pending_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
