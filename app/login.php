<?php

session_start();

include_once('/app/config/variables.php');
include_once($rootPath . 'requests/users.php');

// Validation du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    $user = findUserByEmail($_POST['email']);

    if ($user && password_verify($_POST['password'], $user['password'])) {
        // Email trouvé en bdd et password correspondant
        $_SESSION['LOGGED_USER'] = [
            'id' => $user['id'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'email' => $user['email'],
            'roles' => json_decode($user['roles']),
        ];

        if (!empty($_SESSION['redirect'])) {
            if ($_SESSION['redirect'] !== $_SERVER['REQUEST_URI']) {
                $url = $_SESSION['redirect'];
                unset($_SESSION['redirect']);
            } else {
                $url = $rootUrl;
            }
        } else {
            $url = $rootUrl;
        }

        header("Location:$url");
    } else {
        $errorMessage = sprintf(
            "Les information envoyées ne permettent pas de vous identifier : (%s/%s)",
            $_POST['email'],
            $_POST['password'],
        );
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $stylePath ?>main.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Se connecter - My app Php</title>
</head>

<body>

    <?php include_once($templatePath . 'header.php'); ?>

    <main>
        <section>
            <div class="form-content">
                <h1>Connectez-vous</h1>
                <p>Pour avoir accès au site</p>
                <form action="<?= $_SERVER['REQUEST_URI']; ?>" class="form-login" method="POST">
                    <?php if (isset($errorMessage)) : ?>
                        <div class="alert alert-danger">
                            <?= $errorMessage ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email">
                        </div>
                        <div class="input-group">
                            <label for="password">Votre mot de passe:</label>
                            <input type="password" name="password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
                <a href="<?= "$rootUrl/register.php"; ?>" class="link-signup">Pas encore de compte ?</a>
            </div>
        </section>
    </main>

    <?php include_once($templatePath . 'footer.php'); ?>
</body>

</html>