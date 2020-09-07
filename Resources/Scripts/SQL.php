<?php
    // Including the Settings
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Parser.php";

    // Function for connecting to the Server
    function connectToServer(){ 
        // Returns TRUE if successful, FALSE if not  
        return mysqli_connect(
            settings["server"]["host"],     // The Host Name
            settings["server"]["user"],    // The Host username
            settings["server"]["password"] // The Host Password
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
                return 1;
            }
        } else {
            return 2;
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
?>