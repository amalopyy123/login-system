<?php include 'layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 auth-card">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Login</h3>
                <form action="login" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Login</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="register">Need an account? Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>