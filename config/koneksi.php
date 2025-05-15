<?php

$localhost = "localhost";
$username = "root";
$password = "123456";
$database = "simple_shop";

$con = mysqli_connect($localhost, $username, $password);

if(!$con) {
    die("Connection failed: " . mysqli_connect_error());
}