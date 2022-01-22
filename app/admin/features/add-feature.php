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
    <title>Créer feature - Cours PHP</title>
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
                <form class="form-user" action="post_feature_create.php" method="POST" enctype="multipart/form-data">
                    <div class="form-login-input">
                        <div class="input-group">
                            <label for="email">Nom :</label>
                            <input type="text" name="create_nom" placeholder="Feature Name">
                        </div>
                        <div class="input-group">
                            <label for="create_desc">Description :</label>
                            <textarea id="desctextarea" name="create_desc" placeholder="Description..." rows="5" cols="50"></textarea>
                        </div>
                        <div class="input-group">
                            <label for="create_image">Image :</label>
                            <input type="file" name="create_image">
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