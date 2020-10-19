<?php
/*================================== SETUP CLASS =====================================*/
/* Class used for Setting Up the System's Database                                    */
/* Extends the SQL Class to be able to use SQL commands                               */
/*====================================================================================*/

/*================================== Requirements ====================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/System/Settings/Settings.class.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/System/Database/SQL.class.php";
/*====================================================================================*/

    class Setup extends SQL
    {
        private $_tables;
        public  $setup_results;

        /*                              CONSTRUCTOR                                 */
        public function __construct()
        {
            /* Constructing needed variables from the Parent SQL Class */
            parent::__construct();

            /* Creating list of tables to be created in the database */
            if ($this->_tables = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/System/Database/Database.ini", TRUE) === FALSE)
            {
                $this->_tables = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/System/Database/Default.ini", TRUE);
            }
            
            /* Forcing the database to be created if no database has been found */
            if ($this->connection_status !== "sql_connected_db")
            {
                echo $this->errorChecker($this->setup_results = $this->setup());
            }
        }

        /*------------------------------- METHODS ----------------------------------*/
        private function createDatabase()
        {
            if ($this->connection_status === "sql_connected_server")
            {
                // checkConnection returning sql_db means that the database doesn't exist
                return  $this->runQuery("CREATE DATABASE " . $this->_database);
            } 
            else if ($this->connection_status === "sql_connected_db")
            {
                return $this->error = "setup_dbexists";
            }
            else
            {
                return $this->error = "setup_other";
            }
        }
        
        private function dropDatabase()
        {
            return $this->runQuery("DROP DATABASE " . $this->_database);
        }

        private function createTables()
        {
            /*
                Creates tables from list of pre-defined database table schemas
                You can see the actual table design implementation on Tables.ini 
            */
            foreach ($this->_tables as $table => $options)
            {
                $result[$table] = $this->runQuery($options["SCHEMA"]);
            }

            return $result;
        }

        private function addTestData()
        {
            if ($this->settings['setup']['add_test_data'])
            {
                foreach($this->_tables as $table => $options)
                {
                    $counter = 0;
                    foreach($options["DATA"] as $data)
                    {
                        $result[$counter] = $this->runQuery($data);
                        $counter++;
                    }

                    $data_result[$table] = $result;
                }
            } 
            else 
            {
                /* If they don't need test data, we add the Admin User(s) */
                $counter = 0;
                foreach($this->_tables['USER']['DATA'] as $data)
                {
                    $result[$counter] = $this->runQuery($data);
                    $counter++;
                }
                $data_result['USER'] = $result;
            }

            return $data_result;
        }

        private function hashPasswords()
        {
            /* Getting user data */
            $users = $this->runQuery("SELECT USERNAME, PASS FROM USER");
    
            /* Getting each user's details and hashing their passwords individually */
            foreach ($users as $user => $data)
            {
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

        public function setup()
        {
            /* NOTE: The variables are used for error detection */
            $database_result = $this->createDatabase(); // First we create the Database
            $this->reconnect();                         // Then we connect to the database
            $table_result = $this->createTables();      // Then we create the Tables
            $data_result = $this->addTestData();        // Then we add the test data for each table
            $hashing_results = $this->hashPasswords();  // Then we hash the password for the added users
    
            // Returning the errors (Or lack thereof)
            return array(
                "Database"  => $database_result,
                "Tables"    => $table_result,
                "Test Data" => $data_result,
                "Hash"      => $hashing_results
            );
        }
        
        public function errorChecker($setup_results)
        {
            // Checking database
            if ($setup_results["Database"] === FALSE)
            {
                // Error during the making of the Database
                $this->dropDatabase();
                return '<script type="text/JavaScript">  
                            alert("Error creating the Database. \nCheck the Log File for more information."); 
                        </script>';
            } 
            else 
            {
                // Checking Tables 
                foreach($setup_results["Tables"] as $table)
                {
                    if ($table === FALSE)
                    {
                        // Error Creating Table
                        $this->dropDatabase();
                        return  '<script type="text/JavaScript">  
                                    alert("Error creating the Tables. \nCheck the Log File for more information."); 
                                </script>';
                    } 
                }
                
                // Checking Data
                if ($this->settings['setup']['add_test_data'])
                {
                    foreach($setup_results["Test Data"] as $table => $data){
                        foreach($data as $datum => $status)
                        {
                            if ($status === FALSE)
                            {
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
                foreach($setup_results["Hash"] as $username => $is_password_hashed)
                {
                    if ($is_password_hashed === FALSE)
                    {
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
                            window.location.href = "'.$this->version_dir_relative.'"; 
                        </script>';
            }
        }
    }
?>