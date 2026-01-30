<?php
function auth_login()
{
    if (!isset($_SESSION['login'])) {
        header("Location: " . BASE_URL . "/users/auth/login.php");
        exit;
    }
}