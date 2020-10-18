<?php
    // Used to redirect the user to the page version depending on their choice
    
    // Including the SQL Script Used to check the connection to the DB 
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Includes.inc.php";   

    // Redirecting to correct Index.php
    header("Location: ". relative_root_dir) or die();
?>