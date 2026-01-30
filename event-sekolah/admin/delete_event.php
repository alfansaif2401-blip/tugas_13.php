<?php
session_start();
require_once '../config.php';

if (!is_logged_in() || !is_admin()) {
    redirect('../index.php');
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Cek apakah event ada
$check_query = "SELECT * FROM events WHERE id = $id";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) === 0) {
    redirect('dashboard.php');
}

// Hapus event
$delete_query = "DELETE FROM events WHERE id = $id";
if (mysqli_query($conn, $delete_query)) {
    $_SESSION['delete_success'] = true;
} else {
    $_SESSION['delete_error'] = true;
}

redirect('dashboard.php');
?>
