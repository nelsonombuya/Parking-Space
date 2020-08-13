<!--First Time Setup-->
<?php
    // Requirements
    require "Configuration.php";    // Has the necessary server details to create a connection
    
    // Query to connect to the MySQL Server
    $connect = mysqli_connect(server, server_user, server_password);

    // These are the tables to be made when first making the database    [Used Multidimensional Associative Array]
    // Contains both the Table Definition (Schema) and the Data (If Needed)
    $tables = 
    [
        // Table Name 
        "USERS" =>  array
                    (   
                        // Defines the table's attributes
                        "SCHEMA" => "CREATE TABLE IF NOT EXISTS USERS (
                                            USERNAME VARCHAR(50) NOT NULL PRIMARY KEY,
                                            PASS VARCHAR(50) NOT NULL)",

                        // Contains the Table's Test Data
                        "DATA" =>   array 
                                    (   
                                        //Add the user data here
                                        "admin" =>    "INSERT INTO USERS (USERNAME, PASS) 
                                                        VALUES ('admin', '1234')",
                                    ),
                    ),

        "PARKING" => array
                    (
                        "SCHEMA" => "CREATE TABLE IF NOT EXISTS PARKING (
                                    P_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                    P_TYPE VARCHAR(12) NOT NULL,
                                    P_STATUS VARCHAR(6) NOT NULL)",
                        
                        // Contains the Table's Test Data
                        "DATA" =>   array 
                                    (   
                                        // NOTE: Since it's autoincrement hakuna haja ya adding data to the Parking ID
                                        // Add new parking spots here
                                        "1" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS) 
                                                    VALUES ('Open', 'Taken')",
                                        
                                        "2" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS) 
                                                    VALUES ('Closed', 'Taken')",
                                        
                                        "3" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS) 
                                                    VALUES ('Pick-Up', 'Free')",
                                        
                                        "4" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS) 
                                                    VALUES ('Reserved', 'Free')",
                                        
                                        "5" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS) 
                                                    VALUES ('Handicapped', 'Taken')",
                                        
                                        "6" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS) 
                                                    VALUES ('Open', 'Free')",
                                    ),
                    ),
    ];

    function createDB()
    {
        /*
            TO: Create a new DB
            Uses the database name specified in Configuration.php as server_db
            Creates the DB, then calls createTables() to create it's tables
            If the database to be made already exists, then check whether it's tables exist using createTables()
        */
        echo "<h2>Database</h2>";
        if ($GLOBALS['connect'] -> query("USE " . server_db) === FALSE)
        {
            // If it can't use the Database using USE [Database], then the DB doesn't exist
            echo "The database [". server_db ."] DOES NOT EXIST...<br>Creating it...";
                
            // Making the Database
            if ($GLOBALS['connect'] -> query("CREATE DATABASE " . server_db))
            {
                echo "<br>Database Created Successfully.<br>";

                if (($GLOBALS['connect'] -> query("USE " . server_db))) 
                {
                    echo "<br>Connected to the Database [". server_db ."].<br>";
                    //Since this is a newly created DB, we'll need to make it's tables
                    createTables();
                }
                else
                {
                    // If there was an error, exit the script and report the error
                    exit ("<br>ERROR Connecting to the Database: " . $GLOBALS['connect'] -> connect_error . "<br>");
                }
                
            }
            else
            {
                // If there was an error, exit the script and report the error
                exit ("<br>ERROR Creating the Database: " . $GLOBALS['connect'] -> connect_error . "<br>");
            }
        }
        else
        {
            echo "The database [". server_db ."] EXISTS...<br>Checking Tables...";
            // Function used to check whether tables exist, and make them
            createTables();
        }
        
    }
    

    // Function for checking for and creating tables
    function createTables()
    {
        /*
            TO: Makes the tables in the Database
            The tables to be added can be found in the Associative Array $tables[] on Line 9
            Syntax for adding the table schema and data can be observed in the $tables[] array

            // FIXME: Complexity is O(n^3), Consider Separating Loops
        */
        echo "<br><br><h2>Tables in the [".server_db."] Database.</h2>";

        // Checking whether the connection is alright
        if ($GLOBALS['connect'] -> connect_error)
        {
            // Exiting the script if it fails to connect
            exit("<br>Connection to server failed: " . $GLOBALS['connect'] -> connect_error . "<br>");
        }
        else 
        {
            /*
                In the 3D Array
                    LEVEL 1 => Table Names
                        LEVEL 2=> Table Schema
                            LEVEL 3 => Test Data

                Each Foreach loop represents access to one of the levels
            */
            // Creating the Tables
            foreach ($GLOBALS['tables'] as $table => $options)  //Options being either the SCHEMA or the DATA
            {
                echo "<h3>$table</h3>";
                // Running through the first array dimension to get the Table Names
                // Checking whether the table exists
                if ($GLOBALS['connect'] -> query("DESCRIBE $table"))
                {
                    echo "The table [$table] exists<br><br>";
                }
                else
                {
                    // If the table doesn't exist, then the data also doesn't exist, so we're addiing it
                    foreach ($options as $option => $queries)   // The SCHEMA Queries or the DATA input Queries
                    {
                        // Running through the second level to get the schema
                        /* 
                            The 2nd Level in the array is for the SCHEMA, so if it's not an array, it is passed as a query.
                            And if it is an array, it means it's the DATA array, so it is also taken through a foreach loop.
                        */
                        if (is_array($queries) == FALSE)   
                        {
                            // If it's not an array, then it's the database schema
                            echo "The table [$table] doesn't exist...<br>Creating it now...";
                            $schema_query = $queries;

                            //Creating Table
                            if ($GLOBALS['connect'] -> query("$schema_query") == TRUE) 
                            {
                                echo "<br>Table [$table] has been created successfully.<br>";
                            }
                            else
                            {
                                echo "<br>Error Making the table [$table]: " . $GLOBALS['connect'] -> connect_error . "<br>";
                            }
                        }
                        else
                        {
                            // Checking whether the user wants the test data (NOTE: Check the Configuration.php File)
                            if ($GLOBALS['add_test_data'] == TRUE || $table === "USERS")    // Added OR to allow for ADMIN to be added even when the flag is OFF
                            {
                                // If it is an array, it should go deeper to add the data to the table
                                echo "<br><u>Adding Data to [$table]...</u><br>";

                                foreach ($queries as $record_key => $record_query)
                                {
                                    if ($GLOBALS['connect'] -> query("$record_query") === TRUE) 
                                    {
                                        echo "[$table] -> [$record_key] has been added.<br><br>";
                                    }
                                    else
                                    {
                                        echo "[$table] -> ERROR adding [$record_key]: " . $GLOBALS['connect'] -> connect_error . "<br>";
                                    }
                                }
                            }
                            // If add_test_data is FALSE, skips the adding of records.
                        }
                    }
                }
            }
        }
        //Finished Making the Tables
        $GLOBALS['first_run_is_done'] = TRUE;   // FIXME: Add a .ini File to register when the first run has been done
        echo "<br><br>The database tables have been made.<br>Redirecting...";
        
    }

    //Running the first time connection
    createDB();
?>