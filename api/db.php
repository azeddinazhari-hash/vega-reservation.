<?php
// Configuration de la base de données (Locale + Vercel)
$db_host = getenv('DB_HOST') ?: "localhost";
$db_user = getenv('DB_USER') ?: "root";
$db_pass = getenv('DB_PASS') ?: "";
$db_name = getenv('DB_NAME') ?: "hotelee";
$db_port = getenv('DB_PORT') ?: 3306;

$dsn = "mysql:host=$db_host;dbname=$db_name;port=$db_port";

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    // On Vercel, show a clean message if DB is not configured
    if (getenv('VERCEL')) {
        die("<h3>🚀 Site en ligne, mais la base de données n'est pas encore configurée.</h3>
             <p>Veuillez configurer les variables d'environnement (DB_HOST, DB_USER, etc.) sur Vercel.</p>");
    } else {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
