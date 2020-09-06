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

    // Function for connecting to the database
    function connectToDatabase(){
        if (connectToServer()){   
            // If the connection to the server is good, check for the database
            $database = $GLOBALS['settings']['server']['db'];
    
            if (mysqli_query(connectToServer(), "USE $database"))
            {
                return TRUE;
            } 
            else 
            {
                // The database doesn't exist, possibly the first time running the system
                header("Location: Resources/Scripts/Setup.php");
            }
        } else {
            // Exit the script if the connection to the server fails  
            exit("<br>Connection to server failed" . mysqli_connect_error() . "<br>");
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

    // Connecting to the database each time this file is included
    connectToDatabase();
?>