<?php
session_start();

// amankan data
$jawaban_user = strtoupper(trim($_POST['jawaban'] ?? ''));
$jawaban_benar = strtoupper(trim($_SESSION['jawaban_benar'] ?? ''));

// inisialisasi biar gak error
$_SESSION['benar'] = $_SESSION['benar'] ?? 0;
$_SESSION['salah'] = $_SESSION['salah'] ?? 0;
$_SESSION['skor']  = $_SESSION['skor'] ?? 0;
$_SESSION['no_soal'] = $_SESSION['no_soal'] ?? 0;

// cek jawaban
if ($jawaban_user == $jawaban_benar) {
    $_SESSION['benar']++;
    $_SESSION['skor'] += 10;
    $pesan = "Benar! +10 🎉";
    $sound = "benar.mp3";
} else {
    $_SESSION['salah']++;
    $pesan = "Salah 😢";
    $sound = "salah.mp3";
}

// pindah soal
$_SESSION['no_soal']++;

// amankan soal_list
$total = (isset($_SESSION['soal_list']) && is_array($_SESSION['soal_list']))
    ? count($_SESSION['soal_list'])
    : 0;

// tentukan next page
$next = ($_SESSION['no_soal'] >= $total) ? "hasil.php" : "index.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil</title>
</head>
<body>

<h2><?= $pesan; ?></h2>
<p>Skor sementara: <?= $_SESSION['skor']; ?></p>

<audio autoplay>
    <source src="<?= $sound; ?>" type="audio/mpeg">
</audio>

<script>
setTimeout(() => {
    window.location.href = "<?= $next ?>";
}, 1200);
</script>

</body>
</html>