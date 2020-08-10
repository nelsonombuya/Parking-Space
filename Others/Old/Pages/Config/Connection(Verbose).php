<!--File used to create the database connection-->
<?php
    //Including the connection script
    require "Configuration.php";
    
    //Defining Global Variables
    $connect = new mysqli(server, server_user, server_password);
    if ($connect -> query )
    $connect_to_db = new mysqli(server, server_user, server_password, server_db);

    //Function for connecting
    function connect()
    {
        // Checking connection
        if ($GLOBALS['connect'] -> connect_error) 
        {
            die("<br>Connection to server failed: " . $GLOBALS['connect'] -> connect_error . "<br>");
        }
        else
        {
            //Connecting to the Main Page
            echo ("<br>If NO error or warning has been given, you have been successfully connected!<br>");
        }
        
        //Checking for the Database
        // db_check();
    }
    /*
    //Checking whether the database exists
    function db_check()
    {
        echo "<br><U>CHECKING FOR DATABASE [".server_db."].</U>";
        //Checking whether DB Exists
        //$db_name = server_db;
        if ($GLOBALS['connect']->query("USE " . server_db) === FALSE)
        {
            echo "<br>The database [server_db] doesn't exist.<br><br>Creating it now.<br>";
            if (create_db() == true)
            {
               connect_to_db();
            }
            else
            {
                echo "<small>Skipping Database Creation due to error.</small>";
            }
        }
        else
        {
            echo "<br>The database [$db_name] exists.<br>Accessing it now.<br>";
            connect_to_db();
        }
    }
    */
    /*
    //Connecting to the database
    function connect_to_db()
    {
        echo "<br><U>CONNECTING TO DATABASE</U>";
        $GLOBALS['connect_to_db'] = new mysqli(server, server_user, server_password, server_db);
        $db_name = server_db;
        
        // Checking connection
        if ($GLOBALS['connect_to_db']->connect_error) 
        {
            die("<br>Connection failed: " . $GLOBALS['connect_to_db']->connect_error) . "<br>";
        }
        else
        {
            echo ("<br>If NO error or warning has been given, you have successfully connected to the database [$db_name].<br>");
        }

        //Checking for the Tables in the Database
        database_preset();
    }
    */
    /*
    //Creating the Database
    function create_db()
    {
        //Creating DB
        if ($GLOBALS['connect']->query("CREATE DATABASE " . server_db) === TRUE) 
        {
            echo "<br>Database Created Successfully.<br>";
            // echo "<br>Creating Tables.<br>"
            if (database_preset() === TRUE){
                return true;
            }
            else{
                echo "<br>Error Defining Database: " . $GLOBALS['connect_to_db']->error . "<br>";
                return false;
            }
        } 
        else 
        {
            echo "<br>Error Creating Database: " . $GLOBALS['connect_to_db']->error . "<br>";
            return false;
        }
    }
    
    //Function for closing the MySQL Connection
    function disconnect()
    {
        echo "<br><U>DISCONNECTING FROM MYSQL SERVER</U>";
        $GLOBALS['connect']->close();
        echo "<br>Disconnected. Thank You.<br>";
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function database_preset() //TODO: This is going to be used when first setting up the System
    {
        //Re-declaring the global in the function
        $GLOBALS['connect_to_db'] = new mysqli(server, server_user, server_password, server_db);
        echo "<br><U>CREATING TABLES IN THE [".server_db."] DATABASE.</U>";
        
        //Creating an =Associative Array with all the necessary Tables and Definitions
        $tables = [
            "USERS" => "CREATE TABLE IF NOT EXISTS USERS (
                        USERNAME VARCHAR(50) NOT NULL PRIMARY KEY,
                        PASS VARCHAR(50) NOT NULL)",
        ];

        //For Each Loop for The Entire Table
        foreach ($tables as $table => $attributes){
            //Creating Users Table
            if ($GLOBALS['connect_to_db'] -> query("SHOW TABLES LIKE $table")->num_rows == 1){ //FIXME: Issue during the first run
                echo "The table $table exists";
            }
            else{
                echo "<br>The table [$table] doesn't exist.<br><br>Creating it now.<br>";

                //Creating Table
                if ($GLOBALS['connect_to_db']->query("$attributes") === TRUE)
                {
                    echo "<br>Table [$table] has been cre at ed successfully.<br>";
                }
                else
                {
                    echo "<br>Error Creating Table: " . $GLOBALS['connect_to_db']->error . "<br>";
                }
            }
        }
    }
    */
    
    //Connecting to the server
    connect();  

?>