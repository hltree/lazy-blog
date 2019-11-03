<?php

use App\Setting\Settings;

$settings = new Settings();
$container->set('db', function () {
    $settings = $settings['db'];
    $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'] . ";port=" . $settings['port'],
        $settings['user'], $settings['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
});

//$db = $container->get('db');
//var_dump($db);