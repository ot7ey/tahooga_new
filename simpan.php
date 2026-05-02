<?php
include 'koneksi.php';

$nickname = $_POST['nickname'];
$skor     = $_POST['skor'];

$query = "INSERT INTO skor (nickname, skor) 
          VALUES ('$nickname', '$skor')";

mysqli_query($conn, $query);

header("Location: leaderboard.php");
?>