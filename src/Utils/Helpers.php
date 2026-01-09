<?php
declare(strict_types=1);

namespace Amalo\LoginSystem\Utils;

class Helpers
{
    /**
     * 安全输出 HTML
     */
    public static function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * 简单的重定向逻辑
     */
    public static function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }
}