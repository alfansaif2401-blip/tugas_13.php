<?php
class PersegiPanjang {
    public $panjang;
    public $lebar;

    public function hitungLuas() {
        return $this->panjang * $this->lebar;
    }
}

// Membuat objek
$pp = new PersegiPanjang();
$pp->panjang = 10;
$pp->lebar = 5;

echo "Luas Persegi Panjang: " . $pp->hitungLuas();
?>
