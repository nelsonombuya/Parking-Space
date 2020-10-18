<?php
/*================================== SESSION CLASS ===================================*/
/* Class used for managing the System's Sessions                                      */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Classes/SQL.class.php";
/*====================================================================================*/
    class Session extends SQL {
        public $driver_number;
        public $username;

        /*                              CONSTRUCTOR                                   */
        public function __construct($username = "guest"){
            /* Constructing the Parent Class */
            parent::__construct();

            /* Setting necessary details */
            if (session_status() === PHP_SESSION_NONE){
                session_start();
            }

            /* Setting Username */
            $_SESSION['username'] = $this->username = (
                isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] ) ? $_SESSION['username'] : $username;

            /* Setting Login Status*/
            $_SESSION['is_logged_in'] = (
                $_SESSION['username'] === "guest" && !$_SESSION['is_logged_in']) ? FALSE : TRUE;
            
            /* Setting current driver number */
            $this->driver_number = $this->driverNumber();
        }

        /*------------------------------- METHODS ------------------------------------*/
        /* Method for Logging Out */
        public function logout(){
            if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']){
                unset($_GET);
                session_unset();
                session_destroy();
                header("Location: /Index.php") or die();
                return TRUE;
            }
            return FALSE;
        }

        
        /* Method for outputting the current driver number */
        public function driverNumber(){
            $query  =   "SELECT ID FROM PARKING_TRANSACTION
                        ORDER BY ID DESC
                        LIMIT 1";
            $result = $this->runQuery($query);

            if (is_bool($result)){
                return "No Registered Drivers";
            } else {
                return $result[0]["ID"];
            }
        }
    }
?>