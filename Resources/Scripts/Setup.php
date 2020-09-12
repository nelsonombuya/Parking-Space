<!--First Time Setup-->
<!-- A slimmed version of the hilariously verbose file 😂-->
<?php
    // Files to Include
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/SQL.php";

    // Parsing tables from Tables.ini and using them as a constant
    define('tables', parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Tables.ini", TRUE));

    // Function for creating the database
    function createDatabase($database){
        if (checkConnection() === "db_error"){
            // checkConnection returning db_error means that the database doesn't exist
            return runQuery("CREATE DATABASE " . $database);
        } else {
            return "db_exists";
        }
    }
    
    // Function for dropping the database (In case of any errors)
    function dropDatabase($database){
        return runQuery("DROP DATABASE " . $database);
    }

    // Function for creating the tables
    function createTables($tables){
        foreach ($tables as $table => $options){
            $result[$table] = runQuery($options["SCHEMA"]);
        }
        return $result;
    }

    // Query for adding the test data
    function addTestData($data_array){
        $counter = 0;
        foreach($data_array as $data){
            $result[$counter] = runQuery($data);
            $counter++;
        }
        return $result;
    }

    function setup($tables = tables, $database = settings['server']['db']){
        // NOTE: The variables are used for error detection
        // First we create the Database
        $database_result = createDatabase($database);

        // Then we create the Tables
        $table_result = createTables($tables);

        // Then we add the test data for each table
        if (settings['setup']['add_test_data'] === TRUE){
            foreach($tables as $table => $options){
                $data_result[$table] = addTestData($options["DATA"]);
            }
        } else {
            // If they don't need test data, we add the Admin
            $data_result['USERS'] = addTestData($tables['USERS']["DATA"]);
        }

        return array(
            "Database"  => $database_result,
            "Tables"    => $table_result,
            "Test Data" => $data_result
        );
    }

    function errorChecker($setup_results){
        // Checking for errors
        if ($setup_results["Database"] === FALSE){
            // Error during the making of the Database
            dropDatabase($database);
            return '<script type="text/JavaScript">  
                        alert("Error creating the Database. \nCheck the Log File for more information."); 
                    </script>';
        } else {
            // Checking Tables 
            foreach($setup_results["Tables"] as $table){
                if ($table === FALSE){
                    // Error Creating Table
                    dropDatabase($database);
                    return  '<script type="text/JavaScript">  
                                alert("Error creating the Tables. \nCheck the Log File for more information."); 
                            </script>';
                } 
            }
            
            // Checking Data
            foreach($setup_results["Test Data"] as $table => $data){
                foreach($data as $datum => $status){
                    if ($status === FALSE){
                        // Error adding data
                        dropDatabase($database);
                        return  '<script type="text/JavaScript">  
                                    alert("Error adding data to the Tables. \nCheck the Log File for more information."); 
                                </script>';
                    }
                }
            }

            // If no errors occured
            return  '<script type="text/JavaScript">  
                        alert("The system has been set up. \nYou will be redirected to the Starting Page in a moment");
                        window.location.href = "../../Index.php"; 
                    </script>';
        }  
    }
    
    // Running the script, checking for errors and displaying them
    echo errorChecker(setup());
?>