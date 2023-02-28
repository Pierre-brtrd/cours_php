<?php

session_start();

include_once('/app/config/variables.php');
include_once($rootPath . 'requests/users.php');
include_once($rootPath . 'utils/utils.php');


if (!isset($_SESSION['LOGGED_USER']) || !in_array('ROLE_ADMIN', $_SESSION['LOGGED_USER']['roles'])) {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];

    header("Location:$rootUrl/login.php");
}

// Validation du form
if (
    !empty($_POST['email'])
    && !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['password'])
    && !empty($_POST['roles'])
) {
    $token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);

    if (!$token || $token !== $_SESSION['token']) {
        $errorMessage = 'Une erreur est survenue, token invalide';
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $_POST['password'];
        $roles = $_POST['roles'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $statusImage = addImage('users');

            if ($statusImage) {
                $imageUploadName = $statusImage;
            } else {
                $errorMessage = 'Une erreur est survenue lors du chargement de l\'image';
            }
        }

        $isEmailExist = findUserByEmail($email);

        $response = addUser($nom, $prenom, $email, $password, $roles, isset($imageUploadName) ? $imageUploadName : null);

        if (!$isEmailExist && $response) {
            $_SESSION['message']['success'] = "User created successfully";

            header("Location:$rootUrl/admin/users");
        } else {
            $errorMessage = isset($errorMessage) ? $errorMessage : "L'email est déjà utilisé par un autre compte";
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
    <link rel="stylesheet" href="<?= $stylePath ?>main.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Créer un user - My app Php</title>
</head>

<body>

    <?php include_once($templatePath . 'header.php'); ?>

    <main>
        <section>
            <div class="form-content">
                <h1>Création d'utilisateur</h1>
                <?php if (isset($errorMessage)) : ?>
                    <div class="alert alert-danger">
                        <p><?= $errorMessage; ?></p>
                    </div>
                <?php endif; ?>
                <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="input-group">
                            <label for="nom">Nom:</label>
                            <input type="text" name="nom" placeholder="Doe" required>
                        </div>
                        <div class="input-group">
                            <label for="prenom">Prénom:</label>
                            <input type="text" name="prenom" placeholder="John" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" placeholder="exemple@test.com" required>
                        </div>
                        <div class="input-group">
                            <label for="password">Mot de passe:</label>
                            <input type="password" name="password" placeholder="S3CR3T" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <label>Roles:</label>
                        <div class="input-group">
                            <label for="roles[]">User</label>
                            <input type="checkbox" name="roles[]" value="ROLE_USER" checked>
                            <label for="roles[]">Admin</label>
                            <input type="checkbox" name="roles[]" value="ROLE_ADMIN">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </section>
    </main>

    <?php include_once($templatePath . 'footer.php'); ?>

</body>

</html>