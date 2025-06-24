<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">User Panel</a>
            <div class="d-flex">
                <a href="cart.php" class="btn btn-light me-2">Keranjang</a>
                <a href="../../authentication/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>Selamat datang, <?= $_SESSION['username']; ?>!</h3>
        <p>Ini adalah halaman utama user.</p>
    </div>
</body>
</html>
