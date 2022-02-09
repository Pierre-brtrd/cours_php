<?php
session_start();

include_once('../config/mysql.php');
include_once('../config/variables.php');
include_once('../requetes/users.php');
include_once('../requetes/userActif.php');
include_once('../requetes/articles.php');
include_once('../requetes/features.php');
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
    <script src="https://kit.fontawesome.com/4c9c1eb731.js" crossorigin="anonymous"></script>
    <title>Admin - Cours PHP</title>
</head>

<body>

    <?php include($templatePath . 'header.php'); ?>
    <?php include($templatePath . 'login.php'); ?>

    <main>
        <? if (isset($_SESSION['LOGGED_USER'])) : ?>

            <div class="banner-admin">
                <div class="content-banner">
                    <h1>Bienvenu dans l'administration de l'application PHP</h1>
                    <hr class="separator" />
                    <p>Vous allez pouvoir modifier le contenu de votre application web.</p>
                </div>
                <div class="btn-scroll">
                    <a href="#main">
                        <i class="fas fa-caret-down"></i>
                    </a>
                </div>
            </div>

            <section id="main">
                <h1>Que voulez-vous modifier ?</h1>
                <hr class="separator middle">

                <div class="list-admin">
                    <div class="card">
                        <img src="<? echo $imagePath; ?>admin-card-feature.jpeg" alt="">
                        <div class="card-body">
                            <h2><b>Features</b></h2>
                        </div>
                        <div class="card-btn">
                            <a class="btn-form" href="./features">Modifier</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="<? echo $imagePath; ?>banner-hero.jpeg" alt="">
                        <div class="card-body">
                            <h2><b>Articles</b></h2>
                        </div>
                        <div class="card-btn">
                            <a class="btn-form" href="./articles">Modifier</a>
                        </div>
                    </div>
                    <div class="card">
                        <img src="<? echo $imagePath; ?>admin-card-user.jpeg" alt="">
                        <div class="card-body">
                            <h2><b>Users</b></h2>
                        </div>
                        <div class="card-btn">
                            <a class="btn-form" href="./users">Modifier</a>
                        </div>
                    </div>
                </div>
            </section>

        <? endif; ?>
    </main>

    <?php include($templatePath . 'footer.php'); ?>

</body>

</html>