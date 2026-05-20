<?php
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

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "<p>Connexion réussie à MySQL via PDO !</p>";
} catch (PDOException $e) {
    echo "<p>Erreur de connexion : " . $e->getMessage() . "</p>";
}

// phpinfo(); // Décommente si tu veux afficher phpinfo