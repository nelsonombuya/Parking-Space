<?php
/*===================================== Config Class ==================================*/
/*  Class that can read and write the system's settings (Plus extra helpful functions) */
/*-------------------------------------------------------------------------------------*/
/*------------------------------------ REQUIREMENTS -----------------------------------*/
    require_once __DIR__ . "/paths.inc.php";
/*-------------------------------------------------------------------------------------*/
    class Config
    {
        private $_config_path_default;
        private $_config_path;
        public $config;
        public $version;
        public $root;
        public $web_root;
        public $header_root;

        public function __construct()
        {
            // Setting the path to the config.ini files
            $this->_config_path_default = INI . "config.default.ini";
            $this->_config_path = INI . "config.ini";
            
            /* 
                If the default config.ini file has been deleted, 
                copy a new one containing default settings 
            */
            if (!file_exists($this->_config_path))
            {
                copy(
                    // Copy this file
                    $this->_config_path_default,
                    
                    // Paste the file as this new file
                    $this->_config_path
                );
            }

            // Parsing the system settings from the config.ini file
            $this->config = parse_ini_file($this->_config_path, TRUE);

            // Setting current app version according to settings
            $this->version = $this->config['system']['version'];

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
    }
?>