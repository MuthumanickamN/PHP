-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2022 at 09:19 PM
-- Server version: 5.7.36-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `primestarbeta_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `academy`
--

CREATE TABLE `academy` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academy`
--

INSERT INTO `academy` (`id`, `name`, `logo`) VALUES
(1, 'Prime Star Sport Academy LLC', 'assets/Academy/Prime_Star_Sport_Academy_LLC.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `account_codes`
--

CREATE TABLE `account_codes` (
  `id` int(11) NOT NULL,
  `name_of_service` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_codes`
--

INSERT INTO `account_codes` (`id`, `name_of_service`, `account_code`, `description`, `category`, `prefix`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Badminton Trainning', NULL, 'Badminton Trainning', 'Income', NULL, 'Active', '2022-01-07 14:45:25', '0000-00-00 00:00:00'),
(2, 'Swimming Trainning', NULL, 'Swimming Trainning', 'Income', NULL, 'Active', '2022-01-10 21:05:36', '0000-00-00 00:00:00'),
(3, 'One On One Trainning', NULL, 'One on one session for kids or adults', 'Income', NULL, 'Active', '2022-01-10 21:06:15', '0000-00-00 00:00:00'),
(4, 'Tournament Fee', NULL, 'Payment for Tournament', 'Income', NULL, 'Active', '2022-01-10 21:06:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `account_code_categories`
--

CREATE TABLE `account_code_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `active_kids`
--

CREATE TABLE `active_kids` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `activity_name`, `status`) VALUES
(1, 'Swimming', 'Active'),
(2, 'Badminton', 'Active'),
(3, 'Chess', 'Active'),
(4, 'Table Tennis', 'Active'),
(5, 'Karate', 'Active'),
(6, 'Fitness', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `activity_approvals`
--

CREATE TABLE `activity_approvals` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_lists`
--

CREATE TABLE `activity_lists` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_selections`
--

CREATE TABLE `activity_selections` (
  `id` int(11) NOT NULL,
  `sid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `psa_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contract` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_month_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `head_coach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approval_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_admin_id` int(11) NOT NULL,
  `updated_admin_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_admin_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `discount_applicable` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `discount_type` int(11) DEFAULT NULL,
  `discount_percentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity_selections`
--

INSERT INTO `activity_selections` (`id`, `sid`, `student_id`, `psa_id`, `activity_id`, `location_id`, `contract`, `level_id`, `session_month_id`, `coach_id`, `head_coach_id`, `registration_id`, `student_name`, `status`, `approval_status`, `user_id`, `parent_name`, `parent_mobile`, `parent_email_id`, `parent_user_id`, `serial_number`, `updated_admin_id`, `updated_admin_name`, `updated_admin_email`, `updated_date`, `verified_by`, `created_at`, `updated_at`, `discount_applicable`, `discount_type`, `discount_percentage`) VALUES
(1, 'PS002', 2, 'PSBA002', '1', NULL, 'No', '2', NULL, NULL, '', '2', 'Vishnu karthick', 'Active', 'Approved', '2', 'Karthick', '971552265185', 'srilakshmisundaar@gmail.com', '2', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:53:26', '2022-01-12 18:54:22', 'Yes', 1, '20.00'),
(2, 'PS003', 3, 'PSBA003', '1', NULL, 'No', '2', NULL, NULL, '', '2', 'Shivan Karthick', 'Active', 'Approved', '2', 'Karthick', '971552265185', 'srilakshmisundaar@gmail.com', '2', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:54:50', '2022-01-12 18:56:08', 'No', 0, '0'),
(3, 'PS048', 49, 'PSBA048', '1', NULL, 'No', '1', NULL, NULL, '', '37', 'Samyuktha.V', 'Active', 'Approved', '37', 'Vaidhyanathan.V', '971528598183', 'v.vaidhya@outlook.com', '37', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:56:40', '2022-01-12 18:57:09', 'Yes', 1, '20.00'),
(4, 'PS004', 4, 'PSBA004', '1', NULL, 'No', '1', NULL, NULL, '', '3', 'Joanna Mary Jerry', 'Active', 'Approved', '3', 'Simi Rachel', '971552449010', 'rachu13sm@yahoo.com', '3', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:56:41', '2022-01-12 18:56:52', 'No', 0, '0'),
(5, 'PS005', 5, 'PSBA005', '1', NULL, 'No', '1', NULL, NULL, '', '4', 'Arpita harikrishnan', 'Active', 'Approved', '4', 'Hari Krishnan', '971556306307', 'sreelakshmy.v@gmail.com', '4', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:57:16', '2022-01-12 18:57:26', 'No', 0, '0'),
(6, 'PS047', 48, 'PSBA047', '1', NULL, 'No', '1', NULL, NULL, '', '37', 'Siddharth.V', 'Active', 'Approved', '37', 'Vaidhyanathan.V', '971528598183', 'v.vaidhya@outlook.com', '37', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:57:30', '2022-01-12 18:57:52', 'No', 0, '0'),
(7, 'PS006', 6, 'PSBA006', '1', NULL, 'No', '2', NULL, NULL, '', '5', 'Modit Deepak', 'Active', 'Approved', '5', 'Deepak Dinesh', '971555859232', 'ramyajakka@gmail.com', '5', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:57:42', '2022-01-12 19:37:51', 'No', 0, '0'),
(8, 'PS007', 7, 'PSBA007', '1', NULL, 'No', '1', NULL, NULL, '', '6', 'Abhay Raj', 'Active', 'Approved', '6', 'P.P.Raj', '971506984616', 'ppaj1970@gmail.com', '6', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:58:17', '2022-01-12 18:58:29', 'No', 0, '0'),
(9, 'PS046', 47, 'PSBA046', '1', NULL, 'No', '1', NULL, NULL, '', '36', 'Shreyaansh Girish', 'Active', 'Approved', '36', 'Girish', '971553609421', 'preethi.girish@gmail.com', '36', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:58:25', '2022-01-12 18:58:40', 'No', 0, '0'),
(10, 'PS008', 8, 'PSBA008', '1', NULL, 'No', '1', NULL, NULL, '', '7', 'Jonathan Joseph', 'Active', 'Approved', '7', 'Jonald', '971508508876', 'joesun7@gmail.com', '7', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:58:51', '2022-01-12 19:58:23', 'No', 0, '0'),
(11, 'PS009', 9, 'PSBA009', '1', NULL, 'No', '1', NULL, NULL, '', '7', 'Japheth Joseph', 'Active', 'Approved', '7', 'Jonald', '971508508876', 'joesun7@gmail.com', '7', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:59:29', '2022-01-12 19:58:44', 'Yes', 1, '20.00'),
(12, 'PS045', 46, 'PSSW045', '2', NULL, 'No', '1', NULL, NULL, '', '35', 'Moosa shafeequr', 'Active', 'Approved', '35', 'Shafeequr Rahman', '971501577212', 'toshafeeq@gmail.com', '35', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:59:42', '2022-01-12 19:00:10', 'Yes', 1, '20.00'),
(13, 'PS010', 10, 'PSBA010', '1', NULL, 'No', '1', NULL, NULL, '', '8', 'Adarsh', 'Active', 'Approved', '8', 'raja sekar Ramamoorthy', '971555800490', 'kavithaokm@gmail.com', '8', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 18:59:55', '2022-01-12 19:00:06', 'No', 0, '0'),
(14, 'PS011', 12, 'PSBA011', '1', NULL, 'No', '1', NULL, NULL, '', '9', 'Anadyant', 'Active', 'Approved', '9', 'Ajay subhash', '971507118140', 'dubey.ajay@hotmail.com', '9', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:00:30', '2022-01-12 19:00:40', 'No', 0, '0'),
(15, 'PS044', 45, 'PSSW044', '2', NULL, 'No', '1', NULL, NULL, '', '35', 'Eesa Shafeequr', 'Active', 'Approved', '35', 'Shafeequr Rahman', '971501577212', 'toshafeeq@gmail.com', '35', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:00:41', '2022-01-12 19:00:56', 'No', 0, '0'),
(16, 'PS012', 13, 'PSBA012', '1', NULL, 'No', '1', NULL, NULL, '', '10', 'Sahana Shrikent', 'Active', 'Approved', '10', 'Nivedita', '97150429830', 'niveditashrikent@hotmail.com', '10', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:00:59', '2022-01-12 19:01:07', 'No', 0, '0'),
(17, 'PS013', 14, 'PSBA013', '1', NULL, 'No', '1', NULL, NULL, '', '11', 'Ananya Iyer', 'Active', 'Approved', '11', 'Anand', '971508874673', 'anand158@gmail.com', '11', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:01:27', '2022-01-12 19:01:40', 'No', 0, '0'),
(18, 'PS043', 44, 'PSBA043', '1', NULL, 'No', '1', NULL, NULL, '', '34', 'SAHANAA KOTIEN', 'Active', 'Pending', '34', 'Manohar', '971527773586', 'mkotian238@gmail.com', '34', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:01:27', '2022-01-12 19:01:44', 'No', 0, '0'),
(19, 'PS013', 14, 'PSSW013', '2', NULL, 'No', '2', NULL, NULL, '', '11', 'Ananya Iyer', 'Active', 'Approved', '11', 'Anand', '971508874673', 'anand158@gmail.com', '11', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:01:50', '2022-01-12 19:02:59', 'No', 0, '0'),
(20, 'PS042', 43, 'PSBA042', '1', NULL, 'No', '1', NULL, NULL, '', '33', 'Aneka K.P', 'Active', 'Approved', '33', 'kannan Ashokkumar', '971569033276', 'tprema.tec@gmail.com', '33', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:02:11', '2022-01-12 19:02:44', 'Yes', 1, '20.00'),
(21, 'PS014', 15, 'PSSW014', '2', NULL, 'No', '2', NULL, NULL, '', '11', 'Atharva Iyer', 'Active', 'Approved', '11', 'Anand', '971508874673', 'anand158@gmail.com', '11', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:02:18', '2022-01-12 19:02:35', 'Yes', 1, '20.00'),
(22, 'PS041', 42, 'PSBA041', '1', NULL, 'No', '1', NULL, NULL, '', '33', 'Sanjana sri', 'Active', 'Approved', '33', 'kannan Ashokkumar', '971569033276', 'tprema.tec@gmail.com', '33', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:03:04', '2022-01-12 19:03:18', 'No', 0, '0'),
(23, 'PS015', 16, 'PSBA015', '1', NULL, 'No', '1', NULL, NULL, '', '12', 'Ashwin', 'Active', 'Approved', '12', 'Ramkumar', '971566034384', 'f.l@mail.com', '12', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:03:16', '2022-01-12 19:06:54', 'Yes', 1, '20.00'),
(24, 'PS040', 41, 'PSBA040', '1', NULL, 'No', '1', NULL, NULL, '', '32', 'Nitin Pradeep', 'Active', 'Approved', '32', 'Pradeep', '971509057321', 'keerthanaa.pradeep@gmail.com', '32', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:03:42', '2022-01-12 19:03:54', 'No', 0, '0'),
(25, 'PS016', 17, 'PSBA016', '1', NULL, 'No', '2', NULL, NULL, '', '13', 'Sooriya Venkatraman', 'Active', 'Approved', '13', 'Venkatraman', '971561980256', 'vijisooriya@yahoo.co.in', '13', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:03:42', '2022-01-12 19:03:58', 'Yes', 1, '20.00'),
(26, 'PS017', 18, 'PSBA017', '1', NULL, 'No', '2', NULL, NULL, '', '13', 'Shrijith', 'Active', 'Approved', '13', 'Venkatraman', '971561980256', 'vijisooriya@yahoo.co.in', '13', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:04:16', '2022-01-12 19:04:33', 'No', 0, '0'),
(27, 'PS039', 40, 'PSSW039', '2', NULL, 'No', '1', NULL, NULL, '', '31', 'Rajit Krishna', 'Active', 'Approved', '31', 'Krishna', '971506761363', 'krishna.binsuloom@gmail.com', '31', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:04:20', '2022-01-12 19:04:32', 'No', 0, '0'),
(28, 'PS018', 19, 'PSBA018', '1', NULL, 'No', '1', NULL, NULL, '', '14', 'Armaan  Kumar', 'Active', 'Approved', '14', 'Sandeep Kumar', '971547019400', 'sandeep11sandeep@gmail.com', '14', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:04:54', '2022-01-12 19:05:02', 'No', 0, '0'),
(29, 'PS038', 39, 'PSBA038', '1', NULL, 'No', '1', NULL, NULL, '', '30', 'Vihana rao', 'Active', 'Approved', '30', 'Prajna Rao', '971544770400', 'prajnar19@gmail.com', '30', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:04:58', '2022-01-12 19:05:13', 'No', 0, '0'),
(30, 'PS019', 20, 'PSBA019', '1', NULL, 'No', '1', NULL, NULL, '', '15', 'Sai Shrenik', 'Active', 'Approved', '15', 'Seshendra.V', '971565841387', 'mail2seshendra@gmail.com', '15', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:05:24', '2022-01-12 19:05:33', 'No', 0, '0'),
(31, 'PS037', 38, 'PSSW037', '2', NULL, 'No', '1', NULL, NULL, '', '29', 'jonathan sam joel', 'Active', 'Approved', '29', 'Sam Joel', '971552826852', 'samjoel80@gmail.com', '29', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:05:43', '2022-01-12 19:06:32', 'Yes', 1, '20.00'),
(32, 'PS020', 21, 'PSBA020', '1', NULL, 'No', '1', NULL, NULL, '', '12', 'Anjali Ramkumar', 'Active', 'Approved', '12', 'Ramkumar', '971566034384', 'f.l@mail.com', '12', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:05:55', '2022-01-12 19:06:17', 'No', 0, '0'),
(33, 'PS036', 37, 'PSSW036', '2', NULL, 'No', '1', NULL, NULL, '', '29', 'JOANNA SAM JOEL', 'Active', 'Approved', '29', 'Sam Joel', '971552826852', 'samjoel80@gmail.com', '29', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:06:57', '2022-01-12 19:07:12', 'No', 0, '0'),
(34, 'PS021', 22, 'PSBA021', '1', NULL, 'No', '1', NULL, NULL, '', '16', 'Navneeth', 'Active', 'Approved', '16', 'Dhamodharan', '971506614182', 'dhamus@yahoo.com', '16', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:07:16', '2022-01-12 19:07:24', 'No', 0, '0'),
(35, 'PS035', 36, 'PSBA035', '1', NULL, 'No', '1', NULL, NULL, '', '27', 'Tanmay Maheshwari', 'Active', 'Approved', '27', 'Tanmay Maheshwari', '971501399625', 'ca.maheshwarig@gmail.com', '27', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:07:38', '2022-01-12 19:07:51', 'No', 0, '0'),
(36, 'PS022', 23, 'PSBA022', '1', NULL, 'No', '1', NULL, NULL, '', '17', 'Sahasra Gopal', 'Active', 'Approved', '17', 'Gopal', '97150865489', 'gopalkrishnan.p@gmail.com', '17', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:07:44', '2022-01-12 19:07:54', 'No', 0, '0'),
(37, 'PS034', 35, 'PSBA034', '1', NULL, 'No', '1', NULL, NULL, '', '26', 'Ishaan Ranjith', 'Active', 'Approved', '26', 'Ranjith.P.V', '971558810744', 'ranjith.pv@gmail.com', '26', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:08:20', '2022-01-12 19:08:37', 'No', 0, '0'),
(38, 'PS023', 24, 'PSSW023', '2', NULL, 'No', '2', NULL, NULL, '', '18', 'Sakina Afzal', 'Active', 'Approved', '18', 'Fatima Chandan', '971501852624', 'fchandan1010@yahoo.com', '18', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:08:25', '2022-01-12 19:08:41', 'No', 0, '0'),
(39, 'PS024', 25, 'PSSW024', '2', NULL, 'No', '1', NULL, NULL, '', '18', 'Huzaifa Afzal', 'Active', 'Approved', '18', 'Fatima Chandan', '971501852624', 'fchandan1010@yahoo.com', '18', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:08:57', '2022-01-12 19:09:11', 'Yes', 1, '20.00'),
(40, 'PS033', 34, 'PSBA033', '1', NULL, 'No', '1', NULL, NULL, '', '25', 'Tvisha Kumar', 'Active', 'Approved', '25', 'Arun Kumar', '971527485111', 'aarun.kumaar@gmail.com', '25', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:09:00', '2022-01-12 19:09:13', 'No', 0, '0'),
(41, 'PS025', 26, 'PSBA025', '1', NULL, 'No', '1', NULL, NULL, '', '19', 'Eliza jiwani', 'Active', 'Approved', '19', 'Shahid Jiwani', '971509969410', 'reshmajiwani17@gmail.com', '19', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:09:31', '2022-01-12 19:09:41', 'No', 0, '0'),
(42, 'PS032', 33, 'PSSW032', '2', NULL, 'No', '1', NULL, NULL, '', '24', 'Prapti Rupesh', 'Active', 'Approved', '24', 'Rupesh Gawade', '971528908498', 'rupeshgawadegg@gmail.com', '24', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:09:37', '2022-01-12 19:09:59', 'Yes', 1, '20.00'),
(43, 'PS026', 27, 'PSBA026', '1', NULL, 'No', '1', NULL, NULL, '', '20', 'Adithya Lokesh rao', 'Active', 'Approved', '20', 'Lokesh Rao', '971558999007', 'rlokeshrao@gmail.com', '20', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:09:58', '2022-01-12 19:10:09', 'No', 0, '0'),
(44, 'PS027', 28, 'PSBA027', '1', NULL, 'No', '3', NULL, NULL, '', '21', 'Dhanwanth Raghavan', 'Active', 'Approved', '21', 'Raghavan NRS', '971508189618', 'nrsragav@gmail.com', '21', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:10:23', '2022-01-12 19:10:34', 'No', 0, '0'),
(45, 'PS031', 32, 'PSSW031', '2', NULL, 'No', '1', NULL, NULL, '', '24', 'Bhagya Gawade', 'Active', 'Approved', '24', 'Rupesh Gawade', '971528908498', 'rupeshgawadegg@gmail.com', '24', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:10:35', '2022-01-12 19:10:47', 'No', 0, '0'),
(46, 'PS028', 29, 'PSSW028', '2', NULL, 'No', '1', NULL, NULL, '', '22', 'Devang Gehani', 'Active', 'Approved', '22', 'Manish Gehani', '971503739016', 'manish_hy@yahoo.com', '22', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:10:59', '2022-01-12 19:11:09', 'No', 0, '0'),
(47, 'PS030', 31, 'PSBA030', '1', NULL, 'No', '1', NULL, NULL, '', '23', 'Anushka Anju das', 'Active', 'Approved', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', '23', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:11:14', '2022-01-12 19:11:51', 'Yes', 1, '20.00'),
(48, 'PS029', 30, 'PSBA029', '1', NULL, 'No', '1', NULL, NULL, '', '23', 'Aanya anju Das', 'Active', 'Approved', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', '23', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-12 19:12:19', '2022-01-12 19:12:31', 'No', 0, '0'),
(49, 'PS049', 50, 'PSBA049', '1', NULL, 'No', '1', NULL, NULL, '', '38', 'Sruja Kale', 'Active', 'Approved', '38', 'Upendra Kale', '971567562896', 'upendra.kale@petrofac.com', '38', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-13 09:50:02', '2022-01-13 09:50:16', 'No', 0, '0'),
(50, 'PS050', 51, 'PSBA050', '1', NULL, 'No', '1', NULL, NULL, '', '39', 'Ashwath', 'Active', 'Approved', '39', 'Karthick Raj', '971564048624', 'pjennispandian@gmail.com', '39', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-13 10:17:01', '2022-01-13 10:17:53', 'No', 0, '0'),
(51, 'PS051', 52, 'PSBA051', '1', NULL, 'No', '1', NULL, NULL, '', '40', 'Meghna Balasubramaniyam', 'Active', 'Approved', '40', 'Bala subramaniyam', '97155063883', 'jishabalasubramaniyam@gmail.com', '40', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-13 11:03:53', '2022-01-13 11:04:04', 'No', 0, '0'),
(52, 'PS052', 53, 'PSSW052', '2', NULL, 'No', '1', NULL, NULL, '', '41', 'Karell Candice', 'Active', 'Approved', '41', 'Arnel Suerte', '971508546029', 'nellkarell@gmail.com', '41', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-13 11:14:45', '2022-01-13 11:14:58', 'No', 0, '0'),
(53, 'PS053', 54, 'PSSW053', '2', NULL, 'No', '1', NULL, NULL, '', '41', 'Nelly Ashley', 'Active', 'Approved', '41', 'Arnel Suerte', '971508546029', 'nellkarell@gmail.com', '41', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-13 11:21:16', '2022-01-13 11:21:29', 'No', 0, '0'),
(54, 'PS054', 55, 'PSSW054', '2', NULL, 'No', '1', NULL, NULL, '', '42', 'Lavanya Kishore', 'Active', 'Approved', '42', 'T.S.Kishore', '971506759023', 'kishore.ts@gmail.com', '42', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-13 11:56:17', '2022-01-13 11:58:00', 'Yes', 1, '20.00'),
(55, 'PS055', 56, 'PSSW055', '2', NULL, 'No', '1', NULL, NULL, '', '42', 'Adithya Kishore', 'Active', 'Approved', '42', 'T.S.Kishore', '971506759023', 'kishore.ts@gmail.com', '42', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-13 11:58:25', '2022-01-13 11:58:36', 'No', 0, '0'),
(56, 'PS056', 57, 'PSSW056', '2', NULL, 'No', '1', NULL, NULL, '', '28', 'Antony Wilson', 'Active', 'Approved', '28', 'Xavier', '971506827648', 'vanitha.janet@gmail.com', '28', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-13 12:13:42', '2022-01-13 14:41:44', 'Yes', 2, '20.00'),
(57, 'PS058', 59, 'PSBA058', '1', NULL, 'No', '1', NULL, NULL, '', '44', 'Isha Ramanan', 'Active', 'Approved', '44', 'Anitha Krishna Moorthy', '971503665167', 'anithakrishna81@gmail.com', '44', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-13 13:08:11', '2022-01-13 13:08:25', 'No', 0, '0'),
(58, 'PS057', 58, 'PSSW057', '2', NULL, 'No', '1', NULL, NULL, '', '28', 'Austin Xavier', 'Active', 'Approved', '28', 'Xavier', '971506827648', 'vanitha.janet@gmail.com', '28', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-13 14:43:30', '2022-01-13 14:43:46', 'No', 0, '0'),
(59, 'PS059', 60, 'PSBA059', '1', NULL, 'No', '1', NULL, NULL, '', '45', 'Samyukt Nrayanan', 'Active', 'Approved', '45', 'Jayasri Narayanan', '971525617789', 'jayashri.suryanarayanan@gmail.com', '45', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-14 11:07:26', '2022-01-14 11:07:43', 'No', 0, '0'),
(60, 'PS060', 61, 'PSSW060', '2', NULL, 'No', '1', NULL, NULL, '', '46', 'Abhitha Ganesh', 'Active', 'Approved', '46', 'Ganesh', '971505247201', 'ganesh.gppnair@gmail.com', '46', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-14 11:57:45', '2022-01-14 11:58:09', 'No', 0, '0'),
(61, 'PS062', 63, 'PSSW062', '2', NULL, 'No', '1', NULL, NULL, '', '48', 'Athreyan', 'Active', 'Approved', '48', 'Anish K.S', '971528241849', 'anish.sasi97152dharan@ymail.com', '48', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-14 19:03:49', '2022-01-14 19:04:08', 'No', 0, '0'),
(62, 'PS063', 64, 'PSBA063', '1', NULL, 'No', '1', NULL, NULL, '', '49', 'Rayna', 'Active', 'Approved', '49', 'Murari Pareek', '971555115850', 'pareek.murari@yahoo.com', '49', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-15 11:04:30', '2022-01-15 11:04:46', 'No', 0, '0'),
(63, 'PS064', 65, 'PSBA064', '1', NULL, 'No', '1', NULL, NULL, '', '50', 'Anvesha Birari', 'Active', 'Approved', '50', 'Rahul Birari', '971569824914', 'rahulmax07@gmail.com', '50', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-18 10:00:45', '2022-01-18 10:01:18', 'No', 0, '0'),
(64, 'PS065', 66, 'PSBA065', '1', NULL, 'No', '1', NULL, NULL, '', '17', 'Shreya Gopal', 'Active', 'Approved', '17', 'Gopal', '97150865489', 'gopalkrishnan.p@gmail.com', '17', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-18 10:19:24', '2022-01-18 10:19:38', 'No', 0, '0'),
(65, 'PS066', 67, 'PSSW066', '2', NULL, 'No', '1', NULL, NULL, '', '52', 'Fiona Franklien', 'Active', 'Approved', '52', 'Lavanya Priya', '971551027708', 'lavanya.franklin@gmail.com', '52', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 10:54:18', '2022-01-20 10:54:45', 'No', 0, '0'),
(66, 'PS067', 68, 'PSBA067', '1', NULL, 'No', '1', NULL, NULL, '', '53', 'Ishaan Mehta', 'Active', 'Approved', '53', 'Sudeep Mehta', '971528672989', 'sudeepmehta31@gmail.com', '53', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 11:27:25', '2022-01-20 11:27:48', 'No', 0, '0'),
(67, 'PS068', 69, 'PSBA068', '1', NULL, 'No', '1', NULL, NULL, '', '53', 'Shanyaa Mehta', 'Active', 'Approved', '53', 'Sudeep Mehta', '971528672989', 'sudeepmehta31@gmail.com', '53', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 11:30:22', '2022-01-20 11:30:36', 'No', 0, '0'),
(68, 'PS069', 70, 'PSBA069', '1', NULL, 'No', '1', NULL, NULL, '', '54', 'Rishita Sahu', 'Active', 'Approved', '54', 'Vivek Sahu', '971555584909', 'krish.tolani@gmail.com', '54', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 11:54:00', '2022-01-20 11:54:16', 'No', 0, '0'),
(69, 'PS070', 71, 'PSBA070', '1', NULL, 'No', '1', NULL, NULL, '', '55', 'Emman Fazulbhoy', 'Active', 'Approved', '55', 'Mohammed Reza Fazulbhoy', '971558724105', 'safira.emaan@gmail.com', '55', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 12:08:54', '2022-01-20 12:09:05', 'No', 0, '0'),
(70, 'PS071', 72, 'PSBA071', '1', NULL, 'No', '1', NULL, NULL, '', '56', 'Sharini Suresh', 'Active', 'Approved', '56', 'Suresh Govindaraj', '971503691675', 'sonasuresh07@gmail.com', '56', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 17:20:47', '2022-01-20 17:21:16', 'No', 0, '0'),
(71, 'PS072', 73, 'PSBA072', '1', NULL, 'No', '1', NULL, NULL, '', '57', 'Eeshana Sanjay', 'Active', 'Approved', '57', 'Sanjay Ramdas', '971504782578', 'siresha.sanjay62@gmail.com', '57', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 17:37:17', '2022-01-20 17:37:34', 'No', 0, '0'),
(72, 'PS073', 74, 'PSBA073', '1', NULL, 'No', '1', NULL, NULL, '', '58', 'Ishanvi Sulakshan', 'Active', 'Approved', '58', 'Sulakshan.N', '971507935732', 'ssdv1981@gmail.com', '58', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 17:49:35', '2022-01-20 17:49:49', 'No', 0, '0'),
(73, 'PS074', 75, 'PSBA074', '1', NULL, 'No', '1', NULL, NULL, '', '58', 'Jaishnu', 'Active', 'Approved', '58', 'Sulakshan.N', '971507935732', 'ssdv1981@gmail.com', '58', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 17:59:59', '2022-01-20 18:00:11', 'No', 0, '0'),
(74, 'PS075', 76, 'PSSW075', '2', NULL, 'No', '1', NULL, NULL, '', '59', 'Tiara Dubash', 'Active', 'Approved', '59', 'Zerses Dubash', '971529038326', 'nkhadiwalla@yahoo.com', '59', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 18:57:38', '2022-01-20 18:57:50', 'No', 0, '0'),
(75, 'PS076', 77, 'PSBA076', '1', NULL, 'No', '1', NULL, NULL, '', '51', 'Nandini Singla', 'Active', 'Approved', '51', 'Anshul singhla', '971565384006', 'anshulsingla@gmail.com', '51', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-20 19:16:38', '2022-01-20 19:16:52', 'No', 0, '0'),
(76, 'PS078', 79, 'PSBA078', '1', NULL, 'No', '1', NULL, NULL, '', '61', 'Rithikaa', 'Active', 'Approved', '61', 'Jayaram Jagannathan', '971508497989', 'j_j_ram@yahoo.com', '61', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-21 11:02:29', '2022-01-21 11:02:41', 'No', 0, '0'),
(77, 'PS080', 81, 'PSSW080', '2', NULL, 'No', '1', NULL, NULL, '', '63', 'ANAISHA', 'Active', 'Approved', '63', 'SANDIP GHANDARI', '971506597056', 'sandip_bhandari@hotmail.com', '63', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-21 18:25:45', '2022-01-21 18:25:59', 'No', 0, '0'),
(78, 'PS081', 82, 'PSSW081', '2', NULL, 'No', '1', NULL, NULL, '', '63', 'Samira', 'Active', 'Approved', '63', 'SANDIP GHANDARI', '971506597056', 'sandip_bhandari@hotmail.com', '63', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-21 18:26:36', '2022-01-21 18:29:21', 'Yes', 1, '20.00'),
(79, 'PS082', 83, 'PSBA082', '1', NULL, 'No', '1', NULL, NULL, '', '64', 'Aaravmudhan', 'Active', 'Approved', '64', 'S.Ranganathan', '971566789467', 'rangalakshmi@gmail.com', '64', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-21 19:39:12', '2022-01-21 19:39:42', 'No', 0, '0'),
(80, 'PS082', 83, 'PSSW082', '2', NULL, 'No', '1', NULL, NULL, '', '64', 'Aaravmudhan', 'Active', 'Approved', '64', 'S.Ranganathan', '971566789467', 'rangalakshmi@gmail.com', '64', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-21 19:39:25', '2022-01-21 19:39:54', 'No', 0, '0'),
(81, 'PS083', 84, 'PSBA083', '1', NULL, 'No', '1', NULL, NULL, '', '65', 'Pranav Badri', 'Active', 'Approved', '65', 'Badri Ramaswamy', '971508024976', 'erodebadri@gmail.com', '65', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 09:15:08', '2022-01-23 09:15:58', 'No', 0, '0'),
(82, 'PS084', 85, 'PSBA084', '1', NULL, 'No', '1', NULL, NULL, '', '65', 'Niranjana Badri', 'Active', 'Approved', '65', 'Badri Ramaswamy', '971508024976', 'erodebadri@gmail.com', '65', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 09:18:04', '2022-01-23 09:18:34', 'Yes', 1, '20.00'),
(83, 'PS085', 86, 'PSBA085', '1', NULL, 'No', '1', NULL, NULL, '', '66', 'Aditi Gomadam', 'Active', 'Approved', '66', 'Sudharshan.G', '971528936873', 'gs.sudarshan@gmail.com', '66', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 09:30:19', '2022-01-23 09:30:33', 'No', 0, '0'),
(84, 'PS087', 88, 'PSBA087', '1', NULL, 'No', '1', NULL, NULL, '', '67', 'Keya Upadhyay', 'Active', 'Approved', '67', 'Vishnu upadhyay', '971505583725', 'vishnu_kinkar@yahoo.com', '67', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 09:46:10', '2022-01-23 09:46:23', 'No', 0, '0'),
(85, 'PS088', 89, 'PSBA088', '1', NULL, 'No', '1', NULL, NULL, '', '68', 'Rayaan Irani', 'Active', 'Approved', '68', 'Firdous Irani', '971505505174', 'fidzy101@gmail.com', '68', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 10:53:44', '2022-01-23 10:54:05', 'No', 0, '0'),
(86, 'PS089', 90, 'PSBA089', '1', NULL, 'No', '1', NULL, NULL, '', '68', 'Anaissa Irani', 'Active', 'Approved', '68', 'Firdous Irani', '971505505174', 'fidzy101@gmail.com', '68', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 10:54:36', '2022-01-23 10:55:51', 'Yes', 1, '20.00'),
(87, 'PS090', 91, 'PSBA090', '1', NULL, 'No', '1', NULL, NULL, '', '69', 'Mohamed Niyas', 'Active', 'Approved', '69', 'Rajamohamed', '971503191434', 'raja.mohamed23@gmail.com', '69', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 11:12:43', '2022-01-23 11:12:56', 'No', 0, '0'),
(88, 'PS091', 92, 'PSBA091', '1', NULL, 'No', '1', NULL, NULL, '', '69', 'Hasbina Begum', 'Active', 'Approved', '69', 'Rajamohamed', '971503191434', 'raja.mohamed23@gmail.com', '69', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 11:15:49', '2022-01-23 11:16:28', 'Yes', 1, '20.00'),
(89, 'PS093', 94, 'PSBA093', '1', NULL, 'No', '1', NULL, NULL, '', '70', 'Samridhi', 'Active', 'Approved', '70', 'Parijat', '971543229435', 'preetiparijat@gmail.com', '70', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 11:53:53', '2022-01-23 11:55:56', 'Yes', 1, '20.00'),
(90, 'PS092', 93, 'PSBA092', '1', NULL, 'No', '1', NULL, NULL, '', '70', 'Sanskrati', 'Active', 'Approved', '70', 'Parijat', '971543229435', 'preetiparijat@gmail.com', '70', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 12:25:30', '2022-01-23 12:25:45', 'No', 0, '0'),
(91, 'PS094', 95, 'PSSW094', '2', NULL, 'No', '1', NULL, NULL, '', '71', 'Khadeeja Fahih', 'Active', 'Approved', '71', 'Fehmeena Fahih', '971507684671', 'femfa@yahoo.co.in', '71', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 12:31:34', '2022-01-23 12:31:49', 'No', 0, '0'),
(92, 'PS095', 96, 'PSBA095', '1', NULL, 'No', '1', NULL, NULL, '', '72', 'Nixon', 'Active', 'Approved', '72', 'Naveen', '971508942899', 'quadrosnixon007@gmail.com', '72', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 12:35:11', '2022-01-23 12:35:25', 'No', 0, '0'),
(93, 'PS096', 97, 'PSBA096', '1', NULL, 'No', '1', NULL, NULL, '', '73', 'Aishwarya Sakhrani', 'Active', 'Approved', '73', 'Pradeep Sakhrani', '971507594023', 'pradeepsakhrani2@gmail.com', '73', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 15:16:44', '2022-01-23 15:16:58', 'No', 0, '0'),
(94, 'PS097', 98, 'PSBA097', '1', NULL, 'No', '1', NULL, NULL, '', '74', 'Veer Abichandani', 'Active', 'Approved', '74', 'Sanjay Abichandani', '971501642544', 'sanjay.abichandani79@gmail.com', '74', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-23 15:30:47', '2022-01-23 15:31:02', 'No', 0, '0'),
(95, 'PS099', 100, 'PSBA099', '1', NULL, 'No', '1', NULL, NULL, '', '77', 'Manvir Thejas R.S', 'Active', 'Approved', '77', 'Singaravel Ranjan', '971506442047', 's_shrisakthi@yahoo.com', '77', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-24 13:47:59', '2022-01-24 13:48:23', 'No', 0, '0'),
(96, 'PS100', 101, 'PSSW100', '2', NULL, 'No', '1', NULL, NULL, '', '78', 'Abhay Krishna', 'Active', 'Approved', '78', 'Suma Unnikrishnan', '971502847204', 'cunni09@gmail.com', '78', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-24 14:01:48', '2022-01-24 14:02:01', 'No', 0, '0'),
(97, 'PS001', 1, 'PSBA001', '1', NULL, 'No', '3', NULL, NULL, '', '1', 'Aakash', 'Active', 'Approved', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '1', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-24 16:51:11', '2022-01-24 16:51:24', 'No', 0, '0'),
(98, 'PS101', 102, 'PSSW101', '2', NULL, 'No', '1', NULL, NULL, '', '79', 'Maryam Mobin', 'Active', 'Approved', '79', 'Hena Fatima', '971505605170', 'maryam.mobeen@gmail.com', '79', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-24 17:39:18', '2022-01-24 17:40:31', 'No', 0, '0'),
(99, 'PS102', 103, 'PSSW102', '2', NULL, 'No', '1', NULL, NULL, '', '79', 'Mahna Mobeen', 'Active', 'Approved', '79', 'Hena Fatima', '971505605170', 'maryam.mobeen@gmail.com', '79', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-24 17:43:18', '2022-01-24 17:43:30', 'No', 0, '0'),
(100, 'PS105', 106, 'PSSW105', '2', NULL, 'No', '1', NULL, NULL, '', '81', 'Mihran', 'Active', 'Approved', '81', 'Fathima Zulfa', '971558492740', 'shahulhamee@gmail.com', '81', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-26 12:17:43', '2022-01-26 12:17:56', 'No', 0, '0'),
(101, 'PS106', 107, 'PSSW106', '2', NULL, 'No', '1', NULL, NULL, '', '81', 'Zainab Zuhara', 'Active', 'Approved', '81', 'Fathima Zulfa', '971558492740', 'shahulhamee@gmail.com', '81', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-26 12:21:29', '2022-01-26 12:21:49', 'Yes', 1, '20.00'),
(102, 'PS107', 108, 'PSSW107', '2', NULL, 'No', '1', NULL, NULL, '', '82', 'Sheik Zaina', 'Active', 'Approved', '82', 'Fauzan', '971529459747', 'fauzanjeema@gmail.com', '82', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-26 12:36:37', '2022-01-26 12:36:52', 'No', 0, '0'),
(103, 'PS108', 109, 'PSSW108', '2', NULL, 'No', '1', NULL, NULL, '', '82', 'Abdul Ahad Ahmed', 'Active', 'Approved', '82', 'Fauzan', '971529459747', 'fauzanjeema@gmail.com', '82', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-26 12:37:17', '2022-01-26 12:37:39', 'Yes', 1, '20.00'),
(104, 'PS109', 110, 'PSSW109', '2', NULL, 'No', '1', NULL, NULL, '', '83', 'Kishore', 'Active', 'Approved', '83', 'Chinni', '971502165359', 'garikipati.chinni@gmail.com', '83', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-26 12:41:40', '2022-01-26 12:41:54', 'No', 0, '0'),
(105, 'PS111', 112, 'PSSW111', '2', NULL, 'No', '1', NULL, NULL, '', '84', 'Niharika Sandeep', 'Active', 'Approved', '84', 'Sandeep.P', '971505507842', 'ppsandeep@gmail.com', '84', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-26 12:52:16', '2022-01-26 12:53:43', 'Yes', 1, '20.00'),
(106, 'PS110', 111, 'PSSW110', '2', NULL, 'No', '1', NULL, NULL, '', '84', 'Niranjan Sandeep', 'Active', 'Approved', '84', 'Sandeep.P', '971505507842', 'ppsandeep@gmail.com', '84', NULL, 1, NULL, NULL, NULL, NULL, '2022-01-26 12:52:42', '2022-01-26 12:52:55', 'No', 0, '0'),
(107, 'PS029', 30, 'PSSW029', '2', NULL, 'No', '1', NULL, NULL, NULL, '23', 'Aanya anju Das', 'Inactive', 'Pending', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', '23', NULL, 26, NULL, NULL, NULL, NULL, '2022-01-29 11:58:01', '0000-00-00 00:00:00', 'no', NULL, NULL),
(108, 'PS029', 30, 'PSKA029', '3', NULL, 'No', '1', NULL, NULL, NULL, '23', 'Aanya anju Das', 'Inactive', 'Pending', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', '23', NULL, 26, NULL, NULL, NULL, NULL, '2022-01-29 22:50:14', '0000-00-00 00:00:00', 'no', NULL, NULL),
(109, 'PS030', 31, 'PSKA030', '3', NULL, 'No', '1', NULL, NULL, NULL, '23', 'Anushka Anju das', 'Inactive', 'Pending', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', '23', NULL, 26, NULL, NULL, NULL, NULL, '2022-01-29 22:53:04', '0000-00-00 00:00:00', 'no', NULL, NULL),
(110, 'PS029', 30, 'PSTT029', '4', NULL, 'No', '1', NULL, NULL, NULL, '23', 'Aanya anju Das', 'Inactive', 'Pending', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', '23', NULL, 26, NULL, NULL, NULL, NULL, '2022-01-29 22:53:12', '0000-00-00 00:00:00', 'no', NULL, NULL),
(111, 'PS112', 113, 'PSBA112', '1', NULL, 'Yes', '1', NULL, NULL, '', '86', 'Akshita', 'Active', 'Approved', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', '86', NULL, 92, NULL, NULL, NULL, NULL, '2022-02-01 21:18:31', '2022-02-23 16:30:46', 'No', 0, '0'),
(112, 'PS113', 114, 'PSSW113', '2', NULL, 'No', '1', NULL, NULL, NULL, '87', 'Dev', 'Inactive', 'Pending', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', '87', NULL, 93, NULL, NULL, NULL, NULL, '2022-02-09 11:18:44', '0000-00-00 00:00:00', 'no', NULL, NULL),
(113, 'PS114', 115, 'PSSW114', '2', NULL, 'No', '1', NULL, NULL, NULL, '87', 'Dev', 'Inactive', 'Pending', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', '87', NULL, 93, NULL, NULL, NULL, NULL, '2022-02-09 12:16:05', '0000-00-00 00:00:00', 'no', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activity_slot_reports`
--

CREATE TABLE `activity_slot_reports` (
  `id` int(11) NOT NULL,
  `slot` varchar(255) DEFAULT NULL,
  `time_from` varchar(255) DEFAULT NULL,
  `time_to` varchar(255) DEFAULT NULL,
  `game_id` varchar(255) DEFAULT NULL,
  `location_id` varchar(255) DEFAULT NULL,
  `lanecourt_id` varchar(255) DEFAULT NULL,
  `level_id` varchar(255) DEFAULT NULL,
  `coach_id` varchar(255) DEFAULT NULL,
  `day_id` varchar(255) DEFAULT NULL,
  `slot_count` varchar(255) DEFAULT NULL,
  `hour` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `location_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `phone2` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `emirates_id` varchar(255) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `passport_size_image` varchar(255) NOT NULL,
  `passport_image` varchar(255) NOT NULL,
  `visa_image` varchar(255) NOT NULL,
  `emirates_id_image` varchar(255) NOT NULL,
  `experience_certificate_image` varchar(255) NOT NULL,
  `police_verification_image` varchar(255) NOT NULL,
  `municipality_certificate_image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `code`, `admin_name`, `age`, `dob`, `gender`, `role`, `location_id`, `address`, `address1`, `city`, `state`, `country`, `postal_code`, `phone1`, `phone2`, `email_id`, `emirates_id`, `expiry_date`, `status`, `passport_size_image`, `passport_image`, `visa_image`, `emirates_id_image`, `experience_certificate_image`, `police_verification_image`, `municipality_certificate_image`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'PSADMIN01', 'BMR ', 32, '1990-01-01', 'Male', 'superadmin', 0, '', '', '', '', '', '', '121212121212', '121212121212', 'bmr.ind@gmail.com', '', '0000-00-00', 'Active', '', '', '', '', '', '', '', '2022-01-05 11:35:23', NULL, 0),
(2, 'PSADMIN02', 'Rajeswari Ravikumar', 30, '1992-01-01', 'Female', 'superadmin', 0, '', '', '', '', '', '', '2121212121', '2121212121', 'rajeswariravikumar@gmail.com', '', '0000-00-00', 'Active', '', '', '', '', '', '', '', '2022-01-05 11:42:51', NULL, 0),
(3, 'PSADMIN03', 'test', 0, '2022-01-04', 'Male', 'superadmin', 1, '', '', '', '', '', '60000', '9876543212', '9569660000', 'nmuthu@jksoftec.com', '', '0000-00-00', 'Active', '', '', '', '', '', '', '', '2022-01-27 16:01:34', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_logins`
--

CREATE TABLE `admin_logins` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_slot_selections`
--

CREATE TABLE `admin_slot_selections` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assign_coaches`
--

CREATE TABLE `assign_coaches` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_books`
--

CREATE TABLE `attendance_books` (
  `id` int(11) NOT NULL,
  `slot_selection_id` varchar(255) DEFAULT NULL,
  `slot_id` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tracking_reports`
--

CREATE TABLE `attendance_tracking_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `background_images`
--

CREATE TABLE `background_images` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_file_size` int(11) DEFAULT NULL,
  `image_updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_location` varchar(255) DEFAULT NULL,
  `IBAN_No` int(20) DEFAULT NULL,
  `Account_No` int(20) DEFAULT NULL,
  `Swift_Code` int(20) DEFAULT NULL,
  `IFSC_Code` varchar(20) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `bank_name`, `bank_location`, `IBAN_No`, `Account_No`, `Swift_Code`, `IFSC_Code`, `bank_account_number`, `created_at`, `updated_at`) VALUES
(1, 'ADIB', 'Shiekh Zayed Road', 0, 18991406, 0, '', NULL, '2022-01-05 21:15:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `booked_slots`
--

CREATE TABLE `booked_slots` (
  `id` int(15) NOT NULL,
  `booking_id` int(15) NOT NULL,
  `location_id` int(15) NOT NULL,
  `coach_id` int(15) NOT NULL,
  `lane_court_id` int(15) NOT NULL,
  `booking_no` varchar(100) NOT NULL,
  `booked_date` date NOT NULL,
  `hours` varchar(25) NOT NULL,
  `from_time` varchar(100) NOT NULL,
  `to_time` varchar(100) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  `info` varchar(255) NOT NULL COMMENT 'Refunded, Swapped',
  `amount` decimal(10,2) NOT NULL,
  `payable_amount` decimal(10,2) NOT NULL,
  `deducted_amount` decimal(10,2) NOT NULL,
  `approval_status` varchar(100) NOT NULL,
  `swapped_slot_id` int(10) NOT NULL,
  `vat_perc` decimal(10,2) NOT NULL,
  `vat_amount` decimal(10,2) NOT NULL,
  `attendance` varchar(255) DEFAULT 'Pending',
  `attendance_by` int(11) DEFAULT NULL,
  `is_refunded` int(11) NOT NULL DEFAULT '0',
  `refund_date` datetime DEFAULT NULL,
  `reason` text,
  `refund_requested` int(15) NOT NULL DEFAULT '0',
  `refund_requested_on` datetime DEFAULT NULL,
  `refund_document` text,
  `refund_approved_by` int(15) DEFAULT NULL,
  `approval_rejected_reason` text,
  `refund_approval_status` varchar(255) DEFAULT NULL,
  `discount_perc` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_val` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booked_slots`
--

INSERT INTO `booked_slots` (`id`, `booking_id`, `location_id`, `coach_id`, `lane_court_id`, `booking_no`, `booked_date`, `hours`, `from_time`, `to_time`, `status`, `info`, `amount`, `payable_amount`, `deducted_amount`, `approval_status`, `swapped_slot_id`, `vat_perc`, `vat_amount`, `attendance`, `attendance_by`, `is_refunded`, `refund_date`, `reason`, `refund_requested`, `refund_requested_on`, `refund_document`, `refund_approved_by`, `approval_rejected_reason`, `refund_approval_status`, `discount_perc`, `discount_val`) VALUES
(1, 1, 1, 1, 1, 'BKNO-0002', '2022-01-12', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(2, 1, 1, 1, 1, 'BKNO-0003', '2022-01-13', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(3, 1, 1, 1, 1, 'BKNO-0004', '2022-01-19', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(4, 1, 1, 1, 1, 'BKNO-0005', '2022-01-20', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(5, 1, 1, 1, 1, 'BKNO-0006', '2022-01-26', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(6, 1, 1, 1, 1, 'BKNO-0007', '2022-01-27', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(7, 2, 1, 1, 1, 'BKNO-0008', '2022-01-12', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(8, 2, 1, 1, 1, 'BKNO-0009', '2022-01-13', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(9, 2, 1, 1, 1, 'BKNO-0010', '2022-01-19', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(10, 2, 1, 1, 1, 'BKNO-0011', '2022-01-20', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(11, 2, 1, 1, 1, 'BKNO-0012', '2022-01-26', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(12, 2, 1, 1, 1, 'BKNO-0013', '2022-01-27', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(13, 3, 1, 1, 1, 'BKNO-0014', '2022-01-13', 'Two', '06.00 PM', '08.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(14, 3, 1, 1, 1, 'BKNO-0015', '2022-01-12', 'Two', '06.00 PM', '08.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(15, 3, 1, 1, 1, 'BKNO-0016', '2022-01-14', 'Two', '06.00 PM', '08.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(16, 3, 1, 1, 1, 'BKNO-0017', '2022-01-17', 'Two', '06.00 PM', '08.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(17, 3, 1, 1, 1, 'BKNO-0018', '2022-01-18', 'Two', '06.00 PM', '08.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(18, 3, 1, 1, 1, 'BKNO-0019', '2022-01-19', 'Two', '06.00 PM', '08.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(19, 3, 1, 1, 1, 'BKNO-0020', '2022-01-20', 'Two', '06.00 PM', '08.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(20, 3, 1, 1, 1, 'BKNO-0021', '2022-01-21', 'Two', '06.00 PM', '08.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(21, 4, 1, 1, 1, 'BKNO-0022', '2022-01-13', 'Two', '06.00 PM', '08.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(22, 4, 1, 1, 1, 'BKNO-0023', '2022-01-18', 'Two', '06.00 PM', '08.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(23, 4, 1, 1, 1, 'BKNO-0024', '2022-01-20', 'Two', '06.00 PM', '08.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(24, 4, 1, 1, 1, 'BKNO-0025', '2022-01-25', 'Two', '06.00 PM', '08.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(25, 4, 1, 1, 1, 'BKNO-0026', '2022-01-27', 'Two', '06.00 PM', '08.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(26, 4, 1, 1, 1, 'BKNO-0027', '2022-01-30', 'Two', '08.00 AM', '10.00 AM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(27, 4, 1, 1, 1, 'BKNO-0028', '2022-01-29', 'Two', '08.00 AM', '10.00 AM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(28, 5, 1, 1, 1, 'BKNO-0029', '2022-01-12', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(29, 5, 1, 1, 1, 'BKNO-0030', '2022-01-19', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(30, 5, 1, 1, 1, 'BKNO-0031', '2022-01-20', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(31, 5, 1, 1, 1, 'BKNO-0032', '2022-01-26', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(32, 5, 1, 1, 1, 'BKNO-0033', '2022-01-27', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(33, 5, 1, 1, 1, 'BKNO-0034', '2022-01-28', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(34, 5, 1, 1, 1, 'BKNO-0035', '2022-01-13', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(35, 5, 1, 1, 1, 'BKNO-0036', '2022-01-18', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(36, 5, 1, 1, 1, 'BKNO-0037', '2022-01-25', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(37, 6, 1, 1, 1, 'BKNO-0038', '2022-01-12', 'Two', '05.00 PM', '07.00 PM', 1, '', 52.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(38, 6, 1, 1, 1, 'BKNO-0039', '2022-01-13', 'Two', '05.00 PM', '07.00 PM', 1, '', 52.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(39, 6, 1, 1, 1, 'BKNO-0040', '2022-01-18', 'Two', '05.00 PM', '07.00 PM', 1, '', 52.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(40, 6, 1, 1, 1, 'BKNO-0041', '2022-01-19', 'Two', '05.00 PM', '07.00 PM', 1, '', 52.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(41, 6, 1, 1, 1, 'BKNO-0042', '2022-01-20', 'Two', '05.00 PM', '07.00 PM', 1, '', 52.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(42, 6, 1, 1, 1, 'BKNO-0043', '2022-01-25', 'Two', '05.00 PM', '07.00 PM', 1, '', 52.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(43, 6, 1, 1, 1, 'BKNO-0044', '2022-01-26', 'Two', '05.00 PM', '07.00 PM', 1, '', 52.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(44, 6, 1, 1, 1, 'BKNO-0045', '2022-01-27', 'Two', '05.00 PM', '07.00 PM', 1, '', 52.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 13.00),
(45, 7, 1, 1, 1, 'BKNO-0046', '2022-01-13', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 75.00, 78.75, 'Approved', 0, 5.00, 3.75, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(46, 7, 1, 1, 1, 'BKNO-0047', '2022-01-20', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 75.00, 78.75, 'Approved', 0, 5.00, 3.75, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(47, 7, 1, 1, 1, 'BKNO-0048', '2022-01-27', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 75.00, 78.75, 'Approved', 0, 5.00, 3.75, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(48, 8, 1, 1, 1, 'BKNO-0049', '2022-01-17', 'Two', '06.00 PM', '08.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(49, 8, 1, 1, 1, 'BKNO-0050', '2022-01-19', 'Two', '06.00 PM', '08.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(50, 8, 1, 1, 1, 'BKNO-0051', '2022-01-24', 'Two', '06.00 PM', '08.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Present', 1, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(51, 8, 1, 1, 1, 'BKNO-0052', '2022-01-26', 'Two', '06.00 PM', '08.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(52, 8, 1, 1, 1, 'BKNO-0053', '2022-01-31', 'Two', '06.00 PM', '08.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(53, 9, 1, 1, 1, 'BKNO-0054', '2022-01-13', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(54, 9, 1, 1, 1, 'BKNO-0055', '2022-01-17', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(55, 9, 1, 1, 1, 'BKNO-0056', '2022-01-20', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(56, 9, 1, 1, 1, 'BKNO-0057', '2022-01-24', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(57, 9, 1, 1, 1, 'BKNO-0058', '2022-01-27', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(58, 9, 1, 1, 1, 'BKNO-0059', '2022-01-31', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(59, 10, 1, 1, 1, 'BKNO-0060', '2022-01-17', 'Two', '05.00 PM', '07.00 PM', 1, '', 60.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(60, 10, 1, 1, 1, 'BKNO-0061', '2022-01-20', 'Two', '06.00 PM', '08.00 PM', 1, '', 60.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(61, 10, 1, 1, 1, 'BKNO-0062', '2022-01-24', 'Two', '06.00 PM', '08.00 PM', 1, '', 60.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(62, 10, 1, 1, 1, 'BKNO-0063', '2022-01-26', 'Two', '06.00 PM', '08.00 PM', 1, '', 60.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(63, 10, 1, 1, 1, 'BKNO-0064', '2022-01-27', 'Two', '06.00 PM', '08.00 PM', 1, '', 60.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(64, 10, 1, 1, 1, 'BKNO-0065', '2022-01-31', 'Two', '06.00 PM', '08.00 PM', 1, '', 60.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(65, 11, 1, 1, 1, 'BKNO-0066', '2022-01-15', 'Two', '08.00 AM', '10.00 AM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(66, 11, 1, 1, 1, 'BKNO-0067', '2022-01-16', 'Two', '08.00 AM', '10.00 AM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(67, 11, 1, 1, 1, 'BKNO-0068', '2022-01-18', 'Two', '06.00 PM', '08.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(68, 11, 1, 1, 1, 'BKNO-0069', '2022-01-20', 'Two', '06.00 PM', '08.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(69, 11, 1, 1, 1, 'BKNO-0070', '2022-01-22', 'Two', '08.00 AM', '10.00 AM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(70, 11, 1, 1, 1, 'BKNO-0071', '2022-01-25', 'Two', '06.00 PM', '08.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(71, 12, 1, 1, 1, 'BKNO-0072', '2022-01-14', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(72, 12, 1, 1, 1, 'BKNO-0073', '2022-01-15', 'Two', '03.00 PM', '05.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(73, 12, 1, 1, 1, 'BKNO-0074', '2022-01-16', 'Two', '03.00 PM', '05.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(74, 12, 1, 1, 1, 'BKNO-0075', '2022-01-21', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(75, 12, 1, 1, 1, 'BKNO-0076', '2022-01-22', 'Two', '03.00 PM', '05.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(76, 12, 1, 1, 1, 'BKNO-0077', '2022-01-23', 'Two', '03.00 PM', '05.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(77, 12, 1, 1, 1, 'BKNO-0078', '2022-01-28', 'Two', '06.00 PM', '08.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(78, 12, 1, 1, 1, 'BKNO-0079', '2022-01-29', 'Two', '03.00 PM', '05.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(79, 12, 1, 1, 1, 'BKNO-0080', '2022-01-30', 'Two', '03.00 PM', '05.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(80, 13, 1, 1, 1, 'BKNO-0081', '2022-01-17', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(81, 13, 1, 1, 1, 'BKNO-0082', '2022-01-18', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(82, 13, 1, 1, 1, 'BKNO-0083', '2022-01-24', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(83, 13, 1, 1, 1, 'BKNO-0084', '2022-01-25', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(84, 13, 1, 1, 1, 'BKNO-0085', '2022-01-31', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(85, 14, 1, 1, 1, 'BKNO-0086', '2022-01-23', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 75.00, 78.75, 'Approved', 0, 5.00, 3.75, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(86, 14, 1, 1, 1, 'BKNO-0087', '2022-01-30', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 75.00, 78.75, 'Approved', 0, 5.00, 3.75, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(87, 15, 1, 1, 1, 'BKNO-0088', '2022-01-22', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(88, 15, 1, 1, 1, 'BKNO-0089', '2022-01-23', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(89, 15, 1, 1, 1, 'BKNO-0090', '2022-01-29', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(90, 15, 1, 1, 1, 'BKNO-0091', '2022-01-30', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(91, 16, 1, 1, 1, 'BKNO-0092', '2022-01-22', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(92, 16, 1, 1, 1, 'BKNO-0093', '2022-01-23', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(93, 16, 1, 1, 1, 'BKNO-0094', '2022-01-29', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(94, 16, 1, 1, 1, 'BKNO-0095', '2022-01-30', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(95, 17, 1, 1, 1, 'BKNO-0096', '2022-01-22', 'Two', '03.00 PM', '05.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(96, 17, 1, 1, 1, 'BKNO-0097', '2022-01-23', 'Two', '03.00 PM', '05.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(97, 17, 1, 1, 1, 'BKNO-0098', '2022-01-29', 'Two', '03.00 PM', '05.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(98, 17, 1, 1, 1, 'BKNO-0099', '2022-01-30', 'Two', '03.00 PM', '05.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(99, 18, 2, 2, 5, 'BKNO-0100', '2022-01-18', 'Two', '04.00 PM', '06.00 PM', 1, '', 110.00, 90.00, 94.50, 'Approved', 0, 5.00, 4.50, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(100, 18, 2, 2, 5, 'BKNO-0101', '2022-01-19', 'Two', '04.00 PM', '06.00 PM', 1, '', 110.00, 90.00, 94.50, 'Approved', 0, 5.00, 4.50, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(101, 18, 2, 2, 4, 'BKNO-0102', '2022-01-23', 'Two', '07.00 AM', '09.00 AM', 1, '', 110.00, 90.00, 94.50, 'Approved', 0, 5.00, 4.50, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(102, 18, 2, 2, 4, 'BKNO-0103', '2022-01-22', 'Two', '07.00 AM', '09.00 AM', 1, '', 110.00, 90.00, 94.50, 'Approved', 0, 5.00, 4.50, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(103, 18, 2, 2, 4, 'BKNO-0104', '2022-01-29', 'Two', '07.00 AM', '09.00 AM', 1, '', 110.00, 90.00, 94.50, 'Approved', 0, 5.00, 4.50, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(104, 18, 2, 2, 4, 'BKNO-0105', '2022-01-30', 'Two', '07.00 AM', '09.00 AM', 1, '', 110.00, 90.00, 94.50, 'Approved', 0, 5.00, 4.50, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(105, 19, 1, 1, 1, 'BKNO-0106', '2022-01-22', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(106, 19, 1, 1, 1, 'BKNO-0107', '2022-01-23', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(107, 19, 1, 1, 1, 'BKNO-0108', '2022-01-29', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(108, 19, 1, 1, 1, 'BKNO-0109', '2022-01-30', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(109, 20, 1, 1, 1, 'BKNO-0110', '2022-01-22', 'Two', '10.00 AM', '12.00 PM', 0, 'Refunded', 60.00, 60.00, 63.00, 'Approved', 0, 5.00, 3.00, 'Pending', NULL, 1, '2022-01-17 20:13:12', 'Booked with 20 % discount from 75 plus vat', 1, '2022-01-17 20:12:01', '0', 1, 'Approved', 'Approved', 20.00, 15.00),
(110, 20, 1, 1, 1, 'BKNO-0111', '2022-01-23', 'Two', '10.00 AM', '12.00 PM', 0, 'Refunded', 60.00, 60.00, 63.00, 'Approved', 0, 5.00, 3.00, 'Pending', NULL, 1, '2022-01-17 20:13:20', 'Booked with 20 % discount from 75 plus vat', 1, '2022-01-17 20:12:11', '0', 1, 'Approved', 'Approved', 20.00, 15.00),
(111, 20, 1, 1, 1, 'BKNO-0112', '2022-01-29', 'Two', '10.00 AM', '12.00 PM', 0, 'Refunded', 60.00, 60.00, 63.00, 'Approved', 0, 5.00, 3.00, 'Pending', NULL, 1, '2022-01-17 20:13:02', 'Booked with 20 % discount from 75 plus vat', 1, '2022-01-17 20:12:35', '0', 1, 'Approved', 'Approved', 20.00, 15.00),
(112, 20, 1, 1, 1, 'BKNO-0113', '2022-01-30', 'Two', '10.00 AM', '12.00 PM', 0, 'Refunded', 60.00, 60.00, 63.00, 'Approved', 0, 5.00, 3.00, 'Pending', NULL, 1, '2022-01-17 20:13:29', 'Booked with 20 % discount from 75 plus vat', 1, '2022-01-17 20:12:24', '0', 1, 'Approved', 'Approved', 20.00, 15.00),
(113, 21, 1, 1, 1, 'BKNO-0114', '2022-01-22', 'Two', '10.00 AM', '12.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(114, 21, 1, 1, 1, 'BKNO-0115', '2022-01-23', 'Two', '10.00 AM', '12.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(115, 21, 1, 1, 1, 'BKNO-0116', '2022-01-29', 'Two', '10.00 AM', '12.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(116, 21, 1, 1, 1, 'BKNO-0117', '2022-01-30', 'Two', '10.00 AM', '12.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(117, 22, 1, 1, 1, 'BKNO-0118', '2022-01-24', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 75.00, 78.75, 'Approved', 0, 5.00, 3.75, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(118, 22, 1, 1, 1, 'BKNO-0119', '2022-01-31', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 75.00, 78.75, 'Approved', 0, 5.00, 3.75, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(119, 23, 1, 1, 2, 'BKNO-0120', '2022-01-19', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(120, 23, 1, 1, 1, 'BKNO-0121', '2022-01-24', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(121, 23, 1, 1, 1, 'BKNO-0122', '2022-01-26', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(122, 23, 1, 1, 1, 'BKNO-0123', '2022-01-31', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(123, 24, 1, 1, 1, 'BKNO-0124', '2022-01-22', 'Two', '08.00 AM', '10.00 AM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(124, 24, 1, 1, 1, 'BKNO-0125', '2022-01-23', 'Two', '08.00 AM', '10.00 AM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(125, 25, 1, 1, 1, 'BKNO-0126', '2022-01-22', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(126, 25, 1, 1, 1, 'BKNO-0127', '2022-01-23', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(127, 25, 1, 1, 1, 'BKNO-0128', '2022-01-29', 'Two', '10.00 AM', '12.00 PM', 1, '', 75.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(128, 26, 1, 1, 1, 'BKNO-0129', '2022-01-22', 'Two', '10.00 AM', '12.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(129, 26, 1, 1, 1, 'BKNO-0130', '2022-01-23', 'Two', '10.00 AM', '12.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(130, 26, 1, 1, 1, 'BKNO-0131', '2022-01-29', 'Two', '10.00 AM', '12.00 PM', 1, '', 60.00, 52.00, 54.60, 'Approved', 0, 5.00, 2.60, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 20.00, 15.00),
(131, 27, 1, 1, 1, 'BKNO-0132', '2022-02-02', 'Two', '05.00 PM', '07.00 PM', 1, '', 75.00, 0.10, 0.11, 'Approved', 0, 5.00, 0.01, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(132, 28, 1, 1, 1, 'BKNO-0133', '2022-02-03', 'Two', '05.00 PM', '07.00 PM', 0, 'Swapped', 65.00, 1.25, 1.31, 'Approved', 144, 5.00, 0.06, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(133, 28, 1, 1, 1, 'BKNO-0134', '2022-02-04', 'Two', '05.00 PM', '07.00 PM', 0, 'Refunded', 65.00, 1.25, 1.31, 'Approved', 0, 5.00, 0.06, 'Pending', NULL, 1, '2022-02-02 00:00:40', 'TEST', 1, '2022-02-02 00:00:20', 'Refund_images/1643745620_google.png', 90, 'Approved', 'Approved', 0.00, 0.00),
(134, 28, 1, 1, 1, 'BKNO-0135', '2022-02-05', 'Two', '08.00 AM', '10.00 AM', 1, '', 65.00, 1.25, 1.31, 'Approved', 0, 5.00, 0.06, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(135, 28, 1, 1, 1, 'BKNO-0136', '2022-02-06', 'Two', '08.00 AM', '10.00 AM', 1, '', 65.00, 1.25, 1.31, 'Approved', 0, 5.00, 0.06, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(136, 28, 1, 1, 1, 'BKNO-0137', '2022-02-07', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 1.25, 1.31, 'Approved', 0, 5.00, 0.06, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(137, 28, 1, 1, 1, 'BKNO-0138', '2022-02-08', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 1.25, 1.31, 'Approved', 0, 5.00, 0.06, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(138, 28, 1, 1, 1, 'BKNO-0139', '2022-02-09', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 1.25, 1.31, 'Approved', 0, 5.00, 0.06, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(139, 28, 1, 1, 1, 'BKNO-0140', '2022-02-10', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 1.25, 1.31, 'Approved', 0, 5.00, 0.06, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(140, 29, 1, 1, 1, 'BKNO-0141', '2022-02-11', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(141, 30, 1, 1, 1, 'BKNO-0142', '2022-02-12', 'Two', '08.00 AM', '10.00 AM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(142, 30, 1, 1, 1, 'BKNO-0143', '2022-02-13', 'Two', '08.00 AM', '10.00 AM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(143, 31, 1, 1, 1, 'BKNO-0144', '2022-02-14', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 65.00, 68.25, 'Approved', 0, 5.00, 3.25, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(144, 28, 1, 1, 1, 'BKNO-0145', '2022-02-15', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 1.25, 1.31, 'Approved', 0, 5.00, 0.06, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(145, 32, 1, 1, 1, 'BKNO-0146', '2022-02-16', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 1.00, 1.05, 'Approved', 0, 5.00, 0.05, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(146, 33, 1, 1, 1, 'BKNO-0147', '2022-02-17', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 1.00, 1.05, 'Approved', 0, 5.00, 0.05, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(147, 34, 1, 1, 1, 'BKNO-0148', '2022-02-18', 'Two', '05.00 PM', '07.00 PM', 1, '', 65.00, 1.00, 1.05, 'Approved', 0, 5.00, 0.05, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(148, 35, 1, 1, 1, 'BKNO-0149', '2022-02-19', 'Two', '08.00 AM', '10.00 AM', 1, '', 65.00, 1.00, 1.05, 'Approved', 0, 5.00, 0.05, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(149, 36, 1, 1, 1, 'BKNO-0150', '2022-02-20', 'Two', '08.00 AM', '10.00 AM', 1, '', 65.00, 1.00, 1.05, 'Approved', 0, 5.00, 0.05, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(150, 37, 2, 2, 5, 'BKNO-0151', '2022-02-18', 'Two', '04.00 PM', '06.00 PM', 1, '', 100.00, 100.00, 105.00, 'Approved', 0, 5.00, 5.00, 'Pending', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `booking_approvals`
--

CREATE TABLE `booking_approvals` (
  `id` int(11) NOT NULL,
  `ticket_no` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `activityselection_id` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `psa_id` varchar(255) DEFAULT NULL,
  `activity_id` varchar(255) DEFAULT NULL,
  `level_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Approved',
  `amount` decimal(10,2) NOT NULL,
  `vat_perc` decimal(10,2) NOT NULL,
  `vat_amount` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `discount_percentage` decimal(10,2) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `wallet_amount` decimal(10,2) DEFAULT NULL,
  `payable_amount` decimal(10,2) DEFAULT NULL,
  `wallet_balance` decimal(10,2) DEFAULT NULL,
  `checkout_status` varchar(255) DEFAULT NULL,
  `net_payable_amount_approval` varchar(255) DEFAULT NULL,
  `payable_status` int(5) NOT NULL DEFAULT '0',
  `no_of_slots` int(15) NOT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `reason` text,
  `user_id` int(10) DEFAULT NULL,
  `attendance` varchar(64) NOT NULL DEFAULT 'Pending',
  `attendance_by` int(11) NOT NULL,
  `is_refunded` int(11) NOT NULL DEFAULT '0',
  `refund_date` date NOT NULL,
  `changed_slot` int(11) NOT NULL DEFAULT '0',
  `updated_admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking_approvals`
--

INSERT INTO `booking_approvals` (`id`, `ticket_no`, `parent_id`, `activityselection_id`, `student_id`, `psa_id`, `activity_id`, `level_id`, `status`, `amount`, `vat_perc`, `vat_amount`, `discount`, `discount_percentage`, `discount_amount`, `wallet_amount`, `payable_amount`, `wallet_balance`, `checkout_status`, `net_payable_amount_approval`, `payable_status`, `no_of_slots`, `created_by`, `created_at`, `updated_at`, `reason`, `user_id`, `attendance`, `attendance_by`, `is_refunded`, `refund_date`, `changed_slot`, `updated_admin_id`) VALUES
(1, 'BKNO-0002', '3', '3', '4', NULL, '1', '1', 'Approved', 390.00, 5.00, 19.50, NULL, NULL, NULL, 546.00, 409.50, 136.50, 'Paid', 'Approved', 1, 6, 1, '2022-01-12 19:19:36', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(2, 'BKNO-0003', '4', '3', '5', NULL, '1', '1', 'Approved', 390.00, 5.00, 19.50, NULL, NULL, NULL, 546.00, 409.50, 136.50, 'Paid', 'Approved', 1, 6, 1, '2022-01-12 19:21:34', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(3, 'BKNO-0004', '5', '6', '6', NULL, '1', '1', 'Approved', 520.00, 5.00, 26.00, NULL, NULL, NULL, 1000.00, 546.00, 454.00, 'Paid', 'Approved', 0, 8, 1, '2022-01-12 19:34:24', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(4, 'BKNO-0005', '6', '6', '7', NULL, '1', '1', 'Approved', 455.00, 5.00, 22.75, NULL, NULL, NULL, 683.00, 477.75, 205.25, 'Paid', 'Approved', 1, 7, 1, '2022-01-12 19:46:56', '0000-00-00 00:00:00', 'approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(5, 'BKNO-0006', '7', '3', '8', NULL, '1', '1', 'Approved', 585.00, 5.00, 29.25, NULL, NULL, NULL, 1474.00, 614.25, 859.75, 'Paid', 'Approved', 0, 9, 1, '2022-01-12 20:03:31', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(6, 'BKNO-0007', '7', '3', '9', NULL, '1', '1', 'Approved', 416.00, 5.00, 20.80, NULL, NULL, NULL, 655.00, 436.80, 218.20, 'Paid', 'Approved', 0, 8, 1, '2022-01-12 20:13:34', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(7, 'BKNO-0008', '9', '3', '12', NULL, '1', '1', 'Approved', 225.00, 5.00, 11.25, NULL, NULL, NULL, 315.00, 236.25, 78.75, 'Paid', 'Approved', 0, 3, 1, '2022-01-12 20:19:52', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(8, 'BKNO-0009', '12', '6', '16', NULL, '1', '1', 'Approved', 260.00, 5.00, 13.00, NULL, NULL, NULL, 1052.00, 273.00, 779.00, 'Paid', 'Approved', 1, 5, 1, '2022-01-13 15:26:43', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(9, 'BKNO-0010', '12', '3', '21', NULL, '1', '1', 'Approved', 390.00, 5.00, 19.50, NULL, NULL, NULL, 615.20, 409.50, 205.70, 'Paid', 'Approved', 1, 6, 1, '2022-01-13 15:30:42', '0000-00-00 00:00:00', 'approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(10, 'BKNO-0011', '13', '3', '17', NULL, '1', '2', 'Approved', 390.00, 5.00, 19.50, NULL, NULL, NULL, 1256.00, 409.50, 846.50, 'Paid', 'Approved', 1, 6, 1, '2022-01-14 11:19:16', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(11, 'BKNO-0012', '13', '9', '18', NULL, '1', '2', 'Approved', 390.00, 5.00, 19.50, NULL, NULL, NULL, 819.20, 409.50, 409.70, 'Paid', 'Approved', 1, 6, 1, '2022-01-14 17:32:26', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(12, 'BKNO-0013', '14', '3', '19', NULL, '1', '1', 'Approved', 585.00, 5.00, 29.25, NULL, NULL, NULL, 900.00, 614.25, 285.75, 'Paid', 'Approved', 0, 9, 1, '2022-01-14 17:40:59', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(13, 'BKNO-0014', '15', '3', '20', NULL, '1', '1', 'Approved', 325.00, 5.00, 16.25, NULL, NULL, NULL, 546.00, 341.25, 204.75, 'Paid', 'Approved', 1, 5, 1, '2022-01-14 17:51:10', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(14, 'BKNO-0015', '16', '12', '22', NULL, '1', '1', 'Approved', 150.00, 5.00, 7.50, NULL, NULL, NULL, 315.00, 157.50, 157.50, 'Paid', 'Approved', 0, 2, 1, '2022-01-17 19:22:17', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(15, 'BKNO-0016', '17', '12', '23', NULL, '1', '1', 'Approved', 260.00, 5.00, 13.00, NULL, NULL, NULL, 546.00, 273.00, 273.00, 'Paid', 'Approved', 1, 4, 1, '2022-01-17 19:26:50', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(16, 'BKNO-0017', '19', '12', '26', NULL, '1', '1', 'Approved', 260.00, 5.00, 13.00, NULL, NULL, NULL, 546.00, 273.00, 273.00, 'Paid', 'Approved', 1, 4, 1, '2022-01-17 19:40:26', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(17, 'BKNO-0018', '20', '14', '27', NULL, '1', '1', 'Approved', 260.00, 5.00, 13.00, NULL, NULL, NULL, 546.00, 273.00, 273.00, 'Paid', 'Approved', 1, 4, 1, '2022-01-17 19:44:32', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(18, 'BKNO-0019', '22', '19', '29', NULL, '2', '1', 'Approved', 540.00, 5.00, 27.00, NULL, NULL, NULL, 1050.00, 567.00, 483.00, 'Paid', 'Approved', 1, 6, 1, '2022-01-17 20:00:13', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(19, 'BKNO-0020', '23', '12', '30', NULL, '1', '1', 'Approved', 260.00, 5.00, 13.00, NULL, NULL, NULL, 1107.00, 273.00, 834.00, 'Paid', 'Approved', 1, 4, 1, '2022-01-17 20:06:56', '0000-00-00 00:00:00', 'Approved', NULL, 'Pending', 0, 0, '0000-00-00', 0, 1),
(20, 'BKNO-0021', '23', '12', '31', NULL, '1', '1', 'Approved', 240.00, 5.00, 12.00, NULL, NULL, NULL, 834.00, 252.00, 582.00, 'Paid', 'Approved', 0, 4, 1, '2022-01-17 20:08:44', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(21, 'BKNO-0022', '23', '12', '31', NULL, '1', '1', 'Pending', 208.00, 5.00, 10.40, NULL, NULL, NULL, 822.00, 218.40, 603.60, 'Paid', 'Approved', 1, 4, 1, '2022-01-17 20:17:24', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(22, 'BKNO-0023', '26', '3', '35', NULL, '1', '1', 'Approved', 150.00, 5.00, 7.50, NULL, NULL, NULL, 394.00, 157.50, 236.50, 'Paid', 'Approved', 0, 2, 1, '2022-01-18 11:44:51', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(23, 'BKNO-0024', '30', '4', '39', NULL, '1', '1', 'Pending', 260.00, 5.00, 13.00, NULL, NULL, NULL, 615.00, 273.00, 342.00, 'Paid', 'Approved', 1, 4, 1, '2022-01-18 12:03:31', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(24, 'BKNO-0025', '32', '9', '41', NULL, '1', '1', 'Pending', 130.00, 5.00, 6.50, NULL, NULL, NULL, 546.00, 136.50, 409.50, 'Paid', 'Approved', 1, 2, 1, '2022-01-18 12:23:29', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(25, 'BKNO-0026', '33', '12', '42', NULL, '1', '1', 'Pending', 195.00, 5.00, 9.75, NULL, NULL, NULL, 983.00, 204.75, 778.25, 'Paid', 'Approved', 1, 3, 1, '2022-01-18 12:45:55', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(26, 'BKNO-0027', '33', '12', '43', NULL, '1', '1', 'Pending', 156.00, 5.00, 7.80, NULL, NULL, NULL, 437.00, 163.80, 273.20, 'Paid', 'Approved', 1, 3, 1, '2022-01-18 12:55:06', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(27, 'BKNO-0028', '23', '3', '30', NULL, '1', '1', 'Pending', 0.10, 5.00, 0.01, NULL, NULL, NULL, 0.90, 0.11, 0.80, 'Paid', 'Approved', 1, 1, 26, '2022-02-01 12:08:35', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(28, 'BKNO-0029', '86', '3', '113', NULL, '1', '1', 'Approved', 10.00, 5.00, 0.50, NULL, NULL, NULL, 895.00, 10.50, 884.50, 'Paid', 'Approved', 1, 8, 92, '2022-02-01 23:38:31', '0000-00-00 00:00:00', 'yes', NULL, 'Pending', 0, 0, '0000-00-00', 0, 90),
(29, 'BKNO-0030', '86', '3', '113', NULL, '1', '1', 'Approved', 65.00, 5.00, 3.25, NULL, NULL, NULL, 884.50, 68.25, 816.25, 'Paid', 'Approved', 0, 1, 92, '2022-02-01 23:44:22', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(30, 'BKNO-0031', '86', '9', '113', NULL, '1', '1', 'Approved', 130.00, 5.00, 6.50, NULL, NULL, NULL, 816.25, 136.50, 679.75, 'Paid', 'Approved', 0, 2, 92, '2022-02-01 23:54:26', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(31, 'BKNO-0032', '86', '3', '113', NULL, '1', '1', 'Approved', 65.00, 5.00, 3.25, NULL, NULL, NULL, 679.75, 68.25, 611.50, 'Paid', 'Approved', 0, 1, 92, '2022-02-01 23:56:49', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(32, 'BKNO-0033', '86', '3', '113', NULL, '1', '1', 'Pending', 1.00, 5.00, 0.05, NULL, NULL, NULL, 612.81, 1.05, 611.76, 'Paid', 'Approved', 1, 1, 90, '2022-02-10 09:36:51', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(33, 'BKNO-0034', '86', '3', '113', NULL, '1', '1', 'Pending', 1.00, 5.00, 0.05, NULL, NULL, NULL, 611.76, 1.05, 610.71, 'Paid', 'Approved', 1, 1, 90, '2022-02-10 09:37:56', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(34, 'BKNO-0035', '86', '3', '113', NULL, '1', '1', 'Pending', 1.00, 5.00, 0.05, NULL, NULL, NULL, 610.71, 1.05, 609.66, 'Paid', 'Approved', 1, 1, 90, '2022-02-10 09:39:02', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(35, 'BKNO-0036', '86', '9', '113', NULL, '1', '1', 'Pending', 1.00, 5.00, 0.05, NULL, NULL, NULL, 609.66, 1.05, 608.61, 'Paid', 'Approved', 1, 1, 90, '2022-02-10 09:39:58', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(36, 'BKNO-0037', '86', '9', '113', NULL, '1', '1', 'Pending', 1.00, 5.00, 0.05, NULL, NULL, NULL, 608.61, 1.05, 607.56, 'Paid', 'Approved', 1, 1, 90, '2022-02-10 10:10:30', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0),
(37, 'BKNO-0038', '87', '19', '115', NULL, '2', '', 'Approved', 100.00, 5.00, 5.00, NULL, NULL, NULL, 790.00, 105.00, 685.00, 'Paid', 'Approved', 0, 1, 90, '2022-02-10 10:42:59', '0000-00-00 00:00:00', NULL, NULL, 'Pending', 0, 0, '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_approval_details`
--

CREATE TABLE `booking_approval_details` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bulk_refunds`
--

CREATE TABLE `bulk_refunds` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `calendar_events`
--

CREATE TABLE `calendar_events` (
  `ID` int(11) NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `change_coach_levels`
--

CREATE TABLE `change_coach_levels` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currentlevel_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currentcoach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `newlevel_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `newcoach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approvecoach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `change_slot_reqs`
--

CREATE TABLE `change_slot_reqs` (
  `id` int(11) NOT NULL,
  `ticket_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `psa_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bkid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lane_court_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity_id` int(11) NOT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_month_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activityselection_id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `change_slot_date` date DEFAULT NULL,
  `change_slot_from_time` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `change_slot_to_time` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `change_activityselection_id` int(11) NOT NULL,
  `attendance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checkout_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checkout_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valuable_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approval_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_admin_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_admin_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `medical_proof_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `medical_proof_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `medical_proof_file_size` int(11) DEFAULT NULL,
  `medical_proof_updated_at` datetime DEFAULT NULL,
  `updated_admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_attended_reports`
--

CREATE TABLE `class_attended_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class_booked_reports`
--

CREATE TABLE `class_booked_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class_missed_reports`
--

CREATE TABLE `class_missed_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `coach_id` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `coach_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `phone2` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `emirates_id` varchar(255) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `passport_size_image` varchar(255) NOT NULL,
  `passport_image` varchar(255) NOT NULL,
  `visa_image` varchar(255) NOT NULL,
  `emirates_id_image` varchar(255) NOT NULL,
  `experience_certificate_image` varchar(255) NOT NULL,
  `police_verification_image` varchar(255) NOT NULL,
  `municipality_certificate_image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`coach_id`, `code`, `coach_name`, `age`, `dob`, `gender`, `experience`, `role`, `activity_id`, `location_id`, `address`, `address1`, `city`, `state`, `country`, `postal_code`, `phone1`, `phone2`, `email_id`, `emirates_id`, `expiry_date`, `status`, `passport_size_image`, `passport_image`, `visa_image`, `emirates_id_image`, `experience_certificate_image`, `police_verification_image`, `municipality_certificate_image`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'PSBACH01', 'Raja Sekar', 32, '1989-11-25', 'Male', '5', 'coach', 1, 1, '', '', '', '', '', '', '971508109743', '971566616447', 'rajasekar2503@gmail.com', '', '0000-00-00', 'Active', '', '', '', '', '', '', '', '2022-01-06 17:37:09', '2022-01-16 16:24:02', 0),
(2, 'PSSWCH01', 'Francis Segui', 36, '1985-12-20', 'Male', '10', 'headcoach', 2, 2, '', '', '', '', '', '', '971502861686', '971505761083', 'ranzkylersegui@gmail.com', '', '0000-00-00', 'Active', '', '', '', '', '', '', '', '2022-01-14 19:39:53', NULL, 0),
(3, 'PSSWCH02', 'Marisa', 37, '1984-10-02', 'Male', '8', 'coach', 2, 3, '', '', '', '', '', '', '971527296540', '971527296540', 'marisa@gmail.com', '', '0000-00-00', 'Active', '', '', '', '', '', '', '', '2022-01-16 16:23:43', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `id` int(11) NOT NULL,
  `coachid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experiance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phn1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phn2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proof` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cemid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cemid_issue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cemid_expire` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_file_size` int(11) DEFAULT NULL,
  `image_updated_at` datetime DEFAULT NULL,
  `coach_passport_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_passport_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_passport_file_size` int(11) DEFAULT NULL,
  `coach_passport_updated_at` datetime DEFAULT NULL,
  `coach_emid_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_emid_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_emid_file_size` int(11) DEFAULT NULL,
  `coach_emid_updated_at` datetime DEFAULT NULL,
  `coach_visapage_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_visapage_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_visapage_file_size` int(11) DEFAULT NULL,
  `coach_visapage_updated_at` datetime DEFAULT NULL,
  `municipality_certificate_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `municipality_certificate_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `municipality_certificate_file_size` int(11) DEFAULT NULL,
  `municipality_certificate_updated_at` datetime DEFAULT NULL,
  `experience_certificate_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experience_certificate_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experience_certificate_file_size` int(11) DEFAULT NULL,
  `experience_certificate_updated_at` datetime DEFAULT NULL,
  `police_verification_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `police_verification_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `police_verification_file_size` int(11) DEFAULT NULL,
  `police_verification_updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coach_logins`
--

CREATE TABLE `coach_logins` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coach_profile_reports`
--

CREATE TABLE `coach_profile_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coach_roasters`
--

CREATE TABLE `coach_roasters` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contract_customer_invoices`
--

CREATE TABLE `contract_customer_invoices` (
  `id` int(11) NOT NULL,
  `activity_selection_id` varchar(255) DEFAULT NULL,
  `wallet_transaction_id` varchar(255) DEFAULT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `paid_date` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contract_details`
--

CREATE TABLE `contract_details` (
  `id` int(11) NOT NULL,
  `activity_selection_id` int(10) NOT NULL,
  `year` int(20) NOT NULL,
  `contract_from_date` date NOT NULL,
  `contract_to_date` date NOT NULL,
  `contract_gross_amount` decimal(10,2) NOT NULL,
  `contract_vat_percentage` decimal(10,2) NOT NULL,
  `contract_vat_amount` decimal(10,2) NOT NULL,
  `contract_net_amount` decimal(10,2) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `contract_form_sent_to_parent` int(10) NOT NULL DEFAULT '0',
  `parent_approved` varchar(100) NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contract_details`
--

INSERT INTO `contract_details` (`id`, `activity_selection_id`, `year`, `contract_from_date`, `contract_to_date`, `contract_gross_amount`, `contract_vat_percentage`, `contract_vat_amount`, `contract_net_amount`, `status`, `contract_form_sent_to_parent`, `parent_approved`, `created_at`, `created_by`) VALUES
(10, 111, 1, '2022-02-01', '2023-01-31', 18000.00, 5.00, 900.00, 18900.00, 1, 1, 'Pending', '2022-02-25 16:21:31', 90);

-- --------------------------------------------------------

--
-- Table structure for table `contract_detail_admins`
--

CREATE TABLE `contract_detail_admins` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contract_payments`
--

CREATE TABLE `contract_payments` (
  `id` int(15) NOT NULL,
  `contract_detail_id` int(15) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `bank_id` int(15) DEFAULT NULL,
  `cheque_bank` varchar(255) DEFAULT NULL,
  `cheque_number` varchar(30) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `payable_date` date DEFAULT NULL,
  `payable_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` int(10) NOT NULL DEFAULT '1',
  `created_by` int(10) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_payments`
--

INSERT INTO `contract_payments` (`id`, `contract_detail_id`, `payment_type`, `bank_id`, `cheque_bank`, `cheque_number`, `cheque_date`, `payable_date`, `payable_amount`, `status`, `created_by`, `created_on`) VALUES
(11, 10, 'Cash', NULL, NULL, NULL, NULL, '2022-02-25', 8900.00, 1, 90, '2022-02-25 16:21:31'),
(12, 10, 'Card', 1, NULL, NULL, NULL, '2022-02-02', 10000.00, 1, 90, '2022-02-25 16:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `contract_payment_detail_reports`
--

CREATE TABLE `contract_payment_detail_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(15) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_symbol` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `country_flag` text,
  `status` int(15) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `currency_code`, `currency_symbol`, `country_flag`, `status`) VALUES
(1, 'UAE', 'AED', 'د.إ', 'assets/Country_flags/UAE.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_package_setups`
--

CREATE TABLE `course_package_setups` (
  `id` int(11) NOT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credits_roll_backs`
--

CREATE TABLE `credits_roll_backs` (
  `id` int(11) NOT NULL,
  `roll_back_id` varchar(255) DEFAULT NULL,
  `prepaid_credit_id` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `name_id` varchar(255) DEFAULT NULL,
  `mobile_id` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `balance_credits` decimal(10,2) DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `total_credits` decimal(10,2) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rollback_amount` decimal(10,2) DEFAULT NULL,
  `updated_amount` float DEFAULT NULL,
  `updated_name` varchar(255) DEFAULT NULL,
  `updated_email` varchar(255) DEFAULT NULL,
  `updated_date` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_by_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `daily_activity_reports`
--

CREATE TABLE `daily_activity_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_transactions`
--

CREATE TABLE `daily_transactions` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gross_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_percentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat_percentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund_percentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `net_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `transaction_type` text COLLATE utf8_unicode_ci,
  `activity_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `approved_by` int(11) NOT NULL,
  `settled_by` int(11) NOT NULL,
  `paid_to` int(11) DEFAULT NULL,
  `trn_no` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `debit` float DEFAULT NULL,
  `total_credit` float DEFAULT NULL,
  `transaction_amount` float DEFAULT NULL,
  `transaction_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payfee_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extraclass_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_reversed` int(11) NOT NULL DEFAULT '0',
  `updated_admin_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_admin_id` int(11) NOT NULL,
  `invoice_date` date DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_transaction_reports`
--

CREATE TABLE `daily_transaction_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount_setups`
--

CREATE TABLE `discount_setups` (
  `id` int(11) NOT NULL,
  `discount_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_percentage` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `discount_setups`
--

INSERT INTO `discount_setups` (`id`, `discount_name`, `discount_percentage`, `created_at`, `updated_at`) VALUES
(1, 'Sibling Discount', 20.00, '2022-01-05 21:16:12', '2022-01-06 18:46:45'),
(2, 'Management Discount', 20.00, '2022-01-13 16:10:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_date` date DEFAULT NULL,
  `event_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extraclass_fees`
--

CREATE TABLE `extraclass_fees` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_contact_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee_pay_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay_month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_class_session` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_class_fees` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `daily_transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_bank_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `netbank_bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extra_classes_tracking_reports`
--

CREATE TABLE `extra_classes_tracking_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extra_class_trackings`
--

CREATE TABLE `extra_class_trackings` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `f_contact_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attended_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_monthly`
--

CREATE TABLE `fees_monthly` (
  `id` int(15) NOT NULL,
  `hours` varchar(50) NOT NULL,
  `activity_id` int(15) NOT NULL,
  `level_id` int(15) NOT NULL,
  `country_id` int(15) NOT NULL DEFAULT '1',
  `from_class` int(15) NOT NULL,
  `to_class` int(15) NOT NULL,
  `fees_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `updated_by` int(15) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fees_paid_dues`
--

CREATE TABLE `fees_paid_dues` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_structure_images`
--

CREATE TABLE `fees_structure_images` (
  `id` int(11) NOT NULL,
  `activity_id` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `fee_image_file_name` varchar(255) DEFAULT NULL,
  `fee_image_content_type` varchar(255) DEFAULT NULL,
  `fee_image_file_size` int(11) DEFAULT NULL,
  `fee_image_updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fees_structure_images`
--

INSERT INTO `fees_structure_images` (`id`, `activity_id`, `description`, `created_at`, `updated_at`, `fee_image_file_name`, `fee_image_content_type`, `fee_image_file_size`, `fee_image_updated_at`) VALUES
(1, '1', 'Badminton Fee', '2022-01-06 18:43:32', '0000-00-00 00:00:00', 'Badminton.jpg', NULL, NULL, NULL),
(2, '2', 'Swimming Fee', '2022-01-06 18:43:58', '0000-00-00 00:00:00', 'Swimming.jpg', NULL, NULL, NULL),
(3, '4', 'TT', '2022-01-06 18:44:14', '0000-00-00 00:00:00', 'Table Tennis.png', NULL, NULL, NULL),
(4, '3', 'Karate', '2022-01-06 18:44:30', '0000-00-00 00:00:00', 'Karate.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees_yearly_contract`
--

CREATE TABLE `fees_yearly_contract` (
  `id` int(10) NOT NULL,
  `country_id` int(10) NOT NULL DEFAULT '1',
  `fees_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `updated_by` int(15) DEFAULT NULL,
  `updated_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees_yearly_contract`
--

INSERT INTO `fees_yearly_contract` (`id`, `country_id`, `fees_amount`, `updated_by`, `updated_on`) VALUES
(1, 1, 18000.00, NULL, '2022-02-03 16:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `fee_package_setups`
--

CREATE TABLE `fee_package_setups` (
  `fee_package_setups_id` int(11) NOT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fee_package_setups`
--

INSERT INTO `fee_package_setups` (`fee_package_setups_id`, `game_id`, `location_id`, `level_id`, `hour`, `note`, `category`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, '1', 'Two', '', '', '2022-01-05 21:02:53', '2022-01-07 09:03:48'),
(2, '1', NULL, '2', 'Two', '', '', '2022-01-05 21:03:13', '2022-01-07 09:03:11'),
(3, '1', NULL, '3', 'Two', '', '', '2022-01-05 21:04:04', '2022-01-07 09:03:02'),
(4, '2', NULL, '1', 'One', '', '', '2022-01-05 21:04:30', '0000-00-00 00:00:00'),
(5, '2', NULL, '2', 'One', '', '', '2022-01-05 21:04:57', '0000-00-00 00:00:00'),
(6, '2', NULL, '2', 'Two', '', '', '2022-01-05 21:07:17', '0000-00-00 00:00:00'),
(7, '2', NULL, '1', 'Two', '', '', '2022-01-05 21:07:59', '0000-00-00 00:00:00'),
(8, '2', NULL, '3', 'Two', '', '', '2022-01-05 21:08:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `game` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `game_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `active` int(15) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `game`, `game_code`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Badminton', 'BA', '2022-01-05 20:51:53', '0000-00-00 00:00:00', 1),
(2, 'Swimming', 'SW', '2022-01-05 20:52:04', '0000-00-00 00:00:00', 1),
(3, 'Karate', 'KA', '2022-01-05 20:52:12', '0000-00-00 00:00:00', 1),
(4, 'Table Tennis', 'TT', '2022-01-05 20:52:20', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `game_levels`
--

CREATE TABLE `game_levels` (
  `games_level_id` int(11) NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `game_levels`
--

INSERT INTO `game_levels` (`games_level_id`, `level`, `session`, `created_at`, `updated_at`) VALUES
(1, 'Beginner', '24', '2022-01-05 20:59:46', '0000-00-00 00:00:00'),
(2, 'Intermediate', '24', '2022-01-05 21:00:19', '0000-00-00 00:00:00'),
(3, 'Advance', '24', '2022-01-05 21:00:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `headcoach_logins`
--

CREATE TABLE `headcoach_logins` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `wallet_transaction_id` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `slot_booking_count` varchar(255) DEFAULT NULL,
  `slot_booking` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_reports`
--

CREATE TABLE `invoice_reports` (
  `id` int(11) NOT NULL,
  `wallet_transaction_id` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `parent_mobile` varchar(255) DEFAULT NULL,
  `gross_amount` varchar(255) DEFAULT NULL,
  `discount_percentage` varchar(255) DEFAULT NULL,
  `discount_value` varchar(255) DEFAULT NULL,
  `vat_percentage` varchar(255) DEFAULT NULL,
  `vat_value` varchar(255) DEFAULT NULL,
  `refund_percentage` varchar(255) DEFAULT NULL,
  `refund_value` varchar(255) DEFAULT NULL,
  `net_amount` varchar(255) DEFAULT NULL,
  `account_code` varchar(255) DEFAULT NULL,
  `wallet_transaction_date` date DEFAULT NULL,
  `wallet_transaction_type` text,
  `amount` float DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `debit` float DEFAULT NULL,
  `balance_credit` float DEFAULT NULL,
  `amount_paid` float DEFAULT NULL,
  `total_credit` float DEFAULT NULL,
  `wallet_transaction_amount` float DEFAULT NULL,
  `wallet_transaction_detail` varchar(255) DEFAULT NULL,
  `wallet_id` varchar(255) DEFAULT NULL,
  `reg_id` varchar(255) DEFAULT NULL,
  `payfee_id` varchar(255) DEFAULT NULL,
  `slot_req_id` varchar(255) DEFAULT NULL,
  `refund_reason` varchar(255) DEFAULT NULL,
  `updated_admin_name` varchar(255) DEFAULT NULL,
  `updated_admin_email` varchar(255) DEFAULT NULL,
  `updated_date` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lane_courts`
--

CREATE TABLE `lane_courts` (
  `id` int(11) NOT NULL,
  `lane_court` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lane_courts`
--

INSERT INTO `lane_courts` (`id`, `lane_court`, `game_id`, `location_id`, `created_at`, `updated_at`) VALUES
(1, 'Court 1', NULL, NULL, '2022-01-05 20:57:25', '0000-00-00 00:00:00'),
(2, 'Court 2', NULL, NULL, '2022-01-05 20:57:36', '0000-00-00 00:00:00'),
(3, 'Court 3', NULL, NULL, '2022-01-05 20:57:47', '0000-00-00 00:00:00'),
(4, 'Lane 1', NULL, NULL, '2022-01-05 20:58:04', '0000-00-00 00:00:00'),
(5, 'Lane 2', NULL, NULL, '2022-01-05 20:58:13', '0000-00-00 00:00:00'),
(6, 'Lane 3', NULL, NULL, '2022-01-05 20:58:19', '0000-00-00 00:00:00'),
(7, 'Lane 4', NULL, NULL, '2022-01-05 20:58:31', '2022-01-16 18:02:38'),
(8, 'Table 1', NULL, NULL, '2022-01-05 20:58:42', '0000-00-00 00:00:00'),
(9, 'Table 2', NULL, NULL, '2022-01-05 20:58:51', '0000-00-00 00:00:00'),
(10, 'Table 3', NULL, NULL, '2022-01-05 20:59:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_reports`
--

CREATE TABLE `ledger_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location`, `place`, `address`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Prime Star Karama', 'Karama', 'Near to Nesto / Bank of Baroda (Near Karama post office)', 0, '2022-01-05 20:53:30', '0000-00-00 00:00:00'),
(2, 'Prime Egyption Club', 'Oud Metha', 'Egyption Club', 0, '2022-01-05 20:54:45', '0000-00-00 00:00:00'),
(3, 'Prime Star St Marys', 'Muhaisna Quasis', 'St Marys Catholic School Muhaisna Quasis', 0, '2022-01-05 20:56:01', '0000-00-00 00:00:00'),
(4, 'Prime Star Al Nasr', 'Oud Metha', 'Al Nasr - Oud Metha', 0, '2022-01-06 18:45:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `location_based_games`
--

CREATE TABLE `location_based_games` (
  `id` int(11) NOT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location_based_games`
--

INSERT INTO `location_based_games` (`id`, `location_id`, `game_id`, `level_id`, `coach_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', NULL, NULL, '2022-01-05 20:56:25', '0000-00-00 00:00:00'),
(2, '2', '2', NULL, NULL, '2022-01-05 20:56:33', '0000-00-00 00:00:00'),
(3, '3', '2', NULL, NULL, '2022-01-05 20:56:51', '0000-00-00 00:00:00'),
(4, '4', '1', NULL, NULL, '2022-01-06 18:46:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `main_menu_modules`
--

CREATE TABLE `main_menu_modules` (
  `Id` int(20) NOT NULL,
  `main_menu_name` varchar(255) NOT NULL,
  `position` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main_menu_modules`
--

INSERT INTO `main_menu_modules` (`Id`, `main_menu_name`, `position`) VALUES
(1, 'Academy Activities', 1),
(2, 'Maintenance', 2),
(3, 'Reports', 3),
(4, 'School', 4);

-- --------------------------------------------------------

--
-- Table structure for table `main_menu_sub_modules`
--

CREATE TABLE `main_menu_sub_modules` (
  `Id` int(20) NOT NULL,
  `main_menu_id` int(10) NOT NULL,
  `sub_menu_name` varchar(255) NOT NULL,
  `controller_name` varchar(255) NOT NULL,
  `position` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `main_menu_sub_modules`
--

INSERT INTO `main_menu_sub_modules` (`Id`, `main_menu_id`, `sub_menu_name`, `controller_name`, `position`) VALUES
(1, 1, 'Coach Registration', 'Coach', 1),
(2, 1, 'Student Registration', 'Students', 2),
(3, 1, 'Registration Fees', 'Registration_fees', 3),
(4, 1, 'Daily Transaction', 'Daily_transaction', 4),
(5, 1, 'Activity Remark', 'Activity_remark', 5),
(6, 1, 'Attendance', 'Attendance_book', 6),
(7, 1, 'Slot Refund Approval', 'Slot_refund_request/list', 7),
(8, 1, 'Prepaid Credits', 'Prepaid_credits', 8),
(9, 1, 'User Wallet Details', 'User_wallet_details', 9),
(10, 1, 'Registration Approval', 'Registration_approval', 10),
(11, 1, 'Activity Approval', 'Activity_approval', 11),
(12, 1, 'Credits Roll Back', 'Credits_roll_back', 12),
(13, 1, 'Booking Approval', 'student_profile_slot_booking/approval', 13),
(14, 1, 'Wallet Transaction', 'Wallet_transaction', 14),
(15, 1, 'Bulk refund', 'Bulk_refund', 15),
(16, 1, 'Contract Customer Invoice', 'Contract_customer_invoice', 16),
(17, 2, 'Activity', 'Games', 1),
(18, 2, 'Location', 'Location', 2),
(19, 2, 'Activity Based Location', 'Location_based_games', 3),
(20, 2, 'Lane/Court', 'Lane_court', 4),
(21, 2, 'Activity Level', 'Activity_level', 5),
(22, 2, 'Activity Slot', 'Activity_slot', 6),
(23, 2, 'Registration Charge Setup', 'Registration_charge_setup', 7),
(24, 2, 'Fees Package Setup', 'Fees_package_setup', 8),
(25, 2, 'Bank Details', 'Bank_details', 9),
(26, 2, 'Discount Setup', 'Discount_setup', 10),
(27, 2, 'Account Codes', 'Account_codes', 11),
(28, 2, 'Events', 'Events', 12),
(29, 2, 'Scroll Text Message', 'Scroll_text_messages', 13),
(30, 2, 'Set Academy Holiday', 'Set_academy_holiday', 14),
(31, 2, 'Vat Setup', 'Vat_setup', 15),
(32, 2, 'Refund Discount Percentage', 'Refund_discount_percentages', 16),
(33, 2, 'Fees Structure Images', 'Fees_structure_images', 17),
(34, 2, 'Assign Coach', 'Assign_coach', 18),
(35, 3, 'Daily Activity Report', 'reports/activity/daily_activity', 1),
(36, 3, 'Coach roaster', 'reports/coach_roaster', 2),
(37, 3, 'Student Profile Report', 'reports/student_profile', 3),
(38, 3, 'Coach Profile Report', 'reports/coach_profile', 4),
(39, 3, 'Daily Transaction Report', 'daily_transaction/report', 5),
(40, 3, 'Ledger Report', 'reports/ledger_report', 6),
(41, 3, 'Attendance Tracking Report', 'Reports/attendance_tracking', 7),
(42, 3, 'Request Approve Reject Report', 'Reports/Request_approve_reject', 8),
(43, 3, 'Master Wallet Transaction Report', 'Reports/wallet_transaction/master', 9),
(44, 3, 'Wallet Transaction Report', 'Reports/wallet_transaction', 10),
(45, 3, 'Activity List Report', 'Reports/activity_list', 11),
(46, 3, 'Slot Schedule Report', 'Reports/activity/slot_schedule', 12),
(47, 3, 'Activity Slot Report', 'reports/activity_slot', 13),
(48, 3, 'Invoice Report', 'reports/invoice_report', 14),
(49, 3, 'VAT Report', 'reports/vat_report', 15),
(50, 3, 'Contract Payment Report', 'reports/contract_payment', 16),
(51, 3, 'Slot Swap Report', 'reports/slot_swap', 17),
(52, 3, 'Rating Review Report', 'reports/rating_review', 18),
(53, 3, 'Class Booked Report', 'reports/class_report/booked', 19),
(54, 3, 'Class Attended Report', 'reports/class_report/attended', 20),
(55, 3, 'Class Missed Report', 'reports/class_report/missed', 21),
(56, 4, 'School Registration / Profile Report', 'school_profile_reports', 1),
(57, 4, 'School Credit Invoice', 'school_credits', 2),
(58, 4, 'School Invoice Report', 'school_credits/report', 3),
(59, 4, 'School Attendance / Booking', 'school_attendance', 4);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `main_menu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_menu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `message_type` varchar(255) NOT NULL,
  `message_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `module_permission`
--

CREATE TABLE `module_permission` (
  `id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `module_group` varchar(255) NOT NULL,
  `superadmin` tinyint(4) DEFAULT NULL,
  `admin` tinyint(4) DEFAULT NULL,
  `headcoach` tinyint(4) DEFAULT NULL,
  `coach` tinyint(4) DEFAULT NULL,
  `parent` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_permission`
--

INSERT INTO `module_permission` (`id`, `module_name`, `module_group`, `superadmin`, `admin`, `headcoach`, `coach`, `parent`) VALUES
(5, 'coach', 'Academy Activities', 1, 1, 1, 1, 1),
(6, 'student_registration', 'Academy Activities', 1, 1, 1, 0, 1),
(7, 'registration_fees', 'Academy Activities', 1, 1, 0, 0, 1),
(8, 'daily_transaction', 'Academy Activities', 1, 1, 0, 0, 0),
(9, 'activity_remark', 'Academy_Activities', 1, 1, 1, 1, 0),
(10, 'attendance_book', 'Academy Activities', 1, 1, 1, 0, 0),
(11, 'slot_refund_approval', 'Academy Activities', 1, 1, 1, 0, 0),
(12, 'prepaid_credits', 'Academy Activities', 1, 1, 0, 0, 0),
(13, 'user_wallet_details', 'Academy Activities', 1, 1, 0, 0, 0),
(14, 'prepaid_credits', 'Academy Activities', 1, 1, 0, 0, 0),
(15, 'user_wallet_details', 'Academy Activities', 1, 1, 0, 0, 0),
(16, 'credits_roll_back', 'Academy Activities', 1, 1, 0, 0, 0),
(17, 'booking_approval', 'Academy Activities', 1, 1, 1, 0, 0),
(18, 'wallet_transaction', 'Academy Activities', 1, 1, 0, 0, 1),
(19, 'bulk_refund', 'Academy Activities', 1, 1, 1, 0, 0),
(20, 'contract_customer_invoice', 'Academy Activities', 1, 1, 0, 0, 0),
(21, 'activity', 'Maintenance', 1, 1, 1, 1, 0),
(22, 'location', 'Maintenance', 1, 1, 1, 1, 0),
(23, 'activity_based_location', 'Maintenance', 1, 1, 1, 1, 0),
(24, 'lane_court', 'Maintenance', 1, 1, 1, 1, 0),
(25, 'activity_level', 'Maintenance', 1, 1, 1, 1, 0),
(26, 'activity_slot', 'Maintenance', 1, 1, 1, 1, 0),
(27, 'registration_charge_setup', 'Maintenance', 1, 1, 1, 0, 0),
(28, 'fees_package_setup', 'Maintenance', 1, 1, 0, 0, 0),
(29, 'bank_details', 'Maintenance', 1, 1, 0, 0, 0),
(30, 'discount_setup', 'Maintenance', 1, 1, 0, 0, 0),
(31, 'account_codes', 'Maintenance', 1, 1, 0, 0, 0),
(32, 'events', 'Maintenance', 1, 1, 1, 0, 0),
(33, 'scroll_text_messages', 'Maintenance', 1, 1, 0, 0, 0),
(34, 'Set Academy Holiday', 'Maintenance', 1, 1, 0, 0, 0),
(35, 'users', 'users', 1, 1, 1, 1, 1),
(36, 'set_academy_holiday', 'Academy Activities	', 1, 1, 0, 0, 0),
(37, 'vat_setup', 'Maintenance', 1, 1, 0, 0, 0),
(38, 'refund_discount_percentages', 'Maintenance', 1, 1, NULL, NULL, NULL),
(39, 'fees_structure_images', 'Maintenance', 1, 1, NULL, NULL, NULL),
(40, 'assign_coach', 'Maintenance', 1, 1, NULL, NULL, NULL),
(41, 'coach_registration', 'Academy_Activities', 1, 1, NULL, NULL, NULL),
(42, 'school_profile_report', 'School', 1, 1, 0, 0, 0),
(43, 'student_profile_slot_booking', 'student_profile_slot_booking', 0, 0, 0, 0, 1),
(44, 'MaintenanceMenu', 'MainMenu', 1, 1, 1, 0, 0),
(45, 'ReportsMenu', 'MainMenu', 1, 1, 0, 0, 0),
(46, 'SchoolMenu', 'MainMenu', 1, 0, 0, 0, 0),
(47, 'UserMenu', 'MainMenu', 1, 1, 1, 1, 1),
(48, 'Activity_approval', 'Academy Activites', 1, 0, 0, 0, 0),
(49, 'Registration_approval', 'Academy Activites', 1, 0, 0, 0, 0),
(50, 'daily_transaction_report', 'Reports', 1, 1, 0, 0, 0),
(51, 'Class_booked_report', 'Reports', 1, 1, 0, 0, 0),
(52, 'Class_attended_report', 'Reports', 1, 1, 0, 0, 0),
(53, 'Class_missed_report', 'Reports', 1, 1, 0, 0, 0),
(54, 'Daily_activity_report', 'Reports', 1, 1, 0, 0, 0),
(55, 'Student_profile_report', 'Reports', 1, 1, 0, 0, 0),
(56, 'Coach_profile_report', 'Reports', 1, 1, 0, 0, 0),
(57, 'Attendance_tracking_report', 'Reports', 1, 1, 0, 0, 0),
(58, 'Request_approve_reject_report', 'Reports', 1, 1, 0, 0, 0),
(59, 'Slot_schedule_report', 'Reports', 1, 1, 0, 0, 0),
(60, 'activity_slot_report', 'Reports', 1, 1, 0, 0, 0),
(61, 'Activity_list_Report', 'Reports', 1, 1, 0, 0, 0),
(62, 'Slot_refund_request', 'Academy_activities', 0, 0, 0, 0, 1),
(63, 'Slot_swap_report', 'Reports', 1, 1, 0, 0, 0),
(64, 'vat_report', 'Reports', 1, 1, 0, 0, 0),
(65, 'Master_wallet_transaction_report', 'Reports', 1, 1, 0, 0, 0),
(66, 'Wallet_transaction_report', 'Reports', 1, 1, 0, 0, 0),
(67, 'Invoice_report', 'Reports', 1, 1, 0, 0, 0),
(68, 'Contract_payment_report', 'Reports', 1, 1, 0, 0, 0),
(69, 'Coach_roaster', 'Reports', 1, 1, 0, 0, 0),
(70, 'Ledger_report', 'Reports', 1, 1, 0, 0, 0),
(71, 'Rating_review_report', 'Reports', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_fees`
--

CREATE TABLE `monthly_fees` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_contact_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee_pay_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay_month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `daily_transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_bank_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `netbank_bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multiple_games`
--

CREATE TABLE `multiple_games` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_applicable` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_select` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_percentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `session_month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee_per_month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_total` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_fee_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parent_id` int(11) NOT NULL,
  `parent_code` varchar(255) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `country_id` int(15) NOT NULL,
  `passport_id` varchar(255) DEFAULT NULL,
  `emirate_id` varchar(255) NOT NULL,
  `emirates_expiry` date DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `parent_code`, `parent_name`, `email_id`, `mobile_no`, `country_id`, `passport_id`, `emirate_id`, `emirates_expiry`, `date_time`, `status`) VALUES
(1, 'PSA001', 'Ravikumar', 'bmr.ind@hotmail.com', '971501097469', 1, NULL, '784197483047904', NULL, '2022-01-05 19:19:08', 'Active'),
(2, 'PSA002', 'Karthick', 'srilakshmisundaar@gmail.com', '971552265185', 1, NULL, '784198658324350', NULL, '2022-01-06 11:53:21', 'Active'),
(3, 'PSA003', 'Simi Rachel', 'rachu13sm@yahoo.com', '971552449010', 1, NULL, '78419829506265', NULL, '2022-01-06 12:14:28', 'Active'),
(4, 'PSA004', 'Hari Krishnan', 'sreelakshmy.v@gmail.com', '971556306307', 1, NULL, '784198335426869', NULL, '2022-01-06 12:19:05', 'Active'),
(5, 'PSA005', 'Deepak Dinesh', 'ramyajakka@gmail.com', '971555859232', 1, NULL, '784 19857092344', NULL, '2022-01-06 12:26:50', 'Active'),
(6, 'PSA006', 'P.P.Raj', 'ppaj1970@gmail.com', '971506984616', 1, NULL, '784197002792642', NULL, '2022-01-06 12:34:27', 'Active'),
(7, 'PSA007', 'Jonald', 'joesun7@gmail.com', '971508508876', 1, NULL, '78419797630876', NULL, '2022-01-06 12:46:20', 'Active'),
(8, 'PSA008', 'raja sekar Ramamoorthy', 'kavithaokm@gmail.com', '971555800490', 1, NULL, '784197967904345', NULL, '2022-01-06 13:17:08', 'Active'),
(9, 'PSA009', 'Ajay subhash', 'dubey.ajay@hotmail.com', '971507118140', 1, NULL, '7841983`780368', NULL, '2022-01-07 09:09:07', 'Active'),
(10, 'PSA010', 'Nivedita', 'niveditashrikent@hotmail.com', '97150429830', 1, NULL, '78419807301373', NULL, '2022-01-07 09:30:01', 'Active'),
(11, 'PSA011', 'Anand', 'anand158@gmail.com', '971508874673', 1, NULL, '784197840987265', NULL, '2022-01-07 10:16:39', 'Active'),
(12, 'PSA012', 'Ramkumar', 'f.l@mail.com', '971566034384', 1, NULL, '784197772510406', NULL, '2022-01-07 10:36:59', 'Active'),
(13, 'PSA013', 'Venkatraman', 'vijisooriya@yahoo.co.in', '971561980256', 1, NULL, '7842390321345', NULL, '2022-01-07 18:43:56', 'Active'),
(14, 'PSA014', 'Sandeep Kumar', 'sandeep11sandeep@gmail.com', '971547019400', 1, NULL, '984198248683975', NULL, '2022-01-07 19:39:38', 'Active'),
(15, 'PSA015', 'Seshendra.V', 'mail2seshendra@gmail.com', '971565841387', 1, NULL, '784198156789392', NULL, '2022-01-08 18:19:24', 'Active'),
(16, 'PSA016', 'Dhamodharan', 'dhamus@yahoo.com', '971506614182', 1, NULL, '78419789532501', NULL, '2022-01-09 10:12:11', 'Active'),
(17, 'PSA017', 'Gopal', 'gopalkrishnan.p@gmail.com', '97150865489', 1, NULL, '784197779871041', NULL, '2022-01-09 10:28:47', 'Active'),
(18, 'PSA018', 'Fatima Chandan', 'fchandan1010@yahoo.com', '971501852624', 1, NULL, '78419803678981286', NULL, '2022-01-09 10:42:06', 'Active'),
(19, 'PSA019', 'Shahid Jiwani', 'reshmajiwani17@gmail.com', '971509969410', 1, NULL, '78420103839587', NULL, '2022-01-09 11:37:58', 'Active'),
(20, 'PSA020', 'Lokesh Rao', 'rlokeshrao@gmail.com', '971558999007', 1, NULL, '784197959710231', NULL, '2022-01-09 12:30:07', 'Active'),
(21, 'PSA021', 'Raghavan NRS', 'nrsragav@gmail.com', '971508189618', 1, NULL, '784198038219701', NULL, '2022-01-09 12:37:35', 'Active'),
(22, 'PSA022', 'Manish Gehani', 'manish_hy@yahoo.com', '971503739016', 1, NULL, '784197740836535', NULL, '2022-01-09 14:07:32', 'Active'),
(23, 'PSA023', 'Anju Das', 'anjudas@gmail.com', '971506450578', 1, NULL, '784197658479074', NULL, '2022-01-09 14:18:25', 'Active'),
(24, 'PSA024', 'Rupesh Gawade', 'rupeshgawadegg@gmail.com', '971528908498', 1, NULL, '78419804614141408', NULL, '2022-01-09 15:18:59', 'Active'),
(25, 'PSA025', 'Arun Kumar', 'aarun.kumaar@gmail.com', '971527485111', 1, NULL, '7841980762899026', NULL, '2022-01-09 15:31:40', 'Active'),
(26, 'PSA026', 'Ranjith.P.V', 'ranjith.pv@gmail.com', '971558810744', 1, NULL, '7841980314024345', NULL, '2022-01-09 16:15:19', 'Active'),
(27, 'PSA027', 'Tanmay Maheshwari', 'ca.maheshwarig@gmail.com', '971501399625', 1, NULL, '784199046462158', NULL, '2022-01-09 16:47:10', 'Active'),
(28, 'PSA028', 'Xavier', 'vanitha.janet@gmail.com', '971506827648', 1, NULL, '784197014384252', NULL, '2022-01-09 17:13:50', 'Active'),
(29, 'PSA029', 'Sam Joel', 'samjoel80@gmail.com', '971552826852', 1, NULL, '784197901928373', NULL, '2022-01-10 10:33:35', 'Active'),
(30, 'PSA030', 'Prajna Rao', 'prajnar19@gmail.com', '971544770400', 1, NULL, '784198860281637', NULL, '2022-01-10 11:00:05', 'Active'),
(31, 'PSA031', 'Krishna', 'krishna.binsuloom@gmail.com', '971506761363', 1, NULL, '78419699205427', NULL, '2022-01-10 11:07:11', 'Active'),
(32, 'PSA032', 'Pradeep', 'keerthanaa.pradeep@gmail.com', '971509057321', 1, NULL, '784197975432156', NULL, '2022-01-10 18:37:38', 'Active'),
(33, 'PSA033', 'kannan Ashokkumar', 'tprema.tec@gmail.com', '971569033276', 1, NULL, '784198107971495', NULL, '2022-01-10 18:46:01', 'Active'),
(34, 'PSA034', 'Manohar', 'mkotian238@gmail.com', '971527773586', 1, NULL, '784198754320', NULL, '2022-01-10 18:56:07', 'Active'),
(35, 'PSA035', 'Shafeequr Rahman', 'toshafeeq@gmail.com', '971501577212', 1, NULL, '784198404265062', NULL, '2022-01-10 19:33:30', 'Active'),
(36, 'PSA036', 'Girish', 'preethi.girish@gmail.com', '971553609421', 1, NULL, '784197846018364', NULL, '2022-01-11 17:23:38', 'Active'),
(37, 'PSA037', 'Vaidhyanathan.V', 'v.vaidhya@outlook.com', '971528598183', 1, NULL, '784197819246097', NULL, '2022-01-12 18:32:01', 'Active'),
(38, 'PSA038', 'Upendra Kale', 'upendra.kale@petrofac.com', '971567562896', 1, NULL, '7841980701246532', NULL, '2022-01-13 09:41:35', 'Active'),
(39, 'PSA039', 'Karthick Raj', 'pjennispandian@gmail.com', '971564048624', 1, NULL, '784198319587432', NULL, '2022-01-13 10:13:26', 'Active'),
(40, 'PSA040', 'Bala subramaniyam', 'jishabalasubramaniyam@gmail.com', '97155063883', 1, NULL, '784201164849578', NULL, '2022-01-13 10:59:43', 'Active'),
(41, 'PSA041', 'Arnel Suerte', 'nellkarell@gmail.com', '971508546029', 1, NULL, '784198049509791', NULL, '2022-01-13 11:12:10', 'Active'),
(42, 'PSA042', 'T.S.Kishore', 'kishore.ts@gmail.com', '971506759023', 1, NULL, '784198020937765', NULL, '2022-01-13 11:51:45', 'Active'),
(43, 'PSA043', 'Xavier', 'xavierlazarwilson@gmail.com', '971506827648', 1, NULL, '784197014384252', NULL, '2022-01-13 12:10:17', 'Active'),
(44, 'PSA044', 'Anitha Krishna Moorthy', 'anithakrishna81@gmail.com', '971503665167', 1, NULL, '784198079595801', NULL, '2022-01-13 13:05:44', 'Active'),
(45, 'PSA045', 'Jayasri Narayanan', 'jayashri.suryanarayanan@gmail.com', '971525617789', 1, NULL, '784198524843731', NULL, '2022-01-14 11:01:50', 'Active'),
(46, 'PSA046', 'Ganesh', 'ganesh.gppnair@gmail.com', '971505247201', 1, NULL, '784197660323631', NULL, '2022-01-14 11:54:06', 'Active'),
(47, 'PSA047', 'Prabhakar', 'prabvis@gmail.com', '971505524571', 1, NULL, '78419749013713', NULL, '2022-01-14 12:45:36', 'Active'),
(48, 'PSA048', 'Anish K.S', 'anish.sasi97152dharan@ymail.com', '971528241849', 1, NULL, '784198651739610', NULL, '2022-01-14 18:56:59', 'Active'),
(49, 'PSA049', 'Murari Pareek', 'pareek.murari@yahoo.com', '971555115850', 1, NULL, '784198396157913', NULL, '2022-01-15 11:02:00', 'Active'),
(50, 'PSA050', 'Rahul Birari', 'rahulmax07@gmail.com', '971569824914', 1, NULL, '784197951058656', NULL, '2022-01-18 09:58:21', 'Active'),
(51, 'PSA051', 'Anshul singhla', 'anshulsingla@gmail.com', '971565384006', 1, NULL, '784198020183949', NULL, '2022-01-18 10:23:05', 'Active'),
(52, 'PSA052', 'Lavanya Priya', 'lavanya.franklin@gmail.com', '971551027708', 1, NULL, '78419803912092761', NULL, '2022-01-20 10:51:22', 'Active'),
(53, 'PSA053', 'Sudeep Mehta', 'sudeepmehta31@gmail.com', '971528672989', 1, NULL, '7841979629841061', NULL, '2022-01-20 11:22:15', 'Active'),
(54, 'PSA054', 'Vivek Sahu', 'krish.tolani@gmail.com', '971555584909', 1, NULL, '784197801629481', NULL, '2022-01-20 11:45:21', 'Active'),
(55, 'PSA055', 'Mohammed Reza Fazulbhoy', 'safira.emaan@gmail.com', '971558724105', 1, NULL, '784197703592135', NULL, '2022-01-20 12:05:58', 'Active'),
(56, 'PSA056', 'Suresh Govindaraj', 'sonasuresh07@gmail.com', '971503691675', 1, NULL, '78419760173630182', NULL, '2022-01-20 12:59:08', 'Active'),
(57, 'PSA057', 'Sanjay Ramdas', 'siresha.sanjay62@gmail.com', '971504782578', 1, NULL, '784197704843909', NULL, '2022-01-20 17:35:09', 'Active'),
(58, 'PSA058', 'Sulakshan.N', 'ssdv1981@gmail.com', '971507935732', 1, NULL, '78419798202831', NULL, '2022-01-20 17:43:23', 'Active'),
(59, 'PSA059', 'Zerses Dubash', 'nkhadiwalla@yahoo.com', '971529038326', 1, NULL, '8741979578291037', NULL, '2022-01-20 18:55:30', 'Active'),
(60, 'PSA060', 'Meesha rajwani', 'anup@rajwaniexports.com', '971508039252', 1, NULL, '78419783901298', NULL, '2022-01-20 19:19:33', 'Active'),
(61, 'PSA061', 'Jayaram Jagannathan', 'j_j_ram@yahoo.com', '971508497989', 1, NULL, '784198026591047', NULL, '2022-01-21 10:59:43', 'Active'),
(62, 'PSA062', 'Pratap Mendonca', 'scytlef@gmail.com', '971504953407', 1, NULL, '784198830195178', NULL, '2022-01-21 11:48:56', 'Active'),
(63, 'PSA063', 'SANDIP GHANDARI', 'sandip_bhandari@hotmail.com', '971506597056', 1, NULL, '784198074327854', NULL, '2022-01-21 18:11:07', 'Active'),
(64, 'PSA064', 'S.Ranganathan', 'rangalakshmi@gmail.com', '971566789467', 1, NULL, '784198414050356', NULL, '2022-01-21 19:33:35', 'Active'),
(65, 'PSA065', 'Badri Ramaswamy', 'erodebadri@gmail.com', '971508024976', 1, NULL, '784198013808799', NULL, '2022-01-23 09:12:24', 'Active'),
(66, 'PSA066', 'Sudharshan.G', 'gs.sudarshan@gmail.com', '971528936873', 1, NULL, '784198149872073', NULL, '2022-01-23 09:27:17', 'Active'),
(67, 'PSA067', 'Vishnu upadhyay', 'vishnu_kinkar@yahoo.com', '971505583725', 1, NULL, '7841975916404873', NULL, '2022-01-23 09:41:51', 'Active'),
(68, 'PSA068', 'Firdous Irani', 'fidzy101@gmail.com', '971505505174', 1, NULL, '7841945012846', NULL, '2022-01-23 10:42:02', 'Active'),
(69, 'PSA069', 'Rajamohamed', 'raja.mohamed23@gmail.com', '971503191434', 1, NULL, '78419807102345', NULL, '2022-01-23 10:59:42', 'Active'),
(70, 'PSA070', 'Parijat', 'preetiparijat@gmail.com', '971543229435', 1, NULL, '78419744207254', NULL, '2022-01-23 11:43:24', 'Active'),
(71, 'PSA071', 'Fehmeena Fahih', 'femfa@yahoo.co.in', '971507684671', 1, NULL, '784197839629769', NULL, '2022-01-23 12:28:50', 'Active'),
(72, 'PSA072', 'Naveen', 'quadrosnixon007@gmail.com', '971508942899', 1, NULL, '7841981928345', NULL, '2022-01-23 12:33:13', 'Active'),
(73, 'PSA073', 'Pradeep Sakhrani', 'pradeepsakhrani2@gmail.com', '971507594023', 1, NULL, '784197841941756', NULL, '2022-01-23 15:14:15', 'Active'),
(74, 'PSA074', 'Sanjay Abichandani', 'sanjay.abichandani79@gmail.com', '971501642544', 1, NULL, '784197901246976', NULL, '2022-01-23 15:27:04', 'Active'),
(75, 'PSA075', 'Suresh Muthyala', 'smuthyala@gmail.com', '971529293433', 1, NULL, '784197393104944', NULL, '2022-01-23 15:37:20', 'Active'),
(76, 'PSA076', 'Nikhil Arora', 'nikhil.11986@gmail.com', '971525149169', 1, NULL, '78419861967435', NULL, '2022-01-23 16:19:19', 'Active'),
(77, 'PSA077', 'Singaravel Ranjan', 's_shrisakthi@yahoo.com', '971506442047', 1, NULL, '784197516519614', NULL, '2022-01-24 13:45:21', 'Active'),
(78, 'PSA078', 'Suma Unnikrishnan', 'cunni09@gmail.com', '971502847204', 1, NULL, '784197950287204', NULL, '2022-01-24 13:58:03', 'Active'),
(79, 'PSA079', 'Hena Fatima', 'maryam.mobeen@gmail.com', '971505605170', 1, NULL, '784198438762134', NULL, '2022-01-24 17:36:01', 'Active'),
(80, 'PSA080', 'JayaDeep', 'jayadeep.cm@gmail.com', '971508556368', 1, NULL, '7841974153730227', NULL, '2022-01-24 18:02:47', 'Active'),
(81, 'PSA081', 'Fathima Zulfa', 'shahulhamee@gmail.com', '971558492740', 1, NULL, '7841983176061015', NULL, '2022-01-26 12:15:15', 'Active'),
(82, 'PSA082', 'Fauzan', 'fauzanjeema@gmail.com', '971529459747', 1, NULL, '78419834287018', NULL, '2022-01-26 12:32:14', 'Active'),
(83, 'PSA083', 'Chinni', 'garikipati.chinni@gmail.com', '971502165359', 1, NULL, '7841982348701245', NULL, '2022-01-26 12:39:30', 'Active'),
(84, 'PSA084', 'Sandeep.P', 'ppsandeep@gmail.com', '971505507842', 1, NULL, '784198020865573', NULL, '2022-01-26 12:47:27', 'Active'),
(85, 'PSA085', 'test parent', 'nvijaymuthumanickam4@gmail.com', '956960061', 0, NULL, '', NULL, '2022-01-27 16:12:21', 'Active'),
(86, 'PSA086', 'Vijay', 'nvijaymuthumanickam@gmail.com', '9566960050', 1, 'P1234', 'PE123', '2024-10-25', '2022-02-01 15:25:24', 'Active'),
(87, 'PSA087', 'Sumathi', 'sumathiseetha3317@gmail.com', '8870883990', 1, NULL, 'EID0055', NULL, '2022-02-09 10:56:35', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `parent_logins`
--

CREATE TABLE `parent_logins` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prepaid_credits`
--

CREATE TABLE `prepaid_credits` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance_credits` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amount_paid` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_credits` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prepaid_credits`
--

INSERT INTO `prepaid_credits` (`id`, `parent_id`, `name_id`, `mobile_id`, `balance_credits`, `amount_paid`, `total_credits`, `description`, `created_at`, `updated_at`, `payment_type`, `bank`, `cheque_number`, `cheque_date`) VALUES
(1, 1, 'Ravikumar', '971501097469', 1000.00, 1000.00, 1000.00, 'Wallet update', '2022-01-12 12:12:31', '2022-01-12 01:12:31', 'Cash', '', '', ''),
(2, 36, 'Girish', '971553609421', 615.00, 615.00, 615.00, 'Karama Badminton - 9 classes Jan', '2022-01-12 12:13:55', '2022-01-12 01:13:55', 'Cash', '', '', ''),
(3, 35, 'Shafeequr Rahman', '971501577212', 983.00, 983.00, 983.00, 'Essa / Moosa - Swimming Eg - 8 Classes in Jan', '2022-01-12 12:18:24', '2022-01-12 01:18:24', 'Cash', '', '', ''),
(4, 34, 'Manohar', '971527773586', 237.00, 237.00, 237.00, 'Dec 6 Classes pending taken in Jan - 3 classes additional - Ka - Badminton', '2022-01-12 12:21:41', '2022-01-12 01:21:41', 'Cash', '', '', ''),
(5, 33, 'kannan Ashokkumar', '971569033276', 0.20, 983.00, 0.20, 'Ka - Badminton - 8 classes  for both kids', '2022-01-12 12:22:37', '2022-01-12 01:22:37', 'Cash', '', '', ''),
(6, 32, 'Pradeep', '971509057321', 0.00, 546.00, 0.00, 'Nov 21 - 1 pending class & paid for 8 classes - Ka - Badminton', '2022-01-12 12:23:49', '2022-01-12 01:23:49', 'Cash', '', '', ''),
(7, 31, 'Krishna', '971506761363', 1000.00, 1000.00, 1000.00, 'Eg - Swim - Dec 3 classes pending paid + Jan 6 classes', '2022-01-12 12:25:40', '2022-01-12 01:25:40', 'Online', 'ADIB', '', ''),
(8, 30, 'Prajna Rao', '971544770400', 0.75, 615.00, 0.75, 'Ka  - Badminton - 9 Classes - Jan', '2022-01-12 12:27:01', '2022-01-12 01:27:01', 'Cash', '', '', ''),
(9, 29, 'Sam Joel', '971552826852', 1512.00, 1512.00, 1512.00, 'Eg - Swim - 8 classes - 2 hours - 2 kids ', '2022-01-12 12:29:58', '2022-01-12 01:29:58', 'Cash', '', '', ''),
(10, 27, 'Tanmay Maheshwari', '971501399625', 294.00, 399.00, 294.00, 'New Reg + 8 classes - 1 hour - Ka - Badminton', '2022-01-12 17:17:08', '2022-01-12 06:17:08', 'Cash', '', '', ''),
(11, 26, 'Ranjith.P.V', '971558810744', 0.25, 394.00, 0.25, 'Ka - Badminton - 5 classes - 2 hours', '2022-01-12 17:19:24', '2022-01-12 06:19:24', 'Cash', '', '', ''),
(12, 25, 'Arun Kumar', '971527485111', 944.00, 944.00, 944.00, 'Ka - Badminton - Dec additional customer amount - 108 given as discount for booking  - 40 balance to pay. 16 classes', '2022-01-12 17:23:59', '2022-01-12 06:23:59', 'Cash', '', '', ''),
(13, 24, 'Rupesh Gawade', '971528908498', 1512.00, 1512.00, 1512.00, 'Eg - Swim - 2 hours - 2 Kids - 8 classes each', '2022-01-12 17:27:04', '2022-01-12 06:27:04', 'Cash', '', '', ''),
(14, 23, 'Anju Das', '971506450578', 0.80, 1107.00, 0.80, 'Ka - Badminton - Dec 1 class + 8 classes each - 2 kids', '2022-01-12 17:28:56', '2022-01-12 06:28:56', 'Cash', '', '', ''),
(15, 22, 'Manish Gehani', '971503739016', 0.00, 1050.00, 0.00, 'Eg - Swim - 2 hours - 10 classes', '2022-01-12 17:29:51', '2022-01-12 06:29:51', 'Online', 'ADIB', '', ''),
(16, 20, 'Lokesh Rao', '971558999007', 0.00, 546.00, 0.00, 'Ka - Badminton - 2 hours - 8 classes', '2022-01-12 17:36:17', '2022-01-12 06:36:17', 'Cash', '', '', ''),
(17, 19, 'Shahid Jiwani', '971509969410', 0.00, 546.00, 0.00, 'Ka - Badminton - 8 classes', '2022-01-12 17:37:31', '2022-01-12 06:37:31', 'Cash', '', '', ''),
(18, 18, 'Fatima Chandan', '971501852624', 2646.00, 2646.00, 2646.00, 'Eg - Swim - 2 kids - 2 hours - Sakina - 8 classes - Huzaifa - 20 Classes', '2022-01-12 17:38:55', '2022-01-12 06:38:55', 'Online', 'ADIB', '', ''),
(19, 17, 'Gopal', '97150865489', 1046.00, 546.00, 1046.00, 'Ka - Badminton - 8 Classes', '2022-01-12 17:39:27', '2022-01-12 06:39:27', 'Cash', '', '', ''),
(20, 16, 'Dhamodharan', '971506614182', 0.00, 315.00, 0.00, 'Ka - Badminton - 4 classes', '2022-01-12 17:40:22', '2022-01-12 06:40:22', 'Cash', '', '', ''),
(21, 12, 'Ramkumar', '971566034384', 0.95, 1052.00, 0.95, 'Ka - Badminton - 2 kids - ashwin - 8 classes - Anjali - 9 classes', '2022-01-12 17:46:36', '2022-01-12 06:46:36', 'Cash', '', '', ''),
(22, 15, 'Seshendra.V', '971565841387', 0.00, 546.00, 0.00, 'Ka - Badminton - 8 classes', '2022-01-12 17:47:15', '2022-01-12 06:47:15', 'Cash', '', '', ''),
(23, 14, 'Sandeep Kumar', '971547019400', 149.25, 900.00, 149.25, 'Ka - Badminton - 12 classes ', '2022-01-12 17:48:18', '2022-01-12 06:48:18', 'Cash', '', '', ''),
(24, 13, 'Venkatraman', '971561980256', 0.20, 1256.00, 0.20, 'Ka - Badminton - Shrijith - 12 classes - Sooriya - 8 classes', '2022-01-12 17:50:38', '2022-01-12 06:50:38', 'Cash', '', '', ''),
(25, 11, 'Anand', '971508874673', 1764.00, 1764.00, 1764.00, 'Ka - Badminton - Ananya - 12 classes - Ananya / Atharva - Eg - Swim - 5 Classes - 2 hours - Dec 3 classes taken in Jan', '2022-01-12 17:54:51', '2022-01-12 06:54:51', 'Online', 'ADIB', '', ''),
(26, 10, 'Nivedita', '97150429830', 727.00, 1000.00, 727.00, 'Ka - Badminton - Dec 1 class - Jan 12 classes', '2022-01-12 17:55:56', '2022-01-12 06:55:56', 'Cash', '', '', ''),
(27, 9, 'Ajay subhash', '971507118140', 0.00, 315.00, 0.00, 'Ka - Badminton - 4 classes', '2022-01-12 17:56:30', '2022-01-12 06:56:30', 'Cash', '', '', ''),
(28, 7, 'Jonald', '971508508876', 1.90, 1474.00, 1.90, 'Ka - Badminton - Both 12 classes', '2022-01-12 17:57:59', '2022-01-12 06:57:59', 'Cash', '', '', ''),
(29, 6, 'P.P.Raj', '971506984616', 0.50, 683.00, 0.50, 'Ka - Badminton - 10 classes', '2022-01-12 17:58:56', '2022-01-12 06:58:56', 'Cash', '', '', ''),
(30, 5, 'Deepak Dinesh', '971555859232', 44.50, 1000.00, 44.50, 'Ka - Badminton - 14 classes', '2022-01-12 18:00:23', '2022-01-12 07:00:23', 'Cash', '', '', ''),
(31, 4, 'Hari Krishnan', '971556306307', 0.00, 546.00, 0.00, 'Ka - Badminton - 8 classes', '2022-01-12 18:01:31', '2022-01-12 07:01:31', 'Cash', '', '', ''),
(32, 3, 'Simi Rachel', '971552449010', 0.00, 546.00, 0.00, 'Ka - Badminton - 8 Classes', '2022-01-12 18:02:05', '2022-01-12 07:02:05', 'Cash', '', '', ''),
(33, 2, 'Karthick', '971552265185', 1570.00, 1570.00, 1570.00, 'Ka - badminton - Shivan - 15 classes - Vishnu - 10 classes', '2022-01-12 18:03:16', '2022-01-12 07:03:16', 'Cash', '', '', ''),
(34, 37, 'Vaidhyanathan.V', '971528598183', 1175.00, 1175.00, 1175.00, 'Ka - Badminton siddharth 10 classes  samyuktha 9 classes', '2022-01-12 18:56:13', '2022-01-12 07:56:13', 'Online', 'ADIB', '', ''),
(35, 38, 'Upendra Kale', '971567562896', 315.00, 315.00, 315.00, 'Paid for 4 classes in jan', '2022-01-13 09:44:58', '2022-01-12 22:44:58', 'Cash', '', '', ''),
(36, 39, 'Karthick Raj', '971564048624', 546.00, 546.00, 546.00, 'Paid for 8 classes in jan', '2022-01-13 10:19:47', '2022-01-12 23:19:47', 'Cash', '', '', ''),
(37, 40, 'Bala subramaniyam', '97155063883', 394.00, 394.00, 394.00, 'Paid for 5 classes in Jan', '2022-01-13 11:06:27', '2022-01-13 00:06:27', 'Cash', '', '', ''),
(38, 42, 'T.S.Kishore', '971506759023', 2184.00, 2184.00, 2184.00, 'Paid for 2184 i Jan Egy - Swim Lavanya 8 classes & Adithya 16 classes', '2022-01-13 11:59:58', '2022-01-13 00:59:58', 'Cash', '', '', ''),
(39, 44, 'Anitha Krishna Moorthy', '971503665167', 546.00, 546.00, 546.00, 'paid 546 in Jan for 8 classes', '2022-01-13 13:09:26', '2022-01-13 02:09:26', 'Online', 'ADIB', '', ''),
(40, 43, 'Xavier', '971506827648', 1400.00, 1400.00, 1400.00, 'Antony Wilson 7 Classes & Austin Xavier 756', '2022-01-13 14:47:33', '2022-01-13 03:47:33', 'Online', 'ADIB', '', ''),
(41, 41, 'Arnel Suerte', '971508546029', 1050.00, 1050.00, 1050.00, 'Paid 1050 For Jan-December Taken 1 class. \r\nJan 8 classes for nel 4 classes for carel ', '2022-01-13 13:52:51', '2022-01-13 04:29:28', 'Cash', NULL, NULL, NULL),
(42, 45, 'Jayasri Narayanan', '971525617789', 1092.00, 1092.00, 1092.00, ' Ka- Badminton - Paid for 16 classes in Jan (Paid date   29.12.2021)', '2022-01-14 11:30:30', '2022-01-14 00:30:30', 'Online', 'ADIB', '', ''),
(43, 46, 'Ganesh', '971505247201', 614.25, 614.25, 614.25, 'Paid on Dec25th for 10 classes Dec taken 1 class (25th dec) balance 9 classes booked in Jan', '2022-01-14 12:05:01', '2022-01-14 01:05:01', 'Cash', '', '', ''),
(44, 47, 'Prabhakar', '971505524571', 1092.00, 1092.00, 1092.00, 'Ka - Badminton PaidOn 26th Dec For 16 classes in Jan', '2022-01-14 12:52:55', '2022-01-14 01:52:55', 'Cash', '', '', ''),
(45, 48, 'Anish K.S', '971528241849', 700.00, 700.00, 700.00, 'Egy - swim Paid on Jan  14th 700dhs for  5 classes in Jan balance  amount in Wallet', '2022-01-14 19:22:41', '2022-01-14 08:22:41', 'Cash', '', '', ''),
(46, 49, 'Murari Pareek', '971555115850', 546.00, 500.00, 546.00, 'Ka - Badminton Paid for Jan 8 classes  need to pay 46dhs ', '2022-01-15 11:06:14', '2022-01-15 00:06:14', 'Cash', '', '', ''),
(47, 50, 'Rahul Birari', '971569824914', 546.00, 546.00, 546.00, 'Paid for 8 classes Jan 6 classses & Feb 2 classes', '2022-01-18 10:05:16', '2022-01-17 23:05:16', 'Cash', '', '', ''),
(48, 55, 'Mohammed Reza Fazulbhoy', '971558724105', 1000.00, 1000.00, 1000.00, 'Ka - B Paid  1000  for Jan 12 classes balance cash with us', '2022-01-20 12:11:10', '2022-01-20 01:11:10', 'Cash', '', '', ''),
(49, 54, 'Vivek Sahu', '971555584909', 629.00, 629.00, 629.00, 'paid 629 dhs for Jan 8 classes  (Jan 546 + Dec Pending Payment83) total 629', '2022-01-20 12:16:03', '2022-01-20 01:16:03', 'Cash', '', '', ''),
(50, 53, 'Sudeep Mehta', '971528672989', 983.00, 983.00, 983.00, 'Paid 983 for Jan 8 classes for both', '2022-01-20 12:18:24', '2022-01-20 01:18:24', 'Online', 'ADIB', '', ''),
(51, 52, 'Lavanya Priya', '971551027708', 546.00, 546.00, 546.00, 'Paid 546 dhs for Jan 8 classes', '2022-01-20 12:20:02', '2022-01-20 01:20:02', 'Online', 'ADIB', '', ''),
(52, 58, 'Sulakshan.N', '971507935732', 1107.00, 1107.00, 1107.00, 'Ka - Badminton paid 1107dhs for jar 9 classes for each', '2022-01-20 18:02:31', '2022-01-20 07:02:31', 'Cash', '', '', ''),
(53, 59, 'Zerses Dubash', '971529038326', 1606.50, 1606.50, 1606.50, 'Egy - Swim Paid forJan 17 classes', '2022-01-20 18:59:54', '2022-01-20 07:59:54', 'Online', 'ADIB', '', ''),
(54, 61, 'Jayaram Jagannathan', '971508497989', 546.00, 546.00, 546.00, 'Paid 546dhs (Receipt no 8702&8719) for 8 classes ', '2022-01-21 11:08:15', '2022-01-21 00:08:15', 'Cash', '', '', ''),
(55, 62, 'Pratap Mendonca', '971504953407', 600.00, 600.00, 600.00, 'Ka - Badminton Paid for 600dhs for 8 classes', '2022-01-21 13:31:04', '2022-01-21 02:31:04', 'Cash', '', '', ''),
(56, 64, 'S.Ranganathan', '971566789467', 1105.00, 1105.00, 1105.00, 'Ka b - Badminton  Paid for Jan 4 Classes  & Feb 10 classes', '2022-01-21 19:49:06', '2022-01-21 08:49:06', 'Cash', '', '', ''),
(57, 60, 'Meesha rajwani', '971508039252', 368.00, 368.00, 368.00, 'Ka - Badminton  Reg fee & 5 lasses', '2022-01-21 19:57:18', '2022-01-21 08:57:18', 'Cash', '', '', ''),
(58, 66, 'Sudharshan.G', '971528936873', 1000.00, 1000.00, 1000.00, 'Ka - Badminton paid inJan 8 classes for each', '2022-01-23 09:53:08', '2022-01-22 22:53:08', 'Cash', '', '', ''),
(59, 8, 'raja sekar Ramamoorthy', '971555800490', 1160.00, 1160.00, 1160.00, 'Ka - Bad- 17 classes - Jan -5 classes - Feb 12 classes', '2022-01-23 16:23:46', '2022-01-23 05:23:46', 'Cash', '', '', ''),
(60, 73, 'Pradeep Sakhrani', '971507594023', 546.00, 546.00, 546.00, 'Ka - Bad - Jan 8 classes', '2022-01-23 16:24:39', '2022-01-23 05:24:39', 'Cash', '', '', ''),
(61, 72, 'Naveen', '971508942899', 546.00, 546.00, 546.00, 'Ka - Bad - Jan 8 Classes ', '2022-01-23 16:25:07', '2022-01-23 05:25:07', 'Cash', '', '', ''),
(62, 71, 'Fehmeena Fahih', '971507684671', 546.00, 651.00, 546.00, 'Egy - Swim - Jan 4 classes - Feb 4 classes', '2022-01-23 16:26:25', '2022-01-23 05:26:25', 'Cash', '', '', ''),
(63, 70, 'Parijat', '971543229435', 700.00, 700.00, 700.00, 'Ka - Bad - 2 Kids - Jan - 3 Classes - Feb 1 class', '2022-01-23 16:32:12', '2022-01-23 05:32:12', 'Cash', '', '', ''),
(64, 69, 'Rajamohamed', '971503191434', 700.00, 700.00, 700.00, 'Ka - Bad - 2 kids - Jan 5 classes', '2022-01-23 16:33:02', '2022-01-23 05:33:02', 'Cash', '', '', ''),
(65, 68, 'Firdous Irani', '971505505174', 1200.00, 1200.00, 1200.00, 'Ka - bad - 2 kids - Ryan - Jan 6 classes - Feb 6 classes - Anaissa - Jan 3 class - Feb 2 class', '2022-01-23 16:36:12', '2022-01-23 05:36:12', 'Cash', '', '', ''),
(66, 67, 'Vishnu upadhyay', '971505583725', 683.00, 683.00, 683.00, 'Ka - bad - Jan 10 classes - Paid by cheque', '2022-01-23 16:42:22', '2022-01-23 05:42:22', 'Online', 'ADIB', '', ''),
(67, 56, 'Suresh Govindaraj', '971503691675', 550.00, 550.00, 550.00, 'Ka - Bad - Jan 8 classes', '2022-01-23 17:51:44', '2022-01-23 06:51:44', 'Cash', '', '', ''),
(68, 57, 'Sanjay Ramdas', '971504782578', 1000.00, 1000.00, 1000.00, 'Ka - Bad - Jan - 3  classes + Feb - 8 classes', '2022-01-23 17:54:23', '2022-01-23 06:54:23', 'Cash', '', '', ''),
(69, 51, 'Anshul singhla', '971565384006', 546.00, 651.00, 546.00, 'Reg + Ka - Bad - 8 classes - Jan 6 + Feb 2 classes', '2022-01-23 17:56:55', '2022-01-23 06:56:55', 'Cash', '', '', ''),
(70, 74, 'Sanjay Abichandani', '971501642544', 683.00, 683.00, 683.00, 'Ka - bad - 10 day jan & feb', '2022-01-23 18:00:44', '2022-01-23 07:00:44', 'Cash', '', '', ''),
(71, 65, 'Badri Ramaswamy', '971508024976', 1445.00, 1445.00, 1445.00, 'Ka - Bad - Jan 8 classes', '2022-01-23 18:04:10', '2022-01-23 07:04:10', 'Cash', '', '', ''),
(72, 86, 'Vijay', '9566960050', 607.56, 1000.00, 607.56, 'Prepaid', '2022-02-01 22:58:05', '2022-02-01 11:58:05', 'Cash', '', '', ''),
(73, 87, 'Sumathi', '8870883990', 674.50, 1000.00, 674.50, 'Wallet update', '2022-02-09 11:11:05', '2022-02-09 00:11:05', 'Card', 'ADIB', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rating_reviews`
--

CREATE TABLE `rating_reviews` (
  `id` int(11) NOT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `activity_selection_id` varchar(255) DEFAULT NULL,
  `coach_id` varchar(255) DEFAULT NULL,
  `star_count` varchar(255) DEFAULT NULL,
  `review` text,
  `status` varchar(255) DEFAULT NULL,
  `reset` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rating_review_details`
--

CREATE TABLE `rating_review_details` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rating_review_reports`
--

CREATE TABLE `rating_review_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recaptcha_keys`
--

CREATE TABLE `recaptcha_keys` (
  `id` int(11) NOT NULL,
  `domain_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domain_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_secret_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_discount_percentages`
--

CREATE TABLE `refund_discount_percentages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `percentage` decimal(10,2) NOT NULL DEFAULT '100.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `refund_discount_percentages`
--

INSERT INTO `refund_discount_percentages` (`id`, `name`, `description`, `percentage`, `created_at`, `updated_at`) VALUES
(1, 'Refund Discount Percentage', 'Refund discount percentage', 100.00, '2021-02-10 11:15:04', '2021-06-05 18:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `refund_fees`
--

CREATE TABLE `refund_fees` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paid_amount` int(11) DEFAULT NULL,
  `refund_amount` int(11) DEFAULT NULL,
  `reason_for_refund` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wallet_balance` int(11) DEFAULT NULL,
  `updated_balance` int(11) DEFAULT NULL,
  `updated_admin_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_admin_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `sid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sibling_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sibling_reg_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_office_contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_office_contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emergency_contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `t_shirt_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emirates_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emirates_id_issue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emirates_id_expire` date DEFAULT NULL,
  `reg_fee_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_fee` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_fee_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_applicable` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_select` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_percentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approval_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_email_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `psa_serial_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_admin_id` int(11) NOT NULL,
  `updated_admin_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_admin_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_file_size` int(11) DEFAULT NULL,
  `image_updated_at` datetime DEFAULT NULL,
  `student_passport_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_passport_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_passport_file_size` int(11) DEFAULT NULL,
  `student_passport_updated_at` datetime DEFAULT NULL,
  `student_emid_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_emid_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_emid_file_size` int(11) DEFAULT NULL,
  `student_emid_updated_at` datetime DEFAULT NULL,
  `student_visapage_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_visapage_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_visapage_file_size` int(11) DEFAULT NULL,
  `student_visapage_updated_at` datetime DEFAULT NULL,
  `sponsor_passport_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_passport_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_passport_file_size` int(11) DEFAULT NULL,
  `sponsor_passport_updated_at` datetime DEFAULT NULL,
  `sponsor_emid_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_emid_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_emid_file_size` int(11) DEFAULT NULL,
  `sponsor_emid_updated_at` datetime DEFAULT NULL,
  `sponsor_visapage_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_visapage_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_visapage_file_size` int(11) DEFAULT NULL,
  `sponsor_visapage_updated_at` datetime DEFAULT NULL,
  `deleted` int(15) NOT NULL DEFAULT '0',
  `country_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `sid`, `name`, `role`, `dob`, `age`, `gender`, `nationality`, `country`, `state`, `district`, `city`, `postal_code`, `school_name`, `sibling_name`, `sibling_reg_no`, `father_name`, `father_contact`, `father_office_contact`, `father_email`, `mother_name`, `mother_contact`, `mother_office_contact`, `mother_email`, `student_email`, `emergency_contact`, `current_country`, `current_city`, `current_postal_code`, `address_1`, `address_2`, `t_shirt_size`, `emirates_id`, `emirates_id_issue`, `emirates_id_expire`, `reg_fee_category`, `reg_fee`, `reg_fee_status`, `discount_applicable`, `discount_select`, `discount_percentage`, `status`, `approval_status`, `user_id`, `parent_name`, `parent_mobile`, `parent_email_id`, `parent_user_id`, `psa_serial_number`, `updated_admin_id`, `updated_admin_name`, `updated_admin_email`, `updated_date`, `verified_by`, `created_at`, `updated_at`, `image_file_name`, `image_content_type`, `image_file_size`, `image_updated_at`, `student_passport_file_name`, `passport_id`, `student_passport_content_type`, `student_passport_file_size`, `student_passport_updated_at`, `student_emid_file_name`, `student_emid_content_type`, `student_emid_file_size`, `student_emid_updated_at`, `student_visapage_file_name`, `student_visapage_content_type`, `student_visapage_file_size`, `student_visapage_updated_at`, `sponsor_passport_file_name`, `sponsor_passport_content_type`, `sponsor_passport_file_size`, `sponsor_passport_updated_at`, `sponsor_emid_file_name`, `sponsor_emid_content_type`, `sponsor_emid_file_size`, `sponsor_emid_updated_at`, `sponsor_visapage_file_name`, `sponsor_visapage_content_type`, `sponsor_visapage_file_size`, `sponsor_visapage_updated_at`, `deleted`, `country_id`) VALUES
(1, 'PS001', 'Aakash', 'student', '2002-03-27', '19', 'Male', '', '', '', '', '', '', '', '', '', 'Ravikumar', '971501097469', '', '', 'Rajeswari', '', '', '', '', '971552007183', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '1', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-05 19:20:20', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(2, 'PS002', 'Vishnu karthick', 'student', '2010-04-01', '11', 'Male', '', '', '', '', '', '', '', '', '', 'Karthick', '971509355017', '', '', 'Sri Lakshmi', '', '', '', '', '971552265185', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Karthick', '971552265185', 'srilakshmisundaar@gmail.com', '2', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-06 11:55:29', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(3, 'PS003', 'Shivan Karthick', 'student', '2014-04-05', '7', 'Male', '', '', '', '', '', '', '', '', '', 'Karthick', '971509355017', '', '', 'Sri Lakshmi', '', '', '', '', '971552265185', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Karthick', '971552265185', 'srilakshmisundaar@gmail.com', '2', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-06 11:59:36', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(4, 'PS004', 'Joanna Mary Jerry', 'student', '2010-02-14', '11', 'Female', '', '', '', '', '', '', '', '', '', 'Jerry Varghese', '971552449010', '', '', 'Simi Rachel', '', '', '', '', '9715074627', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Simi Rachel', '971552449010', 'rachu13sm@yahoo.com', '3', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-06 12:16:16', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(5, 'PS005', 'Arpita harikrishnan', 'student', '2010-02-25', '11', 'Female', '', '', '', '', '', '', '', '', '', 'Harikrishnan', '971554954593', '', '', 'Sree Lakshmy', '', '', '', '', '971556306307', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Hari Krishnan', '971556306307', 'sreelakshmy.v@gmail.com', '4', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-06 12:21:34', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(6, 'PS006', 'Modit Deepak', 'student', '2009-01-15', '12', 'Male', '', '', '', '', '', '', '', '', '', 'Deepak Dinesh', '971561854560', '', '', 'Ramy Vani', '', '', '', '', '971522562333', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Deepak Dinesh', '971555859232', 'ramyajakka@gmail.com', '5', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-06 12:29:50', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(7, 'PS007', 'Abhay Raj', 'student', '2002-02-16', '19', 'Male', '', '', '', '', '', '', '', '', '', 'P.P.Raj', '971506984616', '', '', 'Beena Raj', '', '', '', '', '971503460984', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'P.P.Raj', '971506984616', 'ppaj1970@gmail.com', '6', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-06 12:36:30', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(8, 'PS008', 'Jonathan Joseph', 'student', '2008-05-25', '13', 'Male', '', '', '', '', '', '', '', '', '', 'Jonald', '971508508876', '', '', 'Princy', '', '', '', '', '971508508877', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Jonald', '971508508876', 'joesun7@gmail.com', '7', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-06 12:48:19', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(9, 'PS009', 'Japheth Joseph', 'student', '2013-07-03', '8', 'Male', '', '', '', '', '', '', '', '', '', 'Jonald', '971508508876', '', '', 'Princy', '', '', '', '', '971508508877', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Jonald', '971508508876', 'joesun7@gmail.com', '7', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-06 12:52:55', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(10, 'PS010', 'Adarsh', 'student', '2011-02-01', '10', 'Male', '', '', '', '', '', '', '', '', '', 'Rajasekar Ramamoorthy', '971555800491', '', '', 'Viji', '', '', '', '', '971555800490', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'raja sekar Ramamoorthy', '971555800490', 'kavithaokm@gmail.com', '8', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-06 13:19:54', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(12, 'PS011', 'Anadyant', 'student', '2013-08-31', '8', 'Male', '', '', '', '', '', '', '', '', '', 'Ajay Subhash', '971507118140', '', '', 'Ajia', '', '', '', '', '971503898140', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Ajay subhash', '971507118140', 'dubey.ajay@hotmail.com', '9', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-07 09:20:13', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(13, 'PS012', 'Sahana Shrikent', 'student', '2008-07-05', '13', 'Male', '', '', '', '', '', '', '', '', '', 'Aditya Shrikent', '971505589379', '', '', 'Nivedita Shrikent', '', '', '', '', '971504298980', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Nivedita', '97150429830', 'niveditashrikent@hotmail.com', '10', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-07 09:35:57', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(14, 'PS013', 'Ananya Iyer', 'student', '2008-09-08', '13', 'Female', '', '', '', '', '', '', '', '', '', 'Anand Iyer', '0508874673', '', '', 'Priya', '', '', '', '', '971506574615', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Anand', '971508874673', 'anand158@gmail.com', '11', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-07 10:20:51', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(15, 'PS014', 'Atharva Iyer', 'student', '2014-09-06', '7', 'Male', '', '', '', '', '', '', '', '', '', 'Anand Iyer', '971508874673', '', '', 'Priya', '', '', '', '', '971506574615', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Anand', '971508874673', 'anand158@gmail.com', '11', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-07 10:30:20', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(16, 'PS015', 'Ashwin', 'student', '2008-05-04', '13', 'Male', '', '', '', '', '', '', '', '', '', 'Ramkuamr', '971566034387', '', '', 'Nithya', '', '', '', '', '971556531846', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Ramkumar', '971566034384', 'f.l@mail.com', '12', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-07 10:38:49', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(17, 'PS016', 'Sooriya Venkatraman', 'student', '2005-07-01', '16', 'Male', '', '', '', '', '', '', '', '', '', 'Venkatraman', '971503619903', '', '', 'Vijiyalakshmi', '', '', '', '', '971561980256', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Venkatraman', '971561980256', 'vijisooriya@yahoo.co.in', '13', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-07 18:46:11', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(18, 'PS017', 'Shrijith', 'student', '2013-10-10', '8', 'Male', '', '', '', '', '', '', '', '', '', 'Venkatraman', '971503619903', '', '', 'Vijiyalakshmi', '', '', '', '', '971561980256', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Venkatraman', '971561980256', 'vijisooriya@yahoo.co.in', '13', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-07 18:48:37', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(19, 'PS018', 'Armaan  Kumar', 'student', '2008-12-27', '13', 'Male', '', '', '', '', '', '', '', '', '', 'Sandeep', '971547019400', '', '', 'Prathiba', '', '', '', '', '971552563727', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sandeep Kumar', '971547019400', 'sandeep11sandeep@gmail.com', '14', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-07 19:43:18', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(20, 'PS019', 'Sai Shrenik', 'student', '2008-07-30', '13', 'Male', '', '', '', '', '', '', '', '', '', 'Seshendra', '971565841387', '', '', 'Sree Lakshmi.V', '', '', '', '', '971553276601', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Seshendra.V', '971565841387', 'mail2seshendra@gmail.com', '15', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-08 18:21:59', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(21, 'PS020', 'Anjali Ramkumar', 'student', '2014-03-04', '7', 'Female', '', '', '', '', '', '', '', '', '', 'Ramkumar', '971566034384', '', '', 'Nithya', '', '', '', '', '971556531846', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Ramkumar', '971566034384', 'f.l@mail.com', '12', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-08 19:25:45', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(22, 'PS021', 'Navneeth', 'student', '2005-07-31', '16', 'Male', '', '', '', '', '', '', '', '', '', 'Dhamodharan', '971506614182', '', '', 'Sri Viidya', '', '', '', '', '9715074482275', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Dhamodharan', '971506614182', 'dhamus@yahoo.com', '16', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 10:14:58', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(23, 'PS022', 'Sahasra Gopal', 'student', '2014-07-14', '7', 'Female', '', '', '', '', '', '', '', '', '', 'Gopal', '971508658489', '', '', 'Saraswathy', '', '', '', '', '971559099847', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Gopal', '97150865489', 'gopalkrishnan.p@gmail.com', '17', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 10:31:09', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(24, 'PS023', 'Sakina Afzal', 'student', '2007-02-16', '14', 'Female', '', '', '', '', '', '', '', '', '', 'Quresh Fakhruddhin', '971508183830', '', '', 'Fatima Chandan', '', '', '', '', '971501852624', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Fatima Chandan', '971501852624', 'fchandan1010@yahoo.com', '18', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 10:55:40', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(25, 'PS024', 'Huzaifa Afzal', 'student', '2012-11-10', '9', 'Male', '', '', '', '', '', '', '', '', '', 'Queresh fakhruddin', '971508183830', '', '', 'FTIMA CHANDAN', '', '', '', '', '971501852624', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Fatima Chandan', '971501852624', 'fchandan1010@yahoo.com', '18', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 10:58:30', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(26, 'PS025', 'Eliza jiwani', 'student', '2010-08-10', '11', 'Female', '', '', '', '', '', '', '', '', '', 'Shahid Jiwani', '971507684482', '', '', 'Reshma Jiwani', '', '', '', '', '971509969410', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Shahid Jiwani', '971509969410', 'reshmajiwani17@gmail.com', '19', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 11:41:18', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(27, 'PS026', 'Adithya Lokesh rao', 'student', '2006-09-02', '15', 'Male', '', '', '', '', '', '', '', '', '', 'Lokesh Rao', '971558995006', '', '', 'Jaya rao', '', '', '', '', '971558999007', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Lokesh Rao', '971558999007', 'rlokeshrao@gmail.com', '20', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 12:33:02', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(28, 'PS027', 'Dhanwanth Raghavan', 'student', '2008-03-30', '13', 'Male', '', '', '', '', '', '', '', '', '', 'Raghavan NRS', '971508189618', '', '', 'Chitrapriya SL', '', '', '', '', '971509016623', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Raghavan NRS', '971508189618', 'nrsragav@gmail.com', '21', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 12:40:40', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(29, 'PS028', 'Devang Gehani', 'student', '2010-01-20', '11', 'Male', '', '', '', '', '', '', '', '', '', 'Manish Gehani', '971505621966', '', '', 'Riddhi Gehani', '', '', '', '', '971503739016', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Manish Gehani', '971503739016', 'manish_hy@yahoo.com', '22', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 14:10:23', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(30, 'PS029', 'Aanya anju Das', 'student', '2007-05-10', '14', 'Female', '', '', '', '', '', '', '', '', '', 'Anju Das', '971506450578', '', '', 'Dhanya Anju', '', '', '', '', '971504956058', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Anju Das', '971506450578', 'anjudas@gmail.com', '23', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 14:20:19', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(31, 'PS030', 'Anushka Anju das', 'student', '2008-09-30', '13', 'Female', '', '', '', '', '', '', '', '', '', 'Anju Das', '971506450578', '', '', 'Dhanya Anju ', '', '', '', '', '971504956058', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Anju Das', '971506450578', 'anjudas@gmail.com', '23', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 14:23:35', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(32, 'PS031', 'Bhagya Gawade', 'student', '2015-07-02', '6', 'Female', '', '', '', '', '', '', '', '', '', 'Rupesh Gawade', '971528908498', '', '', 'Vaishali Gawade', '', '', '', '', '971509040281', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Rupesh Gawade', '971528908498', 'rupeshgawadegg@gmail.com', '24', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 15:20:49', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(33, 'PS032', 'Prapti Rupesh', 'student', '2012-02-12', '9', 'Female', '', '', '', '', '', '', '', '', '', 'Rupesh Gawade', '971528908498', '', '', 'Vaishali Gawade', '', '', '', '', '971509040281', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Rupesh Gawade', '971528908498', 'rupeshgawadegg@gmail.com', '24', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 15:25:56', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(34, 'PS033', 'Tvisha Kumar', 'student', '2012-08-28', '9', 'Female', '', '', '', '', '', '', '', '', '', 'Arun kumar', '97152748511', '', '', 'Yogita Shetye', '', '', '', '', '971551698001', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Arun Kumar', '971527485111', 'aarun.kumaar@gmail.com', '25', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 15:35:53', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(35, 'PS034', 'Ishaan Ranjith', 'student', '2012-05-22', '9', 'Male', '', '', '', '', '', '', '', '', '', 'Ranjith P. V', '971558810744', '', '', 'Lesy', '', '', '', '', '971527586845', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Ranjith.P.V', '971558810744', 'ranjith.pv@gmail.com', '26', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 16:33:27', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(36, 'PS035', 'Tanmay Maheshwari', 'student', '2018-01-04', '4', 'Male', '', '', '', '', '', '', '', '', '', 'Gopal Maheswari', '971501399625', '', '', 'Gunjan rathi', '', '', '', '', '971558430410', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Tanmay Maheshwari', '971501399625', 'ca.maheshwarig@gmail.com', '27', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-09 16:54:44', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(37, 'PS036', 'JOANNA SAM JOEL', 'student', '2010-02-28', '11', 'Female', '', '', '', '', '', '', '', '', '', 'Sam joel', '971552826852', '', '', 'BINDU ISAAC', '', '', '', '', '971553836384', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sam Joel', '971552826852', 'samjoel80@gmail.com', '29', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-10 10:36:03', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(38, 'PS037', 'jonathan sam joel', 'student', '2015-01-19', '6', 'Male', '', '', '', '', '', '', '', '', '', 'Sam joel', '971552826852', '', '', 'BINDU ISAAC', '', '', '', '', '971506574615', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sam Joel', '971552826852', 'samjoel80@gmail.com', '29', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-10 10:39:22', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(39, 'PS038', 'Vihana rao', 'student', '2013-05-01', '8', 'Female', '', '', '', '', '', '', '', '', '', 'Rao', '971544770400', '', '', 'Prajna', '', '', '', '', '971544770401', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Prajna Rao', '971544770400', 'prajnar19@gmail.com', '30', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-10 11:02:01', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(40, 'PS039', 'Rajit Krishna', 'student', '2004-09-15', '17', 'Male', '', '', '', '', '', '', '', '', '', 'Krishna', '971506761363', '', '', 'Jaya Vilasini', '', '', '', '', '971506761464', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Krishna', '971506761363', 'krishna.binsuloom@gmail.com', '31', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-10 11:09:18', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(41, 'PS040', 'Nitin Pradeep', 'student', '2008-04-07', '13', 'Male', '', '', '', '', '', '', '', '', '', 'Keerthana', '0565396502', '', '', 'Pradeep', '', '', '', '', '0509057321', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Pradeep', '971509057321', 'keerthanaa.pradeep@gmail.com', '32', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-10 18:40:10', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(42, 'PS041', 'Sanjana sri', 'student', '2013-05-06', '8', 'Female', '', '', '', '', '', '', '', '', '', 'Kannan Ashok kumar', '971569033276', '', '', 'Premavathi', '', '', '', '', '971501579619', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'kannan Ashokkumar', '971569033276', 'tprema.tec@gmail.com', '33', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-10 18:47:27', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(43, 'PS042', 'Aneka K.P', 'student', '2016-03-13', '5', 'Female', '', '', '', '', '', '', '', '', '', 'Kannan Ashok kumar', '971569033276', '', '', 'Premavathi', '', '', '', '', '971501579619', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'kannan Ashokkumar', '971569033276', 'tprema.tec@gmail.com', '33', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-10 18:49:11', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(44, 'PS043', 'SAHANAA KOTIEN', 'student', '2009-08-26', '12', 'Female', '', '', '', '', '', '', '', '', '', 'Mnohar', '0527773586', '', '', 'Surekha', '', '', '', '', '0527773587', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Manohar', '971527773586', 'mkotian238@gmail.com', '34', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-10 18:58:46', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(45, 'PS044', 'Eesa Shafeequr', 'student', '2012-11-16', '9', 'Male', '', '', '', '', '', '', '', '', '', 'Shafeequr Rahman', '971501577212', '', '', 'Sharmila Banu', '', '', '', '', '97156290079', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Shafeequr Rahman', '971501577212', 'toshafeeq@gmail.com', '35', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-10 19:36:15', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(46, 'PS045', 'Moosa shafeequr', 'student', '2014-11-11', '7', 'Male', '', '', '', '', '', '', '', '', '', 'Shafeequr Rahman', '971501577212', '', '', 'Sharmila Banu', '', '', '', '', '971562690079', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Shafeequr Rahman', '971501577212', 'toshafeeq@gmail.com', '35', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-10 19:38:07', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(47, 'PS046', 'Shreyaansh Girish', 'student', '2011-09-11', '10', 'Male', '', '', '', '', '', '', '', '', '', 'Girish', '971555082738', '', '', 'Preethi Girish', '', '', '', '', '971553609421', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Girish', '971553609421', 'preethi.girish@gmail.com', '36', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-11 17:27:10', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(48, 'PS047', 'Siddharth.V', 'student', '2008-09-09', '13', 'Male', '', '', '', '', '', '', '', '', '', 'Vaidhyanathan.V', '971509429845', '', '', 'Bhavana', '', '', '', '', '971528598183', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Vaidhyanathan.V', '971528598183', 'v.vaidhya@outlook.com', '37', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-12 18:35:00', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(49, 'PS048', 'Samyuktha.V', 'student', '2011-08-02', '10', 'Female', '', '', '', '', '', '', '', '', '', 'Vaidhyanathan.V', '971509429845', '', '', 'Bhavana', '', '', '', '', '971528598183', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Vaidhyanathan.V', '971528598183', 'v.vaidhya@outlook.com', '37', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-12 18:38:14', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(50, 'PS049', 'Sruja Kale', 'student', '2015-03-28', '6', 'Female', '', '', '', '', '', '', '', '', '', 'Upendra Klae', '971567562896', '', '', 'Rutuja Kale', '', '', '', '', '971557058708', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Upendra Kale', '971567562896', 'upendra.kale@petrofac.com', '38', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-13 09:43:33', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(51, 'PS050', 'Ashwath', 'student', '2011-01-10', '11', 'Male', '', '', '', '', '', '', '', '', '', '971564048624', '971564048624', '', '', '971565908769', '', '', '', '', '971565908769', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Karthick Raj', '971564048624', 'pjennispandian@gmail.com', '39', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-13 10:16:27', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(52, 'PS051', 'Meghna Balasubramaniyam', 'student', '2011-02-22', '10', 'Female', '', '', '', '', '', '', '', '', '', 'Balasubramaniyam', '971555063883', '', '', 'Jisha', '', '', '', '', '971557526800', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Bala subramaniyam', '97155063883', 'jishabalasubramaniyam@gmail.com', '40', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-13 11:02:33', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(53, 'PS052', 'Karell Candice', 'student', '2013-11-13', '8', 'Female', '', '', '', '', '', '', '', '', '', '971508546029', 'Arnel Suerte', '', '', '971508499808', '', '', '', '', 'Daisy Suerte', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Arnel Suerte', '971508546029', 'nellkarell@gmail.com', '41', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-13 11:13:49', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(54, 'PS053', 'Nelly Ashley', 'student', '2004-05-18', '17', 'Male', '', '', '', '', '', '', '', '', '', 'Arnel Suerte', '971508576029', '', '', 'Daisy Suerte', '', '', '', '', '971508499808', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Arnel Suerte', '971508546029', 'nellkarell@gmail.com', '41', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-13 11:20:18', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(55, 'PS054', 'Lavanya Kishore', 'student', '2006-01-09', '16', 'Female', '', '', '', '', '', '', '', '', '', 'T.S.Kishore', '971506759023', '', '', 'Priya Narayanan', '', '', '', '', '971504733070', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'T.S.Kishore', '971506759023', 'kishore.ts@gmail.com', '42', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-13 11:53:25', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(56, 'PS055', 'Adithya Kishore', 'student', '2008-03-17', '13', 'Male', '', '', '', '', '', '', '', '', '', 'T.S.Kishore', '971506759023', '', '', 'Priya Narayanan', '', '', '', '', '971504733070', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'T.S.Kishore', '971506759023', 'kishore.ts@gmail.com', '42', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-13 11:55:46', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(57, 'PS056', 'Antony Wilson', 'student', '2002-01-18', '19', 'Male', '', '', '', '', '', '', '', '', '', 'Xavier', '971506827648', '', '', 'Vanitha Janet', '', '', '', '', '971526413378', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Xavier', '971506827648', 'vanitha.janet@gmail.com', '28', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-13 12:13:25', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(58, 'PS057', 'Austin Xavier', 'student', '2011-02-22', '10', 'Male', '', '', '', '', '', '', '', '', '', 'Xavier', '971506827648', '', '', 'Vanitha Janet', '', '', '', '', '971526413378', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Xavier', '971506827648', 'vanitha.janet@gmail.com', '28', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-13 12:16:11', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(59, 'PS058', 'Isha Ramanan', 'student', '2013-01-27', '8', 'Female', '', '', '', '', '', '', '', '', '', 'Ramanan', '971503665167', '', '', 'Anitha Krishnaurthy', '', '', '', '', '971503665164', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Anitha Krishna Moorthy', '971503665167', 'anithakrishna81@gmail.com', '44', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-13 13:07:50', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(60, 'PS059', 'Samyukt Nrayanan', 'student', '2013-02-08', '8', 'Male', '', '', '', '', '', '', '', '', '', 'Narayanan', '971525617789', '', '', 'Jayashri', '', '', '', '', '971565094036', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Jayasri Narayanan', '971525617789', 'jayashri.suryanarayanan@gmail.com', '45', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-14 11:05:46', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(61, 'PS060', 'Abhitha Ganesh', 'student', '2009-05-27', '12', 'Female', '', '', '', '', '', '', '', '', '', 'Ganesh', '971505247201', '', '', 'Veena Ganesh', '', '', '', '', '9715070352424', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Ganesh', '971505247201', 'ganesh.gppnair@gmail.com', '46', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-14 11:57:20', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(62, 'PS061', 'Viswanathan', 'student', '2009-02-06', '12', 'Male', '', '', '', '', '', '', '', '', '', 'Prabhakar', '971505524571', '', '', 'Sivakamasundari Srinivaasan', '', '', '', '', '971505489851', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Prabhakar', '971505524571', 'prabvis@gmail.com', '47', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-14 12:51:08', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(63, 'PS062', 'Athreyan', 'student', '2016-06-07', '5', 'Male', '', '', '', '', '', '', '', '', '', 'Anish K.S', '971528241849', '', '', 'Praseena', '', '', '', '', '971526576732', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Anish K.S', '971528241849', 'anish.sasi97152dharan@ymail.com', '48', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-14 19:03:05', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(64, 'PS063', 'Rayna', 'student', '2013-12-01', '8', 'Female', '', '', '', '', '', '', '', '', '', 'Murari Pareek', '971555115850', '', '', 'Namita Pareek', '', '', '', '', '971529590775', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Murari Pareek', '971555115850', 'pareek.murari@yahoo.com', '49', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-15 11:04:10', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(65, 'PS064', 'Anvesha Birari', 'student', '2010-03-03', '11', 'Female', '', '', '', '', '', '', '', '', '', 'Rahul Birari', '971569824914', '', '', 'Hauri Birari', '', '', '', '', '971509238267', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Rahul Birari', '971569824914', 'rahulmax07@gmail.com', '50', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-18 10:00:17', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(66, 'PS065', 'Shreya Gopal', 'student', '2010-01-19', '11', 'Female', '', '', '', '', '', '', '', '', '', 'Gopal', '971508658489', '', '', 'Saraswathy', '', '', '', '', '971559099847', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Gopal', '97150865489', 'gopalkrishnan.p@gmail.com', '17', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-18 10:19:01', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(67, 'PS066', 'Fiona Franklien', 'student', '2014-02-17', '7', 'Female', '', '', '', '', '', '', '', '', '', 'Franklien Francis', '971555123117', '', '', 'Lavanya Priya', '', '', '', '', '971551027708', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Lavanya Priya', '971551027708', 'lavanya.franklin@gmail.com', '52', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 10:54:00', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(68, 'PS067', 'Ishaan Mehta', 'student', '2007-06-11', '14', 'Female', '', '', '', '', '', '', '', '', '', 'Sudeep Mehta', '971528672989', '', '', 'Nidhi Bhandari', '', '', '', '', '971528672989', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sudeep Mehta', '971528672989', 'sudeepmehta31@gmail.com', '53', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 11:26:14', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(69, 'PS068', 'Shanyaa Mehta', 'student', '2012-10-13', '9', 'Female', '', '', '', '', '', '', '', '', '', 'Sudeep Mehta', '971528672989', '', '', 'Nidhi Bhandari', '', '', '', '', '971528672989', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sudeep Mehta', '971528672989', 'sudeepmehta31@gmail.com', '53', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 11:30:03', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(70, 'PS069', 'Rishita Sahu', 'student', '2006-01-29', '15', 'Female', '', '', '', '', '', '', '', '', '', 'Vivek Sahu', '971501897114', '', '', 'Jyoti Sanu', '', '', '', '', '971503618649', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Vivek Sahu', '971555584909', 'krish.tolani@gmail.com', '54', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 11:52:33', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(71, 'PS070', 'Emman Fazulbhoy', 'student', '2010-05-06', '11', 'Female', '', '', '', '', '', '', '', '', '', 'Mohammed Reza Fazulbhoy', '971505590305', '', '', 'Safira Fazulbhoy', '', '', '', '', '971558724105', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Mohammed Reza Fazulbhoy', '971558724105', 'safira.emaan@gmail.com', '55', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 12:08:38', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(72, 'PS071', 'Sharini Suresh', 'student', '2010-06-28', '11', 'Female', '', '', '', '', '', '', '', '', '', 'Suresh Govindaraj', '0503691675', '', '', 'Surya Suresh', '', '', '', '', '0559926752', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Suresh Govindaraj', '971503691675', 'sonasuresh07@gmail.com', '56', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 13:06:27', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(73, 'PS072', 'Eeshana Sanjay', 'student', '2011-02-22', '10', 'Female', '', '', '', '', '', '', '', '', '', '971504782578', 'Sanjay Ramdas', '', '', '971568482345', '', '', '', '', 'Sireesha  Sanjay', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sanjay Ramdas', '971504782578', 'siresha.sanjay62@gmail.com', '57', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 17:36:57', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(74, 'PS073', 'Ishanvi Sulakshan', 'student', '2012-12-07', '9', 'Female', '', '', '', '', '', '', '', '', '', 'Sulakshan .N', '971507935732', '', '', 'Vidya.S', '', '', '', '', '971507935732', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sulakshan.N', '971507935732', 'ssdv1981@gmail.com', '58', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 17:49:17', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(75, 'PS074', 'Jaishnu', 'student', '2008-06-09', '13', 'Male', '', '', '', '', '', '', '', '', '', 'Sulakshan .N', '971507935732', '', '', 'Vidya.S', '', '', '', '', '971564335198', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sulakshan.N', '971507935732', 'ssdv1981@gmail.com', '58', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 17:59:45', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(76, 'PS075', 'Tiara Dubash', 'student', '2012-08-23', '9', 'Female', '', '', '', '', '', '', '', '', '', 'Zeres Dubash', '971529038326', '', '', 'Nina Dubash', '', '', '', '', '971559201734', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Zerses Dubash', '971529038326', 'nkhadiwalla@yahoo.com', '59', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 18:57:22', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(77, 'PS076', 'Nandini Singla', 'student', '2012-07-01', '9', 'Female', '', '', '', '', '', '', '', '', '', 'Anshul Singla', '971565384006', '', '', 'Geeta garg', '', '', '', '', '971529492047', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Anshul singhla', '971565384006', 'anshulsingla@gmail.com', '51', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 19:16:23', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(78, 'PS077', 'Adithya rajwani', 'student', '2015-05-17', '6', 'Male', '', '', '', '', '', '', '', '', '', 'Rajwani', '971508039253', '', '', 'Meesha', '', '', '', '', '971557346646', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Meesha rajwani', '971508039252', 'anup@rajwaniexports.com', '60', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-20 19:22:37', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(79, 'PS078', 'Rithikaa', 'student', '2009-09-22', '12', 'Female', '', '', '', '', '', '', '', '', '', 'Jayaram Jagannathan', '971508497989', '', '', 'Menaka', '', '', '', '', '971507949489', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Jayaram Jagannathan', '971508497989', 'j_j_ram@yahoo.com', '61', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-21 11:01:48', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1);
INSERT INTO `registrations` (`id`, `sid`, `name`, `role`, `dob`, `age`, `gender`, `nationality`, `country`, `state`, `district`, `city`, `postal_code`, `school_name`, `sibling_name`, `sibling_reg_no`, `father_name`, `father_contact`, `father_office_contact`, `father_email`, `mother_name`, `mother_contact`, `mother_office_contact`, `mother_email`, `student_email`, `emergency_contact`, `current_country`, `current_city`, `current_postal_code`, `address_1`, `address_2`, `t_shirt_size`, `emirates_id`, `emirates_id_issue`, `emirates_id_expire`, `reg_fee_category`, `reg_fee`, `reg_fee_status`, `discount_applicable`, `discount_select`, `discount_percentage`, `status`, `approval_status`, `user_id`, `parent_name`, `parent_mobile`, `parent_email_id`, `parent_user_id`, `psa_serial_number`, `updated_admin_id`, `updated_admin_name`, `updated_admin_email`, `updated_date`, `verified_by`, `created_at`, `updated_at`, `image_file_name`, `image_content_type`, `image_file_size`, `image_updated_at`, `student_passport_file_name`, `passport_id`, `student_passport_content_type`, `student_passport_file_size`, `student_passport_updated_at`, `student_emid_file_name`, `student_emid_content_type`, `student_emid_file_size`, `student_emid_updated_at`, `student_visapage_file_name`, `student_visapage_content_type`, `student_visapage_file_size`, `student_visapage_updated_at`, `sponsor_passport_file_name`, `sponsor_passport_content_type`, `sponsor_passport_file_size`, `sponsor_passport_updated_at`, `sponsor_emid_file_name`, `sponsor_emid_content_type`, `sponsor_emid_file_size`, `sponsor_emid_updated_at`, `sponsor_visapage_file_name`, `sponsor_visapage_content_type`, `sponsor_visapage_file_size`, `sponsor_visapage_updated_at`, `deleted`, `country_id`) VALUES
(80, 'PS079', 'Siana Avila Mendonca', 'student', '2007-04-27', '14', 'Female', '', '', '', '', '', '', '', '', '', 'Pratap Mendonca', '971504953407', '', '', 'Scytle Fernandes', '', '', '', '', '971504953407', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Pratap Mendonca', '971504953407', 'scytlef@gmail.com', '62', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-21 13:29:35', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(81, 'PS080', 'ANAISHA', 'student', '2008-10-28', '13', 'Female', '', '', '', '', '', '', '', '', '', 'SANDIP Ghandari', '971506597096', '', '', 'TAMANNA', '', '', '', '', '97150597096', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'SANDIP GHANDARI', '971506597056', 'sandip_bhandari@hotmail.com', '63', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-21 18:16:37', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(82, 'PS081', 'Samira', 'student', '2012-02-18', '9', 'Female', '', '', '', '', '', '', '', '', '', 'SANDIP Ghandari', '971506597096', '', '', 'TAMANNA', '', '', '', '', '971506597096', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'SANDIP GHANDARI', '971506597056', 'sandip_bhandari@hotmail.com', '63', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-21 18:24:35', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(83, 'PS082', 'Aaravmudhan', 'student', '2011-07-04', '10', 'Male', '', '', '', '', '', '', '', '', '', 'S.Ranganathan', '971566789467', '', '', 'R.Lakshmi', '', '', '', '', '971507199015', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'S.Ranganathan', '971566789467', 'rangalakshmi@gmail.com', '64', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-21 19:38:46', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(84, 'PS083', 'Pranav Badri', 'student', '2009-12-01', '12', 'Male', '', '', '', '', '', '', '', '', '', 'Badri Ramaswamy', '971508024976', '', '', 'Nagalakshmy.N', '', '', '', '', '971507687318', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Badri Ramaswamy', '971508024976', 'erodebadri@gmail.com', '65', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 09:14:48', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(85, 'PS084', 'Niranjana Badri', 'student', '2014-01-26', '7', 'Female', '', '', '', '', '', '', '', '', '', 'Badri Ramaswamy', '971508024976', '', '', 'Nagalakshmy.N', '', '', '', '', '971507687318', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Badri Ramaswamy', '971508024976', 'erodebadri@gmail.com', '65', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 09:17:46', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(86, 'PS085', 'Aditi Gomadam', 'student', '2014-04-20', '7', 'Female', '', '', '', '', '', '', '', '', '', 'Sudarshan.G', '971528936873', '', '', 'Archana', '', '', '', '', '971526991146', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sudharshan.G', '971528936873', 'gs.sudarshan@gmail.com', '66', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 09:29:58', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(87, 'PS086', 'Sahana Gomadam', 'student', '2016-03-10', '5', 'Female', '', '', '', '', '', '', '', '', '', 'Sudharshan', '971528936873', '', '', 'Archana', '', '', '', '', '971526991146', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sudharshan.G', '971528936873', 'gs.sudarshan@gmail.com', '66', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 09:38:05', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(88, 'PS087', 'Keya Upadhyay', 'student', '2006-05-01', '15', 'Female', '', '', '', '', '', '', '', '', '', 'Vishnu Upadhyay', '971505583725', '', '', 'Pooja Upadhyay', '', '', '', '', '971556725080', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Vishnu upadhyay', '971505583725', 'vishnu_kinkar@yahoo.com', '67', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 09:45:42', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(89, 'PS088', 'Rayaan Irani', 'student', '2008-12-22', '13', 'Male', '', '', '', '', '', '', '', '', '', 'Firdus Irani', '971505505174', '', '', 'Kairmein Irani', '', '', '', '', '971508585926', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Firdous Irani', '971505505174', 'fidzy101@gmail.com', '68', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 10:50:44', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(90, 'PS089', 'Anaissa Irani', 'student', '2006-04-11', '15', 'Female', '', '', '', '', '', '', '', '', '', 'Firdus Irani', '971505505174', '', '', 'Kairmein Irani', '', '', '', '', '971508585926', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Firdous Irani', '971505505174', 'fidzy101@gmail.com', '68', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 10:53:10', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(91, 'PS090', 'Mohamed Niyas', 'student', '2007-10-23', '14', 'Male', '', '', '', '', '', '', '', '', '', 'Raja mohamed', '971503191434', '', '', 'SaheerBegam', '', '', '', '', '971507951779', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Rajamohamed', '971503191434', 'raja.mohamed23@gmail.com', '69', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 11:03:00', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(92, 'PS091', 'Hasbina Begum', 'student', '2012-08-04', '9', 'Female', '', '', '', '', '', '', '', '', '', 'Raja mohamed', '0503191434', '', '', 'SaheerBegam', '', '', '', '', '0507951779', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Rajamohamed', '971503191434', 'raja.mohamed23@gmail.com', '69', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 11:11:53', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(93, 'PS092', 'Sanskrati', 'student', '2010-01-05', '12', 'Female', '', '', '', '', '', '', '', '', '', 'Parijat', '971543229435', '', '', 'Preeti Sharma', '', '', '', '', '971543229435', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Parijat', '971543229435', 'preetiparijat@gmail.com', '70', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 11:46:44', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(94, 'PS093', 'Samridhi', 'student', '2010-01-05', '12', 'Female', '', '', '', '', '', '', '', '', '', 'Parijat', '971503308934', '', '', 'Preeti Sharma', '', '', '', '', '971543229435', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Parijat', '971543229435', 'preetiparijat@gmail.com', '70', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 11:53:34', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(95, 'PS094', 'Khadeeja Fahih', 'student', '2012-09-29', '9', 'Female', '', '', '', '', '', '', '', '', '', 'Fehmeena Fahih', '971507684671', '', '', 'Khadeeja Fahih', '', '', '', '', '971504524513', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Fehmeena Fahih', '971507684671', 'femfa@yahoo.co.in', '71', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 12:31:17', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(96, 'PS095', 'Nixon', 'student', '2003-05-23', '18', 'Male', '', '', '', '', '', '', '', '', '', 'Naveen', '971508942899', '', '', 'Lavina', '', '', '', '', '971508942899', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Naveen', '971508942899', 'quadrosnixon007@gmail.com', '72', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 12:34:58', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(97, 'PS096', 'Aishwarya Sakhrani', 'student', '2009-03-30', '12', 'Female', '', '', '', '', '', '', '', '', '', 'Pradeep Sakhrani', '971507594023', '', '', 'Kamala Sakhrani', '', '', '', '', '971504931056', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Pradeep Sakhrani', '971507594023', 'pradeepsakhrani2@gmail.com', '73', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 15:16:23', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(98, 'PS097', 'Veer Abichandani', 'student', '2013-02-19', '8', 'Male', '', '', '', '', '', '', '', '', '', 'Sanjay Abichandani', '971501642544', '', '', 'Ektavasandani', '', '', '', '', '971555593119', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sanjay Abichandani', '971501642544', 'sanjay.abichandani79@gmail.com', '74', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 15:30:26', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(99, 'PS098', 'Nikhil Arora', 'student', '1986-09-11', '35', 'Male', '', '', '', '', '', '', '', '', '', 'Nikhil Arora', '971525149169', '', '', 'Kikhil Arora', '', '', '', '', '971525149169', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Nikhil Arora', '971525149169', 'nikhil.11986@gmail.com', '76', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-23 16:20:55', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(100, 'PS099', 'Manvir Thejas R.S', 'student', '2010-03-27', '11', 'Male', '', '', '', '', '', '', '', '', '', 'singaravelRanjan', '971506442047', '', '', 'Shrisakthi Shanmugapriyan', '', '', '', '', '971508331705', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Singaravel Ranjan', '971506442047', 's_shrisakthi@yahoo.com', '77', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-24 13:47:40', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(101, 'PS100', 'Abhay Krishna', 'student', '2009-03-04', '12', 'Male', '', '', '', '', '', '', '', '', '', 'Unnikrishnan', '971502847204', '', '', 'Suma', '', '', '', '', '971502847204', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Suma Unnikrishnan', '971502847204', 'cunni09@gmail.com', '78', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-24 14:00:29', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(102, 'PS101', 'Maryam Mobin', 'student', '2008-11-01', '13', 'Female', '', '', '', '', '', '', '', '', '', 'Hena Fatima', '971505605170', '', '', 'Hena Fatima', '', '', '', '', '971505605170', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Hena Fatima', '971505605170', 'maryam.mobeen@gmail.com', '79', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-24 17:38:31', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(103, 'PS102', 'Mahna Mobeen', 'student', '2012-06-18', '9', 'Female', '', '', '', '', '', '', '', '', '', 'Hena Fatima', '971505605170', '', '', 'Hena Fatima', '', '', '', '', '971505605170', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Hena Fatima', '971505605170', 'maryam.mobeen@gmail.com', '79', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-24 17:42:52', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(104, 'PS103', 'Gautham krishna', 'student', '2011-05-18', '10', 'Male', '', '', '', '', '', '', '', '', '', 'Jayadeep', '971503556368', '', '', 'Gayathri', '', '', '', '', '971508510825', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'JayaDeep', '971508556368', 'jayadeep.cm@gmail.com', '80', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-24 18:08:19', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(105, 'PS104', 'Gauri Nanda', 'student', '2008-01-02', '14', 'Male', '', '', '', '', '', '', '', '', '', 'Jayadeep', '971503556368', '', '', 'Gayathri', '', '', '', '', '971503556368', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'JayaDeep', '971508556368', 'jayadeep.cm@gmail.com', '80', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-24 18:10:08', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(106, 'PS105', 'Mihran', 'student', '2014-06-08', '7', 'Male', '', '', '', '', '', '', '', '', '', '971558492740', 'Fathima zulfa', '', '', '971558006579', '', '', '', '', 'Fathima Zulfa', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Fathima Zulfa', '971558492740', 'shahulhamee@gmail.com', '81', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-26 12:17:16', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(107, 'PS106', 'Zainab Zuhara', 'student', '2016-02-04', '5', 'Female', '', '', '', '', '', '', '', '', '', 'Fathima zulfa', '971558492740', '', '', 'Fathima Zulha', '', '', '', '', '971558492740', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Fathima Zulfa', '971558492740', 'shahulhamee@gmail.com', '81', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-26 12:21:09', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(108, 'PS107', 'Sheik Zaina', 'student', '2004-12-19', '17', 'Female', '', '', '', '', '', '', '', '', '', 'Fauzan', '971529459747', '', '', 'Fauzan', '', '', '', '', '971529459747', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Fauzan', '971529459747', 'fauzanjeema@gmail.com', '82', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-26 12:34:20', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(109, 'PS108', 'Abdul Ahad Ahmed', 'student', '2009-08-01', '12', 'Male', '', '', '', '', '', '', '', '', '', 'Fauzan', '971529459747', '', '', 'Fauzan', '', '', '', '', '971539459747', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Fauzan', '971529459747', 'fauzanjeema@gmail.com', '82', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-26 12:36:15', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(110, 'PS109', 'Kishore', 'student', '2014-08-20', '7', 'Male', '', '', '', '', '', '', '', '', '', 'Chinni', '971502165359', '', '', 'Chinni', '', '', '', '', '971502165359', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Chinni', '971502165359', 'garikipati.chinni@gmail.com', '83', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-26 12:41:14', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(111, 'PS110', 'Niranjan Sandeep', 'student', '2009-08-15', '12', 'Male', '', '', '', '', '', '', '', '', '', 'Sandeep.P', '971505507842', '', '', 'Jisha Sandeep', '', '', '', '', '971501149626', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sandeep.P', '971505507842', 'ppsandeep@gmail.com', '84', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-26 12:49:35', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(112, 'PS111', 'Niharika Sandeep', 'student', '2015-04-02', '6', 'Female', '', '', '', '', '', '', '', '', '', 'Sandeep.P', '971505507842', '', '', 'Jisha Sandeep', '', '', '', '', '971501149626', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sandeep.P', '971505507842', 'ppsandeep@gmail.com', '84', NULL, 1, '', 'bmr.ind@gmail.com', NULL, NULL, '2022-01-26 12:52:01', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(113, 'PS112', 'Akshita', 'student', '2018-05-01', '3', 'Female', '', '', '', '', '', '', '', '', '', 'Vijay', '9566960050', '', '', 'Raveena', '', '', '', '', '9566960050', NULL, NULL, NULL, '', '', '', 'SE1234', '', '2024-10-23', NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', '86', NULL, 90, '', 'nmuthu@jksoftec.com', NULL, NULL, '2022-02-01 16:56:12', '2022-02-01 22:56:50', '', NULL, NULL, NULL, '', 'S1234', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1),
(115, 'PS114', 'Dev', 'student', '2003-04-28', '18', 'Male', '', '', '', '', '', '', '', '', '', 'test', '9009980090', '', '', 'test', '', '', '', '', '9009980090', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', 'Approved', NULL, 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', '87', NULL, 90, '', 'nmuthu@jksoftec.com ', NULL, NULL, '2022-02-09 12:07:48', '0000-00-00 00:00:00', '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `registration_approvals`
--

CREATE TABLE `registration_approvals` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_fees`
--

CREATE TABLE `registration_fees` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_contact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee_pay_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay_month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_fee_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_fee` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_fee_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `daily_transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pay_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wallet` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wallet_balance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat_percent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `net_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registration_fees`
--

INSERT INTO `registration_fees` (`id`, `student_id`, `student_name`, `parent_id`, `parent_name`, `parent_contact`, `pay_date`, `fee_pay_type`, `pay_month`, `reg_fee_category`, `reg_fee`, `reg_fee_status`, `daily_transaction_id`, `transaction_detail`, `transaction_id`, `transaction_type`, `account_code`, `pay_type`, `wallet`, `wallet_balance`, `bank_name`, `cheque_date`, `cheque_number`, `vat_percent`, `vat_value`, `net_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, '36', 'Tanmay Maheshwari', '27', 'Tanmay Maheshwari', '971501399625', '2022-01-12', 'Registration Fees', NULL, 'Kid', '100.00', NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', '294', '294', NULL, NULL, NULL, 5.00, 5.00, 105.00, 'Active', '2022-01-12 17:17:40', '0000-00-00 00:00:00'),
(2, '77', 'Nandini Singla', '51', 'Anshul singhla', '971565384006', '2022-01-23', 'Registration Fees', NULL, 'Kid', '100.00', NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', '546', '546', NULL, NULL, NULL, 5.00, 5.00, 105.00, 'Active', '2022-01-23 17:57:28', '0000-00-00 00:00:00'),
(3, '95', 'Khadeeja Fahih', '71', 'Fehmeena Fahih', '971507684671', '2022-01-23', 'Registration Fees', NULL, 'Kid', '100.00', NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', '546', '546', NULL, NULL, NULL, 5.00, 5.00, 105.00, 'Active', '2022-01-23 17:57:42', '0000-00-00 00:00:00'),
(4, '113', 'Akshita', '86', 'Vijay', '9566960050', '2022-02-01', 'Registration Fees', NULL, 'Kid', '100.00', NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', '895', '895', NULL, NULL, NULL, 5.00, 5.00, 105.00, 'Active', '2022-02-01 22:58:15', '0000-00-00 00:00:00'),
(5, '115', 'Dev', '87', 'Sumathi', '8870883990', '2022-02-09', 'Registration Fees', NULL, 'Kid', '100.00', NULL, NULL, NULL, NULL, NULL, NULL, 'wallet', '895', '895', NULL, NULL, NULL, 5.00, 5.00, 105.00, 'Active', '2022-02-09 12:08:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reg_charge_setups`
--

CREATE TABLE `reg_charge_setups` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_fee` decimal(10,2) DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reg_charge_setups`
--

INSERT INTO `reg_charge_setups` (`id`, `category`, `reg_fee`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Kid', 100.00, 'Registration fees for Kid', '2021-01-07 11:01:24', '2021-11-26 18:56:36'),
(2, 'Adult', 100.00, 'Registration fees for Adult', '2021-02-09 16:13:56', '2021-11-26 18:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `reg_fees_paid_dues`
--

CREATE TABLE `reg_fees_paid_dues` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_approve_reject_reports`
--

CREATE TABLE `request_approve_reject_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_approve_rejects`
--

CREATE TABLE `req_approve_rejects` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lanecourt_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currentslot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_slot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_delegations`
--

CREATE TABLE `role_delegations` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `menu_id` varchar(255) DEFAULT NULL,
  `view_id` tinyint(1) DEFAULT NULL,
  `edit_id` tinyint(1) DEFAULT NULL,
  `delete_id` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `sub_module_id` int(15) NOT NULL,
  `permission` int(15) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schema_migrations`
--

CREATE TABLE `schema_migrations` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_attendances`
--

CREATE TABLE `school_attendances` (
  `id` int(11) NOT NULL,
  `bkid` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `school_id` varchar(255) DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `activity_id` varchar(255) DEFAULT NULL,
  `coach_id` varchar(255) DEFAULT NULL,
  `location_id` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `time_to` varchar(255) DEFAULT NULL,
  `status` int(255) NOT NULL DEFAULT '0' COMMENT '0-Pending, 1-Present, 2-Absent',
  `created_name` varchar(255) DEFAULT NULL,
  `created_by` int(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school_attendance_bookings`
--

CREATE TABLE `school_attendance_bookings` (
  `id` int(11) NOT NULL,
  `bkid` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `school_id` varchar(255) DEFAULT NULL,
  `activity_id` varchar(255) DEFAULT NULL,
  `coach_id` varchar(255) DEFAULT NULL,
  `location_id` varchar(255) DEFAULT NULL,
  `time_from` varchar(255) DEFAULT NULL,
  `time_to` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `updated_admin_name` varchar(255) DEFAULT NULL,
  `updated_admin_email` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school_credits`
--

CREATE TABLE `school_credits` (
  `id` int(11) NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `school_id` varchar(255) DEFAULT NULL,
  `activity_id` varchar(255) DEFAULT NULL,
  `location_id` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `trn_number` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `gross_amount` varchar(255) DEFAULT NULL,
  `vat_percentage` varchar(255) DEFAULT NULL,
  `vat_value` varchar(255) DEFAULT NULL,
  `net_amount` varchar(255) DEFAULT NULL,
  `account_code` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `debit` float DEFAULT NULL,
  `amount_paid` float DEFAULT NULL,
  `transaction_amount` float DEFAULT NULL,
  `transaction_detail` varchar(255) DEFAULT NULL,
  `updated_admin_name` varchar(255) DEFAULT NULL,
  `updated_admin_id` int(11) NOT NULL,
  `updated_date` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `wtx_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school_invoices`
--

CREATE TABLE `school_invoices` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school_profile_reports`
--

CREATE TABLE `school_profile_reports` (
  `id` int(11) NOT NULL,
  `school_id` varchar(64) NOT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `school_location` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `trn_number` varchar(255) DEFAULT NULL,
  `school_email_id` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school_registrations`
--

CREATE TABLE `school_registrations` (
  `id` int(11) NOT NULL,
  `school_id` varchar(255) DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `school_location` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `trn_number` varchar(255) DEFAULT NULL,
  `school_email_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scroll_text_messages`
--

CREATE TABLE `scroll_text_messages` (
  `id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `scroll_text_messages`
--

INSERT INTO `scroll_text_messages` (`id`, `message`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Welcome to Prime Star Sports Services', 'Yes', '2022-01-10 21:09:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `set_academy_holidays`
--

CREATE TABLE `set_academy_holidays` (
  `id` int(11) NOT NULL,
  `select_date` date DEFAULT NULL,
  `holiday_name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) NOT NULL,
  `slot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lanecourt_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `day_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_count` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slot_bookings`
--

CREATE TABLE `slot_bookings` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slot_booking_carts`
--

CREATE TABLE `slot_booking_carts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `bkid` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `colour` varchar(255) DEFAULT NULL,
  `textcolour` varchar(255) DEFAULT NULL,
  `checkout` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slot_calendars`
--

CREATE TABLE `slot_calendars` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slot_calendar_admins`
--

CREATE TABLE `slot_calendar_admins` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slot_class_registrations`
--

CREATE TABLE `slot_class_registrations` (
  `id` int(11) NOT NULL,
  `fee_package_setups_id` int(11) NOT NULL,
  `slot_classes_min` int(15) NOT NULL,
  `slot_classes_max` int(15) NOT NULL,
  `fees` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slot_class_registrations`
--

INSERT INTO `slot_class_registrations` (`id`, `fee_package_setups_id`, `slot_classes_min`, `slot_classes_max`, `fees`, `status`) VALUES
(4, 4, 1, 7, 75.00, 'Active'),
(5, 5, 1, 7, 75.00, 'Active'),
(6, 6, 1, 7, 110.00, 'Active'),
(7, 6, 1, 11, 100.00, 'Active'),
(8, 7, 1, 7, 110.00, 'Active'),
(9, 7, 1, 11, 100.00, 'Active'),
(10, 7, 1, 24, 90.00, 'Active'),
(11, 8, 1, 7, 110.00, 'Active'),
(12, 8, 1, 11, 100.00, 'Active'),
(13, 8, 1, 24, 90.00, 'Active'),
(14, 3, 1, 7, 75.00, 'Active'),
(15, 3, 1, 24, 65.00, 'Active'),
(16, 2, 1, 7, 75.00, 'Active'),
(17, 2, 1, 24, 65.00, 'Active'),
(18, 1, 1, 7, 75.00, 'Active'),
(19, 1, 1, 24, 65.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `slot_refund_reports`
--

CREATE TABLE `slot_refund_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slot_reqs`
--

CREATE TABLE `slot_reqs` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slot_requests`
--

CREATE TABLE `slot_requests` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slot_selections`
--

CREATE TABLE `slot_selections` (
  `id` int(11) NOT NULL,
  `coach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lane_court_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_from_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_to_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slot_selections`
--

INSERT INTO `slot_selections` (`id`, `coach_id`, `level_id`, `lane_court_id`, `game_id`, `location_id`, `slot_id`, `slot_class`, `slot_from_time`, `slot_to_time`, `status`, `hour`, `category`, `created_at`, `updated_at`) VALUES
(2, '1', '2', '2', '1', '4', '10', 'ALB002', '08.00 AM', '10.00 AM', 'Active', 'Two', 'Kid', '2022-01-06 19:12:53', '0000-00-00 00:00:00'),
(3, '1', '1', '1', '1', '1', '10', 'KAB001', '05.00 PM', '07.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 19:22:28', '0000-00-00 00:00:00'),
(4, '1', '1', '2', '1', '1', '6', 'KAB002', '05.00 PM', '07.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 19:25:59', '0000-00-00 00:00:00'),
(5, '1', '2', '3', '1', '1', '4', 'KAB003', '05.00 PM', '07.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 19:45:24', '0000-00-00 00:00:00'),
(6, '1', '2', '1', '1', '1', '10', 'KAB004', '06.00 PM', '08.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 20:08:12', '0000-00-00 00:00:00'),
(7, '1', '2', '2', '1', '1', '8', 'KAB005', '06.00 PM', '08.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 20:09:38', '0000-00-00 00:00:00'),
(8, '1', '1', '3', '1', '1', '4', 'KAB006', '06.00 AM', '08.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 20:11:06', '0000-00-00 00:00:00'),
(9, '1', '2', '1', '1', '1', '10', 'KAB007', '08.00 AM', '10.00 AM', 'Active', 'Two', 'Kid', '2022-01-06 20:13:57', '0000-00-00 00:00:00'),
(10, '1', '2', '2', '1', '1', '8', 'KAB008', '08.00 AM', '10.00 AM', 'Active', 'Two', 'Kid', '2022-01-06 20:14:47', '0000-00-00 00:00:00'),
(11, '1', '1', '3', '1', '1', '4', 'KAB009', '08.00 AM', '10.00 AM', 'Active', 'Two', 'Kid', '2022-01-06 20:15:39', '0000-00-00 00:00:00'),
(12, '1', '1', '1', '1', '1', '10', 'KAB010', '10.00 AM', '12.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 20:16:53', '0000-00-00 00:00:00'),
(13, '1', '1', '2', '1', '1', '8', 'KAB011', '10.00 AM', '12.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 20:17:57', '0000-00-00 00:00:00'),
(14, '1', '1', '1', '1', '1', '10', 'KAB013', '03.00 PM', '05.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 20:18:57', '0000-00-00 00:00:00'),
(15, '1', '1', '2', '1', '1', '8', 'KAB014', '03.00 PM', '05.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 20:19:51', '0000-00-00 00:00:00'),
(16, '1', '2', '3', '1', '1', '4', 'KAB012', '10.00 AM', '12.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 20:21:31', '2022-01-07 09:21:48'),
(17, '1', '2', '3', '1', '1', '4', 'KAB015', '03.00 PM', '05.00 PM', 'Active', 'Two', 'Kid', '2022-01-06 20:22:36', '0000-00-00 00:00:00'),
(18, '2', '1', '4', '2', '2', '6', 'EG001', '04.00 PM', '05.00 PM', 'Active', 'One', 'Kid', '2022-01-14 21:11:04', '0000-00-00 00:00:00'),
(19, '2', '2', '5', '2', '2', '6', 'EG002', '04.00 PM', '06.00 PM', 'Active', 'Two', 'Kid', '2022-01-14 21:16:29', '0000-00-00 00:00:00'),
(20, '2', '3', '5', '2', '2', '4', 'EG003', '04.00 PM', '06.00 PM', 'Active', 'Two', 'Kid', '2022-01-14 21:17:47', '0000-00-00 00:00:00'),
(21, '2', '1', '4', '2', '2', '6', 'EG004', '05.00 PM', '06.00 PM', 'Active', 'One', 'Kid', '2022-01-14 21:19:03', '0000-00-00 00:00:00'),
(22, '2', '1', '4', '2', '2', '6', 'EG005', '06.00 PM', '07.00 PM', 'Active', 'One', 'Kid', '2022-01-14 21:22:00', '0000-00-00 00:00:00'),
(23, '2', '1', '5', '2', '2', '6', 'EG006', '06.00 PM', '07.00 PM', 'Active', 'One', 'Kid', '2022-01-14 21:27:18', '0000-00-00 00:00:00'),
(24, '2', '1', '4', '2', '2', '6', 'EG007', '07.00 PM', '08.00 PM', 'Active', 'One', 'Adult', '2022-01-14 21:28:55', '0000-00-00 00:00:00'),
(25, '2', '2', '4', '2', '2', '10', 'EG008', '07.00 AM', '09.00 AM', 'Active', 'Two', 'Kid', '2022-01-15 18:18:00', '2022-01-15 18:29:34'),
(27, '2', '1', '5', '2', '2', '6', 'EG009', '08.00 AM', '09.00 AM', 'Active', 'One', 'Kid', '2022-01-15 18:32:46', '0000-00-00 00:00:00'),
(28, '2', '1', '4', '2', '2', '6', 'EG010', '09.00 AM', '10.00 AM', 'Active', 'One', 'Kid', '2022-01-15 18:34:54', '0000-00-00 00:00:00'),
(29, '2', '1', '5', '2', '2', '6', 'EG011', '09.00 AM', '10.00 AM', 'Active', 'One', 'Kid', '2022-01-15 18:35:42', '0000-00-00 00:00:00'),
(30, '2', '1', '4', '2', '2', '6', 'EG012', '10.00 AM', '11.00 AM', 'Active', 'One', 'Kid', '2022-01-15 18:37:36', '0000-00-00 00:00:00'),
(31, '2', '1', '5', '2', '2', '6', 'EG013', '10.00 AM', '11.00 AM', 'Active', 'One', 'Kid', '2022-01-15 18:53:42', '0000-00-00 00:00:00'),
(32, '2', '1', '4', '2', '2', '6', 'EG014', '11.00 AM', '12.00 PM', 'Active', 'One', 'Kid', '2022-01-15 19:00:25', '0000-00-00 00:00:00'),
(33, '2', '1', '5', '2', '2', '6', 'EG015', '11.00 AM', '12.00 PM', 'Active', 'One', 'Kid', '2022-01-15 19:01:52', '2022-01-15 19:03:13'),
(34, '2', '1', '4', '2', '2', '6', 'EG016', '02.00 PM', '03.00 PM', 'Active', 'One', 'Adult', '2022-01-15 19:04:45', '0000-00-00 00:00:00'),
(35, '2', '2', '4', '2', '2', '6', 'EG017', '03.00 PM', '05.00 PM', 'Active', 'Two', 'Kid', '2022-01-15 19:06:52', '2022-01-15 19:10:52'),
(36, '2', '1', '5', '2', '2', '6', 'EG018', '04.00 PM', '05.00 PM', 'Active', 'One', 'Kid', '2022-01-15 19:09:33', '0000-00-00 00:00:00'),
(37, '2', '1', '4', '2', '2', '6', 'EG019', '05.00 PM', '06.00 PM', 'Active', 'One', 'Kid', '2022-01-15 19:14:35', '2022-01-15 19:15:50'),
(38, '2', '1', '5', '2', '2', '6', 'EG020', '05.00 PM', '06.00 PM', 'Active', 'One', 'Kid', '2022-01-15 19:16:52', '0000-00-00 00:00:00'),
(39, '3', '1', '4', '2', '3', '4', 'ST001', '04.00 PM', '05.00 PM', 'Active', 'One', 'Kid', '2022-01-16 17:56:48', '0000-00-00 00:00:00'),
(40, '3', '1', '5', '2', '3', '4', 'ST002', '04.00 PM', '05.00 PM', 'Active', 'One', 'Kid', '2022-01-16 17:58:47', '0000-00-00 00:00:00'),
(41, '3', '2', '6', '2', '3', '4', 'ST003', '04.00 PM', '06.00 PM', 'Active', 'Two', 'Kid', '2022-01-16 18:01:12', '0000-00-00 00:00:00'),
(42, '3', '2', '7', '2', '3', '4', 'ST004', '04.00 PM', '06.00 PM', 'Active', 'Two', 'Kid', '2022-01-16 18:49:15', '0000-00-00 00:00:00'),
(43, '3', '1', '4', '2', '3', '4', 'ST005', '05.00 PM', '06.00 PM', 'Active', 'One', 'Kid', '2022-01-16 18:50:37', '0000-00-00 00:00:00'),
(44, '3', '1', '5', '2', '3', '4', 'ST006', '05.00 PM', '06.00 PM', 'Active', 'One', 'Kid', '2022-01-16 18:51:29', '0000-00-00 00:00:00'),
(45, '3', '1', '4', '2', '3', '4', 'ST007', '06.00 PM', '07.00 PM', 'Active', 'One', 'Kid', '2022-01-16 18:54:56', '2022-01-16 18:57:26'),
(46, '3', '1', '5', '2', '3', '4', 'ST008', '06.00 PM', '07.00 PM', 'Active', 'One', 'Kid', '2022-01-16 18:55:53', '2022-01-16 18:57:43'),
(47, '3', '1', '6', '2', '3', '6', 'ST009', '06.00 PM', '07.00 PM', 'Active', 'One', 'Adult', '2022-01-16 18:56:53', '2022-01-16 18:58:02'),
(48, '3', '1', '4', '2', '3', '4', 'ST010', '08.00 AM', '09.00 AM', 'Active', 'One', 'Kid', '2022-01-16 19:02:31', '2022-01-16 19:05:41'),
(49, '3', '1', '5', '2', '3', '4', 'ST011', '08.00 AM', '09.00 AM', 'Active', 'One', 'Kid', '2022-01-16 19:03:21', '0000-00-00 00:00:00'),
(50, '3', '2', '6', '2', '3', '4', 'ST012', '08.00 AM', '10.00 AM', 'Active', 'Two', 'Kid', '2022-01-16 19:04:21', '0000-00-00 00:00:00'),
(51, '3', '2', '7', '2', '3', '4', 'ST013', '08.00 AM', '10.00 AM', 'Active', 'Two', 'Kid', '2022-01-16 19:05:13', '0000-00-00 00:00:00'),
(52, '3', '1', '4', '2', '3', '4', 'ST014', '09.00 AM', '10.00 AM', 'Active', 'One', 'Kid', '2022-01-16 19:07:21', '0000-00-00 00:00:00'),
(53, '3', '1', '5', '2', '3', '4', 'ST015', '09.00 AM', '10.00 AM', 'Active', 'One', 'Kid', '2022-01-16 19:09:33', '0000-00-00 00:00:00'),
(54, '3', '1', '4', '2', '3', '6', 'ST016', '10.00 AM', '11.00 AM', 'Active', 'One', 'Kid', '2022-01-16 19:11:04', '2022-01-16 19:22:19'),
(55, '3', '1', '5', '2', '3', '6', 'ST017', '10.00 AM', '11.00 AM', 'Active', 'One', 'Kid', '2022-01-17 19:55:02', '0000-00-00 00:00:00'),
(56, '3', '1', '4', '2', '3', '6', 'ST018', '11.00 AM', '12.00 AM', 'Active', 'One', 'Kid', '2022-01-17 20:11:45', '0000-00-00 00:00:00'),
(57, '3', '1', '5', '2', '3', '6', 'ST019', '11.00 AM', '12.00 AM', 'Active', 'One', 'Kid', '2022-01-17 20:12:35', '0000-00-00 00:00:00'),
(58, '3', '1', '4', '2', '3', '6', 'ST020', '03.00 PM', '04.00 PM', 'Active', 'One', 'Kid', '2022-01-17 20:18:29', '0000-00-00 00:00:00'),
(59, '3', '1', '5', '2', '3', '6', 'ST021', '03.00 PM', '04.00 PM', 'Active', 'One', 'Adult', '2022-01-17 20:21:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `slot_selections_days`
--

CREATE TABLE `slot_selections_days` (
  `ss_days_id` int(10) NOT NULL,
  `slot_selections_id` int(10) NOT NULL,
  `days` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slot_selections_days`
--

INSERT INTO `slot_selections_days` (`ss_days_id`, `slot_selections_id`, `days`) VALUES
(3, 2, 'Sunday'),
(4, 2, 'Saturday'),
(5, 3, 'Monday'),
(6, 3, 'Tuesday'),
(7, 3, 'Wednesday'),
(8, 3, 'Thursday'),
(9, 3, 'Friday'),
(10, 4, 'Monday'),
(11, 4, 'Tuesday'),
(12, 4, 'Wednesday'),
(13, 4, 'Thursday'),
(14, 4, 'Friday'),
(15, 5, 'Monday'),
(16, 5, 'Tuesday'),
(17, 5, 'Wednesday'),
(18, 5, 'Thursday'),
(19, 5, 'Friday'),
(20, 6, 'Monday'),
(21, 6, 'Tuesday'),
(22, 6, 'Wednesday'),
(23, 6, 'Thursday'),
(24, 6, 'Friday'),
(25, 7, 'Monday'),
(26, 7, 'Tuesday'),
(27, 7, 'Wednesday'),
(28, 7, 'Thursday'),
(29, 7, 'Friday'),
(30, 8, 'Monday'),
(31, 8, 'Tuesday'),
(32, 8, 'Wednesday'),
(33, 8, 'Thursday'),
(34, 8, 'Friday'),
(35, 9, 'Sunday'),
(36, 9, 'Saturday'),
(37, 10, 'Sunday'),
(38, 10, 'Saturday'),
(39, 11, 'Sunday'),
(40, 11, 'Saturday'),
(41, 12, 'Sunday'),
(42, 12, 'Saturday'),
(43, 13, 'Sunday'),
(44, 13, 'Saturday'),
(45, 14, 'Sunday'),
(46, 14, 'Saturday'),
(47, 15, 'Sunday'),
(48, 15, 'Saturday'),
(51, 17, 'Sunday'),
(52, 17, 'Saturday'),
(53, 16, 'Sunday'),
(54, 16, 'Saturday'),
(55, 18, 'Tuesday'),
(56, 18, 'Wednesday'),
(57, 18, 'Thursday'),
(58, 18, 'Friday'),
(59, 19, 'Tuesday'),
(60, 19, 'Wednesday'),
(61, 19, 'Thursday'),
(62, 19, 'Friday'),
(63, 20, 'Tuesday'),
(64, 20, 'Wednesday'),
(65, 20, 'Thursday'),
(66, 20, 'Friday'),
(67, 21, 'Tuesday'),
(68, 21, 'Wednesday'),
(69, 21, 'Thursday'),
(70, 21, 'Friday'),
(71, 22, 'Tuesday'),
(72, 22, 'Wednesday'),
(73, 22, 'Thursday'),
(74, 22, 'Friday'),
(75, 23, 'Tuesday'),
(76, 23, 'Wednesday'),
(77, 23, 'Thursday'),
(78, 23, 'Friday'),
(79, 24, 'Tuesday'),
(80, 24, 'Wednesday'),
(81, 24, 'Thursday'),
(82, 24, 'Friday'),
(87, 25, 'Sunday'),
(88, 25, 'Saturday'),
(89, 27, 'Sunday'),
(90, 27, 'Saturday'),
(91, 28, 'Sunday'),
(92, 28, 'Saturday'),
(93, 29, 'Sunday'),
(94, 29, 'Saturday'),
(95, 30, 'Sunday'),
(96, 30, 'Saturday'),
(97, 31, 'Sunday'),
(98, 31, 'Saturday'),
(99, 32, 'Sunday'),
(100, 32, 'Saturday'),
(103, 33, 'Sunday'),
(104, 33, 'Saturday'),
(105, 34, 'Sunday'),
(106, 34, 'Saturday'),
(111, 36, 'Sunday'),
(112, 36, 'Saturday'),
(113, 35, 'Sunday'),
(114, 35, 'Saturday'),
(117, 37, 'Sunday'),
(118, 37, 'Saturday'),
(119, 38, 'Sunday'),
(120, 38, 'Saturday'),
(121, 39, 'Tuesday'),
(122, 39, 'Wednesday'),
(123, 39, 'Thursday'),
(124, 39, 'Friday'),
(125, 40, 'Tuesday'),
(126, 40, 'Wednesday'),
(127, 40, 'Thursday'),
(128, 40, 'Friday'),
(129, 41, 'Tuesday'),
(130, 41, 'Wednesday'),
(131, 41, 'Thursday'),
(132, 41, 'Friday'),
(133, 42, 'Tuesday'),
(134, 42, 'Wednesday'),
(135, 42, 'Thursday'),
(136, 42, 'Friday'),
(137, 43, 'Tuesday'),
(138, 43, 'Wednesday'),
(139, 43, 'Thursday'),
(140, 43, 'Friday'),
(141, 44, 'Tuesday'),
(142, 44, 'Wednesday'),
(143, 44, 'Thursday'),
(144, 44, 'Friday'),
(157, 45, 'Tuesday'),
(158, 45, 'Wednesday'),
(159, 45, 'Thursday'),
(160, 45, 'Friday'),
(161, 46, 'Tuesday'),
(162, 46, 'Wednesday'),
(163, 46, 'Thursday'),
(164, 46, 'Friday'),
(165, 47, 'Tuesday'),
(166, 47, 'Wednesday'),
(167, 47, 'Thursday'),
(168, 47, 'Friday'),
(171, 49, 'Sunday'),
(172, 49, 'Saturday'),
(173, 50, 'Sunday'),
(174, 50, 'Saturday'),
(175, 51, 'Sunday'),
(176, 51, 'Saturday'),
(177, 48, 'Sunday'),
(178, 48, 'Saturday'),
(179, 52, 'Sunday'),
(180, 52, 'Saturday'),
(181, 53, 'Sunday'),
(182, 53, 'Saturday'),
(185, 54, 'Sunday'),
(186, 54, 'Saturday'),
(187, 55, 'Sunday'),
(188, 55, 'Saturday'),
(189, 56, 'Sunday'),
(190, 56, 'Saturday'),
(191, 57, 'Sunday'),
(192, 57, 'Saturday'),
(193, 58, 'Sunday'),
(194, 58, 'Saturday'),
(195, 59, 'Sunday'),
(196, 59, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `slot_swaps`
--

CREATE TABLE `slot_swaps` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slot_swap_reports`
--

CREATE TABLE `slot_swap_reports` (
  `id` int(11) NOT NULL,
  `registration_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activity_selection_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `old_bkid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `old_booking_date` date DEFAULT NULL,
  `old_time_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `old_time_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `old_location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `old_coach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_bkid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_booking_date` date DEFAULT NULL,
  `new_time_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_time_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_location_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_coach_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `games_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_dob` varchar(255) NOT NULL,
  `student_age` varchar(255) NOT NULL,
  `student_gender` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_contact_no` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `emergency_contact_no` varchar(255) NOT NULL,
  `passport_id` varchar(255) NOT NULL,
  `student_passport_image` varchar(255) NOT NULL,
  `parent_mobile` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `parent_email_id` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `sibling_name` varchar(255) NOT NULL,
  `sibling_reg_no` varchar(255) NOT NULL,
  `father_email_id` varchar(255) NOT NULL,
  `father_office_contact_no` varchar(255) NOT NULL,
  `mother_contact_no` varchar(255) NOT NULL,
  `mother_office_contact_no` varchar(255) NOT NULL,
  `mother_email_id` varchar(255) NOT NULL,
  `student_email_id` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `student_emirates_id` varchar(255) NOT NULL,
  `date_of_issue` varchar(255) NOT NULL,
  `tshirt_size` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `approval_status` varchar(255) NOT NULL,
  `student_passport_size_image` varchar(255) NOT NULL,
  `student_visa_page` varchar(255) NOT NULL,
  `sponsor_passport` varchar(255) NOT NULL,
  `sponsor_visa_page` varchar(255) NOT NULL,
  `sponsor_emirates_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_lists`
--

CREATE TABLE `student_lists` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_profile_reports`
--

CREATE TABLE `student_profile_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_remarks`
--

CREATE TABLE `student_remarks` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `remark` text COLLATE utf8_unicode_ci,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_logins`
--

CREATE TABLE `superadmin_logins` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_booking`
--

CREATE TABLE `tmp_booking` (
  `id` int(11) NOT NULL,
  `ticket_no` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `parent_mobile` varchar(255) DEFAULT NULL,
  `parent_email` varchar(255) DEFAULT NULL,
  `activityselection_id` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `psa_id` varchar(255) DEFAULT NULL,
  `activity_id` varchar(255) DEFAULT NULL,
  `level_id` varchar(255) DEFAULT NULL,
  `location_id` int(15) NOT NULL,
  `coach_id` int(15) NOT NULL,
  `checkout_date` date DEFAULT NULL,
  `hours` varchar(25) NOT NULL,
  `from_time` varchar(25) NOT NULL,
  `to_time` varchar(25) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `net_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_percentage` varchar(255) DEFAULT NULL,
  `net_payable_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wallet_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deducted_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wallet_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `checkout_status` varchar(255) DEFAULT NULL,
  `net_payable_amount_approval` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `lane_court_id` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tmp_booking`
--

INSERT INTO `tmp_booking` (`id`, `ticket_no`, `parent_id`, `parent_name`, `parent_mobile`, `parent_email`, `activityselection_id`, `student_id`, `psa_id`, `activity_id`, `level_id`, `location_id`, `coach_id`, `checkout_date`, `hours`, `from_time`, `to_time`, `status`, `amount`, `net_amount`, `discount`, `discount_percentage`, `net_payable_amount`, `discount_amount`, `wallet_amount`, `deducted_amount`, `wallet_balance`, `checkout_status`, `net_payable_amount_approval`, `created_at`, `updated_at`, `reason`, `user_id`, `lane_court_id`) VALUES
(146, 'BKNO-00027', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '3', '1', NULL, '1', '3', 1, 1, '2022-01-28', 'Two', '05.00 PM', '07.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:49:53', '0000-00-00 00:00:00', NULL, '1', 1),
(147, 'BKNO-00028', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '6', '1', NULL, '1', '3', 1, 1, '2022-01-28', 'Two', '06.00 PM', '08.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:50:10', '0000-00-00 00:00:00', NULL, '1', 1),
(148, 'BKNO-00029', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '9', '1', NULL, '1', '3', 1, 1, '2022-01-29', 'Two', '08.00 AM', '10.00 AM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:50:18', '0000-00-00 00:00:00', NULL, '1', 1),
(149, 'BKNO-00030', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '12', '1', NULL, '1', '3', 1, 1, '2022-01-29', 'Two', '10.00 AM', '12.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:50:22', '0000-00-00 00:00:00', NULL, '1', 1),
(150, 'BKNO-00031', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '17', '1', NULL, '1', '3', 1, 1, '2022-01-29', 'Two', '03.00 PM', '05.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:50:29', '0000-00-00 00:00:00', NULL, '1', 3),
(151, 'BKNO-00032', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '9', '1', NULL, '1', '3', 1, 1, '2022-01-30', 'Two', '08.00 AM', '10.00 AM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:50:33', '0000-00-00 00:00:00', NULL, '1', 1),
(152, 'BKNO-00033', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '12', '1', NULL, '1', '3', 1, 1, '2022-01-30', 'Two', '10.00 AM', '12.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:50:38', '0000-00-00 00:00:00', NULL, '1', 1),
(153, 'BKNO-00034', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '17', '1', NULL, '1', '3', 1, 1, '2022-01-30', 'Two', '03.00 PM', '05.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:50:46', '0000-00-00 00:00:00', NULL, '1', 3),
(154, 'BKNO-00035', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '3', '1', NULL, '1', '3', 1, 1, '2022-02-01', 'Two', '05.00 PM', '07.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:50:58', '0000-00-00 00:00:00', NULL, '1', 1),
(155, 'BKNO-00036', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '3', '1', NULL, '1', '3', 1, 1, '2022-02-02', 'Two', '05.00 PM', '07.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:51:13', '0000-00-00 00:00:00', NULL, '1', 1),
(156, 'BKNO-00037', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '3', '1', NULL, '1', '3', 1, 1, '2022-02-03', 'Two', '05.00 PM', '07.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:51:16', '0000-00-00 00:00:00', NULL, '1', 1),
(157, 'BKNO-00038', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '3', '1', NULL, '1', '3', 1, 1, '2022-02-04', 'Two', '05.00 PM', '07.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:51:18', '0000-00-00 00:00:00', NULL, '1', 1),
(158, 'BKNO-00039', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '9', '1', NULL, '1', '3', 1, 1, '2022-02-05', 'Two', '08.00 AM', '10.00 AM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:51:21', '0000-00-00 00:00:00', NULL, '1', 1),
(159, 'BKNO-00040', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '6', '1', NULL, '1', '3', 1, 1, '2022-02-01', 'Two', '06.00 PM', '08.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:51:25', '0000-00-00 00:00:00', NULL, '1', 1),
(160, 'BKNO-00041', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '7', '1', NULL, '1', '3', 1, 1, '2022-02-02', 'Two', '06.00 PM', '08.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:51:28', '0000-00-00 00:00:00', NULL, '1', 2),
(161, 'BKNO-00042', '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', '7', '1', NULL, '1', '3', 1, 1, '2022-02-03', 'Two', '06.00 PM', '08.00 PM', 'Pending', 65.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-01-28 07:51:37', '0000-00-00 00:00:00', NULL, '1', 2),
(183, 'BKNO-00048', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', '3', '30', NULL, '1', '1', 1, 1, '2022-02-10', 'Two', '05.00 PM', '07.00 PM', 'Pending', 75.00, 0.00, 0.00, '0', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, '2022-02-09 10:47:05', '0000-00-00 00:00:00', NULL, '26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_no` decimal(10,0) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `role` tinyint(4) NOT NULL COMMENT '1-superadmin, 2-admin, 3-parent,4-coach,5-headcoach',
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `encrypted_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country_id` int(15) NOT NULL DEFAULT '1',
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `date_of_birth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emirates_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `reset_password_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_sent_at` datetime DEFAULT NULL,
  `remember_created_at` datetime DEFAULT NULL,
  `sign_in_count` int(11) NOT NULL DEFAULT '0',
  `current_sign_in_at` datetime DEFAULT NULL,
  `last_sign_in_at` datetime DEFAULT NULL,
  `current_sign_in_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_sign_in_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `confirmation_sent_at` datetime DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `failed_attempts` int(11) NOT NULL DEFAULT '0',
  `unlock_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locked_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_image_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_image_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_image_file_size` int(11) DEFAULT NULL,
  `user_image_updated_at` datetime DEFAULT NULL,
  `passport_image_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_image_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport_image_file_size` int(11) DEFAULT NULL,
  `passport_image_updated_at` datetime DEFAULT NULL,
  `emirates_image_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emirates_image_content_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emirates_image_file_size` int(11) DEFAULT NULL,
  `emirates_image_updated_at` datetime DEFAULT NULL,
  `deleted` int(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `code`, `user_name`, `email`, `encrypted_password`, `role`, `country_id`, `mobile`, `date_of_birth`, `gender`, `emirates_id`, `status`, `reset_password_token`, `reset_password_sent_at`, `remember_created_at`, `sign_in_count`, `current_sign_in_at`, `last_sign_in_at`, `current_sign_in_ip`, `last_sign_in_ip`, `confirmation_token`, `confirmed_at`, `confirmation_sent_at`, `unconfirmed_email`, `failed_attempts`, `unlock_token`, `locked_at`, `created_at`, `updated_at`, `user_image_file_name`, `user_image_content_type`, `user_image_file_size`, `user_image_updated_at`, `passport_image_file_name`, `passport_image_content_type`, `passport_image_file_size`, `passport_image_updated_at`, `emirates_image_file_name`, `emirates_image_content_type`, `emirates_image_file_size`, `emirates_image_updated_at`, `deleted`) VALUES
(1, 'PSADMIN01', 'BMR ', 'bmr.ind@gmail.com', 'prime123', 'superadmin', 0, '121212121212', '1990-01-01', 'Male', NULL, 'Active', NULL, NULL, NULL, 134, '2022-01-31 15:42:01', '2022-01-28 07:45:02', '2.49.117.81', '157.51.2.137', NULL, NULL, NULL, NULL, 0, NULL, NULL, '0000-00-00 00:00:00', '2022-01-05 11:35:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 'PSADMIN02', 'Rajeswari Ravikumar', 'rajeswariravikumar@gmail.com', '', 'superadmin', 1, '2121212121', '1992-01-01', 'Female', NULL, 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 'PSA001', 'Ravikumar', 'bmr.ind@hotmail.com', 'ravi', 'parent', 1, '971501097469', '1974-09-10', 'Male', '784197483047904', 'Active', NULL, NULL, NULL, 5, '2022-02-01 12:02:24', '2022-01-24 16:43:26', '86.98.55.117', '2.49.117.81', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-05 19:19:08', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 'PSA002', 'Karthick', 'srilakshmisundaar@gmail.com', '123', 'Parent', 1, '971552265185', NULL, NULL, '784198658324350', 'Active', NULL, NULL, NULL, 1, '2022-01-22 22:27:04', '2022-01-22 22:36:01', '157.51.26.154', '157.51.26.154', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-06 11:53:21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(5, 'PSA003', 'Simi Rachel', 'rachu13sm@yahoo.com', '', 'Parent', 1, '971552449010', NULL, NULL, '78419829506265', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-06 12:14:28', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(6, 'PSA004', 'Hari Krishnan', 'sreelakshmy.v@gmail.com', '', 'Parent', 1, '971556306307', NULL, NULL, '784198335426869', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-06 12:19:05', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(7, 'PSA005', 'Deepak Dinesh', 'ramyajakka@gmail.com', '', 'Parent', 1, '971555859232', NULL, NULL, '784 19857092344', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-06 12:26:50', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(8, 'PSA006', 'P.P.Raj', 'ppaj1970@gmail.com', '', 'Parent', 1, '971506984616', NULL, NULL, '784197002792642', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-06 12:34:27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(9, 'PSA007', 'Jonald', 'joesun7@gmail.com', '', 'Parent', 1, '971508508876', NULL, NULL, '78419797630876', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-06 12:46:20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(10, 'PSA008', 'raja sekar Ramamoorthy', 'kavithaokm@gmail.com', '', 'Parent', 1, '971555800490', NULL, NULL, '784197967904345', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-06 13:17:08', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(11, 'PSBACH01', 'Raja Sekar', 'rajasekar2503@gmail.com', '', 'coach', 1, '971508109743', '1989-11-25', 'Male', NULL, 'Inactive', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(12, 'PSA009', 'Ajay subhash', 'dubey.ajay@hotmail.com', '', 'Parent', 1, '971507118140', NULL, NULL, '7841983`780368', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-07 09:09:07', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(13, 'PSA010', 'Nivedita', 'niveditashrikent@hotmail.com', '', 'Parent', 1, '97150429830', NULL, NULL, '78419807301373', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-07 09:30:01', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(14, 'PSA011', 'Anand', 'anand158@gmail.com', '', 'Parent', 1, '971508874673', NULL, NULL, '784197840987265', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-07 10:16:39', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(15, 'PSA012', 'Ramkumar', 'f.l@mail.com', '', 'Parent', 1, '971566034384', NULL, NULL, '784197772510406', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-07 10:36:59', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(16, 'PSA013', 'Venkatraman', 'vijisooriya@yahoo.co.in', '', 'Parent', 1, '971561980256', NULL, NULL, '7842390321345', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-07 18:43:56', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(17, 'PSA014', 'Sandeep Kumar', 'sandeep11sandeep@gmail.com', '', 'Parent', 1, '971547019400', NULL, NULL, '984198248683975', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-07 19:39:38', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(18, 'PSA015', 'Seshendra.V', 'mail2seshendra@gmail.com', '', 'Parent', 1, '971565841387', NULL, NULL, '784198156789392', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-08 18:19:24', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(19, 'PSA016', 'Dhamodharan', 'dhamus@yahoo.com', '', 'Parent', 1, '971506614182', NULL, NULL, '78419789532501', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 10:12:11', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(20, 'PSA017', 'Gopal', 'gopalkrishnan.p@gmail.com', '', 'parent', 1, '971508658489', '', NULL, '784197779871041', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 10:28:47', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(21, 'PSA018', 'Fatima Chandan', 'fchandan1010@yahoo.com', '', 'Parent', 1, '971501852624', NULL, NULL, '78419803678981286', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 10:42:06', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(22, 'PSA019', 'Shahid Jiwani', 'reshmajiwani17@gmail.com', '', 'Parent', 1, '971509969410', NULL, NULL, '78420103839587', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 11:37:58', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(23, 'PSA020', 'Lokesh Rao', 'rlokeshrao@gmail.com', '', 'Parent', 1, '971558999007', NULL, NULL, '784197959710231', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 12:30:07', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(24, 'PSA021', 'Raghavan NRS', 'nrsragav@gmail.com', '', 'Parent', 1, '971508189618', NULL, NULL, '784198038219701', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 12:37:35', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(25, 'PSA022', 'Manish Gehani', 'manish_hy@yahoo.com', '', 'Parent', 1, '971503739016', NULL, NULL, '784197740836535', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 14:07:32', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(26, 'PSA023', 'Anju Das', 'anjudas@gmail.com', '123', 'Parent', 1, '971506450578', NULL, NULL, '784197658479074', 'Active', NULL, NULL, NULL, 14, '2022-02-24 11:56:21', '2022-02-09 10:46:14', '157.51.6.47', '157.51.12.207', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 14:18:25', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(27, 'PSA024', 'Rupesh Gawade', 'rupeshgawadegg@gmail.com', '', 'Parent', 1, '971528908498', NULL, NULL, '78419804614141408', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 15:18:59', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(28, 'PSA025', 'Arun Kumar', 'aarun.kumaar@gmail.com', '', 'Parent', 1, '971527485111', NULL, NULL, '7841980762899026', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 15:31:40', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(29, 'PSA026', 'Ranjith.P.V', 'ranjith.pv@gmail.com', '', 'Parent', 1, '971558810744', NULL, NULL, '7841980314024345', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 16:15:19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(30, 'PSA027', 'Tanmay Maheshwari', 'ca.maheshwarig@gmail.com', '', 'Parent', 1, '971501399625', NULL, NULL, '784199046462158', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 16:47:10', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(31, 'PSA028', 'Xavier', 'vanitha.janet@gmail.com', '', 'Parent', 1, '971506827648', NULL, NULL, '784197014384252', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-09 17:13:50', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(32, 'PSA029', 'Sam Joel', 'samjoel80@gmail.com', '', 'Parent', 1, '971552826852', NULL, NULL, '784197901928373', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-10 10:33:35', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(33, 'PSA030', 'Prajna Rao', 'prajnar19@gmail.com', '', 'Parent', 1, '971544770400', NULL, NULL, '784198860281637', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-10 11:00:05', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(34, 'PSA031', 'Krishna', 'krishna.binsuloom@gmail.com', '', 'Parent', 1, '971506761363', NULL, NULL, '78419699205427', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-10 11:07:11', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(35, 'PSA032', 'Pradeep', 'keerthanaa.pradeep@gmail.com', '', 'Parent', 1, '971509057321', NULL, NULL, '784197975432156', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-10 18:37:38', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(36, 'PSA033', 'kannan Ashokkumar', 'tprema.tec@gmail.com', '', 'Parent', 1, '971569033276', NULL, NULL, '784198107971495', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-10 18:46:01', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(37, 'PSA034', 'Manohar', 'mkotian238@gmail.com', '', 'Parent', 1, '971527773586', NULL, NULL, '784198754320', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-10 18:56:07', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(38, 'PSA035', 'Shafeequr Rahman', 'toshafeeq@gmail.com', '', 'Parent', 1, '971501577212', NULL, NULL, '784198404265062', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-10 19:33:30', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(39, 'PSA036', 'Girish', 'preethi.girish@gmail.com', '', 'Parent', 1, '971553609421', NULL, NULL, '784197846018364', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-11 17:23:38', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(40, 'PSA037', 'Vaidhyanathan.V', 'v.vaidhya@outlook.com', '', 'Parent', 1, '971528598183', NULL, NULL, '784197819246097', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-12 18:32:01', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(41, 'PSA038', 'Upendra Kale', 'upendra.kale@petrofac.com', '', 'Parent', 1, '971567562896', NULL, NULL, '7841980701246532', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-13 09:41:35', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(42, 'PSA039', 'Karthick Raj', 'pjennispandian@gmail.com', '', 'Parent', 1, '971564048624', NULL, NULL, '784198319587432', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-13 10:13:26', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(43, 'PSA040', 'Bala subramaniyam', 'jishabalasubramaniyam@gmail.com', '', 'Parent', 1, '97155063883', NULL, NULL, '784201164849578', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-13 10:59:43', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(44, 'PSA041', 'Arnel Suerte', 'nellkarell@gmail.com', '', 'Parent', 1, '971508546029', NULL, NULL, '784198049509791', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-13 11:12:10', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(45, 'PSA042', 'T.S.Kishore', 'kishore.ts@gmail.com', '', 'Parent', 1, '971506759023', NULL, NULL, '784198020937765', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-13 11:51:45', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(46, 'PSA043', 'Xavier', 'xavierlazarwilson@gmail.com', '', 'Parent', 1, '971506827648', NULL, NULL, '784197014384252', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-13 12:10:17', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(47, 'PSA044', 'Anitha Krishna Moorthy', 'anithakrishna81@gmail.com', '', 'Parent', 1, '971503665167', NULL, NULL, '784198079595801', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-13 13:05:44', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(48, 'PSA045', 'Jayasri Narayanan', 'jayashri.suryanarayanan@gmail.com', '', 'Parent', 1, '971525617789', NULL, NULL, '784198524843731', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-14 11:01:50', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(49, 'PSA046', 'Ganesh', 'ganesh.gppnair@gmail.com', '', 'Parent', 1, '971505247201', NULL, NULL, '784197660323631', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-14 11:54:06', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(50, 'PSA047', 'Prabhakar', 'prabvis@gmail.com', '', 'Parent', 1, '971505524571', NULL, NULL, '78419749013713', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-14 12:45:36', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(51, 'PSA048', 'Anish K.S', 'anish.sasi97152dharan@ymail.com', '', 'Parent', 1, '971528241849', NULL, NULL, '784198651739610', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-14 18:56:59', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(52, 'PSSWCH01', 'Francis Segui', 'ranzkylersegui@gmail.com', '', 'headcoach', 1, '971502861686', '1985-12-20', 'Male', NULL, 'Inactive', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(53, 'PSA049', 'Murari Pareek', 'pareek.murari@yahoo.com', '', 'Parent', 1, '971555115850', NULL, NULL, '784198396157913', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-15 11:02:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(54, 'PSSWCH02', 'Marisa', 'marisa@gmail.com', '', 'coach', 1, '971527296540', '1984-10-02', 'Male', NULL, 'Inactive', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(55, 'PSA050', 'Rahul Birari', 'rahulmax07@gmail.com', '', 'Parent', 1, '971569824914', NULL, NULL, '784197951058656', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-18 09:58:21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(56, 'PSA051', 'Anshul singhla', 'anshulsingla@gmail.com', '', 'Parent', 1, '971565384006', NULL, NULL, '784198020183949', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-18 10:23:05', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(57, 'PSA052', 'Lavanya Priya', 'lavanya.franklin@gmail.com', '', 'Parent', 1, '971551027708', NULL, NULL, '78419803912092761', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-20 10:51:22', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(58, 'PSA053', 'Sudeep Mehta', 'sudeepmehta31@gmail.com', '', 'Parent', 1, '971528672989', NULL, NULL, '7841979629841061', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-20 11:22:15', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(59, 'PSA054', 'Vivek Sahu', 'krish.tolani@gmail.com', '', 'Parent', 1, '971555584909', NULL, NULL, '784197801629481', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-20 11:45:21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(60, 'PSA055', 'Mohammed Reza Fazulbhoy', 'safira.emaan@gmail.com', '', 'Parent', 1, '971558724105', NULL, NULL, '784197703592135', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-20 12:05:58', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(61, 'PSA056', 'Suresh Govindaraj', 'sonasuresh07@gmail.com', '', 'Parent', 1, '971503691675', NULL, NULL, '78419760173630182', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-20 12:59:08', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(62, 'PSA057', 'Sanjay Ramdas', 'siresha.sanjay62@gmail.com', '', 'Parent', 1, '971504782578', NULL, NULL, '784197704843909', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-20 17:35:09', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(63, 'PSA058', 'Sulakshan.N', 'ssdv1981@gmail.com', '', 'Parent', 1, '971507935732', NULL, NULL, '78419798202831', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-20 17:43:23', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(64, 'PSA059', 'Zerses Dubash', 'nkhadiwalla@yahoo.com', '', 'Parent', 1, '971529038326', NULL, NULL, '8741979578291037', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-20 18:55:30', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(65, 'PSA060', 'Meesha rajwani', 'anup@rajwaniexports.com', '', 'Parent', 1, '971508039252', '', NULL, '78419783901298', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-20 19:19:33', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(66, 'PSA061', 'Jayaram Jagannathan', 'j_j_ram@yahoo.com', '', 'Parent', 1, '971508497989', NULL, NULL, '784198026591047', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-21 10:59:43', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(67, 'PSA062', 'Pratap Mendonca', 'scytlef@gmail.com', '', 'Parent', 1, '971504953407', NULL, NULL, '784198830195178', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-21 11:48:56', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(68, 'PSA063', 'SANDIP GHANDARI', 'sandip_bhandari@hotmail.com', '', 'Parent', 1, '971506597056', NULL, NULL, '784198074327854', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-21 18:11:07', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(69, 'PSA064', 'S.Ranganathan', 'rangalakshmi@gmail.com', '', 'Parent', 1, '971566789467', NULL, NULL, '784198414050356', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-21 19:33:35', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(70, 'PSA065', 'Badri Ramaswamy', 'erodebadri@gmail.com', '', 'Parent', 1, '971508024976', NULL, NULL, '784198013808799', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 09:12:24', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(71, 'PSA066', 'Sudharshan.G', 'gs.sudarshan@gmail.com', '', 'Parent', 1, '971528936873', NULL, NULL, '784198149872073', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 09:27:17', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(72, 'PSA067', 'Vishnu upadhyay', 'vishnu_kinkar@yahoo.com', '', 'Parent', 1, '971505583725', NULL, NULL, '7841975916404873', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 09:41:51', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(73, 'PSA068', 'Firdous Irani', 'fidzy101@gmail.com', '', 'Parent', 1, '971505505174', NULL, NULL, '7841945012846', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 10:42:02', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(74, 'PSA069', 'Rajamohamed', 'raja.mohamed23@gmail.com', '', 'Parent', 1, '971503191434', NULL, NULL, '78419807102345', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 10:59:42', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(75, 'PSA070', 'Parijat', 'preetiparijat@gmail.com', '', 'Parent', 1, '971543229435', NULL, NULL, '78419744207254', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 11:43:24', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(76, 'PSA071', 'Fehmeena Fahih', 'femfa@yahoo.co.in', '', 'Parent', 1, '971507684671', NULL, NULL, '784197839629769', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 12:28:50', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(77, 'PSA072', 'Naveen', 'quadrosnixon007@gmail.com', '', 'Parent', 1, '971508942899', NULL, NULL, '7841981928345', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 12:33:13', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(78, 'PSA073', 'Pradeep Sakhrani', 'pradeepsakhrani2@gmail.com', '', 'Parent', 1, '971507594023', NULL, NULL, '784197841941756', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 15:14:15', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(79, 'PSA074', 'Sanjay Abichandani', 'sanjay.abichandani79@gmail.com', '', 'Parent', 1, '971501642544', NULL, NULL, '784197901246976', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 15:27:04', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(80, 'PSA075', 'Suresh Muthyala', 'smuthyala@gmail.com', '', 'Parent', 1, '971529293433', NULL, NULL, '784197393104944', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 15:37:20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(81, 'PSA076', 'Nikhil Arora', 'nikhil.11986@gmail.com', '', 'Parent', 1, '971525149169', NULL, NULL, '78419861967435', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-23 16:19:19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(82, 'PSA077', 'Singaravel Ranjan', 's_shrisakthi@yahoo.com', '', 'Parent', 1, '971506442047', NULL, NULL, '784197516519614', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-24 13:45:21', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(83, 'PSA078', 'Suma Unnikrishnan', 'cvunni09@gmail.com', '', 'parent', 1, '971502847204', '', NULL, '784197950287204', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-24 13:58:03', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(84, 'PSA079', 'Hena Fatima', 'maryam.mobeen@gmail.com', '', 'Parent', 1, '971505605170', NULL, NULL, '784198438762134', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-24 17:36:01', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(85, 'PSA080', 'JayaDeep', 'jayadeep.cm@gmail.com', '', 'Parent', 1, '971508556368', NULL, NULL, '7841974153730227', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-24 18:02:47', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(86, 'PSA081', 'Fathima Zulfa', 'shahulhamee@gmail.com', '', 'Parent', 1, '971558492740', NULL, NULL, '7841983176061015', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-26 12:15:15', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(87, 'PSA082', 'Fauzan', 'fauzanjeema@gmail.com', '', 'Parent', 1, '971529459747', NULL, NULL, '78419834287018', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-26 12:32:14', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(88, 'PSA083', 'Chinni', 'garikipati.chinni@gmail.com', '', 'Parent', 1, '971502165359', NULL, NULL, '7841982348701245', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-26 12:39:30', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(89, 'PSA084', 'Sandeep.P', 'ppsandeep@gmail.com', '', 'Parent', 1, '971505507842', NULL, NULL, '784198020865573', 'Active', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-01-26 12:47:27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(90, 'PSADMIN03', 'test', 'nmuthu@jksoftec.com', '123', 'superadmin', 1, '9876543212', '2022-01-04', 'Male', NULL, 'Active', NULL, NULL, NULL, 48, '2022-03-14 09:09:57', '2022-03-04 16:34:55', '106.195.42.58', '157.49.153.20', NULL, NULL, NULL, NULL, 0, NULL, NULL, '0000-00-00 00:00:00', '2022-01-27 16:01:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(91, 'PSA085', 'test parent', 'nvijaymuthumanickam4@gmail.com', '123', 'Parent', 1, '956960061', '2022-01-01', 'Male', NULL, 'Active', NULL, NULL, NULL, 1, '2022-01-27 16:12:29', '2022-01-27 16:17:51', '157.51.2.137', '157.51.2.137', NULL, NULL, NULL, NULL, 0, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(92, 'PSA086', 'Vijay', 'nvijaymuthumanickam@gmail.com', '123', 'Parent', 1, '9566960050', '', NULL, 'ABCDE568787', 'Active', NULL, NULL, NULL, 26, '2022-03-14 09:08:30', '2022-03-07 10:16:28', '106.195.42.58', '157.49.153.20', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-02-01 15:25:24', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(93, 'PSA087', 'Sumathi', 'sumathiseetha3317@gmail.com', '123', 'Parent', 1, '8870883990', '', NULL, 'EID0055', 'Active', NULL, NULL, NULL, 22, '2022-03-04 08:29:07', '2022-03-04 08:19:51', '223.181.220.13', '223.181.220.13', NULL, NULL, NULL, NULL, 0, NULL, NULL, '2022-02-09 10:56:35', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vat_setups`
--

CREATE TABLE `vat_setups` (
  `id` int(11) NOT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `percentage` decimal(10,2) DEFAULT NULL,
  `vat_no` varchar(255) NOT NULL,
  `vat_pdf` text,
  `country_id` int(15) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vat_setups`
--

INSERT INTO `vat_setups` (`id`, `tax`, `description`, `percentage`, `vat_no`, `vat_pdf`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'VAT', 'Vat Tax 5% as per UAE Government', 5.00, '12345', '', 1, '2022-01-06 18:37:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_details`
--

CREATE TABLE `wallet_details` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `name_id` varchar(255) DEFAULT NULL,
  `mobile_id` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `balance_credits` float DEFAULT NULL,
  `amount_paid` float DEFAULT NULL,
  `total_credits` float DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_payment_histories`
--

CREATE TABLE `wallet_payment_histories` (
  `id` int(11) NOT NULL,
  `wallet_transaction_id` varchar(255) DEFAULT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `parent_name` varchar(255) DEFAULT NULL,
  `parent_mobile` varchar(255) DEFAULT NULL,
  `gross_amount` varchar(255) DEFAULT NULL,
  `discount_percentage` varchar(255) DEFAULT NULL,
  `discount_value` varchar(255) DEFAULT NULL,
  `vat_percentage` varchar(255) DEFAULT NULL,
  `vat_value` varchar(255) DEFAULT NULL,
  `refund_percentage` varchar(255) DEFAULT NULL,
  `refund_value` varchar(255) DEFAULT NULL,
  `net_amount` varchar(255) DEFAULT NULL,
  `account_code` varchar(255) DEFAULT NULL,
  `wallet_transaction_date` date DEFAULT NULL,
  `wallet_transaction_type` text,
  `amount` float DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `debit` float DEFAULT NULL,
  `balance_credit` float DEFAULT NULL,
  `amount_paid` float DEFAULT NULL,
  `total_credit` float DEFAULT NULL,
  `wallet_transaction_amount` float DEFAULT NULL,
  `wallet_transaction_detail` varchar(255) DEFAULT NULL,
  `wallet_id` varchar(255) DEFAULT NULL,
  `reg_id` varchar(255) DEFAULT NULL,
  `payfee_id` varchar(255) DEFAULT NULL,
  `slot_req_id` varchar(255) DEFAULT NULL,
  `refund_reason` varchar(255) DEFAULT NULL,
  `updated_admin_name` varchar(255) DEFAULT NULL,
  `updated_admin_email` varchar(255) DEFAULT NULL,
  `updated_date` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_prepaid_credits`
--

CREATE TABLE `wallet_prepaid_credits` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `name_id` varchar(255) DEFAULT NULL,
  `mobile_id` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `balance_credits` float DEFAULT NULL,
  `amount_paid` float DEFAULT NULL,
  `total_credits` float DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` int(11) NOT NULL,
  `wallet_transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_email_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `gross_amount` decimal(10,2) DEFAULT NULL,
  `discount_percentage` decimal(10,2) DEFAULT NULL,
  `discount_value` decimal(10,2) DEFAULT NULL,
  `vat_percentage` decimal(10,2) DEFAULT NULL,
  `vat_value` decimal(10,2) DEFAULT NULL,
  `refund_percentage` decimal(10,2) DEFAULT NULL,
  `refund_value` decimal(10,2) DEFAULT NULL,
  `net_amount` decimal(10,2) DEFAULT NULL,
  `account_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ac_code` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `wallet_transaction_date` date DEFAULT NULL,
  `wallet_transaction_type` text COLLATE utf8_unicode_ci,
  `amount` decimal(10,2) DEFAULT NULL,
  `credit` decimal(10,2) DEFAULT NULL,
  `debit` decimal(10,2) DEFAULT NULL,
  `balance_credit` decimal(10,2) DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `total_credit` decimal(10,2) DEFAULT NULL,
  `wallet_transaction_amount` decimal(10,2) DEFAULT NULL,
  `wallet_transaction_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wallet_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payfee_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_req_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refund_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_admin_id` int(11) NOT NULL,
  `updated_admin_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_admin_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `payment_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_booking_count` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slot_booking` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_invoice_id` int(11) DEFAULT NULL,
  `roll_back_id` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_by_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `wallet_transaction_id`, `student_id`, `parent_id`, `parent_name`, `parent_mobile`, `parent_email_id`, `gross_amount`, `discount_percentage`, `discount_value`, `vat_percentage`, `vat_value`, `refund_percentage`, `refund_value`, `net_amount`, `account_code`, `ac_code`, `wallet_transaction_date`, `wallet_transaction_type`, `amount`, `credit`, `debit`, `balance_credit`, `amount_paid`, `total_credit`, `wallet_transaction_amount`, `wallet_transaction_detail`, `wallet_id`, `reg_id`, `payfee_id`, `slot_req_id`, `refund_reason`, `updated_admin_id`, `updated_admin_name`, `updated_admin_email`, `updated_date`, `description`, `invoice`, `created_at`, `updated_at`, `payment_type`, `bank`, `cheque_number`, `cheque_date`, `invoice_id`, `slot_booking_count`, `slot_booking`, `school_invoice_id`, `roll_back_id`, `updated_by`, `updated_by_name`) VALUES
(1, 'WTXNO-1', NULL, '1', 'Ravikumar', '971501097469', 'bmr.ind@hotmail.com', 1000.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1000.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1000.00, NULL, NULL, NULL, NULL, 1000.00, 'Prepaid credits', NULL, '1', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 12:12:31', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(2, 'WTXNO-2', NULL, '36', 'Girish', '971553609421', 'preethi.girish@gmail.com', 615.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 615.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 615.00, NULL, NULL, NULL, NULL, 615.00, 'Prepaid credits', NULL, '36', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 12:13:55', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(3, 'WTXNO-3', NULL, '35', 'Shafeequr Rahman', '971501577212', 'toshafeeq@gmail.com', 983.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 983.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 983.00, NULL, NULL, NULL, NULL, 983.00, 'Prepaid credits', NULL, '35', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 12:18:24', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(4, 'WTXNO-4', NULL, '34', 'Manohar', '971527773586', 'mkotian238@gmail.com', 237.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 237.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 237.00, NULL, NULL, NULL, NULL, 237.00, 'Prepaid credits', NULL, '34', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 12:21:41', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(5, 'WTXNO-5', NULL, '33', 'kannan Ashokkumar', '971569033276', 'tprema.tec@gmail.com', 983.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 983.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 983.00, NULL, NULL, NULL, NULL, 983.00, 'Prepaid credits', NULL, '33', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 12:22:37', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(6, 'WTXNO-6', NULL, '32', 'Pradeep', '971509057321', 'keerthanaa.pradeep@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '32', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 12:23:49', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(7, 'WTXNO-7', NULL, '31', 'Krishna', '971506761363', 'krishna.binsuloom@gmail.com', 1000.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1000.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1000.00, NULL, NULL, NULL, NULL, 1000.00, 'Prepaid credits', NULL, '31', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 12:25:40', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(8, 'WTXNO-8', NULL, '30', 'Prajna Rao', '971544770400', 'prajnar19@gmail.com', 615.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 615.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 615.00, NULL, NULL, NULL, NULL, 615.00, 'Prepaid credits', NULL, '30', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 12:27:01', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(9, 'WTXNO-9', NULL, '29', 'Sam Joel', '971552826852', 'samjoel80@gmail.com', 1512.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1512.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1512.00, NULL, NULL, NULL, NULL, 1512.00, 'Prepaid credits', NULL, '29', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 12:29:58', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(10, 'WTXNO-10', NULL, '27', 'Tanmay Maheshwari', '971501399625', 'ca.maheshwarig@gmail.com', 399.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 399.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 399.00, NULL, NULL, NULL, NULL, 399.00, 'Prepaid credits', NULL, '27', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:17:08', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(11, 'WTXNO-11', '36', '27', 'Tanmay Maheshwari', '971501399625', '', 100.00, NULL, NULL, 5.00, 5.00, NULL, NULL, 105.00, NULL, 'RFWTR', '2022-01-12', 'Debit', NULL, NULL, 105.00, NULL, NULL, NULL, 100.00, 'Registration Fees', NULL, '27', '1', NULL, NULL, 1, NULL, NULL, NULL, ' Registration Fees', 'yes', '2022-01-12 17:17:40', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-1', NULL, NULL, NULL, 0, NULL, NULL),
(12, 'WTXNO-12', NULL, '26', 'Ranjith.P.V', '971558810744', 'ranjith.pv@gmail.com', 394.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 394.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 394.00, NULL, NULL, NULL, NULL, 394.00, 'Prepaid credits', NULL, '26', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:19:24', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(13, 'WTXNO-13', NULL, '25', 'Arun Kumar', '971527485111', 'aarun.kumaar@gmail.com', 944.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 944.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 944.00, NULL, NULL, NULL, NULL, 944.00, 'Prepaid credits', NULL, '25', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:23:59', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(14, 'WTXNO-14', NULL, '24', 'Rupesh Gawade', '971528908498', 'rupeshgawadegg@gmail.com', 1512.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1512.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1512.00, NULL, NULL, NULL, NULL, 1512.00, 'Prepaid credits', NULL, '24', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:27:04', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(15, 'WTXNO-15', NULL, '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 1107.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1107.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1107.00, NULL, NULL, NULL, NULL, 1107.00, 'Prepaid credits', NULL, '23', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:28:56', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(16, 'WTXNO-16', NULL, '22', 'Manish Gehani', '971503739016', 'manish_hy@yahoo.com', 1050.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1050.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1050.00, NULL, NULL, NULL, NULL, 1050.00, 'Prepaid credits', NULL, '22', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:29:51', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(17, 'WTXNO-17', NULL, '20', 'Lokesh Rao', '971558999007', 'rlokeshrao@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '20', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:36:17', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(18, 'WTXNO-18', NULL, '19', 'Shahid Jiwani', '971509969410', 'reshmajiwani17@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '19', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:37:31', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(19, 'WTXNO-19', NULL, '18', 'Fatima Chandan', '971501852624', 'fchandan1010@yahoo.com', 2646.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 2646.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 2646.00, NULL, NULL, NULL, NULL, 2646.00, 'Prepaid credits', NULL, '18', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:38:55', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(20, 'WTXNO-20', NULL, '17', 'Gopal', '97150865489', 'gopalkrishnan.p@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '17', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:39:27', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(21, 'WTXNO-21', NULL, '16', 'Dhamodharan', '971506614182', 'dhamus@yahoo.com', 315.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 315.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 315.00, NULL, NULL, NULL, NULL, 315.00, 'Prepaid credits', NULL, '16', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:40:22', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(22, 'WTXNO-22', NULL, '12', 'Ramkumar', '971566034384', 'f.l@mail.com', 1052.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1052.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1052.00, NULL, NULL, NULL, NULL, 1052.00, 'Prepaid credits', NULL, '12', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:46:36', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(23, 'WTXNO-23', NULL, '15', 'Seshendra.V', '971565841387', 'mail2seshendra@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '15', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:47:15', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(24, 'WTXNO-24', NULL, '14', 'Sandeep Kumar', '971547019400', 'sandeep11sandeep@gmail.com', 900.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 900.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 900.00, NULL, NULL, NULL, NULL, 900.00, 'Prepaid credits', NULL, '14', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:48:18', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(25, 'WTXNO-25', NULL, '13', 'Venkatraman', '971561980256', 'vijisooriya@yahoo.co.in', 1256.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1256.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1256.00, NULL, NULL, NULL, NULL, 1256.00, 'Prepaid credits', NULL, '13', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:50:38', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(26, 'WTXNO-26', NULL, '11', 'Anand', '971508874673', 'anand158@gmail.com', 1764.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1764.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1764.00, NULL, NULL, NULL, NULL, 1764.00, 'Prepaid credits', NULL, '11', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:54:51', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(27, 'WTXNO-27', NULL, '10', 'Nivedita', '97150429830', 'niveditashrikent@hotmail.com', 1000.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1000.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1000.00, NULL, NULL, NULL, NULL, 1000.00, 'Prepaid credits', NULL, '10', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:55:56', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(28, 'WTXNO-28', NULL, '9', 'Ajay subhash', '971507118140', 'dubey.ajay@hotmail.com', 315.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 315.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 315.00, NULL, NULL, NULL, NULL, 315.00, 'Prepaid credits', NULL, '9', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:56:30', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(29, 'WTXNO-29', NULL, '7', 'Jonald', '971508508876', 'joesun7@gmail.com', 1474.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1474.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1474.00, NULL, NULL, NULL, NULL, 1474.00, 'Prepaid credits', NULL, '7', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:57:59', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(30, 'WTXNO-30', NULL, '6', 'P.P.Raj', '971506984616', 'ppaj1970@gmail.com', 683.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 683.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 683.00, NULL, NULL, NULL, NULL, 683.00, 'Prepaid credits', NULL, '6', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 17:58:56', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(31, 'WTXNO-31', NULL, '5', 'Deepak Dinesh', '971555859232', 'ramyajakka@gmail.com', 1000.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1000.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1000.00, NULL, NULL, NULL, NULL, 1000.00, 'Prepaid credits', NULL, '5', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 18:00:23', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(32, 'WTXNO-32', NULL, '4', 'Hari Krishnan', '971556306307', 'sreelakshmy.v@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '4', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 18:01:31', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(33, 'WTXNO-33', NULL, '3', 'Simi Rachel', '971552449010', 'rachu13sm@yahoo.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '3', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 18:02:05', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(34, 'WTXNO-34', NULL, '2', 'Karthick', '971552265185', 'srilakshmisundaar@gmail.com', 1570.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1570.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1570.00, NULL, NULL, NULL, NULL, 1570.00, 'Prepaid credits', NULL, '2', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 18:03:16', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(35, 'WTXNO-35', NULL, '37', 'Vaidhyanathan.V', '971528598183', 'v.vaidhya@outlook.com', 1175.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1175.00, NULL, 'WCTR', '2022-01-12', 'Credit', NULL, 1175.00, NULL, NULL, NULL, NULL, 1175.00, 'Prepaid credits', NULL, '37', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-12 18:56:13', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(36, 'WTXNO-36', '4', '3', 'Simi Rachel', '971552449010', 'rachu13sm@yahoo.com', 390.00, NULL, NULL, 5.00, 19.50, NULL, NULL, 409.50, NULL, 'SBWT', '2022-01-12', 'Debit', NULL, NULL, 409.50, NULL, NULL, NULL, 409.50, 'Slot Booking Fees', NULL, '4', NULL, NULL, NULL, 3, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-12 19:19:36', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-2', NULL, '1', NULL, 0, NULL, NULL),
(37, 'WTXNO-37', '5', '4', 'Hari Krishnan', '971556306307', 'sreelakshmy.v@gmail.com', 390.00, NULL, NULL, 5.00, 19.50, NULL, NULL, 409.50, NULL, 'SBWT', '2022-01-12', 'Debit', NULL, NULL, 409.50, NULL, NULL, NULL, 409.50, 'Slot Booking Fees', NULL, '5', NULL, NULL, NULL, 4, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-12 19:21:34', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-3', NULL, '2', NULL, 0, NULL, NULL),
(38, 'WTXNO-38', '5', '4', 'Hari Krishnan', '971556306307', 'sreelakshmy.v@gmail.com', 130.00, NULL, NULL, 5.00, 6.50, 0.00, 0.00, 136.50, '1', 'Badminton Trainning', '2022-01-12', 'Debit', NULL, 0.00, 136.50, NULL, NULL, 136.50, 130.00, 'already taken 2 classes in jan balance 6 classes booked', '31', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-12 19:23:10', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-4', NULL, NULL, NULL, 0, NULL, NULL),
(39, 'WTXNO-39', '4', '3', 'Simi Rachel', '971552449010', 'rachu13sm@yahoo.com', 130.00, NULL, NULL, 5.00, 6.50, 0.00, 0.00, 136.50, '1', 'Badminton Trainning', '2022-01-12', 'Debit', NULL, 0.00, 136.50, NULL, NULL, 136.50, 130.00, 'Already taken 2 classes balance 6 classes booked', '32', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-12 19:24:32', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-5', NULL, NULL, NULL, 0, NULL, NULL),
(40, 'WTXNO-40', '6', '5', 'Deepak Dinesh', '971555859232', 'ramyajakka@gmail.com', 520.00, NULL, NULL, 5.00, 26.00, NULL, NULL, 546.00, NULL, 'SBWT', '2022-01-12', 'Debit', NULL, NULL, 546.00, NULL, NULL, NULL, 546.00, 'Slot Booking Fees', NULL, '6', NULL, NULL, NULL, 5, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-12 19:34:24', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-6', NULL, '3', NULL, 0, NULL, NULL),
(41, 'WTXNO-41', '6', '5', 'Deepak Dinesh', '971555859232', 'ramyajakka@gmail.com', 390.00, NULL, NULL, 5.00, 19.50, 0.00, 0.00, 409.50, '1', 'Badminton Trainning', '2022-01-12', 'Debit', NULL, 0.00, 409.50, NULL, NULL, 454.00, 390.00, 'Already taken 6 classes in jan balance 8 classes booked', '30', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-12 19:36:24', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-7', NULL, NULL, NULL, 0, NULL, NULL),
(42, 'WTXNO-42', '7', '6', 'P.P.Raj', '971506984616', 'ppaj1970@gmail.com', 455.00, NULL, NULL, 5.00, 22.75, NULL, NULL, 477.75, NULL, 'SBWT', '2022-01-12', 'Debit', NULL, NULL, 477.75, NULL, NULL, NULL, 477.75, 'Slot Booking Fees', NULL, '7', NULL, NULL, NULL, 6, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-12 19:46:56', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-8', NULL, '4', NULL, 0, NULL, NULL),
(43, 'WTXNO-43', '7', '6', 'P.P.Raj', '971506984616', 'ppaj1970@gmail.com', 195.00, NULL, NULL, 5.00, 9.75, 0.00, 0.00, 204.75, '1', 'Badminton Trainning', '2022-01-12', 'Debit', NULL, 0.00, 204.75, NULL, NULL, 205.25, 195.00, 'paid for 10 classes taken 3 classes balance 7 classes booked', '29', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-12 19:49:23', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-9', NULL, NULL, NULL, 0, NULL, NULL),
(44, 'WTXNO-44', '8', '7', 'Jonald', '971508508876', 'joesun7@gmail.com', 585.00, NULL, NULL, 5.00, 29.25, NULL, NULL, 614.25, NULL, 'SBWT', '2022-01-12', 'Debit', NULL, NULL, 614.25, NULL, NULL, NULL, 614.25, 'Slot Booking Fees', NULL, '8', NULL, NULL, NULL, 7, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-12 20:03:31', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-10', NULL, '5', NULL, 0, NULL, NULL),
(45, 'WTXNO-45', '8', '7', 'Jonald', '971508508876', 'joesun7@gmail.com', 195.00, NULL, NULL, 5.00, 9.75, 0.00, 0.00, 204.75, '1', 'Badminton Trainning', '2022-01-12', 'Debit', NULL, 0.00, 204.75, NULL, NULL, 859.75, 195.00, 'Paid 12 classes  Already taken 3 classes balance 9 classes booked', '28', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-12 20:05:08', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-11', NULL, NULL, NULL, 0, NULL, NULL),
(46, 'WTXNO-46', '9', '7', 'Jonald', '971508508876', 'joesun7@gmail.com', 534.00, 20.00, 118.00, 5.00, 20.80, NULL, NULL, 436.80, NULL, 'SBWT', '2022-01-12', 'Debit', NULL, NULL, 436.80, NULL, NULL, NULL, 436.80, 'Slot Booking Fees Discount', NULL, '9', NULL, NULL, NULL, 7, NULL, NULL, NULL, 'Slot Booking Fees Discount', 'yes', '2022-01-12 20:13:34', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-12', NULL, '6', NULL, 0, NULL, NULL),
(47, 'WTXNO-47', '9', '7', 'Jonald', '971508508876', 'joesun7@gmail.com', 206.00, NULL, NULL, 5.00, 10.30, 0.00, 0.00, 216.30, '1', 'Badminton Trainning', '2022-01-12', 'Debit', NULL, 0.00, 216.30, NULL, NULL, 218.20, 206.00, 'Japheth Paid for 12 classes Already taken 4 classes ', '28', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-12 20:17:04', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-13', NULL, NULL, NULL, 0, NULL, NULL),
(48, 'WTXNO-48', '12', '9', 'Ajay subhash', '971507118140', 'dubey.ajay@hotmail.com', 225.00, NULL, NULL, 5.00, 11.25, NULL, NULL, 236.25, NULL, 'SBWT', '2022-01-12', 'Debit', NULL, NULL, 236.25, NULL, NULL, NULL, 236.25, 'Slot Booking Fees', NULL, '12', NULL, NULL, NULL, 9, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-12 20:19:52', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-14', NULL, '7', NULL, 0, NULL, NULL),
(49, 'WTXNO-49', '12', '9', 'Ajay subhash', '971507118140', 'dubey.ajay@hotmail.com', 75.00, NULL, NULL, 5.00, 3.75, 0.00, 0.00, 78.75, '1', 'Badminton Trainning', '2022-01-12', 'Debit', NULL, 0.00, 78.75, NULL, NULL, 78.75, 75.00, 'Paid for 4 classes Taken 1 classes 3 classes booked', '27', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-12 20:21:49', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-15', NULL, NULL, NULL, 0, NULL, NULL),
(50, 'WTXNO-50', NULL, '38', 'Upendra Kale', '971567562896', 'upendra.kale@petrofac.com', 315.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 315.00, NULL, 'WCTR', '2022-01-13', 'Credit', NULL, 315.00, NULL, NULL, NULL, NULL, 315.00, 'Prepaid credits', NULL, '38', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-13 09:44:58', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(51, 'WTXNO-51', NULL, '39', 'Karthick Raj', '971564048624', 'pjennispandian@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-13', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '39', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-13 10:19:47', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(52, 'WTXNO-52', NULL, '40', 'Bala subramaniyam', '97155063883', 'jishabalasubramaniyam@gmail.com', 394.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 394.00, NULL, 'WCTR', '2022-01-13', 'Credit', NULL, 394.00, NULL, NULL, NULL, NULL, 394.00, 'Prepaid credits', NULL, '40', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-13 11:06:27', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(53, 'WTXNO-53', NULL, '42', 'T.S.Kishore', '971506759023', 'kishore.ts@gmail.com', 2184.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 2184.00, NULL, 'WCTR', '2022-01-13', 'Credit', NULL, 2184.00, NULL, NULL, NULL, NULL, 2184.00, 'Prepaid credits', NULL, '42', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-13 11:59:58', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(54, 'WTXNO-54', NULL, '44', 'Anitha Krishna Moorthy', '971503665167', 'anithakrishna81@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-13', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '44', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-13 13:09:26', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(55, 'WTXNO-55', NULL, '41', 'Arnel Suerte', '971508546029', 'nellkarell@gmail.com', 1050.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1050.00, NULL, 'WCTR', '2022-01-13', 'Credit', NULL, 1050.00, NULL, NULL, NULL, NULL, 1050.00, 'Prepaid credits', NULL, '41', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-13 13:52:56', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(56, 'WTXNO-56', NULL, '43', 'Xavier', '971506827648', 'xavierlazarwilson@gmail.com', 1400.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1400.00, NULL, 'WCTR', '2022-01-13', 'Credit', NULL, 1400.00, NULL, NULL, NULL, NULL, 1400.00, 'Prepaid credits', NULL, '43', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-13 14:47:33', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(57, 'WTXNO-57', '13', '10', 'Nivedita', '97150429830', 'niveditashrikent@hotmail.com', 260.00, NULL, NULL, 5.00, 13.00, 0.00, 0.00, 273.00, '1', 'Badminton Trainning', '2022-01-13', 'Debit', NULL, 0.00, 273.00, NULL, NULL, 1000.00, 260.00, 'Paid Amount 1000 in Jan Dec taken 1 class Jan taken 3 classes till 12th of Jan', '26', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-13 15:05:04', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-16', NULL, NULL, NULL, 0, NULL, NULL),
(58, 'WTXNO-58', '16', '12', 'Ramkumar', '971566034384', 'f.l@mail.com', 335.00, 20.00, 75.00, 5.00, 13.00, NULL, NULL, 273.00, NULL, 'SBWT', '2022-01-13', 'Debit', NULL, NULL, 273.00, NULL, NULL, NULL, 273.00, 'Slot Booking Fees Discount', NULL, '16', NULL, NULL, NULL, 12, NULL, NULL, NULL, 'Slot Booking Fees Discount', 'yes', '2022-01-13 15:26:43', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-17', NULL, '8', NULL, 0, NULL, NULL),
(59, 'WTXNO-59', '16', '12', 'Ramkumar', '971566034384', 'f.l@mail.com', 156.00, NULL, NULL, 5.00, 7.80, 0.00, 0.00, 163.80, '1', 'Badminton Trainning', '2022-01-13', 'Debit', NULL, 0.00, 163.80, NULL, NULL, 779.00, 156.00, 'Paid for 8 classes Already taken 3 classes balance 5 classes booked', '21', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-13 15:28:23', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-18', NULL, NULL, NULL, 0, NULL, NULL),
(60, 'WTXNO-60', '21', '12', 'Ramkumar', '971566034384', 'f.l@mail.com', 390.00, NULL, NULL, 5.00, 19.50, NULL, NULL, 409.50, NULL, 'SBWT', '2022-01-13', 'Debit', NULL, NULL, 409.50, NULL, NULL, NULL, 409.50, 'Slot Booking Fees', NULL, '21', NULL, NULL, NULL, 12, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-13 15:30:42', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-19', NULL, '9', NULL, 0, NULL, NULL),
(61, 'WTXNO-61', '21', '12', 'Ramkumar', '971566034384', 'f.l@mail.com', 195.00, NULL, NULL, 5.00, 9.75, 0.00, 0.00, 204.75, '1', 'Badminton Trainning', '2022-01-13', 'Debit', NULL, 0.00, 204.75, NULL, NULL, 205.70, 195.00, 'Paid for 9 classes Already taken 3 classes Balance 6 classes booked', '21', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-13 15:32:02', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-20', NULL, NULL, NULL, 0, NULL, NULL),
(62, 'WTXNO-62', '17', '13', 'Venkatraman', '971561980256', 'vijisooriya@yahoo.co.in', 480.00, 20.00, 90.00, 5.00, 19.50, NULL, NULL, 409.50, NULL, 'SBWT', '2022-01-14', 'Debit', NULL, NULL, 409.50, NULL, NULL, NULL, 409.50, 'Slot Booking Fees Discount', NULL, '17', NULL, NULL, NULL, 13, NULL, NULL, NULL, 'Slot Booking Fees Discount', 'yes', '2022-01-14 11:19:16', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-21', NULL, '10', NULL, 0, NULL, NULL),
(63, 'WTXNO-63', '17', '13', 'Venkatraman', '971561980256', 'vijisooriya@yahoo.co.in', 26.00, NULL, NULL, 5.00, 1.30, 0.00, 0.00, 27.30, '1', 'Badminton Trainning', '2022-01-14', 'Debit', NULL, 0.00, 27.30, NULL, NULL, 846.50, 26.00, 'Paid for 8 classes taken 2 classes booked 6 classes20% discount Alppicable missed to add in booking', '24', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-14 11:22:49', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-22', NULL, NULL, NULL, 0, NULL, NULL),
(64, 'WTXNO-64', NULL, '45', 'Jayasri Narayanan', '971525617789', 'jayashri.suryanarayanan@gmail.com', 1092.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1092.00, NULL, 'WCTR', '2022-01-14', 'Credit', NULL, 1092.00, NULL, NULL, NULL, NULL, 1092.00, 'Prepaid credits', NULL, '45', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-14 11:30:30', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(65, 'WTXNO-65', NULL, '46', 'Ganesh', '971505247201', 'ganesh.gppnair@gmail.com', 614.25, NULL, NULL, 0.00, 0.00, NULL, NULL, 614.25, NULL, 'WCTR', '2022-01-14', 'Credit', NULL, 614.25, NULL, NULL, NULL, NULL, 614.25, 'Prepaid credits', NULL, '46', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-14 12:05:01', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(66, 'WTXNO-66', NULL, '47', 'Prabhakar', '971505524571', 'prabvis@gmail.com', 1092.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1092.00, NULL, 'WCTR', '2022-01-14', 'Credit', NULL, 1092.00, NULL, NULL, NULL, NULL, 1092.00, 'Prepaid credits', NULL, '47', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-14 12:52:55', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(67, 'WTXNO-67', '18', '13', 'Venkatraman', '971561980256', 'vijisooriya@yahoo.co.in', 390.00, NULL, NULL, 5.00, 19.50, NULL, NULL, 409.50, NULL, 'SBWT', '2022-01-14', 'Debit', NULL, NULL, 409.50, NULL, NULL, NULL, 409.50, 'Slot Booking Fees', NULL, '18', NULL, NULL, NULL, 13, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-14 17:32:26', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-23', NULL, '11', NULL, 0, NULL, NULL),
(68, 'WTXNO-68', '18', '13', 'Venkatraman', '971561980256', 'vijisooriya@yahoo.co.in', 390.00, NULL, NULL, 5.00, 19.50, 0.00, 0.00, 409.50, '1', 'Badminton Trainning', '2022-01-14', 'Debit', NULL, 0.00, 409.50, NULL, NULL, 409.70, 390.00, 'Ka - Badminton Paid for 12 classes Already taken 6 classes Balance 6 classes booked', '24', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-14 17:37:23', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-24', NULL, NULL, NULL, 0, NULL, NULL),
(69, 'WTXNO-69', '19', '14', 'Sandeep Kumar', '971547019400', 'sandeep11sandeep@gmail.com', 585.00, NULL, NULL, 5.00, 29.25, NULL, NULL, 614.25, NULL, 'SBWT', '2022-01-14', 'Debit', NULL, NULL, 614.25, NULL, NULL, NULL, 614.25, 'Slot Booking Fees', NULL, '19', NULL, NULL, NULL, 14, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-14 17:40:59', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-25', NULL, '12', NULL, 0, NULL, NULL),
(70, 'WTXNO-70', '19', '14', 'Sandeep Kumar', '971547019400', 'sandeep11sandeep@gmail.com', 130.00, NULL, NULL, 5.00, 6.50, 0.00, 0.00, 136.50, '1', 'Badminton Trainning', '2022-01-14', 'Debit', NULL, 0.00, 136.50, NULL, NULL, 285.75, 130.00, 'Ka - Badminton   paid for 12 classes taken 2 classes booked 9 classes ', '23', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-14 17:44:02', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-26', NULL, NULL, NULL, 0, NULL, NULL),
(71, 'WTXNO-71', '20', '15', 'Seshendra.V', '971565841387', 'mail2seshendra@gmail.com', 325.00, NULL, NULL, 5.00, 16.25, NULL, NULL, 341.25, NULL, 'SBWT', '2022-01-14', 'Debit', NULL, NULL, 341.25, NULL, NULL, NULL, 341.25, 'Slot Booking Fees', NULL, '20', NULL, NULL, NULL, 15, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-14 17:51:10', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-27', NULL, '13', NULL, 0, NULL, NULL),
(72, 'WTXNO-72', '20', '15', 'Seshendra.V', '971565841387', 'mail2seshendra@gmail.com', 195.00, NULL, NULL, 5.00, 9.75, 0.00, 0.00, 204.75, '1', 'Badminton Trainning', '2022-01-14', 'Debit', NULL, 0.00, 204.75, NULL, NULL, 204.75, 195.00, ' Ka -Badminton Paid for 8 classes  taken 3 classes balance 5 classes booked', '22', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-14 17:54:09', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-28', NULL, NULL, NULL, 0, NULL, NULL),
(73, 'WTXNO-73', NULL, '48', 'Anish K.S', '971528241849', 'anish.sasi97152dharan@ymail.com', 700.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 700.00, NULL, 'WCTR', '2022-01-14', 'Credit', NULL, 700.00, NULL, NULL, NULL, NULL, 700.00, 'Prepaid credits', NULL, '48', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-14 19:22:41', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(74, 'WTXNO-74', NULL, '49', 'Murari Pareek', '971555115850', 'pareek.murari@yahoo.com', 500.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 500.00, NULL, 'WCTR', '2022-01-15', 'Credit', NULL, 500.00, NULL, NULL, NULL, NULL, 500.00, 'Prepaid credits', NULL, '49', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-15 11:06:14', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(75, 'WTXNO-75', '22', '16', 'Dhamodharan', '971506614182', 'dhamus@yahoo.com', 150.00, NULL, NULL, 5.00, 7.50, NULL, NULL, 157.50, NULL, 'SBWT', '2022-01-17', 'Debit', NULL, NULL, 157.50, NULL, NULL, NULL, 157.50, 'Slot Booking Fees', NULL, '22', NULL, NULL, NULL, 16, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-17 19:22:17', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-29', NULL, '14', NULL, 0, NULL, NULL),
(76, 'WTXNO-76', '22', '16', 'Dhamodharan', '971506614182', 'dhamus@yahoo.com', 150.00, NULL, NULL, 5.00, 7.50, 0.00, 0.00, 157.50, '1', 'Badminton Trainning', '2022-01-17', 'Debit', NULL, 0.00, 157.50, NULL, NULL, 157.50, 150.00, 'PAID FOR 4 CLASSSES IN JAN taken 2 classes balance 2 classes booked', '20', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-17 19:23:52', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-30', NULL, NULL, NULL, 0, NULL, NULL),
(77, 'WTXNO-77', '23', '17', 'Gopal', '97150865489', 'gopalkrishnan.p@gmail.com', 260.00, NULL, NULL, 5.00, 13.00, NULL, NULL, 273.00, NULL, 'SBWT', '2022-01-17', 'Debit', NULL, NULL, 273.00, NULL, NULL, NULL, 273.00, 'Slot Booking Fees', NULL, '23', NULL, NULL, NULL, 17, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-17 19:26:50', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-31', NULL, '15', NULL, 0, NULL, NULL),
(78, 'WTXNO-78', '23', '17', 'Gopal', '97150865489', 'gopalkrishnan.p@gmail.com', 260.00, NULL, NULL, 5.00, 13.00, 0.00, 0.00, 273.00, '1', 'Badminton Trainning', '2022-01-17', 'Debit', NULL, 0.00, 273.00, NULL, NULL, 273.00, 260.00, 'Ka - Badminton paid for 8 classes taken 4 classes balance 4 classes  booked', '19', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-17 19:29:13', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-32', NULL, NULL, NULL, 0, NULL, NULL),
(79, 'WTXNO-79', '26', '19', 'Shahid Jiwani', '971509969410', 'reshmajiwani17@gmail.com', 260.00, NULL, NULL, 5.00, 13.00, NULL, NULL, 273.00, NULL, 'SBWT', '2022-01-17', 'Debit', NULL, NULL, 273.00, NULL, NULL, NULL, 273.00, 'Slot Booking Fees', NULL, '26', NULL, NULL, NULL, 19, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-17 19:40:26', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-33', NULL, '16', NULL, 0, NULL, NULL),
(80, 'WTXNO-80', '26', '19', 'Shahid Jiwani', '971509969410', 'reshmajiwani17@gmail.com', 260.00, NULL, NULL, 5.00, 13.00, 0.00, 0.00, 273.00, '1', 'Badminton Trainning', '2022-01-17', 'Debit', NULL, 0.00, 273.00, NULL, NULL, 273.00, 260.00, 'Paid for 8 classes taken 4 classes balance 4 classes booked', '17', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-17 19:42:27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-34', NULL, NULL, NULL, 0, NULL, NULL),
(81, 'WTXNO-81', '27', '20', 'Lokesh Rao', '971558999007', 'rlokeshrao@gmail.com', 260.00, NULL, NULL, 5.00, 13.00, NULL, NULL, 273.00, NULL, 'SBWT', '2022-01-17', 'Debit', NULL, NULL, 273.00, NULL, NULL, NULL, 273.00, 'Slot Booking Fees', NULL, '27', NULL, NULL, NULL, 20, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-17 19:44:32', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-35', NULL, '17', NULL, 0, NULL, NULL),
(82, 'WTXNO-82', '27', '20', 'Lokesh Rao', '971558999007', 'rlokeshrao@gmail.com', 260.00, NULL, NULL, 5.00, 13.00, 0.00, 0.00, 273.00, '1', 'Badminton Trainning', '2022-01-17', 'Debit', NULL, 0.00, 273.00, NULL, NULL, 273.00, 260.00, 'Paid for 8 classes taken 4 classes balance 4 classes booked', '16', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-17 19:46:03', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-36', NULL, NULL, NULL, 0, NULL, NULL),
(83, 'WTXNO-83', '29', '22', 'Manish Gehani', '971503739016', 'manish_hy@yahoo.com', 540.00, NULL, NULL, 5.00, 27.00, NULL, NULL, 567.00, NULL, 'SBWT', '2022-01-17', 'Debit', NULL, NULL, 567.00, NULL, NULL, NULL, 567.00, 'Slot Booking Fees', NULL, '29', NULL, NULL, NULL, 22, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-17 20:00:13', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-37', NULL, '18', NULL, 0, NULL, NULL),
(84, 'WTXNO-84', NULL, '22', 'Manish Gehani', '971503739016', 'manish_hy@yahoo.com', 84.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 84.00, NULL, 'WCTR', '2022-01-17', 'Credit', NULL, 84.00, NULL, NULL, NULL, NULL, 84.00, 'Prepaid credits', NULL, '22', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-17 20:01:52', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(85, 'WTXNO-85', '29', '22', 'Manish Gehani', '971503739016', 'manish_hy@yahoo.com', 540.00, NULL, NULL, 5.00, 27.00, 0.00, 0.00, 567.00, '2', 'Swimming Trainning', '2022-01-17', 'Debit', NULL, 0.00, 567.00, NULL, NULL, 567.00, 540.00, 'Paid for 12 classes taken 6 classes balance 6 classes booked', '15', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-17 20:03:33', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-38', NULL, NULL, NULL, 0, NULL, NULL),
(86, 'WTXNO-86', '30', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 260.00, NULL, NULL, 5.00, 13.00, NULL, NULL, 273.00, NULL, 'SBWT', '2022-01-17', 'Debit', NULL, NULL, 273.00, NULL, NULL, NULL, 273.00, 'Slot Booking Fees', NULL, '30', NULL, NULL, NULL, 23, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-17 20:06:56', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-39', NULL, '19', NULL, 0, NULL, NULL),
(87, 'WTXNO-87', '31', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 300.00, 20.00, 60.00, 5.00, 12.00, NULL, NULL, 252.00, NULL, 'SBWT', '2022-01-17', 'Debit', NULL, NULL, 252.00, NULL, NULL, NULL, 252.00, 'Slot Booking Fees Discount', NULL, '31', NULL, NULL, NULL, 23, NULL, NULL, NULL, 'Slot Booking Fees Discount', 'yes', '2022-01-17 20:08:44', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-40', NULL, '20', NULL, 0, NULL, NULL),
(88, 'WTXNO-88', '31', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 60.00, NULL, NULL, 5.00, 3.00, NULL, NULL, 60.00, NULL, 'REFWTR', '2022-01-29', 'Credit', NULL, 60.00, NULL, NULL, NULL, NULL, 60.00, 'Slot Refund Fees', NULL, '23', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Slot Refund Fees', NULL, '2022-01-17 20:13:02', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '111', NULL, 0, NULL, NULL),
(89, 'WTXNO-89', '31', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 60.00, NULL, NULL, 5.00, 3.00, NULL, NULL, 60.00, NULL, 'REFWTR', '2022-01-22', 'Credit', NULL, 60.00, NULL, NULL, NULL, NULL, 60.00, 'Slot Refund Fees', NULL, '23', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Slot Refund Fees', NULL, '2022-01-17 20:13:12', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '109', NULL, 0, NULL, NULL),
(90, 'WTXNO-90', '31', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 60.00, NULL, NULL, 5.00, 3.00, NULL, NULL, 60.00, NULL, 'REFWTR', '2022-01-23', 'Credit', NULL, 60.00, NULL, NULL, NULL, NULL, 60.00, 'Slot Refund Fees', NULL, '23', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Slot Refund Fees', NULL, '2022-01-17 20:13:20', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '110', NULL, 0, NULL, NULL),
(91, 'WTXNO-91', '31', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 60.00, NULL, NULL, 5.00, 3.00, NULL, NULL, 60.00, NULL, 'REFWTR', '2022-01-30', 'Credit', NULL, 60.00, NULL, NULL, NULL, NULL, 60.00, 'Slot Refund Fees', NULL, '23', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Slot Refund Fees', NULL, '2022-01-17 20:13:29', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '112', NULL, 0, NULL, NULL),
(92, 'WTXNO-92', '31', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 268.00, 20.00, 60.00, 5.00, 10.40, NULL, NULL, 218.40, NULL, 'SBWT', '2022-01-17', 'Debit', NULL, NULL, 218.40, NULL, NULL, NULL, 218.40, 'Slot Booking Fees Discount', NULL, '31', NULL, NULL, NULL, 23, NULL, NULL, NULL, 'Slot Booking Fees Discount', 'yes', '2022-01-17 20:17:24', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-41', NULL, '21', NULL, 0, NULL, NULL),
(93, 'WTXNO-93', '30', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 325.00, NULL, NULL, 5.00, 16.25, 0.00, 0.00, 341.25, '1', 'Badminton Trainning', '2022-01-17', 'Debit', NULL, 0.00, 341.25, NULL, NULL, 603.60, 325.00, 'Paid for 9 classes Dec 1 class 4 classes taken 4 classes booked', '14', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-17 20:23:56', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-42', NULL, NULL, NULL, 0, NULL, NULL),
(94, 'WTXNO-94', '31', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 249.00, NULL, NULL, 5.00, 12.45, 0.00, 0.00, 261.45, '1', 'Badminton Trainning', '2022-01-17', 'Debit', NULL, 0.00, 261.45, NULL, NULL, 262.35, 249.00, 'Paid for 9 classes taken 1 class in Dec taken 4 classes in Jan balance 4 classes booked', '14', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-17 20:32:56', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-43', NULL, NULL, NULL, 0, NULL, NULL),
(95, 'WTXNO-95', NULL, '50', 'Rahul Birari', '971569824914', 'rahulmax07@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-18', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '50', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-18 10:05:16', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(96, 'WTXNO-96', NULL, '17', 'Gopal', '97150865489', 'gopalkrishnan.p@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-18', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '17', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-18 11:22:42', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(97, 'WTXNO-97', '35', '26', 'Ranjith.P.V', '971558810744', 'ranjith.pv@gmail.com', 150.00, NULL, NULL, 5.00, 7.50, NULL, NULL, 157.50, NULL, 'SBWT', '2022-01-18', 'Debit', NULL, NULL, 157.50, NULL, NULL, NULL, 157.50, 'Slot Booking Fees', NULL, '35', NULL, NULL, NULL, 26, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-18 11:44:51', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-44', NULL, '22', NULL, 0, NULL, NULL),
(98, 'WTXNO-98', '35', '26', 'Ranjith.P.V', '971558810744', 'ranjith.pv@gmail.com', 225.00, NULL, NULL, 5.00, 11.25, 0.00, 0.00, 236.25, '1', 'Badminton Trainning', '2022-01-18', 'Debit', NULL, 0.00, 236.25, NULL, NULL, 236.50, 225.00, 'ka - Badminton Paid for 5 classes already taken 3 classes balance 2 classes booked', '11', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-18 11:47:56', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-45', NULL, NULL, NULL, 0, NULL, NULL),
(99, 'WTXNO-99', '39', '30', 'Prajna Rao', '971544770400', 'prajnar19@gmail.com', 260.00, NULL, NULL, 5.00, 13.00, NULL, NULL, 273.00, NULL, 'SBWT', '2022-01-18', 'Debit', NULL, NULL, 273.00, NULL, NULL, NULL, 273.00, 'Slot Booking Fees', NULL, '39', NULL, NULL, NULL, 30, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-18 12:03:31', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-46', NULL, '23', NULL, 0, NULL, NULL),
(100, 'WTXNO-100', '39', '30', 'Prajna Rao', '971544770400', 'prajnar19@gmail.com', 325.00, NULL, NULL, 5.00, 16.25, 0.00, 0.00, 341.25, '1', 'Badminton Trainning', '2022-01-18', 'Debit', NULL, 0.00, 341.25, NULL, NULL, 342.00, 325.00, 'Ka - B  Paid for 9 classes  already taken 5 classes booked 4 classes', '8', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-18 12:06:49', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-47', NULL, NULL, NULL, 0, NULL, NULL),
(101, 'WTXNO-101', '41', '32', 'Pradeep', '971509057321', 'keerthanaa.pradeep@gmail.com', 130.00, NULL, NULL, 5.00, 6.50, NULL, NULL, 136.50, NULL, 'SBWT', '2022-01-18', 'Debit', NULL, NULL, 136.50, NULL, NULL, NULL, 136.50, 'Slot Booking Fees', NULL, '41', NULL, NULL, NULL, 32, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-18 12:23:29', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-48', NULL, '24', NULL, 0, NULL, NULL),
(102, 'WTXNO-102', '41', '32', 'Pradeep', '971509057321', 'keerthanaa.pradeep@gmail.com', 390.00, NULL, NULL, 5.00, 19.50, 0.00, 0.00, 409.50, '1', 'Badminton Trainning', '2022-01-18', 'Debit', NULL, 0.00, 409.50, NULL, NULL, 409.50, 390.00, 'Ka - Badminton  Paid for 546 already taken nov 1 class & Jan 5 classes Balance 2 classes booked', '6', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-18 12:27:51', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-49', NULL, NULL, NULL, 0, NULL, NULL),
(103, 'WTXNO-103', '42', '33', 'kannan Ashokkumar', '971569033276', 'tprema.tec@gmail.com', 195.00, NULL, NULL, 5.00, 9.75, NULL, NULL, 204.75, NULL, 'SBWT', '2022-01-18', 'Debit', NULL, NULL, 204.75, NULL, NULL, NULL, 204.75, 'Slot Booking Fees', NULL, '42', NULL, NULL, NULL, 33, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-01-18 12:45:55', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-50', NULL, '25', NULL, 0, NULL, NULL),
(104, 'WTXNO-104', '42', '33', 'kannan Ashokkumar', '971569033276', 'tprema.tec@gmail.com', 325.00, NULL, NULL, 5.00, 16.25, 0.00, 0.00, 341.25, '1', 'Badminton Trainning', '2022-01-18', 'Debit', NULL, 0.00, 341.25, NULL, NULL, 778.25, 325.00, 'Ka - Badminton Paid for 8 classes taken 5 classes balance 3 classes booked', '5', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-18 12:49:23', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-51', NULL, NULL, NULL, 0, NULL, NULL),
(105, 'WTXNO-105', '43', '33', 'kannan Ashokkumar', '971569033276', 'tprema.tec@gmail.com', 201.00, 20.00, 45.00, 5.00, 7.80, NULL, NULL, 163.80, NULL, 'SBWT', '2022-01-18', 'Debit', NULL, NULL, 163.80, NULL, NULL, NULL, 163.80, 'Slot Booking Fees Discount', NULL, '43', NULL, NULL, NULL, 33, NULL, NULL, NULL, 'Slot Booking Fees Discount', 'yes', '2022-01-18 12:55:06', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-52', NULL, '26', NULL, 0, NULL, NULL),
(106, 'WTXNO-106', '43', '33', 'kannan Ashokkumar', '971569033276', 'tprema.tec@gmail.com', 260.00, NULL, NULL, 5.00, 13.00, 0.00, 0.00, 273.00, '1', 'Badminton Trainning', '2022-01-18', 'Debit', NULL, 0.00, 273.00, NULL, NULL, 273.20, 260.00, 'Ka - badminton Pqid for 8 classes taken 5 classes balance 3 classes booked', '5', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'yes', '2022-01-18 12:56:33', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-53', NULL, NULL, NULL, 0, NULL, NULL),
(107, 'WTXNO-107', NULL, '55', 'Mohammed Reza Fazulbhoy', '971558724105', 'safira.emaan@gmail.com', 1000.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1000.00, NULL, 'WCTR', '2022-01-20', 'Credit', NULL, 1000.00, NULL, NULL, NULL, NULL, 1000.00, 'Prepaid credits', NULL, '55', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-20 12:11:10', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(108, 'WTXNO-108', NULL, '54', 'Vivek Sahu', '971555584909', 'krish.tolani@gmail.com', 629.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 629.00, NULL, 'WCTR', '2022-01-20', 'Credit', NULL, 629.00, NULL, NULL, NULL, NULL, 629.00, 'Prepaid credits', NULL, '54', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-20 12:16:03', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(109, 'WTXNO-109', NULL, '53', 'Sudeep Mehta', '971528672989', 'sudeepmehta31@gmail.com', 983.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 983.00, NULL, 'WCTR', '2022-01-20', 'Credit', NULL, 983.00, NULL, NULL, NULL, NULL, 983.00, 'Prepaid credits', NULL, '53', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-20 12:18:24', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(110, 'WTXNO-110', NULL, '52', 'Lavanya Priya', '971551027708', 'lavanya.franklin@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-20', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '52', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-20 12:20:02', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(111, 'WTXNO-111', NULL, '58', 'Sulakshan.N', '971507935732', 'ssdv1981@gmail.com', 1107.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1107.00, NULL, 'WCTR', '2022-01-20', 'Credit', NULL, 1107.00, NULL, NULL, NULL, NULL, 1107.00, 'Prepaid credits', NULL, '58', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-20 18:02:31', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL);
INSERT INTO `wallet_transactions` (`id`, `wallet_transaction_id`, `student_id`, `parent_id`, `parent_name`, `parent_mobile`, `parent_email_id`, `gross_amount`, `discount_percentage`, `discount_value`, `vat_percentage`, `vat_value`, `refund_percentage`, `refund_value`, `net_amount`, `account_code`, `ac_code`, `wallet_transaction_date`, `wallet_transaction_type`, `amount`, `credit`, `debit`, `balance_credit`, `amount_paid`, `total_credit`, `wallet_transaction_amount`, `wallet_transaction_detail`, `wallet_id`, `reg_id`, `payfee_id`, `slot_req_id`, `refund_reason`, `updated_admin_id`, `updated_admin_name`, `updated_admin_email`, `updated_date`, `description`, `invoice`, `created_at`, `updated_at`, `payment_type`, `bank`, `cheque_number`, `cheque_date`, `invoice_id`, `slot_booking_count`, `slot_booking`, `school_invoice_id`, `roll_back_id`, `updated_by`, `updated_by_name`) VALUES
(112, 'WTXNO-112', NULL, '59', 'Zerses Dubash', '971529038326', 'nkhadiwalla@yahoo.com', 1606.50, NULL, NULL, 0.00, 0.00, NULL, NULL, 1606.50, NULL, 'WCTR', '2022-01-20', 'Credit', NULL, 1606.50, NULL, NULL, NULL, NULL, 1606.50, 'Prepaid credits', NULL, '59', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-20 18:59:54', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(113, 'WTXNO-113', NULL, '61', 'Jayaram Jagannathan', '971508497989', 'j_j_ram@yahoo.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-21', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '61', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-21 11:08:15', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(114, 'WTXNO-114', NULL, '62', 'Pratap Mendonca', '971504953407', 'scytlef@gmail.com', 600.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 600.00, NULL, 'WCTR', '2022-01-21', 'Credit', NULL, 600.00, NULL, NULL, NULL, NULL, 600.00, 'Prepaid credits', NULL, '62', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-21 13:31:04', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(115, 'WTXNO-115', NULL, '64', 'S.Ranganathan', '971566789467', 'rangalakshmi@gmail.com', 1105.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1105.00, NULL, 'WCTR', '2022-01-21', 'Credit', NULL, 1105.00, NULL, NULL, NULL, NULL, 1105.00, 'Prepaid credits', NULL, '64', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-21 19:49:06', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(116, 'WTXNO-116', NULL, '60', 'Meesha rajwani', '971508039252', 'anup@rajwaniexports.com', 368.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 368.00, NULL, 'WCTR', '2022-01-21', 'Credit', NULL, 368.00, NULL, NULL, NULL, NULL, 368.00, 'Prepaid credits', NULL, '60', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-21 19:57:18', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(117, 'WTXNO-117', NULL, '66', 'Sudharshan.G', '971528936873', 'gs.sudarshan@gmail.com', 1000.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1000.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 1000.00, NULL, NULL, NULL, NULL, 1000.00, 'Prepaid credits', NULL, '66', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 09:53:08', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(118, 'WTXNO-118', NULL, '8', 'raja sekar Ramamoorthy', '971555800490', 'kavithaokm@gmail.com', 1160.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1160.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 1160.00, NULL, NULL, NULL, NULL, 1160.00, 'Prepaid credits', NULL, '8', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 16:23:46', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(119, 'WTXNO-119', NULL, '73', 'Pradeep Sakhrani', '971507594023', 'pradeepsakhrani2@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '73', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 16:24:39', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(120, 'WTXNO-120', NULL, '72', 'Naveen', '971508942899', 'quadrosnixon007@gmail.com', 546.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 546.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 546.00, NULL, NULL, NULL, NULL, 546.00, 'Prepaid credits', NULL, '72', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 16:25:07', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(121, 'WTXNO-121', NULL, '71', 'Fehmeena Fahih', '971507684671', 'femfa@yahoo.co.in', 651.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 651.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 651.00, NULL, NULL, NULL, NULL, 651.00, 'Prepaid credits', NULL, '71', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 16:26:25', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(122, 'WTXNO-122', NULL, '49', 'Murari Pareek', '971555115850', 'pareek.murari@yahoo.com', 46.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 46.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 46.00, NULL, NULL, NULL, NULL, 46.00, 'Prepaid credits', NULL, '49', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 16:30:38', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(123, 'WTXNO-123', NULL, '70', 'Parijat', '971543229435', 'preetiparijat@gmail.com', 700.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 700.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 700.00, NULL, NULL, NULL, NULL, 700.00, 'Prepaid credits', NULL, '70', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 16:32:12', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(124, 'WTXNO-124', NULL, '69', 'Rajamohamed', '971503191434', 'raja.mohamed23@gmail.com', 700.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 700.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 700.00, NULL, NULL, NULL, NULL, 700.00, 'Prepaid credits', NULL, '69', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 16:33:02', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(125, 'WTXNO-125', NULL, '68', 'Firdous Irani', '971505505174', 'fidzy101@gmail.com', 1200.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1200.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 1200.00, NULL, NULL, NULL, NULL, 1200.00, 'Prepaid credits', NULL, '68', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 16:36:12', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(126, 'WTXNO-126', NULL, '67', 'Vishnu upadhyay', '971505583725', 'vishnu_kinkar@yahoo.com', 683.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 683.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 683.00, NULL, NULL, NULL, NULL, 683.00, 'Prepaid credits', NULL, '67', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 16:42:22', '0000-00-00 00:00:00', 'Online', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(127, 'WTXNO-127', NULL, '17', 'Gopal', '97150865489', 'gopalkrishnan.p@gmail.com', 500.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 500.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 500.00, NULL, NULL, NULL, NULL, 500.00, 'Prepaid credits', NULL, '17', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 17:02:13', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(128, 'WTXNO-128', NULL, '56', 'Suresh Govindaraj', '971503691675', 'sonasuresh07@gmail.com', 550.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 550.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 550.00, NULL, NULL, NULL, NULL, 550.00, 'Prepaid credits', NULL, '56', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 17:51:44', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(129, 'WTXNO-129', NULL, '57', 'Sanjay Ramdas', '971504782578', 'siresha.sanjay62@gmail.com', 1000.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1000.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 1000.00, NULL, NULL, NULL, NULL, 1000.00, 'Prepaid credits', NULL, '57', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 17:54:23', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(130, 'WTXNO-130', NULL, '51', 'Anshul singhla', '971565384006', 'anshulsingla@gmail.com', 651.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 651.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 651.00, NULL, NULL, NULL, NULL, 651.00, 'Prepaid credits', NULL, '51', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 17:56:55', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(131, 'WTXNO-131', '77', '51', 'Anshul singhla', '971565384006', '', 100.00, NULL, NULL, 5.00, 5.00, NULL, NULL, 105.00, NULL, 'RFWTR', '2022-01-23', 'Debit', NULL, NULL, 105.00, NULL, NULL, NULL, 100.00, 'Registration Fees', NULL, '51', '2', NULL, NULL, 1, NULL, NULL, NULL, ' Registration Fees', 'yes', '2022-01-23 17:57:28', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-54', NULL, NULL, NULL, 0, NULL, NULL),
(132, 'WTXNO-132', '95', '71', 'Fehmeena Fahih', '971507684671', '', 100.00, NULL, NULL, 5.00, 5.00, NULL, NULL, 105.00, NULL, 'RFWTR', '2022-01-23', 'Debit', NULL, NULL, 105.00, NULL, NULL, NULL, 100.00, 'Registration Fees', NULL, '71', '3', NULL, NULL, 1, NULL, NULL, NULL, ' Registration Fees', 'yes', '2022-01-23 17:57:42', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-55', NULL, NULL, NULL, 0, NULL, NULL),
(133, 'WTXNO-133', NULL, '74', 'Sanjay Abichandani', '971501642544', 'sanjay.abichandani79@gmail.com', 683.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 683.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 683.00, NULL, NULL, NULL, NULL, 683.00, 'Prepaid credits', NULL, '74', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 18:00:44', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(134, 'WTXNO-134', NULL, '65', 'Badri Ramaswamy', '971508024976', 'erodebadri@gmail.com', 1445.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1445.00, NULL, 'WCTR', '2022-01-23', 'Credit', NULL, 1445.00, NULL, NULL, NULL, NULL, 1445.00, 'Prepaid credits', NULL, '65', NULL, NULL, NULL, 1, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-01-23 18:04:10', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(135, 'WTXNO-135', '30', '23', 'Anju Das', '971506450578', 'anjudas@gmail.com', 0.10, NULL, NULL, 5.00, 0.01, NULL, NULL, 0.11, NULL, 'SBWT', '2022-02-01', 'Debit', NULL, NULL, 0.11, NULL, NULL, NULL, 0.11, 'Slot Booking Fees', NULL, '30', NULL, NULL, NULL, 23, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-01 12:08:35', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-56', NULL, '27', NULL, 0, NULL, NULL),
(136, 'WTXNO-136', NULL, '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 1000.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1000.00, NULL, 'WCTR', '2022-02-01', 'Credit', NULL, 1000.00, NULL, NULL, NULL, NULL, 1000.00, 'Prepaid credits', NULL, '86', NULL, NULL, NULL, 90, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-02-01 22:58:05', '0000-00-00 00:00:00', 'Cash', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(137, 'WTXNO-137', '113', '86', 'Vijay', '9566960050', '', 100.00, NULL, NULL, 5.00, 5.00, NULL, NULL, 105.00, NULL, 'RFWTR', '2022-02-01', 'Debit', NULL, NULL, 105.00, NULL, NULL, NULL, 100.00, 'Registration Fees', NULL, '86', '4', NULL, NULL, 92, NULL, NULL, NULL, ' Registration Fees', 'yes', '2022-02-01 22:58:15', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-57', NULL, NULL, NULL, 0, NULL, NULL),
(138, 'WTXNO-138', '113', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 10.00, NULL, NULL, 5.00, 0.50, NULL, NULL, 10.50, NULL, 'SBWT', '2022-02-01', 'Debit', NULL, NULL, 10.50, NULL, NULL, NULL, 10.50, 'Slot Booking Fees', NULL, '113', NULL, NULL, NULL, 86, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-01 23:38:31', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-58', NULL, '28', NULL, 0, NULL, NULL),
(139, 'WTXNO-139', '113', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 65.00, NULL, NULL, 5.00, 3.25, NULL, NULL, 68.25, NULL, 'SBWT', '2022-02-01', 'Debit', NULL, NULL, 68.25, NULL, NULL, NULL, 68.25, 'Slot Booking Fees', NULL, '113', NULL, NULL, NULL, 86, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-01 23:44:22', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-59', NULL, '29', NULL, 0, NULL, NULL),
(140, 'WTXNO-140', '113', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 130.00, NULL, NULL, 5.00, 6.50, NULL, NULL, 136.50, NULL, 'SBWT', '2022-02-01', 'Debit', NULL, NULL, 136.50, NULL, NULL, NULL, 136.50, 'Slot Booking Fees', NULL, '113', NULL, NULL, NULL, 86, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-01 23:54:26', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-60', NULL, '30', NULL, 0, NULL, NULL),
(141, 'WTXNO-141', '113', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 65.00, NULL, NULL, 5.00, 3.25, NULL, NULL, 68.25, NULL, 'SBWT', '2022-02-01', 'Debit', NULL, NULL, 68.25, NULL, NULL, NULL, 68.25, 'Slot Booking Fees', NULL, '113', NULL, NULL, NULL, 86, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-01 23:56:49', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-61', NULL, '31', NULL, 0, NULL, NULL),
(142, 'WTXNO-142', '113', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 1.25, NULL, NULL, 5.00, 0.06, NULL, NULL, 1.31, NULL, 'REFWTR', '2022-02-04', 'Credit', NULL, 1.31, NULL, NULL, NULL, NULL, 1.31, 'Slot Refund Fees', NULL, '86', NULL, NULL, NULL, 90, NULL, NULL, NULL, 'Slot Refund Fees', NULL, '2022-02-02 00:00:40', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '133', NULL, 0, NULL, NULL),
(143, 'WTXNO-143', NULL, '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', 1000.00, NULL, NULL, 0.00, 0.00, NULL, NULL, 1000.00, NULL, 'WCTR', '2022-02-09', 'Credit', NULL, 1000.00, NULL, NULL, NULL, NULL, 1000.00, 'Prepaid credits', NULL, '87', NULL, NULL, NULL, 90, NULL, NULL, NULL, 'Prepaid credits', NULL, '2022-02-09 11:11:05', '0000-00-00 00:00:00', 'Card', 'ADIB', '', '', NULL, NULL, NULL, NULL, 0, NULL, NULL),
(144, 'WTXNO-144', '115', '87', 'Sumathi', '8870883990', '', 100.00, NULL, NULL, 5.00, 5.00, NULL, NULL, 105.00, NULL, 'RFWTR', '2022-02-09', 'Debit', NULL, NULL, 105.00, NULL, NULL, NULL, 100.00, 'Registration Fees', NULL, '87', '5', NULL, NULL, 93, NULL, NULL, NULL, ' Registration Fees', 'yes', '2022-02-09 12:08:37', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-62', NULL, NULL, NULL, 0, NULL, NULL),
(145, 'WTXNO-145', '115', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', 10.00, NULL, NULL, 5.00, 0.50, 0.00, 0.00, 10.50, '2', 'Swimming Trainning', '2022-02-02', 'Debit', NULL, 0.00, 10.50, NULL, NULL, 895.00, 10.50, 'Debit', '73', NULL, NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, 'yes', '2022-02-09 12:36:08', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-63', NULL, NULL, NULL, 0, NULL, NULL),
(146, 'WTXNO-146', '115', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', 10.00, NULL, NULL, 5.00, 0.50, 0.00, 0.00, 10.50, '2', 'Swimming Trainning', '2022-02-02', 'Debit', NULL, 0.00, 10.50, NULL, NULL, 895.00, 10.50, 'Debit', '73', NULL, NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, 'yes', '2022-02-09 12:36:16', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-64', NULL, NULL, NULL, 0, NULL, NULL),
(147, 'WTXNO-147', '115', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', 10.00, NULL, NULL, 5.00, 0.50, 0.00, 0.00, 10.50, '2', 'Swimming Trainning', '2022-02-02', 'Debit', NULL, 0.00, 10.50, NULL, NULL, 895.00, 10.50, 'Debit', '73', NULL, NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, 'yes', '2022-02-09 12:36:18', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-65', NULL, NULL, NULL, 0, NULL, NULL),
(148, 'WTXNO-148', '115', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', 10.00, NULL, NULL, 5.00, 0.50, 0.00, 0.00, 10.50, '2', 'Swimming Trainning', '2022-02-02', 'Debit', NULL, 0.00, 10.50, NULL, NULL, 895.00, 10.50, 'Debit', '73', NULL, NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, 'yes', '2022-02-09 12:36:19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-66', NULL, NULL, NULL, 0, NULL, NULL),
(149, 'WTXNO-149', '115', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', 10.00, NULL, NULL, 5.00, 0.50, 0.00, 0.00, 10.50, '2', 'Swimming Trainning', '2022-02-02', 'Debit', NULL, 0.00, 10.50, NULL, NULL, 895.00, 10.50, 'Debit', '73', NULL, NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, 'yes', '2022-02-09 12:36:31', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-67', NULL, NULL, NULL, 0, NULL, NULL),
(150, 'WTXNO-150', '115', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', 10.00, NULL, NULL, 5.00, 0.50, 0.00, 0.00, 10.50, '2', 'Swimming Trainning', '2022-02-02', 'Debit', NULL, 0.00, 10.50, NULL, NULL, 895.00, 10.50, 'debit', '73', NULL, NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, 'yes', '2022-02-09 12:37:10', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-68', NULL, NULL, NULL, 0, NULL, NULL),
(151, 'WTXNO-151', '113', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 1.00, NULL, NULL, 5.00, 0.05, NULL, NULL, 1.05, NULL, 'SBWT', '2022-02-10', 'Debit', NULL, NULL, 1.05, NULL, NULL, NULL, 1.05, 'Slot Booking Fees', NULL, '113', NULL, NULL, NULL, 86, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-10 09:36:51', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-69', NULL, '32', NULL, 0, NULL, NULL),
(152, 'WTXNO-152', '113', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 1.00, NULL, NULL, 5.00, 0.05, NULL, NULL, 1.05, NULL, 'SBWT', '2022-02-10', 'Debit', NULL, NULL, 1.05, NULL, NULL, NULL, 1.05, 'Slot Booking Fees', NULL, '113', NULL, NULL, NULL, 86, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-10 09:37:56', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-70', NULL, '33', NULL, 0, NULL, NULL),
(153, 'WTXNO-153', '113', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 1.00, NULL, NULL, 5.00, 0.05, NULL, NULL, 1.05, NULL, 'SBWT', '2022-02-10', 'Debit', NULL, NULL, 1.05, NULL, NULL, NULL, 1.05, 'Slot Booking Fees', NULL, '113', NULL, NULL, NULL, 86, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-10 09:39:02', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-71', NULL, '34', NULL, 0, NULL, NULL),
(154, 'WTXNO-154', '113', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 1.00, NULL, NULL, 5.00, 0.05, NULL, NULL, 1.05, NULL, 'SBWT', '2022-02-10', 'Debit', NULL, NULL, 1.05, NULL, NULL, NULL, 1.05, 'Slot Booking Fees', NULL, '113', NULL, NULL, NULL, 86, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-10 09:39:58', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-72', NULL, '35', NULL, 0, NULL, NULL),
(155, 'WTXNO-155', '113', '86', 'Vijay', '9566960050', 'nvijaymuthumanickam@gmail.com', 1.00, NULL, NULL, 5.00, 0.05, NULL, NULL, 1.05, NULL, 'SBWT', '2022-02-10', 'Debit', NULL, NULL, 1.05, NULL, NULL, NULL, 1.05, 'Slot Booking Fees', NULL, '113', NULL, NULL, NULL, 86, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-10 10:10:30', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-73', NULL, '36', NULL, 0, NULL, NULL),
(156, 'WTXNO-156', '115', '87', 'Sumathi', '8870883990', '', 100.00, NULL, NULL, 5.00, 5.00, NULL, NULL, 105.00, NULL, 'RFWTR', '2022-02-10', 'Debit', NULL, NULL, 105.00, NULL, NULL, NULL, 100.00, 'Registration Fees', NULL, '87', '6', NULL, NULL, 93, NULL, NULL, NULL, ' Registration Fees', 'yes', '2022-02-10 10:23:48', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-74', NULL, NULL, NULL, 0, NULL, NULL),
(157, 'WTXNO-157', '115', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', 100.00, NULL, NULL, 5.00, 5.00, NULL, NULL, 105.00, NULL, 'SBWT', '2022-02-10', 'Debit', NULL, NULL, 105.00, NULL, NULL, NULL, 105.00, 'Slot Booking Fees', NULL, '115', NULL, NULL, NULL, 87, NULL, NULL, NULL, 'Slot Booking Fees', 'yes', '2022-02-10 10:42:59', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-75', NULL, '37', NULL, 0, NULL, NULL),
(158, 'WTXNO-158', '115', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', 10.00, NULL, NULL, 5.00, 0.50, 0.00, 0.00, 10.50, '2', 'Swimming Trainning', '2022-02-08', 'Debit', NULL, 0.00, 10.50, NULL, NULL, 685.00, 10.50, 'debit', '73', NULL, NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, 'yes', '2022-02-10 10:53:19', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-76', NULL, NULL, NULL, 0, NULL, NULL),
(159, 'WTXNO-159', '115', '87', 'Sumathi', '8870883990', 'sumathiseetha3317@gmail.com', 10.00, NULL, NULL, 5.00, 0.50, 0.00, 0.00, 10.50, '2', 'Swimming Trainning', '2022-02-08', 'Debit', NULL, 0.00, 10.50, NULL, NULL, 685.00, 10.50, 'debit', '73', NULL, NULL, NULL, NULL, 90, NULL, NULL, NULL, NULL, 'yes', '2022-02-10 10:53:27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 'PS2022-77', NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transaction_reports`
--

CREATE TABLE `wallet_transaction_reports` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transaction_report_admins`
--

CREATE TABLE `wallet_transaction_report_admins` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academy`
--
ALTER TABLE `academy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_codes`
--
ALTER TABLE `account_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `activity_selections`
--
ALTER TABLE `activity_selections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked_slots`
--
ALTER TABLE `booked_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_approvals`
--
ALTER TABLE `booking_approvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `change_slot_reqs`
--
ALTER TABLE `change_slot_reqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`coach_id`);

--
-- Indexes for table `contract_details`
--
ALTER TABLE `contract_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_payments`
--
ALTER TABLE `contract_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credits_roll_backs`
--
ALTER TABLE `credits_roll_backs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_transactions`
--
ALTER TABLE `daily_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_setups`
--
ALTER TABLE `discount_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_monthly`
--
ALTER TABLE `fees_monthly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_structure_images`
--
ALTER TABLE `fees_structure_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_yearly_contract`
--
ALTER TABLE `fees_yearly_contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_package_setups`
--
ALTER TABLE `fee_package_setups`
  ADD PRIMARY KEY (`fee_package_setups_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `game_levels`
--
ALTER TABLE `game_levels`
  ADD PRIMARY KEY (`games_level_id`);

--
-- Indexes for table `lane_courts`
--
ALTER TABLE `lane_courts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `location_based_games`
--
ALTER TABLE `location_based_games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_menu_modules`
--
ALTER TABLE `main_menu_modules`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `main_menu_sub_modules`
--
ALTER TABLE `main_menu_sub_modules`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `module_permission`
--
ALTER TABLE `module_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `prepaid_credits`
--
ALTER TABLE `prepaid_credits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_reviews`
--
ALTER TABLE `rating_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund_discount_percentages`
--
ALTER TABLE `refund_discount_percentages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_fees`
--
ALTER TABLE `registration_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_charge_setups`
--
ALTER TABLE `reg_charge_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_attendances`
--
ALTER TABLE `school_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_credits`
--
ALTER TABLE `school_credits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_profile_reports`
--
ALTER TABLE `school_profile_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scroll_text_messages`
--
ALTER TABLE `scroll_text_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_academy_holidays`
--
ALTER TABLE `set_academy_holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slot_class_registrations`
--
ALTER TABLE `slot_class_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slot_selections`
--
ALTER TABLE `slot_selections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slot_selections_days`
--
ALTER TABLE `slot_selections_days`
  ADD PRIMARY KEY (`ss_days_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_remarks`
--
ALTER TABLE `student_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_booking`
--
ALTER TABLE `tmp_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vat_setups`
--
ALTER TABLE `vat_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academy`
--
ALTER TABLE `academy`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `account_codes`
--
ALTER TABLE `account_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `activity_selections`
--
ALTER TABLE `activity_selections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booked_slots`
--
ALTER TABLE `booked_slots`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `booking_approvals`
--
ALTER TABLE `booking_approvals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `change_slot_reqs`
--
ALTER TABLE `change_slot_reqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contract_details`
--
ALTER TABLE `contract_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contract_payments`
--
ALTER TABLE `contract_payments`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `credits_roll_backs`
--
ALTER TABLE `credits_roll_backs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daily_transactions`
--
ALTER TABLE `daily_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount_setups`
--
ALTER TABLE `discount_setups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_monthly`
--
ALTER TABLE `fees_monthly`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_structure_images`
--
ALTER TABLE `fees_structure_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fees_yearly_contract`
--
ALTER TABLE `fees_yearly_contract`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fee_package_setups`
--
ALTER TABLE `fee_package_setups`
  MODIFY `fee_package_setups_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `game_levels`
--
ALTER TABLE `game_levels`
  MODIFY `games_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lane_courts`
--
ALTER TABLE `lane_courts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location_based_games`
--
ALTER TABLE `location_based_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_permission`
--
ALTER TABLE `module_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `prepaid_credits`
--
ALTER TABLE `prepaid_credits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `rating_reviews`
--
ALTER TABLE `rating_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_discount_percentages`
--
ALTER TABLE `refund_discount_percentages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `registration_fees`
--
ALTER TABLE `registration_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reg_charge_setups`
--
ALTER TABLE `reg_charge_setups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_attendances`
--
ALTER TABLE `school_attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_credits`
--
ALTER TABLE `school_credits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_profile_reports`
--
ALTER TABLE `school_profile_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scroll_text_messages`
--
ALTER TABLE `scroll_text_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `set_academy_holidays`
--
ALTER TABLE `set_academy_holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slot_class_registrations`
--
ALTER TABLE `slot_class_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `slot_selections`
--
ALTER TABLE `slot_selections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `slot_selections_days`
--
ALTER TABLE `slot_selections_days`
  MODIFY `ss_days_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_remarks`
--
ALTER TABLE `student_remarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmp_booking`
--
ALTER TABLE `tmp_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `vat_setups`
--
ALTER TABLE `vat_setups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
