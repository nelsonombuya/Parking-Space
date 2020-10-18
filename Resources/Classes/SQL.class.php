<?php
/*==========================================SQL CLASS=================================*/
/* Class used for SQL Commands and such. Makes Life Easier                            */
/*====================================================================================*/

/*=====================================Requirements===================================*/
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/Parser.php";
/*====================================================================================*/

    class SQL {
        protected $_connection;
        protected $_database;
        public  $connection_status;
        public  $prepared;
        public  $error;
        public  $setup_results;

        /*                              CONSTRUCTOR                                 */
        public function __construct(
            /*-------------------------- Arguments ---------------------------------*/
            $host = settings['server']['host'],             // The Host Name
            $user = settings['server']['user'],             // The Host username
            $password = settings['server']['password'],     // The Host Password
            $database = settings['server']['database']      // The Host Database
        )
        /*                          CONSTRUCTOR DEFINITION                          */
        {
            /* Saving Database as a variable for use outside the class */
            $this->_database = $database;

            /* Creating connection with server */
            if ($this->_connection = mysqli_connect($host, $user, $password)){
                /* Checking for a connection to the database */
                if ($this->_connection->query("USE $database")){
                    /* If connection to db occurs, use it as trhe main connection */
                    $this->reconnectToDB($host, $user, $password, $database);
                    $this->connection_status = "sql_connected_db";
                    return TRUE;
                } else {
                    /* Continue using connection to sql server if the connection to the db fails */
                    $this->connection_status = "sql_connected_server";
                    return FALSE;
                }
            } else {
                /* When no connection is made to the server */
                $this->_connection = null;
                $this->connection_status = "sql_disconnected";
                return FALSE;
            }
        }

        /*------------------------------- METHODS ----------------------------------*/
        protected function reconnectToDB(
            $host = settings['server']['host'],             // The Host Name
            $user = settings['server']['user'],             // The Host username
            $password = settings['server']['password'],     // The Host Password
            $database = settings['server']['database']      // The Host Database
        ){
            $this->_connection->close();
            return $this->_connection = mysqli_connect($host, $user, $password, $database);
        }

        public function runQuery($query){
            /* Running the query and fetching it's data */
            return $this->fetchResults($this->_connection->query($query));
        }

        public function prepareQuery($query){
            if (!$this->prepared = $this->_connection->stmt_init()){
                return $this->error = "sql_init";        // Error initializing the SQL Database connection

            } else if (!$this->prepared = $this->_connection->prepare($query)){
                return $this->error = "sql_prepare";     // Error preparing the SQL Statement
            } else {
                return TRUE;
            }
        }

        /* 
            NOTE: To Bind Data, one needs to call the bind function using the object 
                e.g. 
                $SQL = new SQL;
                ;
                if ($SQL->prepareQuery($query){
                    if ($SQL->prepared->bind_param("sss", $element, $of, $surpise)){
                        $SQL->executePreparedQuery();
        
                    }
                    $SQL->error = "sql_bind";
                }
        */

        public function executePreparedQuery(){
            if (!$this->prepared->execute()){
                /* Error Executing prepared query */                
                return $this->error ="sql_execute";     
    
            } else {                                
                /* Getting the results of the query */
                return $this->fetchResults($this->prepared->get_result());
            }
        }

        public function redirect($page, $error_type){
            if (!empty($this->error)){
                return header("Location: $page?$error_type-error=$this->error") or die();
            }
        }

        private function fetchResults($fetched){
            /* Outputting a boolean or associative array when necessary */
            if (is_bool($fetched)){
                $result = $fetched;
            } else {
                $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
            }
            return $result;
        }
    }
?>