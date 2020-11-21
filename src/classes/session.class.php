<!-------------- Some Javascript functions that are useful for this class ------------->
    <script type="text/Javascript" src="./../src/js/session.inc.js"></script>
<!------------------------------------------------------------------------------------->

<?php
/*================================== SESSION CLASS ===================================*/
/* Class used for managing the System's Sessions                                      */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once __DIR__ . "/sql.class.php";
/*====================================================================================*/
    class Session extends SQL 
    {
        protected $username;
        protected $priviledge;

        /*                              CONSTRUCTOR                                   */
        public function __construct($username = null, $priviledge = null, $new_login = FALSE)
        {
            /* Constructing the Parent Class */
            parent::__construct();

            /* Starting session if there isn't one */
            if (session_status() === PHP_SESSION_NONE) session_start();

            /* Setting Username and user priviledges if it's a new login */
            if ($new_login) $this->setUserCredentials($username, $priviledge);
            
            /* Setting username carried by object */
            $this->username = isset($_SESSION['username']) ? $_SESSION['username'] : "guest";
            $this->priviledge = isset($_SESSION['priviledge']) ? $_SESSION['priviledge'] : "user";
        }

        /*------------------------------- METHODS ------------------------------------*/
        /* Method for setting the user's credentials after login  */
        private function setUserCredentials($username, $priviledge)
        {
            /* Setting the username and user priviledges in the session */
            $_SESSION['username'] = $username;
            $_SESSION['priviledge'] = $priviledge;
        }

        /* Method for Logging Out */
        public function logout($confirmed = FALSE)
        {
            /* Checking whether the user has already confirmed logout */
            if ($confirmed === TRUE)
            {
                /* Checking whether a session is present */
                if (isset($_SESSION['username']))
                {
                    unset($_GET);
                    session_unset();
                    session_destroy();
                    header("Location: " . HEADER_ROOT) or die();
                    return TRUE;
                }

                /* If the user hasn't logged in */
                else
                {
                    echo    '<script type="text/JavaScript">  
                                alert("No user is currently logged in."); 
                            </script>';
                    return FALSE;
                }
            }

            /* Asking the user whether they want to log out */
            else if (isset($_SESSION['username']))
            {
                /* Setting up some funky JS within PHP */
                echo    '<script type="text/JavaScript">
                            /* Confirming whether the user wants to log out */
                            if (confirm("Are you sure you want to log out?"))
                            {
                                /* Adding the logout_confirmed $_GET value to the URL */
                                window.location = addParamsToURL("logout_confirmed", "true");
                            }
                            else
                            {
                                /* Removing the logout $_GET value from the URL */
                                window.location = removeParamsFromURL("logout", "true");
                            }
                        </script>';
                return FALSE;
            }

            /* 
                If the user hasn't logged in 
                and they haven't set logout to true 
                but this function is still called 
            */
            else
            {
                echo    '<script type="text/JavaScript">  
                            alert("No user is currently logged in."); 
                        </script>';
                return FALSE;
            }
        }

        /* Method for resetting a user's password */
        public function resetPassword($email, $reset_key, $new_password)
        {
            /* Getting the user details from the database so as to verify the user's key */
            $query =    "SELECT USERNAME, PASS, TEMP_KEY
                        FROM USER
                        WHERE EMAIL = ?";
            if(!empty($result = $this->runPreparedQuery($query, "s",  array($email))))
            {
                if ($this->verifyPassword($reset_key, $result[0]['TEMP_KEY']))
                {
                    /* If the key matches, change their password */
                    return $this->changePassword($result[0]['USERNAME'], $new_password);
                }
                else
                {
                    /* If the key doesn't match, send false so that they can get another link */
                    $this->error = "password-reset_bad-key";
                    return FALSE;
                }
            }
            else
            {
                /* IF the email doesn't match, return false */
                $this->error = "password-reset_email-dne";
                return FALSE;
            } 
        }

        /* Method for changing a user's password */
        public function changePassword($username, $new_password, $old_password = null)
        {
            if ($old_password !== null)
            {
                /* Checking whether the user's old password is the correct one */
                /* First we get the user data */
                $prepared_query =   "SELECT USERNAME, PASS FROM USER WHERE USERNAME = ?";
                $user_data = $this->runPreparedQuery($prepared_query, "s", array($username));
                if (empty($user_data))
                {
                    $this->error = "change-password_user-dne";
                    return FALSE;
                }
                else
                {
                    /* Verifying the old password */
                    $password_check = password_verify($old_password, $user_data[0]['PASS']);

                    if ($password_check === FALSE)
                    {
                        /* If the password is wrong */
                        $this->error = "change-password_wrong-pass";
                        return FALSE;
                    } 
                    else if ($password_check === TRUE) 
                    {
                        /* If the password is correct */
                        return $this->updatePassword($username, $new_password);
                    } 
                    else 
                    {
                        /* If the password is wrong but due to a different error */
                        $this->error = "change-password_wrong-pass-other";
                        return FALSE;
                    }
                }
            } 
            else
            {
                return $this->updatePassword($username, $new_password);
            }
        }

        private function updatePassword($username, $new_password)
        {
            /* Query for changing the user's password */
            $prepared_query =   "UPDATE USER
                                SET PASS = ?
                                WHERE USERNAME = ?";

            /* Hashing the user's input passwords */
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);

            /* Running prepared query to avoid SQL Injections */
            /* Prepared Queries Return false during Update Statements */
            return $this->runPreparedQuery($prepared_query, "ss", array($new_password, $username)) ? FALSE : TRUE;
        }

        /* 
            Method for retrieving user details from the database 
            Only username, email, password unless explicitly defined otherwise
        */
        protected function getUserDetails($username_or_email)
        {
            $query =    "SELECT USERNAME, EMAIL, PASS, PRIVILEDGE FROM USER WHERE USERNAME LIKE ? OR EMAIL LIKE ?";
            $variable_types = "ss";
            $variables = array($username_or_email, $username_or_email);
            return $this->runPreparedQuery($query, $variable_types, $variables);
        }

        /* Method for verifying the user input password against the one on the database */
        protected function verifyPassword($input_password, $user_password_in_database)
        {
            $password_check = password_verify($input_password, $user_password_in_database);

            if ($password_check === FALSE)
            {
                /* If the password is wrong */
                return "pass";
            } 
            else if ($password_check === TRUE) 
            {
                /* If the password is correct */
                return TRUE;
            } 
            else 
            {
                // If the password is wrong but due to a different error
                return "pass-other";
            }
        }

        /* Method to check whether the user exists in the database */
        public function doesUserExist($username_or_email)
        {
            return empty($this->getUserDetails($username_or_email)) ? FALSE : TRUE;
        }

        /* Method for generating temporary user keys for stuff */
        public function generateTemporaryKey($username_or_email = null)
        {
            /* Generating random number, hashing it to use it as the key, and hashing the key */
            $key = password_hash(rand(), PASSWORD_DEFAULT);
            $hashed_key = password_hash($key, PASSWORD_DEFAULT);

            if ($username_or_email === null)
            {
                /* Adding key to the set user's database record */
                $query =    "UPDATE USER
                            SET TEMP_KEY = ? 
                            WHERE USERNAME = ? 
                            OR EMAIL = ?";
                $variable_types = "sss";
                $variables = array($hashed_key, $username_or_email, $username_or_email);
                $this->runPreparedQuery($query, $variable_types, $variables);
            }
            
            /* Returning the generated key */
            return $key;
        }
    }
?>