<?php
class Node {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

// Membuat node
$node1 = new Node(10);
$node2 = new Node(20);
$node3 = new Node(30);

// Menghubungkan node
$node1->next = $node2;
$node2->next = $node3;

// Menampilkan isi linked list
$current = $node1;
echo "Isi Single Linked List:<br>";
while ($current != null) {
    echo $current->data . "<br>";
    $current = $current->next;
}
?>
