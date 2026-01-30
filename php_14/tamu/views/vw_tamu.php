<?php
// ==================
// DATA DARI CONTROLLER
// ==================
$mode = $_GET['mode'] ?? null;
$id   = $_GET['id']   ?? null;
$data = null;

if (($mode === 'detail' || $mode === 'edit') && $id) {
    $data = $this->model->find($id);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen Tamu</title>

<!-- FONT AWESOME -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f8;
    margin:0;
}
.header{
    background:#0d6efd;
    color:#fff;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.container{
    max-width:1100px;
    margin:auto;
    padding:30px;
}
.card{
    background:#fff;
    padding:20px;
    border-radius:6px;
}
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
}
th{
    background:#0d6efd;
    color:#fff;
}
.btn{
    padding:7px 12px;
    border-radius:4px;
    color:#fff;
    text-decoration:none;
    border:none;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    gap:6px;
    font-size:14px;
}
.primary{background:#0d6efd;}
.success{background:#198754;}
.warning{background:#ffc107;color:#000;}
.danger{background:#dc3545;}
.secondary{background:#6c757d;}

.overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.55);
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:999;
}
.modal{
    background:#fff;
    width:500px;
    max-width:90%;
    padding:25px;
    border-radius:8px;
    animation:zoom .25s ease;
}
@keyframes zoom{
    from{transform:scale(.9);opacity:0}
    to{transform:scale(1);opacity:1}
}
.modal input{
    width:100%;
    padding:10px;
    margin-bottom:12px;
}
.modal-footer{
    text-align:right;
    margin-top:10px;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <h3><i class="fa-solid fa-users"></i> Manajemen Tamu</h3>
    <a href="<?= BASE_URL ?>/users/auth/logout.php" class="btn danger">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
</div>

<div class="container">
<div class="card">

<a href="index.php?page=tamu&mode=tambah" class="btn primary">
    <i class="fa-solid fa-plus"></i> Tambah Tamu
</a>

<br><br>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($r = $tamu->fetch_assoc()): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($r['nama']) ?></td>
    <td><?= htmlspecialchars($r['alamat']) ?></td>
    <td>

        <!-- DETAIL -->
        <a href="index.php?page=tamu&mode=detail&id=<?= $r['id'] ?>"
           class="btn secondary" title="Detail">
           <i class="fa-solid fa-eye"></i>
        </a>

        <!-- EDIT -->
        <a href="index.php?page=tamu&mode=edit&id=<?= $r['id'] ?>"
           class="btn warning" title="Edit">
           <i class="fa-solid fa-pen-to-square"></i>
        </a>

        <!-- HAPUS (ADMIN ONLY) -->
        <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="index.php?page=tamu&action=hapus&id=<?= $r['id'] ?>"
           class="btn danger"
           title="Hapus"
           onclick="return confirm('Yakin hapus data?')">
           <i class="fa-solid fa-trash"></i>
        </a>
        <?php endif; ?>

    </td>
</tr>
<?php endwhile; ?>
</table>

</div>
</div>

<!-- ================= MODAL ================= -->
<?php if ($mode): ?>
<div class="overlay">
<div class="modal">

<?php if ($mode === 'tambah'): ?>
<h3><i class="fa-solid fa-user-plus"></i> Tambah Tamu</h3>
<form method="post" action="index.php?page=tamu&action=store">
    <input name="nama" placeholder="Nama" required>
    <input name="alamat" placeholder="Alamat" required>
    <div class="modal-footer">
        <button class="btn primary">
            <i class="fa-solid fa-save"></i> Simpan
        </button>
        <a href="index.php?page=tamu" class="btn secondary">Batal</a>
    </div>
</form>

<?php elseif ($mode === 'detail'): ?>
<h3><i class="fa-solid fa-user"></i> Detail Tamu</h3>
<p><b>ID:</b> <?= $data['id'] ?></p>
<p><b>Nama:</b> <?= htmlspecialchars($data['nama']) ?></p>
<p><b>Alamat:</b> <?= htmlspecialchars($data['alamat']) ?></p>
<div class="modal-footer">
    <a href="index.php?page=tamu&mode=edit&id=<?= $data['id'] ?>"
       class="btn warning">
       <i class="fa-solid fa-pen"></i> Edit
    </a>
    <a href="index.php?page=tamu" class="btn secondary">Tutup</a>
</div>

<?php elseif ($mode === 'edit'): ?>
<h3><i class="fa-solid fa-pen-to-square"></i> Edit Tamu</h3>
<form method="post" action="index.php?page=tamu&action=update">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <input name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
    <input name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" required>
    <div class="modal-footer">
        <button class="btn success">
            <i class="fa-solid fa-check"></i> Update
        </button>
        <a href="index.php?page=tamu" class="btn secondary">Batal</a>
    </div>
</form>
<?php endif; ?>

</div>
</div>
<?php endif; ?>

</body>
</html>