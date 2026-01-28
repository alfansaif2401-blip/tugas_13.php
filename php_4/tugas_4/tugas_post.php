<?php
$hasil = "";
$warna = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $matkul   = $_POST['matkul'];
    $nilai    = $_POST['nilai'];

    if ($nilai >= 75) {
        $hasil = "LULUS";
        $warna = "green";
    } else {
        $hasil = "TIDAK LULUS";
        $warna = "red";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Penilaian Mahasantri</title>
<style>
body{
    background:linear-gradient(120deg,#1e3c72,#2a5298);
    font-family:Segoe UI,sans-serif;
    color:#fff;
}
.container{
    width:420px;
    margin:60px auto;
    background:rgba(0,0,0,.6);
    padding:30px;
    border-radius:12px;
}
h2{text-align:center}
label{display:block;margin-top:12px}
input,select{
    width:100%;
    padding:10px;
    margin-top:5px;
    border-radius:6px;
    border:none;
}
button{
    width:100%;
    margin-top:20px;
    padding:12px;
    background:#00c6ff;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
}
.result{
    margin-top:25px;
    padding:15px;
    border-radius:8px;
    text-align:center;
    font-weight:bold;
}
</style>
</head>

<body>
<div class="container">
<h2>Form Penilaian Mahasantri</h2>

<form method="POST">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Mata Kuliah</label>
    <select name="matkul">
        <option>PPL</option>
        <option>DM</option>
    </select>

    <label>Nilai</label>
    <input type="number" name="nilai" min="0" max="100" required>

    <button type="submit">Proses Penilaian</button>
</form>

<?php if($hasil != ""): ?>
<div class="result" style="background:<?= $warna ?>">
    Username : <?= $username ?><br>
    Mata Kuliah : <?= $matkul ?><br>
    Nilai : <?= $nilai ?><br>
    Status : <?= $hasil ?>
</div>
<?php endif; ?>

</div>
</body>
</html>
