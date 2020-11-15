<?php
/*----------------------------------- REQUIREMENTS ------------------------------------*/
    /* Adding the config file */
    require_once __DIR__ . "/../../config/config.inc.php";

    /* 
        These are the scripts run on any page. 
        They assist in Logging Out and The first time setup of the System 
    */
    /* Checking if the connection to the server is made */
    if ($Session->connection_status !== "sql_connected_db")
    {
        /* 
            If there are connection problems using the default settings... 
            Send the user to the Setup Page
        */
        header("Location: ". HEADER_ROOT . "/setup.php?state=new") or die();
    }

    /* Logging out the user when needed */
    if (isset($_GET['logout'])) isset($_GET['logout_confirmed']) ? $Session->logout(TRUE) : $Session->logout();

    require "header-content.inc.php";
/*-------------------------------------------------------------------------------------*/
?>