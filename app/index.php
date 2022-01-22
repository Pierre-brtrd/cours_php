<?php
session_start();

include_once('config/mysql.php');
include_once('config/variables.php');
include_once('requetes/users.php');
include_once('requetes/userActif.php');
include_once('requetes/articles.php');
include_once('requetes/features.php');
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
    <script src="https://kit.fontawesome.com/4c9c1eb731.js" crossorigin="anonymous"></script>
    <title>Cours PHP</title>
</head>

<body>


    <?php include($templatePath . 'header.php'); ?>

    <?php include($templatePath . 'login.php'); ?>

    <main>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <? include($templatePath . 'banner-hero.php'); ?>

            <? if (isset($features)) : ?>
                <section id="features">
                    <article>
                        <h1>Présentation des fonctionnalités</h1>
                        <hr class="separator middle" />
                        <p>Voici la liste des features que nous avons mise en place sur cette page</p>
                        <div class="liste-features">
                            <? foreach ($features as $feature) : ?>
                                <div class="card-feature">
                                    <div class="card-feature-img">
                                        <a href="#">
                                            <? if (!empty($feature['feature_image'])) : ?>
                                                <img src="<? echo $uploadPath . $feature['feature_image']; ?>" loading="lazy" />
                                            <? else : ?>
                                                <img src="./uploads/banner-feature-default.jpeg" loading="lazy" />
                                            <? endif; ?>
                                        </a>
                                    </div>
                                    <div class="card-feature-body">
                                        <h2 class="card-title"><? echo $feature['feature_name']; ?></h2>
                                        <p><? echo $feature['feature_desc']; ?></p>
                                        <a class="btn-feature" href="#">En savoir plus</a>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </article>
                </section>
            <? endif; ?>

            <section style="margin-bottom: 4em;">
                <h1>Liste des utilisateurs</h1>
                <hr class="separator middle">
                <div class="user-list">
                    <? foreach ($users as $user) : ?>
                        <div class="user-card">
                            <span>
                                <i class="fas fa-user"></i>
                            </span>
                            <h2>Utilisateur</h2>
                            <ul>
                                <li class="user-icon">
                                    <? if ($user['image']) : ?>
                                        <img src="<? echo $uploadPath . $user['image']; ?>" alt="">
                                    <? endif; ?>
                                </li>
                                <li>
                                    <h3><? echo $user['nom']; ?></h3>
                                    <h3><? echo $user['email']; ?></h3>
                                    <form action="article.php" method="GET">
                                        <div class="hidden">
                                            <label for="id">Identifiant de l'utilisateurs</label>
                                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        </div>
                                        <button class="btn-user" type="submit">Voir les articles</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    <? endforeach; ?>
                </div>
            </section>

            <? include($templatePath . 'contact/section-contact.php'); ?>

        <?php endif; ?>
    </main>

    <?php include($templatePath . 'footer.php'); ?>
</body>

</html>