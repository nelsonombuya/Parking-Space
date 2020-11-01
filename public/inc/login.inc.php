<?php
    /* Short Script for Logging In... Don't Mind Me */
    require_once __DIR__ . "/../../config/config.php";
    require_once CLASSES . "login.class.php";
    $Login = new Login($_POST['login_username'], $_POST['login_password']) or die(); 
?>