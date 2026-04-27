<?php
// Configuration de la base de données (Locale + Vercel)
$db_host = getenv('DB_HOST') ?: "localhost";
$db_user = getenv('DB_USER') ?: "root";
$db_pass = getenv('DB_PASS') ?: "";
$db_name = getenv('DB_NAME') ?: "hotelee";
$db_port = getenv('DB_PORT') ?: 3306;

$dsn = "mysql:host=$db_host;dbname=$db_name;port=$db_port";
$db_error = false;

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 2, // Fast timeout for Vercel
    ]);
} catch (PDOException $e) {
    $db_error = true;
    // We don't die() anymore, we'll use Mock data in the UI if needed
}
