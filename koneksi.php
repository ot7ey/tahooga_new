<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "tahoo_ga"; // ganti sesuai punyamu

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
