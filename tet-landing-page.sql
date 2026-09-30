-- ==================================================================
-- Tạo trang "Quà Tết" (/qua-tet/) dùng template "Landing Quà Tết"
-- Chạy trên DB production: tdhworld_home  (table prefix: wp_)
--
-- Yêu cầu: đã deploy các file theme trước khi chạy:
--   wp-content/themes/efarm/tet-landing.php
--   wp-content/themes/efarm/css/tet-landing.css
--   wp-content/themes/efarm/js/tet-landing.js
--
-- Script an toàn khi chạy lại: nếu slug 'qua-tet' đã tồn tại thì không
-- tạo trang mới, chỉ đảm bảo trang đó dùng đúng template.
-- ==================================================================

SET NAMES utf8mb4;

START TRANSACTION;

-- 1) Tạo trang nếu chưa có (gmt_offset của site = 0 nên post_date = UTC)
INSERT INTO `wp_posts` (
    `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`,
    `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`,
    `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`,
    `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`,
    `post_mime_type`, `comment_count`
)
SELECT
    1, UTC_TIMESTAMP(), UTC_TIMESTAMP(), '', 'Quà Tết',
    '', 'publish', 'closed', 'closed', '',
    'qua-tet', '', '', UTC_TIMESTAMP(), UTC_TIMESTAMP(),
    '', 0, '', 0, 'page',
    '', 0
FROM DUAL
WHERE NOT EXISTS (
    SELECT 1 FROM `wp_posts`
    WHERE `post_name` = 'qua-tet' AND `post_type` = 'page' AND `post_status` <> 'trash'
);

-- 2) Lấy ID trang
SET @tet_page_id := (
    SELECT `ID` FROM `wp_posts`
    WHERE `post_name` = 'qua-tet' AND `post_type` = 'page' AND `post_status` <> 'trash'
    ORDER BY `ID` LIMIT 1
);

-- 3) GUID theo chuẩn WordPress (chỉ khi còn trống)
UPDATE `wp_posts`
SET `guid` = CONCAT('https://tdhworld.com/?page_id=', @tet_page_id)
WHERE `ID` = @tet_page_id AND `guid` = '';

-- 4) Gán page template
DELETE FROM `wp_postmeta`
WHERE `post_id` = @tet_page_id AND `meta_key` = '_wp_page_template';

INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`)
VALUES (@tet_page_id, '_wp_page_template', 'tet-landing.php');

COMMIT;

-- 5) Kiểm tra kết quả
SELECT p.`ID`, p.`post_title`, p.`post_name`, p.`post_status`, m.`meta_value` AS `template`
FROM `wp_posts` p
LEFT JOIN `wp_postmeta` m ON m.`post_id` = p.`ID` AND m.`meta_key` = '_wp_page_template'
WHERE p.`ID` = @tet_page_id;

-- ------------------------------------------------------------------
-- ROLLBACK (nếu cần gỡ trang):
--   SET @tet_page_id := (SELECT ID FROM wp_posts WHERE post_name='qua-tet' AND post_type='page' LIMIT 1);
--   DELETE FROM wp_postmeta WHERE post_id = @tet_page_id;
--   DELETE FROM wp_posts    WHERE ID      = @tet_page_id;
-- ------------------------------------------------------------------
