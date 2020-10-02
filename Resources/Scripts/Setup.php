<?php
    /*
        First Time Setup
        A slimmed version of the hilariously verbose file 😂
        If you see functions you don't understand:
            eg. checkConnection(), runQuery() etc 
        Check the SQL.php file for more info
    */
    
    // Files to Include
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Parser.php";
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

    /*  NOTE: Table design
        You can see the actual implementation on Tables.ini
        
        The tables are designed as the following associative array:
        Table               Options
        ------              --------
        [Table Name] =>     Schema  = "Query for table schema"

                            Data    => array(
                                        Array of Queries containing test data
                                    )
    */

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

    // Function for hashing test user passwords
    function hashPasswords(){
        // Getting the already added user data
        $users = runQuery("SELECT * FROM USERS");

        // Getting each user's details and hashing their passwords individually
        foreach ($users as $user => $data){
            $username = $data["USERNAME"];
            $original_password = $data["PASS"];
            $hashed_password = password_hash($original_password, PASSWORD_DEFAULT);

            // Running update query to change their insecure passwords to the hashed password
            $query ="UPDATE USERS 
                    SET PASS = '$hashed_password'
                    WHERE USERNAME = '$username'";
            $result[$username]= runQuery($query);
        }

        return $result;
    }

    function setup($tables = tables, $database = settings['server']['db']){
        // NOTE: The variables are used for error detection
        // First we create the Database
        $database_result = createDatabase($database);

        // Then we create the Tables
        $table_result = createTables($tables);

        // Then we add the test data for each table (If the user wants it)
        if (settings['setup']['add_test_data']){
            foreach($tables as $table => $options){
                $data_result[$table] = addTestData($options["DATA"]);
            }
        } else {
            // If they don't need test data, we add the Admin User(s)
            $data_result['USERS'] = addTestData($tables['USERS']["DATA"]);
        }

        // Then we hash the password for the added users
        $hashing_results = hashPasswords();

        // Returning the errors (Or lack thereof)
        return array(
            "Database Name" => $database,
            "Database"  => $database_result,
            "Tables"    => $table_result,
            "Test Data" => $data_result,
            "Hash"      => $hashing_results
        );
    }

    function errorChecker($setup_results){
        // Adding variable for database name (In case a different DB was used)
        $database = $setup_results["Database Name"];

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

            // Checking whether passwords were hashed
            foreach($setup_results["Hash"] as $username => $is_password_hashed){
                if ($is_password_hashed === FALSE){
                    // Error hashing a user's password, it'll be insecure
                    dropDatabase($database);
                    return  '<script type="text/JavaScript">  
                                alert("Error hashing user passwords. \nCheck the Log File for more information."); 
                            </script>';
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