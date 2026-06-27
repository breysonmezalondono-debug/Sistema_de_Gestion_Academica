<?php
$host = '127.0.0.1';
$port = 3306;
$db   = 'laravel_db';
$user = 'root';
$pass = 'Ar3122916169';
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("DROP TABLE IF EXISTS estudiantes");
    echo "dropped estudiantes\n";
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}
