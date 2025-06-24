<?php
session_start();
include '../config/koneksi.php';

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input dari form dan filter untuk mencegah XSS
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "Semua kolom harus diisi.";
        header("Location: ../pages/auth/register.php");
        exit;
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Password dan konfirmasi password tidak cocok.";
        header("Location: ../pages/auth/register.php");
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user'; // default role

    // Masukkan ke database
    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: ../pages/auth/login.php");
        exit;
    } else {
        $_SESSION['error'] = "Pendaftaran gagal: " . mysqli_error($conn);
        header("Location: ../pages/auth/register.php");
        exit;
    }
} else {
    // Jika akses langsung ke file ini tanpa POST
    header("Location: ../pages/auth/register.php");
    exit;
}
?>