<?php
session_start();

include_once('/app/config/variables.php');
include_once($rootPath . 'requests/articles.php');

if (!isset($_SESSION['LOGGED_USER']) || !in_array('ROLE_ADMIN', $_SESSION['LOGGED_USER']['roles'])) {
    $_SESSION['redirect'] = $_SERVER['PHP_SELF'];

    header("Location:$rootUrl/login.php", false);
}

$_SESSION['token'] = bin2hex(random_bytes(35));

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $stylePath; ?>main.css">
    <link rel="stylesheet" href="<?php echo $stylePath; ?>articles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <title>Liste articles - Cours PHP</title>
</head>

<body>
    <?php include($templatePath . 'header.php'); ?>
    <main>
        <section>
            <h1>Liste des articles</h1>
            <hr class="separator middle mb-2" />
            <?php include_once($templatePath . 'messages.php'); ?>
            <a class="btn btn-primary" href="<?php echo $rootUrl; ?>/admin/articles/create.php">Ajouter un article</a>
            <div class="list-articles">
                <? foreach (findAllArticlesWithUser() as $article) : ?>
                    <?
                    if (strlen($article['description']) < 150) {
                        $description = $article['description'];
                    } else {
                        $description = substr($article['description'], 0, strpos($article['description'], ' ', 150)) . "...";
                    }
                    ?>
                    <div class="card">
                        <? if (!empty($article['image'])) : ?>
                            <img src="/uploads/articles/<?= $article['image']; ?>" alt="<?= strip_tags(html_entity_decode($article['titre'])); ?>">
                        <? endif; ?>
                        <div class="card-body">
                            <div class="card-content">
                                <div class="card-articles-header">
                                    <h2><?= $article['titre']; ?></h2>
                                    <em>
                                        <?php if ($article['avatar']) : ?>
                                            <div class="card-articles-img">
                                                <img src="/uploads/users/<?= $article['avatar']; ?>" alt="<?= "$user[nom] $user[prenom]"; ?>">
                                            </div>
                                        <?php endif; ?>
                                        <?= $article['prenom']; ?>
                                    </em>
                                </div>
                                <p>Date : <?= $article['date']; ?></p>
                                <p class="card-text"><b>Description</b> : <?= strip_tags(html_entity_decode($description)); ?></p>
                                <div class="card-btn">
                                    <a class="btn btn-success" href="<?= $rootUrl . "/admin/articles/update.php?id=" . $article['id']; ?>">Modifier</a>
                                    <form action="<?= "$rootUrl/admin/articles/delete.php"; ?>" method="POST" onsubmit="return confirm('Êtes-vous sur de vouloir supprimer ce user')">
                                        <input type="hidden" name="id" value="<?= $article['id']; ?>">
                                        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                                        <button class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </section>
    </main>
    <?php include($templatePath . 'footer.php'); ?>
</body>

</html>