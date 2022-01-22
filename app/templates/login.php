<?php

// VALIDATION DU FORMULAIRE

if (isset($_POST['nom']) && isset($_POST['password'])) {
    foreach ($users as $user) {
        if ($user['nom'] === $_POST['nom'] && ((password_verify($_POST['password'], $user['password']) == true) || $_POST['password'] === $user['password'])) {
            $_SESSION['LOGGED_USER'] = $user['nom'];
        } else {
            $errorMessage = sprintf(
                "Les informations envoyées ne permettent pas de vous identifier : (%s/%s)",
                $_POST['nom'],
                $_POST['password']
            );
        }
    }
}

// Redirection page
if (isset($_SERVER['HTTP_REFERER'])) {
    $lastPage = $_SERVER["HTTP_REFERER"];
} else {
    $lastPage = $rootURL;
}
?>
<!-- SI PAS CONNECTÉ AFFICHAGE DU FORMULAIRE -->
<?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
    <section>
        <div class="form-login-area">
            <h1>Connectez-vous</h1>
            <p>Pour avoir accès au site</p>
            <form class="form-login" action="<?php echo $lastPage; ?>" method="POST">
                <!-- Si erreur, on affiche le message d'erreur -->
                <?php if (isset($errorMessage)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>
                <div class="form-login-input">
                    <div class="input-group">
                        <label for="email">Nom :</label>
                        <input type="text" name="nom" placeholder="Votre nom">
                    </div>
                    <div class="input-group">
                        <label for="password">Mot de passe :</label>
                        <input type="password" name="password" placeholder="Mot de passe">
                    </div>
                </div>
                <button class="btn-form" type="submit">Envoyer</button>
            </form>
        </div>
    </section>
<?php endif; ?>