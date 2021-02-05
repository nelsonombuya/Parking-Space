<?php
/*===================================== Config Class ==================================*/
/*  Class that can read and write the system's settings (Plus extra helpful functions) */
/*-------------------------------------------------------------------------------------*/
/*------------------------------------ REQUIREMENTS -----------------------------------*/
    require_once __DIR__ . "/paths.inc.php";
/*-------------------------------------------------------------------------------------*/
    class Config
    {
        private $_config_path;
        public $config;
        public $root;
        public $web_root;
        public $header_root;

        public function __construct()
        {
            // Setting the path to the config.ini files
            $this->_config_path = INI . "config.ini";
            
            /* 
                If the default config.ini file has been deleted, 
                create a new config.ini file
                then add the default settings into it
            */
            if (!file_exists($this->_config_path)) $this->setDefaultSettings();

            // Parsing the system settings from the config.ini file
            $this->config = parse_ini_file($this->_config_path, TRUE);

            // Setting current paths for use in classes
            $this->root = ROOT;
            $this->web_root = WEB_ROOT;
            $this->header_root = HEADER_ROOT;
        }

        public function URLHandler($_GET_variables_array, $add = TRUE, $url = null)
        {
            /* Setting the current page as the URL if it hasn't been explicitly defined */
            if ($url === null) $url = $_SERVER['REQUEST_URI'];

            /* Adding or Removing $_GET variables to/from the current url */
            $url = $add === TRUE ? 
                $this->addGETVariables($_GET_variables_array, $url) : 
                $this->removeGETVariables($_GET_variables_array, $url);

            /* Returning the new url */
            return $url;
        }

        private function addGETVariables($_GET_variables_array, $url)
        {
            if (strpos($url, '?') !== FALSE) 
            { 
                foreach($_GET_variables_array as $variable => $value)
                {
                    $url .= "&" . $variable . "=" . $value;
                }
            }
            else
            {
                $counter = 0;
                foreach($_GET_variables_array as $variable => $value)
                {
                    $url .= ($counter == 0) ? ("?" . $variable . "=" . $value) : ("&" . $variable . "=" . $value);
                    $counter++;
                }
            }
            return $url;        
        }

        private function removeGETVariables($_GET_variables_array, $url)
        {
            /* Removing the variable from the link */
            foreach($_GET_variables_array as $variable => $value)
            {
                if (strpos($url, "?" . $variable . "=" . $value) !== FALSE) 
                {
                    $url = str_replace("?" . $variable . "=" . $value, "?", $url);
                }
                else
                {
                    $url = str_replace("&" . $variable . "=" . $value, "", $url);
                }
            }

            /* Fixing the link in case of ?& */
            $url = str_replace("?&", "?", $url);

            /* Returning the corrected URL */
            return $url;        
        }

        /* Method to create the config.ini file if it doesn't exist, and write the default settings into it */
        protected function setDefaultSettings()
        {
            $default_settings = 
            '
            ; <?php die(); ?>
            ;==========================================================================================
            ; General settings File for the Car Parking Management System
            ;
            ;==========================================================================================
            ; Server Settings
            ; You can change these settings according to your XAMPP Server Settings
            ;------------------------------------------------------------------------------------------
            [server]
            host        = "localhost"
            user        = "root"
            password    = ""
            database    = "Car_Parking_System"
            time_zone   = "Africa/Nairobi"

            ;------------------------------------------------------------------------------------------
            ; System Settings
            ;------------------------------------------------------------------------------------------
            [system]
            ; Setting this to true uses the shortest path algorithm to find the next closest spot
            ; Setting it to false makes it get any available spot instead
            next_closest_spot = FALSE

            ;------------------------------------------------------------------------------------------
            ; Settings used during setup process
            ;------------------------------------------------------------------------------------------
            [setup]
            ; Setting for adding test data to the tables during setup
            add_test_data = TRUE

            ; Checking whether the system has been setup for the first time
            first_time = FALSE

            ;------------------------------------------------------------------------------------------
            ; Settings for the parking fees charges
            ;------------------------------------------------------------------------------------------
            [charges]
            enabled = TRUE

            ; Parking fees duration in minutes
            duration = 60

            ; Parking fees amount
            ; Use Local Currency
            cost = 20

            ';
            fopen(__DIR__ . "/config.ini", "w");
            file_put_contents(__DIR__ . "/config.ini", $default_settings);
        }
    }
?>