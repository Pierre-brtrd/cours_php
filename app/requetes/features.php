<?php

$sqlQuery = 'SELECT * FROM features';
$sqlStatement = $db->prepare($sqlQuery);
$sqlStatement->execute();

$features = $sqlStatement->fetchAll();
