<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Amalo\LoginSystem\Core\Session;
use Amalo\LoginSystem\Services\AuthService;

Session::start();

if (AuthService::isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $authService = new AuthService();
    
    if ($authService->login($email, $password)) {
        // 登录成功，跳转到首页
        header('Location: index.php');
        exit;
    } else {
        Session::set('error', "Invalid email or password.");
        header('Location: login.php'); // PRG 模式：重定向防止重复提交
        exit;
    }
}

$pageTitle = "Login";
include __DIR__ . '/../views/login.view.php';