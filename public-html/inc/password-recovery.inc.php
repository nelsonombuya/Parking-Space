<?php
    /* Short Script for Changing the Password... Don't Mind Me */
    require_once __DIR__ . "/../../config/config.inc.php";

    /* First of all, we check whether the user exists */
    $email = $_POST['email'];   // The user's input email address

    if ($Session->doesUserExist($email))
    {
        /* Creating a temporary key for the user */
        $key = $Session->generateTemporaryKey($email);

        /* TODO: Code for sending the user the email */
        echo "<a href='". HEADER_ROOT ."/password-reset.php?email=$email&reset_key=$key'>HERE'S A TEST LINK</a>";  // Dummy link
    }
    else
    {
        /* If the user email doesn't exist, return the error to the user */
        header ("Location: ../password-recovery.php?error=recover-password-email-dne") or die();
    }
?>