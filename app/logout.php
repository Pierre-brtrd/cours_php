<?php

session_start();

if (isset($_SESSION['LOGGED_USER'])) {
    session_destroy();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
