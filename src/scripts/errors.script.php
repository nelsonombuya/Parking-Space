<?php
/*==================================== ERRORS SCRIPT =================================*/
/* Script for returning Javascipt Alerts after Errors.                                */
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

    function checkSignUpErrors($error)
    {
        // Checks the error code and displays relevant error messages
        if (!empty($error))
        {
            if ($error === 'signup_user-exists')
            {
                // In case the user doesn't exist
                return  '<script type="text/JavaScript">  
                            alert("The username has been taken, try another. \nError Code: ' . $error . '");
                        </script>';
            } 

            else if ($error === 'signup_email-exists')
            {
                // In case the user doesn't exist
                return  '<script type="text/JavaScript">  
                            alert("The email has been taken, try another. \nError Code: ' . $error . '");
                        </script>';
            }

            else if ($error === 'signup_user')
            {
                // In case the user doesn't exist
                return  '<script type="text/JavaScript">  
                            alert("An error has occured when adding the user. \nError Code: ' . $error . '");
                        </script>';
            }

            else if ($error === 'fail')
            {
                // In case the user doesn't exist
                return  '<script type="text/JavaScript">  
                            alert("An error has occured when signing up. \nPlease try again \nError Code: ' . $error . '");
                        </script>';
            }

            else if ($error === 'success')
            {
                // In case the user doesn't exist
                return  '<script type="text/JavaScript">  
                            alert("You have been successfully signed up. \nYou will now be redirected to the login page \nError Code: ' . $error . '");

                            var time_left = 5; // How much time before redirecting
                            var redirect_timer = setInterval(function () {
                                if (time_left <= 0) {
                                    clearInterval(redirect_timer);
                                    window.location.href = "login.php"; // Page to redirect to
                                } else {
                                    time_left -= 1;
                                }
                            }, 1000);
                        </script>';
            }

            else 
            {
                // If a different kind of error occurs
                return  '<script type="text/JavaScript">  
                            alert("Please, try signing up again."); 
                        </script>';
            }

        }    
    }

    function checkChangePasswordErrors($error)
    {
        // Checks the error code and displays relevant error messages
        if (!empty($error))
        {
            switch ($error)
            {
                case 'success':
                    /* If the user is logged in */
                    if (isset($_SESSION['username']))
                    {
                        return  '<script type="text/JavaScript">  
                                    alert("Your password has been changed successfully. \nYou will be taken back to the dashboard.");
                                    window.location.href = "dashboard.php"; 
                                </script>';
                    }
                    else
                    {
                        /* Destroying the session so as to remove those reset details from session */
                        session_destroy();

                        /* Returning the javascript */
                        return  '<script type="text/JavaScript">  
                                    alert("Your password has been changed successfully. \nYou will be taken back to the home page.");
                                    window.location.href = "index.php"; 
                                </script>';
                    }   
                

                case 'change-password_fail':
                    return  '<script type="text/JavaScript">  
                                alert("Unable to change the password. \nPlease Try Again. \nError Code: ' . $error . '");
                            </script>';
                

                case 'reset-password_fail':
                    return  '<script type="text/JavaScript">  
                                alert(  "You have an incorrect link. \n
                                        It has either timed-out or is invalid. \n
                                        You will now be redirected to the password reset page to request for another reset link \n
                                        Error Code: ' . $error . ');
                                window.location.href = "password-recovery.php"; 
                            </script>';
                

                case 'recover-password_email-dne':
                    return  '<script type="text/JavaScript">  
                                alert(  "The email you have input does not exist in the databse. \n
                                        You could always sign up for an account if you do not have one" \n
                                        Error Code: ' . $error . ');
                            </script>';
                

                default:
                    /* In case of any other failure */
                    return  '<script type="text/JavaScript">  
                                alert("Unable to change the password. \nPlease Try Again. \nError Code: ' . $error . '");
                            </script>';
                

            }
        }
    }

    /* 
        Function for inputting values in forms 
        Useful after error's in the form
    */
    function formInputValue($form_variable_name)
    {
        /* Checking if the form array is set */
        if (isset($_GET))
        {
            /* Setting the output value in case it exists in the $_GET variables */
            $output = isset($_GET[$form_variable_name]) ? $_GET[$form_variable_name] : "";

            /* Return the value for that form variable */
            echo "value='". $output ."'";
        }
        else
        {
            /* If it's not set, return a blank value */
            echo "value=''";
        }
    }
?>