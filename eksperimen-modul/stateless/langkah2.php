<?php
$nama = $_POST['nama'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Langkah 2</title>
<style>body{font-family:sans-serif;padding:1.5rem}
.tag{background:#1a7f37;color:#fff;padding:2px 10px;border-radius:10px;fontsize:13px}</style></head>
<body>
	<span class="tag">Request 2</span>
 	<h2>Langkah 2: Server menerima data</h2>
 	<p>Halo, <b><?= htmlspecialchars($nama ?? 'tidak diketahui') ?></b>! Server berhasil
	menerima nama Anda.</p>
 	<a href="langkah3.php">Lanjut ke Langkah 3 &raquo;</a>
</body>
</html>