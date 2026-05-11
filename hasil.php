<?php
session_start();
?>

<h2>Hasil Kuis 🎉</h2>

<p>Nama: <?= $_SESSION['nama']; ?></p>
<p>Benar: <?= $_SESSION['benar']; ?></p>
<p>Salah: <?= $_SESSION['salah']; ?></p>
<p>Skor: <?= $_SESSION['skor']; ?></p>

<form action="reset.php" method="POST">
    <button type="submit">Ulangi Kuis 🔁</button>
</form>