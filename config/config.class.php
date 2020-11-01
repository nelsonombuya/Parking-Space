<?php
/*===================================== Config Class ==================================*/
//  Class that can read and write the system's settings                                //
/*-------------------------------------------------------------------------------------*/
/*------------------------------------ REQUIREMENTS -----------------------------------*/
    require_once __DIR__ . "/paths.php";
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
    }
?>