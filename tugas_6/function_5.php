<?php
function hitungTotalNilai($nilai) {
    $total = 0;
    foreach ($nilai as $n) {
        $total += $n;
    }
    return $total;
}

// Data array
$daftarNilai = [10, 20, 30, 40];

// Memanggil fungsi
echo "Total Nilai: " . hitungTotalNilai($daftarNilai);
?>