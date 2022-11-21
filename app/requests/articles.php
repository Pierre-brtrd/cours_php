<?php

include_once('/app/config/mysql.php');

/**
 * Find all article in database
 *
 * @return array Array of articles with all informations
 */
function findAllArticles(): array
{
    global $db;

    $query = 'SELECT * FROM articles';

    $sqlStatement = $db->prepare($query);
    $sqlStatement->execute();

    return $sqlStatement->fetchAll();
}

function findAllArticlesWithUser(): array|bool
{
    global $db;

    $query = "SELECT a.*, u.nom, u.prenom, u.image as avatar FROM articles a JOIN users u ON a.user_id = u.id";

    $sqlStatement = $db->prepare($query);
    $sqlStatement->execute();

    return $sqlStatement->fetchAll();
}

function findArticleById(int $id): array|bool
{
    global $db;

    $query = "SELECT a.*, u.nom, u.prenom, u.image as avatar FROM articles a JOIN users u ON a.user_id = u.id WHERE a.id = :id";

    $sqlStatement = $db->prepare($query);
    $sqlStatement->execute([
        'id' => $id,
    ]);

    return $sqlStatement->fetch();
}

function findLatestArticleWithLimit(int $limit): array
{
    global $db;

    $query = "SELECT a.*, u.nom, u.prenom, u.image as avatar FROM articles a JOIN users u ON a.user_id = u.id ORDER BY a.date DESC LIMIT :limit";

    $sqlStatement = $db->prepare($query);
    $sqlStatement->bindValue('limit', $limit, $db::PARAM_INT);
    $sqlStatement->execute();

    return $sqlStatement->fetchAll();
}

function findArticleWithOrder(string $order = 'DESC'): array
{
    global $db;

    if ($order === 'DESC') {
        $query = "SELECT a.*, u.nom, u.prenom, u.image as avatar FROM articles a JOIN users u ON a.user_id = u.id ORDER BY a.date DESC";
    } else {
        $query = "SELECT a.*, u.nom, u.prenom, u.image as avatar FROM articles a JOIN users u ON a.user_id = u.id ORDER BY a.date ASC";
    }

    $sqlStatement = $db->prepare($query);
    $sqlStatement->execute();

    return $sqlStatement->fetchAll();
}

/**
 * Add an article in database
 *
 * @param string $titre
 * @param string $description
 * @param string $date
 * @param integer $userId
 * @return boolean
 */
function addArticle(string $titre, string $description, string $date, int $userId, ?string $image = null): bool
{
    global $db;

    try {
        if ($image) {
            $query = "INSERT INTO articles (titre, description, date, user_id, image) VALUES (:titre, :description, :date, :userId, :image)";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'userId' => $userId,
                'titre' => $titre,
                'description' => $description,
                'date' => $date,
                'image' => $image
            ]);
        } else {
            $query = "INSERT INTO articles (titre, description, date, user_id) VALUES (:titre, :description, :date, :userId)";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'userId' => $userId,
                'titre' => $titre,
                'description' => $description,
                'date' => $date,
            ]);
        }
    } catch (PDOException $e) {
        return false;
    }

    return true;
}

function updateArticle(int $id, string $titre, string $description, int $userId, ?string $image = null): bool
{
    global $db;

    try {
        if ($image) {
            $query = "UPDATE articles SET titre= :titre, description= :description, user_id = :userId, image= :image WHERE id = :id";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'id' => $id,
                'userId' => $userId,
                'titre' => $titre,
                'description' => $description,
                'image' => $image,
            ]);
        } else {
            $query = "UPDATE articles SET titre= :titre, description= :description, user_id = :userId WHERE id = :id";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'id' => $id,
                'userId' => $userId,
                'titre' => $titre,
                'description' => $description,
            ]);
        }
    } catch (PDOException $e) {
        return false;
    }

    return true;
}

function deleteArticle(int $id): bool
{
    global $db;

    try {
        $query = "DELETE FROM articles WHERE id = :id";
        $sqlStatement = $db->prepare($query);
        $sqlStatement->execute([
            'id' => $id,
        ]);
    } catch (PDOException $e) {
        return false;
    }

    return true;
}
