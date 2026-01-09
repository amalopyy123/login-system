<?php
// router.php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 1. 如果请求的是静态资源（图片、CSS、JS），直接返回 false，PHP 会自动处理
if (file_exists(__DIR__ . '/public' . $uri) && is_file(__DIR__ . '/public' . $uri)) {
    return false; 
}

// 2. 路由逻辑：把无后缀的 URL 映射到 .php 文件
// 例如：访问 /login -> 加载 public/login.php
$file = __DIR__ . '/public' . $uri . '.php';

if (file_exists($file)) {
    require $file;
    exit;
}

// 3. 如果直接请求根目录 / -> 加载 public/index.php
if ($uri === '/') {
    require __DIR__ . '/public/index.php';
    exit;
}

// 4. 404 处理
http_response_code(404);
echo "404 Not Found";