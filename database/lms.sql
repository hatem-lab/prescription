-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2021 at 11:05 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `user_type`, `phone`, `region`, `city`, `photo`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$77uUmwNLh5cRiBimrGX.IO/0Wstm1kMlC1g23W/KWfYVfywjy3BIi', '2021-10-25 21:00:00', '2021-10-25 21:00:00', 'admin', '0937676881', 'المزة', 'دمشق', NULL),
(19, 'hatem hasan', 'hatem@gmail.com', '$2y$10$SdClC5rNoJFIPLMTF8JSFu01s3Bb6DlLkrowhXf45ntU.JYnl4ZyG', '2021-11-10 17:50:22', '2021-11-10 17:50:22', 'student', NULL, NULL, NULL, NULL),
(20, 'teacher', 'teacher@gmail.com', '$2y$10$8I1M1q009cdLaDf9SSQ2geVlU/rHEwiC/MZbpNOIGSP/ETvguykYW', '2021-11-10 18:01:16', '2021-11-10 18:01:16', 'teacher', NULL, NULL, NULL, NULL),
(21, 'teacher1', 'teacher1@gmail.com', '$2y$10$2GeowXac0A.i1rpSCkAK4.KXovki3SBwlxYZNC0ECI3vaYo/jctyG', '2021-11-10 19:26:41', '2021-11-10 19:26:41', 'teacher', NULL, NULL, NULL, NULL),
(22, 'teacher2', 'teacher2@gmail.com', '$2y$10$YlJMnIZd3MgyzbWrtjU1uuWqFtn9shJp2KzrAV1tisEk7vLyh6o8.', '2021-11-10 19:26:53', '2021-11-10 19:26:53', 'teacher', NULL, NULL, NULL, NULL),
(23, 'teacher3', 'teacher3@gmail.com', '$2y$10$PoNwjfpgGjVgleldA4QQjOOgemEXCCYqDxVjUH2.ZxqYUiWTh8UNy', '2021-11-10 19:28:03', '2021-11-10 19:28:03', 'teacher', NULL, NULL, NULL, NULL),
(24, 'teacher4', 'teacher4@gmail.com', '$2y$10$RmBeTbfJ5wJf4Q4CAi5RbenfyRgaNZ0ufGS6xFT/ICFPmh/sk3OqO', '2021-11-10 19:28:09', '2021-11-10 19:28:09', 'teacher', NULL, NULL, NULL, NULL),
(25, 'teacher5', 'teacher5@gmail.com', '$2y$10$1KB163mBXEsYnVL9UgDh9OR5AX.NPbbsEXpVQ7xXMPW4g6XAydtfy', '2021-11-10 19:28:15', '2021-11-10 19:28:15', 'teacher', NULL, NULL, NULL, NULL),
(26, 'teacher6', 'teacher6@gmail.com', '$2y$10$tpHuT7jbFujvlqqP7SVagu3G5Bel8TNblWBKGFOTUtvg9mptaqhYC', '2021-11-10 19:28:23', '2021-11-10 19:28:23', 'teacher', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coures_student`
--

CREATE TABLE `coures_student` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coures_student`
--

INSERT INTO `coures_student` (`id`, `course_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 2, 19, '2021-10-25 21:00:00', '2021-10-25 21:00:00'),
(2, 3, 19, '2021-10-25 21:00:00', '2021-10-25 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_published` int(2) DEFAULT 2,
  `type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `views_count` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `content`, `photo`, `created_at`, `updated_at`, `is_published`, `type_id`, `user_id`, `views_count`) VALUES
(2, 'lecture', 'This is a large class held in a lecture hall, a theater-like room that may seat hundreds of students. The professor talks for the entire class while students take notes. Lecture classes are common in first-year courses. Students in these classes may also attend a related discussion class.', NULL, '2021-11-09 16:24:44', '2021-11-09 16:24:44', 1, 1, 20, 3),
(3, 'Discussion', 'Discussion classes (sometimes called sections) are often a required part of lecture classes. Discussions are usually smaller groups of students led by a graduate student. You’ll do additional work, talk about the lecture and have a chance to ask questions.', 'C:\\xampp\\tmp\\php2B4B.tmp', '2021-11-09 16:25:04', '2021-11-09 17:33:19', 1, 1, 20, 3),
(4, 'seminars', 'In seminars, professors meet with a small group of students. These are often advanced courses that focus on special topics within the student’s major. Seminars are more personal, and students participate more in presentations and discussions. Some seminars focus on career or research skills.', NULL, '2021-11-09 16:25:22', '2021-11-10 18:23:40', 1, 2, 22, 2),
(5, 'studio', 'Students who take hands-on classes such as art, theater, music, design or photography will find themselves in a class environment in which they do what they are studying. A drawing class, for example, may be divided into two parts: a lesson class and a drawing studio.', NULL, '2021-11-09 16:26:06', '2021-11-09 16:26:06', 1, 2, 22, 5),
(6, 'independent-study', 'For an independent-study class, a student and a professor design a study program for the student that is separate from regular courses. Independent study often requires a research project or a lot of reading on a central theme as well as a series of papers or one major paper.', NULL, '2021-11-09 16:26:23', '2021-11-09 16:26:23', 1, 2, 24, 5),
(20, 'any', 'any', NULL, '2021-11-10 14:36:35', '2021-11-10 14:36:35', 2, 1, 24, 7);

-- --------------------------------------------------------

--
-- Table structure for table `courses_types`
--

CREATE TABLE `courses_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_types`
--

INSERT INTO `courses_types` (`id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'lecture', 1, '2021-11-09 19:58:36', '2021-11-09 20:02:08'),
(2, 'student math', 1, '2021-11-09 20:02:24', '2021-11-09 20:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `couse_id` int(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `lecture_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `lecture_id`, `course_id`, `file`, `created_at`, `updated_at`) VALUES
(11, NULL, 15, 'courses_images/0XWejysPRvaOP01K.jpg', '2021-11-10 11:44:32', '2021-11-10 11:44:32'),
(12, NULL, 15, 'courses_images/ihtUMktfZjFl0f56.jpg', '2021-11-10 11:44:32', '2021-11-10 11:44:32'),
(13, NULL, 16, 'courses_images/YpZRGihzwd353h4P.jpg', '2021-11-10 11:45:38', '2021-11-10 11:45:38'),
(14, NULL, 16, 'courses_images/wCTlsvSAEcVydFuI.jpg', '2021-11-10 11:45:38', '2021-11-10 11:45:38'),
(15, NULL, 17, 'courses_images/1tqdkWrnbrXb0s0a.jpg', '2021-11-10 11:45:54', '2021-11-10 11:45:54'),
(16, NULL, 17, 'courses_images/KsY3DyD6XSS0VAT8.jpg', '2021-11-10 11:45:54', '2021-11-10 11:45:54'),
(17, NULL, 18, 'courses_images/A7lGI1FevqAp1Y8G.jpg', '2021-11-10 11:46:51', '2021-11-10 11:46:51'),
(18, NULL, 18, 'courses_images/6C1thFPbX9EHgLq0.jpg', '2021-11-10 11:46:51', '2021-11-10 11:46:51');

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
(3, '2017_05_29_155126144426_create_products_table', 1),
(4, '2020_08_19_204833_create_settings_table', 1),
(5, '2020_08_19_213045_create_setting_translations_table', 1),
(6, '2020_09_12_191258_create_brand_translations_table', 1),
(7, '2020_11_14_133140_add_mobile_column_to_user_table', 1),
(8, '2020_11_14_133619_drop_email_column_from_user_table', 1),
(9, '2020_11_14_141441_create_users_verfication_code_table', 1),
(10, '2021_11_09_132548_create_teashers_table', 2),
(12, '2021_11_09_132740_create_admins_table', 3);

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
-- Table structure for table `teashers`
--

CREATE TABLE `teashers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `phone`, `image`, `city`) VALUES
(1, 'admin', 'admin@me.com', '$2y$10$77uUmwNLh5cRiBimrGX.IO/0Wstm1kMlC1g23W/KWfYVfywjy3BIi', '2021-10-25 21:00:00', '2021-11-09 12:14:33', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `coures_student`
--
ALTER TABLE `coures_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_types`
--
ALTER TABLE `courses_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `teashers`
--
ALTER TABLE `teashers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `coures_student`
--
ALTER TABLE `coures_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `courses_types`
--
ALTER TABLE `courses_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teashers`
--
ALTER TABLE `teashers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
