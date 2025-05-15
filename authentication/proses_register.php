<?php
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];

include '../config/koneksi.php';

echo "Nama: " . $nama . "<br>";
echo "Email: " . $email . "<br>";
echo "Password: " . $password . "<br>";