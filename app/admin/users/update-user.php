<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/users.php');

foreach ($users as $user => $userInfo) {
    if (in_array($_GET['id'], $users[$user])) {
        $searchId = true;
    }
}

if (!isset($searchId)) {
    $errorMessageId = "Il faut un id valide";
} else {
    $sqlQueryGetUser = 'SELECT * FROM utilisateurs WHERE id =:id';
    $getUserStatement = $db->prepare($sqlQueryGetUser);

    $getUserStatement->execute([
        'id' => $_GET['id'],
    ]);

    $userUpdate = $getUserStatement->fetch(PDO::FETCH_ASSOC);
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
    <title>Modif utilisateur - Cours PHP</title>
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
                    <h1>Page de modification utilisateur <?php echo $userUpdate['nom']; ?></h1>
                    <form class="form-contact" action="post_update.php" method="POST" enctype="multipart/form-data">
                        <div class="contact">
                            <div class="hidden">
                                <label for="id">Identifiant de l'utilisateurs</label>
                                <input type="hidden" name="id" value="<?php echo $userUpdate['id']; ?>">
                            </div>
                            <div class="input-group">
                                <label for="create_nom">Nom :</label>
                                <input type="text" name="create_nom" placeholder="Votre nom" value="<?php echo strip_tags($userUpdate['nom']); ?>">
                            </div>
                            <div class="input-group">
                                <label for="create_email">Email :</label>
                                <input type="email" name="create_email" placeholder="you@exemple.com" value="<?php echo strip_tags($userUpdate['email']); ?>">
                            </div>
                            <div class="input-group">
                                <label for="create_password">Mot de passe :</label>
                                <input type="password" name="create_password" placeholder="Mot de passe" value="<?php echo strip_tags($userUpdate['password']); ?>">
                            </div>
                            <div class="input-group">
                                <label for="create_image">Image :</label>
                                <input type="file" name="create_image" value="<?php echo strip_tags($userUpdate['image']); ?>">
                            </div>
                            <div class="input-group">
                                <label for="create_actif">Actif :</label>
                                <input type="text" name="create_actif" value="<?php echo strip_tags($userUpdate['actif']); ?>" list="is_actif">
                                <datalist id="is_actif">
                                    <option value="true">
                                    <option value="false">
                                </datalist>
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