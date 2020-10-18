<?php
/*==================================== SQL SCRIPT ====================================*/
/* Script with functions used for SQL Commands and such. Makes Life Easier            */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Parser.php";
/*====================================================================================*/

    /* Function for connecting to the Server */
    function connectToServer(){ 
        /* Returns TRUE if successful, FALSE if not */
        return mysqli_connect(
            settings["server"]["host"],     // The Host Name
            settings["server"]["user"],     // The Host username
            settings["server"]["password"]  // The Host Password
        );
    }
    
    // Function for connecting to the Database
    function connectToDatabase(){ 
        /* Returns TRUE if successful, FALSE if not */
        return mysqli_connect(
            settings["server"]["host"],     // The Host Name
            settings["server"]["user"],     // The Host username
            settings["server"]["password"], // The Host Password
            settings['server']["database"]  // The Host Database
        );
    }

    /* Function for connecting to the database */
    function checkConnection(){
        if (connectToServer()){   
            /* If the connection to the server is good, check for the database */
            if (connectToDatabase()){
                return TRUE;
            } else {
                return "sql_db";
            }
        } else {
            return "sql_server";
        }
    }
?>