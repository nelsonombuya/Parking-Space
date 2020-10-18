<?php
/*================================== SETUP CLASS =====================================*/
/* Class used for Setting Up the System's Database                                    */
/* Extends the SQL Class to be able to use SQL commands                               */
/*====================================================================================*/

/*================================== Requirements ====================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Parser.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Classes/SQL.class.php";
/*====================================================================================*/
    class Setup extends SQL{
        private $_tables;

        /*                              CONSTRUCTOR                                 */
        public function __construct(
            /*-------------------------- Arguments ---------------------------------*/
            $file = "/Resources/Settings/Tables.ini", 
            $host = settings['server']['host'],             // The Host Name
            $user = settings['server']['user'],             // The Host username
            $password = settings['server']['password'],     // The Host Password
            $database = settings['server']['database']      // The Host Database
        )
        /*                          CONSTRUCTOR DEFINITION                          */
        {
            /* Constructing needed variables from the SQL Parent Class */
            parent::__construct($host, $user, $password, $database);

            /* Creating list of tables to be created in the database */
            $this->_tables = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . $file, TRUE);
            
            /* Forcing the database to be created if no database has been found */
            if ($this->connection_status !== "sql_connected_db"){
                echo $this->errorChecker($this->setup_results = $this->setup());
            }
        }

        /*------------------------------- METHODS ----------------------------------*/
        private function createDatabase(){
            if ($this->connection_status === "sql_connected_server"){
                // checkConnection returning sql_db means that the database doesn't exist
                return  $this->runQuery("CREATE DATABASE " . $this->_database);
            } else {
                return $this->error = "sql_db_exists";
            }
        }
        
        private function dropDatabase(){
            return $this->runQuery("DROP DATABASE " . $this->_database);
        }

        private function createTables(){
            /*
                Creates tables from list of pre-defined database table schemas
                You can see the actual table design implementation on Tables.ini 
            */
            foreach ($this->_tables as $table => $options){
                $result[$table] = $this->runQuery($options["SCHEMA"]);
            }
            return $result;
        }

        private function addTestData(){
            if (settings['setup']['add_test_data']){
                foreach($this->_tables as $table => $options){
                    $counter = 0;
                    foreach($options["DATA"] as $data){
                        $result[$counter] = $this->runQuery($data);
                        $counter++;
                    }
                    $data_result[$table] = $result;
                }
            } else {
                /* If they don't need test data, we add the Admin User(s) */
                $counter = 0;
                foreach($this->_tables['USER']['DATA'] as $data){
                    $result[$counter] = $this->runQuery($data);
                    $counter++;
                }
                $data_result['USER'] = $result;
            }
            return $data_result;
        }

        private function hashPasswords(){
            /* Getting user data */
            $users = $this->runQuery("SELECT USERNAME, PASS FROM USER");
    
            /* Getting each user's details and hashing their passwords individually */
            foreach ($users as $user => $data){
                $username = $data["USERNAME"];
                $original_password = $data["PASS"];
                $hashed_password = password_hash($original_password, PASSWORD_DEFAULT);
    
                /* Running update query to change their insecure passwords to the hashed password */
                $query  =   "UPDATE USER 
                            SET PASS = '$hashed_password' 
                            WHERE USERNAME = '$username'";
                $result[$username]= $this->runQuery($query);
            }
            return $result;
        }

        public function setup(){
            /* NOTE: The variables are used for error detection */
            /* First we create the Database */
            $database_result = $this->createDatabase();
            $this->reconnectToDB();
    
            // Then we create the Tables
            $table_result = $this->createTables();
    
            // Then we add the test data for each table (If the user wants it)
            $data_result = $this->addTestData();
    
            // Then we hash the password for the added users
            $hashing_results = $this->hashPasswords();
    
            // Returning the errors (Or lack thereof)
            return array(
                "Database"  => $database_result,
                "Tables"    => $table_result,
                "Test Data" => $data_result,
                "Hash"      => $hashing_results
            );
        }
        
        public function errorChecker($setup_results){
            // Checking for errors
            if ($setup_results["Database"] === FALSE){
                // Error during the making of the Database
                $this->dropDatabase();
                return '<script type="text/JavaScript">  
                            alert("Error creating the Database. \nCheck the Log File for more information."); 
                        </script>';
            } else {
                // Checking Tables 
                foreach($setup_results["Tables"] as $table){
                    if ($table === FALSE){
                        // Error Creating Table
                        $this->dropDatabase();
                        return  '<script type="text/JavaScript">  
                                    alert("Error creating the Tables. \nCheck the Log File for more information."); 
                                </script>';
                    } 
                }
                
                // Checking Data
                if (settings['setup']['add_test_data']){
                    foreach($setup_results["Test Data"] as $table => $data){
                        foreach($data as $datum => $status){
                            if ($status === FALSE){
                                // Error adding data
                                $this->dropDatabase();
                                return  '<script type="text/JavaScript">  
                                            alert("Error adding data to the Tables. \nCheck the Log File for more information."); 
                                        </script>';
                            }
                        }
                    }
                }
    
                // Checking whether passwords were hashed
                foreach($setup_results["Hash"] as $username => $is_password_hashed){
                    if ($is_password_hashed === FALSE){
                        // Error hashing a user's password, it'll be insecure
                        $this->dropDatabase();
                        return  '<script type="text/JavaScript">  
                                    alert("Error hashing user passwords. \nCheck the Log File for more information."); 
                                </script>';
                    }
                }
    
                // If no errors occured
                return  '<script type="text/JavaScript">  
                            alert("The system has been set up. \nYou will be redirected to the Starting Page in a moment");
                            window.location.href = "../../Index.php"; 
                        </script>';
            }
        }
    }
?>