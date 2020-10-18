<?php
    // NOTE: The contents of this file are functions obtained from external sources for use in the project
    // This is the path for the external scripts folder
    define ('external_scripts', $_SERVER['DOCUMENT_ROOT'] . "/Resources/Scripts/External/");

    // NOTE: If you want to include all of the files within this folder, uncomment this line
    // foreach (glob($external_scripts . "*.php") as $file){include $file;}

    // NOTE: To include individual files, uncomment the following lines as necessary
    // NOTE: The following lines can also be added directly to the page that needs them
    // include external_scripts . "Elapsed.php";

###########################################################################################
    
    /* 
        COMPOSER
        ---------
        This is a toolkit used to add and maintain php scripts used in the project

        Scipts Used
        ------------
        So far, we're using the following plugins:
            1. jelix/inifile
                This is used for reading and writing into ini files
                https://github.com/jelix/inifile
                Uses \Jelix\IniFile\IniModifier
            2. phpunit/php-timer
                This is used to get the websites performance time
                Uses SebastianBergmann\Timer\Timer
    */
    // Autoloading the Composer Scripts used in the project
    // NOTE: Comment this line to turn off scripts from Composer
    require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";

###########################################################################################
?>