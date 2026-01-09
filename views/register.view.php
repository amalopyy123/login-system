<?php
include 'layout/header.php';

// --- 获取旧输入数据，取完后立即清理 Session，实现“一次性”效果 ---
$oldInput = $_SESSION['old_input'] ?? [];
// 如果使用了 Session::get() 封装类，也可以用 Session::remove('old_input')
unset($_SESSION['old_input']);
?>

<div class="row justify-content-center">
    <div class="col-md-6 auth-card">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Create Account</h3>

                <!-- 增加 id 方便 JS 获取 -->
                <form id="registerForm" action="register" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <!-- 关键点：value 属性回填，并使用 htmlspecialchars 防御 XSS -->
                        <input type="text"
                            name="username"
                            id="username"
                            class="form-control"
                            value="<?php echo htmlspecialchars($oldInput['username'] ?? ''); ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <!-- 关键点：value 属性回填 -->
                        <input type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            value="<?php echo htmlspecialchars($oldInput['email'] ?? ''); ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <div class="form-text">Min 6 chars, cannot be only numbers.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    </div>

                    <!-- 错误提示容器 -->
                    <div id="jsError" class="alert alert-danger d-none"></div>

                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                </form>

                <div class="mt-3 text-center">
                    <a href="login">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 前端校验脚本 -->
<script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const errorDiv = document.getElementById('jsError');

        let errors = [];

        // 1. 长度校验
        if (username.length < 3) errors.push("Username is too short.");
        if (password.length < 6) errors.push("Password must be at least 6 characters.");

        // 2. 纯数字校验 (正则表达式: /^\d+$/ 表示全数字)
        if (/^\d+$/.test(password)) {
            errors.push("Password cannot be only numbers.");
        }

        // 3. 两次密码一致性
        if (password !== confirmPassword) {
            errors.push("Passwords do not match.");
        }

        // 如果有错误，阻止提交
        if (errors.length > 0) {
            e.preventDefault(); // 关键：阻止表单发送到后端
            errorDiv.innerHTML = errors.join('<br>');
            errorDiv.classList.remove('d-none');
            window.scrollTo(0, 0);
        }
    });
</script>

<?php include 'layout/footer.php'; ?>