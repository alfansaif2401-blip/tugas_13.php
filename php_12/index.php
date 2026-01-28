<?php
// index.php HANYA UNTUK ROUTING

$controller = $_GET['controller'] ?? 'dashboard';
$action     = $_GET['action'] ?? 'index';

$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . "/controllers/$controllerName.php";

if (!file_exists($controllerFile)) {
    die("Controller tidak ditemukan");
}

require_once $controllerFile;

$ctrl = new $controllerName();

if (!method_exists($ctrl, $action)) {
    die("Method tidak ditemukan");
}

$ctrl->$action();
