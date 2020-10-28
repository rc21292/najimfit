-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 28, 2020 at 11:52 AM
-- Server version: 5.7.32
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
-- Database: `najimfit_backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `package_id` int(255) NOT NULL,
  `quantity` int(255) DEFAULT NULL,
  `subtotal` int(255) DEFAULT NULL,
  `coupon` varchar(255) DEFAULT NULL,
  `discount` int(255) DEFAULT NULL,
  `total` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `client_id`, `package_id`, `quantity`, `subtotal`, `coupon`, `discount`, `total`) VALUES
(4, 7, 1, 1, 499, NULL, 0, 499),
(5, 1, 2, 1, 499, NULL, 0, 499),
(8, 11, 1, 1, 499, NULL, 0, 499),
(9, 12, 2, 1, 499, NULL, 0, 499),
(14, 18, 1, 1, 499, NULL, 0, 499),
(15, 19, 1, 1, 499, NULL, 0, 499),
(16, 1, 1, 1, 499, NULL, 0, 499),
(18, 22, 2, 1, 499, NULL, 0, 499),
(19, 18, 3, 1, 199, NULL, 0, 199),
(22, 33, 1, 2, 998, 'FREAK20', 100, 898),
(23, 26, 1, 1, 499, NULL, 0, 499),
(29, 14, 1, 1, 499, NULL, 0, 499),
(85, 42, 3, 1, 199, NULL, 0, 199),
(125, 45, 1, 2, 998, 'FREAK20', 100, 898),
(127, 17, 1, 1, 499, NULL, 0, 499),
(130, 48, 1, 1, 499, NULL, 0, 499);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `address` text COLLATE utf8mb4_unicode_ci,
  `package_id` bigint(20) DEFAULT NULL,
  `validity` date DEFAULT NULL,
  `subscription_date` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(2588) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.png',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `firstname`, `lastname`, `phone`, `gender`, `email`, `active_status`, `dark_mode`, `messenger_color`, `address`, `package_id`, `validity`, `subscription_date`, `email_verified_at`, `avatar`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Johnas', 'White', '9876543210', 'male', 'johnas@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 1, '2020-11-19', '2020-10-21', NULL, NULL, '$2y$10$ueyA6oJKNLV/mtkpX8K2WOBm8Q/hcvOwkzfVSgA1QxXnUP7bF7Xby', 'on', NULL, '2020-08-17 09:19:23', '2020-10-20 08:38:35'),
(2, 'Alena', 'Finch', '9876543212', 'male', 'alena@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 2, '2020-11-20', '2020-10-21', NULL, NULL, '$2y$10$lg7Z6FwRPnkr0f8cEmnEqO6T8AWQFBR1sJtW.XbebYJgNJ.2dHZvK', 'on', NULL, '2020-08-17 10:14:51', '2020-08-17 10:14:51'),
(3, 'Chantale', 'Reynolds', '9854763214', 'female', 'chantale@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 1, '2020-11-27', '2020-10-21', NULL, NULL, '$2y$10$lJEET22WD3WjIWy/2UoDjeZi18poCY2UAzQ4gSB1HlBYuchebeDWG', 'on', NULL, '2020-08-27 13:55:53', '2020-08-27 13:55:53'),
(4, 'Zephr', 'Warren', '9547863214', 'female', 'zephr@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 3, '2021-01-08', '2020-10-21', NULL, NULL, '$2y$10$PV2bXaD1x.AYTm/NTYRJH.4KgCqbRYttzSZHEuk/rGGVSWmcK7/Fi', 'on', NULL, '2020-08-31 23:15:14', '2020-08-31 23:15:14'),
(5, 'Sharda', 'zala', '9724604987', 'female', 'amit@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 2, '2020-11-06', '2020-10-21', NULL, NULL, '$2y$10$4ayoBMVyzJZsSLgMrcpozedi.NZxOt6tGBb6IEdXNdt962DzkUJr6', 'on', NULL, '2020-09-29 09:44:53', '2020-09-29 09:44:53'),
(7, 'Alnah', 'Biu', '9724604988', 'female', 'abz1@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 2, '2020-11-07', '2020-10-21', NULL, NULL, '$2y$10$NJo8EVWX4qJgqwoKcFnPu.sIkudv1F9n/v/2CYmsCcLFbghcmxBYG', 'on', NULL, '2020-09-29 15:51:47', '2020-09-29 15:51:47'),
(8, 'Micheal', 'Pedas', '8320865202', 'female', 'abz2@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 1, '2020-12-22', '2020-10-21', NULL, NULL, '$2y$10$n/oCLaQh.HJ6J3UdK/a42uHZRVJzXG9D5qy57e4DfOoUxRCf6tsiC', 'on', NULL, '2020-09-29 17:04:44', '2020-09-29 17:04:44'),
(9, 'Abhraham', 'Merkel', '8888888888', 'male', 'abb@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 1, '2021-01-29', '2020-10-21', NULL, NULL, '$2y$10$eOBqVD4MoYXUT2JAWNTXxOATr7xoZYLFTssQQ.YfS8y7pMwyfGlnC', 'on', NULL, '2020-09-29 17:14:31', '2020-09-29 17:14:31'),
(10, 'qwqw', 'asdf', '9999577845', 'male', 'abcd@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$N/PP0TVlIaxntbZCrZCe1.xZfxtKuZhVMjCsOP8pG5supIErfX8L6', 'on', NULL, '2020-10-01 10:07:25', '2020-10-01 10:07:25'),
(11, 'kon', 'zzzx', '9754604987', 'female', 'kon@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$p2MNIEEYDzzfdO4DHqDT5uKpFqWNlxDRQM1I/4dtLfLc9Vh6R3AiS', 'on', NULL, '2020-10-05 07:26:05', '2020-10-05 07:26:05'),
(12, 'name', 'name', '36666666', 'male', 'email@email.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$qrP8EF10.5vcfX17P2jDDerd5qgmxCL3AhzQTNF15RE6Zy1Dl8hGu', 'on', NULL, '2020-10-05 08:00:01', '2020-10-05 08:00:01'),
(13, 'firetest', 'firetest', '9999999999', 'female', 'firetest@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$B.qpcUOOaI3MLr.RsnyQDubjyOl3X8vNydxCPYRvhLJwUQwssyKwq', 'on', NULL, '2020-10-05 10:29:38', '2020-10-05 10:29:38'),
(14, 'fire1test', 'fire1test', '9724608869', 'male', 'fire1test@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$5zZHIQ8C4KKn8HDpq4VYqOY7TG9jODnN83ZQObG7pH9awVLhNjDSi', 'on', NULL, '2020-10-05 10:33:11', '2020-10-05 10:33:11'),
(15, 'devansh', 'zala', '7485968596', 'male', 'devansh@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 2, '2020-11-16', '2020-10-21', NULL, '1603804405playstore-icon.png', '$2y$10$kRh3m6JnZqOgZeRS/wtChe2IYagBd15JcvWVH.ZD/f8mgwUNG4UI.', 'on', NULL, '2020-10-05 10:43:32', '2020-10-27 13:23:40'),
(16, 'Raman', 'Singh', '9999577620', 'male', 'rc21292@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$Vj0.sRcm.IVmxJ0TWpTFguf08tjikRGsUnpEBORtWL8vq8aBNFO3O', 'on', NULL, '2020-10-06 07:06:50', '2020-10-21 10:17:24'),
(17, 'Avinash', 'Singh', '9588745521', 'male', 'avinash@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 1, '2020-11-07', '2020-10-21', NULL, '1603700099download.png', '$2y$10$Ea0V7AOD4ttMRGuH9oCDHOLWscHM.UkOZ/2qmJGGvaetRGyY2kwMK', 'on', NULL, '2020-10-06 07:09:08', '2020-10-26 08:14:59'),
(18, 'test', 'test', '39905856', 'female', 'mariam@najim-fitness.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$OQutL9BeP/iGCgPJ1w133OqaWsbpx98TLpX5w4UqKx2lF3NMo1I/C', 'on', NULL, '2020-10-06 09:17:19', '2020-10-06 09:17:19'),
(19, 'mustafa', 'hasan', '36599909', 'male', 'gbay2121212@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$dd5zSp2T6rujadJNojA3nOycgVsVywZaqSQM3UqFgwWLYIxV38vIG', 'on', NULL, '2020-10-06 17:43:41', '2020-10-06 17:43:41'),
(20, 'Raman', 'Singh', '9724604563', 'female', 'test1@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$71aaHFbrKNsfu9dFqO6lY.QEA6h/pk9mjYsngEOYGl7dbh4kd342a', 'on', NULL, '2020-10-07 04:03:44', '2020-10-07 04:03:44'),
(21, 'test2', 'test', '9724685697', 'female', 'test2@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$qBQGpOL/7HKQVUiWcoSBbeJ44ZSwfvkP8S5e2iAyVf.GiWw2eMcEy', 'on', NULL, '2020-10-07 04:07:32', '2020-10-07 04:07:32'),
(22, 'hh', 'hh', '+966253565383', 'male', 'ghh@hh.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$QcXWaQZz2yZfUBz2PBAVPegeiAdl9h/sOrhwInwaEjcn4PFJhyv/.', 'on', NULL, '2020-10-08 07:56:07', '2020-10-08 07:56:07'),
(23, 'ali', 'alhayki', '+97334636696', 'female', 'ali@inagrab.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$ystMQSyYDwCgGThhYF044ewSqR4YBPHjl0TShw7cxEjYYwlaFWw.i', 'on', NULL, '2020-10-08 11:17:14', '2020-10-08 11:17:14'),
(25, 'rony', 'zzzz', '98755458545', 'male', 'rony@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$GEXYjmMaqU/yQVplH0SRC.9GTygNeptjI3s8SVKvkDfaZcrNdp8rq', 'on', NULL, '2020-10-08 19:10:02', '2020-10-08 19:10:02'),
(26, 'baby', 'patel', '+915625362536', 'female', 'baby@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$iHOzxiixVyov13rLSpDv8e/.YLD.Xy7AbQTUiYkZIxQk.FekN7Ose', 'on', NULL, '2020-10-09 06:12:57', '2020-10-09 06:12:57'),
(27, 'bhula', 'patel', '+919685365656', 'male', 'bhulo@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$RbZ3llVCdz3TT6J.uYukJOTTrxAPbch.v3tOiwa2sn7Za4bSUpvfy', 'on', NULL, '2020-10-09 06:24:59', '2020-10-09 06:24:59'),
(28, 'hardki', 'patel', '+919653225555', NULL, 'hardik@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$W0I/hpQEzKe1SIJbTmP9HOxjrNrGSOgOQbnVt2EATeWANIl7Yczci', 'on', NULL, '2020-10-09 06:27:15', '2020-10-09 06:27:15'),
(29, 'kajal', 'raval', '+916532525363', NULL, 'kajal@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$Q29Naoz1JNluPFb4.h5l/OHU3rDU0IK3QRAahrZe1YmrNCKR4eEuS', 'on', NULL, '2020-10-09 06:30:46', '2020-10-09 06:30:46'),
(30, 'paras', 'adnani', '+919685236523', NULL, 'paras@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$fEgTUWBYPVTAbC3mR4FF7eUdzHGADhcctAw4QYa0TfFjYBpyaVUWa', 'on', NULL, '2020-10-09 06:33:36', '2020-10-09 06:33:36'),
(31, 'gendertestzxxx', 'xxx', '+9669685356565', 'female', 'gennder@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$3CoohjDzvHxbUFU2Rpnh8.9X0GPnWuX18/avSqPhZbWzVqA9QIXyK', 'on', NULL, '2020-10-09 06:35:36', '2020-10-09 06:44:19'),
(33, 'Krishna', 'Mishra', '9026574061', 'male', 'er.krishna.mishra@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$XOiJO1WnMuLF.jwdOxTY8.OPJa.XCMJHUvQokIF27UiIK7c6.UkKa', 'on', NULL, '2020-10-09 06:52:59', '2020-10-09 06:55:19'),
(34, 'oza', 'oza', '5555555555', NULL, 'oza@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$O92F5HmuDP9ZPrGMWTgCfOHpbQsgvogk3L1u3z724s6l76ZnKfuhy', 'on', NULL, '2020-10-10 06:08:25', '2020-10-10 06:08:25'),
(35, 'test', 'test', '+97312345678', NULL, 'test@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$9Fh.3hY5sPBtB987aeXnKeVxYSzouhpiri8DNs9SPOsonEccv.EzW', 'on', NULL, '2020-10-10 07:30:02', '2020-10-10 07:30:02'),
(36, 'test', 'test', '+96612345678', 'male', 'testtest@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$ci5plfY0SWKzu.h4EyXEQuhnGpI1YEVGe05mfja784j4ZhiY70fR.', 'on', NULL, '2020-10-10 07:30:56', '2020-10-10 07:31:04'),
(37, 'test', 'test', '+96612345679', 'male', 'testest@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$qG8COMa0phg50Oj2E9h7TOoLvV1/drzvkUaXT7UXfFv.YIotiJXDK', 'on', NULL, '2020-10-11 07:15:38', '2020-10-11 07:15:47'),
(38, 'ab', 'zala', '7485968574', NULL, 'zalaaamitya36@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$F8TTVBAoMFeG07JpVT82me8QsjVQjB4QDP26HR5/63rC2j81zuelq', 'on', NULL, '2020-10-13 06:30:49', '2020-10-13 06:30:49'),
(39, 'test', 'test', '+966123456788', NULL, 'testytest@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$JTMjCE5QRKNTDE6WCBsIw.PbED9zDMYufDEH2hlFMwFSqhf2j8T2i', 'on', NULL, '2020-10-13 08:50:20', '2020-10-13 08:50:20'),
(40, 'bbbb', 'bbbb', '+96697979979', NULL, 'bbbb@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$VsTHz9OHNXeLsve71pIQbeV9akiLlVlF28pVcRkNQbjW8tfolJ8AO', 'on', NULL, '2020-10-13 09:40:01', '2020-10-13 09:40:01'),
(41, 'cccc', 'ccccc', '+9669685323652', NULL, 'cccc@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$q5hoH/xXw6w5Zis2672P6.zfda2RyHL9ecQZ3RI/6nfN0JPEFDyBO', 'on', NULL, '2020-10-13 09:47:23', '2020-10-13 09:47:23'),
(42, 'new user', 'zala', '+966979797997', 'male', 'newuser@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', 1, '2020-11-12', '2020-10-21', NULL, NULL, '$2y$10$UJ2y6pzr03CDjXQTsR5co.uQwREzYLXkQlniD98.ETQ55g6dX3tqO', 'on', NULL, '2020-10-13 18:10:20', '2020-10-13 18:12:15'),
(43, 'hshsgsgs', 'gsgs', '+96676676464', NULL, 'gggg@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$pCnANZKAncg3fq3H6DTkNuTqyLwbSyTA16GXqwnWXpdBAc0GpzNb.', 'on', NULL, '2020-10-13 18:14:59', '2020-10-13 18:14:59'),
(44, 'test', 'test', '+966123456766', NULL, 'tetstetsttest@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$ij2LdOBD5HTCcmzYWt4kau6Wez4aHaaLkWwSE7qfGRk5yOjW2e02O', 'on', NULL, '2020-10-15 07:16:28', '2020-10-15 07:16:28'),
(45, 'dev', 'zala', '+9664664646', 'male', 'dev@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$quAkfU4S7TKdfRVpNpQd5uZocZ6992muQ3d.Yqo6TXiW//BQVPQLu', 'on', NULL, '2020-10-15 07:34:18', '2020-10-15 07:34:27'),
(46, 'dwv', 'zala', '+966968565236', 'male', 'dev2@gmail.com', 0, 0, '#2180f3', 'PO. Box 21836, Shop 2283, Rd 237, 302, Manama, Baharain', NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$EQaVrfGN4GreO7W50HOzNu0DQBrXXGGAo1lIzd4qCzf137hjWXfpq', 'on', NULL, '2020-10-15 09:34:38', '2020-10-15 09:34:50'),
(47, 'hayat', 'hayat', '+9669685236253', 'female', 'hayat@gmail.com', 0, 0, '#2180f3', NULL, 1, '2020-11-19', '2020-10-21', NULL, NULL, '$2y$10$ZkJKPZ26eB00g3PgK/y0Z..gUdzC69q1cQxx7Vr2R4VleaNTGq262', 'on', NULL, '2020-10-20 07:38:56', '2020-10-20 08:11:38'),
(48, 'علي', 'الحايكي', '+96612234567', 'male', 'testetstet@gmail.com', 0, 0, '#2180f3', NULL, 1, '2020-11-19', '2020-10-21', NULL, NULL, '$2y$10$ozgWCpUBke1kF/ewdZSMrOKcuNNzWAk58EZxLWlAb1atM3zv1H6Lq', 'on', NULL, '2020-10-20 08:59:51', '2020-10-20 09:09:08'),
(49, 'fateh', 'gotra', '8825073822', 'male', 'fateh@gmail.com', 0, 0, '#2180f3', NULL, 1, '2020-11-20', '2020-10-21', NULL, NULL, '$2y$10$4St3U51qW7fqZRrx9k8OyOkzzr3ojeydVn3xPbik9WQIngAwKyWjm', 'on', NULL, '2020-10-21 07:20:43', '2020-10-21 08:42:24'),
(50, 'jhon', 'smith', '8956231478', 'male', 'jhon@gmail.com', 0, 0, '#2180f3', NULL, NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$sXJm.HPLQ/cGD3Fb1cE4ze7aAzoaR5sI0ESObNSUNu9TCN6ZW4pzG', 'on', NULL, '2020-10-21 07:53:42', '2020-10-21 13:45:38'),
(57, 'amitone', 'zala', '+9669724604987', 'male', 'amitone@gmail.com', 0, 0, '#2180f3', NULL, NULL, NULL, '2020-10-21', NULL, NULL, '$2y$10$qesCHs10pkxlStRRdbEMAOlHsnvpdeZwFbWWnx889dtbCcF25EzbG', 'on', NULL, '2020-10-24 10:44:29', '2020-10-24 10:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `client_answers`
--

CREATE TABLE `client_answers` (
  `id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `answer` varchar(2500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_answers`
--

INSERT INTO `client_answers` (`id`, `client_id`, `question_id`, `answer`, `created_at`) VALUES
(1, 1, 1, 'Baharain', '2020-09-01 10:45:46'),
(2, 1, 2, 'Manama', '2020-09-01 10:45:46'),
(3, 1, 3, '16 November 1992', '2020-09-01 10:45:46'),
(4, 1, 5, 'Yes I am Married', '2020-09-01 10:45:46'),
(5, 1, 9, '80 kg', '2020-09-01 10:45:46'),
(6, 1, 10, '186 cm', '2020-09-01 10:45:46'),
(7, 1, 11, '42 cm', '2020-09-01 10:45:46'),
(8, 1, 12, '38 cm', '2020-09-01 10:45:46'),
(9, 1, 13, '36cm', '2020-09-01 10:45:46'),
(10, 1, 14, '40 cm', '2020-09-01 10:45:46'),
(11, 1, 15, '22 cm', '2020-09-01 10:45:46'),
(12, 1, 16, 'Diabetes', '2020-09-01 10:45:46'),
(13, 1, 21, 'Yes i Take Medication', '2020-09-01 10:45:46'),
(14, 1, 22, 'Tripride 2', '2020-09-01 10:51:57'),
(15, 2, 1, 'Baharain', '2020-09-01 10:45:46'),
(16, 2, 2, 'Hamala', '2020-09-01 10:45:46'),
(17, 2, 3, '25 December 1991', '2020-09-01 10:45:46'),
(18, 2, 5, 'No', '2020-09-01 10:45:46'),
(19, 2, 9, '82 kg', '2020-09-01 10:45:46'),
(20, 2, 10, '173 cm', '2020-09-01 10:45:46'),
(21, 2, 11, '35 cm', '2020-09-01 10:45:46'),
(22, 2, 12, '36 cm', '2020-09-01 10:45:46'),
(23, 2, 13, '34cm', '2020-09-01 10:45:46'),
(24, 2, 14, '38 cm', '2020-09-01 10:45:46'),
(25, 2, 15, '20 cm', '2020-09-01 10:45:46'),
(26, 2, 16, 'Acidity', '2020-09-01 10:45:46'),
(27, 2, 21, 'Yes', '2020-09-01 10:45:46'),
(28, 2, 22, 'Pantacid', '2020-09-01 10:51:57'),
(29, 3, 1, 'Arad', '2020-09-01 10:45:46'),
(30, 3, 2, 'Sanabis', '2020-09-01 10:45:46'),
(31, 3, 3, '06 October 1992', '2020-09-01 10:45:46'),
(32, 3, 5, 'Yes', '2020-09-01 10:45:46'),
(33, 3, 9, '83 kg', '2020-09-01 10:45:46'),
(34, 3, 10, '173 cm', '2020-09-01 10:45:46'),
(35, 3, 11, '38 cm', '2020-09-01 10:45:46'),
(36, 3, 12, '36 cm', '2020-09-01 10:45:46'),
(37, 3, 13, '34 cm', '2020-09-01 10:45:46'),
(38, 3, 14, '38 cm', '2020-09-01 10:45:46'),
(39, 3, 15, '20 cm', '2020-09-01 10:45:46'),
(40, 3, 16, 'Arthritis', '2020-09-01 10:45:46'),
(41, 3, 21, 'Yes i Take Medication', '2020-09-01 10:45:46'),
(42, 3, 22, 'Tamaflex', '2020-09-01 10:51:57'),
(43, 17, 1, 'Baharain', '2020-10-19 12:19:04'),
(44, 17, 2, 'Manama', '2020-10-19 12:22:44'),
(45, 17, 3, 'India', '2020-10-19 12:22:44'),
(46, 17, 4, 'Developer', '2020-10-19 12:22:44'),
(47, 17, 5, 'single', '2020-10-19 12:22:44'),
(48, 15, 1, '', '2020-10-19 12:42:33'),
(49, 15, 2, '', '2020-10-19 12:42:33'),
(50, 47, 1, 'india', '2020-10-20 07:45:36'),
(51, 47, 2, 'sggs', '2020-10-20 07:45:36'),
(52, 47, 3, 'gdgdg', '2020-10-20 07:45:36'),
(53, 47, 4, 'dggd', '2020-10-20 07:45:36'),
(54, 47, 5, 'hddh', '2020-10-20 07:45:36'),
(55, 47, 6, 'gdgd', '2020-10-20 07:45:36'),
(56, 47, 7, 'gdgd', '2020-10-20 07:45:36'),
(57, 47, 8, 'gsgdg', '2020-10-20 07:45:36'),
(58, 47, 9, '55', '2020-10-20 07:45:36'),
(59, 47, 10, 'hdhd', '2020-10-20 07:45:36'),
(60, 47, 11, 'dtts', '2020-10-20 07:45:36'),
(61, 47, 12, 'fsgs', '2020-10-20 07:45:36'),
(62, 47, 13, 'dttd', '2020-10-20 07:45:36'),
(63, 47, 14, 'fsts', '2020-10-20 07:45:36'),
(64, 47, 15, 'gsgssggs', '2020-10-20 07:45:36'),
(65, 49, 1, 'Baharain', '2020-10-21 08:50:21'),
(66, 49, 2, 'Africa', '2020-10-21 08:50:21'),
(67, 15, 1, 'Baharain', '2020-09-01 10:45:46'),
(68, 15, 2, 'Manama', '2020-09-01 10:45:46'),
(69, 15, 3, '16 November 1992', '2020-09-01 10:45:46'),
(70, 15, 5, 'Yes I am Married', '2020-09-01 10:45:46'),
(71, 15, 9, '80 kg', '2020-09-01 10:45:46'),
(72, 15, 10, '186 cm', '2020-09-01 10:45:46'),
(73, 15, 11, '42 cm', '2020-09-01 10:45:46'),
(74, 15, 12, '38 cm', '2020-09-01 10:45:46'),
(75, 15, 13, '36cm', '2020-09-01 10:45:46'),
(76, 15, 14, '40 cm', '2020-09-01 10:45:46'),
(77, 15, 15, '22 cm', '2020-09-01 10:45:46'),
(78, 15, 16, 'Diabetes', '2020-09-01 10:45:46'),
(79, 15, 21, 'Yes i Take Medication', '2020-09-01 10:45:46'),
(80, 15, 22, 'Tripride 2', '2020-09-01 10:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `client_labels`
--

CREATE TABLE `client_labels` (
  `client_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_labels`
--

INSERT INTO `client_labels` (`client_id`, `label`, `created_at`, `updated_at`) VALUES
(4, 'High Priority', '2020-10-14 12:28:58', '2020-10-14 12:28:58'),
(4, 'Diabetic', '2020-10-14 12:28:58', '2020-10-14 12:28:58'),
(3, 'High Priority', '2020-10-14 12:30:56', '2020-10-14 12:30:56'),
(3, 'Diabetic', '2020-10-14 12:30:57', '2020-10-14 12:30:57'),
(1, 'High Priority', '2020-10-14 12:34:31', '2020-10-14 12:34:31'),
(1, 'Diabetic', '2020-10-14 12:34:32', '2020-10-14 12:34:32'),
(2, 'High Priority', '2020-10-14 12:38:34', '2020-10-14 12:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `client_tables`
--

CREATE TABLE `client_tables` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `breakfast` int(11) DEFAULT NULL,
  `snacks1` int(11) DEFAULT NULL,
  `lunch` int(11) DEFAULT NULL,
  `snacks2` int(11) DEFAULT NULL,
  `dinner` int(11) DEFAULT NULL,
  `snacks3` int(11) DEFAULT NULL,
  `calories` varchar(300) DEFAULT NULL,
  `carbs` varchar(300) DEFAULT NULL,
  `protein` varchar(300) DEFAULT NULL,
  `fat` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `calorie_range` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_tables`
--

INSERT INTO `client_tables` (`id`, `client_id`, `table_id`, `breakfast`, `snacks1`, `lunch`, `snacks2`, `dinner`, `snacks3`, `calories`, `carbs`, `protein`, `fat`, `created_at`, `updated_at`, `calorie_range`) VALUES
(2, 1, 1, 1, 2, 3, 26, 4, 26, '750', '215', '82', '88', '2020-09-17 09:20:06', '2020-09-17 09:20:06', '600-700 Cal'),
(3, 2, 1, 1, 2, 3, 34, 4, 2, '742', '215', '82', '88', '2020-10-01 06:13:56', '2020-10-01 06:13:56', '700-800 Cal'),
(4, 15, 1, 1, 2, 3, 34, 4, 2, '742', '215', '82', '88', '2020-10-01 06:13:56', '2020-10-01 06:13:56', '700-800 Cal');

-- --------------------------------------------------------

--
-- Table structure for table `client_workouts`
--

CREATE TABLE `client_workouts` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `exercise` int(11) NOT NULL,
  `sets` int(11) DEFAULT NULL,
  `reps` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `timer` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_workouts`
--

INSERT INTO `client_workouts` (`id`, `client_id`, `day`, `exercise`, `sets`, `reps`, `created_at`, `updated_at`, `status`, `timer`) VALUES
(12, 1, 1, 2, NULL, NULL, '2020-10-20 11:35:50', '2020-10-20 11:35:50', 'completed', '00:00:00'),
(13, 1, 2, 3, NULL, NULL, '2020-10-20 11:35:50', '2020-10-20 11:35:50', 'pending', NULL),
(14, 1, 3, 7, NULL, NULL, '2020-10-20 11:35:50', '2020-10-20 11:35:50', 'pending', NULL),
(15, 15, 1, 2, 10, 20, '2020-10-20 11:35:50', '2020-10-20 11:35:50', 'completed', '00:00:13'),
(16, 15, 2, 3, 10, 45, '2020-10-20 11:35:50', '2020-10-20 11:35:50', 'completed', '00:00:00'),
(17, 15, 3, 7, 3, 89, '2020-10-20 11:35:50', '2020-10-20 11:35:50', 'pending', NULL),
(22, 4, 1, 4, 11, 12, '2020-10-21 13:43:48', '2020-10-21 13:43:48', 'pending', NULL),
(23, 4, 1, 5, 12, 23, '2020-10-21 13:43:48', '2020-10-21 13:43:48', 'pending', NULL),
(24, 4, 1, 8, 23, 34, '2020-10-21 13:43:48', '2020-10-21 13:43:48', 'pending', NULL),
(25, 4, 2, 6, 12, 34, '2020-10-21 13:43:48', '2020-10-21 13:43:48', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(20) NOT NULL,
  `package_id` int(11) NOT NULL,
  `type` char(1) NOT NULL,
  `discount` decimal(15,2) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'on',
  `used_by` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `package_id`, `type`, `discount`, `date_start`, `date_end`, `status`, `used_by`, `created_at`, `updated_at`) VALUES
(7, 'Freaky Discount', 'FREAK20', 1, 'F', 100.00, '2020-09-28', '2020-10-28', 'on', NULL, '2020-09-28 10:26:45', NULL),
(8, 'Junkie Discount', 'JUNKIE20', 2, 'F', 250.00, '2020-10-28', '2020-11-28', 'on', NULL, '2020-09-28 10:14:36', NULL),
(9, 'Forger Discount', 'FORGER20', 3, 'F', 325.00, '2020-08-28', '2020-09-28', 'on', NULL, '2020-09-28 10:15:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_arabic` varchar(2555) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_arabic` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `name_arabic`, `category`, `sort`, `image`, `video`, `time`, `calories`, `description`, `description_arabic`, `created_at`, `updated_at`) VALUES
(2, 'Downward Dog', 'الكلب الهابط', 2, 1, '1.gif', 'https://www.youtube.com/watch?v=YqOqM79McYY', '7', '30-35', 'The pose has the head down, ultimately touching the floor, with the weight of the body on the palms and the feet. \r\nThe arms are stretched straight forward, shoulder width apart; the feet are a foot apart, the legs are straight, and the hips are raised as high as possible.', 'يكون الرأس لأسفل ، ويلامس الأرض في النهاية ، مع ثقل الجسم على الراحتين والقدمين.\r\nيتم شد الذراعين بشكل مستقيم للأمام ، عرض الكتفين متباعدان ؛ القدمان متباعدتان ، والساقان مستقيمة ، والفخذان مرفوعان إلى أعلى مستوى ممكن.', '2020-08-19 07:06:30', '2020-10-20 07:15:19'),
(3, 'Sun Salutation', 'تحية الصباح', 2, 2, '2.gif', 'https://www.youtube.com/watch?v=7y8N8K9vKvo', '5', '50-60', '1. Inhale and Bring the arms out to the sides and up to the ceiling to join your palms above your head.\r\n\r\n2. Exhale and release your arms to either side and forward bend over your legs (as if you were doing a swan dive into a swimming pool).\r\n\r\n3. Exhale and plant your palms and step or jump back to a plank position. In plank, make sure your shoulders are over your wrists and your butt is neither sticking up nor drooping down.\r\n\r\n4. Exhale and lower to your knees, chest, and chin. Lower your chest and chin down to the floor, landing your shoulders right over your hands. Keep your butt high and your elbows hugging your ribs. \r\n\r\n5. Come forward to a low cobra. Anchor your pelvis and the tops of your feet to the floor but try not to press into your hands as you come up into the backbend. \r\n\r\n6. Exhale and push back to downward facing dog. You can come through hands and knees on the way if necessary. Stay here a few breaths (or more) if you need to take a break. If you are going ​at a brisk pace, just stay one breath. \r\n\r\n7. Exhale and step the right foot next to the right hand and then bring the left foot to join it in standing forward bend.\r\n\r\n8. Inhale and lift your arms out to the sides and up, reversing the swan dive to return to raised arms pose.\r\n\r\n9. Exhale and come to stand in mountain pose with your hands in a prayer position at the heart', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 08:43:40', '2020-10-20 07:16:10'),
(4, 'Tree Pose', 'وضعية الشجرة', 2, 3, '3.gif', 'https://www.youtube.com/watch?v=wdln9qWYloU', '7', '25-30', '1. The posture is entered by standing with the feet together, grounding evenly through the feet and lifting up through the crown of the head. \r\n\r\n2. The thighs are lifted, the waist is lifted, and the spine is elongated. Breathing is relaxed., weight is shifted to one leg, for example, starting with the left leg.\r\n\r\n3. The entire sole of the foot remains in contact with the floor. The right knee is bent and the right foot placed on the left inner thigh, or in half lotus position. \r\n\r\n4. In either foot placement, the hips should be open, with the bent knee pointing towards the side. \r\n\r\n5. With the toes of the right foot pointing directly down, the left foot, center of the pelvis, shoulders and head are all vertically aligned. \r\n\r\n6. Hands are typically held above the head either pointed directly upwards and unclasped, or clasped together. \r\n\r\n7. The asana is typically held for 20 to 60 seconds, returning to the Step 1 while exhaling, then repeating standing on the opposite leg.', '1. يتم الدخول في الموقف بالوقوف مع القدمين معًا ، والتأريض بالتساوي من خلال القدمين والرفع من خلال تاج الرأس.\r\n\r\n2. يتم رفع الفخذين والخصر واستطالة العمود الفقري. يكون التنفس مسترخيًا ، ويتحول الوزن إلى رجل واحدة ، على سبيل المثال ، بدءًا من الرجل اليسرى.\r\n\r\n3. يظل باطن القدم بأكمله ملامسًا للأرض. تكون الركبة اليمنى مثنية وتوضع القدم اليمنى على الفخذ الأيسر الداخلي ، أو في وضع نصف اللوتس.\r\n\r\n4. في وضع أي من القدمين ، يجب أن تكون الوركين مفتوحتين ، مع ثني الركبة باتجاه الجانب.\r\n\r\n5. مع توجيه أصابع القدم اليمنى للأسفل مباشرة ، يتم محاذاة القدم اليسرى ومركز الحوض والكتفين والرأس عموديًا.\r\n\r\n6. تُمسك الأيدي عادة فوق الرأس إما مشيرة مباشرة لأعلى وغير مشدودة ، أو متشابكة معًا.\r\n\r\n7. عادةً ما يتم تعليق الأسانا لمدة 20 إلى 60 ثانية ، والعودة إلى الخطوة 1 أثناء الزفير ، ثم تكرار الوقوف على الساق الأخرى.', '2020-08-19 08:56:08', '2020-10-20 07:16:55'),
(5, 'Bound Angle Pose', 'تحية الصباح', 2, 4, '4.gif', 'https://www.youtube.com/watch?v=ti3tbscESUY', '7', '30-40', '1.  From sitting position with both the legs outstretched forward, hands by the sides, palms resting on the ground, fingers together pointing forward, the legs are hinged at the knees so the soles of the feet meet. \r\n\r\n2. The legs are grasped at the ankles and folded more until the heels reach the perineum. \r\n\r\n3. The knees move down to the ground, and with practice reach there; the body is erect and the gaze in front. \r\n\r\n4. The exercise is held before coming back to the starting position.\r\n5. The thighs are stretched with care. When used for meditation, the hands are placed in Prayer Position in front of the chest.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 09:00:41', '2020-08-19 09:00:41'),
(6, 'Pilates 1', 'تحية الصباح', 3, 1, NULL, 'https://www.youtube.com/watch?v=YqOqM79McYY', '7', '30-35', 'The pose has the head down, ultimately touching the floor, with the weight of the body on the palms and the feet. \r\nThe arms are stretched straight forward, shoulder width apart; the feet are a foot apart, the legs are straight, and the hips are raised as high as possible.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 07:06:30', '2020-08-19 09:01:53'),
(7, 'Pilates 2', 'تحية الصباح', 3, 2, NULL, 'https://www.youtube.com/watch?v=7y8N8K9vKvo', '5', '50-60', '1. Inhale and Bring the arms out to the sides and up to the ceiling to join your palms above your head.\r\n\r\n2. Exhale and release your arms to either side and forward bend over your legs (as if you were doing a swan dive into a swimming pool).\r\n\r\n3. Exhale and plant your palms and step or jump back to a plank position. In plank, make sure your shoulders are over your wrists and your butt is neither sticking up nor drooping down.\r\n\r\n4. Exhale and lower to your knees, chest, and chin. Lower your chest and chin down to the floor, landing your shoulders right over your hands. Keep your butt high and your elbows hugging your ribs. \r\n\r\n5. Come forward to a low cobra. Anchor your pelvis and the tops of your feet to the floor but try not to press into your hands as you come up into the backbend. \r\n\r\n6. Exhale and push back to downward facing dog. You can come through hands and knees on the way if necessary. Stay here a few breaths (or more) if you need to take a break. If you are going ​at a brisk pace, just stay one breath. \r\n\r\n7. Exhale and step the right foot next to the right hand and then bring the left foot to join it in standing forward bend.\r\n\r\n8. Inhale and lift your arms out to the sides and up, reversing the swan dive to return to raised arms pose.\r\n\r\n9. Exhale and come to stand in mountain pose with your hands in a prayer position at the heart', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 08:43:40', '2020-08-19 09:01:37'),
(8, 'Pilates 3', 'تحية الصباح', 3, 3, NULL, 'https://www.youtube.com/watch?v=wdln9qWYloU', '7', '25-30', '1. The posture is entered by standing with the feet together, grounding evenly through the feet and lifting up through the crown of the head. \r\n\r\n2. The thighs are lifted, the waist is lifted, and the spine is elongated. Breathing is relaxed., weight is shifted to one leg, for example, starting with the left leg.\r\n\r\n3. The entire sole of the foot remains in contact with the floor. The right knee is bent and the right foot placed on the left inner thigh, or in half lotus position. \r\n\r\n4. In either foot placement, the hips should be open, with the bent knee pointing towards the side. \r\n\r\n5. With the toes of the right foot pointing directly down, the left foot, center of the pelvis, shoulders and head are all vertically aligned. \r\n\r\n6. Hands are typically held above the head either pointed directly upwards and unclasped, or clasped together. \r\n\r\n7. The asana is typically held for 20 to 60 seconds, returning to the Step 1 while exhaling, then repeating standing on the opposite leg.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 08:56:08', '2020-08-19 09:01:21'),
(9, 'Pilates 4', 'تحية الصباح', 3, 4, NULL, 'https://www.youtube.com/watch?v=ti3tbscESUY', '7', '30-40', '1.  From sitting position with both the legs outstretched forward, hands by the sides, palms resting on the ground, fingers together pointing forward, the legs are hinged at the knees so the soles of the feet meet. \r\n\r\n2. The legs are grasped at the ankles and folded more until the heels reach the perineum. \r\n\r\n3. The knees move down to the ground, and with practice reach there; the body is erect and the gaze in front. \r\n\r\n4. The exercise is held before coming back to the starting position.\r\n5. The thighs are stretched with care. When used for meditation, the hands are placed in Prayer Position in front of the chest.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 09:00:41', '2020-08-19 09:00:41'),
(10, 'HIIT 1', 'تحية الصباح', 4, 1, NULL, 'https://www.youtube.com/watch?v=YqOqM79McYY', '7', '30-35', 'The pose has the head down, ultimately touching the floor, with the weight of the body on the palms and the feet. \r\nThe arms are stretched straight forward, shoulder width apart; the feet are a foot apart, the legs are straight, and the hips are raised as high as possible.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 07:06:30', '2020-08-19 09:01:53'),
(11, 'HIIT 2', 'تحية الصباح', 4, 2, NULL, 'https://www.youtube.com/watch?v=7y8N8K9vKvo', '5', '50-60', '1. Inhale and Bring the arms out to the sides and up to the ceiling to join your palms above your head.\r\n\r\n2. Exhale and release your arms to either side and forward bend over your legs (as if you were doing a swan dive into a swimming pool).\r\n\r\n3. Exhale and plant your palms and step or jump back to a plank position. In plank, make sure your shoulders are over your wrists and your butt is neither sticking up nor drooping down.\r\n\r\n4. Exhale and lower to your knees, chest, and chin. Lower your chest and chin down to the floor, landing your shoulders right over your hands. Keep your butt high and your elbows hugging your ribs. \r\n\r\n5. Come forward to a low cobra. Anchor your pelvis and the tops of your feet to the floor but try not to press into your hands as you come up into the backbend. \r\n\r\n6. Exhale and push back to downward facing dog. You can come through hands and knees on the way if necessary. Stay here a few breaths (or more) if you need to take a break. If you are going ​at a brisk pace, just stay one breath. \r\n\r\n7. Exhale and step the right foot next to the right hand and then bring the left foot to join it in standing forward bend.\r\n\r\n8. Inhale and lift your arms out to the sides and up, reversing the swan dive to return to raised arms pose.\r\n\r\n9. Exhale and come to stand in mountain pose with your hands in a prayer position at the heart', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 08:43:40', '2020-08-19 09:01:37'),
(12, 'HIIT 3', 'تحية الصباح', 4, 3, NULL, 'https://www.youtube.com/watch?v=wdln9qWYloU', '7', '25-30', '1. The posture is entered by standing with the feet together, grounding evenly through the feet and lifting up through the crown of the head. \r\n\r\n2. The thighs are lifted, the waist is lifted, and the spine is elongated. Breathing is relaxed., weight is shifted to one leg, for example, starting with the left leg.\r\n\r\n3. The entire sole of the foot remains in contact with the floor. The right knee is bent and the right foot placed on the left inner thigh, or in half lotus position. \r\n\r\n4. In either foot placement, the hips should be open, with the bent knee pointing towards the side. \r\n\r\n5. With the toes of the right foot pointing directly down, the left foot, center of the pelvis, shoulders and head are all vertically aligned. \r\n\r\n6. Hands are typically held above the head either pointed directly upwards and unclasped, or clasped together. \r\n\r\n7. The asana is typically held for 20 to 60 seconds, returning to the Step 1 while exhaling, then repeating standing on the opposite leg.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 08:56:08', '2020-08-19 09:01:21'),
(13, 'HIIT 4', 'تحية الصباح', 4, 4, NULL, 'https://www.youtube.com/watch?v=ti3tbscESUY', '7', '30-40', '1.  From sitting position with both the legs outstretched forward, hands by the sides, palms resting on the ground, fingers together pointing forward, the legs are hinged at the knees so the soles of the feet meet. \r\n\r\n2. The legs are grasped at the ankles and folded more until the heels reach the perineum. \r\n\r\n3. The knees move down to the ground, and with practice reach there; the body is erect and the gaze in front. \r\n\r\n4. The exercise is held before coming back to the starting position.\r\n5. The thighs are stretched with care. When used for meditation, the hands are placed in Prayer Position in front of the chest.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 09:00:41', '2020-08-19 09:00:41'),
(14, 'Cardio 1', 'تحية الصباح', 5, 1, NULL, 'https://www.youtube.com/watch?v=YqOqM79McYY', '7', '30-35', 'The pose has the head down, ultimately touching the floor, with the weight of the body on the palms and the feet. \r\nThe arms are stretched straight forward, shoulder width apart; the feet are a foot apart, the legs are straight, and the hips are raised as high as possible.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 07:06:30', '2020-08-19 09:01:53'),
(15, 'Cardio 2', 'تحية الصباح', 5, 2, NULL, 'https://www.youtube.com/watch?v=7y8N8K9vKvo', '5', '50-60', '1. Inhale and Bring the arms out to the sides and up to the ceiling to join your palms above your head.\r\n\r\n2. Exhale and release your arms to either side and forward bend over your legs (as if you were doing a swan dive into a swimming pool).\r\n\r\n3. Exhale and plant your palms and step or jump back to a plank position. In plank, make sure your shoulders are over your wrists and your butt is neither sticking up nor drooping down.\r\n\r\n4. Exhale and lower to your knees, chest, and chin. Lower your chest and chin down to the floor, landing your shoulders right over your hands. Keep your butt high and your elbows hugging your ribs. \r\n\r\n5. Come forward to a low cobra. Anchor your pelvis and the tops of your feet to the floor but try not to press into your hands as you come up into the backbend. \r\n\r\n6. Exhale and push back to downward facing dog. You can come through hands and knees on the way if necessary. Stay here a few breaths (or more) if you need to take a break. If you are going ​at a brisk pace, just stay one breath. \r\n\r\n7. Exhale and step the right foot next to the right hand and then bring the left foot to join it in standing forward bend.\r\n\r\n8. Inhale and lift your arms out to the sides and up, reversing the swan dive to return to raised arms pose.\r\n\r\n9. Exhale and come to stand in mountain pose with your hands in a prayer position at the heart', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 08:43:40', '2020-08-19 09:01:37'),
(16, 'Cardio 3', 'تحية الصباح', 5, 3, NULL, 'https://www.youtube.com/watch?v=wdln9qWYloU', '7', '25-30', '1. The posture is entered by standing with the feet together, grounding evenly through the feet and lifting up through the crown of the head. \r\n\r\n2. The thighs are lifted, the waist is lifted, and the spine is elongated. Breathing is relaxed., weight is shifted to one leg, for example, starting with the left leg.\r\n\r\n3. The entire sole of the foot remains in contact with the floor. The right knee is bent and the right foot placed on the left inner thigh, or in half lotus position. \r\n\r\n4. In either foot placement, the hips should be open, with the bent knee pointing towards the side. \r\n\r\n5. With the toes of the right foot pointing directly down, the left foot, center of the pelvis, shoulders and head are all vertically aligned. \r\n\r\n6. Hands are typically held above the head either pointed directly upwards and unclasped, or clasped together. \r\n\r\n7. The asana is typically held for 20 to 60 seconds, returning to the Step 1 while exhaling, then repeating standing on the opposite leg.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 08:56:08', '2020-08-19 09:01:21'),
(17, 'Cardio 4', 'تحية الصباح', 5, 4, NULL, 'https://www.youtube.com/watch?v=ti3tbscESUY', '7', '30-40', '1.  From sitting position with both the legs outstretched forward, hands by the sides, palms resting on the ground, fingers together pointing forward, the legs are hinged at the knees so the soles of the feet meet. \r\n\r\n2. The legs are grasped at the ankles and folded more until the heels reach the perineum. \r\n\r\n3. The knees move down to the ground, and with practice reach there; the body is erect and the gaze in front. \r\n\r\n4. The exercise is held before coming back to the starting position.\r\n5. The thighs are stretched with care. When used for meditation, the hands are placed in Prayer Position in front of the chest.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 09:00:41', '2020-08-19 09:00:41'),
(18, 'Gain 1', 'تحية الصباح', 6, 1, NULL, 'https://www.youtube.com/watch?v=YqOqM79McYY', '7', '30-35', 'The pose has the head down, ultimately touching the floor, with the weight of the body on the palms and the feet. \r\nThe arms are stretched straight forward, shoulder width apart; the feet are a foot apart, the legs are straight, and the hips are raised as high as possible.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 07:06:30', '2020-08-19 09:01:53'),
(19, 'Gain 2', 'تحية الصباح', 6, 2, NULL, 'https://www.youtube.com/watch?v=7y8N8K9vKvo', '5', '50-60', '1. Inhale and Bring the arms out to the sides and up to the ceiling to join your palms above your head.\r\n\r\n2. Exhale and release your arms to either side and forward bend over your legs (as if you were doing a swan dive into a swimming pool).\r\n\r\n3. Exhale and plant your palms and step or jump back to a plank position. In plank, make sure your shoulders are over your wrists and your butt is neither sticking up nor drooping down.\r\n\r\n4. Exhale and lower to your knees, chest, and chin. Lower your chest and chin down to the floor, landing your shoulders right over your hands. Keep your butt high and your elbows hugging your ribs. \r\n\r\n5. Come forward to a low cobra. Anchor your pelvis and the tops of your feet to the floor but try not to press into your hands as you come up into the backbend. \r\n\r\n6. Exhale and push back to downward facing dog. You can come through hands and knees on the way if necessary. Stay here a few breaths (or more) if you need to take a break. If you are going ​at a brisk pace, just stay one breath. \r\n\r\n7. Exhale and step the right foot next to the right hand and then bring the left foot to join it in standing forward bend.\r\n\r\n8. Inhale and lift your arms out to the sides and up, reversing the swan dive to return to raised arms pose.\r\n\r\n9. Exhale and come to stand in mountain pose with your hands in a prayer position at the heart', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 08:43:40', '2020-08-19 09:01:37'),
(20, 'Gain 3', 'تحية الصباح', 6, 3, NULL, 'https://www.youtube.com/watch?v=wdln9qWYloU', '7', '25-30', '1. The posture is entered by standing with the feet together, grounding evenly through the feet and lifting up through the crown of the head. \r\n\r\n2. The thighs are lifted, the waist is lifted, and the spine is elongated. Breathing is relaxed., weight is shifted to one leg, for example, starting with the left leg.\r\n\r\n3. The entire sole of the foot remains in contact with the floor. The right knee is bent and the right foot placed on the left inner thigh, or in half lotus position. \r\n\r\n4. In either foot placement, the hips should be open, with the bent knee pointing towards the side. \r\n\r\n5. With the toes of the right foot pointing directly down, the left foot, center of the pelvis, shoulders and head are all vertically aligned. \r\n\r\n6. Hands are typically held above the head either pointed directly upwards and unclasped, or clasped together. \r\n\r\n7. The asana is typically held for 20 to 60 seconds, returning to the Step 1 while exhaling, then repeating standing on the opposite leg.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\n\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\n\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\n\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\n\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\n\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\n\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\n\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\n\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 08:56:08', '2020-08-19 09:01:21'),
(21, 'Gain 4', 'تحية الصباح', 6, 4, 'download.png', 'https://www.youtube.com/watch?v=ti3tbscESUY', '7', '30-40', '1.  From sitting position with both the legs outstretched forward, hands by the sides, palms resting on the ground, fingers together pointing forward, the legs are hinged at the knees so the soles of the feet meet. \r\n\r\n2. The legs are grasped at the ankles and folded more until the heels reach the perineum. \r\n\r\n3. The knees move down to the ground, and with practice reach there; the body is erect and the gaze in front. \r\n\r\n4. The exercise is held before coming back to the starting position.\r\n5. The thighs are stretched with care. When used for meditation, the hands are placed in Prayer Position in front of the chest.', '1. استنشق وأخرج الذراعين على الجانبين وحتى السقف لربط راحة يدك فوق رأسك.\r\n\r\n2. قم بالزفير ثم حرر ذراعيك إلى أي من الجانبين وانحني للأمام على ساقيك (كما لو كنت تغوص بجعة في حمام السباحة).\r\n\r\n3. ازفر وازرع راحتيك واقفز للخلف إلى وضعية اللوح الخشبي. في اللوح الخشبي ، تأكد من أن كتفيك فوق معصميك وأن مؤخرتك ليست بارزة أو متدلية.\r\n\r\n4. ازفر واخفض إلى ركبتيك وصدرك وذقنك. أنزل صدرك وذقنك على الأرض ، واضبط كتفيك على يديك. حافظ على مؤخرتك مرتفعة ومرفقيك يعانقان ضلوعك.\r\n\r\n5. تعال إلى كوبرا منخفض. ثبت حوضك وأعلى قدميك على الأرض لكن حاول ألا تضغط على يديك وأنت تصعد إلى الخلف.\r\n\r\n6. زفر وادفع الكلب المتجه للأسفل. يمكنك المرور عبر اليدين والركبتين في الطريق إذا لزم الأمر ابق هنا بضع أنفاس (أو أكثر) إذا كنت بحاجة إلى أخذ قسط من الراحة. إذا كنت تسير بخطى سريعة ، فقط ابق نفسًا واحدًا.\r\n\r\n7. زفر وخطوة القدم اليمنى بجانب اليد اليمنى ثم أحضر القدم اليسرى لتلتحق بها في الوقوف عند الانحناء للأمام.\r\n\r\n8. استنشق وارفع ذراعيك للخارج إلى الجانبين وأعلى ، وعكس اتجاه غوص البجعة للعودة إلى وضع الذراعين المرتفعين.\r\n\r\n9. قم بالزفير وتعال للوقوف في الجبل واقفًا بيديك في وضع الصلاة في القلب', '2020-08-19 09:00:41', '2020-10-26 08:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` int(11) NOT NULL,
  `type` enum('breakfast','snacks','lunch','dinner') COLLATE utf8mb4_unicode_ci NOT NULL,
  `food` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spoon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carbs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `protein` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `table_id`, `type`, `food`, `quantity`, `weight`, `spoon`, `calories`, `carbs`, `protein`, `fat`, `sort`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'breakfast', 'Eggs and Bread', '3', NULL, NULL, '125', '12', '15', '15', 1, 'eggs.jpg', 'on', '2020-08-27 17:40:56', '2020-10-28 01:41:04'),
(2, 1, 'snacks', 'Apple', '2', NULL, NULL, '185', '21', '18', '19', 2, 'apple.jpg', 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:44'),
(3, 1, 'lunch', 'Dal + Rice', NULL, '200', NULL, '147', '16', '18', '25', 3, 'dal.png', 'on', '2020-08-27 17:40:56', '2020-08-27 17:40:56'),
(4, 1, 'dinner', 'Lady Finger + 2 Rotis', NULL, '200', NULL, '135', '26', '15', '25', 4, 'llady.jpg', 'on', '2020-08-27 17:40:56', '2020-08-27 13:07:30'),
(5, 1, 'lunch', 'Lentils', NULL, '300', NULL, '150', '140', '16', '15', 5, 'download.jpg', 'on', '2020-08-27 12:44:14', '2020-08-27 13:05:16'),
(6, 1, 'breakfast', 'Breakfast 2', NULL, NULL, '7', '154', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(7, 1, 'breakfast', 'Breakfast 3', NULL, '3', NULL, '189', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(8, 1, 'breakfast', 'Breakfast 4', '7', NULL, NULL, '178', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(9, 1, 'breakfast', 'Breakfast 5', NULL, '800', NULL, '95', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(10, 1, 'breakfast', 'Breakfast 6', '2', NULL, NULL, '68', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(11, 1, 'breakfast', 'Breakfast 7', NULL, NULL, '5', '62', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(12, 1, 'breakfast', 'Breakfast 8', NULL, '400', NULL, '88', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(13, 1, 'breakfast', 'Breakfast 9', '3', NULL, NULL, '73', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(14, 1, 'breakfast', 'Breakfast 10', NULL, NULL, '8', '25', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(15, 1, 'breakfast', 'Breakfast 11', '14', NULL, NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(16, 1, 'breakfast', 'Breakfast 12', NULL, '800', NULL, '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(17, 1, 'breakfast', 'Breakfast 13', '9', NULL, NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(18, 1, 'breakfast', 'Breakfast 14', NULL, NULL, '8', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(19, 1, 'breakfast', 'Breakfast 15', NULL, '500', NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(20, 1, 'breakfast', 'Breakfast 16', '4', NULL, NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(21, 1, 'breakfast', 'Breakfast 17', NULL, '250', NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(22, 1, 'breakfast', 'Breakfast 18', NULL, NULL, '7', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(23, 1, 'breakfast', 'Breakfast 19', NULL, '150', NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(24, 1, 'breakfast', 'Breakfast 20', NULL, NULL, '9', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(25, 1, 'breakfast', 'Breakfast 21', '5', NULL, NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(26, 1, 'snacks', 'Snack 2', '7', NULL, NULL, '158', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(27, 1, 'snacks', 'Snack 3', NULL, '45', NULL, '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(28, 1, 'snacks', 'Snack 4', NULL, NULL, '8', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(29, 1, 'snacks', 'Snack 5', '9', NULL, NULL, '157', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(30, 1, 'snacks', 'Snack 6', NULL, '856', NULL, '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(31, 1, 'snacks', 'Snack 7', NULL, NULL, '20', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(32, 1, 'snacks', 'Snack 8', '8', NULL, NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(33, 1, 'snacks', 'Snack 9', NULL, '547', NULL, '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(34, 1, 'snacks', 'Snack 10', NULL, NULL, '3', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(35, 1, 'snacks', 'Snack 11', '7', NULL, NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(36, 1, 'snacks', 'Snack 12', NULL, '457', NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(37, 1, 'snacks', 'Snack 13', NULL, NULL, '9', '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(38, 1, 'snacks', 'Snack 14', '7', NULL, NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(39, 1, 'snacks', 'Snack 15', NULL, '820', NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(40, 1, 'snacks', 'Snack 16', NULL, NULL, '8', '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(41, 1, 'snacks', 'Snack 17', '3', NULL, NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(42, 1, 'snacks', 'Snack 18', NULL, '87', NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(43, 1, 'snacks', 'Snack 19', NULL, NULL, '9', '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(44, 1, 'snacks', 'Snack 20', '5', NULL, NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(45, 1, 'snacks', 'Snack 21', NULL, NULL, NULL, '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(46, 4, 'breakfast', 'Apple', NULL, NULL, NULL, '10', '10', '5', '10', 1, NULL, 'on', '2020-09-23 15:15:37', '2020-09-23 15:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `type`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
(1703022056, 'user', 1, 17, 'Hi', NULL, 0, '2020-10-27 02:24:35', '2020-10-27 02:24:35'),
(1741149429, 'user', 1, 2, 'Hi', NULL, 1, '2020-10-27 02:43:53', '2020-10-27 10:56:04'),
(1889347857, 'user', 1, 1, 'Hello', NULL, 1, '2020-10-27 02:37:48', '2020-10-27 02:37:48'),
(2002456957, 'user', 1, 1, 'Johnas', NULL, 1, '2020-10-27 02:39:51', '2020-10-27 02:39:51'),
(2034750493, 'user', 2, 1, 'Hello', NULL, 1, '2020-10-27 10:56:17', '2020-10-27 10:57:13'),
(2082215465, 'user', 1, 17, 'hr', NULL, 0, '2020-10-27 02:38:10', '2020-10-27 02:38:10'),
(2282817195, 'user', 2, 2, 'Hello', NULL, 1, '2020-10-27 10:55:39', '2020-10-27 10:55:39'),
(2367579348, 'user', 1, 2, 'haha', NULL, 1, '2020-10-27 10:57:24', '2020-10-27 10:58:05'),
(2375990872, 'user', 1, 29, 'Hi', NULL, 0, '2020-10-27 02:39:33', '2020-10-27 02:39:33'),
(2408451208, 'user', 1, 1, 'hELLO', NULL, 1, '2020-10-27 10:52:37', '2020-10-27 10:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_14_003703_create_products_table', 1),
(5, '2020_08_14_004132_create_permission_tables', 1),
(6, '2014_10_12_000000_create_clients_table', 2),
(7, '2016_06_01_000001_create_oauth_auth_codes_table', 3),
(8, '2016_06_01_000002_create_oauth_access_tokens_table', 3),
(9, '2016_06_01_000003_create_oauth_refresh_tokens_table', 3),
(10, '2016_06_01_000004_create_oauth_clients_table', 3),
(11, '2016_06_01_000005_create_oauth_personal_access_clients_table', 3),
(13, '2020_08_19_022406_create_questions_table', 4),
(14, '2020_08_19_054051_create_packages_table', 5),
(15, '2020_08_19_080206_create_workout_categories_table', 6),
(16, '2020_08_19_095054_create_exercises_table', 7),
(17, '2020_08_27_165412_create_table_meals_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `nutritionist_clients`
--

CREATE TABLE `nutritionist_clients` (
  `id` bigint(20) NOT NULL,
  `client_id` bigint(255) NOT NULL,
  `nutritionist_id` bigint(255) NOT NULL,
  `table_status` varchar(255) NOT NULL DEFAULT 'due',
  `workout_status` varchar(255) NOT NULL DEFAULT 'due',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutritionist_clients`
--

INSERT INTO `nutritionist_clients` (`id`, `client_id`, `nutritionist_id`, `table_status`, `workout_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'posted', 'due', '2020-09-01 06:01:58', '2020-09-01 06:01:34'),
(2, 2, 3, 'posted', 'due', '2020-09-01 06:01:58', '2020-09-01 06:01:34'),
(3, 3, 2, 'due', 'due', '2020-09-01 06:02:31', '2020-09-01 06:02:12'),
(4, 4, 5, 'due', 'posted', '2020-09-01 06:02:31', '2020-09-01 06:02:12'),
(5, 15, 5, 'due', 'posted', '2020-09-01 06:02:31', '2020-09-01 06:02:12'),
(6, 57, 2, 'due', 'due', '2020-10-24 10:44:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('003bc4f89e302d27ae99186734e1d1beced997b887f489df8211a41848ddffb4f1bccd55660372d2', 9, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 17:14:31', '2020-09-29 17:14:31', '2021-09-29 17:14:31'),
('00732818c8f51aab6ab7f518eff75b4e3cfc5755a3781b35f272df0c4d079b06df266e0133f461ea', 2, 1, 'Laravel Password Grant Client', '[]', 0, '2020-08-17 10:14:52', '2020-08-17 10:14:52', '2021-08-17 15:44:52'),
('0178630189cf3fbd4eb57ff525aabed5100c573a696c72abd8a25e82449d29a4ba8a651470382e41', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 10:55:28', '2020-10-13 10:55:28', '2021-10-13 10:55:28'),
('03d4c83e83492584c67c56bfde4f5058b4342f7d83382eae2c0439ef0745df9b0b6f8d4fbd49a4e4', 23, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 11:17:14', '2020-10-08 11:17:14', '2021-10-08 11:17:14'),
('041870ce808179208897baf7371dc29958b6e933abdabc4e4572fc6d6b5c61e6be6ddb5f20b75af8', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 04:26:03', '2020-10-08 04:26:03', '2021-10-08 04:26:03'),
('05e13a881d0215ab6b14ec48e348825a95cb7bf014a224b08ae4caf2b608c0fc152b141c4dff53cf', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 12:58:34', '2020-10-13 12:58:34', '2021-10-13 12:58:34'),
('068f2ddd89c78a8034c90bb220a36e032ba73876545def463b2f54bb39251f5d09e1e17cabc889f4', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-19 12:41:36', '2020-10-19 12:41:36', '2021-10-19 12:41:36'),
('0813dd84de2ecfe6249c3b710ba5f5faae30bcb02f08c7b72a3db3be04476a26f149285f37215b89', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 08:11:19', '2020-10-07 08:11:19', '2021-10-07 08:11:19'),
('08f1a02a91c03f0a14538ab153aba7bc4305655fb5018c484a39ad83fa3e881066624021dc45db4b', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-28 09:30:12', '2020-10-28 09:30:12', '2021-10-28 09:30:12'),
('0909d2bc2f6b8d50a2c30214209e8c70d48670618f6ee713abee0227265d631d25beea0e0191efe5', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-19 12:05:32', '2020-10-19 12:05:32', '2021-10-19 12:05:32'),
('0966f655a14f76fb4623edc15475ce8a36b47cfea36b01255170bd1fa3bc6a359a3e7a0c99a47d27', 14, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 13:26:14', '2020-10-09 13:26:14', '2021-10-09 13:26:14'),
('09ef018732a91f8084717d260e3d1a7a8e8f32cdd4048c9ce5aa437e5a1309a1978c2525b522774e', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:25:48', '2020-10-20 07:25:48', '2021-10-20 07:25:48'),
('0a06c4e171fac4180f5bfea06b648b1af763f09c8284accad2e9574c5074eb5970ff3ffe6ccafcb6', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-02 04:55:22', '2020-10-02 04:55:22', '2021-10-02 04:55:22'),
('0d98569e1437baf737fc2b5df156de68b028272892b19e7e9e35110a8f6797e2b2a5744571ea022f', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-01 10:13:59', '2020-10-01 10:13:59', '2021-10-01 10:13:59'),
('0d9f649fa6eb62a461a1865de4324bb6a124c6e9ee28a56887db1a0bcc42eb2724a79cf3b5037b18', 46, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 09:34:38', '2020-10-15 09:34:38', '2021-10-15 09:34:38'),
('0e3fd409fe13b717e1d0da4c78a55abcb80f9e6b982a041832ebae4706c1719f47955771629d9878', 7, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 16:37:27', '2020-09-29 16:37:27', '2021-09-29 16:37:27'),
('0f5829c72d2cf554ae8225f05f44b3de9d8c6b239decf4bdad78a0f7c77344d9ba8cc03fe30b59a9', 12, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 08:00:01', '2020-10-05 08:00:01', '2021-10-05 08:00:01'),
('0f805913d6622a5f4c0d62e2675b6e4e6818149f488f69f6269dc6642888f71e28aff11f5b83e92c', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-14 12:27:49', '2020-10-14 12:27:49', '2021-10-14 12:27:49'),
('0ff2f1da8771b3ec90361ffa2ce422787618dc63c28d14b3b8269f6d21d1eb989c3a432e2b507617', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 07:08:03', '2020-10-12 07:08:03', '2021-10-12 07:08:03'),
('100515d65b3882c2fe4614ffe6dad4c1c6ffb36a3ba8362471fbf89bbb961b234f052f44fba5b515', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-28 09:28:45', '2020-10-28 09:28:45', '2021-10-28 09:28:45'),
('10b81eea3c0fa12bc6c7e69871609fba685b1c219eaa1270e6d34994e8acc9223f0ef42cea51c257', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 19:16:21', '2020-10-08 19:16:21', '2021-10-08 19:16:21'),
('127c32db095ea495fdafa934a8763cc130265728cf0583cf3c058176f8a88141b4dba81f376c21d0', 26, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 07:11:00', '2020-10-09 07:11:00', '2021-10-09 07:11:00'),
('147d4eda8f6440cb8d8c8c7c6bddbf37a2287539ee7f12c7c1e4feddac62e225eb41b2d98b8159f6', 27, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 06:24:59', '2020-10-09 06:24:59', '2021-10-09 06:24:59'),
('14e52e2aa096b2b8a10a26e1c1da2b0e8d5c260cbb1ba4f8ae5e8f8893d745e1c9d35739a94eacff', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 10:51:10', '2020-10-13 10:51:10', '2021-10-13 10:51:10'),
('1687bd0d008c59be631632e043aec8f9c51cf638fcedd8539f73545180a2c696e6d9c727e8b40c3e', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 10:38:12', '2020-10-13 10:38:12', '2021-10-13 10:38:12'),
('18adc5885798d35de44a41bebbd4d85bd23e31cc62fec8522f7952c687b76fecee6cc753f2931395', 47, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 08:02:29', '2020-10-21 08:02:29', '2021-10-21 08:02:29'),
('19089a381f84d961a5c686873c416bf56e23bda727628b5d4e7f4fb5fcce217b7c7481152bba4b57', 45, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 07:34:18', '2020-10-15 07:34:18', '2021-10-15 07:34:18'),
('1ab3950ab6357d8f240574a450a817e13a903d9fbec96688c252ec901215aa1016d679aab638c6b1', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-19 13:28:18', '2020-10-19 13:28:18', '2021-10-19 13:28:18'),
('1bb44f154507e64225faac792a6a5f156f0fc4d743c51a255edc3534bd7e0a45399ddfb3342c0430', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 11:48:13', '2020-10-07 11:48:13', '2021-10-07 11:48:13'),
('1d3b41a2220215c79e038b98885387ef1a0f2a7d7a65079a47a1f4be7ce6b6387214613353239423', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 11:36:33', '2020-10-13 11:36:33', '2021-10-13 11:36:33'),
('20e5c1771ac409eab9e717a0deb92088cb75214733417f0b0f3b7a76fa528aa0fd62ab1f55b9def5', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 12:51:44', '2020-10-13 12:51:44', '2021-10-13 12:51:44'),
('21e79ea13ea924317da9f0ad8063278bde13a7394c40728302c974a02dc1a24f8d0a382d165fdf01', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 07:09:08', '2020-10-06 07:09:08', '2021-10-06 07:09:08'),
('22ab7104748325253a4bf720da0b12a033b0189e2c7aa99c0cb4282de032c27d269cf6d366c8de11', 47, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:40:01', '2020-10-20 07:40:01', '2021-10-20 07:40:01'),
('22b421b0f06900b465a66bade8b9dc5e3312b51cb4ad10d6b87051ee5ac93758e4ceb45b9ccb778e', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-14 12:09:11', '2020-10-14 12:09:11', '2021-10-14 12:09:11'),
('22fadad64daceddbf5e77a48b37738fa4d4de78fc860663101ee16e6c9f76b5ad54f75d508040808', 13, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 10:29:38', '2020-10-05 10:29:38', '2021-10-05 10:29:38'),
('23bbd248e0f375b2df9beda8289e9fed0306814a947b887a35eaa41bf4ff2544c0eefbdd6b7a584f', 26, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 06:12:57', '2020-10-09 06:12:57', '2021-10-09 06:12:57'),
('25ee9471313865c637248d48b609965c0bd07ca304270523c27016874f96c09f9d3069be91fbfb8f', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 10:43:32', '2020-10-05 10:43:32', '2021-10-05 10:43:32'),
('261175ac910620d2d4218d38ae755d7013dc5125e02f729ffce0b6911a77ea5b81b42bef859b590e', 7, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 16:56:55', '2020-09-29 16:56:55', '2021-09-29 16:56:55'),
('26ebb3477c13272fe5bec1eed45a59c84d1225281b15482f0ec200262db6f34e3070f5579cf2ce37', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:19:47', '2020-10-20 07:19:47', '2021-10-20 07:19:47'),
('270d5e74ace670dc851464d12102da5e510be94a7b738a28ab4c2adc5c21cd73fca0848fe143b0c1', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:16:42', '2020-10-20 07:16:42', '2021-10-20 07:16:42'),
('2727b1aab10147f09346e1e0d97d06e599766c290de90508959dfb05d644a8bb550d5040fb751fb7', 57, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-24 10:44:29', '2020-10-24 10:44:29', '2021-10-24 10:44:29'),
('284ff2b706c6396e8fce13c664a7442cb1ce013fd45fb88133dc2320209b18c9df86b23922cbf52d', 5, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-30 06:23:33', '2020-09-30 06:23:33', '2021-09-30 06:23:33'),
('291661a44fbbb603c33e6902c770b5d93e46959d8f3a6ce51ec1963b63872a421c2d102d38215fd1', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 11:06:27', '2020-10-05 11:06:27', '2021-10-05 11:06:27'),
('293b61a833306fc79bb527930e63978f2d90cc4ba0eebe57b35dce12b26b5ea110795fc7b2b95ddd', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 07:16:37', '2020-10-13 07:16:37', '2021-10-13 07:16:37'),
('2986ecee20329f0a77a3b17a476a08fc8e6f2960ff466ad3fbeef2f07b56538d26f9857a539c4e20', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 17:36:14', '2020-10-13 17:36:14', '2021-10-13 17:36:14'),
('29f87578287a59f70c43e9f54fac9f4f5d87ced286861c36cb6687fb691273d4ddf5c98f062c5b38', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:34:08', '2020-10-20 07:34:08', '2021-10-20 07:34:08'),
('2a91702f05be127d61980d780075bb73e1356eec173e79d1ea0c05d9fe29c3a84b11feb3e74f565a', 7, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 16:31:46', '2020-09-29 16:31:46', '2021-09-29 16:31:46'),
('2acd3e46605b7e039ccd9c362e096ed8137d562b5ca168c1b6faad20bcecbdd87b09057e41b9951c', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 07:52:19', '2020-10-07 07:52:19', '2021-10-07 07:52:19'),
('2bdeec798bc8a4b84856b0bdb2fe64519dd15e79e92c650e7aa38d71b1d74d693ecc900779e8dbbe', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 04:37:34', '2020-10-08 04:37:34', '2021-10-08 04:37:34'),
('2c24308173f1cbcaa0a71b32bb82c74732ef6139a63d6da5d34a1cb44152c1059ab6999354e53c55', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 18:23:08', '2020-10-13 18:23:08', '2021-10-13 18:23:08'),
('2c84f8f1b6c6c03fbaadb9d2dd6117773cb1caba3c133e84726caff533c7d1e648aa92852152fa53', 22, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 07:56:07', '2020-10-08 07:56:07', '2021-10-08 07:56:07'),
('2cb5690fd8d02212bcd83dd52d62176b496c84cc0a1fae560a627722d8b1a8fdce850d8956d75283', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 16:04:49', '2020-10-10 16:04:49', '2021-10-10 16:04:49'),
('2e48a76ae11f908e0029ed5524f8c3ea7513db06cd6ec2d9cdd27489c35748f3b1e08f98ad41b7c4', 49, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 07:20:43', '2020-10-21 07:20:43', '2021-10-21 07:20:43'),
('2e4fc27c30a7c1bfbf445b78468dfcab8c34a520886d25a8348c1c91aef99f19da404a7f3d7b5693', 16, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 05:00:55', '2020-10-12 05:00:55', '2021-10-12 05:00:55'),
('2f6e772ea8d92c7b61885c2b6099346a44247efcd4081e46356de762ebaa29d4c47d04d60de57c1e', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-27 10:46:31', '2020-10-27 10:46:31', '2021-10-27 10:46:31'),
('2fde5c204643b28f0d2b71d8abde4799df99c004e4ba74b49103c55a88ec81ac2d8fefef7c6f9e89', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 07:05:35', '2020-10-07 07:05:35', '2021-10-07 07:05:35'),
('33f30927adce41d7b828daa55c33dab57772ae3a64f1f3cb373a33513dbcfe2545e4c39b9632173b', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 17:53:59', '2020-10-13 17:53:59', '2021-10-13 17:53:59'),
('340e4a49d5dd47d4e5ec042cea09f5de2d938a7f1af5ac5e96615e9262aeb7bce64b09b2ff5b59e8', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 13:18:43', '2020-10-07 13:18:43', '2021-10-07 13:18:43'),
('3433f5e64e59b2214703e26830e04f606524b58c19983141a9b6876353f4c7d6d93c4bda859e6871', 21, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 04:07:32', '2020-10-07 04:07:32', '2021-10-07 04:07:32'),
('3616d36ee4cb16ae686ce7bde08d555d5de4e8e861105fcac6c20a56a258de950479de867dbbad86', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 11:34:22', '2020-10-13 11:34:22', '2021-10-13 11:34:22'),
('363e874af620b1fe1aa07cb4ab6666572b4edd995d64a5be20726e181eed4c39551f8747ec1c4e59', 21, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 04:11:09', '2020-10-07 04:11:09', '2021-10-07 04:11:09'),
('3835180ddc58481564651a23bc110a6fe2b1ea8f3e1f0445610c8a3101ac6666dd96670f6e6fe85b', 25, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 19:10:02', '2020-10-08 19:10:02', '2021-10-08 19:10:02'),
('38997c249e01e9f1b8baef551b765473553777fcbaec69c20ec1d84a8e599247da1c5482cc6a90c7', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 07:10:47', '2020-10-07 07:10:47', '2021-10-07 07:10:47'),
('397695ddb0df76b8d34927b8b8c042e2160a02bdbc703e80a019609d5ea82b78a363e02dd82b9fee', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 11:05:31', '2020-10-15 11:05:31', '2021-10-15 11:05:31'),
('3a4e5d4b909d8c13bd3f24459a111b680c92c2775c2a323c0be35feec030a595c35e9d549b078c24', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 05:37:35', '2020-10-12 05:37:35', '2021-10-12 05:37:35'),
('3a874358249fb5e78418166781de058f39d26611cde04dedb1b038496374ecedf40a65b3bd9d1315', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 11:03:31', '2020-10-07 11:03:31', '2021-10-07 11:03:31'),
('3af0df043e5c8a763cdc02f9381e764a30ed242886d87aaa9e5602334297bdce2dd97fa238e99430', 50, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 07:53:42', '2020-10-21 07:53:42', '2021-10-21 07:53:42'),
('3b78177ce293c2e62098c74725620372d5fb21f201b69379d582f478d9cd3fe357ca155afffd98db', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 12:27:58', '2020-10-08 12:27:58', '2021-10-08 12:27:58'),
('3c86cdf57b697011a51de237d91d91c21d241cf384790a92e6f9123006cc2e3535596e5d901f427a', 30, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 06:33:36', '2020-10-09 06:33:36', '2021-10-09 06:33:36'),
('3c97708dbf051030028ccf5f3d7bd2c4ae346c7ab534b6560172ce51599cc6a1d699490d556db294', 11, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 07:29:36', '2020-10-05 07:29:36', '2021-10-05 07:29:36'),
('3d33342a5e6d83100d87f8b5953822496d1b9cfb7d46bb7b284fea771c2aeeb6367ad5df1d2b0abc', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 09:30:43', '2020-10-12 09:30:43', '2021-10-12 09:30:43'),
('423cb07844f888a1e54190b2f885a526eb1a55c04227ea85b69041936a94a6259dba237800004a0f', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:37:41', '2020-10-20 07:37:41', '2021-10-20 07:37:41'),
('42cd9d985a0ed9de5b36b48c77b34f10fcf174736562b762fbb5c36587c4a7b44cc3cb64031bbae5', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 05:44:25', '2020-10-05 05:44:25', '2021-10-05 05:44:25'),
('431ffe7db8bb06e4736f78965122e0f37c9ed48da8f2e343ae8396b7a788f204d24d0ee6ed90e2f7', 5, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 09:50:56', '2020-09-29 09:50:56', '2021-09-29 09:50:56'),
('44e766e1c6876a996ab9bc44ac1eb7f5ce53b32cfcca289cf60b3a3640e2dcfbe86742535ad1c91f', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 12:01:09', '2020-10-15 12:01:09', '2021-10-15 12:01:09'),
('45c236d669284450a7fec4ad9a0c7bd9523f7180090a379b67ddfb5066d89461c3b33092d9224b66', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-01 10:07:25', '2020-10-01 10:07:25', '2021-10-01 10:07:25'),
('472bc94250daf738cf37bc2f9ed3a728ddcf497fa147481a0b0aaebb0092f1ba6e91f20a8f8893b8', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 17:51:01', '2020-10-13 17:51:01', '2021-10-13 17:51:01'),
('4a0e647c3cc3aca274c5c970d164b0db5d5646622d87d41a329fd2fce08f350f8bc8491de4eba834', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-19 13:12:16', '2020-10-19 13:12:16', '2021-10-19 13:12:16'),
('4b11676b80d20407bd14113e3b2c59a899c0ad02b623f2014058cc9be304c4db779a4ebfc200139e', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 07:12:33', '2020-10-09 07:12:33', '2021-10-09 07:12:33'),
('4b8504d5dd3cdf99d7a680b6e882b68545afdb7d3a30d1631b2e8c4f979136e968b712faa56c9668', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-23 08:28:41', '2020-10-23 08:28:41', '2021-10-23 08:28:41'),
('4ba69364ce29058ea22a6895dd594747ee47d38cfc5d38aa21ce2520f5327df59dd170f70f26c95b', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 13:20:19', '2020-10-07 13:20:19', '2021-10-07 13:20:19'),
('4c91182bb740ca00be0054f829598b21b24799e93391ea061cfa4a6686a125e5b54948ae97e9ed6e', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 08:10:29', '2020-10-07 08:10:29', '2021-10-07 08:10:29'),
('4d8a1f852ec4998fb606504a0a7ce5bd81ec8b017d450951a79f375996af0be68bab32f943d0019a', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 12:21:52', '2020-10-20 12:21:52', '2021-10-20 12:21:52'),
('5207ef425914f2b484d53500268e3160260888bc13986322e28590d73c191ba98d4981da1c6854cd', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 12:35:33', '2020-10-08 12:35:33', '2021-10-08 12:35:33'),
('525a6822ed1b64e3be76f722578de2bddbb4961e279538c9295d7f683081114e27aa22dd645cc1a6', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 16:27:18', '2020-10-13 16:27:18', '2021-10-13 16:27:18'),
('5323e27f339cc369c93a658da82416a3c090be3751e01731fbdaf0b5a697c59f29cb88c1610be076', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 17:46:18', '2020-10-13 17:46:18', '2021-10-13 17:46:18'),
('53e85219c6a370749c21d40abf60819af722a8afb74ab9e285aa0367291e3c81bb467566bd0ff7cd', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 11:36:05', '2020-10-05 11:36:05', '2021-10-05 11:36:05'),
('54e89761775889dadce898d8462a8bc0818a0b2765caca7c5259f655aecd22c3b3ba204db35a1919', 19, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 17:43:41', '2020-10-06 17:43:41', '2021-10-06 17:43:41'),
('554a0421c844b1f0ce1b10f74b599bc2325aecd31fe01e7a5d2c933e1e72ccf6ba94d65ba49cc9bc', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 08:11:20', '2020-10-21 08:11:20', '2021-10-21 08:11:20'),
('56c004e2c01e73d2de333f05b286850c34ce98cf9af2e4f90d2f7220e7e3be1b1088665a278d12ff', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 16:59:56', '2020-10-08 16:59:56', '2021-10-08 16:59:56'),
('57774d83e75f50847ac7ab5f2e13abe23003c946a972625c10727dc599f5685badeb178ab7839193', 31, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 06:35:36', '2020-10-09 06:35:36', '2021-10-09 06:35:36'),
('57f044a7a9874ef38193976ed36977fdb8b611d735d066cb3de6b9ebdda71e612cafcb5c8320bace', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 16:05:00', '2020-10-10 16:05:00', '2021-10-10 16:05:00'),
('59812a3ee31c96037f7dfcf2e2fce730e5e19fdc14503ff250a9a13a97dd110347cde9ab75dd4485', 43, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 18:14:59', '2020-10-13 18:14:59', '2021-10-13 18:14:59'),
('5a73b6712fdbb33065bc2eb8362488424d8cb07d44fb7e0f732ca581b2dd96bf3ee76ff2ac40df34', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 11:59:34', '2020-10-06 11:59:34', '2021-10-06 11:59:34'),
('5b01120f1ba0f2ebb1b4e87f6ed7d044c3a28faf2c0294398934ef4b23ededc49fb3eaad07618b69', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-01 10:38:43', '2020-10-01 10:38:43', '2021-10-01 10:38:43'),
('5e65c19136d29726295d4e818630bff4573104d06ad855805d9a70f8312c3ccd5e16da7bf40ac78e', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 05:07:53', '2020-10-12 05:07:53', '2021-10-12 05:07:53'),
('60788e2b4215b3bcf4c35f3c24f13f6e090725f7445c8d029a0725dbbf215e0caa657a7560aee82f', 14, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 11:07:35', '2020-10-05 11:07:35', '2021-10-05 11:07:35'),
('617a6f033647bd95a0102fa5018db00acbd8f3ef97f211c52439296a6a2c148b32ecaf96554c3d64', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-19 06:35:26', '2020-10-19 06:35:26', '2021-10-19 06:35:26'),
('624795a58c36d3f11b162a2af8321c77113594b7dc8c2331981637a330308956f0663d9d28c1b7b6', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 08:31:41', '2020-10-09 08:31:41', '2021-10-09 08:31:41'),
('62a6c1a70e7486d64bef959404e20ece28e17e6be7c5a6c8a42e779be2404033f3b092516be263f8', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:47:14', '2020-10-20 07:47:14', '2021-10-20 07:47:14'),
('63c2287fa2b1a05a836e8d30562cf1e5ee68f2c716a4b814a442daed29f4265930a7cbef28db07a6', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 12:16:47', '2020-10-15 12:16:47', '2021-10-15 12:16:47'),
('6435bb5d35792bcfc9c0f242dad9b1c11ea22bd519866c17b3242d6704f37dc857e5e8a967072c90', 47, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:59:00', '2020-10-20 07:59:00', '2021-10-20 07:59:00'),
('66811fc86eec4c9eabad4f5cfd5786cf456d9d3488c6fcf55a42ccb90fe937bc442e7c0fbb693868', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 11:52:48', '2020-10-06 11:52:48', '2021-10-06 11:52:48'),
('6aa5a4d82e8130fb1a6afda47df08abd9d8422e9d177256266dbb45fb2028e95636b5e5b1c158e6b', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 12:11:48', '2020-10-13 12:11:48', '2021-10-13 12:11:48'),
('6abe488728ec3511f203127436167f456512502cefeb82818eee4f7eb838d1accd8373558a95b933', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:38:10', '2020-10-20 07:38:10', '2021-10-20 07:38:10'),
('6bd6969e3d0d9b41f7454f8cf0c7e5fa18a0555851e6c6d8b640d5d8ed3f6445ae17b71b45b6f10b', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:35:34', '2020-10-20 07:35:34', '2021-10-20 07:35:34'),
('6d16152f11f91190dbf3e7a1a91695e935fe9eb0786995fd8fed8ff7ce9c04f2292b31af38f93c13', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-19 13:26:04', '2020-10-19 13:26:04', '2021-10-19 13:26:04'),
('6dc8c64f5fd8742fd9e6c6f75fbc2d029de29137bca9d36ba042bdb114d382231a14fa647276a3b4', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 09:09:45', '2020-10-12 09:09:45', '2021-10-12 09:09:45'),
('6f1b7e3651cadf06c305adcd964ce00bd65277fe66148eaa0e281eb9627028d926b010865d0dca79', 20, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 04:03:44', '2020-10-07 04:03:44', '2021-10-07 04:03:44'),
('7008352bb084426235ded394a581426df4436c3ae6aeb5f9c422c42d32c0b3c0e09f2257f423bc71', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 13:44:42', '2020-10-09 13:44:42', '2021-10-09 13:44:42'),
('7269ef8cbcb66870cbc49f5cb7f9adb33ff71121ffb8c7a58f9dc6b6ae0d86399629400c8883d08c', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 06:50:45', '2020-10-21 06:50:45', '2021-10-21 06:50:45'),
('728e69b9c240767a9a4b3ed9c41e9aca2d016c3ea861ab063c204488688ac73d66dc657f6c22952f', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 07:43:02', '2020-10-21 07:43:02', '2021-10-21 07:43:02'),
('72efa41e35e5d6217b0c46911a72eab21b6de026c45184a9757932d5cc20563cb7409b5a47212ffa', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-24 06:28:27', '2020-10-24 06:28:27', '2021-10-24 06:28:27'),
('73a5e3b25cfcd701458a44acf4a8ac6affaafcf12be7f8b38d4d1f07377c8913fabc2bafdb482798', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-19 08:59:31', '2020-10-19 08:59:31', '2021-10-19 08:59:31'),
('7446e195e5157d43c61b7cfa1d25cebf29d527abaadfaf0efdbd5b6a2c44a1da334eb7a5dafb193a', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 12:33:57', '2020-10-06 12:33:57', '2021-10-06 12:33:57'),
('74aa1f2e86ede41e11470b330b59890c98220316a5ba2f12f4ff0299d5f90966a8caa718f9693f45', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 07:54:47', '2020-10-07 07:54:47', '2021-10-07 07:54:47'),
('7581496fafc50c5a56b931c9c9bd90d05fdee0573be689537391b795072c3c3052107d1474c3b03b', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 08:24:02', '2020-10-09 08:24:02', '2021-10-09 08:24:02'),
('762e4d01475e59d2327a219ea325bb9bd6a777f58e7521118fbe0bf613d9f254c9d883aff0084cd8', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 15:17:38', '2020-10-13 15:17:38', '2021-10-13 15:17:38'),
('772d412b06de11cef5bda05e3bf89ceb358cae9499a23f12832bf11b549bb5badc50b14771ae402a', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:26:07', '2020-10-20 07:26:07', '2021-10-20 07:26:07'),
('7884acdb5f8add9705631f1b5879b1f9df8c3d2fca2d0726a140b930137fa4f0788392d237529a02', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 10:25:50', '2020-10-13 10:25:50', '2021-10-13 10:25:50'),
('78962ffecc0c4c1759297d79f7925be1e5e3ed2cbf824a508764da0bcaf75c0d1ea5bde30edc8ca6', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 07:49:00', '2020-10-09 07:49:00', '2021-10-09 07:49:00'),
('78f44764c3b5a853500f4269ce7b33f53f868a780405894221a633740bd2f5557810ffc7bac43b6f', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 13:25:39', '2020-10-07 13:25:39', '2021-10-07 13:25:39'),
('79b47832e691a66525206a6fe3e001d58ce4d5556c049508d66b0d06179ee1d0b0d3f7f95f716400', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-02 04:55:00', '2020-10-02 04:55:00', '2021-10-02 04:55:00'),
('7a9afc80604291cf88c397b8e6a81ffd24d81859e82603d8b5b4668f5a0757732ee80ae5847023f2', 16, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 07:06:50', '2020-10-06 07:06:50', '2021-10-06 07:06:50'),
('7be5809c527bcb5c79069c9a8e15d7bcc0fe8a472f16f08206e8835addec0cc46cc7f9e96aa10426', 36, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 07:30:56', '2020-10-10 07:30:56', '2021-10-10 07:30:56'),
('7d4abc315d3d9fa7c4d3fcdae3808a8728c8f9a1e38f06070f309e9c3c5625f08b39baa846492971', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-24 07:05:45', '2020-10-24 07:05:45', '2021-10-24 07:05:45'),
('7da280692526c264396c917663c136344d978397caea268d578e14ee7327fab514b4828064faa70e', 37, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-11 07:15:38', '2020-10-11 07:15:38', '2021-10-11 07:15:38'),
('7db2761bbf32bd6a83c25ab037c2555d56adf13e76cdab0ba1a5bc9fc39e45f782fc72fd22b4589e', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 08:09:04', '2020-10-07 08:09:04', '2021-10-07 08:09:04'),
('7f9a96e64386a3f17a03b16b8370175c58bfa9d103fe0b796b7f120753bc82394f27a8890fbf4072', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 16:08:46', '2020-10-13 16:08:46', '2021-10-13 16:08:46'),
('8096a1737911bf884b734f134599ca0787f78f2dfec28d160508dfa92e6ccb5943dc0cd6e0fc332e', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 08:46:23', '2020-10-07 08:46:23', '2021-10-07 08:46:23'),
('809d040cb6c63ce23c2e1915e42242c0b4d342d503bbc106de196924c788fd3b598b5ec519eec4ae', 14, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 05:55:20', '2020-10-10 05:55:20', '2021-10-10 05:55:20'),
('80fe915047cc261f74fcdc0441d9912c6077c00bf151328453cd3e76d416698a0d7d0ac89164a566', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 06:02:50', '2020-10-10 06:02:50', '2021-10-10 06:02:50'),
('816a3f848965cd135793f6ec2b4f8e1f6926fcc781eb24cf32303ca53075891f6b7cdd6402e57e90', 47, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:38:56', '2020-10-20 07:38:56', '2021-10-20 07:38:56'),
('81759cafa7d709c2a5517f5a3c3c284b44443c47d02951860ddbfe1fbde9d0378f68e036714d7669', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 07:45:47', '2020-10-21 07:45:47', '2021-10-21 07:45:47'),
('83441309866267c1149d3d91a42e3ed6d133ea1e852530ac0d38442351d76eff8b2d393f4ea7c8f1', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:17:28', '2020-10-20 07:17:28', '2021-10-20 07:17:28'),
('8350acadd99c8b2c97a4447017553d8a9166f279cbd2407bcffe5c20b640534f34f2d7ae0d1568f5', 14, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 10:33:11', '2020-10-05 10:33:11', '2021-10-05 10:33:11'),
('83c0ae19cc165534e210b2b2955563ce9fe97bf46a000117c895601fddb204175c49c6d3755474a7', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 11:03:51', '2020-10-13 11:03:51', '2021-10-13 11:03:51'),
('83efd6e91dc77c51163a9022db76041c2be8886efedb925c541ac9825abb39f6d1cbe15911067855', 49, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 07:32:35', '2020-10-21 07:32:35', '2021-10-21 07:32:35'),
('84420d9de5f5ceddaefc5ec1fc859b6b9d49ab4ec2e9c6f1eeb4c0d471333f5a2da4cf9276a9f362', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 17:57:52', '2020-10-13 17:57:52', '2021-10-13 17:57:52'),
('844a53b515a0ffe1bfd24130aeb1c5b7e2df3ea86f88fb895e8faf0a2c3c4ac3d44b3944811e74f6', 34, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 06:08:25', '2020-10-10 06:08:25', '2021-10-10 06:08:25'),
('85111381606e5f222da11e159f6e22c8e5868e00d8e94013b85d68907fbaa48e0c22f29da7e07f8f', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 12:39:39', '2020-10-13 12:39:39', '2021-10-13 12:39:39'),
('8553254b7c6fbae4e46e4a2449e6a0434e222e5840707d8c716fb57b447c9df87dfc33e7b0a85f21', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:25:54', '2020-10-20 07:25:54', '2021-10-20 07:25:54'),
('8735bd43d736ebc21942869a3774e1b8a15f89ea8adc7b5755da67a304fb8946fa45d3f5a49383d3', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:20:30', '2020-10-20 07:20:30', '2021-10-20 07:20:30'),
('87bab0c6474113b1720fd413e45abafba0dfda2a0bf206fbc3f6c15090c04013eb99f5797f7392b6', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:27:48', '2020-10-20 07:27:48', '2021-10-20 07:27:48'),
('88119d50d3af00d36af1f8dbf1406408722af9e0ea9b321e5b8eff975ccf7d8ded1ba40556c37573', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 08:41:11', '2020-10-09 08:41:11', '2021-10-09 08:41:11'),
('881dc97cacd64d099f07a99865072687e95459b8fc5c43cc842f233efd36deb0758ea7ba5fd420eb', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 20:38:42', '2020-10-08 20:38:42', '2021-10-08 20:38:42'),
('892e1db0a7e581d44ba1eaa2e42d9c5747f47de5c66403095dc8d7db55ad81b6c80cbba826c0b480', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 13:22:47', '2020-10-09 13:22:47', '2021-10-09 13:22:47'),
('8957015d524b48e918926282c87d698624cea3cf5ca5563981e13b358abc1f0c4d3d2c2b2002d53e', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-14 14:07:18', '2020-10-14 14:07:18', '2021-10-14 14:07:18'),
('89ee38ed5af7ae3bd54b3741012800b354a3cf4528bb0540ef34d3c21f994650c550b5f9ebd74174', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-27 05:26:33', '2020-10-27 05:26:33', '2021-10-27 05:26:33'),
('8a99d78fa466248320a54fcc8d013eb00031b6caf1f2c21a8b1bd3f4fdecdc153007e24cb0edfac2', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-24 06:32:28', '2020-10-24 06:32:28', '2021-10-24 06:32:28'),
('8ad086e616aee647353f4767e11e203642d84cbce58338b1a48de181a171a0041116de93db3d7e21', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 10:49:54', '2020-10-08 10:49:54', '2021-10-08 10:49:54'),
('8b828f714f8f2f6df62857a8175f87a0b9ea9be6c13dc710643353503cbe3511021ea9f2e945d886', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 12:54:56', '2020-10-13 12:54:56', '2021-10-13 12:54:56'),
('8ca2f45fb0ff2efd40e5f9663b9086d1b8bcd1c3d6f2683b28de2bcde7dfb17f89fe7723f2e0e85f', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 10:30:05', '2020-10-15 10:30:05', '2021-10-15 10:30:05'),
('8cac8a55af2b3756e0edb276e3621b205bb1aa70bedf17beb89d822e2160b48f82945610169f5c42', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 12:47:54', '2020-10-08 12:47:54', '2021-10-08 12:47:54'),
('8daaa0d00c9c5e877b0e574cb7178f068b094bd6d252329db8de84b1d31cae47f812d3b869b3cc26', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2020-08-17 09:29:21', '2020-08-17 09:29:21', '2021-08-17 14:59:21'),
('8e06135194f93a1f5965c655dd3e7659c6bd1c38127dfb6196f89bffc02748403e4d3e46d79e933c', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-26 05:16:53', '2020-10-26 05:16:53', '2021-10-26 05:16:53'),
('8effa6ba81f04eb958f61ed53c24ca6aa8c03a612e6d44502b3dfa1967a40e2cab83af3825126aa7', 48, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 08:59:51', '2020-10-20 08:59:51', '2021-10-20 08:59:51'),
('8f4526cc28b3f840e2f0e198bc1582da3039b9a3e3cd715ad915e668faaf701661606c4c94f4cd44', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 07:29:56', '2020-10-07 07:29:56', '2021-10-07 07:29:56'),
('8f917d3df62317adddeff2e064b2aa524def74156b92ade70200d7845310b481ad9cee75f7a3e65c', 5, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 09:48:20', '2020-09-29 09:48:20', '2021-09-29 09:48:20'),
('90606b32cba8e1540a9d5ba984d1fb6ee9c0aade0631a0b5aaa66abd69edf2e290f347d0b5e8b39b', 29, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 06:30:46', '2020-10-09 06:30:46', '2021-10-09 06:30:46'),
('90c9cbc2e5485f189296985a41b7991d0a33b9485bcd53c5e61d15ca0bb67ba42879a720d95a06fc', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 10:20:03', '2020-10-10 10:20:03', '2021-10-10 10:20:03'),
('90e7bec2ecbba983e953c15ffa02ffdb14f30f2298f01510c83bbf75532b9bec56b75ba51f728fdf', 33, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 06:52:59', '2020-10-09 06:52:59', '2021-10-09 06:52:59'),
('923569be2425d001a6a12511d4419a6f05d23809aedd67165654ffce170fd4fe929c4fae6d816fdd', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 07:31:21', '2020-10-21 07:31:21', '2021-10-21 07:31:21'),
('929a014d6def5bf170fa3f802bc633e2cd3de2a1eac3937861aa05c1694befdb2cad2a18804c23ef', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-27 11:29:23', '2020-10-27 11:29:23', '2021-10-27 11:29:23'),
('942a8b23855f678b74939b94c85449ab8c90ba466d01cb7b08872bbc951dd81c9e5f1d03a5516051', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 15:11:31', '2020-10-06 15:11:31', '2021-10-06 15:11:31'),
('957481332c64c1af43c20f8a77814bd3ad4d4a988dc291df5c64245a5946e3625fb941ea9315a3ad', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 12:42:19', '2020-10-13 12:42:19', '2021-10-13 12:42:19'),
('98360b37bfa4ae5ddda7d3b25adfa27f1d259c82d822f896db9c56f80a3234bc0294767fad1d8504', 5, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 10:14:21', '2020-09-29 10:14:21', '2021-09-29 10:14:21'),
('9843e05f5cea4b168c827fe4f961e3c8a51370191a12c7a5e9a81aa5df2e869b2fdfd98a6410c247', 7, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 16:55:07', '2020-09-29 16:55:07', '2021-09-29 16:55:07'),
('98da6c4957ba76371f0f390af3f685d43b11da3658bab40259142d4cd867dea2c7898aa996bdbf1e', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 20:36:41', '2020-10-08 20:36:41', '2021-10-08 20:36:41'),
('9a0421c8bff41017a1f50605bf4d2d90c88822cf6c7212f3fd1011369963aa1134f1540bd344beb2', 14, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 17:17:59', '2020-10-08 17:17:59', '2021-10-08 17:17:59'),
('9abb10cedfa73c8dda2830c057b40768a6c27e421ab507af8e76333a45ad941805c88260d3c0dfc8', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 17:31:06', '2020-10-12 17:31:06', '2021-10-12 17:31:06'),
('9c8aee7bca8bedc4dddd57d19d30e92c11c4cd9858ec90176c227e617dd0b0661ab457c71533fa08', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 10:56:28', '2020-10-13 10:56:28', '2021-10-13 10:56:28'),
('9d78ecfa45a824bb392f609aa12b5c7e1a081f8ff69a189cbe8c6a485cd990ec9939defe177c8154', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 04:02:32', '2020-10-07 04:02:32', '2021-10-07 04:02:32'),
('9e1b1fe29cb39c2f983911e1e9c4cb3945f02336838a1d3e7ba0f7f5b039c626f4a605e0f351e0ce', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 12:56:04', '2020-10-06 12:56:04', '2021-10-06 12:56:04'),
('9e4354ca721683e31cc470ea6ad11566c4853149127a02aa5ff13eeb05562de24a8fb8b50651daa4', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 11:13:57', '2020-10-13 11:13:57', '2021-10-13 11:13:57'),
('9ec3d8bc6d79ce02fdc6d582055e04b2a48c3bc1a935eee76228cff321baf2b1dd2e3eb2ebaf30ba', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-22 11:06:44', '2020-10-22 11:06:44', '2021-10-22 11:06:44'),
('9ec3e84e329d3103ac39f7e0a8be4fae2fc5b4726e1bdd585894dab0e3c17052330d7d6450fbbb71', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-22 12:08:02', '2020-10-22 12:08:02', '2021-10-22 12:08:02'),
('9fffb80db437f1ef1d79898ff39cad28e377ae96d0bb63b87a6e3c35db4c17bdee9de82dcc4b5f79', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 09:00:32', '2020-10-13 09:00:32', '2021-10-13 09:00:32'),
('a046de885adce714a65e0aeb6bda9d62f0099b9fdba0ec2f4d3558ddf815499f9fd7a6358532235a', 20, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 04:06:03', '2020-10-07 04:06:03', '2021-10-07 04:06:03'),
('a099ac4fb8cf32299ea3de311e89c6aeff1d3692471230264d175a834d8d8b2cbc0f565ffeb8f1f5', 34, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-11 16:54:44', '2020-10-11 16:54:44', '2021-10-11 16:54:44'),
('a09a5283710fbb831866453fc8ef7bd8393b925605f3e671ffad0647eb26b7e3a1be358838b0c00e', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-28 08:56:59', '2020-10-28 08:56:59', '2021-10-28 08:56:59'),
('a0d3e4151602eda7be90508fb2925c83581dc208c3405a525105eeac5c48db80da057ebd1ce8e5a9', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 09:41:17', '2020-10-09 09:41:17', '2021-10-09 09:41:17'),
('a165f39567c1a611a59190359360d7536640f0c139a0b0e25851d71856c734f10e9cadb730df0382', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 10:04:30', '2020-10-15 10:04:30', '2021-10-15 10:04:30'),
('a2694ca77065ec0f0af95e61a660d3de8da73e73caefcae09e2e7ab995d552f5ea6e1c9ca76557c0', 7, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-30 06:58:46', '2020-09-30 06:58:46', '2021-09-30 06:58:46'),
('a2ba861adb965a0ee48c9b7901c9610c7fabc208728f68fd84886e6a6927f9e049ec973541cc71b0', 7, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-30 06:09:25', '2020-09-30 06:09:25', '2021-09-30 06:09:25'),
('a2d896a2cbe3148a22638576567aa5a99b268e783440455c516c21e2bfe927b0a3dbaed35ad07f13', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 05:38:33', '2020-10-08 05:38:33', '2021-10-08 05:38:33'),
('a687d413cee754bc8ddd22979ce1d171cf80931d30259dea4cb0645e835e96d6be7fdcc1246fc37a', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 11:50:58', '2020-10-09 11:50:58', '2021-10-09 11:50:58'),
('a695217dc6a2ab686a0165e43a4160d1fc0de338b2fae46ae55da52dc434b6fcc8cb761da96c51e7', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 11:29:38', '2020-10-13 11:29:38', '2021-10-13 11:29:38'),
('a73a52c4a5e8a63ff28291e2f8c85d68c1d6f07854799bab9ac420bfb9d56c5076fb6b99fc19b239', 5, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-01 09:32:34', '2020-10-01 09:32:34', '2021-10-01 09:32:34'),
('a7c88c0a182fa03bb64d7e40c3f32e2beb8859b8227938a1a1806d082c1c80621871065275c8c78e', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 20:40:10', '2020-10-08 20:40:10', '2021-10-08 20:40:10'),
('a8ebe92c3f13abc9fa6786284637db5ffcd4ad76aa3ee5d059d3b11f45b018985b98aecbbeae3a5e', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:26:12', '2020-10-20 07:26:12', '2021-10-20 07:26:12'),
('a9690a50fe400cf971082ad616bfd1e15672d8dfeca5e658b34b25173e7e2f042d95b5f73f3fb967', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 10:43:48', '2020-10-21 10:43:48', '2021-10-21 10:43:48'),
('aa84a0c5ccffde6e2ead73c390a5c8313f5d1f6535173841a0b0d2c99fe06e583a8f225b066e86fc', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 12:00:54', '2020-10-13 12:00:54', '2021-10-13 12:00:54'),
('abcd369264f0e9962a917763c07eeca7088731e18afbd9c814c50c2f1f3a0a0bd975bfac62401226', 5, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 09:44:53', '2020-09-29 09:44:53', '2021-09-29 09:44:53'),
('abf2992dc1f07a744fa4e80536c60cfec7ae70f6609a2861c75a0a66e01b591b337ab9cf0152ec79', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 20:41:58', '2020-10-08 20:41:58', '2021-10-08 20:41:58'),
('ac45db7ead3ae90ffdd425af30a9b21be7cbe5ff91bc980b7b01d471f0d155aaeaa06d682f2dfcc6', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-16 06:01:08', '2020-10-16 06:01:08', '2021-10-16 06:01:08'),
('acb043f31f2269ef7520f0c2788d4af5033ffc6cfdf2845e554edcef59d0c3c7784acc4bd5d0a3ae', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 07:57:33', '2020-10-13 07:57:33', '2021-10-13 07:57:33'),
('ace3fd69486c0258f10db6135af22797fddee6c6dfb3758d2961bc48314a5dde94e34161e4d88561', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 07:39:42', '2020-10-10 07:39:42', '2021-10-10 07:39:42'),
('aec45cde446ae21ea2460238bffee8e2d40e83a4b0ffa664240a3f71e4cd1063fa56e9a869760077', 8, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 17:04:44', '2020-09-29 17:04:44', '2021-09-29 17:04:44'),
('af666e3025a1a19e1f65f875de10cfc31adaf65e6e8505f34cad17f5182bcfdcae771fbf3ac8fca5', 7, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 16:41:29', '2020-09-29 16:41:29', '2021-09-29 16:41:29'),
('b034b6420d36aba6d3f2cb6cc89a8a87315b954f73b06cd519b9f19ab66c7add0d7962e605fc0913', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 12:44:04', '2020-10-09 12:44:04', '2021-10-09 12:44:04'),
('b0d087c96fe90b73097c3d5f3f9545c3417b94ad5c66b45a8372bdb193ea57c84b9e099fecb4e3a3', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 10:44:03', '2020-10-13 10:44:03', '2021-10-13 10:44:03'),
('b1e540c93731aa8c60792b96b7cd274f8f2ddcb75bd205c3605d74e9267ef490678e2fae248ef1de', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 16:24:32', '2020-10-13 16:24:32', '2021-10-13 16:24:32'),
('b21e8060a8d929cb71075606449ab3e1239ad456b37a1af5afe83e0740ff75e07f108884133ee443', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 15:00:54', '2020-10-06 15:00:54', '2021-10-06 15:00:54'),
('b244c94313d06ea06c4e8da0704ed64344ddc7fe99bae00f1f25b57affe11a31b1d55ad28429ee4f', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 11:10:56', '2020-10-09 11:10:56', '2021-10-09 11:10:56'),
('b3bcd964c03326c017b0970bdee4a0301f055107b3ace56698f278c562dc5c77de8e3ce3d079ca7f', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 11:36:42', '2020-10-12 11:36:42', '2021-10-12 11:36:42'),
('b428621f5722728c0d01602b7fc7fa9e61e7bdaf72b9ba55d93874d34022bf5d1a241fcb361f2ecf', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 12:15:59', '2020-10-07 12:15:59', '2021-10-07 12:15:59'),
('b4eee6ad7fed9021ec430ed86fa26371fcb77a3612de462ae9972014b532bc48e3c45c03c510fc5f', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-26 06:07:45', '2020-10-26 06:07:45', '2021-10-26 06:07:45'),
('b51b5290b400358128977062ca4b141e7e6aede9f12922224831fe6fa2a411636347333a6f45dbdf', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 15:55:18', '2020-10-13 15:55:18', '2021-10-13 15:55:18'),
('b57b01ac40d99d1dd1f7889269963c4bbc6e7f6c03814dab5a06455d31bca43517eaf24797fb2f9e', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 12:07:42', '2020-10-07 12:07:42', '2021-10-07 12:07:42'),
('b806ae5941137a5f04d955a3098487cc36e12324ffbef0e5102b5e2e8ca95237085f55240b0694c3', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 11:50:16', '2020-10-05 11:50:16', '2021-10-05 11:50:16'),
('b9b17974a159c17bf17837073ef96ada3eb37141c57431d6c33739ea2889eb65cde575846416192e', 7, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 16:26:36', '2020-09-29 16:26:36', '2021-09-29 16:26:36'),
('ba146fd95589ab8ec7cbec33e007ac3c8bb8c32d7854752ad6e676ca0529ba0aa09bae8d131a0271', 41, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 09:47:23', '2020-10-13 09:47:23', '2021-10-13 09:47:23'),
('ba4a759dc12a1adbb58329793d3b96e66d5119d7bf96fc406341865b02c1ba4db1fad6917840752e', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-19 09:48:33', '2020-10-19 09:48:33', '2021-10-19 09:48:33'),
('baf4d4d74779b9e1d817172ab4be0dec9308e52aad2c9da9da565de0bd4f7fb8905b74b8f824f53b', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:34:27', '2020-10-20 07:34:27', '2021-10-20 07:34:27'),
('bb935d646aadd560b0c958564a41bcaf7c8a9dfc7daf14b103688e14da545c0a0fd3277138fac3a6', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 18:40:18', '2020-10-12 18:40:18', '2021-10-12 18:40:18'),
('bc61891084f78482e0028b7438f3278d8db30086e1aac27b11d29834f9dbec430de975f3e42e813d', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 11:49:16', '2020-10-13 11:49:16', '2021-10-13 11:49:16'),
('bc6a6ca3eff25d47c85b19c24978ba8344cb7e65bd0a36fdc8ab78e8c3c131cc50ea691c44a78939', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 12:28:27', '2020-10-12 12:28:27', '2021-10-12 12:28:27'),
('bc6f8857dc81da6886b7b4233e8db220e637a0568a663327861f97b44d92a3eb5fd80df1f8c3872b', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-26 06:08:28', '2020-10-26 06:08:28', '2021-10-26 06:08:28'),
('bcb2749adf31200e47cb75c973673da6d317c0e72c2196f930c0567debfba2261b7dcf13a0825fca', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 13:12:11', '2020-10-07 13:12:11', '2021-10-07 13:12:11'),
('bcd49b4e16a542a0b1b90d0c8da9ae5332bc67d4ae7dd7f6c814baf5be3e9e125c99a16a4f718839', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 12:19:00', '2020-10-08 12:19:00', '2021-10-08 12:19:00'),
('bd31ab2fc6f54bafad399ccac15c185b7253e1520cd671e950e756f154cf249f357e6a767b37b2f8', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 17:42:10', '2020-10-13 17:42:10', '2021-10-13 17:42:10'),
('be5067f4b3c900f7abe5125907e8d123f627f9551b25b493ea90828dfeb10b55e658b7ce9f97aae9', 19, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 17:45:55', '2020-10-06 17:45:55', '2021-10-06 17:45:55'),
('be65b9928dbcd25b002b6a50d540063cf3864fae3b2fe77c158bdbf2e33262b3a0fd94027e2749f7', 26, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 06:21:09', '2020-10-09 06:21:09', '2021-10-09 06:21:09'),
('bed0e9319d2b56f7184500de9e06a75f0cb5dc981750573deb23c53937ac7269376611929a40b6c6', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:26:18', '2020-10-20 07:26:18', '2021-10-20 07:26:18'),
('bed974013f64cd9cb6396fb393d71ae17e716ff587f40d72d7c33014a160e669b02aec5d689ad72a', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 07:17:38', '2020-10-15 07:17:38', '2021-10-15 07:17:38'),
('bf18fcbbb8792c8a50709e8687b738ee1aa8419539912c3fe14a2f802f588ac618b42b8aecb19230', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 09:00:24', '2020-10-08 09:00:24', '2021-10-08 09:00:24'),
('bf1e7ccce1783a2f6829a08abc076cf81ed68412abb6c804506a024ff7f62683a90c59aac359ff75', 42, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 18:10:20', '2020-10-13 18:10:20', '2021-10-13 18:10:20'),
('bf209fcb34a3aed2d60c4b1bbe0304e2c076296a6c223b2074b278428c6e05c8ace4573dfcdf9ccb', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 12:03:49', '2020-10-08 12:03:49', '2021-10-08 12:03:49'),
('bf8f858293f4245dd82c1d35b77ba39cee18a18640ec363b6536912af6c0e002a8eab45b95b60a5e', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 09:26:57', '2020-10-15 09:26:57', '2021-10-15 09:26:57'),
('c0a2b713bebced0dec0daa1a6d2c373e737067d2e520d6b438097101ddd74195494ee8c5e4b09075', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-24 11:56:16', '2020-10-24 11:56:16', '2021-10-24 11:56:16'),
('c28985ffc7fbcd35068f658e8d2dc14c9dbd43b264272bfad824ebc7b27c335a28713a052d616378', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:16:26', '2020-10-20 07:16:26', '2021-10-20 07:16:26'),
('c2c48dd0b3bf5102f9e447fe579c2da2aca3876e1ec560bb514bf91d955e85c574b006205fb0fe36', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 06:57:34', '2020-10-21 06:57:34', '2021-10-21 06:57:34'),
('c31da200a6279b5110386fe9ba409ff30b8957466903c53671c6dcda05599da2ce2f0e45e6ce9095', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 20:31:34', '2020-10-08 20:31:34', '2021-10-08 20:31:34'),
('c3ef3dd61951df0805f4540cbd84db9d5f3767a6a0f935caec5d13a73165110bc809a04be4d0f8a7', 7, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-29 15:51:47', '2020-09-29 15:51:47', '2021-09-29 15:51:47'),
('c4d259530b92d223ed80404323bf60cb7bd7375ca4d2a1522f56a62ed9d30feeee69240ede4f42f5', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-26 04:20:50', '2020-10-26 04:20:50', '2021-10-26 04:20:50'),
('c54f5fb32178df94b65e82a563cd8fd437f159029a8a4c29443e4f5a7587d1448f72d10e5612152f', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 19:50:56', '2020-10-08 19:50:56', '2021-10-08 19:50:56'),
('c57ba05cb1332aa108cd3cebda15d14c8fe8021f00013d9377c409f7d85ddd5a51328f90cccf60d9', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 12:08:34', '2020-10-13 12:08:34', '2021-10-13 12:08:34'),
('c5b9275278400ec234d9e1506024feb35ad933c2da509fa53fecffcf3563693a75f4631586552567', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 07:14:11', '2020-10-07 07:14:11', '2021-10-07 07:14:11'),
('c691c63e58aa30d11009a96bf80c56fb6d6409540d75eeecfc512a95a7f75515585511c1feb14526', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 14:08:36', '2020-10-10 14:08:36', '2021-10-10 14:08:36'),
('c76807171b2ddf6d5e06f00e4fba6910abe5d87a432edc4a77e91b83abf619ddd0f7175932791563', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 11:24:20', '2020-10-05 11:24:20', '2021-10-05 11:24:20'),
('c8c83db091034aacb6d053ac5d6dc3a0fedd30535b55de84c9459fd04e5426b23c9405ddfc761ecd', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 12:19:57', '2020-10-09 12:19:57', '2021-10-09 12:19:57'),
('c8f37d3f333c242d114a4a84b1bd55b86ad373a8368e9e1cb7d0ecbcba50dd1c1bd45eef141978a9', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 11:26:54', '2020-10-10 11:26:54', '2021-10-10 11:26:54'),
('ca5a01e526fda35a8669aaf4f2620b8c9d9d6837b2cc1e2b5d68f99e4a86ed4d94f838f17a953a6c', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 18:15:47', '2020-10-13 18:15:47', '2021-10-13 18:15:47'),
('ca9ea9781ae356e8a5c5ebd556dac3def58cf9800cfe8889b244d65564c2c9807f4363f7b021b599', 38, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 10:45:40', '2020-10-13 10:45:40', '2021-10-13 10:45:40'),
('caf2b6f7690e06e7d60bca1456c17fc9e74d978fa282d0e47917ece4d5972c964c4373f942c5dfef', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-14 07:46:11', '2020-10-14 07:46:11', '2021-10-14 07:46:11'),
('cb61c0d5c2b68f8edc4e15828993e894caa73e5672f6988274d0f5fddf9ef40b7e7c0e1de12ea3b4', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-25 02:59:35', '2020-09-25 02:59:35', '2021-09-25 02:59:35');
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('cbac465d96c18e8686ba49c7f24eb3c4dc96f256ef82588939dc51d2ff7872b57c2813c03e71e739', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-27 11:03:55', '2020-10-27 11:03:55', '2021-10-27 11:03:55'),
('cbe489537b82e0469c26438803bb9fb276da18acbf7911871d79c44351570bbce402f4d9e148e4cc', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 07:00:36', '2020-10-21 07:00:36', '2021-10-21 07:00:36'),
('cda96c0de263b270ae5ad9ee9f291250ea6a56fd7491a6907b05a1ac2cb7f0dc965808fdcb7bd796', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 10:41:05', '2020-10-13 10:41:05', '2021-10-13 10:41:05'),
('cfa3dc1e57a87d5eebb04e3c658480b31781dd822499078fa5ea63e77004c80cb13a2d6eb11df6b8', 34, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 06:08:46', '2020-10-10 06:08:46', '2021-10-10 06:08:46'),
('cfab23a35bc01fe74322cdb86ce12028f8d538769e5f782c76a3baae7a93412d83eeb6599bd1db07', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-08-17 09:19:23', '2020-08-17 09:19:23', '2021-08-17 14:49:23'),
('d1febe5498a050296033d32083b807daaf356f5e6eb92ad3f776b95635e00c015eadda30048f4c3c', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 05:33:13', '2020-10-10 05:33:13', '2021-10-10 05:33:13'),
('d2e4360bd9845697e91d6d241aa49999c3ba435d9c3d05d0919aa7f5e9c67daec6cbe1da7673bef9', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 07:16:25', '2020-10-07 07:16:25', '2021-10-07 07:16:25'),
('d32c3b46f1ad6ad0f359caf0b410702eab99c15a3621d0cd8e69b77047c63c2f2672b5b346c7bbe2', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 08:28:40', '2020-10-09 08:28:40', '2021-10-09 08:28:40'),
('d352534be4551ec4fef28e78bbd35a66350e66b13111e275441a42b1e320f9f03024e72692e3ab07', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-12 07:38:06', '2020-10-12 07:38:06', '2021-10-12 07:38:06'),
('d3ce810570b68ec3d350102271ed9a289b8feb04d9a47bcecc4b63346064377f36aab1ca34f24a65', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 13:16:22', '2020-10-07 13:16:22', '2021-10-07 13:16:22'),
('d426d35d7ba1d6ada28fa22e654e36c2ec77c27a4006fadbf136b75f052ebf987676e785d61f0a01', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-23 08:32:49', '2020-10-23 08:32:49', '2021-10-23 08:32:49'),
('d50531bc248780c0e140b3037a5023f7032bf144d0f6d821d4ad366274c813f8d37d0265a8d2f8d6', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-27 10:47:13', '2020-10-27 10:47:13', '2021-10-27 10:47:13'),
('d52e7c6401d977a46a1ff069bcb75951984cbb458e86277f15068bf645f01f0709a5985375aee194', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 08:19:49', '2020-10-07 08:19:49', '2021-10-07 08:19:49'),
('d5437fc8a47fb6de170d88469cc812c5e10c92a860db41a51e199b54c11605b85add71ffe66da457', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-19 11:42:23', '2020-10-19 11:42:23', '2021-10-19 11:42:23'),
('d63340d85ec437720cbddf4aea9ac0511ae0e3754c17af7677d06ccd688203ac3d43e6f8d72cd6b7', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 09:01:47', '2020-10-10 09:01:47', '2021-10-10 09:01:47'),
('d69227ba4b88a2e68719508409d137d7f96d659019d0379577750ee21a702759be131defb3cad83e', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 14:41:25', '2020-10-06 14:41:25', '2021-10-06 14:41:25'),
('d7505b40fa763133811d4e3186b1c2d1b5df863e331f2901ffc6886e95042b72e3ad511015572341', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-22 10:18:27', '2020-10-22 10:18:27', '2021-10-22 10:18:27'),
('d8d2025d25fab49908a3e839522b5aa1919f71fe46e00bfa9ef39941c34ac0366c74eb932dc84faf', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 07:20:40', '2020-10-13 07:20:40', '2021-10-13 07:20:40'),
('d99cdbe76f2d4e3c1a815bb0942367352a6a3f23e412b2c870c1d86358461a3e1b28e1cfcd19c38b', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 09:09:53', '2020-10-08 09:09:53', '2021-10-08 09:09:53'),
('dc0009a6a560c88dcd74688455871d007d44191f4b9cd9c0e5ca1ad99d342545a3f99195ebbc4740', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 10:54:06', '2020-10-13 10:54:06', '2021-10-13 10:54:06'),
('de6a1b67d4746a8f2830867a5b26e19e68da19448742c7c9d7472a3d7927456a5b07d8b0dea5c669', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 15:10:27', '2020-10-06 15:10:27', '2021-10-06 15:10:27'),
('e102c4c58d25356d6107104a3d6afb5c1010fb04e353feae3658130c640b257a70941cc468ddf753', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 13:27:23', '2020-10-07 13:27:23', '2021-10-07 13:27:23'),
('e1262285ac617932635dc7f03495e7c482ff2251013a94e108abcedfb01afa93ecc05f6ea63bafe9', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 11:45:33', '2020-10-13 11:45:33', '2021-10-13 11:45:33'),
('e287bbd278380df9411e29a3cc96015a25a68349bd3f8506b998276b450d803e2a19055f2d418bfa', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 12:31:36', '2020-10-09 12:31:36', '2021-10-09 12:31:36'),
('e2bbb2d20b430afe3c3bef9f3a0087de9eaff94cd3439c959b962870110b2184e572f917a24b9b28', 44, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 07:16:28', '2020-10-15 07:16:28', '2021-10-15 07:16:28'),
('e3b37814f87767de8b7c124fd916d32bb0eb498fb999576a631a6a6871d9edd0540a7890e0f0ef26', 14, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 12:25:15', '2020-10-05 12:25:15', '2021-10-05 12:25:15'),
('e4b2b8adb851be8d801f77ee65c8140e450a542bf6f3e1b517a3e3323fa61361ee56ac74e9734136', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 20:33:11', '2020-10-08 20:33:11', '2021-10-08 20:33:11'),
('e635a0ea6029124121b2bd24f01cd4e9c20e655350197668945945c5404c8e30ffcf70cd065915f0', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-22 10:18:31', '2020-10-22 10:18:31', '2021-10-22 10:18:31'),
('e6a298b7383ac439f82be259815cc87032b2283012e730d3395ddbb77774955c58c64c6e00a882ad', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:26:22', '2020-10-20 07:26:22', '2021-10-20 07:26:22'),
('e70a692a7b2e0b77279cb31ef91f68a7040a18b9064837ecc4bab8f1690b4eb1f93f581bdbf6ac1d', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 13:45:29', '2020-10-10 13:45:29', '2021-10-10 13:45:29'),
('e7cf04c6958f6624ea016346e16312b790367ee98b2ccb323f9e141fb27e192118c9844b38ee505c', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 04:02:44', '2020-10-07 04:02:44', '2021-10-07 04:02:44'),
('e8609da6c28fa014dd125fd3e75777f07ae05b989ce70fa23b1f67d13a0573f7104b3d1a69690882', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:29:39', '2020-10-20 07:29:39', '2021-10-20 07:29:39'),
('e905347d62ced35ab80acbc18869d7cc682a48ec90aa7d9057aecf00ca95ea1cc3c1d3dbd03715d6', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 07:43:14', '2020-10-13 07:43:14', '2021-10-13 07:43:14'),
('e92860de92cd06b0f9df0952a8f968b690b57d5a1c9300b70ed944ed51bae2bf5721e7443cc471eb', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 11:05:07', '2020-10-13 11:05:07', '2021-10-13 11:05:07'),
('e938315bbecb3bcf0ba8866030044f088e5f7a8ce53a9532ea5f605c16a6e9fa2f35e137a8384d43', 11, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-05 07:26:05', '2020-10-05 07:26:05', '2021-10-05 07:26:05'),
('e9522ee3f93c9c0c4bd914b206ac4929ea18f0d024d8f00a16b95f17890cc2b5ec16ffb94668e8da', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 07:29:39', '2020-10-21 07:29:39', '2021-10-21 07:29:39'),
('e95a247eeb18ed2e1242b6fb3cabd989bced4666adafd87cbcbeb5d5776a13b3b581e34f0e99b900', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 12:36:07', '2020-10-06 12:36:07', '2021-10-06 12:36:07'),
('ebe0f79ed8a049a122486e7098c9fd4480a8c33ccc573968e1a9898f72498f81ec7b6d52c3541251', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-21 07:47:35', '2020-10-21 07:47:35', '2021-10-21 07:47:35'),
('ecbd786ae100d93edde711605dc686cd25ac138eb8255a35c96e24af6eecc8a82d9837737ad61dab', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 05:25:19', '2020-10-08 05:25:19', '2021-10-08 05:25:19'),
('ed83d014fba0b17a0f8ee468e245ad9a9d9491adf4c67d368c6efc030e2a3cf877db11eaaaa46174', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-27 05:26:11', '2020-10-27 05:26:11', '2021-10-27 05:26:11'),
('ee953fe32e18cec8a707f36339c7682725c813349a297b0cebb2fd3441a7557ceaaa43b6940d2953', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-19 12:07:23', '2020-10-19 12:07:23', '2021-10-19 12:07:23'),
('f05a0a4984f924436a998d434cc9e1b7d1655648b7e8ed8e7d40247bee3d6ca3844ff119217c8071', 18, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 09:17:19', '2020-10-06 09:17:19', '2021-10-06 09:17:19'),
('f0e86b4180d6efcf7c613738efdce18f8d399a741383d635877e66d6f8ea0dfd8e8d2b9f4cb4ccd6', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-08 09:51:20', '2020-10-08 09:51:20', '2021-10-08 09:51:20'),
('f2e5990523aadd4e28da77af9ace47774d0c6d0b8b6d5d68c94f9109e5c42dcc3312e4cc2b1b0334', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 15:11:04', '2020-10-06 15:11:04', '2021-10-06 15:11:04'),
('f3012377a06ae25b3cacfc3fd15e88b23bc8e74dcb55817df54a2aeb519472a7fcf083bc620ef9ab', 28, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 06:27:15', '2020-10-09 06:27:15', '2021-10-09 06:27:15'),
('f3ab828cf8fe9f5146a82bd6dbe031df27616119fbe97dc1bf55e48e9e3b2b6b2bbc17fcae671883', 38, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 07:43:42', '2020-10-13 07:43:42', '2021-10-13 07:43:42'),
('f431a16113b8bcfca31526c6052cf1bdd74fa3a99187bfcf4cc406d9514c60911343182d10226a8f', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 09:43:29', '2020-10-06 09:43:29', '2021-10-06 09:43:29'),
('f45dd094b6bc0351b17ec8eed3b4555472a9e0478d2df481f9e8b1c96f6c1cb9dbee2b58e90a0d1f', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-02 11:11:59', '2020-10-02 11:11:59', '2021-10-02 11:11:59'),
('f48b757bc977b74a23b19d642faccc04122349d1e616541dead41683f53194b751a7317fabc136d7', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-11 07:16:45', '2020-10-11 07:16:45', '2021-10-11 07:16:45'),
('f4c3cc7361d76f60d6786e3cf8685ae72b91f369c748176f80cdd368bf9a57338fb94d60465a65f2', 40, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 09:40:01', '2020-10-13 09:40:01', '2021-10-13 09:40:01'),
('f5030e893bcac8c885c2926aa6cd7c865ac0dad82aa9c3d4a2006022832536eda742726e75182ff7', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 07:33:59', '2020-10-06 07:33:59', '2021-10-06 07:33:59'),
('f52207859f2a070a1678d492cfdce3440bb8191fa95686409caedffcabcb9bfac65f84a8bc3bc25e', 39, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-13 08:50:20', '2020-10-13 08:50:20', '2021-10-13 08:50:20'),
('f6011fece6c5444b3750d3b4fdd8729d6a50ab619103bbe53b82f17f82ad06aef84847d128daee79', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-01 11:21:57', '2020-10-01 11:21:57', '2021-10-01 11:21:57'),
('f6150dd2bc9825f65e1a6b4bb15f29a245f078022a95f6abbb1b9fd20f710a56ea8670ff92c6e8c9', 7, 1, 'Laravel Password Grant Client', '[]', 0, '2020-09-30 06:57:56', '2020-09-30 06:57:56', '2021-09-30 06:57:56'),
('f809573a4a0e8a7109cd60eabe7f1e64ff130e7c34c9b3c50d8c3f06e5dbbf4851b7e9256a5898e5', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 09:12:43', '2020-10-09 09:12:43', '2021-10-09 09:12:43'),
('fa5f2e8b65388b0298095083cdfdfad063bf7d944610caa7bf0a8728ac55aab616d8904377900cf7', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:16:31', '2020-10-20 07:16:31', '2021-10-20 07:16:31'),
('fa6b87628de4636bbfd9e49864370832e7100dbc7107a0d3d457ac274076c1d762c336a9598034d3', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-09 12:32:55', '2020-10-09 12:32:55', '2021-10-09 12:32:55'),
('faa87a558b72a9fea1ead3f859a6bf9fd48990b357e6ef55bc7e16cb46043c1d9f65ebe4b75fab8e', 15, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-15 06:38:26', '2020-10-15 06:38:26', '2021-10-15 06:38:26'),
('fbd997b2c42cfd0fbad0f90461d08f8dda5232fc2ef5ce1d8b68a65435c069ab10b8b1dc13b7afff', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-22 11:05:53', '2020-10-22 11:05:53', '2021-10-22 11:05:53'),
('fc3446c54c1fd0ac403fec3f589c044b852b39d709a56d17c3566b5479bbeefbce6a77c7fd793edf', 47, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 08:10:01', '2020-10-20 08:10:01', '2021-10-20 08:10:01'),
('fd9a5e4a433af3b4b0554a78fee31bfdb1fcc3ceabb59aa86a74f3f87d27ac9123c873200c1d7df8', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-01 12:07:56', '2020-10-01 12:07:56', '2021-10-01 12:07:56'),
('fe8263b6b725172639ebfdcfc3e4acfb53ad6a34fa36a848f5dff271cd8c55695d4c6a577de9dcc9', 17, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-20 07:20:10', '2020-10-20 07:20:10', '2021-10-20 07:20:10'),
('ff2fafe152c219c053ee9e3817a58b9143832ff1d0d5c553aabc6433cd638e6d2bff92a74ede820e', 19, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-06 17:45:48', '2020-10-06 17:45:48', '2021-10-06 17:45:48'),
('ff3653abb0f1ea3ef01ddaac6b99f352cf04e2e6ce6ee04e90895b548c625ff1e0023333266be951', 35, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-10 07:30:02', '2020-10-10 07:30:02', '2021-10-10 07:30:02'),
('ff579757faf8cff838d7901bd5e526f56d97e742c39f46780db723f80fe10270f329f15174d07d49', 21, 1, 'Laravel Password Grant Client', '[]', 0, '2020-10-07 04:10:23', '2020-10-07 04:10:23', '2021-10-07 04:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'IdpIkf1lurtmRYSgeWkjbDJiiQub9XLG9qs6G5h8', NULL, 'http://localhost', 1, 0, 0, '2020-08-17 08:52:12', '2020-08-17 08:52:12'),
(2, NULL, 'Laravel Password Grant Client', 'vRNmdvvtoTzGnSbJYPSITU6yF72D9YVRW9eB1eFp', 'users', 'http://localhost', 0, 1, 0, '2020-08-17 08:52:12', '2020-08-17 08:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-08-17 08:52:12', '2020-08-17 08:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_arabic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `includes` enum('both','workout','diet') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `validity` int(11) NOT NULL,
  `target` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_arabic` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_arabic` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `image` varchar(12234) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `name_arabic`, `includes`, `sort`, `price`, `validity`, `target`, `target_arabic`, `description`, `description_arabic`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Fitness Freaks', 'النزوات اللياقة البدنية', 'both', 1, 499.00, 30, 'This is for those who like challenges and face them head on like a beast', 'هذا لمن يحبون التحديات ويواجهونها وجهاً لوجه مثل الوحش', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\n\r\nLorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Lorem ipsum هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد.\r\n\r\nكان Lorem ipsum هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة.\r\n\r\nعلى مر السنين ، سآتي ، التي ستخرج منها برأيك من ميزة التمرين ، بحيث تحفز الجهود بالمنطقة التعليمية وطول العمر.', 'on', '16009576871.jpg', '2020-08-19 01:02:28', '2020-10-14 07:27:57'),
(2, 'Fitnes Junkie', 'مدمن اللياقة البدنية', 'both', 2, 499.00, 20, 'This is for those who live the gym life, can\'t stand to miss working out for even a day, a structured exercise for every day of the week.', 'هذا مخصص لأولئك الذين يعيشون حياة الصالة الرياضية ، ولا يمكنهم تحمل تفويت التمرين حتى يوم واحد ، وهو تمرين منظم لكل يوم من أيام الأسبوع.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\n\r\nLorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد.\r\n\r\nكان Lorem ipsum هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة.\r\n\r\nباستثناء أن السود كيوبيدات ليسوا استثناءً ، فهو مهدئ للروح ، أي أنهم تخلوا عن الواجبات العامة لأولئك المسؤولين عن مشاكلك.', 'on', '1600959216download.png', '2020-08-19 01:32:34', '2020-10-14 07:28:58'),
(3, 'Fitness Forger', 'فيتنس فورجر', 'workout', 3, 199.00, 15, 'Shaping your body is your first Goal. However time constraints does not allow you to workout to the max, here are some exercises you can do any time of day.', 'تشكيل جسمك هو هدفك الأول. على الرغم من أن ضيق الوقت لا يسمح لك بالتمرين إلى أقصى حد ، فإليك بعض التمارين التي يمكنك القيام بها في أي وقت من اليوم.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\n\r\nLorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'Lorem ipsum هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد.\r\n\r\nكان Lorem ipsum هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة.\r\n\r\nتريد أن تكون ألمًا في كيوبيداتات سيلوم وقد تم انتقاده في فرار Duis et dolore magna لا ينتج عنه متعة.', 'on', '1600959300165_Forge-Fitness-adjusted.jpg', '2020-08-19 01:37:15', '2020-10-14 07:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@najim.com', '$2y$10$MAWpkvIyywS9linH7bBzvOpIft9qUNQrLICx874TVdenr9WM6bfHS', '2020-08-13 23:10:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets_clients`
--

CREATE TABLE `password_resets_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets_clients`
--

INSERT INTO `password_resets_clients` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(4, 'avinash@gmail.com', '1Bu8QtHAy1xhqMeYAHOjGnhnrQI1nN70gjnldmJJ', '2020-10-08 12:10:12', '2020-10-08 12:10:12'),
(5, 'er.krishna.mishra@gmail.com', 'dR8AyU6g022lndUjDCrvOQkm7nkDV3m1Vq0y0JiH', '2020-10-09 09:37:45', '2020-10-09 11:56:08'),
(6, 'amit@gmail.com', 'qLJfg64zX6Tv8n7VfGcwEkue3vjdE7f9nL98AKOy', '2020-10-12 08:58:52', '2020-10-12 09:09:24'),
(7, 'zalaaamitya36@gmail.com', 'hU9FAJEOKKmOCJA0bFEwYyjpq7CP13f5HjuwSPSm', '2020-10-13 07:02:42', '2020-10-22 13:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2020-08-13 19:58:07', '2020-08-13 19:58:07'),
(2, 'role-create', 'web', '2020-08-13 19:58:07', '2020-08-13 19:58:07'),
(3, 'role-edit', 'web', '2020-08-13 19:58:07', '2020-08-13 19:58:07'),
(4, 'role-delete', 'web', '2020-08-13 19:58:07', '2020-08-13 19:58:07'),
(5, 'product-list', 'web', '2020-08-13 19:58:07', '2020-08-13 19:58:07'),
(6, 'product-create', 'web', '2020-08-13 19:58:08', '2020-08-13 19:58:08'),
(7, 'product-edit', 'web', '2020-08-13 19:58:08', '2020-08-13 19:58:08'),
(8, 'product-delete', 'web', '2020-08-13 19:58:08', '2020-08-13 19:58:08'),
(9, 'user-list', 'web', '2020-08-13 19:58:07', '2020-08-13 19:58:07'),
(10, 'user-create', 'web', '2020-08-13 19:58:08', '2020-08-13 19:58:08'),
(11, 'user-edit', 'web', '2020-08-13 19:58:08', '2020-08-13 19:58:08'),
(12, 'user-delete', 'web', '2020-08-13 19:58:08', '2020-08-13 19:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gender` enum('male','female','both') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_arabic` text COLLATE utf8mb4_unicode_ci,
  `category` int(11) DEFAULT NULL,
  `image` varchar(2558) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `gender`, `sort`, `question`, `question_arabic`, `category`, `image`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'both', 1, 'Where are you in the world ?', 'أين تكون في العالم ؟', 1, NULL, NULL, '2020-08-18 22:30:26', '2020-08-18 23:06:51'),
(2, 'both', 2, 'What city do you live in ?', 'في اي مدينه تعيش ؟', 1, NULL, NULL, '2020-08-18 23:08:41', '2020-08-18 23:08:41'),
(3, 'both', 3, 'When were you born ?', 'متى ولدت ؟', 1, NULL, NULL, '2020-08-18 23:09:45', '2020-08-18 23:09:45'),
(4, 'both', 4, 'What is your Job ? (If Applicable)', 'ما هو عملك ؟ (إذا كان قابلا للتطبيق)', 1, NULL, NULL, '2020-08-18 23:12:43', '2020-08-18 23:12:43'),
(5, 'both', 5, 'Are you married ?', 'هل انت متزوج ؟', 1, NULL, NULL, '2020-08-18 23:13:16', '2020-08-18 23:13:16'),
(6, 'female', 6, 'Last Period Cycle ?', 'الدورة الشهرية الأخيرة؟', 1, NULL, NULL, '2020-08-18 23:14:26', '2020-08-18 23:14:26'),
(7, 'female', 7, 'Are you pregnant ?', 'هل انت حامل ؟', 1, NULL, NULL, '2020-08-18 23:15:02', '2020-08-18 23:15:02'),
(8, 'female', 8, 'How many weeks pregnant are you ? (if applicable)', 'كم أسبوع من الحمل أنت؟ (إذا كان قابلا للتطبيق)', 1, NULL, NULL, '2020-08-18 23:18:35', '2020-08-18 23:18:35'),
(9, 'both', 9, 'Last Recorded Weight ?', 'نص بسيط', 2, 'scale-weight-1296x728-header.jpg', 'kgs', '2020-08-18 23:19:26', '2020-10-01 13:08:52'),
(10, 'both', 10, 'Height', 'نص بسيط', 2, 'science-finds-a-scary-link-between-height-and-prostate-cancer-645189991-redlinevector-1024x683.jpg', 'cm', '2020-08-18 23:19:43', '2020-10-01 13:19:57'),
(11, 'both', 11, 'Bust Size', 'نص بسيط', 2, NULL, NULL, '2020-08-18 23:20:40', '2020-08-18 23:20:40'),
(12, 'both', 12, 'Stomach size', 'نص بسيط', 2, NULL, NULL, '2020-08-18 23:21:36', '2020-08-18 23:21:36'),
(13, 'both', 13, 'Waist size', 'نص بسيط', 2, 'images.jpg', NULL, '2020-08-18 23:22:23', '2020-10-02 07:16:51'),
(14, 'both', 14, 'Hip size', 'نص بسيط', 2, NULL, NULL, '2020-08-18 23:22:46', '2020-08-18 23:22:46'),
(15, 'both', 15, 'Thigh size', 'نص بسيط', 3, NULL, NULL, '2020-08-18 23:23:01', '2020-08-18 23:23:01'),
(16, 'both', 16, 'Health issue #1', 'نص بسيط', 3, NULL, NULL, '2020-08-18 23:25:33', '2020-08-18 23:25:33'),
(17, 'both', 17, 'Health issue #2', 'نص بسيط', 3, NULL, NULL, '2020-08-18 23:25:46', '2020-08-18 23:25:46'),
(18, 'both', 18, 'Health issue #3', 'نص بسيط', 3, NULL, NULL, '2020-08-18 23:26:00', '2020-08-18 23:26:36'),
(19, 'both', 19, 'Health issue #4', 'نص بسيط', 3, NULL, NULL, '2020-08-18 23:26:16', '2020-08-18 23:26:16'),
(20, 'both', 20, 'Health issue #5', 'نص بسيط d', 3, NULL, NULL, '2020-08-18 23:27:09', '2020-08-18 23:27:57'),
(21, 'both', 21, 'Do you take any medication ?', 'نص بسيطsw', 5, NULL, NULL, '2020-08-18 23:27:42', '2020-08-18 23:27:42'),
(22, 'both', 22, 'Medication #1', 'نص بسيطj', 5, NULL, NULL, '2020-08-18 23:25:33', '2020-08-18 23:25:33'),
(23, 'both', 23, 'Medication #2', 'نص بسيطd', 5, NULL, NULL, '2020-08-18 23:25:46', '2020-08-18 23:25:46'),
(24, 'both', 24, 'Medication #3', 'نص بسيطh', 5, NULL, NULL, '2020-08-18 23:26:00', '2020-08-18 23:26:36'),
(25, 'both', 25, 'Medication #4', 'نص بسيطd', 5, NULL, NULL, '2020-08-18 23:26:16', '2020-08-18 23:26:16'),
(26, 'both', 26, 'Medication #5', 'نص بسيطds', 5, NULL, NULL, '2020-08-18 23:27:09', '2020-08-18 23:27:57'),
(27, 'both', 27, 'Have you dieted before ?', 'نص بسيطb', 4, NULL, NULL, '2020-08-18 23:30:49', '2020-08-18 23:30:49'),
(28, 'both', 28, 'Foods you love (food, beverages, sweets)', 'نص بسيطq', 4, NULL, NULL, '2020-08-18 23:44:43', '2020-08-18 23:44:43'),
(29, 'both', 29, 'Foods you hate (food, beverage, sweet)', 'نص بسيط4', 4, NULL, NULL, '2020-08-18 23:45:22', '2020-08-18 23:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `question_categories`
--

CREATE TABLE `question_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(233) NOT NULL,
  `name_arabic` varchar(255) CHARACTER SET cp1256 DEFAULT NULL,
  `description` text CHARACTER SET cp1256 NOT NULL,
  `description_arabic` text CHARACTER SET cp1256
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_categories`
--

INSERT INTO `question_categories` (`id`, `name`, `name_arabic`, `description`, `description_arabic`) VALUES
(1, 'Personal Info', 'النزوات اللياقة البدنية', 'Lorem de ipsum text', 'بقوانين الحقوق المدنية الفدرالية المعمول بها وال يميز على أساس العرق أو'),
(2, 'Measurements', 'النزوات اللياقة البدنية', 'Lorem De ipsum text', 'النزوات اللياقة البدنية النزوات اللياقة البدنية'),
(3, 'Health Issues', 'النزوات اللياقة البدنية', 'Lorem de ipsum text', 'النزوات اللياقة البدنية النزوات اللياقة البدنية'),
(4, 'Food', 'النزوات اللياقة البدنية', 'Lorem de ipsum text', 'النزوات اللياقة البدنية النزوات اللياقة البدنية'),
(5, 'Medication', 'النزوات اللياقة البدنية', 'Lorem de ipsum text', 'النزوات اللياقة البدنية النزوات اللياقة البدنية');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2020-08-13 20:03:14', '2020-08-13 20:03:14'),
(3, 'Nutritionist', 'web', '2020-08-13 21:48:08', '2020-08-13 21:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(5, 3),
(6, 3),
(7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `name`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'Regular', 1, '2020-08-27 10:33:22', '2020-08-27 10:33:22'),
(2, 'Vegetarian', 2, '2020-08-27 10:33:42', '2020-08-27 10:33:42'),
(3, 'Vegan', 3, '2020-08-27 10:34:01', '2020-08-27 10:34:01'),
(4, 'Child', 4, '2020-08-27 10:34:13', '2020-08-27 10:34:23'),
(5, 'Gain', 5, '2020-08-27 10:34:34', '2020-08-27 10:34:34'),
(6, 'Quick', 6, '2020-08-27 10:34:44', '2020-08-27 10:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `content`) VALUES
(1, 'Terms and Conditions for Company Name\r\nIntroduction\r\nThese Website Standard Terms and Conditions written on this webpage shall manage your use of our website, Webiste Name accessible at Website.com.\r\n\r\nThese Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions.\r\n\r\nMinors or people below 18 years old are not allowed to use this Website.\r\n\r\nIntellectual Property Rights\r\nOther than the content you own, under these Terms, Company Name and/or its licensors own all the intellectual property rights and materials contained in this Website.\r\n\r\nYou are granted limited license only for purposes of viewing the material contained on this Website.\r\n\r\nRestrictions\r\nYou are specifically restricted from all of the following:\r\n\r\npublishing any Website material in any other media;\r\nselling, sublicensing and/or otherwise commercializing any Website material;\r\npublicly performing and/or showing any Website material;\r\nusing this Website in any way that is or may be damaging to this Website;\r\nusing this Website in any way that impacts user access to this Website;\r\nusing this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity;\r\nengaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website;\r\nusing this Website to engage in any advertising or marketing.\r\nCertain areas of this Website are restricted from being access by you and Company Name may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.\r\n\r\nYour Content\r\nIn these Website Standard Terms and Conditions, “Your Content” shall mean any audio, video text, images or other material you choose to display on this Website. By displaying Your Content, you grant Company Name a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.\r\n\r\nYour Content must be your own and must not be invading any third-party\'s rights. Company Name reserves the right to remove any of Your Content from this Website at any time without notice.\r\n\r\nNo warranties\r\nThis Website is provided “as is,” with all faults, and Company Name express no representations or warranties, of any kind related to this Website or the materials contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you.\r\n\r\nLimitation of liability\r\nIn no event shall Company Name, nor any of its officers, directors and employees, shall be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract.  Company Name, including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.\r\n\r\nIndemnification\r\nYou hereby indemnify to the fullest extent Company Name from and against any and/or all liabilities, costs, demands, causes of action, damages and expenses arising in any way related to your breach of any of the provisions of these Terms.\r\n\r\nSeverability\r\nIf any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted without affecting the remaining provisions herein.\r\n\r\nVariation of Terms\r\nCompany Name is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.\r\n\r\nAssignment\r\nThe Company Name is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.\r\n\r\nEntire Agreement\r\nThese Terms constitute the entire agreement between Company Name and you in relation to your use of this Website, and supersede all prior agreements and understandings.\r\n\r\nGoverning Law & Jurisdiction\r\nThese Terms will be governed by and interpreted in accordance with the laws of the State of Country, and you submit to the non-exclusive jurisdiction of the state and federal courts located in Country for the resolution of any disputes.');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `transaction_id` varchar(350) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `client_id`, `package_id`, `transaction_id`, `amount`, `created_at`) VALUES
(1, 1, 1, 'abcd1234', '123456', '2020-10-20 08:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `avater` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `active_status`, `dark_mode`, `messenger_color`, `avatar`, `avater`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mike Paully', 'admin@najim.com', 0, 0, '#2180f3', 'avatar.png', '15982654831.png', NULL, '$2y$10$tYwYvCPh9giXKu2E7SkxSOx6toEjFrgi79JxUK8KRo8UdQIrNX2aG', 'RLP3QXXfzdODK5cU7drKnDdpgKnprm7LXZqD3ym6g6l6Z5ZJwKVKjvNLt3Iw', '2020-08-13 20:03:14', '2020-08-24 05:08:03'),
(2, 'Nutritionist 1', 'vendor@najim.com', 0, 0, '#2180f3', 'avatar.png', NULL, NULL, '$2y$10$fcLw.xNZMljUTr8k6L0P/OGuEcSa2HiK.K0G1Y1llEvfxwkZMi3a.', NULL, '2020-08-13 20:10:16', '2020-08-13 20:10:16'),
(3, 'Nutritionist 2', 'nutritionist2@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, NULL, '$2y$10$PRLipcznFczHtNOMHNnJ6uqm6L80ASclWIBu4DH4TlAEhZa6cmAWe', NULL, '2020-09-01 00:11:37', '2020-09-01 00:11:37'),
(4, 'Nutritionist 3', 'nutritionist3@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, NULL, '$2y$10$Jb0A44ZaD92mg0coXIfmP.Hx/8P7gcr0LTlHArpKBrKCZK4TxJ1WG', NULL, '2020-09-01 00:12:20', '2020-09-01 00:12:20'),
(5, 'Nutritionist 4', 'nutritionist4@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, NULL, '$2y$10$Qxtmw.Y6ato5hnEcS11.XeS1E04nomMzpF4jRpZX2VVnvWDCdpBCy', NULL, '2020-09-01 00:12:52', '2020-09-01 00:12:52'),
(6, 'Nutritionist 5', 'nutritionist5@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, NULL, '$2y$10$cGrzj9i7qxgRkNkAQOZSuekerimyQZAD3ZZgIUGtf6ylWwI8Rg7X2', NULL, '2020-09-01 00:13:19', '2020-09-01 00:13:19'),
(7, 'Nutritionist 6', 'nutritionist6@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, NULL, '$2y$10$ewVFRhB.WClWl.Nvo3vd7eJWrixMyXvI8w/gGzcvJzSXV9Kgg2GpG', NULL, '2020-09-01 00:13:49', '2020-09-01 00:13:49'),
(8, 'Nutritionist 7', 'nutritionist7@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, NULL, '$2y$10$4SWyisyN5GU1m5G9iaQSjOyKusmw4S8BIRix5e2eKW3CszUpLYOqW', NULL, '2020-09-01 00:15:17', '2020-09-01 00:15:17'),
(9, 'Nutritionist 8', 'nutritionist8@gmail.com', 0, 0, '#2180f3', 'avatar.png', NULL, NULL, '$2y$10$akTQJDJ.yLZg1Elst1QMQeD/am6cTC3SluWPxTsPbd9b3z65ffNqG', NULL, '2020-09-01 00:15:51', '2020-09-01 00:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `workout_categories`
--

CREATE TABLE `workout_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workout_categories`
--

INSERT INTO `workout_categories` (`id`, `name`, `sort`, `created_at`, `updated_at`) VALUES
(2, 'Yoga', 1, '2020-08-19 04:07:01', '2020-08-19 04:07:01'),
(3, 'Pilates', 2, '2020-08-19 04:08:05', '2020-08-19 04:08:05'),
(4, 'HIIIT', 3, '2020-08-19 04:08:20', '2020-08-19 04:08:20'),
(5, 'Cardio', 4, '2020-08-19 04:08:38', '2020-08-19 04:08:38'),
(6, 'Gain', 5, '2020-08-19 04:08:54', '2020-08-19 04:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `workout_information`
--

CREATE TABLE `workout_information` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `name_arabic` text CHARACTER SET cp1256,
  `information` text NOT NULL,
  `information_arabic` text CHARACTER SET cp1256,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workout_information`
--

INSERT INTO `workout_information` (`id`, `name`, `name_arabic`, `information`, `information_arabic`, `created_at`, `updated_at`) VALUES
(3, 'Instruction for slow weight Loss', 'تعليمات لفقدان الوزنتعل', 'lOREM DE IPSUM', 'تعليمات لفقدان الوزنتعليمات لفقدان الوزنتعليمات لفقدان الوز', '2020-10-21 11:59:12', '2020-10-21 11:59:12'),
(4, 'Instruction for quick weight Loss', 'تعليمات لإنقاص الوزن بسرعة', 'Lorem de ipsum', 'تعليمات لإنقاص الوزن بسرعةتعليمات لإنقاص الوزن بسرعة', '2020-10-21 12:06:48', '2020-10-21 12:06:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_phone_unique` (`phone`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `client_answers`
--
ALTER TABLE `client_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_tables`
--
ALTER TABLE `client_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_workouts`
--
ALTER TABLE `client_workouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `nutritionist_clients`
--
ALTER TABLE `nutritionist_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_resets_clients`
--
ALTER TABLE `password_resets_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_clients_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_categories`
--
ALTER TABLE `question_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `workout_categories`
--
ALTER TABLE `workout_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_information`
--
ALTER TABLE `workout_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `client_answers`
--
ALTER TABLE `client_answers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `client_tables`
--
ALTER TABLE `client_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_workouts`
--
ALTER TABLE `client_workouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nutritionist_clients`
--
ALTER TABLE `nutritionist_clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_resets_clients`
--
ALTER TABLE `password_resets_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `question_categories`
--
ALTER TABLE `question_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `workout_categories`
--
ALTER TABLE `workout_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `workout_information`
--
ALTER TABLE `workout_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
