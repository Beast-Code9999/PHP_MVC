-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 10:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `austro_asian_times`
-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS austro_asian_times
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

-- Use the newly created (or existing) database
USE austro_asian_times;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT 0,
  `allow_comments` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_data` longblob DEFAULT NULL,
  `tags_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` 
(`id`, `title`, `content`, `author_id`, `is_published`, `allow_comments`, `created_at`, `updated_at`, `image_data`, `tag_id`) VALUES
(1, 'The Rise of AI Journalism', 'Exploring how AI is shaping the future of newsrooms.', 1, 1, 1, '2024-11-30 15:00:00', '2024-11-30 15:00:00', NULL, 3), 
(2, 'Climate Change and Southeast Asia', 'A detailed look into the environmental challenges in the region.', 2, 1, 0, '2024-12-01 19:30:00', '2024-12-02 13:00:00', NULL, 5), 
(3, 'Tech Startups to Watch in 2025', 'We round up the hottest new tech startups this year.', 1, 1, 1, '2024-12-03 14:15:00', '2024-12-04 16:45:00', NULL, 3), 
(4, 'Local Voices: Community Journalism', 'The importance of community-driven news in urban areas.', 3, 0, 1, '2024-12-05 03:30:00', '2025-05-29 08:15:58', NULL, 6),
(5, 'Digital Privacy in the Modern Age', 'A closer look at how your data is handled online.', 2, 1, 1, '2024-12-05 21:20:00', '2024-12-05 21:25:00', NULL, 3),
(6, 'Mental Health in the Digital Age', 'How social media and technology impact mental well-being.', 2, 1, 0, '2024-12-06 09:30:00', '2024-12-06 10:00:00', NULL, 4),
(7, 'Inside the World of eSports', 'The growth and monetization of competitive gaming.', 3, 0, 1, '2024-12-07 18:00:00', '2024-12-07 18:30:00', NULL, 7),
(8, 'Space Tourism: Hype or Reality?', 'Will commercial space travel be accessible in our lifetime?', 1, 1, 1, '2024-12-08 12:00:00', '2024-12-08 14:15:00', NULL, 3),
(9, 'Urban Farming: Growing Greens in Cities', 'A closer look at sustainability and city agriculture.', 4, 1, 0, '2024-12-09 08:45:00', '2024-12-09 09:15:00', NULL, 5),
(10, 'Understanding Blockchain Beyond Bitcoin', 'Exploring blockchain uses across industries.', 2, 0, 0, '2024-12-10 16:20:00', '2024-12-10 16:50:00', NULL, 3),
(11, 'Reviving Indigenous Languages Through Tech', 'How apps and AI are preserving endangered languages.', 3, 1, 1, '2024-12-11 10:10:00', '2024-12-11 11:40:00', NULL, 6),
(12, 'The Gig Economy: Pros and Pitfalls', 'Exploring life as a freelancer in a digital age.', 1, 0, 1, '2024-12-12 17:30:00', '2024-12-12 18:00:00', NULL, 2),
(13, 'Cybersecurity Trends for 2025', 'The latest in protecting data and digital identities.', 4, 1, 1, '2024-12-13 14:45:00', '2024-12-13 15:00:00', NULL, 3),
(14, 'Smart Homes: Are We There Yet?', 'A critical look at smart home tech adoption.', 3, 0, 0, '2024-12-14 11:20:00', '2024-12-14 11:40:00', NULL, 3),
(15, 'The Rise of EdTech Startups', 'How technology is reshaping education globally.', 2, 1, 1, '2024-12-15 13:30:00', '2024-12-15 13:45:00', NULL, 6);


-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moderation`
--

CREATE TABLE `moderation` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `editor_id` int(11) DEFAULT NULL,
  `status` enum('approved','rejected','pending') DEFAULT 'pending',
  `moderated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(10, 'Admin'),
(1, 'Author'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_name` varchar(255) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_name`, `tag_id`) VALUES
('Politics', 1),
('Economy', 2),
('Technology', 3),
('Health', 4),
('Environment', 5),
('Education', 6),
('Sports', 7),
('Entertainment', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `created_at`) VALUES
(1, 'JohnWriter', 'john@example.com', 'test1', 1, '2025-05-08 19:51:14'),
(2, 'JaneEditor', 'jane@example.com', 'test2', 2, '2025-05-08 19:51:15'),
(3, 'MichaelReader', 'mike@example.com', 'test3', 3, '2025-05-09 05:21:15'),
(4, 'AdminUser', 'admin@example.com', 'adminpass', 10, '2025-05-18 16:32:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `moderation`
--
ALTER TABLE `moderation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `editor_id` (`editor_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moderation`
--
ALTER TABLE `moderation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
