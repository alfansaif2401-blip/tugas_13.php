<?php
function hitungLuasPersegi($sisi) {
    $luas = $sisi * $sisi;
    return $luas;
}

// Memanggil dan menampilkan hasil return
echo "Luas Persegi: " . hitungLuasPersegi(5);
?>