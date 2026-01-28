<?php
$host = "localhost";
$db   = "db_koperasi";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE jenis (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nama_jenis VARCHAR(50) NOT NULL
            )";

    $pdo->exec($sql);
    echo "Tabel jenis berhasil dibuat";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
