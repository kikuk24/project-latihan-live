<?php
$email = $_POST['email'];
$password = $_POST['password'];

include '../config/koneksi.php';

echo "Email: " . $email . "<br>";
echo "Password: " . $password . "<br>";