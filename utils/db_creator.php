<?php
require_once 'pdo_config.php';

try {
    $pdo->exec(file_get_contents('./db_create.sql'));
    print('DB created');
} catch (PDOException $ex) {
    exit('Can\'t create database: '.$ex->getMessage());
}