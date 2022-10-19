<?php
session_start();

include_once('../config/mysql.php');
include_once('../config/variables.php');
include_once('../requetes/users.php');
include_once('../requetes/userActif.php');
include_once('../requetes/articles.php');

if (isset($_GET['id']) || isset($_GET['auteur'])) {
    foreach ($users as $user => $userInfo) {
        if (isset($_GET['id'])) {
            if (in_array($_GET['id'], $users[$user])) {
                $searchId = true;
                $auteur = $userInfo['nom'];
                $id = $_GET['id'];
            }
        } elseif (isset($_GET['auteur'])) {
            if (in_array($_GET['auteur'], $users[$user])) {
                $searchId = true;
                $auteur = $userInfo['nom'];
                $id = $userInfo['id'];
            }
        }
    }

    if (isset($searchId)) {
        $sqlQuery = "SELECT u.nom, a.titre, a.description, a.date 
        FROM utilisateurs u 
        INNER JOIN articles a 
        ON u.id = a.auteur_id 
        WHERE u.id = :id 
        ORDER BY a.titre";

        $sqlQueryStatement = $db->prepare($sqlQuery);
        $sqlQueryStatement->execute([
            'id' => $id,
        ]);

        $articlesUser = $sqlQueryStatement->fetchAll();
    } else {
        $errorMessageId = "Il faut un auteur valide";
    }
} else {
    $errorMessageId = true;
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
    <link rel="shortcut icon" href="./assets/favicon/favicon.ico" type="image/x-icon">
    <title>Article - Cours PHP</title>
</head>

<body>


    <?php include($templatePath . 'header.php'); ?>

    <section>
        <?php include($templatePath . 'login.php'); ?>
    </section>

    <main>

        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <section>
                <? if (isset($errorMessageId)) : ?>
                    <h1>Page de présentation des articles</h1>
                    <form class="form-user form-article-auteur" action="article.php" method="GET">
                        <div class="form-login-input form-article">
                            <p>Il faut d'abord sélectionner un auteur pour afficher ses articles</p>
                            <div class="input-group">
                                <label for="auteur">Auteur :</label>
                                <input type="text" name="auteur" list="auteur_list">
                                <datalist id="auteur_list">
                                    <? foreach ($users as $user) : ?>
                                        <option value="<? echo $user['nom']; ?>">
                                        <? endforeach; ?>
                                </datalist>
                            </div>
                        </div>
                        <button class="btn-form" type="submit">Envoyer</button>
                    </form>
                <? else : ?>
                    <article>
                        <h1>Page des articles de <? echo $auteur; ?></h1>
                        <hr class="separator" color="#3fd3c9">
                        <? if (!empty($articlesUser)) : ?>
                            <? foreach ($articlesUser as $article) : ?>
                                <div class="article-content">
                                    <div class="article-info">
                                        <h2><? echo $article['titre']; ?></h2>
                                        <em>Auteur : <? echo $article['nom']; ?></em>
                                        <p>Date : <? echo $article['date']; ?></p>
                                    </div>
                                    <div class="article-desc">
                                        <p><? echo $article['description']; ?></p>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        <? else : ?>
                            <div style="margin: 1em auto;" class="alert alert-danger">
                                <h5 class="card-title">Pas d'articles disponibles</h5>
                            </div>
                            <a class="btn-form" href="<?php echo $rootURL; ?>">Retour accueil</a>
                        <? endif; ?>
                    </article>
                <? endif; ?>
            </section>
        <?php endif; ?>

    </main>

    <?php include($templatePath . 'footer.php'); ?>

</body>

</html>