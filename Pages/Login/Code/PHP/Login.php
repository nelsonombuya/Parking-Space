<?php
    // For connecting to the database
    require "../../../../Includes/Configuration/Connection.php";
    require "../../../../Includes/Configuration/Session.php";

    // Checking for user input
    if (isset($_POST['login_username']) && isset($_POST['login_password']))
    {
        // Getting the username and password from the page and adding htmlentities to make it more secure
        $username = htmlentities($_POST['login_username']);
        $password = htmlentities($_POST['login_password']);
        login($username, $password);
    }
    else
    {
        // Check for a user session
        if (checkSession() == 1 || checkSession() == 2){
            // 1 is for when the session details are that of a guest
            // 2 is for when the session details are that of a user
            header("Location: ../../../Management/Account Management.php");
        }
        // This condition focuses on anyone other than those who we haven't mentioned
        header("Location: ../../Sign In.php");
    }      

    // TODO: Define the way the username should be for Validation
    function login($username, $password)
    {
        //The Query for checking for the user's details in the database
        $query  = "SELECT USERNAME, PASS FROM USERS WHERE USERNAME = '$username' AND PASS = '$password'";

        // If data is received, check whether the user details exist
        if (mysqli_query($GLOBALS['connect'], $query) -> num_rows == 1)
        {
            // Means that the user details are correct  (Otherwise, would return no rows)
            //Session Details
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            //  FIXME: Remember to use an auto-generated hash key
            
            //Redirect to Account Management Page
            header("Location: ../../../Management/Account Management.php");
        }
        else
        {
            //Return back to Login Page
            //TODO: Account Doesn't Exist Warning
            session_unset();
            $_POST['login_username'] = "";
            $_POST['login_password'] = "";
            $_SESSION['error'] = 1;
            header("Location: ../../../Login/Sign In.php");
        }
    }
?>