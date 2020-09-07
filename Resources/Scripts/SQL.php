<?php
    // Parsing the settings from Settings.ini
    $settings = parse_ini_file("../Settings/Settings.ini", TRUE);

    // Function for connecting to the Server
    function connectToServer(){ 
        // Returns TRUE if successful, FALSE if not  
        return mysqli_connect(
            $GLOBALS["settings"]["server"]["host"],     // The Host Name
            $GLOBALS["settings"]["server"]["user"],    // The Host username
            $GLOBALS["settings"]["server"]["password"] // The Host Password
        );
    }
    
    // Function for connecting to the Database
    function connectToDatabase(){ 
        // Returns TRUE if successful, FALSE if not  
        return mysqli_connect(
            $GLOBALS["settings"]["server"]["host"],     // The Host Name
            $GLOBALS["settings"]["server"]["user"],     // The Host username
            $GLOBALS["settings"]["server"]["password"], // The Host Password
            $GLOBALS['settings']['server']['db']        // The Host Database
        );
    }

    // Function for connecting to the database
    function checkConnection(){
        if (connectToServer()){   
            // If the connection to the server is good, check for the database
            if (connectToDatabase()){
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    // Function for running queries and directly returning results
    function runQuery($query){
        $fetched = mysqli_query(connectToDatabase(), $query);
        
        if (is_bool($fetched)){
            $result = $fetched;
        } else {
            $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
        }
        return $result;
    }

    // Checking the connection each time this script is run
    if (checkConnection() === FALSE){
        // Since there are connection problems using the default settings, it's possibly the first time running the system
        // So send the user to the Setup Page
        header("Location: Resources/Scripts/Setup.php");
    }
?>