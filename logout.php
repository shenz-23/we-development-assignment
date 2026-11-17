<?php
session_start();

$_SESSION = array();
session_destroy();

header("Location: /vehicle_rental/login.html");
exit();
?>