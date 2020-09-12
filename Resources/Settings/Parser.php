<!-- Script for reading and modifying the system settings -->
<?php
    // Defining the path for the system's settings
    define('settings_path', 
        $_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Settings.ini") ;

    // Parsing the settings from Settings.ini and saving it as a constant
    define('settings', parse_ini_file(settings_path, TRUE));
?>