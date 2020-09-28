-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2020 at 02:46 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `najim`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_id` bigint(20) DEFAULT NULL,
  `validity` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `firstname`, `lastname`, `phone`, `gender`, `email`, `package_id`, `validity`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Johnas', 'White', '9876543210', 'female', 'johnas@gmail.com', 3, '2020-09-09', NULL, '$2y$10$ueyA6oJKNLV/mtkpX8K2WOBm8Q/hcvOwkzfVSgA1QxXnUP7bF7Xby', 'on', NULL, '2020-08-17 09:19:23', '2020-08-27 14:00:56'),
(2, 'Alena', 'Finch', '9876543212', 'male', 'alena@gmail.com', NULL, NULL, NULL, '$2y$10$lg7Z6FwRPnkr0f8cEmnEqO6T8AWQFBR1sJtW.XbebYJgNJ.2dHZvK', 'on', NULL, '2020-08-17 10:14:51', '2020-08-17 10:14:51'),
(3, 'Chantale', 'Reynolds', '9854763214', 'female', 'chantale@gmail.com', NULL, NULL, NULL, '$2y$10$lJEET22WD3WjIWy/2UoDjeZi18poCY2UAzQ4gSB1HlBYuchebeDWG', 'on', NULL, '2020-08-27 13:55:53', '2020-08-27 13:55:53'),
(4, 'Zephr', 'Warren', '9547863214', 'female', 'zephr@gmail.com', NULL, NULL, NULL, '$2y$10$PV2bXaD1x.AYTm/NTYRJH.4KgCqbRYttzSZHEuk/rGGVSWmcK7/Fi', 'on', NULL, '2020-08-31 23:15:14', '2020-08-31 23:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `client_answers`
--

CREATE TABLE `client_answers` (
  `id` bigint(20) NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `answer` varchar(2500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(42, 3, 22, 'Tamaflex', '2020-09-01 10:51:57');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `calorie_range` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `category`, `sort`, `image`, `video`, `time`, `calories`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Downward Dog', 2, 1, '1.gif', 'https://www.youtube.com/watch?v=YqOqM79McYY', '7', '30-35', 'The pose has the head down, ultimately touching the floor, with the weight of the body on the palms and the feet. \r\nThe arms are stretched straight forward, shoulder width apart; the feet are a foot apart, the legs are straight, and the hips are raised as high as possible.', '2020-08-19 07:06:30', '2020-08-19 09:01:53'),
(3, 'Sun Salutation', 2, 2, '2.gif', 'https://www.youtube.com/watch?v=7y8N8K9vKvo', '5', '50-60', '1. Inhale and Bring the arms out to the sides and up to the ceiling to join your palms above your head.\r\n\r\n2. Exhale and release your arms to either side and forward bend over your legs (as if you were doing a swan dive into a swimming pool).\r\n\r\n3. Exhale and plant your palms and step or jump back to a plank position. In plank, make sure your shoulders are over your wrists and your butt is neither sticking up nor drooping down.\r\n\r\n4. Exhale and lower to your knees, chest, and chin. Lower your chest and chin down to the floor, landing your shoulders right over your hands. Keep your butt high and your elbows hugging your ribs. \r\n\r\n5. Come forward to a low cobra. Anchor your pelvis and the tops of your feet to the floor but try not to press into your hands as you come up into the backbend. \r\n\r\n6. Exhale and push back to downward facing dog. You can come through hands and knees on the way if necessary. Stay here a few breaths (or more) if you need to take a break. If you are going ​at a brisk pace, just stay one breath. \r\n\r\n7. Exhale and step the right foot next to the right hand and then bring the left foot to join it in standing forward bend.\r\n\r\n8. Inhale and lift your arms out to the sides and up, reversing the swan dive to return to raised arms pose.\r\n\r\n9. Exhale and come to stand in mountain pose with your hands in a prayer position at the heart', '2020-08-19 08:43:40', '2020-08-19 09:01:37'),
(4, 'Tree Pose', 2, 3, '3.gif', 'https://www.youtube.com/watch?v=wdln9qWYloU', '7', '25-30', '1. The posture is entered by standing with the feet together, grounding evenly through the feet and lifting up through the crown of the head. \r\n\r\n2. The thighs are lifted, the waist is lifted, and the spine is elongated. Breathing is relaxed., weight is shifted to one leg, for example, starting with the left leg.\r\n\r\n3. The entire sole of the foot remains in contact with the floor. The right knee is bent and the right foot placed on the left inner thigh, or in half lotus position. \r\n\r\n4. In either foot placement, the hips should be open, with the bent knee pointing towards the side. \r\n\r\n5. With the toes of the right foot pointing directly down, the left foot, center of the pelvis, shoulders and head are all vertically aligned. \r\n\r\n6. Hands are typically held above the head either pointed directly upwards and unclasped, or clasped together. \r\n\r\n7. The asana is typically held for 20 to 60 seconds, returning to the Step 1 while exhaling, then repeating standing on the opposite leg.', '2020-08-19 08:56:08', '2020-08-19 09:01:21'),
(5, 'Bound Angle Pose', 2, 4, '4.gif', 'https://www.youtube.com/watch?v=ti3tbscESUY', '7', '30-40', '1.  From sitting position with both the legs outstretched forward, hands by the sides, palms resting on the ground, fingers together pointing forward, the legs are hinged at the knees so the soles of the feet meet. \r\n\r\n2. The legs are grasped at the ankles and folded more until the heels reach the perineum. \r\n\r\n3. The knees move down to the ground, and with practice reach there; the body is erect and the gaze in front. \r\n\r\n4. The exercise is held before coming back to the starting position.\r\n5. The thighs are stretched with care. When used for meditation, the hands are placed in Prayer Position in front of the chest.', '2020-08-19 09:00:41', '2020-08-19 09:00:41');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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

INSERT INTO `meals` (`id`, `table_id`, `type`, `food`, `calories`, `carbs`, `protein`, `fat`, `sort`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'breakfast', 'Eggs and Bread', '125', '12', '15', '15', 1, 'eggs.jpg', 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(2, 1, 'snacks', 'Apple', '185', '21', '18', '19', 2, 'apple.jpg', 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:44'),
(3, 1, 'lunch', 'Dal + Rice', '147', '16', '18', '25', 3, 'dal.png', 'on', '2020-08-27 17:40:56', '2020-08-27 17:40:56'),
(4, 1, 'dinner', 'Lady Finger + 2 Rotis', '135', '26', '15', '25', 4, 'llady.jpg', 'on', '2020-08-27 17:40:56', '2020-08-27 13:07:30'),
(5, 1, 'lunch', 'Lentils', '150', '140', '16', '15', 5, 'download.jpg', 'on', '2020-08-27 12:44:14', '2020-08-27 13:05:16'),
(6, 1, 'breakfast', 'Breakfast 2', '154', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(7, 1, 'breakfast', 'Breakfast 3', '189', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(8, 1, 'breakfast', 'Breakfast 4', '178', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(9, 1, 'breakfast', 'Breakfast 5', '95', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(10, 1, 'breakfast', 'Breakfast 6', '68', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(11, 1, 'breakfast', 'Breakfast 7', '62', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(12, 1, 'breakfast', 'Breakfast 8', '88', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(13, 1, 'breakfast', 'Breakfast 9', '73', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(14, 1, 'breakfast', 'Breakfast 10', '25', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(15, 1, 'breakfast', 'Breakfast 11', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(16, 1, 'breakfast', 'Breakfast 12', '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(17, 1, 'breakfast', 'Breakfast 13', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(18, 1, 'breakfast', 'Breakfast 14', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(19, 1, 'breakfast', 'Breakfast 15', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(20, 1, 'breakfast', 'Breakfast 16', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(21, 1, 'breakfast', 'Breakfast 17', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(22, 1, 'breakfast', 'Breakfast 18', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(23, 1, 'breakfast', 'Breakfast 19', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(24, 1, 'breakfast', 'Breakfast 20', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(25, 1, 'breakfast', 'Breakfast 21', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(26, 1, 'snacks', 'Snack 2', '158', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(27, 1, 'snacks', 'Snack 3', '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(28, 1, 'snacks', 'Snack 4', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(29, 1, 'snacks', 'Snack 5', '157', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(30, 1, 'snacks', 'Snack 6', '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(31, 1, 'snacks', 'Snack 7', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(32, 1, 'snacks', 'Snack 8', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(33, 1, 'snacks', 'Snack 9', '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(34, 1, 'snacks', 'Snack 10', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(35, 1, 'snacks', 'Snack 11', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(36, 1, 'snacks', 'Snack 12', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(37, 1, 'snacks', 'Snack 13', '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(38, 1, 'snacks', 'Snack 14', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(39, 1, 'snacks', 'Snack 15', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(40, 1, 'snacks', 'Snack 16', '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(41, 1, 'snacks', 'Snack 17', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(42, 1, 'snacks', 'Snack 18', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(43, 1, 'snacks', 'Snack 19', '125', '12', '15', '15', 1, NULL, 'on', '2020-08-27 17:40:56', '2020-08-27 13:06:20'),
(44, 1, 'snacks', 'Snack 20', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07'),
(45, 1, 'snacks', 'Snack 21', '150', '140', '16', '4', 7, NULL, 'on', '2020-09-09 04:51:07', '2020-09-09 04:51:07');

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
  `workout status` varchar(255) NOT NULL DEFAULT 'due',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutritionist_clients`
--

INSERT INTO `nutritionist_clients` (`id`, `client_id`, `nutritionist_id`, `table_status`, `workout status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'due', 'due', '2020-09-01 06:01:58', '2020-09-01 06:01:34'),
(2, 2, 3, 'due', 'due', '2020-09-01 06:01:58', '2020-09-01 06:01:34'),
(3, 3, 4, 'due', 'due', '2020-09-01 06:02:31', '2020-09-01 06:02:12'),
(4, 4, 5, 'due', 'due', '2020-09-01 06:02:31', '2020-09-01 06:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('00732818c8f51aab6ab7f518eff75b4e3cfc5755a3781b35f272df0c4d079b06df266e0133f461ea', 2, 1, 'Laravel Password Grant Client', '[]', 0, '2020-08-17 10:14:52', '2020-08-17 10:14:52', '2021-08-17 15:44:52'),
('8daaa0d00c9c5e877b0e574cb7178f068b094bd6d252329db8de84b1d31cae47f812d3b869b3cc26', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2020-08-17 09:29:21', '2020-08-17 09:29:21', '2021-08-17 14:59:21'),
('cfab23a35bc01fe74322cdb86ce12028f8d538769e5f782c76a3baae7a93412d83eeb6599bd1db07', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2020-08-17 09:19:23', '2020-08-17 09:19:23', '2021-08-17 14:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `includes` enum('both','workout','diet') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `validity` int(11) NOT NULL,
  `target` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `includes`, `sort`, `price`, `validity`, `target`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fitness Freaks', 'both', 1, 499.00, 30, 'This is for those who like challenges and face them head on like a beast', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\n\r\nLorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'on', '2020-08-19 01:02:28', '2020-08-19 01:28:24'),
(2, 'Fitnes Junkie', 'both', 2, 499.00, 20, 'This is for those who live the gym life, can\'t stand to miss working out for even a day, a structured exercise for every day of the week.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\n\r\nLorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'on', '2020-08-19 01:32:34', '2020-08-19 01:32:34'),
(3, 'Fitness Forger', 'workout', 3, 199.00, 15, 'Shaping your body is your first Goal. However time constraints does not allow you to workout to the max, here are some exercises you can do any time of day.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\n\r\nLorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'on', '2020-08-19 01:37:15', '2020-08-19 01:37:15');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `gender`, `sort`, `question`, `created_at`, `updated_at`) VALUES
(1, 'both', 1, 'Where are you in the world ?', '2020-08-18 22:30:26', '2020-08-18 23:06:51'),
(2, 'both', 2, 'What city do you live in ?', '2020-08-18 23:08:41', '2020-08-18 23:08:41'),
(3, 'both', 3, 'When were you born ?', '2020-08-18 23:09:45', '2020-08-18 23:09:45'),
(4, 'both', 4, 'What is your Job ? (If Applicable)', '2020-08-18 23:12:43', '2020-08-18 23:12:43'),
(5, 'both', 5, 'Are you married ?', '2020-08-18 23:13:16', '2020-08-18 23:13:16'),
(6, 'female', 6, 'Last Period Cycle ?', '2020-08-18 23:14:26', '2020-08-18 23:14:26'),
(7, 'female', 7, 'Are you pregnant ?', '2020-08-18 23:15:02', '2020-08-18 23:15:02'),
(8, 'female', 8, 'How many weeks pregnant are you ? (if applicable)', '2020-08-18 23:18:35', '2020-08-18 23:18:35'),
(9, 'both', 9, 'Last Recorded Weight ?', '2020-08-18 23:19:26', '2020-08-18 23:19:26'),
(10, 'both', 10, 'Height', '2020-08-18 23:19:43', '2020-08-18 23:19:43'),
(11, 'both', 11, 'Bust Size', '2020-08-18 23:20:40', '2020-08-18 23:20:40'),
(12, 'both', 12, 'Stomach size', '2020-08-18 23:21:36', '2020-08-18 23:21:36'),
(13, 'both', 13, 'Waist size', '2020-08-18 23:22:23', '2020-08-18 23:22:23'),
(14, 'both', 14, 'Hip size', '2020-08-18 23:22:46', '2020-08-18 23:22:46'),
(15, 'both', 15, 'Thigh size', '2020-08-18 23:23:01', '2020-08-18 23:23:01'),
(16, 'both', 16, 'Health issue #1', '2020-08-18 23:25:33', '2020-08-18 23:25:33'),
(17, 'both', 17, 'Health issue #2', '2020-08-18 23:25:46', '2020-08-18 23:25:46'),
(18, 'both', 18, 'Health issue #3', '2020-08-18 23:26:00', '2020-08-18 23:26:36'),
(19, 'both', 19, 'Health issue #4', '2020-08-18 23:26:16', '2020-08-18 23:26:16'),
(20, 'both', 20, 'Health issue #5', '2020-08-18 23:27:09', '2020-08-18 23:27:57'),
(21, 'both', 21, 'Do you take any medication ?', '2020-08-18 23:27:42', '2020-08-18 23:27:42'),
(22, 'both', 22, 'Medication #1', '2020-08-18 23:25:33', '2020-08-18 23:25:33'),
(23, 'both', 23, 'Medication #2', '2020-08-18 23:25:46', '2020-08-18 23:25:46'),
(24, 'both', 24, 'Medication #3', '2020-08-18 23:26:00', '2020-08-18 23:26:36'),
(25, 'both', 25, 'Medication #4', '2020-08-18 23:26:16', '2020-08-18 23:26:16'),
(26, 'both', 26, 'Medication #5', '2020-08-18 23:27:09', '2020-08-18 23:27:57'),
(27, 'both', 27, 'Have you dieted before ?', '2020-08-18 23:30:49', '2020-08-18 23:30:49'),
(28, 'both', 28, 'Foods you love (food, beverages, sweets)', '2020-08-18 23:44:43', '2020-08-18 23:44:43'),
(29, 'both', 29, 'Foods you hate (food, beverage, sweet)', '2020-08-18 23:45:22', '2020-08-18 23:45:22');

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
(5, 3),
(6, 1),
(6, 3),
(7, 1),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `avater`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mike Paully', 'admin@najim.com', '15982654831.png', NULL, '$2y$10$tYwYvCPh9giXKu2E7SkxSOx6toEjFrgi79JxUK8KRo8UdQIrNX2aG', NULL, '2020-08-13 20:03:14', '2020-08-24 05:08:03'),
(2, 'Nutritionist 1', 'vendor@najim.com', NULL, NULL, '$2y$10$fcLw.xNZMljUTr8k6L0P/OGuEcSa2HiK.K0G1Y1llEvfxwkZMi3a.', NULL, '2020-08-13 20:10:16', '2020-08-13 20:10:16'),
(3, 'Nutritionist 2', 'nutritionist2@gmail.com', NULL, NULL, '$2y$10$PRLipcznFczHtNOMHNnJ6uqm6L80ASclWIBu4DH4TlAEhZa6cmAWe', NULL, '2020-09-01 00:11:37', '2020-09-01 00:11:37'),
(4, 'Nutritionist 3', 'nutritionist3@gmail.com', NULL, NULL, '$2y$10$Jb0A44ZaD92mg0coXIfmP.Hx/8P7gcr0LTlHArpKBrKCZK4TxJ1WG', NULL, '2020-09-01 00:12:20', '2020-09-01 00:12:20'),
(5, 'Nutritionist 4', 'nutritionist4@gmail.com', NULL, NULL, '$2y$10$Qxtmw.Y6ato5hnEcS11.XeS1E04nomMzpF4jRpZX2VVnvWDCdpBCy', NULL, '2020-09-01 00:12:52', '2020-09-01 00:12:52'),
(6, 'Nutritionist 5', 'nutritionist5@gmail.com', NULL, NULL, '$2y$10$cGrzj9i7qxgRkNkAQOZSuekerimyQZAD3ZZgIUGtf6ylWwI8Rg7X2', NULL, '2020-09-01 00:13:19', '2020-09-01 00:13:19'),
(7, 'Nutritionist 6', 'nutritionist6@gmail.com', NULL, NULL, '$2y$10$ewVFRhB.WClWl.Nvo3vd7eJWrixMyXvI8w/gGzcvJzSXV9Kgg2GpG', NULL, '2020-09-01 00:13:49', '2020-09-01 00:13:49'),
(8, 'Nutritionist 7', 'nutritionist7@gmail.com', NULL, NULL, '$2y$10$4SWyisyN5GU1m5G9iaQSjOyKusmw4S8BIRix5e2eKW3CszUpLYOqW', NULL, '2020-09-01 00:15:17', '2020-09-01 00:15:17'),
(9, 'Nutritionist 8', 'nutritionist8@gmail.com', NULL, NULL, '$2y$10$akTQJDJ.yLZg1Elst1QMQeD/am6cTC3SluWPxTsPbd9b3z65ffNqG', NULL, '2020-09-01 00:15:51', '2020-09-01 00:15:51');

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

--
-- Indexes for dumped tables
--

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
-- Indexes for table `meals`
--
ALTER TABLE `meals`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_answers`
--
ALTER TABLE `client_answers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `client_tables`
--
ALTER TABLE `client_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nutritionist_clients`
--
ALTER TABLE `nutritionist_clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
