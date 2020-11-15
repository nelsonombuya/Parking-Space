<?php
    /* Short Script for Changing the Password... Don't Mind Me */
    require_once __DIR__ . "/../../config/config.inc.php";
    
    if ($error = $Session->changePassword($_SESSION['username'], $_POST['old-password'], $_POST['new-password']) === TRUE)
    {
        header ("Location: ../password-change.php?error=success") or die();
    }
    else
    {   
        header ("Location: ../password-change.php?error=$Session->session_error") or die();
    }
?>