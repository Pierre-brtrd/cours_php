<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/features.php');
include_once('../../requetes/users.php');

if (isset($_POST['create_nom']) && isset($_POST['create_desc'])) {
    $name = $_POST['create_nom'];
    $desc = $_POST['create_desc'];
}

if (!empty($name) && !empty($desc)) {
    if (isset($_FILES['create_image']) && $_FILES['create_image']['error'] == 0) {
        if ($_FILES['create_image']['size'] <= 1000000) {
            $fileInfo = pathinfo($_FILES['create_image']['name']);
            $extension = $fileInfo['extension'];
            $extensionAllowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($extension, $extensionAllowed)) {
                $file = str_replace(" ", "-", $_FILES['create_image']['name']);
                move_uploaded_file(str_replace(" ", "-", $_FILES['create_image']['tmp_name']), $uploadUrl . $file);
                $image = $file;
            }
        }
    } else {
        $image = NULL;
    }

    $sqlQuery = "INSERT INTO features(feature_name, feature_desc, feature_image) VALUE (:nom, :desc, :img)";
    $sqlStatement = $db->prepare($sqlQuery);
    $sqlStatement->execute([
        'nom' => $name,
        'desc' => $desc,
        'img' => $image,
    ]);
} else {
    $errorMessageCreate = true;
}

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
    <title>Ajout feature - Cours PHP</title>
</head>

<body>

    <?php include($templatePath . 'header.php'); ?>
    <?php include($templatePath . 'login.php'); ?>

    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
        <?php if (isset($errorMessageCreate)) : ?>
            <section>
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <h5 class="card-title">Erreur dans le formulaire</h5>
                        </div>
                    </div>
                </div>
            </section>

        <?php else : ?>

            <section>
                <h1>Feature ajoutée</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rappel des informations</h5>
                        <p class="card-text"><b>Nom</b> : <?php echo strip_tags($name); ?></p>
                        <p class="card-text"><b>Description</b> : <?php echo strip_tags($desc); ?></p>
                        <p class="card-text"><b>Image</b> : <?php echo strip_tags($image); ?></p>
                    </div>
                </div>
            </section>

            <section>
                <a class="btn-form" href="<?php echo $rootURL; ?>/admin/features/liste_features.php">Retour features</a>
            </section>
        <? endif; ?>

    <? endif; ?>

</body>

</html>