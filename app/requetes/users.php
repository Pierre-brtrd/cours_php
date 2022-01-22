<?php

$sqlQueryUsers = 'SELECT * FROM utilisateurs';
$usersStatement = $db->prepare($sqlQueryUsers);
$usersStatement->execute();

$users = $usersStatement->fetchAll();
