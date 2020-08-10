<!--File used to create the database connection-->
<!--First Time Setup-->
<?php
    //Requirements
    //Including the connection script
    require "Configuration.php";

    //Creating an Associative Array with all the necessary Tables and Definitions
    $tables = [
        "USERS" =>  "CREATE TABLE IF NOT EXISTS USERS (
                    USERNAME VARCHAR(50) NOT NULL PRIMARY KEY,
                    PASS VARCHAR(50) NOT NULL)",
    ];

    $users = [
        "admin" => "INSERT INTO USERS (USERNAME, PASS) 
                    VALUES ('admin', '1234')",
    ];

    //Connection Scripts
    //Connecting to DB Server
    $connect = mysqli_connect(server, server_user, server_password);

    //Running the first time connection
    connect();

    //Function for connecting (Helps us with the first time Setup)
    function connect()
    {
        //Checking for connection to DB Server
        if ($GLOBALS['connect'] -> connect_error)
        {
            //Kill the connection request
            die("<br>Connection to server failed: " . $GLOBALS['connect'] -> connect_error . "<br>");
        }
        
        //Checking whether the database exists
        else if ($GLOBALS['connect'] -> query("USE " . server_db) === TRUE)
        {
            echo "<br>The database [". server_db ."] exists...<br>Connecting...";
            
            //Connecting to the database
            $GLOBALS['connect'] = mysqli_connect(server, server_user, server_password, server_db);
            echo "<br>Connected.";

            //Check whether Tables exist in the database, and make the one's that don't
            create_tables();
        }

        //The Database doesn't exist, so we're creating it
        else 
        {
            echo "<br>The database [". server_db ."] DOES NOT EXIST...<br>Creating...";
            //If the Database is created successfully, make the tables
            if ($GLOBALS['connect'] -> query("CREATE DATABASE " . server_db) === TRUE) 
            {
                echo "<br>Database Created Successfully.<br>";
                
                //Since this is a newly created DB, we'll need to make it's tables
                create_tables();
            }
        } 
    }

    //Function for creating tables
    function create_tables()
    {
        echo "<br><br><U>TABLES IN THE [".server_db."] DATABASE.</U>";
        
        //Connecting to the New Database
        $GLOBALS['connect'] = mysqli_connect(server, server_user, server_password, server_db);

        //Checking whether the connection is alright
        if ($GLOBALS['connect'] -> connect_error)
        {
            //Kill the connection request
            die("<br>Connection to server failed: " . $GLOBALS['connect'] -> connect_error . "<br>");
        }
        else
        {
            //For Each Loop for The Entire Database Tables
            foreach ($GLOBALS['tables'] as $table => $attributes)
            {
                //Checking whether the table exists
                if ($GLOBALS['connect'] -> query("DESCRIBE $table"))
                {
                    echo "<br>The table [$table] exists<br>";
                }
                else
                {   
                    echo "<br>The table [$table] doesn't exist...<br><br>Creating it now...<br>";

                    //Creating Table
                    if ($GLOBALS['connect'] -> query("$attributes") === TRUE)
                    {
                        echo "<br>Table [$table] has been created successfully.<br>";
                    }
                    else
                    {
                        echo "<br>Error Creating Table $table: " . $GLOBALS['connect'] -> error . "<br>";
                    }
                }
            }

            //TODO: Make a way to add data to all necessary tables
            //FIXME: Probably needs a nested array
            //Once Table Creation is done, add a default users
            echo "<br><u>Table Data</u>";
            foreach ($GLOBALS['users'] as $user => $details)
            {
                if ($GLOBALS['connect'] -> query("SELECT * FROM USERS WHERE USERNAME = '$user'"))
                {
                    echo "<br>User [$user] exists.";
                }
                else
                {
                    $GLOBALS['connect'] -> query($details);
                    echo "<br>Added the user [$user]";
                }
            }
        }
        //Finished Making the Tables
        echo "<br><br>The database tables have been made.<br>Redirecting...";
    }
?>