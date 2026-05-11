<?php
include "koneksi.php";
session_start();

$nama = $_SESSION['nama'];
$nama = $_POST['nama'];
$skor = $_SESSION['skor'];

mysqli_query($conn, "INSERT INTO skor (nama, skor) VALUES ('$nama', '$skor')");

echo "Skor berhasil disimpan!";
session_destroy();
?>