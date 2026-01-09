<?php
declare(strict_types=1);

namespace Amalo\LoginSystem\Utils;

class Validator
{
    public static function validateRegistration(array $data): array
    {
        $errors = [];

        // 用户名验证
        if (empty($data['username']) || strlen($data['username']) < 3) {
            $errors[] = "Username must be at least 3 characters.";
        }

        // 邮箱验证
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        // 密码基本长度验证
        if (empty($data['password']) || strlen($data['password']) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        }

        // preg_match('/\D/', ...) 检查是否包含至少一个“非数字”字符
        if (!preg_match('/\D/', $data['password'])) {
            $errors[] = "Password cannot be purely numeric. Please include letters or symbols.";
        }

        // 确认密码验证
        if ($data['password'] !== ($data['confirm_password'] ?? '')) {
            $errors[] = "Passwords do not match.";
        }

        return $errors;
    }
}