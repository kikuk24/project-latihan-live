<?php 

$localhost = "localhost";
$username = "root";
$password = "";
$database = "simple_comerce";

$con = mysqli_connect($localhost, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}