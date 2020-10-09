<?php
    // Session
    // --------
    // Starting the session if there is none
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // Logging out the user when needed
    if (isset($_GET['logout']) && $_GET['logout'] = TRUE){ 
        logout(); 
    }

    // Function for logging out
    function logout(){
        session_unset();
        session_destroy();
        header("Location: /Index.php") or die();
    }

    // Function for checking Login Errors
    function checkLoginErrors()
    {
        // Checks the error code and displays relevant error messages
        if (isset($_GET['login_error']))
        {
            if (fnmatch('sql_*' , $_GET['login_error']))
            {
                // In the case of an SQL Error
                return  '<script type="text/JavaScript">
                            alert("A database error has occured. \nError Code: ' . $_GET['login_error'] . '");
                        </script>';
            }

            else if ($_GET['login_error'] === 'login_user')
            {
                // In case the user doesn't exist
                return  '<script type="text/JavaScript">  
                            alert("The username/e-mail does not have an account. \nError Code: ' . $_GET['login_error'] . '");
                        </script>';
            } 

            else if (fnmatch('login_pas*' , $_GET['login_error']))
            {
                // If the user input an incorrect password
                return  '<script type="text/JavaScript">  
                            alert("Wrong password, try again. \nError Code: ' . $_GET['login_error'] . '");
                        </script>';
            }
            
            else if ($_GET['login_error'] === 'login_empty')
            {
                // If there was no data input
                return  '<script type="text/JavaScript">  
                            alert("Please input details and try again. \nError Code: ' . $_GET['login_error'] . '");
                        </script>';
            }

            else 
            {
                // If a different kind of error occurs
                return  '<script type="text/JavaScript">  
                            alert("Please, sign in or continue as guest."); 
                        </script>';
            }

        }    
    }

    // User Details
    // ---------------
    // Function for outputting the current username
    function currentUsername(){
        if (isset($_SESSION['username'])){
            return $_SESSION['username'];
        }
        return "guest";
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