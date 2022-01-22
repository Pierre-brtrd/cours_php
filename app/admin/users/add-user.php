<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/users.php');
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
    <title>Créer user - Cours PHP</title>
</head>

<body>


    <?php include($templatePath . 'header.php'); ?>

    <main>
        <section>
            <?php include($templatePath . 'login.php'); ?>
        </section>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>

            <section>
                <h1>Page de création d'un utilisateur</h1>
                <form class="form-user" action="post_create.php" method="POST" enctype="multipart/form-data">
                    <div class="form-login-input">
                        <div class="input-group">
                            <label for="email">Nom :</label>
                            <input type="text" name="create_nom" placeholder="Votre nom">
                        </div>
                        <div class="input-group">
                            <label for="email">Email :</label>
                            <input type="email" name="create_email" placeholder="you@exemple.com">
                        </div>
                        <div class="input-group">
                            <label for="password">Mot de passe :</label>
                            <input type="password" name="create_password" placeholder="Mot de passe">
                        </div>
                        <div class="input-group">
                            <label for="create_image">Image :</label>
                            <input type="file" name="create_image" placeholder="Insérer une image" value="<?php echo strip_tags($userUpdate['image']); ?>">
                        </div>
                        <div class="input-group">
                            <label for="actif">Actif :</label>
                            <input type="text" name="create_actif" list="is_actif">
                            <datalist id="is_actif">
                                <option value="true">
                                <option value="false">
                            </datalist>
                        </div>
                    </div>
                    <button class="btn-form" type="submit">Envoyer</button>
                </form>
            </section>
        <?php endif; ?>
    </main>

    <?php include($templatePath . 'footer.php'); ?>

</body>

</html>