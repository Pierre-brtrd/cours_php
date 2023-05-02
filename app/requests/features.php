<?php

include_once('/app/config/mysql.php');

function findAllFeatures(): array
{
    global $db;

    $query = "SELECT * FROM features";

    $sqlStatement = $db->prepare($query);
    $sqlStatement->execute();

    return $sqlStatement->fetchAll();
}

function findFeaturesOrderByDateWithLimit(int $max = 6): array|bool
{
    global $db;

    $query = "SELECT * FROM features ORDER BY name LIMIT :max";
    $sqlStatement = $db->prepare($query);
    $sqlStatement->execute([
        'max' => $max,
    ]);

    return $sqlStatement->fetchAll();
}

function findFeatureById(int $id): array|bool
{
    global $db;

    $query = "SELECT * FROM features WHERE id = :id";

    $sqlStatement = $db->prepare($query);
    $sqlStatement->execute([
        'id' => $id,
    ]);

    return $sqlStatement->fetch();
}

function addFeature(string $titre, ?string $image = null): bool
{
    global $db;

    try {
        if ($image) {
            $query = "INSERT INTO features(name, image) VALUE (:titre, :image)";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'titre' => $titre,
                'image' => $image,
            ]);
        } else {
            $query = "INSERT INTO features(name) VALUE (:titre)";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'titre' => $titre,
            ]);
        }
    } catch (PDOException $e) {
        return false;
    }

    return true;
}

function updateFeature(int $id, string $titre, ?string $image = null): bool
{
    global $db;

    try {
        if ($image) {
            $query = "UPDATE features SET name= :name, image= :image WHERE id= :id";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'id' => $id,
                'name' => $titre,
                'image' => $image,
            ]);
        } else {
            $query = "UPDATE features SET name= :name WHERE id= :id";

            $sqlStatement = $db->prepare($query);
            $sqlStatement->execute([
                'id' => $id,
            ]);
        }
    } catch (PDOException $e) {
        die($e->getMessage());
        return false;
    }

    return true;
}

function deleteFeature(int $id): bool
{
    global $db;

    try {
        $query = "DELETE FROM features WHERE id = :id";
        $sqlStatement = $db->prepare($query);
        $sqlStatement->execute([
            'id' => $id,
        ]);
    } catch (PDOException $e) {
        return false;
    }

    return true;
}
