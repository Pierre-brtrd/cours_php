<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/users.php');
include_once('../../requetes/features.php');

foreach ($features as $feature => $featureInfo) {
    if (in_array($_GET['id'], $features[$feature])) {
        $searchId = true;
    }
}

if (!isset($searchId)) {
    $errorMessageId = "Il faut un id valide";
} else {
    $sqlQuery = 'SELECT * FROM features WHERE id =:id';
    $sqlStatement = $db->prepare($sqlQuery);

    $sqlStatement->execute([
        'id' => $_GET['id'],
    ]);

    $featureDelete = $sqlStatement->fetch(PDO::FETCH_ASSOC);
}

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
    <title>Suppression feature - Cours PHP</title>
</head>

<body>


    <?php include($templatePath . 'header.php'); ?>
    <?php include($templatePath . 'login.php'); ?>

    <main>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>

            <section>
                <h1>Page de suppression d'une feature</h1>
                <div class="liste-users" style="margin: 1em 0px;">
                    <div class=" card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $featureDelete['feature_name']; ?></h5>
                            <p class="card-text"><b>Description</b> : <?php echo strip_tags($featureDelete['feature_desc']); ?></p>
                        </div>
                    </div>
                </div>
                <form class="form-user" action="post_feature_delete.php" method="POST">
                    <div class="form-login-input">
                        <div class="hidden">
                            <label for="id">Identifiant de la feature</label>
                            <input type="hidden" name="id" value="<?php echo $featureDelete['id']; ?>">
                        </div>
                        <div class="input-group alert alert-danger">
                            <p><b>Attention la suppression est définitive</b></p>
                        </div>
                    </div>
                    <button class="btn-form" type="submit">Suppresion de l'utilisateur</button>
                </form>
            </section>
        <?php endif; ?>
    </main>

    <?php include($templatePath . 'footer.php'); ?>

</body>

</html>