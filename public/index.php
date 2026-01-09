<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Amalo\LoginSystem\Core\Session;
use Amalo\LoginSystem\Services\AuthService;

Session::start();

// 检查是否登录，未登录则跳转到登录页
if (!AuthService::isLoggedIn()) {
    header('Location: login');
    exit;
}

$pageTitle = "Dashboard";
include __DIR__ . '/../views/dashboard.view.php';