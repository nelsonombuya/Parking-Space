<?php
    // Including the Settings
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Parser.php";

    // Function for connecting to the Server
    function connectToServer(){ 
        // Returns TRUE if successful, FALSE if not 
        return mysqli_connect(
            settings["server"]["host"],     // The Host Name
            settings["server"]["user"],     // The Host username
            settings["server"]["password"]  // The Host Password
        );
    }
    
    // Function for connecting to the Database
    function connectToDatabase(){ 
        // Returns TRUE if successful, FALSE if not 
        return mysqli_connect(
            settings["server"]["host"],     // The Host Name
            settings["server"]["user"],     // The Host username
            settings["server"]["password"], // The Host Password
            settings['server']['db']        // The Host Database
        );
    }

    // Function for connecting to the database
    function checkConnection(){
        if (connectToServer()){   
            // If the connection to the server is good, check for the database
            if (connectToDatabase()){
                return TRUE;
            } else {
                return "db_error";
            }
        } else {
            return "server_error";
        }
    }

    // Function for running queries and directly returning results
    function runQuery($query){
        // Picking the correct query for when the database exists
        if (checkConnection() === TRUE){
            $fetched = connectToDatabase() -> query($query);
        } else {
            $fetched = connectToServer() -> query($query);
        }
        
        // Outputting a boolean or associative array when necessary
        if (is_bool($fetched)){
            $result = $fetched;
        } else {
            $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
        }
        return $result;
    }

    // Checking if the connection is made
    if (checkConnection() !== TRUE){
        // If there are connection problems using the default settings... 
        // Send the user to the Setup Page
        header("Location: Resources/Scripts/Setup.php") or die();
    }
?>