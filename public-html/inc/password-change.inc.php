<?php
    /* Short Script for Changing the Password... Don't Mind Me */
    require_once __DIR__ . "/../../config/config.inc.php";
    if ($Session->changePassword($_SESSION['username'], $_POST['password']))
    {
        header ("Location: ../password-change.php?error=success") or die();
    }
    else
    {   
        header ("Location: ../password-change.php?error=change_password-fail") or die();
    }
?>