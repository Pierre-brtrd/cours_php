<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/users.php');
include_once('../../requetes/features.php');
include_once('../../requetes/articles.php');

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
    <title>Liste articles - Cours PHP</title>
</head>

<body>

    <?php include($templatePath . 'header.php'); ?>
    <?php include($templatePath . 'login.php'); ?>

    <main>

        <? if (isset($_SESSION['LOGGED_USER'])) : ?>
            <section>
                <h1>Liste des articles</h1>
                <hr class="separator middle" />
                <div class="liste-users liste-users-admin">
                    <? foreach ($articles_Auteurs_id as $article) : ?>
                        <?
                        if (strlen($article['Description']) < 150) {
                            $description = $article['Description'];
                        } else {
                            $description = substr($article['Description'], 0, strpos($article['Description'], ' ', 150)) . "...";
                        }
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $article['titre']; ?></h5>
                                <p class="card-text"><b>Description</b> : <?php echo strip_tags($description); ?></p>
                                <p class="card-text"><b><em>Auteur</em></b> : <? echo $article['nom']; ?></p>
                            </div>
                            <div class="card-btn">
                                <a class="alert-success" href="<?php echo $rootURL . "/admin/articles/update.php?id=" . $article['article_id']; ?>">Modifier</a>
                                <a class="alert-danger" href="<?php echo $rootURL . "/admin/articles/delete.php?id=" . $article['article_id']; ?>">Supprimer</a>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </section>

            <section>
                <a class="btn-form" href="<?php echo $rootURL; ?>/admin/articles/create.php">Ajouter un article</a>
            </section>

        <? endif; ?>
    </main>
</body>

</html>