<?php
/*==========================================SQL CLASS=================================*/
/* Class used for SQL Commands and such. Makes Life Easier                            */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once __DIR__ . '/../../config/paths.php';
    require_once ROOT . '/config/config.class.php';
/*====================================================================================*/

    class SQL extends Config 
    {
        private $_prepared;
        protected $_connection;
        protected $_database;
        public  $connection_status;
        public  $error;

        /*                              CONSTRUCTOR                                 */
        public function __construct()
        {
            /* Getting the settings from the config class */
            parent::__construct();

            /* Setting the server details from the config ini file */
            $host = $this->config["server"]["host"];          // The host server
            $user = $this->config["server"]["user"];          // The host username
            $password = $this->config["server"]["password"];  // The host password
            $database = $this->config["server"]["database"];  // The host database name

            /* Saving Database as a variable for use outside the class */
            $this->_database = $database;

            /* Creating connection with server */
            if (!$this->connect($host, $user, $password, $database))
            {
                if ($this->config["setup"]["first_time"])
                {
                    echo    '<script type="text/JavaScript">  
                                alert("Error connecting to the SQL Server."); 
                            </script>';
                }
                else
                {
                    echo    '<script type="text/JavaScript">  
                                alert("The system needs to be setup."); 
                            </script>';
                }
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
                $this->config["server"]["host"],      // The host server
                $this->config["server"]["user"],      // The host username
                $this->config["server"]["password"],  // The host password
                $this->config["server"]["database"]   // The host database name
            );
        }

        /* Function for running a query and fetching it's data */
        public function runQuery($query)
        {
            return $this->fetchQueryResults($this->_connection->query($query));
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
                    return $this->fetchQueryResults($this->_prepared->get_result());
                }
            }
        }

        /* Function for binding values to a prepared query */
        // NOTE: Can do a maximum of 5 values so far
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

                case 4 :
                    if ($this->_prepared->bind_param($value_types, 
                        $data_array[0], 
                        $data_array[1], 
                        $data_array[2],
                        $data_array[3]))
                    {
                        return TRUE;
                    }
                    else
                    {
                        return $this->error = "sql_bind";
                    }
                break;

                case 5 :
                    if ($this->_prepared->bind_param($value_types, 
                        $data_array[0], 
                        $data_array[1], 
                        $data_array[2],
                        $data_array[3],
                        $data_array[4]))
                    {
                        return TRUE;
                    }
                    else
                    {
                        return $this->error = "sql_bind";
                    }
                break;

                case 6 :
                    if ($this->_prepared->bind_param($value_types, 
                        $data_array[0], 
                        $data_array[1], 
                        $data_array[2],
                        $data_array[3],
                        $data_array[4],
                        $data_array[5]))
                    {
                        return TRUE;
                    }
                    else
                    {
                        return $this->error = "sql_bind";
                    }
                break;

                case 7 :
                    if ($this->_prepared->bind_param($value_types, 
                        $data_array[0], 
                        $data_array[1], 
                        $data_array[2],
                        $data_array[3],
                        $data_array[4],
                        $data_array[5],
                        $data_array[6]))
                    {
                        return TRUE;
                    }
                    else
                    {
                        return $this->error = "sql_bind";
                    }
                break;

                case 8 :
                    if ($this->_prepared->bind_param($value_types, 
                        $data_array[0], 
                        $data_array[1], 
                        $data_array[2],
                        $data_array[3],
                        $data_array[4],
                        $data_array[5],
                        $data_array[6],
                        $data_array[7]))
                    {
                        return TRUE;
                    }
                    else
                    {
                        return $this->error = "sql_bind";
                    }
                break;

                case 9 :
                    if ($this->_prepared->bind_param($value_types, 
                        $data_array[0], 
                        $data_array[1], 
                        $data_array[2],
                        $data_array[3],
                        $data_array[4],
                        $data_array[5],
                        $data_array[6],
                        $data_array[7],
                        $data_array[8]))
                    {
                        return TRUE;
                    }
                    else
                    {
                        return $this->error = "sql_bind";
                    }
                break;

                case 10 :
                    if ($this->_prepared->bind_param($value_types, 
                        $data_array[0], 
                        $data_array[1], 
                        $data_array[2],
                        $data_array[3],
                        $data_array[4],
                        $data_array[5],
                        $data_array[6],
                        $data_array[7],
                        $data_array[8],
                        $data_array[9]))
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
        private function fetchQueryResults($fetched)
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
    }
?>