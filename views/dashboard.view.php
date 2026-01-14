<?php include 'layout/header.php'; ?>

<div class="mt-5 text-center">
    <div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
        <h1 class="display-5 fw-bold">User Dashboard</h1>
        <p class="col-md-8 fs-4 mx-auto mt-4">
            Hello, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! 
            You have successfully logged in to the system.
        </p>
        <hr class="my-4">
        <p>My Account Page</p>
        <a href="logout" class="btn btn-danger btn-lg mt-3">Logout Now</a>
    </div>
</div>

<?php include 'layout/footer.php'; ?>