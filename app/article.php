<?php
session_start();

include("/app/config/variables.php");
include($rootPath . 'requests/articles.php');

if (!isset($_SESSION['article']['id'])) {
    $article = findArticleById(isset($_POST['id']) ? (int) $_POST['id'] : 0);

    if (!$article) {
        $_SESSION['message']['error'] = "Article not found";

        header("Location:$rootUrl");
    }

    $_SESSION['article']['id'] = $article['id'];
} else if ($_SESSION['article']['id'] != !isset($_POST['id']) ? $_POST['id'] : 0) {
    $article = findArticleById(isset($_POST['id']) ? (int) $_POST['id'] : 0);

    if (!$article) {
        $_SESSION['message']['error'] = "Article not found";

        header("Location:$rootUrl");
    }

    $_SESSION['article']['id'] = $article['id'];
} else {
    $article = findArticleById($_SESSION['article']['id']);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $stylePath; ?>main.css">
    <link rel="stylesheet" href="<?= $stylePath; ?>articles.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <title><?= strip_tags(html_entity_decode($article['titre'])); ?> - Cours PHP</title>
</head>

<body>
    <?php include($templatePath . 'header.php'); ?>
    <main>
        <?php if (!empty($article['image'])) : ?>
            <div class="banner" style="background: center / cover url(<?= "/uploads/articles/$article[image]"; ?>)">
                <div class="banner-title">
                    <h1><?= strip_tags(html_entity_decode($article['titre'])); ?></h1>
                </div>
            </div>
        <?php else : ?>
            <div class="banner">
                <div class="banner-title">
                    <h1><?= strip_tags(html_entity_decode($article['titre'])); ?></h1>
                </div>
            </div>
        <?php endif; ?>
        <section>
            <div class="article-row">
                <div class="article-info">
                    <h2>Information de l'article:</h2>
                    <div class="article-auteur">
                        <?php if ($article['avatar']) : ?>
                            <div class="article-info-avatar">
                                <img src="/uploads/users/<?= $article['avatar']; ?>" alt="<?= "$article[nom] $article[prenom]"; ?>">
                            </div>
                        <?php endif; ?>
                        <span><?= "$article[prenom] $article[nom]"; ?></span>
                    </div>
                    <p><b>Date</b>: <?= date_format(new Datetime($article['date']), 'd/m/Y'); ?></p>
                </div>
                <div class="article-content">
                    <?= html_entity_decode($article['description']); ?>
                </div>
            </div>
        </section>
    </main>
    <?php include($templatePath . 'footer.php'); ?>
</body>

</html>