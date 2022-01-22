<?php
session_start();

include_once('config/mysql.php');
include_once('config/variables.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/main.css">
    <link rel="stylesheet" href="./assets/styles/index.css">
    <link rel="shortcut icon" href="./assets/favicon/favicon.ico" type="image/x-icon">
    <title>Contact - Cours PHP</title>
</head>

<body>


    <?php include('templates/header.php'); ?>

    <main>
        <section>
            <?php include('templates/login.php'); ?>
        </section>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <section>
                <article>
                    <?php if ((!isset($_POST['nom']) || empty($_POST['nom'])) || (!isset($_POST['message']) || empty($_POST['message']))) : ?>

                        <h1>Erreur dans le formulaire</h1>

                    <?php else : ?>

                        <h1>Message bien reçu !</h1>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Rappel de vos informations</h5>
                                <p class="card-text"><b>Nom</b> : <?php echo $_POST['nom']; ?></p>
                                <p class="card-text"><b>Message</b> : <?php echo strip_tags($_POST['message']); ?></p>
                            </div>
                            <?php if (isset($_FILES["image"]) && $_FILES["image"]['error'] == 0) : ?>

                                <?php if ($_FILES['image']['size'] <= 1000000) {
                                    $fileInfo = pathinfo($_FILES['image']['name']);
                                    $extension = $fileInfo['extension'];
                                    $extensionAllowed = ['jpg', 'jpeg', 'gif', 'png'];

                                    if (in_array($extension, $extensionAllowed)) {
                                        $file = str_replace(" ", "-", $_FILES['image']['name']);
                                        move_uploaded_file(str_replace(" ", "-", $_FILES['image']['tmp_name']), 'uploads/' . $file);
                                ?>
                                        <p class="card-text"><b>Fichier</b> : <?php echo strip_tags($file); ?></p>
                                <?php }
                                }
                                ?>
                            <?php else : ?>
                                <p class="card-text"><b>Fichier</b> : Vous n'avez pas transmit de fichier</p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </article>
            </section>
        <?php endif; ?>
    </main>

    <?php include('templates/footer.php'); ?>

</body>

</html>