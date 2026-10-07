<?php

if (isset($_POST['nama']) && trim($_POST['nama']) !== '') {
 setcookie('nama', trim($_POST['nama']), time() + (86400 * 7), '/');
 header('Location: cookie_dasar.php');
 exit;
}

if (isset($_GET['hapus'])) {
 setcookie('nama', '', time() - 3600, '/');
 header('Location: cookie_dasar.php');
 exit;
}

$kunjungan = isset($_COOKIE['kunjungan']) ? (int)$_COOKIE['kunjungan'] : 0;
$kunjungan++;
setcookie('kunjungan', $kunjungan, time() + (86400 * 7), '/'); 

$nama = $_COOKIE['nama'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Cookie Dasar</title></head>
<body>
    <?php if ($nama): ?>
    <h1>Halo, <?= htmlspecialchars($nama) ?>!</h1>
    <p>Anda sudah membuka halaman ini <?= $kunjungan ?> kali.</p>
    <a href="?hapus=1">Lupakan saya</a>
    <?php else: ?>
    <h1>Halo, tamu!</h1>
    <form method="post">
        <input type="text" name="nama" placeholder="Nama Anda" required>
        <button type="submit">Simpan</button>
    </form>
    <?php endif; ?>
</body>
</html>