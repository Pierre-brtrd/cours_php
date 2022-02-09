<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/users.php');
include_once('../../requetes/features.php');
include_once('../../requetes/articles.php');

if (!empty($_GET['id'])) {
    foreach ($articles as $article => $articleInfo) {
        if (in_array($_GET['id'], $articles[$article])) {
            $searchId = true;
        }
    }
}

if (isset($searchId)) {
    $id = $_GET['id'];

    $sqlQuery = "SELECT * FROM articles WHERE article_id= :id";
    $sqlStatement = $db->prepare($sqlQuery);
    $sqlStatement->execute([
        'id' => $id,
    ]);

    $articleUpdate = $sqlStatement->fetch(PDO::FETCH_ASSOC);
} else {
    $errorMessageId = "Erreur, il faut un id valide";
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
    <title>Supprimer article - Cours PHP</title>
</head>

<body>

    <?php include($templatePath . 'header.php'); ?>

    <main>
        <section>
            <?php include($templatePath . 'login.php'); ?>
        </section>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>

            <? if (isset($errorMessageId)) : ?>
                <section>
                    <div class="alert alert-danger">
                        <p><? echo $errorMessageId; ?></p>
                    </div>
                </section>
            <? else : ?>
                <section>
                    <h1>Page de suppression de l'article</h1>
                    <form class="form-user" action="post_article_delete.php" method="POST">
                        <div class="form-login-input form-article">
                            <div class="hidden">
                                <input type="text" name="create_id" value="<? echo $articleUpdate['article_id']; ?>">
                            </div>
                            <div class="input-group alert alert-danger">
                                <p><b>Attention la suppression est définitive</b></p>
                            </div>
                        </div>
                        <button class="btn-form" type="submit">Envoyer</button>
                    </form>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    </main>

    <?php include($templatePath . 'footer.php'); ?>
</body>

</html>