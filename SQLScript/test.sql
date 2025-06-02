-- Read newly created article
SELECT * FROM `articles` WHERE `id` = 16;

-- Read comments on the new article
SELECT * FROM `comments` WHERE `article_id` = 16;

-- Read updated article
SELECT * FROM `articles` WHERE `id` = 16;

-- Ensure everything related to ID 16 is gone
SELECT * FROM `articles` WHERE `id` = 16;
SELECT * FROM `comments` WHERE `article_id` = 16;
SELECT * FROM `article_tags` WHERE `article_id` = 16;