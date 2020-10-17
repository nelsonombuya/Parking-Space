<?php
    // Script for reading and modifying the system settings 
    // Parsing the settings from Settings.ini and saving it as a constant
    define('settings', parse_ini_file(
        $_SERVER['DOCUMENT_ROOT'] . "/Resources/Settings/Settings.ini", TRUE));

    // Version Management
    // Defining Current Root
    switch (settings['setup']['version']){
        case 'Alpha':
            // Very First version 
            $selected_version_root_dir = "/Other Versions/Alpha";
        break;

        case 'Beta':
            // Version after major refactor
            $selected_version_root_dir = "/Other Versions/Beta";
        break;
        
        case 'Gamma':
            // Version after major refactor
            $selected_version_root_dir = "/Other Versions/Gamma";
        break;
        
        default:
            // Current working version
            $selected_version_root_dir = "/Parking Space";
        break;
    }

    // Defining root directory depending on the webpage version settings
    // Absolute directories to be used with Require or Include statements
    define ('absolute_root_dir', $_SERVER['DOCUMENT_ROOT'] . $selected_version_root_dir);

    // Relative directories to be used with header methods
    define ('relative_root_dir', $selected_version_root_dir);

    // Setting Default Time Zone
    date_default_timezone_set(settings['server']['time_zone']);
?>