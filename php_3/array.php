<?php
$nilai = [80, 75, 90, 85, 70];

// Menampilkan isi array
echo "Isi Array Nilai:<br>";
foreach ($nilai as $n) {
    echo $n . "<br>";
}

// Menghitung total dan rata-rata
$total = array_sum($nilai);
$rata_rata = $total / count($nilai);

echo "<br>Total Nilai: $total";
echo "<br>Rata-rata Nilai: $rata_rata";
?>
