<?php
session_start();

include('/app/config/variables.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/main.css">
    <link rel="stylesheet" href="./assets/styles/contact.css">
    <link rel="shortcut icon" href="./assets/favicon/favicon.ico" type="image/x-icon">
    <title>Cours PHP</title>
</head>

<body>
    <?php include('templates/header.php'); ?>

    <main>
        <section>
            <?php if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['message']) && !empty($_POST['message'])) : ?>
                <div class="card">
                    <div class="card-body">
                        <h5>Rappel des informations</h5>
                        <p><b>Nom :</b> <?php echo strip_tags($_POST['nom']); ?> </p>
                        <p><b>Message :</b> <?php echo strip_tags($_POST['message']); ?></p>
                        <?php

                        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                            // Le fichier existe et il n'y a pas d'erreurs
                            if ($_FILES['image']["size"] <= 1000000) {
                                // Le fichier est de bonne taille

                                $infoFile = pathinfo($_FILES['image']['name']);
                                $extension = $infoFile['extension'];
                                $extensionAllowed = ['jpeg', 'jpg', 'png', 'gif'];

                                if (in_array($extension, $extensionAllowed)) {
                                    // L'extension du fichier est valide
                                    $fileName = str_replace(" ", "-", $_FILES['image']['name']);
                                    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $fileName);

                                    echo "<p>Votre fichier a bien été envoyé.</p>";
                                }
                            }
                        }

                        ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-danger">
                    <p>Erreur dans le formulaire</p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php include('templates/footer.php'); ?>
</body>

</html>