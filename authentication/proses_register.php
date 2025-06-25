<?php
session_start();
include '../config/koneksi.php';

// Pastikan akses hanya dari form POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Akses ditolak.";
    header("Location: ../pages/auth/register.php");
    exit;
}

// Ambil input dan sanitasi
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
    $_SESSION['error'] = "Password tidak cocok.";
    header("Location: ../pages/auth/register.php");
    exit;
}

// Cek apakah username sudah ada
$check_query = "SELECT * FROM users WHERE username = '$username'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    $_SESSION['error'] = "Username sudah digunakan.";
    header("Location: ../pages/auth/register.php");
    exit;
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$role = 'user'; // Default role

// Simpan ke database
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
?>
