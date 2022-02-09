<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/users.php');
include_once('../../requetes/features.php');

if (isset($_POST['id']) && !empty($_POST['id'])) {

    $id = $_POST['id'];

    $sqlQuery = 'DELETE FROM features WHERE id= :id';

    $deleteFeature = $db->prepare($sqlQuery);

    $deleteFeature->execute([
        'id' => $id,
    ]);
} else {
    $errorMessageDelete = 'Il y a une erreur';
}

header('refresh:1;url="' . $rootURL . '/admin/features"');

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
    <title>Suppression feature - Cours PHP</title>
</head>

<body>

    <?php include($templatePath . 'header.php'); ?>
    <?php include($templatePath . 'login.php'); ?>

    <main>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <section>
                <?php if (isset($errorMessageDelete)) : ?>

                    <div class="alert alert-danger">
                        <h5 class="card-title">Erreur dans le formulaire</h5>
                        <p><?php echo ($errorMessageDelete); ?></p>
                    </div>

                <?php else : ?>

                    <div class="alert alert-success">
                        <h5 class="card-title">Feature supprimer</h5>
                    </div>

                <?php endif; ?>
            </section>
        <? endif; ?>
    </main>

</body>

</html>