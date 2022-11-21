<?php

session_start();

include("/app/config/variables.php");
include($rootPath . 'requests/articles.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $stylePath ?>main.css">
    <link rel="stylesheet" href="<?= $stylePath ?>articles.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Liste des articles - Cours PHP</title>
</head>

<body>
    <?php include($templatePath . 'header.php'); ?>
    <main>
        <div class="banner">
            <div class="banner-title">
                <h1>Liste des articles</h1>
                <hr class="separator">
                <p>Découvrez tous les articles</p>
            </div>
            <a class="btn-scroll" href="#liste">
                <i class="bi bi-arrow-down-circle"></i>
            </a>
        </div>
        <? if (!empty(findArticleWithOrder())) : ?>
            <section id="articles">
                <h1>Articles</h1>
                <hr class="separator middle">
                <div class="list-articles mt-2">
                    <? foreach (findArticleWithOrder() as $article) : ?>
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
                                                    <img src="/uploads/users/<?= $article['avatar']; ?>" alt="<?= "$article[nom] $article[prenom]"; ?>">
                                                </div>
                                            <?php endif; ?>
                                            <?= $article['prenom']; ?>
                                        </em>
                                    </div>
                                    <p>Date : <?= date_format(new Datetime($article['date']), 'd/m/Y'); ?></p>
                                    <p class="card-text"><b>Description</b> : <?= strip_tags(html_entity_decode($description)); ?></p>
                                    <form action="<?= "$rootUrl/article.php"; ?>" method="POST">
                                        <input type="hidden" name="id" value="<?= $article['id']; ?>">
                                        <button type="submit" class="btn btn-primary">Lire plus</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
                <a href="<?= "$rootUrl/article-liste.php"; ?>" class="btn btn-primary btn-center">Voir plus</a>
            </section>
        <? endif; ?>
    </main>
    <?php include($templatePath . 'footer.php'); ?>
</body>

</html>