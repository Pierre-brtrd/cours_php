<?php
session_start();

include_once('/app/config/variables.php');
include_once($rootPath . 'requests/features.php');

if (!isset($_SESSION['LOGGED_USER']) || !in_array('ROLE_ADMIN', $_SESSION['LOGGED_USER']['roles'])) {
    $_SESSION['redirect'] = $_SERVER['PHP_SELF'];

    header("Location:$rootUrl/login.php", false);
}

if (
    !empty($_POST['id']) && !empty($_POST['token'])
    && hash_equals($_POST['token'], $_SESSION['token'])
) {
    if (deleteFeature($_POST['id'])) {
        $_SESSION['message']['success'] = "Feature supprimé avec succès";
    } else {
        $_SESSION['message']['error'] = "Une erreur est survenue, veuillez réessayer";
    }
} else {
    $_SESSION['message']['error'] = "Une erreur est survenue, veuillez réessayer";
}

header("Location:$rootUrl/admin/features");
