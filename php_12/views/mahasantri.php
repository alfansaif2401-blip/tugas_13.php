<!DOCTYPE html>
<html>
<head>
    <title>Dashboard PeTIK</title>
</head>
<body>
    <h2>Dashboard Akademik PeTIK</h2>
    <ul>
        <li>Total Mahasantri : <?= $data['mahasantri']; ?></li>
        <li>Dosen IT : <?= $data['dosen_it']; ?></li>
        <li>Dosen Diniyah : <?= $data['dosen_diniyah']; ?></li>
        <li>Mata Kuliah : <?= $data['mk']; ?></li>
    </ul>

    <a href="?controller=mahasantri&action=index">Data Mahasantri</a>
</body>
</html>
