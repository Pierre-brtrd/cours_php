<?php

session_start();

include_once('/app/config/variables.php');
include_once($rootPath . 'config/mysql.php');
include_once($rootPath . 'requests/users.php');

if (!isset($_SESSION['LOGGED_USER']) || !in_array('ROLE_ADMIN', $_SESSION['LOGGED_USER']['roles'])) {
    $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];

    header("Location:$rootUrl/login.php");
}

if (
    !empty($_POST['id']) && !empty($_POST['token'])
    && $_POST['token'] === $_SESSION['token']
) {
    if (deleteUser($_POST['id'])) {
        $_SESSION['message']['success'] = "Utilisateur supprimé avec succès";
    } else {
        $_SESSION['message']['error'] = "Une erreur est survenue, veuillez réessayer";
    }
} else {
    $_SESSION['message']['error'] = "Une erreur est survenue, veuillez réessayer";
}

header("Location:$rootUrl/admin/users");
