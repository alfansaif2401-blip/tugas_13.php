<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Account Bank | 3D Professional</title>

<style>
/* ================= ROOT ================= */
:root{
    --primary:#1e3c72;
    --secondary:#2a5298;
    --accent:#00c6ff;
    --light:#ffffff;
    --glass:rgba(255,255,255,.18);
}

/* ================= BODY ================= */
body{
    margin:0;
    min-height:100vh;
    font-family:'Segoe UI',sans-serif;
    background:
        radial-gradient(circle at top, #2a5298, #1e3c72);
    color:#1c1c1c;
}

/* ================= NAVBAR ================= */
.navbar{
    padding:22px;
    text-align:center;
    color:#fff;
    font-size:22px;
    font-weight:600;
    letter-spacing:.5px;
    background:rgba(0,0,0,.25);
    backdrop-filter: blur(12px);
    box-shadow:0 15px 40px rgba(0,0,0,.35);
}

/* ================= CONTAINER ================= */
.wrapper{
    width:70%;
    margin:70px auto;
    perspective:1600px;
}

/* ================= 3D CARD ================= */
.card{
    background:var(--glass);
    backdrop-filter: blur(18px);
    border-radius:22px;
    padding:35px;
    box-shadow:
        0 30px 80px rgba(0,0,0,.35),
        inset 0 0 0 1px rgba(255,255,255,.2);
    transform-style:preserve-3d;
    animation: floatIn 1.2s ease;
    transition:.6s cubic-bezier(.25,.8,.25,1);
}

.card:hover{
    transform:
        rotateX(6deg)
        rotateY(-6deg)
        translateY(-14px);
}

/* ================= TABLE ================= */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:25px;
}

th,td{
    padding:16px;
    border-bottom:1px solid rgba(0,0,0,.1);
}

th{
    background:rgba(255,255,255,.6);
    font-weight:600;
}

/* ================= INPUT ================= */
input{
    width:100%;
    padding:14px;
    border-radius:14px;
    border:none;
    background:rgba(255,255,255,.9);
    font-size:15px;
    box-shadow:inset 0 2px 6px rgba(0,0,0,.15);
    transition:.35s;
}

input:focus{
    outline:none;
    transform:translateZ(18px);
    box-shadow:
        0 0 0 2px var(--accent),
        0 12px 25px rgba(0,0,0,.25);
}

/* ================= BUTTON ================= */
button{
    padding:14px 45px;
    border-radius:35px;
    border:none;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    color:#fff;
    background:linear-gradient(135deg,var(--accent),var(--secondary));
    box-shadow:0 15px 35px rgba(0,0,0,.35);
    transition:.45s;
}

button:hover{
    transform:translateY(-4px) scale(1.06);
    box-shadow:0 25px 50px rgba(0,0,0,.45);
}

/* ================= TITLES ================= */
h3{
    margin-top:45px;
    color:#1e3c72;
    letter-spacing:.4px;
}

/* ================= HIGHLIGHT ================= */
.final{
    font-weight:700;
    color:#0a8f6a;
    font-size:16px;
}

/* ================= ANIMATION ================= */
@keyframes floatIn{
    from{
        opacity:0;
        transform:translateY(60px) rotateX(25deg);
    }
    to{
        opacity:1;
        transform:none;
    }
}
</style>
</head>

<body>

<div class="navbar">
    💳 Account Bank Management System
</div>

<div class="wrapper">
<div class="card">

<!-- ================= FORM ================= -->
<form method="POST">
<table>
<tr>
    <td>Nomor Rekening</td>
    <td><input type="text" name="nomor" required></td>
</tr>
<tr>
    <td>Nama Customer</td>
    <td><input type="text" name="customer" required></td>
</tr>
<tr>
    <td>Saldo Awal</td>
    <td><input type="number" name="saldo_awal" required></td>
</tr>
<tr>
    <td>Input Saldo (Setoran)</td>
    <td><input type="number" name="setoran" required></td>
</tr>
<tr>
    <td colspan="2" align="center">
        <button type="submit">Proses Rekening</button>
    </td>
</tr>
</table>
</form>

<?php if(isset($_POST['nomor'])):
    $nomor = $_POST['nomor'];
    $customer = $_POST['customer'];
    $saldo_awal = $_POST['saldo_awal'];
    $setoran = $_POST['setoran'];
    $saldo_akhir = $saldo_awal + $setoran;
?>

<!-- ================= TABLE DATA ================= -->
<h3>📄 Data Rekening</h3>
<table>
<tr>
    <th>Nomor Rekening</th>
    <th>Nama Customer</th>
    <th>Saldo Awal</th>
</tr>
<tr>
    <td><?= $nomor ?></td>
    <td><?= $customer ?></td>
    <td>Rp <?= number_format($saldo_awal,0,',','.') ?></td>
</tr>
</table>

<!-- ================= TABLE RESULT ================= -->
<h3>📊 Hasil Transaksi</h3>
<table>
<tr>
    <th>Saldo Awal</th>
    <th>Saldo Setoran</th>
    <th>Saldo Akhir</th>
</tr>
<tr>
    <td>Rp <?= number_format($saldo_awal,0,',','.') ?></td>
    <td>Rp <?= number_format($setoran,0,',','.') ?></td>
    <td class="final">Rp <?= number_format($saldo_akhir,0,',','.') ?></td>
</tr>
</table>

<?php endif; ?>

</div>
</div>

</body>
</html>
