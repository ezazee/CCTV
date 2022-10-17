-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2022 at 07:20 PM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1246502_absensi_v4`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `building_id` int(8) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `building_scanner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `code`, `name`, `address`, `building_scanner`) VALUES
(1, 'SWUKZ/2021', 'BIN KETINTANG', 'JL KETINTANG  MADYA', ''),
(4, 'SWJ6B/2022', 'KAB. BANGKALAN', '-', ''),
(5, 'SWKT8/2022', 'KAB. BANYUWANGI', '-', ''),
(6, 'SW7WI/2022', 'KAB. BLITAR', '-', ''),
(7, 'SWQGI/2022', 'KAB. BOJONOGORO', '-', ''),
(8, 'SW07M/2022', 'KAB. BONDOWOSO', '-', ''),
(9, 'SWV6D/2022', 'KAB. GRESIK', '-', ''),
(10, 'SW05L/2022', 'KAB. JEMBER', '-', ''),
(11, 'SWFZR/2022', 'KAB. JOMBANG', '-', ''),
(12, 'SWE30/2022', 'KAB. KEDIRI', '-', ''),
(13, 'SWQXA/2022', 'KAB. LAMONGAN', '-', ''),
(14, 'SWUI0/2022', 'KAB. LUMAJANG', '-', ''),
(16, 'SWTG5/2022', 'KAB. MADIUN', '-', ''),
(17, 'SW8J7/2022', 'KAB. MAGETAN', '-', ''),
(18, 'SW152/2022', 'KAB. MALANG', '-', ''),
(19, 'SWS6G/2022', 'KAB. MOJOKERTO', '-', ''),
(20, 'SWGXL/2022', 'KAB. NGANJUK', '-', ''),
(21, 'SW7J3/2022', 'KAB. NGAWI', '-', ''),
(22, 'SWKOK/2022', 'KAB. PACITAN', '-', ''),
(23, 'SWERH/2022', 'KAB. PAMEKASAN', '-', ''),
(24, 'SWIPO/2022', 'KAB. PASURUAN', '-', ''),
(25, 'SWEAR/2022', 'KAB. PONOROGO', '-', ''),
(26, 'SW2DP/2022', 'KAB. PROBOLINGGO', '-', ''),
(27, 'SWLUA/2022', 'KAB. SAMPANG', '-', ''),
(28, 'SWVJK/2022', 'KAB. SITUBONDO', '-', ''),
(29, 'SWZVH/2022', 'KAB. SUMENEP', '-', ''),
(30, 'SWDBE/2022', 'KAB. TRENGGALEK', '- ', ''),
(31, 'SW6C7/2022', 'KAB. TUBAN', '-', ''),
(32, 'SWCD8/2022', 'KAB. TULUNGAGUNG', '-', ''),
(33, 'SWW3F/2022', 'KOTA BATU', '-', ''),
(34, 'SW9B5/2022', 'KOTA BLITAR', '-', ''),
(35, 'SWIY8/2022', 'KOTA KEDIRI', '-', ''),
(36, 'SWVC0/2022', 'KOTA MADIUN', '-', ''),
(37, 'SWL1X/2022', 'KOTA MALANG', '-', ''),
(38, 'SWNH8/2022', 'KOTA MOJOKERTO', '-', ''),
(39, 'SWR9L/2022', 'KOTA PASURUAN', '-', ''),
(40, 'SWB0A/2022', 'KOTA PROBOLINGGO', '-', ''),
(41, 'SW016/2022', 'KOTA SURABAYA', '-', ''),
(42, 'SW2UL/2022', 'KAB. SIDOARJO', '-', '');

-- --------------------------------------------------------

--
-- Table structure for table `business_card`
--

CREATE TABLE `business_card` (
  `id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `active` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_card`
--

INSERT INTO `business_card` (`id`, `name`, `photo`, `active`) VALUES
(1, 'Thema 1', '2022-01-2190bebb3e43ad8678ba544cf0695513cf.jpg', '1'),
(2, 'Theme 2', '2022-01-21f8397ab324781477c395f45be6daf94a.jpg', '2');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `chat_pengirim` int(11) NOT NULL,
  `chat_penerima` int(11) NOT NULL,
  `chat_isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `chat_waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `chat_status` int(11) NOT NULL,
  `chat_notif` int(11) NOT NULL,
  `chat_tipe` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `chat_pengirim`, `chat_penerima`, `chat_isi`, `chat_waktu`, `chat_status`, `chat_notif`, `chat_tipe`) VALUES
(5, 34, 19, 'Hallo ini cuman tes', '2022-01-03 17:18:37', 1, 1, 'text'),
(6, 34, 19, '2126423643.jpeg', '2022-01-03 17:18:50', 1, 1, 'file'),
(7, 34, 19, 'tes', '2022-01-03 22:31:39', 1, 1, 'text'),
(10, 34, 19, '-6.1842196, 106.7411559', '2022-01-04 05:33:09', 1, 1, 'shareloc'),
(11, 19, 20, 'Tes', '2022-01-05 03:55:25', 0, 1, 'text'),
(12, 19, 20, '1559866506.jpg', '2022-01-05 03:56:03', 0, 1, 'file'),
(14, 20, 21, 'Apakah saya akan', '2022-01-05 05:23:05', 1, 1, 'text'),
(17, 29, 19, 'Test', '2022-01-05 13:03:09', 1, 1, 'text'),
(18, 29, 19, '652092038.jpg', '2022-01-05 13:04:26', 1, 1, 'file'),
(19, 29, 19, 'Test stiker', '2022-01-05 13:11:30', 1, 1, 'text'),
(20, 29, 19, '?', '2022-01-05 13:11:44', 1, 1, 'text'),
(21, 29, 19, '?', '2022-01-05 13:11:48', 1, 1, 'text'),
(22, 29, 19, '?', '2022-01-05 13:11:48', 1, 1, 'text'),
(23, 29, 19, '?', '2022-01-05 13:11:50', 1, 1, 'text'),
(24, 29, 19, '?', '2022-01-05 13:11:53', 1, 1, 'text'),
(25, 29, 19, '?', '2022-01-05 13:11:53', 1, 1, 'text'),
(26, 29, 19, '?', '2022-01-05 13:11:53', 1, 1, 'text'),
(27, 29, 19, '?', '2022-01-05 13:11:58', 1, 1, 'text'),
(28, 29, 19, '?', '2022-01-05 13:12:25', 1, 1, 'text'),
(29, 29, 19, '1644287587.jpg', '2022-01-05 13:19:29', 1, 1, 'file'),
(30, 29, 19, '1115453.docx', '2022-01-05 13:21:32', 1, 1, 'file'),
(31, 29, 22, '1713910369.jpg', '2022-01-05 13:26:39', 1, 1, 'file'),
(32, 29, 22, '?', '2022-01-05 13:26:50', 1, 1, 'text'),
(33, 29, 22, '?', '2022-01-05 13:27:08', 1, 1, 'text'),
(34, 29, 22, '?', '2022-01-05 13:27:16', 1, 1, 'text'),
(35, 19, 29, '?', '2022-01-05 15:20:41', 1, 1, 'text'),
(36, 29, 19, '?', '2022-01-06 09:15:47', 1, 1, 'text'),
(37, 29, 19, '?', '2022-01-06 09:15:58', 1, 1, 'text'),
(38, 29, 19, '506756429.jpg', '2022-01-06 11:18:17', 1, 1, 'file'),
(39, 29, 19, '1801360565.pdf', '2022-01-06 11:18:56', 1, 1, 'file'),
(40, 19, 20, '-7.2574719, 112.7520883', '2022-01-06 16:24:14', 0, 1, 'shareloc'),
(41, 29, 22, 'Test', '2022-01-07 10:53:45', 1, 1, 'text'),
(42, 29, 22, '😁', '2022-01-07 10:53:56', 1, 1, 'text'),
(43, 29, 22, '🙏', '2022-01-07 10:54:02', 1, 1, 'text'),
(44, 29, 22, '💪', '2022-01-07 10:54:11', 1, 1, 'text'),
(45, 29, 22, '🤗🤗', '2022-01-07 10:54:19', 1, 1, 'text'),
(46, 29, 22, '👍', '2022-01-07 10:54:27', 1, 1, 'text'),
(47, 29, 22, '313269881.png', '2022-01-07 10:55:37', 1, 1, 'file'),
(48, 29, 28, '👍', '2022-01-07 11:28:10', 1, 1, 'text'),
(49, 29, 28, '🤗', '2022-01-07 11:28:15', 1, 1, 'text'),
(50, 29, 28, '🙏', '2022-01-07 11:28:24', 1, 1, 'text'),
(51, 29, 28, '313920192.png', '2022-01-07 11:28:34', 1, 1, 'file'),
(52, 29, 28, '1309334424.png', '2022-01-07 11:28:48', 1, 1, 'file'),
(53, 37, 21, 'P', '2022-01-07 17:27:43', 1, 1, 'text'),
(54, 37, 29, 'P', '2022-01-07 17:27:52', 1, 1, 'text'),
(55, 29, 37, '🙏', '2022-01-07 17:28:23', 1, 1, 'text'),
(56, 19, 28, '😀', '2022-01-07 19:46:05', 1, 1, 'text'),
(57, 29, 37, '🙏', '2022-01-08 12:44:17', 1, 1, 'text'),
(58, 28, 19, 'hallo tes', '2022-01-11 07:24:47', 1, 1, 'text'),
(59, 28, 19, '-5.3809442, 105.1283813', '2022-01-11 07:24:49', 1, 1, 'shareloc'),
(60, 28, 19, '🙂', '2022-01-11 07:24:54', 1, 1, 'text'),
(61, 28, 19, 'chat-269526127.jpeg', '2022-01-11 07:24:58', 1, 1, 'gambar'),
(62, 28, 19, 'chatfile-1824692750.pdf', '2022-01-11 07:25:12', 1, 1, 'file'),
(63, 19, 28, '🤫', '2022-01-11 08:06:54', 1, 1, 'text'),
(64, 19, 21, 'chatfile-218055029.jpg', '2022-01-11 08:08:59', 1, 1, 'file'),
(65, 19, 21, 'chatfile-1653301319.jpg', '2022-01-11 08:09:20', 1, 1, 'file'),
(66, 19, 28, 'Tes', '2022-01-11 08:20:15', 1, 1, 'text'),
(67, 19, 28, 'chat-1061838097.jpg', '2022-01-11 08:20:32', 1, 1, 'gambar'),
(68, 19, 29, '😗', '2022-01-11 08:22:56', 1, 1, 'text'),
(69, 19, 29, 'chat-1877839916.jpg', '2022-01-11 08:23:09', 1, 1, 'gambar'),
(70, 19, 21, 'chat-168449037.jpg', '2022-01-11 08:31:33', 1, 1, 'gambar'),
(71, 29, 21, '🙏', '2022-01-11 11:50:11', 0, 1, 'text'),
(72, 22, 29, '-7.8204351, 110.3674144', '2022-01-12 22:34:25', 0, 1, 'shareloc'),
(73, 22, 29, '-7.8204351, 110.3674144', '2022-01-12 22:34:25', 0, 1, 'shareloc'),
(75, 19, 22, 'P', '2022-01-13 12:36:39', 1, 1, 'text'),
(76, 19, 28, 'chat-1988287473.jpg', '2022-01-14 01:49:26', 1, 1, 'gambar'),
(79, 19, 28, 'Min', '2022-01-14 01:50:41', 1, 1, 'text'),
(80, 19, 28, '-7.8211594, 110.368676', '2022-01-14 02:48:05', 1, 1, 'shareloc'),
(81, 19, 28, '-7.8211594, 110.368676', '2022-01-14 02:48:14', 1, 1, 'shareloc'),
(82, 19, 22, '-7.8205346, 110.3683036', '2022-01-14 02:49:53', 1, 1, 'shareloc'),
(83, 21, 28, '🤠', '2022-01-14 13:47:16', 1, 1, 'text'),
(84, 21, 28, '😎', '2022-01-14 13:47:24', 1, 1, 'text'),
(85, 21, 28, '😦', '2022-01-14 13:47:51', 1, 1, 'text'),
(86, 21, 37, 'chat-1526651782.jpg', '2022-01-14 13:49:23', 1, 1, 'gambar'),
(87, 28, 22, 'tes', '2022-01-16 17:32:43', 1, 1, 'text'),
(88, 22, 28, 'tes2', '2022-01-16 17:33:28', 1, 1, 'text'),
(89, 28, 22, 'cal\n\n', '2022-01-16 17:34:20', 1, 1, 'text'),
(90, 28, 22, 'cal\n\n\n\n\n\n\n', '2022-01-16 17:34:25', 1, 1, 'text'),
(91, 28, 22, 'sall\n', '2022-01-16 17:34:31', 1, 1, 'text'),
(92, 28, 22, 'sall\n', '2022-01-16 17:34:33', 1, 1, 'text'),
(93, 28, 22, 'sall', '2022-01-16 17:34:34', 1, 1, 'text'),
(94, 28, 22, 'cal', '2022-01-16 17:35:24', 1, 1, 'text'),
(95, 28, 22, 'cal\n', '2022-01-16 17:35:25', 1, 1, 'text'),
(96, 28, 22, 'tes\n', '2022-01-16 17:35:31', 1, 1, 'text'),
(97, 28, 22, 'cal\n\n\n', '2022-01-16 17:35:31', 1, 1, 'text'),
(98, 28, 22, 'cal\n\n\n\n', '2022-01-16 17:35:36', 1, 1, 'text'),
(99, 28, 22, 'cal\n\n\n\n\n\n', '2022-01-16 17:35:39', 1, 1, 'text'),
(100, 28, 22, 'tes', '2022-01-16 17:35:43', 1, 1, 'text'),
(101, 28, 22, 'cal\n\n\n\n\n', '2022-01-16 17:35:43', 1, 1, 'text'),
(102, 22, 28, 'tes', '2022-01-16 17:35:54', 1, 1, 'text'),
(103, 22, 28, 'sal', '2022-01-16 17:36:14', 1, 1, 'text'),
(104, 22, 28, 'sal\n', '2022-01-16 17:36:15', 1, 1, 'text'),
(105, 0, 28, 'notif ', '2022-01-16 17:38:46', 1, 1, 'text'),
(106, 19, 28, 'min', '2022-01-16 18:08:43', 1, 1, 'text'),
(107, 28, 19, 'admin', '2022-01-16 18:08:57', 1, 1, 'text'),
(108, 28, 19, 'admin\n', '2022-01-16 18:09:00', 1, 1, 'text'),
(109, 28, 19, 'notif', '2022-01-16 18:09:42', 1, 1, 'text'),
(110, 19, 28, 'gak ada notif', '2022-01-16 18:09:50', 1, 1, 'text'),
(111, 19, 28, 'Emmm', '2022-01-16 19:15:53', 1, 1, 'text'),
(112, 19, 28, '-7.089169, 107.9819201', '2022-01-16 19:18:24', 1, 1, 'shareloc'),
(113, 28, 19, 'tes', '2022-01-16 20:37:28', 1, 1, 'text'),
(115, 28, 19, 'sal', '2022-01-16 20:57:47', 1, 1, 'text'),
(116, 19, 28, 'tes', '2022-01-16 20:58:07', 1, 1, 'text'),
(117, 19, 28, 'ts', '2022-01-16 20:58:15', 1, 1, 'text'),
(118, 28, 19, 'tes', '2022-01-16 20:58:22', 1, 1, 'text'),
(119, 28, 19, 'tes', '2022-01-16 21:00:00', 1, 1, 'text'),
(122, 28, 19, '-6.9021, 107.6191', '2022-01-16 21:00:35', 1, 1, 'shareloc'),
(130, 19, 28, '-7.0891703, 107.9819194', '2022-01-17 09:08:07', 1, 1, 'shareloc'),
(131, 19, 28, '🤬', '2022-01-17 09:08:16', 1, 1, 'text'),
(132, 19, 21, '-7.0347973, 107.9826015', '2022-01-17 13:21:28', 1, 1, 'shareloc'),
(133, 21, 19, '-7.2085149, 107.8985222', '2022-01-17 17:16:15', 0, 1, 'shareloc'),
(134, 29, 19, '-7.2085167, 107.8985238', '2022-01-17 17:18:22', 0, 1, 'shareloc'),
(135, 28, 40, 'test', '2022-01-19 10:54:50', 1, 1, 'text'),
(136, 40, 28, 'kk', '2022-01-19 10:57:07', 1, 1, 'text'),
(137, 40, 28, 'lkl', '2022-01-19 10:57:25', 1, 1, 'text'),
(138, 40, 28, 'test', '2022-01-19 10:57:49', 1, 1, 'text'),
(139, 40, 28, 'oi', '2022-01-19 10:59:40', 1, 1, 'text'),
(140, 40, 28, 'test', '2022-01-19 10:59:53', 1, 1, 'text'),
(141, 19, 22, '-7.0891799, 107.9819274', '2022-01-19 11:11:56', 0, 0, 'shareloc'),
(142, 40, 28, 'notif', '2022-01-19 11:39:36', 1, 1, 'text'),
(143, 40, 28, 'notif', '2022-01-19 11:39:36', 1, 1, 'text'),
(144, 40, 28, 'h', '2022-01-19 11:39:39', 1, 1, 'text'),
(145, 19, 28, '-7.0891803, 107.9819291', '2022-01-19 11:41:54', 1, 1, 'shareloc'),
(146, 19, 40, '-7.0891774, 107.9819319', '2022-01-19 11:47:23', 0, 1, 'shareloc'),
(147, 19, 40, '-7.0891796, 107.9819286', '2022-01-19 11:48:57', 0, 1, 'shareloc'),
(148, 19, 28, '-7.0891782, 107.9819286', '2022-01-19 11:49:21', 1, 1, 'shareloc'),
(150, 19, 37, '-7.0892197, 107.9819341', '2022-01-19 13:06:35', 1, 1, 'shareloc'),
(151, 19, 37, '🤯', '2022-01-19 13:06:48', 1, 1, 'text'),
(159, 19, 22, '-7.0891774, 107.9819304', '2022-01-19 13:51:29', 0, 0, 'shareloc'),
(160, 19, 22, 'chat-1752853476.jpg', '2022-01-19 13:51:52', 0, 0, 'gambar'),
(161, 19, 22, 'chatfile-242690077.jpg', '2022-01-19 13:52:02', 0, 0, 'file'),
(162, 37, 19, '😜', '2022-01-19 14:53:55', 1, 1, 'text'),
(163, 37, 21, 'P', '2022-01-19 14:54:11', 0, 0, 'text'),
(164, 37, 29, '🤪', '2022-01-19 14:55:00', 1, 1, 'text'),
(165, 37, 29, '🤪', '2022-01-19 14:55:00', 1, 1, 'text'),
(167, 29, 37, '-7.2012987, 107.8873052', '2022-01-19 19:51:11', 1, 1, 'shareloc'),
(177, 19, 37, '-7.0891824, 107.9819278', '2022-01-19 20:32:38', 1, 1, 'shareloc'),
(200, 29, 37, 'Test ji', '2022-01-20 13:16:22', 1, 1, 'text'),
(201, 29, 37, 'Test ji', '2022-01-20 13:16:22', 1, 1, 'text'),
(202, 29, 37, 'Aya notif teu', '2022-01-20 13:16:37', 1, 1, 'text'),
(203, 29, 37, 'Ka abdi teuaya notif', '2022-01-20 13:16:45', 1, 1, 'text'),
(204, 37, 19, '-7.2085151, 107.898522', '2022-01-20 13:41:12', 1, 1, 'shareloc'),
(206, 19, 37, '-7.0892585, 107.9820497', '2022-01-20 14:26:43', 1, 1, 'shareloc'),
(207, 19, 37, '🤧', '2022-01-20 14:26:56', 1, 1, 'text'),
(208, 19, 22, '-7.0891822, 107.9819226', '2022-01-20 14:29:38', 0, 0, 'shareloc'),
(209, 19, 22, '-7.0891828, 107.9819308', '2022-01-20 16:19:15', 0, 0, 'shareloc'),
(210, 19, 22, '-7.0891782, 107.9819313', '2022-01-20 16:19:16', 0, 0, 'shareloc'),
(211, 19, 37, '-7.0891777, 107.9819297', '2022-01-20 18:41:28', 1, 1, 'shareloc'),
(212, 19, 22, '-7.0970222, 107.984255', '2022-01-21 06:28:59', 0, 0, 'shareloc'),
(213, 19, 22, '-7.0891754, 107.9819355', '2022-01-21 07:21:19', 0, 0, 'shareloc'),
(214, 19, 37, '0', '2022-01-21 07:22:04', 1, 1, 'text'),
(215, 19, 37, '0', '2022-01-21 07:22:04', 1, 1, 'text'),
(216, 19, 37, '0', '2022-01-21 07:22:05', 1, 1, 'text'),
(217, 19, 37, 'A', '2022-01-21 07:22:09', 1, 1, 'text'),
(218, 19, 37, '🧐', '2022-01-21 07:22:37', 1, 1, 'text'),
(219, 19, 37, 'chatfile-598421514.jpg', '2022-01-21 07:22:48', 1, 1, 'file'),
(220, 19, 28, 'Tidak terkirim foto', '2022-01-21 07:27:48', 0, 1, 'text'),
(221, 19, 37, '-7.0883682, 107.981773', '2022-01-21 12:12:26', 1, 1, 'shareloc'),
(222, 19, 22, '-7.0882585, 107.9817926', '2022-01-21 12:13:57', 0, 0, 'shareloc'),
(223, 19, 37, '-7.087697, 107.9837397', '2022-01-21 12:24:36', 1, 1, 'shareloc'),
(224, 19, 28, '-7.0891807, 107.981926', '2022-01-21 13:06:58', 0, 1, 'shareloc'),
(225, 19, 28, '-7.089181, 107.9819261', '2022-01-21 13:07:09', 0, 1, 'shareloc'),
(227, 19, 28, '-7.0891764, 107.9819281', '2022-01-21 13:14:16', 0, 1, 'shareloc'),
(228, 19, 22, '-7.0891773, 107.9819269', '2022-01-21 13:28:12', 0, 0, 'shareloc'),
(229, 29, 19, '-7.2085198, 107.8985155', '2022-01-21 14:59:30', 0, 0, 'shareloc'),
(230, 41, 21, 'Halo', '2022-01-21 15:25:19', 0, 0, 'text'),
(231, 41, 21, '-7.3161475, 112.722757', '2022-01-21 15:27:28', 0, 0, 'shareloc'),
(232, 41, 21, 'Apakabar', '2022-01-21 15:30:06', 0, 0, 'text'),
(233, 43, 28, '-7.0891819, 107.9819287', '2022-01-21 16:30:28', 1, 1, 'shareloc'),
(234, 43, 28, 'chat-466293760.jpg', '2022-01-21 16:30:56', 1, 1, 'gambar'),
(235, 43, 28, 'P', '2022-01-21 16:30:56', 1, 1, 'text'),
(236, 43, 28, 'chatfile-149436781.jpg', '2022-01-21 16:31:12', 1, 1, 'file'),
(237, 43, 28, '🤬', '2022-01-21 16:31:27', 1, 1, 'text'),
(254, 28, 43, '-7.0891774, 107.9819224', '2022-01-21 21:58:26', 1, 1, 'shareloc'),
(255, 28, 43, '🧐', '2022-01-21 21:59:14', 1, 1, 'text'),
(256, 43, 40, '-7.0891799, 107.9819274', '2022-01-21 22:03:20', 1, 1, 'shareloc'),
(257, 43, 29, 'P', '2022-01-21 22:04:41', 1, 1, 'text'),
(260, 43, 28, '-7.0891777, 107.9819218', '2022-01-21 22:13:59', 1, 1, 'shareloc'),
(261, 43, 28, 'P', '2022-01-21 22:14:27', 1, 1, 'text'),
(262, 43, 28, '-7.0891776, 107.9819231', '2022-01-21 22:29:30', 1, 1, 'shareloc'),
(263, 43, 28, 'chatfile-394302987.jpg', '2022-01-21 22:30:44', 1, 1, 'file'),
(265, 43, 28, 'chat-452184510.jpg', '2022-01-21 22:33:01', 1, 1, 'gambar'),
(272, 43, 28, 'chat-1624524351.jpg', '2022-01-21 22:44:12', 1, 1, 'gambar'),
(273, 43, 28, 'chat-1980722496.jpg', '2022-01-21 22:44:21', 1, 1, 'gambar'),
(276, 28, 43, 'P', '2022-01-21 22:51:44', 1, 1, 'text'),
(277, 28, 43, 'chat-1610711293.jpg', '2022-01-21 22:51:45', 1, 1, 'gambar'),
(278, 43, 28, '-7.0891807, 107.9819276', '2022-01-21 23:02:17', 1, 1, 'shareloc'),
(279, 29, 37, 'Test', '2022-01-21 23:03:25', 1, 1, 'text'),
(280, 29, 37, 'Aya notif teu?', '2022-01-21 23:03:34', 1, 1, 'text'),
(281, 29, 38, 'Nda hadir?', '2022-01-21 23:03:49', 0, 0, 'text'),
(283, 43, 28, 'chat-1712660550.jpg', '2022-01-21 23:09:15', 1, 1, 'gambar'),
(284, 28, 29, '-7.0891781, 107.9819294', '2022-01-21 23:10:25', 1, 1, 'shareloc'),
(285, 28, 29, 'chat-642422875.jpg', '2022-01-21 23:10:36', 1, 1, 'gambar'),
(286, 29, 28, 'chat-316028640.jpg', '2022-01-21 23:45:23', 1, 1, 'gambar'),
(288, 43, 40, '-7.0891776, 107.9819309', '2022-01-22 10:07:45', 0, 1, 'shareloc'),
(289, 43, 40, 'P', '2022-01-22 10:07:49', 0, 1, 'text'),
(290, 43, 40, 'chat-720186994.jpg', '2022-01-22 10:08:07', 0, 1, 'gambar'),
(297, 29, 37, '-7.0899368, 107.9841101', '2022-01-22 19:14:35', 1, 1, 'shareloc'),
(298, 37, 29, 'Teaya', '2022-01-22 19:17:00', 0, 1, 'text'),
(299, 44, 40, '-6.230179, 106.83783', '2022-01-23 17:16:12', 0, 0, 'shareloc'),
(300, 43, 28, '-7.089179, 107.9819294', '2022-01-23 17:47:26', 1, 1, 'shareloc'),
(301, 43, 28, 'P', '2022-01-23 17:47:31', 1, 1, 'text'),
(302, 43, 28, 'P', '2022-01-23 17:47:35', 1, 1, 'text'),
(303, 43, 28, 'P', '2022-01-23 17:47:37', 1, 1, 'text'),
(308, 28, 44, 'P', '2022-01-23 19:36:22', 1, 1, 'text'),
(316, 28, 40, '-6.230198, 106.8378634', '2022-01-28 14:31:18', 0, 1, 'shareloc'),
(317, 28, 47, '-7.0891806, 107.9819257', '2022-01-28 16:58:59', 0, 0, 'shareloc'),
(318, 28, 47, 'chatfile-436289142.jpg', '2022-01-28 17:00:18', 0, 0, 'file'),
(319, 28, 47, 'P', '2022-01-28 17:00:18', 0, 0, 'text'),
(320, 28, 47, '😇', '2022-01-28 17:01:00', 0, 0, 'text'),
(321, 28, 47, '😇', '2022-01-28 17:01:00', 0, 0, 'text'),
(322, 28, 47, '😇\n', '2022-01-28 17:01:10', 0, 0, 'text'),
(323, 28, 47, '😇\n', '2022-01-28 17:01:10', 0, 0, 'text'),
(324, 28, 47, '😇\n', '2022-01-28 17:01:10', 0, 0, 'text'),
(325, 28, 47, '😇\n', '2022-01-28 17:01:11', 0, 0, 'text'),
(326, 28, 47, '😇\n', '2022-01-28 17:01:11', 0, 0, 'text'),
(327, 28, 47, '😇\n', '2022-01-28 17:01:12', 0, 0, 'text'),
(328, 28, 47, '😇\n', '2022-01-28 17:01:13', 0, 0, 'text'),
(329, 28, 47, '😇\n', '2022-01-28 17:01:13', 0, 0, 'text'),
(330, 28, 47, '😇', '2022-01-28 17:01:20', 0, 0, 'text'),
(331, 28, 47, '😇', '2022-01-28 17:01:22', 0, 0, 'text'),
(332, 28, 47, '😇', '2022-01-28 17:01:42', 0, 0, 'text'),
(333, 28, 47, '-7.0891619, 107.9819547', '2022-01-28 17:02:05', 0, 0, 'shareloc'),
(335, 28, 47, '-7.0891632, 107.9819708', '2022-01-28 17:02:50', 0, 0, 'shareloc'),
(336, 43, 28, 'P', '2022-01-28 17:06:33', 1, 1, 'text'),
(337, 43, 28, 'chat-1850732986.jpg', '2022-01-28 17:06:33', 1, 1, 'gambar'),
(338, 43, 28, 'P', '2022-01-28 17:06:34', 1, 1, 'text'),
(339, 43, 28, 'chat-1855921586.jpg', '2022-01-28 17:07:01', 1, 1, 'gambar'),
(340, 43, 28, '-7.089176, 107.9819312', '2022-01-28 17:07:08', 1, 1, 'shareloc'),
(345, 43, 28, '-6.2372969, 106.6290792', '2022-02-06 22:04:36', 1, 1, 'shareloc'),
(346, 40, 29, '-7.3161294, 112.7211422', '2022-02-14 14:16:34', 1, 1, 'shareloc'),
(347, 29, 28, 'Test', '2022-02-14 14:21:06', 1, 1, 'text'),
(348, 41, 29, 'Tes', '2022-02-15 06:33:00', 0, 1, 'text'),
(349, 41, 29, 'chatfile-162199034.jpg', '2022-02-15 06:33:25', 0, 1, 'file'),
(350, 41, 29, 'Tes gambar', '2022-02-15 06:33:39', 0, 1, 'text'),
(351, 41, 29, 'Gambar', '2022-02-15 06:34:34', 0, 1, 'text'),
(352, 41, 29, '-7.3162035, 112.7226619', '2022-02-15 06:34:41', 0, 1, 'shareloc'),
(353, 29, 28, '-6.2352171, 106.6108947', '2022-02-16 14:35:56', 1, 1, 'shareloc'),
(354, 28, 29, 'chat-1363342025.jpg', '2022-02-22 10:48:51', 0, 0, 'gambar'),
(355, 28, 29, 'P', '2022-02-22 10:48:51', 0, 0, 'text'),
(356, 48, 29, 'Test', '2022-02-22 18:21:48', 0, 0, 'text'),
(357, 48, 29, '🤡', '2022-02-22 18:21:54', 0, 0, 'text'),
(358, 48, 29, '-6.2557876, 106.6045865', '2022-02-22 19:32:54', 0, 0, 'shareloc'),
(360, 48, 49, 'Test', '2022-02-22 19:34:35', 1, 1, 'text'),
(361, 48, 49, 'chat-1223600248.jpg', '2022-02-22 19:34:43', 1, 1, 'gambar'),
(362, 48, 49, '-6.2557963, 106.604578', '2022-02-22 19:34:48', 1, 1, 'shareloc'),
(363, 48, 49, '🤐', '2022-02-22 19:34:52', 1, 1, 'text'),
(364, 28, 48, 'test', '2022-02-22 19:37:38', 1, 1, 'text'),
(365, 28, 48, '😫', '2022-02-22 19:38:25', 1, 1, 'text'),
(366, 48, 28, 'Hai', '2022-02-22 19:39:56', 1, 1, 'text'),
(368, 48, 28, '-6.2557941, 106.6045789', '2022-02-22 19:42:37', 1, 1, 'shareloc'),
(369, 48, 28, '🤪', '2022-02-22 19:43:17', 1, 1, 'text'),
(370, 28, 40, 'test', '2022-03-08 14:12:18', 0, 0, 'text');

-- --------------------------------------------------------

--
-- Table structure for table `chat_group`
--

CREATE TABLE `chat_group` (
  `group_id` int(8) NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `group_type` enum('public','private') NOT NULL DEFAULT 'private',
  `photo` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_at` datetime DEFAULT NULL,
  `deleted` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat_group`
--

INSERT INTO `chat_group` (`group_id`, `group_name`, `group_type`, `photo`, `created_by`, `create_at`, `update_at`, `delete_at`, `deleted`) VALUES
(1, 'Ini Group Tes', 'private', '660701717.jpeg', 28, '2022-01-11 00:24:22', '2022-01-11 00:24:22', NULL, NULL),
(2, '', 'private', '251204293.', 0, '2022-01-11 01:10:01', '2022-01-11 01:10:01', NULL, NULL),
(3, 'Tes grup', 'private', '514834799.png', 19, '2022-01-11 01:15:54', '2022-01-11 01:15:54', NULL, NULL),
(4, 'Sisters kom', 'private', '2103197287.jpg', 28, '2022-02-22 03:45:45', '2022-02-22 03:45:45', NULL, NULL),
(5, 'Eagle', 'private', '734840252.jpg', 28, '2022-02-22 03:46:39', '2022-02-22 03:46:39', NULL, NULL),
(6, 'Training', 'private', '1120712449.jpg', 28, '2022-02-22 09:47:42', '2022-02-22 09:47:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_group_file`
--

CREATE TABLE `chat_group_file` (
  `cgf_id` int(15) NOT NULL,
  `cgm_id` int(15) NOT NULL,
  `cgf_name` text NOT NULL,
  `cgf_path` varchar(100) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delete_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chat_group_member`
--

CREATE TABLE `chat_group_member` (
  `id` int(11) NOT NULL,
  `group_id` int(8) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_type` enum('user','admin') NOT NULL DEFAULT 'user',
  `joined_by` int(11) NOT NULL,
  `member_status` enum('join','remove','exit') NOT NULL DEFAULT 'join',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delete_at` timestamp NULL DEFAULT NULL,
  `deleted` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat_group_member`
--

INSERT INTO `chat_group_member` (`id`, `group_id`, `member_id`, `member_type`, `joined_by`, `member_status`, `create_at`, `update_at`, `delete_at`, `deleted`) VALUES
(1, 1, 28, 'admin', 28, 'join', '2022-01-11 00:24:22', '2022-01-11 00:24:22', NULL, NULL),
(2, 1, 37, 'user', 28, 'join', '2022-01-11 00:24:22', '2022-01-11 00:24:22', NULL, NULL),
(3, 1, 29, 'user', 28, 'join', '2022-01-11 00:24:22', '2022-01-11 00:24:22', NULL, NULL),
(4, 1, 22, 'user', 28, 'join', '2022-01-11 00:24:22', '2022-01-11 00:24:22', NULL, NULL),
(5, 2, 0, 'admin', 0, 'join', '2022-01-11 01:10:01', '2022-01-11 01:10:01', NULL, NULL),
(6, 3, 19, 'admin', 19, 'join', '2022-01-11 01:15:54', '2022-01-11 01:15:54', NULL, NULL),
(7, 3, 37, 'user', 19, 'join', '2022-01-11 01:15:54', '2022-01-11 01:15:54', NULL, NULL),
(8, 3, 29, 'user', 19, 'join', '2022-01-11 01:15:54', '2022-01-11 01:15:54', NULL, NULL),
(9, 3, 28, 'user', 19, 'join', '2022-01-11 01:15:54', '2022-01-11 01:15:54', NULL, NULL),
(10, 3, 22, 'user', 19, 'join', '2022-01-11 01:15:54', '2022-01-11 01:15:54', NULL, NULL),
(11, 3, 21, 'user', 19, 'join', '2022-01-11 01:15:54', '2022-01-11 01:15:54', NULL, NULL),
(12, 3, 20, 'user', 19, 'join', '2022-01-11 01:15:54', '2022-01-11 01:15:54', NULL, NULL),
(13, 4, 28, 'admin', 28, 'join', '2022-02-22 03:45:45', '2022-02-22 03:45:45', NULL, NULL),
(14, 4, 43, 'user', 28, 'join', '2022-02-22 03:45:45', '2022-02-22 03:45:45', NULL, NULL),
(15, 4, 41, 'user', 28, 'join', '2022-02-22 03:45:45', '2022-02-22 03:45:45', NULL, NULL),
(16, 4, 40, 'user', 28, 'join', '2022-02-22 03:45:45', '2022-02-22 03:45:45', NULL, NULL),
(17, 4, 37, 'user', 28, 'join', '2022-02-22 03:45:45', '2022-02-22 03:45:45', NULL, NULL),
(18, 4, 29, 'user', 28, 'join', '2022-02-22 03:45:45', '2022-02-22 03:45:45', NULL, NULL),
(19, 5, 28, 'admin', 28, 'join', '2022-02-22 03:46:39', '2022-02-22 03:46:39', NULL, NULL),
(20, 5, 43, 'user', 28, 'join', '2022-02-22 03:46:39', '2022-02-22 03:46:39', NULL, NULL),
(21, 5, 41, 'user', 28, 'join', '2022-02-22 03:46:39', '2022-02-22 03:46:39', NULL, NULL),
(22, 5, 40, 'user', 28, 'join', '2022-02-22 03:46:39', '2022-02-22 03:46:39', NULL, NULL),
(23, 5, 37, 'user', 28, 'join', '2022-02-22 03:46:39', '2022-02-22 03:46:39', NULL, NULL),
(24, 5, 29, 'user', 28, 'join', '2022-02-22 03:46:39', '2022-02-22 03:46:39', NULL, NULL),
(25, 6, 28, 'admin', 28, 'join', '2022-02-22 09:47:42', '2022-02-22 09:47:42', NULL, NULL),
(26, 6, 43, 'user', 28, 'join', '2022-02-22 09:47:42', '2022-02-22 09:47:42', NULL, NULL),
(27, 6, 40, 'user', 28, 'join', '2022-02-22 09:47:42', '2022-02-22 09:47:42', NULL, NULL),
(28, 6, 29, 'user', 28, 'join', '2022-02-22 09:47:42', '2022-02-22 09:47:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_group_message`
--

CREATE TABLE `chat_group_message` (
  `cgm_id` int(15) NOT NULL,
  `group_id` int(11) NOT NULL,
  `cgm_sender` int(11) NOT NULL,
  `cgm_forward` int(11) DEFAULT NULL,
  `cgm_reply` int(15) DEFAULT NULL,
  `cgm_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `cgm_path` text DEFAULT NULL,
  `cgm_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `cgm_type` enum('text','file','shareloc','gambar') NOT NULL DEFAULT 'text',
  `cgm_status` int(2) NOT NULL DEFAULT 0,
  `cgm_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat_group_message`
--

INSERT INTO `chat_group_message` (`cgm_id`, `group_id`, `cgm_sender`, `cgm_forward`, `cgm_reply`, `cgm_message`, `cgm_path`, `cgm_time`, `cgm_type`, `cgm_status`, `cgm_update`) VALUES
(1, 1, 28, NULL, NULL, 'Hallo', NULL, '2022-01-11 00:24:28', 'text', 1, '2022-01-11 04:50:30'),
(2, 1, 28, NULL, NULL, '-5.3809442, 105.1283813', NULL, '2022-01-11 00:24:32', 'shareloc', 1, '2022-01-11 04:50:30'),
(3, 1, 28, NULL, NULL, '😂', NULL, '2022-01-11 00:24:38', 'text', 1, '2022-01-11 04:50:30'),
(4, 3, 19, NULL, NULL, 'Hallo', NULL, '2022-01-11 01:16:03', 'text', 1, '2022-01-12 15:34:38'),
(5, 3, 19, NULL, NULL, '\n', NULL, '2022-01-11 01:16:03', 'text', 1, '2022-01-12 15:34:38'),
(6, 3, 19, NULL, NULL, 'Tekan enter dua kali UAt posisi sedang masih tahap decoding', NULL, '2022-01-11 01:16:54', 'text', 1, '2022-01-12 15:34:38'),
(7, 3, 19, NULL, NULL, '\n😐', NULL, '2022-01-11 01:19:35', 'text', 1, '2022-01-12 15:34:38'),
(8, 3, 19, NULL, NULL, 'Screenshot_20220111_081717.jpg', 'group-1709697977.jpg', '2022-01-11 01:19:48', 'gambar', 1, '2022-01-12 15:34:38'),
(9, 1, 29, NULL, NULL, '👍', NULL, '2022-01-11 04:50:54', 'text', 1, '2022-01-12 15:34:33'),
(10, 1, 28, NULL, NULL, '😂', NULL, '2022-01-13 05:35:00', 'text', 1, '2022-01-19 07:55:53'),
(11, 3, 19, NULL, NULL, 'Walaler atuh ahahaa', NULL, '2022-01-13 05:38:21', 'text', 1, '2022-01-14 06:47:57'),
(12, 3, 19, NULL, NULL, 'tes', NULL, '2022-01-13 05:40:01', 'text', 1, '2022-01-14 06:47:57'),
(14, 3, 21, NULL, NULL, 'Test grup', NULL, '2022-01-14 06:48:21', 'text', 1, '2022-01-14 09:10:02'),
(15, 3, 21, NULL, NULL, 'file_2022_01_44_5411842207720843594.jpg', 'group-2078331381.jpg', '2022-01-14 06:49:07', 'gambar', 1, '2022-01-14 09:10:02'),
(16, 3, 29, NULL, NULL, '-7.2085157, 107.8985227', NULL, '2022-01-17 10:19:01', 'shareloc', 1, '2022-01-19 04:09:19'),
(17, 3, 37, NULL, NULL, '\n', NULL, '2022-01-19 07:55:21', 'text', 1, '2022-01-19 13:32:43'),
(18, 1, 37, NULL, NULL, 'Test', NULL, '2022-01-19 07:56:00', 'text', 1, '2022-01-23 12:36:02'),
(19, 3, 19, NULL, NULL, '-7.089182, 107.9819311', NULL, '2022-01-19 13:32:51', 'shareloc', 0, '2022-01-19 13:32:51'),
(20, 1, 37, NULL, NULL, '-7.2085121, 107.8985151', NULL, '2022-01-20 06:41:40', 'shareloc', 1, '2022-01-23 12:36:02'),
(21, 3, 19, NULL, NULL, '-7.0892577, 107.9820491', NULL, '2022-01-20 07:27:11', 'shareloc', 0, '2022-01-20 07:27:11'),
(22, 5, 28, NULL, NULL, 'Ping', NULL, '2022-02-22 03:46:54', 'text', 0, '2022-02-22 03:46:54'),
(23, 5, 28, NULL, NULL, '-7.3163211, 112.7227086', NULL, '2022-02-22 03:47:02', 'shareloc', 0, '2022-02-22 03:47:02'),
(24, 5, 28, NULL, NULL, '20220222_084012.jpg', 'groupfile-1781906759.jpg', '2022-02-22 03:47:48', 'file', 0, '2022-02-22 03:47:48'),
(25, 5, 28, NULL, NULL, 'img_20220222_104904_7929006669653512035.jpg', 'group-1639418038.jpg', '2022-02-22 03:49:13', 'gambar', 0, '2022-02-22 03:49:13'),
(26, 5, 28, NULL, NULL, 'P', NULL, '2022-02-22 03:49:25', 'text', 0, '2022-02-22 03:49:25'),
(27, 5, 28, NULL, NULL, '-7.3163145, 112.7227065', NULL, '2022-02-22 03:49:28', 'shareloc', 0, '2022-02-22 03:49:28'),
(28, 5, 28, NULL, NULL, 'img_20220222_104932_4370499056064785615.jpg', 'group-449317190.jpg', '2022-02-22 03:49:41', 'gambar', 0, '2022-02-22 03:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `cuty`
--

CREATE TABLE `cuty` (
  `cuty_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `cuty_start` date NOT NULL,
  `cuty_end` date NOT NULL,
  `date_work` date NOT NULL,
  `cuty_total` int(5) NOT NULL,
  `cuty_description` varchar(100) NOT NULL,
  `cuty_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuty`
--

INSERT INTO `cuty` (`cuty_id`, `employees_id`, `cuty_start`, `cuty_end`, `date_work`, `cuty_total`, `cuty_description`, `cuty_status`) VALUES
(3, 22, '2021-12-26', '2021-12-30', '2021-12-31', 8, 'Mau jelong jelong', 2),
(4, 48, '2022-03-12', '2022-03-14', '2022-03-15', 2, 'Urusan keluarga', 3);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employees_code` varchar(35) NOT NULL,
  `employees_nip` varchar(30) NOT NULL,
  `employees_email` varchar(30) NOT NULL,
  `employees_password` varchar(100) NOT NULL,
  `employees_name` varchar(50) NOT NULL,
  `position_id` int(5) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `user_status` varchar(20) NOT NULL DEFAULT 'online',
  `created_login` datetime NOT NULL,
  `created_cookies` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employees_code`, `employees_nip`, `employees_email`, `employees_password`, `employees_name`, `position_id`, `shift_id`, `building_id`, `photo`, `user_status`, `created_login`, `created_cookies`) VALUES
(28, '2021/11111111111111/2021-12-28', '7506071xx2', 'admin@gmail.com', '93f1b997ab5cf21ac0678754f2b8c4a1bb612221ec90bbfaee8f8c0067fb7cb4', 'admin', 1, 1, 1, '', 'diluar', '2022-03-10 13:14:26', '75d23af433e0cea4c0e45a56dba18b30'),
(29, '2021/09765572/2021-12-28', '09765572', 'emilmuttakin88garut@gmail.com', '02851becc07ed15e8f85b24e4b22abc7db6a434a50f4af1468ddfdd26471d398', 'Emil Mutaqin', 1, 1, 1, '29-79e4bfd196b62786e838fddd1541dfe8-164854-.jpg', 'online', '2022-02-27 15:28:22', 'daaa4c69477ea3cfbf779f36e8a46361'),
(37, '2022/000100092022/2022-01-07', '000100092022', 'cnbuziegrt@gmail.com', 'ace4e667b836f603afa31b5cee6be65d4d1e88e71f737f74216ec2b915fc318d', 'FauziF', 1, 1, 1, '', 'online', '2022-01-14 21:56:53', '5413f08be6044e09d1e781b810be63c6'),
(40, '2022/Udjdjd/2022-01-18', '7506071xx', 'admin2@gmail.com', '93f1b997ab5cf21ac0678754f2b8c4a1bb612221ec90bbfaee8f8c0067fb7cb4', 'admin2', 1, 1, 1, '', 'online', '2022-03-10 13:14:26', '75d23af433e0cea4c0e45a56dba18b30'),
(41, '2022/75060715/2022-01-21', '75060715', 'yusupsaprudin2019@gmail.com', 'acd2bcf0a751e78ba7a1904d55cb26b00b7b5c21ea1c7a91b373c2cf44ae0b29', 'Yusup Saprudin', 22, 1, 1, '', 'online', '2022-02-14 16:38:57', '76eb070e20b90e2114e66bbbcc882148'),
(43, 'P-004-2022', '', 'ariesnotfound04@gmail.com', '', 'aris notfound', 1, 1, 1, '', 'online', '2022-01-21 16:30:10', 'a2cf05b7e0e0753abe172dece03c8215'),
(48, '2022/123456/2022-02-22', '123456', 'nda.ramdhana@gmail.com', '768d671315907da21548415394e2ec1b70d697e071d1fa654f1a9b3a3549430d', 'Nanda Ramdhana', 18, 1, 1, '48-c5aa2a7170bdd31ecad87d7e884190c4-182548-.jpg', 'online', '2022-02-22 18:11:48', '9ccbfb203bac3b92133de5dbf2bc11b9'),
(49, 'P-005-2022', '', 'data.janusa@gmail.com', '', 'data janusa', 1, 1, 1, '', 'online', '2022-02-22 18:18:32', '91c18f42e4704149cd5c0b7b079f18da');

-- --------------------------------------------------------

--
-- Table structure for table `m_work_report`
--

CREATE TABLE `m_work_report` (
  `id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL COMMENT 'laporannya dari user siapa',
  `employe_name` varchar(125) DEFAULT NULL COMMENT 'Pengirim',
  `point` enum('1','2','3','4','5') NOT NULL,
  `about` longtext NOT NULL,
  `fakta_fakta` longtext NOT NULL,
  `camera` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `analisa` longtext NOT NULL,
  `upaya` longtext NOT NULL,
  `rekomendasi` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_work_report`
--

INSERT INTO `m_work_report` (`id`, `employe_id`, `employe_name`, `point`, `about`, `fakta_fakta`, `camera`, `link`, `analisa`, `upaya`, `rekomendasi`, `created_at`, `updated_at`) VALUES
(19, 19, '5', '1', 'Prihal', 'Jdjdjjd', '19-cam-1642738987.png', '', 'Anali', 'Uo', 'Rek', '2022-01-21 11:23:07', '2022-01-21 11:23:07'),
(21, 29, 'P1', '4', 'Test laporan sister kominda untuk menguji experience program', '1. .....\r\n2. .....\r\n3. .....\r\n4. .....', '', '', 'Catatan test 1', 'Upaya test 1', 'Rekomendasi test 1', '2022-01-21 15:08:15', '2022-01-21 15:08:15'),
(22, 43, 'V', '3', ' ', '', '43-cam-1642777972.png', '', '', '', '', '2022-01-21 22:12:52', '2022-01-21 22:12:52'),
(23, 0, 'Ttt', '3', 'Ggt', 'Ggt', '', '', 'T', 'G', '55', '2022-01-22 09:15:08', '2022-01-22 09:15:08'),
(24, 48, 'Nanda', '1', 'Halo', 'Pembunuhan', '', '', 'Gdhdh', 'Vsgs', 'Gdgdg', '2022-02-22 18:36:36', '2022-02-22 18:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE `online` (
  `online_id` int(11) NOT NULL,
  `online_pengirim` int(11) NOT NULL,
  `online_penerima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(5) NOT NULL,
  `position_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`) VALUES
(1, 'STAFF'),
(9, 'Kabinda'),
(10, 'Kabag Ops'),
(11, 'Kasubag Opsin'),
(12, 'Kasubag Dukminops'),
(13, 'Kasubag Teksiber'),
(14, 'Staf Opsin'),
(15, 'Staf Dukminops'),
(16, 'Staf Teksiber'),
(17, 'Staf Khusus'),
(18, 'Driver'),
(19, 'ADC Ka'),
(20, 'Kaposda'),
(21, 'Posda'),
(22, 'Staf Khusus Ka');

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE `presence` (
  `presence_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `presence_date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `present_id` int(11) NOT NULL COMMENT 'Masuk,Pulang,Tidak Hadir',
  `latitude_longtitude_in` varchar(100) NOT NULL,
  `latitude_longtitude_out` varchar(100) NOT NULL,
  `information` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`presence_id`, `employees_id`, `presence_date`, `time_in`, `time_out`, `present_id`, `latitude_longtitude_in`, `latitude_longtitude_out`, `information`) VALUES
(13, 6, '2021-09-13', '12:13:51', '00:00:00', 1, '-5.3845586,105.26526899999999', '', ''),
(14, 6, '2021-09-14', '09:06:21', '16:35:01', 1, '-5.4028375,105.2601191', '-5.4028459,105.2601085', ''),
(15, 6, '2021-09-15', '14:11:48', '21:27:10', 1, '-5.4028596,105.2601037', '-0.789275,113.92132699999999', ''),
(17, 6, '2021-09-16', '10:10:55', '00:00:00', 1, '-5.4099968,105.26719999999999', '', ''),
(18, 6, '2021-09-18', '23:31:56', '00:00:00', 1, '-0.789275,113.92132699999999', '', ''),
(19, 6, '2021-09-20', '22:15:58', '00:00:00', 1, '-5.3971396,105.2667887', '', ''),
(20, 22, '2021-12-26', '10:40:15', '00:00:00', 1, '-7.3161545,112.7210619', '', ''),
(21, 32, '2021-12-30', '12:46:45', '00:00:00', 1, '2.4692023,100.3385733', '', ''),
(22, 32, '2022-01-03', '03:18:46', '00:00:00', 1, '2.4692023,100.3385733', '', ''),
(23, 32, '2022-01-04', '17:06:24', '17:06:24', 1, '2.4692023,100.3385733', '2.4692023,100.3385733', ''),
(24, 29, '2022-01-21', '17:14:03', '17:14:03', 1, '-6.9174639,107.6191228', '-6.9174639,107.6191228', ''),
(25, 28, '2022-02-22', '18:53:57', '18:53:57', 1, '-6.2557945,106.6045799', '-6.2557945,106.6045799', ''),
(26, 48, '2022-03-09', '11:21:19', '00:00:00', 1, '-6.3504384,106.381312', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `present_status`
--

CREATE TABLE `present_status` (
  `present_id` int(6) NOT NULL,
  `present_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `present_status`
--

INSERT INTO `present_status` (`present_id`, `present_name`) VALUES
(1, 'Hadir'),
(2, 'Sakit'),
(3, 'Izin');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `shift_id` int(11) NOT NULL,
  `shift_name` varchar(20) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_id`, `shift_name`, `time_in`, `time_out`) VALUES
(1, 'FULL TIME', '07:30:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sw_site`
--

CREATE TABLE `sw_site` (
  `site_id` int(4) NOT NULL,
  `site_url` varchar(100) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `site_company` varchar(30) NOT NULL,
  `site_manager` varchar(30) NOT NULL,
  `site_director` varchar(30) NOT NULL,
  `site_phone` char(12) NOT NULL,
  `site_address` text NOT NULL,
  `site_description` text NOT NULL,
  `site_logo` varchar(50) NOT NULL,
  `site_email` varchar(30) NOT NULL,
  `site_email_domain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sw_site`
--

INSERT INTO `sw_site` (`site_id`, `site_url`, `site_name`, `site_company`, `site_manager`, `site_director`, `site_phone`, `site_address`, `site_description`, `site_logo`, `site_email`, `site_email_domain`) VALUES
(1, 'https://sisterskominda.eagleye.id', 'Sisters Kominda Jatim', 'BIN Jatim ', ' ', ' ', '-', 'Jl. Ketintang Madya', 'Dashboard SISTER KOMINDA adalah alat yang digunakan untuk manajemen informasi dan intelijen bisnis. \r\n\r\nDengan menggunakan visualisasi atau data visualization, dasbor mengomunikasikan metrik secara visual untuk membantu pengguna memahami hubungan yang kompleks dalam datanya.', 'logo-sisters-kominda-jatim-tekspng.png', 'cs@eagleye.id', 'noreply@eagleye.id');

-- --------------------------------------------------------

--
-- Table structure for table `tr_forward_report_to_work_report`
--

CREATE TABLE `tr_forward_report_to_work_report` (
  `id` int(11) NOT NULL,
  `work_report_id` int(11) NOT NULL,
  `employe_name` varchar(125) NOT NULL COMMENT 'user tembusan',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_forward_report_to_work_report`
--

INSERT INTO `tr_forward_report_to_work_report` (`id`, `work_report_id`, `employe_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Fahmi', '2021-12-29 07:35:46', '2021-12-29 07:35:46'),
(2, 1, 'Faturrohman', '2021-12-29 07:35:46', '2021-12-29 07:35:46'),
(28, 19, 'C', '2022-01-21 11:23:07', '2022-01-21 11:23:07'),
(31, 21, 'T2', '2022-01-21 15:08:15', '2022-01-21 15:08:15'),
(32, 22, 'V', '2022-01-21 22:12:52', '2022-01-21 22:12:52'),
(33, 23, 'Tt', '2022-01-22 09:15:08', '2022-01-22 09:15:08'),
(34, 24, 'Emil mutaqin', '2022-02-22 18:36:36', '2022-02-22 18:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `tr_picture_to_work_report`
--

CREATE TABLE `tr_picture_to_work_report` (
  `id` int(11) NOT NULL,
  `work_report_id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_picture_to_work_report`
--

INSERT INTO `tr_picture_to_work_report` (`id`, `work_report_id`, `picture`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '780995-1000xauto-rurin-nirmala.jpg', 'Ini Pipin', '2021-12-29 07:35:46', '2021-12-29 07:35:46'),
(2, 1, '614dc6865eb24.jpg', 'Nasi Goreng', '2021-12-29 07:35:46', '2021-12-29 07:35:46'),
(26, 19, 'IMG_20220120_201805.jpg', '', '2022-01-21 11:23:07', '2022-01-21 11:23:07'),
(29, 21, 'IMG_1642752437870.jpg', 'Test gambar', '2022-01-21 15:08:15', '2022-01-21 15:08:15'),
(30, 22, '', '', '2022-01-21 22:12:52', '2022-01-21 22:12:52'),
(31, 23, '', '', '2022-01-22 09:15:08', '2022-01-22 09:15:08'),
(32, 24, 'Screenshot_20220222_180838.jpg', '', '2022-02-22 18:36:36', '2022-02-22 18:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `tr_report_purpose_to_work_report`
--

CREATE TABLE `tr_report_purpose_to_work_report` (
  `id` int(11) NOT NULL,
  `work_report_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL COMMENT 'user_penerima',
  `employe_name` varchar(125) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_report_purpose_to_work_report`
--

INSERT INTO `tr_report_purpose_to_work_report` (`id`, `work_report_id`, `employe_id`, `employe_name`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Agung Hardiyanto', '2021-12-29 07:35:46', '2021-12-29 07:35:46'),
(2, 1, 0, 'Agung Hardiyanto 2', '2021-12-29 07:35:46', '2021-12-29 07:35:46'),
(28, 19, 19, 'B', '2022-01-21 11:23:07', '2022-01-21 11:23:07'),
(31, 21, 29, 'T1', '2022-01-21 15:08:15', '2022-01-21 15:08:15'),
(32, 22, 43, 'B', '2022-01-21 22:12:52', '2022-01-21 22:12:52'),
(33, 23, 0, 'Yggtt', '2022-01-22 09:15:08', '2022-01-22 09:15:08'),
(34, 23, 0, 'Hgtt', '2022-01-22 09:15:08', '2022-01-22 09:15:08'),
(35, 24, 48, 'Yusup saprudin', '2022-02-22 18:36:36', '2022-02-22 18:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `registered` datetime NOT NULL,
  `created_login` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `session` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `fullname`, `registered`, `created_login`, `last_login`, `session`, `ip`, `browser`, `level`) VALUES
(3, 'admin', 'testadmin@gmail.com', '377f4518c6457f2bcb393783aa64c28dd798285fabd4bd26bca89ebc2c6d0813', 'admin', '2021-12-28 16:21:56', '2022-03-09 20:46:27', '2022-01-25 11:40:58', '-', '1', 'Google Crome', 1),
(4, 'opr', 'tesopr@gmail.com', '377f4518c6457f2bcb393783aa64c28dd798285fabd4bd26bca89ebc2c6d0813', 'Opr Admin', '2021-12-28 16:22:28', '2022-03-09 20:46:27', '2021-12-28 16:22:28', '-', '1', 'Google Crome', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `level_id` int(4) NOT NULL,
  `level_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`level_id`, `level_name`) VALUES
(1, 'Administrator'),
(2, 'Operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `business_card`
--
ALTER TABLE `business_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `chat_group`
--
ALTER TABLE `chat_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `chat_group_file`
--
ALTER TABLE `chat_group_file`
  ADD PRIMARY KEY (`cgf_id`);

--
-- Indexes for table `chat_group_member`
--
ALTER TABLE `chat_group_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_group_message`
--
ALTER TABLE `chat_group_message`
  ADD PRIMARY KEY (`cgm_id`);

--
-- Indexes for table `cuty`
--
ALTER TABLE `cuty`
  ADD PRIMARY KEY (`cuty_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_work_report`
--
ALTER TABLE `m_work_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`online_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`presence_id`);

--
-- Indexes for table `present_status`
--
ALTER TABLE `present_status`
  ADD PRIMARY KEY (`present_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `sw_site`
--
ALTER TABLE `sw_site`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `tr_forward_report_to_work_report`
--
ALTER TABLE `tr_forward_report_to_work_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_picture_to_work_report`
--
ALTER TABLE `tr_picture_to_work_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_report_purpose_to_work_report`
--
ALTER TABLE `tr_report_purpose_to_work_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `building_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `business_card`
--
ALTER TABLE `business_card`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT for table `chat_group`
--
ALTER TABLE `chat_group`
  MODIFY `group_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat_group_file`
--
ALTER TABLE `chat_group_file`
  MODIFY `cgf_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_group_member`
--
ALTER TABLE `chat_group_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `chat_group_message`
--
ALTER TABLE `chat_group_message`
  MODIFY `cgm_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cuty`
--
ALTER TABLE `cuty`
  MODIFY `cuty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `m_work_report`
--
ALTER TABLE `m_work_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `online`
--
ALTER TABLE `online`
  MODIFY `online_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `presence`
--
ALTER TABLE `presence`
  MODIFY `presence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `present_status`
--
ALTER TABLE `present_status`
  MODIFY `present_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sw_site`
--
ALTER TABLE `sw_site`
  MODIFY `site_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tr_forward_report_to_work_report`
--
ALTER TABLE `tr_forward_report_to_work_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tr_picture_to_work_report`
--
ALTER TABLE `tr_picture_to_work_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tr_report_purpose_to_work_report`
--
ALTER TABLE `tr_report_purpose_to_work_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `level_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
