<?php

try {
    $db = new PDO(
        'mysql:host=cours_php-db-1;dbname=data_site;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
