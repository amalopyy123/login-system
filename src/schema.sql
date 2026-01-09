-- 创建数据库
-- CREATE DATABASE IF NOT EXISTS `auth_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- USE `auth_db`;

-- 创建用户表
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL COMMENT '用户名',
    `email` VARCHAR(191) NOT NULL COMMENT '唯一邮箱',
    `password` VARCHAR(255) NOT NULL COMMENT 'bcrypt加密后的哈希值',
    `status` TINYINT(1) DEFAULT 1 COMMENT '状态: 1=正常, 0=禁用',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    
    -- 索引优化
    UNIQUE KEY `uk_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 提示：使用 utf8mb4 字符集是为了完美支持各种字符及表情符号，避免旧版 utf8 的安全坑。
-- 提示：password 长度给 255 是为了兼容未来更长的哈希算法（如 Argon2）。