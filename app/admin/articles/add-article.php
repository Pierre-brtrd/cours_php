<?php
session_start();

include_once('../../config/mysql.php');
include_once('../../config/variables.php');
include_once('../../requetes/users.php');
include_once('../../requetes/features.php');
include_once('../../requetes/articles.php');
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
    <script src="https://cdn.tiny.cloud/1/vp15111dywf4y9mun2o85rzowycoep4c6i6gat3ufcg30427/tinymce/5/tinymce.min.js" sameSite=None referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>
    <title>Créer article - Cours PHP</title>
</head>

<body>


    <?php include($templatePath . 'header.php'); ?>

    <main>
        <section>
            <?php include($templatePath . 'login.php'); ?>
        </section>
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>

            <section>
                <h1>Page de création d'un article</h1>
                <form class="form-user" action="post_article_create.php" method="POST">
                    <div class="form-login-input form-article">
                        <div class="input-group">
                            <label for="create_nom">Titre :</label>
                            <input type="text" name="create_nom" placeholder="Un super titre...">
                        </div>
                        <div class="input-group">
                            <label for="create_auteur">Auteur :</label>
                            <input type="text" name="create_auteur" list="auteur_list">
                            <datalist id="auteur_list">
                                <? foreach ($users as $user) : ?>
                                    <option value="<? echo $user['nom']; ?>">
                                    <? endforeach; ?>
                            </datalist>
                        </div>
                        <div class="input-group input-editor">
                            <label for="create_desc">Contenu :</label>
                            <textarea class="text-editor" id="desctextarea" name="create_desc" placeholder="Description..." rows="5" cols="50"></textarea>
                        </div>
                    </div>
                    <button class="btn-form" type="submit">Envoyer</button>
                </form>
            </section>
        <?php endif; ?>
    </main>

    <?php include($templatePath . 'footer.php'); ?>
</body>

</html>