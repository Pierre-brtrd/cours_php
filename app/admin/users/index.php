<?php

session_start();

include_once('/app/config/variables.php');
include_once($rootPath . 'requests/users.php');

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
    <link rel="stylesheet" href="<?= $stylePath ?>main.css">
    <link rel="stylesheet" href="<?= $stylePath ?>user.css">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Admin Users - My app Php</title>
</head>

<body>

    <?php include_once($templatePath . 'header.php'); ?>

    <main>
        <section>
            <h1>Administration des utillisateurs</h1>
            <?php include_once($templatePath . 'messages.php'); ?>
            <a href="<?= "$rootUrl/admin/users/create.php"; ?>" class="btn btn-primary">Créer un user</a>
            <div class="list-users">
                <?php foreach (findAllUsers() as $user) : ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-user-title">
                                <div class="card-user-img">
                                    <?php if ($user['image']) : ?>
                                        <div class="card-img">
                                            <img src="/uploads/users/<?= $user['image']; ?>" alt="<?= "$user[nom] $user[prenom]"; ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h2><?= "$user[nom] $user[prenom]"; ?></h2>
                            </div>
                            <p class="card-text"><b>Email</b> : <?= strip_tags($user['email']); ?></p>
                            <div class="card-btn">
                                <a href="<?= "$rootUrl/admin/users/update.php?id=$user[id]"; ?>" class="btn btn-success">Modifier</a>
                                <form action="<?= "$rootUrl/admin/users/delete.php"; ?>" method="POST" onsubmit="return confirm('Êtes-vous sur de vouloir supprimer ce user')">
                                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                                    <button class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <?php include_once($templatePath . 'footer.php'); ?>

</body>

</html>