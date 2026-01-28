<?php
$data = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Pendaftaran Mahasantri</title>

<style>
*{
    box-sizing:border-box;
    font-family:"Segoe UI",sans-serif;
}

body{
    margin:0;
    min-height:100vh;
    background:linear-gradient(120deg,#0f2027,#203a43,#2c5364);
    color:#fff;
    overflow:hidden;
    scroll-behavior:smooth;
}

/* ===== 3D BACKGROUND (UPGRADE HALUS) ===== */
.bg-3d{
    position:fixed;
    width:100%;
    height:100%;
    perspective:1000px;
    z-index:-1;
}
.cube{
    position:absolute;
    width:140px;
    height:140px;
    background:rgba(255,255,255,.08);
    border-radius:14px;
    transform-style:preserve-3d;
    animation:
        spin 40s linear infinite,
        float 8s ease-in-out infinite;
    box-shadow:
        0 0 30px rgba(0,255,255,.15),
        inset 0 0 25px rgba(255,255,255,.05);
    will-change:transform;
}
.cube:nth-child(1){top:12%;left:10%}
.cube:nth-child(2){top:65%;left:70%;animation-duration:55s}
.cube:nth-child(3){top:38%;left:45%;animation-duration:65s}

@keyframes spin{
    from{transform:rotateX(0) rotateY(0)}
    to{transform:rotateX(360deg) rotateY(360deg)}
}
@keyframes float{
    0%,100%{transform:translateY(0)}
    50%{transform:translateY(-22px)}
}

/* ===== CONTAINER ===== */
.container{
    width:760px;
    margin:70px auto;
    background:rgba(0,0,0,.6);
    padding:35px;
    border-radius:18px;
    backdrop-filter:blur(14px);
    box-shadow:
        0 30px 60px rgba(0,0,0,.45),
        inset 0 0 1px rgba(255,255,255,.2);
    animation:containerFade .6s ease;
}

@keyframes containerFade{
    from{opacity:0; transform:translateY(10px)}
    to{opacity:1; transform:translateY(0)}
}

h2{
    text-align:center;
    margin-bottom:28px;
    font-weight:600;
    letter-spacing:.6px;
}

/* ===== TABS ===== */
.tabs{
    display:flex;
    margin-bottom:25px;
    border-radius:12px;
    overflow:hidden;
}
.tabs button{
    flex:1;
    padding:15px;
    border:none;
    background:#2c5364;
    color:#fff;
    font-weight:600;
    cursor:pointer;
    letter-spacing:.4px;
    transition:background .35s, box-shadow .35s;
}
.tabs button.active{
    background:linear-gradient(90deg,#00c6ff,#0072ff);
    color:#000;
    box-shadow:0 0 20px rgba(0,198,255,.9);
}

/* ===== CONTENT ===== */
.tab-content{
    display:none;
    animation:fadeIn .45s ease;
}
.tab-content.active{display:block}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(10px)}
    to{opacity:1; transform:translateY(0)}
}

label{
    display:block;
    margin-top:14px;
    font-size:14px;
    letter-spacing:.3px;
}

input,select{
    width:100%;
    padding:12px;
    margin-top:6px;
    border-radius:9px;
    border:none;
    outline:none;
    transition:box-shadow .3s, transform .2s;
}

/* ✨ INPUT FOCUS PREMIUM */
input:focus,select:focus{
    box-shadow:0 0 0 2px rgba(0,198,255,.6);
    transform:translateY(-1px);
}

.radio-group{
    margin-top:8px;
}
.radio-group label{
    display:inline-block;
    margin-right:18px;
    font-weight:normal;
}

/* ===== BUTTON ===== */
button.submit{
    width:100%;
    margin-top:30px;
    padding:15px;
    background:linear-gradient(90deg,#00c6ff,#0072ff);
    border:none;
    border-radius:12px;
    font-weight:bold;
    font-size:15px;
    color:#fff;
    cursor:pointer;
    position:relative;
    overflow:hidden;
    transition:transform .2s, box-shadow .3s;
}

button.submit::after{
    content:"";
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,.35),
        transparent
    );
    transition:.6s;
}
button.submit:hover::after{
    left:100%;
}
button.submit:hover{
    transform:translateY(-2px);
    box-shadow:0 0 28px rgba(0,198,255,.8);
}
button.submit:active{
    transform:scale(.98);
}

/* ===== OUTPUT ===== */
.output{
    margin-top:22px;
    background:rgba(0,255,200,.18);
    padding:22px;
    border-radius:14px;
    border-left:5px solid #00ffcc;
    box-shadow:0 0 30px rgba(0,255,200,.25);
    animation:fadeIn .5s ease;
}
.output b{
    font-size:16px;
}
</style>
</head>

<body>

<!-- 3D BACKGROUND -->
<div class="bg-3d">
    <div class="cube"></div>
    <div class="cube"></div>
    <div class="cube"></div>
</div>

<div class="container">
<h2>Form Pendaftaran Mahasantri</h2>

<div class="tabs">
    <button class="active" onclick="openTab(0)">Form Pendaftaran</button>
    <button onclick="openTab(1)">Data Pendaftaran</button>
</div>

<form method="POST">

<!-- TAB 1 -->
<div class="tab-content active">
    <label>Nama Lengkap</label>
    <input type="text" name="nama" required>

    <label>NIM</label>
    <input type="text" name="nim" required>

    <label>Jenis Kelamin</label>
    <div class="radio-group">
        <label><input type="radio" name="jk" value="Laki-laki" required> Laki-laki</label>
        <label><input type="radio" name="jk" value="Perempuan"> Perempuan</label>
    </div>

    <label>Program Studi</label>
    <select name="prodi">
        <option>PPL</option>
        <option>DM</option>
    </select>

    <label>Hobi</label>
    <div class="radio-group">
        <label><input type="radio" name="hobi" value="Ngoding" required> Ngoding</label>
        <label><input type="radio" name="hobi" value="Desain"> Desain</label>
        <label><input type="radio" name="hobi" value="Membaca"> Membaca</label>
    </div>

    <button type="button" class="submit" onclick="openTab(1)">Lanjut</button>
</div>

<!-- TAB 2 -->
<div class="tab-content">
<?php if($data): ?>
    <div class="output">
        <b>Data Pendaftaran Mahasantri</b><br><br>
        Nama : <?= $_POST['nama'] ?><br>
        NIM : <?= $_POST['nim'] ?><br>
        Jenis Kelamin : <?= $_POST['jk'] ?><br>
        Program Studi : <?= $_POST['prodi'] ?><br>
        Hobi : <?= $_POST['hobi'] ?>
    </div>
<?php else: ?>
    <p style="text-align:center;opacity:.7">
        Silakan isi form terlebih dahulu.
    </p>
<?php endif; ?>

    <button type="submit" class="submit">Daftar</button>
</div>

</form>
</div>

<script>
function openTab(i){
    const tabs = document.querySelectorAll(".tabs button");
    const contents = document.querySelectorAll(".tab-content");

    tabs.forEach(t=>t.classList.remove("active"));
    contents.forEach(c=>c.classList.remove("active"));

    tabs[i].classList.add("active");
    contents[i].classList.add("active");
}
</script>

</body>
</html>
