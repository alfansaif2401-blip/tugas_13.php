<?php
function cekKelulusan($nilai) {
    if ($nilai >= 75) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

// Contoh pemanggilan
echo "Hasil: " . cekKelulusan(80);
?>