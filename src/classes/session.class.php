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
        public $username;
        public $current_driver_number;

        /*                              CONSTRUCTOR                                   */
        public function __construct($username = null, $new_login = FALSE)
        {
            /* Constructing the Parent Class */
            parent::__construct();

            /* Starting session if there isn't one */
            if (session_status() === PHP_SESSION_NONE) session_start();

            /* Setting Username if it's a new login*/
            if ($new_login) $_SESSION['username'] = $this->username = $username;
            
            /* Setting username carried by object */
            $this->username = isset($_SESSION['username']) ? $_SESSION['username'] : "~guest-session~";
            
            /* Setting current driver number */
            $this->current_driver_number = $this->driverNumber() + 1;
        }

        /*------------------------------- METHODS ------------------------------------*/
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

        /* Method for outputting the current driver number */
        public function driverNumber()
        {
            $query  =   "SELECT ID FROM PARKING_TRANSACTION
                        ORDER BY ID DESC
                        LIMIT 1";
            $result = $this->runQuery($query);

            if (is_bool($result))
            {
                return "No Registered Transactions";
            } 
            else 
            {
                return $result[0]["ID"];
            }
        }

        public function changePassword($username, $new_password)
        {
            /* Query for changing the user's password */
            $prepared_query =   "UPDATE USER
                                SET PASS = ?
                                WHERE USERNAME = ?";

            /* Hashing the user's password */
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);

            /* Running prepared query to avoid SQL Injections */
            /* Prepared Queries Return false during Update Statements */
            return $this->runPreparedQuery($prepared_query, "ss", array($new_password, $username)) ? FALSE : TRUE;
        } 
    }
?>