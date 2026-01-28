<?php
$stack = [];

// Push data
array_push($stack, 10);
array_push($stack, 20);
array_push($stack, 30);

// Pop data teratas
array_pop($stack);

// Menampilkan isi stack
echo "Isi Stack:<br>";
foreach ($stack as $data) {
    echo $data . "<br>";
}
?>
