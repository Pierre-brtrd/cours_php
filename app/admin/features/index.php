<?php
session_start();

include('/app/config/variables.php');
include($rootPath . 'requests/features.php');

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
    <link rel="stylesheet" href="<? echo $stylePath; ?>main.css">
    <link rel="stylesheet" href="<? echo $stylePath; ?>features.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <title>Admin features - Cours PHP</title>
</head>

<body>
    <? include($templatePath . 'header.php') ?>
    <main>
        <section>
            <h1>Admin des features</h1>
            <?php include_once($templatePath . 'messages.php'); ?>
            <a href="<?= "$rootUrl/admin/features/create.php"; ?>" class="btn btn-primary">Ajouter une feature</a>
            <div class="list-features mt-2">
                <? foreach (findAllFeatures() as $feature) : ?>
                    <div class="card card-features">
                        <? if (!empty($feature['image'])) : ?>
                            <img src="/uploads/features/<?= $feature['image']; ?>" alt="<?= $feature['name']; ?>">
                        <? endif; ?>
                        <div class="card-body">
                            <h2 class="card-text"><? echo $feature['name'] ?></h2>
                            <div class="card-btn">
                                <a href="<?= "$rootUrl/admin/features/update.php?id=" . $feature['id']; ?>" class="btn btn-success">Modifier</a>
                                <form action="<?= "$rootUrl/admin/features/delete.php"; ?>" method="POST" onsubmit="return confirm('Êtes-vous sur de vouloir supprimer ce user')">
                                    <input type="hidden" name="id" value="<?= $feature['id']; ?>">
                                    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                                    <button class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </section>
    </main>
    <? include($templatePath . 'footer.php'); ?>

</body>

</html>