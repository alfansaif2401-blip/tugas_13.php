<?php
// membuat Fungsi
function perkenalan($nama, $salam){
    echo $salam.",";
    echo "perkenalkan, nama saya ".$nama."<br/>";
    echo "senang berkenalan dengan anda<br/>";
}

//memanggil fungsi yang sudah dibuat
perkenalan("usro", "Hai");

echo "<hr/>";

$saya = "bedu";
$ucapansalam = "Selamat pagi";

// memanggil lagi
perkenalan($saya, $ucapansalam);
?>