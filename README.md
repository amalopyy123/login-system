## 📥 安装与运行 (Installation)

### 1. 克隆项目
```bash
git clone https://github.com/amalopyy123/login-system.git
cd [仓库名]
```

### 2. 安装依赖
```bash
composer install
```

### 3. 数据库配置
1. 登录 MySQL 创建数据库：
   ```sql
   CREATE DATABASE auth_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
2. 导入数据表结构：
   将项目根目录下的 `schema.sql` 导入数据库。

3. 配置连接信息：
   复制配置文件模板：
   ```bash
   cp config/database.php.example config/database.php
   ```
   编辑 `config/database.php`，填入你的数据库主机、用户名和密码。

### 4. 启动服务
本项目内置了 PHP 开发服务器的启动指令，直接运行：

```bash
# 将 public 目录作为 Web 根目录
php -S 127.0.0.1:8000 router.php
```

### 5. 访问
打开浏览器访问：[http://localhost:8000](http://localhost:8000)

---

## 📂 目录结构 (Directory Structure)

```text
├── config/             # 配置文件
├── public/             # Web 入口 (只有此目录对外公开)
│   ├── index.php       # 路由分发
│   └── assets/         # 静态资源
├── src/                # 核心代码 (PSR-4 App\)
│   ├── Core/           # 基础设施 (Database, Session)
│   ├── Models/         # 数据模型 (User)
│   ├── Services/       # 业务逻辑 (AuthService)
│   └── Utils/          # 工具类 (Validator)
├── views/              # 视图文件 (HTML/PHP Templates)
├── vendor/             # Composer 依赖
├── schema.sql          # 数据库建表脚本
└── README.md           # 项目文档
```

## 📝 开发者说明

为了解决 MySQL 旧版本索引长度限制问题，`email` 字段长度被设定为 `191` 或使用了 `ROW_FORMAT=DYNAMIC`，确保兼容 `utf8mb4` 字符集。


