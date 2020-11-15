<?php
    /* Short Script for Changing the Password... Don't Mind Me */
    require_once __DIR__ . "/../../config/config.inc.php";

    if ($Session->resetPassword($_SESSION['reset_email'], $_SESSION['reset_key'], $_POST['password']) === TRUE)
    {
        header ("Location: ../password-reset.php?error=success") or die();
    }
    else
    {   
        header ("Location: ../password-reset.php?error=$Session->error") or die();
    }
?>