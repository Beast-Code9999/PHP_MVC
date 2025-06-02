-- Insert a new article
INSERT INTO `articles` (`title`, `content`, `author_id`, `is_published`, `allow_comments`, `created_at`, `updated_at`, `status`)
VALUES ('Test Article for CRUD', 'This is a test article for CRUD operations.', 1, 1, 1, NOW(), NOW(), 'draft');

-- Insert tags for the new article (assuming new article gets ID 16)
INSERT INTO `article_tags` (`article_id`, `tag_id`)
VALUES (16, 2), (16, 3);

-- Insert a comment on the new article
INSERT INTO `comments` (`article_id`, `user_id`, `content`, `is_approved`, `created_at`)
VALUES (16, 2, 'Testing comment insert.', 0, NOW());

-- Update article title and status
UPDATE `articles`
SET `title` = 'Updated CRUD Test Article', `status` = 'published', `updated_at` = NOW()
WHERE `id` = 16;

-- Delete comments on the article
DELETE FROM `comments` WHERE `article_id` = 16;

-- Delete article-tag relations
DELETE FROM `article_tags` WHERE `article_id` = 16;

-- Delete the article
DELETE FROM `articles` WHERE `id` = 16;

