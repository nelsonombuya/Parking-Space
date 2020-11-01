<?php
    /* Short Script for Logging In... Don't Mind Me*/
    require_once "Login.class.php";
    $login = new Login($_POST['login_username'], $_POST['login_password']) or die(); 
?>