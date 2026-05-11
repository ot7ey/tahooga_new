<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mulai Kuis</title>
</head>
<body>

<h2>Masukkan Nama Kamu</h2>

<form action="index.php" method="POST">
    <input type="text" name="nama" required placeholder="Nama kamu">
    <button type="submit">Mulai</button>
</form>

</body>
</html>