<?php
$pdo = new PDO(
    'mysql:host=localhost;dbname=db_belajar;charset=utf8mb4',
    'root',
    '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
