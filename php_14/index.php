<?php
session_start();

define('BASE_PATH', __DIR__);
define('BASE_URL', '/Gen_4/php_14');

require BASE_PATH . '/config/database.php';
require BASE_PATH . '/helpers/auth.php';

$page   = $_GET['page']   ?? 'tamu';
$action = $_GET['action'] ?? 'index';

switch ($page) {
    case 'tamu':
    default:
        require BASE_PATH . '/tamu/controllers/TamuController.php';
        $controller = new TamuController();
        break;
}

if (!method_exists($controller, $action)) {
    die('Action tidak ditemukan');
}

$controller->$action();