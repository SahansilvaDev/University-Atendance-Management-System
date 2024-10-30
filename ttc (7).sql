-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 07:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ttc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` varchar(11) NOT NULL,
  `nic` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `fname`, `lname`, `name`, `email`, `dob`, `nic`, `phone_number`, `address`, `password`, `date`) VALUES
(1, 'AD00003', 'admin', 'admin', 'admin', 'admin1234@gmail.com', '02 May 1990', '123456789V', '01234679', '', '$2y$10$GMZIsZI0LsLYqW.ySoPfzeB/FsQzhuI2ilHrUvYRhEZssdalpHm2G', '2024-05-02 11:08:06'),
(2, 'AD00004', 'shan', 'chamara', 'shan', 'shan100@gmail.com', '02 February', '12346789v', '123456789', '123 Street piliyandala', '$2y$10$pKOgbUZPfydWTbqSkO5Q6e7k27R0ZXK5KJsXkcxe6gEwuxjXwQ7P.', '2024-05-02 13:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `calender`
--

CREATE TABLE `calender` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_select` varchar(100) NOT NULL,
  `subject_url` varchar(1000) NOT NULL,
  `title` varchar(25) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `batch` varchar(25) NOT NULL,
  `batch_year` varchar(25) NOT NULL,
  `start_time` varchar(25) NOT NULL,
  `end_time` varchar(25) NOT NULL,
  `teacher_id` varchar(25) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `online_or_physical` varchar(25) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `color` varchar(100) NOT NULL,
  `color1` varchar(100) NOT NULL,
  `eicon` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `calender`
--

INSERT INTO `calender` (`id`, `subject_code`, `subject_select`, `subject_url`, `title`, `description`, `batch`, `batch_year`, `start_time`, `end_time`, `teacher_id`, `teacher_name`, `online_or_physical`, `date`, `color`, `color1`, `eicon`) VALUES
(1, 'sec', 'software engineer', '', 'Barber', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.', '8B', '', '25 March 2024 01:08 pm', '25 March 2024 02:08 pm', '', '', '1', '2024-03-25 07:44:49', 'fc-bg-default', 'fc-bg-default', ''),
(2, 'sec', 'software engineer', 'google.com', 'Barber fhhfhfu fjif f', 'jhbjn', '8B', '', '2024-03-26', '2024-03-27', '', '', '2', '2024-03-25 07:27:01', 'fc-bg-default', 'fc-bg-default', 'circle'),
(3, 'sec', 'software engineer', 'google.com', 'software engineer', 'https://www.google.com/url?q=https://learn.zoom.us/j/92162172706?pwd%3DTWxBSDhwTi82a2xhZHFYQmxWcFo3U', '8B', '', '25 March 2024 02:22 pm', '25 March 2024 04:26 pm', '', '', '', '2024-03-25 09:03:29', '1', 'fc-bg-blue', 'cog');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `degree_name` varchar(255) NOT NULL,
  `degree_code` varchar(25) NOT NULL,
  `faculty_name` varchar(100) NOT NULL,
  `teacher_id` varchar(100) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `course_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `degree_name`, `degree_code`, `faculty_name`, `teacher_id`, `teacher_name`, `course_description`, `created_at`, `updated_at`) VALUES
(1, 'software engineering', 'sec', 'software engieering', 'se', '1', '', '2', 'test', '2024-03-16 04:09:06', '2024-03-16 04:09:06'),
(2, 'mobile application', 'ccs', 'software engieering', 'se', '2', '', '4', 'gi', '2024-03-16 05:12:16', '2024-03-16 05:12:16'),
(3, 'Embedded System', 'cse', 'electronic', 'ee', '3', '', '1', 'k', '2024-03-16 05:15:21', '2024-03-16 05:15:21'),
(5, 'Data Science', 'DS', 'DS', '', 'Computing and IT', '', 'Bawan zoysa', 'Data Science', '2024-05-02 04:07:55', '2024-05-02 04:07:55'),
(6, 'Cyber Security', 'CS', 'CS', '', 'Computing and IT', '', 'sewmina wijesekara', 'Cyber Security', '2024-05-02 04:10:11', '2024-05-02 04:10:11'),
(7, 'Accounting and Finance', 'AnF', 'AnF', '', 'Business Management', '', 'Dilan Manujaya', 'Accounting and Finance - Dilan', '2024-05-02 04:18:45', '2024-05-02 04:18:45'),
(8, 'Data Structures and Algorithms', 'CCS2300', 'DS', 'DS', 'Computing and IT', '', 'Dilan Manujaya', 'Accounting and Finance - Dilan', '2024-05-02 04:18:45', '2024-05-02 04:18:45'),
(9, 'Software Engineering', 'CCSE', '', '', 'Computing and IT', '', 'cathuranga', 'software enginering', '2024-05-02 13:27:01', '2024-05-02 13:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `create_qr_attendance`
--

CREATE TABLE `create_qr_attendance` (
  `id` int(11) NOT NULL,
  `subject_select` text NOT NULL,
  `subject_code` varchar(25) NOT NULL,
  `batch` varchar(25) NOT NULL,
  `batch_year` varchar(11) NOT NULL,
  `mentrol_or_interctive` varchar(25) NOT NULL,
  `time` varchar(11) NOT NULL,
  `qr_date` varchar(25) NOT NULL,
  `start_time` varchar(11) NOT NULL,
  `end_time` varchar(11) NOT NULL,
  `subject_time` varchar(11) NOT NULL,
  `qr_code` varchar(25) NOT NULL,
  `expired` varchar(11) NOT NULL,
  `teacher_id` varchar(25) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `create_qr_attendance`
--

INSERT INTO `create_qr_attendance` (`id`, `subject_select`, `subject_code`, `batch`, `batch_year`, `mentrol_or_interctive`, `time`, `qr_date`, `start_time`, `end_time`, `subject_time`, `qr_code`, `expired`, `teacher_id`, `date`) VALUES
(1, 'software engineering', 'sec', '8B', '03/15/2023 ', '0', '4:07 pm', '26 March 2024 04:07 pm', '4:07 pm', '4:07 pm', '2', '65759', '1', 'T00002', '2024-04-07 08:03:39'),
(2, 'mobile application', 'ccs', '8B', ' - 8B', '0', '4:08 pm', '21 March 2024 04:08 pm', '4:08 pm', '4:08 pm', '4', '15595', '1', 'T00002', '2024-04-02 17:18:04'),
(3, 'Embedded System', 'cse', '10A', '03/15/2024 ', '0', '4:08 pm', '21 March 2024 04:08 pm', '4:08 pm', '4:08 pm', '1', '67425', '1', 'T00002', '2024-04-24 12:28:40'),
(4, 'software engineering', 'sec', '8B', '03/15/2024 ', '0', '12:57 pm', '22 March 2024 12:57 pm', '12:57 pm', '12:57 pm', '4', '96866', '1', 'T00002', '2024-04-24 12:28:40'),
(5, 'software engineering', 'sec', '8A', '03/15/2023 ', '0', '4:08 pm', '22 March 2024 04:08 pm', '4:08 pm', '4:08 pm', '1', '72717', '1', '', '2024-04-24 12:28:40'),
(6, 'software engineering', 'sec', '8B', ' - 8B', '0', '4:08 pm', '22 March 2024 04:08 pm', '4:08 pm', '4:08 pm', '1', '94161', '1', '', '2024-04-24 12:28:40'),
(7, 'software engineering', 'sec', '8A', '03/15/2023 ', '0', '2:09 pm', '01 April 2024 02:09 pm', '2:09 pm', '2:09 pm', '4', '94947', '1', '', '2024-04-24 12:28:40'),
(8, 'software engineering', 'sec', '10A', '03/15/2024 ', '0', '3:05 pm', '01 April 2024 03:05 pm', '3:05 pm', '3:05 pm', '1', '74585', '1', '', '2024-04-24 12:28:40'),
(9, 'software engineering', 'sec', '8A', '03/15/2023 ', '1', '12:07 am', '02 April 2024 12:07 am', '12:07 am', '12:07 am', '4', '82722', '1', '', '2024-04-24 12:28:40'),
(10, 'software engineering', 'sec', '8B', ' - 8B', '0', '3:40 am', '02 April 2024 03:40 am', '3:40 am', '3:40 am', '3', '93373', '1', '', '2024-04-24 12:28:40'),
(11, 'software engineering', 'sec', '8B', ' - 8B', '1', '11:58 am', '02 April 2024 11:58 am', '11:58 am', '11:58 am', '3', '88781', '1', '', '2024-04-24 12:28:40'),
(12, 'software engineering', 'sec', '8B', ' - 8B', '0', '2:20 pm', '02 April 2024 02:20 pm', '2:20 pm', '2:20 pm', '3', '51591', '1', '', '2024-04-24 12:28:40'),
(14, 'software engineering', 'sec', '8B', ' - 8B', '1', '10:47 pm', '02 April 2024 10:47 pm', '10:47 pm', '10:47 pm', '3', '63856', '1', 'T00002', '2024-04-24 12:28:40'),
(15, 'software engineering', 'sec', '8B', ' - 8B', '0', '3:20 am', '06 April 2024', '3:20 am', '3:20 am', '2', '86982', '1', 'T00002', '2024-04-24 12:28:40'),
(16, 'software engineering', 'sec', '8B', '03/15/2023 ', '1', '3:50 pm', '07 April 2024', '3:50 pm', '3:50 pm', '3', '64789', '1', 'T00002', '2024-04-24 12:28:40'),
(17, 'software engineering', 'sec', '8B', ' - 8B', '1', '3:30 am', '21 April 2024', '3:30 am', '3:30 am', '3', '23175', '1', 'T00002', '2024-04-24 12:28:40'),
(18, 'software engineering', 'sec', '8B', ' - 8B', '1', '5:13 pm', '26 April 2024', '2:38 pm', '2:38 pm', '2', '79854', '0', 'T00002', '2024-04-27 11:42:43'),
(21, 'software engineering', 'sec', '8B', ' - 8B', '1', '10:42 pm', '30 April 2024', '10:43 pm', '10:43 pm', '1', '69117', '1', 'T00005', '2024-04-30 17:14:23'),
(22, 'software engineering', 'sec', '8B', ' - 8B', '1', '10:23 pm', '31 April 2024', '9:55 pm', '9:55 pm', '3', '14812', '0', 'T00002', '2024-04-30 16:55:50'),
(23, 'software engineering', 'sec', '8B', '03/15/2023 ', '0', '11:52 pm', '2 May 2024', '11:52 pm', '1:52 am', '30', '92932', '1', 'T00006', '2024-05-01 18:44:19'),
(24, 'software engineering', 'sec', '8B', '2021 - 8B', '1', '12:18 am', '2 May 2024', '12:15 am', '7:15 am', '30', '89362', '1', 'T00006', '2024-05-01 18:48:10'),
(25, 'software engineering', 'sec', '8B', '2021 - 8B', '1', '12:18 am', '2 May 2024', '12:15 am', '7:15 am', '30', '89362', '0', 'T00006', '2024-05-01 18:48:59'),
(26, 'software engineering', 'sec', '8B', '2021 - 8B', '1', '12:18 am', '2 May 2024', '12:15 am', '7:15 am', '30', '89362', '0', 'T00006', '2024-05-01 18:49:02'),
(27, 'software engineering', 'sec', '8B', '2021 - 8B', '1', '12:18 am', '2 May 2024', '12:15 am', '7:15 am', '30', '89362', '0', 'T00006', '2024-05-01 18:49:04'),
(28, 'software engineering', 'sec', '8B', '2021 - 8B', '1', '5:30 pm', '2 May 2024', '12:15 am', '7:15 am', '30', '89362', '1', 'T00006', '2024-05-02 11:59:53'),
(29, 'software engineering', 'sec', '8B', '2021 - 8B', '1', '12:18 am', '2 May 2024', '12:15 am', '7:15 am', '30', '89362', '1', 'T00006', '2024-05-02 11:21:01'),
(30, 'Data Structures and Algorithms', 'CCS2300', '8B', '2021 - 8B', '1', '4:46 pm', '2 May 2024', '4:44 pm', '4:44 pm', '3', '64943', '1', 'T00002', '2024-05-02 11:20:58'),
(31, 'software engineering', 'sec', '8B', '2021 - 8B', '1', '4:52 pm', '2 May 2024', '4:50 pm', '4:51 pm', '3', '76687', '1', 'T00002', '2024-05-02 12:59:08'),
(32, 'Data Structures and Algorithms', 'CCS23000', '8B', '2021 - 8B', '1', '5:28 pm', '2 May 2024', '5:28 pm', '5:28 pm', '3', '18479', '1', 'T00002', '2024-05-02 12:59:23'),
(33, 'Data Structures and Algorithms', 'CCS2300', '8B', '2021 - 8B', '1', '6:29 pm', '2 May 2024', '6:14 pm', '5:30 pm', '3', '13734', '1', 'T00002', '2024-05-02 13:00:15'),
(34, 'Data Structures and Algorithms', 'CCS2300', '8B', '2021 - 8B', '1', '7:26 pm', '02 May 2024', '7:19 pm', '7:19 pm', '15', '35988', '1', 'T00004', '2024-05-02 14:14:43'),
(35, 'Data Structures and Algorithms', 'CCS2300', '8B', '2021 - 8B', '1', '7:45 pm', '2 May 2024', '7:43 pm', '7:43 pm', '3', '84638', '1', 'T00002', '2024-05-02 14:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `degree_module`
--

CREATE TABLE `degree_module` (
  `id` int(11) NOT NULL,
  `degree_code` varchar(25) NOT NULL,
  `degree_name` varchar(255) NOT NULL,
  `module_code` varchar(25) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `Faculty_code` varchar(25) NOT NULL,
  `Faculty_name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `degree_module`
--

INSERT INTO `degree_module` (`id`, `degree_code`, `degree_name`, `module_code`, `module_name`, `Faculty_code`, `Faculty_name`, `date`) VALUES
(4, 'DS', 'Data Science', 'CCS2300', 'Data Structures and Algorithms', 'FoCIT', 'Computing and IT', '2024-05-02 04:09:04'),
(5, 'CS', 'Cyber Security', 'CCS3304', 'Cyber Security Domains and Tools', 'FoCIT', 'Computing and IT', '2024-05-02 04:11:09'),
(6, 'CS', 'Cyber Security', 'CCS4330', 'Network Security', 'FoCIT', 'Computing and IT', '2024-05-02 04:13:58'),
(7, 'AnF', 'Accounting and Finance', 'SEC0301', 'Introduction to Principles of Economics', 'FoB', 'Business Management', '2024-05-02 04:19:45'),
(8, 'CCSE', 'Software Engineering', 'SE', 'Software Engineering', 'FoCIT', 'Computing and IT', '2024-05-02 13:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `faculty_code` varchar(255) NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `faculty_Description` varchar(255) NOT NULL,
  `faculty_image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `faculty_code`, `faculty_name`, `faculty_Description`, `faculty_image`, `date`, `update_date`) VALUES
(5, 'FoCIT', 'Computing and IT', 'Computing and IT', '../upload/Faculty_img/66330ab039293_iT.jpg', '2024-05-02 03:40:52', '0000-00-00 00:00:00'),
(6, 'FoB', 'Business Management', 'Business Management', '../upload/Faculty_img/66330ae30d783_Business.jpg', '2024-05-02 03:40:44', '0000-00-00 00:00:00'),
(7, 'FoE', 'Engineering', 'Engineering', '../upload/Faculty_img/66330b2b2e73c_Engineering.jpg', '2024-05-02 03:40:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_hed`
--

CREATE TABLE `faculty_hed` (
  `id` int(11) NOT NULL,
  `facluty_hed_code` varchar(100) NOT NULL,
  `faculty_code` varchar(100) NOT NULL,
  `faculty_name` varchar(100) NOT NULL,
  `faculty_head` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faculty_hed`
--

INSERT INTO `faculty_hed` (`id`, `facluty_hed_code`, `faculty_code`, `faculty_name`, `faculty_head`, `date`) VALUES
(5, 'FH00001', 'FoCIT', 'Computing and IT', 'Mr.sampath Degalle', '2024-05-02 03:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `message`, `timestamp`) VALUES
(1, 'Student', 'hhhh', '2024-04-07 17:34:27'),
(2, 'Student', 'hhh', '2024-04-07 17:35:49'),
(3, 'Teacher', 'ffff', '2024-04-07 17:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `nic` varchar(100) NOT NULL,
  `degree_programe` varchar(255) NOT NULL,
  `degree_code` varchar(25) NOT NULL,
  `year` varchar(11) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fingerprint` varchar(255) NOT NULL,
  `login_ip` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `Token_idinti` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `user_id`, `fname`, `lname`, `name`, `email`, `dob`, `nic`, `degree_programe`, `degree_code`, `year`, `batch`, `phone_number`, `address`, `profile_img`, `password`, `fingerprint`, `login_ip`, `token`, `Token_idinti`, `date`) VALUES
(1, 'ST00001', 'chathuranga', 'bandara', 'chathuranga', 'chatthuraga19990702@gmail.com', '02 May 2000', '123456789V', 'Data Science', 'DS', '2021', '8B', '123456789', '123456 street city', '', '$2y$10$D/xx22d/lzOZtlFTKfqqEOkXy1L87RiRgdi6ooKBSxd.8pc1pJgsa', 'tisuvrkish', '', '202c17a83caf494180935d45e1b91993', '1', '2024-05-02 14:03:36'),
(2, 'ST00002', 'gevidu', 'obayasekara', 'admin', 'pctecnic29@gmail.com', '02 february 2000', '123456789v', 'Data Science', 'DS', '2021', '8B', '123456789', '1234 street piliyandala', './uploads/icon-5404125_1280.webp', '$2y$10$pJ4P2FL25fWFxZdAgkFBfesswqC1YQkYTYD7U6BwielB1vpJifYge', 'tisuvrkish', '', 'ba002d8c62c95940ae3dd78fb753fa93', '1', '2024-05-02 14:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `st_module_assign`
--

CREATE TABLE `st_module_assign` (
  `id` int(11) NOT NULL,
  `st_user_id` varchar(50) NOT NULL,
  `degree_code` varchar(255) NOT NULL,
  `module_code` varchar(255) NOT NULL,
  `teacher_id` varchar(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `date1` datetime NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `success_attend`
--

CREATE TABLE `success_attend` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `subject_select` varchar(255) NOT NULL,
  `subject_code` varchar(100) NOT NULL,
  `batch` varchar(100) NOT NULL,
  `qr_code` varchar(50) NOT NULL,
  `qr_date` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `teacher_id` varchar(100) NOT NULL,
  `currentTime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `success_attend`
--

INSERT INTO `success_attend` (`id`, `user_id`, `subject_select`, `subject_code`, `batch`, `qr_code`, `qr_date`, `date`, `teacher_id`, `currentTime`) VALUES
(1, 'ST00001', 'software engineering', 'sec', '8A', '65757', '02 April 2024', '2024-04-02 22:02:42', 'T00002', '03:29:06'),
(2, 'ST00005', 'software engineering', 'sec', '8A', '65759', '22 March 2024 04:07 pm', '2024-04-28 12:11:45', 'T00002', '03:29:06'),
(4, 'ST00002', 'software engineering', 'sec', '8B', '73519', '05 April 2024', '2024-04-16 10:02:50', 'T00002', '03:29:06'),
(8, 'ST00005', 'software engineering', 'sec', '8B', '65759', '03 April 2024 ', '2024-04-28 12:08:56', 'T00002', '03:29:06'),
(9, 'ST00002', 'software engineering', 'sec', '8B', '64789', '07 April 2024', '2024-04-16 07:45:36', 'T00002', '22:48:50'),
(10, 'ST00002', 'software engineering', 'sec', '8B', '69117', '30 April 2024', '2024-04-30 16:57:07', 'T00005', '22:26:30'),
(11, 'ST00005', 'software engineering', 'sec', '8B', '92932', '02 May 2024', '2024-05-01 18:44:23', 'T00006', '00:14:19'),
(12, 'ST00005', 'software engineering', 'sec', '8B', '89362', '02 May 2024', '2024-05-01 18:48:14', 'T00006', '00:18:10'),
(13, 'ST00002', 'Data Structures and Algorithms', 'CCS2300', '8B', '84638', '02 May 2024', '2024-05-02 14:15:57', 'T00002', '19:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` varchar(11) NOT NULL,
  `nic` varchar(100) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `internal_external` varchar(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `t_notification` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Token_idinti` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `user_id`, `fname`, `lname`, `name`, `email`, `dob`, `nic`, `phone_number`, `address`, `password`, `internal_external`, `token`, `t_notification`, `date`, `Token_idinti`) VALUES
(1, 'T00001', 'chathuranga', 'bandara', 'cathuranga', 'chathuranga@gmail.com', '02 February', '123456789V', '1234567890', '123456 street city', '$2y$10$EePKT5DUDh5T.n4SpWqiuu2xgGYbFklr5C2JOhRynx4B6CT.y1CG2', '1', 'd1b8f29de839edaf12c35a14c8394072', '', '2024-05-02 11:01:56', ''),
(2, 'T00002', 'shan', 'chamara', 'sahn', 'shan100@gmail.com', '02 May 1992', '123456789V', '13456799', '123456 street city', '$2y$10$Y2ipAhtYENx3Uu1ktXwO/uTmVfJ/yAVWXc6PzdMlfmzm0KThEdt1m', '2', '202c17a83caf494180935d45e1b91993', '', '2024-05-02 11:03:01', ''),
(3, 'T00003', 'yeshan', 'kavidu', 'yeshn', 'yeshan100@gmail.com', '02 May 1993', '12346789v', '123565871', '123456 street city', '$2y$10$Q.DVxOFS41hl/3JBWlOOnOvFhLugUO4aPvAvIvYpY5Hn9m2Xl0nni', '1', '7815a4aed620bde736024b12b4219063', '', '2024-05-02 11:03:59', ''),
(4, 'T00004', 'yeshan', 'siriwardhna', 'yeshan', 'pctecnic29@gmail.com', '02 February', '123456789V', '123456789', '123 street kaluthra', '$2y$10$PSNfO3ouT1yUN.02SRiRfOwUVcFuxi4eG8gw4pHJP27H3KE79L4gu', '1', 'ba002d8c62c95940ae3dd78fb753fa93', '', '2024-05-02 13:43:09', '1');

-- --------------------------------------------------------

--
-- Table structure for table `test_create_qr_attendance`
--

CREATE TABLE `test_create_qr_attendance` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `batch_year` varchar(255) NOT NULL,
  `batch` varchar(25) NOT NULL,
  `year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `test_create_qr_attendance`
--

INSERT INTO `test_create_qr_attendance` (`id`, `course_name`, `batch_year`, `batch`, `year`) VALUES
(1, '', '', '', ''),
(2, '', '1970 - ', '', ''),
(3, 'mobile application', '03/15/2023 - 8A', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_module`
--

CREATE TABLE `t_module` (
  `id` int(11) NOT NULL,
  `t_user_id` varchar(50) NOT NULL,
  `t_name` varchar(100) NOT NULL,
  `degree_code` varchar(255) NOT NULL,
  `module_code` varchar(255) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `Faculty_code` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_module`
--

INSERT INTO `t_module` (`id`, `t_user_id`, `t_name`, `degree_code`, `module_code`, `module_name`, `Faculty_code`, `date`) VALUES
(6, 'T00001', 'Bawan zoysa', 'DS', 'CCS2300', 'Data Structures and Algorithms', 'FoCIT', '2024-05-02 04:09:04'),
(7, 'T00002', 'sewmina wijesekara', 'CS', 'CCS3304', 'Cyber Security Domains and Tools', 'FoCIT', '2024-05-02 04:11:09'),
(8, 'T00002', 'sewmina wijesekara', 'CS', 'CCS4330', 'Network Security', 'FoCIT', '2024-05-02 04:13:58'),
(9, 'T00003', 'Dilan Manujaya', 'AnF', 'SEC0301', 'Introduction to Principles of Economics', 'FoB', '2024-05-02 04:19:45'),
(10, 'T00001', 'cathuranga', 'CCSE', 'SE', 'Software Engineering', 'FoCIT', '2024-05-02 13:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `t_success_attend`
--

CREATE TABLE `t_success_attend` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `subject_select` varchar(255) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `qr_code` varchar(50) NOT NULL,
  `qr_date` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_success_attend`
--

INSERT INTO `t_success_attend` (`id`, `user_id`, `subject_select`, `subject_code`, `batch`, `qr_code`, `qr_date`, `date`) VALUES
(18, 'T00002', 'Data Structures and Algorithms', 'CCS2300', '8B', '64943', '2 May 2024', '2024-05-02 11:15:25'),
(19, 'T00002', 'software engineering', 'sec', '8B', '76687', '2 May 2024', '2024-05-02 11:20:36'),
(20, 'T00002', 'Data Structures and Algorithms', 'CCS2300', '8B', '18479', '2 May 2024', '2024-05-02 11:58:41'),
(21, 'T00002', 'Data Science', 'DS', '8B', '13734', '2 May 2024', '2024-05-02 12:01:13'),
(22, 'T00004', 'Data Structures and Algorithms', 'CCS2300', '8B', '35988', '02 May 2024', '2024-05-02 13:51:40'),
(23, 'T00002', 'Data Structures and Algorithms', 'CCS2300', '8B', '84638', '2 May 2024', '2024-05-02 14:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `email`, `password`, `role`, `token`, `data`) VALUES
(1, 'AD00001', 'admin', 'admin123@gmail.com', '$2y$10$pm35Z5zg7jFKDY9nj1NyIuUFfXgKvhjtAeyyncAeAlo0BA03SjHZi', 1, '', '2024-05-02 11:05:56'),
(2, 'T00001', 'cathuranga', 'chathuranga@gmail.com', '$2y$10$EePKT5DUDh5T.n4SpWqiuu2xgGYbFklr5C2JOhRynx4B6CT.y1CG2', 2, 'd1b8f29de839edaf12c35a14c8394072', '2024-05-02 11:01:56'),
(3, 'T00002', 'sahn', 'shan100@gmail.com', '$2y$10$Y2ipAhtYENx3Uu1ktXwO/uTmVfJ/yAVWXc6PzdMlfmzm0KThEdt1m', 2, '202c17a83caf494180935d45e1b91993', '2024-05-02 11:03:01'),
(4, 'T00003', 'yeshn', 'yeshan100@gmail.com', '$2y$10$Q.DVxOFS41hl/3JBWlOOnOvFhLugUO4aPvAvIvYpY5Hn9m2Xl0nni', 2, '7815a4aed620bde736024b12b4219063', '2024-05-02 11:03:59'),
(5, 'ST00001', 'chathuranga', 'chatthuraga19990702@gmail.com', '$2y$10$D/xx22d/lzOZtlFTKfqqEOkXy1L87RiRgdi6ooKBSxd.8pc1pJgsa', 3, 'This is Your Token. Please Use This Token to Login Our System.&lt;br&gt;', '2024-05-02 11:05:37'),
(6, 'AD00002', 'admin', 'admin1234@gmail.com', '$2y$10$pm35Z5zg7jFKDY9nj1NyIuUFfXgKvhjtAeyyncAeAlo0BA03SjHZi', 1, '', '2024-05-02 11:06:58'),
(7, 'AD00003', 'admin', 'admin1234@gmail.com', '$2y$10$GMZIsZI0LsLYqW.ySoPfzeB/FsQzhuI2ilHrUvYRhEZssdalpHm2G', 1, '', '2024-05-02 11:08:06'),
(8, 'AD00004', 'shan', 'shan100@gmail.com', '$2y$10$pKOgbUZPfydWTbqSkO5Q6e7k27R0ZXK5KJsXkcxe6gEwuxjXwQ7P.', 1, '', '2024-05-02 13:18:02'),
(9, 'T00004', 'yeshan', 'pctecnic29@gmail.com', '$2y$10$PSNfO3ouT1yUN.02SRiRfOwUVcFuxi4eG8gw4pHJP27H3KE79L4gu', 2, 'ba002d8c62c95940ae3dd78fb753fa93', '2024-05-02 13:20:35'),
(10, 'ST00002', 'gevindu', 'pctecnic29@gmail.com', '$2y$10$ASTvKOiYT9mOVjmD6B8YW.NaYclZKhhEGKczi550N7oSKlvD2tlyO', 3, 'This is Your Token. Please Use This Token to Login Our System.&lt;br&gt;', '2024-05-02 13:24:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `nic` (`nic`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `calender`
--
ALTER TABLE `calender`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_code` (`subject_code`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `create_qr_attendance`
--
ALTER TABLE `create_qr_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degree_module`
--
ALTER TABLE `degree_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `degree_code` (`degree_code`),
  ADD KEY `module_code` (`module_code`),
  ADD KEY `Faculty_code` (`Faculty_code`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_code` (`faculty_code`);

--
-- Indexes for table `faculty_hed`
--
ALTER TABLE `faculty_hed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facluty_hed_code` (`facluty_hed_code`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `nic` (`nic`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `st_module_assign`
--
ALTER TABLE `st_module_assign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_user_id` (`st_user_id`);

--
-- Indexes for table `success_attend`
--
ALTER TABLE `success_attend`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subject_code` (`subject_code`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `nic` (`nic`);

--
-- Indexes for table `test_create_qr_attendance`
--
ALTER TABLE `test_create_qr_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_module`
--
ALTER TABLE `t_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_success_attend`
--
ALTER TABLE `t_success_attend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `calender`
--
ALTER TABLE `calender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `create_qr_attendance`
--
ALTER TABLE `create_qr_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `degree_module`
--
ALTER TABLE `degree_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `faculty_hed`
--
ALTER TABLE `faculty_hed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `st_module_assign`
--
ALTER TABLE `st_module_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `success_attend`
--
ALTER TABLE `success_attend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_create_qr_attendance`
--
ALTER TABLE `test_create_qr_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_module`
--
ALTER TABLE `t_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_success_attend`
--
ALTER TABLE `t_success_attend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
