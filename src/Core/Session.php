<?php
declare(strict_types=1);

namespace Amalo\LoginSystem\Core;

class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            // 设置安全的 Cookie 属性
            session_start([
                'cookie_httponly' => true, // 防止 JS 读取 Cookie (防御 XSS)
                'cookie_secure'   => false, // 如果是 HTTPS，请设置为 true
                'use_strict_mode' => true,
            ]);
        }
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        session_destroy();
        $_SESSION = [];
    }

    /**
     * 防御 Session 固定攻击：在登录成功后重新生成 ID
     */
    public static function regenerate(): void
    {
        session_regenerate_id(true);
    }
}