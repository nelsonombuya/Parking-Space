<?php
    // REQUIREMENTS
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Parser.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/SQL.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Session.php";

    // CLASSES
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Classes/SQL.class.php";

    // EXTERNAL CLASSES AND SCRIPTS
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/External.inc.php";

    // Checking if the connection is made
    if (checkConnection() !== TRUE){
        // If there are connection problems using the default settings... 
        // Send the user to the Setup Page
        header("Location: /Resources/Scripts/Setup.php") or die();
    }
?>