<?php
include '../config/koneksi.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

// ambil data dari form
$name = trim($_POST['name']);
$price = floatval($_POST['price']);
$description = trim($_POST['description']);
$stock = intval($_POST['stock']);
$category = $_POST['category'];

if ($name === '' || $price <= 0 || $description === '' || $stock < 0 || $category === '') {
    header("Location: ../index.php?status=invalid_input");
    exit();
}

// siapkan direktori
$targetDir = "../uploads/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// validasi file gambar
if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== 0) {
    header("Location: index.php?status=no_image");
    exit();
}

$fileName = basename($_FILES["image"]["name"]);
$fileSize = $_FILES["image"]["size"];
$fileTmp = $_FILES["image"]["tmp_name"];
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$allowedExt = ["jpeg", "jpg", "png", "gif"];

$back = $_SERVER['HTTP_REFERER'];

if (!in_array($fileExt, $allowedExt)) {
    header("Location: $back?status=invalid_ext");
    exit();
}

if ($fileSize > 2097152) {
    header("Location: $back?status=file_too_large");
    exit();
}

$finalName = uniqid() . '.' . $fileExt;
$uploadPath = $targetDir . $finalName;

if (!move_uploaded_file($fileTmp, $uploadPath)) {
    header("Location: $back?status=upload_fail");
    exit();
}


// insert ke database
$query = "INSERT INTO products (name, price, description, stock, image_url, category_id) VALUES ('$name', $price, '$description', $stock, '$finalName', '$category')";
$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: ../index.php?status=insert_success");
} else {
    if (file_exists($uploadPath)) unlink($uploadPath);
    echo mysqli_error($conn);
    // header("Location: ../index.php?status=insert_fail");
}

mysqli_close($conn);
