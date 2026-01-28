<?php
// Start session jika diperlukan
// session_start();

include_once 'views/layout/header.php';
include_once 'views/layout/sidebar.php';

// Router
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch($page) {
    case 'mahasiswa':
        include 'controllers/MahasiswaController.php';
        break;
    case 'home':
    default:
        include 'home.php';
        break;
}

include_once 'views/layout/footer.php';
?>
<?php
$page = $_GET['page'] ?? 'dashboard';

$allowed_pages = [
    'dashboard',
    'mahasiswa',
    'dosen'
];

if (in_array($page, $allowed_pages)) {
   
} else {
    include "pages/404.php";
}
?>