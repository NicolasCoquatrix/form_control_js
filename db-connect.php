<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'authentication';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbName", $user, $password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
} catch (PDOException $e) {
    echo 'Erreur lors de la connexion à la base de données : ' . $e->getMessage();
    exit;
}