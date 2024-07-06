-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 06, 2024 at 08:54 AM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tailwebs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `password` mediumtext DEFAULT NULL,
  `admin_type` int(11) NOT NULL DEFAULT 0 COMMENT '0:admin,1:super admin',
  `otp` varchar(10) DEFAULT NULL,
  `otp_generated_on` datetime DEFAULT NULL,
  `level1` text DEFAULT NULL,
  `level2` text DEFAULT NULL,
  `order_columns` text DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `admin_status` int(11) DEFAULT 0,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `fullname`, `username`, `email`, `profile_image`, `password`, `admin_type`, `otp`, `otp_generated_on`, `level1`, `level2`, `order_columns`, `updated_on`, `admin_status`) VALUES
(1, 'Super Administrator', 'su-admin', 'superadmin@gmail.com', '628300643bca2483d3dc67f0449c97bb.jpg', 'eba2cdec9401d2ebbb14ac8931fcea1ae8c2f4619f24343b01446f2e9367e33ac2e44907724b73700da265a7e14cb7856240e27e7278dc277e2638e82f4aff31q1uSBx2tN1URFLTeoQRKRIfUWo7NDAC6763dslk0xPk=', 1, '742190', '2023-02-14 16:33:30', NULL, NULL, NULL, '2021-12-16 12:07:35', 1),
(2, 'Admin', 'admin', 'admin@gmail.com', '04a7459ed54da20291e475d0b9750387.jpg', 'e09143ee1d3c604a6e1817655b3e5c6ef2126fdf2426f82c5e0ffb5b01d7656b63265cd5e33ef4fea205f4e055d61622079ba4da402bd1147f4ca051706a6e13wzgYGSrfbMiWePNvpXijcX//wq0dWGVwoU2MiQmJ1D8=', 0, NULL, NULL, NULL, NULL, NULL, '2024-07-06 04:38:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `general_setting`
--

DROP TABLE IF EXISTS `general_setting`;
CREATE TABLE IF NOT EXISTS `general_setting` (
  `gs_id` int(11) NOT NULL AUTO_INCREMENT,
  `pri_color` varchar(50) DEFAULT NULL,
  `sec_color` varchar(50) DEFAULT NULL,
  `website_status` int(11) DEFAULT 0 COMMENT '0:live,1:server under maintenance,2:Coming Soon with timer',
  `launch_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`gs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `general_setting`
--

INSERT INTO `general_setting` (`gs_id`, `pri_color`, `sec_color`, `website_status`, `launch_datetime`) VALUES
(1, '#e12b34', '#e4e4e4', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meta_info`
--

DROP TABLE IF EXISTS `meta_info`;
CREATE TABLE IF NOT EXISTS `meta_info` (
  `mi_id` int(11) NOT NULL AUTO_INCREMENT,
  `website_name` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` mediumtext DEFAULT NULL,
  `meta_keywords` mediumtext DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `copyright_year` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `meta_info`
--

INSERT INTO `meta_info` (`mi_id`, `website_name`, `meta_title`, `meta_description`, `meta_keywords`, `logo`, `footer_logo`, `favicon`, `copyright_year`) VALUES
(1, 'Tailwebs', 'Tailwebs', 'Tailwebs', 'Tailwebs', '192e3c867d0fc4e638f16b7d2937650a.png', 'caf367984bd30f6bcd28a08d9a682b70.png', 'a3a28ff6f970f0b72a329f9867c15461.png', '2024-2025');

-- --------------------------------------------------------

--
-- Table structure for table `plugin_script`
--

DROP TABLE IF EXISTS `plugin_script`;
CREATE TABLE IF NOT EXISTS `plugin_script` (
  `ps_id` int(11) NOT NULL AUTO_INCREMENT,
  `header_script` mediumtext DEFAULT NULL,
  `footer_script` mediumtext DEFAULT NULL,
  PRIMARY KEY (`ps_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `marks` varchar(255) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `subject`, `marks`, `updated_on`) VALUES
(1, 'Student 1', 'Math', '77', '2024-07-06 04:40:14'),
(2, 'Student 2', 'Science', '85', '2024-07-06 04:40:23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
