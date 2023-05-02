<?php
session_start();

include_once '/app/config/variables.php';
include_once $rootPath . 'requests/articles.php';

if (!isset($_SESSION['LOGGED_USER']) || !in_array('ROLE_ADMIN', $_SESSION['LOGGED_USER']['roles'])) {
    $_SESSION['redirect'] = $_SERVER['PHP_SELF'];

    header("Location:$rootUrl/login.php", false);
}

$_SESSION['token'] = bin2hex(random_bytes(35));

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo $stylePath; ?>main.css">
    <link rel="stylesheet" href="<?php echo $stylePath; ?>articles.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <title>Liste articles - Cours PHP</title>
</head>

<body>
    <?php include $templatePath . 'header.php'; ?>
    <main>
        <section>
            <h1>Liste des articles</h1>
            <hr class="separator middle mb-2" />
            <?php include_once $templatePath . 'messages.php'; ?>
            <a class="btn btn-primary" href="<?php echo $rootUrl; ?>/admin/articles/create.php">Ajouter un article</a>
            <div class="list-articles">
                <?php
                $pagination = paginationArticlesWithAuthor(3, isset($_GET['page']) ? $_GET['page'] : 1);
                foreach ($pagination['data'] as $article) : ?>
                    <?php
                    if (strlen($article['description']) < 150) {
                        $description = $article['description'];
                    } else {
                        $description = substr($article['description'], 0, strpos($article['description'], ' ', 150)) . '...';
                    }
                    ?>

                    <div class="card">
                        <?php if ($article['image']) : ?>
                            <img src="/uploads/articles/<?= $article['image']; ?>" alt="<?= $article['titre']; ?>" class="card-img" loading="lazy">
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="card-content">
                                <div class="card-articles-header">
                                    <h2><?php echo $article['titre']; ?></h2>
                                    <em>
                                        <?php if ($article['avatar']) { ?>
                                            <div class="card-articles-img">
                                                <img src="/uploads/users/<?php echo $article['avatar']; ?>" alt="<?php echo "$user[nom] $user[prenom]"; ?>" loading="lazy">
                                            </div>
                                        <?php } ?>
                                        <?= $article['prenom']; ?>
                                    </em>
                                </div>
                                <p>Date : <?= $article['date']; ?></p>
                                <p class="card-text"><b>Description</b> : <?php html_entity_decode($description); ?></p>
                                <div class="card-btn">
                                    <a class="btn btn-success" href="<?php echo $rootUrl . '/admin/articles/update.php?id=' . $article['id']; ?>">Modifier</a>
                                    <form action="<?php echo "$rootUrl/admin/articles/delete.php"; ?>" method="POST" onsubmit="return confirm('Êtes-vous sur de vouloir supprimer ce user')">
                                        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                                        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                        <button class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
            <?php if ($pagination['pages'] > 1) : ?>
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= isset($_GET['page']) && (isset($_GET['page']) ? $_GET['page'] : 1) != 1 ? '' : 'disabled'; ?>">
                            <a class="page-link" href="?page=<?= (isset($_GET['page']) ? $_GET['page'] : 1) > 1 ? $_GET['page'] - 1 : 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $pagination['pages']; $i++) : ?>
                            <li class="page-item <?= $i == (isset($_GET['page']) ? $_GET['page'] : 1) ? 'active' : ''; ?>"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item <?= (isset($_GET['page']) ? $_GET['page'] : 1) == $pagination['pages'] ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?= (isset($_GET['page']) ? $_GET['page'] : 1) > 1 ? $_GET['page'] + 1 : 2; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </section>
    </main>
    <?php include $templatePath . 'footer.php'; ?>
</body>

</html>