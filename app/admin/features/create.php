<?php
session_start();

include("/app/config/variables.php");
include($rootPath . 'requests/features.php');
include_once($rootPath . '/utils/utils.php');

if (!isset($_SESSION['LOGGED_USER']) || !in_array('ROLE_ADMIN', $_SESSION['LOGGED_USER']['roles'])) {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];

    header("Location:$rootUrl/login.php");
}

// Validation du form
if (
    !empty($_POST['name'])
) {
    $token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);

    if (!$token || $token !== $_SESSION['token']) {
        $errorMessage = 'Une erreur est survenue, token invalide';
    } else {
        $titre = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $statusImage = addImage('features');

            if ($statusImage) {
                $imageUploadName = $statusImage;
            } else {
                $errorMessage = 'Une erreur est survenue lors du chargement de l\'image';
            }
        }

        if (!isset($errorMessage) && addFeature($titre, isset($imageUploadName) ? $imageUploadName : null)) {
            $_SESSION['message']['success'] = "Feature created successfully";

            header("Location:$rootUrl/admin/features");
        } else {
            $errorMessage = isset($errorMessage) ? $errorMessage : "Une erreur est survenue, veuillez réessayer";
        }
    }
} else {
    $_SESSION['token'] = bin2hex(random_bytes(35));
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $stylePath; ?>main.css">
    <link rel="stylesheet" href="<?= $stylePath; ?>index.css">
    <link rel="shortcut icon" href="../../assets/favicon/favicon.ico" type="image/x-icon">
    <title>Création feature - Cours PHP</title>
</head>

<body>
    <? include($templatePath . 'header.php') ?>
    <main>
        <section>
            <div class="form-content">
                <h1>Création d'une feature</h1>
                <?php if (isset($errorMessage)) : ?>
                    <div class="alert alert-danger">
                        <p><?= $errorMessage; ?></p>
                    </div>
                <?php endif; ?>
                <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="input-group">
                            <label for="name">Titre:</label>
                            <input type="text" name="name" placeholder="Nom de la feature" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </section>
    </main>
    <? include($templatePath . 'footer.php') ?>
</body>

</html>