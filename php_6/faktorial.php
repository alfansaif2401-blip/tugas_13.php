<?php
function faktorial($angka){
    if ($angka < 2) {
        return 1;
    } else {
 // memanggil dirinya sendiri
        return ($angka * faktorial($angka-1));
    }
}

// memanggil fungsi
echo "faktorial 5 adalah " . faktorial(5);

echo"<br/>";
function pangkatDua($a){
    global $a;
    $a = $a * $a;
}
$a = 20;
echo 'sebelum nilai $a :'.$a;
pangkatDua($a);
echo '<br/>Sesudah nilai $a :'.$a;
?>

