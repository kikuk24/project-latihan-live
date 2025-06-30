<?php
session_start();
require_once 'C:/wamp64/www/PROJECT-LATIHAN-LIVE/config/koneksi.php';

// Cek apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Akses tidak sah'); window.history.back();</script>";
    exit;
}

// Ambil data dari form
$email = $conn->real_escape_string($_POST['email'] ?? '');
$password = $conn->real_escape_string($_POST['password'] ?? '');

// Validasi input
if (empty($email) || empty($password)) {
    echo "<script>alert('Email dan password harus diisi'); window.history.back();</script>";
    exit;
}

// Query untuk mencari admin berdasarkan email
$sql = "SELECT id, name, email, password FROM admins WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Query gagal diproses: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Email tidak ditemukan'); window.history.back();</script>";
    $stmt->close();
    $conn->close();
    exit;
}

$admin = $result->fetch_assoc();

// Verifikasi password
if (!password_verify($password, $admin['password'])) {
    echo "<script>alert('Password salah'); window.history.back();</script>";
    $stmt->close();
    $conn->close();
    exit;
}

// Jika berhasil, simpan session dan arahkan ke dashboard admin
$_SESSION['admin_id'] = $admin['id'];
$_SESSION['admin_name'] = htmlspecialchars($admin['name']);
$_SESSION['role'] = 'admin';

$stmt->close();
$conn->close();

// 🔥 Redirect ke halaman index admin
header("Location: ../pages/admin/index.php");
exit;