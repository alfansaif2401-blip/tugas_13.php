<?php
class TreeNode {
    public $data;
    public $left;
    public $right;

    public function __construct($data) {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
}

// Membuat tree
$root = new TreeNode("Root");
$root->left = new TreeNode("Child Kiri");
$root->right = new TreeNode("Child Kanan");

// Menampilkan data tree
echo "Data Binary Tree:<br>";
echo $root->data . "<br>";
echo $root->left->data . "<br>";
echo $root->right->data . "<br>";
?>
