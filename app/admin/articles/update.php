<?php
session_start();

include_once('/app/config/variables.php');
include_once($rootPath . 'requests/articles.php');
include_once($rootPath . 'requests/users.php');
include_once($rootPath . '/utils/utils.php');

if (!isset($_SESSION['LOGGED_USER']) || !in_array('ROLE_ADMIN', $_SESSION['LOGGED_USER']['roles'])) {
    $_SESSION['redirect'] = $_SERVER['PHP_SELF'];

    header("Location:$rootUrl/login.php", false);
}

$article = findArticleById(isset($_GET['id']) ? (int) $_GET['id'] : 0);

if (!$article) {
    $_SESSION['message']['error'] = "Article not found";

    header("Location:$rootUrl/admin/articles");
}

// Validation du form
if (
    !empty($_POST['titre'])
    && !empty($_POST['description'])
    && !empty($_POST['auteur'])
) {
    $token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);

    if (!$token || !hash_equals($_SESSION['token'], $token)) {
        $errorMessage = "Une erreur est survenue, token invalid";
    } else {
        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
        $auteur = filter_input(INPUT_POST, 'auteur', FILTER_SANITIZE_NUMBER_INT);

        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $statusImage = addImage('articles', $article, true);

            if ($statusImage) {
                $imageUploadName = $statusImage;
            } else {
                $errorMessage = 'Une erreur est survenue lors du chargement de l\'image';
            }
        }

        if (!isset($errorMessage) && updateArticle($article['id'], $titre, $description, $auteur, isset($imageUploadName) ? $imageUploadName : null)) {
            $_SESSION['message']['success'] = "Article updated successfully";

            header("Location:$rootUrl/admin/articles");
        } else {
            $errorMessage = isset($errorMessage) ? $errorMessage : "Une erreur est survenue, veuillez réessayer";
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
    <link rel="stylesheet" href="<?= $stylePath; ?>main.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <title>Modifier article - Cours PHP</title>
</head>

<body>
    <?php include($templatePath . 'header.php'); ?>
    <main>
        <section>
            <div class="form-content">
                <h1>Création d'un article</h1>
                <?php if (isset($errorMessage)) : ?>
                    <div class="alert alert-danger">
                        <p><?= $errorMessage; ?></p>
                    </div>
                <?php endif; ?>
                <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
                    <?php if (!empty($article['image'])) : ?>
                        <div class="form-row">
                            <div class="form-img">
                                <img src="/uploads/articles/<?= $article['image'] ?>" alt="<?= strip_tags(html_entity_decode($article['titre'])); ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="titre">Titre:</label>
                            <input type="text" name="titre" placeholder="Un super titre" required value="<?= strip_tags(html_entity_decode($article['titre'])); ?>">
                        </div>
                        <div class="input-group">
                            <label for="auteur">Auteur :</label>
                            <select type="text" name="auteur" list="auteur_list" placeholder="Sélectionner un auteur">
                                <? foreach (findAllUsers() as $user) : ?>
                                    <option value="<?= $user['id']; ?>" <?= ($user['id'] === $article['user_id']) ? 'selected' : '' ?>><?= "$user[nom] $user[prenom]"; ?></option>
                                <? endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="" cols="50" rows="7" required placeholder="Contenu de votre article">
                            <?= html_entity_decode($article['description']); ?>
                            </textarea>
                        </div>
                    </div>
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
            <a href="<?= "$rootUrl/admin/articles"; ?>" class="btn btn-success">Retour à la liste</a>
        </section>
    </main>
    <?php include($templatePath . 'footer.php'); ?>
</body>

</html>