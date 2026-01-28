<?php
$nilai = 70;
if($nilai > 60){
    echo 'Lulus';
} else{
    echo 'mengulang';
}
?>
<br>

<?php
// Struktur Else If
$teman = "Alafan";
if($teman == "Alfan"){
    echo "Dia adalah teman saya";
}   else{
    echo "Dia bukan teman saya";
}
?>
<br>

<?php
$nilai = 90;
if($nilai <= 60){
      echo'nilai cukup';
}   elseif ($nilai <=75) {
      echo 'nilai baik';
}   elseif ($nilai >= 85) {
      echo 'nilai sangat baik';
}   else {
      echo 'nilai kurang';
}
?>