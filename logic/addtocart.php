<?php
include '../config/koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product_id'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "Silakan login terlebih dahulu.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);

    // Cek apakah produk sudah ada di keranjang
    $cek = mysqli_query($conn, "SELECT * FROM carts WHERE user_id = $user_id AND product_id = $product_id");
    
    if (mysqli_num_rows($cek) > 0) {
        // Kalau sudah ada, update quantity
        mysqli_query($conn, "UPDATE carts SET quantity = quantity + 1, created_at = NOW() 
                             WHERE user_id = $user_id AND product_id = $product_id");
    } else {
        // Kalau belum ada, insert baru
        mysqli_query($conn, "INSERT INTO carts (user_id, product_id, quantity, created_at) 
                             VALUES ($user_id, $product_id, 1, NOW())");
    }

    echo "Produk berhasil ditambahkan ke keranjang.";
}
