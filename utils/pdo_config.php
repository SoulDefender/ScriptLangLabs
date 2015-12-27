<?php

$config = include 'config.php';

try {
    $pdo = new PDO("mysql:host=" . $config['DB_HOST'] . ";dbname=". $config['DB_NAME'], $config['DB_USER'], $config['DB_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    exit("Error Connect to DB: $ex->errorInfo");
}
