<?php
$host = getenv('DB_HOST') ?: 'db'; // <- 'db' is the name of the MySQL service in docker-compose
$user = getenv('DB_USER') ?: 'root';
$pass = '';  // Blank password
$db   = getenv('DB_NAME') ?: 'tertibega_coffee';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
