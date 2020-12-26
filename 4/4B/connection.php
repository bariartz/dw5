<?php

$host = "127.0.0.1";
$username = "pokochan";
$password = "Bariarts9300!";
$database = "dwkloter5";
$conn = new mysqli($host, $username, $password, $database);

if($conn->connect_errno){
    echo die("Gagal terhubung ke MySQL: " . $conn->connect_errror);
}
