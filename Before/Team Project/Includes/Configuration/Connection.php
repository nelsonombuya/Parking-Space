<!--File used to create the database connection-->
<?php
    //Requirements
    //Including the server configuration
    require "Configuration.php";

    //Connecting to DB Server
    $connect = mysqli_connect(server, server_user, server_password);

    //Checking for connection to DB Server
    if ($GLOBALS['connect'] -> connect_error)
    {
        // Exit the script if the connection to the server fails  
        exit("<br>Connection to server failed: " . $GLOBALS['connect'] -> connect_error . "<br>");
    }

    //Checking whether the database exists
    else if ($GLOBALS['connect'] -> query("USE " . server_db) === FALSE)
    {
        /*  
            We're sending a query to the SQL Server
            If it runs successfully (When the database exists), it returns TRUE. 
            If it doesn't run successfully (Meaning the Database we want to use doesn't exist), it returns FALSE.

            If it doesn't exist, it's probably a new system
            Therefore we run the First Time Setup.php script
        */

        //Redirecting to first time setup script (From the Terminal)
        header("Location: ../../Includes/Configuration/First Time Setup.php");
    }

    // Function for running queries and directly returning results
    function runQuery($query){
        $fetched = mysqli_query($GLOBALS['connect'], $query);
        if (is_bool($fetched)){
            $result = $fetched;
        } else {
            $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
        }
        return $result;
    }
?>