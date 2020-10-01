<?php
    // Required Files
    require $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Includes.php"; 

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
        // If there's no user details input, check for a user session
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === TRUE){
            // Redirect to Account Management Page
            header("Location: ../../Management/Account.php") or die();
        }
        // Else... To make the user to log in
        header("Location: ../Login.php?error=empty") or die();
    }      

    // Function for logging in
    function login($username, $password)
    {
        //The Query for checking for the user's details in the database
        $query  =   "SELECT USERNAME, PASS 
                    FROM USERS 
                    WHERE USERNAME = ?";

        // Using Prepared SQL statements for security
        $stmt = mysqli_stmt_init(connectToDatabase());

        if (!mysqli_stmt_prepare($stmt, $query))
        {
            // If there's a connection error
            header("Location: ../Login.php?error=sql_error") or die();
        } 
        else 
        {
            // Executing the Query
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // If the user exists
            if ($row = mysqli_fetch_assoc($result))
            {
                // Checking Password
                $password_check = password_verify($password, $row['PASS']);
                if ($password_check === FALSE)
                {
                    // If the password is wrong
                    header("Location: ../Login.php?error=wrong_pass") or die();
                }
                else if ($password_check === TRUE)
                {
                    // If the password is correct, the user is logged in successfully
                    unset($_POST);
                    session_start();
                    $_SESSION['username'] = $row['USERNAME'];

                    // Redirect to Account Management Page
                    header("Location: ../../Management/Account.php") or die();
                }
                else 
                {
                    // If the password is wrong but due to a different error
                    header("Location: ../Login.php?error=wrong_pass") or die();
                }
            } 
            else 
            {
                // If the username doesn't exist in the database
                header("Location: ../Login.php?error=user_dne") or die();
            }
        }
    }
?>