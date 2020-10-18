<?php
/*================================== LOGIN SCRIPT ====================================*/
/* LOGIN PLEASE                                                                       */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Includes.inc.php";
/*====================================================================================*/

    class Login extends Session {
        /*                              CONSTRUCTOR                                   */
        public function __construct($username, $password){
            /* Constructing the Parent Class */
            parent::__construct();
            /* Setting variables to protect from JS injection */
            $username = htmlentities($username);
            $password = htmlentities($password);
            $this->login($username, $password);
        }

        /*------------------------------- METHODS ------------------------------------*/
        private function login($username, $password){
            /* Getting user details */
            $user_data = $this->userDetails($username);    

            if (!empty($user_data)){  // If it's not an array, it has an error
                /* Checking the input password */
                $checked_password = $this-> passwordCheck($password, $user_data['0']['PASS']);
            } else if (!empty($this->error)){
                header("Location: ". relative_root_dir . "/Pages/Login/Login.php?error=login_".$this->error) or die();
            } else {
                header("Location: ". relative_root_dir . "/Pages/Login/Login.php?error=login_user") or die();
            }

            if ($checked_password === TRUE){
                /* Username iko sawa, Password iko sawa */
                unset($_POST);
                $session = new Session($this->username = $username);
                header("Location: ../../Management/Account.php") or die();
            } else {
                header("Location: ". relative_root_dir . "/Pages/Login/Login.php?error=login_"."$checked_password") or die();
            }
        }

        private function userDetails($username){
            /* Running a prepared query to protect from SQL Injections */
            $query  =   "SELECT USERNAME, EMAIL, PASS
                        FROM USER
                        WHERE USERNAME LIKE ?
                        OR EMAIL LIKE ?";

            if ($result = $this->prepareQuery($query)){                         // Preparing Query
                if ($this->prepared->bind_param("ss", $username, $username)){   // Binding the Parameters
                    $result = $this->executePreparedQuery();                    // Executing the query
                } else {
                    $result = $this->error = "sql_bind";
                }
            }    
            // NOTE: If the execution fails, it adds sql_init or sql_prepare depending on the error
            return $result;
        }

        private function passwordCheck($password, $user_password){
            $password_check = password_verify($password, $user_password);

            if ($password_check === FALSE){
                /* If the password is wrong */
                return "pass";
            } else if ($password_check === TRUE) {
                /* If the password is correct */
                return TRUE;
            } else {
                // If the password is wrong but due to a different error
                return "pass-extra";
            }
        }
    }   
?>