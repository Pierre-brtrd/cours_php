<?php
session_start();

include_once('../config/mysql.php');
include_once('../config/variables.php');
include_once('../requetes/users.php');

if (isset($_SESSION['LOGGED_USER'])) {
    session_destroy();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
