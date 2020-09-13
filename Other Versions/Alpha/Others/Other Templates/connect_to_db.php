<?php
    /*
        User defined details that will affect the entire MySQL Functionality
        Change these according to your database
    */
    $user_defined_db = "";
    $user_defined_username = "root";
    $user_defined_password = "";
    
    //I used port 3325 for my MySQL service so as to not conflict with other existing applications
    $user_defined_mysql_server = 'localhost:3325';  
    //If it displays a warning, please replace 'localhost:3325' with 'localhost' or the correct server and port used for your mysql server
    
    //The Program Script
    //Defining them as constants so as to be able to use them globally within the script
    define ('server', $user_defined_mysql_server);  
    define ('user', $user_defined_username);
    define ('password', $user_defined_password);
    define ('db', $user_defined_db);

    connect();  //First time connection

    //Function for connecting
    function connect()
    {
        $GLOBALS['connect'] = new mysqli(server, user, password);
        
        // Checking connection
        if ($GLOBALS['connect']->connect_error) 
        {
            die("<br>Connection failed: " . $GLOBALS['connect']->connect_error . "<br>");
        }
        else
        {
            echo ("<br>If NO error or warning has been given, you have been successfully connected!<br>");
        }
    }

    //Function for closing the MySQL Connection
    function disconnect()
    {
        echo "<br>Disconnecting from MySQL<br>";
        $GLOBALS['connect']->close();
        echo "<br>Disconnected. Thank You.<br>";
    }

    disconnect();   //Closing the connection after stuff is done
?>
        