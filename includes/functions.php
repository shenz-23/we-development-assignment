<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check whether user is logged in
function require_login() {

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }

}

// Check whether user is an administrator
function require_admin() {

    require_login();

    if (!isset($_SESSION['role']) ||
        $_SESSION['role'] !== 'admin') {

        header("Location: ../index.php");
        exit();
    }

}

?>