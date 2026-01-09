<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Amalo\LoginSystem\Core\Session;
use Amalo\LoginSystem\Services\AuthService;
use Amalo\LoginSystem\Utils\Validator;

Session::start();

// 如果已经登录，直接跳到首页
if (AuthService::isLoggedIn()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. 获取输入数据
    $data = [
        'username'         => trim($_POST['username'] ?? ''),
        'email'            => trim($_POST['email'] ?? ''),
        'password'         => $_POST['password'] ?? '',
        'confirm_password' => $_POST['confirm_password'] ?? '',
    ];

    // 2. 验证输入
    $errors = Validator::validateRegistration($data);
    $oldInput = $data; // 保存输入的数据，用于回显

    if (empty($errors)) {
        try {
            $authService = new AuthService();
            // ... 注册成功逻辑 ...
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }

    // 如果校验通过，尝试数据库注册
    if (empty($errors)) {
        try {
            $authService = new AuthService();
            if ($authService->register($data['username'], $data['email'], $data['password'])) {
                Session::set('success', "Registration successful! Please login.");
                // 注册成功，一定要清除旧输入，防止干扰
                Session::remove('old_input'); 
                header('Location: login.php');
                exit;
            }
        } catch (Exception $e) {
            // 捕获“邮箱已存在”等业务异常
            $errors[] = $e->getMessage();
        }
    }

    // 3. --- 关键修改：如果有错误，保存旧输入到 Session ---
    if (!empty($errors)) {
        Session::set('error', implode('<br>', $errors));
        
        // 保存用户填写的 username 和 email (千万不要保存 password！)
        Session::set('old_input', [
            'username' => $data['username'],
            'email'    => $data['email']
        ]);

        header('Location: register.php'); // PRG 重定向
        exit;
    }
}

$pageTitle = "Register";
include __DIR__ . '/../views/register.view.php';
