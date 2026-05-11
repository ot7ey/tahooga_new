<?php
session_start();
include "koneksi.php";

// simpan nama
if (isset($_POST['nama'])) {
    $_SESSION['nama'] = $_POST['nama'];
}

// ambil semua soal sekali
if (!isset($_SESSION['soal_list'])) {
    $result = mysqli_query($conn, "SELECT * FROM soal");

    $soal_list = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $soal_list[] = $row;
    }

    $_SESSION['soal_list'] = $soal_list;
    $_SESSION['no_soal'] = 0;
    $_SESSION['skor'] = 0;
    $_SESSION['benar'] = 0;
    $_SESSION['salah'] = 0;
}

// cek kalau soal sudah habis
if ($_SESSION['no_soal'] >= count($_SESSION['soal_list'])) {
    header("Location: hasil.php");
    exit;
}

// ambil soal sekarang
$no = $_SESSION['no_soal'];
$soal = $_SESSION['soal_list'][$no];

// simpan jawaban benar
$_SESSION['jawaban_benar'] = $soal['jawaban_benar'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kuis</title>
</head>
<body>

<h3>Player: <?= $_SESSION['nama']; ?></h3>

<h3>Soal <?= $no + 1; ?></h3>
<p><?= $soal['soal']; ?></p>

<form action="cek.php" method="POST">
    <input type="radio" name="jawaban" value="A"> <?= $soal['jawaban1']; ?><br>
    <input type="radio" name="jawaban" value="B"> <?= $soal['jawaban2']; ?><br>
    <input type="radio" name="jawaban" value="C"> <?= $soal['jawaban3']; ?><br>
    <input type="radio" name="jawaban" value="D"> <?= $soal['jawaban4']; ?><br><br>

    <button type="submit">Jawab</button>
</form>

</body>
</html>