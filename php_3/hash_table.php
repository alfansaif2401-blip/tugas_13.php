<?php
$hashTable = [
    "231001" => "Ahmad Fauzi",
    "231002" => "Siti Aisyah",
    "231003" => "Moh Alfan Syaifullah"
];

// Menampilkan seluruh data
echo "Data Mahasantri:<br>";
foreach ($hashTable as $nim => $nama) {
    echo "NIM: $nim | Nama: $nama<br>";
}
?>
