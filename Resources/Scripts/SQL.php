<?php
    // Including the Settings
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Parser.php";

    // Function for connecting to the Server
    function connectToServer($show_warnings = FALSE){ 
        // Returns TRUE if successful, FALSE if not 
        if ($show_warnings === TRUE){
            return mysqli_connect(
                settings["server"]["host"],     // The Host Name
                settings["server"]["user"],    // The Host username
                settings["server"]["password"] // The Host Password
            );
        } else {
            return @mysqli_connect(
                settings["server"]["host"],     // The Host Name
                settings["server"]["user"],    // The Host username
                settings["server"]["password"] // The Host Password
            );
        }
    }
    
    // Function for connecting to the Database
    function connectToDatabase($show_warnings = FALSE){ 
        // Returns TRUE if successful, FALSE if not 
        if ($show_warnings === TRUE){
            return mysqli_connect(
                settings["server"]["host"],     // The Host Name
                settings["server"]["user"],    // The Host username
                settings["server"]["password"], // The Host Password
                settings['server']['db']        // The Host Database
            );
        } else {
            return @mysqli_connect(
                settings["server"]["host"],     // The Host Name
                settings["server"]["user"],    // The Host username
                settings["server"]["password"], // The Host Password
                settings['server']['db']        // The Host Database
            );
        }
    }

    // Function for connecting to the database
    function checkConnection($show_warnings = FALSE){
        if (connectToServer($show_warnings)){   
            // If the connection to the server is good, check for the database
            if (connectToDatabase($show_warnings)){
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
            $fetched = mysqli_query(connectToServer(), $query);
        }
        
        // Outputting a boolean or associative array when necessary
        if (is_bool($fetched)){
            $result = $fetched;
        } else {
            $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
        }
        return $result;
    }
?>