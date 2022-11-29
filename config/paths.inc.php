<?php
/*--------------------------------------- PATHS ---------------------------------------*/
    /* Parsing the location of the root directory from the dir.ini file */
    $directories = getDirectories();

    /* The entire project's root directory */
    defined("ROOT")
        or define("ROOT", $directories['root']);

    /* Website Root */
    defined("WEB_ROOT")
        or define("WEB_ROOT", $directories['root'] . $directories['web_root']);

    /* Header Root */
    defined("HEADER_ROOT")
        or define("HEADER_ROOT", $directories['header_root']);

    /* Paths for heavily used files and locations */
    defined("CLASSES")
        or define("CLASSES", ROOT . '/src/classes/');

    defined("SCRIPTS")
        or define("SCRIPTS", ROOT . '/src/scripts/');

    defined("COMPOSER")
        or define("COMPOSER", ROOT . '/src/composer/vendor/autoload.php');

    defined("INI")
            or define("INI", ROOT . '/config/ini/');

    /*
        NOTE: This is to be ECHOed rather than Included
        It's a collection of Javascript functions
    */
    defined("JS.CONFIG")
            or define("CONFIG.JS", '<script type="text/Javascript" src=' . ROOT . '"/config/config.inc.js"></script>');
    /*-------------------------------------------------------------------------------------*/

    function getDirectories()
    {
        /*
            Getting directories from dir.ini file
            Use this to override system paths for various parts of the app
            Check the dir.default.ini for guide
        */
        if (file_exists(__DIR__ . "/ini/dir.ini"))
        {
            $directories = parse_ini_file(__DIR__ . "/ini/dir.ini");
        }
        else
        {
            /*
                Checking whether current document root is in public-html
                or in the main folder
            */
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/login.php"))
            {
                /* Document Root is in public-html */
                $directories = array(
                    "root" => $_SERVER['DOCUMENT_ROOT'] . "/../",
                    "web_root" => "/public-html",
                    "header_root" => "",
                );
            }
            else
            {
                /* Document Root is in Root Folder */
                $directories = array(
                    "root" => __DIR__ . "/..",
                    "web_root" => "/public-html",
                    "header_root" => "/public-html",
                );
            }
        }
        return $directories;
    }
