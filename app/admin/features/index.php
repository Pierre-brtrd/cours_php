<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/users.php');
include_once('../../requetes/features.php');

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
    <title>Liste features - Cours PHP</title>
</head>

<body>

    <?php include($templatePath . 'header.php'); ?>

    <?php include($templatePath . 'login.php'); ?>

    <main>

        <? if (isset($_SESSION['LOGGED_USER'])) : ?>
            <section>
                <h1>Liste des features</h1>
                <hr class="separator middle" />
                <div class="liste-users liste-users-admin">
                    <? foreach ($features as $feature) : ?>
                        <div class="card">
                            <? if (!empty($feature['feature_image'])) : ?>
                                <img src="<? echo $uploadPath . $feature['feature_image']; ?>" alt="">
                            <? endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $feature['feature_name']; ?></h5>
                                <p class="card-text"><b>Description</b> : <?php echo strip_tags($feature['feature_desc']); ?></p>
                            </div>
                            <div class="card-btn">
                                <a class="alert-success" href="<?php echo $rootURL . "/admin/features/update-feature.php?id=" . $feature['id']; ?>">Modifier</a>
                                <a class="alert-danger" href="<?php echo $rootURL . "/admin/features/delete-feature.php?id=" . $feature['id']; ?>">Supprimer</a>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </section>

            <section>
                <a class="btn-form" href="<?php echo $rootURL; ?>/admin/features/add-feature.php">Ajouter une feature</a>
            </section>

        <? endif; ?>
    </main>

    <?php include($templatePath . 'footer.php'); ?>

</body>

</html>