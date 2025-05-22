<?php

include '../config/koneksi.php';
// Cek apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan bersihkan input
    $name     = mysqli_real_escape_string($conn, $_POST["nama"]);
    $email    = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Validasi input
    if (empty($name) || empty($email) || empty($password)) {
        echo "Semua field wajib diisi.";    
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Format email tidak valid.";
        exit;
    }

    // Cek apakah email sudah terdaftar
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "Email sudah terdaftar.";
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Simpan ke database
    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

    if (mysqli_query($conn, $query)) {
        echo "Registrasi berhasil!";
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
