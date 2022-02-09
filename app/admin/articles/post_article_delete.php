<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/features.php');
include_once('../../requetes/users.php');
include_once('../../requetes/articles.php');

if (!empty($_POST['create_id'])) {

    $id = $_POST['create_id'];

    $sqlQuery = 'DELETE FROM articles WHERE article_id= :id';

    $deleteFeature = $db->prepare($sqlQuery);

    $deleteFeature->execute([
        'id' => $id,
    ]);
} else {
    $errorMessageDelete = 'Il y a une erreur';
}

header('refresh:1;url="' . $rootURL . '/admin/articles"');

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
    <title>Suppression article - Cours PHP</title>
</head>

<body>

    <?php include($templatePath . 'header.php'); ?>
    <?php include($templatePath . 'login.php'); ?>

    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
        <?php if (isset($errorMessageDelete)) : ?>
            <section>

                <div class="alert alert-danger" role="alert">
                    <p class="card-title"><b><? echo $errorMessageDelete; ?></b></p>
                </div>

            </section>

        <?php else : ?>
            <section>
                <div class="alert alert-success">
                    <p class="card-title"><b>Article supprimé</b></p>
                </div>
            </section>
        <? endif; ?>

    <? endif; ?>

</body>

</html>