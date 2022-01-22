<?php

// All articles
$sqlQuery = "SELECT * FROM articles";
$sqlQueryStatement = $db->prepare($sqlQuery);
$sqlQueryStatement->execute();

$articles = $sqlQueryStatement->fetchAll();

// Jointure interne
$sqlQueryArticleInterne = "SELECT u.nom, a.titre, a.description, a.date FROM utilisateurs u INNER JOIN articles a ON u.id = a.auteur_id";

$sqlQueryStatement = $db->prepare($sqlQueryArticleInterne);
$sqlQueryStatement->execute();

$articles_Auteurs = $sqlQueryStatement->fetchAll();

// Jointure Interne avec filtre sur un auteur
$sqlArticleInterneSearchAuteur = "SELECT u.nom, a.titre, a.description, a.date FROM utilisateurs u INNER JOIN articles a ON u.id = a.auteur_id WHERE u.nom = :nom";

$sqlQueryStatement = $db->prepare($sqlArticleInterneSearchAuteur);
$sqlQueryStatement->execute([
    'nom' => 'Pierre',
]);

$articlesPierre = $sqlQueryStatement->fetchAll();

// Jointure Externe LEFT JOIN
$sqlQueryArticleExterne = "SELECT u.nom, a.titre FROM utilisateurs u LEFT JOIN articles a ON u.id = a.auteur_id";

$sqlQueryStatement = $db->prepare($sqlQueryArticleExterne);
$sqlQueryStatement->execute();

$auteurs_Articles = $sqlQueryStatement->fetchAll();

// Jointure Externe RIGHT JOIN
$sqlQueryArticleExterne = "SELECT u.nom, a.article_id, a.titre, a.Description FROM utilisateurs u RIGHT JOIN articles a ON u.id = a.auteur_id";

$sqlQueryStatement = $db->prepare($sqlQueryArticleExterne);
$sqlQueryStatement->execute();

$articles_Auteurs_id = $sqlQueryStatement->fetchAll();
