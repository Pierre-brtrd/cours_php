<?php

try {
    $db = new PDO(
        'mysql:host=cours_php-db-1;dbname=data_site;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
