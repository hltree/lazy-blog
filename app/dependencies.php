<?php

use App\Setting;

$settings = new Setting\Settings();
$container->set('db', function ($settings) {
    $db = $settings->db;
    var_dump($settings);
    $dsn = "mysql:host={$db['user']}@{$db['host']};port={$db['port']};dbname={$db['dbname']}charset=utf8;";
    try {
        $pdo = new PDO($dsn, $db['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
});

$db = $container->get('db');