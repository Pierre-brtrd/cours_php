<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/users.php');
include_once('../../requetes/userActif.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $stylePath; ?>main.css">
    <link rel="stylesheet" href="<?php echo $stylePath; ?>contact.css">
    <link rel="stylesheet" href="<?php echo $stylePath; ?>index.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <title>Liste utilisateurs - Cours PHP</title>
</head>

<body>


    <?php include($templatePath . 'header.php'); ?>

    <?php include($templatePath . 'login.php'); ?>

    <main>
        <section>
            <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                <section>
                    <h1>Liste des utilisateurs</h1>
                    <hr class="separator middle" />

                    <div class="liste-users liste-users-admin">
                        <?php foreach ($users as $user) : ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $user['nom']; ?></h5>
                                    <p class="card-text"><b>Email</b> : <?php echo strip_tags($user['email']); ?></p>
                                    <p class="card-text"><b>Actif</b> : <?php echo strip_tags($user['actif']); ?></p>
                                </div>
                                <div class="card-btn">
                                    <a class="alert-success" href="<?php echo $rootURL . "/admin/users/update-user.php?id=" . $user['id']; ?>">Modifier</a>
                                    <a class="alert-danger" href="<?php echo $rootURL . "/admin/users/delete-user.php?id=" . $user['id']; ?>">Supprimer</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <section>
                    <a class="btn-form" href="<?php echo $rootURL; ?>/admin/users/add-user.php">Ajouter un utilisateur</a>
                </section>
            <?php endif; ?>
        </section>
    </main>

    <?php include($templatePath . 'footer.php'); ?>

</body>

</html>