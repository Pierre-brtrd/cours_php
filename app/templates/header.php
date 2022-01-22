<header>
    <nav class="navbar">
        <div class="container navbar-content">
            <h3 class="logo">
                <a href='<?php echo $rootURL; ?>'>Accueil</a>
            </h3>
            <ul class="navbar-list">
                <? if (isset($_SESSION["LOGGED_USER"])) : ?>
                    <li><a href="<?php echo $rootURL; ?>/admin">Admin</a></li>
                <? endif; ?>
                <li><a href="<? echo $rootURL; ?>/article.php">Article</a></li>
                <li><a href="/templates/logout.php">Déconnexion</a></li>
            </ul>
        </div>
    </nav>
</header>