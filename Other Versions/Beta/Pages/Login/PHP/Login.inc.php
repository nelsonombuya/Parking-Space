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
        if (isset($_SESSION['username'])){
            // Redirect to Account Management Page
            header("Location: ../../Management/Account.php") or die();
        }
        // Else... To make the user to log in
        header("Location: ../Login.php?error=empty") or die();
    }      

    // Function for logging in
    function login($username, $password)
    {
        // Checking for connection to DB
        $connection_status = checkConnection();

        if ($connection_status !== TRUE)
        {
            // If there's a connection error
            header("Location: ../Login.php?error=$connection_status") or die();
        } 
        else 
        {
            // Connecting to the database
            $conn = connectToDatabase();

            //The query for checking for the user's details in the database
            $query  =   "SELECT USERNAME, EMAIL, PASS
                        FROM USERS 
                        WHERE USERNAME LIKE ?
                        OR EMAIL LIKE ?";

            // Preparing and executing the query
            if (!$stmt =  $conn->stmt_init())
            {
                // Error initializing the SQL Statement
                header("Location: ../Login.php?error=sql_init") or die();
            }

            else if (!$stmt = $conn->prepare($query))
            {
                // Error preparing the SQL Statement
                header("Location: ../Login.php?error=sql_prepare") or die();
            }
            
            else if (!$stmt->bind_param("ss", $username, $username))
            {
                // Error binding parameters
                header("Location: ../Login.php?error=sql_bind") or die();
            }
            
            else if (!$stmt->execute())
            {
                // Execute query
                header("Location: ../Login.php?error=sql_execute") or die();
            }
            
            else
            {
                // Getting the results of the query
                $fetched = $stmt->get_result();
                $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);

                if (is_bool($result))
                {    
                    // The username or e-mail isn't in the database
                    header("Location: ../Login.php?error=login_user") or die();
                }
                else 
                {
                    // Username of E-mail exists, checking Password
                    $password_check = password_verify($password, $result['0']['PASS']);
                    if ($password_check === FALSE)
                    {
                        // If the password is wrong
                        header("Location: ../Login.php?error=login_pass") or die();
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
                        header("Location: ../Login.php?error=login_pass_") or die();
                    }
                }
            }
        }
    }
?>