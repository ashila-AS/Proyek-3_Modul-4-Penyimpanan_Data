<?php
session_start();
require 'koneksi.php';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true); 
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama_lengkap'];
        header('Location: dashboard.php');
    exit;
    }
    
    $error = 'Username atau password salah.';
}

?>
<!DOCTYPE html>
<html lang="id">
    <head><meta charset="UTF-8"><title>Login</title></head>
    <body>
        <h1>Login</h1>
        <?php if ($error): ?>
        <p style="color:red"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post">
            <p><input type="text" name="username" placeholder="Username" required></p>
            <p><input type="password" name="password" placeholder="Password" required></p>
            <button type="submit">Masuk</button>
        </form>
    </body>
</html>