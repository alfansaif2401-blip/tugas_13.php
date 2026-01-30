<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: ../../index.php");
    exit;
}

$error = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // USER HARDCODE (sementara, aman buat development)
    $users = [
        'admin' => [
            'password' => 'admin',
            'role' => 'admin'
        ],
        'petugas' => [
            'password' => 'petugas',
            'role' => 'petugas'
        ]
    ];

    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];

        header("Location: ../../index.php");
        exit;
    } else {
        $error = 'Username atau password salah';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login | App Tamu</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

body {
    margin: 0;
    height: 100vh;
    background: linear-gradient(135deg, #2563eb, #1e40af);
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-wrapper {
    width: 100%;
    max-width: 380px;
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 20px 40px rgba(0,0,0,.2);
    animation: slideUp .5s ease;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-wrapper h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #1e3a8a;
}

.form-group {
    margin-bottom: 18px;
    position: relative;
}

.form-group input {
    width: 100%;
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid #cbd5f5;
    font-size: 14px;
    outline: none;
    transition: .2s;
}

.form-group input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,.15);
}

.toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 13px;
    color: #2563eb;
}

button {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: none;
    background: #2563eb;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: .3s;
}

button:hover {
    background: #1e40af;
}

.error {
    background: #fee2e2;
    color: #991b1b;
    padding: 10px;
    border-radius: 6px;
    text-align: center;
    margin-bottom: 15px;
    font-size: 14px;
}

.footer-text {
    text-align: center;
    margin-top: 18px;
    font-size: 12px;
    color: #64748b;
}
</style>
</head>

<body>

<div class="login-wrapper">
    <h2>🔐 Login Sistem</h2>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required autofocus>
        </div>

        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword()">👁️</span>
        </div>

        <button type="submit" name="login">Masuk</button>
    </form>

    <div class="footer-text">
        © <?= date('Y') ?> App Tamu — Secure Login
    </div>
</div>

<script>
function togglePassword() {
    const pass = document.getElementById('password');
    pass.type = pass.type === 'password' ? 'text' : 'password';
}
</script>

</body>
</html>