-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 04:23 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

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
  `expense_date` date DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `additional_comment` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_date`, `category`, `amount`, `additional_comment`, `date`, `added_by`) VALUES
(3, '2020-02-02', 1, '500', 'February, 2020 Updated.', '2020-03-12 02:10:42', 1);

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
(3, 'Himel Control', 'a:14:{i:0;s:13:\"createMethods\";i:1;s:13:\"updateMethods\";i:2;s:11:\"viewMethods\";i:3;s:13:\"deleteMethods\";i:4;s:9:\"createWeb\";i:5;s:9:\"updateWeb\";i:6;s:7:\"viewWeb\";i:7;s:9:\"deleteWeb\";i:8;s:11:\"createGroup\";i:9;s:11:\"updateGroup\";i:10;s:9:\"viewGroup\";i:11;s:11:\"deleteGroup\";i:12;s:13:\"updateControl\";i:13;s:11:\"viewControl\";}');

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` int(11) NOT NULL,
  `invest_date` date DEFAULT NULL,
  `investorID` int(11) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `invest_date`, `investorID`, `amount`, `purpose`, `date`, `added_by`) VALUES
(1, '2020-02-02', 1, '5000', 'Demo Invest Updated', '2020-03-12 00:56:03', 1);

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
  `pending` int(11) DEFAULT NULL,
  `available` int(11) DEFAULT NULL,
  `processing_fee` varchar(11) DEFAULT NULL,
  `buy_rate` int(11) DEFAULT NULL,
  `sell_rate` int(11) DEFAULT NULL,
  `acc_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `methods`
--

INSERT INTO `methods` (`id`, `name`, `icon`, `is_dollar`, `pending`, `available`, `processing_fee`, `buy_rate`, `sell_rate`, `acc_number`) VALUES
(2, 'Bkash', 'IMG_1583085667_JDPic2.jpg', 0, 500, 300, '2', 50, 100, '172576215'),
(3, 'Web Money', 'IMG_1583261815_JDPic1.jpg', 1, 0, 397, '0.8', 84, 98, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`) VALUES
(1, 'hell yeah updated');

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
  `from_account_no` varchar(255) DEFAULT NULL,
  `tranx_id` varchar(255) DEFAULT NULL,
  `to_method` int(11) DEFAULT NULL,
  `to_account_no` varchar(255) DEFAULT NULL,
  `amount_give` varchar(255) DEFAULT NULL,
  `processing_fee` varchar(50) DEFAULT NULL,
  `total_amount` varchar(50) DEFAULT NULL,
  `amount_received` varchar(255) DEFAULT NULL,
  `is_completed` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `completed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `send_pro_fee`, `receive_pro_fee`, `user_id`, `invoice`, `from_method`, `from_account_no`, `tranx_id`, `to_method`, `to_account_no`, `amount_give`, `processing_fee`, `total_amount`, `amount_received`, `is_completed`, `date`, `completed_by`) VALUES
(1, NULL, NULL, 1, '20200310-33988', 2, '0178284', 'akks671bsh', 3, '88371973', '1000', '28', '1028', '10.204081632653061', 1, '2020-03-10 09:26:28', 1),
(2, NULL, NULL, 1, '20200310-34230', 2, 'adsadas', 'asdsadsa', 3, 'asdasdsa', '1000', '28', '1028', '10.204081632653061', 1, '2020-03-10 09:30:30', NULL),
(3, NULL, NULL, 1, '20200310-34381', 2, 'adsadas', 'akks671bsh', 3, '88371973', '10', '0.28', '10.28', '0.10204081632653061', 2, '2020-03-10 09:33:01', NULL),
(4, NULL, NULL, 1, '20200310-34552', 2, 'adsadas', 'akks671bsh', 3, 'asdasdsa', '100', '2.8', '102.8', '1.0204081632653061', 0, '2020-03-10 09:35:52', NULL),
(5, NULL, NULL, 1, '20200310-34983', 2, 'adsadas', 'asdsadsa', 3, '88371973', '100', '2.8', '102.8', '1.0204081632653061', 0, '2020-03-10 09:43:03', NULL),
(6, NULL, NULL, 1, '20200310-35357', 2, 'adsadas', 'akks671bsh', 3, 'asdasdsa', '1000', '28', '1028', '10.204081632653061', 0, '2020-03-10 09:49:17', NULL),
(7, '20', '8', 1, '20200316-20273', 2, 'adsadas', 'akks671bsh', 3, '88371973', '1000', '28', '1028', '10.204081632653061', 2, '2020-03-16 05:37:53', 1),
(8, '200', '0.816326530612245', 1, '20200316-21269', 2, '01782840097', 'asdsadsa', 3, '88371973', '10000', '280', '10280', '102.04081632653062', 1, '2020-03-16 05:54:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pending_review`
--

CREATE TABLE `pending_review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pending_review`
--

INSERT INTO `pending_review` (`id`, `user_id`, `review`, `date`, `status`) VALUES
(1, 1, 'Hi there.. Test Review', '2020-03-12 16:51:51', 1),
(3, 1, 'Hi', '2020-03-16 20:36:11', 0);

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
(1, 'Joy Das', 'joyd451@gmail.com', '01831586368', '51673', 1, 'Hello', 1, '2020-02-08 19:18:57'),
(2, 'Prothom', 'prothom@prothom.com', '12345', 'hey', 1, 'Prothom\'s Address.', 1, '2020-03-10 15:08:40'),
(3, 'Himel Barua', 'himel@himel.com', '012345', 'password', 1, 'Himel\'s Address.', 1, '2020-03-10 15:11:41'),
(4, 'aa', 'joyd451@gmail.com', '01', 'hey', 1, '', 1, '2020-03-12 11:51:31'),
(5, 'jj', 'joyd451@gmail.com', '012', 'hey', 1, '', 1, '2020-03-12 12:00:11'),
(6, 'JJ', 'joydas@gmail.com', '0123', '123', 2, '', 1, '2020-03-12 12:07:45');

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
(6, 6, 2);

--
-- Indexes for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pending_review`
--
ALTER TABLE `pending_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
