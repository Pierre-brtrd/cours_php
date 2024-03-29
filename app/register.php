<?php

session_start();

include_once('/app/config/variables.php');
include_once($rootPath . 'requests/users.php');

// Validation du form
if (
    !empty($_POST['email'])
    && !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['password'])
) {
    $token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);

    if (!$token || $token !== $_SESSION['token']) {
        $errorMessage = 'Une erreur est survenue, token invalide';
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $_POST['password'];

        // On vérifie s'il y a une image d'upload et qu'il n'y a pas d'erreur
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            // On vérifie la taille du fichier
            if ($_FILES['image']['size'] <= 8000000) {
                // On vérifie l'extension du fichier
                $fileInfo = pathinfo($_FILES['image']['name']);
                $extension = $fileInfo['extension'];
                $extensionAllowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

                if (in_array($extension, $extensionAllowed)) {
                    // Déplacer le fichier dans le bon dossier
                    $imageUploadName = str_replace(' ', '-', $fileInfo['filename']) . (new DateTime())->format('Y-m-d_H:i:s') . '.' . $fileInfo['extension'];

                    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/users/' . $imageUploadName);
                } else {
                    $errorMessage = 'Fichier invalide, veuillez télécharger un fichier de type image';
                }
            } else {
                $errorMessage = "Fichier trop volumineux, la limite est de 8M";
            }
        }

        $isEmailExist = findUserByEmail($email);

        if (!$isEmailExist && !isset($errorMessage)) {
            $response = addUser($nom, $prenom, $email, $password, ["ROLE_USER"], isset($imageUploadName) ? $imageUploadName : null);
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
    <title>Inscription - My app Php</title>
</head>

<body>

    <?php include_once($templatePath . 'header.php'); ?>

    <main>
        <section>
            <?php if (!isset($response)) : ?>
                <div class="form-content">
                    <h1>Inscription</h1>
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
                            <div class="input-group">
                                <label for="image">Image:</label>
                                <input type="file" name="image">
                            </div>
                        </div>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </form>
                </div>
            <?php else : ?>
                <?php if ($response) : ?>
                    <div class="alert alert-success">
                        <p>Vous êtes bien inscrit sur notre application.</p>
                    </div>
                <?php else : ?>
                    <div class="alert alert-danger">
                        <p>Une erreur est survenue</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </main>

    <?php include_once($templatePath . 'footer.php'); ?>

</body>

</html>