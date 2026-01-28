<?php
$host = "localhost";
$db   = "db_koperasi";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM jenis";
    $result = $pdo->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Jenis: " . $row['nama_jenis'] . "<br><br>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
