<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Amalo\LoginSystem\Services\AuthService;

$authService = new AuthService();
$authService->logout();

// 退出后跳转到登录页，并带上成功提示
session_start();
$_SESSION['success'] = "You have been logged out.";
header('Location: login');
exit;