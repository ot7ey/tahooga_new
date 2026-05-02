<?php
include 'koneksi.php';

$query = "SELECT * FROM skor 
          ORDER BY skor DESC 
          LIMIT 10";

$result = mysqli_query($conn, $query);
?>

<h2>Leaderboard TahooGa 🏆</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Rank</th>
    <th>Nickname</th>
    <th>Skor</th>
    <th>Waktu</th>
</tr>

<?php 
$rank = 1;
while($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?= $rank++; ?></td>
    <td><?= $row['nickname']; ?></td>
    <td><?= $row['skor']; ?></td>
    <td><?= $row['created_at']; ?></td>
</tr>
<?php } ?>

</table>