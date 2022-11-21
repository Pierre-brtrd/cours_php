<header>
    <nav class="navbar">
        <div class="container navbar-content">
            <h3>
                <a href="<? echo $rootUrl; ?>">Accueil</a>
            </h3>
            <ul class="navbar-list">
                <?php if (in_array('ROLE_ADMIN', !empty($_SESSION['LOGGED_USER']['roles']) ? $_SESSION['LOGGED_USER']['roles'] : [])) : ?>
                    <li><a href="<? echo $rootUrl; ?>/admin">Admin</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                    <li><a href="<? echo $rootUrl; ?>/logout.php">Déconnexion</a></li>
                <?php else : ?>
                    <li><a href="<? echo $rootUrl; ?>/login.php">Se connecter</a></li>
                    <li><a href="<? echo $rootUrl; ?>/register.php">S'insccrire</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>