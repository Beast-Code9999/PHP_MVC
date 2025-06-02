-- Articles
INSERT INTO `articles` (`id`, `title`, `content`, `author_id`, `is_published`, `allow_comments`, `created_at`, `updated_at`, `image_data`, `status`) VALUES
(101, 'Beyond Headlines: The Impact of Mobile News Apps', 'How smartphones are reshaping media consumption habits.', 2, 1, 1, '2025-01-10 09:00:00', '2025-01-10 09:30:00', NULL, 'published'),
(102, 'Tales from the Archipelago', 'Stories that define identity across island cultures.', 3, 0, 1, '2025-01-15 14:10:00', '2025-01-16 08:45:00', NULL, 'pending'),
(103, 'Food Security in Southeast Asia', 'Examining the food supply chain post-pandemic.', 4, 1, 1, '2025-01-20 16:45:00', '2025-01-21 11:30:00', NULL, 'published'),
(104, 'The Ethics of Deepfakes', 'Is synthetic media the future or a threat?', 1, 1, 0, '2025-01-25 20:00:00', '2025-01-25 21:00:00', NULL, 'published'),
(105, 'Women in Digital Journalism', 'Challenges and triumphs of female journalists online.', 2, 1, 1, '2025-01-28 10:15:00', '2025-01-28 11:00:00', NULL, 'published');

-- Article Tags
INSERT INTO `article_tags` (`article_id`, `tag_id`) VALUES
(101, 3),
(101, 6),
(102, 1),
(102, 4),
(103, 4),
(103, 5),
(104, 2),
(104, 8),
(105, 3),
(105, 6);

-- Comments
INSERT INTO `comments` (`id`, `article_id`, `user_id`, `content`, `is_approved`, `created_at`) VALUES
(101, 101, 2, 'This article made me rethink how I consume news.', 1, '2025-02-01 12:45:00'),
(102, 102, 4, 'Loved the cultural insights!', 1, '2025-02-02 08:10:00'),
(103, 103, 6, 'Important topic, but the stats need citation.', 0, '2025-02-05 14:35:00'),
(104, 104, 1, 'Fascinating perspective on deepfakes.', 1, '2025-02-06 19:55:00'),
(105, 105, 3, 'Such an empowering read!', 1, '2025-02-07 09:05:00'),
(106, 101, 5, 'Would love to see a follow-up piece.', 0, '2025-02-08 16:22:00'),
(107, 103, 2, 'This needs more local data.', 1, '2025-02-09 18:10:00'),
(108, 104, 6, 'Very relevant to current issues.', 0, '2025-02-10 11:40:00'),
(109, 105, 7, 'Well-structured and informative.', 1, '2025-02-11 13:55:00'),
(110, 102, 4, 'Would like to read more traditional stories.', 1, '2025-02-12 15:30:00');

