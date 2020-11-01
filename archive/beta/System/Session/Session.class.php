<?php
/*================================== SESSION CLASS ===================================*/
/* Class used for managing the System's Sessions                                      */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once __DIR__ . "/../Database/SQL.class.php";
/*====================================================================================*/
    class Session extends SQL 
    {
        public $current_driver_number;
        public $username;

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
            $this->username = isset($_SESSION['username']) ? $_SESSION['username'] : "~guest session~";
            
            /* Setting current driver number */
            $this->current_driver_number = $this->driverNumber() + 1;
        }

        /*------------------------------- METHODS ------------------------------------*/
        /* Method for Logging Out */
        public function logout()
        {
            if (isset($_SESSION['username']))
            {
                unset($_GET);
                session_unset();
                session_destroy();
                header("Location: ../Index.php") or die();
                return TRUE;
            }
            return FALSE;
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
                return "No Registered Drivers";
            } 
            else 
            {
                return $result[0]["ID"];
            }
        }
    }
?>