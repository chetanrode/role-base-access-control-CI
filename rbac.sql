-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2019 at 10:36 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roles-permission-codignator`
--

-- --------------------------------------------------------

--
-- Table structure for table `device_type`
--

CREATE TABLE `device_type` (
  `typeId` int(11) NOT NULL,
  `deviceType` varchar(200) NOT NULL,
  `createdDtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `device_type`
--

INSERT INTO `device_type` (`typeId`, `deviceType`, `createdDtm`, `updatedDtm`) VALUES
(1, 'Home Automation', '2019-02-09 10:11:06', '0000-00-00 00:00:00'),
(2, 'Home Appliances', '2019-02-09 10:12:42', '0000-00-00 00:00:00'),
(3, 'Home Energy Management ', '2019-02-09 10:12:42', '0000-00-00 00:00:00'),
(4, 'IoT Home Security and Safety ', '2019-02-09 10:13:42', '0000-00-00 00:00:00'),
(5, 'IoT Health and Fitness ', '2019-02-09 10:13:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `iot_devices`
--

CREATE TABLE `iot_devices` (
  `deviceId` int(11) NOT NULL,
  `deviceType` varchar(255) DEFAULT NULL,
  `deviceName` varchar(255) NOT NULL,
  `stock` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) DEFAULT NULL,
  `updatedBy` varchar(200) DEFAULT NULL,
  `createdDtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iot_devices`
--

INSERT INTO `iot_devices` (`deviceId`, `deviceType`, `deviceName`, `stock`, `isDeleted`, `updatedBy`, `createdDtm`, `updatedDtm`) VALUES
(1, 'Home Energy Management ', 'Google Home Voice Controller', '1000', 0, '1', '2019-02-16 21:06:45', '2019-02-16 16:36:12'),
(2, 'Home Energy Management', 'Philips Hue Hue Go', '1000', 0, '1', '2019-02-16 21:07:06', '2019-02-16 16:22:51'),
(3, 'IoT Home Security and Safety ', 'Security Camera', '2000', 0, '1', '2019-02-16 21:07:10', '2019-02-16 16:36:10'),
(4, 'IoT Health and Fitness', 'Heart Rate Monitor', '1000', 0, '1', '2019-02-16 21:06:49', '2019-02-16 16:36:09'),
(5, 'Home Energy Management', 'Ghghhdh', '12', 0, '1', '2019-02-16 21:06:40', '2019-02-16 16:36:08'),
(6, 'Home Energy Management', 'Logitech Pop Smart Button Controller', '500', 0, '1', '2019-02-16 21:06:53', '2019-02-16 16:36:07'),
(7, 'Home Energy Management', 'Logitech Pop Smart Button Controller', '500', 0, '1', '2019-02-16 21:06:57', '2019-02-16 16:36:07'),
(8, 'Home Energy Management', 'Logitech Pop Smart Button Controller', '500', 0, '1', '2019-02-16 21:07:02', '2019-02-16 16:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `description` tinytext,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permission_roles`
--

CREATE TABLE `permission_roles` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `sessionData` varchar(255) DEFAULT NULL,
  `machineIp` varchar(55) DEFAULT NULL,
  `userAgent` varchar(255) DEFAULT NULL,
  `agentString` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `createdDtm` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(1, 1, '{\"role\":\"1\",\"roleText\":\"Super Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(2, 1, '{\"role\":\"1\",\"roleText\":\"Super Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(3, 3, '{\"role\":\"3\",\"roleText\":\"Worker\",\"name\":\"Girish Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(4, 1, '{\"role\":\"1\",\"roleText\":\"Super Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(5, 2, '{\"role\":\"3\",\"roleText\":\"Implementor\",\"name\":\"Chetan Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(6, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(7, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(8, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(9, 2, '{\"role\":\"2\",\"roleText\":\"Implementor\",\"name\":\"Chetan Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(10, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(11, 2, '{\"role\":\"2\",\"roleText\":\"Implementor\",\"name\":\"Chetan Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(12, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(13, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(14, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(15, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(16, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(17, 2, '{\"role\":\"2\",\"roleText\":\"Implementor\",\"name\":\"Chetan Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(18, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(19, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(20, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(21, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(22, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Dhananjay Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(23, 3, '{\"role\":\"2\",\"roleText\":\"Implementor\",\"name\":\"Implementor\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(24, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"admin\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(25, 4, '{\"role\":\"2\",\"roleText\":\"Implementor\",\"name\":\"Chetan Rode\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(26, 3, '{\"role\":\"2\",\"roleText\":\"Implementor\",\"name\":\"Implementor\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(27, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"admin\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(28, 3, '{\"role\":\"2\",\"roleText\":\"Implementor\",\"name\":\"Implementor\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(29, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"admin\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(30, 3, '{\"role\":\"2\",\"roleText\":\"Implementor\",\"name\":\"Implementor\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(31, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"admin\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(32, 3, '{\"role\":\"2\",\"roleText\":\"Implementor\",\"name\":\"Implementor\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL),
(33, 1, '{\"role\":\"1\",\"roleText\":\"Admin\",\"name\":\"Admin\"}', '::1', 'Firefox 54.0', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows 10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `activation_id` int(11) NOT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `client_ip` varchar(255) DEFAULT NULL,
  `createdDtm` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` int(11) NOT NULL,
  `role` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'Admin'),
(2, 'Implementor');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sites`
--

CREATE TABLE `tbl_sites` (
  `siteId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `createdDtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sites`
--

INSERT INTO `tbl_sites` (`siteId`, `address`, `city`, `district`, `state`, `pincode`, `contact`, `isDeleted`, `createdBy`, `updatedBy`, `createdDtm`, `updatedDtm`) VALUES
(1, 'Naendra Nagar', 'Nagpur', 'Nagpur', 'Maharashtra', '778587', '8208133659', 1, 0, 1, '2019-02-16 21:07:27', '2019-02-16 16:37:27'),
(2, 'Naendra Nagar,badil Kheda', 'Nagpur Center', 'Nagpur West', 'Maharashtra Vidarbh', '440010', '7385778289', 1, 0, 1, '2019-02-16 21:07:29', '2019-02-16 16:37:29'),
(3, 'Narendra Nagar', 'Nagpur', 'Nagpur', 'Maharashtra', '778587', '8208133659', 0, 0, 1, '2019-02-10 15:32:00', '2019-02-10 11:02:00'),
(4, 'Shivaji Nagar', 'Nagpur', 'Nagpur', 'Maharashtra', '440010', '8208133659', 0, 0, 0, '2019-02-12 17:33:15', '0000-00-00 00:00:00'),
(5, 'Google', 'California', 'Handala', 'Canada', '440052', '8201246541', 0, 0, 0, '2019-02-12 17:34:30', '0000-00-00 00:00:00'),
(6, 'Manish Nagar', 'Nagpur', 'Nagpur', 'Maharashtra', '445522', '1234567890', 0, 0, 0, '2019-02-12 17:38:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `taskId` int(11) NOT NULL,
  `taskName` varchar(255) NOT NULL,
  `assignTo` varchar(100) NOT NULL,
  `siteId` int(11) NOT NULL,
  `deviceId` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `isDeleted` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `createdDtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedDtm` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`taskId`, `taskName`, `assignTo`, `siteId`, `deviceId`, `description`, `isDeleted`, `status`, `createdDtm`, `updatedDtm`) VALUES
(1, 'Yeshwant Appartment', '4', 1, 1, 'Google Home, The Connected Voice Controller From Google. Besides Controlling Your Home It Also Comes With Google Assistant, Helping With Lists, Translation, News, Music, Calendar And Many Many More.', 1, 1, '2019-02-16 21:24:34', '2019-02-16 16:54:34'),
(2, 'Bhagirathappartment', '4', 4, 1, 'Google Home, The Connected Voice Controller From Google. Besides Controlling Your Home It Also Comes With Google Assistant, Helping With Lists, Translation, News, Music, Calendar And Many Many More.', NULL, 0, '2019-02-16 21:12:48', '2019-02-16 16:42:48'),
(3, 'G-6,seven Heights', '4', 6, 1, 'Google Home, The Connected Voice Controller From Google. Besides Controlling Your Home It Also Comes With Google Assistant, Helping With Lists, Translation, News, Music, Calendar And Many Many More.', 1, 1, '2019-02-16 21:21:27', '2019-02-16 16:51:27'),
(4, 'Concrete Appartment', '3', 2, 4, 'Pulseon\'s Patented Optical Sensor Detecting And Measuring Heart Rate Is Excelling Among Optical Sensors Developed For Continuous, Accurate And Reliable Heart Rate.', NULL, 1, '2019-02-16 21:13:21', '2019-02-16 16:43:21'),
(5, 'Raja Appt', '3', 6, 1, 'Google Home, The Connected Voice Controller From Google. Besides Controlling Your Home It Also Comes With Google Assistant, Helping With Lists, Translation, News, Music, Calendar And Many Many More.', 1, 1, '2019-02-16 21:27:38', '2019-02-16 16:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `roleId` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdBy` varchar(11) NOT NULL,
  `updatedBy` varchar(11) NOT NULL,
  `createdDtm` timestamp NULL DEFAULT NULL,
  `updatedDtm` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `roleId`, `name`, `mobile`, `email`, `password`, `isDeleted`, `createdBy`, `updatedBy`, `createdDtm`, `updatedDtm`) VALUES
(1, 1, 'Admin', '8208133659', 'admin@mail.com', '0192023a7bbd73250516f069df18b500', 0, '', '1', '2019-02-07 18:30:00', '2019-02-16 15:55:26'),
(3, 2, 'Implementor', '9579406741', 'implementor@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0, '1', '', '2019-02-08 11:26:27', NULL),
(4, 2, 'Chetan Rode', '8208133659', 'chetan@hotmail.com', '$2y$10$OVT1uXEe9upI/5kVpGGVF.wod9izDTrW2zGwl4UK75emKe9BlFiR6', 0, '1', '', '2019-02-16 11:05:54', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device_type`
--
ALTER TABLE `device_type`
  ADD PRIMARY KEY (`typeId`);

--
-- Indexes for table `iot_devices`
--
ALTER TABLE `iot_devices`
  ADD PRIMARY KEY (`deviceId`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `permission_roles`
--
ALTER TABLE `permission_roles`
  ADD PRIMARY KEY (`role_id`,`permission_id`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`),
  ADD UNIQUE KEY `UK_Role_Name` (`role`);

--
-- Indexes for table `tbl_sites`
--
ALTER TABLE `tbl_sites`
  ADD PRIMARY KEY (`siteId`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`taskId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device_type`
--
ALTER TABLE `device_type`
  MODIFY `typeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `iot_devices`
--
ALTER TABLE `iot_devices`
  MODIFY `deviceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_sites`
--
ALTER TABLE `tbl_sites`
  MODIFY `siteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
