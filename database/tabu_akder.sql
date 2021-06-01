-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 11:54 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabu_akder`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `superadmin` smallint(6) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_confirmed` smallint(1) DEFAULT 0,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `address` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `region_id` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isOnline` int(11) NOT NULL DEFAULT 0,
  `car_type_id` int(11) DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'en',
  `firebase_token` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `username`, `password`, `status`, `superadmin`, `created_at`, `updated_at`, `email`, `email_confirmed`, `lat`, `lng`, `address`, `avatar`, `fname`, `lname`, `phone`, `mobile_confirmed`, `region_id`, `isOnline`, `car_type_id`, `language`, `firebase_token`, `type`) VALUES
(41, 1, 'Diyaa Koman', '$2y$10$/rXVqU1o9kFslB9T4PQ01emIYSpoTdNUrFCYnVIBgYSYbaN9Oou3u', 1, 1, '2021-04-20 16:06:47', '2021-04-16 09:34:08', 'Diyaa@gmail.com', 0, 3, 4.5, NULL, 'admins\\1618573417.jpg', 'Diyaa', 'Koman', '0', 1, '5', 1, 1, 'en', 'eVMUQ3JESIGkEYun-XFpoV:APA91bH-AJPITq27H_RWiMX383_yNNw_JO9U4DReI3JN2cfEVRGOn0k9N-7fNSordOyJWQwAjj2ywnw_VhwOgTVn0RZcYLGYwHEFuCD6F1eH_PbpJWSouOhuQKSzRTqJZ0vAr9fW5iQu', 1),
(42, 2, NULL, '$2y$10$TaTe8B0JXfDKNg3GIuZS.ukSUzUSxJ3D5xM0brhJT8qBCU9.FRjsO', 0, 0, '2021-04-10 07:43:00', '2021-04-15 12:36:59', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '012', 0, NULL, 0, 4, 'en', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_mobile_email`
--

CREATE TABLE `admin_mobile_email` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `confirm_code` varchar(50) NOT NULL,
  `is_confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `is_primary` tinyint(4) NOT NULL DEFAULT 0,
  `symbol` varchar(15) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_mobile_email`
--

INSERT INTO `admin_mobile_email` (`id`, `admin_id`, `mobile`, `email`, `confirm_code`, `is_confirmed`, `is_primary`, `symbol`, `type`) VALUES
(15, 41, '0', NULL, '26473', 1, 1, NULL, 1),
(16, 41, '0', NULL, '64864', 1, 0, NULL, 2),
(17, 42, '012', NULL, '52240', 0, 1, NULL, 1),
(18, 42, '012', NULL, '12166', 0, 0, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(8, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(11, 2, 'password', 'password', 'Password', 0, 0, 0, 0, 0, 0, '{}', 6),
(13, 2, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 0, 0, 0, '{}', 8),
(14, 2, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, '{}', 9),
(19, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(20, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(21, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(22, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(23, 4, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(24, 4, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(25, 4, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(26, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(27, 4, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(29, 5, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(30, 5, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, NULL, 2),
(31, 5, 'category_id', 'text', 'Category', 1, 0, 1, 1, 1, 0, NULL, 3),
(32, 5, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 4),
(33, 5, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 5),
(34, 5, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 6),
(35, 5, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', 7),
(36, 5, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}', 8),
(37, 5, 'meta_description', 'text_area', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 9),
(38, 5, 'meta_keywords', 'text_area', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 10),
(39, 5, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}', 11),
(40, 5, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 12),
(41, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 13),
(42, 5, 'seo_title', 'text', 'SEO Title', 0, 1, 1, 1, 1, 1, NULL, 14),
(43, 5, 'featured', 'checkbox', 'Featured', 1, 1, 1, 1, 1, 1, NULL, 15),
(44, 6, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(45, 6, 'author_id', 'text', 'Author', 1, 0, 0, 0, 0, 0, NULL, 2),
(46, 6, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 3),
(47, 6, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 4),
(48, 6, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 5),
(49, 6, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\"},\"validation\":{\"rule\":\"unique:pages,slug\"}}', 6),
(50, 6, 'meta_description', 'text', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 7),
(51, 6, 'meta_keywords', 'text', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 8),
(52, 6, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}', 9),
(53, 6, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 0, 0, 0, NULL, 10),
(54, 6, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 11),
(55, 6, 'image', 'image', 'Page Image', 0, 1, 1, 1, 1, 1, NULL, 12),
(56, 2, 'fname', 'text', 'First name', 0, 1, 1, 1, 1, 1, '{}', 4),
(57, 2, 'lname', 'text', 'Last name', 0, 1, 1, 1, 1, 1, '{}', 5),
(58, 2, 'phone', 'number', 'Phone', 0, 1, 1, 1, 1, 1, '{}', 7),
(60, 2, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"InActive\",\"1\":\"Active\",\"-1\":\"Banned\"}}', 10),
(61, 2, 'mobile_confirmed', 'select_dropdown', 'Mobile Confirmed', 1, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 11),
(62, 2, 'num_del_ob', 'number', 'Num Del Ob', 1, 0, 1, 1, 1, 1, '{}', 12),
(63, 8, 'id', 'number', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(64, 8, 'role_id', 'text', 'Role Id', 1, 0, 1, 1, 1, 1, '{}', 11),
(65, 8, 'username', 'text', 'Username', 0, 1, 1, 1, 1, 1, '{}', 3),
(66, 8, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '{}', 7),
(67, 8, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"InActive\",\"1\":\"Active\",\"-1\":\"Banned\"}}', 12),
(68, 8, 'superadmin', 'select_dropdown', 'Superadmin', 0, 0, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 13),
(69, 8, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 1, 0, 1, '{}', 14),
(70, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 15),
(71, 8, 'email', 'text', 'Email', 0, 1, 1, 1, 1, 1, '{}', 6),
(72, 8, 'email_confirmed', 'select_dropdown', 'Email Confirmed', 0, 0, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 16),
(73, 8, 'lat', 'number', 'Lat', 0, 0, 1, 1, 1, 1, '{}', 17),
(74, 8, 'lng', 'number', 'Lng', 0, 0, 1, 1, 1, 1, '{}', 18),
(75, 8, 'address', 'text', 'Address', 0, 0, 1, 1, 1, 1, '{}', 19),
(79, 8, 'fname', 'text', 'Fname', 0, 1, 1, 1, 1, 1, '{}', 4),
(80, 8, 'lname', 'text', 'Lname', 0, 1, 1, 1, 1, 1, '{}', 5),
(81, 8, 'phone', 'number', 'Phone', 0, 0, 1, 1, 1, 1, '{}', 20),
(82, 8, 'mobile_confirmed', 'select_dropdown', 'Mobile Confirmed', 1, 0, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 21),
(83, 8, 'region_id', 'text', 'Region Id', 0, 0, 1, 1, 1, 1, '{}', 23),
(84, 8, 'isOnline', 'select_dropdown', 'IsOnline', 1, 0, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 24),
(85, 8, 'car_type_id', 'text', 'Car Type Id', 0, 0, 1, 1, 1, 1, '{}', 9),
(86, 9, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(87, 9, 'car_type', 'text', 'Car Type', 1, 1, 1, 1, 1, 1, '{}', 2),
(88, 9, 'icon', 'image', 'Icon', 0, 1, 1, 1, 1, 1, '{}', 3),
(89, 9, 'status', 'text', 'Status', 1, 1, 1, 1, 1, 1, '{}', 4),
(90, 9, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 1, 0, 1, '{}', 5),
(91, 9, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(93, 8, 'admin_belongsto_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"about_app\",\"pivot\":\"0\",\"taggable\":\"0\"}', 10),
(94, 10, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(95, 10, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 4),
(96, 10, 'status', 'select_dropdown', 'Status', 0, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"InActive\",\"1\":\"Active\"}}', 5),
(98, 10, 'city_id', 'text', 'City Id', 1, 1, 1, 1, 1, 1, '{}', 3),
(99, 11, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(100, 11, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 4),
(101, 11, 'status', 'select_dropdown', 'Status', 0, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"InActive\",\"1\":\"Active\"}}', 5),
(103, 11, 'country_id', 'text', 'Country Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(104, 12, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(105, 12, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{}', 2),
(106, 12, 'status', 'select_dropdown', 'Status', 0, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"InActive\",\"1\":\"Active\"}}', 3),
(108, 11, 'city_belongsto_country_relationship', 'relationship', 'Country', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Country\",\"table\":\"countries\",\"type\":\"belongsTo\",\"column\":\"country_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"about_app\",\"pivot\":\"0\",\"taggable\":\"0\"}', 3),
(109, 10, 'region_belongsto_city_relationship', 'relationship', 'City', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\City\",\"table\":\"cities\",\"type\":\"belongsTo\",\"column\":\"city_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"about_app\",\"pivot\":\"0\",\"taggable\":\"0\"}', 2),
(111, 2, 'username', 'text', 'Username', 0, 1, 1, 1, 1, 1, '{}', 3),
(112, 8, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '{}', 2),
(113, 2, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '{}', 2),
(114, 13, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(115, 13, 'admin_id', 'text', 'Admin Id', 1, 1, 1, 1, 1, 1, '{}', 3),
(116, 13, 'image', 'image', 'Image', 1, 1, 1, 1, 1, 1, '{}', 4),
(117, 13, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 1, 0, 1, '{}', 5),
(118, 13, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(119, 13, 'car_image_belongsto_admin_relationship', 'relationship', 'admins', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Admin\",\"table\":\"admins\",\"type\":\"belongsTo\",\"column\":\"admin_id\",\"key\":\"id\",\"label\":\"username\",\"pivot_table\":\"about_app\",\"pivot\":\"0\",\"taggable\":\"0\"}', 2),
(120, 10, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 1, '{}', 5),
(121, 10, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(122, 12, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(123, 12, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(124, 11, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 5),
(125, 11, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 6),
(126, 14, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(127, 14, 'user_id', 'text', 'User Id', 1, 1, 1, 1, 1, 1, '{}', 5),
(128, 14, 'description', 'text', 'Description', 0, 0, 1, 1, 1, 1, '{}', 6),
(129, 14, 'dateTime', 'timestamp', 'DateTime', 0, 1, 1, 1, 1, 1, '{}', 7),
(130, 14, 'from', 'text', 'From', 1, 1, 1, 1, 1, 1, '{}', 2),
(131, 14, 'to', 'text', 'To', 1, 1, 1, 1, 1, 1, '{}', 3),
(132, 14, 'address_to', 'text', 'Address To', 0, 0, 0, 0, 0, 0, '{}', 8),
(133, 14, 'region_id_to', 'text', 'Region Id To', 0, 0, 0, 0, 0, 0, '{}', 9),
(134, 14, 'lat_to', 'text', 'Lat To', 0, 0, 0, 0, 0, 0, '{}', 10),
(135, 14, 'lng_to', 'text', 'Lng To', 0, 0, 0, 0, 0, 0, '{}', 11),
(136, 14, 'address_from', 'text', 'Address From', 0, 0, 0, 0, 0, 0, '{}', 14),
(137, 14, 'region_id_from', 'text', 'Region Id From', 0, 0, 0, 0, 0, 0, '{}', 15),
(138, 14, 'lat_from', 'text', 'Lat From', 0, 0, 0, 0, 0, 0, '{}', 16),
(139, 14, 'lng_from', 'text', 'Lng From', 0, 0, 0, 0, 0, 0, '{}', 17),
(140, 14, 'price', 'text', 'Price', 0, 1, 1, 1, 1, 1, '{}', 18),
(141, 14, 'isWantRide', 'select_dropdown', 'IsWantRide', 1, 0, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 19),
(142, 14, 'car_type_id', 'text', 'Car Type Id', 0, 1, 1, 1, 1, 1, '{}', 21),
(143, 14, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"1\",\"options\":{\"1\":\"New Request\",\"2\":\"Reserved\",\"3\":\"On Way\",\"4\":\"Delivered\"}}', 22),
(144, 14, 'isPaid', 'select_dropdown', 'IsPaid', 1, 1, 1, 1, 1, 1, '{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Yes\"}}', 23),
(145, 14, 'created_at', 'timestamp', 'Created At', 1, 0, 1, 0, 0, 0, '{}', 24),
(146, 14, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 25),
(147, 14, 'order_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"username\",\"pivot_table\":\"about_app\",\"pivot\":\"0\",\"taggable\":\"0\"}', 4),
(148, 14, 'order_belongsto_car_type_relationship', 'relationship', 'Car Type', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\CarType\",\"table\":\"car_types\",\"type\":\"belongsTo\",\"column\":\"car_type_id\",\"key\":\"id\",\"label\":\"car_type\",\"pivot_table\":\"about_app\",\"pivot\":\"0\",\"taggable\":\"0\"}', 20),
(149, 14, 'order_belongsto_region_relationship', 'relationship', 'Source Region', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Region\",\"table\":\"regions\",\"type\":\"belongsTo\",\"column\":\"to\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"about_app\",\"pivot\":\"0\",\"taggable\":\"0\"}', 12),
(150, 14, 'order_belongsto_region_relationship_1', 'relationship', 'Destination Region', 0, 1, 1, 1, 1, 1, '{\"model\":\"App\\\\Models\\\\Region\",\"table\":\"regions\",\"type\":\"belongsTo\",\"column\":\"from\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"about_app\",\"pivot\":\"0\",\"taggable\":\"0\"}', 13);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(2, 'users', 'users', 'User', 'Users', 'voyager-person', 'App\\User', NULL, NULL, NULL, 1, 1, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2021-04-02 08:25:38', '2021-04-17 07:06:26'),
(3, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2021-04-02 08:25:38', '2021-04-02 08:25:38'),
(4, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2021-04-02 08:25:38', '2021-04-02 08:25:38'),
(5, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', 'TCG\\Voyager\\Policies\\PostPolicy', '', '', 1, 0, NULL, '2021-04-02 08:27:05', '2021-04-02 08:27:05'),
(6, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', NULL, '', '', 1, 0, NULL, '2021-04-02 08:27:06', '2021-04-02 08:27:06'),
(8, 'admins', 'admins', 'Admin', 'Admins', 'voyager-person', 'App\\Models\\Admin', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-04-15 12:03:12', '2021-04-16 09:32:11'),
(9, 'car_types', 'car-types', 'Car Type', 'Car Types', NULL, 'App\\Models\\CarType', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2021-04-15 12:31:55', '2021-04-15 12:31:55'),
(10, 'regions', 'regions', 'Region', 'Regions', 'voyager-paper-plane', 'App\\Models\\Region', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-04-15 12:55:04', '2021-04-16 09:09:03'),
(11, 'cities', 'cities', 'City', 'Cities', 'voyager-paper-plane', 'App\\Models\\City', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-04-15 12:55:25', '2021-04-16 09:09:15'),
(12, 'countries', 'countries', 'Country', 'Countries', 'voyager-paper-plane', 'App\\Models\\Country', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-04-15 12:55:46', '2021-04-16 09:09:24'),
(13, 'car_images', 'car-images', 'Car Image', 'Car Images', NULL, 'App\\Models\\CarImage', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-04-16 08:46:04', '2021-04-16 08:46:56'),
(14, 'orders', 'orders', 'Order', 'Orders', NULL, 'App\\Models\\Order', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2021-04-17 04:22:28', '2021-04-17 05:29:56');

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
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entity` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `entity_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-04-02 08:25:39', '2021-04-02 08:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2021-04-02 08:25:39', '2021-04-02 08:25:39', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 3, '2021-04-02 08:25:39', '2021-04-24 06:31:33', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, 19, 1, '2021-04-02 08:25:39', '2021-04-16 07:40:42', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, 19, 3, '2021-04-02 08:25:39', '2021-04-16 07:40:43', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 6, '2021-04-02 08:25:39', '2021-04-24 06:31:33', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2021-04-02 08:25:40', '2021-04-16 07:37:59', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2021-04-02 08:25:40', '2021-04-16 07:37:59', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2021-04-02 08:25:40', '2021-04-16 07:37:59', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2021-04-02 08:25:40', '2021-04-16 07:37:59', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 7, '2021-04-02 08:25:40', '2021-04-24 06:31:33', 'voyager.settings.index', NULL),
(12, 1, 'Posts', '', '_self', 'voyager-news', NULL, NULL, 4, '2021-04-02 08:27:06', '2021-04-24 06:31:33', 'voyager.posts.index', NULL),
(13, 1, 'Pages', '', '_self', 'voyager-file-text', NULL, NULL, 5, '2021-04-02 08:27:07', '2021-04-24 06:31:33', 'voyager.pages.index', NULL),
(14, 1, 'Admins', '', '_self', 'voyager-person', '#000000', 19, 2, '2021-04-15 12:03:13', '2021-04-16 07:40:42', 'voyager.admins.index', 'null'),
(16, 1, 'Regions', '', '_self', 'voyager-paper-plane', '#000000', 21, 3, '2021-04-15 12:55:04', '2021-04-16 09:07:34', 'voyager.regions.index', 'null'),
(17, 1, 'Cities', '', '_self', 'voyager-paper-plane', '#000000', 21, 2, '2021-04-15 12:55:25', '2021-04-16 09:07:27', 'voyager.cities.index', 'null'),
(18, 1, 'Countries', '', '_self', 'voyager-paper-plane', '#000000', 21, 1, '2021-04-15 12:55:46', '2021-04-16 09:05:16', 'voyager.countries.index', 'null'),
(19, 1, 'User Management', '', '_self', 'voyager-people', '#000000', NULL, 2, '2021-04-16 07:39:51', '2021-04-16 07:40:23', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_01_01_000000_create_pages_table', 1),
(6, '2016_01_01_000000_create_posts_table', 1),
(7, '2016_02_15_204651_create_categories_table', 1),
(8, '2016_05_19_173453_create_menu_table', 1),
(9, '2016_10_21_190000_create_roles_table', 1),
(10, '2016_10_21_190000_create_settings_table', 1),
(11, '2016_11_30_135954_create_permission_table', 1),
(12, '2016_11_30_141208_create_permission_role_table', 1),
(13, '2016_12_26_201236_data_types__add__server_side', 1),
(14, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(15, '2017_01_14_005015_create_translations_table', 1),
(16, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(17, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(18, '2017_04_11_000000_alter_post_nullable_fields_table', 1),
(19, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(20, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(21, '2017_08_05_000000_add_group_to_settings_table', 1),
(22, '2017_11_26_013050_add_user_role_relationship', 1),
(23, '2017_11_26_015000_create_user_roles_table', 1),
(24, '2018_03_11_000000_add_user_settings', 1),
(25, '2018_03_14_000000_add_details_to_data_types_table', 1),
(26, '2018_03_16_000000_make_settings_value_nullable', 1),
(27, '2019_08_19_000000_create_failed_jobs_table', 1),
(28, '2020_03_31_115935_create_sys_admins', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_id` int(11) DEFAULT NULL,
  `type` tinyint(3) NOT NULL,
  `date` datetime NOT NULL,
  `icon` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_read` tinyint(3) DEFAULT 0,
  `publish` tinyint(3) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `admin_id`, `title`, `content`, `data_id`, `type`, `date`, `icon`, `image`, `url`, `is_read`, `publish`, `created_at`, `updated_at`) VALUES
(21, NULL, 41, 'New Order', 'User added a new order', 19, 1, '2021-04-20 23:52:07', NULL, '', '', 0, 0, '2021-04-20 20:52:07', '2021-04-20 20:52:07'),
(22, NULL, 41, 'New Order', 'User added a new order', 20, 1, '2021-04-20 23:53:40', NULL, '', '', 0, 0, '2021-04-20 20:53:40', '2021-04-20 20:53:40'),
(23, NULL, 41, 'New Order', 'User added a new order', 21, 1, '2021-04-20 23:54:02', NULL, '', '', 0, 0, '2021-04-20 20:54:02', '2021-04-20 20:54:02'),
(24, NULL, 41, 'New Order', 'User added a new order', 22, 1, '2021-04-21 08:23:31', NULL, '', '', 0, 0, '2021-04-21 05:23:31', '2021-04-21 05:23:31'),
(25, 103, NULL, 'New Order', 'User added a new order', NULL, 1, '2021-04-21 08:51:53', NULL, '', '', 0, 0, '2021-04-21 05:51:53', '2021-04-21 05:51:53'),
(26, 103, NULL, 'New Order', 'User added a new offer', 24, 1, '2021-04-21 08:53:15', NULL, '', '', 0, 0, '2021-04-21 05:53:15', '2021-04-21 05:53:15'),
(27, 103, NULL, 'New Offer', 'User added a new offer', 25, 2, '2021-04-21 08:59:33', NULL, '', '', 0, 0, '2021-04-21 05:59:33', '2021-04-21 05:59:33'),
(28, 103, NULL, 'New Offer', 'User added a new offer', 26, 2, '2021-04-21 09:00:49', NULL, '', '', 0, 0, '2021-04-21 06:00:49', '2021-04-21 06:00:49'),
(29, 103, NULL, 'New Offer', 'User added a new offer', 27, 2, '2021-04-21 09:01:19', NULL, '', '', 0, 0, '2021-04-21 06:01:19', '2021-04-21 06:01:19'),
(30, 103, NULL, 'New Offer', 'User added a new offer', 28, 2, '2021-04-21 09:02:23', NULL, '', '', 0, 0, '2021-04-21 06:02:23', '2021-04-21 06:02:23'),
(31, 103, NULL, 'New Offer', 'User added a new offer', 29, 2, '2021-04-21 09:02:58', NULL, '', '', 0, 0, '2021-04-21 06:02:58', '2021-04-21 06:02:58'),
(32, 103, NULL, 'New Offer', 'User added a new offer', 30, 2, '2021-04-21 09:04:08', NULL, '', '', 0, 0, '2021-04-21 06:04:08', '2021-04-21 06:04:08'),
(33, 103, NULL, 'New Offer', 'User added a new offer', 31, 2, '2021-04-21 10:45:13', NULL, '', '', 0, 0, '2021-04-21 07:45:13', '2021-04-21 07:45:13'),
(34, 103, NULL, 'Delete Offer', 'User removed the offer because it\'s hard', 31, 3, '2021-04-21 10:45:43', NULL, '', '', 0, 0, '2021-04-21 07:45:43', '2021-04-21 07:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Hello World', 'Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.', '<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', 'pages/page1.jpg', 'hello-world', 'Yar Meta Description', 'Keyword1, Keyword2', 'ACTIVE', '2021-04-02 08:27:07', '2021-04-02 08:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2021-04-02 08:09:29', '2021-04-02 08:09:29'),
(2, 'browse_bread', NULL, '2021-04-02 08:09:30', '2021-04-02 08:09:30'),
(3, 'browse_database', NULL, '2021-04-02 08:09:30', '2021-04-02 08:09:30'),
(4, 'browse_media', NULL, '2021-04-02 08:09:30', '2021-04-02 08:09:30'),
(5, 'browse_compass', NULL, '2021-04-02 08:09:31', '2021-04-02 08:09:31'),
(6, 'browse_menus', 'menus', '2021-04-02 08:09:31', '2021-04-02 08:09:31'),
(7, 'read_menus', 'menus', '2021-04-02 08:09:31', '2021-04-02 08:09:31'),
(8, 'edit_menus', 'menus', '2021-04-02 08:09:31', '2021-04-02 08:09:31'),
(9, 'add_menus', 'menus', '2021-04-02 08:09:32', '2021-04-02 08:09:32'),
(10, 'delete_menus', 'menus', '2021-04-02 08:09:32', '2021-04-02 08:09:32'),
(11, 'browse_roles', 'roles', '2021-04-02 08:09:32', '2021-04-02 08:09:32'),
(12, 'read_roles', 'roles', '2021-04-02 08:09:32', '2021-04-02 08:09:32'),
(13, 'edit_roles', 'roles', '2021-04-02 08:09:32', '2021-04-02 08:09:32'),
(14, 'add_roles', 'roles', '2021-04-02 08:09:32', '2021-04-02 08:09:32'),
(15, 'delete_roles', 'roles', '2021-04-02 08:09:33', '2021-04-02 08:09:33'),
(16, 'browse_users', 'users', '2021-04-02 08:09:33', '2021-04-02 08:09:33'),
(17, 'read_users', 'users', '2021-04-02 08:09:33', '2021-04-02 08:09:33'),
(18, 'edit_users', 'users', '2021-04-02 08:09:33', '2021-04-02 08:09:33'),
(19, 'add_users', 'users', '2021-04-02 08:09:33', '2021-04-02 08:09:33'),
(20, 'delete_users', 'users', '2021-04-02 08:09:33', '2021-04-02 08:09:33'),
(21, 'browse_settings', 'settings', '2021-04-02 08:09:33', '2021-04-02 08:09:33'),
(22, 'read_settings', 'settings', '2021-04-02 08:09:33', '2021-04-02 08:09:33'),
(23, 'edit_settings', 'settings', '2021-04-02 08:09:33', '2021-04-02 08:09:33'),
(24, 'add_settings', 'settings', '2021-04-02 08:09:33', '2021-04-02 08:09:33'),
(25, 'delete_settings', 'settings', '2021-04-02 08:09:34', '2021-04-02 08:09:34'),
(31, 'browse_posts', 'posts', '2021-04-02 08:27:06', '2021-04-02 08:27:06'),
(32, 'read_posts', 'posts', '2021-04-02 08:27:06', '2021-04-02 08:27:06'),
(33, 'edit_posts', 'posts', '2021-04-02 08:27:06', '2021-04-02 08:27:06'),
(34, 'add_posts', 'posts', '2021-04-02 08:27:06', '2021-04-02 08:27:06'),
(35, 'delete_posts', 'posts', '2021-04-02 08:27:06', '2021-04-02 08:27:06'),
(36, 'browse_pages', 'pages', '2021-04-02 08:27:07', '2021-04-02 08:27:07'),
(37, 'read_pages', 'pages', '2021-04-02 08:27:07', '2021-04-02 08:27:07'),
(38, 'edit_pages', 'pages', '2021-04-02 08:27:07', '2021-04-02 08:27:07'),
(39, 'add_pages', 'pages', '2021-04-02 08:27:07', '2021-04-02 08:27:07'),
(40, 'delete_pages', 'pages', '2021-04-02 08:27:07', '2021-04-02 08:27:07'),
(41, 'browse_admins', 'admins', '2021-04-15 12:03:13', '2021-04-15 12:03:13'),
(42, 'read_admins', 'admins', '2021-04-15 12:03:13', '2021-04-15 12:03:13'),
(43, 'edit_admins', 'admins', '2021-04-15 12:03:13', '2021-04-15 12:03:13'),
(44, 'add_admins', 'admins', '2021-04-15 12:03:13', '2021-04-15 12:03:13'),
(45, 'delete_admins', 'admins', '2021-04-15 12:03:13', '2021-04-15 12:03:13'),
(46, 'browse_car_types', 'car_types', '2021-04-15 12:31:56', '2021-04-15 12:31:56'),
(47, 'read_car_types', 'car_types', '2021-04-15 12:31:56', '2021-04-15 12:31:56'),
(48, 'edit_car_types', 'car_types', '2021-04-15 12:31:56', '2021-04-15 12:31:56'),
(49, 'add_car_types', 'car_types', '2021-04-15 12:31:56', '2021-04-15 12:31:56'),
(50, 'delete_car_types', 'car_types', '2021-04-15 12:31:56', '2021-04-15 12:31:56'),
(51, 'browse_regions', 'regions', '2021-04-15 12:55:04', '2021-04-15 12:55:04'),
(52, 'read_regions', 'regions', '2021-04-15 12:55:04', '2021-04-15 12:55:04'),
(53, 'edit_regions', 'regions', '2021-04-15 12:55:04', '2021-04-15 12:55:04'),
(54, 'add_regions', 'regions', '2021-04-15 12:55:04', '2021-04-15 12:55:04'),
(55, 'delete_regions', 'regions', '2021-04-15 12:55:04', '2021-04-15 12:55:04'),
(56, 'browse_cities', 'cities', '2021-04-15 12:55:25', '2021-04-15 12:55:25'),
(57, 'read_cities', 'cities', '2021-04-15 12:55:25', '2021-04-15 12:55:25'),
(58, 'edit_cities', 'cities', '2021-04-15 12:55:25', '2021-04-15 12:55:25'),
(59, 'add_cities', 'cities', '2021-04-15 12:55:25', '2021-04-15 12:55:25'),
(60, 'delete_cities', 'cities', '2021-04-15 12:55:25', '2021-04-15 12:55:25'),
(61, 'browse_countries', 'countries', '2021-04-15 12:55:46', '2021-04-15 12:55:46'),
(62, 'read_countries', 'countries', '2021-04-15 12:55:46', '2021-04-15 12:55:46'),
(63, 'edit_countries', 'countries', '2021-04-15 12:55:46', '2021-04-15 12:55:46'),
(64, 'add_countries', 'countries', '2021-04-15 12:55:46', '2021-04-15 12:55:46'),
(65, 'delete_countries', 'countries', '2021-04-15 12:55:46', '2021-04-15 12:55:46'),
(66, 'browse_car_images', 'car_images', '2021-04-16 08:46:04', '2021-04-16 08:46:04'),
(67, 'read_car_images', 'car_images', '2021-04-16 08:46:04', '2021-04-16 08:46:04'),
(68, 'edit_car_images', 'car_images', '2021-04-16 08:46:04', '2021-04-16 08:46:04'),
(69, 'add_car_images', 'car_images', '2021-04-16 08:46:04', '2021-04-16 08:46:04'),
(70, 'delete_car_images', 'car_images', '2021-04-16 08:46:04', '2021-04-16 08:46:04'),
(71, 'browse_orders', 'orders', '2021-04-17 04:22:28', '2021-04-17 04:22:28'),
(72, 'read_orders', 'orders', '2021-04-17 04:22:28', '2021-04-17 04:22:28'),
(73, 'edit_orders', 'orders', '2021-04-17 04:22:28', '2021-04-17 04:22:28'),
(74, 'add_orders', 'orders', '2021-04-17 04:22:28', '2021-04-17 04:22:28'),
(75, 'delete_orders', 'orders', '2021-04-17 04:22:28', '2021-04-17 04:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
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
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `seo_title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, 'Lorem Ipsum Post', NULL, 'This is the excerpt for the Lorem Ipsum Post', '<p>This is the body of the lorem ipsum post</p>', 'posts/post1.jpg', 'lorem-ipsum-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2021-04-02 08:27:06', '2021-04-02 08:27:06'),
(2, 0, NULL, 'My Sample Post', NULL, 'This is the excerpt for the sample Post', '<p>This is the body for the sample post, which includes the body.</p>\n                <h2>We can use all kinds of format!</h2>\n                <p>And include a bunch of other stuff.</p>', 'posts/post2.jpg', 'my-sample-post', 'Meta Description for sample post', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2021-04-02 08:27:06', '2021-04-02 08:27:06'),
(3, 0, NULL, 'Latest Post', NULL, 'This is the excerpt for the latest post', '<p>This is the body for the latest post</p>', 'posts/post3.jpg', 'latest-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2021-04-02 08:27:06', '2021-04-02 08:27:06'),
(4, 0, NULL, 'Yarr Post', NULL, 'Reef sails nipperkin bring a spring upon her cable coffer jury mast spike marooned Pieces of Eight poop deck pillage. Clipper driver coxswain galleon hempen halter come about pressgang gangplank boatswain swing the lead. Nipperkin yard skysail swab lanyard Blimey bilge water ho quarter Buccaneer.', '<p>Swab deadlights Buccaneer fire ship square-rigged dance the hempen jig weigh anchor cackle fruit grog furl. Crack Jennys tea cup chase guns pressgang hearties spirits hogshead Gold Road six pounders fathom measured fer yer chains. Main sheet provost come about trysail barkadeer crimp scuttle mizzenmast brig plunder.</p>\n<p>Mizzen league keelhaul galleon tender cog chase Barbary Coast doubloon crack Jennys tea cup. Blow the man down lugsail fire ship pinnace cackle fruit line warp Admiral of the Black strike colors doubloon. Tackle Jack Ketch come about crimp rum draft scuppers run a shot across the bow haul wind maroon.</p>\n<p>Interloper heave down list driver pressgang holystone scuppers tackle scallywag bilged on her anchor. Jack Tar interloper draught grapple mizzenmast hulk knave cable transom hogshead. Gaff pillage to go on account grog aft chase guns piracy yardarm knave clap of thunder.</p>', 'posts/post4.jpg', 'yarr-post', 'this be a meta descript', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2021-04-02 08:27:06', '2021-04-02 08:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2021-04-02 08:09:28', '2021-04-02 08:09:28'),
(2, 'user', 'Normal User', '2021-04-02 08:09:29', '2021-04-02 08:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Site Title', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Site Description', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', '', '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Voyager', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Welcome to Voyager. The Missing Admin for Laravel', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', '', '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`) VALUES
(1, 'data_types', 'display_name_singular', 5, 'pt', 'Post', '2021-04-02 08:27:07', '2021-04-02 08:27:07'),
(2, 'data_types', 'display_name_singular', 6, 'pt', 'Página', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(3, 'data_types', 'display_name_singular', 2, 'pt', 'Utilizador', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(4, 'data_types', 'display_name_singular', 1, 'pt', 'Categoria', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(5, 'data_types', 'display_name_singular', 3, 'pt', 'Menu', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(6, 'data_types', 'display_name_singular', 4, 'pt', 'Função', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(7, 'data_types', 'display_name_plural', 5, 'pt', 'Posts', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(8, 'data_types', 'display_name_plural', 6, 'pt', 'Páginas', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(9, 'data_types', 'display_name_plural', 2, 'pt', 'Utilizadores', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(10, 'data_types', 'display_name_plural', 1, 'pt', 'Categorias', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(11, 'data_types', 'display_name_plural', 3, 'pt', 'Menus', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(12, 'data_types', 'display_name_plural', 4, 'pt', 'Funções', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(13, 'categories', 'slug', 1, 'pt', 'categoria-1', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(14, 'categories', 'name', 1, 'pt', 'Categoria 1', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(15, 'categories', 'slug', 2, 'pt', 'categoria-2', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(16, 'categories', 'name', 2, 'pt', 'Categoria 2', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(17, 'pages', 'title', 1, 'pt', 'Olá Mundo', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(18, 'pages', 'slug', 1, 'pt', 'ola-mundo', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(19, 'pages', 'body', 1, 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(20, 'menu_items', 'title', 1, 'pt', 'Painel de Controle', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(21, 'menu_items', 'title', 2, 'pt', 'Media', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(22, 'menu_items', 'title', 12, 'pt', 'Publicações', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(23, 'menu_items', 'title', 3, 'pt', 'Utilizadores', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(24, 'menu_items', 'title', 11, 'pt', 'Categorias', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(25, 'menu_items', 'title', 13, 'pt', 'Páginas', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(26, 'menu_items', 'title', 4, 'pt', 'Funções', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(27, 'menu_items', 'title', 5, 'pt', 'Ferramentas', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(28, 'menu_items', 'title', 6, 'pt', 'Menus', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(29, 'menu_items', 'title', 7, 'pt', 'Base de dados', '2021-04-02 08:27:08', '2021-04-02 08:27:08'),
(30, 'menu_items', 'title', 10, 'pt', 'Configurações', '2021-04-02 08:27:08', '2021-04-02 08:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_confirmed` tinyint(4) NOT NULL DEFAULT 1,
  `num_del_ob` int(11) NOT NULL DEFAULT 0,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'en',
  `firebase_token` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`, `created_at`, `updated_at`, `avatar`, `fname`, `lname`, `phone`, `mobile_confirmed`, `num_del_ob`, `language`, `firebase_token`) VALUES
(103, 'Diyaa Koman', '$2y$10$ewFTOy66MTAGsNlgbcD.AefwBtedgG5MDSSMd.Phgui8ISlnkXYda', 1, '2021-04-21 08:55:44', '2021-04-21 05:55:44', 'users\\1618576153.jpg', 'Diyaa', 'Koman', '0', 1, 0, 'en', 'eVMUQ3JESIGkEYun-XFpoV:APA91bH-AJPITq27H_RWiMX383_yNNw_JO9U4DReI3JN2cfEVRGOn0k9N-7fNSordOyJWQwAjj2ywnw_VhwOgTVn0RZcYLGYwHEFuCD6F1eH_PbpJWSouOhuQKSzRTqJZ0vAr9fW5iQu');

-- --------------------------------------------------------

--
-- Table structure for table `user_mobile_email`
--

CREATE TABLE `user_mobile_email` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirm_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `is_primary` tinyint(4) NOT NULL DEFAULT 0,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user set of his emails and mobile numbers that can confirm';

--
-- Dumping data for table `user_mobile_email`
--

INSERT INTO `user_mobile_email` (`id`, `user_id`, `mobile`, `email`, `confirm_code`, `is_confirmed`, `is_primary`, `symbol`, `type`) VALUES
(59, 103, '0', NULL, '79856', 1, 1, NULL, 1),
(62, 106, '126523', NULL, '52716', 0, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_visit_log`
--

CREATE TABLE `user_visit_log` (
  `id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `language` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visit_time` int(11) NOT NULL,
  `browser` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `os` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `view_obj_log`
--

CREATE TABLE `view_obj_log` (
  `id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `from` varchar(24) COLLATE utf8_unicode_ci NOT NULL COMMENT 'web/mobile',
  `symbol` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`),
  ADD KEY `mobile_confirmed` (`mobile_confirmed`),
  ADD KEY `car_type_id` (`car_type_id`);

--
-- Indexes for table `admin_mobile_email`
--
ALTER TABLE `admin_mobile_email`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_mobile_email_key` (`admin_id`,`mobile`,`email`) USING BTREE;

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `entity_id` (`entity_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `data_id` (`data_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`),
  ADD KEY `mobile_confirmed` (`mobile_confirmed`);

--
-- Indexes for table `user_mobile_email`
--
ALTER TABLE `user_mobile_email`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_mobile_email_key` (`user_id`,`mobile`,`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- Indexes for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `view_obj_log`
--
ALTER TABLE `view_obj_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obj_id` (`obj_id`),
  ADD KEY `date` (`date`),
  ADD KEY `from` (`from`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `obj_id_2` (`obj_id`),
  ADD KEY `obj_id_3` (`obj_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `admin_mobile_email`
--
ALTER TABLE `admin_mobile_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `user_mobile_email`
--
ALTER TABLE `user_mobile_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `view_obj_log`
--
ALTER TABLE `view_obj_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_mobile_email`
--
ALTER TABLE `admin_mobile_email`
  ADD CONSTRAINT `admin_mobile_email_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
