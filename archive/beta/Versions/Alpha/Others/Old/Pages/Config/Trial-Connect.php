<?php
    //Includes
    require "Trial-Config.php";

    connect();

    //Function for connecting
    function connect()
    {
        $GLOBALS['connect'] = new mysqli(server, server_user, server_password);

        // Checking connection
        if ($GLOBALS['connect']->connect_error) 
        {
            die("<br>Connection to server failed: " . $GLOBALS['connect']->connect_error . "<br>");
        }
        else
        {
            //Connecting to the Main Page
            echo ("<br>If NO error or warning has been given, you have been successfully connected!<br>");
        }
    }
?>