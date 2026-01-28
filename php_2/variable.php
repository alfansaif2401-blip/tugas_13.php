<?php
// Menbuat Variabel baru
/*$harga1 = 1000;
$nama_barang = "kopi Robuasta";
$harga2 = 20000;
$stok = 30;*/

// Panggin nilai variabel
/*echo "harga 1 choki-choki = $harga1 </br>";
echo "Bayu membeli $nama_barang dengan harga $harga2 jumlah $stok pcs";*/

// function var_local()
// {
//     $angka = 11;
//     echo "Local Angka = $angka";
// }
//     var_local();


//     $angka = 12;
//     function var_global();


// function var_static()
// {
//     // definisi variabel
//     static $angka = 5;
//     $nomor = 2;

//     // penambahan variabel
//     $angka++;
//     $nomor++;

//     // output variabel
//     echo $angka, "<br>";
//     echo $nomor, "<br>";
// }

    // panggil fungsi
// var_static();
// var_static();


/*$makanan = ["Kebab", "Sate", "Bakso"];
echo "$makanan[0], $makanan[1], $makanan[2] <br>";

print_r($makanan);*/

class Salam
{
    var $hai;
}

// manbuat object hello, ini disebut instansiasi
$hello = new Salam();

// memberikan value untuk properti hai pada objek htmlspecialchars_decode
$hello->hai="hello world!";

// mencetak nilai
echo $hello->hai;

?>