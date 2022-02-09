<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/features.php');
include_once('../../requetes/users.php');
include_once('../../requetes/articles.php');

if (!empty($_POST['create_id']) && !empty($_POST['create_nom']) && !empty($_POST['create_desc'])) {
    $id = $_POST['create_id'];
    $titre = $_POST['create_nom'];
    $desc = $_POST['create_desc'];
    $date = date('Y-m-d');

    foreach ($users as $user) {
        if ($user['nom'] === $_POST['create_auteur']) {
            $auteur = $user['id'];
        }
    }

    $sqlQuery = "UPDATE articles SET titre= :titre, Description= :desc, auteur_id= :auteur, date= :date WHERE article_id= :id";
    $sqlStatement = $db->prepare($sqlQuery);
    $sqlStatement->execute([
        'id' => $id,
        'titre' => $titre,
        'desc' => $desc,
        'auteur' => $auteur,
        'date' => $date,
    ]);
} else {
    $errorMessageCreate = true;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $stylePath; ?>main.css">
    <link rel="stylesheet" href="<?php echo $stylePath; ?>index.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <title>Modification article - Cours PHP</title>
</head>

<body>

    <?php include($templatePath . 'header.php'); ?>
    <?php include($templatePath . 'login.php'); ?>

    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
        <?php if (isset($errorMessageCreate)) : ?>
            <section>
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <h5 class="card-title">Erreur dans le formulaire</h5>
                        </div>
                    </div>
                </div>
            </section>

        <?php else : ?>

            <section>
                <h1>Article modifié</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rappel des informations</h5>
                        <p class="card-text"><b>Nom</b> : <?php echo strip_tags($titre); ?></p>
                        <p class="card-text"><b>Description</b> : <?php echo strip_tags($desc); ?></p>
                    </div>
                </div>
            </section>

            <section>
                <a class="btn-form" href="<?php echo $rootURL; ?>/admin/articles">Retour articles</a>
            </section>
        <? endif; ?>

    <? endif; ?>

</body>

</html>