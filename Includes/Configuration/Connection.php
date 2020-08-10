<!--File used to create the database connection-->
<?php
    //Requirements
    //Including the connection script
    require "Configuration.php";

    //Connection Scripts
    //Connecting to DB Server
    $connect = mysqli_connect(server, server_user, server_password);

    //Checking for connection to DB Server
    if ($GLOBALS['connect'] -> connect_error)
    {
        //Kill the connection request
        die("<br>Connection to server failed: " . $GLOBALS['connect'] -> connect_error . "<br>");
    }

    //Checking whether the database exists
    else if ($GLOBALS['connect'] -> query("USE " . server_db) === TRUE)
    {
        //Connecting to the database
        $GLOBALS['connect'] = mysqli_connect(server, server_user, server_password, server_db);

        //TODO: Redirect to the next Page
    }

    //The Database doesn't exist, so it's a new system
    else 
    {
        //Redirecting to first time setup
        header("Location: Connection(Verbose).php");
    }
?>