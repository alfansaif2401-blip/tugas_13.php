<?php
$queue = [];

// Enqueue
array_push($queue, "A");
array_push($queue, "B");
array_push($queue, "C");

// Dequeue
array_shift($queue);

// Menampilkan isi queue
echo "Isi Queue:<br>";
foreach ($queue as $data) {
    echo $data . "<br>";
}
?>
