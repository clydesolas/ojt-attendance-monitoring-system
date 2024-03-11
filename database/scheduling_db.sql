-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2023 at 02:19 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduling_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `log_type` tinyint(4) NOT NULL COMMENT '1 = AM IN, 2 = AM out, 3 = PM IN, 4 = PM out',
  `datetime_log` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `log_type`, `datetime_log`, `date_updated`) VALUES
(26, 3344, 1, '2023-05-22 07:41:39', '2023-05-22 07:41:39'),
(27, 1185, 1, '2023-05-22 09:44:15', '2023-05-22 09:44:15'),
(28, 3422, 1, '2023-05-24 08:47:26', '2023-05-24 08:47:26'),
(29, 3692, 1, '2023-05-29 08:10:01', '2023-05-29 08:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `title`, `content`) VALUES
(3, 'Allauigan, Wyeth A.', 'Faculty ID - [3422]  \r\nwyeth.alluigan@cvsu.edu.ph\r\n'),
(4, 'Apostol, Mildred T.', 'Faculty ID - [1084]\r\nmildred.apostol@cvsu.edu.ph\r\n'),
(5, 'Asas, Ronel E.', 'Faculty ID - [36424573]\r\nronel.asa@cvsu.edu.ph'),
(6, 'Batula, Jose Lerio V.', 'Faculty ID - [1184]\r\njvbatula@cvsu.edu.ph\r\n'),
(7, 'Bautista, Benedict', 'Faculty ID - [5794]\r\nbenedict.bautista@cvsu.edu.ph'),
(8, 'Cruz, Raymond M.', 'Faculty ID - [3459]\r\nraymond.cruz@cvsu.edu.ph'),
(9, 'Dallego, John Vincent A.', 'Faculty ID - [3427]\r\njohnvincent.dallego@cvsu.edu.ph'),
(10, 'Fajutagana, Sherilyn F.', 'Faculty ID - [3329]\r\nsherilyn.fajutagana@cvsu.edu.ph'),
(11, 'Faller, Remart', 'Faculty ID - [5526]\r\nreymart.faller@cvsu.edu.ph'),
(12, 'Hayag, Mikael Bael', 'Faculty ID - [5539]\r\nmikaelbael.hayag@cvsu.edu.ph'),
(13, 'Huele, Ramil V.', 'Faculty ID - [5168]\r\nramil.huele@cvsu.edu.ph'),
(14, 'Ibañez, Grace S.', 'Faculty ID - [3331]\r\ngrace.ibañez@cvsu.edu.ph'),
(15, 'Lacuesta, Rosalina D.', 'Faculty ID - [239]\r\nrosalina.lacuesta@cvsu.edu.ph'),
(16, 'Lariza, Jayson I.', 'Faculty ID - [3624]\r\njayson.lariza@cvsu.edu.ph'),
(17, 'Leyba, Mariella R.', 'Faculty ID - [3573]\r\nmariella.leyba@cvsu.edu.ph'),
(18, 'Malabanan, Carlo P.', 'Faculty ID - [3344]\r\ncarlo.malaban@cvsu.edu.ph'),
(19, 'Modesto, Shaina Marie M.', 'Faculty ID - [5625]\r\nshainamarie.modesto@cvsu.edu.ph\r\n'),
(20, 'Moran, Klaid Bendio L.', 'Faculty ID - [3686]\r\nklaidbendio.moran@cvsu.edu.ph'),
(21, 'Pagtakhan, Vlademir', 'Faculty ID - [3378]\r\nvlademir.pagtakhan@cvsu.edu.ph'),
(22, 'Rios, Joven S.', 'Faculty ID - [48206562]\r\njoven.rios@cvsu.edu.ph'),
(23, 'Rodero, Gizelle A.', 'Faculty ID - [3330]\r\ngizelle.rodero@cvsu.edu.ph'),
(24, 'Sarino, Rhoel Joseph R.', 'Faculty ID - [3692]\r\nrhoeljoseph.sarino@cvsu.edu.ph\r\nContact # - 0965547065'),
(25, 'Tampos, Armando Jr. M.', 'Faculty ID - [09300253]\r\narmando.tampos@cvsu.edu.ph'),
(26, 'Tepora, Ricky R.', 'Faculty ID - [1185]\r\nrdrtepora@cvsu.edu.ph'),
(27, 'Tomas, Angelica Joyce G.', 'Faculty ID - [5685]\r\nangelicajoyce.tomas@cvsu.edu.ph');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule_info`
--

CREATE TABLE `class_schedule_info` (
  `id` int(30) NOT NULL,
  `schedule_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `subject` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(30) NOT NULL,
  `id_no` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `id_no`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `address`, `email`) VALUES
(5, '3344', 'Carlo', 'P.', 'Malabanan', 'TBA', 'Male', 'TBA', 'carlo.malaban@cvsu.edu.ph'),
(7, '5539', 'Mikael Bael', '', 'Hayag', 'TBA', 'Male', 'TBA', 'mikaelbael.hayag@cvsu.edu.ph'),
(8, '3378', 'Vlademir', '', 'Pagtakhan', 'TBA', 'Male', 'TBA', 'vlademir.pagtakhan@cvsu.edu.ph'),
(9, '3330', 'Gizelle', 'A.', 'Rodero', 'TBA', 'Male', 'TBA', 'gizelle.rodero@cvsu.edu.ph'),
(10, '3422', 'Wyeth', 'A.', 'Allauigan', 'TBA', 'Female', 'TBA', 'wyeth.alluigan@cvsu.edu.ph'),
(11, '5625', 'Shaina Marie', 'M.', 'Modesto', 'tba', 'Female', 'tba', 'shainamarie.modesto@cvsu.edu.ph'),
(12, '3427', 'John Vincent', 'A.', 'Dallego', 'TBA', 'Male', 'TBA', 'johnvincent.dallego@cvsu.edu.ph'),
(13, '3692', 'Rhoel Joseph', 'R.', 'Sarino', '0965547065', 'Male', 'TBA', 'rhoeljoseph.sarino@cvsu.edu.ph'),
(14, '5526', 'Remart', '', 'Faller', 'TBA', 'Male', 'TBA', 'reymart.faller@cvsu.edu.ph'),
(15, '3573', 'Mariella', 'R.', 'Leyba', 'TBA', 'Female', 'TBA', 'mariella.leyba@cvsu.edu.ph'),
(16, '3459', 'Raymond', 'M.', 'Cruz', 'TBA', 'Male', 'TBA', 'raymond.cruz@cvsu.edu.ph'),
(17, '5794', 'Benedict', '', 'Bautista', 'TBA', 'Male', 'TBA', 'benedict.bautista@cvsu.edu.ph'),
(18, '5685', 'Angelica Joyce', 'G.', 'Tomas', 'TBA', 'Female', 'TBA', 'angelicajoyce.tomas@cvsu.edu.ph'),
(19, '3329', 'Sherilyn', 'F.', 'Fajutagana', 'TBA', 'Female', 'TBA', 'sherilyn.fajutagana@cvsu.edu.ph'),
(20, '239', 'Rosalina', 'D.', 'Lacuesta', 'TBA', 'Female', 'TBA', 'rosalina.lacuesta@cvsu.edu.ph'),
(21, '5168', 'Ramil', 'V.', 'Huele', 'TBA', 'Male', 'TBA', 'ramil.huele@cvsu.edu.ph'),
(22, '36424573', 'Ronel', 'E.', 'Asas', 'TBA', 'Male', 'TBA', 'ronel.asa@cvsu.edu.ph'),
(23, '1084', 'Mildred', 'T.', 'Apostol', 'TBA', 'Female', 'TBA', 'mildred.apostol@cvsu.edu.ph'),
(24, '1185', 'Ricky', 'R.', 'Tepora', 'TBA', 'Male', 'TBA', 'rdrtepora@cvsu.edu.ph'),
(25, '3686', 'Klaid Bendio', 'L.', 'Moran', 'TBA', 'Male', 'TBA', 'klaidbendio.moran@cvsu.edu.ph'),
(26, '09300253', 'Armando Jr.', 'M.', 'Tampos', 'TBA', 'Male', 'TBA', 'armando.tampos@cvsu.edu.ph'),
(27, '48206562', 'Joven', 'S.', 'Rios', 'TBA', 'Male', 'TBA', 'joven.rios@cvsu.edu.ph'),
(28, '3624', 'Jayson', 'I.', 'Lariza', 'TBA', 'Male', 'TBA', 'jayson.lariza@cvsu.edu.ph'),
(29, '3331', 'Grace', 'S.', 'Ibañez', 'TBA', 'Female', 'TBA', 'grace.ibañez@cvsu.edu.ph'),
(30, '1184', 'Jose Lerio', 'V.', 'Batula', 'TBA', 'Male', 'TBA', 'jvbatula@cvsu.edu.ph');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(9) NOT NULL,
  `user_id` int(30) NOT NULL,
  `action_made` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `title` varchar(200) NOT NULL,
  `schedule_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1= class, 2= meeting,3=others',
  `description` text NOT NULL,
  `location` text NOT NULL,
  `is_repeating` tinyint(1) NOT NULL DEFAULT 1,
  `repeating_data` text NOT NULL,
  `schedule_date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `faculty_id`, `title`, `schedule_type`, `description`, `location`, `is_repeating`, `repeating_data`, `schedule_date`, `time_from`, `time_to`, `date_created`) VALUES
(12, 15, 'SAMPLE TITLE', 1, 'SAMPLE DESCRIPTION', 'SAMPLE LOCATION', 0, '', '2023-05-16', '10:00:00', '16:00:00', '2023-05-16 15:22:55'),
(15, 10, 'Sample', 1, 'Sample', 'Sample', 0, '', '2023-05-18', '09:00:00', '11:00:00', '2023-05-18 08:25:31'),
(17, 24, '\r\n', 1, '', '', 0, '{\"dow\":\"1\",\"start\":\"2023-07-01\",\"end\":\"2023-07-31\"}', '0000-00-00', '00:00:00', '00:00:00', '2023-06-28 15:59:43'),
(18, 24, 'ASYNCHRONOUS', 1, '', '', 1, '{\"dow\":\"1\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '10:00:00', '11:00:00', '2023-06-28 16:00:47'),
(19, 24, 'COSC 95', 1, 'LEC ONLY \r\nBSCS - 3B', 'ROOM 106', 1, '{\"dow\":\"1\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '13:00:00', '15:00:00', '2023-06-28 16:01:36'),
(20, 0, '', 1, '', '', 0, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '00:00:00', '00:00:00', '2023-06-28 16:02:39'),
(21, 0, '', 1, '', '', 0, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '00:00:00', '00:00:00', '2023-06-28 16:03:11'),
(22, 24, 'Consultation Hours', 3, '', '', 1, '{\"dow\":\"3\",\"start\":\"2023-07-01\",\"end\":\"2023-07-31\"}', '0000-00-00', '08:00:00', '10:00:00', '2023-06-28 16:05:43'),
(23, 24, 'COSC 200B', 1, 'BSCS-4C ', 'ROOM 106', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '10:00:00', '11:00:00', '2023-06-28 16:37:41'),
(24, 24, 'ITEC 75', 1, 'BSIT - PETITION\r\nLECTURE ONLY', 'TBA', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '13:00:00', '15:00:00', '2023-06-28 16:38:34'),
(25, 24, 'COSC 70', 1, 'BSCS 2A\r\nLECTURE ONLY \r\n', 'CTMO 1', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '07:00:00', '09:00:00', '2023-06-28 16:39:29'),
(26, 24, 'COSC 95', 1, 'BSCS -3A\r\nLECTURE ONLY', 'LR 6', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '13:00:00', '15:00:00', '2023-06-28 16:40:22'),
(27, 20, 'DCIT 55 LAB\r\n', 1, 'BSCS 2A', 'CL 3', 1, '{\"dow\":\"1\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '08:00:00', '11:00:00', '2023-06-28 16:41:33'),
(28, 20, 'DCIT 55 LAB', 1, 'BSCS 2B', 'CL 2', 1, '{\"dow\":\"1\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '12:00:00', '15:00:00', '2023-06-28 16:42:12'),
(29, 20, 'DCIT 55 LAB', 1, 'BSCS 2C ', 'CL 7', 1, '{\"dow\":\"1\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '15:00:00', '18:00:00', '2023-06-28 16:43:07'),
(30, 20, 'CH', 1, '', '', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '10:00:00', '12:00:00', '2023-06-28 16:43:43'),
(31, 20, 'DCIT 55 LAB', 1, 'BSCS 2D', 'A 305', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '08:00:00', '11:00:00', '2023-06-28 16:44:32'),
(32, 20, 'DCIT 55 LEC', 1, 'BSCS 2D', '', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '11:00:00', '13:00:00', '2023-06-28 16:46:36'),
(33, 20, 'DCIT 55 LEC', 1, 'BSCS 2C', '106', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '15:00:00', '17:00:00', '2023-06-28 16:48:12'),
(34, 29, 'RESEARCH', 3, '', '', 1, '{\"dow\":\"1\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '08:30:00', '11:00:00', '2023-06-28 16:49:36'),
(35, 29, 'EXTENSION', 3, '', '', 1, '{\"dow\":\"1\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '13:30:00', '16:00:00', '2023-06-28 16:50:07'),
(36, 29, 'CONSULTATION HOURS', 1, '', 'DCS OFFICE', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '13:30:00', '15:00:00', '2023-06-28 16:53:01'),
(37, 29, 'ITEC 199 PRACTICUM', 1, 'BSIT 4B', '106', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '09:30:00', '12:00:00', '2023-06-28 16:55:12'),
(38, 29, 'ITEC 199 PRACTICUM', 1, 'BSIT 4B', '106', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '13:30:00', '16:00:00', '2023-06-28 16:56:03'),
(39, 29, 'COSC 90 LEC O NLY', 1, 'BSCS 3A ', '106', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '08:30:00', '23:00:00', '2023-06-28 16:57:54'),
(40, 29, 'COSC 90 LEC ONLY ', 1, 'BSCS 3B', '106', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-27\"}', '0000-00-00', '13:30:00', '16:00:00', '2023-06-28 16:58:32'),
(41, 15, 'DCIT 25 LEC', 1, 'BSIT 2B', 'CTMO2', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '08:00:00', '10:00:00', '2023-06-29 13:49:38'),
(42, 15, 'DCIT 25', 1, 'BSIT 2B', 'CL4', 1, '{\"dow\":\"2\",\"start\":\"2023-06-01\",\"end\":\"2023-07-31\"}', '0000-00-00', '10:00:00', '01:00:00', '2023-06-29 13:52:54'),
(43, 15, 'DCI5 25 LAB\r\n', 1, 'BSIT-2B', 'CL4', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '10:00:00', '01:00:00', '2023-06-29 14:03:20'),
(44, 15, 'DCIT 25 LEC', 1, 'BSIT 2A', 'CL4', 1, '{\"dow\":\"2\",\"start\":\"2023-07-01\",\"end\":\"2023-07-31\"}', '0000-00-00', '14:00:00', '16:00:00', '2023-06-29 14:04:14'),
(45, 15, 'DCIT 25 LAB', 1, 'BSIT-2A', 'CL 4', 1, '{\"dow\":\"2\",\"start\":\"2023-07-01\",\"end\":\"2023-07-31\"}', '0000-00-00', '16:00:00', '19:00:00', '2023-06-29 14:05:19'),
(46, 15, 'DCIT 25 LEC ', 1, 'BSIT 2D', 'CTMO2', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '08:00:00', '10:00:00', '2023-06-29 14:06:14'),
(47, 15, 'DCIT 25 LAB ', 1, 'BSIT 2D', 'CL4', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '10:00:00', '01:00:00', '2023-06-29 14:06:47'),
(48, 15, 'CONSULTATION HOURS', 1, '', '', 1, '{\"dow\":\"3\",\"start\":\"2023-07-01\",\"end\":\"2023-07-31\"}', '0000-00-00', '14:00:00', '15:00:00', '2023-06-29 14:07:54'),
(49, 15, 'DCIT 25 LEC ', 1, 'BSIT 2C ', 'LR 5 ', 1, '{\"dow\":\"3\",\"start\":\"2023-07-01\",\"end\":\"2023-07-31\"}', '0000-00-00', '12:00:00', '17:00:00', '2023-06-29 14:08:53'),
(50, 15, 'DCIT 25 LAB', 1, 'BSIT 2C ', 'A-305', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '05:00:00', '08:00:00', '2023-06-29 14:09:44'),
(51, 15, 'DCIT 25 LEC ', 1, 'BSIT 2E ', 'CTMO2', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '08:00:00', '10:00:00', '2023-06-29 14:10:38'),
(52, 15, 'DCIT 25 LAB', 1, 'BSIT 2E ', 'CL4', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '10:00:00', '01:00:00', '2023-06-29 14:11:29'),
(53, 15, 'CONSULTATION HOURS', 1, '', '', 1, '{\"dow\":\"4\",\"start\":\"2023-06-01\",\"end\":\"2023-07-31\"}', '0000-00-00', '02:00:00', '03:00:00', '2023-06-29 14:12:23'),
(54, 15, 'DCIT 25 LEC', 1, 'BSIT 2F', 'LR 5', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '03:00:00', '05:00:00', '2023-06-29 14:13:41'),
(55, 15, 'DCIT 25 LAB', 1, 'BSIT 2F', 'A-305', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '05:00:00', '08:00:00', '2023-06-29 14:14:16'),
(56, 9, 'ITEC 70 LEC', 1, 'BSIT 2C', 'A 307', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '08:00:00', '10:00:00', '2023-06-29 14:20:45'),
(57, 9, 'ITEC 70 LAB', 1, 'BSIT 2C', 'A-307', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '10:00:00', '13:00:00', '2023-06-29 14:21:27'),
(58, 9, 'ITEC 70 LEC', 1, 'BSIT 2D', 'A-307', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '14:00:00', '16:00:00', '2023-06-29 14:22:59'),
(59, 9, 'ITEC 70 LAB', 1, 'BSIT 2D', 'A 307', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '04:00:00', '07:00:00', '2023-06-29 14:23:35'),
(60, 9, 'ITEC 70 LAB', 1, 'BSIT 2C', 'A 307', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '07:00:00', '10:00:00', '2023-06-29 14:25:16'),
(61, 9, 'ITEC 70 LEC', 1, 'BSIT 2E', 'A 307', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '10:00:00', '12:00:00', '2023-06-29 14:25:49'),
(62, 9, 'Consultation Hours', 1, '', 'DCS Faculty', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '13:00:00', '14:00:00', '2023-06-29 14:26:16'),
(63, 9, 'ITEC 70 LEC', 1, 'BSIT 2F', 'CTMO 1 ', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '14:00:00', '16:00:00', '2023-06-29 14:27:02'),
(64, 9, 'ITEC 70 LAB', 1, 'BSIT 2F', 'A307', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '16:00:00', '19:00:00', '2023-06-29 14:27:57'),
(65, 9, 'ITEC 70 LAB', 1, 'BSIT 2A', 'A307', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '07:00:00', '10:00:00', '2023-06-29 14:30:38'),
(66, 9, 'ITEC 70 LEC', 1, 'BSIT 2A', 'CTMO1', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '10:00:00', '12:00:00', '2023-06-29 14:31:28'),
(67, 9, 'Consultation Hours', 1, '', 'DCS Faculty', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '13:00:00', '14:00:00', '2023-06-29 14:31:47'),
(68, 9, 'ITEC 70 LEC', 1, 'BSIT 2B', 'CTMO1', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '14:00:00', '16:00:00', '2023-06-29 14:32:22'),
(69, 9, 'ITEC 70 LAB', 1, 'BSIT 2B', 'A 307', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '16:00:00', '19:00:00', '2023-06-29 14:32:55'),
(70, 30, 'RESEARCH', 1, '', '', 1, '{\"dow\":\"1\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '09:00:00', '12:00:00', '2023-06-29 14:37:54'),
(71, 30, 'RESEARCH', 1, '', '', 1, '{\"dow\":\"1\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '01:00:00', '04:00:00', '2023-06-29 14:38:15'),
(72, 30, 'PRACTICUM BSIT 4A', 1, 'BSIT 4A 486 HOURS', '', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '00:00:00', '12:00:00', '2023-06-29 14:50:29'),
(73, 30, 'ITEC 80 LEC', 1, 'BSIT PETITION', '', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '07:00:00', '09:00:00', '2023-06-29 14:51:07'),
(74, 30, 'ITEC 80 LAB', 1, 'BSIT PETITION', '', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '09:00:00', '12:00:00', '2023-06-29 14:51:44'),
(75, 30, 'CONSULTATION HOURS', 1, '', '', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '01:00:00', '03:00:00', '2023-06-29 14:52:06'),
(76, 30, 'PRACTICUM', 1, 'BSIT 4C \r\n486 HOURS', '', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '09:00:00', '12:00:00', '2023-06-29 14:52:58'),
(77, 17, 'ITEC 60 LEC', 1, 'BSIT 2D', 'LR 6', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '07:00:00', '09:00:00', '2023-06-29 15:17:59'),
(78, 17, 'ITEC 60 LAB', 1, 'BSIT 2D', 'CL 2', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '09:00:00', '12:00:00', '2023-06-29 15:18:33'),
(79, 17, 'CH', 1, '', '', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '01:00:00', '03:00:00', '2023-06-29 15:19:04'),
(80, 17, 'ITEC 60 LEC', 1, 'BSIT 2E', 'LR 6', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '03:00:00', '05:00:00', '2023-06-29 15:19:57'),
(81, 17, 'ITEC 60 LAB', 1, 'BSIT 2E', 'CL2', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '05:00:00', '08:00:00', '2023-06-29 15:20:26'),
(82, 17, 'ITEC 60 LEC ', 1, 'BSIT 2A', 'LR 6', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '07:00:00', '09:00:00', '2023-06-29 15:21:51'),
(83, 17, 'ITEC 60 LAB', 1, 'BSIT 2A', 'CL2', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '09:00:00', '12:00:00', '2023-06-29 15:22:24'),
(84, 17, 'ITEC 60 LEC ', 1, 'BSIT 2B', 'LR 6', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '01:00:00', '03:00:00', '2023-06-29 15:23:05'),
(85, 17, 'ITEC 70 LAB', 1, 'BSIT 2B', 'CL2', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '03:00:00', '06:00:00', '2023-06-29 15:23:34'),
(86, 17, 'ITEC 70 LEC', 1, 'BSIT 2G', 'LR 6', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '07:00:00', '09:00:00', '2023-06-29 15:24:29'),
(87, 17, 'ITEC 70 LAB', 1, 'BSIT 2G', 'LR6', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '09:00:00', '12:00:00', '2023-06-29 15:24:57'),
(88, 17, 'ITEC 60 LEC', 1, 'BSIT 2C', 'LR 6', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '01:00:00', '03:00:00', '2023-06-29 15:25:30'),
(89, 17, 'ITEC 60 LAB', 1, 'BSIT 2C', 'CL2', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-07-28\"}', '0000-00-00', '03:00:00', '06:00:00', '2023-06-29 15:25:55'),
(90, 24, 'COSC 70', 1, 'BSCS-2B', 'Room 106', 1, '{\"dow\":\"1\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '08:00:00', '10:00:00', '2023-07-08 19:10:34'),
(91, 24, 'Research', 2, '', 'DCS Faculty', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '08:00:00', '11:00:00', '2023-07-08 19:12:37'),
(92, 24, 'Extension', 2, '', 'DCS Faculty', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '13:00:00', '16:00:00', '2023-07-08 19:13:23'),
(93, 10, 'DCIT 55 LEC', 1, 'BSIT 2A', 'CL 3', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '08:00:00', '22:00:00', '2023-07-08 19:38:19'),
(94, 10, 'DCIT 55 LAB', 1, 'BSIT 2A', 'CL 3', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '10:00:00', '13:00:00', '2023-07-08 19:39:10'),
(95, 10, 'DCIT 55 LEC', 1, 'BSIT 2B', 'CL3', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '14:00:00', '16:00:00', '2023-07-08 19:39:42'),
(96, 10, 'DCIT 55 LAB', 1, 'BSIT 2B', 'CL3', 1, '{\"dow\":\"2\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '16:00:00', '19:00:00', '2023-07-08 19:40:26'),
(97, 10, 'Consultation Hours', 3, '', 'DCS Faculty', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '07:00:00', '08:00:00', '2023-07-08 19:41:08'),
(98, 10, 'DCIT 55 LEC', 1, 'BSIT 2C', 'CL3', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '08:00:00', '10:00:00', '2023-07-08 19:45:18'),
(99, 10, 'DCIT 55 LAB', 1, 'BSIT 2C', 'CL3', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '10:00:00', '13:00:00', '2023-07-08 19:45:53'),
(100, 10, 'DCIT 55 LEC', 1, 'BSIT 2D', 'CL3 ', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '14:00:00', '16:00:00', '2023-07-08 19:46:25'),
(101, 10, 'DCIT 55 LAB', 1, 'BSIT 2D', 'CL3', 1, '{\"dow\":\"3\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '16:00:00', '19:00:00', '2023-07-08 19:47:25'),
(102, 10, 'Consultation Hours', 3, '', 'DCS Faculty', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '07:00:00', '08:00:00', '2023-07-08 19:48:16'),
(103, 10, 'DCIT 55 LEC', 1, 'BSIT 2F', 'CL3', 1, '{\"dow\":\"4\",\"start\":\"2023-07-01\",\"end\":\"2023-08-31\"}', '0000-00-00', '08:00:00', '10:00:00', '2023-07-08 19:49:00'),
(104, 10, 'DCIT 55 LAB', 1, 'CL 3 ', 'BSIT 2F', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '10:00:00', '13:00:00', '2023-07-08 19:50:06'),
(105, 10, 'DCIT 55 LEC', 1, 'BSIT 2E', 'CL3', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '14:00:00', '16:00:00', '2023-07-08 20:18:01'),
(106, 10, 'DCIT 55 LAB', 1, 'BSIT 2E', 'CL 3 ', 1, '{\"dow\":\"4\",\"start\":\"-01\",\"end\":\"2023-08-07\"}', '0000-00-00', '16:00:00', '19:00:00', '2023-07-08 20:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `username` varchar(9) NOT NULL,
  `yrsec` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `yrsec`, `password`) VALUES
(11, '201811520', 'BSIT4D', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `studusers`
--

CREATE TABLE `studusers` (
  `id` int(9) NOT NULL,
  `useraydi` text NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Staff, 3= subscriber'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `class_schedule_info`
--
ALTER TABLE `class_schedule_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studusers`
--
ALTER TABLE `studusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `type_2` (`type`),
  ADD KEY `id` (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `type` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `class_schedule_info`
--
ALTER TABLE `class_schedule_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `studusers`
--
ALTER TABLE `studusers`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `studusers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
