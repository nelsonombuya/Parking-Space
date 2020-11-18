<?php
    /* Short Script for Logging In... Don't Mind Me */
    require_once __DIR__ . "/../../config/config.inc.php";
    require_once CLASSES . "login.class.php";
    new Login($_POST['login_username'], $_POST['login_password']) or die(); 
?>