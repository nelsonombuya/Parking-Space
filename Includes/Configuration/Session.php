<?php
    // TODO: Remember to organize general program security
    // Starting Session if there isn't one
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Checking whether the session had been destroyed or doesn't exist
    if (checkSession() == 0){
        // Creating a guest session
        setGuestUser();
    }

    function checkSession(){
        if ($_SESSION['username'] === "" || $_SESSION['username'] === null)
        {
            // If this is a guest user, then it means no one's logged in, transferring the user to the login page
            return 0;
        }
        else if ($_SESSION['username'] === "guest"){
            // Might be a guest user
            return 1;
        }
        else{
            // Is probably a logged on user
            return 2;
        }
    }

    function logout()
    {
        // Unsets user data and ends the session
        session_unset();
        session_destroy();

        // Set's guest user as fallback
        setGuestUser();
    }

    function setGuestUser(){
        // TO: Set the guest user's credetntials
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['username'] = "guest";
    }
    // TODO: No user logged in output
    // TODO: When user is already Logged In
    // TODO: Add session expiry
    // TODO: Using Session Confirm Hash Key to verify the account every 30 or so minutes    
    // NOTE: Will use Driver ID with guest users
?>