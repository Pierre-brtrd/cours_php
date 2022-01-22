<?php

if (isset($_SESSION["LOGGED_USER"])) {
    $sqlQueryUserActif = 'SELECT * FROM utilisateurs WHERE nom = :name AND actif = :is_enabled';
    $userActifStatement = $db->prepare($sqlQueryUserActif);
    $userActifStatement->execute([
        'name' => $_SESSION["LOGGED_USER"],
        'is_enabled' => 'true'
    ]);

    $userActif = $userActifStatement->fetchAll();
}
