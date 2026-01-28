<?php
class Mahasiswa {
    public $nama;

    public function tampilkanNama() {
        echo "Nama Mahasiswa: " . $this->nama;
    }
}

// Membuat 1 objek
$mhs = new Mahasiswa();
$mhs->nama = "Alfan";
$mhs->tampilkanNama();
?>
