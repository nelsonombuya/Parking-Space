<?php
/*=================================== LOGIN CLASS ====================================*/
/* LOGIN PLEASE                                                                       */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once __DIR__ . "/session.class.php";
/*====================================================================================*/

    class Login extends Session 
    {
        /*                              CONSTRUCTOR                                   */
        public function __construct($username, $password)
        {
            /* Constructing the Parent Class */
            parent::__construct();

            /* Setting variables to protect from JS injection */
            $username = htmlentities($username);
            $password = htmlentities($password);
            $this->login($username, $password);
        }

        /*------------------------------- METHODS ------------------------------------*/
        private function login($username, $password)
        {
            /* Getting user details */
            $user_data = $this->getUserDetails($username);

            if (empty($user_data)) 
            {
                /* If it's empty, the user isn't on the database */
                header("Location: " . HEADER_ROOT . "/login.php?error=login_user") or die();
            }
            else if (!empty($this->error))
            {
                /* In case of any other kind of error */  
                header("Location: " . HEADER_ROOT . "/login.php?error=login_".$this->error) or die();
            } 
            else
            {
                /* Everything's OK -> Checking the input password */
                $checked_password = $this-> verifyPassword($password, $user_data['0']['PASS']);
            }

            if ($checked_password === TRUE)
            {
                /* Username iko sawa, Password iko sawa */
                unset($_POST);
                new Session($user_data[0]['USERNAME'], $user_data[0]['PRIVILEDGE'], TRUE);
                header("Location: " . HEADER_ROOT . "/dashboard.php") or die();
            } 
            else 
            {
                header("Location: " . HEADER_ROOT . "/login.php?error=login_$checked_password") or die();
            }
        }
    }   
?>