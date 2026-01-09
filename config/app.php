<?php
declare(strict_types=1);

/**
 * 应用基础配置文件
 */
return [
    'app_name'    => 'Amalo Auth System',
    'base_url'    => 'http://localhost:8000',
    'env'         => 'development', // 可选：development, production
    
    // 安全相关配置
    'session_name' => 'AMALO_SESSION_ID',
    'password_min_length' => 6,
];