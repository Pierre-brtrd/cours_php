<?php
session_start();

include_once('/app/config/variables.php');

if (!isset($_SESSION['LOGGED_USER']) || !in_array('ROLE_ADMIN', $_SESSION['LOGGED_USER']['roles'])) {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];

    header("Location:$rootUrl/login.php");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $stylePath; ?>main.css">
    <link rel="stylesheet" href="<?= $stylePath; ?>admin.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Admin - Cours PHP</title>
</head>

<body>
    <?php include($templatePath . 'header.php'); ?>
    <main>
        <div class="banner">
            <div class="banner-title">
                <h1>Bienvenu dans l'administration de l'application PHP</h1>
                <hr class="separator">
                <p>Vous allez pouvoir modifier le contenu de votre application web.</p>
            </div>
            <a class="btn-scroll" href="#main">
                <i class="bi bi-arrow-down-circle"></i>
            </a>
        </div>
        <section id="main">
            <h1>Que voulez-vous modifier ?</h1>
            <hr class="separator middle">
            <div class="list-admin mt-2">
                <div class="card card-admin">
                    <div class="card-admin-img">
                        <img src="<?= $imagePath; ?>admin-card-feature.jpeg" alt="">
                    </div>
                    <div class="card-body">
                        <h2>Features</h2>
                        <a class="btn btn-primary" href="./features">Modifier</a>
                    </div>
                </div>
                <div class="card card-admin">
                    <div class="card-admin-img">
                        <img src="<?= $imagePath; ?>banner-admin.jpeg" alt="">
                    </div>
                    <div class="card-body">
                        <h2>Articles</h2>
                        <a class="btn btn-primary" href="./articles">Modifier</a>
                    </div>
                </div>
                <div class="card card-admin">
                    <div class="card-admin-img">
                        <img src="<?= $imagePath; ?>admin-card-user.jpeg" alt="">
                    </div>
                    <div class="card-body">
                        <h2>Users</h2>
                        <a class="btn btn-primary" href="./users">Modifier</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include($templatePath . 'footer.php'); ?>
</body>

</html>