<?php
$host = "mysql:host=localhost;dbname=hotelee";
$user = "root";
$pass = "";

try {
    $pdo = new PDO($host,$user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
