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
        if ($_SESSION['is_logged_in'] === TRUE){
            // Redirect to Account Management Page
            header("Location: ../../../Management/Account Management.php");
        }
        // To make the user to log in
        header("Location: ../../Sign In.php");
    }      

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
            // FIXME: Remember to use an auto-generated hash key
            
            // Setting the user as logged in
            isLoggedIn();
            // Removing stored variables from $_POST
            unset($_POST);

            //Redirect to Account Management Page
            header("Location: ../../../Management/Account Management.php");
        }
        else
        {
            //Return back to Login Page
            session_unset();
            unset($_POST);
            $_SESSION['error'] = 1;
            header("Location: ../../../Login/Sign In.php");
        }
    }
?>