-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 12:34 PM
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
--
USE austro_asian_times;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `created_at`) VALUES
(1, 'JohnWriter', 'john@example.com', 'test1', 1, '2025-05-08 19:51:14'),
(2, 'JaneEditor', 'jane@example.com', 'test2', 2, '2025-05-08 19:51:15'),
(3, 'MichaelReader', 'mike@example.com', 'test3', 3, '2025-05-09 05:21:15'),
(4, 'AdminUser', 'admin@example.com', 'adminpass', 10, '2025-05-18 16:32:25'),
(5, 'SarahWriter', 'sarah@example.com', 'pass123', 1, '2025-04-21 14:30:00'),
(6, 'TomEditor', 'tom@example.com', 'editme', 2, '2025-04-23 09:15:00'),
(7, 'LilyReader', 'lily@example.com', 'readpass', 3, '2025-04-25 18:45:00'),
(8, 'ChrisWriter', 'chris@example.com', 'chrispass', 1, '2025-04-30 12:10:00'),
(9, 'NinaEditor', 'nina@example.com', 'ninaedit', 2, '2025-05-02 08:00:00'),
(10, 'BenReader', 'ben@example.com', 'benread', 3, '2025-05-03 11:11:00'),
(11, 'OliviaWriter', 'olivia@example.com', 'olipass', 1, '2025-05-04 17:25:00'),
(12, 'EthanEditor', 'ethan@example.com', 'ethanpass', 2, '2025-05-05 10:55:00'),
(13, 'ZoeReader', 'zoe@example.com', 'zoeread', 3, '2025-05-06 14:45:00'),
(14, 'SuperAdmin', 'superadmin@example.com', 'supersecure', 10, '2025-05-07 16:30:00');
--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `author_id`, `is_published`, `allow_comments`, `created_at`, `updated_at`, `image_data`, `status`) VALUES
(1, 'The Rise of AI Journalism', 'Exploring how AI is shaping the future of newsrooms.', 1, 1, 1, '2024-11-30 15:00:00', '2024-11-30 15:00:00', NULL, 'published'),
(2, 'Climate Change and Southeast Asia', 'A detailed look into the environmental challenges in the region.', 2, 1, 0, '2024-12-01 19:30:00', '2024-12-02 13:00:00', NULL, 'pending'),
(3, 'Tech Startups to Watch in 2025', 'We round up the hottest new tech startups this year.', 1, 1, 1, '2024-12-03 14:15:00', '2024-12-04 16:45:00', NULL, 'published'),
(4, 'Local Voices: Community Journalism', 'The importance of community-driven news in urban areas.', 8, 0, 1, '2024-12-05 03:30:00', '2025-05-29 08:15:58', NULL, 'pending'),
(5, 'Digital Privacy in the Modern Age', 'A closer look at how your data is handled online.', 2, 1, 1, '2024-12-05 21:20:00', '2024-12-05 21:25:00', NULL, 'published'),
(6, 'Mental Health in the Digital Age', 'How social media and technology impact mental well-being.', 2, 1, 0, '2024-12-06 09:30:00', '2024-12-06 10:00:00', NULL, 'pending'),
(7, 'Inside the World of eSports', 'The growth and monetization of competitive gaming.', 1, 0, 1, '2024-12-07 18:00:00', '2024-12-07 18:30:00', NULL, 'pending'),
(8, 'Space Tourism: Hype or Reality?', 'Will commercial space travel be accessible in our lifetime?', 1, 1, 1, '2024-12-08 12:00:00', '2024-12-08 14:15:00', NULL, 'published'),
(9, 'Urban Farming: Growing Greens in Cities', 'A closer look at sustainability and city agriculture.', 4, 1, 0, '2024-12-09 08:45:00', '2024-12-09 09:15:00', NULL, 'pending'),
(10, 'Understanding Blockchain Beyond Bitcoin', 'Exploring blockchain uses across industries.', 2, 0, 0, '2024-12-10 16:20:00', '2024-12-10 16:50:00', NULL, 'pending'),
(11, 'Reviving Indigenous Languages Through Tech', 'How apps and AI are preserving endangered languages.', 5, 1, 1, '2024-12-11 10:10:00', '2024-12-11 11:40:00', NULL, 'published'),
(12, 'The Gig Economy: Pros and Pitfalls', 'Exploring life as a freelancer in a digital age.', 1, 0, 1, '2024-12-12 17:30:00', '2024-12-12 18:00:00', NULL, 'pending'),
(13, 'Cybersecurity Trends for 2025', 'The latest in protecting data and digital identities.', 4, 1, 1, '2024-12-13 14:45:00', '2024-12-13 15:00:00', NULL, 'published'),
(14, 'Smart Homes: Are We There Yet?', 'A critical look at smart home tech adoption.', 11, 0, 0, '2024-12-14 11:20:00', '2024-12-14 11:40:00', NULL, 'pending'),
(15, 'The Rise of EdTech Startups', 'How technology is reshaping education globally.', 2, 1, 1, '2024-12-15 13:30:00', '2024-12-15 13:45:00', NULL, 'published');


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


--
-- Dumping data for table `article_tags`
--

INSERT INTO `article_tags` (`article_id`, `tag_id`) VALUES
(1, 2),
(1, 3),
(1, 6),
(2, 1),
(2, 4),
(2, 5),
(3, 2),
(3, 3),
(3, 8),
(4, 1),
(4, 5),
(4, 6),
(5, 2),
(5, 3),
(5, 4),
(6, 3),
(6, 4),
(7, 7),
(7, 8),
(8, 2),
(8, 3),
(8, 8),
(9, 4),
(9, 5),
(10, 2),
(10, 3),
(11, 3),
(11, 6),
(12, 2),
(12, 3),
(13, 2),
(13, 3),
(14, 3),
(14, 8),
(15, 3),
(15, 6);

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `user_id`, `content`, `is_approved`, `created_at`) VALUES
(1, 2, 4, 'Great insights, especially the last section!', 1, '2025-01-08 14:25:00'),
(2, 5, 3, 'I didn’t know that, very helpful!', 0, '2025-01-15 09:13:00'),
(3, 1, 6, 'The conclusion could be stronger.', 1, '2025-02-02 16:42:00'),
(4, 9, 2, 'Interesting take, thanks for sharing.', 1, '2025-02-11 10:30:00'),
(5, 3, 5, 'Needs more sources, but good read.', 0, '2025-03-03 18:20:00'),
(6, 11, 1, 'Loved this! I shared it with my team.', 1, '2025-03-09 07:50:00'),
(7, 6, 7, 'I disagree with the main argument.', 0, '2025-03-15 22:12:00'),
(8, 13, 2, 'Nice breakdown of complex ideas.', 1, '2025-04-01 11:45:00'),
(9, 8, 1, 'This article is a bit too short.', 0, '2025-04-05 08:17:00'),
(10, 15, 3, 'Good structure and flow.', 1, '2025-04-09 13:35:00'),
(11, 1, 4, 'Can you add references?', 0, '2025-04-10 17:21:00'),
(12, 9, 5, 'Awesome! Waiting for a follow-up.', 1, '2025-04-11 09:02:00'),
(13, 2, 6, 'Please write more about this topic.', 0, '2025-04-15 12:33:00'),
(14, 3, 7, 'Solid points, well articulated.', 1, '2025-04-16 19:45:00'),
(15, 13, 2, 'A few typos, but otherwise great.', 1, '2025-04-20 16:18:00'),
(16, 5, 3, 'Totally agree with this perspective.', 1, '2025-04-22 08:44:00'),
(17, 11, 4, 'I found this confusing to follow.', 0, '2025-04-25 10:50:00'),
(18, 6, 5, 'The stats used are outdated.', 0, '2025-04-26 15:00:00'),
(19, 1, 6, 'Very informative article.', 1, '2025-04-27 09:15:00'),
(20, 8, 7, 'Brilliantly written and timely.', 1, '2025-04-29 20:10:00'),
(21, 15, 1, 'Could you expand on the last point?', 0, '2025-05-01 11:11:00'),
(22, 9, 2, 'I’ve bookmarked this.', 1, '2025-05-03 13:30:00'),
(23, 2, 3, 'Well explained, easy to understand.', 1, '2025-05-05 17:45:00'),
(24, 3, 4, 'More visuals would help.', 0, '2025-05-06 21:20:00'),
(25, 13, 5, 'Didn’t expect to agree, but I do.', 1, '2025-05-08 14:14:00'),
(26, 11, 6, 'You should do a podcast on this.', 0, '2025-05-09 10:10:00'),
(27, 5, 7, 'Not your best work.', 0, '2025-05-10 16:45:00'),
(28, 1, 1, 'Really engaging and concise.', 1, '2025-05-11 07:33:00'),
(29, 6, 2, 'Thank you, I learned a lot!', 1, '2025-05-12 08:28:00'),
(30, 8, 3, 'Can you cite your sources?', 0, '2025-05-13 20:00:00'),
(31, 3, 4, 'Thought-provoking content.', 1, '2025-05-14 12:00:00'),
(32, 9, 5, 'Great headline. Caught my eye.', 1, '2025-05-15 15:30:00'),
(33, 2, 6, 'You missed a major aspect of the issue.', 0, '2025-05-16 17:00:00'),
(34, 5, 7, 'This was super useful for my project.', 1, '2025-05-17 09:50:00'),
(35, 11, 1, 'Your writing style is great.', 1, '2025-05-18 14:45:00'),
(36, 13, 2, 'I would love a deeper dive.', 0, '2025-05-19 11:10:00'),
(37, 5, 3, 'Nicely formatted too.', 1, '2025-05-20 13:55:00'),
(38, 1, 4, 'Can we get a part two?', 1, '2025-05-21 16:35:00'),
(39, 3, 5, 'Might be controversial, but I liked it.', 0, '2025-05-22 18:15:00'),
(40, 15, 6, 'Very well put together.', 1, '2025-05-23 19:05:00');

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(10, 'Admin'),
(1, 'Author'),
(2, 'Editor'),
(3, 'User');


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
