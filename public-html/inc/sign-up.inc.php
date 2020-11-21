<?php
    /* Short Script for Signing Up... Don't Mind Me */
    require_once __DIR__ . "/../../config/config.inc.php";
    require_once CLASSES . "sign-up.class.php";

    /* Adding variables as an array */
    $signup_details['first_name'] = $_POST["first_name"];
    $signup_details['last_name']  = $_POST["last_name"];
    $signup_details['username']   = $_POST["username"];
    $signup_details['email']   = $_POST["email"];
    $signup_details['number_plate'] = $_POST["number_plate"];
    $signup_details['id_number']   = $_POST["id_number"];
    $signup_details['phone']   = $_POST["phone"];
    $signup_details['password']   = $_POST["password"];
    
    /* Signing Up */
    new SignUp($signup_details) or die();

    /* -TEST- */
    // header ("Location: ../sign-up.php?error=signup_user-exists");
?>