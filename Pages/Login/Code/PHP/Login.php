<?php
    // For connecting to the database
    require "../../../../Includes/Configuration/Connection.php";
    //TODO: Define the way the username should be for Validation
    // Getting the username and password from the page and adding htmlentities to make it more secure
    $username = htmlentities($_POST['login_username']);
    $password = htmlentities($_POST['login_password']);

    //TODO: A way to access data in an associative array without using Foreach
    //The Query for checking for the user's details in the database
    $query  = "SELECT USERNAME, PASS FROM USERS WHERE USERNAME = '$username'";
    if (mysqli_query($GLOBALS['connect'], $query) -> num_rows > 0)
    {
        $fetched = mysqli_query($GLOBALS['connect'], $query);
        $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
        
        //TODO:Remember to add security features for these elements
        //Checking whether the user is using correct details
        foreach($result as $user)
        {
            if ($user['USERNAME'] == $username && $user['PASS'] == $password)
            {
                //Start Session
                session_start();
                $_SESSION['username'] = $username;
                
                //Redirect to Account Management Page
                header("Location: ../../../Management/Account Management.php");
            }
            else
            {
                //Account Exists But Passwords don't Match
                //TODO: Wrong Username & Password Message
                $_POST['login_username'] = "";
                $_POST['login_password'] = "";
                header("Location: ../../../Login/Login.html");
            }
        }
    }
    else
    {
        //Return back to Login Page
        //TODO: Account Doesn't Exist Warning
        $_POST['login_username'] = "";
        $_POST['login_password'] = "";
        header("Location: ../../../Login/Login.html");
    }
?>