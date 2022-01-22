<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/users.php');

if (isset($_POST['id']) && !empty($_POST['create_email']) && !empty($_POST['create_password']) && !empty($_POST['create_actif'])) {

    if (isset($_FILES['create_image']) && $_FILES['create_image']['error'] == 0) {
        if ($_FILES['create_image']['size'] <= 1000000) {
            $fileInfo = pathinfo($_FILES['create_image']['name']);
            $extension = $fileInfo['extension'];
            $extensionAllowed = ['jpg', 'jpeg', 'gif', 'png'];

            if (in_array($extension, $extensionAllowed)) {
                $file = str_replace(" ", "-", $_FILES['create_image']['name']);
                move_uploaded_file(str_replace(" ", "-", $_FILES['create_image']['tmp_name']), $uploadUrl . $file);
                $image = $file;
            }
        }
    } else {
        $image = NULL;
    }

    $id = $_POST['id'];
    $nom = $_POST['create_nom'];
    $email = $_POST['create_email'];
    $password = password_hash($_POST['create_password'], PASSWORD_DEFAULT);
    $actif = $_POST['create_actif'];

    $sqlQueryUpdateUser = 'UPDATE utilisateurs SET nom= :nom, email= :email, password= :password, image= :img, actif= :actif WHERE id= :id';

    $insertUser = $db->prepare($sqlQueryUpdateUser);

    $insertUser->execute([
        'id' => $id,
        'nom' => $nom,
        'email' => $email,
        'password' => $password,
        'img' => $image,
        'actif' => $actif,
    ]);
} else {
    $errorMessageUpdate = 'Il y a une erreur :';
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
    <title>Modification utilisateur - Cours PHP</title>
</head>

<body>


    <?php include($templatePath . 'header.php'); ?>

    <main>
        <section>
            <?php include($templatePath . 'login.php'); ?>
        </section>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <?php if (isset($errorMessageUpdate)) : ?>
                <section>
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger" role="alert">
                                <h5 class="card-title">Erreur dans le formulaire</h5>
                                <p><?php echo ($errorMessageUpdate); ?></p>
                            </div>
                        </div>
                    </div>
                </section>

            <?php else : ?>
                <section>
                    <h1>Utilisateur modifié</h1>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rappel des informations</h5>
                            <p class="card-text"><b>Nom</b> : <?php echo $_POST['create_nom']; ?></p>
                            <p class="card-text"><b>email</b> : <?php echo strip_tags($_POST['create_email']); ?></p>
                            <? if (isset($image)) : ?>
                                <p class="card-text"><b>Image</b> : <?php echo strip_tags($image); ?></p>
                            <? endif; ?>
                            <p class="card-text"><b>actif</b> : <?php echo strip_tags($_POST['create_actif']); ?></p>
                        </div>
                    </div>
                </section>
                <section>
                    <a class="btn-form" href="<?php echo $rootURL; ?>/admin/users/liste_user.php">Retour utilisateurs</a>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    </main>

    <?php include($templatePath . 'footer.php'); ?>

</body>

</html>