<!--First Time Setup-->
<!-- A Hilariously Verbose File -->
<?php
    // Requirements
    require "Configuration.php";    // Has the necessary server details to create a connection
    
    // Query to connect to the MySQL Server
    $connect = mysqli_connect(server, server_user, server_password);

    // These are the tables to be made when first making the database    [Used Multidimensional Associative Array]
    // Contains both the Table Definition (Schema) and the Data (If needed)
    $tables = // Used for Test Data and Default Users
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
                                        "manager" =>    "INSERT INTO USERS (USERNAME, PASS) 
                                                        VALUES ('manager', '1234')",
                                    ),
                    ),

        "PARKING" => array
                    (
                        "SCHEMA" => "CREATE TABLE IF NOT EXISTS PARKING (
                                    P_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                    P_TYPE VARCHAR(12) NOT NULL,
                                    P_STATUS VARCHAR(6) NOT NULL,
                                    P_LOCATION VARCHAR(50) NOT NULL)",
                        
                        // Contains the Table's Test Data
                        "DATA" =>   array 
                                    (   
                                        // NOTE: Since it's autoincrement hakuna haja ya adding data to the Parking ID
                                        // Add new parking spots here
                                        "1" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS, P_LOCATION) 
                                                    VALUES ('Open', 'Free', 'Mall')",
                                        
                                        "2" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS, P_LOCATION) 
                                                    VALUES ('Closed', 'Taken', 'Chemist')",
                                        
                                        "3" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS, P_LOCATION) 
                                                    VALUES ('Pick-Up', 'Free', 'KFC')",
                                        
                                        "4" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS, P_LOCATION) 
                                                    VALUES ('Reserved', 'Free', 'Equity Bank')",
                                        
                                        "5" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS, P_LOCATION) 
                                                    VALUES ('Handicapped', 'Taken', 'Mall')",
                                        
                                        "6" =>    "INSERT INTO PARKING (P_TYPE, P_STATUS, P_LOCATION) 
                                                    VALUES ('Open', 'Free', 'KFC')",
                                    ),
                    ),
    ];

    function createDB()
    {
        /*
            TO: Create a new DB
            Uses the database name specified in Configuration.php as server_db
            Creates the DB, then calls checkTables() to create it's tables  
            NOTE: I don't need to check whether the tables exist if the database doesn't exist, but using checkTables() helps minimize redundancy since I'd still need the first foreach loop
            If the database to be made already exists, then check whether it's tables exist using checkTables()
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
                    checkTables();
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
            // Function used to check whether tables exist
            checkTables();
        }
        
    }
    
    function checkTables()
    {
        /*
            TO: Checks whether the tables exist in the Database

            NOTE: If the table doesn't exist, it calls the function createTables() which makes the tables
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
                NOTE: I split the Nested Loops into their own functions in order to save on time complexity
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
                    // If the table doesn't exist, then the data also doesn't exist, so we're adding it
                    createTables($table, $options); 
                }
            }
        }
        //Finished Making the Tables
        $GLOBALS['first_run_is_done'] = TRUE;   // TODO: Add a .ini File to register when the first run has been done
        echo "<br><br>The database tables have been made.<br>Redirecting...";
        
    }

    function createTables($table, $options)
    {
        /*
            TO: Create the Tables using the table schema 
            The tables to be added can be found in the Associative Array $tables[] on Line 9
            Syntax for adding the table schema and data can be observed in the $tables[] array

            NOTE: Used $options since the Associative Array has the options to either select the table's SCHEMA or the table's DATA
                        Also used the same variable in the foreach on checkTables()
        */
        foreach ($options as $option => $queries)   // The SCHEMA Queries or the DATA input Queries
        {
            // Running through the second level to get the schema
            /* 
                The 2nd Level in the $tables array is for the SCHEMA, so if it's not an array, it is passed as a query.
                And if it is an array, it means it's the DATA array, so we call addDataToTables() function to add data to the tables
            */
            if (is_array($queries) == FALSE)   
            {
                // If it's not an array, then it's the database schema
                echo "The table [$table] doesn't exist...<br>Creating it now...";
                $schema_query = $queries;   // To show you that the query in this case is a schema query

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
                if ($GLOBALS['add_test_data'] == TRUE || $table === "USERS")    // TO: Allow the admin (or any other default user) to be added despite the system user wanting no test data (The Admin allows the system to be managed)
                {
                    // If it is an array, it should go deeper to add the data to the table
                    addDataToTables($table, $queries);
                }
                // If add_test_data is FALSE, skips the adding of records.
            }
        }
    }

    function addDataToTables($table, $queries)
    {
        // TO: Add data to the Table
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
    //Running the first time connection
    createDB();
?>