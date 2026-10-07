<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="id">
    <head><meta charset="UTF-8"><title>Dashboard</title></head>
    <body>
        <h1>Selamat datang, <?= htmlspecialchars($_SESSION['nama']) ?>!</h1>
        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <a href="logout.php">Logout</a>
    </body>
</html>
