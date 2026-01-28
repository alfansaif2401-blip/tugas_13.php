<?php
$graph = [
    "A" => ["B", "C"],
    "B" => [],
    "C" => []
];

// Menampilkan hubungan antar node
echo "Graph (Adjacency List):<br>";
foreach ($graph as $node => $connections) {
    echo $node . " terhubung ke: ";
    if (count($connections) > 0) {
        echo implode(", ", $connections);
    } else {
        echo "Tidak ada";
    }
    echo "<br>";
}
?>
