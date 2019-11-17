<?php

use App\Setting;

$container->settings = new Setting\Settings();
$db = $container->settings->db;
$dsn = "mysql:host={$db['host']};port={$db['port']};dbname={$db['dbname']};charset=utf8;";
try {
    $pdo = new PDO($dsn, $db['user'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}