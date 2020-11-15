<?php
    /* Short Script for Logging In... Don't Mind Me */
    require_once __DIR__ . "/../../config/config.inc.php";
    require_once CLASSES . "sign-up.class.php";

    /* Adding variables as an array */
    $user_details['first_name'] = $_POST["First-Name"];
    $user_details['last_name']  = $_POST["Last-Name"];
    $user_details['username']   = $_POST["Username"];
    $user_details['email']   = $_POST["email"];
    $user_details['number_plate'] = $_POST["numberplate"];
    $user_details['id_number']   = $_POST["ID-No"];
    $user_details['password']   = $_POST["password"];
    $user_details['phone']   = $_POST["phone"];

    /* Signing Up */
    $SignUp = new SignUp($user_details) or die();
?>