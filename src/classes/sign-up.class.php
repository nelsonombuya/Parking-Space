<?php
/*================================= CHECK-IN CLASS ===================================*/
/* Class for the whole checking in process                                            */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once __DIR__ . "/session.class.php";
/*====================================================================================*/
    class SignUp extends Session
    {
        private $_new_user;
        private $_url;

        public function __construct($new_user)
        {
            /* Constructing a session object */
            parent::__construct();

            /* Defining the user's details */
            $this->_new_user = $new_user;

            /* Defining the URL */
            $this->_url = HEADER_ROOT . "/sign-up.php";

            /* Checking whether the username or email already exists in the DB */
            if (!$this->checkUsername($this->_new_user['username']))
            {
                /* If checkUsername returns false, then the username already exists */
                $redirect = $this->URLHandler(array("error" => "signup_user-exists"), TRUE, $this->_url);
            }
            else if (!$this->checkEmail($this->_new_user['email']))
            {
                /* If checkEmail returns false, then the email already exists */
                $redirect = $this->URLHandler(array("error" => "signup_email-exists"), TRUE, $this->_url);
            }
            else
            {
                /* Signing up the user */
                $signup_result = $this->signUp();

                /* Redirecting in case of errors */
                if ($signup_result['user'])
                {
                    /* If there was an error adding the user, return the error */
                    $redirect = $this->URLHandler(array("error" => "signup_user"), TRUE, $this->_url);
                }
                else if ($signup_result['car'])
                {
                    /* If there was an error adding the user's cars, return the error */
                    $redirect = $this->URLHandler(array("error" => "signup_car"), TRUE, $this->_url);
                }
                else if ($signup_result['user'] && $signup_result['car'])
                {
                    /* If there was some kind of error adding both */
                    $redirect = $this->URLHandler(array("error" => "fail"), TRUE, $this->_url);
                }
                else
                {
                    /* If there was no error adding both */
                    $redirect = $this->URLHandler(array("error" => "success"), TRUE, $this->_url);
                }
            }

            /* Redirecting after the sign-up process stops */
            unset($this->_new_user['password']);    // Removing the user password so that they have to input a new one
            $redirect = $this->URLHandler($this->_new_user, TRUE, $redirect);
            header("Location: " . $redirect) or die();
        }

        private function checkUsername($username)
        {
            $query = "SELECT USERNAME FROM USER WHERE USERNAME LIKE ?";
            $variable_types = "s";
            $variables = array($username);
            return empty($this->runPreparedQuery($query, $variable_types, $variables)) ? TRUE : FALSE ;
        }
        
        private function checkEmail($email)
        {
            $query = "SELECT EMAIL FROM USER WHERE EMAIL LIKE ?";
            $variable_types = "s";
            $variables = array($email);
            return empty($this->runPreparedQuery($query, $variable_types, $variables)) ? TRUE : FALSE ;
        }

        private function signUp()
        {
            /* Getting the new user's details */
            $username = htmlentities($this->_new_user['username']);
            $email = htmlentities($this->_new_user['email']);
            $password = htmlentities($this->_new_user['password']);
            $first_name = htmlentities($this->_new_user['first_name']);
            $last_name = htmlentities($this->_new_user['last_name']);
            $id_number = htmlentities($this->_new_user['id_number']);
            $phone = htmlentities($this->_new_user['phone']);
            $number_plate = htmlentities($this->_new_user['number_plate']);

            /* Hashing the user password */
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            /* Setting up the query needed to add the user details */
            $query =    "INSERT INTO USER (USERNAME, PASS, EMAIL, FIRST_NAME, LAST_NAME, ID_NUMBER, PHONE)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";

            /* Running the prepared query to add user details */
            $result = $this->runPreparedQuery($query, "sssssss", array(
                $username,
                $hashed_password,
                $email,
                $first_name,
                $last_name,
                $id_number,
                $phone
            ));

            /* Query to add the driver's number_plate to the Car Table  */
            $query =    "INSERT INTO CAR (USERNAME, NUMBER_PLATE) VALUES (?, ?)";

            /* Running the prepared query */
            $number_plate_result = $this->runPreparedQuery($query, "ss", array($username, $number_plate));

            /* Setting the procedure as done */
            $_SESSION['form']['done'] = TRUE;

            return array(
                "user"  =>  $result,
                "car"   =>  $number_plate_result,
            );
        }
    }