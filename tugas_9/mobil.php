<?php
class Mobil {
    public $merk;

    public function infoMobil() {
        echo "Merk Mobil: " . $this->merk . "<br>";
    }
}

// Membuat 2 objek Mobil
$mobil1 = new Mobil();
$mobil1->merk = "Toyota";

$mobil2 = new Mobil();
$mobil2->merk = "Honda";

// Menampilkan informasi
$mobil1->infoMobil();
$mobil2->infoMobil();
?>
