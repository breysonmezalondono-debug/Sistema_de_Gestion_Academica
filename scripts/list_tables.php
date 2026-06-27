<?php
$host = '127.0.0.1';
$port = 3306;
$db   = 'laravel_db';
$user = 'root';
$pass = 'Ar3122916169';
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->query("SHOW FULL TABLES");
    $rows = $stmt->fetchAll(PDO::FETCH_NUM);
    foreach ($rows as $r) {
        echo $r[0] . ' | ' . ($r[1] ?? '') . PHP_EOL;
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}
