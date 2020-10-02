<?php
    // Session
    // --------
    // Starting the session if there is none
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // Function for logging out
    function logout(){
        session_unset();
        session_destroy();
        header("Location: ../../Index.php") or die();
    }

    // User Details
    // ---------------
    // Function for outputting the current username
    function currentUsername(){
        if (isset($_SESSION['username'])){
            return $_SESSION['username'];
        }
        return "Guest";
    }
    
    // Function for outputting the current driver number
    function currentDriverNumber(){
        $query =    "SELECT DRIVER_ID FROM DRIVERS 
                    ORDER BY DRIVER_ID DESC
                    LIMIT 1";
        $result = runQuery($query);

        if (is_bool($result)){
            return "No Registered Drivers";
        } else {
            return $result[0]["DRIVER_ID"];
        }
    }
?>