<?php
    // Requirements
    // This is the file containing the server details
    // require "Includes/Configuration.php";

    // These are the tables to be made when first making the database    [Used Multidimensional Associative Array]
    $tables = 
    [
        "USERS" =>  array
                    (   
                        // Defines the table's attributes
                        "SCHEMA" => "CREATE TABLE IF NOT EXISTS USERS (
                                            USERNAME VARCHAR(50) NOT NULL PRIMARY KEY,
                                            PASS VARCHAR(50) NOT NULL)",

                        // Contains the Table's Test Data
                        "DATA" =>   array 
                                    (   "admin" =>    "INSERT INTO USERS (USERNAME, PASS) 
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
                                    (   // NOTE: Since it's autoincrement hakuna haja ya adding data to the Parking ID
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

    //Testing Echo
    foreach ($tables as $tables => $options)
    {
        //Running through the first dimension to get the Table Names
        echo "<br><br>";
        echo $tables;

        foreach ($options as $option => $queries)
        {
            // Running through the second level to get the schema
            if (is_array($queries) == FALSE)
            {
                $schema_query = $queries; 
                // If it's not an array, then it's the database schema
                echo "<br>$schema_query><br>";
            }
            else
            {
                // If it is an array, it should go deeper to add the data to the table
                foreach ($queries as $record_query)
                {
                    echo "<br>$record_query<br>";
                }
            }
        }
    }