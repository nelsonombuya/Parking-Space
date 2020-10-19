<?php
/*================================ LOGIN ERRORS SCRIPT ===============================*/
/* Script for returning Javascipt Alerts after Login Errors.                          */
/*====================================================================================*/
    function checkLoginErrors($error)
    {
        // Checks the error code and displays relevant error messages
        if (!empty($error))
        {
            if (fnmatch('sql_*' , $error))
            {
                // In the case of an SQL Error
                return  '<script type="text/JavaScript">
                            alert("A database error has occured. \nError Code: ' . $error . '");
                        </script>';
            }

            else if ($error === 'login_user')
            {
                // In case the user doesn't exist
                return  '<script type="text/JavaScript">  
                            alert("The username/e-mail does not have an account. \nError Code: ' . $error . '");
                        </script>';
            } 

            else if (fnmatch('login_pas*' , $error))
            {
                // If the user input an incorrect password
                return  '<script type="text/JavaScript">  
                            alert("Wrong password, try again. \nError Code: ' . $error . '");
                        </script>';
            }
            
            else if ($error === 'login_empty')
            {
                // If there was no data input
                return  '<script type="text/JavaScript">  
                            alert("Please input details and try again. \nError Code: ' . $error . '");
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
?>