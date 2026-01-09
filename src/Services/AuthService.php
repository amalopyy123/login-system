<?php
declare(strict_types=1);

namespace Amalo\LoginSystem\Services;

use Amalo\LoginSystem\Models\User;
use Amalo\LoginSystem\Core\Session;

class AuthService
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * 注册逻辑
     */
    public function register(string $username, string $email, string $password): bool
    {
        // 检查用户是否已存在
        if ($this->userModel->findByEmail($email)) {
            throw new \Exception("Email already registered.");
        }

        // 密码加密 (注意：使用 password_hash)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->userModel->create($username, $email, $hashedPassword);
    }

    /**
     * 登录逻辑
     */
    public function login(string $email, string $password): bool
    {
        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // 登录成功
            Session::regenerate(); // 防御会话固定攻击
            Session::set('user_id', $user['id']);
            Session::set('username', $user['username']);
            return true;
        }

        return false;
    }

    /**
     * 检查是否已登录
     */
    public static function isLoggedIn(): bool
    {
        Session::start();
        return Session::get('user_id') !== null;
    }

    /**
     * 登出
     */
    public function logout(): void
    {
        Session::start();
        Session::destroy();
    }
}