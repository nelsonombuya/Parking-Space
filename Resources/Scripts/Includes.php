<?
    // All the necessary files to be included in a page
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Parser.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/SQL.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Session.php";

    // Checking if the connection is made
    if (checkConnection() !== TRUE){
        // If there are connection problems using the default settings... 
        // Send the user to the Setup Page
        header("Location: /Resources/Scripts/Setup.php") or die();
    }
?>