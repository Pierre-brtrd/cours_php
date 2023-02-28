<?php

session_start();

include_once('/app/config/variables.php');
include_once($rootPath . 'config/mysql.php');
include_once($rootPath . 'requests/users.php');
include_once($rootPath . 'utils/utils.php');

if (!isset($_SESSION['LOGGED_USER']) || !in_array('ROLE_ADMIN', $_SESSION['LOGGED_USER']['roles'])) {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];

    header("Location:$rootUrl/login.php");
}

$user = findUserById(isset($_GET['id']) ? (int) $_GET['id'] : 0);

if (!$user) {
    $_SESSION['message']['error'] = "User not found";

    header("Location:$rootUrl/admin/users");
}

if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['email'])
    && !empty($_POST['roles'])
) {
    $token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);

    if (!$token || !hash_equals($_SESSION['token'], $token)) {
        $errorMessage = 'Une erreur est survenue sur le token, veuillez réessayer';
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $roles = $_POST['roles'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $statusImage = addImage('users', $user, true);

            if ($statusImage) {
                $imageUploadName = $statusImage;
            } else {
                $errorMessage = 'Une erreur est survenue lors du chargement de l\'image';
            }
        }

        if (!isset($errorMessage)) {
            if (updateUser($user['id'], $nom, $prenom, $email, $roles, isset($imageUploadName) ? $imageUploadName : $_POST['delete-img'])) {
                $_SESSION['message']['success'] = 'User updated successfully.';

                header("Location:$rootUrl/admin/users");
            } else {
                $errorMessage = isset($errorMessage) ? $errorMessage : 'Une erreur est survenue, veuillez réessayer';
            }
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
    <link rel="stylesheet" href="<?= $stylePath ?>user.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Modifier un User - My app Php</title>
</head>

<body>

    <?php include_once($templatePath . 'header.php'); ?>

    <main>

        <section>
            <div class="form-content">
                <h1>Modification</h1>
                <?php if (isset($errorMessage)) : ?>
                    <div class="alert alert-danger">
                        <p><?= $errorMessage; ?></p>
                    </div>
                <?php endif; ?>
                <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
                    <?php if (!empty($user['image'])) : ?>
                        <div class="form-row mb-2">
                            <div class="form-img">
                                <img src="/uploads/users/<?= $user['image'] ?>" alt="<?= "$user[prenom] $user[nom]"; ?>">
                            </div>
                        </div>
                        <input type="checkbox" name="delete-img">
                        <label for="delete-img">Suprimer image ?</label>
                    <?php endif; ?>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="nom">Nom:</label>
                            <input type="text" name="nom" placeholder="Doe" required value="<?= strip_tags($user['nom']); ?>">
                        </div>
                        <div class="input-group">
                            <label for="prenom">Prénom:</label>
                            <input type="text" name="prenom" placeholder="John" required value="<?= strip_tags($user['prenom']); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" placeholder="exemple@test.com" required value="<?= strip_tags($user['email']); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <label>Roles:</label>
                        <div class="input-group">
                            <label for="roles[]">User</label>
                            <input type="checkbox" name="roles[]" value="ROLE_USER" <?= in_array('ROLE_USER', json_decode($user['roles'])) ? 'checked' : null; ?>>
                            <label for="roles[]">Admin</label>
                            <input type="checkbox" name="roles[]" value="ROLE_ADMIN" <?= in_array('ROLE_ADMIN', json_decode($user['roles'])) ? 'checked' : null; ?>>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
            <a href="<?= "$rootUrl/admin/users"; ?>" class="btn btn-success">Retour à la liste</a>
        </section>
    </main>
    <?php include_once($templatePath . 'footer.php'); ?>

</body>

</html>