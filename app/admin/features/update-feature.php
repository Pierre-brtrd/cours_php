<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/features.php');
include_once('../../requetes/users.php');

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

    $featureUpdate = $sqlStatement->fetch(PDO::FETCH_ASSOC);
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
    <title>Modif Feature - Cours PHP</title>
</head>

<body>


    <?php include($templatePath . 'header.php'); ?>

    <main>
        <section>
            <?php include($templatePath . 'login.php'); ?>
        </section>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>

            <section>
                <?php if (isset($errorMessageId)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessageId; ?>
                    </div>

                <?php else : ?>
                    <h1>Page de modification feature <?php echo $featureUpdate['feature_name']; ?></h1>
                    <form class="form-contact" action="post_feature_update.php" method="POST" enctype="multipart/form-data">
                        <div class="contact">
                            <div class="hidden">
                                <label for="id">Identifiant de la feature</label>
                                <input type="hidden" name="id" value="<?php echo $featureUpdate['id']; ?>">
                            </div>
                            <div class="input-group">
                                <label for="create_nom">Nom :</label>
                                <input type="text" name="create_nom" placeholder="Votre nom" value="<?php echo strip_tags($featureUpdate['feature_name']); ?>">
                            </div>
                            <div class="input-group">
                                <label for="create_desc">Description :</label>
                                <textarea name="create_desc" placeholder="Message..." rows="5" cols="50"><?php echo strip_tags($featureUpdate['feature_desc']); ?></textarea>
                            </div>
                            <div class="input-group">
                                <label for="create_image">Image :</label>
                                <input type="file" name="create_image" value="<?php echo strip_tags($featureUpdate['feature_image']); ?>">
                            </div>
                        </div>
                        <button class="btn-form" type="submit">Envoyer</button>
                    </form>

                <?php endif; ?>

            </section>
        <?php endif; ?>
    </main>

    <?php include($templatePath . 'footer.php'); ?>

</body>

</html>