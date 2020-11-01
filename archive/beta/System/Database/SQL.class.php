<?php
/*==========================================SQL CLASS=================================*/
/* Class used for SQL Commands and such. Makes Life Easier                            */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once __DIR__ . "/../.." . "/System/Settings/Settings.class.php";
/*====================================================================================*/

    class SQL extends Settings 
    {
        private $_prepared;
        protected $_connection;
        protected $_database;
        public  $connection_status;
        public  $error;

        /*                              CONSTRUCTOR                                 */
        public function __construct()
        {
            // Getting the settings from the settings class
            parent::__construct();

            // Setting the server details from the settings file
            $host = $this->settings["server"]["host"];          // The host server
            $user = $this->settings["server"]["user"];          // The host username
            $password = $this->settings["server"]["password"];  // The host password
            $database = $this->settings["server"]["database"];  // The host database name

            /* Saving Database as a variable for use outside the class */
            $this->_database = $database;

            /* Creating connection with server */
            if (!$this->connect($host, $user, $password, $database))
            {
                echo    '<script type="text/JavaScript">  
                            alert("Error connecting to the SQL Server."); 
                        </script>';
            }
        }

        /*------------------------------- METHODS ----------------------------------*/
        /* Method for setting up a connection to the database */
        public function connect($host, $user, $password, $database)
        {
            if ($this->_connection = mysqli_connect($host, $user, $password))
            {
                /* Checking for a connection to the database */
                if ($this->_connection->query("USE $database"))
                {
                    /* If connection to db occurs, use it as trhe main connection */
                    $this->reconnect();
                    $this->connection_status = "sql_connected_db";
                    return TRUE;
                } 
                else 
                {
                    /* Continue using connection to sql server if the connection to the db fails */
                    $this->connection_status = "sql_connected_server";
                    return FALSE;
                }
            } 
            else 
            {
                /* When no connection is made to the server */
                $this->_connection = null;
                $this->connection_status = "sql_disconnected";
                return FALSE;
            }
        }

        /* Function for reconnecting to the database if need be */
        protected function reconnect()
        {
            $this->_connection->close();
            return $this->_connection = mysqli_connect(
                $this->settings["server"]["host"],      // The host server
                $this->settings["server"]["user"],      // The host username
                $this->settings["server"]["password"],  // The host password
                $this->settings["server"]["database"]   // The host database name
            );
        }

        /* Function for running a query and fetching it's data */
        public function runQuery($query)
        {
            return $this->fetchResults($this->_connection->query($query));
        }

        /* Function for preparing a query for running as a prepared query */
        public function runPreparedQuery($query, $value_types = null, $data_array = array())
        {
            if (!$this->_prepared = $this->_connection->stmt_init())
            {
                return $this->error = "sql_init";        // Error initializing the SQL Database connection
            } 
            else if (!$this->_prepared = $this->_connection->prepare($query))
            {
                return $this->error = "sql_prepare";     // Error preparing the SQL Statement
            } 
            else
            {
                // If it has managed to prepare the query, start binding the variables
                if ($value_types !== null)
                {
                    if ($this->bindPreparedQuery($value_types, $data_array) !== TRUE)
                    {
                        return "sql_bind";
                    }
                }
                
                if (!$this->_prepared->execute())
                {
                    /* Error Executing prepared query */                
                    return $this->error ="sql_execute";     
                } 
                else 
                {                                
                    /* Getting the results of the query */
                    return $this->fetchResults($this->_prepared->get_result());
                }
            }
        }

        /* Function for binding values to a prepared */
        // NOTE: Can do a maximum of 3 values so far
        private function bindPreparedQuery($value_types, $data_array)
        {
            $inputs = count($data_array);

            switch ($inputs)
            {
                case 1 :
                    if ($this->_prepared->bind_param($value_types, $data_array[0]))
                    {
                        return TRUE;
                    }
                    else
                    {
                        return $this->error = "sql_bind";
                    }
                break;

                case 2 :
                    if ($this->_prepared->bind_param($value_types, $data_array[0], $data_array[1]))
                    {
                        return TRUE;
                    }
                    else
                    {
                        return $this->error = "sql_bind";
                    }
                break;

                case 3 :
                    if ($this->_prepared->bind_param($value_types, $data_array[0], $data_array[1], $data_array[2]))
                    {
                        return TRUE;
                    }
                    else
                    {
                        return $this->error = "sql_bind";
                    }
                break;

                default :
                    return $this->error = "sql_bind_overflow";
                break;
            }
        }

        /* Function for converting the results obtained from running a query into an associative array or boolean */
        private function fetchResults($fetched)
        {
            /* Outputting a boolean or associative array when necessary */
            if (is_bool($fetched))
            {
                $result = $fetched;
            } 
            else 
            {
                $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
            }

            return $result;
        }

        /* Function for connecting to the Server */
        public function connectToServer()
        { 
            /* Returns TRUE if successful, FALSE if not */
            return mysqli_connect(
                $this->settings["server"]["host"],     // The Host Name
                $this->settings["server"]["user"],     // The Host username
                $this->settings["server"]["password"]  // The Host Password
            );
        }
        
        // Function for connecting to the Database
        public function connectToDatabase()
        { 
            /* Returns TRUE if successful, FALSE if not */
            return mysqli_connect(
                $this->settings["server"]["host"],     // The Host Name
                $this->settings["server"]["user"],     // The Host username
                $this->settings["server"]["password"], // The Host Password
                $this->settings['server']["database"]  // The Host Database
            );
        }

        /* Function for connecting to the database */
        public function checkConnection()
        {
            if ($this->connectToServer())
            {   
                /* If the connection to the server is good, check for the database */
                if ($this->connectToDatabase())
                {
                    return TRUE;
                } 
                else 
                {
                    return "sql_db";
                }
            } 
            else 
            {
                return "sql_server";
            }
        }
    }
?>