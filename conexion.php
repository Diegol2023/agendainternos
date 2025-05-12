//obtener variables de entorno
<?php
$dbHost = $_ENV['DB_HOST'] ?? '127.0.0.1';
$dbPort = $_ENV['DB_PORT'] ?? '3306';
$dbName = $_ENV['DB_DATABASE'] ?? null;
$dbUser = $_ENV['DB_USERNAME'] ?? null;
$dbPass = $_ENV['DB_PASSWORD'] ?? null;
?>

