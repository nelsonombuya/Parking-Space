<?php
    // TODO: Remember to organize general program security
    // Starting Session if there isn't one
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Checking whether the user is logged in
    function isLoggedIn(){
        if (isset($_SESSION['username']))
        {
            if ($_SESSION['username'] === "guest"){
                // TODO: Allow guest to manage their parking
                $_SESSION['is_logged_in'] = FALSE;
                return FALSE;   
            }
            $_SESSION['is_logged_in'] = TRUE;
            return TRUE;
        }
        else {
            logout();
            return FALSE;
        }
    }

    // TO: Logout the user and return the session state to guest
    function logout()
    {
        // Unsets user data and ends the session
        session_unset();
        session_destroy();

        // Set's guest user as fallback
        setGuestUser();
    }

    // TO: Set the current user as guest (For when logging out or having a destroyed session)
    function setGuestUser(){
        // TO: Set the guest user's credetntials
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['username'] = "guest";
    }
    // TODO: Add session expiry
    // TODO: Using Session Confirm Hash Key to verify the account every 30 or so minutes    
    // NOTE: Will use Driver ID with guest users

    function driverNumber(){
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