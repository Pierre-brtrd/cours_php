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

    $userDelete = $getUserStatement->fetch(PDO::FETCH_ASSOC);
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
    <title>Suppression user - Cours PHP</title>
</head>

<body>


    <?php include($templatePath . 'header.php'); ?>

    <main>
        <section>
            <?php include($templatePath . 'login.php'); ?>
        </section>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>

            <section>
                <h1>Page de suppression d'un utilisateur</h1>
                <div class="liste-users" style="margin: 1em 0px;">
                    <div class=" card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $userDelete['nom']; ?></h5>
                            <p class="card-text"><b>Email</b> : <?php echo strip_tags($userDelete['email']); ?></p>
                            <p class="card-text"><b>Actif</b> : <?php echo strip_tags($userDelete['actif']); ?></p>
                        </div>
                    </div>
                </div>
                <form class="form-user" action="post_delete.php" method="POST">
                    <div class="form-login-input">
                        <div class="hidden">
                            <label for="id">Identifiant de l'utilisateurs</label>
                            <input type="hidden" name="id" value="<?php echo $userDelete['id']; ?>">
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