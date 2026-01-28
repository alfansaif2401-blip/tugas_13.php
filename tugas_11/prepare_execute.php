<?php
$host = "localhost";
$db   = "db_koperasi";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO jenis (nama_jenis) VALUES (:nama)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nama' => 'ELEKTRONIK'
    ]);

    echo "Data berhasil ditambahkan";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
