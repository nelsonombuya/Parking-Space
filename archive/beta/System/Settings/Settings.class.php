<?php
/*=================================== Settings Class ==================================*/
//  Class that can read and write the system's settings                                //
/*-------------------------------------------------------------------------------------*/
    
    class Settings
    {
        public $version;
        public $settings;
        public $version_dir;
        public $version_dir_relative;

        public function __construct()
        {
            // Parsing the settings from Settings.ini and saving them
            if (!$this->settings = parse_ini_file(__DIR__ . "/Settings.ini", TRUE))
            {
                /* If the default settings file has been deleted, copy a new one using default settings */
                copy(__DIR__ . "Default.ini", __DIR__ . "/Settings.ini");
                $this->settings = parse_ini_file(__DIR__ . "/Settings.ini", TRUE);
            }

            // Setting current app version according to settings
            $this->version = $this->settings['system']['version'];
            $this->setVersionDirectories($this->version);
        }
        
        private function setVersionDirectories($version)
        {
            // Remove this line when running standalone beta EXTERNAL
            $this->version_dir_relative = "/archive/beta";

            // Setting Relative Path for selected version's root directory
            switch ($version)
            {
                case 'Current':
                    // Current working version
                    $this->version_dir_relative .= "/Main";
                break;

                case 'Alpha':
                    // Very First version
                    $this->version_dir_relative .= "/Versions/Alpha";
                break;
                
                case 'Beta':
                    // Version after major refactor
                    $this->version_dir_relative .= "/Versions/Beta";
                break;
                
                case 'Gamma':
                    // Version after Benji Joined
                    $this->version_dir_relative .= "/Versions/Gamma";
                break;

                default:
                    // If another version is picked, default to current version
                    $this->version_dir_relative .= "/Main";
                break;
            } 
            
            // Setting Absolute Path for selected version's root directory
            $this->version_dir = __DIR__ . "/../.." . $this->version_dir_relative;
        }
    }
?>