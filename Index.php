<?
    // Used to redirect the user to the page version depending on their choice
    
    // Including the SQL Script Used to check the connection to the DB 
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/SQL.php";   

    // Checking if the connection is made
    if (checkConnection() !== TRUE){
        // If there are connection problems using the default settings... 
        // Send the user to the Setup Page
        header("Location: Resources/Scripts/Setup.php") or die();
    }

    // Redirecting to correct Index.php
    header("Location: ". relative_root_dir) or die();
?>