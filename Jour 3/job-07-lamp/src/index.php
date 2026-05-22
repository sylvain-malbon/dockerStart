<?php
// Affiche les informations PHP
phpinfo();

$host = 'db'; // nom du service MySQL dans docker-compose
$db   = 'lamp_demo';
$user = 'dev';
$pass = 'secret';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Test de connexion à MySQL
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "<p style=\"background:#dfd;padding:8px;\">Connexion réussie à MySQL via PDO !</p>";
} catch (PDOException $e) {
    echo "<p style=\"background:#fdd;padding:8px;\">Erreur de connexion : " . htmlspecialchars($e->getMessage()) . "</p>";
}
