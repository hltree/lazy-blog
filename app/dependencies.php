<?php

use App\Setting;

$settings = new Setting\Settings();
$container->set('db', function ($settings) {
    $db = $settings->db;
    $dsn = "mysql:host={$db['host']};port={$db['port']};dbname={$db['dbname']}charset=utf8mb4;";
    try {
        $pdo = new PDO($dsn, $db['user'], $db['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
});

$db = $container->get('db');