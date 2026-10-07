<?php
$nama = $_POST['nama'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Langkah 3</title>
<style>body{font-family:sans-serif;padding:1.5rem}
.tag{background:#c0392b;color:#fff;padding:2px 10px;border-radius:10px;fontsize:13px}</style></head>
<body>
 	<span class="tag">Request 3</span>
 	<h2>Langkah 3: Apakah server masih ingat?</h2>
 	<p>Halo, <b><?= htmlspecialchars($nama ?? 'tidak diketahui') ?></b>.</p>
 	<p>Server <b>lupa</b> nama Anda, padahal baru saja menerimanya di request sebelumnya.</p>
</body>
</html>