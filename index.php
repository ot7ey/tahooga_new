<?php

session_start();
// RESET TOTAL (buat debug / ulang dari awal)
if (isset($_GET['reset_all'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// INIT SESSION
if (!isset($_SESSION['level_done'])) $_SESSION['level_done'] = 0;
if (!isset($_SESSION['score'])) $_SESSION['score'] = 0;
if (!isset($_SESSION['q'])) $_SESSION['q'] = 0;

// SET NICKNAME
if (isset($_POST['nickname'])) {
    $_SESSION['nickname'] = $_POST['nickname'];
}

// START LEVEL
if (isset($_GET['start_level'])) {
    $_SESSION['q'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['current_level'] = $_GET['start_level'];
}

// DATA SOAL (LEVEL 1 CONTOH, TAMBAHIN SENDIRI)
$questions = [
    1 => [
        ["q"=>"Ibukota Indonesia?","a"=>["Jakarta","Bandung","Medan","Bali"],"c"=>0],
        ["q"=>"2+2=?","a"=>["3","4","5","6"],"c"=>1],
        ["q"=>"Makanan Khas Papua?","a"=>["Ikan masam","Telor Barendo","Bakmi Aceh","Papeda"],"c"=>3],
        ["q"=>"Kepala Sekolah SMK Telkom Purwokerto?","a"=>["Bp. Wiwid","Bp. Tata","Bp. Aris","Bp. Nandar"],"c"=>2],
        ["q"=>"Yang Termasuk Jurusan di Telkom?","a"=>["Teknik Mesin","Tata Boga","Akuntansi","RPL"],"c"=>1],
        ["q"=>"2+2=?","a"=>["3","4","5","6"],"c"=>1],
        ["q"=>"Siapa Mantan Justin Bieber","a"=>["Gigi Hadid","Billie Elish","Ariana Grande","Selena Gomez"],"c"=>3],
        ["q"=>"Ciri khas Presiden kita apa?","a"=>["Gemoy","Garang","Pemalu","Penakut"],"c"=>0],
    ],
];

// LEVEL AKTIF
$level = $_SESSION['current_level'] ?? null;

// HANDLE JAWABAN
if (isset($_POST['jawaban'])) {
    $data = $questions[$level][$_SESSION['q']];
    if ($_POST['jawaban'] == $data['c']) {
        $_SESSION['score'] += 10;
    }
    $_SESSION['q']++;
}

// CEK SELESAI
$done = false;
if ($level && $_SESSION['q'] >= count($questions[$level])) {
    $done = true;
    $_SESSION['level_done'] = max($_SESSION['level_done'], $level);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>TahooGa</title>
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
</head>

<body>

<div class="menu" onclick="location='?home=1'">☰</div>

<audio id="benar" src="benar.mp3"></audio>
<audio id="salah" src="salah.mp3"></audio>

<?php if (!isset($_SESSION['nickname'])): ?>

<h2>Masukkan Nickname</h2>
<form method="POST">
<input type="text" name="nickname" required>
<button type="submit">Start</button>
</form>

<?php elseif (!isset($_GET['start_level'])): ?>

<!-- HOME -->
<h2>Halo <?= $_SESSION['nickname']; ?></h2>

<div class="level" onclick="location='?start_level=1'">Level 1</div>

<div class="level <?= $_SESSION['level_done']<1?'lock':'' ?>"
onclick="<?= $_SESSION['level_done']<1?"alert('anda harus menyelesaikan level 1 dahulu')":"location='?start_level=2'" ?>">
Level 2
</div>

<div class="level <?= $_SESSION['level_done']<2?'lock':'' ?>"
onclick="<?= $_SESSION['level_done']<2?"alert('anda harus menyelesaikan level 2 dahulu')":"location='?start_level=3'" ?>">
Level 3
</div>

<?php else: ?>

<!-- LEVEL -->
<?php if (!$done): 
$data = $questions[$level][$_SESSION['q']];
?>

<h2><?= $data['q']; ?></h2>

<form method="POST" id="form">
<input type="hidden" name="jawaban" id="jawaban">

<div class="grid">
<?php foreach($data['a'] as $i=>$opsi): ?>
<div class="card" onclick="jawab(this,<?= $i ?>,<?= $i==$data['c']?'true':'false' ?>)">
<?= $opsi ?>
</div>
<?php endforeach; ?>
</div>
</form>

<?php else: ?>

<!-- RESULT -->
<div class="result">
<h2>Level <?= $level ?> Selesai</h2>
<h1><?= $_SESSION['score']; ?></h1>

<button onclick="location='?home=1'">Home</button>
<button onclick="location='?start_level=<?= $level+1 ?>'">Next</button>
</div>

<?php endif; ?>

<?php endif; ?>

</body>
</html>