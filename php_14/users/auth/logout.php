<?php
session_start();
session_destroy();
header("Location: ../../users/auth/login.php");
exit;