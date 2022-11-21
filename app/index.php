<?php
session_start();

include("/app/config/variables.php");
include($rootPath . 'requests/users.php');
include($rootPath . 'requests/articles.php');
include($rootPath . 'requests/features.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $stylePath ?>main.css">
    <link rel="stylesheet" href="<?= $stylePath ?>user.css">
    <link rel="stylesheet" href="<?= $stylePath ?>articles.css">
    <link rel="stylesheet" href="<?= $stylePath ?>features.css">
    <link rel="stylesheet" href="<?= $stylePath ?>index.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Cours PHP</title>
</head>

<body>
    <?php include($templatePath . 'header.php'); ?>
    <main>
        <?php include($templatePath . 'messages.php'); ?>
        <?php include_once($templatePath . 'banner.php'); ?>
        <? if (!empty(findAllFeatures())) : ?>
            <section id="features">
                <h1>Présentation des fonctionnalités</h1>
                <hr class="separator tier">
                <p>Voici la liste des features de l'application</p>
                <div class="list-features">
                    <? foreach (findAllFeatures() as $feature) : ?>
                        <div class="card card-features">
                            <? if (!empty($feature['image'])) : ?>
                                <img src="/uploads/features/<?= $feature['image']; ?>" alt="<?= $feature['name']; ?>">
                            <? endif; ?>
                            <div class="card-body">
                                <h2 class="card-text"><? echo $feature['name'] ?></h2>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </section>
        <? endif; ?>
        <? if (!empty(findLatestArticleWithLimit(2))) : ?>
            <section id="articles" style="margin-bottom: 4em;">
                <h1 class="text-right">Derniers Articles</h1>
                <hr class="separator middle right">
                <div class="list-users-front" style="margin-top: 2em;">
                    <? foreach (findLatestArticleWithLimit(2) as $article) : ?>
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
                                    <p>Date : <?= $article['date']; ?></p>
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
        <? if (!empty(findAllUsers())) : ?>
            <section id="users" style="margin-bottom: 4em;">
                <h1>Liste des utilisateurs</h1>
                <hr class="separator tier">
                <div class="list-users-front" style="margin-top: 2em;">
                    <? foreach (findAllUsers() as $user) : ?>
                        <div class="card card-user">
                            <div class="card-body">
                                <div class="card-user-title">
                                    <?php if ($user['image']) : ?>
                                        <div class="card-user-img">
                                            <div class="card-img">
                                                <img src="/uploads/users/<?= $user['image']; ?>" alt="<?= "$user[nom] $user[prenom]"; ?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <h2><?= "$user[prenom] $user[nom]"; ?></h2>
                                </div>
                                <p class="card-text"><b>Email</b> : <?= strip_tags($user['email']); ?></p>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </section>
        <? endif; ?>
        <? include($templatePath . 'contact/sectionContact.php'); ?>
    </main>
    <?php include($templatePath . 'footer.php'); ?>
</body>

</html>